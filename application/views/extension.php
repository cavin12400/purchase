
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
<script>
	$('.selectpicker').selectpicker();
</script>