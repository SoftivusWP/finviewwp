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
use mtekk\adminKit\setting\setting;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Process extends Widget_Base
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
        return 'tp-working-process';
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
        return __('Working Process', 'tpcore');
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

        // work
        $this->start_controls_section(
            'finview_work_section_genaral',
            [
                'label' => esc_html__('Section', 'finview-core')
            ]
        );


        $this->add_control(
            'finview_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'finview-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'finview-core'),
                    'style_two' => esc_html__('Style Two', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_one_reborn_content',
            [
                'label' => esc_html__('Reborn', 'finview-core'),
            ]
        );

        $this->add_control(
            'one_reborn_show',
            [
                'label' => esc_html__('Hide Reborn?', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'finview_content_style_selection' => 'style_one',
                ]
            ]
        );
        $this->add_control(
            'title_img_reborn_show',
            [
                'label' => esc_html__('Hide Subtitle Image?', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );

        $this->end_controls_section();


        // Image
        $this->start_controls_section(
            'services_three_section_general_content',
            [
                'label' => esc_html__('Image', 'finview-core'),

            ]
        );

        $this->add_control(
            'finview_section_vector_image',
            [
                'label' => esc_html__('Choose Short Image', 'finview-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'finview_content_style_selection' => 'style_one',
                ]
            ]
        );

        $this->add_control(
            'finview_section_content_image',
            [
                'label' => esc_html__('Choose Image', 'finview-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'finview_content_style_selection' => 'style_two',
                ]
            ]
        );

        $this->end_controls_section();

        // Heading
        $this->start_controls_section(
            'services_three_heading_general_content',
            [
                'label' => esc_html__('Heading', 'finview-core'),

            ]
        );
        $this->add_control(
            'finview_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Working Process', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,

            ]
        );
        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Simplified Steps to Find Your Ideal Loan', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,

            ]
        );
        $this->add_control(
            'finview_heading_content_description',
            [
                'label' => esc_html__('Short Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Our working process is designed to make your loan search and selection as seamless as possible.', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),

            ]
        );

        $this->end_controls_section();


        // Card
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Card', 'finview-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_working_card_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'bi bi-hand-thumbs-up',
                    'library' => 'solid',
                ],
            ]
        );


        $repeater->add_control(
            'finview_card_title',
            [
                'label' => esc_html__('Card Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Research & Explore', 'finview-core'),
                'placeholder' => esc_html__('Type your Title here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'finview_card_descript',
            [
                'label' => esc_html__('Card Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('An online quote is an estimate of the cost of a product or service provided', 'finview-core'),
                'placeholder' => esc_html__('Type your Description here', 'finview-core'),
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
                        'finview_card_title' => esc_html__('Research & Explore', 'finview-core'),
                    ],
                    [
                        'finview_card_title' => esc_html__('Comparison Tools', 'finview-core'),
                    ],
                    [
                        'finview_card_title' => esc_html__('Reviews & Feedback', 'finview-core'),
                    ],
                    [
                        'finview_card_title' => esc_html__('Secure Your Loan', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_card_title }}}',

            ]
        );


        $this->end_controls_section();



        // ======================= Heading Style =================================//

        // Section 
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Section Area', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        // $this->add_control(
        //     'box_style_color',
        //     [
        //         'label'     => esc_html__('Background', 'plugin-name'),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .working-process:after' => 'background: {{VALUE}};',
        //         ],
        //     ]
        // );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__('Background Color', 'finview-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .working-process:after',
            ]
        );

        $this->add_responsive_control(
            'cus_background_overlay_opacity',
            [
                'label' => esc_html__('Opacity', 'finview-core'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .10,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .working-process::after' => 'opacity: {{SIZE}} !important;',
                ]
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
                    '{{WRAPPER}} .working-process:after' => 'height: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        $this->add_responsive_control(
            'box_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .box_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .box_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        // Subtitle 
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_content_style_selection' => ['style_three', 'style_four'],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'subtitle_style_typ',
                'selector' => '{{WRAPPER}} .sub-title',

            ]
        );

        $this->add_control(
            'subtitle_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        // Title 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_content_style_selection' => ['style_one', 'style_three', 'style_four'],
                ]
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

        //    Description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_content_style_selection' =>  ['style_three', 'style_four'],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'description_style_typ',
                'selector' => '{{WRAPPER}} .pp',

            ]
        );

        $this->add_control(
            'description_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();

        // card
        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__('Card', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'finview_heading_content_align',
            [
                'label'         => esc_html__('Heading Text Align', 'finview-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'finview-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'finview-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'finview-core'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'finview-core'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .section__header' => 'text-align: {{VALUE}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'finview_card_content_align',
            [
                'label'         => esc_html__('Card Align', 'finview-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'finview-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'finview-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'finview-core'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'finview-core'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .cus_cont' => 'text-align: {{VALUE}};',
                ],

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

        // card  Number 
        $this->start_controls_section(
            'card_no_icon_style',
            [
                'label' => esc_html__('Card Number', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'card_icon_no_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number-bullet' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_icon_no_bg',
            [
                'label'     => esc_html__('BG Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number-bullet' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_icon_no_border_radius',
            [
                'label'      => __('Number Border Radius', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .number-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // card  Icon 
        $this->start_controls_section(
            'card_icon_style',
            [
                'label' => esc_html__('Card Icon', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'card_icon_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_icon svg path' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_icon_bg_color',
            [
                'label'     => esc_html__('background', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_icon_top_bdr_hvr_color',
            [
                'label' => esc_html__('Btn Hover BG Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card:hover .cus_icon' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'card_icon_bdr_color',
            [
                'label' => esc_html__('Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon:after' => 'border:1px dashed {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .cus_card:hover .cus_icon:after',
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'card_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon or Image Size', 'plugin-name'),
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
                    '{{WRAPPER}} .cus_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cus_icon svg' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Box Size', 'plugin-name'),
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
                    '{{WRAPPER}} .cus_icon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );


        $this->add_responsive_control(
            'card_icon_border_radius',
            [
                'label'      => __('Border Radius', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'card_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_icon_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // card title
        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Card Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_title_style_typ',
                'selector' => '{{WRAPPER}} .card__title',

            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card__title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_title_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .card__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_title_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .card__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        // Card Description
        $this->start_controls_section(
            'card_des_style',
            [
                'label' => esc_html__('Card Description', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_des_style_typ',
                'selector' => '{{WRAPPER}} .cus_cont p',

            ]
        );

        $this->add_control(
            'card_des_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_cont p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_des_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_cont p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_des_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_cont p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
            .working-process .cus_icon,
            .working-process .cus_icon:after {
                transition: var(--transition);
            }

            .working-process .cus_icon i {
                font-size: 60px;
            }

            .working-process .cus_icon svg {
                width: 64px;
                height: 64px;
                object-fit: contain;
            }
        </style>


        <!-- working-process start -->
        <?php if ($settings['finview_content_style_selection'] == 'style_one') : ?>
            <section class="working-process section">
                <?php if (!empty($settings['one_reborn_show'] == 'yes')) : ?>
                    <img src="<?php echo esc_url($settings['finview_section_vector_image']['url']) ?>" alt="<?php esc_attr('Image') ?>" class="working__animation">
                <?php endif ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6 col-xxl-5">
                            <div class="section__header">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/title_vector.png" alt="<?php echo esc_attr('Image') ?>">
                                        <?php endif ?>
                                        <?php echo wp_kses($settings['finview_heading_content_subtitle'], wp_kses_allowed_html('post')) ?></span>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                                    <h2 class="title section__header-title wow fadeInUp" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_description'])) :   ?>
                                    <p class="xlr pp section__header-content wow fadeInDown" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 g-md-4  wow fadeInUp" data-wow-duration="0.8s">
                        <?php foreach ($settings['card_repeater'] as $key => $item) : ?>
                            <div class="col-12 col-sm-6 col-xxl-3">
                                <div class="cus_card card card--custom">
                                    <?php if (!empty($item['finview_working_card_icon'])) :   ?>
                                        <div class="cus_icon card__icon">
                                            <?php \Elementor\Icons_Manager::render_icon($item['finview_working_card_icon'], ['aria-hidden' => 'true']); ?>
                                            <span class="number-bullet"><?php echo esc_html($key + 1) ?></span>
                                        </div>
                                    <?php endif ?>
                                    <div class="card__content cus_cont">
                                        <?php if (!empty($item['finview_card_title'])) : ?>
                                            <h4 class="card__title"><?php echo esc_html($item['finview_card_title']) ?></h4>
                                        <?php endif ?>
                                        <?php if (!empty($item['finview_card_descript'])) : ?>
                                            <p class="card__des fs-small"> <?php echo esc_html($item['finview_card_descript']) ?> </p>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['finview_content_style_selection'] == 'style_two') : ?>
            <section class="how-works section section--space-top">
                <div class="container">
                    <div class="row align-items-center justify-content-center justify-content-lg-between gy-5 gy-lg-0">
                        <div class="col-12 col-sm-8 col-lg-6 col-xxl-5 order-1 order-lg-0">
                            <?php if (!empty($settings['finview_section_content_image']['url'])) : ?>
                                <div class="how-works__thumbs unset-xxl-left me-4 me-xxl-0 wow fadeInDown" data-wow-duration="0.8s">
                                    <img src="<?php echo esc_url($settings['finview_section_content_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col-12 col-lg-6 col-xxl-6">
                            <div class="section__content">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__content-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/title_vector.png" alt="<?php echo esc_attr('Image') ?>">
                                        <?php endif ?>
                                        <?php echo wp_kses($settings['finview_heading_content_subtitle'], wp_kses_allowed_html('post')) ?></span>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                                    <h2 class="title section__content-title wow fadeInUp" data-wow-duration="0.8s" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_description'])) :   ?>
                                    <p class="xlr pp section__content-text wow fadeInDown" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <div class="section__content-inner mt_60">
                                    <?php foreach ($settings['card_repeater'] as $key => $item) : ?>
                                        <div class="cus_card card wow fadeInUp" data-wow-duration="0.8s">
                                            <?php if (!empty($item['finview_working_card_icon'])) :   ?>
                                                <div class="cus_icon card__icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($item['finview_working_card_icon'], ['aria-hidden' => 'true']); ?>
                                                    <span class="number-bullet"><?php echo esc_html($key + 1) ?></span>
                                                </div>
                                            <?php endif ?>

                                            <div class="card__content">
                                                <?php if (!empty($item['finview_card_title'])) : ?>
                                                    <h4 class="card__title"><?php echo esc_html($item['finview_card_title']) ?></h4>
                                                <?php endif ?>
                                                <?php if (!empty($item['finview_card_descript'])) : ?>
                                                    <p class="card__des fs-small"> <?php echo esc_html($item['finview_card_descript']) ?> </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- working-process end -->

<?php
    }
}

$widgets_manager->register(new TP_Process());
