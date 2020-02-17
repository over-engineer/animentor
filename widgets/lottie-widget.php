<?php
/**
 * Lottie widget
 *
 * @copyright 2020 over-engineer
 */

namespace LottieForElementor\Widgets;

// Prevent direct access to files
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Lottie Elementor widget
 *
 * Elementor widget that inserts Lottie content into the page
 */
class Lottie extends \Elementor\Widget_Base {
  public function __construct( $data = array(), $args = null ) {
    parent::__construct( $data, $args );

    // Register scripts
    wp_register_script(
      'lottie',
      'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.6.4/lottie.min.js',
      array(), // dependencies
      '5.6.4'
    );

    wp_register_script(
      'lottie-for-elementor-frontend',
      \LottieForElementor\PLUGIN_URL . 'assets/js/frontend.js',
      array( 'jquery', 'lottie' ), // dependencies
      '1.0.0'
    );

    // Register styles
    wp_register_style(
      'lottie-for-elementor-widget',
      \LottieForElementor\PLUGIN_URL . 'assets/css/widget.css',
      array(), //dependencies
      '1.0.0'
    );
  }

  /**
   * Return an array containing all of the custom scripts required for the plugin
   *
   * Elementor makes sure the scripts returned by this method are enqueued in the
   * proper time and only when it's necessary. The script handle has to be unique
   * and it is determined when registering the scripts.
   *
   * @return array An array containing all of the custom scripts
   */
  public function get_script_depends() {
    return array( 'lottie', 'lottie-for-elementor-frontend' );
  }

  /**
   * Return an array containing all of the custom styles required for the plugin
   *
   * Elementor makes sure the styles returned by this method are enqueued in the
   * proper time and only when it's necessary. The style handle has to be unique
   * and it is determined when registering the styles.
   *
   * @return array An array containing all of the custom styles
   */
  public function get_style_depends() {
    return array( 'lottie-for-elementor-widget' );
  }

  /**
   * Get widget name
   *
   * @return string Lottie for Elementor widget name
   */
  public function get_name() {
    return 'lottie';
  }

  /**
   * Get widget title
   *
   * @return string Lottie for Elementor widget title
   */
  public function get_title() {
    return __( 'Lottie', 'lottie-for-elementor' );
  }

  /**
   * Get widget icon
   *
   * @return string Lottie for Elementor widget icon
   */
  public function get_icon() {
    return 'fa fa-magic';
  }

  /**
   * Get widget categories
   *
   * @return array An array of categories the Lottie for Elementor widget belongs to
   */
  public function get_categories() {
    return array( 'general' );
  }

  private function add_animation_section() {
    $this->start_controls_section(
      'animation_section',
      array(
        'label' => __( 'Animation', 'lottie-for-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
      )
    );

    $this->add_control(
      'data_file',
      array(
        'label'       => __( 'Data file', 'lottie-for-elementor' ),
        'type'        => \Elementor\Controls_Manager::MEDIA,
        'media_type'  => \LottieForElementor\Json_Handler::MIME_TYPE
      )
    );

    $this->add_responsive_control(
			'align',
			array(
				'label' => __( 'Alignment', 'lottie-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'flex-start' => array(
						'title' => __( 'Left', 'lottie-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'lottie-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					),
					'flex-end' => array(
						'title' => __( 'Right', 'lottie-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
          '{{WRAPPER}} .elementor-widget-container'   => 'display: flex; justify-content: {{VALUE}};',
          '{{WRAPPER}} .elementor-widget-container a' => 'display: flex; justify-content: {{VALUE}};'
				),
			)
    );
    
    $this->add_control(
      'link_enabled',
      array(
        'label'     => __( 'Link', 'lottie-for-elementor' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'lottie-for-elementor' ),
        'label_off' => __( 'No', 'lottie-for-elementor' )
      )
    );

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'elementor' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'lottie-for-elementor' ),
				'condition'   => array(
					'link_enabled' => 'yes',
				),
				'show_label'  => false,
			)
		);

    $this->end_controls_section();
  }

  private function add_animation_options_section() {
    $this->start_controls_section(
      'animation_options_section',
      array(
        'label' => __( 'Animation Options', 'lottie-for-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
      )
    );

    $this->add_control(
      'speed',
      array(
        'label'       => __( 'Speed', 'lottie-for-elementor' ),
        'description' => __( 'Normal speed is 1', 'lottie-for-elementor' ),
        'type'        => \Elementor\Controls_Manager::NUMBER,
        'step'        => '0.1',
        'placeholder' => '1',
        'default'     => '1'
      )
    );

    $this->add_control(
      'autoplay',
      array(
        'label'       => __( 'Autoplay', 'lottie-for-elementor' ),
        'type'        => \Elementor\Controls_Manager::SWITCHER,
        'label_on'    => __( 'Yes', 'lottie-for-elementor' ),
        'label_off'   => __( 'No', 'lottie-for-elementor' ),
        'default'     => 'yes'
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => __( 'Loop', 'lottie-for-elementor' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'lottie-for-elementor' ),
        'label_off' => __( 'No', 'lottie-for-elementor' )
      )
    );

    $this->add_control(
      'reversed',
      array(
        'label'     => __( 'Reversed', 'lottie-for-elementor' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'lottie-for-elementor' ),
        'label_off' => __( 'No', 'lottie-for-elementor' )
      )
    );

    $this->add_control(
			'separator_panel_content_animation_options',
			array(
				'type'  => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
      )
    );

    $this->add_control(
      'onmouseover',
      array(
        'label'     => __( 'Play on mouse over', 'lottie-for-elementor' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'lottie-for-elementor' ),
        'label_off' => __( 'No', 'lottie-for-elementor' )
      )
    );

    $this->add_control(
      'onmouseout',
      array(
        'label'   => __( 'On mouse out', 'lottie-for-elementor' ),
        'type'    => \Elementor\Controls_Manager::SELECT2,
        'options' => array(
          'stop'    => __( 'Stop', 'lottie-for-elementor' ),
          'pause'   => __( 'Pause', 'lottie-for-elementor' ),
          'reverse' => __( 'Reverse', 'lottie-for-elementor' )
        ),
        'default' => 'stop',
        'condition' => array(
          'onmouseover' => 'yes',
        ),
      )
    );

    $this->end_controls_section();
  }

  private function add_styles_section() {
    $this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Lottie', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      )
    );

    // Dimensions
    $this->add_responsive_control(
			'width',
			array(
				'label' => __( 'Width', 'lottie-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units' => array( '%', 'px', 'vw' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .lottie-for-elementor-widget' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
    );
    
    $this->add_responsive_control(
			'space',
			array(
				'label' => __( 'Max Width', 'lottie-for-elementor' ) . ' (%)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units' => array( '%' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .lottie-for-elementor-widget' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
    );
    
    $this->add_control(
			'separator_panel_style',
			array(
				'type'  => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
      )
    );
    
    // Opacity and CSS filters
    $this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			array(
				'label' => __( 'Normal', 'elementor' ),
			)
		);

		$this->add_control(
			'opacity',
			array(
				'label' => __( 'Opacity', 'elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px'  => array(
						'max'   => 1,
						'min'   => 0.10,
						'step'  => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .lottie-for-elementor-widget' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			array(
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .lottie-for-elementor-widget',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			array(
				'label' => __( 'Hover', 'lottie-for-elementor' ),
			)
		);

		$this->add_control(
			'opacity_hover',
			array(
				'label' => __( 'Opacity', 'lottie-for-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px'  => array(
						'max'   => 1,
						'min'   => 0.10,
						'step'  => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .lottie-for-elementor-widget:hover' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			array(
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .lottie-for-elementor-widget:hover',
			)
		);

		$this->add_control(
			'background_hover_transition',
			array(
				'label' => __( 'Transition Duration', 'lottie-for-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px'  => array(
						'max'   => 3,
						'step'  => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .lottie-for-elementor-widget' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

    // Border and box shadow
    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'      => 'lottie_border',
				'selector'  => '{{WRAPPER}} .lottie-for-elementor-widget',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'lottie_border_radius',
			array(
				'label'       => __( 'Border Radius', 'lottie-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'selectors'   => array(
					'{{WRAPPER}} .lottie-for-elementor-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'lottie_box_shadow',
				'exclude'   => array( 'box_shadow_position' ),
				'selector'  => '{{WRAPPER}} .lottie-for-elementor-widget',
			)
		);

		$this->end_controls_section();

		$this->end_controls_section();
  }

  /**
   * Register Lottie for Elementor controls
   *
   * Adds different input fields to allow the user
   * to change and customize the widget settings
   */
  protected function _register_controls() {
    $this->add_animation_section();
    $this->add_animation_options_section();
    $this->add_styles_section();
  }

  /**
   * Return either the on or the off value based on the given setting
   *
   * @param string $setting   The setting to check
   * @param string $on_val    The on value (if setting is 'yes')
   * @param string $off_val   The off value (if setting is not 'yes')
   * @return string           Either the on or the off value
   */
  private function switcher_value( $setting, $on_val, $off_val ) {
    return $setting === 'yes' ? $on_val : $off_val;
  }

  /**
   * Retrieve widget link URL
   *
   * @param array $settings
   * @return array|string|false An array/string containing the link URL, or false if no link
   */
  private function get_link_url( $settings ) {
    if ( 'yes' !== $settings['link_enabled'] || empty( $settings['link']['url'] ) ) {
      return false;
    }

    return $settings['link'];
  }

  /**
   * Render Lottie for Elementor widget output on the frontend
   * Generates the final HTML
   */
  protected function render() {
    $widget_id = $this->get_id();
    $settings = $this->get_settings_for_display();
    
    // If animation data
    if ( ! isset( $settings['data_file']['url'] ) || empty( $settings['data_file']['url'] ) ) {
      return;
    }

    // Get the url pointing to the animation data JSON file
    $data_file_url = $settings['data_file']['url'];

    // Make sure animation data is a JSON
    $ext = strtolower( substr( $data_file_url, -5 ) );
    if ( '.json' !== $ext ) {
      return;
    }

    // Parse settings
    $link = $this->get_link_url( $settings );
    $loop = $this->switcher_value( $settings['loop'], 'true', 'false' );
    $speed = $settings['speed'];
    $direction = $this->switcher_value( $settings['reversed'], '-1', '1' );
    $autoplay = $this->switcher_value( $settings['autoplay'], 'true', 'false' );
    $mouseover = $this->switcher_value( $settings['onmouseover'], 'true', 'false' );
    $mouseout = $settings['onmouseout'];

    // Animation name should include the widget id
    $animation_name = 'lottie-for-elementor-anim-' . $widget_id;

    // Handle link
    if ( $link ) {
      $this->add_link_attributes( 'link', $link );

      if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', array(
					'class' => 'elementor-clickable',
        ) );
			}
    }

    // Print the HTML
    if ( $link ) {
      printf( '<a %s style="color: inherit;">', $this->get_render_attribute_string( 'link' ) );
    }

    printf(
      '<div class="lottie-for-elementor-widget" '
      . 'data-animation-path="%1$s" data-anim-loop="%2$s" data-speed="%3$s" data-direction="%4$s" data-autoplay="%5$s" '
      . 'data-mouseover="%6$s" data-mouseout="%7$s" data-name="%8$s">'
      . '</div>',
      $data_file_url,     // path to the animation object
      $loop,              // loop (true, false, or number)
      $speed,             // speed (1 is normal speed)
      $direction,         // direction (1 is normal, -1 is reversed)
      $autoplay,          // start playing the animation on page load
      $mouseover,         // start playing the animation on mouse over
      $mouseout,          // on mouse out we should stop, pause, or reverse
      $animation_name     // animation name to refer to a specific animation
    );

    if ( $link ) {
      echo '</a>';
    }
  }
}
