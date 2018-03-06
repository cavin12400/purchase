var start = moment().subtract(29, 'days');
var end = moment();
function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#config-demo').daterangepicker({
	//startDate: start,
    //endDate: end,
    ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
	autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  var starting=start.format('YYYY-MM-DD');
  var ending=end.format('YYYY-MM-DD');
  passDate(starting,ending);
});
$('input[id="config-demo"]').on('apply.daterangepicker', function(ev, picker) {
  $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
});
$('input[id="config-demo"]').on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
});
function passDate(starting, ending) {
  var base_url = "http://localhost/purchase/"
	$.ajax({
		
		url: base_url+"purchase/filter", 
		type: 'get',
		dataType: "json",
		data: {"starter": starting, "ender": ending},
		success: function(){
			window.location.href = base_url+'purchase/filter?starter='+starting+"&ender="+ending;
		},
		error: function(){
			window.location.href = base_url+'purchase/filter?starter='+starting+"&ender="+ending;
		}
	});
}