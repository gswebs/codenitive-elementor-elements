<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CodeNit_All_Reviews_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'codenit_all_reviews_carousel';
	}

	public function get_title() {
		return __( 'WooCommerce Reviews Carousel', 'codenitive' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	public function get_style_depends(): array {
		return [ 'swiper', 'gproduct-reviews-style' ];
	}

	public function get_script_depends(): array {
		return [ 'swiper', 'codenit-product-review-js' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'codenitive' ),
			]
		);

		$this->add_responsive_control(
			'slides_per_view',
			[
				'label' => __( 'Slides Per View', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'min' => 1,
				'max' => 6,
			]
		);

		$this->add_responsive_control(
        	'space_between',
        	[
        		'label' => __( 'Space Between', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::SLIDER,
        
        		'size_units' => [ 'px' ],
        
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 1000,
        				'step' => 1,
        			],
        		],
        
        		'default' => [
        			'size' => 24,
        			'unit' => 'px',
        		],
        
        		'tablet_default' => [
        			'size' => 16,
        			'unit' => 'px',
        		],
        
        		'mobile_default' => [
        			'size' => 12,
        			'unit' => 'px',
        		],
        	]
        );

		$this->add_control(
			'reviews_count',
			[
				'label' => __( 'Reviews Count', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 1,
				'max' => 50,
			]
		);

		$this->add_control(
			'show_navigation',
			[
				'label' => __( 'Navigation Arrows', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_centered_slides',
			[
				'label' => __( 'Centered Slides', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_responsive_control(
        	'center_scale',
        	[
        		'label' => __( 'Side Slide Scale', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::NUMBER,
        
        		'min' => 0.1,
        		'max' => 1,
        		'step' => 0.01,
        
        		'default' => 0.88,
        		'tablet_default' => 0.84,
        		'mobile_default' => 0.8,
        
        		'condition' => [
        			'show_centered_slides' => 'yes',
        		],
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-slide-prev .codenit-review,
        			 {{WRAPPER}} .swiper-slide-next .codenit-review' =>
        				'transform: scale({{VALUE}});',
        		],
        	]
        );
        
        $this->add_responsive_control(
        	'far_slide_scale',
        	[
        		'label' => __( 'Far Slide Scale', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::NUMBER,
        
        		'min' => 0.1,
        		'max' => 1,
        		'step' => 0.01,
        
        		'default' => 0.75,
        
        		'condition' => [
        			'show_centered_slides' => 'yes',
        		],
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-slide:not(.swiper-slide-active):not(.swiper-slide-prev):not(.swiper-slide-next) .codenit-review' =>
        				'transform: scale({{VALUE}});',
        		],
        	]
        );

		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'Pagination Dots', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'enable_read_more',
			[
				'label' => __( 'Read More Toggle', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_length',
			[
				'label' => __( 'Read More Character Limit', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 160,
				'condition' => [
					'enable_read_more' => 'yes',
				],
			]
		);
		
		$this->add_control(
        	'show_all_reviews_button',
        	[
        		'label' => __( 'Show Button', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::SWITCHER,
        		'return_value' => 'yes',
        		'default' => '',
        	]
        );
        
        $this->add_control(
        	'all_reviews_button_text',
        	[
        		'label' => __( 'Button Text', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::TEXT,
        		'default' => __( 'See All Reviews', 'codenitive' ),
        		'placeholder' => __( 'See All Reviews', 'codenitive' ),
        
        		'condition' => [
        			'show_all_reviews_button' => 'yes',
        		],
        	]
        );
        
        $this->add_control(
        	'all_reviews_button_link',
        	[
        		'label' => __( 'Button Link', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::URL,
        
        		'placeholder' => 'https://',
        
        		'options' => [ 'url', 'is_external', 'nofollow' ],
        
        		'default' => [
        			'url' => '',
        			'is_external' => false,
        			'nofollow' => false,
        		],
        
        		'condition' => [
        			'show_all_reviews_button' => 'yes',
        		],
        	]
        );
        
        $this->add_responsive_control(
        	'all_reviews_button_align',
        	[
        		'label' => __( 'Button Alignment', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::CHOOSE,
        
        		'options' => [
        			'left' => [
        				'title' => __( 'Left', 'codenitive' ),
        				'icon' => 'eicon-text-align-left',
        			],
        
        			'center' => [
        				'title' => __( 'Center', 'codenitive' ),
        				'icon' => 'eicon-text-align-center',
        			],
        
        			'right' => [
        				'title' => __( 'Right', 'codenitive' ),
        				'icon' => 'eicon-text-align-right',
        			],
        		],
        
        		'default' => 'center',
        
        		'selectors' => [
        			'{{WRAPPER}} .codenit-review-button-wrap' =>
        				'text-align: {{VALUE}};',
        		],
        
        		'condition' => [
        			'show_all_reviews_button' => 'yes',
        		],
        	]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Review Box', 'codenitive' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'review_bg_color',
			[
				'label' => __( 'Background Color', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codenit-review' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'review_padding',
			[
				'label' => __( 'Padding', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .codenit-review' =>
						'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'review_border',
				'selector' => '{{WRAPPER}} .codenit-review',
			]
		);

		$this->add_responsive_control(
			'review_border_radius',
			[
				'label' => __( 'Border Radius', 'codenitive' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .codenit-review' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
        	'pagination_style_section',
        	[
        		'label' => __( 'Pagination', 'codenitive' ),
        		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        
        		'condition' => [
        			'show_pagination' => 'yes',
        		],
        	]
        );
        
        $this->add_responsive_control(
        	'pagination_spacing',
        	[
        		'label' => __( 'Top Spacing', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::SLIDER,
        
        		'size_units' => [ 'px' ],
        
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 200,
        			],
        		],
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination' =>
        				'margin-top: {{SIZE}}{{UNIT}};',
        		],
        	]
        );
        
        $this->add_control(
        	'pagination_dot_size',
        	[
        		'label' => __( 'Dot Size', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::SLIDER,
        
        		'size_units' => [ 'px' ],
        
        		'range' => [
        			'px' => [
        				'min' => 4,
        				'max' => 30,
        			],
        		],
        
        		'default' => [
        			'size' => 10,
        			'unit' => 'px',
        		],
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination-bullet' =>
        				'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        		],
        	]
        );
        
        $this->add_control(
        	'pagination_gap',
        	[
        		'label' => __( 'Dots Gap', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::SLIDER,
        
        		'size_units' => [ 'px' ],
        
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 40,
        			],
        		],
        
        		'default' => [
        			'size' => 8,
        			'unit' => 'px',
        		],
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination-bullet' =>
        				'margin: 0 {{SIZE}}{{UNIT}} !important;',
        		],
        	]
        );
        
        $this->add_control(
        	'pagination_color',
        	[
        		'label' => __( 'Dot Color', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::COLOR,
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination-bullet' =>
        				'background: {{VALUE}};',
        		],
        	]
        );
        
        $this->add_control(
        	'pagination_active_color',
        	[
        		'label' => __( 'Active Dot Color', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::COLOR,
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination-bullet-active' =>
        				'background: {{VALUE}};',
        		],
        	]
        );
        
        $this->add_control(
        	'pagination_opacity',
        	[
        		'label' => __( 'Inactive Opacity', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::NUMBER,
        
        		'min' => 0.1,
        		'max' => 1,
        		'step' => 0.01,
        
        		'default' => 0.88,
        		'tablet_default' => 0.84,
        		'mobile_default' => 0.8,
    
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination-bullet' =>
        				'opacity: {{SIZE}};',
        		],
        	]
        );
        
        $this->add_control(
        	'pagination_active_width',
        	[
        		'label' => __( 'Active Dot Width', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::SLIDER,
        
        		'size_units' => [ 'px' ],
        
        		'range' => [
        			'px' => [
        				'min' => 6,
        				'max' => 60,
        			],
        		],
        
        		'default' => [
        			'size' => 28,
        			'unit' => 'px',
        		],
        
        		'selectors' => [
        			'{{WRAPPER}} .swiper-pagination-bullet-active' =>
        				'width: {{SIZE}}{{UNIT}}; border-radius: 999px;',
        		],
        	]
        );
        
        $this->end_controls_section();
		
		$this->start_controls_section(
        	'button_style_section',
        	[
        		'label' => __( 'Button', 'codenitive' ),
        		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        
        		'condition' => [
        			'show_all_reviews_button' => 'yes',
        		],
        	]
        );
        
        $this->add_control(
        	'button_text_color',
        	[
        		'label' => __( 'Text Color', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::COLOR,
        
        		'selectors' => [
        			'{{WRAPPER}} .codenit-review-button' =>
        				'color: {{VALUE}};',
        		],
        	]
        );
        
        $this->add_control(
        	'button_background_color',
        	[
        		'label' => __( 'Background Color', 'codenitive' ),
        		'type' => \Elementor\Controls_Manager::COLOR,
        
        		'selectors' => [
        			'{{WRAPPER}} .codenit-review-button' =>
        				'background-color: {{VALUE}};',
        		],
        	]
        );
        
        $this->add_group_control(
        	\Elementor\Group_Control_Typography::get_type(),
        	[
        		'name' => 'button_typography',
        
        		'selector' => '{{WRAPPER}} .codenit-review-button',
        	]
        );
        
        $this->add_responsive_control(
        	'button_padding',
        	[
        		'label' => __( 'Padding', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::DIMENSIONS,
        
        		'selectors' => [
        			'{{WRAPPER}} .codenit-review-button' =>
        				'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );
        
        $this->add_responsive_control(
        	'button_border_radius',
        	[
        		'label' => __( 'Border Radius', 'codenitive' ),
        
        		'type' => \Elementor\Controls_Manager::DIMENSIONS,
        
        		'selectors' => [
        			'{{WRAPPER}} .codenit-review-button' =>
        				'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );
        
        $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$reviews_count = intval( $settings['reviews_count'] );

		$args = [
			'status'    => 'approve',
			'post_type' => 'product',
			'type'      => 'review',
			'number'    => $reviews_count,
			'orderby'   => 'comment_date',
			'order'     => 'DESC',
			'meta_query' => [
				[
					'key'     => 'rating',
					'compare' => 'EXISTS',
				],
			],
		];

		$comments = get_comments( $args );

		if ( empty( $comments ) ) {
			echo '<p>' . esc_html__( 'No reviews found.', 'codenitive' ) . '</p>';
			return;
		}

		$uid = 'codenit-swiper-' . $this->get_id();

		?>
		
		<div
			id="<?php echo esc_attr( $uid ); ?>"
			class="codenit-swiper swiper"
			data-desktop="<?php echo esc_attr( $settings['slides_per_view'] ); ?>"
			data-tablet="<?php echo esc_attr( $settings['slides_per_view_tablet'] ?? 2 ); ?>"
			data-mobile="<?php echo esc_attr( $settings['slides_per_view_mobile'] ?? 1 ); ?>"
			data-space-desktop="<?php echo esc_attr( $settings['space_between']['size'] ?? 24 ); ?>"
            data-space-tablet="<?php echo esc_attr( $settings['space_between_tablet']['size'] ?? 16 ); ?>"
            data-space-mobile="<?php echo esc_attr( $settings['space_between_mobile']['size'] ?? 12 ); ?>"
			data-loop="<?php echo esc_attr( $settings['loop'] === 'yes' ? 'true' : 'false' ); ?>"
			data-autoplay="<?php echo esc_attr( $settings['autoplay'] === 'yes' ? 'true' : 'false' ); ?>"
			data-centered_slides="<?php echo esc_attr( $settings['show_centered_slides'] === 'yes' ? 'true' : 'false' ); ?>"
		>

			<div class="swiper-wrapper">

				<?php foreach ( $comments as $comment ) :

					$product_id = $comment->comment_post_ID;

					$product = wc_get_product( $product_id );

					if ( ! $product ) {
						continue;
					}

					$rating = intval(
						get_comment_meta(
							$comment->comment_ID,
							'rating',
							true
						)
					);

					$comment_text = wp_strip_all_tags(
						$comment->comment_content
					);

					$char_limit = intval(
						$settings['read_more_length']
					);

					$short_text = mb_substr(
						$comment_text,
						0,
						$char_limit
					) . '...';

					?>

					<div class="swiper-slide">

						<div class="codenit-review">

                            <div class="review-top">
                        
                                <div class="review-product-image">
                                    <?php echo $product->get_image( 'thumbnail' ); ?>
                                </div>
                        
                                <div class="review-top-content">
                        
                                    <h5 class="cproduct-title">
                                        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                                            <?php echo esc_html( $product->get_name() ); ?>
                                        </a>
                                    </h5>
                        
                                    <div class="cstar">
                                        <div
                                            class="star-rating"
                                            role="img"
                                            aria-label="<?php echo esc_attr( sprintf( __( 'Rated %d out of 5', 'codenitive' ), $rating ) ); ?>"
                                        >
                                            <span style="width:<?php echo esc_attr( ( $rating / 5 ) * 100 ); ?>%"></span>
                                        </div>
                                    </div>
                        
                                </div>
                        
                            </div>
                        
                            <div class="review-content">
                        
                                <div class="cdescription">
                                    <?php echo wp_kses_post( wpautop( $short_text ) ); ?>
                                </div>
                        
                                <div class="comment-head">
                                    <span class="woocommerce-review__author">
                                        <?php echo esc_html( $comment->comment_author ); ?>
                                    </span>
                                </div>
                        
                            </div>
                        
                        </div>

					</div>

				<?php endforeach; ?>

			</div>

			<?php if ( $settings['show_pagination'] === 'yes' ) : ?>
				<div class="swiper-pagination"></div>
			<?php endif; ?>

			<?php if ( $settings['show_navigation'] === 'yes' ) : ?>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			<?php endif; ?>

            <?php if ( 'yes' === $settings['show_all_reviews_button'] ) :

            	$link = $settings['all_reviews_button_link'];
            
            	$target = ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
            
            	$nofollow = ! empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
            
            	?>
            
            	<div class="codenit-review-button-wrap">
            
            		<a
            			class="codenit-review-button"
            			href="<?php echo esc_url( $link['url'] ); ?>"
            			<?php echo $target; ?>
            			<?php echo $nofollow; ?>
            		>
            
            			<?php echo esc_html( $settings['all_reviews_button_text'] ); ?>
            
            		</a>
            
            	</div>
            
            <?php endif; ?>

		</div>

		<?php
	}
}