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
class TP_testimonial extends Widget_Base
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
        return 'tp-testimonial';
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
        return __('Testimonial', 'tpcore');
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

        // testimonial
        $this->start_controls_section(
            'finview_testimonial_section_genaral',
            [
                'label' => esc_html__('Testimonial Section', 'finview-core')
            ]
        );

        $this->add_control(
            'finview_testimonial_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'finview-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'finview-core'),
                    'style_two' => esc_html__('Style Two', 'finview-core'),
                    'style_three' => esc_html__('Style Three', 'finview-core'),
                    'style_four' => esc_html__('Style Four', 'finview-core'),
                    'style_five' => esc_html__('Style Five', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->add_control(
            'image_area_switch',
            [
                'label' => esc_html__('Image', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'finview_testimonial_content_style_selection' => 'style_three',
                ]
            ]
        );

        $this->add_control(
            'finview_about_one_content_image2',
            [
                'label' => esc_html__('Choose Vector Image', 'finview-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'image_area_switch' => 'yes',
                    'finview_testimonial_content_style_selection' => 'style_three',
                ]
            ]
        );



        $this->end_controls_section();


        // ======================================Content One============================================//
        $this->start_controls_section(
            'testimonial_content_one',
            [
                'label' => esc_html__('Testimonial', 'finview-core'),

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
                    '{{WRAPPER}} .section__header' => 'text-align: {{VALUE}} !important;',
                ],
                'condition' => [
                    'finview_testimonial_content_style_selection' => ['style_one','style_two','style_three','style_four',]
                ]
            ]
        );

        $this->add_responsive_control(
            'finview_card_content_align',
            [
                'label'     => esc_html__('Card Text Align', 'finview-core'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'finview-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'finview-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'finview-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'finview-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => 'left',

                'selectors'     => [
                    '{{WRAPPER}} .cus_card' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .card--custom' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .testimonials__author' => 'justify-content: {{VALUE}}!important;',
                    '{{WRAPPER}} .quote_img' => 'justify-content: {{VALUE}}!important;',
                ],
            ]
        );



        $this->add_control(
            'quote_reborn_show',
            [
                'label' => esc_html__('Hide Quote Image?', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'condition' => [
                    'finview_testimonial_content_style_selection' => ['style_one','style_two','style_three','style_four',]
                ]
            ]
        );

        $this->add_control(
            'subtitle_img_reborn_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'title_img_reborn_show' => 'yes',
                    'finview_testimonial_content_style_selection' => ['style_one','style_two','style_three','style_four',]
                ]
            ]
        );

        $this->add_control(
            'finview_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Client Testimonials', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_testimonial_content_style_selection' => ['style_one','style_two','style_three','style_four',]
                ]
            ]
        );

        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Success Stories Shared by Our Customers', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_testimonial_content_style_selection' => ['style_one','style_two','style_three','style_four',]
                ]
            ]
        );

        $this->add_control(
            'finview_heading_content_description',
            [
                'label' => esc_html__('Short Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Feel free to customize the text with actual client testimonials, ensuring you have their permission to use their names and occupations', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
                'condition' => [
                    'finview_testimonial_content_style_selection' => ['style_one','style_two','style_three','style_four',]
                ]
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testi_rating',
            [
                'label' => esc_html__('Rating', 'finview-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

        $repeater->add_control(
            'testi_description',
            [
                'label' => esc_html__('Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Our satisfied clients have experienced success with our services and loan recommendations. Here are some of their testimonials highlighting their positive experiences and the value they received', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image', 'finview-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'testi_name',
            [
                'label' => esc_html__('Name', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Kende Attila', 'finview-core'),
                'placeholder' => esc_html__('Type your name here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testi_designation',
            [
                'label' => esc_html__('Designation', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('President of Sales', 'finview-core'),
                'placeholder' => esc_html__('Type your designation here', 'finview-core'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'testimonial_repeater',
            [
                'label' => esc_html__('Testimonial List', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testi_name' => esc_html__('Balogh Imre', 'finview-core'),
                        'testi_designation' => esc_html__('Account Executive', 'finview-core'),
                    ],
                    [
                        'testi_name' => esc_html__('Kende Attila', 'finview-core'),
                        'testi_designation' => esc_html__('President of Sales', 'finview-core'),
                    ],
                    [
                        'testi_name' => esc_html__('Eleanor Pena', 'finview-core'),
                        'testi_designation' => esc_html__('Marketing Director', 'finview-core'),
                    ],
                    [
                        'testi_name' => esc_html__('Balogh Imre', 'finview-core'),
                        'testi_designation' => esc_html__('Account Executive', 'finview-core'),
                    ],

                ],
                'title_field' => '{{{ testi_description }}}',

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
                'selector' => '{{WRAPPER}} .testimonials::after, {{WRAPPER}} .working-section4.testimonial4::before',
            ]
        );

        // Background Height
        $this->add_responsive_control(
            'section_bg_custom_dimensionsss',
            [
                'label' => esc_html__('Background Height', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000, // Increased for better flexibility
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials::after' => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .working-section4.testimonial4::before' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();



        // Subtitle 
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'subtitle_style_typ',
                'selector' => '{{WRAPPER}} .sub-title',

            ]
        );

        $this->add_control(
            'subtitle_svgstyle_color',
            [
                'label'     => esc_html__('icon Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'subtitle_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'golftio-core'),
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
                    '{{WRAPPER}} .sub-title i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sub-title svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
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
                'label'      => __('Padding', 'plugin-name'),
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

        // Description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'description_style_typ',
                'selector' => '{{WRAPPER}} .pp',

            ]
        );

        $this->add_control(
            'description_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
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
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();

        // =======================Button Style One===========================//


        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Pagination Button', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'button_typ',
                'selector' => '{{WRAPPER}} .pagination-button i',
            ]
        );


        // Icon box Size
        $this->add_responsive_control(
            'icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Pagination Box Size', 'plugin-name'),
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
                    '{{WRAPPER}} .pagination-button' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-button i' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-button:hover i' => 'color: {{VALUE}} !important;',
                ]
            ]
        );

        $this->add_control(
            'button_bgcolor',
            [
                'label'     => esc_html__('Pagination BG', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-button' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hvr_bgcolor',
            [
                'label'     => esc_html__(' Pagination Hover BG', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bdr_color',
            [
                'label' => esc_html__('Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-button' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-button:hover' => 'border:1px solid {{VALUE}}',
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
                    '{{WRAPPER}} .pagination-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .pagination-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .pagination-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        //    slider style
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



        // Star Icon 
        $this->start_controls_section(
            'facility_icon_star_style',
            [
                'label' => esc_html__('Star Icon', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'facility_icon_star_color',
            [
                'label'     => esc_html__('Icon Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star_review svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .star_review i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'star_icon_hover_color',
            [
                'label'     => esc_html__('Hover Icon Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star_review:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .star_review:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'star_icon_custom_dimensionsss',
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
                    '{{WRAPPER}} .star_review i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .star_review svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'facility_icon_star_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .star_review' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_icon_star_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .star_review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Review Description
        $this->start_controls_section(
            'slider_description_style',
            [
                'label' => esc_html__('Review Content', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'slider_description_style_typ',
                'selector' => '{{WRAPPER}} .review_text',

            ]
        );

        $this->add_control(
            'slider_description_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .review_text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_description_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .review_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_description_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .review_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();

        // Slider author
        $this->start_controls_section(
            'slider_author_style',
            [
                'label' => esc_html__('Slider author', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'slider_author_style_typ',
                'selector' => '{{WRAPPER}} .author__title',

            ]
        );

        $this->add_control(
            'slider_author_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author__title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_author_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .author__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_author_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .author__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();

        // Slider Deg
        $this->start_controls_section(
            'slider_deg_style',
            [
                'label' => esc_html__('Slider Deg', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'slider_deg_style_typ',
                'selector' => '{{WRAPPER}} .author__desi',

            ]
        );

        $this->add_control(
            'slider_deg_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author__desi' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_deg_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .author__desi' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_deg_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .author__desi' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

        <script>
            jQuery(document).ready(function($) {

                // testimonials-slider
                jQuery(".testimonials-slider")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        speed: 1500,
                        arrows: true,
                        dots: false,
                        prevArrow: jQuery(".prev-testimonials"),
                        nextArrow: jQuery(".next-testimonials"),
                        responsive: [{
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 1,
                            },
                        }],
                    });




                // testimonials-secondary slider
                jQuery(".testimonials-secondary_slider")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        speed: 1500,
                        arrows: true,
                        dots: false,
                        prevArrow: jQuery(".prev-testimonials"),
                        nextArrow: jQuery(".next-testimonials"),
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 2,
                                },
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                },
                            }
                        ],
                    });




                // testimonials-secondary slider
                jQuery(".testimonials-secondary_slider3")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        speed: 1500,
                        arrows: true,
                        dots: false,
                        prevArrow: jQuery(".prev-testimonials"),
                        nextArrow: jQuery(".next-testimonials"),
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 1,
                                },
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                },
                            }
                        ],
                    });
            });
        </script>

        <style>
            .testimonial4 .author__thumg img,
            .testionial-section5 .author__thumg img,
            .testimonials-section3 .author__thumg img,
            .testimonials .author__thumg img {
                height: 60px;
                min-height: 60px;
                width: 60px;
                min-width: 60px;
            }
        </style>



        <!-- Client Testimonials start -->
        <?php if ($settings['finview_testimonial_content_style_selection'] == 'style_one') : ?>
            <section class="testimonials section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6 col-xxl-5">
                            <div class="section__header">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <?php \Elementor\Icons_Manager::render_icon($settings['subtitle_img_reborn_icon'], ['aria-hidden' => 'true']); ?>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="testimonials-slider wow fadeInUp" data-wow-duration="0.8s">
                                <?php foreach ($settings['testimonial_repeater'] as $item) : ?>
                                    <div class="cus_card card card--custom position-relative">
                                        <?php if (!empty($settings['quote_reborn_show'])) :   ?>
                                            <div class="quote_img position-absolute">
                                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/quote.png" alt="<?php echo esc_attr('Image') ?>">
                                            </div>
                                        <?php endif ?>
                                        <div class="testimonials__author-review">
                                            <?php if (!empty($item['testi_rating'])) :   ?>
                                                <div class="star_review mb-3">
                                                    <?php for ($i = 0; $i < $item['testi_rating']; $i++) : ?>
                                                        <i class="bi bi-star-fill"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if (!empty($item['testi_description'])) :   ?>
                                                <p class="review_text"><?php echo esc_html($item['testi_description']) ?></p>
                                            <?php endif ?>
                                        </div>
                                        <div class="testimonials__author">
                                            <?php if (!empty($item['testimonial_image']['url'])) :   ?>
                                                <div class="author__thumg">
                                                    <img src="<?php echo esc_url($item['testimonial_image']['url']) ?>" class="rounded-circle" alt="<?php echo esc_attr('image') ?>">
                                                </div>
                                            <?php endif ?>
                                            <div class="author__content">
                                                <?php if (!empty($item['testi_name'])) :   ?>
                                                    <h5 class="author__title"><?php echo esc_html($item['testi_name']) ?></h5>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_designation'])) :   ?>
                                                    <p class="author__desi"><?php echo esc_html($item['testi_designation']) ?></p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="slider-navigation wow fadeInRight" data-wow-duration="1.2s">
                                <button class="prev-testimonials pagination-button">
                                    <i class="bi bi-chevron-left"></i>
                                </button>

                                <button class="next-testimonials pagination-button">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Client Testimonials end -->


        <!-- ==== testimonial section secondary start ==== -->
        <?php if ($settings['finview_testimonial_content_style_selection'] == 'style_two') : ?>
            <section class="testimonials testimonials--secondary section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6 col-xxl-5">
                            <div class="section__header">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <?php \Elementor\Icons_Manager::render_icon($settings['subtitle_img_reborn_icon'], ['aria-hidden' => 'true']); ?>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="testimonials-secondary_slider wow fadeInDown" data-wow-duration="0.8s">
                                <?php foreach ($settings['testimonial_repeater'] as $item) : ?>
                                    <div class="cus_card card card--custom position-relative">
                                        <?php if (!empty($settings['quote_reborn_show'])) :   ?>
                                            <div class="quote_img position-absolute">
                                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/quote.png" alt="<?php echo esc_attr('Image') ?>">
                                            </div>
                                        <?php endif ?>
                                        <div class="testimonials__author-review">
                                            <?php if (!empty($item['testi_rating'])) :   ?>
                                                <div class="star_review mb-3">
                                                    <?php for ($i = 0; $i < $item['testi_rating']; $i++) : ?>
                                                        <i class="bi bi-star-fill"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if (!empty($item['testi_description'])) :   ?>
                                                <p class="review_text"><?php echo esc_html($item['testi_description']) ?></p>
                                            <?php endif ?>
                                        </div>
                                        <div class="testimonials__author">
                                            <?php if (!empty($item['testimonial_image']['url'])) :   ?>
                                                <div class="author__thumg">
                                                    <img src="<?php echo esc_url($item['testimonial_image']['url']) ?>" class="rounded-circle" alt="<?php echo esc_attr('image') ?>">
                                                </div>
                                            <?php endif ?>
                                            <div class="author__content">
                                                <?php if (!empty($item['testi_name'])) :   ?>
                                                    <h5 class="author__title"><?php echo esc_html($item['testi_name']) ?></h5>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_designation'])) :   ?>
                                                    <p class="author__desi"><?php echo esc_html($item['testi_designation']) ?></p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="slider-navigation wow fadeInRight" data-wow-duration="1.2s">
                                <button class="prev-testimonials pagination-button">
                                    <i class="bi bi-chevron-left"></i>
                                </button>

                                <button class="next-testimonials pagination-button">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== testimonial section secondary end ==== -->
        <?php if ($settings['finview_testimonial_content_style_selection'] == 'style_three') : ?>
            <!-- Client Testimonials start -->
            <section class="testimonials-section3 section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6 col-xxl-6">
                            <div class="section__header">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <?php \Elementor\Icons_Manager::render_icon($settings['subtitle_img_reborn_icon'], ['aria-hidden' => 'true']); ?>
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
                    <div class="row g-4 gy-5 justify-content-center justify-content-lg-between">
                        <div class="<?php echo ($settings['image_area_switch'] == 'yes') ? 'col-lg-7' : 'col-12'; ?> position-relative ">
                            <div class="testimonials-secondary_slider3 wow fadeInDown" data-wow-duration="0.8s">
                                <?php foreach ($settings['testimonial_repeater'] as $item) : ?>
                                    <div class="card p-0">
                                        <div class="testimonials__author-review mb-4">
                                            <?php if (!empty($item['testi_rating'])) :   ?>
                                                <div class="star_review mb-3">
                                                    <?php for ($i = 0; $i < $item['testi_rating']; $i++) : ?>
                                                        <i class="bi bi-star-fill"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if (!empty($item['testi_description'])) :   ?>
                                                <p class="review_text"><?php echo esc_html($item['testi_description']) ?></p>
                                            <?php endif ?>
                                        </div>
                                        <div class="testimonials__author d-flex align-items-center gap-xxl-4 gap-2">
                                            <?php if (!empty($item['testimonial_image']['url'])) :   ?>
                                                <div class="author__thumg">
                                                    <img src="<?php echo esc_url($item['testimonial_image']['url']) ?>" class="rounded-circle box_15" alt="<?php echo esc_attr('image') ?>">
                                                </div>
                                            <?php endif ?>
                                            <div class="author__content">
                                                <?php if (!empty($item['testi_name'])) :   ?>
                                                    <h5 class="author__title"><?php echo esc_html($item['testi_name']) ?></h5>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_designation'])) :   ?>
                                                    <span class="author__desi"><?php echo esc_html($item['testi_designation']) ?></span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="slider-navigation d-flex mt-0 justify-content-end">
                                <button class="prev-testimonials pagination-button">
                                    <i class="bi bi-chevron-left"></i>
                                </button>

                                <button class="next-testimonials pagination-button">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="<?php echo ($settings['image_area_switch'] == 'yes') ? 'col-xl-4 col-lg-5 d-none d-lg-flex' : ''; ?>">
                            <?php if (!empty($settings['finview_about_one_content_image2']['url'])) : ?>
                                <div class="testimonial-thumv3 text-center">
                                    <img src="<?php echo esc_url($settings['finview_about_one_content_image2']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Client Testimonials end -->

        <?php endif; ?>


        <!-- Client Testimonials start -->
        <?php if ($settings['finview_testimonial_content_style_selection'] == 'style_four') : ?>
            <section class="working-section4 testimonial4">
                <div class="container">
                    <div class="section__header text-center m-auto mb-xxl-5 mb-5">
                        <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                            <span class="sub-title section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                    <?php \Elementor\Icons_Manager::render_icon($settings['subtitle_img_reborn_icon'], ['aria-hidden' => 'true']); ?>
                                <?php endif ?>
                                <?php echo wp_kses($settings['finview_heading_content_subtitle'], wp_kses_allowed_html('post')) ?>
                            </span>
                        <?php endif ?>
                        <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                            <h2 class="title section__header-title wow fadeInUp" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                        <?php endif ?>
                        <?php if (!empty($settings['finview_heading_content_description'])) :   ?>
                            <p class="xlr pp section__header-content wow fadeInDown" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                        <?php endif ?>
                    </div>
                    <div class="testimonials-secondary_slider wow fadeInDown" data-wow-duration="0.8s">
                        <?php foreach ($settings['testimonial_repeater'] as $item) : ?>
                            <div class="card card--custom position-relative">
                                <div class="testimonials__author-review">
                                    <?php if (!empty($item['testi_rating'])) :   ?>
                                        <div class="star_review mb-3">
                                            <?php for ($i = 0; $i < $item['testi_rating']; $i++) : ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($item['testi_description'])) :   ?>
                                        <p class="review_text text-start"><?php echo esc_html($item['testi_description']) ?></p>
                                    <?php endif ?>
                                </div>
                                <div class="testimonials__author d-flex justify-content-between w-100 mb-4">
                                    <div class="author__content text-start">
                                        <?php if (!empty($item['testi_name'])) :   ?>
                                            <h5 class="author__title"><?php echo esc_html($item['testi_name']) ?></h5>
                                        <?php endif ?>
                                        <?php if (!empty($item['testi_designation'])) :   ?>
                                            <p class="author__desi"><?php echo esc_html($item['testi_designation']) ?></p>
                                        <?php endif ?>
                                    </div>
                                    <?php if (!empty($settings['quote_reborn_show'])) :   ?>
                                        <div class="quote_img position-absolute">
                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/quote2.png" class="element-quote" alt="<?php echo esc_attr('Image') ?>">
                                        </div>
                                    <?php endif ?>
                                </div>
                                <?php if (!empty($item['testimonial_image']['url'])) :   ?>
                                    <div class="author__thumg">
                                        <img src="<?php echo esc_url($item['testimonial_image']['url']) ?>" class="rounded-circle" alt="<?php echo esc_attr('image') ?>">
                                    </div>
                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="slider-navigation wow fadeInRight" data-wow-duration="1.2s">
                        <button class="prev-testimonials pagination-button">
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <button class="next-testimonials pagination-button">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Client Testimonials end -->

        <!-- Client Testimonials start -->
        <?php if ($settings['finview_testimonial_content_style_selection'] == 'style_five') : ?>
            <section class="testionial-section5 cmn-bg section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 position-relative">
                            <div class="testimonials-secondary_slider3 wow fadeInDown" data-wow-duration="0.8s">
                                <?php foreach ($settings['testimonial_repeater'] as $item) : ?>
                                    <div class="card cus_card testimonial-items5 p-0 bg-transparent">
                                        <div class="box">
                                            <div class="testimonials__author-review mb-4">
                                                <?php if (!empty($settings['quote_reborn_show'])) :   ?>
                                                    <div class="quote_img d-flex">
                                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/quote3.png" class="mb-xl-4 mb-4 quote5-icon text-center" alt="<?php echo esc_attr('Image') ?>">
                                                    </div>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_rating'])) :   ?>
                                                    <div class="star_review justify-content-center mb-3">
                                                        <?php for ($i = 0; $i < $item['testi_rating']; $i++) : ?>
                                                            <i class="bi bi-star-fill"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_description'])) :   ?>
                                                    <p class="review_text"><?php echo esc_html($item['testi_description']) ?></p>
                                                <?php endif ?>
                                            </div>
                                            <div class="testimonials__author d-flex justify-content-center align-items-center gap-xxl-4 gap-2">
                                                <?php if (!empty($item['testimonial_image']['url'])) :   ?>
                                                    <div class="author__thumg">
                                                        <img src="<?php echo esc_url($item['testimonial_image']['url']) ?>" class="rounded-circle" alt="<?php echo esc_attr('image') ?>">
                                                    </div>
                                                <?php endif ?>
                                                <div class="author__content text-start">
                                                    <?php if (!empty($item['testi_name'])) :   ?>
                                                        <h5 class="author__title"><?php echo esc_html($item['testi_name']) ?></h5>
                                                    <?php endif ?>
                                                    <?php if (!empty($item['testi_designation'])) :   ?>
                                                        <p class="author__desi"><?php echo esc_html($item['testi_designation']) ?></p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="slider-navigation d-flex justify-content-between wow fadeInRight"
                                data-wow-duration="1.2s">
                                <button class="prev-testimonials pagination-button">
                                    <i class="bi bi-chevron-left"></i>
                                </button>

                                <button class="next-testimonials pagination-button">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Client Testimonials end -->
<?php
    }
}

$widgets_manager->register(new TP_testimonial());
