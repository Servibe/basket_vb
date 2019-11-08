@extends("../layout.plantilla_footer")
@extends("../layout.plantilla_cookie")

<!DOCTYPE html>
<html>
@include('layout.plantilla_css')

<body>
    @include('layout.plantilla_header')

    @include('layout.plantilla_nav')

    <br>

    @if(now()->isThursday())
    <center>
        <h2>¡¡DÍA SIN IVA!!</h2>
        <h6>0% de IVA en todos nuestros productos.</h6>
    </center>
    @endif

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>
            <!-- row -->
            <div class="row">
                @include('flash::message')
                @isset($productos)
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Productos Rebajados</h3>
                        <hr>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @forelse($productos as $producto)
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/{{ $producto->foto }}" alt="">
                                            <div class="product-label">
                                                <span class="sale">- {{ number_format($producto->rebajado, 0) }}%</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $producto->proveedor }}</p>
                                            <h3 class="product-name"><a href="{{ route('productosC.show', $producto->id) }}">{{ $producto->nombre }}</a></h3>
                                            <h4 class="product-price">{{ number_format($producto->pvp + ($producto->pvp * ($producto->iva/100)), 2) }} € <del class="product-old-price">{{ number_format(($producto->pvp/(1 - ($producto->rebajado/100))) + (($producto->pvp/(1 - ($producto->rebajado/100))) * ($producto->iva/100)), 2) }} €</del></h4>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                    @empty
                                    <center>
                                        <h2>¡¡REBAJAS PRÓXIMAMENTE!!</h2>
                                    </center>
                                    @endforelse
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div><br><hr>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                @endisset

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Algunos Productos</h3><hr>
                        <h4>Confección 1</h4>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Brooklyn Nets.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/5">Brooklyn Nets Swingman Jersey</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">72.73 €</h4>
                                            @else
                                            <h4 class="product-price">88.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Boston Celtics Away.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/18">Boston Celtics Away Swingman Jersey</a></h3>
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
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Houston Rockets Away.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/9">Houston Rockets Away Swingman Jersey</a></h3>
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
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Philadelphia Sixers Away.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/12">Philadelphia Sixers Away Swingman Jersey</a></h3>
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
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Golden State Warriors Away.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/15">Golden State Warriors Away Swingman Jersey</a></h3>
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
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div><br><hr>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->

                <div class="col-md-12">
                    <div class="section-title">
                        <h4>Confección 2</h4>
                    </div>
                </div>

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-3">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Toronto Raptors.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Sudadera</p>
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
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Chicago Bulls.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Pantalón</p>
                                            <h3 class="product-name"><a href="/productosC/30">Chicago Bulls Icon Swingman Sweatpants</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">61.98 €</h4>
                                            @else
                                            <h4 class="product-price">75.00 €</h4>
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
                                            <img src="/images/muestra/Milwaukee Bucks.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">T-shirt</p>
                                            <h3 class="product-name"><a href="/productosC/23">Milwaukee Bucks Stock Team T-shirt</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">30.90 €</h4>
                                            @else
                                            <h4 class="product-price">37.50 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/New York Knicks 2.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/24">New York Knicks City Edition Swingman Jersey</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">78.51 €</h4>
                                            @else
                                            <h4 class="product-price">95.00 €</h4>
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
                                            <img src="/images/muestra/Kings.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camiseta</p>
                                            <h3 class="product-name"><a href="/productosC/34">Sacramento Kings Hardwood Classics Edition Swingman Jersey</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">99.17 €</h4>
                                            @else
                                            <h4 class="product-price">120.00 €</h4>
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
                                <div id="slick-nav-3" class="products-slick-nav"></div><br><hr>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->

                <div class="col-md-12">
                    <div class="section-title">
                        <h4>Accesorios</h4>
                    </div>
                </div>

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab3" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-4">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Philadelphia Sixers 1983.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Anillo</p>
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
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Phoenix Suns2.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Calcetines</p>
                                            <h3 class="product-name"><a href="/productosC/8">Phoenix Suns Stance Arena Collection - Jersey Crew Sock</a></h3>
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
                                            <img src="/images/muestra/Cinta Negra.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Cinta</p>
                                            <h3 class="product-name"><a href="/productosC/7">Black Headband of Match Player NBA</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">16.53 €</h4>
                                            @else
                                            <h4 class="product-price">20.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Calentador Nike brazo.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Calentador</p>
                                            <h3 class="product-name"><a href="/productosC/6">Nike Arm Warmer for matches</a></h3>
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
                                </div>
                                <div id="slick-nav-4" class="products-slick-nav"></div><br><hr>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->

                <div class="col-md-12">
                    <div class="section-title">
                        <h4>Souvenirs</h4>
                    </div>
                </div>

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab4" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-5">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Brooklyn Nets Bag.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Bolsa</p>
                                            <h3 class="product-name"><a href="/productosC/17">Brooklyn Nets Basketball Gym Bag</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">20.66 €</h4>
                                            @else
                                            <h4 class="product-price">25.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/New York Knicks Cap.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Gorra</p>
                                            <h3 class="product-name"><a href="/productosC/10">New York Knicks New Era 59FIFTY Fitted Cap</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">33.06 €</h4>
                                            @else
                                            <h4 class="product-price">40.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Los Ángeles Lakers Ball.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Balón</p>
                                            <h3 class="product-name"><a href="/productosC/21">Spalding NBA Los Ángeles Lakers Basketball</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">24.79 €</h4>
                                            @else
                                            <h4 class="product-price">30.00 €</h4>
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
                                            <p class="product-category">Funda</p>
                                            <h3 class="product-name"><a href="/productosC/19">Indiana Pacers Soft Phone Case</a></h3>
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
                                            <img src="/images/muestra/Memphis Grizzlies Cup.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Taza</p>
                                            <h3 class="product-name"><a href="/productosC/20">Memphis Grizzlies 11oz Team Logo Mug</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">6.61 €</h4>
                                            @else
                                            <h4 class="product-price">8.00 €</h4>
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
                                </div>
                                <div id="slick-nav-5" class="products-slick-nav"></div><br><hr>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->

                <div class="col-md-12">
                    <div class="section-title">
                        <h4>Calzado</h4>
                    </div>
                </div>

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab5" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-6">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/images/muestra/Kobe AD NXT.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Nike</p>
                                            <h3 class="product-name"><a href="/productosC/13">Nike Kobe AD NXT Basketball Shoe</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">175.56 €</h4>
                                            @else
                                            <h4 class="product-price">212.43 €</h4>
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
                                            <img src="/images/muestra/Zoom KD10.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Nike</p>
                                            <h3 class="product-name"><a href="/productosC/11">Nike Zoom KD10 Basketball Shoe</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">123.97 €</h4>
                                            @else
                                            <h4 class="product-price">150.00 €</h4>
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
                                            <img src="/images/muestra/Ultra Fly.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Jordan</p>
                                            <h3 class="product-name"><a href="/productosC/16">Jordan Ultra Fly Low Basketball Shoe</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">99.17 €</h4>
                                            @else
                                            <h4 class="product-price">120.00 €</h4>
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
                                            <img src="/images/muestra/Drive 4.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Under Armour</p>
                                            <h3 class="product-name"><a href="/productosC/14">Under Armour Drive 4 Basketball Shoe</a></h3>
                                            @if(now()->isThursday())
                                            <h4 class="product-price">111.57 €</h4>
                                            @else
                                            <h4 class="product-price">135.00 €</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-6" class="products-slick-nav"></div><br><hr>
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

    <center>
        <div id="cookieConsent">
            <div id="closeCookieConsent">x</div>
            Este sitio web usa cookies. Si continua en ella o sigue hacia delante, se entenderá que acepta dicha política. <a href="cookies" target="_blank">Más info</a>. <a class="cookieConsentOK">OK</a>
        </div>
    </center>

    @include('layout.plantilla_script')

    <script>
    var url = document.URL;
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, url);
    });
    </script>
</body>
</html>