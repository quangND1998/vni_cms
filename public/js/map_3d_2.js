jQuery(document).ready(function(){
	var $window = jQuery(window);
	var $window_width = $window.width();
	var $window_height = $window.height();

	var $about_num = jQuery('.about-num ul');
	if ($about_num.length > 0) {
		var flag_countup = false;
		var dt1 = $about_num.find('li:eq(0) dl dt').text();
		var dt2 = $about_num.find('li:eq(1) dl dt').text();
		var dt3 = $about_num.find('li:eq(2) dl dt').text();
		var dt4 = $about_num.find('li:eq(3) dl dt').text();
		$about_num.find('li dl dt').text(0);
		var about_num_offset_bottom =  $about_num.offset().top;
	}
	
	function countUp($num, $el = 0, $i = 0){
		if($i < $num){
			$i+=10;
			$about_num.find('li').eq($el).find('dl dt').text($i);
			setTimeout(function(){
			 	return countUp($num, $el, $i)
			}, 100);		
		}else{
			$about_num.find('li').eq($el).find('dl dt').text($num);
		}
	}	

	$window.scroll(function(event) {
		var scroll = jQuery(this).scrollTop();
		if ($about_num.length > 0) {
			if(scroll > (about_num_offset_bottom - $window_height)){
				if (!flag_countup){
					countUp(dt1, 0);
					countUp(dt2, 1);
					countUp(dt3, 2);
					countUp(dt4, 3);
				}
				flag_countup = true;
			}
		}
		if (scroll > 0) {
			jQuery('.main-nav').addClass('is-sticked small-height').removeClass('transparent');
		}else{
            jQuery('.main-nav').removeClass('is-sticked small-height').addClass('transparent');
		}
	});

	jQuery('header').on('click', '.primary-nav ul >li >a[href=#]', function(event) {
		event.preventDefault();
		jQuery('.primary-nav .botton').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
		jQuery(this).parent().find('.sub-menu').toggleClass('expanded');
	});

	jQuery('.btn-open-nav').click(function(event) {
		jQuery('body').toggleClass('open-nav');
	});

	$window.click(function(event) {
		if(event.target.className == 'primary-nav'){
			jQuery('body').removeClass('open-nav');
		}
	});

	jQuery('.main-nav .primary-nav ul li').has('ul').find('>a').append(' <i class="botton fa fa-angle-down"></i>')

	$window.on('load resize', function(event) {
		let = w_width = jQuery(this).width();
		if (jQuery('#wpadminbar').length > 0) {
			if (w_width > 600) {
				jQuery('.main-nav.stick-fixed').css('top', jQuery('#wpadminbar').outerHeight());
			}else{
				jQuery('.main-nav.stick-fixed').css('top', 0);
			}
		} 
	});

	jQuery('#da-thumbs > li').each( function() { jQuery(this).hoverdir(); } );

	//  Set caption from card text
	jQuery('#list-video-products a').fancybox({
	  caption : function( instance, item ) {
	    return jQuery(this).parent().find('figcaption').html();
	  }
	});

	// hidden - show go to top
	jQuery(window).scroll(function(event) {
		if (jQuery(this).scrollTop() > 1000) {
			jQuery('.top-up').fadeIn();
		}else{
			jQuery('.top-up').fadeOut();
		}
	});

	// go to top
	jQuery('.top-up').click(function(event) {
		jQuery('body,html').animate({scrollTop:0}, 750);
	});

	jQuery('#load-iframe').click(function(event) {
	    let iframe = jQuery(this).data('iframe');
	    let win_w = jQuery(window).width();
	    if (win_w >= 768) {
	      jQuery(`<iframe style="margin-bottom: -5px;" class="url_world_in_3d" width="100%" height="800" src="`+iframe+`" allow="vr" frameborder="0" allowfullscreen></iframe>`).insertAfter('.embed-wrap');
	      jQuery(this).closest('.embed-wrap').hide();
	    }else{
	      jQuery('body').append(
	        `<div id="fullscreen-wrap">
	        	<iframe src="${iframe}" frameborder="0" allowfullscreen=""></div></iframe>
	        </div>
	        <a href="#" id="tour-close" title="CLOSE">
	        <img src="/images/close.svg">
	        </a>`
		  );
		  jQuery('[id^="gb-widget-"]').hide();
	    }
	  });

    jQuery(document).on('click', '#tour-close', function(event) {
		jQuery('#fullscreen-wrap, #tour-close').remove();
		jQuery('[id^="gb-widget-"]').show();
    });

	// jQuery('.owl-www').owlCarousel({
	//     loop:true,
	//     margin:10,
	//     responsiveClass:true,
	//     navText: ["",""],
	//     dots: false,
	//     items: 1,
	//     responsive:{
	//         0:{
	//             items:2,
	//             nav:true
	//         },
	//         600:{
	//             items:3,
	//             nav:false
	//         },
	//         1000:{
	//             items:6,
	//             nav:true,
	//             loop:false
	//         }
	//     }
	// });
});
