jQuery(document).ready(function($){
	
	/*Menu */
	function megaMenu() {
		var screenWidth = $(document).width(),
			containerWidth = $(".container").width(),
			containerMinuScreen = (screenWidth - containerWidth)/2;
			
			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){
					var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
					MegaMenuChildContainerWidth = $(this).width();
					
					if( (ParentLeftPosition + MegaMenuChildContainerWidth) > containerWidth ){
						
						var marginFromLeft = ( ParentLeftPosition + MegaMenuChildContainerWidth ) - screenWidth;
							marginLeftFromContainer = ( containerMinuScreen + marginFromLeft ) - 52;
							marginLeftFromContainer = "-"+marginLeftFromContainer+"px";
						
						$(this).css('left',marginLeftFromContainer);
					}
			});
	}
	
	megaMenu();
	$(window).smartresize(function(){
		megaMenu();
	});
	
	//Menu Hover Animation...
	$("li.menu-item-depth-0,li.menu-item-simple-parent ul li" ).hover(function(){
		//mouseover 
		if( $(this).find(".megamenu-child-container").length  ){
			$(this).find(".megamenu-child-container").stop().fadeIn('fast');
		} else {
			$(this).find("> ul.sub-menu").stop().fadeIn('fast');
		}
		
	},function(){
		//mouseout
		if( $(this).find(".megamenu-child-container").length ){
			$(this).find(".megamenu-child-container").stop(true, true).hide();
		} else {
			$(this).find('> ul.sub-menu').stop(true, true).hide(); 
		}
	});
	
	if( navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) || navigator.userAgent.match(/Android/i)|| navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i)) {
		if( mytheme_urls.mobilestickynav === "enable") {
			$("#header-wrapper").sticky({ topSpacing: 0 });
		}
	} else {

		if( mytheme_urls.stickynav === "enable" ) {
			$("#header-wrapper").sticky({ topSpacing: 0 });
		}
	}	
	//Menu Ends Here
	
	
	var isMacLike = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i)?true:false;
	if( mytheme_urls.scroll === "enable" && !isMacLike ) {
		jQuery("html").niceScroll({zindex:99999,cursorborder:"1px solid #424242"});
	}

	//Menu
	$('nav#main-menu').meanmenu({ meanMenuContainer :  $('header #primary-menu'), meanRevealPosition:  'right', meanScreenWidth : 767 , meanRemoveAttrs: true });
	
	/* To Top */
	$().UItoTop({ easingType: 'easeOutQuart' });
	
	$("select").each(function(){
		if($(this).css('display') != 'none') {
			$(this).wrap( '<div class="selection-box"></div>' );
		}
	});
	

	/* Portfolio Lightbox */
	if($(".gallery").length) {
		$(".gallery a[data-gal^='prettyPhoto']").prettyPhoto({hook:'data-gal',animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false,social_tools: false,deeplinking:false});		
	}


	//Portfolio isotope
	var $container = $('.dt-sc-portfolio-container');
	if( $container.length) {

		$(window).smartresize(function(){
			$container.css({overflow:'hidden'}).isotope({itemSelector : '.isotope-item',masonry: { gutterWidth: 20} });
		});
		
		$container.isotope({
		  filter: '*',
		  masonry: { gutterWidth: 20},
		  animationOptions: { duration: 750, easing: 'linear', queue: false  }
		});
		
	}
	
	if($("div.dt-sc-sorting-container").length){
		$("div.dt-sc-sorting-container a").click(function(){
			$("div.dt-sc-sorting-container a").removeClass("active-sort");
			var selector = $(this).attr('data-filter');
			$(this).addClass("active-sort");
			$container.isotope({
				filter: selector,
				masonry: { gutterWidth: 20 },
				animationOptions: { duration:750, easing: 'linear',  queue: false }
			});
		return false;	
		});
	}
	//Portfolio isotope End
	
	//Portfolio Single page Slider
	if( ($(".portfolio-slider").length) && ($(".portfolio-slider li").length > 1) ) {
		$('.portfolio-slider').bxSlider({ auto:false, video:true, useCSS:false, pager:'', autoHover:true, adaptiveHeight:true });
	}//Portfolio Single page Slider
	
	if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ){
	  	$("ul.entry-gallery-post-slider").bxSlider({auto:false, video:true, useCSS:false, pager:'', autoHover:true, adaptiveHeight:true});
    }
	
	/* Placeholder Script */
  if(!Modernizr.input.placeholder){
    $('[placeholder]').focus(function() {
      
      var input = $(this);
      if( input.val() == input.attr('placeholder') ) {
        input.val('');
        input.removeClass('placeholder');
      }
      }).blur(function() {
      
      var input = $(this);
      if (input.val() === '' || input.val() === input.attr('placeholder')) {
        input.addClass('placeholder');
        input.val(input.attr('placeholder'));
      }
      }).blur();
    
    $('[placeholder]').parents('form').submit(function() {
      $(this).find('[placeholder]').each(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
          input.val('');
        }
       });
     });
  }
  
  $("div.dt-video-wrap").fitVids();
  
  // Mailchimb
  $(document).on("click", ".mailchimp-form > .nl-submit", function(e){
	  var $this = $(this);
	  var $key = $this.parent("form").find("[name='mythem_mc_api_key']").val();
	  var $email = $this.parent("form").find("[name='mythem_mc_emailid']").val();
	  var $list_id = $this.parent("form").find("[name='mythem_mc_listid']").val();
	  
	  $.ajax({
		  url: mytheme_urls.ajaxurl,
		  data: { action: 'mailchimp_subscribe', 'key' : $key, 'email' : $email, 'list' : $list_id  },
		  success: function (response) {
			  $this.parent("form").next('.zn_mailchimp_result').html(response);
			  $this.parent("form").next('.zn_mailchimp_result').slideDown('slow');
			  if (response.match('success') != null) $this.slideUp('slow');
		  }
		});
		
		e.preventDefault();
	});  
 
  $(window).load(function() {
	  
	  $("ul.products li").each(function(){
		var liHeight = $(this).height(); 
		$(this).css("height", liHeight);
	  });
	  
	  //Portfolio isotope
	  var $container = $('.dt-sc-portfolio-container');
	  if( $container.length) {
		  $container.isotope({
			  filter: '*',
			  masonry: { gutterWidth: 20},
			  animationOptions: { duration: 750, easing: 'linear', queue: false  }
		  });//Portfolio isotope End
	  }
	
  });
});