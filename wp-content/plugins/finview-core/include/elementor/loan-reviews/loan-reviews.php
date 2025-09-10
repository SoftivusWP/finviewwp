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
class TP_Reviews extends Widget_Base
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
        return 'tp-loan-reviews';
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
        return __('Loan Reviews', 'tpcore');
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
            'loan_general_content',
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

        $this->end_controls_section();


        // Posts Per Page Show
        $this->start_controls_section(
            'loan_one_general_content',
            [
                'label' => esc_html__(' Per Page Show', 'finview-core')
            ]
        );


        $this->add_control(
            'loan_category',
            [
                'label' => __('Select Loan Category', 'turio-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_post_list_by_post_type('loans'),
                'default'     => $this->get_all_post_key('loans'),
            ]
        );


        $this->add_control(
            'loan_posts_per_page',
            [
                'label'       => esc_html__('Posts Per Page', 'corelaw-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => -1,
                'label_block' => false,
            ]
        );
        $this->add_control(
            'loan_template_order_by',
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
            'loan_template_order',
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


        // Heading
        $this->start_controls_section(
            'loan_three_heading_general_content',
            [
                'label' => esc_html__('Heading', 'finview-core'),

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
        $this->add_control(
            'finview_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Loan Reviews', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,

            ]
        );
        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('In-depth Analysis for Informed Borrowing Decisions', 'finview-core'),
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
                'default' => esc_html__('Welcome to our comprehensive loan reviews section, where we provide you with detailed and unbiased analyses of various loan options.', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),

            ]
        );

        // Button text
        $this->add_control(
            'finview_content_button',
            [
                'label' => esc_html__('Button', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('See All Review Loan', 'finview-core'),
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

        $this->end_controls_section();

        // Card
        $this->start_controls_section(
            'loan_card_general_content',
            [
                'label' => esc_html__('Card', 'finview-core'),

            ]
        );


        // Button text
        $this->add_control(
            'finview_average_button',
            [
                'label' => esc_html__('Average Review Text', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Average Review', 'finview-core'),
                'placeholder' => esc_html__('Type your Text here', 'finview-core'),
                'label_block' => true,
            ]
        );
        // Button text
        $this->add_control(
            'finview_visit_button',
            [
                'label' => esc_html__('Visit Site Button', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Visit Site', 'finview-core'),
                'placeholder' => esc_html__('Type your button here', 'finview-core'),
                'label_block' => true,
            ]
        );
        // Button text
        $this->add_control(
            'finview_read_button',
            [
                'label' => esc_html__('Read More Button', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'finview-core'),
                'placeholder' => esc_html__('Type your button here', 'finview-core'),
                'label_block' => true,
            ]
        );

        // Terms text
        $this->add_control(
            'finview_terms_text',
            [
                'label' => esc_html__('Terms & Conditions Text ', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Terms & Conditions Apply', 'finview-core'),
                'placeholder' => esc_html__('Type your Text here', 'finview-core'),
                'label_block' => true,
            ]
        );

        // Terms URL
        $this->add_control(
            'finview_terms_url',
            [
                'label' => esc_html__('Terms & Conditions Text URL', 'finview-core'),
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
                    '{{WRAPPER}} .loan-reviews-area::before' => 'height: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__('Background Color', 'finview-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .loan-reviews-area::before',
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
                    '{{WRAPPER}} .loan-reviews-area::before' => 'opacity: {{SIZE}} !important;',
                ]
            ]
        );




        $this->add_responsive_control(
            'box_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .loan-reviews' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .loan-reviews' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Section 
        $this->start_controls_section(
            'inner_box_style',
            [
                'label' => esc_html__('Inner Section Area', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'inner_style_color',
            [
                'label'     => esc_html__('Background Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .loan-reviews-area::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'inner_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .loan-reviews-area::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'inner_sec_border_radius',
            [
                'label'      => __('Main Content Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .loan-reviews.loan-reviews--secondary::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_background_color',
                'label' => esc_html__('Main Content Background Color', 'finview-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .loan-reviews.loan-reviews--secondary::after',
            ]
        );

        $this->add_responsive_control(
            'inner_cus_background_overlay_opacity',
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
                    '{{WRAPPER}} .loan-reviews.loan-reviews--secondary::after' => 'opacity: {{SIZE}} !important;',
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



        $this->add_responsive_control(
            'card_border_color',
            [
                'label'      => __('Border color', 'finview-core'),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .loan-reviews__part-two::before, 
                    {{WRAPPER}} .loan-reviews__part-two::after, 
                    {{WRAPPER}} .loan-reviews__part-two .reviews-heading' => 'border-color: {{VALUE}};',
                ]
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
                'selector' => '{{WRAPPER}} .reviews-heading__title',

            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .reviews-heading__title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .reviews-heading__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .reviews-heading__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                'selector' => '{{WRAPPER}} .reviews-heading p',

            ]
        );

        $this->add_control(
            'card_des_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .reviews-heading p' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .reviews-heading p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .reviews-heading p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Card List
        $this->start_controls_section(
            'card_list_style',
            [
                'label' => esc_html__('Card List', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_list_style_typ',
                'selector' => '{{WRAPPER}} .reviews-inner ul li',

            ]
        );

        $this->add_control(
            'card_list_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .reviews-inner ul li, .reviews-inner ul li i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_list_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .reviews-inner ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_list_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .reviews-inner ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        // Button Style

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
                    '{{WRAPPER}} .btn_theme i' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .btn_theme:hover i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_color',
            [
                'label'     => esc_html__('Btn Secondary Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn_theme.btn_alt i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_secondary_color_hover',
            [
                'label'     => esc_html__('Btn Secondary Hover Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .btn_theme.btn_alt:hover i' => 'color: {{VALUE}} !important;',
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


        // conditions_apply
        $this->start_controls_section(
            'card_terms_style',
            [
                'label' => esc_html__('Conditions Link', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_terms_style_typ',
                'selector' => '{{WRAPPER}} .conditions_apply',

            ]
        );

        $this->add_control(
            'card_terms_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .conditions_apply' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .conditions_apply::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_terms_style_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .conditions_apply:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .conditions_apply:hover::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_terms_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .conditions_apply' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_terms_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .conditions_apply' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;



        $query = new \WP_Query(
            array(
                'post_type'      => 'loans',
                'posts_per_page' => $settings['loan_posts_per_page'],
                'orderby'        => $settings['loan_template_order_by'],
                'order'          => $settings['loan_template_order'],
                'post_status'    => 'publish',
                'post__in'       => $settings['loan_category'],
                'paged'          => $paged
            )
        );

?>


        <!-- ==== training section start ==== -->
        <?php if ($settings['finview_content_style_selection'] == 'style_one') : ?>
            <section class="loan-reviews-area position-relative section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-10 col-xxl-9">
                            <div class="loan-reviews loan-reviews--secondary position-relative ">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-lg-10 col-xxl-9">
                                        <div class="section__header">
                                            <?php if (!empty($settings['finview_heading_content_subtitle'])) : ?>
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
                                <div class="row justify-content-center">
                                    <div class="col-12 flex-column gap-4">
                                        <?php if ($query->have_posts()) :
                                            while ($query->have_posts()) :
                                                $query->the_post();
                                                $contact_url = function_exists('get_field') ? get_field('contact_url') : '';
                                                $loan_card_list = function_exists('get_field') ? get_field('loan_card_list') : '';
                                                $loan_rating = get_field('loan_rating');
                                        ?>

                                                <div class="cus_card loan-reviews_card card wow fadeInUp" data-wow-duration="0.8s">
                                                    <div class="loan-reviews__part-one">
                                                        <div class="loan-reviews__thumb">
                                                            <?php
                                                            if (has_post_thumbnail()) {
                                                                the_post_thumbnail();
                                                            } else {
                                                                echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.png" />';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="loan-reviews__review">
                                                            <p class="rating"><?php echo esc_html($loan_rating); ?></p>
                                                            <div class="d-flex gap-2 flex-column">
                                                                <div class="star_review">
                                                                    <?php
                                                                    if (is_numeric($loan_rating)) {
                                                                        $filled_stars = floor($loan_rating);
                                                                        $half_star = $loan_rating - $filled_stars;

                                                                        for ($i = 1; $i <= 5; $i++) {
                                                                            if ($i <= $filled_stars) {
                                                                                echo '<i class="bi bi-star-fill"></i>';
                                                                            } elseif ($i == ($filled_stars + 1) && $half_star > 0) {
                                                                                echo '<i class="bi bi-star-half"></i>';
                                                                            } else {
                                                                                echo '<i class="bi bi-star"></i>';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        for ($i = 1; $i <= 5; $i++) {
                                                                            echo '<i class="bi bi-star"></i>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <p class="fs-small"><?php echo esc_html($settings['finview_average_button']) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="loan-reviews__part-two">
                                                        <div class="reviews-heading">
                                                            <h4 class="reviews-heading__title"><?php the_title() ?></h4>
                                                            <p class="reviews-heading__content"><?php the_excerpt(); ?></p>
                                                        </div>
                                                        <div class="reviews-inner">
                                                            <ul>
                                                                <?php if (have_rows('loan_list_repeater')) : ?>
                                                                    <?php while (have_rows('loan_list_repeater')) : the_row(); ?>
                                                                        <li><i class="bi bi-check2-circle"></i><?php acf_esc_html(the_sub_field('loan_card_list')); ?> </li>
                                                                    <?php endwhile ?>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="loan-reviews__part-three">
                                                        <div class="btn-group">
                                                            <a href="<?php echo esc_url($contact_url); ?>" class="btn_theme " target="_blank"> <?php echo esc_html($settings['finview_visit_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                                            <a href="<?php the_permalink(); ?>" class="btn_theme btn_alt"> <?php echo esc_html($settings['finview_read_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                                            <?php if (!empty($settings['finview_terms_text'])) : ?>
                                                                <a href="<?php echo esc_url($settings['finview_terms_url']['url']) ?>" class="conditions_apply"><?php echo esc_html($settings['finview_terms_text']) ?></a>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            endwhile;
                                        endif;
                                        wp_reset_postdata();
                                        ?>
                                    </div>
                                    <div class="col-12">
                                        <?php if (!empty($settings['finview_content_button'])) : ?>
                                            <div class="section__cta wow fadeInUp" data-wow-duration="0.8s">
                                                <a href="<?php echo esc_url($settings['finview_content_button_url']['url']) ?>" class="btn_theme btn_alt"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['finview_content_style_selection'] == 'style_two') : ?>
            <section class="loan-reviews section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-7 col-xxl-6">
                            <div class="section__header">
                                <?php if (!empty($settings['finview_heading_content_subtitle'])) : ?>
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
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-11 col-xl-9 col-xxl-8">
                            <div class="d-flex flex-column gap-4">
                                <?php if ($query->have_posts()) :
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                        $contact_url = function_exists('get_field') ? get_field('contact_url') : '';
                                        $loan_card_list = function_exists('get_field') ? get_field('loan_card_list') : '';
                                        $loan_rating = get_field('loan_rating');
                                ?>
                                        <div class="cus_card loan-reviews_card card wow fadeInUp" data-wow-duration="0.8s">
                                            <div class="loan-reviews__part-one">
                                                <div class="loan-reviews__thumb">
                                                    <?php the_post_thumbnail() ?>
                                                </div>
                                                <div class="loan-reviews__review">
                                                    <p class="rating"><?php echo esc_html($loan_rating); ?></p>
                                                    <div class="d-flex gap-2 flex-column">
                                                        <div class="star_review">
                                                            <?php
                                                            if (is_numeric($loan_rating)) {
                                                                $filled_stars = floor($loan_rating);
                                                                $half_star = $loan_rating - $filled_stars;

                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $filled_stars) {
                                                                        echo '<i class="bi bi-star-fill"></i>';
                                                                    } elseif ($i == ($filled_stars + 1) && $half_star > 0) {
                                                                        echo '<i class="bi bi-star-half"></i>';
                                                                    } else {
                                                                        echo '<i class="bi bi-star"></i>';
                                                                    }
                                                                }
                                                            } else {
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    echo '<i class="bi bi-star"></i>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <p class="fs-small"><?php echo esc_html($settings['finview_average_button']) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="loan-reviews__part-two">
                                                <div class="reviews-heading">
                                                    <h4 class="reviews-heading__title"><?php the_title() ?></h4>
                                                    <p class="reviews-heading__content"><?php the_excerpt(); ?></p>
                                                </div>
                                                <div class="reviews-inner">
                                                    <ul>
                                                        <?php if (have_rows('loan_list_repeater')) : ?>
                                                            <?php while (have_rows('loan_list_repeater')) : the_row(); ?>
                                                                <li><i class="bi bi-check2-circle"></i><?php acf_esc_html(the_sub_field('loan_card_list')); ?> </li>
                                                            <?php endwhile ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="loan-reviews__part-three">
                                                <div class="btn-group">
                                                    <a href="<?php echo esc_url($contact_url); ?>" class="btn_theme " target="_blank"> <?php echo esc_html($settings['finview_visit_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                                    <a href="<?php the_permalink(); ?>" class="btn_theme btn_alt"> <?php echo esc_html($settings['finview_read_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                                    <?php if (!empty($settings['finview_terms_text'])) : ?>
                                                        <a href="<?php echo esc_html($settings['finview_terms_url']['url']) ?>" class="conditions_apply"><?php echo esc_html($settings['finview_terms_text']) ?></a>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php if (!empty($settings['finview_content_button'])) : ?>
                                <div class="section__cta wow fadeInUp" data-wow-duration="0.8s">
                                    <a href="<?php echo esc_html($settings['finview_content_button_url']['url']) ?>" class="btn_theme btn_alt"><?php echo esc_html($settings['finview_content_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['finview_content_style_selection'] == 'style_three') : ?>
            <section class="loan-reviews">
                <div class="d-flex flex-column gap-4">
                    <?php if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                            $contact_url = function_exists('get_field') ? get_field('contact_url') : '';
                            $loan_card_list = function_exists('get_field') ? get_field('loan_card_list') : '';
                            $loan_rating = get_field('loan_rating');
                    ?>
                            <div class="cus_card loan-reviews_card card wow fadeInUp" data-wow-duration="0.8s">
                                <div class="loan-reviews__part-one">
                                    <div class="loan-reviews__thumb">
                                        <?php the_post_thumbnail() ?>
                                    </div>
                                    <div class="loan-reviews__review">
                                        <p class="rating"><?php echo esc_html($loan_rating); ?></p>
                                        <div class="d-flex gap-2 flex-column">
                                            <div class="star_review">
                                                <?php
                                                if (is_numeric($loan_rating)) {
                                                    $filled_stars = floor($loan_rating);
                                                    $half_star = $loan_rating - $filled_stars;

                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $filled_stars) {
                                                            echo '<i class="bi bi-star-fill"></i>';
                                                        } elseif ($i == ($filled_stars + 1) && $half_star > 0) {
                                                            echo '<i class="bi bi-star-half"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-star"></i>';
                                                        }
                                                    }
                                                } else {
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        echo '<i class="bi bi-star"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <p class="fs-small"><?php echo esc_html($settings['finview_average_button']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="loan-reviews__part-two">
                                    <div class="reviews-heading">
                                        <h4 class="reviews-heading__title"><?php the_title() ?></h4>
                                        <p class="reviews-heading__content"><?php the_excerpt(); ?></p>
                                    </div>
                                    <div class="reviews-inner">
                                        <ul>
                                            <?php if (have_rows('loan_list_repeater')) : ?>
                                                <?php while (have_rows('loan_list_repeater')) : the_row(); ?>
                                                    <li><i class="bi bi-check2-circle"></i><?php acf_esc_html(the_sub_field('loan_card_list')); ?> </li>
                                                <?php endwhile ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="loan-reviews__part-three">
                                    <div class="btn-group">
                                        <a href="<?php echo esc_url($contact_url); ?>" class="btn_theme " target="_blank"> <?php echo esc_html($settings['finview_visit_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                        <a href="<?php the_permalink(); ?>" class="btn_theme btn_alt"> <?php echo esc_html($settings['finview_read_button']) ?><i class="bi bi-arrow-up-right"></i></a>
                                        <?php if (!empty($settings['finview_terms_text'])) : ?>
                                            <a href="<?php echo esc_html($settings['finview_terms_url']['url']) ?>" class="conditions_apply"><?php echo esc_html($settings['finview_terms_text']) ?></a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    endif;





                    if ($query->max_num_pages > 1) {
                        echo '<nav aria-label="Page navigation" class="nav_pagination wow fadeInUp">';
                        echo '<ul class="pagination">';

                        // Previous page link
                        if (get_previous_posts_link()) {
                            echo '<li class="page-item">';
                            previous_posts_link('<span class="prev-icon"></span>');
                            echo '</li>';
                        }

                        // Pagination numbers
                        $current_page = max(1, get_query_var('paged'));
                        $total_pages = $query->max_num_pages;
                        $range = 2; // Number of links to show before and after the current page
                        $show_items = ($range * 2) + 1;

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($total_pages != 1 && $total_pages >= $show_items && abs($current_page - $i) <= $range) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link' . ($current_page === $i ? ' active' : '') . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
                                echo '</li>';
                            } elseif ($total_pages < $show_items) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link' . ($current_page === $i ? ' active' : '') . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
                                echo '</li>';
                            } elseif ($i === 1 || $i === $total_pages) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link' . ($current_page === $i ? ' active' : '') . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
                                echo '</li>';
                            } elseif ($total_pages != 1 && $total_pages > $show_items && abs($current_page - $i) <= $range) {
                                if ($i === $current_page - $range - 1 || $i === $current_page + $range + 1) {
                                    echo '<li class="page-item three_dots_box">';
                                    echo '<a class="page-link three-dots" href="#">...</a>';
                                    echo '</li>';
                                }
                            }
                        }

                        // Next page link
                        if (get_next_posts_link()) {
                            echo '<li class="page-item">';
                            next_posts_link('<span class="next-icon"></span>');
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo '</nav>';
                    }






                    wp_reset_postdata();
                    ?>
                </div>
            </section>
        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Reviews());
