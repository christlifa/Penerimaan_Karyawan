<?php
// check jika slider ada yg active
if($slider_data): 
$no = 1;
?>
   <!--slider section start-->
    <div class="slider-container">
        <!-- Slider Image -->
        <div id="mainSlider" class="nivoSlider slider-image">
        <?php foreach($slider_data as $slider_row): ?>
            <img src="<?php echo base_url('assets/images/slider/'.$slider_row->gambar);?>" alt="" title="#htmlcaption<?php echo $no; ?>"/>
        <?php 
            $no++;
        endforeach; 
        ?>
        </div>
    </div>
    <!--slider section end-->
<?php endif; ?>

<!--popular dises start-->
<div class="popular-dishes">
    <div class="bg-img-2 ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="section-title text-center grey_bg">
                        <h2>Our Popular Dishes</h2>
                        <p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="dises-list">

                            <div class="dises-show text-center">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="single-disesh">
                                        <div class="disesh-img">
                                            <a href="#"><img class="img img-responsive" src="<?php echo base_url('assets/images/paket/ramadhan1.png')?>" alt=""></a>
                                        </div>
                                        <div class="disesh-desc pt-50">
                                            <h3><a href="">Ramadhan</a></h3>                                                    
                                            <p>
                                                Nikmati paket ramadhan disini.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="single-disesh">
                                        <div class="disesh-img">
                                            <a href="#"><img class="img img-responsive" src="<?php echo base_url('assets/images/paket/makansiang.png')?>" alt=""></a>
                                        </div>
                                        <div class="disesh-desc pt-50">
                                            <h3><a href="">Makan Siang</a></h3>
                                            <p>
                                                Nikmati paket makan siang disini.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="single-disesh">
                                        <div class="disesh-img">
                                            <a href="#"><img class="img img-responsive" src="<?php echo base_url('assets/images/paket/makanmalam.png')?>" alt=""></a>
                                        </div>
                                        <div class="disesh-desc pt-50">
                                            <h3><a href="">Makan Malam</a></h3>
                                            <p>
                                                Nikmati paket makan malam disini.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>	
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--popular dises end-->