<?php
	class Home extends CI_Controller
	{
		public function index()
		{
			$this->load->library('pagination');
			$this->load->model('CrudModel');
			$config = $this->pagination_config(base_url().'index.php/home/index',$this->CrudModel->count_vendors(),5);

			$this->pagination->initialize($config);
			$data['records']= $this->CrudModel->getRecords($config['per_page'],$this->uri->segment(3));
			$data['links'] = $this->pagination->create_links();
			$this->load->view('home',$data);
		}

		public function view_vendor($record_id)
		{
			//$this->load->library('pagination');
			$this->load->model('CrudModel');
			//$config = $this->pagination_config(base_url().'index.php/home/view_vendor/'.$record_id,$this->CrudModel->count_products($record_id),2);

			//$this->pagination->initialize($config);
			$data['record'] = $this->CrudModel->getAllRecords( $record_id,'tblVendors' );
			$data['products'] = $this->CrudModel->getProducts($record_id);
			//$data['links'] = $this->pagination->create_links();
			$this->load->view('view_vendor',$data);
		}

		public function pagination_config($base_url,$total_rows,$per_page)
		{
			$config = array();
			$config['base_url'] = $base_url;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['num_links'] = 3;

			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';

			return $config;
		}

		public function search()
		{
			$this->load->model('CrudModel');
			$searched_item = $this->input->post('search');

			if(isset($searched_item) and !empty($searched_item))
			{
				$data['links'] = '';
				$data['records'] = $this->CrudModel->search($searched_item);
				$this->load->view('home',$data);
			}
			else
			{
				redirect($this->index());
			}
		}

		public function search_product($vendorID)
		{
			$this->load->model('CrudModel');
			$searched_item = $this->input->post('search');
			$data['record'] = $this->CrudModel->getAllRecords( $vendorID,'tblVendors' );
			$data['products'] = $this->CrudModel->search_product($searched_item,$vendorID);
			$this->load->view('view_vendor',$data);
		}

		public function add_vendor()
		{
			$this->load->view('add_vendor');
		}

		public function add_product($vendorID)
		{
			$this->load->model('CrudModel');
			$records= $this->CrudModel->vendorCode();
			$this->load->view('add_product',['records'=>$records,'vendorID' => $vendorID]);
		}

		public function save($tableName)
		{
			$this->form_validation->set_rules('tVendorCode','Vendor Code','required|is_unique[tblVendors.tVendorCode]');
			$this->form_validation->set_rules('tVendorName','Vendor Name','required');
			$this->form_validation->set_rules('tContactNo','Contact No','required');
			$this->form_validation->set_rules('tEmail','Email','trim|required|valid_email');
			$this->form_validation->set_rules('tAddress','Address','required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run())
            {
            	$data = $this->input->post();
                $this->load->model('CrudModel');
                if($this->CrudModel->saveRecord($data,$tableName))
                {
                	$this->session->set_flashdata('response','Vendor Successfully Saved.');
                }
                else
                {
					$this->session->set_flashdata('response','Vendor Not Saved!');
                }
                return redirect('home/add_vendor');
            }
            else
            {
                $this->load->view('add_vendor');
            }
		}

		public function save_product($tableName)
		{
			$this->form_validation->set_rules('tVendorID','Vendor Code','required');
			$this->form_validation->set_rules('tProductName','Product Name','required');
			$this->form_validation->set_rules('tProductCode','Product Code','required','required|is_unique[tblProducts.tProductCode]');
			$this->form_validation->set_rules('tProductDesc','Product Description','required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run())
            {
            	$data = $this->input->post();
                $this->load->model('CrudModel');
                if($this->CrudModel->saveRecord($data,$tableName))
                {
                	$this->session->set_flashdata('response', $data['tProductCode'].' was Successfully Saved.');
                }
                else
                {
					$this->session->set_flashdata('response',$data['tProductCode'].' was Not Saved!');
                }
                return redirect('home/add_product/0');
            }
            else
            {
            	$this->load->model('CrudModel');
            	$records= $this->CrudModel->vendorCode();
                $this->load->view('add_product',['records'=>$records,'vendorID' => 0]);
            }
		}


		public function edit($record_id)
		{
			$this->load->model('CrudModel');
			$record = $this->CrudModel->getAllRecords( $record_id,'tblVendors' );
			$this->load->view('update_vendor',['record'=>$record]);
		}

		public function edit_product($record_id)
		{
			$this->load->model('CrudModel');
			$record = $this->CrudModel->getAllRecords( $record_id,'tblProducts' );
			$vendorCodes= $this->CrudModel->vendorCode();
			$this->load->view('update_product',['record'=>$record,'vendorCodes' => $vendorCodes]);
		}

		public function update($record_id)
		{
			$this->form_validation->set_rules('tVendorCode','Vendor Code','required');
			$this->form_validation->set_rules('tVendorName','Vendor Name','required');
			$this->form_validation->set_rules('tContactNo','Contact No','required');
			$this->form_validation->set_rules('tEmail','Email','trim|required|valid_email');
			$this->form_validation->set_rules('tAddress','Address','required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run())
            {
            	$data = $this->input->post();
                $this->load->model('CrudModel');
                if($this->CrudModel->updateRecord( $record_id,$data,'tblVendors' ))
                {
                	$this->session->set_flashdata('response',$data[tVendorCode].' was Successfully Updated.');
                }
                else
                {
					$this->session->set_flashdata('response',$data[tVendorCode].' was Not Updated!');
                }
                return redirect("home");
            }
            else
            {
                $this->load->model('CrudModel');
				$record = $this->CrudModel->getAllRecords( $record_id,'tblVendors' );
				$products = $this->CrudModel->getProducts( $record_id );
				$this->load->view('view_vendor',['record'=>$record,'products' => $products]);
            }
		}

		public function update_product($record_id,$vendorID)
		{
			$this->form_validation->set_rules('tProductCode','Product Code','required');
			$this->form_validation->set_rules('tProductName','Product Name','required');
			$this->form_validation->set_rules('tProductDesc','Product Description','required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run())
            {
            	$data = $this->input->post();
                $this->load->model('CrudModel');
                if($this->CrudModel->updateRecord( $record_id,$data,'tblProducts'))
                {
                	$this->session->set_flashdata('response',$data['tProductCode'].' was  successfully updated.');
                }
                else
                {
					$this->session->set_flashdata('response',$data['tProductCode'].' was  not successfully updated.!');
                }
                return redirect("home/view_vendor/{$vendorID}");
            }
            else
            {
                $this->load->model('CrudModel');
				$record = $this->CrudModel->getAllRecords( $record_id,'tblProducts' );
				$vendorCodes= $this->CrudModel->getRecords();
				$this->load->view('update_product',['record'=>$record,'vendorCodes' => $vendorCodes]);
            }
		}

		public function delete($record_id,$tableName,$vendorID)
		{
			$data = array('bActive' => 0, 'dDateDeleted' => date("Y-m-d H:i:s"));
			$this->load->model('CrudModel');
			if($this->CrudModel->deleteRecord( $record_id,$data,$tableName ))
			{
				$this->session->set_flashdata('response','Record Successfully Deleted.');
			}
			else
			{
				$this->session->set_flashdata('response','Record Not Deleted!');
			}

			if($tableName == 'tblProducts')
			{
				return redirect("home/view_vendor/$vendorID");
			}
			else
			{
				return redirect('home');
			}
		}
	}

?>