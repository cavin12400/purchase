function validate() {
  if (document.getElementById('password1').value !== document.getElementById('password2').value){
    document.getElementById('password2').style.cssText = 'border: 1px solid red';
  }
  else{
    isValid = (document.getElementById('password1').value === document.getElementById('password2').value);
    document.getElementById('signupbtn').disabled = !isValid;
    document.getElementById('password2').style.cssText = 'border: 1px solid #a0b3b0';
  }
}

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(500);
  
});