<?php
/**
 * Product Grid Widget (WooCommerce)
 *
 * @package KatlaKit\Widgets\WooCommerce
 */

namespace KatlaKit\Widgets\WooCommerce;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

class Product_Grid extends Widget_Base {

	public function get_name(): string      { return 'katlakit-product-grid'; }
	public function get_title(): string     { return esc_html__( 'Product Grid', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-products'; }
	public function get_categories(): array { return [ 'katlakit-woocommerce' ]; }
	public function get_keywords(): array   { return [ 'woocommerce', 'product', 'grid', 'store', 'katlakit' ]; }

	protected function register_controls(): void {

		// Query
		$this->start_controls_section( 'section_query', [ 'label' => esc_html__( 'Query', 'katlakit' ) ] );

		$this->add_control( 'posts_per_page', [
			'label' => esc_html__( 'Products Count', 'katlakit' ), 'type' => Controls_Manager::NUMBER,
			'default' => 4,
		] );

		$this->add_responsive_control( 'columns', [
			'label' => esc_html__( 'Columns', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6' ],
			'default' => '4',
			'selectors' => [ '{{WRAPPER}} .kk-product-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);' ],
		] );

		$this->add_control( 'orderby', [
			'label' => esc_html__( 'Order By', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [ 'date' => 'Date', 'price' => 'Price', 'sales' => 'Sales', 'rand' => 'Random' ],
			'default' => 'date',
		] );

		$this->add_control( 'order', [
			'label' => esc_html__( 'Order', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [ 'DESC' => 'Descending', 'ASC' => 'Ascending' ],
			'default' => 'DESC',
		] );

		$this->end_controls_section();

		// Layout
		$this->start_controls_section( 'section_layout', [ 'label' => esc_html__( 'Layout', 'katlakit' ) ] );
		$this->add_responsive_control( 'gap', [ 'label' => esc_html__( 'Gap', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-product-grid' => 'gap: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Card Style
		$this->start_controls_section( 'style_card', [ 'label' => esc_html__( 'Product Card', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'card_bg', [ 'label' => esc_html__( 'Background', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-product-item' => 'background-color: {{VALUE}};' ] ] );
		$this->add_responsive_control( 'card_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'card_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .kk-product-item' ] );
		$this->end_controls_section();

		// Typography Style
		$this->start_controls_section( 'style_typography', [ 'label' => esc_html__( 'Typography', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-product-title a' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-product-title a' ] );
		$this->add_control( 'price_color', [ 'label' => esc_html__( 'Price Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .price' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'price_typography', 'selector' => '{{WRAPPER}} .price' ] );
		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if ( ! class_exists( 'WooCommerce' ) ) {
			echo '<div class="kk-error">WooCommerce is not active.</div>';
			return;
		}

		$args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $settings['posts_per_page'],
			'order' => $settings['order'],
		];

		if ( 'price' === $settings['orderby'] ) {
			$args['meta_key'] = '_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$args['orderby'] = 'meta_value_num';
		} elseif ( 'sales' === $settings['orderby'] ) {
			$args['meta_key'] = 'total_sales'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$args['orderby'] = 'meta_value_num';
		} else {
			$args['orderby'] = $settings['orderby'];
		}

		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) {
			echo '<div class="kk-product-grid" style="display: grid;">';
			while ( $query->have_posts() ) {
				$query->the_post();
				global $product;
				?>
				<div class="kk-product-item">
					<div class="kk-product-image">
						<a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( woocommerce_get_product_thumbnail() ); ?>
						</a>
						<div class="kk-product-action">
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</div>
					</div>
					<div class="kk-product-info">
						<h3 class="kk-product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="kk-product-price">
							<?php echo wp_kses_post( $product->get_price_html() ); ?>
						</div>
					</div>
				</div>
				<?php
			}
			echo '</div>';
			wp_reset_postdata();
		} else {
			echo '<div class="kk-no-products">No products found.</div>';
		}
	}
}
