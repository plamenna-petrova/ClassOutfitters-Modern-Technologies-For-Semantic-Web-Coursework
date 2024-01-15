<?php
if (file_exists('./xml/class-outfitters.xml')) {
    $shopNode = simplexml_load_file('./xml/class-outfitters.xml');
    $productNumber = $_GET['productNumber'];
    $productCategory = $_GET['productCategory'];
    $productByXPathQuery = $shopNode->xpath("collection/product[@number='$productNumber']")[0];
    $productCollectionName = $productByXPathQuery->xpath("parent::*")[0]->attributes()->name;
    $productName = $productByXPathQuery->name;
    $productBrand = $productByXPathQuery->brand;
    $productPrice = $productByXPathQuery->price;
    $productImages = $productByXPathQuery->images;
    $productAvailableSizes = $productByXPathQuery->availableSizes;
    $productDesignAndExtras = $productByXPathQuery->details->designAndExtras;
    $productFit = $productByXPathQuery->details->fit;
    $productMaterialAndCareInstructions = $productByXPathQuery->details->materialAndCareInstructions;
    $shippingAndReturnsPolicy = $shopNode->shippingAndReturnsPolicy;
    $relatedProducts = $shopNode->xpath("collection/product[@category='$productCategory' and @number!='$productNumber']");
    shuffle($relatedProducts);
    $relatedProducts = array_slice($relatedProducts, 0, 4);
} else {
    exit('Failed to open class-outfitters.xml');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Outfitters</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">FAQs</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#">FAQs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li>
                                <a href="#">Shop</a>
                                <ul class="dropdown">
                                    <li><a href="./fallWinterClothingCollection.php">Clothing</a></li>
                                    <li><a href="./shoesWinterCollection.php">Shoes</a></li>
                                    <li><a href="./accessoriesFallCollection.php">Accessories</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./contact.php">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="./shoppingCart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.php">Home</a>
                            <?php
                                switch ($productCollectionName) {
                                    case 'Fall-Winter Clothing Collection 2023/2024':
                                        echo "<a href='./fallWinterClothingCollection.php'>".$productCollectionName."</a>";
                                        break;
                                    case 'Shoes Winter Collection 2023/2024':
                                        echo "<a href='./shoesWinterCollection.php'>".$productCollectionName."</a>";
                                        break;
                                    case 'Accessories Fall Collection 2023':
                                        echo "<a href='./accessoriesFallCollection.php'>".$productCollectionName."</a>";
                                        break;
                                }
                            ?>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                                if ($productImages->modelCenterImage) {
                                    echo "
                                        <li class='nav-item'>
                                            <a class='nav-link active' data-toggle='tab' href='#tabs-1' role='tab'>
                                                <div class='product__thumb__pic set-bg' data-setbg='$productImages->modelCenterImage'>
                                                </div>
                                            </a>
                                        </li>
                                    ";
                                }

                                if ($productImages->modelSideImage) {
                                    echo "
                                        <li class='nav-item'>
                                            <a class='nav-link' data-toggle='tab' href='#tabs-2' role='tab'>
                                                <div class='product__thumb__pic set-bg' data-setbg='$productImages->modelSideImage'>
                                                </div>
                                            </a>
                                        </li>   
                                    ";
                                }

                                if ($productImages->productFocusImage) {
                                    echo "
                                        <li class='nav-item'>
                                            <a class='nav-link' data-toggle='tab' href='#tabs-3' role='tab'>
                                                <div class='product__thumb__pic set-bg' data-setbg='$productImages->productFocusImage'>
                                                </div>
                                            </a>
                                        </li>
                                    ";
                                }

                                if ($productImages->productZoomImage) {
                                    echo "
                                        <li class='nav-item'>
                                            <a class='nav-link' data-toggle='tab' href='#tabs-4' role='tab'>
                                                <div class='product__thumb__pic set-bg' data-setbg='$productImages->productZoomImage'>
                                                </div>
                                            </a>
                                        </li>
                                    ";
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <?php
                                if ($productImages->modelCenterImage) {
                                    echo "
                                        <div class='tab-pane active' id='tabs-1' role='tabpanel'>
                                            <div class='product__details__pic__item'>
                                                <img src='$productImages->modelCenterImage' alt=''>
                                            </div>
                                        </div>
                                    ";
                                }

                                if ($productImages->modelSideImage) {
                                    echo "
                                        <div class='tab-pane' id='tabs-2' role='tabpanel'>
                                            <div class='product__details__pic__item'>
                                                <img src='$productImages->modelSideImage' alt=''>
                                            </div>
                                        </div>
                                    ";
                                }

                                if ($productImages->productFocusImage) {
                                    echo "
                                        <div class='tab-pane' id='tabs-3' role='tabpanel'>
                                            <div class='product__details__pic__item'>
                                                <img src='$productImages->productFocusImage' alt=''>
                                            </div>
                                        </div>
                                    ";
                                }

                                if ($productImages->productZoomImage) {
                                    echo "
                                        <div class='tab-pane' id='tabs-4' role='tabpanel'>
                                            <div class='product__details__pic__item'>
                                                <img src='$productImages->productZoomImage' alt=''>
                                            </div>
                                        </div>
                                    ";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <?php
                                echo "
                                    <h4>$productName</h4>
                                    <h4>By: ".$productBrand."</h4>
                                    <h3>$$productPrice</h3>
                                ";
                            ?>
                            <div class="product__details__cart__option">
                                <?php
                                    if ($productAvailableSizes) {
                                        echo "<div class='product__details__option__size'>";
                                        echo "<span>Size:</span>";

                                        foreach ($productAvailableSizes->size as $sizeNode) {
                                            $sizeNodeValue = (string) $sizeNode;

                                            echo "<label for='$sizeNodeValue'>$sizeNodeValue
                                                <input type='radio' id='$sizeNodeValue'>
                                                </label>";
                                        }

                                        echo "</div>";
                                    }
                                ?>
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <a href="#" class="primary-btn">add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Shipping And Returns</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="product__details__tab__content__item">
                                                    <h5>Design and Extras</h5>
                                                    <?php
                                                        echo "<ul>";

                                                        foreach ($productDesignAndExtras->feature as $featureNode) {
                                                            $featureNodeValue = (string) $featureNode;
                                                            echo "<li>$featureNodeValue</li>";
                                                        }

                                                        echo "</ul>";
                                                    ?>
                                                </div>
                                                <div class="product__details__tab__content__item">
                                                    <h5>Fit</h5>
                                                    <?php
                                                        echo "<ul>";
                                                            if ($productFit->sleeveLength->count()) {
                                                                echo "<li>$productFit->sleeveLength</li>";
                                                            }
                                                            if ($productFit->length->count()) {
                                                                echo "<li>$productFit->length</li>";
                                                            }
                                                            if ($productFit->styleFit->count()) {
                                                                echo "<li>$productFit->styleFit</li>";
                                                            }
                                                            if ($productFit->waistline->count() ) {
                                                                echo "<li>$productFit->waistline</li>";
                                                            }
                                                        echo "</ul>";
                                                    ?>        
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="product__details__tab__content__item">
                                                    <?php
                                                        if ($productMaterialAndCareInstructions) { 
                                                            echo "<h5>Materials Used</h5>";
                                                            
                                                            if ($productMaterialAndCareInstructions->material) {
                                                                echo "<h6>Material: $productMaterialAndCareInstructions->material</h6>";
                                                                echo "<br />";
                                                            }

                                                            if ($productMaterialAndCareInstructions->lining) {
                                                                echo "<h6>Lining: $productMaterialAndCareInstructions->lining</h6>";
                                                                echo "<br />";
                                                            }     

                                                            if ($productMaterialAndCareInstructions->countryOfOrigin) {
                                                                echo "<h6>Country Of Origin: $productMaterialAndCareInstructions->countryOfOrigin</h6>";
                                                                echo "<br />";
                                                            }

                                                            if ($productMaterialAndCareInstructions->outerMaterial) {
                                                                echo "<h6>Outer Material: $productMaterialAndCareInstructions->outerMaterial</h6>";
                                                                echo "<br />";
                                                            }

                                                            if ($productMaterialAndCareInstructions->innerMaterial) {
                                                                echo "<h6>Inner Material: $productMaterialAndCareInstructions->innerMaterial</h6>";
                                                                echo "<br />";
                                                            }

                                                            if ($productMaterialAndCareInstructions->outerSole) {
                                                                echo "<h6>Outer Sole: $productMaterialAndCareInstructions->outerSole</h6>";
                                                                echo "<br />";
                                                            }

                                                            if (sizeof($productMaterialAndCareInstructions->careInstruction) !== 0) {
                                                                echo "<h6>Care Instructions:</h6>";
                                                                echo "<br />";
              
                                                                echo "<ul>";

                                                                foreach ($productMaterialAndCareInstructions->careInstruction as $careInstructionNode) {
                                                                    $careInstructionValue = (string) $careInstructionNode;
                                                                    echo "<li>$careInstructionValue</li>";
                                                                }

                                                                echo "</ul>";
                                                            }
                                                        }
                                                    ?>
                                                </div>            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note"></p>
                                        <div class="product__details__tab__content__item">
                                            <?php
                                              echo "<p>$shippingAndReturnsPolicy</p>"; 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Products</h3>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach ($relatedProducts as $relatedProduct) {
                      $relatedProductImages = $relatedProduct->images;
                      $relatedProductTagValue = (string) $relatedProduct->tag;
                      $relatedProductNumber = $relatedProduct->attributes()->number;
                      $relatedProductCategory = $relatedProduct->attributes()->category;

                       echo "<div class='col-lg-3 col-md-6 col-sm-6 col-sm-6'>
                            <div class='product__item'>
                                <div class='product__item__pic set-bg' data-setbg='$relatedProductImages->modelCenterImage'>
                                    " . ($relatedProductTagValue != 'regular' ? "<span class='label'>$relatedProductTagValue</span>" : '') . "
                                    <ul class='product__hover'>
                                        <li>
                                            <form method='get' action='shopDetails.php'>
                                                <input type='hidden' name='productNumber' value='$relatedProductNumber' />
                                                <input type='hidden' name='productCategory' value='$relatedProductCategory' />
                                                <button type='submit'>
                                                    <img src='img/icon/search.png' alt='' />
                                                </button>
                                            </form> 
                                        </li>
                                    </ul>
                                </div>
                                <div class='product__item__text'>
                                    <h6>$relatedProduct->name</h6>
                                    <a href='#' class='add-cart'>+ Add To Cart</a>
                                    <form method='get' action='shopDetails.php'>
                                        <input type='hidden' name='productNumber' value='".$relatedProductNumber."' />
                                        <input type='hidden' name='productCategory' value='".$relatedProductCategory."' />
                                        <a href='#' class='add-cart' onclick='event.preventDefault(); this.parentNode.submit();'>
                                            + Add To Cart
                                        </a>
                                    </form>
                                    <h5>$$relatedProduct->price</h5>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Related Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="./fallWinterClothingCollection.php">Clothing Store</a></li>
                            <li><a href="./shoesWinterCollection.php">Trending Shoes</a></li>
                            <li><a href="./accessoriesFallCollection.php">Accessories</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Info</h6>
                        <ul>
                            <li><a href="./contact.php">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivery</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                     <div class="footer__copyright__text">
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | Class Outfitters
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form method="get" class="search-model-form" action="searchResults.php">
                <input type="text" id="search-input" name="search" placeholder="Search here.....">
                <input type="submit" hidden />
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/productDetailsShoppingCart.js"></script>
</body>

</html>