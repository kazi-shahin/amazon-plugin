jQuery( function($) {
    var handle = $( "#custom-handle" );
    var change_text = $( "#discount-rate>span" );
    var sidebar_change_text = $( "#sidebar-discount-rate>span" );
    $( "#slider, #sidebar-slider" ).slider({
    	//value: 60,
	    orientation: "horizontal",
	    range: "min",
	    animate: true,
      	create: function() {
        	change_text.text( $( this ).slider( "value" ) );
      	},
      	slide: function( event, ui ) {
        	//handle.text( ui.value );
        	change_text.text( ui.value );
      	}
    });

    $( "#sidebar-slider" ).slider({
	    orientation: "horizontal",
	    range: "min",
	    animate: true,
      	create: function() {
        	sidebar_change_text.text( $( this ).slider( "value" ) );
      	},
      	slide: function( event, ui ) {
        	//handle.text( ui.value );
        	sidebar_change_text.text( ui.value );
      	}
    });
});

jQuery('.grid').masonry({
  	itemSelector: '.grid-item',
});

jQuery('.dropdown-toggle').dropdown();