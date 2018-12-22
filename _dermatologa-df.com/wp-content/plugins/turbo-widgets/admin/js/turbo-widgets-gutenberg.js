var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	// Editable = wp.blocks.Editable,
	BlockControls = wp.blocks.BlockControls,
	InspectorControls = wp.blocks.InspectorControls,
	BlockDescription = wp.blocks.BlockDescription,
	SelectControl = wp.blocks.InspectorControls.SelectControl,
	AlignmentToolbar = wp.blocks.AlignmentToolbar;
	Placeholder = wp.components.Placeholder;
	Button = wp.components.Button;
	// children = wp.blocks.source.children;

var blockStyle = { backgroundColor: '#900', color: '#fff', padding: '20px' };

var twSupportedWidgets = [];
var twCurrentWidget;

function twGetSupportedWidgets(){
	var selectOptionsSelect = [{label:  wp.i18n.__( 'SELECT ', 'turbo-widgets' ) ,value: ''}];
	if ( twSupportedWidgets.length != 0 ) {
		return selectOptionsSelect.concat(twSupportedWidgets);
	} else {
		var request = new Request('/wp-json/turbowidgets/v1/widgets', {
			method: 'GET'
		});
		const res = fetch(request);
		res.then( result => {
			return result.text();
		}).then( result => {
			console.log("supported widgets", result);
			var widgets = JSON.parse( result );
			for (var widget in widgets ) {
			  twSupportedWidgets.push( {label: widgets[ widget ].name, value: widget, object: widgets[ widget ].object } );
			}
		})
		return selectOptionsSelect.concat(twSupportedWidgets);
	}
}

function twGetWidgetForm(widget_id){
	return new Promise(function(resolve, reject) {
		var request = new Request('/wp-json/turbowidgets/v1/widget-form?id=' + widget_id, {
			method: 'GET'
		});
		const res = fetch(request);
		res.then( result => {
			return result.text();
		}).then( result => {
			var stripped = result.replace(new RegExp("\\\\", "g"), "");
			var stripped2 = stripped.replace(/^"(.*)"$/, '$1');
			resolve(stripped2);
		});
	});
}

function twGetTurbowidgetContent( turbowidgetAttrStr ) {
	console.log("getturbowidgetContent", turbowidgetAttrStr);
	var request = new Request('http://local.wordpress.dev/wp-json/turbowidgets/v1/turbowidget?attrs=' + encodeURIComponent(turbowidgetAttrStr), {
		method: 'GET',
		headers: new Headers({
			'Content-Type': 'text/plain'
		})
	});
	const res = fetch(request);
	return res;
}

function twDisplayFormValues() {
    var theDiv = jQuery("#turbowidget-form div");
    childElems = theDiv.children();
    var data = {};
    theDiv.find('input, textarea, select').each(function(i, field) {
        //var item = {field.name : field.value};
        //data.push(item);
        var type = jQuery(this).prop('type');
        if (type == "checkbox" || type=="radio"){
            data[field.id] = jQuery(this).prop('checked');
        } else {
            data[field.id] = jQuery.trim(field.value);
        }
    });
    var str = jQuery.param(data)
    return str;
}

registerBlockType( 'turbo-widgets/turbowidget', {
	title:  wp.i18n.__( 'Turbo Widget', 'turbo-widgets' ),

	icon: 'welcome-widgets-menus',

	category: 'widgets',

	attributes: {
		twCurrentWidgetId: {
			type: 'string',
			value: ''
		},
		twCurrentWidgetName :{
			type: 'string',
			value: ''
		},
		turbowidgetAttrStr: {
			type: 'string',
			value: ''
		},
		widgetform: {
			type: 'string',
			value: null
		}
	},

	edit: class extends wp.element.Component {

		constructor ( ) {

			super( ...arguments );

			var twCurrentWidgetId = this.props.attributes.twCurrentWidgetId;
			console.log("twCurrentWidgetId", twCurrentWidgetId);
			this.state = {
				widgetform: null,
			};
			if ( twCurrentWidgetId && twCurrentWidgetId !== '' ) {
				console.log("We have a already selected a widget" );
				// TODO - need render our widget, and also fill in our form

				this.getWidgetOutputReq = twGetTurbowidgetContent( this.props.attributes.turbowidgetAttrStr );
				this.getWidgetOutputReq.then( result => {
					return result.text();
				}).then(res => {
					console.log("res", res);
					var stripped = res.replace(new RegExp("\\\\", "g"), "");
					var stripped2 = stripped.replace(/^"(.*)"$/, '$1');
					this.setState( {
						content : stripped2
					})
				});
			}

			// Setup InspectorControls, as we want to output them in multiple places
      this.turbowidgetInspectorControls = (twCurrentWidget) => {
      	var el = wp.element.createElement;
      	// console.log("this.props.attributes.turboId", this.props.attributes.turboId);
      	return el(
					InspectorControls,
					{
						key: 'inspector'
					},
					el(
						BlockDescription,
						null,
						el( 'p', null, wp.i18n.__( 'Configure your ', 'turbo-widgets' ) + this.props.attributes.twCurrentWidgetName + ' widget' )
					),
					el( 'h3', null, wp.i18n.__( 'Widget Settings ', 'turbo-widgets' ) ),
					el('form',
						{
							id: "turbowidget-form",
							onClick : () => {
								console.log("Form submit");
								let str = twDisplayFormValues();
								let turbowidgetAttrStr = 'widget-prefix=' + twCurrentWidget.value + '&obj-class=' + twCurrentWidget.object + '&' + str;
									this.props.setAttributes( {
										turbowidgetAttrStr : turbowidgetAttrStr
									});
								// Example of existing shortcode ->
								// [turbo_widget widget-prefix=calendar2&obj-class=WP_Widget_Calendar&widget-calendar2--title=My+Calendar]
								this.getWidgetOutputReq = twGetTurbowidgetContent( turbowidgetAttrStr );
								this.getWidgetOutputReq.then( result => {
									return result.text();
								}).then(res => {
									console.log("res", res);
									var stripped = res.replace(new RegExp("\\\\", "g"), "");
									var stripped2 = stripped.replace(/^"(.*)"$/, '$1');
									this.setState( {
										content : stripped2
									})
								});
							}
						},
						el(
							'div',
								{
									dangerouslySetInnerHTML: {
										__html: this.state.widgetform
									}
								}
							),
						el(Button,
							{
								title: 'Save',
								className: 'components-button button-link'
							},
							wp.i18n.__( 'Save widget settings', 'turbo-widgets' )
						)
					)
				)
      };
      this.turbowidgetInspectorControls = this.turbowidgetInspectorControls.bind(this);
		}

		render ( ) {
			if ( this.state.content) {
				console.log("Rendering content");
				return [
					// InspectorControls
					!! this.props.focus && this.turbowidgetInspectorControls(twCurrentWidget),
					// Preview
					el(
						'div',
						{
							dangerouslySetInnerHTML: {
								__html: this.state.content
							}
						}
					)
				];
			} else
			if (this.state.widgetform) {
				console.log("this.state.widgetform", this.state.widgetform);
				return [
					// InspectorControls
					!! this.props.focus && this.turbowidgetInspectorControls(twCurrentWidget),
					// Preview
					// el(
					// 	'div',
					// 	{
					// 		dangerouslySetInnerHTML: {
					// 			__html: this.state.widgetform
					// 		}
					// 	}
					// )
					el(
						Placeholder,
						{
							icon: "welcome-widgets-menus",
							label:  wp.i18n.__( 'Turbo Widgets', 'turbo-widgets' ),
							instructions:  wp.i18n.__( 'Select a widget from the inspector', 'turbo-widgets' )
						},
						el(
							SelectControl,
							{
								options: twGetSupportedWidgets(),
								onChange : (newWidgetId ) => {
									console.log("newWidgetId", newWidgetId);
									console.log("twSupportedWidgets", twSupportedWidgets);
									twCurrentWidget = _.find(twSupportedWidgets, {value: newWidgetId});
									this.props.setAttributes( {
										twCurrentWidgetId : newWidgetId,
										twCurrentWidgetName: twCurrentWidget.label
									});
									console.log("twCurrentWidget", twSupportedWidgets);
									twGetWidgetForm(newWidgetId).then( result => {
										console.log("result", result);
										this.setState( { widgetform : result } )
									}).catch(function(e){
										console.error(e);
									});
								}
							}
						)
					)
				];
			} else {
				return  [
					// Placeholder
					el(
						Placeholder,
						{
							icon: "welcome-widgets-menus",
							label:  wp.i18n.__( 'Turbo Widgets', 'turbo-widgets' ),
							instructions:  wp.i18n.__( 'Select a widget from the inspector', 'turbo-widgets' )
						},
						el(
							SelectControl,
							{
								options: twGetSupportedWidgets(),
								onChange : (newWidgetId ) => {
									console.log("newWidgetId", newWidgetId);
									console.log("twSupportedWidgets", twSupportedWidgets);
									twCurrentWidget = _.find(twSupportedWidgets, {value: newWidgetId});
									this.props.setAttributes( {
										twCurrentWidgetId : newWidgetId,
										twCurrentWidgetName: twCurrentWidget.label
									});
									console.log("twCurrentWidget", twSupportedWidgets);
									twGetWidgetForm(newWidgetId).then( result => {
										console.log("result", result);
										this.setState( { widgetform : result } )
									}).catch(function(e){
										console.error(e);
									});
								}
							}
						)
					)
				];
			}
		}
	},

	save( props ) {
		// TODO - Somehow removes the shortcode, and just use the HTML comment.
		// 				Perhaps only switch to this once everything has settled down, to
		// 				allow for switching to normal editor.
		// 				NOTE!!! Maybe need to update std shortcode output to also inlcude
		// 				our comment setup too? - UPDATE, seems that HTML comments are kept
		// 				, but we STILL want to see the fact that turbowidget is in there
		//
		console.log('props.attributes', props.attributes);
		if (props.attributes.turbowidgetAttrStr) {
			var turbowidgetAttrStr = props.attributes.turbowidgetAttrStr;
			return '[turbo_widget ' + turbowidgetAttrStr + ']';
		}
	},
} );