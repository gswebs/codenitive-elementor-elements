# Elementor Elements by Codenitive

A small WordPress plugin that provides custom Elementor widgets and styling helpers.

## Summary

This plugin registers one or more Elementor widgets (current example: a marquee/image-list widget) along with its frontend styles.  

- **Bootstrap file:** `codenitive-elementor-elements.php`  
- **Widgets:** `includes/widgets/`  
- **Styles:** `assets/css/`

The plugin follows a minimal and modular design, allowing easy extension for future widgets.

## Requirements

- WordPress 5.6+ (tested up to 6.5)  
- Elementor plugin (runtime dependency)  
- PHP 7.4+  

## Installation (Local Development)

1. Copy the repository folder into your WordPress `wp-content/plugins/` directory.  
2. Activate the plugin from **WP Admin > Plugins** (name: "Elementor Elements by Codenitive").  
3. Ensure the **Elementor** plugin is active.  
4. Edit a page with Elementor and add the widget (category: Basic, title: "Marquee 1").  

## Features

- Marquee/Image-list widget with:  
  - Repeating items for seamless looping  
  - Responsive sizing and styling options  
  - Optional auto-scrolling mode with configurable speed and direction  

- WooCommerce Reviews widget (if WooCommerce is installed) with:  
  - Paginated reviews  
  - Sorting (newest, oldest, rating-based)  
  - Header and style controls  

## Changelog

### 1.0.2
- Added WooCommerce product reviews widget

### 1.0.1
- Added marquee direction options: Top to Bottom, Bottom to Top

### 1.0.0
- Initial release: marquee/image-list widget, style registration, and textdomain loading

## Upgrade Notice

- 1.0.2: Adds WooCommerce reviews widget. No migration needed.  
- 1.0.1: Adds marquee direction options. No migration needed.  
- 1.0.0: Initial release. No upgrade steps required.  
