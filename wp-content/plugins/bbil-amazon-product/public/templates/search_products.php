<?php include 'header.php'; ?>
<?php
    $AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);
?>
<!--Content START -->
<div class="col-lg-9 col-sm-6">
    <?php $AMAZON_PRODUCT->render(); ?>
    <?php $AMAZON_PRODUCT->getLoader(); ?>
</div>
<!--Content END -->
<?php $categories = $AMAZON_PRODUCT->getCategories(); ?>
<?php include 'sidebar.php'; ?>
<?php include 'footer.php'; ?>

<script>
    jQuery(function ($) {
        var ajaxurl             = "<?php echo admin_url('admin-ajax.php'); ?>";
        var initiate_new_load   = true;
        var SearchIndex         = '';
        var ItemPage            = '';
        var maxPages            = '';
        var Keywords            = '';
        var MinPercentageOff    = '';

        // search products
        $(document).on( 'click', '#searchForm, #sidebarSearchForm', function(event) {
            event.preventDefault();
            if ($(this).attr('id') == 'searchForm') {
                // reset values
                $('#sidebar-discount-rate span').html('0');
                $('#sidebar-slider > #custom-handle').css('left', '0');
                $('#sidebar-slider > .ui-slider-range').css('width', '0');
                $('#sidebarSearchKeywords').val('');

                MinPercentageOff   = $('#discount-rate span').html();
                Keywords    = $('#searchKeywords').val();
            } else {
                // reset values
                $('#discount-rate span').html('0');
                $('#slider > #custom-handle').css('left', '0');
                $('#slider > .ui-slider-range').css('width', '0');
                $('#searchKeywords').val('');

                MinPercentageOff   = $('#sidebar-discount-rate span').html();
                Keywords    = $('#sidebarSearchKeywords').val();
            }
            // alert('offer : '+ MinPercentageOff +' === name : '+ Keywords); return false;

            if (Keywords.length > 0) {
                initiate_new_load = true;
                $.ajax({
                    url : ajaxurl, // AJAX handler
                    data    : { 
                        'action'            : 'searchProduct',
                        'MinPercentageOff'  : MinPercentageOff,
                        'Keywords'          : Keywords
                        },
                    method  : 'POST',
                    beforeSend  : function(){ $('#productWrapper').html(''); }, 
                    success     : function(data){
                        var dataObj = JSON.parse(data);
                        $('#productWrapper').html(dataObj.products);

                        $('#productWrapper').attr('data_SearchIndex', 'All');
                        $('#productWrapper').attr('data_maxPages', dataObj.maxPages);
                        $('#productWrapper').attr('data_Keywords', dataObj.Keywords);
                        $('#productWrapper').attr('data_MinPercentageOff', dataObj.MinPercentageOff);
                        $('#productWrapper').attr('data_itempage', 2);
                        $('.spinnerWrapper').addClass('hidden');
                    }, 
                    error       : function(){
                        $('.spinnerWrapper').addClass('hidden');
                        console.log(e); 
                    } 
                });
            } else {
                alert('Name should not be empty.');
            }
        });

        // search products by category
        $(document).on( 'click', '#sidebarCategories li a', function(event) {
            event.preventDefault();
            SearchIndex = $(this).html();
            Keywords = $('#productWrapper').attr('data_Keywords');
            MinPercentageOff = $('#productWrapper').attr('data_MinPercentageOff');
            // alert('SearchIndex : '+ SearchIndex +' == Keywords : '+ Keywords +' == MinPercentageOff : '+ MinPercentageOff);

            if (Keywords.length > 0) {
                $.ajax({
                    url : ajaxurl, // AJAX handler
                    data    : { 
                        'action'            : 'searchProductByCategory',
                        'MinPercentageOff'  : MinPercentageOff,
                        'Keywords'          : Keywords,
                        'SearchIndex'       : SearchIndex
                        },
                    method  : 'POST',
                    beforeSend  : function(){ $('#productWrapper').html(''); }, 
                    success     : function(data){
                        var dataObj = JSON.parse(data);
                        $('#productWrapper').html(dataObj.products);

                        $('#productWrapper').attr('data_SearchIndex', dataObj.SearchIndex);
                        $('#productWrapper').attr('data_maxPages', dataObj.maxPages);
                        $('#productWrapper').attr('data_Keywords', dataObj.Keywords);
                        $('#productWrapper').attr('data_MinPercentageOff', dataObj.MinPercentageOff);
                        $('#productWrapper').attr('data_itempage', 2);
                        $('.spinnerWrapper').addClass('hidden');
                    }, 
                    error       : function(){
                        $('.spinnerWrapper').addClass('hidden');
                        console.log(e); 
                    } 
                });
            } else {
                alert('Name should not be empty.');
            }
        });

        // infinite loading
        $(window).scroll(function() {
            if (ItemPage <= maxPages && initiate_new_load ) {
               if($(window).scrollTop() + $(window).height() > $(document).height() - 2000 ) {
                    SearchIndex = $('#productWrapper').attr('data_SearchIndex');
                    ItemPage = parseInt($('#productWrapper').attr('data_ItemPage'));
                    maxPages = $('#productWrapper').attr('data_maxPages');
                    Keywords = $('#productWrapper').attr('data_Keywords');
                    MinPercentageOff = $('#productWrapper').attr('data_MinPercentageOff');
                    // alert('ItemPage : '+ ItemPage +' == maxPages : '+ maxPages +' == Keywords : '+ Keywords +' == MinPercentageOff : '+ MinPercentageOff);

                    $.ajax({
                        url : ajaxurl, // AJAX handler
                        data : {
                            'action': 'loadMoreProducts',
                            'SearchIndex': SearchIndex,
                            'Keywords': Keywords,
                            'ItemPage' : ItemPage,
                            'MinPercentageOff' : MinPercentageOff
                        },
                        type : 'POST',
                        beforeSend : function ( xhr ) { 
                            jQuery('.spinnerWrapper').removeClass('hidden');
                            initiate_new_load = false;
                        },
                        success : function( data ) {
                            // console.log(data);
                            if (data.length > 0) {
                                jQuery('#productWrapper').append(data);
                                jQuery('.spinnerWrapper').addClass('hidden');
                                $('#productWrapper').attr('data_itempage', ItemPage + 1);
                                initiate_new_load = true;
                            }
                        },
                        error: function(e){ 
                            jQuery('.spinnerWrapper').addClass('hidden');
                            alert(e); 
                        }
                    });
               }
            }
        });
    });
</script>