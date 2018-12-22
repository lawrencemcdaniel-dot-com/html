<?php

/**
* @package turbo-widgets
* WOP tinyMCE editor dialog
* /

/**
* [turbo_list_all_widgets description]
*
* @param  [arraay] $tw_attrs .
*/
function turbo_list_all_widgets( $tw_attrs )
{
    global  $wp_registered_widgets, $wp_registered_widget_controls ;
    $turbo_widget_name = '';
    $select_disabled = '';

    if ( '' != $tw_attrs ) {
        $pieces = explode( ' ', $tw_attrs );
        parse_str( $pieces[1], $output );
        // $turbo_widget_name = $output['widget-prefix'];
        // $turbo_widget_name = str_replace( '-99', '', $turbo_widget_name );

        if ( array_key_exists( 'id_base', $output ) ) {
            parse_str( htmlspecialchars_decode( $tw_attrs ), $output );
            $turbo_widget_name = $output['id_base'];
        } else {
            $turbo_widget_name = $output['widget-prefix'];
        }

        $select_disabled = 'disabled';
    }

    $sort = $wp_registered_widgets;
    $turbo_widget_name_arr = array();
    foreach ( $sort as $i => $value ) {

        if ( array_key_exists( $value['name'], $turbo_widget_name_arr ) ) {
            unset( $sort[$i] );
        } else {
            $turbo_widget_name_arr[$value['name']] = true;
        }

    }
    echo  '<select id="widget_select"' . esc_html( $select_disabled ) . '><option value="Null"></option>' ;
    foreach ( $sort as $i => $value ) {
        $callback = $value['callback'];
        $turbo_object = $callback[0];

        if ( is_array( $callback ) ) {
            $turbo_object = $callback[0];

            if ( isset( $turbo_object->id_base ) ) {
                $select_value = $turbo_object->id_base;
            } else {
                $select_value = $value['id'];
            }

        } else {
            $select_value = $value['id'];
        }

        $selected = '';
        if ( $select_value == $turbo_widget_name ) {
            $selected = 'SELECTED';
        }
        echo  '<option value="' . esc_html( $select_value ) . '" ' . esc_html( $selected ) . '>' . esc_html( $value['name'] ) . '</option>' ;
    }
    echo  '</select>' ;
    // Output all the hidden widget forms.
    // If the Widget does not conform to what we need then we display some info.
    echo  '<div class="isNull"></div>' ;
    foreach ( $sort as $i => $value ) {
        $callback = $value['callback'];
        $control = $wp_registered_widget_controls[$value['id']];
        $control_callback = $control['callback'];
        ob_start();
        call_user_func_array( $control_callback, $value['params'] );
        $my_str = ob_get_contents();
        ob_end_clean();

        if ( $value['params'][0]['number'] > 0 ) {
            $widget_prefix = $value['id'];
        } else {
            $widget_prefix = $control['id'] = $control['id_base'] . '-99';
            $my_str = str_replace( '__i__', '99', $my_str );
        }

        $widget_id_base = $callback[0]->id_base;

        if ( is_array( $control_callback ) ) {
            $turbo_object = $control_callback[0];
            $form_class = $turbo_object->id_base;
            $obj_class = get_class( $turbo_object );
        } else {
            $form_class = $value['id'];
            $obj_class = $form_class;
        }

        echo  '<div class="is' . esc_html( $form_class ) . '">' ;
        echo  '<input type="hidden" id="widget-prefix" name="widget-prefix" value="' . esc_html( $widget_prefix ) . '" />' ;
        echo  '<input type="hidden" id="obj-class" name="obj-class" value="' . esc_html( $obj_class ) . '" />' ;
        echo  '<input type="hidden" id="id_base" name="id_base" value="' . esc_html( $widget_id_base ) . '" />' ;

        if ( !is_array( $callback ) ) {
            // This widget does not extend WP_Widget.
            echo  '<input type="hidden" id="display-callback" name="display-callback" value="' . esc_html( $callback ) . '" />' ;
            echo  '<p>This widget only supports a single instance. It\'s setings will come from config that is set in the main Widgets Admin Screen.</p>' ;
            //echo  '<p>If you do not wish to set the widget config in one of the existing sidebars, you can enabled <a href="' . tw_fs()->get_upgrade_url() . '">Turbo Sidebars by updrading to the PRO version</a>' ;
            echo  '<p>If you do not wish to set the widget config in one of the existing sidebars, you can enabled <a href="http://turbowidgets.net/go-pro/?plugin"  target="_BLANK">Turbo Sidebars by updrading to the PRO version</a>' ;
        } else {
            echo  $my_str ;
        }

        echo  '</div>' ;
        echo  '</div>' ;
    }
}

?>

<style>
	.turbo-widget-title {font-family: "Open Sans",sans-serif; color: #5A5A5A; font-size: 1.7em;}
	.current-div input[type=text], .current-div select {  border-spacing: 0; width: 100%;clear: both;margin: 0;}
	.submit_btn {clear: both;}
	div#TB_ajaxContent {width: 95% !important; height: 90% !important;}
	.tw-notification {color: #fff; padding: 1em; margin-top: 0.8em;}
	.tw-notification h2 {color: #fff;}
	.tw-notification a {color: #fff; font-style: italic;}
</style>
<script>
	jQuery(document).ready(function(){
		// Hide the default MCE image toolbar
		jQuery(".mce-inline-toolbar-grp").hide();

		jQuery('[class^=is]').hide();
		// This log shows that we can get currently selected widget info.
		// And thus we can edit existing widgets.
		var currWidget =  tinymce.activeEditor.selection.getContent();
		//console.log('getContent' +  currWidget);
		var value = jQuery("#widget_select option:selected").val();
		var theDiv = jQuery(".is" + value);
		theDiv.slideDown();
		theDiv.addClass('current-div');
		theDiv.siblings('[class^=is]').slideUp();
		theDiv.siblings('[class^=is]').removeClass("current-div");
		jQuery("#current-widget").val(".is" + value);

		// Polulate form if editing existing widget shortcode
		return currWidget.replace(/\[turbo_widget([^\]]*)\]/g, function(a,b){
			b = b.replace(/\+/g, '%20');
			b = b.replace(/#038;widget-/g, '&widget-');
			b = b.replace(/#038;obj-class=/g, '&obj-class=');
			b = b.replace(/#038;id_base=/g, '&id_base=');

			var queryDict = {};
			b.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
			console.debug('queryDict', queryDict);
			jQuery('input', jQuery('.current-div')).each(function () {
				var curId = jQuery(this).attr("id");
				var type = jQuery(this).prop('type');
				if (typeof(queryDict[curId] != "undefined")) {
					if (type == "checkbox") {
						if  (queryDict[curId] == "true"){
							jQuery(this).prop('checked', true);
						} else {
							jQuery(this).prop('checked', false);
						}
					} else {
						jQuery(this).val(decodeURIComponent(queryDict[curId]));
					}
				}
			});
			jQuery('textarea', jQuery('.current-div')).each(function () {
				var curId = jQuery(this).attr("id");
				if (typeof(queryDict[curId] != "undefined")) {
					jQuery(this).val(decodeURIComponent(queryDict[curId]));
				}
			});
			jQuery('select', jQuery('.current-div')).each(function () {
				var curId = jQuery(this).attr("id");
				if (typeof(queryDict[curId] != "undefined")) {
					jQuery(this).val(decodeURIComponent(queryDict[curId]));
				}
			});
		});
	});
	jQuery('#widget_select').change(function() {
		var value = jQuery("#widget_select option:selected").val();
		var theDiv = jQuery(".is" + value);
		theDiv.slideDown();
		theDiv.addClass('current-div');
		theDiv.siblings('[class^=is]').slideUp();
		theDiv.siblings('[class^=is]').removeClass("current-div");
		jQuery("#current-widget").val(".is" + value);
	});
</script>
		<?php
$update_existing = 0;

if ( '' != $tw_attrs ) {
    $update_existing = 1;
    echo  '<h3 class=\'turbo-widget-title\'>Modifying Widget</h3>' ;
    if ( tw_fs()->is_not_paying() ) {
        // echo  '<p class="update-nag"> This is a PRO feature only - <strong><a href="' . tw_fs()->get_upgrade_url() . '">' . __( 'Upgrade Now!', 'turbo-widgets' ) . '</a></strong></p><hr />' ;
        echo  '<p class="update-nag"> This is a PRO feature only - <strong><a href="http://turbowidgets.net/go-pro/?plugin"  target="_BLANK">' . __( 'Upgrade Now!', 'turbo-widgets' ) . '</a></strong></p><hr />' ;
    }
} else {
    echo  '<h3 class=\'turbo-widget-title\'>Select a Widget to add</h3>' ;
}

?>
		<form id='widget-options-form'>
			<input type='hidden' id='current-widget' value=''/>
		<?php
turbo_list_all_widgets( $tw_attrs );
?>

		<?php

if ( '' != $tw_attrs ) {
} else {
    ?>
			<p class='submit_btn'>
					<input type="button" class="button-secondary" value="<?php
    esc_html_e( 'Cancel', 'wop' );
    ?>
" onclick="tb_remove();" />
					<input type="button" class="button-primary" value="<?php
    esc_html_e( 'Insert', 'wop' );
    ?>
" onclick="insertShortCode(<?php
    echo  esc_html( $update_existing ) ;
    ?>
);" />
				</p>
		<?php
}

?>
		</form>
		<hr />
		<?php

if ( tw_fs()->is_not_paying() ) {
    ?>
			<h3>Upgrade for more features</h3>
			<p>Get extra features, like being to edit existing Widgets once they've already been added, and the super <a href="http://turbowidgets.net/features/" target="_BLANK">Turbo Sidebars</a></p>
			<h4><?php
    // echo  '<a href="' . tw_fs()->get_upgrade_url() . '">' . __( 'Upgrade Now!', 'turbo-widgets' ) . '</a>' ;
    echo  '<a href="http://turbowidgets.net/go-pro/?plugin" target="_BLANK">' . __( 'Upgrade Now!', 'turbo-widgets' ) . '</a>' ;
    ?>

						</h4>
		<?php
}

?>
		<h3>Rate this plugin</h3><p><a href="http://wordpress.org/support/view/plugin-reviews/turbo-widgets?rate=5#postform" title="Rate me" target="_BLANK">If you like me, please rate me</a>... or maybe even <a href="https://datamad.co.uk/donate/" title="Show you love" target="_BLANK">donate to the author</a></p> <p>or perhaps just spread the good word <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://wordpress.org/extend/plugins/turbo-widgets/" data-text="Using the Turbo Widgets WordPress plugin and lovin' it" data-via="toddhalfpenny" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
</div>
