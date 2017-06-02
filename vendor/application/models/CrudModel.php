<?php 
	class CrudModel extends CI_Model
	{
		public function count_vendors()
		{
			$this->db->where('bActive',1);
			$this->db->from('tblVendors');
			return $this->db->count_all_results();
			//return $this->db->count_all($table_name);
		}

		public function count_products($vendorID)
		{
			$this->db->where('bActive',1);
			$this->db->where('tVendorID',$vendorID);
			$this->db->from('tblProducts');
			return $this->db->count_all_results();
		}

		public function getRecords($limit,$offset)
		{
			$this->db->limit($limit,$offset);
			$this->db->order_by('tVendorName', 'ASC');
			$query = $this->db->get_where('tblVendors', array('bActive' => 1));
			return $query->result();
		}

		public function vendorCode()
		{
			$query = $this->db->get_where('tblVendors', array('bActive' => 1));
			return $query->result();
		}

		public function saveRecord( $data,$tableName )
		{
			return $this->db->insert($tableName,$data);
		}

		public function getAllRecords( $record_id,$tableName )
		{
			$query = $this->db->get_where($tableName,array('id'=> $record_id));
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

		public function getProducts($record_id)
		{
			//$this->db->limit($limit,$offset);
			$this->db->order_by('tProductName', 'ASC');
			$query = $this->db->get_where('tblProducts', array('tVendorID'=> $record_id,'bActive' => 1));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function updateRecord( $record_id,$data,$tableName )
		{
			return $this->db->where('id',$record_id)->update($tableName,$data);
		}

		public function deleteRecord($record_id ,$data,$tableName )
		{
			return $this->db->where('id',$record_id)->update($tableName,$data);
		}

		public function search($searched_item)
		{
			$this->db->select('*');
			$this->db->like('tVendorName',$searched_item);
			$query = $this->db->get_where('tblVendors', array('bActive' => 1));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function search_product($searched_item,$vendorID)
		{
			$this->db->select('*');
			$this->db->like('tProductName',$searched_item);
			$query = $this->db->get_where('tblProducts', array('bActive' => 1,'tVendorID' => $vendorID));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}
	}

?>