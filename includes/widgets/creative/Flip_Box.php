<?php
/**
 * Flip Box Widget
 *
 * @package KatlaKit\Widgets\Creative
 */

namespace KatlaKit\Widgets\Creative;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class Flip_Box extends Widget_Base {

	public function get_name(): string      { return 'katlakit-flip-box'; }
	public function get_title(): string     { return esc_html__( 'Flip Box', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-flip-box'; }
	public function get_categories(): array { return [ 'katlakit-creative' ]; }
	public function get_keywords(): array   { return [ 'flip', 'box', 'card', '3d', 'katlakit' ]; }

	protected function register_controls(): void {

		// Front Content
		$this->start_controls_section( 'section_front', [ 'label' => esc_html__( 'Front', 'katlakit' ) ] );
		$this->add_control( 'front_icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ] ] );
		$this->add_control( 'front_title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Front Side', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'front_desc', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Hover me to flip.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Back Content
		$this->start_controls_section( 'section_back', [ 'label' => esc_html__( 'Back', 'katlakit' ) ] );
		$this->add_control( 'back_title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Back Side', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'back_desc', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'This is the back side content.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_text', [ 'label' => esc_html__( 'Button Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Click Here', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_link', [ 'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Settings
		$this->start_controls_section( 'section_settings', [ 'label' => esc_html__( 'Settings', 'katlakit' ) ] );
		$this->add_responsive_control( 'height', [ 'label' => esc_html__( 'Height', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px', 'vh' ], 'range' => [ 'px' => [ 'min' => 100, 'max' => 800 ] ], 'default' => [ 'unit' => 'px', 'size' => 300 ], 'selectors' => [ '{{WRAPPER}} .kk-flip-box' => 'height: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'flip_direction', [ 'label' => esc_html__( 'Flip Direction', 'katlakit' ), 'type' => Controls_Manager::SELECT, 'options' => [ 'right' => esc_html__( 'Right', 'katlakit' ), 'left' => esc_html__( 'Left', 'katlakit' ), 'up' => esc_html__( 'Up', 'katlakit' ), 'down' => esc_html__( 'Down', 'katlakit' ) ], 'default' => 'right' ] );
		$this->add_control( 'border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-fb-front, {{WRAPPER}} .kk-fb-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Front Style
		$this->start_controls_section( 'style_front', [ 'label' => esc_html__( 'Front', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'front_bg', 'selector' => '{{WRAPPER}} .kk-fb-front' ] );
		$this->add_control( 'front_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-fb-front' => 'color: {{VALUE}};' ] ] );
		$this->end_controls_section();

		// Back Style
		$this->start_controls_section( 'style_back', [ 'label' => esc_html__( 'Back', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'back_bg', 'selector' => '{{WRAPPER}} .kk-fb-back' ] );
		$this->add_control( 'back_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-fb-back' => 'color: {{VALUE}};' ] ] );
		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$dir = esc_attr( $settings['flip_direction'] );
		?>
		<div class="kk-flip-box" style="perspective: 1000px; position: relative; width: 100%;">
			<div class="kk-fb-inner kk-fb-dir-<?php echo esc_attr( $dir ); ?>" style="position: absolute; width: 100%; height: 100%; text-align: center; transition: transform 0.6s; transform-style: preserve-3d;">
				
				<!-- Front -->
				<div class="kk-fb-front" style="position: absolute; width: 100%; height: 100%; backface-visibility: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0;">
					<?php if ( ! empty( $settings['front_icon']['value'] ) ) : ?>
						<div class="kk-fb-icon" style="font-size: 40px; margin-bottom: 20px; color: #7c3aed;">
							<?php \Elementor\Icons_Manager::render_icon( $settings['front_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $settings['front_title'] ) ) : ?><h3 style="margin: 0 0 10px 0;"><?php echo esc_html( $settings['front_title'] ); ?></h3><?php endif; ?>
					<?php if ( ! empty( $settings['front_desc'] ) ) : ?><p style="margin: 0;"><?php echo wp_kses_post( $settings['front_desc'] ); ?></p><?php endif; ?>
				</div>

				<!-- Back -->
				<div class="kk-fb-back" style="position: absolute; width: 100%; height: 100%; backface-visibility: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; background: #7c3aed; color: #fff;">
					<?php if ( ! empty( $settings['back_title'] ) ) : ?><h3 style="margin: 0 0 10px 0; color: #fff;"><?php echo esc_html( $settings['back_title'] ); ?></h3><?php endif; ?>
					<?php if ( ! empty( $settings['back_desc'] ) ) : ?><p style="margin: 0 0 20px 0;"><?php echo wp_kses_post( $settings['back_desc'] ); ?></p><?php endif; ?>
					<?php if ( ! empty( $settings['button_text'] ) ) : 
						$url = ! empty( $settings['button_link']['url'] ) ? esc_url( $settings['button_link']['url'] ) : '#';
					?>
						<a href="<?php echo esc_url( $url ); ?>" style="display: inline-block; padding: 10px 20px; background: #fff; color: #7c3aed; text-decoration: none; border-radius: 4px; font-weight: bold;"><?php echo esc_html( $settings['button_text'] ); ?></a>
					<?php endif; ?>
				</div>

			</div>
		</div>

		<style>
			/* Setup flips */
			.kk-fb-dir-right .kk-fb-back { transform: rotateY(180deg); }
			.kk-flip-box:hover .kk-fb-dir-right { transform: rotateY(180deg); }

			.kk-fb-dir-left .kk-fb-back { transform: rotateY(-180deg); }
			.kk-flip-box:hover .kk-fb-dir-left { transform: rotateY(-180deg); }

			.kk-fb-dir-up .kk-fb-back { transform: rotateX(180deg); }
			.kk-flip-box:hover .kk-fb-dir-up { transform: rotateX(180deg); }

			.kk-fb-dir-down .kk-fb-back { transform: rotateX(-180deg); }
			.kk-flip-box:hover .kk-fb-dir-down { transform: rotateX(-180deg); }
		</style>
		<?php
	}
}
