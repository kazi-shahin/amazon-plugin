<?php get_header(); ?>
<?php

    $AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);

    // print_r($AMAZON_PRODUCT->args); echo "<br>";
    // echo json_encode($AMAZON_PRODUCT->args); echo "<br>";
    // print_r($AMAZON_PRODUCT->args);

    $AMAZON_PRODUCT->get_search_form();
    $AMAZON_PRODUCT->render();
    // echo "<br> Total pages : ". $AMAZON_PRODUCT->get_total_pages();
?>
<script>
    jQuery(function ($) {
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        var initiate_new_load = true;
        var ItemPage = parseInt($('#productWrapper').attr('data_ItemPage'));
        var maxPages = $('#productWrapper').attr('data_maxPages');
        var Keywords = $('#productWrapper').attr('data_Keywords');
        var MinPercentageOff = $('#productWrapper').attr('data_MinPercentageOff');
        // alert(ItemPage + ' == '+ maxPages + ' === '+ Keywords);

        // infinite loading
        $(window).scroll(function() {
            if (ItemPage <= maxPages && initiate_new_load ) {
               if($(window).scrollTop() + $(window).height() > $(document).height() - 100 ) {
                    // alert('ItemPage : '+ ItemPage +' == maxPages : '+ maxPages +' == Keywords : '+ Keywords +' == MinPercentageOff : '+ MinPercentageOff);
                    $.ajax({
                        url : ajaxurl, // AJAX handler
                        data : {
                            'action': 'loadMoreProducts',
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
                            jQuery('.imageList ul').append(data);
                            jQuery('.spinnerWrapper').addClass('hidden');
                            ItemPage = ItemPage + 1;
                            initiate_new_load = true;
                        },
                        error: function(e){ 
                            jQuery('.spinnerWrapper').addClass('hidden');
                            alert(e); 
                        }
                    });
               }
            }
        });

        // search products
        $(document).on( 'submit', '#searchForm', function(event) {
            event.preventDefault();
            var MinPercentageOff   = $('#offer').val();
            var Keywords    = $('#name').val();
            // alert('offer : '+ offer +' === name : '+ name);
            if (Keywords.length > 0) {
                $.ajax({
                    url : ajaxurl, // AJAX handler
                    data    : { 
                        'action'            : 'searchProduct',
                        'MinPercentageOff'  : MinPercentageOff,
                        'Keywords'          : Keywords
                        },
                    method  : 'POST',
                    beforeSend  : function(){ $('.imageList ul').html(''); }, 
                    success     : function(data){
                        var dataObj = JSON.parse(data);
                        $('.imageList ul').html(dataObj.products);

                        // $('#productWrapper').attr('data_maxPages', dataObj.maxPages);
                        // $('#productWrapper').attr('data_Keywords', dataObj.Keywords);
                        // $('#productWrapper').attr('data_MinPercentageOff', dataObj.MinPercentageOff);
                        ItemPage = 2;
                        maxPages = dataObj.maxPages;
                        Keywords = dataObj.Keywords;
                        MinPercentageOff = dataObj.MinPercentageOff;
                        alert('ItemPage : '+ ItemPage +' == maxPages : '+ maxPages +' == Keywords : '+ Keywords +' == MinPercentageOff : '+ MinPercentageOff);
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
    });
</script>
<?php get_footer(); ?>
