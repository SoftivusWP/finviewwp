<?php

namespace TPCore\Widgets;

use Elementor\Conditions;
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
class TP_Choose extends Widget_Base
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
        return 'tp-choose';
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
        return __('Choose Us', 'tpcore');
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

        // choose
        $this->start_controls_section(
            'finview_choose_section_genaral',
            [
                'label' => esc_html__('Choose Us Section', 'finview-core')
            ]
        );


        $this->add_control(
            'finview_choose_content_style_selection',
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

        // Reborn
        $this->start_controls_section(
            'finview_reborn_content',
            [
                'label' => esc_html__('Reborn', 'finview-core'),
            ]
        );

        $this->add_control(
            'one_reborn_show',
            [
                'label' => esc_html__('Show Reborn?', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'finview_choose_content_style_selection' => 'style_one',
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

        // choose content
        $this->start_controls_section(
            'choose_content',
            [
                'label' => esc_html__('Choose Content', 'finview-core'),

            ]
        );

        $this->add_control(
            'finview_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Why Choose Us', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Experience Excellence in Loan Review and Comparison', 'finview-core'),
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
                'default' => esc_html__('Our dedicated team of experts conducts thorough research and analysis to provide you with comprehensive and unbiased reviews of various loan options.', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_list_content',
            [
                'label' => esc_html__('list content', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Comprehensive and Reviews', 'finview-core'),
                'placeholder' => esc_html__('Type your list content here', 'finview-core'),
            ]
        );

        $this->add_control(
            'list_repeater',
            [
                'label' => esc_html__('List Content', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_list_content' => esc_html__('Comprehensive and Reviews', 'finview-core'),
                    ],
                    [
                        'finview_list_content' => esc_html__('Expert Guidance and Insights', 'finview-core'),
                    ],
                    [
                        'finview_list_content' => esc_html__('User-Friendly Comparison', 'finview-core'),
                    ],
                    [
                        'finview_list_content' => esc_html__('Trusted User Reviews', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_list_content }}}',
                'condition' => [
                    'finview_choose_content_style_selection' => 'style_one',
                ]
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_card_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'bi bi-emoji-smile-fill',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'finview_card_title',
            [
                'label' => esc_html__(' Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Expertise & Objectivity', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'finview_card_text',
            [
                'label' => esc_html__('Short Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('With years of experience in the financial industry', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
            ]
        );


        $this->add_control(
            'card_repeater',
            [
                'label' => esc_html__('Card', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_card_title' => esc_html__('Expertise & Objectivity', 'finview-core'),
                        'finview_card_text' => esc_html__('With years of experience in the financial industry', 'finview-core'),
                    ],
                    [
                        'finview_card_title' => esc_html__('Loan Database', 'finview-core'),
                        'finview_card_text' => esc_html__('We have curated a comprehensive database of loan products ', 'finview-core'),
                    ],
                    [
                        'finview_card_title' => esc_html__('Transparent Comparison', 'finview-core'),
                        'finview_card_text' => esc_html__('Our user-friendly loan comparison tools allow you to effortlessly', 'finview-core'),
                    ],
                    [
                        'finview_card_title' => esc_html__('Reviews and Ratings', 'finview-core'),
                        'finview_card_text' => esc_html__('We pride ourselves on providing unbiased loan reviews', 'finview-core'),
                    ],

                ],
                'title_field' => '{{{ finview_card_title }}}',
                'condition' => [
                    'finview_choose_content_style_selection' => 'style_two',
                ]
            ]
        );


        // Button text
        $this->add_control(
            'finview_content_button',
            [
                'label' => esc_html__('Button', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'finview-core'),
                'placeholder' => esc_html__('Type your button here', 'finview-core'),
                'label_block' => true,
            ]
        );

        // Button URL
        $this->add_control(
            'finview_content_button_url',
            [
                'label' => esc_html__('Button URL', 'finview-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'finview-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        // Image
        $this->add_control(
            'finview_choose_content_image',
            [
                'label' => esc_html__('Choose Image', 'finview-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->end_controls_section();

        // ======================= Style =================================//

        // Subtitle 
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
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

        // Description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
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



        // list
        $this->start_controls_section(
            'card_list_style',
            [
                'label' => esc_html__('List', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_choose_content_style_selection' => 'style_one',
                ]

            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'card_list_style_typ',
                'selector' => '{{WRAPPER}} .cus_list li',
            ]
        );

        $this->add_control(
            'pricing_list_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_list li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_list li::marker' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_list li i' => 'color: {{VALUE}};',
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

        // card Icon 
        $this->start_controls_section(
            'card_icon_style',
            [
                'label' => esc_html__('Card Icon', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_choose_content_style_selection' => 'style_two',
                ]
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
            'card_icon_bdr_color',
            [
                'label' => esc_html__('Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'border:1px dashed {{VALUE}}',
                ],
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


        // card Content
        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Card Content', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_choose_content_style_selection' => 'style_two',
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Card TitleTypography', 'finview-core'),
                'name'     => 'card_title_style_typ',
                'selector' => '{{WRAPPER}} .cart_title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Card Deatails Typography', 'finview-core'),
                'name'     => 'card_det_style_typ',
                'selector' => '{{WRAPPER}} .cart_text',
            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Title Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_des_style_color',
            [
                'label'     => esc_html__('Description Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_title_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cart_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_title_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cart_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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


        <style>
            .why-choose .cus_icon svg,
            .why-choose .cus_icon i,
            .choose-us .cus_icon svg,
            .choose-us .cus_icon i {
                font-size: 36px;
                height: 36px;
                width: 36px;
            }
        </style>

        <!-- ==== choose section one start ==== -->
        <?php if ($settings['finview_choose_content_style_selection'] == 'style_one') : ?>
            <!-- Choose Us start -->
            <section class="choose-us ">
                <?php if (!empty($settings['one_reborn_show'] == 'yes')) :   ?>
                    <div class="animation">
                        <div class="animation">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/hero_vector_arrow.png" alt="<?php echo esc_attr('Image') ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/choose_vector.png" alt="<?php echo esc_attr('Image') ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/Elements.png" alt="<?php echo esc_attr('Image') ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/Elelement.png" alt="<?php echo esc_attr('Image') ?>">
                        </div>
                    </div>
                <?php endif ?>
                <div class="container">
                    <div class="row gy-5 gy-lg-0 justify-content-between align-items-center section">
                        <div class="col-12 col-md-8 col-lg-5 mx-auto mx-lg-0 order-1 order-lg-0">
                            <?php if (!empty($settings['finview_choose_content_image']['url'])) : ?>
                                <div class="choose-us__thumb me-xl-4 me-xxl-0 wow fadeInUp" data-wow-duration="0.8s">
                                    <img src="<?php echo esc_url($settings['finview_choose_content_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col-12 col-lg-7 col-xxl-6">
                            <div class="section__content ms-lg-4 ms-xl-0">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__content-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/title_vector.png" alt="<?php echo esc_attr('Image') ?>">
                                        <?php endif ?>
                                        <?php echo wp_kses($settings['finview_heading_content_subtitle'], wp_kses_allowed_html('post')) ?>
                                    </span>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                                    <h2 class="title section__content-title wow fadeInUp" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_description'])) :   ?>
                                    <p class="xlr pp section__content-text wow fadeInDown" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>


                                <div class="section__content-inner wow fadeInUp" data-wow-duration="0.8s">
                                    <ul class="cus_list">
                                        <?php foreach ($settings['list_repeater'] as $item) : ?>
                                            <li class="headingFive"> <i class="bi bi-check2-circle"></i> <?php echo !empty($item['finview_list_content']) ? esc_html($item['finview_list_content']) : ''; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php if (!empty($settings['finview_content_button'])) : ?>
                                    <div class="btn-cta">
                                        <a href="<?php echo esc_html($settings['finview_content_button_url']['url']) ?>" class="btn_theme mt_40"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== choose section one start ==== -->


        <!-- ==== choose section two start ==== -->
        <?php if ($settings['finview_choose_content_style_selection'] == 'style_two') : ?>
            <section class="why-choose section">
                <div class="container">
                    <div class="row align-items-center justify-content-center justify-content-lg-between gy-5 gy-lg-0">
                        <div class="col-12 col-sm-8 col-lg-6 col-xxl-5 order-1 order-lg-0">
                            <?php if (!empty($settings['finview_choose_content_image']['url'])) : ?>
                                <div class="how-works__thumbs previewShapeY unset-xxl-left me-4 me-xxl-0 wow fadeInDown" data-wow-duration="0.8s">
                                    <img src="<?php echo esc_url($settings['finview_choose_content_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
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
                                        <?php echo wp_kses($settings['finview_heading_content_subtitle'], wp_kses_allowed_html('post')) ?>
                                    </span>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                                    <h2 class="title section__content-title wow fadeInUp" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_description'])) :   ?>
                                    <p class="xlr pp section__content-text wow fadeInDown" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <div class="section__content-inner">
                                    <?php foreach ($settings['card_repeater'] as $item) : ?>
                                        <div class="card wow fadeInDown" data-wow-duration="0.8s">
                                            <?php if (!empty($item['finview_card_icon'])) : ?>
                                                <div class="cus_icon card__icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($item['finview_card_icon'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif ?>

                                            <div class="card__content">
                                                <?php if (!empty($item['finview_card_title'])) :   ?>
                                                    <h5 class="cart_title card__title"><?php echo esc_html($item['finview_card_title']) ?></h5>
                                                <?php endif ?>
                                                <?php if (!empty($item['finview_card_text'])) :   ?>
                                                    <p class="cart_text fs-small"><?php echo esc_html($item['finview_card_text']) ?></p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <?php if (!empty($settings['finview_content_button'])) : ?>
                                    <div class="btn-cta">
                                        <a href="<?php echo esc_html($settings['finview_content_button_url']['url']) ?>" class="btn_theme mt_40 wow fadeInDown" data-wow-duration="0.8s"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== choose section two End ==== -->

<?php
    }
}

$widgets_manager->register(new TP_Choose());
