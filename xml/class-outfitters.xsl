<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:key name="category" match="*[@category]" use="@category"/>
    <xsl:key name="brand" match="*[brand]" use="brand" />
    <xsl:template match="/">
        <html>
            <head>
                <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
                <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
                <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css" />
                <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css" />
                <link rel="stylesheet" href="../css/nice-select.css" type="text/css" />
                <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css" />
                <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css" />
                <link rel="stylesheet" href="../css/style.css" type="text/css" />
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
                        <a href="#" class="search-switch"><img src="../img/icon/search.png" alt="" /></a>
                        <a href="#"><img src="../img/icon/cart.png" alt="" /> <span>0</span></a>
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
                                    <a href="../../index.php"><img src="../img/logo.png" alt="" /></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <nav class="header__menu mobile-menu">
                                    <ul>
                                        <li><a href="../../index.php">Home</a></li>
                                        <li>
                                            <a href="#">Shop</a>
                                            <ul class="dropdown">
                                                <li><a href="./fallWinterClothingCollection.php">Clothing</a></li>
                                                <li><a href="./shoesWinterCollection.php">Shoes</a></li>
                                                <li><a href="./accessoriesFallCollection.php">Accessories</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../../blog.php">Blog</a></li>
                                        <li><a href="../../about.php">About Us</a></li>
                                        <li><a href="../../contact.php">Contacts</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="header__nav__option">
                                    <a href="#" class="search-switch"><img src="../img/icon/search.png" alt="" /></a>
                                    <a href="#"><img src="../img/icon/cart.png" alt="" /> <span>0</span></a>
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
                                    <h4>Shop</h4>
                                    <div class="breadcrumb__links">
                                        <a href="./index.php">Home</a>
                                        <span>Shop</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Breadcrumb Section End -->
                
                <!-- Shop Section Begin -->
                <section class="shop spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="shop__sidebar">
                                    <div class="shop__sidebar__search">
                                        <form action="#">
                                            <input type="text" placeholder="Search..." />
                                            <button type="submit"><span class="icon_search"></span></button>
                                        </form>
                                    </div>
                                    <div class="shop__sidebar__accordion">
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="card-heading">
                                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shop__sidebar__categories">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-heading">
                                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                                </div>
                                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shop__sidebar__brand">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-heading">
                                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                                </div>
                                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shop__sidebar__price">
                                                            <ul>
                                                                <li><a href="#">$0.00 - $50.00</a></li>
                                                                <li><a href="#">$50.00 - $100.00</a></li>
                                                                <li><a href="#">$100.00 - $150.00</a></li>
                                                                <li><a href="#">$150.00 - $200.00</a></li>
                                                                <li><a href="#">$200.00 - $250.00</a></li>
                                                                <li><a href="#">$250.00+</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-heading">
                                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                                </div>
                                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shop__sidebar__size">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-heading">
                                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                                </div>
                                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shop__sidebar__color ml-1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-heading">
                                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                                </div>
                                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shop__sidebar__tags">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="shop__product__option">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="shop__product__option__left">
                                                <p>Showing 1–12 of 126 results</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="shop__product__option__right">
                                                <p>Sort by Price:</p>
                                                <select>
                                                    <option value="">Neutral</option>
                                                    <option value="">Low To High</option>
                                                    <option value="">High To Low</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="paginated-list">
                                    <xsl:for-each select="shop/collection[@name='Fall-Winter Clothing Collection 2023/2024']/product">
                                        <div class="col-lg-4 col-md-6 col-sm-6 product__item__col fall-winter-clothing-collection">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{images/modelCenterImage}">
                                                    <xsl:if test="tag != 'regular'">
                                                       <span class="label"><xsl:value-of select="tag" /></span>     
                                                    </xsl:if>
                                                    <ul class="product__hover">
                                                        <li>
                                                            <form method="get" action="shop-details.php">
                                                                <input type="hidden" name="productNumber" value="{@number}" />
                                                                <input type="hidden" name="productCategory" value="{@category}" />
                                                                <button type="submit">
                                                                    <img src="img/icon/search.png" alt="" />
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__item__text">
                                                    <h6><xsl:value-of select="name" /></h6>
                                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                                    <h5><xsl:value-of select="price" /></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </xsl:for-each>
                                    <xsl:for-each select="shop/collection[@name='Shoes Winter Collection 2023/2024']/product">
                                        <div class="col-lg-4 col-md-6 col-sm-6 product__item__col shoes-winter-collection">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{images/modelCenterImage}">
                                                    <xsl:if test="tag != 'regular'">
                                                        <span class="label"><xsl:value-of select="tag" /></span>     
                                                    </xsl:if>
                                                    <ul class="product__hover">
                                                        <li>
                                                            <form method="get" action="shop-details.php">
                                                                <input type="hidden" name="productNumber" value="{@number}" />
                                                                <input type="hidden" name="productCategory" value="{@category}" />
                                                                <button type="submit">
                                                                    <img src="../img/icon/search.png" alt="" />
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__item__text">
                                                    <h6><xsl:value-of select="name" /></h6>
                                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                                    <h5><xsl:value-of select="price" /></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </xsl:for-each>
                                    <xsl:for-each select="shop/collection[@name='Accessories Fall Collection 2023']/product">
                                        <div class="col-lg-4 col-md-6 col-sm-6 product__item__col accessories-fall-collection">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{images/modelCenterImage}">
                                                    <xsl:if test="tag != 'regular'">
                                                        <span class="label"><xsl:value-of select="tag" /></span>     
                                                    </xsl:if>
                                                    <ul class="product__hover">
                                                        <li>
                                                            <form method="get" action="shop-details.php">
                                                                <input type="hidden" name="productNumber" value="{@number}" />
                                                                <input type="hidden" name="productCategory" value="{@category}" />
                                                                <button type="submit">
                                                                    <img src="../img/icon/search.png" alt="" />
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__item__text">
                                                    <h6><xsl:value-of select="name" /></h6>
                                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                                    <h5><xsl:value-of select="price" /></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </xsl:for-each>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <nav class="pagination-container product__pagination">
                                            <div id="pagination-numbers">
                                                
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Shop Section End -->
                
                <!-- Footer Section Begin -->
                <footer class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="footer__about">
                                    <div class="footer__logo">
                                        <a href="#"><img src="../img/logo.png" alt="" /></a>
                                    </div>
                                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                                </div>
                            </div>
                            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                                <div class="footer__widget">
                                    <h6>Shopping</h6>
                                    <ul>
                                        <li><a href="#">Clothing Store</a></li>
                                        <li><a href="#">Trending Shoes</a></li>
                                        <li><a href="#">Accessories</a></li>
                                        <li><a href="#">Sale</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <div class="footer__widget">
                                    <h6>Shopping</h6>
                                    <ul>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">Payment Methods</a></li>
                                        <li><a href="#">Delivary</a></li>
                                        <li><a href="#">Return &amp; Exchanges</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                                <div class="footer__widget">
                                    <h6>NewLetter</h6>
                                    <div class="footer__newslatter">
                                        <p>Be the first to know about new arrivals, look books, sales &amp; promos!</p>
                                        <form action="#">
                                            <input type="text" placeholder="Your email" />
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
                        <form class="search-model-form">
                            <input type="text" id="search-input" placeholder="Search here....." />
                        </form>
                    </div>
                </div>
                <!-- Search End -->
                
                <!-- Js Plugins -->
                <script src="../js/jquery-3.3.1.min.js"></script>
                <script src="../js/bootstrap.min.js"></script>
                <script src="../js/jquery.nice-select.min.js"></script>
                <script src="../js/jquery.nicescroll.min.js"></script>
                <script src="../js/jquery.magnific-popup.min.js"></script>
                <script src="../js/jquery.countdown.min.js"></script>
                <script src="../js/jquery.slicknav.js"></script>
                <script src="../js/mixitup.min.js"></script>
                <script src="../js/owl.carousel.min.js"></script>
                <script src="../js/main.js"></script>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>