/**
 * File base.js.
 *
 * Theme functions.
 */

/*===================================
=            MIN SCRIPTS            =
===================================*/

/*===================================
=            SCG REPLACE            =
===================================*/

(function($){

    $('img[src$=".svg"]').each(function() {
        var $img = jQuery(this);
        var imgURL = $img.attr('src');
        var attributes = $img.prop("attributes");

        $.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Remove any invalid XML tags
            $svg = $svg.removeAttr('xmlns:a');

            // Loop through IMG attributes and apply on SVG
            $.each(attributes, function() {
                $svg.attr(this.name, this.value);
            });

            // Replace IMG with SVG
            $img.replaceWith($svg);
        }, 'xml');
    });
	
})(jQuery);

/*==============================
=            LOADER            =
==============================*/

(function($){

	function id(v){ return document.getElementById(v); }
	function loadbar() {
		var ovrl = id("loader"),
			prog = id("progress"),
			stat = id("progstat"),
			img = document.images,
			c = 0,
			tot = img.length;
		if(tot == 0) return doneLoading();

		function imgLoaded(){
			c += 1;
			var perc = ((100/tot*c) << 0) +"%";
			prog.style.width = perc;
			stat.innerHTML = "Loading "+ perc;
			if(c===tot) return doneLoading();
		}
		function doneLoading(){
			ovrl.style.opacity = 0;
			setTimeout(function(){ 
				ovrl.style.display = "none";
			}, 1200);
		}
		for(var i=0; i<tot; i++) {
			var tImg     = new Image();
			tImg.onload  = imgLoaded;
			tImg.onerror = imgLoaded;
			tImg.src     = img[i].src;
		}
	}
	document.addEventListener('DOMContentLoaded', loadbar, false);

})(jQuery);


/*===============================
=            HEADER             =
===============================*/

(function($) {

	var $document = $(document),
	$element = $('#masthead'),
	className = 'scrolled';

	$document.scroll(function() {
		$element.toggleClass(className, $document.scrollTop() >= 10);
	});

})(jQuery);

/*===============================
=            BANNER             =
===============================*/

(function($) {

	$('#banner .table').each(function(){
		var headerHeight = $('#masthead').height();
		$(this).css('padding-top', headerHeight+'px');
	});

})(jQuery);

/*===============================
=            SLICK             =
===============================*/

(function($) {

	$('.tweets').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		fade: true,
		dots: false
	});


})(jQuery);

/*==================================
=            NAVIGATION            =
==================================*/

(function($) {

	$(".menu-item-has-children").on('hover', function(event) {
		event.preventDefault();
		$(this).find('.sub-menu').slideToggle("fast");
	});

})(jQuery);

/*===================================
=            ORIENTATION            =
===================================*/

// jQuery(window).on("orientationchange",function($){
// 	if(window.orientation == 0) // Portrait
// 	{
// 		$('#turnme').removeClass('show');
// 		$('body').removeClass('disablescroll');
// 	}
// 	else // Landscape
// 	{
// 		$('#turnme').addClass('show');
// 		$('body').addClass('disablescroll');
// 	}
// });

/*===========================
=            MAP            =
===========================*/

(function($) {

	function new_map( $el ) {
		
		// var
		var $markers = $el.find('.marker');
		
		// vars
		var args = {
			zoom		: 13,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP,
			// styles 		: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"visibility":"off"},{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"lightness":20},{"color":"#000000"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#dbdbdb"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#212325"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#6b2f2f"},{"lightness":21},{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#858585"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
		};
		
		// create map	        	
		var map = new google.maps.Map( $el[0], args);
		
		
		// add a markers reference
		map.markers = [];
		
		// add markers
		$markers.each(function(){
			
	    	add_marker( $(this), map );
			
		});
		
		// center map
		center_map( map );
		
		// return
		return map;
		
	}

	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function add_marker( $marker, map ) {

		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		var icon = {
			url: $marker.attr('data-icon'), // url
			size: new google.maps.Size(64, 64),     // original size you defined in the SVG file
			scaledSize: new google.maps.Size(64, 64), // scaled size
			//origin: new google.maps.Point(0,0), // origin
			//anchor: new google.maps.Point(0, 0) // anchor
		}

		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon 		: icon
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				infowindow.open( map, marker );

			});
		}

	}

	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 13 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}

	}

	/*
	*  document ready
	*
	*  This function will render each map when the document is ready (page has loaded)
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	// global var
	var map = null;

	$(document).ready(function(){

		$('#map').each(function(){

			// create map
			map = new_map( $(this) );

		});

	});

})(jQuery);