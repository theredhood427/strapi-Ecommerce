<?php

include "vendor/autoload.php";


use GuzzleHttp\Client;

function getItem() {
    $token = '33aeacb78a7aa3600f8b0d22aa60187a58828cbec0f0b1ebe9aea1c26ef2b42d9f208d92363099841f79598519e00e91dfc3e02663c9135fd1228a58ee04b4e82f58b328630b9797b322739114eda6d97592e093adddaa54f7f8b7175af75d18106e1a87ce342d948b216f327c604424c2f4cfb7a5dfae8ba20895bd3704c39a';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'home', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}

$item = getItem();
$data = $item->data;

$header_logo = $data->attributes->headerLogo;
$hero_title = $data->attributes->heroSection->title;
$hero_description = $data->attributes->heroSection->description;
$hero_button_text = $data->attributes->heroSection->buttonText;
$footer_logo = $data->attributes->footerLogo;
$footer_slogan = $data->attributes->footerSlogan;

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.html"><img src="<?= $header_logo ?>" alt="logo" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="account.html">Account</a></li>
                    </ul>
                </nav>
                <a href="cart.html"><img src="images/cart.png" width="30px" height="30px"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1><?= $hero_title ?></h1>
                    <p><?= $hero_description?></p>
                    <a href="" class="btn"><?= $hero_button_text ?> &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Feadtued Categories -->

    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="images/category-1.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-2.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-3.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->

    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
        <?php foreach($data->attributes->featuredProducts as $featured_products): ?>
            <div class="col-4">
            <a href="product_details.html"><img src="<?= $featured_products->image ?>"></a>
            <h4><?= $featured_products->name ?></h4>
            <div class="rating">
                    <?php for($x=0; $x < $featured_products->stars; $x++){
                    ?>    
                    <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($x=0; $x < (5 - $featured_products->stars); $x++){
                    ?>    
                    <i class="fa fa-star-o"></i>
                    <?php } ?>
                </div>
                <p><?= $featured_products->price ?></p>
            </div>
            <?php endforeach; ?>
        </div>


        <h2 class="title">Latest Products</h2>
        <div class="row">
        <?php foreach($data->attributes->latestProducts as $latest_products): ?>
            <div class="col-4">
                <a href="product_details.html"><img src="<?= $latest_products->image ?>"></a>
                <h4><?= $latest_products->name ?></h4>
                <div class="rating">
                    <?php for($x=0; $x < $latest_products->stars; $x++){
                    ?>    
                    <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($x=0; $x < (5 - $latest_products->stars); $x++){
                    ?>    
                    <i class="fa fa-star-o"></i>    
                    <?php } ?>
                </div>
                <p><?= $latest_products->price ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Offer -->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="images/exclusive.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusively Available on RedStore</p>
                    <h1>Smart Band 4</h1>
                    <small>The Mi Smart Band 4 fearures a 39.9%larger (than Mi Band 3) AMOLED color full-touch display
                        with adjustable brightness, so everything is clear as can be.<br></small>
                    <a href="products.html" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
            <?php foreach($data->attributes->testimonials as $testimonials): ?>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p><?= $testimonials->testimonial ?></p>
                    <div class="rating">
                        <?php for($x=0; $x < $testimonials->stars; $x++){
                        ?>    
                        <i class="fa fa-star"></i>
                        <?php } ?>
                        <?php for($x=0; $x < (5 - $testimonials->stars); $x++){
                        ?>    
                        <i class="fa fa-star-o"></i>    
                        <?php } ?>
                    </div>
                    <img src="<?= $testimonials->picture?>">
                    <h3><?= $testimonials->name?></h3>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/logo-godrej.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-oppo.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-coca-cola.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-paypal.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-philips.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/play-store.png">
                        <img src="images/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                <img src="<?= $footer_logo?>">
                    <p><?= $footer_slogan?>
                    </p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2020 - Samwit Adhikary</p>
        </div>
    </div>

    <!-- javascript -->

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            }
            else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>

</body>

</html>