<!--sidebar START -->
<div class="col-lg-3 col-sm-6 sidebar">
    <div class="panel panel-default m-t-15">
        <div class="panel-body">
            <div id="sidebar-discount-rate">Discount: <span>0</span>%</div>

            <!-- jquery ui slider START-->
            <div id="sidebar-slider">
                <div id="custom-handle" class="ui-slider-handle"></div>
            </div>
            <!-- jquery ui slider END-->

            <div class="input-group m-t-40 clearfix">
                <input id="sidebarSearchKeywords" type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button id="sidebarSearchForm" class="btn btn-default" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>
    
    <?php if ($categories) {
        echo '<div class="panel panel-default m-t-15">';
            echo '<div class="panel-body sidebar-categories">';
                echo '<h4>Amazon Categories</h4>';
                    echo '<ul id="sidebarCategories">';
                        foreach ($categories as $category) {
                            echo '<li> <a href="'. trim($category) .'">'. trim($category) .'</a></li>';
                        }
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    } ?>
</div>
<!--sidebar END-->