<?php include('header.php'); ?>

	<div class="container-fluid">
	<?php 
		if($error = $this->session->flashdata('response')):
		{						
	?>
			<div class="alert alert-success">
			<span class ="glyphicon glyphicon-info-sign"></span>
			<?php echo $error; ?>
				</div>
			<?php 
			}
			endif
			?>

		<div style ="padding-right: 30px;" class="col-md-4">
			<?php echo form_open("home/update/{$record->id}",['class' => 'form-horizontal']); ?>
				<center><h2>Vendor Details</h2></center>
				<hr/>
				
				<div class="form-group">
					<label for="tVendorCode" class="control-label">Vendor Code</label>
					<?php echo form_input(['type' => 'text','name' => 'tVendorCode', 'class' => 'form-control',
						'autocomplete' => 'off', 'readonly' => 'true'],$record->tVendorCode); ?>
					<span> <?php echo form_error('tVendorCode') ?> </span>
				</div>
				<div class="form-group">
					<label for="tVendorName" class="control-label">Vendor Name</label>
					<?php echo form_input(['type' => 'text','name' => 'tVendorName', 'class' => 'form-control',
						'autocomplete' => 'off',],$record->tVendorName); ?>
					<span> <?php echo form_error('tVendorName') ?> </span>
				</div>
				<div class="form-group">
					<label for="tContactNo" class="control-label">Contact No</label>
					<?php echo form_input(['type' => 'text','name' => 'tContactNo', 'class' => 'form-control',
						'autocomplete' => 'off'],$record->tContactNo); ?>
					<span> <?php echo form_error('tContactNo') ?> </span>
				</div>
				<div class="form-group">
					<label for="tEmail" class="control-label">Email</label>
					<?php echo form_input(['type' => 'text','name' => 'tEmail', 'class' => 'form-control',
						'autocomplete' => 'off'],$record->tEmail); ?>
					<span> <?php echo form_error('tEmail') ?> </span>
				</div>
				<div class="form-group">
					<label for="tAddress" class="control-label">Address</label>
					<?php echo form_textarea(['type' => 'text','name' => 'tAddress', 'class' => 'form-control',
						'autocomplete' => 'off'],$record->tAddress); ?>
					<span> <?php echo form_error('tAddress') ?> </span>
				</div>
				<div class="form-group">
					<?php echo form_submit(['value' => 'Update','class' => 'btn btn-primary']); ?>
					&nbsp;&nbsp;<?php echo anchor("home/index","View List"); ?>
				</div>
				<hr/>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-8">
			<center><h2>Product List</h2></center>
			<hr/>
			<div class="row">
				<div class="col-xs-2">
					<?php echo anchor("home/add_product/{$record->id}","Add Product",["class"=>"btn btn-default"]); ?>
				</div>
				<div class="col-lg-6">
					<?php echo form_open("home/search_product/{$record->id}",['class' => 'form-horizontal','method' => 'post']); ?>
				    	<div class="input-group">
					    	<?php echo form_input(['type' => 'text','name' => 'search','id' => 'search', 'class' => 'form-control',
										'autocomplete' => 'on', 'placeholder' => 'Search Product Name']); ?>
					      	<span class="input-group-btn">
					        	<?php echo form_button(['type' => 'submit','class' => 'btn btn-default','name' => 'submit','content' => "<span class='btn-label'><i class='glyphicon glyphicon-search'></i></span>"]); ?>
					      	</span>
				    	</div>
			    	<?php echo form_close(); ?>
			    </div>
			    <?php echo anchor("home/view_vendor/{$record->id}","<i class='glyphicon glyphicon-refresh'></i>",["class"=>"btn btn-default"]); ?>
	    	</div><br>
			<table class="table table-striped">
			 	<thead>
			  	<tr>
				    <th>Product Name</th>
				    <th>Product Code</th>
				    <th>Product Description</th>
				    <th></th>
				    <th></th>
			    </tr>
			  	</thead>
			  	<tbody>
				  	<?php if(count($products)): ?>
				  		<?php foreach($products as $product) { ?>
						    <tr>
						    	<td><?php echo $product->tProductName ?></td>
						    	<td><?php echo $product->tProductCode ?></td>
						    	<td><?php echo $product->tProductDesc ?></td>
						    	<td><?php echo anchor("home/edit_product/{$product->id}/{$product->tVendorID}","Update",["class"=>"btn btn-success"]); ?></td>
						    	<td><?php echo anchor("home/delete/{$product->id}/tblProducts/{$product->tVendorID}","Delete",["class"=>"btn btn-danger","onclick" => "return confirm('Are you sure you want delete?')"]); ?></td>
						    </tr>
						<?php } else: ?>
						<td>No Product(s) Found!</td>
					<?php endif; ?>
			  	</tbody>
			</table>
			<!--<center>
				<?php echo $links ?>
			</center>-->
		</div>		
	</div>

<?php include('footer.php'); ?>