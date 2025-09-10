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
class TP_counter extends Widget_Base
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
        return 'tp-counter';
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
        return __('Counter', 'tpcore');
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

        // ====================================== Content One ============================================//

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Counter', 'finview-core'),
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_counter_card_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'finview-users',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'finview_counter_number',
            [
                'label' => esc_html__('Counter number', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('66.6', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'finview_counter_sign',
            [
                'label' => esc_html__('Counter Sign', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('k', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'finview_counter_text',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 10,
                'default' => esc_html__('Total Services Loan', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'card_repeater',
            [
                'label' => esc_html__('Counter Card', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_counter_number' => esc_html__('66.6', 'finview-core'),
                        'finview_counter_text' => esc_html__('Total Services Loan', 'finview-core'),
                    ],
                    [
                        'finview_counter_number' => esc_html__('99.5', 'finview-core'),
                        'finview_counter_text' => esc_html__('Customer Satisfaction', 'finview-core'),
                    ],
                    [
                        'finview_counter_number' => esc_html__('33.9', 'finview-core'),
                        'finview_counter_text' => esc_html__('Compare Loan', 'finview-core'),
                    ],
                    [
                        'finview_counter_number' => esc_html__('504', 'finview-core'),
                        'finview_counter_sign' => esc_html__('+', 'finview-core'),
                        'finview_counter_text' => esc_html__('Awards Won', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_counter_text }}}',

            ]
        );


        $this->end_controls_section();


        // ======================= Style =================================//

        // counter_card_bg_style
        $this->start_controls_section(
            'counter_bg_style',
            [
                'label' => esc_html__('Counter', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_bg_style_color',
            [
                'label'     => esc_html__('BG Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown:after ' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'counter_box_style_color',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );



        $this->end_controls_section();

        // counter_number_style
        $this->start_controls_section(
            'counter_number_style',
            [
                'label' => esc_html__('Counter Number', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'counter_number_style_typ',
                'selector' => '{{WRAPPER}} .countdown__title',

            ]
        );

        $this->add_control(
            'counter_number_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'counter_number_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // counter_text
        $this->start_controls_section(
            'counter_text_style',
            [
                'label' => esc_html__('Counter Text', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'counter_text_style_typ',
                'selector' => '{{WRAPPER}} .counter_text',

            ]
        );

        $this->add_control(
            'counter_text_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();



        // counter Icon 
        $this->start_controls_section(
            'counter_icon_style',
            [
                'label' => esc_html__('Counter Icon', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .countdown__icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .countdown__icon:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_icon_bgcolor',
            [
                'label'     => esc_html__('Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_bdr_color',
            [
                'label' => esc_html__('Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'bdr_counter_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon:hover' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'counter_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'finview-core'),
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
                    '{{WRAPPER}} .countdown__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'counter_icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Box Size', 'finview-core'),
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
                    '{{WRAPPER}} .countdown__icon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        // ======================= Style End=================================//

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
        <!-- ==== counter section start ==== -->
        <section class="countdown section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="countdown__area justify-content-center  justify-content-md-between">
                            <?php foreach ($settings['card_repeater'] as $item) : ?>
                                <div class="countdown__part wow fadeInUp" data-wow-duration="0.8s">
                                    <?php if (!empty($item['finview_counter_card_icon'])) :   ?>
                                        <div class="countdown__icon">
                                            <?php \Elementor\Icons_Manager::render_icon($item['finview_counter_card_icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="countdown__content">
                                        <?php if (!empty($item['finview_counter_number'])) :   ?>
                                            <h2 class="countdown__title display-4"><span class="odometer" data-odometer-final="<?php echo esc_html($item['finview_counter_number']) ?>"></span> <span><?php echo esc_html($item['finview_counter_sign']) ?></span></h2>
                                        <?php endif ?>
                                        <?php if (!empty($item['finview_counter_text'])) :   ?>
                                            <p class="counter_text"><?php echo wp_kses($item['finview_counter_text'], wp_kses_allowed_html('post'))  ?></p>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <span class="v-line d-none d-lg-block"></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== / counter section end ==== -->
<?php
    }
}

$widgets_manager->register(new TP_counter());
