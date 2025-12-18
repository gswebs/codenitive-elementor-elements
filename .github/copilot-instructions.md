<!-- .github/copilot-instructions.md - guidance for AI coding agents -->
# Copilot instructions — Codenitive Elementor Elements

Purpose: Help an AI agent become productive quickly when editing or extending this WordPress Elementor plugin.

1) Big picture
- **Type:** A small WordPress plugin that registers custom Elementor widgets.
- **Bootstrap:** `codenitive-elementor-elements.php` — plugin header, hooks, widget registration, style registration, and textdomain loading.
- **Widget implementations:** `includes/widgets/*.php` (example: `marquee.php`) contain classes that extend `Elementor\Widget_Base` and implement controls + render logic.
- **Assets:** `assets/css/` contains styles (e.g. `marquee.css`) registered via `wp_register_style` in the main plugin file.

2) Key files to read first
- `codenitive-elementor-elements.php` — plugin bootstrap, hook attachment points, style registration, and localization.
- `includes/widgets/marquee.php` — canonical example of an Elementor widget (controls, style controls, `render()` output, use of `Repeater`, and `Group_Control_Image_Size`).
- `assets/css/marquee.css` — visual rules used by the widget and registered via `wp_register_style`.

3) Project-specific patterns and quirks (use these to avoid regressions)
- Widget registration: main file listens to `elementor/widgets/register` and requires the widget PHP file, then registers `new \Codenit_Marquee_List_Widget()` with the `$widgets_manager`.
- Style registration: stylesheet is registered with handle `'codenitive-marquee'` in the bootstrap and enqueued on `elementor/frontend/after_enqueue_styles`.
- Important mismatch to watch for: `Codenit_Marquee_List_Widget::get_style_depends()` returns `['gmarquee-widget-style']` while the plugin registers `'codenitive-marquee'`. When adding or editing styles, keep handles consistent (either change `get_style_depends()` or register the same handle) — otherwise Elementor may not auto-load the CSS.
- Text domain inconsistencies: widget files use `__( ..., 'textdomain' )` while bootstrap uses `'codenitive-elementor-elements'`. Prefer the plugin textdomain (`codenitive-elementor-elements`) when adding new strings so translations load correctly.

4) How to run and debug locally (minimal steps)
- Install a local WordPress (LocalWP, Docker, or MAMP) and activate the **Elementor** plugin.
- Copy this repo to `wp-content/plugins/` and activate `Elementor Elements by Codenitive` in WP Admin.
- Enable `WP_DEBUG` in `wp-config.php` and check `debug.log` in `wp-content` for PHP notices.
- To verify styles reload after editing `assets/css/marquee.css` the plugin uses `filemtime()` for versioning in `wp_register_style` — ensure the file's mtime changes or bump version manually.

5) How to add a new widget (step-by-step)
- Create `includes/widgets/my-widget.php` with a class that extends `Elementor\Widget_Base`.
- Mirror patterns in `marquee.php`: `get_name()`, `get_title()`, `get_icon()`, `get_categories()`, `register_controls()`, `render()`.
- Add `require_once plugin_dir_path( __FILE__ ) . 'includes/widgets/my-widget.php';` inside the anonymous callback hooked to `elementor/widgets/register` in `codenitive-elementor-elements.php` and register with `$widgets_manager->register( new \My_Widget_Class() );`.
- If your widget needs CSS, either return its style handle from `get_style_depends()` and register that handle in the bootstrap, or enqueue the style in `elementor/frontend/after_enqueue_styles` directly — keep handles consistent.

6) Integration points & dependencies
- Runtime dependency: the plugin requires the **Elementor** plugin (check `plugins_loaded` / `did_action('elementor/loaded')`).
- PHP compat: plugin header says `Requires PHP: 7.4` — prefer writing compatible PHP for 7.4+. Use typed return types only where safe.

7) Tests / build / conventions
- There is no automated test or build system in this repo. Changes are validated manually by enabling the plugin in a WP + Elementor environment.
- Coding conventions: follow the existing style (procedural bootstrap file + class files in `includes/widgets/`). Keep file and class names consistent with the current pattern (prefix `Codenit_` and snake-style file names).

8) Example snippets for quick reference
- Widget registration (from `codenitive-elementor-elements.php`):

```php
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/widgets/marquee.php';
    $widgets_manager->register( new \Codenit_Marquee_List_Widget() );
});
```

- Style registration uses `filemtime()` for cache-busting:

```php
wp_register_style(
    'codenitive-marquee',
    $css_url,
    [],
    file_exists( $css_path ) ? filemtime( $css_path ) : '1.0.0'
);
```

9) When to open PRs vs small commits
- Small, focused PRs are preferred (one widget / one bugfix at a time). Include a brief manual test procedure in the PR description (pages/Elementor editor steps to verify).

10) Questions for the repo owner
- Which textdomain should be canonical for translations? (current plugin: `codenitive-elementor-elements`, widget files use `textdomain`).
- Should `get_style_depends()` handles be aligned to the registered style handle, or should we register multiple handles? State a canonical strategy and I'll follow it in edits.

If anything above is unclear or you want me to expand a section (examples for adding controls, a style-handle migration patch, or an automated QA checklist), tell me which part to iterate on.
