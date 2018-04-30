<?php
/**
 * product_list.php
 * 
 * content for the product list page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
?>

<main class="page product-page">
    <section class="clean-block clean-product dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">Product Page</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
            </div>
            <div class="block-content">
                <div class="product-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery" style="height:385px;background-color:rgb(255,255,255);"><img src="assets/img/soup1.jpg" width="100px" height="350px" style="width:350px;margin-left:10px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <h3>Lorem Ipsum</h3>
                                <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                <div class="price">
                                    <h3>$300.00</h3>
                                </div><button class="btn btn-primary" type="button" style="background-color:#608e3a;"><i class="icon-basket"></i>Add to Cart</button>
                                <div class="summary">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc, pretium at augue at, convallis pellentesque ipsum. Vestibulum diam risus, sagittis at fringilla at, pulvinar vel risus. Vestibulum dignissim
                                        eu nulla eu imperdiet. Morbi mollis tellus a nunc vestibulum consequat. Quisque tristique elit et nibh dapibus sodales. Nam sollicitudin a urna sed iaculis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-info">
                    <div>
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#description" id="description-tab">Description</a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#specifications" id="specifications-tabs" style="color:#608e3a;">Specifications</a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#reviews" id="reviews-tab" style="color:#608e3a;">Reviews</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active fade show description" role="tabpanel" id="description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="tab-pane fade show specifications" role="tabpanel" id="specifications">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="stat">Display</td>
                                                <td>5.2"</td>
                                            </tr>
                                            <tr>
                                                <td class="stat">Camera</td>
                                                <td>12MP</td>
                                            </tr>
                                            <tr>
                                                <td class="stat">RAM</td>
                                                <td>4GB</td>
                                            </tr>
                                            <tr>
                                                <td class="stat">OS</td>
                                                <td>iOS</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" role="tabpanel" id="reviews">
                                <div class="reviews">
                                    <div class="review-item">
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4>Incredible product</h4><span class="text-muted"><a href="#">John Smith</a>, 20 Jan 2018</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc, pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                                <div class="reviews">
                                    <div class="review-item">
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4>Incredible product</h4><span class="text-muted"><a href="#">John Smith</a>, 20 Jan 2018</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc, pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                                <div class="reviews">
                                    <div class="review-item">
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4>Incredible product</h4><span class="text-muted"><a href="#">John Smith</a>, 20 Jan 2018</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc, pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clean-related-items">
                    <h3 style="color:#608e3a;">Related Products</h3>
                    <div class="items">
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/soup2.jpg" width="150px" height="150px" style="color:#608e3a;"></a></div>
                                    <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4 style="color:#608e3a;">$300</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/soup3.jpg" width="150px" height="150px"></a></div>
                                    <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4 style="color:#608e3a;">$300</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/soup4.jpg" width="150px" height="150px"></a></div>
                                    <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4 style="color:#608e3a;">$300</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
