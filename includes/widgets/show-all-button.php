<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;

class Codenit_Elementor_ShowAll extends Widget_Base {

    public function get_name() {
        return 'codenit-showall';
    }

    public function get_title() {
        return __( 'Show All Button', 'gs-elementor' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'show all', 'button', 'woocommerce', 'icon', 'link' ];
    }

    protected function register_controls() {

        /* ================= CONTENT ================= */
        $this->start_controls_section(
            'section_content',
            [ 'label' => __( 'Content', 'gs-elementor' ) ]
        );

        $this->add_control(
            'text',
            [
                'label'   => __( 'Text', 'gs-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Show All', 'gs-elementor' ),
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'icon_only',
            [
                'label'        => __( 'Icon Only', 'gs-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dynamic_wc_link',
            [
                'label'   => __( 'WooCommerce Dynamic Link', 'gs-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''            => __( 'None', 'gs-elementor' ),
                    'shop'        => __( 'Shop Page', 'gs-elementor' ),
                    'current_cat' => __( 'Current Product Category', 'gs-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => __( 'Custom Link', 'gs-elementor' ),
                'type'      => Controls_Manager::URL,
                'default'   => [ 'url' => '#' ],
                'condition' => [ 'dynamic_wc_link' => '' ],
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'        => __( 'Show Icon', 'gs-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     => __( 'Icon', 'gs-elementor' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [ 'show_icon' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        /* ================= STYLE ================= */
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Button', 'gs-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Text & background
        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => __( 'Button Background', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_text_color',
            [
                'label'     => __( 'Hover Text Color', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall:hover .codenit-showall-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_bg_color',
            [
                'label'     => __( 'Hover Background', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .codenit-showall-text',
            ]
        );

        // Button padding & border
        $this->add_responsive_control(
            'padding',
            [
                'label'     => __( 'Padding', 'gs-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units'=> [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .codenit-showall',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'     => __( 'Border Radius', 'gs-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* ================= ICON STYLE ================= */
        $this->add_control(
            'icon_heading',
            [
                'label' => __( 'Icon', 'gs-elementor' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'gs-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall-icon i,
                     {{WRAPPER}} .codenit-showall-icon svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'     => __( 'Icon Padding', 'gs-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'     => __( 'Icon Border Radius', 'gs-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Icon colors & background
        $this->start_controls_tabs( 'icon_colors' );

        $this->start_controls_tab(
            'icon_normal',
            [ 'label' => __( 'Normal', 'gs-elementor' ) ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall-icon i'   => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .codenit-showall-icon svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label'     => __( 'Icon Background', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .codenit-showall-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover',
            [ 'label' => __( 'Hover', 'gs-elementor' ) ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __( 'Icon Hover Color', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall:hover .codenit-showall-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .codenit-showall:hover .codenit-showall-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => __( 'Icon Hover Background', 'gs-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-showall:hover .codenit-showall-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border_hover',
                'selector' => '{{WRAPPER}} .codenit-showall:hover .codenit-showall-icon',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'icon_hover_animation',
            [
                'label'   => __( 'Icon Hover Animation', 'gs-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'   => __( 'None', 'gs-elementor' ),
                    'slide'  => __( 'Slide Right', 'gs-elementor' ),
                    'rotate' => __( 'Rotate', 'gs-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => __( 'Icon Position', 'gs-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'right',
                'options' => [
                    'left'  => [ 'icon' => 'eicon-h-align-left' ],
                    'right' => [ 'icon' => 'eicon-h-align-right' ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $link = $settings['link'];

        // WooCommerce dynamic links
        if ( $settings['dynamic_wc_link'] === 'shop' && function_exists( 'wc_get_page_permalink' ) ) {
            $link['url'] = wc_get_page_permalink( 'shop' );
        }

        if ( $settings['dynamic_wc_link'] === 'current_cat' && is_product_category() ) {
            $term = get_queried_object();
            if ( $term && ! is_wp_error( $term ) ) {
                $link['url'] = get_term_link( $term );
            }
        }

        if ( empty( $link['url'] ) ) return;

        $this->add_render_attribute( 'button', 'class', 'codenit-showall' );
        $this->add_link_attributes( 'button', $link );

        if ( $settings['icon_hover_animation'] !== 'none' ) {
            $this->add_render_attribute(
                'button',
                'class',
                'hover-' . esc_attr( $settings['icon_hover_animation'] )
            );
        }

        $direction = ( $settings['icon_position'] === 'left' ) ? 'row-reverse' : 'row';
        $this->add_render_attribute( 'button', 'style', "flex-direction: {$direction}; display:inline-flex; align-items:center; gap:5px; text-decoration:none; transition:all .3s;" );
        ?>

        <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
            <?php if ( $settings['icon_only'] !== 'yes' ) : ?>
                <span class="codenit-showall-text"><?php echo esc_html( $settings['text'] ); ?></span>
            <?php endif; ?>

            <?php if ( $settings['show_icon'] === 'yes' && ! empty( $settings['icon']['value'] ) ) : ?>
                <span class="codenit-showall-icon" style="display:inline-flex; align-items:center; justify-content:center; transition:all .3s;">
                    <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
            <?php endif; ?>
        </a>
        <?php
    }
}
