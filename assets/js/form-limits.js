function getMaxValueForRequest() {
  var requester = document.getElementById("tpayment");
  var currentItemAmount = parseInt(document.getElementById("tamount").value);
  requester.setAttribute('max', currentItemAmount);
}

getMaxValueForRequest()

document.getElementById("tpayment").addEventListener('click', function(event) {
  getMaxValueForRequest()
})


