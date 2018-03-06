<?php $this->load->view('header') ?>
<h2>Detailed View</h2>
<div class="col-md-4">
	<table class="table text-center table-responsive table-bordered" >
	<tbody>
	
		
	
		<tr>
			<th>Purchase ID:</th>
			<td><?php echo $details->purchase_id; ?></td>
		</tr>
		<tr>
			<th>Supplier IDs:</th>
			<td><?php echo $details->supplier_id; ?></td>
		</tr>
		<tr>
			<th>Notes:</th>
			<td><?php echo $details->notes; ?></td>
		</tr>
		<tr>
			<th>Total Amount:</th>
			<td>PHP<?php echo $details->total_amount; ?></td>
		</tr>

		<tr>
			<th>Purchase Date:</th>
			<td><?php echo date("F j, Y",strtotime($details->Date_Ordered)); ?></td>
		</tr>
		<tr>
			<th>Added By:</th>
			<td><?php echo $details->Added_by; ?></td>
		</tr>
		<tr>
			<th>Date Updated:</th>
			<td><?php echo date("F j, Y",strtotime($details->Date_updated)); ?></td>
		</tr>
		<tr>
			<th>Updated By:</th>
			<td><?php echo $details->Update_by; ?></td>
		</tr>
	
	</tbody>
	</table>

	<a href="<?php echo base_url().'purchase/start';?>" id="menubutton" class="btn btn-info pull-left unpaid">Go back</a>
</div>

<div class="col-md-8">
	<table class="table text-center table-responsive table-bordered" id="example">
		<thead>
			<th>Supplier</th>
			<th>Stock Item</th>
			<th>Quantity</th>
			<th>Purchase Price</th>
			<th>Selling Price</th>
			<th>Line Total</th>
		</thead>
		<tbody>
		<?php foreach ($purchase_detail as $asd): ?>
		<tr>
			<?php foreach ($supplier_info as $id): ?>
				<?php 
				if(($id->supplier_id) == ($asd->supplier_id)){
					echo "<td>".$id->supplier_name."</td>";
				}
				
			?>
			<?php endforeach ?>
			<?php foreach ($product_info as $prod_name): ?>
			<?php 
			  	if(($prod_name->product_id) == ($asd->product_id)){
			  		echo "<td>".$prod_name->product_name."</td>";
			  	}
			
			?>
			<?php endforeach ?>
			<td><?php echo $asd->qty_IN ?></td>
			<td>PHP<?php echo $asd->purchase_price ?></td>
			<td>PHP<?php echo $asd->selling_price ?></td>
			<td>PHP<?php echo $asd->total_amount ?></td>
		
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php $this->load->view('footer') ?>

<script src="<?php echo base_url().'assets/js/addsearch.js'?>"></script>