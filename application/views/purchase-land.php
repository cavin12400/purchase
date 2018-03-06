<?php $this->load->view('header') ?>
<h1>Purchase Orders</h1>
		<form class="navbar-form pull-right" action="<?php echo base_url().'purchase/searchdate';?>" method="post">
	        
	          <input type="text" name="search" id="menubutton"  class="form-control" placeholder="Search">
	        
	        <button type="submit" name="submit" id="menubutton" class="btn btn-default">Submit</button>
	    </form>
		
		<form action="<?php echo base_url().'purchase/start';?>" method="post">
			
		<a href="<?php echo base_url().'purchase/add'; ?>" id="menubutton" class="btn btn-primary pull-left">Add Purchase</a>
		<button type="submit" id="menubutton" name="delete_button" class="btn btn-danger pull-left" onclick="return confirm('Delete Entry?')">Delete</button>
		<div  id="menubutton" class="form-group pull-left">
			<div id="config-demo" class="form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span>Date Range</span> <b class="caret"></b>
			</div>
		</div>
		<a href="<?php echo $paymentlink ?>" id="menubutton" class="btn btn-info pull-left unpaid"><?php echo $paymentText ?></a>
		<br><br>
		<br>

			<table class="table table-hover text-center table-responsive table-bordered" id="example">

			  <thead>
			  	<tr>
			  		<th></th>
			  		<th><input type="checkbox" id="checkBoxAll"> Purchase ID</th>
			  		<th>Purchase Date</th>
			  		<th>Total Amount</th>
			  		<th>Total Payment</th>
			  		<th>Total Balance</th>
			  	</tr>
			  </thead>
			  <?php foreach ($purchase_detail as $queries): ?>
			  	<tr>
			  		<td>
			  			<a href="<?php echo base_url();?>purchase/view/<?php echo $queries->purchase_id; ?>" class="btn btn-info"><i class="fa fa-search"></i></a>
			  			<a href="<?php echo base_url();?>purchase/report_gen/<?php echo $queries->purchase_id; ?>" class="btn btn-success" onclick="return !window.open(this.href, 'Report', 'width=700,height=900')"
    					target="_blank"><i class="fa fa-download"></i></a>
						<a href="<?php echo base_url();?>purchase/edit/<?php echo $queries->purchase_id; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
						<?php 
							$base_url = base_url();
							$purchase_id = $queries->purchase_id;
							if($queries->total_balance>0){
								echo "<a href=".$base_url."purchase/pay/".$purchase_id." class='btn btn-default'>Pay Now!</a>";
							}
						?></td>
			  		<td><input type="checkbox" class="chkbox" name="purchase_id[]" value="<?php echo $queries->purchase_id; ?>"> <?php echo $queries->purchase_id; ?></td>
			  		<td><?php echo $queries->Date_Ordered; ?></td>

			  		<td>PHP<?php echo $queries->total_amount; ?></td>
			  		<td>PHP<?php echo $queries->total_payment; ?></td>
			  		<td>PHP<?php echo $queries->total_balance; ?></td>
			  	</tr>

			  <?php endforeach;?>
			</table>

			</form>
			<br>
			
			


<?php $this->load->view('footer') ?>
<script src="<?php echo base_url().'assets/js/removesearch.js'?>"></script>
