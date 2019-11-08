@extends("../layout.plantilla_footer")

@if(Auth::user()->hasRole('Admin'))

<!DOCTYPE html>
<html lang="en">
@include('layout.plantilla_css')

<body>
    @include('layout.plantilla_header')

    @include('layout.plantilla_nav')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div>
                        <div class="shop-img">
                            <img src="/images/muestra/NBA.png" alt="" width="350">
                        </div>
                    </div>
                </div> 
                &nbsp;
                <div class="col-md-4 col-xs-6">
                    <div>
                        <div class="shop-img">
                            <img src="/images/muestra/PO.png" alt="" width="350">
                        </div>
                    </div>
                </div>
                &nbsp;
                <div class="col-md-4 col-xs-6">
                    <div>
                        <div class="shop-img">
                            <img src="/images/muestra/Portland Banner.png" alt="" width="200">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    @include('layout.plantilla_script')

</body>
</html>

@else

<!DOCTYPE html>
<html lang="en">
@include('layout.plantilla_css')

<body>
    @include('layout.plantilla_header')
    
    @include('layout.plantilla_nav')

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                @include('flash::message')
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="/images/muestra/1553531509Los Ángeles Lakers.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Confección<br>Colección</h3>
                            <a href="/ocultoConfeccion" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="/images/muestra/Boston Celtics 1969.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Accesorios<br>Colección</h3>
                            <a href="/ocultoAccesorios" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="/images/muestra/XXXII.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Calzado<br>Colección</h3>
                            <a href="/ocultoCalzado" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Algunos Productos <h6>(Muestrario)</h6></h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Brooklyn Nets.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Confección</p>
                                            <h3 class="product-name"><a href="/productosC/5">Brooklyn Nets Swigman Jersey</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">72.73 €</h4>
                                            @else
                                            <h4 class="product-price">88.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Philadelphia Sixers 1983.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Accesorios</p>
                                            <h3 class="product-name"><a href="/productosC/4">Philadelphia Sixers Championship Ring 1983</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">16.53 €</h4>
                                            @else
                                            <h4 class="product-price">20.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Indiana Pacers Ball.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Souvenirs</p>
                                            <h3 class="product-name"><a href="/productosC/36">Indiana Pacers Ball</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">24.79 €</h4>
                                            @else
                                            <h4 class="product-price">30.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Toronto Raptors.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Confección</p>
                                            <h3 class="product-name"><a href="/productosC/22">Toronto Raptors Sweatshirt Hoodie</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">57.85 €</h4>
                                            @else
                                            <h4 class="product-price">70.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Indiana Pacers Cover.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Souvenirs</p>
                                            <h3 class="product-name"><a href="/productosC/19">Indiana Pacer Soft Phone Case</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">16.53 €</h4>
                                            @else
                                            <h4 class="product-price">20.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    @include('layout.plantilla_top')

    @include('layout.plantilla_script')

</body>
</html>

@endif