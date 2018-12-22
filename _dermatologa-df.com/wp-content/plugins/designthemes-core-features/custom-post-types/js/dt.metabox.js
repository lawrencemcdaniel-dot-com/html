var dtMetabox = {
	dtInit : function() {
		dtMetabox.dtLayoutSelect();
		dtMetabox.dtCustomSwitch();
		dtMetabox.dtImageUploader();
		dtMetabox.dtImageHolder();
		dtMetabox.dtAddVideo();
	},

	dtLayoutSelect : function() {
		jQuery(".dt-bpanel-layout-set").each(function() {
			jQuery(this).find("a").click(function(e) {

				var $parent = jQuery(this).parents(".dt-bpanel-layout-set");
				var $input = $parent.next(":input");

				if (jQuery(this).hasClass("selected")) {
					jQuery(this).removeClass("selected");
					$input.val("");
				} else {
					$parent.find("a.selected").removeClass("selected");
					$input.val(jQuery(this).attr("rel"));
					jQuery(this).addClass("selected");
				}

				e.preventDefault();
			});
		});
	},

	dtCustomSwitch : function() {
		jQuery("div.dt-checkbox-switch").each(function() {
			jQuery(this).click(function() {
				
				var $ele = '#' + jQuery(this).attr("data-for");

				jQuery(this).toggleClass('checkbox-switch-off checkbox-switch-on');

				if (jQuery(this).hasClass('checkbox-switch-on')) {
					jQuery($ele).attr("checked", "checked");
				} else {
					jQuery($ele).removeAttr("checked");
				}
			});
		});
	},
	
	dtImageUploader: function(){
		var file_frame = "";
		jQuery(".dt-open-media").live('click',function(e){
			e.preventDefault();
			
			// If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }
		    
		    file_frame = wp.media.frames.file_frame = wp.media({
		    	multiple: true,
		    	title : "Upload / Select Media",
		    	button :{
		    		text : "Insert Image"
		    	}
		    });
		    
		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		    	// We set multiple to false so only get one image from the uploader
		        var attachments = file_frame.state().get('selection').toJSON();
		        var  holder = "";
		        jQuery.each( attachments,function(key,value){
		        	 var full = value.sizes.full.url,
		        	 thumbnail =  value.sizes.thumbnail.url,
		        	 name = value.name;
					 var id = value.id;
		        	 
		        	 holder += "<li>" +
		        	 		"<img src='"+thumbnail+"'/>" +
		        	 		"<span class='dt-image-name' >"+name+"</span>" +
		        	 		"<input type='hidden' class='dt-image-name' name='items_name[]' value='"+name+"' />" +
		        	 		"<input type='hidden' name='items[]' value='"+full+"' />" +
		        	 		"<input type='hidden' name='items_thumbnail[]' value='"+thumbnail+"' />" +
							"<input type='hidden' name='items_id[]' value='"+id+"' />" +
		        	 		"<span class='my_delete'></span>" +
		        	 		"</li>";
		        });
		        
		        jQuery("ul.dt-items-holder").append(holder);
		        
		    });
		    
		    // Finally, open the modal
		    file_frame.open();
		});
	},
	
	dtImageHolder: function() {
		
		jQuery('ul.dt-items-holder').sortable({
			placeholder: 'sortable-placeholder',
			forcePlaceholderSize: true,
			cancel: '.my_delete, input, textarea, label'
		});
		
		jQuery('body').delegate('span.my_delete','click', function(){
			jQuery(this).parent('li').remove();
		});
		
	},
	
	dtAddVideo : function() {
		
		jQuery(".dt-add-video").click(function(e){
			var $video =  "<li>" +
					"<span class='dt-video'></span>" +
					"<input type='text' name='items[]' value='http://vimeo.com/18439821'/>" +
					"<input type='hidden' class='dt-image-name' name='items_name[]' value='video' />" +
					"<input type='hidden' name='items_thumbnail[]' value='http://vimeo.com/18439821' />" +
					"<span class='my_delete'></span>" +
					"</li>";
			jQuery('ul.dt-items-holder').append($video);
			e.preventDefault();
		});
		
	}
};

jQuery(document).ready(function() {

	dtMetabox.dtInit();

});