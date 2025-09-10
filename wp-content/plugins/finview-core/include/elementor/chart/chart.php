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
class TP_Progress_circles extends Widget_Base
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
        return 'tp-progress-circles-chart';
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
        return __('Progress Circles Chart', 'tpcore');
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

        // ======================================Content One============================================//
        $this->start_controls_section(
            'chart_content_one',
            [
                'label' => esc_html__('Progress Circles', 'finview-core'),

            ]
        );

        // Chart Size
        $this->add_responsive_control(
            'chart_width_custom_dimensionsss',
            [
                'label' => esc_html__('Chart Width', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .chart-items .chart_width' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'series_value',
            [
                'label' => __('Series Value', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 80,
            ]
        );

        $this->add_control(
            'chart_color',
            [
                'label' => __('Chart Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#074C3E',
            ]
        );

        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Total Services Loan', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // ======================= Style =================================//
        // Section 
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Section Area', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__('Background Color', 'finview-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .chart::after',
            ]
        );

        // bg Size
        $this->add_responsive_control(
            'section_bg_custom_dimensionsss',
            [
                'label' => esc_html__('Background Height', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .chart::after' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );



        $this->end_controls_section();



        // Title 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'title_style_typ',
                'selector' => '{{WRAPPER}} .title',

            ]
        );

        $this->add_control(
            'title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
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

?>

        <style>
            .chart-items {
                max-width: fit-content;
                margin: -15px 0 0 -40px;
            }
        </style>

        <?php
        $chart_id = 'chart_' . uniqid();
        ?>
        <!-- Client Charts start -->
        <div class="d-flex flex-column gap-3 chart-items m-0">
            <div id="<?php echo esc_attr($chart_id); ?>" class="chart_width"></div>
            <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                <span class="cus_title fs-seven fw-500 test text-center"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></span>
            <?php endif ?>
        </div>
        <!-- Client Charts end -->

        <?php
        $series_value = !empty($settings['series_value']) ? intval($settings['series_value']) : 80; // Default value
        $chart_color = !empty($settings['chart_color']) ? esc_attr($settings['chart_color']) : '#074C3E'; // Default color
        ?>

        <script>
            jQuery(document).ready(function($) {
                function createChartOptions(seriesValue, color) {
                    return {
                        series: [seriesValue],
                        chart: {
                            type: 'radialBar',
                            offsetY: -0,
                            sparkline: {
                                enabled: true
                            }
                        },
                        plotOptions: {
                            radialBar: {
                                startAngle: -90,
                                endAngle: 90,
                                track: {
                                    background: "#074c3e0d",
                                    strokeWidth: '97%',
                                    margin: 5,
                                    dropShadow: {
                                        enabled: true,
                                        top: 2,
                                        left: 0,
                                        color: '#999',
                                        opacity: 1,
                                        blur: 2
                                    }
                                },
                                hollow: {
                                    size: '70%',
                                },
                                dataLabels: {
                                    name: {
                                        show: false
                                    },
                                    value: {
                                        offsetY: -2,
                                        fontSize: '22px',
                                        fontWeight: '700'
                                    }
                                }
                            }
                        },
                        grid: {
                            padding: {
                                top: -10
                            }
                        },
                        fill: {
                            colors: [color],
                            type: 'solid',
                            gradient: {
                                shade: 'light',
                                shadeIntensity: 0.4,
                                inverseColors: false,
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [0, 50, 53, 91]
                            },
                        },
                        stroke: {
                            lineCap: "round",
                        },
                        labels: ['Average Results'],
                    };
                }

                // Pass PHP values to JavaScript
                var seriesValue = <?php echo $series_value; ?>; // PHP variable for value
                var chartColor = "<?php echo $chart_color; ?>"; // PHP variable for color
                var chartId = "<?php echo esc_js($chart_id); ?>";

                // Initialize the chart
                var chart1 = new ApexCharts(document.querySelector("#" + chartId), createChartOptions(seriesValue, chartColor));
                chart1.render();
            });
        </script>

<?php
    }
}

$widgets_manager->register(new TP_Progress_circles());
