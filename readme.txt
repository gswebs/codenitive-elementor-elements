=== Elementor Elements by Codenitive ===
Contributors: gurjitsingh
Donate link: https://codenitive.com
Tags: elementor, widgets, marquee, image, design, woocommerce, reviews
Requires at least: 5.6
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A small collection of custom Elementor widgets and styles to extend Elementor with a marquee image-list and WooCommerce product reviews widget.

== Description ==

Elementor Elements by Codenitive adds lightweight, focused widgets for Elementor.  

The current release includes:
* A marquee/image-list widget with repeating items, responsive sizing, style controls, and optional auto-scrolling.
* A WooCommerce product reviews widget with pagination, sorting, and customizable styles.

This plugin follows a minimal bootstrap pattern: the main plugin file `codenitive-elementor-elements.php` registers widget classes located in `includes/widgets/` and frontend CSS in `assets/css/`.

== Installation ==

1. Upload the entire `codenitive-elementor-elements` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Ensure the Elementor plugin is installed and active.
4. Edit a page with Elementor and add the widget (category: Basic, title: "Marquee 1" or "WooCommerce All Reviews").

== Frequently Asked Questions ==

= Why don't my styles load on the front-end? =
If the widget's `get_style_depends()` returns a different handle than the one registered in the plugin bootstrap, Elementor may not auto-load the CSS. Confirm the handles match (default registered handle for marquee: `codenitive-marquee`; for reviews: `gproduct-reviews-style`).

= How do I change the marquee speed or direction? =
Open the widget in the Elementor editor, toggle "Enable Marquee," then set the "Speed (seconds)" and "Direction" controls.

= Can I customize review display? =
Yes, the WooCommerce reviews widget allows:
* Number of reviews per page
* Default sort order (newest, oldest, highest rating, lowest rating)
* Pagination, header display, and read more toggle
* Styling for review boxes, authors, stars, product titles, comments, dates, and pagination

== Screenshots ==

1. Widget controls in the Elementor editor (Repeater + style controls).
2. Front-end marquee output with duplicated items for seamless looping.
3. WooCommerce reviews widget with header, sorting, and paginated reviews.

== Changelog ==

= 1.0.3 =
* Added the link option in the Marquee 1 widget items
* Added the new widget name Show All Button to link the sections to their related pages.

= 1.0.2 =
* Added WooCommerce product reviews widget

= 1.0.1 =
* Added marquee direction options: Top to Bottom and Bottom to Top

= 1.0.0 =
* Initial release: marquee/image-list widget, style registration, and textdomain loading

== Upgrade Notice ==

= 1.0.3 =
* Added the link option in the Marquee 1 widget items
* Added the new widget name Show All Button to link the sections to their related pages.