jQuery(document).ready(function() {

	
	
	//Accordion & Toggle
	jQuery('.dt-sc-toggle').toggle(function(){ jQuery(this).addClass('active'); },function(){ jQuery(this).removeClass('active'); });
	jQuery('.dt-sc-toggle').click(function(){ jQuery(this).next('.dt-sc-toggle-content').slideToggle(); });
	
	jQuery('.dt-sc-toggle-frame-set').each(function(){
		var $this = jQuery(this),
		    $toggle = $this.find('.dt-sc-toggle-accordion');
			
			$toggle.click(function(){
				if( jQuery(this).next().is(':hidden') ) {
					$this.find('.dt-sc-toggle-accordion').removeClass('active').next().slideUp();
					jQuery(this).toggleClass('active').next().slideDown();
				}
				return false;
			});
			
			//Activate First Item always
			$this.find('.dt-sc-toggle-accordion:first').addClass("active");
			$this.find('.dt-sc-toggle-accordion:first').next().slideDown();
  	});//Accordion & Toggle

	//Tooltip
	 if(jQuery(".dt-sc-tooltip-bottom").length){
		 jQuery(".dt-sc-tooltip-bottom").each(function(){	jQuery(this).tipTip({maxWidth: "auto"}); });
	 }
	 
	 if(jQuery(".dt-sc-tooltip-top").length){
		 jQuery(".dt-sc-tooltip-top").each(function(){ jQuery(this).tipTip({maxWidth: "auto",defaultPosition: "top"}); });
	 }
	 
	 if(jQuery(".dt-sc-tooltip-left").length){
		 jQuery(".dt-sc-tooltip-left").each(function(){ jQuery(this).tipTip({maxWidth: "auto",defaultPosition: "left"}); });
	 }
	 
	 if(jQuery(".dt-sc-tooltip-right").length){
		 jQuery(".dt-sc-tooltip-right").each(function(){ jQuery(this).tipTip({maxWidth: "auto",defaultPosition: "right"}); });
	 }//Tooltip End	

	/* Progress Bar */
	 animateSkillBars();
	 jQuery(window).scroll(function(){ 
	 	animateSkillBars();
	 });
	 
	 function animateSkillBars(){
		 var applyViewPort = ( jQuery("html").hasClass('csstransforms') ) ? ":in-viewport" : "";
		 
		 jQuery('.dt-sc-progress'+applyViewPort).each(function(){
			 var progressBar = jQuery(this),
			 	 progressValue = progressBar.find('.dt-sc-bar').attr('data-value');
				 
				 if (!progressBar.hasClass('animated')) {
					 	progressBar.addClass('animated');
						progressBar.find('.dt-sc-bar').animate({width: progressValue + "%"},600,function(){ progressBar.find('.dt-sc-bar-text').fadeIn(400); });
				 }
    	 });
  	}/* Progress Bar End */

  //Divider Scroll to top
  jQuery("a.scrollTop").each(function(){
    jQuery(this).click(function(e){
      jQuery("html, body").animate({ scrollTop: 0 }, 600);
      e.preventDefault();
    });
  });//Divider Scroll to top end

  // Tabs Shortcodes
  "use strict";
  if(jQuery('ul.dt-sc-tabs').length > 0) {
    jQuery('ul.dt-sc-tabs').tabs('> .dt-sc-tabs-content');
  }
  
  if(jQuery('ul.dt-sc-tabs-frame').length > 0){
    jQuery('ul.dt-sc-tabs-frame').tabs('> .dt-sc-tabs-frame-content');
  }
  
  if(jQuery('.dt-sc-tabs-vertical-frame').length > 0){
    
    jQuery('.dt-sc-tabs-vertical-frame').tabs('> .dt-sc-tabs-vertical-frame-content');
    
    jQuery('.dt-sc-tabs-vertical-frame').each(function(){
      jQuery(this).find("li:first").addClass('first').addClass('current');
      jQuery(this).find("li:last").addClass('last');
    });
    
    jQuery('.dt-sc-tabs-vertical-frame li').click(function(){
      jQuery(this).parent().children().removeClass('current');
      jQuery(this).addClass('current');
    });
    
  }/*Tabs Shortcode Ends*/
  
  //Donutchart
  jQuery(".dt-sc-donutchart").each(function(){
	 var $this = jQuery(this);
	 var $bgColor =  ( $this.data("bgcolor") !== undefined ) ? $this.data("bgcolor") : "#5D18D6";
	 var $fgColor =  ( $this.data("fgcolor") !== undefined ) ? $this.data("fgcolor") : "#000000";
	 var $size = ( $this.data("size") !== undefined ) ? $this.data("size") : "100";
	 
	 $this.donutchart({'size': $size, 'fgColor': $fgColor, 'bgColor': $bgColor });
	 $this.donutchart('animate');
	 
 });//Donutchart Shortcode Ends
  
  
  jQuery(window).load(function() {
	  
	  //Portfolio Carousel
	  if( jQuery('.portfolio-carousel-wrapper').length ) {
		  jQuery('.portfolio-carousel-wrapper').each(function(){
			  
			  var pagger = jQuery(this).find("div.carousel-arrows"),
			  	  next = pagger.find("a.portfolio-next-arrow"),
				  prev = pagger.find("a.portfolio-prev-arrow"),
				  item = jQuery(this).find("ul.portfolio-carousel"),
				  max = 3,
				  width  = 340;
				  
				  if ( item.hasClass('four-columns-portfolio-carousel') ) {
					  max = 4,
					  width  = 250;
				  }
				  
				  item.carouFredSel({
					  responsive: true,
					  auto: false,
					  width: '100%',
					  prev: prev,
					  next: next,
					  height: 'auto',
					  //scroll: 1,	
					  scroll : {
							items  : 1,
							duration : 800
							//pauseOnHover :true
					  },			
					  items: {
						  width: width,
						  visible: {   min: 1, max: max  }
					  }				
				  });//carouFredSel()
		  });
	  }
	  
	  //Testimonial Carousel
	  if( jQuery('.dt-sc-testimonial-carousel').length ) {
		  jQuery('.dt-sc-testimonial-carousel').each(function(){
			  var pagger = jQuery(this).parents(".dt-sc-testimonial-carousel-wrapper").find("div.carousel-arrows"),
			      next = pagger.find("a.testimonial-next"),
				  prev = pagger.find("a.testimonial-prev") ;
			  		
			  jQuery(this).carouFredSel({
				  responsive:true,
				  auto:true,
				  width:'100%',
				  height:'auto',
				  scroll:1,
				  items:{ visible: {min: 1,max: 1} },
				  prev:prev,
				  next:next
			  });
		  });
		}
  });
});