<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Tripgo_Elementor_Counter extends Widget_Base {

	
	public function get_name() {
		return 'tripgo_elementor_counter';
	}

	
	public function get_title() {
		return esc_html__( 'Ova Counter', 'tripgo' );
	}

	
	public function get_icon() {
		return 'eicon-counter';
	}

	
	public function get_categories() {
		return [ 'tripgo' ];
	}

	public function get_script_depends() {
		// appear js
		wp_enqueue_script( 'tripgo-counter-appear', get_theme_file_uri('/assets/libs/appear/appear.js'), array('jquery'), false, true);
		// Odometer for counter
		wp_enqueue_style( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.css' );
		wp_enqueue_script( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.js', array('jquery'), false, true );
		return [ 'tripgo-elementor-counter' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Ova Counter', 'tripgo' ),
			]
		);	
			
			// Add Class control

		    $this->add_control(
				'icon',
				[
					'label' 	=> __( 'Icon', 'tripgo' ),
					'type' 		=> Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'icomoon icomoon-profile-2user',
						'library' 	=> 'all',
					],
				]
			);

		    $this->add_control(
				'number',
				[
					'label' 	=> esc_html__( 'Number', 'tripgo' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => esc_html__( '28', 'tripgo' ),
				]
			);

			$this->add_control(
				'suffix',
				[
					'label'  => esc_html__( 'Suffix', 'tripgo' ),
					'type'   => Controls_Manager::TEXT,
					'default' => 'k',
				]
			);

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'tripgo' ),
					'type' 	=> Controls_Manager::TEXT,
					'default' => esc_html__( 'Total Users', 'tripgo' ),
				]
			);

			$this->add_responsive_control(
				'text_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'tripgo' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'tripgo' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'tripgo' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'tripgo' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'text-align: {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_section();

		/* Begin Counter Style */
		$this->start_controls_section(
            'counter_style',
            [
               'label' => esc_html__( 'Ova Counter', 'tripgo' ),
               'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
				'counter_bgcolor',
				[
					'label' 	=> esc_html__( 'Background', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'counter_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Hover', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover' => 'background: {{VALUE}};',
					],
				]
			);

		    $this->add_responsive_control(
	            'counter_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'tripgo' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => esc_html__( 'Box Shadow', 'tripgo' ),
					'selector' => '{{WRAPPER}} .ova-counter',
				]
			);

			$this->add_responsive_control(
				'counter_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tripgo' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ova-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

        $this->end_controls_section();
		/* End counter style */
        
        /* Begin icon Style */
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'tripgo' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'icon_fontsize',
				[
					'label' 		=> esc_html__( 'Size', 'tripgo' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 90,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-counter .icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .icon' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .icon' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'tripgo' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-counter .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section(); 
		// End Style tab Icon

		/* Begin number (odometer) Style */
		$this->start_controls_section(
            'number_style',
            [
                'label' => esc_html__( 'Number', 'tripgo' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			 $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'number_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .odometer',
				]
			);

			$this->add_control(
				'number_color',
				[
					'label' 	=> esc_html__( 'Color', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .odometer' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .odometer' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End number style */

		/* Begin suffix Style */
		$this->start_controls_section(
            'suffix_style',
            [
                'label' => esc_html__( 'Suffix', 'tripgo' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'suffix_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .suffix',
				]
			);

			$this->add_control(
				'suffix_color',
				[
					'label' 	=> esc_html__( 'Color', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'suffix_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'suffix_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'tripgo' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter .suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End suffix style */

		/* Begin title Style */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'tripgo' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'tripgo' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'tripgo' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End title style */

		
	}

	// Render Template Here
	protected function render() {

		$settings   = $this->get_settings();

        $class_icon = $settings['icon']['value'];
		$number     = isset( $settings['number'] ) ? $settings['number'] : '100';
		$suffix     = $settings['suffix'];
		$title      = $settings['title'];

		 ?>
           
           <div class="ova-counter" data-count="<?php echo esc_attr( $number ); ?>">
                
	            <?php if(!empty( $class_icon )) : ?>
	            	<div class="icon-wrapper">
	            		<div class="icon">
							<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
						</div>
	            	</div>
				<?php endif; ?>
	            
                <div class="odometer-wrapper">
					<span class="odometer">0</span>
					<span class="suffix">
						<?php echo esc_html( $suffix ); ?>
			        </span>
			    </div>
				
	      	     <?php if (!empty( $title )): ?>
					<h4 class="title">
						<?php echo esc_html( $title ); ?>
					</h4>
				<?php endif;?>

           </div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Tripgo_Elementor_Counter() );