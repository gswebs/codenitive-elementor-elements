=== Elementor Elements by Codenitive ===
Contributors: gurjitsingh
Donate link: https://codenitive.com
Tags: elementor, widgets, marquee, image, design
Requires at least: 5.6
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A small collection of custom Elementor widgets and styles to extend Elementor with a marquee image-list and related controls.

== Description ==

Elementor Elements by Codenitive adds lightweight, focused widgets for Elementor. The current release provides a marquee/image-list widget that supports repeating items, responsive sizing, style controls, and an optional marquee (auto-scrolling) mode.

This plugin follows a minimal bootstrap pattern: the plugin file `codenitive-elementor-elements.php` registers widget classes located in `includes/widgets/` and frontend CSS in `assets/css/`.

== Installation ==

1. Upload the entire `codenitive-elementor-elements` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Ensure the Elementor plugin is installed and active.
4. Edit a page with Elementor and add the widget (category: Basic, title: "Marquee 1").

== Frequently Asked Questions ==

= Why don't my styles load on the front-end? =
If the widget's `get_style_depends()` returns a different handle than the one registered in the plugin bootstrap, Elementor may not auto-load the CSS. Confirm the handles match (default registered handle: `codenitive-marquee`).

= How do I change the marquee speed or direction? =
Open the widget in the Elementor editor, toggle "Enable Marquee", then set the "Speed (seconds)" and "Direction" controls.

== Screenshots ==

1. Widget controls in the Elementor editor (Repeater + style controls).
2. Front-end marquee output with duplicated items for seamless looping.

== Changelog ==

= 1.0.0 =
* Initial release: marquee/image-list widget, style registration, and textdomain loading.

== Upgrade Notice ==

= 1.0.1 =
Added the Marqee:
Top to Bottom
Bottom to Top

= 1.0.0 =
Initial release. No upgrade steps required.

== Notes for Developers ==

- Bootstrap file: `codenitive-elementor-elements.php` registers widgets and styles and loads the plugin textdomain `codenitive-elementor-elements`.
- Widgets: add new widget classes under `includes/widgets/` and register them in the `elementor/widgets/register` callback.
- Styling: CSS files are registered using `filemtime()` for cache-busting. When editing CSS locally, update file mtime (for example, `touch assets/css/marquee.css`) to force reload.

If you contribute, please open small focused PRs and include manual verification steps (Elementor editor steps to add and test the widget).
