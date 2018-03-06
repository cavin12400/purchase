<?php $this->load->view('header') ?>
<?php $start=4;
	$startplus=0;
 ?>
<div class="container " align="center">
		<br>
		
		<form  id="addform" name="theform" method="post">
		<div class="container-fluid">
		  <div class="form-group">
		    <label >Purchase ID:</label>
		    
		    	
		    
		    <input type="text"  value="<?php echo $purchase_order_id->purchase_id ?>" class="form-control form-small"  disabled>
		    <input type="hidden" name="purchase_id" value="<?php echo $purchase_order_id->purchase_id ?>" class="form-control form-small"  >
		  </div>
		  <div class="form-group">
		    <label >Purchase Date:</label>
		    <input type="date" name="purdate" value="<?php echo $purchase_order_id->Date_Ordered ?>" class="form-control form-small" required>
		    <input type="date" name="update" value="<?php echo date('Y-m-d');?>" hidden>
		  </div>
		  <div class="form-group">
		    <label >Notes:</label>
		    <input type="text" name="notes" class="form-control form-small" value="<?php echo $purchase_order_id->notes ?>" >
		  </div>
		  <div class="form-group">
		    <label >Total Amount:</label>
		    <input type="text" name="tamount" class="form-control form-small total-amount" value="<?php echo $purchase_order_id->total_amount ?>" disabled>
		    <input type="hidden" name="tamount" id="tamount" value="<?php echo $purchase_order_id->total_amount ?>" class="form-control form-small total-amount" >
		  </div>
		  <div class="form-group">
		    <label >Total Payment:</label>
		    <input type="number" name="tpayment" id="tpayment" min="1" max="2" value="<?php echo $purchase_order_id->total_payment ?>" class="form-control form-small total-payment" required>
		  </div>
		  <div class="form-group">
		    <label >Total Balance:</label>
		    <input type="text" name="tbalance" value="<?php echo $purchase_order_id->total_balance ?>" class="form-control form-small total-balance" disabled>
		    <input type="hidden" name="tbalance" value="<?php echo $purchase_order_id->total_balance ?>" class="form-control form-small total-balance" >
		  </div><br>
		<button type="submit" class="btn btn-primary" name="editbtn"  onclick="getMaxValueForRequest();">Submit Edit</button>
		<a href="<?php echo base_url();?>purchase/start" class="btn btn-default">Cancel</a>
		<hr>
		<h2>Order Details</h2>
		<table class="table table-bordered text-center tablesaw" id="order_details">
			<thead>
				<tr>
					<th>Supplier ID</th>
					<th>Stock Item</th>
					<th>Purchase Quantity</th>
					<th>Purchase Price</th>
					<th>Selling Price</th>
					<th>Purchase Total Amount</th>
				</tr>
			</thead>
			<tbody >
			
				<?php foreach ($purchase_detail as $asd): ?>
				
				
				<tr id="cavin">
					<td>
						<select class="form-control selectpicker"  data-live-search="true" name="supplier_id[]">
						
							
							<option value="">Select</option>
							
						
						<?php foreach ($supplier_info as $id): ?>
							<?php 
							if(($id->supplier_id) == ($asd->supplier_id)){
								echo "<option selected='selected' data-subtext='".$id->supplier_id."' value='".$id->supplier_id."'>".$id->supplier_name."</option>";
							}
							else{
								echo "<option data-subtext='".$id->supplier_id."' value='".$id->supplier_id."'>".$id->supplier_name."</option>";
							}
						    ?>
						<?php endforeach ?>
						</select>
					
					</td>
					<td>
					  <select class="form-control selectpicker"  data-live-search="true" name="product_id[]">
					  	<option value="">Select</option>
					  <?php foreach ($product_info as $prod_name): ?>
					  	<?php 
					  	if(($prod_name->product_id) == ($asd->product_id)){
					  		echo "<option selected='selected' data-subtext='".$prod_name->product_id."' value='".$prod_name->product_id."'>".$prod_name->product_name."</option>";
					  	}
					  	else{
					  		echo  "<option data-subtext='".$prod_name->product_id."' value='".$prod_name->product_id."'>".$prod_name->product_name."</option>";
					  	}
					    ?>
					  <?php endforeach ?>
					  </select>
					</td>
					<td>
						<input class="form-control purchaseqty" value="<?php echo $asd->qty_IN ?>" type="number"  name="purchaseqty[]" required>
						
					</td>
					<input type="hidden" name="uniqID[]" value="<?php echo $asd->uniqID?>">
					<td><input class="form-control purchaseprice" value="<?php echo $asd->purchase_price ?>" type="number"  name="purchaseprice[]" required></td>
					<td><input class="form-control selling-price" value="<?php echo $asd->selling_price ?>" type="text" name="selling-price[]"  required></td>
					
					<td><input type="text" class="form-control totalsum" value="<?php echo $asd->total_amount ?>" name="totalsum[]"></td>
					
				</tr>
				<?php endforeach ?>

			</tbody>

		</table>
		<br><br>
		</div>
		</form>
		<br>
		<p class="pull-left" style="color:red;font-size: 12px;"><i><b>Notice: Cannot add Order detail on Edit. Please <a href="<?php echo base_url();?>purchase/add">Add Purchase</a> to order new.</i></b></p>
		
		<br><br>

</div>

<script src="<?php echo base_url().'assets/js/form-limits.js'?>"></script>
<?php $this->load->view('footer') ?>