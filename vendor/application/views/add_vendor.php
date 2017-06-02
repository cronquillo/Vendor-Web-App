<?php include('header.php'); ?>

	<div class="container">
		<div style ="width:500px;margin:auto;">
			<?php echo form_open('home/save/tblVendors',['class' => 'form-horizontal']); ?>
				<center><h2>Add Vendor Details</h2></center>
				<hr/>
				<?php 
					if($error = $this->session->flashdata('response')):
					{						
				?>
					<div class="alert alert-success">
						<span class ="glyphicon glyphicon-info-sign"></span>
						<?php echo $error; ?>
						<?php echo anchor("home/index","View List"); ?>
					</div>
				<?php 
					}
					endif
				?>
				<div class="form-group">
					<label for="tVendorCode" class="control-label">Vendor Code</label>
					<?php echo form_input(['type' => 'text','name' => 'tVendorCode', 'class' => 'form-control',
						'autocomplete' => 'on', 'value' => set_value('tVendorCode')]); ?>
					<span> <?php echo form_error('tVendorCode') ?> </span>
				</div>
				<div class="form-group">
					<label for="tVendorName" class="control-label">Vendor Name</label>
					<?php echo form_input(['type' => 'text','name' => 'tVendorName', 'class' => 'form-control',
						'autocomplete' => 'off', 'value' => set_value('tVendorName')]); ?>
					<span> <?php echo form_error('tVendorName') ?> </span>
				</div>
				<div class="form-group">
					<label for="tContactNo" class="control-label">Contact No</label>
					<?php echo form_input(['type' => 'text','name' => 'tContactNo', 'class' => 'form-control',
						'autocomplete' => 'off', 'value' => set_value('tContactNo')]); ?>
					<span> <?php echo form_error('tContactNo') ?> </span>
				</div>
				<div class="form-group">
					<label for="tEmail" class="control-label">Email</label>
					<?php echo form_input(['type' => 'text','name' => 'tEmail', 'class' => 'form-control',
						'autocomplete' => 'off', 'value' => set_value('tEmail')]); ?>
					<span> <?php echo form_error('tEmail') ?> </span>
				</div>
				<div class="form-group">
					<label for="tAddress" class="control-label">Address</label>
					<?php echo form_textarea(['type' => 'text','name' => 'tAddress', 'class' => 'form-control',
						'autocomplete' => 'off', 'value' => set_value('tAddress')]); ?>
					<span> <?php echo form_error('tAddress') ?> </span>
				</div>
				<hr>
				<div class="form-group">
					<?php echo form_submit(['value' => 'Save','class' => 'btn btn-primary']); ?>
					&nbsp;&nbsp; <?php echo anchor("home/index","View List"); ?>
				</div>
			<?php echo form_close(); ?>
		</div>		
	</div>

<?php include('footer.php'); ?>