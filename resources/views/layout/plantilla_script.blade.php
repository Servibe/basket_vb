<!-- jQuery Plugins -->
<script src="../../../assets/js/jquery.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>
<script src="../../../assets/js/slick.min.js"></script>
<script src="../../../assets/js/nouislider.min.js"></script>
<script src="../../../assets/js/jquery.zoom.min.js"></script>
<script src="../../../assets/js/main.js"></script>

<script type="text/javascript">
$(document).ready(function(){   
	setTimeout(function () {
		$("#cookieConsent").fadeIn(200);
	}, 4000);
	$("#closeCookieConsent, .cookieConsentOK").click(function() {
		$("#cookieConsent").fadeOut(200);
	}); 
});
</script>

<script type="text/javascript">
$(document).ready(function(){

	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});

});
</script>

<script type="text/javascript">
$(".btn-update-item").on('click', function(e){
	e.preventDefault();

	var id = $(this).data('id');
	var href = $(this).data('href');
	var stock_actual = $("#producto_" + id).val();

	window.location.href = href + "/" + stock_actual;
});
</script>

<script>
$('div.alert').not('.alert-important').delay(5500).fadeOut(350);
</script>