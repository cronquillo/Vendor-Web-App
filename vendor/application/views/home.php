<?php include('header.php'); ?>

<div class="container">

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
	<div class="row">
	  	 <div class="col-xs-3">
		  	<?php echo anchor("home/add_vendor","Add Vendor",["class"=>"btn btn-default"]); ?>
			<?php echo anchor("home/add_product/0","Add Product",["class"=>"btn btn-default"]); ?>
	 	</div>
  		<div class="col-lg-6">
  		<?php echo form_open('home/search',['class' => 'form-horizontal','method' => 'post']); ?>
	    	<div class="input-group">
		    	<?php echo form_input(['type' => 'text','name' => 'search','id' => 'search', 'class' => 'form-control',
							'autocomplete' => 'on', 'placeholder' => 'search Vendor Name']); ?>
		      	<span class="input-group-btn">
		        	<?php echo form_button(['type' => 'submit','class' => 'btn btn-default','name' => 'submit','content' => "<span class='btn-label'><i class='glyphicon glyphicon-search'></i></span>"]); ?>
		      	</span>
	    	</div>
	    <?php echo form_close(); ?>
  		</div>
  		<?php echo anchor("home/index","<i class='glyphicon glyphicon-refresh'></i>",["class"=>"btn btn-default"]); ?>
	</div><br>
	<div class="row">
	<table class="table table-striped">
	  <thead>
	  	<tr>
	      <th>Vendor Name</th>
	      <th>Vendor Code</th>
	      <th>Contact No</th>
	      <th>Email</th>
	      <th>Address</th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php if(count($records)): ?>
	  		<?php foreach($records as $record) { ?>
			    <tr>
			    	<td><?php echo anchor("home/view_vendor/{$record->id}",$record->tVendorName);?></td>
			    	<td><?php echo $record->tVendorCode ?></td>
			    	<td><?php echo $record->tContactNo ?></td>
			   		<td><?php echo $record->tEmail ?></td>
			    	<td><?php echo $record->tAddress ?></td>
			    	<!-- <td><?php echo anchor("home/edit/{$record->id}","Update",["class"=>"btn btn-success"]); ?></td> -->
			    	<td><?php echo anchor("home/delete/{$record->id}/tblVendors/{$record->id}","Delete",["class"=>"btn btn-danger","onclick" => "return confirm('Are you sure you want delete?')"]); ?></td>
			    </tr>
			<?php } else: ?>
			<tr>No Records Found!</tr>
		<?php endif; ?>
	  </tbody>
	</table>
	<center>
		<?php echo $links ?>
	</center>
	</div>
</div>

<?php include('footer.php'); ?>