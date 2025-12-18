<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit;

class Codenit_Marquee_List_Widget extends Widget_Base {

    public function get_name() {
        return 'gmarquee_widget';
    }

    public function get_title() {
        return __( 'Marquee 1', 'textdomain' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return [ 'basic' ];
    }
    
    public function get_style_depends(): array {
        return [ 'gmarquee-widget-style' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'List Items', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'textdomain' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __( 'Title', 'textdomain' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'List Item', 'textdomain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'textdomain' ),
                'type'  => Controls_Manager::TEXTAREA,
                'rows'  => 3,
            ]
        );

        $this->add_control(
            'items',
            [
                'label'       => __( 'Items', 'textdomain' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'marquee_section',
            [
                'label' => __( 'Marquee Settings', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'enable_marquee',
            [
                'label'        => __( 'Enable Marquee', 'textdomain' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => 'Yes',
                'label_off'    => 'No',
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        
        $this->add_control(
            'marquee_direction',
            [
                'label'     => __( 'Direction', 'textdomain' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'rtl',
                'options'   => [
                    'reverse' => __( 'Right to Left', 'textdomain' ),
                    'normal' => __( 'Left to Right', 'textdomain' ),
                ],
                'condition' => [
                    'enable_marquee' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'marquee_speed',
            [
                'label'     => __( 'Speed (seconds)', 'textdomain' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 15,
                'min'       => 5,
                'max'       => 60,
                'condition' => [
                    'enable_marquee' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Marquee Item Style', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'item_size',
            [
                'label' => __( 'Item Size', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => ['min' => 5, 'max' => 100],
                    'px' => ['min' => 50, 'max' => 600],
                ],
                'default' => ['size' => 20, 'unit' => '%'],
                'selectors' => [
                    '{{WRAPPER}} .codenit-marquee-item' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'item_bg_color',
            [
                'label' => __( 'Background Color', 'textdomain' ),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-marquee-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'textdomain' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-marquee-item' =>
                        'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => __( 'Item Padding', 'textdomain' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-marquee-item' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label' => __( 'Item Gap', 'textdomain' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-marquee' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'item_image',
                'default' => 'medium',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( empty( $settings['items'] ) ) {
            return;
        }
        
        $enable_marquee = $settings['enable_marquee'] === 'yes';
        $direction      = $settings['marquee_direction'] ?? 'normal';
        $speed          = $settings['marquee_speed'] ?? 15;
        $item_size = $settings['item_size'] ?? [
            'size' => 20,
            'unit' => '%',
        ];
        
        $size = $item_size['size'] ?? 20;
        $unit = $item_size['unit'] ?? '%';
        
        $classes = [ 'elementor-image-list' ];
        
        if ( $enable_marquee ) {
            $classes[] = 'is-marquee';
            $classes[] = 'codenit-marquee-' . esc_attr( $direction );
            $classes[] = 'codenit-marquee';
        }
        
        ?>
        <div class="codenit-marquee-wrapper">
            <ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
                style="--marquee-speed: <?php echo esc_attr( $speed ); ?>s; --direction: <?php echo esc_attr( $direction ); ?>; --item-width: <?php echo esc_attr( $size ); ?><?php echo esc_attr( $unit ); ?>
;">
                
                <?php foreach ( $settings['items'] as $item ) : ?>
                    <li class="codenit-marquee-item elementor-image-list-item">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'item_image', 'image' ); ?>
                        <span><?php echo esc_html( $item['title'] ); ?></span>
                    </li>
                <?php endforeach; ?>
        
                <?php if ( $enable_marquee ) : ?>
                    <!-- Duplicate for seamless loop -->
                    <?php foreach ( $settings['items'] as $item ) : ?>
                        <li aria-hidden="true" class="codenit-marquee-item elementor-image-list-item">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'item_image', 'image' ); ?>
                            <span><?php echo esc_html( $item['title'] ); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
        
            </ul>
        </div>
        <?php
    }
}
