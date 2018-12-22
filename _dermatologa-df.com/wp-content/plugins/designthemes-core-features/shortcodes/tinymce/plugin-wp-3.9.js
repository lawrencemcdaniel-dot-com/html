(function() {
	
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
			
			var testimonal = '[dt_sc_testimonial image="http://placehold.it/300" name="John Doe" role="Cambridge Telcecom"]'+dummy_conent+'[/dt_sc_testimonial]';

	// add DTCoreShortcodePlugin plugin
	tinymce.PluginManager.add("DTCoreShortcodePlugin",function( editor , url ) {
		
		editor.on('init', function() {

			editor.addCommand("scnOpenDialog", function(obj) {
				scnSelectedShortcodeType = obj.identifier;
				jQuery.get(url + "/dialog.php", function(b) {
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
					jQuery("#scn-options h3:first").text("Customize the " + obj.title + " Shortcode");
					
				});
			});
		});
	
			
			
		editor.addButton('designthemes_sc_button', {
			title : "DT Shortcodes",
			icon : 'dt-icon',
			type: 'menubutton',
			menu: [

				{ text : 'Accordion',
					menu : [
						{ text: 'Default', onclick: function(e){
							e.stopPropagation();
							var content = "[dt_sc_accordion_group]"
								+'<br>[dt_sc_toggle title="Accordion 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Accordion 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Accordion 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+"<br>[/dt_sc_accordion_group]";
								editor.insertContent(content);
							}
						},

						{ text: 'Framed', onclick: function(e){
							e.stopPropagation();
							var content = "[dt_sc_accordion_group]"
								+'<br>[dt_sc_toggle_framed title="Accordion 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Accordion 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Accordion 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+"<br>[/dt_sc_accordion_group]";
							editor.insertContent(content);
							}
						}
					]
				},


				{ text : 'Button',
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "button"});
					}
				},

				{ text: 'Block Quote',
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "blockquote"});
					}
				},

				{ text: 'Call Out Button',
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "callout"});
					}
					
				 },

				{ text: 'Column Layout', 
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "column"});
					}
				},

				{ text: 'Colored Box',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "coloredbox"});
					}
				},

				{ text : 'Contact Info', menu :[

					{ text: 'Address', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_address line1="No: 58 A, East Madison St" line2="Baltimore, MD, USA" /]');
					}},

					{ text: 'Phone', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_phone phone="+1 200 258 2145" /]');
					}},

					{ text: 'Mobile', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_mobile mobile="+91 99941 49897" /]');
					}},

					{ text: 'Fax', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_fax fax="+1 100 458 2345" /]');
					}},

					{ text: 'Email', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_email emailid="yourname@somemail.com" /]');
					}},

					{ text: 'Web', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_web url="http://www.google.com" /]');
					}},
					
					{ text: 'Onlie Form', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_online_form url="http://www.google.com" /]');
					}},
					
				] },

				{ text : 'Donut Chart', menu:[

					{ text: 'Small', onclick: function(e) {
						e.stopPropagation();
						editor.insertContent('[dt_sc_donutchart_small title="Lorem" bgcolor="#808080" fgcolor="#4bbcd7" percent="70" /]');
					} },


					{ text: 'Medium', onclick: function(e) {
						e.stopPropagation();
						editor.insertContent('[dt_sc_donutchart_medium title="Lorem" bgcolor="#808080" fgcolor="#7aa127" percent="65" /]');
					} },


					{ text: 'Large', onclick: function(e) {
						e.stopPropagation();
						editor.insertContent('[dt_sc_donutchart_large title="Lorem" bgcolor="#808080" fgcolor="#a23b6f" percent="50" /]');
					} },
				] },

				{ text: 'Drop Cap',
					onclick: function( e ){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "dropcap"});
					}
				},

				{ text : 'Dividers', menu:[

					{ text: 'Clear', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_clear]');
					}},

					{ text: 'Bordered Horizontal Rule', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_border]');
					}},

					{ text: 'Horizontal Rule', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr]');
					}},

					{ text: 'Horizontal Rule Medium', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_medium]');
					}},

					{ text: 'Horizontal Rule Large', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_large]');
					}},

					{ text: 'Horizontal Rule with top link', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr top]');
					}},

					{ text: 'Whitespace', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible]');
					}},

					{ text: 'Whitespace Medium', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible_medium]');
					}},

					{ text: 'Whitespace Large', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible_large]');
					}},
				] },

				{ text: 'Icon Boxes', 
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "iconbox"});
					}
				},

				{ text : 'Lists', menu:[

					{ text:'Ordered List',
						onclick: function(e){
							e.stopPropagation();
							tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "orderedlist"});
					}},
					
					{ text:'Unordered List',
						onclick: function(e){
							e.stopPropagation();
							tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "unorderedlist"});
					}},
					
					{ text: 'Manual List 1', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_manual_list type="type1"]<br><ul><li>[dt_sc_box]1[/dt_sc_box]Sinus Attack!</li><li>[dt_sc_box]2[/dt_sc_box]Seasonal affective disorder</li> <li>[dt_sc_box]3[/dt_sc_box]Medicaid Eligibility</li></ul><br>[/dt_sc_manual_list]');
					}},
					
					{ text: 'Manual List 2', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_manual_list type="type2"]<br><ul><li>[dt_sc_box]1[/dt_sc_box]Sinus Attack!</li><li>[dt_sc_box]2[/dt_sc_box]Seasonal affective disorder</li> <li>[dt_sc_box]3[/dt_sc_box]Medicaid Eligibility</li></ul><br>[/dt_sc_manual_list]');
					}},
				] },

				{ text:'Pull Quote',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "pullquote"});
					}
				},

				{ text:'Pricing Table',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "pricingtable"});
					}
				},

				{
					text: 'Progress Bar',
					menu:[

						{ text:'Standard',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_progressbar value="85" type="standard" color="#9c59b6" textcolor=""] consectetur[/dt_sc_progressbar]');
							}
						},

						{ text:'Stripe',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_progressbar value="75" type="progress-striped" color="" textcolor=""] consectetur[/dt_sc_progressbar]');
							}
						},
						
						{ text:'Active', 
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_progressbar value="45" type="progress-striped-active"] consectetur[/dt_sc_progressbar]');
							}
						},
					]
				},

				{ text:'Info Graphics Bar',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "infographicbar"});
					}
				},

				{ text: 'Tabs',
					menu:[
						{ text:'Horizontal',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent("[dt_sc_tabs_horizontal]" + dummy_tabs + "[/dt_sc_tabs_horizontal]");
							}
						},
						{ text:'Vertical',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent("[dt_sc_tabs_vertical]" + dummy_tabs+ "[/dt_sc_tabs_vertical]");
							}
						},
					]
				},
				
				{ text:'Titled Box',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "box"});
					}
				},

				{ text: 'Toggle',
					menu:[
						{
							text: 'Default',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_toggle title="Toggle 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
										+'<br>[dt_sc_toggle title="Toggle 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
										+'<br>[dt_sc_toggle title="Toggle 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]");
							}
						},

						{
							text: 'Framed',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_toggle_framed title="Toggle 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
										+'<br>[dt_sc_toggle_framed title="Toggle 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
										+'<br>[dt_sc_toggle_framed title="Toggle 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]");
							}
						},
					]
				},

				{ text:'Tool tip',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "tooltip"});
					}
				},

				{ text:'Others',
					menu:[

						{ text:'Recent Posts',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_recent_post  count="2" column="2" read_more_text="Read More" excerpt_length="10"]');
							}
						},
						
						{ text:'Individual Post',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_post id="" excerpt_length="15" read_more_text="Read More"]');
							}
						},

						{ text:'3 Columns Portfolio Carousel',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_three_columns_portfolio  showposts="-1" categories=""]');
							}
						},

						{ text:'4 Columns Portfolio Carousel',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_four_columns_portfolio  showposts="-1" categories=""]');
							}
						},

						{ text:'Team',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_team name="DesignThemes" degree="MBBS" email="yourname@domain.com" role="Gastroenterologist" image="http://placehold.it/500" twitter="#" facebook="#" google="#" linkedin="#"]<br><p>Saleem naijar kaasram eerie can be disbursed in the wofl like of a fox that is her thing smaoasa lase lemedds laasd pamade eleifend sapien.</p>[/dt_sc_team]');
							}
						},

						{ text:'Testimonial',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent(testimonal);
							}
						},

						{ text:'Testimonial Carousel',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_testimonial_carousel]<br>'
									+'<ul>'
									+'<li>'+testimonal+'</li>'
									+'<li>'+testimonal+'</li>'
									+'<li>'+testimonal+'</li>'
									+'</ul>'
									+'<br>[/dt_sc_testimonial_carousel]');
							}
						}, 
					]
				}
			]
		});
		
	});
})();