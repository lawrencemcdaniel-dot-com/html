=== Turbo Widgets ===
Contributors: toddhalfpenny
Donate link: https://datamad.co.uk/donate/
Tags: widgets, widgets in page, widgets in post, sidebar, pages, post, shortcode, inline, widgetise, widgetize, theme, tinymce
Requires at least: 2.8
Tested up to: 4.8.2
Stable tag: 2.0.0

The easiest way to add Widgets or Sidebars to Posts and Pages through the WYSIWYG or shortcodes. Or add them to your theme through template tags.

== Description ==

The easiest way to add Widgets or Sidebars to Posts and Pages through the WYSIWYG or shortcodes. Or add them to your theme through template tags.

What can you do with this plugin?

* Add Widgets and _Turbo Sidebars_ to your posts and pages content, inline.
* Widgets can be inserted through the WYSIWYG editor or shortcodes.
* Widgets can also be included to your theme via template tags.
* [Pro version](http://turbowidgets.net/pro) supports WYSIWYG editing of widgets and karma points.

**How to**

* When writing a post or page click the "Add New Widget" button in the editor
* Enter the config params (such as Title)
* Click Insert
* That's it... nothing else is needed, you have a Widget in your page


**Demo Video**

https://www.youtube.com/watch?v=5A4NPtzsPU8

**Recent Reviews**

**&#8727; &#8727; &#8727; &#8727; &#8727;**  Handy and Dandy! Thank you so much for this awesome plugin! - [@type-historian](https://wordpress.org/support/topic/handy-and-dandy/)

**&#8727; &#8727; &#8727; &#8727; &#8727;** Has the potential to be one of the best Plugins ever - [@drachsi](https://wordpress.org/support/topic/has-the-potential-to-be-one-of-the-best-plugins-ever/)


== Installation ==

1. Install via the 'Plugins' admin screen or upload the turbo-widgets folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. To insert a widget into a paste or a page use the new 'Add a widget' WYSIWYG editor button
1. If you want to add "Sidebars" to your posts or pages first create a new "Turbo Sidebar" via the 'Appearance'->'Turbo Sidebars' screen. This can then be added via a shortcode (copied from the admin screen once your 'Turbo Sidebar' has been saved)
1. Turbo Sidebars can also be used through template tags such as `<?php turbo_sidebar_tt(['p'=>48]); ?>` in your templates. In this example *48* is the ID of the Turbo Sidebar as noted in the admin screen.

== Frequently Asked Questions ==

= Is there any more documentation? =

Absolutely. Check it out [on our official site](http://turbowidgets.net/docs).

= Why are some widgets unsupported? =

Widgets might be unsupported if they do not support standard methods, as per the [codex](https://codex.wordpress.org/Widgets_API). There can also be issue with widgets that use JavaScript in their config screens. Please let us know if you run into any.

= Can I have more than one defined sidebar area =

Yes... you can have an unlimited number of sidebars defined. The number available can be administered via the settings menu.

== Screenshots ==

1. Add A Widget button available in the standard WordPress editor

2. Widgets can also be added through Turbo Sidebars (can be many widgets) and then inserts using shortcode tags or in your theme's templates.

3. An example Shortcode Tag

4. An example Teamplate Tag in a theme file.


== Changelog ==

= 2.0.0 =

1. Re-written to use WordPress Plugin Boiler Plate structure
1. Incorporating Freemius
1. Bugfix - Support for Widgets that weren't built through extending WP_Widget (such as those in the Atahualpa theme)
1. Bugfix - Better handling of default Widgets' checkboxes.


= 1.0.5 =

Catching of Widgets that were built with the Admin Page Framework - sadly there's a conflict with the Widget form rendering - this release means that the Turbo Widgets will continue to work even if widgets built with this framework are in use. Note though that these widgets cannot be used with Turbo Widgets (though work for this in ongoing).


= 1.0.4 =

Better Handling of unsupported Widgets; now show notification. Widgets might be unsupported if the do not extend WP_Widget or do not support standard methods (as per codex)


= 1.0.3 =

Fix issue where widgets not extending WP_Widget caused the admin screens to not sure widget options.


= 1.0.2 =

Fix issue where image edit toolbar was being disabled.


= 1.0.1 =

Fix issue with WordPress 4.3.X compatibility.


= 1.0.0 =

1st release


== Upgrade Notice ==

= 2.0.0 =

* Minor bug-fixes, but major re-write
* Existing Turbo Widgets should be migrated automatically, without issue.
