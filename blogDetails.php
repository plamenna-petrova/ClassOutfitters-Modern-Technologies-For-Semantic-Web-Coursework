<?php
if (file_exists('./xml/class-outfitters.xml')) {
    $shopNode = simplexml_load_file('./xml/class-outfitters.xml');
    $slug = $_GET['slug'];
    $blogPostByXPathQuery = $shopNode->xpath("blog/post[@slug='$slug']")[0];
    $blogPostTitle = $blogPostByXPathQuery->title;
    $blogPostAuthor = $blogPostByXPathQuery->author;
    $blogPostCreatedOn = $blogPostByXPathQuery->createdOn;
    $blogPostCreatedOnDay = $blogPostCreatedOn->day;
    $blogPostMonthObject = DateTime::createFromFormat('!m', $blogPostCreatedOn->month);
    $formattedBlogPostMonthName = $blogPostMonthObject->format('F');
    $blogPostCreatedOnYear = $blogPostCreatedOn->year;
    $blogPostImage = $blogPostByXPathQuery->image;
    $blogPostContent = $blogPostByXPathQuery->content;
    $blogPostQuote = $blogPostByXPathQuery->quote;
    $blogPostTags = $blogPostByXPathQuery->tag;

    $blogPosts = array();

    foreach ($shopNode->blog->post as $blogPost) {
        $blogPosts[] = $blogPost;
    }

    usort($blogPosts, function ($firstPost, $secondPost) {
        $firstPostDate = "" . $firstPost->createdOn->year . "-" . $firstPost->createdOn->month . "-" . $firstPost->createdOn->day . "";
        $secondPostDate = "" . $secondPost->createdOn->year . "-" . $secondPost->createdOn->month . "-" . $secondPost->createdOn->day . "";
        return strtotime($secondPostDate) - strtotime($firstPostDate);
    });
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

    <!-- Blog Details Hero Begin -->
    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <?php
                            echo "
                                <h2>".$blogPostTitle."</h2>
                                <ul>
                                    <li>".$blogPostAuthor."</li>
                                    <li>".$formattedBlogPostMonthName." ".$blogPostCreatedOnDay.", ".$blogPostCreatedOnYear."</li>
                                </ul>
                            "; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <?php
                        echo "
                            <div class='blog__details__pic'>
                                <img src='".$blogPostImage."' />
                            </div>
                        "; 
                    ?>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__share">
                            <span>share</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <?php
                            echo "
                                <div class='blog__details__text'>
                                    <p>".$blogPostContent."</p>
                                </div>
                                <div class='blog__details__quote'>
                                    <i class='fa fa-quote-left'></i>
                                    <p>\"$blogPostQuote->note\"</p>
                                    <h6>$blogPostQuote->designer</h6>
                                </div>
                            "; 
                        ?>
                        </div>
                        <div class="blog__details__option">
                            <div class="row">
                                <?php
                                    echo "
                                        <div class='col-lg-6 col-md-6 col-sm-6'>
                                            <div class='blog__details__author'>
                                                <div class='blog__details__author__text'>
                                                    <h5>".$blogPostAuthor."</h5>
                                                </div>
                                            </div>
                                        </div>
                                    "; 

                                    echo "<div class='col-lg-6 col-md-6 col-sm-6'>";
                                    echo "<div class='blog__details__tags'>";

                                    foreach ($blogPostTags as $blogPostTag) {
                                        echo "<a>#$blogPostTag</a>";
                                    }

                                    echo "</div>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <?php
                                    $currentBlogPostIndex = array_search($blogPostByXPathQuery, $blogPosts);
                                    
                                    echo "<div class='col-lg-6 col-md-6 col-sm-6'>";

                                    if ($currentBlogPostIndex > 0) {
                                        echo "
                                            <form method='get' action='blogDetails.php'>
                                                <input type='hidden' name='slug' value='".$blogPosts[$currentBlogPostIndex - 1]->attributes()->slug."' />
                                                <a href='#' class='blog__details__btns__item' onclick='event.preventDefault(); this.parentNode.submit();'>
                                                    <p><span class='arrow_left'></span>Previous Post</p>
                                                    <h5>".$blogPosts[$currentBlogPostIndex - 1]->title."</h5>
                                                </a>
                                            </form>
                                        ";
                                    }

                                    echo "</div>";

                                    echo "<div class='col-lg-6 col-md-6 col-sm-6'>";

                                    if ($currentBlogPostIndex < count($blogPosts) - 1) {
                                        echo "
                                            <form method='get' action='blogDetails.php'>
                                                <input type='hidden' name='slug' value='".$blogPosts[$currentBlogPostIndex + 1]->attributes()->slug."' />
                                                <a href='#' class='blog__details__btns__item blog__details__btns__item--next' onclick='event.preventDefault(); this.parentNode.submit();'>
                                                    <p>Next Post<span class='arrow_right'></span></p>
                                                    <h5>".$blogPosts[$currentBlogPostIndex + 1]->title."</h5>
                                                </a>
                                            </form>
                                        ";
                                    }

                                    echo "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

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
    <script src="js/shoppingCartTotal.js"></script>
</body>

</html>
