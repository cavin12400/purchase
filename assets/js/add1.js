var rowCount = $('#order_details tr').length;


var arr = [];
for (var i = 0; i <= rowCount; i++) {
	arr[i] = i;
}

jQuery.each(arr,function(i,val){
	$(document).on("mouseover", "body", function() {
	    var sum = 0;
	    var qty = $("#purchaseqty"+i).val();
	    for (var h = 1; h <= qty; h++) {
	    	$("#purchaseprice"+i).each(function(){
		        sum += +$(this).val();
		    });
	    }
    	
	    $("#total"+val).val(sum);
	    
	});

});


jQuery.each(arr,function(j,val){
	$(document).on("mouseover", "body", function() {
	    var sum = 0;
	    for (var i = 1; i <= rowCount-1; i++) {
	    	var totall = $("#total"+i).val()
	    	sum = sum+(parseInt(totall));
	    }
	    $(".total-amount").val(sum);

	});
});

$(document).on("mouseover", "body", function() {
    	var num = $(".total-payment").val();
    	var num2 = $(".total-amount").val();
    	var totals=num2-num;
    $(".total-balance").val(totals);
});

$(document).on("mouseover", "body", function() {
    	var num = $(".paypayment").val();
    	var num2 = $(".paybalance").val();
    	var totals=num2-num;
    $(".sub-total").val(totals);
});


$(document).ready(function(){
    $(".extend").click(function(){
    	$('.extend').attr('disabled',true);
    	rowCount++;
        $.ajax({
            url : "extension",
            type: "POST",
            success: function(data, textStatus, jqXHR) {
                //$("#cavin").append(data);
                $(data).insertBefore("#cavin");
                //$("#cavin").insertAfter(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                console.log('OOPS! Something went wrong');
            }
        });
   });
});



$(document).ready(function(){
	$("form").change(function(){
		var i=0;
		$('.purchaseqty').each(function(){
		    i++;
		    var newID='purchaseqty'+i;
		    $(this).attr('id',newID);

		});
		var i=0;
		$('.purchaseprice').each(function(){
		    i++;
		    var newID='purchaseprice'+i;
		    $(this).attr('id',newID);
		});
		var i=0;
		$('.totalsum').each(function(){
		    i++;
		    var newID='total'+i;
		    $(this).attr('id',newID);

		});
		var i=0;
		$('.selling-price').each(function(){
		    i++;
		    var newID='price'+i;
		    $(this).attr('id',newID);

		});

    });
});
$(document).ready(function(){
	$("body").load(function(){
		var i=0;
		$('.purchaseqty').each(function(){
		    i++;
		    var newID='purchaseqty'+i;
		    $(this).attr('id',newID);

		});
		var i=0;
		$('.purchaseprice').each(function(){
		    i++;
		    var newID='purchaseprice'+i;
		    $(this).attr('id',newID);
		});
		var i=0;
		$('.totalsum').each(function(){
		    i++;
		    var newID='total'+i;
		    $(this).attr('id',newID);

		});
		var i=0;
		$('.selling-price').each(function(){
		    i++;
		    var newID='price'+i;
		    $(this).attr('id',newID);

		});

    });
});


$(document).ready(function(){

    $('.extend').attr('disabled',true);
	$("form").change(function(){
		for (var i = 0; i <= rowCount; i++){
			$('#price'+i).keyup(function(){
	        if($(this).val().length !=0)
	            $('.extend').attr('disabled', false);            
	        else
	            $('.extend').attr('disabled',true);
	    	})
		}
	    
	})
});

$(document).ready(function(){
	$('#checkBoxAll').click(function(){
		if($(this).is(":checked"))
			$('.chkbox').prop('checked',true);
		else
			$('.chkbox').prop('checked',false);
	});
});



