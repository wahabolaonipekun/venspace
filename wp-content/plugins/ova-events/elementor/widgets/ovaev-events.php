<?php
namespace ova_ovaev_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_events extends Widget_Base {

	public function get_name() {		
		return 'ova_events';
	}

	public function get_title() {
		return esc_html__( 'Events', 'ovaev' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	protected function register_controls() {

	   	$args = array(
           'taxonomy' => 'event_category',
           'orderby' => 'name',
           'order'   => 'ASC'
       	);
	
		$categories = get_categories($args);
		$categories_all = array( 'all' => 'All categories');
		$category_data = array();
		if ($categories) {
			foreach ( $categories as $category ) {
				$category_data[$category->slug] = $category->cat_name;
			}
		} else {
			$category_data["No content Category found"] = 0;
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ovaev' ),
			]
		);

			$this->add_control(
				'category',
				[
					'label'   => esc_html__( 'Category', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge( $categories_all, $category_data )
				]
			);


			$this->add_control(
				'total_count',
				[
					'label'   => esc_html__( 'Post Total', 'ovaev' ),
					'type'    => Controls_Manager::NUMBER,
					'min'     => 1,
					'default' => 3,
				]
			);

			$this->add_control(
				'time_event',
				[
					'label'   => esc_html__('Choose time', 'ovaev'),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						''     => esc_html__('All','ovaev'),
						'current'  => esc_html__('Current','ovaev'),
						'upcoming' => esc_html__('Upcoming','ovaev'),
						'past'     => esc_html__('Past','ovaev'),
					],
					'default'   => '',
				]
			);

			$this->add_control(
				'version',
				[
					'label' => esc_html__('Version','ovaev'),
					'type' 	=> Controls_Manager::SELECT,
					'default' => 'version_1',
					'options' => [
						'version_1' => esc_html__('List', 'ovaev'),
						'version_2' => esc_html__('Grid', 'ovaev'),
						'version_3' => esc_html__('Templates', 'ovaev'),
 					]
				]
			);

			$this->add_control(
				'type_event',
				[
					'label' => esc_html__('Template','ovaev'),
					'type' 	=> Controls_Manager::SELECT,
					'default' => 'type1',
					'options' => [
						'type1' => esc_html__('Template 1', 'ovaev'),
						'type2' => esc_html__('Template 2', 'ovaev'),
						'type3' => esc_html__('Template 3', 'ovaev'),
						'type4' => esc_html__('Template 4', 'ovaev'),
						'type5' => esc_html__('Template 5', 'ovaev'),
						'type6' => esc_html__('Template 6', 'ovaev'),
 					],
 					'condition' => [
 						'version' => ['version_3'],
 					],
				]
			);

			$this->add_control(
				'column',
				[
					'label' => esc_html__('Column','ovaev'),
					'type' => Controls_Manager::SELECT,
					'default' => 'two_column',
					'options' => [
						'two_column' => esc_html__('Two Columns', 'ovaev'),
						'three_column' => esc_html__('Three Columns', 'ovaev'),
 					],
 					'condition' => [
 						'version' => 'version_2'
 					],
				]
			);

			$this->add_control(
				'column_template',
				[
					'label' => esc_html__('Column','ovaev'),
					'type' => Controls_Manager::SELECT,
					'default' => 'col2',
					'options' => [
						'col1' => esc_html__('One Column', 'ovaev'),
						'col2' => esc_html__('Two Columns', 'ovaev'),
						'col3' => esc_html__('Three Columns', 'ovaev'),
 					],
 					'condition' => [
 						'version' => 'version_3'
 					],
				]
			);

			$this->add_control(
				'order_by',
				[
					'label'   => esc_html__( 'Order By', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'title',
					'options' => [
						'ID'  => esc_html__( 'ID', 'ovaev' ),			
						'title'             => esc_html__( 'Title', 'ovaev' ),
						'event_custom_sort' => esc_html__( 'Custom Sort', 'ovaev' ),
						'ovaev_start_date_time'  => esc_html__( 'Start Date', 'ovaev' ),		
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => esc_html__( 'Order', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => esc_html__( 'Descending', 'ovaev' ),
						'ASC'  => esc_html__( 'Ascending', 'ovaev' ),
						
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

			$this->add_responsive_control(
				'margin_content',
				[
					'label' => esc_html__( 'Margin', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ovaev-event-element' 			 => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ovaev-event-element.version_2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ovaev-event-element.version_3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_content',
				[
					'label' => esc_html__( 'Padding', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ovaev-event-element' 			 => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ovaev-event-element.version_2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ovaev-event-element.version_3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$template = apply_filters( 'elementor_ovaev', 'elements/ovaev_events.php' );

		ob_start();
		ovaev_get_template( $template, $settings );
		echo ob_get_clean();

	}
}
