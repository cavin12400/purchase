function getMaxValueForRequest() {
  var requester = document.getElementById("paypayment");
  var currentItemAmount = parseInt(document.getElementById("paybalance").value);
  requester.setAttribute('max', currentItemAmount);
}

getMaxValueForRequest()

document.getElementById("paypayment").addEventListener('click', function(event) {
  getMaxValueForRequest()
})


