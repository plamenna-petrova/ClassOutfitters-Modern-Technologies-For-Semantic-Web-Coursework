<?php
if (file_exists('./xml/class-outfitters.xml')) {
    $shopNode = simplexml_load_file('./xml/class-outfitters.xml');
    $searchTerm = $_GET['search'];

    $UPPERCASE_ALPHABET_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $LOWERCASE_ALPHABET_LETTERS = 'abcdefghijklmnopqrstuvwxyz';

    $foundProducts = $shopNode->xpath("collection/product[@category[contains(translate(., '".$UPPERCASE_ALPHABET_LETTERS."', '".$LOWERCASE_ALPHABET_LETTERS."'), '".$searchTerm."')] or name[contains(translate(., '".$UPPERCASE_ALPHABET_LETTERS."', '".$LOWERCASE_ALPHABET_LETTERS."'), '".$searchTerm."')] or brand[contains(translate(., '".$UPPERCASE_ALPHABET_LETTERS."', '".$LOWERCASE_ALPHABET_LETTERS."'), '".$searchTerm."')]]");
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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Search Results</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Results Section Begin -->

    <?php
        if ($foundProducts) {
            echo "<div class='pt-5'><h3 class='text-center'>You searched for '" . $searchTerm . "'</h3></div>";
            echo "<div class='pt-5'><h2 class='text-center'>".count($foundProducts)." products found</h2></div>";

            echo "<section class='blog spad'>";
            echo "<div class='container'>";
            echo "<div class='row' id='paginated-list'>";

            foreach ($foundProducts as $foundProduct) {
                echo "
                    <div class='col-lg-4 col-md-6 col-sm-6 result_item__col'>
                        <div class='blog__item'>
                            <div class='blog__item__pic set-bg' data-setbg='".$foundProduct->images->modelCenterImage."'></div>
                            <div class='blog__item__text'>
                                <h5>".$foundProduct->name."</h5>
                                <form method='get' action='shopDetails.php'>
                                    <input type='hidden' name='productNumber' value='".$foundProduct->attributes()->number."' />
                                    <input type='hidden' name='productCategory' value='".$foundProduct->attributes()->category."' />
                                    <a href='#' onclick='event.preventDefault(); this.parentNode.submit();'>View</a>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
            }

            echo "</div>";
            
            echo "
                <div class='row'>
                    <div class='col-lg-12'>
                        <nav class='pagination-container product__pagination'>
                            <div id='pagination-numbers'></div>
                        </nav>
                    </div>
                </div>
            ";

            echo "</div>";
            echo "</section";
        } else {
            echo "<div class='py-5'><h3 class='text-center'>You searched for '" . $searchTerm . "'</h3></div>";
            echo "<div class='pt-3 pb-5'><h2 class='text-center'>No products found</h2></div>";
        }
    ?>

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="logo">
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
    <script src="js/pagination.js"></script>
    <script src="js/shoppingCartTotal.js"></script>
</body>

</html>