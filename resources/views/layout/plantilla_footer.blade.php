<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Contenido</h3>
                        <p>Basket Vb, la tienda relacionada con el baloncesto que está a tu alcance.</p>
                        <p>En esta tienda podrás encontrar todo tipo de productos relacionados con el mundo del baloncesto sin tener que ir de una página a otra buscándolos.</p>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Información</h3>
                        <ul class="footer-links">
                            <li><a href="/nosotros">Sobre nosotros</a></li>
                            <li><a href="/contact-us">Contactar</a></li>
                            @if(Auth::check())
                            @if(Auth::user()->hasRole('Admin'))
                            <li style="display:none"><a href="/comentarios">Comentarios</a></li>
                            @else
                            <li><a href="/comentarios">Comentarios</a></li>
                            @endif
                            @else
                            <li><a href="/comentarios">Comentarios</a></li>
                            @endif
                            <li><a href="/privacidad">Política de privacidad</a></li>
                            <li><a href="/terminos">Términos y condiciones</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Datos</h3>
                        <ul class="footer-links">
                            <li><i class="fa fa-map-marker"></i>Badajoz, España</li>
                            <li><i class="fa fa-phone"></i>+34 669 95 93 17</li>
                            @if((Auth::check()) == 0)
                            <li><a href="contact-us"><i class="fa fa-envelope-o"></i>svitalb04@gmail.com</a></li>
                            @elseif(Auth::user()->hasRole('user'))
                            <li><a href="contact-us"><i class="fa fa-envelope-o"></i>svitalb04@gmail.com</a></li>
                            @elseif(Auth::user()->hasRole('Admin'))
                            <li style="display:none"><a href="contact-us"><i class="fa fa-envelope-o"></i>svitalb04@gmail.com</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Siguenos</h3>
                        <ul class="footer-links">
                            <li><a href="https://www.instagram.com/basket_vb/?hl=es"><i class="fa fa-instagram"></i>Instagram</a></li>
                            <li><a href="https://twitter.com/basket_vb1"><i class="fa fa-twitter"></i>Twitter</a></li>
                            <li><a href="https://www.facebook.com/basketVB"><i class="fa fa-facebook"></i>Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="https://www.paypal.com/es/home"><i class="fa fa-cc-paypal"></i></a></li>
                    </ul>
                    <span class="copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados <i class="fa fa-heart-o" aria-hidden="true"></i> para <a href="https://basket.test" target="_blank">Design</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
        <!-- /FOOTER -->