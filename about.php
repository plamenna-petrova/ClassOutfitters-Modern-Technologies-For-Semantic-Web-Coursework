<?php
if (file_exists('./xml/class-outfitters.xml')) {
    $shopNode = simplexml_load_file('./xml/class-outfitters.xml');
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
            <a href="./shoppingCart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
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
                            <li class="active"><a href="./about.php">About Us</a></li>
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
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>About Us</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="img/about/about-us.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who Are We ?</h4>
                        <?php
                            echo "<p>$shopNode->whoAreWe</p>";
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>What We Do ?</h4>
                        <?php
                            echo "<p>$shopNode->whatWeDo</p>";
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Why Choose Us</h4>
                        <?php
                            echo "<p>$shopNode->whyChooseUs</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <?php
                        echo '<p>' . $shopNode->testimonial->content . '</p>' .
                            '<div class="testimonial__author">' .
                            '<div class="testimonial__author__pic">' .
                            '<img src="img/about/testimonial-author.jpg" alt="">' .
                            '</div>' .
                            '<div class="testimonial__author__text">' .
                            '<h5>' . $shopNode->testimonial->author . '</h5>' .
                            '<p>' . $shopNode->testimonial->area . '</p>' .
                            '</div>' .
                            '</div>' ;
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="img/about/testimonial-pic.jpg"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Counter Section Begin -->
    <section class="counter spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <?php
                    echo '<div class="counter__item">' .
                        '<div class="counter__item__number">' .
                        '<h2 class="cn_num">' . $shopNode->internationalClients . '</h2>' .
                        '</div>' .
                        '<span>' . 'International' . '</br>' . 'Clients' . '</span>' .
                        '</div>';
                    ?>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <?php
                        echo '<div class="counter__item">' .
                        '<div class="counter__item__number">' .
                        '<h2 class="cn_num">' . $shopNode->nationalClients . '</h2>' .
                        '</div>' .
                        '<span>' . 'National' . '</br>' . 'Clients' . '</span>' .
                        '</div>';
                    ?>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <?php
                        echo '<div class="counter__item">' .
                        '<div class="counter__item__number">' .
                        '<h2 class="cn_num">' . $shopNode->totalCategories . '</h2>' .
                        '</div>' .
                        '<span>' . 'Total' . '</br>' . 'Categories' . '</span>' .
                        '</div>';
                    ?>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <?php
                        echo '<div class="counter__item">' .
                        '<div class="counter__item__number">' .
                        '<h2 class="cn_num">' . $shopNode->happyCustomersPercentage . '</h2>' .
                        '<strong>' . '%' . '</strong>' .
                        '</div>' .
                        '<span>' . 'Happy' . '</br>' . 'Customers' . '</span>' .
                        '</div>';
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Team</span>
                        <h2>Meet Our Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach ($shopNode->teamMember as $teamMemberNode) {
                        echo "<div class='col-lg-3 col-md-6 col-sm-6'>
                                <div class='team__item'>
                                    <img src=" . $teamMemberNode->image . " alt=''>
                                    <h4>" . $teamMemberNode->name . "</h4>
                                    <span>" . $teamMemberNode->position . "</span>
                                </div>
                            </div>";
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- MathML Section Begin -->
    <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Math ML</span>
                        <h2>Formulas</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-12 text-center my-5">
                    <section>
                        <br />
                        <h5 class="font-weight-bold">
                            <math>
                            <mrow>
                                <mn>4</mn>
                                <mo>+</mo>
                                <msqrt>
                                    <msup>
                                        <mi>x</mi>
                                        <mn>2</mn>
                                    </msup>
                                    <mo>+</mo>
                                    <mn>1</mn>
                                </msqrt>
                                <mo>-</mo>
                                <mn>2</mn>
                                <mo>=</mo>
                                <mn>0</mn>
                            </mrow>
                            </math>
                        </h5>
                    </section>
                </div> 
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 text-center my-5">
                    <section>
                        <br />
                        <h5 class="font-weight-bold">
                            <math display="block">
                                <mi>x</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <msup>
                                        <mfrac>
                                            <mi>q</mi>
                                            <mn>2</mn>
                                        </mfrac>
                                        <mo>-</mo>
                                        <mrow>
                                            <msup>
                                                <mrow>
                                                <mo>(</mo>
                                                <mfrac>
                                                    <mi>1</mi>
                                                    <mi>q</mi>
                                                </mfrac>
                                                <mo>)</mo>
                                                </mrow>
                                                <mn>2</mn>
                                            </msup>
                                        </mrow>
                                        <mo>+</mo>
                                        <mroot>
                                            <mrow>
                                                <msup>
                                                    <mi>q</mi>
                                                    <mn>2</mn>
                                                </msup>
                                                <mo>-</mo>
                                                <mrow>
                                                    <mn>4</mn>
                                                    <mi>q</mi>
                                                </mrow>
                                            </mrow>
                                            <mn>3</mn>
                                        </mroot>
                                    </msup>
                                    <mrow>
                                        <mroot>
                                            <mrow>
                                                <msup>
                                                <mi>q</mi>
                                                <mn>2</mn>
                                                </msup>
                                                <mo>-</mo>
                                                <mn>4</mn>
                                            </mrow>
                                            <mn>3</mn>
                                        </mroot>
                                    </mrow>
                                </mfrac>
                            </math>
                        </h5>
                    </section>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12 text-center my-5">
                     <section>
                        <br />
                        <h5 class="font-weight-bold">
                            <math>
                                <mrow>
                                    <mn>5.23</mn>
                                    <mo>&#x00F7;</mo>
                                    <mn>100</mn>
                                </mrow>
                                <mo>=</mo>
                                <mfrac>
                                    <mn>5.23</mn>
                                    <mn>100</mn>
                                </mfrac>
                                <mo>=</mo>
                                <mn>0.0523</mn>
                            </math>
                        </h5>
                    </section>
                </div>
                <div class="col-12 text-center my-5">
                    <section>
                        <br />
                        <h5 class="font-weight-bold">
                            <math>
                                <mtable frame="solid" columnlines="solid" rowlines="solid">
                                    <mtr mathbackground="green;">
                                        <mtd style="border: 1px solid">
                                            <mi>F</mi>
                                            <mo>(</mo>
                                            <mi>x</mi>
                                            <mo>)</mo>
                                            <mo>=</mo>
                                            <mrow>
                                                <mo>[</mo>
                                                    <mtable>
                                                    <mtr>
                                                        <mtd>
                                                            <mi>cos</mi>
                                                            <mi>x</mi>
                                                        </mtd>
                                                        <mtd>
                                                            <mo>-</mo>
                                                            <mi>sin</mi>
                                                            <mi>x</mi>
                                                        </mtd>
                                                    </mtr>
                                                    <mtr>
                                                        <mtd>
                                                            <mi>sin</mi>
                                                            <mi>x</mi>
                                                        </mtd>
                                                        <mtd>
                                                            <mi>cos</mi>
                                                            <mi>x</mi>
                                                        </mtd>
                                                    </mtr>
                                                    </mtable>
                                                <mo>]</mo>
                                            </mrow>
                                        </mtd>
                                        <mtd
                                            style="
                                            border-top: 1px solid;
                                            border-right: 1px solid;
                                            border-bottom: 1px solid;
                                            "
                                        >
                                            <munderover>
                                                <mo>&int;</mo>
                                                <mn>1</mn>
                                                <mn>e</mn>
                                            </munderover>
                                            <mfrac>
                                                <mrow>
                                                    <mo>d</mo>
                                                    <msup>
                                                        <mi>e</mi>
                                                        <mn>z</mn>                                            
                                                    </msup>
                                                </mrow>
                                                <mi>z</mi>
                                            </mfrac>
                                            <mo>=</mo>
                                            <mn>1</mn>
                                        </mtd>
                                        <mtd
                                            style="
                                            border-top: 1px solid;
                                            border-right: 1px solid;
                                            border-bottom: 1px solid;
                                            "
                                        >
                                            <mstyle displaystyle="true">
                                                <msup>
                                                    <mi>cos</mi>
                                                    <mn>2</mn>
                                                </msup>
                                                <mo>&#x2061;</mo>
                                                <mfrac>
                                                    <mfenced>
                                                        <mrow>
                                                            <mi>&#x03B8;</mi>
                                                            <mo>+</mo>
                                                            <mn>2</mn>
                                                        </mrow>
                                                    </mfenced>
                                                    <mrow>
                                                        <mi>x</mi>
                                                        <mo>&#x2212;</mo>
                                                        <mn>1</mn>
                                                    </mrow>
                                                </mfrac>
                                            </mstyle>
                                        </mtd>
                                    </mtr>
                                    <mtr>
                                        <mtd
                                            style="
                                            border-left: 1px solid;
                                            border-right: 1px solid;
                                            border-bottom: 1px solid;
                                            "
                                        >
                                            <mrow>
                                                <mo>{</mo>
                                                <mtable>
                                                    <mtr>
                                                    <mtd>
                                                        <mrow>
                                                        <mrow>
                                                            <mrow>
                                                            <mn>3</mn>
                                                            <mo>&#8290;</mo>
                                                            <mi>x</mi>
                                                            </mrow>
                                                            <mo>+</mo>
                                                            <mi>y</mi>
                                                        </mrow>
                                                        <mo>=</mo>
                                                        <mn>8</mn>
                                                        </mrow>
                                                    </mtd>
                                                    </mtr>
                                                    <mtr>
                                                    <mtd>
                                                        <mrow>
                                                        <mrow>
                                                            <mi>x</mi>
                                                            <mo>+</mo>
                                                            <mi>y</mi>
                                                        </mrow>
                                                        <mo>=</mo>
                                                        <mn>15</mn>
                                                        </mrow>
                                                    </mtd>
                                                    </mtr>
                                                </mtable>
                                            </mrow>
                                        </mtd>
                                        <mtd style="border-right: 1px solid; border-bottom: 1px solid">
                                             <mrow>
                                                <mo>(</mo>
                                                <mtable>
                                                    <mtr>
                                                        <mtd>
                                                            <mn>1</mn>
                                                        </mtd>
                                                        <mtd>
                                                            <mn>0</mn>
                                                        </mtd>
                                                        <mtd>
                                                            <mn>1</mn>
                                                        </mtd>
                                                    </mtr>
                                                    <mtr>
                                                        <mtd>
                                                            <mn>0</mn>
                                                        </mtd>
                                                        <mtd>
                                                            <mn>1</mn>
                                                        </mtd>
                                                        <mtd>
                                                            <mn>0</mn>
                                                        </mtd>
                                                    </mtr>
                                                    <mtr>
                                                        <mtd>
                                                            <mn>1</mn>
                                                        </mtd>
                                                        <mtd>
                                                            <mn>0</mn>
                                                        </mtd>
                                                        <mtd>
                                                            <mn>1</mn>
                                                        </mtd>
                                                    </mtr>
                                                </mtable>
                                                <mo>)</mo>
                                            </mrow>
                                        </mtd>
                                        <mtd style="border-right: 1px solid; border-bottom: 1px solid">
                                            <msup>
                                                <mrow>
                                                    <mo>(</mo>
                                                        <mrow>
                                                            <mi>f</mi><mo>&#x2062;</mo><mi>g</mi>
                                                        </mrow>
                                                    <mo>)</mo>
                                                </mrow>
                                                <mo>&#x2032;</mo>
                                            </msup>
                                            <mo>=</mo>
                                            <mrow>
                                                <mrow>
                                                    <mi>f</mi>
                                                    <mo>&#x2062;</mo>
                                                    <msup>
                                                        <mi>g</mi>
                                                        <mo>&#x2032;</mo>
                                                    </msup>
                                                </mrow>
                                                <mo>+</mo>
                                                <mrow>
                                                    <msup>
                                                        <mi>f</mi>
                                                        <mo>&#x2032;</mo>
                                                    </msup>
                                                    <mo>&#x2062;</mo>
                                                    <mi>g</mi>
                                                </mrow>
                                            </mrow>
                                        </mtd>
                                    </mtr>
                                    <mtr>
                                        <mtd
                                            style="
                                            border-left: 1px solid;
                                            border-bottom: 1px solid;
                                            border-right: 1px solid;
                                            "
                                        >
                                            <mrow>
                                                <mi>A</mi>
                                                <mo>=</mo>
                                                <mo>(</mo>
                                                    <mtable>
                                                    <mtr>
                                                        <mtd><mi>x</mi></mtd>
                                                        <mtd><mi>y</mi></mtd>
                                                    </mtr>
                                                    <mtr>
                                                        <mtd><mi>z</mi></mtd>
                                                        <mtd><mi>w</mi></mtd>
                                                    </mtr>
                                                    </mtable>
                                                <mo>)</mo>
                                            </mrow>
                                        </mtd>
                                        <mtd style="border-right: 1px solid; border-bottom: 1px solid">
                                            <mi>&#x03C0;</mi>
                                            <mo>&#x2062;</mo>
                                            <msup>
                                                <mi>r</mi>
                                                <mn>2</mn>
                                            </msup>
                                        </mtd>
                                        <mtd style="border-right: 1px solid; border-bottom: 1px solid">
                                             <mrow>
                                                <mo>(</mo>
                                                <mrow>
                                                    <msub>
                                                        <mi>b</mi>
                                                        <mn>1</mn>
                                                    </msub>
                                                    <mo>,</mo>
                                                    <msub>
                                                        <mi>b</mi>
                                                        <mn>2</mn>
                                                    </msub>
                                                    <mo>,</mo>
                                                    <msub>
                                                        <mi>b</mi>
                                                        <mo>3</mo>
                                                    </msub>
                                                    <mo>,</mo>
                                                    <msub>
                                                        <mi>b</mi>
                                                        <mo>4</mo>
                                                    </msub>
                                                    <mo>,</mo>
                                                    <msub>
                                                        <mi>b</mi>
                                                        <mo>5</mo>
                                                    </msub>
                                                </mrow>
                                                <mo>)</mo>
                                            </mrow>
                                        </mtd>
                                    </mtr>
                                </mtable>
                            </math>
                        </h5>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Section End -->

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
    <script src="js/shoppingCartTotal.js"></script>
</body>

</html>
