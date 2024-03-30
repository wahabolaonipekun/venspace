<?php
namespace ova_ovaev_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_event_tags extends Widget_Base {

	public function get_name() {		
		return 'ova_event_tags';
	}

	public function get_title() {
		return esc_html__( 'Event Tags', 'ovaev' );
	}

	public function get_icon() {
		return 'eicon-tags';
	}

	public function get_categories() {
		return [ 'ovaev_template' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tags',
			[
				'label' => esc_html__( 'Tags', 'ovaev' ),
			]
		);

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'ovaev' ),
					'type' 	=> Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ovaev' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ovaev' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ovaev' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .ovaev-event-tags' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

		$this->start_controls_section(
			'section_tags_style',
			[
				'label' => esc_html__( 'Tags', 'ovaev' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'tags_title_color',
				[
					'label' => esc_html__( 'Color', 'ovaev' ),
					'type' 	=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovaev-event-tags .ovatags' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'tags_title_typography',
					'selector' 	=> '{{WRAPPER}} .ovaev-event-tags .ovatags',
				]
			);


			$this->add_responsive_control(
	            'tags_title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'ovaev' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovaev-event-tags .ovatags' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'tags_title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'ovaev' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovaev-event-tags .ovatags' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tags_items_style',
			[
				'label' => esc_html__( 'Items', 'ovaev' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_items_style' );
				
				$this->start_controls_tab(
		            'tab_item_normal',
		            [
		                'label' => esc_html__( 'Normal', 'ovaev' ),
		            ]
		        );

		        	$this->add_control(
			            'item_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'ovaev' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'item_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'ovaev' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_item_hover',
		            [
		                'label' 	=> esc_html__( 'Hover', 'ovaev' ),
		            ]
		        );

		        	$this->add_control(
			            'item_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'ovaev' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag:hover' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'item_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'ovaev' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'item_typography',
					'selector' 	=> '{{WRAPPER}} .ovaev-event-tags .ovaev-tag',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'item_border',
	                'selector' 	=> '{{WRAPPER}} .ovaev-event-tags .ovaev-tag',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'item_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'ovaev' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'tags_item_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'ovaev' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'tags_item_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'ovaev' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ovaev-event-tags .ovaev-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
	}

	protected function render() {

		$settings 	= $this->get_settings();

		$id 		= get_the_ID();
		$post_type 	= get_post_type( $id );
		
		if ( empty( $post_type ) || 'event' != $post_type ) {
			echo '<div class="ovaev_elementor_none"><span>' . esc_html( $this->get_title() ) . '</span></div>';
			return;
		}

		$tag_event = get_the_terms( $id, 'event_tag' );

		?>

		<?php if ( ! empty( $tag_event ) ): ?>
			<div class="ovaev-event-tags">
				<?php ovaev_get_tag_event_by_id( $id ); ?>
			</div>
		<?php
		endif;
	}
}
