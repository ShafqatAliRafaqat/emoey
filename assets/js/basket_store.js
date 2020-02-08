var Basketsstore;

$( document ).ready(function() {
$('#goingtocheckout').click(function()
	{
		localStorage.setItem("iscustomize",false);
		localStorage.setItem("basketStoreid",$('#hotdealsid').val());
		localStorage.setItem('message',$('#greetings').val());
	});


$(".basketstore").click(function() {
			    $('html,body').animate({
			        scrollTop: $("#details").offset().top-40},
			        'slow');
					});
$(".our-partners").click(function() {
			    $('html,body').animate({
			        scrollTop: $(document).height()},
			        'slow');
					});
$(".about-us").click(function() {
			    $('html,body').animate({
			        scrollTop: $("#aboutUs").offset().top-80},
			        'slow');
					});

});



