<?php
/**
 * Image Hover Card Widget
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

class Image_Hover_Card extends Widget_Base {

	public function get_name(): string      { return 'katlakit-image-hover-card'; }
	public function get_title(): string     { return esc_html__( 'Image Hover Card', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-image-rollover'; }
	public function get_categories(): array { return [ 'katlakit-creative' ]; }
	public function get_keywords(): array   { return [ 'image', 'hover', 'card', 'katlakit' ]; }

	protected function register_controls(): void {

		// Content
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Content', 'katlakit' ) ] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'katlakit' ), 'type' => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ], 'dynamic' => [ 'active' => true ],
		] );
		$this->add_group_control( Group_Control_Image_Size::get_type(), [ 'name' => 'image', 'default' => 'large' ] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Hover Card', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Hover over this image to reveal the hidden content with smooth animation.', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'link', [
			'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'hover_effect', [
			'label' => esc_html__( 'Hover Effect', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [
				'fade' => esc_html__( 'Fade In', 'katlakit' ),
				'slide-up' => esc_html__( 'Slide Up', 'katlakit' ),
				'zoom-in' => esc_html__( 'Zoom In', 'katlakit' ),
			],
			'default' => 'slide-up',
		] );

		$this->end_controls_section();

		// Style: Card
		$this->start_controls_section( 'style_card', [ 'label' => esc_html__( 'Card', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'height', [ 'label' => esc_html__( 'Height', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px', 'vh' ], 'range' => [ 'px' => [ 'min' => 100, 'max' => 800 ] ], 'default' => [ 'unit' => 'px', 'size' => 350 ], 'selectors' => [ '{{WRAPPER}} .kk-image-hover-card' => 'height: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'overlay_color', [ 'label' => esc_html__( 'Overlay Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(0,0,0,0.6)', 'selectors' => [ '{{WRAPPER}} .kk-ihc-overlay' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-image-hover-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Style: Content
		$this->start_controls_section( 'style_content', [ 'label' => esc_html__( 'Content', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'content_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-ihc-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => [ '{{WRAPPER}} .kk-ihc-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-ihc-title' ] );
		$this->add_control( 'desc_color', [ 'label' => esc_html__( 'Description Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => '#dddddd', 'selectors' => [ '{{WRAPPER}} .kk-ihc-desc' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .kk-ihc-desc' ] );
		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		
		$effect = esc_attr( $settings['hover_effect'] );
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
		
		$image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'image', $settings );
		if ( ! $image_url ) {
			$image_url = $settings['image']['url'];
		}
		?>
		
		<<?php echo esc_attr( $tag ); ?> <?php if ( $url ) { echo 'href="' . esc_url( $url ) . '"'; echo $target ? ' target="_blank"' : ''; echo $nofollow ? ' rel="nofollow"' : ''; } ?> class="kk-image-hover-card kk-ihc-<?php echo esc_attr( $effect ); ?>" style="display: block; position: relative; overflow: hidden; text-decoration: none;">
			
			<div class="kk-ihc-bg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?php echo esc_url( $image_url ); ?>'); background-size: cover; background-position: center; transition: transform 0.5s ease;"></div>
			
			<div class="kk-ihc-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; transition: opacity 0.4s ease;"></div>
			
			<div class="kk-ihc-content" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px; z-index: 2; transition: all 0.4s ease;">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h3 class="kk-ihc-title" style="margin: 0 0 10px 0;"><?php echo esc_html( $settings['title'] ); ?></h3>
				<?php endif; ?>
				
				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="kk-ihc-desc" style="margin: 0;"><?php echo wp_kses_post( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>
			
			<style>
				.kk-image-hover-card:hover .kk-ihc-bg { transform: scale(1.1); }
				.kk-image-hover-card:hover .kk-ihc-overlay { opacity: 1; }
				
				/* Fade */
				.kk-ihc-fade .kk-ihc-content { opacity: 0; }
				.kk-ihc-fade:hover .kk-ihc-content { opacity: 1; }
				
				/* Slide Up */
				.kk-ihc-slide-up .kk-ihc-content { transform: translateY(100%); opacity: 0; }
				.kk-ihc-slide-up:hover .kk-ihc-content { transform: translateY(0); opacity: 1; }
				
				/* Zoom In */
				.kk-ihc-zoom-in .kk-ihc-content { transform: scale(0.8); opacity: 0; }
				.kk-ihc-zoom-in:hover .kk-ihc-content { transform: scale(1); opacity: 1; }
			</style>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
	}
}
