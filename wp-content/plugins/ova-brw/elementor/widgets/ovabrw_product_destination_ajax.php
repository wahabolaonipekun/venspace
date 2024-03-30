<?php namespace ovabrw_product_elementor\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_destination_ajax extends \Elementor\Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_destination_ajax';
	}

	public function get_title() {
		return esc_html__( 'Product Destination Ajax', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-products-archive';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'ova-brw' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

			$this->add_control(
				'auto_sorted',
				[
					'label' 		=> esc_html__( 'Auto Sorted', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'No', 'ova-brw' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$args_destination = $defaults_destination = [];

			$args = array(
	            'post_type'         => 'destination',
	            'post_status'       => 'publish',
	            'posts_per_page'    => -1,
	            'orderby'           => 'ID',
	            'order'             => 'DESC',
	            'fields'            => 'ids'
	        );

	        $destinations = get_posts( $args );

	        if ( $destinations && is_array( $destinations ) ) {
	            foreach ( $destinations as $k => $destination_id ) {
	                $destination_title = get_the_title( $destination_id );
	                $args_destination[$destination_id] = $destination_title;

	                if ( $k < 3 ) {
	                	$defaults_destination[] = $destination_id;
	                }
	            }
	        }

			$this->add_control(
				'destinations',
				[
					'label' 	=> esc_html__( 'Destinations', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT2,
					'multiple' 	=> true,
					'options' 	=> $args_destination,
					'default' 	=> $defaults_destination,
					'condition' => [
						'auto_sorted' => [ 'yes' ]
					]
				]
			);

			$this->add_control(
				'destination_ids',
				[
					'label' 		=> esc_html__( 'Destination IDs', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=> implode( '|', $defaults_destination ),
					'placeholder' 	=> esc_html__( '1|2|3', 'ova-brw' ),
					'description' 	=> esc_html__( 'Destination IDs are separated by "|"', 'ova-brw' ),
					'condition' 	=> [
						'auto_sorted' => ''
					]
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label' 	=> esc_html__( 'Posts per page', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> -1,
					'default' 	=> 9
				]
			);

			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__( 'Order', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'DESC',
					'options' 	=> [
						'ASC' 	=> esc_html__( 'Ascending', 'ova-brw' ),
						'DESC'  => esc_html__( 'Descending', 'ova-brw' ),
					]
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' 	=> esc_html__( 'OrderBy', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'date',
					'options' 	=> [
						'date' 		=> esc_html__( 'Date', 'ova-brw' ),
						'ID'  		=> esc_html__( 'ID', 'ova-brw' ),
						'title'  	=> esc_html__( 'title', 'ova-brw' ),
						'rand'  	=> esc_html__( 'rand', 'ova-brw' )
					]
				]
			);

			$this->add_control(
				'layout',
				[
					'label' 	=> esc_html__( 'Layout', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'grid',
					'options' 	=> [
						'grid' 	=> esc_html__( 'Grid', 'ova-brw' ),
						'list' 	=> esc_html__( 'List', 'ova-brw' )
					]
				]
			);

			$this->add_control(
				'column',
				[
					'label' 	=> esc_html__( 'Column', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'column3',
					'options' 	=> [
						'column2'  	=> esc_html__( '2 Column', 'ova-brw' ),
						'column3'  	=> esc_html__( '3 Column', 'ova-brw' ),
						'column4'  	=> esc_html__( '4 Column', 'ova-brw' ),
					],
					'condition' => [
						'layout' 	=> 'grid'
					]
				]
			);

			$this->add_control(
				'thumbnail_type',
				[
					'label' 	=> esc_html__( 'Thumbnail', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'image',
					'options' 	=> [
						'image' 	=> esc_html__( 'Image', 'ova-brw' ),
						'gallery' 	=> esc_html__( 'Gallery', 'ova-brw' ),
					]
				]
			);

			$this->add_control(
				'pagination',
				[
					'label' 		=> esc_html__( 'Pagination', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'ova-brw' ),
					'label_off' 	=> esc_html__( 'Hide', 'ova-brw' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes'
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_destination',
			[
				'label' => esc_html__( 'Destination', 'ova-brw' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'destination_item_typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item',
				]
			);

			$this->start_controls_tabs(
				'destination_item_tabs'
			);

				$this->start_controls_tab(
					'destination_item_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'ova-brw' ),
					]
				);

					$this->add_control(
						'item_color',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'item_background_color',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'destination_item_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'ova-brw' ),
					]
				);

					$this->add_control(
						'item_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'item_background_color_hover',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item:hover' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'destination_item_active_tab',
					[
						'label' => esc_html__( 'Active', 'ova-brw' ),
					]
				);

					$this->add_control(
						'item_color_active',
						[
							'label' => esc_html__( 'Color', 'ova-brw' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item.active' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'item_background_color_active',
						[
							'label' => esc_html__( 'Background', 'ova-brw' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item.active' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'item_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before'
				]
			);

			$this->add_responsive_control(
				'item_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'item_border',
					'selector' 	=> '{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item',
				]
			);

			$this->add_responsive_control(
				'item_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-destination-ajax .ovabrw-destination-list .destination-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$template = apply_filters( 'ovabrw_ft_element_product_destionation_ajax', 'elementor/ovabrw_product_destination_ajax.php' );

		ob_start();
		ovabrw_get_template( $template, $settings );
		echo ob_get_clean();
	}
}