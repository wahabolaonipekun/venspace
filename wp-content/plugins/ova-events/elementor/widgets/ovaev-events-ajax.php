<?php
namespace ova_ovaev_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_events_ajax extends Widget_Base {

	public function get_name() {
		return 'ova_events_ajax';
	}

	public function get_title() {
		return esc_html__( 'Event Filter Ajax', 'ovaev' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'slick-script', OVAEV_PLUGIN_URI.'assets/libs/slick/slick/slick.min.js', array('jquery'), false, true );
		wp_enqueue_style( 'carousel', OVAEV_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'carousel', OVAEV_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		
		return [ 'script-elementor' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_setting',
			[
				'label' => esc_html__( 'Settings', 'ovaev' ),
			]
		);

		$this->add_control(
			'heading_setting_layout',
			[
				'label' => esc_html__( 'Layout', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Layout', 'ovaev'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1'     	=> esc_html__('Layout 1','ovaev'),
					'2'     	=> esc_html__('Layout 2','ovaev'),
				],
				'default' => '1',
			]
		);

		$this->add_responsive_control(
			'filter_align',
			[
				'label' => esc_html__( 'Alignment', 'ovaev' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'ovaev' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ovaev' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'ovaev' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .button-filter' => 'justify-content: {{VALUE}}',
				],
				'toggle' => false,
			]
		);


		$this->add_control(
			'heading_setting_post',
			[
				'label' => esc_html__( 'Setting Post', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'number_post',
			[
				'label' => esc_html__( 'Number Post', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 8,
			]
		);

		$this->add_control(
			'orderby_post',
			[
				'label' => esc_html__( 'OrderBy Post', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => esc_html__( 'Date', 'ovaev' ),
					'id'  => esc_html__( 'ID', 'ovaev' ),
					'title' => esc_html__( 'Title', 'ovaev' ),
				],
			]
		);

		$this->add_control(
			'order_post',
			[
				'label' => esc_html__( 'Order Post', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__( 'Ascending', 'ovaev' ),
					'DESC'  => esc_html__( 'Descending', 'ovaev' ),
				],
			]
		);

		$this->add_control(
			'exclude_cat',
			[
				'label' => esc_html__( 'Excluded Categories', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'ID category',
				'description' => 'ID category, example: 5, 7'
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label' => esc_html__( 'Show Filter', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ovaev' ),
				'label_off' => esc_html__( 'Hide', 'ovaev' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_all',
			[
				'label' => esc_html__( 'Show All', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ovaev' ),
				'label_off' => esc_html__( 'Hide', 'ovaev' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_featured',
			[
				'label' => esc_html__( 'Show Only Featured', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ovaev' ),
				'label_off' => esc_html__( 'Hide', 'ovaev' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'owl_margin',
			[
				'label' => esc_html__( 'Margin', 'evaev' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 30,
			]
		);

		$this->add_control(
			'owl_show_nav',
			[
				'label' => esc_html__( 'Show Nav', 'evaev' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);



		$this->add_control(
			'owl_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'evaev' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]

		);

		$this->add_control(
			'owl_autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed (ms)', 'evaev' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'owl_autoplay' => 'yes',
				],
				
			]
		);

		$this->add_control(
			'owl_loop',
			[
				'label' => esc_html__( 'Infinite Loop', 'evaev' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->add_control(
			'owl_lazyload',
			[
				'label' => esc_html__( 'Lazy Load', 'evaev' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'owl_nav_prev',
			[
				'label' => esc_html__( 'Class Nav Prev', 'evaev' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'arrow_carrot-left',
				'placeholder' => 'arrow_carrot-left'
			]
		);

		$this->add_control(
			'owl_nav_next',
			[
				'label' => esc_html__( 'Class Nav Next', 'evaev' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'arrow_carrot-right',
				'placeholder' => 'arrow_carrot-right'
			]
		);

		$this->add_control(
				'text_read_more',
				[
					'label'       => esc_html__( 'All Events Button', 'ovaev' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'See All Events', 'ovaev' ),
				]
			);

		$this->add_control(
				'show_read_more',
				[
					'label'        => esc_html__( 'Show All Events Button', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
				]
			);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_fillter',
			[
				'label' => esc_html__( 'Button Fillter', 'ovaev' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_filter_typo',
				'label' => esc_html__( 'Typography', 'ovaev' ),
				'selector' => '{{WRAPPER}} .ovapo_project_grid .button-filter button',
			]
		);

		$this->add_control(
			'button_filter_color',
			[
				'label' => esc_html__( 'Color', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .button-filter button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_filter_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .button-filter button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_filter_color_active',
			[
				'label' => esc_html__( 'Color Active', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .button-filter button.active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_filter_padding',
			[
				'label' => esc_html__( 'Padding', 'ovaev' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .button-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'ovaev' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_heading',
			[
				'label' => esc_html__( 'Background', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'item_background',
				'label' => esc_html__( 'Background', 'ovaev' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ovapo_project_grid .items',
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
			

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .content .items .item .desc .post_grid .event_title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Hover', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .content .items .item .desc .post_grid .event_title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'day_color',
			[
				'label' => esc_html__( 'Background day Color', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovapo_project_grid .content .items .item .desc .date-event' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
				
					'{{WRAPPER}} .ovapo_project_grid .content .items .item .desc .post_grid .time-event i ' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ovapo_project_grid .content .items .item .desc .post_grid .time-event svg ' => 'color: {{VALUE}}',
					
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Button Color', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .btn_grid .btn_grid_event' => 'color: {{VALUE}}',
				],
			]
		);
			$this->add_control(
			'AllEvent_color',
			[
				'label' => esc_html__( 'Hover Button Color', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .btn_grid .btn_grid_event:hover' => 'color: {{VALUE}};border-color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'nav_hover_bg_color',
			[
				'label' => esc_html__( 'Backgroud Color: Navigation Button Hover', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ovapo_project_slide .grid .owl-nav button:hover' => 'background-color: {{VALUE}}!important;border-color: {{VALUE}}!important;',
				],
			]
		);
			
		$this->add_control(
			'nav_hover_color',
			[
				'label' => esc_html__( 'Color: Navigation Button Hover', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ovapo_project_slide .grid .owl-nav button:hover i:before' => 'color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_control(
			'loading_color',
			[
				'label' => esc_html__( 'Color Loading', 'ovaev' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ovapo_project_grid .wrap_loader .loader circle' => 'stroke: {{VALUE}}!important;',
				],
			]
		);	

		$this->end_controls_section();

	}

	public function get_data_ajax() {
		$settings = $this->get_settings();
		
		//data post
		$number_post 	= $settings['number_post'];
		$order_post 	= $settings['order_post'];
		$orderby_post 	= $settings['orderby_post'];
		$show_all 		= $settings['show_all'];
		$show_featured 	= $settings['show_featured'];
		$show_filter 	= $settings['show_filter'];
		$exclude_cat 	= $settings['exclude_cat'];
		$text_read_more = $settings['text_read_more'];
        $show_read_more = $settings['show_read_more'];

        $cat_exclude = array(
			'exclude' => explode(", ",$exclude_cat), 
		);


		$terms 				= get_terms('event_category', $cat_exclude);
		$settings['terms'] 	= $terms;
		$count 				= count($terms);

		$term_id_filter 	= array();
		foreach ( $terms as $term ) {
			$term_id_filter[] = $term->term_id;
		}

		$term_id_filter_string = implode(", ", $term_id_filter);
		$first_term = '';
		if( $terms ){
			$first_term = $terms[0]->term_id;	
		}
		$settings['first_term'] 			= $first_term;
		$settings['term_id_filter_string'] 	= $term_id_filter_string;
		$settings['column'] 				= 1;
		
		$args_base = array(
			'post_type' 		=> 'event',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> $number_post,
			'order' 			=> $order_post,
			'orderby' 			=> $orderby_post,
		);


		/* Show Featured */
		if ($show_featured == 'yes') {
			$args_featured = array(
				'meta_key' => 'ovaev_special',
				'meta_query'=> array(
					array(
						'key' 		=> 'ovaev_special',
						'compare' 	=> '=',
						'value' 	=> 'checked',
					)
				)
			);
		} else {
			$args_featured = array();
		}

		if ($show_all !== 'yes' && $first_term != '' ) {
			$args_cat = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'event_category',
						'field'    => 'id',
						'terms'    => $first_term,
					)
				)
			);

			$args = array_merge_recursive($args_cat, $args_base, $args_featured);
			$event_posts = new \WP_Query( $args );

		} else {
			$args_cat = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'event_category',
						'field'    => 'id',
						'terms'    => $term_id_filter,
					)
				)
			);

			$args = array_merge_recursive($args_cat, $args_base, $args_featured);
			$event_posts = new \WP_Query( $args );
		}

		//data carousel
		$data_carousel = [
			'items'           => 3,
			'slideBy'		  => 1,
			'margin'          => $settings['owl_margin'],
			'dots'            => false,
			'nav'             => $settings['owl_show_nav'] === 'yes' ? true : false,
			'autoplay'        => $settings['owl_autoplay'] === 'yes' ? true : false,
			'autoplayTimeout' => $settings['owl_autoplay_speed'],
			'loop'            => $settings['owl_loop'] 	   === 'yes' ? true : false,
			'lazyLoad'        => $settings['owl_lazyload'] === 'yes' ? true : false,
			'mouseDrag'       => $my_posts->found_posts == 1 ? false : true,
			'navText' => [
				'<i class="'.$settings['owl_nav_prev'].'"></i>',
				'<i class="'.$settings['owl_nav_next'].'"></i>'
			],
			'responsive' => [
				'0'  	=> [
					'items'  => 1,
				],
				'768'  	=> [
					'items'  => 2,
				],
				'1024'  => [
					'items'  => 3,
				]
			]
		];

		$data = [
			'data_posts' 	=> $event_posts,
			'data_carousel' => $data_carousel,
			'settings' 		=> $settings,
		];

		return $data;
	}

	protected function render() {

		$settings = $this->get_data_ajax();

		$template = apply_filters( 'elementor_ovaev_ajax', 'elements/ovaev_events_ajax_content.php' );
		ob_start();
		ovaev_get_template( $template, $settings );
		echo ob_get_clean();
	}
}