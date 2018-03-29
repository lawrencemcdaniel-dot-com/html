(function() {
     tinymce.create('tinymce.plugins.doodleicons', {
          init : function(ed, url) {



	var doodleicons = [
		'address-book', 'amazon', 'anchor', 'android', 'angellist', 'apple', 'appstore', 'archive', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'atom', 'award-star', 'awards-cup', 'balloon', 'bar-chart', 'battery-full', 'battery-low', 'beer', 'bicycle', 'blackberry', 'block', 'blogger', 'bomb', 'bookmark', 'boombox', 'boy', 'briefcase', 'browser', 'brush', 'bug', 'calculator', 'calendar', 'camera', 'chart-growth', 'chart-pie', 'chat', 'check', 'checklist', 'chicken', 'chrome', 'clockwise', 'closing-tag', 'cloud', 'coffee', 'competition', 'counterclockwise', 'creativemarket', 'credit-card', 'crown', 'css3', 'cupcake', 'diamond', 'direction', 'directions', 'download', 'dribble', 'drink', 'dumbbell', 'email', 'etsy', 'exchange', 'export', 'eye', 'facebook', 'factory', 'female', 'file', 'file-download', 'file-upload', 'fir-tree', 'firefox', 'flag', 'flickr', 'flow-tree', 'flower', 'folder', 'fonts', 'football', 'fork-spoon', 'foursquare', 'free', 'fruit', 'game-console', 'gauge', 'gear', 'gift', 'github', 'globe', 'google-plus', 'googleplay', 'graduation', 'head-exclamation-mark', 'head-idea', 'head-question', 'headphones', 'heart', 'home', 'horseshoe', 'hotdog', 'html5', 'icecream', 'ie', 'image', 'info', 'instagram', 'itunes', 'key', 'keyboard', 'kickstarter', 'lab', 'label', 'leaf', 'lifebuoy', 'lightbulb', 'lightning', 'link', 'linkedin', 'linux', 'location', 'lock', 'luggage', 'magic-wand', 'magnet', 'mail', 'male', 'man', 'map-location', 'microscope', 'mobile', 'money', 'moon', 'mouse', 'music-notes', 'new', 'open', 'opening-tag', 'opera', 'palm-tree', 'paperbox', 'paperclip', 'paperplane', 'paypal', 'pencil', 'phone', 'picasa', 'picture', 'pin', 'pinterest', 'plane', 'play', 'plus', 'podcasts', 'power', 'print', 'profile', 'promote', 'pulse', 'question-mark', 'quotes', 'radiation', 'rain', 'record', 'reddit', 'ribbon', 'robot', 'rocket', 'rss', 'ruler', 'safari', 'sale', 'sale2', 'scales', 'scissors', 'screen', 'screwdriver', 'search', 'settings', 'share', 'shipping', 'shopping-bag', 'shoppingcart', 'siringe', 'skype', 'sliders', 'smiley-happy', 'sneaker', 'snow', 'soccer', 'sound', 'soundcloud', 'speech-bubbles', 'spotify', 'star', 'steam', 'stumbleupon', 'sun', 'sync-cycle-repeat', 'tablet', 'tea', 'temperature', 'thumbs-down', 'thumbs-up', 'ticket', 'time-alarm', 'time-clock', 'time-hourglass', 'tools', 'traffic-cone', 'trash', 'tree', 'trumpet', 'tumblr', 'tv', 'twitter', 'umbrella', 'unlocked', 'user', 'user-profile', 'users', 'valentine', 'video', 'vimeo', 'vine', 'whatsapp', 'wifi', 'wikipedia', 'wind', 'windows', 'wine', 'woman', 'wrench', 'yinyang', 'youtube'
	];

	function showDialog() {
		var gridHtml, x, y, win;

		function getParentTd(elm) {
			while (elm) {
				if (elm.nodeName == 'TD') {
					return elm;
				}

				elm = elm.parentNode;
			}
		}

		gridHtml = '<table role="presentation" cellspacing="0" class="mce-doodleicons"><tbody>';

		var width = 14;
		for (y = 0; y < 17; y++) {
			gridHtml += '<tr>';

			for (x = 0; x < width; x++) {
				if ( (y * width + x) < 235) {
					var chr = doodleicons[y * width + x];
					gridHtml += '<td title="' + chr + '"><div tabindex="-1" title="' + chr + '" role="button"><i class="icon-' +
					(chr ? chr : '&nbsp;') + '"></i></div></td>';
				}
				else {
					gridHtml += '<td>&nbsp;</td>';
				}
			}

			gridHtml += '</tr>';
		}

		gridHtml += '</tbody></table>';

		var doodleiconsPanel = {
			type: 'container',
			html: gridHtml,
			onclick: function(e) {
				var target = e.target;

				if (target.tagName == 'I') {
					target = target.parentNode;
				}

				if (target.tagName == 'TD') {
					target = target.firstChild;
				}

				if (target.tagName == 'DIV') {
					ed.selection.setContent('[doodle_icon]'+target.innerHTML+'[/doodle_icon]');

					if (!e.ctrlKey) {
						win.close();
					}

				}
			},
			onmouseover: function(e) {
				var td = getParentTd(e.target);

				if (td) {
					jQuery('.doodle_icon_preview').html( td.firstChild.innerHTML );
				}
			}
		};

		win = ed.windowManager.open({
			title: "Doodle icons",
			spacing: 10,
			padding: 10,
			items: [
				doodleiconsPanel,
				{
					type: 'container',
					name: 'preview',
					html: '<div class="doodle_icon_preview"></div>',
					style: 'font-size: 40px; text-align: center',
					border: 1,
					minWidth: 100,
					minHeight: 80
				}
			],
			buttons: [
				{text: "Close", onclick: function() {
					win.close();
				}}
			]
		});
	}

	ed.addButton('doodleicons', {
		icon: 'doodleicons',
		tooltip: 'Doodle icons',
		onclick: showDialog
	});

	ed.addMenuItem('doodleicons', {
		icon: 'doodleicons',
		text: 'Doodle icons',
		onclick: showDialog,
		context: 'insert'
	});




          },
          createControl : function(n, cm) {
               return null;
          },
     });
     tinymce.PluginManager.add( 'doodleicons', tinymce.plugins.doodleicons );
})();


