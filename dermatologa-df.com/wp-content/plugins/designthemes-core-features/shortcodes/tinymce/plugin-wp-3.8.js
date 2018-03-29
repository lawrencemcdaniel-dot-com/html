(function() {
	tinymce.create("tinymce.plugins.DTCoreShortcodePlugin", {

		init : function(d, e) {

			d.addCommand("scnOpenDialog", function(a, c) {
				scnSelectedShortcodeType = c.identifier;
				jQuery.get(e + "/dialog.php", function(b) {
					jQuery("#scn-dialog").remove();
					jQuery("body").append(b);
					jQuery("#scn-dialog").hide();
					var f = jQuery(window).width();
					b = jQuery(window).height();
					f = 720 < f ? 720 : f;
					f -= 80;
					b -= 84;
					tb_show("Insert Shortcode", "#TB_inline?width=" + f
							+ "&height=" + b + "&inlineId=scn-dialog");
					jQuery("#scn-options h3:first").text(
							"Customize the " + c.title + " Shortcode");
				});

			});

		},

		getInfo : function() {
			return {
				longname : 'DesignThemes Core Shortcodes',
				author : 'DesignThemes',
				authorurl : 'http://themeforest.net/user/designthemes',
				infourl : '',
				version : "1.0"
			};

		},

		createControl : function(btn, e) {

			var dummy_conent = "Lorem ipsum dolor sit amet, consectetur"
					+ " adipiscing elit. Morbi hendrerit elit turpis,"
					+ " a porttitor tellus sollicitudin at."
					+ " Class aptent taciti sociosqu ad litora "
					+ " torquent per conubia nostra,"
					+ " per inceptos himenaeos.",
					
			dummy_tabs = '<br>[dt_sc_tab title="Tab 1"]'
					+ "<br>" + dummy_conent + "<br>" + '[/dt_sc_tab]' + "<br>"
					+ '[dt_sc_tab title="Tab 2"]' + "<br>"
					+ dummy_conent + "<br>" + '[/dt_sc_tab]' + "<br>"
					+ '[dt_sc_tab title="Tab 3"]' + "<br>"
					+ dummy_conent + "<br>" + '[/dt_sc_tab]<br>';

			if ("designthemes_sc_button" === btn) {

				var a = this;
				var btn = e.createSplitButton("designthemes_sc_buttons",
						{
							title : "Insert Shortcode",
							image : DTCorePlugin.tinymce_folder
									+ "/images/dt-icon.png",
							icons : false
						});

				btn.onRenderMenu
						.add(function(c, b) {

							/* Accordion */
							c = b.addMenu({
								title : "Accordion"
							});
							a.addImmediate(c, "Default",
								"[dt_sc_accordion_group]"
								+'<br>[dt_sc_toggle title="Accordion 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Accordion 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Accordion 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+"<br>[/dt_sc_accordion_group]");
							 									
							a.addImmediate(c, "Framed",
								"[dt_sc_accordion_group]"
								+'<br>[dt_sc_toggle_framed title="Accordion 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Accordion 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Accordion 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+"<br>[/dt_sc_accordion_group]");
								
							a.addWithDialog(b, "Button", "button");
							a.addWithDialog(b, "Blockquote", "blockquote");
							
							/* Callout Button */
							a.addWithDialog(b, "Callout Button", "callout");
							
							a.addWithDialog(b, "Column Layout", "column");
							
							a.addWithDialog(b, "Colored Box", "coloredbox");
							
							/* Contact Info */
							c = b.addMenu({
								title: "Contact Info"
							});
							a.addImmediate(c, "Address",'<br>[dt_sc_address line1="No: 58 A, East Madison St" line2="Baltimore, MD, USA" /]<br>');
							a.addImmediate(c, "Phone",'<br>[dt_sc_phone phone="+1 200 258 2145" /]<br>');
							a.addImmediate(c, "Mobile",'<br>[dt_sc_mobile mobile="+91 99941 49897" /]<br>');
							a.addImmediate(c, "Fax",'<br>[dt_sc_fax fax="+1 100 458 2345" /]<br>');
							a.addImmediate(c, "Email",'<br>[dt_sc_email emailid="yourname@somemail.com" /]<br>');
							a.addImmediate(c, "Web",'<br>[dt_sc_web url="http://www.google.com" /]<br>');
							a.addImmediate(c, "Onlie Form",'<br>[dt_sc_online_form url="http://www.google.com" /]<br>');
							
							/* Donutchart */
							c = b.addMenu({
								title: "Donut Chart"
							});
							a.addImmediate(c, "Small",'<br>[dt_sc_donutchart_small title="Lorem" bgcolor="#808080" fgcolor="#4bbcd7" percent="70" /]<br>');
							a.addImmediate(c, "Medium",'<br>[dt_sc_donutchart_medium title="Lorem" bgcolor="#808080" fgcolor="#7aa127" percent="65" /]<br>');
							a.addImmediate(c, "Large",'<br>[dt_sc_donutchart_large title="Lorem" bgcolor="#808080" fgcolor="#a23b6f" percent="50" /]<br>');
							
							/* Dropcap Shortcodes */
							a.addWithDialog(b, "Dropcap", "dropcap");

							/* Dividers Shortcodes */
							c = b.addMenu({
								title : "Dividers"
							});
							
							a.addImmediate(c,"Clear",
									"<br>[dt_sc_clear]<br>");

							a.addImmediate(c, "Bordered Horizontal Rule",
									"<br>[dt_sc_hr_border] <br>");
							
							a.addImmediate(c, "Horizontal Rule",
									"<br>[dt_sc_hr] <br>");
							
							a.addImmediate(c, "Horizontal Rule Medium",
									"<br>[dt_sc_hr_medium] <br>");
							
							a.addImmediate(c, "Horizontal Rule Large",
									"<br>[dt_sc_hr_large] <br>");
							
							a.addImmediate(c, "Horizontal Rule with top link",
									"<br>[dt_sc_hr top] <br>");
							
							a.addImmediate(c, "Whitespace",
									"<br>[dt_sc_hr_invisible] <br>");
							
							a.addImmediate(c, "Whitespace Medium",
									"<br>[dt_sc_hr_invisible_medium] <br>");
							
							a.addImmediate(c, "Whitespace Large",
									"<br>[dt_sc_hr_invisible_large] <br>");
									
							
							/* Icon Box */
							a.addWithDialog(b, "Icon Boxes", "iconbox");


							/* List Shortcodes */
							c = b.addMenu({
								title : "Lists"
							});
							a.addWithDialog(c, "Ordered List", "orderedlist");
							a.addWithDialog(c, "Unordered List","unorderedlist");
							a.addImmediate(c, "Manual List 1","[dt_sc_manual_list type='type1']<br><ul><li>[dt_sc_box]1[/dt_sc_box]Sinus Attack!</li><li>[dt_sc_box]2[/dt_sc_box]Seasonal affective disorder</li> <li>[dt_sc_box]3[/dt_sc_box]Medicaid Eligibility</li></ul><br>[/dt_sc_manual_list]");
							a.addImmediate(c, "Manual List 2","[dt_sc_manual_list type='type2']<br><ul><li>[dt_sc_box]1[/dt_sc_box]Sinus Attack!</li><li>[dt_sc_box]2[/dt_sc_box]Seasonal affective disorder</li> <li>[dt_sc_box]3[/dt_sc_box]Medicaid Eligibility</li></ul><br>[/dt_sc_manual_list]");
							
							/*Pullquotes*/							
							a.addWithDialog(b, "Pullquote", "pullquote");
							

							/*Pricing Table*/
							a.addWithDialog(b, "Pricing Table", "pricingtable");
							
							/* Progressbar*/
							c = b.addMenu({ title:"Progress Bar"});
							a.addImmediate(c, "Standard","<br>[dt_sc_progressbar value='85' type='standard' color='#9c59b6' textcolor=''] consectetur[/dt_sc_progressbar]<br>");
							a.addImmediate(c, "Stripe","<br>[dt_sc_progressbar value='75' type='progress-striped' color='' textcolor=''] consectetur[/dt_sc_progressbar]<br>");
							a.addImmediate(c, "Active","<br>[dt_sc_progressbar value='45' type='progress-striped-active'] consectetur[/dt_sc_progressbar]<br>");
							
							/* Info Graphics Progress bar*/
							a.addWithDialog(b, "Info Graphics Bar", "infographicbar");

							/* Tab */
							c = b.addMenu({
								title : "Tabs"
							});
							a.addImmediate(c, "Horizontal",
									"[dt_sc_tabs_horizontal]" + dummy_tabs
											+ "[/dt_sc_tabs_horizontal]");

							a.addImmediate(c, "Vertical",
									"[dt_sc_tabs_vertical]" + dummy_tabs
											+ "[/dt_sc_tabs_vertical]");
							
							a.addWithDialog(b, "Titled Box", "box");				

							/* Toggle */
							c = b.addMenu({
								title : "Toggle"
							});

							a.addImmediate(c, "Default",
								'[dt_sc_toggle title="Toggle 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Toggle 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Toggle 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]");
							
							a.addImmediate(c, "Framed",
								'[dt_sc_toggle_framed title="Toggle 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Toggle 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Toggle 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]");
									
							/* Tooltip Shortcodes */
							a.addWithDialog(b, "Tooltip", "tooltip");							

							c = b.addMenu({
								title : "Others"
							});
							
							a.addImmediate(c,"Recent Posts",'<br>[dt_sc_recent_post  count="2" column="2" read_more_text="Read More" excerpt_length="10"]<br>');
							a.addImmediate(c,"Individual Post",'<br>[dt_sc_post id="" excerpt_length="15" read_more_text="Read More"]<br>');
							a.addImmediate(c,"3 Columns Portfolio Carousel",'<br>[dt_sc_three_columns_portfolio  showposts="-1" categories=""]<br>');
							a.addImmediate(c,"4 Columns Portfolio Carousel",'<br>[dt_sc_four_columns_portfolio  showposts="-1" categories=""]<br>');
							
							a.addImmediate(c, "Team",'<br>[dt_sc_team name="DesignThemes" degree="MBBS" email="yourname@domain.com" role="Gastroenterologist" image="http://placehold.it/500" twitter="#" facebook="#" google="#" linkedin="#"]<br><p>Saleem naijar kaasram eerie can be disbursed in the wofl like of a fox that is her thing smaoasa lase lemedds laasd pamade eleifend sapien.</p>[/dt_sc_team]<br>');
							
							var testimonal = '[dt_sc_testimonial image="http://placehold.it/300" name="John Doe" role="Cambridge Telcecom"]'+dummy_conent+'[/dt_sc_testimonial]';
							a.addImmediate(c, "Testimonial",'<br>'+testimonal+'<br>');
							a.addImmediate(c, "Testimonial Carousel",'<br>[dt_sc_testimonial_carousel]<br>'
										+'<ul>'
										+'<li>'+testimonal+'</li>'
										+'<li>'+testimonal+'</li>'
										+'<li>'+testimonal+'</li>'
										+'</ul>'
										+'<br>[/dt_sc_testimonial_carousel]<br>');
						});

				return btn;

			}

		},

		addImmediate : function(d, e, a) {
			d.add({
				title : e,
				onclick : function() {
					tinyMCE.activeEditor.execCommand("mceInsertContent", false,
							a);
				}
			});
		},

		addWithDialog : function(d, e, a) {
			d.add({
				title : e,
				onclick : function() {
					tinyMCE.activeEditor.execCommand("scnOpenDialog", false, {
						title : e,
						identifier : a
					});
				}
			});

		}

	});

	// add DTCoreShortcodePlugin plugin
	tinymce.PluginManager.add("DTCoreShortcodePlugin",
			tinymce.plugins.DTCoreShortcodePlugin);
})();