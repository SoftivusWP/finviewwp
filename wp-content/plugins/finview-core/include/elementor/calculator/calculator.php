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
class TP_calculator extends Widget_Base
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
        return 'tp-calculator';
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
        return __('Calculator', 'tpcore');
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


        // choose content
        $this->start_controls_section(
            'choose_content',
            [
                'label' => esc_html__('Calculator Content', 'finview-core'),

            ]
        );


        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Calculator', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_heading_result_title',
            [
                'label' => esc_html__('Result Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Result', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_loan_title',
            [
                'label' => esc_html__('Loan 1', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 10,
                'default' => esc_html__('Loan 01', 'finview-core'),
                'placeholder' => esc_html__('Type your loan name here', 'finview-core'),
            ]
        );
        $this->add_control(
            'finview_loan2_title',
            [
                'label' => esc_html__('Loan 2', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 10,
                'default' => esc_html__('Loan 02', 'finview-core'),
                'placeholder' => esc_html__('Type your loan name here', 'finview-core'),
            ]
        );
        $this->add_control(
            'finview_calculator_result_note',
            [
                'label' => esc_html__('Result Note', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 10,
                'default' => esc_html__('Learn about the pros and cons of a shorter-term mortgage or how to get preapproved for a mortgage.', 'finview-core'),
                'placeholder' => esc_html__('Type your Note here', 'finview-core'),
            ]
        );


        $this->end_controls_section();

        // ======================= Style =================================//
        // card
        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__('Card', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_style_color',
            [
                'label'     => esc_html__('Background Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_inner_style_color',
            [
                'label'     => esc_html__('Inner Background Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_inner_hover_style_color',
            [
                'label'     => esc_html__('Inner Background Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card:hover::after' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'card_inner_border_radius',
            [
                'label'      => __('Card Inner Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_card:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'card_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();
        // Title 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'title_style_typ',
                'selector' => '{{WRAPPER}} .title',

            ]
        );

        $this->add_control(
            'title_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
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
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Loan title 
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Loan Title', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'subtitle_style_typ',
                'selector' => '{{WRAPPER}} .calculator__title',

            ]
        );

        $this->add_control(
            'subtitle_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calculator__title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .calculator__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .calculator__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();



        // label
        $this->start_controls_section(
            'label_style',
            [
                'label' => esc_html__('label', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'label_style_typ',
                'selector' => '{{WRAPPER}} .label',

            ]
        );

        $this->add_control(
            'label_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'label_style_span_color',
            [
                'label'     => esc_html__('Sub Content Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .label span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();



        // result
        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Result', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'card_title_style_typ',
                'selector' => '{{WRAPPER}} .input-single p',
            ]
        );

        $this->add_control(
            'pricing_list_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .input-single p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pricing_note_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .note' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_list_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_list_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();




        // Button Style//

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'button_typ',
                'selector' => '{{WRAPPER}} .btn_theme',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_bgcolor',
            [
                'label'     => esc_html__('Btn BG Primary', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hvr_bgcolor',
            [
                'label'     => esc_html__(' Btn Hover BG Primary', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme:after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_hvr_bgcolor',
            [
                'label'     => esc_html__('Btn Secondary BG', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_alt' => 'background: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_bgcolor',
            [
                'label'     => esc_html__('Btn Secondary BG Hover', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt:after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bdr_color',
            [
                'label' => esc_html__('Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme:hover' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .btn_theme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .btn_theme' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .btn_theme' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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


        <!-- Calculator start -->
        <section class="calculator">
            <div class="calculator-input">
                <div class="cus_card card card--custom calc">
                    <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                        <h3 class="title text-start wow fadeInLeft" data-wow-duration="0.8s"> <?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?> </h3>
                    <?php endif ?>
                    <div class="card--custom__loan">
                        <div class="card--custom__form">
                            <form method="POST" autocomplete="off" id="frmCalculate" class="calculate__form">
                                <div class="row gy-5 gy-md-0">
                                    <div class="col-12 col-md-6">
                                        <h5 class="calculator__title"><?php echo esc_html($settings['finview_loan_title']) ?></h5>
                                        <div class="calculate__form-part">
                                            <div class="input-single">
                                                <label class="label" for="amount"><?php echo esc_html__('Loan Amount', 'finview-core') ?> <span><?php echo esc_html__('(required)', 'finview-core') ?></span></label>
                                                <input type="number" class="form-control" name="amount" id="amount" placeholder="$0" required>
                                            </div>
                                            <div class="input-single">
                                                <label class="label" for="year"><?php echo esc_html__('Loan Term', 'finview-core') ?> <span><?php echo esc_html__('(years)', 'finview-core') ?></span></label>
                                                <input type="number" class="form-control" name="year" id="year" placeholder="0 years">
                                            </div>
                                            <div class="input-single">
                                                <label class="label" for="interest"><?php echo esc_html__('Interest Rate (%)', 'finview-core') ?> <span><?php echo esc_html__('(required)', 'finview-core') ?></span></label>
                                                <input type="number" class="form-control" name="interest" id="interest" placeholder="0.00%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <h5 class="calculator__title"><?php echo esc_html($settings['finview_loan2_title']) ?></h5>
                                        <div class="calculate__form-part">
                                            <div class="input-single">
                                                <label class="label" for="amount2"><?php echo esc_html__('Loan Amount', 'finview-core') ?> <span><?php echo esc_html__('(required)', 'finview-core') ?></span></label>
                                                <input type="number" class="form-control" name="amount2" id="amount2" placeholder="$0" required>
                                            </div>
                                            <div class="input-single">
                                                <label class="label" for="year2"><?php echo esc_html__('Loan Term', 'finview-core') ?> <span><?php echo esc_html__('(years)', 'finview-core') ?></span></label>
                                                <input type="number" class="form-control" name="year2" id="year2" placeholder="0 years">
                                            </div>
                                            <div class="input-single">
                                                <label class="label" for="interest2"><?php echo esc_html__('Interest Rate (%)', 'finview-core') ?> <span><?php echo esc_html__('(required)', 'finview-core') ?></span></label>
                                                <input type="number" class="form-control" name="interest2" id="interest2" placeholder="0.00%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span id="CalcMsg"></span>
                                <button type="submit" class="btn_theme mt_40" name="calc_submit" id="calc_submit"><?php echo esc_html__('Calculate', 'finview-core') ?> <i class="bi bi-arrow-up-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="cus_card card card--custom calculator-result">
                    <?php if (!empty($settings['finview_heading_result_title'])) :   ?>
                        <h3 class="title"> <?php echo wp_kses($settings['finview_heading_result_title'], wp_kses_allowed_html('post'))  ?> </h3>
                    <?php endif ?>
                    <div class="card--custom__loan">
                        <div class="card--custom__form">
                            <div class="calculate__form">
                                <div class="row gy-5 gy-md-0">
                                    <div class="col-12 col-md-6">
                                        <h5 class="calculator__title"><?php echo esc_html($settings['finview_loan_title']) ?></h5>
                                        <div class="calculate__form-part">
                                            <div class="input-single">
                                                <label class="label"><?php echo esc_html__('Monthly cost', 'finview-core') ?> </label>
                                                <p class="headingFour" id="monthly_cost"></p>
                                            </div>
                                            <div class="input-single">
                                                <label class="label"><?php echo esc_html__('Total cost', 'finview-core') ?></label>
                                                <p class="headingFour" id="total_value"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <h5 class="calculator__title"><?php echo esc_html($settings['finview_loan2_title']) ?></h5>
                                        <div class="calculate__form-part">
                                            <div class="input-single">
                                                <label class="label"><?php echo esc_html__('Monthly cost', 'finview-core') ?> </label>
                                                <p class="headingFour" id="monthly_cost2"></p>
                                            </div>
                                            <div class="input-single">
                                                <label class="label"><?php echo esc_html__('Total cost', 'finview-core') ?></label>
                                                <p class="headingFour" id="total_value2"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt_32">
                                        <?php if (!empty($settings['finview_calculator_result_note'])) :   ?>
                                            <p class="note"><span class=""><?php echo esc_html__('MORE:', 'finview-core') ?></span>
                                                <?php echo wp_kses($settings['finview_calculator_result_note'], wp_kses_allowed_html('post'))  ?>
                                            </p>
                                        <?php endif ?>
                                        <a href="<?php echo home_url() ?>" class="btn_theme mt_40"><?php echo esc_html__('Back', 'finview-core') ?> <i class="bi bi-arrow-up-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Calculator end -->

<?php
    }
}

$widgets_manager->register(new TP_calculator());
