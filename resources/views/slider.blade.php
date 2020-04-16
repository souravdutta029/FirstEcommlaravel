<section id="slider"><!--slider-->
<div class="container"> <!--container-->
    <div class="row">    <!--row-->
        <div class="col-sm-12">    <!--col-sm-12-->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <?php 
                    $get_slider = DB::table('slider')
                                ->where('publication_status', 1)
                                ->get();
                ?>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ( $get_slider as $slider)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    @foreach ( $get_slider as $slider)
                    <div class="item {{ $loop->first ? 'active' : '' }}">
                        <div class="col-sm-6">
                            <h1><span>E-SHOPPER</span></h1>
                            <h2>Free E-Commerce Template</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ URL::to($slider->slider_image) }}" class="girl img-responsive" alt="" />
                            <!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>
    </div>  <!--row-->
</div>  <!--container-->
</section><!--/slider-->