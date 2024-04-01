<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tripgo_Elementor_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'tripgo_elementor_icon_box';
	}

	public function get_title() {
		return esc_html__( 'Ova Icon Box', 'tripgo' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'tripgo' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'tripgo' ),
			]
		);	
			
			// Add Class control
			$this->add_control(
				'template',
				[
					'label' => esc_html__( 'Template', 'tripgo' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template1',
					'options' => [
						'template1' => esc_html__('Template 1', 'tripgo'),
						'template2' => esc_html__('Template 2', 'tripgo'),
						'template3' => esc_html__('Template 3', 'tripgo'),
					]
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'flaticon2 flaticon2-teamwork',
						'library' => 'all',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Culture', 'tripgo' ),
					'placeholder' => esc_html__( 'Type your title here', 'tripgo' ),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'tripgo' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '#',
						'is_external' => true,
						'nofollow' => false,
					],
					'dynamic' => [
						'active' => true
					],
					'label_block' => true,
				]
			);

			$this->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 5,
					'default' => esc_html__( 'Sed ut perspiciatis unde omnis totam rem aperia eaque', 'tripgo' ),
					'placeholder' => esc_html__( 'Type your description here', 'tripgo' ),
				]
			);

			$this->add_control(
				'show_button_read_more',
				[
					'label' => esc_html__( 'Show Button Readmore', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'tripgo' ),
					'label_off' => esc_html__( 'Hide', 'tripgo' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'template' => 'template1',
					],
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => esc_html__( 'Text Button', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read More', 'tripgo' ),
					'condition' => [
						'template' => 'template1',
						'show_button_read_more' => 'yes',
					],
				],
			);

			$this->add_control(
				'icon_button',
				[
					'label' => esc_html__( 'Icon', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'icomoon icomoon-arrow-right',
						'library' => 'icomoon',
					],
					'condition' => [
						'template' => 'template1',
						'show_button_read_more' => 'yes',
					],
				]
			);

	$this->end_controls_section();

	$this->start_controls_section(
		'general_style',
		[
			'label' => esc_html__( 'General', 'tripgo' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox ' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box:hover .iconbox ' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'general_padding',
			[
				'label' => esc_html__( 'Padding', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'general_border',
				'selector' => '{{WRAPPER}} .ova-icon-box .iconbox',
			]
		);

		$this->add_control(
			'general_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'general_box_shadow',
				'selector' => '{{WRAPPER}} .ova-icon-box .iconbox',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'general_box_shadow_hover',
				'label' => esc_html__( 'Hover Box Shadow ', 'tripgo' ),
				'selector' => '{{WRAPPER}} .ova-icon-box:hover .iconbox',
			]
		);

		$this->add_control(
			'general_alignment',
			[
				'label' => esc_html__( 'Alignment', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tripgo' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tripgo' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tripgo' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'template' => 'template1',
				],
			]
		);

	$this->end_controls_section();

	$this->start_controls_section(
		'icon_section',
		[
			'label' => esc_html__( 'Icon', 'tripgo' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ova-icon-box .iconbox .icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_background_size',
			[
				'label' => esc_html__( 'Background Size', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'template' => 'template1',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Margin', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'background_border_radius',
			[
				'label' => esc_html__( 'Background Border Radius', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'template' => 'template1',
				],
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'tripgo' ),
			]
		);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-box .iconbox .icon svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-box .iconbox .icon svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_background_color',
				[
					'label' => esc_html__( 'Background Color', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'template' => 'template1',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'icon_box_shadow',
					'selector' => '{{WRAPPER}} .ova-icon-box .iconbox .icon',
					'condition' => [
						'template' => 'template1',
					],
				]
			);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'tripgo' ),
			]
		);

			$this->add_control(
				'icon_hover_color',
				[
					'label' => esc_html__( 'Color', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_background_hover_color',
				[
					'label' => esc_html__( 'Background Color', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'template' => 'template1',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'icon_box_shadow_hover',
					'label' => esc_html__( 'Box Shadow ', 'tripgo' ),
					'selector' => '{{WRAPPER}} .ova-icon-box:hover .iconbox .icon',
					'condition' => [
						'template' => 'template1',
					],
				]
			);

		$this->end_controls_tab();

		$this->end_controls_tabs();

	$this->end_controls_section();

	$this->start_controls_section(
		'content_title',
		[
			'label' => esc_html__( 'Title', 'tripgo' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ova-icon-box .iconbox .title',
			]
		);


		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Color Hover', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box:hover .iconbox .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
	$this->end_controls_section();

	$this->start_controls_section(
		'content_description',
		[
			'label' => esc_html__( 'Description', 'tripgo' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .ova-icon-box .iconbox .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'description_hover_color',
			[
				'label' => esc_html__( 'Color Hover', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box:hover .iconbox .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__( 'Margin', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	

	$this->end_controls_section();

	$this->start_controls_section(
		'line_decoration',
		[
			'label' => esc_html__( 'Line Decoration', 'tripgo' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
				'template' => 'template2',
			],
		]
	);

		$this->add_control(
			'line_decoration_width',
			[
				'label' => esc_html__( 'Width', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .line-decoration' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'line_decoration_height',
			[
				'label' => esc_html__( 'Height', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .line-decoration' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'line_decoration_color',
			[
				'label' => esc_html__( 'Color', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .line-decoration' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'line_decoration_color_hover',
			[
				'label' => esc_html__( 'Hover Color', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box:hover .iconbox .line-decoration' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'line_decoration_margin',
			[
				'label' => esc_html__( 'Margin', 'tripgo' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ova-icon-box .iconbox .line-decoration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	$this->end_controls_section();

	$this->start_controls_section(
		'button_readmore_section',
			[
				'label' => esc_html__( ' Button Readmore', 'tripgo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'template' => 'template1',
				],
			]
		);

			$this->add_responsive_control(
				'button_readmore_margin',
				[
					'label' => esc_html__( 'Margin', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox  .button-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'text_button_heading',
				[
					'label' => esc_html__( 'Text', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_button_typography',
					'selector' => '{{WRAPPER}} .ova-icon-box .iconbox  .button-readmore .text-button',
				]
			);

			$this->add_control(
				'text_button_color',
				[
					'label' => esc_html__( 'Color', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox  .button-readmore .text-button' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'text_button_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .iconbox  .button-readmore .text-button' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'text_button_margin',
				[
					'label' => esc_html__( 'Margin', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox .button-readmore .text-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_button_heading',
				[
					'label' => esc_html__( 'Icon', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'icon_button_size',
				[
					'label' => esc_html__( 'Size', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .button-readmore .icon-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_button_color',
				[
					'label' => esc_html__( 'Color', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox  .button-readmore .icon-button i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_button_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'tripgo' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .iconbox  .button-readmore .icon-button i' => 'color: {{VALUE}}',
					],
				]
			);

	$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

		$icon 					= $settings['icon'];
		$templates 				= $settings['template'];
		$title 					= $settings['title'];
		$description 			= $settings['description'];
		$link 					= $settings['link'];
		$show_button_read_more  = $settings['show_button_read_more'];
		$text_button 			= $settings['text_button'];
		$icon_button         	= $settings['icon_button'];

		?>
			<div class="ova-icon-box <?php echo esc_attr($templates);?> "> 

			<?php if ( !empty( $link['url'] ) ) {
				$this->add_link_attributes( 'link', $link );
			?>

				<a class="iconbox" <?php $this->print_render_attribute_string( 'link' ); ?> >

			<?php }else{ ?>	
				<div class="iconbox">
			<?php } ?>	

				<?php if( $templates == 'template2' ) {  ?>
				<div class="wrap-icon">
				<?php } ?>

					<span class="icon">
						<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
					</span>

					<?php if( $title ) {  ?>
						<h3 class="title">
							<?php echo esc_html($title) ;?>
						</h3>
	                <?php } ?>

				<?php if( $templates == 'template2' ) {  ?>
				</div>
				<?php } ?>
				
                <?php if( $templates == 'template2' ) {  ?>
					<div class="line-decoration"></div>
				<?php } ?>

                <?php if ($description) { ?>
					<p class="description">
						<?php echo esc_html($description) ;?>
					</p>
				<?php  } ?>

				<?php if( $templates == 'template1' && $show_button_read_more == 'yes') {  ?>	

					<div class="button-readmore">
						<span class="text-button"><?php echo esc_html($text_button); ?></span>
						<span class="icon-button"><?php \Elementor\Icons_Manager::render_icon( $icon_button , [ 'aria-hidden' => 'true' ] ); ?></span> 
					</div> 
			
				<?php } ?>

			<?php if ( !empty( $link['url'] ) ) { ?>
				</a> 
			<?php }else{ ?>	
				</div>
			<?php } ?>	

		</div>

		<?php
	}
}
$widgets_manager->register( new Tripgo_Elementor_Icon_Box() );