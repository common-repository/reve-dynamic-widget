=== Reve Dynamic Widget ===
Stable tag:		1.7.0
Tags:			widget, text widget, html widget, php widget
Requires PHP:		5.6
Requires at least:	4.0
Tested up to:		5.6.0
Contributors:		promostudio
Donate link:		https:promostudio.es/support-revedw
License:		GPL2
License URI:		http://www.gnu.org/licenses/gpl-2.0.html


Add any text, HTML, CSS, Javascript and/or PHP code, and show it in the pages you want.


== Description ==

Reve Dynamic Widget is a extended WordPress text widget that evaluates any content type (text, HTML, Javascript, PHP or shortcodes) and shows it in the posts and pages you want.

It is totally free, very light-weight, fast, easy to use and versatile.

This plugin is translation ready (pot file included) and translated to spanish. Translations to other languages are welcome.


== Editor features ==

1. The "Show title" option allows you to show or hide the widget title in the frontend.
2. As the core text widget, you can format the content with the "Add paragraphs automatically" option.
3. You can enter only text as content, or any HTML, CSS, Javascript and/or PHP code.
4. Also you can enter any shortcode that you normally use in your posts or pages.
5. Activate the "Evaluate content with PHP" option to enable the PHP interpreter.


== Filter options ==

* Show or hide the widget by template options: show in front page, blog page, posts, pages, archive, search and error pages.
* Use the "Exclude posts or pages" option to hide the widget in certain posts or pages, when show in post and/or in pages are activated.


== To insert PHP code ==

* PHP code must be correct and used within the open and close PHP tags: `<?php` and `?>`.

* Note that any PHP code is executed in the scope of a PHP function, but you can do almost everything that you can do with PHP. So only administrators with PHP knowledges must use this feature.

* This plugin uses the native PHP `eval()` function with the error control operator `@`, to prevent error messages and broken pages. So if you don't see your PHP output it is probably because your code have mistakes.

* And don't forget to activate the "Evaluate with PHP" option, that is disabled by default. 


== Installation ==

1. Download "reve-dynamic-widget" to the "/wp-content/plugins/" directory of your site.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Go to Appearance > Widgets and insert it in any sidebar of your theme.


== Screenshots ==

1. The widget admin interface (screenshot-1.png).


== Need help? ==

* For help use the [WordPress Support](https://wordpress.org/support/plugin/reve-dynamic-widget/).
* Also you can [write a review](https://wordpress.org/support/plugin/reve-dynamic-widget/reviews/#new-post).


== Contribute development ==

* [If you like this plugin, give us a five stars rating clicking here.](https://wordpress.org/support/plugin/reve-dynamic-widget/reviews/)

* [If you make this plugin profitable, give us any Paypal donation clicking here.](http://www.promostudio.es/support-revedw)


== Changelog ==

= 1.7.0 =
* Added the Show in front page filter.
* Added version control.
* Tested with WordPress 5.6.

= 1.6.0 =
* Fixed a bug when used with Elementor Page Builder.
* Improved options validation.

= 1.0.0 =
* 2017-04-26: Initial release.


== Upgrade Notice ==

= 1.0.0 =
* Launch of the initial stable version.