<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Progress_circle_full extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tp-progress-circles';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Progress Circles', 'tpcore');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'tp-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tpcore'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['tpcore'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'chart_content_one',
            [
                'label' => esc_html__('Progress Circles', 'finview-core'),
            ]
        );

        // Progress Value
        $this->add_control(
            'series_value',
            [
                'label' => __('Progress Value (%)', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 80,
                'min' => 0,
                'max' => 100,
            ]
        );

        // Progress Bar Stroke Color
        $this->add_control(
            'chart_color',
            [
                'label' => __('Progress Bar Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f6a828',
            ]
        );

        // Background Stroke Color
        $this->add_control(
            'background_stroke_color',
            [
                'label' => __('Background Stroke Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#404A60',
            ]
        );

        // Value Text Color
        $this->add_control(
            'value_text_color',
            [
                'label' => __('Value Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f6a828',
            ]
        );

        // Width Control
        $this->add_control(
            'canvas_width',
            [
                'label'   => __('Canvas Width', 'text-domain'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 120,
                    'unit' => 'px',
                ],
            ]
        );

        // Line Cap Style
        $this->add_control(
            'line_cap_style',
            [
                'label' => __('Line Cap Style', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'round' => __('Round', 'plugin-name'),
                    'butt' => __('Butt', 'plugin-name'),
                    'square' => __('Square', 'plugin-name'),
                ],
                'default' => 'round',
            ]
        );

        // Line Width Control
        $this->add_control(
            'line_width',
            [
                'label'   => __('Line Width', 'text-domain'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'   => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 6,
                    'unit' => 'px',
                ],
            ]
        );

        // Rotation Control (Appears only when rotation is enabled)
        $this->add_control(
            'rotation_angle',
            [
                'label'     => __('Rotation Angle (°)', 'text-domain'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range'     => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default'   => [
                    'size' => 0,  // Default rotation is 90 degrees
                    'unit' => 'deg',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Generate a unique ID for each widget instance
        $unique_id = uniqid('progress_circle_', true);

        // Get values from settings
        $progress_value = $settings['series_value'];
        $progress_bar_color = $settings['chart_color'];
        $background_stroke_color = $settings['background_stroke_color'];
        $value_text_color = $settings['value_text_color'];
        $line_cap_style = $settings['line_cap_style'];
        // Get user-defined Line Width
        $line_width = isset($settings['line_width']['size']) ? $settings['line_width']['size'] : 6;
       $canvas_width = isset($settings['canvas_width']['size']) ? $settings['canvas_width']['size'] : 120;
?>

        <style>
            .progress-container {
                position: relative;
                width: <?php echo esc_attr($canvas_width); ?><?php echo esc_attr($settings['canvas_width']['unit']); ?>;
                height: <?php echo esc_attr($canvas_width); ?><?php echo esc_attr($settings['canvas_width']['unit']); ?>;
            }

            .progress-text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 20px;
                font-weight: bold;
                color: <?php echo esc_attr($value_text_color); ?>;
            }

            canvas {
                position: absolute;
            }
        </style>

        <?php $rotation_angle = isset($settings['rotation_angle']['size']) ? $settings['rotation_angle']['size'] : 0; ?>
        <div class="progress-container">
            <canvas id="progressCanvas-<?php echo esc_attr($unique_id); ?>" style="transform: rotate(<?php echo esc_attr($rotation_angle); ?>deg);" width="<?php echo esc_attr($canvas_width); ?>" height="<?php echo esc_attr($canvas_width); ?>"></canvas>
            <div class="progress-text" id="progressText-<?php echo esc_attr($unique_id); ?>"><?php echo esc_html($progress_value); ?>%</div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("progressCanvas-<?php echo esc_attr($unique_id); ?>").getContext("2d"),
                    center = <?php echo esc_attr($canvas_width / 2); ?>,
                    radius = Math.min(<?php echo esc_attr($canvas_width); ?>, <?php echo esc_attr($canvas_width); ?>) / 2 - <?php echo esc_attr($line_width); ?>,
                    lw = <?php echo esc_js($line_width); ?>,
                    start = -Math.PI / 2;
                let progress = 0;

                function draw(p) {
                    ctx.clearRect(0, 0, <?php echo esc_attr($canvas_width); ?>, <?php echo esc_attr($canvas_width); ?>);
                    ctx.lineWidth = <?php echo esc_js($line_width); ?>;
                    ctx.lineCap = "<?php echo esc_js($line_cap_style); ?>";
                    ctx.strokeStyle = "<?php echo esc_js($background_stroke_color); ?>";
                    ctx.beginPath();
                    ctx.arc(center, center, radius, 0, 2 * Math.PI);
                    ctx.stroke();
                    ctx.strokeStyle = "<?php echo esc_js($progress_bar_color); ?>";
                    ctx.beginPath();
                    ctx.arc(center, center, radius, start, start + (p / 100) * 2 * Math.PI);
                    ctx.stroke();
                    document.getElementById("progressText-<?php echo esc_attr($unique_id); ?>").textContent = p + "%";
                }


                (function animate() {
                    if (progress <= <?php echo esc_js($progress_value); ?>) {
                        draw(progress++);
                        requestAnimationFrame(animate);
                    }
                })();
            });
        </script>

<?php
    }
}

$widgets_manager->register(new TP_Progress_circle_full());
