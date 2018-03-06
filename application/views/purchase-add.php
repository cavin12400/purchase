<?php $this->load->view('header') ?>
<?php $start=4;
	$startplus=0;
 ?>
<div class="container " align="center">
		<br>
		
		<form  id="addform" name="theform" method="post">
		<div class="container-fluid">
		  <div class="form-group"><br>
		    <label >Purchase ID:</label>
		    <?php foreach ($purchase_order as $cavin): ?>
		    	
		    
		    <input type="text"  value="<?php echo $cavin->cavins ?>" class="form-control form-small"  disabled>
		    <input type="hidden" name="purchase_id" value="<?php echo $cavin->cavins ?>" class="form-control form-small"  >
		  </div>
		  <?php endforeach ?>
		  <div class="form-group">
		    <label >Purchase Date:</label>
		    <input type="date" name="purdate" class="form-control form-small" required>
		    <input type="date" name="update" value="<?php echo date('Y-m-d');?>" hidden>
		  </div>
		  <div class="form-group">
		    <label >Notes:</label>
		    <input type="text" name="notes" class="form-control form-small">
		  </div>
		  <div class="form-group">
		    <label >Total Amount:</label>
		    <input type="text" name="tamount" class="form-control form-small total-amount" disabled>
		    <input type="hidden" name="tamount" id="tamount" class="form-control form-small total-amount" >
		  </div>
		  <div class="form-group">
		    <label >Total Payment:</label>
		    <input type="number" name="tpayment" id="tpayment" min="1" max="2" class="form-control form-small total-payment" required>
		  </div>
		  <div class="form-group">
		    <label >Total Balance:</label>
		    <input type="text" name="tbalance" class="form-control form-small total-balance" disabled>
		    <input type="hidden" name="tbalance" class="form-control form-small total-balance" >
		  </div><br>
		<button type="submit" class="btn btn-primary" name="addbtn"  onclick="getMaxValueForRequest();">Submit</button>
		<br>
		<hr>
		<h2>Order Details</h2>
		<button class="btn btn-default extend pull-left" name="extend" id="extend"><b>Add more</b></button><br><br>
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
				<tr id="cavin">
					<td>
						<select class="form-control selectpicker"  data-live-search="true" name="supplier_id[]">
							<option value="">Select</option>
						<?php foreach ($supplier_info as $id): ?>
							
						    <option data-subtext="<?php echo $id->supplier_id ?>" value="<?php echo $id->supplier_id ?>"><?php echo $id->supplier_name ?></option>
						<?php endforeach ?>
						</select>
					
					</td>
					<td>
					  <select class="form-control selectpicker"  data-live-search="true" name="product_id[]">
					  	<option value="">Select</option>
					  <?php foreach ($product_info as $prod_name): ?>
					  	
					    <option data-subtext="<?php echo $prod_name->product_id ?>" value="<?php echo $prod_name->product_id ?>"><?php echo $prod_name->product_name ?></option>
					  <?php endforeach ?>
					  </select>
					</td>
					<input type="hidden" name="uniqID[]" value="<?php echo uniqid("uniq");?>">
					<td><input class="form-control purchaseqty"  type="number"  name="purchaseqty[]" required></td>

					<td><input class="form-control purchaseprice"  type="number"  name="purchaseprice[]" required></td>
					<td><input class="form-control selling-price" type="text" name="selling-price[]"  required></td>
					
					<td><input type="text" class="form-control totalsum" name="totalsum[]"></td>
					
				</tr>
				
				
			</tbody>

		</table>
		<br>
		</div>
		</form>
		

		<br>
		
		
		<br><br>

</div>

<script src="<?php echo base_url().'assets/js/form-limits.js'?>"></script>
<?php $this->load->view('footer') ?>