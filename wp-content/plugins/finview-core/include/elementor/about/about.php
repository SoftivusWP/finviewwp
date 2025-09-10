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
class TP_about extends Widget_Base
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
        return 'tp-about';
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
        return __('about', 'tpcore');
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

        // about
        $this->start_controls_section(
            'finview_about_section_genaral',
            [
                'label' => esc_html__('About Section', 'finview-core')
            ]
        );


        $this->add_control(
            'finview_about_content_style_selection',
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
                    'finview_about_content_style_selection' => 'style_one',
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

        // about content
        $this->start_controls_section(
            'about_content',
            [
                'label' => esc_html__('Content', 'finview-core'),

            ]
        );

        $this->add_control(
            'finview_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('About Us', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Your Trusted Source for Loan Reviews and Comparison', 'finview-core'),
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
                'default' => esc_html__('We are dedicated to providing you with a reliable and user-friendly platform for loan reviews and comparison. With a mission to simplify the loan selection', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
            ]
        );

        $this->add_control(
            'finview_marketing_bar_title',
            [
                'label' => esc_html__('Progress Bar Value', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Marketing', 'finview-core'),
                'placeholder' => esc_html__('Type your Text here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_about_content_style_selection' => 'style_two',
                ]
            ]
        );
        $this->add_control(
            'finview_marketing_bar',
            [
                'label' => esc_html__('Progress Bar Value', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('85%', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_about_content_style_selection' => 'style_two',
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
                    'finview_about_content_style_selection' => 'style_one',
                ]
            ]
        );


        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_card_miss_title',
            [
                'label' => esc_html__(' Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Expertise & Objectivity', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'finview_card_miss_text',
            [
                'label' => esc_html__('Short Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('With years of experience in the financial industry', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
            ]
        );


        $this->add_control(
            'card_miss_repeater',
            [
                'label' => esc_html__('Card', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_card_miss_title' => esc_html__('Our Mission', 'finview-core'),
                        'finview_card_miss_text' => esc_html__('To empower individuals and businesses with the knowledge and tools to make informed', 'finview-core'),
                    ],
                    [
                        'finview_card_miss_title' => esc_html__('Our Vision', 'finview-core'),
                        'finview_card_miss_text' => esc_html__('To empower individuals and businesses with the knowledge and tools to make informed', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_card_miss_title }}}',
                'condition' => [
                    'finview_about_content_style_selection' => 'style_two',
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

        $this->add_control(
            'finview_contact_text',
            [
                'label' => esc_html__('Number Text', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Support us', 'finview-core'),
                'placeholder' => esc_html__('Type your Text here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_about_content_style_selection' => 'style_two',
                ]
            ]
        );
        $this->add_control(
            'finview_contact_number',
            [
                'label' => esc_html__('Number', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('123-456-7891', 'finview-core'),
                'placeholder' => esc_html__('Type your Number here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_about_content_style_selection' => 'style_two',
                ]
            ]
        );

        $this->add_control(
            'finview_about_content_image',
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


        // card Icon 
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
                    '{{WRAPPER}} .cus_icon svg path' => 'fill: {{VALUE}};',
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
                    '{{WRAPPER}} .cart_title i' => 'color: {{VALUE}};',
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


        // Progress Bar
        $this->start_controls_section(
            'prog_style',
            [
                'label' => esc_html__('Progress Bar', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'finview_about_content_style_selection' => 'style_two',
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Progress Title Typography', 'finview-core'),
                'name'     => 'prog_style_typ',
                'selector' => '{{WRAPPER}} .progress-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Progress % Typography', 'finview-core'),
                'name'     => 'prog_det_style_typ',
                'selector' => '{{WRAPPER}} .progress-area .prog-percentage::before',
            ]
        );

        $this->add_control(
            'prog_style_color',
            [
                'label'     => esc_html__('Title Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'prog_des_style_color',
            [
                'label'     => esc_html__('% Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-area .prog-percentage::before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'prog_style_bg_color',
            [
                'label'     => esc_html__('Progress BG Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prog-bar' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'prog_col_style_color',
            [
                'label'     => esc_html__('Progress Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prog-percentage' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'prog_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .progress-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'prog_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .progress-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
            .about-us .cus_icon svg,
            .about-us .cus_icon i {
                font-size: 36px;
            }
        </style>

        <!-- ==== about section one start ==== -->
        <?php if ($settings['finview_about_content_style_selection'] == 'style_one') : ?>
            <!-- About Us start -->
            <section class="about-us section">
                <?php if (!empty($settings['one_reborn_show'] == 'yes')) :   ?>
                    <div class="animation">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/hero_vector_dollar.png" alt="<?php echo esc_attr('Image') ?>">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/hero_vector_message.png" alt="<?php echo esc_attr('Image') ?>">
                    </div>
                <?php endif ?>
                <div class="container">
                    <div class="row gy-5 gy-lg-0 justify-content-between align-items-center">
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
                                <div class="section__content-inner">
                                    <?php foreach ($settings['card_repeater'] as $item) : ?>
                                        <div class="card card--small wow fadeInUp" data-wow-duration="0.8s">
                                            <?php if (!empty($item['finview_card_icon'])) : ?>
                                                <div class="cus_icon card--small-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($item['finview_card_icon'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif ?>
                                            <div class="card--small-content">
                                                <?php if (!empty($item['finview_card_title'])) :   ?>
                                                    <h5 class="cart_title card--small-title"><?php echo esc_html($item['finview_card_title']) ?></h5>
                                                <?php endif ?>
                                                <?php if (!empty($item['finview_card_text'])) :   ?>
                                                    <p class="cart_text card--small-text"><?php echo esc_html($item['finview_card_text']) ?></p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <?php if (!empty($settings['finview_content_button'])) : ?>
                                    <div class="btn-cta">
                                        <a href="<?php echo esc_html($settings['finview_content_button_url']['url']) ?>" class="btn_theme mt_40"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-5 mx-auto mx-lg-0">
                            <?php if (!empty($settings['finview_about_content_image']['url'])) : ?>
                                <div class="choose-us__thumb unset-xxl me-xl-4 me-xxl-0 wow fadeInDown" data-wow-duration="0.8s">
                                    <img src="<?php echo esc_url($settings['finview_about_content_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About Us end -->
        <?php endif; ?>
        <!-- ==== about section one start ==== -->


        <!-- ==== about section two start ==== -->
        <?php if ($settings['finview_about_content_style_selection'] == 'style_two') : ?>
            <section class="about-guideline section">
                <div class="container">
                    <div class="row gy-5 gy-lg-0 justify-content-between align-items-center">
                        <div class="col-12 col-lg-7 col-xxl-6">
                            <div class="section__content me-lg-5 me-xxl-0">
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
                                <?php if (!empty($settings['finview_marketing_bar'])) :   ?>
                                    <div class="progress-area mt_32 wow fadeInUp" data-wow-duration="0.8s">
                                        <p class="progress-title headingFive"><?php echo esc_html($settings['finview_marketing_bar_title']) ?></p>
                                        <div class="prog-bar">
                                            <div class="prog-percentage" per="<?php echo esc_html($settings['finview_marketing_bar']) ?>" style="max-width:<?php echo esc_html($settings['finview_marketing_bar']) ?>"></div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="section__content-inner">
                                    <div class="row gy-4 gy-md-0">
                                        <?php foreach ($settings['card_miss_repeater'] as $item) : ?>
                                            <div class="col-12 col-md-6">
                                                <div class="mission wow fadeInDown" data-wow-duration="0.8s">
                                                    <div class="card card--small">
                                                        <div class="card--small-content">
                                                            <?php if (!empty($item['finview_card_miss_title'])) :   ?>
                                                                <h5 class="cart_title card--small-title gap-6"><i class="bi bi-check2-circle"></i><?php echo esc_html($item['finview_card_miss_title']) ?></h5>
                                                            <?php endif ?>
                                                            <?php if (!empty($item['finview_card_miss_text'])) :   ?>
                                                                <p class="cart_text card--small-text"><?php echo esc_html($item['finview_card_miss_text']) ?></p>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="btn-group align-items-center wow fadeInRight" data-wow-duration="0.8s">
                                    <?php if (!empty($settings['finview_content_button'])) : ?>
                                        <div class="btn-cta">
                                            <a href="<?php echo esc_html($settings['finview_content_button_url']['url']) ?>" class="btn_theme"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($settings['finview_contact_number'])) : ?>
                                        <div class="card card--small">
                                            <div class="cus_icon card--small-icon">
                                                <i class="bi bi-headset"></i>
                                            </div>
                                            <div class="card--small-content">
                                                <p class="cart_text card--small-title"><?php echo esc_html($settings['finview_contact_text']) ?></p>
                                                <a href="tel:<?php echo esc_html($settings['finview_contact_number']) ?>" class="cart_title card--small-call"><?php echo esc_html($settings['finview_contact_number']) ?></a>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 col-md-8 col-lg-5 mx-auto mx-lg-0">
                            <?php if (!empty($settings['finview_about_content_image']['url'])) : ?>
                                <div class="choose-us__thumb unset-xxl me-xl-4 me-xxl-0 wow fadeInDown" data-wow-duration="0.8s">
                                    <img src="<?php echo esc_url($settings['finview_about_content_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== about section two End ==== -->
<?php
    }
}

$widgets_manager->register(new TP_about());
