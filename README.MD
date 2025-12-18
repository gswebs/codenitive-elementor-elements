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

For debugging, enable `WP_DEBUG` in `wp-config.php` and inspect `wp-content/debug.log` for PHP notices.

## Files to read first (fast onboarding)

- `codenitive-elementor-elements.php` — plugin header, registration hooks, style registration, and translations.
- `includes/widgets/marquee.php` — canonical widget: controls, style controls, `render()` output, `Repeater`, and `Group_Control_Image_Size` usage.
- `assets/css/marquee.css` — styling for the marquee widget. The bootstrap uses `filemtime()` for cache-busting when registering this file.

## Developer workflow

- Make changes to widget classes in `includes/widgets/`.
- If you add or change CSS, update `assets/css/*.css`. Note the plugin registers `codenitive-marquee` in the bootstrap; use `filemtime()` to refresh versions during development (or touch the file).
- Manual verification: enable the plugin in a local WP install, open a page in the Elementor editor and add the widget from the `Basic` category (example widget title: "Marquee 1").

Recommended quick commands (from macOS zsh, assuming repo placed in wp-content/plugins):

```bash
# restart php service if needed (example for brew php)
brew services restart php

# touch the css file to bump filemtime (forces new version)
touch wp-content/plugins/codenitive-elementor-elements/assets/css/marquee.css
```

## Project-specific patterns & gotchas

- Widget registration: the plugin hooks `elementor/widgets/register` in `codenitive-elementor-elements.php` and requires widget files, then calls `$widgets_manager->register( new \Codenit_Marquee_List_Widget() );`.
- Style registration: the main file registers style handle `'codenitive-marquee'` and enqueues it via `elementor/frontend/after_enqueue_styles`.
- Style-handle mismatch: `Codenit_Marquee_List_Widget::get_style_depends()` currently returns `['gmarquee-widget-style']`, but the plugin registers `'codenitive-marquee'`. To ensure Elementor auto-loads styles, pick one of:
	- Update `get_style_depends()` in the widget to return `['codenitive-marquee']`.
	- Or register an additional handle `'gmarquee-widget-style'` in the bootstrap.

Example fix (preferred): update the widget to return the registered handle:

```php
public function get_style_depends(): array {
		return [ 'codenitive-marquee' ];
}
```

- Textdomain mismatch: the bootstrap loads textdomain `'codenitive-elementor-elements'`, but the widget files use `__( ..., 'textdomain' )`. Prefer using the plugin textdomain (`codenitive-elementor-elements`) for new strings so translations load correctly.

## How to add a new widget

1. Create `includes/widgets/my-widget.php` with a class that extends `Elementor\Widget_Base`.
2. Implement `get_name()`, `get_title()`, `get_icon()`, `get_categories()`, `register_controls()`, and `render()` following `marquee.php` as a model.
3. Add a `require_once` for your file inside the `elementor/widgets/register` callback in `codenitive-elementor-elements.php` and call `$widgets_manager->register( new \My_Widget_Class() );`.
4. If your widget requires styles, either:
	- Return the style handle from `get_style_depends()` and register that handle in the bootstrap; or
	- Enqueue the style on `elementor/frontend/after_enqueue_styles`.

## Manual testing checklist

- Activate plugin and Elementor.
- Add the widget in Elementor editor and verify controls appear and `render()` produces expected HTML.
- Inspect front-end: ensure `assets/css/marquee.css` is loaded. If not, confirm handle names match.

## Troubleshooting

- If styles aren't loading: verify the registered handle in `codenitive-elementor-elements.php` matches what `get_style_depends()` returns in the widget class.
- If translations don't appear: make widget string calls use `codenitive-elementor-elements` textdomain and ensure `languages/` has proper .mo/.po files.

## Contributing

- Small, focused PRs are preferred (one widget or one bugfix per PR). In PR description include manual test steps (Elementor editor steps).

## License

This repository follows the plugin header license (GPL v2 or later).

