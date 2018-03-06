$(function() {
    $(window).bind("load resize", function() {
        if ($(this).width() < 768) {
            $('.navbar-default').addClass('navbar-fixed-top')
        } else {
            $('.navbar-default').removeClass('navbar-fixed-top')
        }
    })
})

// CAROUSEL
$('#myCarousel').carousel({ interval: 3000 })
// MODAL BACKDROP
$('.modal').appendTo("body")