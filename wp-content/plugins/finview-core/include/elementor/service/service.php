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
class TP_services extends Widget_Base
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
        return 'tp-services';
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
        return __('services', 'tpcore');
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

    public function get_post_list_by_post_type($post_type)
    {
        $return_val = [];
        $args       = array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'post_status'      => 'publish',
        );
        $all_post   = new \WP_Query($args);

        while ($all_post->have_posts()) {
            $all_post->the_post();
            $return_val[get_the_ID()] = get_the_title();
        }
        wp_reset_query();
        return $return_val;
    }

    public function get_all_post_key($post_type)
    {
        $return_val = [];
        $args       = array(
            'post_type'      => $post_type,
            'posts_per_page' => 6,
            'post_status'      => 'publish',

        );
        $all_post   = new \WP_Query($args);

        while ($all_post->have_posts()) {
            $all_post->the_post();
            $return_val[] = get_the_ID();
        }
        wp_reset_query();
        return $return_val;
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
            'services_general_content',
            [
                'label' => esc_html__('General', 'finview-core')
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
                    'style_three' => esc_html__('Style Three', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );
 
        $this->add_responsive_control(
            'finview_card_content_align',
            [
                'label'         => esc_html__('Card Align', 'finview-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'start'         => [
                        'title' => esc_html__('Left', 'finview-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'finview-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'end'     => [
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
                    '{{WRAPPER}} .cus_align' => 'align-items: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_section();


        // Posts Per Page Show
        $this->start_controls_section(
            'services_one_general_content',
            [
                'label' => esc_html__('Posts Per Page Show', 'finview-core')
            ]
        );


        $this->add_control(
            'services_category',
            [
                'label' => __('Select services', 'turio-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_post_list_by_post_type('services'),
                'default'     => $this->get_all_post_key('services'),
            ]
        );


        $this->add_control(
            'services_posts_per_page',
            [
                'label'       => esc_html__('Posts Per Page', 'corelaw-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => -1,
                'label_block' => false,
            ]
        );
        $this->add_control(
            'services_template_order_by',
            [
                'label'   => esc_html__('Order By', 'corelaw-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => [
                    'ID'         => esc_html__('Post Id', 'corelaw-core'),
                    'author'     => esc_html__('Post Author', 'corelaw-core'),
                    'title'      => esc_html__('Title', 'corelaw-core'),
                    'post_date'  => esc_html__('Date', 'corelaw-core'),
                    'rand'       => esc_html__('Random', 'corelaw-core'),
                    'menu_order' => esc_html__('Menu Order', 'corelaw-core'),
                ],
            ]
        );
        $this->add_control(
            'services_template_order',
            [
                'label'   => esc_html__('Order', 'corelaw-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'asc'  => esc_html__('Ascending', 'corelaw-core'),
                    'desc' => esc_html__('Descending', 'corelaw-core')
                ],
                'default' => 'desc',
            ]
        );

        $this->end_controls_section();


        // Reborn Hide show
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


        // Heading
        $this->start_controls_section(
            'services_three_heading_general_content',
            [
                'label' => esc_html__('Heading', 'finview-core'),
                'condition' => [
                    'finview_content_style_selection' => ['style_one', 'style_two'],
                ]
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
                    '{{WRAPPER}} .section__content' => 'text-align: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'finview_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Featured Services', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,

            ]
        );
        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Empowering You with Loan Knowledge and Comparison Tools', 'finview-core'),
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
                'default' => esc_html__('We are dedicated to providing you with valuable services that simplify your loan search and empower you to make informed borrowing decisions. Our comprehensive range of services', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),

            ]
        );

        // Button text
        $this->add_control(
            'finview_content_button',
            [
                'label' => esc_html__('Button', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('See All Services', 'finview-core'),
                'placeholder' => esc_html__('Type your button here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'finview_content_style_selection' => 'style_two',
                ]
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
                'condition' => [
                    'finview_content_style_selection' => 'style_two',
                ]
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

        $this->add_control(
            'box_style_color',
            [
                'label'     => esc_html__('Background', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box_area' => 'background: {{VALUE}};',
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
                    'finview_content_style_selection' => ['style_one', 'style_two'],
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
                    'finview_content_style_selection' => ['style_one', 'style_two'],
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
                    'finview_content_style_selection' => ['style_one', 'style_two'],
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
            'card_icon_bottom_bdr_hvr_color',
            [
                'label' => esc_html__('bottom Btn Hover BG Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card:hover .cus_icon_2' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_icon_bdr_color',
            [
                'label' => esc_html__('Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'card_icon_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card:hover .cus_icon' => 'border:1px solid {{VALUE}}',
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
                    '{{WRAPPER}} .cus_icon img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',
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


        //bottom Icon box Size
        $this->add_responsive_control(
            'icon_box2_custom_dimensionsss',
            [
                'label' => esc_html__('Bottom Box Size', 'plugin-name'),
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
                    '{{WRAPPER}} .cus_icon_2' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'card_icon2_custom_dimensionsss',
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
                    '{{WRAPPER}} .cus_icon_2 i' => 'font-size: {{SIZE}}{{UNIT}};',
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

        // Card Title
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
                'selector' => '{{WRAPPER}} .cus_title_link',

            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_title_link' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .cus_title_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .cus_title_link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

        $query = new \WP_Query(
            array(
                'post_type'      => 'services',
                'posts_per_page' => $settings['services_posts_per_page'],
                'orderby'        => $settings['services_template_order_by'],
                'order'          => $settings['services_template_order'],
                'offset'         => 0,
                'post_status'    => 'publish',
                'post__in'          => $settings['services_category'],
            )
        );

?>


        <script>
            jQuery(document).ready(function($) {

                // feature slider
                // feature slider
                jQuery(".feature_slider")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        speed: 1500,
                        arrows: false,
                        dots: true,
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
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 1,
                                },
                            }
                        ],
                    });

            });
        </script>
        <style>

            .feature .cus_icon {
                border: 1px solid #DFE0E4;
            }

            .feature .cus_icon img {
                width: 46px;
                height: 46px;
                object-fit: contain;
            }

            .feature .btn_cus {
                width: 40px;
                min-width: 40px;
                height: 40px;
                margin-top: 24px;
            }

            .feature .cus_icon_2 {
                width: 40px;
                min-width: 40px;
                height: 40px;
                background: var(--neutral-n-0);

            }

            .feature .cus_card:hover .cus_icon_2 {
                background: var(--secondary-color);
            }

            .feature .cus_icon_2:hover i {
                transform: rotate(45deg);
            }

        

            .feature--secondary .card--custom .card__content{
                gap: 20px;
            }
        </style>

        <!-- ==== training section start ==== -->
        <?php if ($settings['finview_content_style_selection'] == 'style_one') : ?>
            <section class="feature section">
                <?php if (!empty($settings['one_reborn_show'])) :   ?>
                    <div class="animation">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/hero_vector_dollar.png" alt="<?php esc_attr('Image') ?>">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/hero_vector_message.png" alt="<?php esc_attr('Image') ?>">
                    </div>
                <?php endif ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-9 col-xxl-8">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="feature_slider wow fadeInUp" data-wow-duration="0.8s">
                                <?php
                                if ($query->have_posts()) :
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                        $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                                        $service_icon_img = function_exists('get_field') ? get_field('service_icon_img') : '';
                                ?>
                                        <div class="cus_card card card--custom cus_align gap-0">
                                            <div class="card__icon cus_icon cus_icon2 mb_32">
                                                <?php if ($service_icon) : ?>
                                                    <i class="<?php echo esc_html($service_icon) ?>"></i>
                                                <?php else : ?>
                                                    <img src="<?php echo esc_url($service_icon_img) ?>" alt="<?php echo esc_attr('image') ?>">
                                                <?php endif ?>
                                            </div>
                                            <div class="card__content cus_cont">
                                                <h4 class="card__title">
                                                    <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h4>
                                                <p class="fs-small"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?> </p>
                                            </div>
                                            <div class="btn_cus">
                                                <a href="<?php the_permalink() ?>" class="cus_icon cus_icon_2 d-flex align-items-center justify-content-center rounded-circle"><i class="bi bi-arrow-up-right"></i></a>
                                            </div>
                                        </div>
                                    <?php endwhile ?>
                                <?php endif ?>
                                <?php wp_reset_postdata(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['finview_content_style_selection'] == 'style_two') : ?>
            <section class="feature feature--secondary section">
                <div class="container">
                    <div class="row gy-5 gy-lg-0 align-items-center justify-content-between">
                        <div class="col-12 col-lg-5 col-xxl-5 ">
                            <div class="section__content">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) :   ?>
                                    <span class="sub-title section__content-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s">
                                        <?php if (!empty($settings['title_img_reborn_show'])) :   ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/title_vector.png" alt="<?php echo esc_attr('Image') ?>">
                                        <?php endif ?>
                                        <?php echo wp_kses($settings['finview_heading_content_subtitle'], wp_kses_allowed_html('post')) ?></span>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_title'])) :   ?>
                                    <h2 class="title section__content-title wow fadeInUp" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_heading_content_description'])) :   ?>
                                    <p class="xlr pp section__content-content wow fadeInDown" data-wow-duration="0.8s"><?php echo wp_kses($settings['finview_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <?php if (!empty($settings['finview_content_button'])) : ?>
                                    <div class="btn-cta">
                                        <a href="<?php echo esc_html($settings['finview_content_button_url']['url']) ?>" class="btn_theme btn_alt mt_40 wow fadeInUp" data-wow-duration="0.8s"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 col-xxl-5">
                            <div class="feature__content gap-4 flex-column ms-lg-4 ms-xxl-0 wow fadeInUp" data-wow-duration="0.8s">
                                <?php if ($query->have_posts()) :
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                        $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                                        $service_icon_img = function_exists('get_field') ? get_field('service_icon_img') : '';
                                ?>
                                        <div class="cus_card card card--custom gap-0">
                                            <div class="card__icon cus_icon me-3 me-xl-4">
                                                <?php if ($service_icon) : ?>
                                                    <i class="<?php echo esc_html($service_icon) ?>"></i>
                                                <?php else : ?>
                                                    <img src="<?php echo esc_url($service_icon_img) ?>" alt="<?php echo esc_attr('image') ?>">
                                                <?php endif ?>
                                            </div>
                                            <div class="card__content cus_cont">
                                                <div class="card__content-text">
                                                    <h4 class="card__title">
                                                        <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h4>
                                                    <p class="fs-small"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?> </p>
                                                </div>
                                                <a href="<?php the_permalink() ?>" class="cus_icon cus_icon_2 d-flex align-items-center justify-content-center rounded-circle mt_20 mt-lg-4 mx-auto"><i class="bi bi-arrow-up-right"></i></a>
                                            </div>
                                        </div>
                                    <?php endwhile ?>
                                <?php endif ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['finview_content_style_selection'] == 'style_three') : ?>
            <section class="feature feature--tertiary section">
                <div class="container">
                    <div class="row g-3 g-sm-2 g-md-3 g-xxl-4">
                        <?php if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post();
                                $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                                $service_icon_img = function_exists('get_field') ? get_field('service_icon_img') : '';
                        ?>
                                <div class="col-12 col-sm-6 col-xl-4">
                                    <div class="cus_card card card--custom gap-0 cus_align wow fadeInUp" data-wow-duration="0.8s">
                                        <div class="card__icon cus_icon mb_32">
                                            <?php if ($service_icon) : ?>
                                                <i class="<?php echo esc_html($service_icon) ?>"></i>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url($service_icon_img) ?>" alt="<?php echo esc_attr('image') ?>">
                                            <?php endif ?>
                                        </div>
                                        <div class="card__content cus_cont">
                                            <h4 class="card__title">
                                                <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h4>
                                            <p class="fs-small"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?> </p>
                                        </div>
                                        <div class="btn_cus">
                                            <a href="<?php the_permalink() ?>" class="cus_icon cus_icon_2 d-flex align-items-center justify-content-center rounded-circle"><i class="bi bi-arrow-up-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile ?>
                        <?php endif ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>



<?php
    }
}

$widgets_manager->register(new TP_services());
