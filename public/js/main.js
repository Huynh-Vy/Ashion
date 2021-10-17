$('#pay1').click(function() {
    $('.content-pay-two').addClass("d-none");
    $('.content-pay-one').removeClass("d-none");
});

$('#pay2').click(function() {
    $('.content-pay-one').addClass("d-none");
    $('.content-pay-two').removeClass("d-none");
});