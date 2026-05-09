<?php
/**
 * Glassmorphism Card Widget
 *
 * @package KatlaKit\Widgets\Creative
 */

namespace KatlaKit\Widgets\Creative;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use KatlaKit\Controls\Group_Control_Glass;

class Glassmorphism_Card extends Widget_Base {

	public function get_name(): string      { return 'katlakit-glassmorphism-card'; }
	public function get_title(): string     { return esc_html__( 'Glassmorphism Card', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-image-box'; }
	public function get_categories(): array { return [ 'katlakit-creative' ]; }
	public function get_keywords(): array   { return [ 'glass', 'card', 'box', 'katlakit' ]; }

	protected function register_controls(): void {

		// Content
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Content', 'katlakit' ) ] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image/Icon', 'katlakit' ), 'type' => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ], 'dynamic' => [ 'active' => true ],
		] );
		$this->add_group_control( Group_Control_Image_Size::get_type(), [ 'name' => 'image', 'default' => 'thumbnail' ] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Glass Card', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'This card uses modern CSS properties to create a frosted glass effect.', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );
		
		$this->add_control( 'link', [
			'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'dynamic' => [ 'active' => true ],
		] );

		$this->add_responsive_control( 'text_align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'center',
			'selectors' => [ '{{WRAPPER}} .kk-glass-card' => 'text-align: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// Style: Content
		$this->start_controls_section( 'style_content', [ 'label' => esc_html__( 'Content', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-gc-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-gc-title' ] );
		$this->add_control( 'desc_color', [ 'label' => esc_html__( 'Description Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .kk-gc-desc' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .kk-gc-desc' ] );
		$this->end_controls_section();

		// Style: Image
		$this->start_controls_section( 'style_image', [ 'label' => esc_html__( 'Image', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'image_size', [ 'label' => esc_html__( 'Size', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-gc-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'image_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-gc-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_responsive_control( 'image_spacing', [ 'label' => esc_html__( 'Spacing', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-gc-image' => 'margin-bottom: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Style: Glass Effect
		$this->start_controls_section( 'style_glass', [ 'label' => esc_html__( 'Glass Effect', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		
		if ( \Elementor\Plugin::$instance->controls_manager->get_control_groups( 'katlakit-glass' ) ) {
			$this->add_group_control( Group_Control_Glass::get_type(), [ 'name' => 'glass_effect', 'selector' => '{{WRAPPER}} .kk-glass-card' ] );
		} else {
			// Fallback if custom control isn't loaded
			$this->add_control( 'glass_bg', [ 'label' => esc_html__( 'Background', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(255, 255, 255, 0.1)', 'selectors' => [ '{{WRAPPER}} .kk-glass-card' => 'background-color: {{VALUE}};' ] ] );
			$this->add_control( 'glass_border', [ 'label' => esc_html__( 'Border Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(255, 255, 255, 0.2)', 'selectors' => [ '{{WRAPPER}} .kk-glass-card' => 'border: 1px solid {{VALUE}};' ] ] );
			$this->add_control( 'glass_blur', [ 'label' => esc_html__( 'Blur', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'default' => [ 'size' => 10 ], 'selectors' => [ '{{WRAPPER}} .kk-glass-card' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);' ] ] );
		}
		
		$this->add_responsive_control( 'card_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-glass-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'card_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-glass-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		
		$this->end_controls_section();

		$this->register_animation_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		
		$tag = 'div';
		$url = '';
		$target = false;
		$nofollow = false;
		
		if ( ! empty( $settings['link']['url'] ) ) {
			$tag = 'a';
			$url = esc_url( $settings['link']['url'] );
			$target = ! empty( $settings['link']['is_external'] );
			$nofollow = ! empty( $settings['link']['nofollow'] );
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php if ( $url ) { echo 'href="' . esc_url( $url ) . '"'; echo $target ? ' target="_blank"' : ''; echo $nofollow ? ' rel="nofollow"' : ''; } ?> class="kk-glass-card" style="display: block; text-decoration: none;">
			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<div class="kk-gc-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image' ) ); ?>
				</div>
			<?php endif; ?>
			
			<div class="kk-gc-content">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h3 class="kk-gc-title"><?php echo esc_html( $settings['title'] ); ?></h3>
				<?php endif; ?>
				
				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="kk-gc-desc"><?php echo wp_kses_post( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
	}
}
