# Elementor Elements by Codenitive

A small WordPress plugin that provides custom Elementor widgets and styling helpers.

## Summary

This repository registers one or more Elementor widgets (canonical example: a marquee/image-list widget) and its frontend styles. The plugin bootstrap is in `codenitive-elementor-elements.php`. Widgets live in `includes/widgets/` and styles in `assets/css/`.

## Requirements

- WordPress (tested up to 6.5)
- Elementor plugin (runtime dependency)
- PHP 7.4+ (plugin header requirement)

## Installation (local development)

1. Copy the repo folder into your WordPress `wp-content/plugins/` directory.
2. Activate the plugin from the WP Admin > Plugins page (name: "Elementor Elements by Codenitive").
3. Ensure the **Elementor** plugin is active.

## Changelog

- 1.0.0
 Initial release: marquee/image-list widget, style registration, and textdomain loading.

## Upgrade Notice

- 1.0.1
Added the Marqee:
1. Top to Bottom
2. Bottom to Top

- 1.0.0
Initial release. No upgrade steps required.