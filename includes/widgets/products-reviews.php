<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'cpage';
    return $vars;
});

class CodeNit_All_Reviews_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'codenit_all_reviews';
	}

	public function get_title() {
		return __( 'WooCommerce All Reviews', 'codenitive' );
	}

	public function get_icon() {
		return 'eicon-comments';
	}
	
	public function get_style_depends(): array {
        return [ 'gproduct-reviews-style' ];
    }
    
    public function get_script_depends(): array {
    	return [ 'codenit-product-review-js' ];
    }

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'codenitive' ),
			]
		);

		$this->add_control(
			'reviews_per_page',
			[
				'label'   => __( 'Reviews Per Page', 'codenitive' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 1,
				'max'     => 50,
			]
		);
		
		$this->add_control(
        	'enable_read_more',
        	[
        		'label'        => __( 'Read More Toggle', 'codenitive' ),
        		'type'         => \Elementor\Controls_Manager::SWITCHER,
        		'label_on'     => __( 'Enable', 'codenitive' ),
        		'label_off'    => __( 'Disable', 'codenitive' ),
        		'return_value' => 'yes',
        		'default'      => 'yes',
        	]
        );
		
		$this->add_control(
        	'read_more_length',
        	[
        		'label'     => __( 'Read More Character Limit', 'codenitive' ),
        		'type'      => \Elementor\Controls_Manager::NUMBER,
        		'default'   => 160,
        		'min'       => 0,
        		'max'       => 1000,
        		'condition' => [
        			'enable_read_more' => 'yes',
        		],
        	]
        );
		
		$this->add_control(
            'show_header',
            [
                'label'        => __( 'Show Header', 'codenitive' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'codenitive' ),
                'label_off'    => __( 'Hide', 'codenitive' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->add_control(
            'default_sort',
            [
                'label'   => __( 'Default Sort Order', 'codenitive' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'newest',
                'options' => [
                    'newest' => __( 'Newest First', 'codenitive' ),
                    'oldest' => __( 'Oldest First', 'codenitive' ),
                    'rating_high' => __( 'Highest Rating', 'codenitive' ),
                    'rating_low'  => __( 'Lowest Rating', 'codenitive' ),
                ],
            ]
        );

		$this->add_control(
            'show_pagination',
            [
                'label'        => __( 'Pagination', 'codenitive' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'codenitive' ),
                'label_off'    => __( 'Hide', 'codenitive' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
            'header_style_start',
            [
                'label' => __( 'Header', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'header_text_color',
            [
                'label' => __( 'Text Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-review-count, {{WRAPPER}} .codenit-review-sort > *' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'header_background_color',
            [
                'label' => __( 'Background Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'header_text_typography',
                'selector' => '{{WRAPPER}} .codenit-review-count, {{WRAPPER}} .codenit-review-sort > *',
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'header_border',
                'selector' => '{{WRAPPER}} .codenit-reviews-header',
            ]
        );
        
        $this->add_responsive_control(
            'header_border_radius',
            [
                'label' => __( 'Border Radius', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-header' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __( 'Padding', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-header' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'header_margin',
            [
                'label' => __( 'Margin', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-header' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Review Box', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Columns', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-list' =>
                        'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_control(
            'auto_fit',
            [
                'label' => __( 'Auto Fit Columns', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description' => __( 'Automatically fit columns based on width', 'codenitive' ),
            ]
        );

        $this->add_responsive_control(
            'min_column_width',
            [
                'label' => __( 'Min Column Width', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'size' => 260,
                    'unit' => 'px',
                ],
                'condition' => [
                    'auto_fit' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-list' =>
                        'grid-template-columns: repeat(auto-fit, minmax({{SIZE}}{{UNIT}}, 1fr));',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'grid_gap',
            [
                'label' => __( 'Grid Gap', 'codenitive' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'default' => [
                    'size' => 24,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-reviews-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_control(
            'review_bg_color',
            [
                'label' => __( 'Background Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-review' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'review_padding',
            [
                'label' => __( 'Padding', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
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
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codenit-review' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'author_style_section',
            [
                'label' => __( 'Author', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'author_color',
            [
                'label' => __( 'Author Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-review__author' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'author_typography',
                'selector' => '{{WRAPPER}} .woocommerce-review__author',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'review_style_section',
            [
                'label' => __( 'Review', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'review_text_typography',
                'selector' => '{{WRAPPER}} .codenit-review .description',
            ]
        );
        
        $this->add_control(
            'star_color',
            [
                'label' => __( 'Star Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating span::before' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'star_bg_color',
            [
                'label' => __( 'Star Background Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating::before' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'rating_text_color',
            [
                'label' => __( 'Rating Text Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cstar-txt' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'date_style_section',
            [
                'label' => __( 'Date', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'date_color',
            [
                'label' => __( 'Date Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmeta' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'selector' => '{{WRAPPER}} .cmeta',
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'product_style_section',
            [
                'label' => __( 'Product', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'product_title_typography',
                'selector' => '{{WRAPPER}} .cproduct-title',
            ]
        );
        $this->add_control(
            'product_title_color',
            [
                'label' => __( 'Product Title Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-text a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'product_title_hover_color',
            [
                'label' => __( 'Product Title Hover Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-text a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'comment_style_section',
            [
                'label' => __( 'Comment', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'comment_typography',
                'selector' => '{{WRAPPER}} .cdescription',
            ]
        );
        $this->add_control(
            'comment_color',
            [
                'label' => __( 'Comment Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cdescription' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'pagination_style_section',
            [
                'label' => __( 'Pagination', 'codenitive' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'pagination_text_color',
            [
                'label' => __( 'Text Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers' =>
                        'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_color',
            [
                'label' => __( 'Hover Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers:hover' =>
                        'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_color',
            [
                'label' => __( 'Active Text Color', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers.current' =>
                        'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'pagination_active_bg',
            [
                'label' => __( 'Active Background', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers.current' =>
                        'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'pagination_typography',
                'selector' => '{{WRAPPER}} .codenit-pagination .page-numbers',
            ]
        );

        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label' => __( 'Item Spacing', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers' =>
                        'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'pagination_align',
            [
                'label' => __( 'Alignment', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'codenitive' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'codenitive' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'codenitive' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination' =>
                        'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => __( 'Padding', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'selector' => '{{WRAPPER}} .codenit-pagination .page-numbers',
            ]
        );
        
        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label' => __( 'Border Radius', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination .page-numbers' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'pagination_top_spacing',
            [
                'label' => __( 'Space Above Pagination', 'codenitive' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codenit-pagination' =>
                        'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


	}

	protected function render() {

		if ( ! function_exists( 'wc_placeholder_img_src' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		
		$show_pagination = ( isset( $settings['show_pagination'] ) && $settings['show_pagination'] === 'yes' );
		$enable_read_more = ( isset( $settings['enable_read_more'] ) && $settings['enable_read_more'] === 'yes' );
        $char_limit       = intval( $settings['read_more_length'] );
		
		$per_page = intval( $settings['reviews_per_page'] );
		$current_page = isset( $_GET['csort'] ) ? 1 : max( 1, get_query_var( 'cpage' ) );
		
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $current_page = 1;
        }

        $show_header = ( $settings['show_header'] ?? 'yes' ) === 'yes';

        $sort = isset( $_GET['csort'] )
            ? sanitize_text_field( $_GET['csort'] )
            : $settings['default_sort'];
        
        $order      = 'DESC';
        $orderby    = 'comment_date';
        $meta_key   = '';
        
        switch ( $sort ) {
            case 'oldest':
                $order = 'ASC';
                break;
        
            case 'rating_high':
                $orderby  = 'meta_value_num';
                $meta_key = 'rating';
                $order    = 'DESC';
                break;
        
            case 'rating_low':
                $orderby  = 'meta_value_num';
                $meta_key = 'rating';
                $order    = 'ASC';
                break;
        }

		/*$args = [
            'status'    => 'approve',
            'post_type' => 'product',
            'type'      => 'review',
            'number'    => $per_page,
            'offset'    => ( $current_page - 1 ) * $per_page,
            'orderby'   => $orderby,
            'order'     => $order,
        ];*/
        
        $args = [
            'status'    => 'approve',
            'post_type' => 'product',
            'type'      => 'review',
            'number'    => $per_page,
            'paged'     => $current_page,
            'orderby'   => $orderby,
            'order'     => $order,
        ];

        
        if ( $meta_key ) {
            $args['meta_key'] = $meta_key;
        }

        $args['meta_query'] = [
            [
                'key'     => 'rating',
                'compare' => 'EXISTS',
            ],
        ];

		$comments = get_comments( $args );

		$total = get_comments( [
            'status'    => 'approve',
            'post_type' => 'product',
            'type'      => 'review',
            'meta_query' => [
                [
                    'key'     => 'rating',
                    'compare' => 'EXISTS',
                ],
            ],
            'count' => true,
        ] );

		$max_pages = ceil( $total / $per_page );

		if ( ! $comments ) {
			echo '<p>' . esc_html__( 'No reviews found.', 'codenitive' ) . '</p>';
			return;
		}
        
		echo '<div class="codenit-products-reviews woocommerce-Reviews">';
		
		if ( $show_header ) :
        ?>
        <div class="codenit-reviews-header">
            <div class="codenit-review-count">
                <?php
                printf(
                    esc_html__( '%d Customer Reviews', 'codenitive' ),
                    intval( $total )
                );
                ?>
            </div>
        
            <form method="get" class="codenit-review-sort">
                <select name="csort" onchange="this.form.submit()">
                    <option value="newest" <?php selected( $sort, 'newest' ); ?>>
                        <?php esc_html_e( 'Newest', 'codenitive' ); ?>
                    </option>
                    <option value="oldest" <?php selected( $sort, 'oldest' ); ?>>
                        <?php esc_html_e( 'Oldest', 'codenitive' ); ?>
                    </option>
                    <option value="rating_high" <?php selected( $sort, 'rating_high' ); ?>>
                        <?php esc_html_e( 'Highest Rating', 'codenitive' ); ?>
                    </option>
                    <option value="rating_low" <?php selected( $sort, 'rating_low' ); ?>>
                        <?php esc_html_e( 'Lowest Rating', 'codenitive' ); ?>
                    </option>
                    <?php
                    foreach ( $_GET as $key => $value ) {
                        if ( ! in_array( $key, [ 'csort', 'cpage' ], true ) ) {
                            echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
                        }
                    }
                    ?>
                </select>
        
                <?php
                // Preserve pagination
                if ( isset( $_GET['cpage'] ) ) {
                    echo '<input type="hidden" name="cpage" value="' . esc_attr( $_GET['cpage'] ) . '">';
                }
                ?>
            </form>
        </div>
        <?php endif; 
        
		echo '<ul class="codenit-reviews-list">';

		foreach ( $comments as $comment ) {

			$product_id = $comment->comment_post_ID;
			$rating     = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
			$image      = get_the_post_thumbnail_url( $product_id, 'thumbnail' );
			
			$comment_text = wp_strip_all_tags( $comment->comment_content );
            $comment_len = function_exists( 'mb_strlen' )
                            ? mb_strlen( $comment_text )
                            : strlen( $comment_text );

            $short_text = function_exists( 'mb_substr' )
                        ? mb_substr( $comment_text, 0, $char_limit ) . '…'
                        : substr( $comment_text, 0, $char_limit ) . '…';
        
			static $product_cache = [];

            if ( ! isset( $product_cache[ $product_id ] ) ) {
                $product_cache[ $product_id ] = wc_get_product( $product_id );
            }
            
            $product = $product_cache[ $product_id ];

			if ( ! $image ) {
				$image = wc_placeholder_img_src();
			}
			?>
			<li class="codenit-review">
				<div class="comment_container">

					<?php /* ?><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
						<img src="<?php echo esc_url( $image ); ?>" class="avatar avatar-60" width="60" height="60">
					</a><?php */ ?>
					
					<div class="comment-head">
					    
					    <div class="cimg">
					        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <rect width="44" height="44" rx="22" fill="#ECF1EA"/>
                                <g clip-path="url(#clip0_1546_3343)">
                                <path d="M22 21C22.7911 21 23.5645 20.7654 24.2223 20.3259C24.8801 19.8864 25.3928 19.2616 25.6955 18.5307C25.9983 17.7998 26.0775 16.9956 25.9231 16.2196C25.7688 15.4437 25.3878 14.731 24.8284 14.1716C24.269 13.6122 23.5563 13.2312 22.7804 13.0769C22.0044 12.9225 21.2002 13.0017 20.4693 13.3045C19.7384 13.6072 19.1136 14.1199 18.6741 14.7777C18.2346 15.4355 18 16.2089 18 17C18 18.0609 18.4214 19.0783 19.1716 19.8284C19.9217 20.5786 20.9391 21 22 21ZM22 15C22.3956 15 22.7822 15.1173 23.1111 15.3371C23.44 15.5568 23.6964 15.8692 23.8478 16.2346C23.9991 16.6001 24.0387 17.0022 23.9616 17.3902C23.8844 17.7781 23.6939 18.1345 23.4142 18.4142C23.1345 18.6939 22.7781 18.8844 22.3902 18.9616C22.0022 19.0387 21.6001 18.9991 21.2346 18.8478C20.8692 18.6964 20.5568 18.44 20.3371 18.1111C20.1173 17.7822 20 17.3956 20 17C20 16.4696 20.2107 15.9609 20.5858 15.5858C20.9609 15.2107 21.4696 15 22 15Z" fill="#01311C"/>
                                <path d="M22 23C20.1435 23 18.363 23.7375 17.0503 25.0503C15.7375 26.363 15 28.1435 15 30C15 30.2652 15.1054 30.5196 15.2929 30.7071C15.4804 30.8946 15.7348 31 16 31C16.2652 31 16.5196 30.8946 16.7071 30.7071C16.8946 30.5196 17 30.2652 17 30C17 28.6739 17.5268 27.4021 18.4645 26.4645C19.4021 25.5268 20.6739 25 22 25C23.3261 25 24.5979 25.5268 25.5355 26.4645C26.4732 27.4021 27 28.6739 27 30C27 30.2652 27.1054 30.5196 27.2929 30.7071C27.4804 30.8946 27.7348 31 28 31C28.2652 31 28.5196 30.8946 28.7071 30.7071C28.8946 30.5196 29 30.2652 29 30C29 28.1435 28.2625 26.363 26.9497 25.0503C25.637 23.7375 23.8565 23 22 23Z" fill="#01311C"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_1546_3343">
                                <rect width="24" height="24" fill="white" transform="translate(10 10)"/>
                                </clipPath>
                                </defs>
                            </svg>
					    </div>
					    <div class="cauthor">
					        <strong class="woocommerce-review__author">
								<?php echo esc_html( $comment->comment_author ); ?>
							</strong>
					    </div>
					    <div class="ccheckmark">
					        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <rect width="16" height="16" rx="8" fill="#A0D549"/>
                                <g clip-path="url(#clip0_1546_3352)">
                                <path d="M6.92955 11C6.861 10.9997 6.79322 10.9854 6.73042 10.9579C6.66763 10.9304 6.61117 10.8902 6.56455 10.84L4.13455 8.25496C4.04372 8.15815 3.99506 8.02923 3.99928 7.89655C4.0035 7.76386 4.06025 7.63829 4.15705 7.54746C4.25386 7.45662 4.38278 7.40796 4.51546 7.41218C4.64815 7.4164 4.77372 7.47315 4.86455 7.56996L6.92455 9.76496L11.1296 5.16496C11.1722 5.11182 11.2253 5.06796 11.2856 5.03609C11.3458 5.00421 11.4119 4.98499 11.4798 4.97959C11.5478 4.9742 11.6161 4.98276 11.6806 5.00473C11.7451 5.02671 11.8045 5.06164 11.855 5.10738C11.9055 5.15312 11.9462 5.20871 11.9744 5.27073C12.0027 5.33275 12.0179 5.39989 12.0193 5.46802C12.0207 5.53616 12.0081 5.60386 11.9823 5.66696C11.9566 5.73006 11.9182 5.78723 11.8696 5.83496L7.29955 10.835C7.25338 10.8861 7.19711 10.9272 7.1343 10.9556C7.07149 10.984 7.00348 10.9991 6.93455 11H6.92955Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_1546_3352">
                                <rect width="12" height="12" fill="white" transform="translate(2 2)"/>
                                </clipPath>
                                </defs>
                            </svg>
					    </div>
					    
					</div>

					<div class="comment-text">
                        
                        <div class="cstar">
    						<div class="star-rating" role="img" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %d out of 5', 'codenitive' ), $rating ) ); ?>">
    							<span style="width:<?php echo esc_attr( ( $rating / 5 ) * 100 ); ?>%">
                                </span>
    						</div>
    						<div class="cstar-txt"><?php printf( esc_html__( 'Rated %d out of 5', 'codenitive' ), $rating ); ?></div>
						</div>
						
                        <h5 class="cproduct-title">
                            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
        						<?php echo esc_html( $product->get_name() ); ?>
        					</a>
    					</h5>
                        
						<p class="cmeta">
							<time>
								<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $comment->comment_date ) ) ); ?>
							</time>
						</p>

						<div class="cdescription<?php echo ( $enable_read_more && $comment_len > $char_limit ) ? '' : ' no-read-more'; ?>">
                            <div class="cdescription-text" data-short="<?php echo esc_attr( wp_strip_all_tags( $short_text ) ); ?>">
                                <?php echo wp_kses_post( wpautop( $short_text ) ); ?>
                            </div>
                            <?php if ( $enable_read_more && $comment_len > $char_limit ) : ?>
                                <div class="cdescription-full" style="display:none;">
                                    <?php echo wp_kses_post( wpautop( $comment->comment_content ) ); ?>
                                </div>
                                <a href="#" class="cdescription-toggle" data-more="Read more" data-less="Read less">
                                    <?php esc_html_e( 'Read more', 'codenitive' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>


					</div>
				</div>
			</li>
			<?php
		}

		echo '</ul>';
        
        if ( $show_pagination && $max_pages > 1 ) {
            echo '<div class="codenit-pagination">';
            echo paginate_links( [
                'base'      => add_query_arg( 'cpage', '%#%' ),
                'current'   => $current_page,
                'total'     => $max_pages,
                'prev_text' => __( '« Previous', 'codenitive' ),
                'next_text' => __( 'Next »', 'codenitive' ),
            ] );
            echo '</div>';
        }

		echo '</div>';
	}
}
