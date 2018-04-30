<?php
/**
 * payment.php
 * 
 * content for the payment page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
?>

<main class="page payment-page">
    <section class="clean-block payment-form dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">Payment</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
            </div>
            <form style="border-top:0px solid #608e3a;">
                <div class="products" style="background-color:rgba(184,156,132,0.16);border-top:2px solid #608e3a;">
                    <h3 class="title">Checkout</h3>
                    <div class="item"><span class="price">$200</span>
                        <p class="item-name">Product 1</p>
                        <p class="item-description">Lorem ipsum dolor sit amet</p>
                    </div>
                    <div class="item"><span class="price">$120</span>
                        <p class="item-name">Product 2</p>
                        <p class="item-description">Lorem ipsum dolor sit amet</p>
                    </div>
                    <div class="total"><span>Total</span><span class="price">$320</span></div>
                </div>
                <div class="card-details">
                    <h3 class="title">Credit Card Details</h3>
                    <div class="form-row">
                        <div class="col-sm-7">
                            <div class="form-group"><label for="card-holder">Card Holder</label><input class="form-control" type="text" placeholder="Card Holder"></div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group"><label>Expiration date</label>
                                <div class="input-group expiration-date"><input class="form-control" type="text" placeholder="MM"><input class="form-control" type="text" placeholder="YY"></div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group"><label for="card-number">Card Number</label><input class="form-control" type="text" placeholder="Card Number" id="card-number"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="cvc">CVC</label><input class="form-control" type="text" placeholder="CVC" id="cvc"></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group"><button class="btn btn-primary btn-block" type="button" style="background-color:#608e3a; border-color:#608e3a;">Proceed</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>