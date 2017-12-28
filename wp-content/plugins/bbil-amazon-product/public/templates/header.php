<!DOCTYPE html>
<html lang="en">
    <head>
        <?php wp_head(); ?>
    </head>

    <body>
        <?php if (!is_page_template('single_product.php')): ?>
            <section id="promo-area">
                <div class="container">
                    <!-- fixed cart -->
                    <div class="cart">
                        <div class="cart-item">
                            <span>2</span>
                        </div>
                        <a href="javascript:;">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <a href="#">
                                <img class="logo" src="<?php echo plugin_dir_url(__FILE__).'../images/your-logo.png'; ?>">
                            </a>

                            <h1>Welcome!</h1>
                            <h2>Get the Best Deal</h2>
                            <div id="discount-rate">Discount: <span>30</span>%</div>
                            
                            <!-- jquery ui slider START-->
                            <p class="slider-range">
                                <span class="pull-left">0%</span>
                                <span class="pull-right">100%</span>
                            </p>
                            <div id="slider">
                                <div id="custom-handle" class="ui-slider-handle"></div>
                            </div>
                            <!-- jquery ui slider END-->
                            <form action="" method="POST" role="form">
                                <div class="input-group" id="searchbar">
                                    <input id="searchKeywords" type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button id="searchForm" class="btn" type="submit">Find</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        <?php else: ?>

        <?php endif ?>
		<section id="product-list">
		    <div class="container">
		        <div class="row">