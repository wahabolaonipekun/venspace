<?php
namespace ovabrw_product_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ovabrw_product_custom_taxonomy extends Widget_Base {

	public function get_name() {		
		return 'ovabrw_product_custom_taxonomy';
	}

	public function get_title() {
		return esc_html__( 'Custom Taxonomy', 'ova-brw' );
	}

	public function get_icon() {
		return 'eicon-editor-list-ul';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_demo',
			[
				'label' => esc_html__( 'Demo', 'ova-brw' ),
			]
		);

			$default_product 	= '';
			$arr_product 		= array();

			$products = ovabrw_get_all_id_product();

			if ( ! empty( $products ) && is_array( $products ) ) {
				$default_product = $products[0];

				foreach( $products as $product_id ) {
					$arr_product[$product_id] = get_the_title( $product_id );
				}
			} else {
				$arr_product[''] = esc_html__( 'There are no rental products', 'ova-brw' );
			}

			$this->add_control(
				'product_id',
				[
					'label' 	=> esc_html__( 'Choose Product', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> $default_product,
					'options' 	=> $arr_product,
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_custom_taxonomy_style',
			[
				'label' => esc_html__( 'Taxonomy', 'ova-brw' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'taxonomy_display',
				[
					'label' => esc_html__( 'Display', 'ova-brw' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'block',
					'options' => [
						'block' 		=> esc_html__( 'Block', 'ova-brw' ),
						'inline-block' 	=> esc_html__( 'Auto', 'ova-brw' ),
					],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy' => 'display: {{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'taxonomy_padding',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Padding', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'taxonomy_margin',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items_taxonomy_style',
			[
				'label' => esc_html__( 'Items', 'ova-brw' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'items_taxonomy_background',
				[
					'label' 	=> esc_html__( 'Background', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'items_border',
					'label' 	=> esc_html__( 'Border', 'ova-brw' ),
					'selector' 	=> '{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li',
				]
			);

			$this->add_control(
				'items_border_first_options',
				[
					'label' 	=> esc_html__( 'Border Items (first)', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'items_border_first',
					'label' 	=> esc_html__( 'Border', 'ova-brw' ),
					'selector' 	=> '{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li:first-child',
				]
			);

			$this->add_control(
				'items_border_last_options',
				[
					'label' 	=> esc_html__( 'Border Items (last)', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'items_border_last',
					'label' 	=> esc_html__( 'Border', 'ova-brw' ),
					'selector' 	=> '{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li:last-child',
				]
			);

			$this->add_responsive_control(
				'items_taxonomy_padding',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Padding', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'items_taxonomy_margin',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_taxonomy_style',
			[
				'label' => esc_html__( 'Label', 'ova-brw' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'label_taxonomy_typography',
					'selector' 	=> '{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li label',
				]
			);

			$this->add_control(
				'label_taxonomy_color',
				[
					'label' 	=> esc_html__( 'Color', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li label' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'label_taxonomy_min_width',
				[
					'label' 		=> esc_html__( 'Min Width', 'ova-brw' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li label' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'label_taxonomy_border',
					'label' 	=> esc_html__( 'Border', 'ova-brw' ),
					'selector' 	=> '{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li label',
				]
			);

			$this->add_responsive_control(
				'label_taxonomy_padding',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Padding', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'label_taxonomy_margin',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_value_taxonomy_style',
			[
				'label' => esc_html__( 'Value', 'ova-brw' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'value_taxonomy_typography',
					'selector' 	=> '{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li span',
				]
			);

			$this->add_control(
				'value_taxonomy_color',
				[
					'label' 	=> esc_html__( 'Color', 'ova-brw' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li span' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'value_taxonomy_padding',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Padding', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'value_taxonomy_margin',
				[
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'ova-brw' ),
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-custom-taxonomy ul.ovabrw_cus_taxonomy li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		// Get Product
		$product  = wc_get_product();

		if ( empty( $product ) ) {
			$product_id = $settings['product_id'];
			$product 	= wc_get_product( $product_id );
		}

    	if ( ! $product || ! $product->is_type('ovabrw_car_rental') ) {
			?>
			<div class="ovabrw_elementor_no_product">
				<span><?php echo $this->get_title(); ?></span>
			</div>
			<?php
			return;
		}

		$product_id = $product->get_id();

		?>

		<div class="elementor-custom-taxonomy">
			<?php ovabrw_get_template( 'single/custom_taxonomy.php', array( 'id' => $product_id ) ); ?>
		</div>

		<?php
	}
}