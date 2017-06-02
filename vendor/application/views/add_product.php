<?php include('header.php'); ?>

	<div class="container">
		<div style ="width:500px;margin:auto;">
			<?php echo form_open('home/save_product/tblProducts',['class' => 'form-horizontal']); ?>
				<center><h2>Add Product Details</h2></center>
				<hr/>
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

				<div class="form-group">
					<label for="tProductCode" class="control-label">Product Code</label>
					<?php echo form_input(['type' => 'text','name' => 'tProductCode', 'class' => 'form-control',
						'autocomplete' => 'off', 'value' => set_value('tProductCode')]); ?>
					<span> <?php echo form_error('tProductCode') ?> </span>
				</div>
				<div class="form-group">
					<label for="tProductName" class="control-label">Product Name</label>
					<?php echo form_input(['type' => 'text','name' => 'tProductName', 'class' => 'form-control',
						'autocomplete' => 'on', 'value' => set_value('tProductName')]); ?>
					<span> <?php echo form_error('tProductName') ?> </span>
				</div>
				<div class="form-group">
					<label for="tVendorID" class="control-label">Vendor Code</label>
					<?php
						$vendors = array();
						foreach($records as $record)
						{
							$vendors[$record->id]=$record->tVendorCode;
						}
					echo form_dropdown(['name' => 'tVendorID', 'class' => 'form-control',
						'autocomplete' => 'on'],$vendors,$vendorID); ?>
					<span> <?php echo form_error('tVendorID') ?> </span>
				</div>
				<div class="form-group">
					<label for="tProductDesc" class="control-label">Product Description</label>
					<?php echo form_textarea(['type' => 'text','name' => 'tProductDesc', 'class' => 'form-control',
						'autocomplete' => 'off', 'value' => set_value('tProductDesc')]); ?>
					<span> <?php echo form_error('tProductDesc') ?> </span>
				</div>
				<div class="form-group">
					<?php echo form_submit(['value' => 'Save','class' => 'btn btn-primary']); ?>
					&nbsp;&nbsp; <?php echo anchor("home/index","View List"); ?>
				</div>
				<hr/>
			<?php echo form_close(); ?>
		</div>		
	</div>

<?php include('footer.php'); ?>