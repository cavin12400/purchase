<?php $this->load->view('header') ?>

<div class="col-md-4">
	<h2>Payment</h2>
	<form action="" method="post">
		<table class="table text-center table-responsive table-bordered" id="addform">
		<tbody>
			<tr>
				<th>Purchase ID:</th>
				<td>
					<?php echo $details->purchase_id; ?>
					<input type="hidden" name="purchase_id" value="<?php echo $details->purchase_id; ?>">
				</td>
			</tr>
			<tr>
				<th>Balance:</th>
				<td >
					<?php echo $details->total_balance; ?>
					<input type="hidden"  id="paybalance" class="form-control paybalance" value="<?php echo $details->total_balance; ?>">
				</td>
			</tr>
			<tr>
				<th>Pay:</th>
				<td>
					<input type="number" class="form-control paypayment" id="paypayment" placeholder="amount to pay">
				</td>
			</tr>
			<tr>
				<th>Sub-total:</th>
				<td>
					<input type="text" disabled class="form-control sub-total"  id="sub-total">
					<input type="hidden"  class="form-control sub-total" name="total_balance"  id="sub-total">
				</td>
			</tr>
		
			
		
		</tbody>
		</table>
		<button id="menubutton" class="btn btn-success pull-left" name="pay" onclick="getMaxValueForRequest();">Confirm Payment</button>
		<a href="<?php echo base_url().'purchase/start';?>" id="menubutton" class="btn btn-info pull-left unpaid">Go back</a>
	</form>
</div>
<script src="<?php echo base_url().'assets/js/form-limits-payment.js'?>"></script>
<?php $this->load->view('footer') ?>

