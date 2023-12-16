<?php
    if (file_exists('./xml/class-outfitters.xml')) {
        $shopNode = simplexml_load_file('./xml/class-outfitters.xml');
        $collections = $shopNode->collection;
        $bestSellers = $shopNode->xpath("collection/product[tag='best seller']");
        $newArrivals = $shopNode->xpath("collection/product[tag='new']");
        $hotSales = $shopNode->xpath("collection/product[tag='sale']");
        shuffle($bestSellers);
        $bestSellers = array_slice($bestSellers, 0, 8);
        shuffle($newArrivals);
        $newArrivals = array_slice($newArrivals, 0, 4);
        shuffle($hotSales);
        $hotSales = array_slice($hotSales, 0, 4);

        $latestBlogPosts = array();

        foreach ($shopNode->blog->post as $blogPost) {
            $latestBlogPosts[] = $blogPost;
        }

        usort($latestBlogPosts, function ($firstPost, $secondPost) {
            $firstPostDate = "" . $firstPost->createdOn->year . "-" . $firstPost->createdOn->month . "-" . $firstPost->createdOn->day . "";
            $secondPostDate = "" . $secondPost->createdOn->year . "-" . $secondPost->createdOn->month . "-" . $secondPost->createdOn->day . "";
            return strtotime($secondPostDate) - strtotime($firstPostDate);
        });

        $latestBlogPosts = array_slice($latestBlogPosts, 0, 3);
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
                            <li class="active"><a href="./index.php">Home</a></li>
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

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <?php
                $fallWinterClothingCollection = $collections[0];
                $fallWinterClothingCollectionName = $fallWinterClothingCollection->attributes()->name;
                $fallWinterClothingCollectionPresentationImage = $fallWinterClothingCollection->presentationImage;

                echo "<div class='hero__items set-bg' data-setbg='".$fallWinterClothingCollectionPresentationImage."'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-xl-5 col-lg-7 col-md-8'>
                                    <div class='hero__text'>
                                        <h6>".$fallWinterClothingCollectionName."</h6>
                                        <h2>Clothing</h2>
                                        <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                        commitment to exceptional quality.</p>
                                        <a href='./fallWinterClothingCollection.php' class='primary-btn'>Shop now <span class='arrow_right'></span></a>
                                        <div class='hero__social'>
                                            <a href='".$shopNode->socials->facebook."'><i class='fa fa-facebook socials-icon'></i></a>
                                            <a href='".$shopNode->socials->x."'><i class='fa fa-twitter socials-icon'></i></a>
                                            <a href='".$shopNode->socials->pinterest."'><i class='fa fa-pinterest socials-icon'></i></a>
                                            <a href='".$shopNode->socials->instagram."'><i class='fa fa-instagram socials-icon'></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>"; 
            ?>
            <?php
                $shoesWinterCollection = $collections[1];
                $shoesWinterCollectionName = $shoesWinterCollection->attributes()->name;
                $shoesWinterCollectionPresentationImage = $shoesWinterCollection->presentationImage;

                echo "<div class='hero__items set-bg' data-setbg='" . $shoesWinterCollectionPresentationImage . "'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-xl-5 col-lg-7 col-md-8'>
                                <div class='hero__text'>
                                    <h6>" . $shoesWinterCollectionName . "</h6>
                                    <h2>Shoes</h2>
                                    <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                    <a href='./shoesWinterCollection.php' class='primary-btn'>Shop now <span class='arrow_right'></span></a>
                                    <div class='hero__social'>
                                        <a href='" . $shopNode->socials->facebook . "'><i class='fa fa-facebook socials-icon'></i></a>
                                        <a href='" . $shopNode->socials->x . "'><i class='fa fa-twitter socials-icon''></i></a>
                                        <a href='" . $shopNode->socials->pinterest . "'><i class='fa fa-pinterest socials-icon'></i></a>
                                        <a href='" . $shopNode->socials->instagram . "'><i class='fa fa-instagram socials-icon'></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            ?>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <?php
                                echo "<img src='". $collections[0]->bannerImage ."' alt=''/>"; 
                            ?>
                        </div>
                        <div class="banner__item__text">
                            <?php
                                $fallWinterClothingCollectionName = $collections[0]->attributes()->name;
                                echo "<h2>$fallWinterClothingCollectionName</h2>"; 
                                echo "<a href='./fallWinterClothingCollection.php'>Shop now</a>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mt-2">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <?php
                                echo "<img src='". $collections[1]->bannerImage ."' alt=''>"; 
                            ?>
                        </div>
                        <div class="banner__item__text">
                            <?php
                                $shoesWinterCollectionName = $collections[1]->attributes()->name;
                                echo "<h2>$shoesWinterCollectionName</h2>";
                                echo "<a href='./shoesWinterCollection.php'>Shop now</a>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <?php
                                echo "<img src='". $collections[2]->bannerImage ."'>"; 
                            ?>
                        </div>
                        <div class="banner__item__text">
                            <?php
                                $accessoriesFallCollectionName = $collections[2]->attributes()->name;
                                echo "<h2>$accessoriesFallCollectionName</h2>";
                                echo "<a href='./accessoriesFallCollection.php'>Shop now</a>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">All Trending</li>
                        <li data-filter=".best-sellers">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                <?php
                    foreach ($bestSellers as $bestSeller) {
                        $bestSellerProductNumber = $bestSeller->attributes()->number;
                        $bestSellerCategory = $bestSeller->attributes()->category;

                        echo "
                            <div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-sellers'>
                                <div class='product__item'>
                                    <div class='product__item__pic set-bg' data-setbg=".$bestSeller->images->modelCenterImage.">
                                        <span class='label'>Best Seller</span>
                                        <ul class='product__hover'>
                                            <li>
                                                <form method='get' action='shopDetails.php'>
                                                    <input type='hidden' name='productNumber' value='".$bestSellerProductNumber."'/>
                                                    <input type='hidden' name='productCategory' value='".$bestSellerCategory."'/>
                                                    <button type='submit'>
                                                        <img src='img/icon/search.png' alt=''>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class='product__item__text'>
                                        <h6>".$bestSeller->name."</h6>
                                        <a href='#' class='add-cart'>+ Add To Cart</a>
                                        <h5>$".$bestSeller->price."</h5>
                                    </div>
                                </div>
                            </div>
                        ";
                    } 
                ?>
                <?php
                    foreach ($newArrivals as $newArrival) {
                        $newArrivalProductNumber = $newArrival->attributes()->number;
                        $newArrivalCategory = $newArrival->attributes()->category;

                        echo "
                            <div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals'>
                                <div class='product__item'>
                                    <div class='product__item__pic set-bg' data-setbg=".$newArrival->images->modelCenterImage.">
                                        <span class='label'>New</span>
                                        <ul class='product__hover'>
                                             <li>
                                                <form method='get' action='shopDetails.php'>
                                                    <input type='hidden' name='productNumber' value='".$newArrivalProductNumber."'/>
                                                    <input type='hidden' name='productCategory' value='".$newArrivalCategory."'/>
                                                    <button type='submit'>
                                                        <img src='img/icon/search.png' alt=''>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class='product__item__text'>
                                        <h6>".$newArrival->name."</h6>
                                        <a href='#' class='add-cart'>+ Add To Cart</a>
                                        <h5>$".$newArrival->price."</h5>
                                    </div>
                                </div>
                            </div>
                        ";
                    } 
                ?>
                <?php
                    foreach ($hotSales as $hotSale) {
                        $hotSaleProductNumber = $hotSale->attributes()->number;
                        $hotSaleCategory = $hotSale->attributes()->category;

                        echo "
                            <div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales'>
                                <div class='product__item'>
                                    <div class='product__item__pic set-bg' data-setbg=".$hotSale->images->modelCenterImage.">
                                        <span class='label'>Sale</span>
                                        <ul class='product__hover'>
                                            <li>
                                                <form method='get' action='shopDetails.php'>
                                                    <input type='hidden' name='productNumber' value='".$hotSaleProductNumber."'/>
                                                    <input type='hidden' name='productCategory' value='".$hotSaleCategory."'/>
                                                    <button type='submit'>
                                                        <img src='img/icon/search.png' alt=''>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class='product__item__text'>
                                        <h6>".$hotSale->name."</h6>
                                        <a href='#' class='add-cart'>+ Add To Cart</a>
                                        <h5>$".$hotSale->price."</h5>
                                    </div>
                                </div>
                            </div>
                        ";
                    } 
                ?>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Class Outfitters is a lifestyle retailer dedicated to inspiring customers through 
                            a unique combination of product, creativity and cultural trends.</p>
                        <h3>#Class_Outfitters</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                        <h2>Fashion New Trends</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach ($latestBlogPosts as $latestBlogPost) {
                        $latestBlogPostMonthObject = DateTime::createFromFormat('!m', $latestBlogPost->createdOn->month);
                        $formattedLatestBlogPostMonthName = $latestBlogPostMonthObject->format('F');

                        echo "<div class='col-lg-4 col-md-6 col-sm-6 result_item__col'>
                                <div class='blog__item'>
                                    <div class='blog__item__pic set-bg' data-setbg='" . $latestBlogPost->image . "'></div>
                                    <div class='blog__item__text'>
                                        <span>
                                            <img src='img/icon/calendar.png'/>
                                            " . $latestBlogPost->createdOn->day . " " . $formattedLatestBlogPostMonthName . " " . $latestBlogPost->createdOn->year . "
                                        </span>
                                        <h5>" . $latestBlogPost->title . "</h5>
                                        <form method='get' action='blogDetails.php'>
                                            <input type='hidden' name='slug' value='" . $latestBlogPost->attributes()->slug . "' />
                                            <a href='#' onclick='this.parentNode.submit(); return false;'>Read More</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

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
                        <h6>NewsLetter</h6>
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
    <script src="js/shoppingCartTotal.js"></script>
</body>

</html>
