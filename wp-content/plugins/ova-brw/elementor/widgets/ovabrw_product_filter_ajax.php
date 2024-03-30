<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_filter_ajax extends Widget_Base {

	public function get_name() {
		return 'ovabrw_product_filter_ajax';
	}

	public function get_title() {
		return esc_html__( 'Product Filter Ajax', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-gallery-justified';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'carousel', OVABRW_PLUGIN_URI.'assets/libs/carousel/owl.carousel.min.css' );
		wp_enqueue_script( 'carousel', OVABRW_PLUGIN_URI.'assets/libs/carousel/owl.carousel.min.js', array('jquery'), false, true );
  		return [ 'script-elementor' ];
	}

  	
	protected function register_controls() {

		$this->start_controls_section(
			'section_product',
			[
				'label' => esc_html__( 'Product', 'ova-brw' ),
			]
		);  

			$this->add_control(
				'show_on_sale',
				[
					'label' 		=> esc_html__( 'Only Show On Sale Products', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'No', 'ova-brw' ),
					'default' 		=> 'no',
				]
			);

            $this->add_control(
				'posts_per_page',
				[
					'label'   => esc_html__( 'Products Per Category', 'ova-brw' ),
					'type'    => Controls_Manager::NUMBER,
					'min'     => 1,
					'default' => 4
				]
			);

			$this->add_control(
				'product_orderby',
				[
					'label' => esc_html__( 'Order By', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'ID',
					'options' => [
						'ID'  => esc_html__( 'ID', 'ova-brw' ),
						'title'   => esc_html__( 'Title', 'ova-brw' ),
						'date'    => esc_html__( 'Date', 'ova-brw' ),
					],
				]
			);

			$this->add_control(
				'product_order',
				[
					'label' => esc_html__( 'Order', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'ASC'  => esc_html__( 'Ascending', 'ova-brw' ),
						'DESC'  => esc_html__( 'Descending', 'ova-brw' ),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category',
			[
				'label' => esc_html__( 'Category Filter', 'ova-brw' ),
			]
		);     

			$this->add_control(
				'filter_title',
				[
					'label'   => esc_html__( 'Filter Titlte', 'ova-brw' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Popular Categories', 'ova-brw' ),
				]
			);  

			$this->add_control(
				'catAll',
				[
					'label'   => esc_html__( 'Text All', 'ova-brw' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'All', 'ova-brw' ),
				]
			);  

            $args = array(
				'taxonomy' 	=> 'product_cat',
				'orderby' => 'name',
				'order' => 'ASC'
			);
  
		  	$categories   = get_categories($args);
		  	$cate_array   = array();
		  	$arrayCateAll = array( 'all' => esc_html__( 'All categories', 'ova-brw' ) );
		  	if ($categories) {
			  	foreach ( $categories as $cate ) {
				  	$cate_array[$cate->slug] = $cate->name;
			  	}
		  	} else {
			  	$cate_array[ esc_html__( 'No content Category found', 'ova-brw' ) ] = 0;
		  	}

			$this->add_control(
				'categories',
				[
					'label' => esc_html__( 'Categories', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => array_merge( $arrayCateAll, $cate_array ),
					'default' => 'all'
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'ID',
					'options' => [
						'ID'  => esc_html__( 'ID', 'ova-brw' ),
						'title'   => esc_html__( 'Title', 'ova-brw' ),
						'date'    => esc_html__( 'Date', 'ova-brw' ),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label' => esc_html__( 'Order', 'ova-brw' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'ASC',
					'options' => [
						'ASC'  => esc_html__( 'Ascending', 'ova-brw' ),
						'DESC'  => esc_html__( 'Descending', 'ova-brw' ),
					],
				]
			);

		$this->end_controls_section();

        /*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options Slider', 'ova-brw' ),
			]
		);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'ova-brw' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'ova-brw' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'ova-brw' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'ova-brw' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'false',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'ova-brw' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'false',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'ova-brw' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'ova-brw' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 1000,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'ova-brw' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'dots_control',
				[
					'label'   => esc_html__( 'Show Dots', 'ova-brw' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'ova-brw' ),
						'no'  => esc_html__( 'No', 'ova-brw' ),
					],
					'frontend_available' => true,
				]
			);


		$this->end_controls_section();
		/****************************  END SECTION ADDITIONAL *********************/


		/****************************  SECTION TAB STYLE CATEGORY *********************/
		$this->start_controls_section(
			'style_section_category',
			[
				'label' => esc_html__( 'Category Filter', 'ova-brw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);		

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'category_label_typography',
					'selector' => '{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button',
				]
			);

			$this->start_controls_tabs('style_category_tabs');

				$this->start_controls_tab(
					'style_normal_category_tab',
					[
						'label' => esc_html__( 'Normal', 'ova-brw' ),
					]
				);
			
					$this->add_control(
						'label_category_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'label_category_bgcolor',
						[
							'label' => esc_html__( 'Background Color', 'ova-brw' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button' => 'background-color : {{VALUE}};',
							],
						]
					);

				
				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_hover_category_tab',
					[
						'label' => esc_html__( 'Hover', 'ova-brw' ),
					]
				);

					$this->add_control(
						'label_category_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button:hover' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'label_category_bgcolor_hover',
						[
							'label' => esc_html__( 'Background Color', 'ova-brw' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button:hover' => 'background-color : {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_active_category_tab',
					[
						'label' => esc_html__( 'Active', 'ova-brw' ),
					]
				);

					$this->add_control(
						'label_category_color_active',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button.active-category' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'label_category_bgcolor_active',
						[
							'label' => esc_html__( 'Background Color', 'ova-brw' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-filter-ajax ul li.product-filter-button.active-category' => 'background-color : {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'category_title_heading',
				[
					'label' => esc_html__( 'Filter Title', 'ova-brw' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'category_title_typography',
						'selector' => '{{WRAPPER}} .ova-product-filter-ajax ul li.filter-title',
					]
				);

				$this->add_control(
					'category_title_color',
					[
						'label' => esc_html__( 'Color', 'ova-brw' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-product-filter-ajax ul li.filter-title' => 'color : {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'category_title_line_color',
					[
						'label' => esc_html__( 'Line Color', 'ova-brw' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-product-filter-ajax ul li.filter-title:after' => 'background-color : {{VALUE}};',
						],
					]
				);

				$this->add_responsive_control(
					'category_title_margin',
					[
						'label' 	 => esc_html__( 'Margin', 'ova-brw' ),
						'type' 		 => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors'  => [
							'{{WRAPPER}} .ova-product-filter-ajax ul li.filter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
	
		$template = apply_filters( 'ovabrw_ft_element_product_filter_ajax', 'single/product_filter_ajax.php' );

		ob_start();
		ovabrw_get_template( $template, $settings );
		echo ob_get_clean();
		
	}
}