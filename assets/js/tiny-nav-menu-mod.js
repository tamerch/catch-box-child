jQuery.noConflict();
(function($) {
	$( document ).ready(function() {
		if ( $('.woocommerce-breadcrumb').children().size() > 0 ){ //assume we are in shop -> select the correct menu
			$($('.menu-header-container ul li')[1]).addClass('current-menu-item current_page_item');
			if ( $('.tinynav').length != 0 ) { $($('.tinynav').children()[1]).selected(true) }
		}
	});
})(jQuery);