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
class TP_Blog_page extends Widget_Base
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
        return 'tp-blog-page';
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
        return __('Blog Page', 'tpcore');
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
?>

    <?php
        // ======================Content================================//

        $this->start_controls_section(
            'casestudy_general_content',
            [
                'label' => esc_html__('General', 'finview-core')
            ]
        );
        $this->add_control(
            'blog_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'finview-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style Grid', 'finview-core'),
                    'style_two' => esc_html__('Style Left Sidebar', 'finview-core'),
                    'style_three' => esc_html__('Style Right Sidebar', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();

        // Posts Per Page Show
        $this->start_controls_section(
            'blog_general_content',
            [
                'label' => esc_html__('Posts Per Page Show', 'finview-core')
            ]
        );

        $this->add_control(
            'blog_category',
            [
                'label' => __('Select Blog', 'turio-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_post_list_by_post_type('post'),
                // 'default'     => $this->get_all_post_key('post'),
            ]
        );

        $this->add_control(
            'blog_blog_posts_per_page',
            [
                'label'       => esc_html__('Posts Per Page', 'finview-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 3,
                'label_block' => false,
            ]
        );
        $this->add_control(
            'blog_blog_template_orderby',
            [
                'label'   => esc_html__('Order By', 'finview-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => [
                    'ID'         => esc_html__('Post Id', 'finview-core'),
                    'author'     => esc_html__('Post Author', 'finview-core'),
                    'title'      => esc_html__('Title', 'finview-core'),
                    'post_date'  => esc_html__('Date', 'finview-core'),
                    'rand'       => esc_html__('Random', 'finview-core'),
                    'menu_order' => esc_html__('Menu Order', 'finview-core'),
                ],
            ]
        );
        $this->add_control(
            'blog_blog_template_order',
            [
                'label'   => esc_html__('Order', 'finview-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'asc'  => esc_html__('Ascending', 'finview-core'),
                    'desc' => esc_html__('Descending', 'finview-core')
                ],
                'default' => 'desc',
            ]
        );

        $this->end_controls_section();

        // card
        $this->start_controls_section(
            'blog_card',
            [
                'label' => esc_html__('Card', 'plugin-name'),
            ]
        );

        $this->add_control(
            'product_grid_column',
            [
                'label' => esc_html__('Columns', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12' => esc_html__('1 Column', 'rsaddon'),
                    '6' => esc_html__('2 Column', 'rsaddon'),
                    '4' => esc_html__('3 Column', 'rsaddon'),
                    '3' => esc_html__('4 Column', 'rsaddon'),
                    '2' => esc_html__('6 Column', 'rsaddon'),
                ],
            ]
        );

        
        $this->add_control(
            'category_show',
            [
                'label' => esc_html__('Category Show', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'meta_part_show',
            [
                'label' => esc_html__('Meta Part', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title_part_show',
            [
                'label' => esc_html__('Title Part', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'trim_words_count',
            [
                'label' => esc_html__('Trim Words Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__('7', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'condition' => [
                    'title_part_show' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'content_part_show',
            [
                'label' => esc_html__('Content Part', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'trim_words_count_content',
            [
                'label' => esc_html__('Trim Words Content', 'finview-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__('15', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'condition' => [
                    'content_part_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_part_show',
            [
                'label' => esc_html__('Button Part', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // button
        $this->start_controls_section(
            'blog_button',
            [
                'label' => esc_html__('Button Text', 'plugin-name'),
                'condition' => [
                    'button_part_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_button_content_style',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__('Select Style', 'finview-core'),
                'options' => [
                    'style_one' => esc_html__('Style One', 'finview-core'),
                    'style_two' => esc_html__('Style Two', 'finview-core'),
                    'style_three' => esc_html__('Style Three', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );


        // Button text
        $this->add_control(
            'blog_content_button',
            [
                'label' => esc_html__('Button', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'finview-core'),
                'placeholder' => esc_html__('Type your button here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'btn_icon_show',
            [
                'label' => esc_html__('Button Icon Show', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-arrow-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'btn_icon_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // =======================Style=================================//

        // card 
        $this->start_controls_section(
            'bg_style',
            [
                'label' => esc_html__('Card', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_content_align',
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
                'default'         => 'left',
                'selectors'     => [
                    '{{WRAPPER}} .blog_card' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .blog_card .meta' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'category_show' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_border_radius',
            [
                'label'      => __('Image Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .blog_card .blog_thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'bg_style_color',
            [
                'label'     => esc_html__('BG Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_card' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mf_input_label_box_shadow',
                'label' => esc_html__('Box Shadow', 'metform'),
                'selector' => '{{WRAPPER}} .blog_card',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .blog_card',
            ]
        );


        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .blog_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'card_con_padding',
            [
                'label'      => __('Content Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .blog_card .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_responsive_control(
            'card_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blog_card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .blog_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->end_controls_section();

        // category 
        $this->start_controls_section(
            'cat_style',
            [
                'label' => esc_html__('First Category', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'category_show' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'category_position',
            [
                'label'         => esc_html__('Category Position', 'finview-core'),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'top-left'      => [
                        'title' => esc_html__('Top Left', 'finview-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top-right'     => [
                        'title' => esc_html__('Top Right', 'finview-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'bottom-left'   => [
                        'title' => esc_html__('Bottom Left', 'finview-core'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                    'bottom-right'  => [
                        'title' => esc_html__('Bottom Right', 'finview-core'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'       => 'top-left',
                'selectors_dictionary' => [
                    'top-left'      => 'top: 0; left: 0;',
                    'top-right'     => 'top: 0; right: 0;',
                    'bottom-left'   => 'bottom: 0; left: 0;',
                    'bottom-right'  => 'bottom: 0; right: 0;',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .blog_area .blog_card .blog_thumb .first_category' => '{{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'cattyp',
                'selector' => '{{WRAPPER}} .first_category',
            ]
        );

        $this->add_control(
            'cat_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first_category' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'cat_style_bg_color',
            [
                'label'     => esc_html__('BG Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first_category' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_cat',
                'selector' => '{{WRAPPER}} .first_category',
            ]
        );

        $this->add_responsive_control(
            'cat_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .first_category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ],
            ]
        );

        $this->add_responsive_control(
            'cat_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .first_category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'cat_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .first_category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ],
            ]
        );

        $this->end_controls_section();

        // // meta
        $this->start_controls_section(
            'metastyle',
            [
                'label' => esc_html__('Meta', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'meta_part_show' =>  'yes'
                ],
            ]
        );

        $this->add_control(
            'meta_icon_show',
            [
                'label' => esc_html__('Meta Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'metacolor1',
            [
                'label'     => esc_html__('Icon Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_meta i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'meta_icon_show' =>  'yes'
                ],
            ]
        );
        $this->add_control(
            'meta_admin_show',
            [
                'label' => esc_html__('Meta Admin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'meta_calender_show',
            [
                'label' => esc_html__('Meta Calender', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'meta_comments_show',
            [
                'label' => esc_html__('Meta Comments', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'metatyp',
                'selector' => '{{WRAPPER}} .cus_meta',

            ]
        );

        $this->add_control(
            'metacolor',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_meta' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'metacolorhover',
            [
                'label'     => esc_html__('Link Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a:hover .cus_meta' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'innermeta_space_between_widgets',
            [
                'label'     => esc_html__('Meta Inner Gap', 'finview-core'),
                'type'      => Controls_Manager::GAPS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_meta' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}} !important',
                ],
            ]
        );
        $this->add_control(
            'meta_space_between_widgets',
            [
                'label'     => esc_html__('Meta Gap', 'finview-core'),
                'type'      => Controls_Manager::GAPS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} .content .meta' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'metamargin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .content .meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'metapadding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content .meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->end_controls_section();

        // card title
        $this->start_controls_section(
            'titlestyle',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title_part_show' =>  'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'title_typ',
                'selector' => '{{WRAPPER}} .cus_title',

            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'titlecolorhover',
            [
                'label'     => esc_html__('Link Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.cus_title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->end_controls_section();

        // card content
        $this->start_controls_section(
            'contentstyle',
            [
                'label' => esc_html__('Content', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_part_show' =>  'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'content_typ',
                'selector' => '{{WRAPPER}} .cus_content',

            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'contentcolorhover',
            [
                'label'     => esc_html__('Link Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.cus_content:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->end_controls_section();

        // card Button/Link
        $this->start_controls_section(
            'linkstyle',
            [
                'label' => esc_html__('Button/Link Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_part_show' =>  'yes'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'link_typ',
                'selector' => '{{WRAPPER}} .cus_link, {{WRAPPER}} .cus_blog_btn',
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'button_icon_custom_dimensionsss',
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
                    '{{WRAPPER}} .cus_link i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .cus_link svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .cus_blog_btn i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .cus_blog_btn svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );


        $this->add_control(
            'link_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_link' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_blog_btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'linkcolorhover',
            [
                'label'     => esc_html__('Btn Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.cus_link:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_blog_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .cus_blog_btn',
                'condition' => [
                    'blog_button_content_style' =>  ['style_two', 'style_three']
                ],
            ]
        );
        $this->add_control(
            'button_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_blog_btn:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_button_content_style' => ['style_two', 'style_three']
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
                    '{{WRAPPER}} .cus_blog_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'blog_button_content_style' => ['style_two', 'style_three']
                ],
            ]
        );

        $this->add_control(
            'button_width',
            [
                'label' => esc_html__('Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cus_blog_btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_button_content_style' => ['style_two', 'style_three']
                ],
            ]
        );

        // btn bg
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'label'     => esc_html__('BG Color', 'finview-core'),
                'name'     => 'grid_items_style_background',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .cus_blog_btn',
                'condition' => [
                    'blog_button_content_style' => ['style_two', 'style_three']
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'label'     => esc_html__('BG Hover Color', 'finview-core'),
                'name'     => 'grid_items_style_background_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .cus_blog_btn::before',
                'condition' => [
                    'blog_button_content_style' => ['style_two', 'style_three']
                ],
            ]
        );


        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => __('Button Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content .btn_cta .cus_blog_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ],
                'condition' => [
                    'blog_button_content_style' => ['style_two', 'style_three']
                ],
            ]
        );


        $this->add_responsive_control(
            'link_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .content .btn_cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'link_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content .btn_cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
            ]
        );

        $this->end_controls_section();

        // pagination 
        $this->start_controls_section(
            'pagination_style',
            [
                'label' => esc_html__('Pagination', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pagination_content_align',
            [
                'label'         => esc_html__('Pagination Align', 'finview-core'),
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
                    '{{WRAPPER}} .blog_pagination_area .pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'pagi_typ',
                'selector' => '{{WRAPPER}} .pagination li .page-numbers',
            ]
        );

        $this->add_control(
            'pagi_text_color',
            [
                'label'     => esc_html__('Pagination Text Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination li .page-numbers' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pagi_text_hover_color',
            [
                'label'     => esc_html__('Pagination Hover/Active Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination li .page-numbers:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pagination li .page-numbers.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagi_bgcolor',
            [
                'label'     => esc_html__('Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination li .page-numbers' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pagi_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination li .page-numbers:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .pagination li .page-numbers.current' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pagi_border',
                'selector' => '{{WRAPPER}} .pagination li .page-numbers',
            ]
        );
        $this->add_control(
            'counter_bdr_color',
            [
                'label' => esc_html__('Border Hover Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination li .page-numbers.current' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .pagination li .page-numbers:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'pagi_inner_dimensionsss',
            [
                'label' => esc_html__('Pagination Box Size', 'finview-core'),
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
                    '{{WRAPPER}} .pagination li .page-numbers' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .pagination li .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'pagi_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blog_pagination_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagi_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .blog_pagination_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                'post_type'      => 'post',
                'posts_per_page' => $settings['blog_blog_posts_per_page'],
                'orderby'        => $settings['blog_blog_template_orderby'],
                'order'          => $settings['blog_blog_template_order'],
                'post_status'    => 'publish',
                'post__in'          => $settings['blog_category'],
                'paged'          => $paged,
            )
        );



    ?>


        <?php if ($settings['blog_content_style_selection'] == 'style_one') : ?>
            <!-- ==== blog Grid start ==== -->
            <section class="blog_area section">
                <div class="container">
                    <div class="row g-4">
                        <?php
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                        ?>
                                <div class="col-12 col-md-6 col-xl-<?php echo esc_html($settings['product_grid_column']); ?>">
                                    <div class="blog_card">
                                        <div class="blog_thumb">
                                            <?php if (has_post_thumbnail()) :   ?>
                                                <a href="<?php the_permalink() ?>">
                                                    <img src="<?php the_post_thumbnail_url() ?>" alt="Image" class="w-100">
                                                </a>
                                            <?php endif ?>
                                            <?php if (!empty($settings['category_show'] == 'yes')) :   ?>
                                                <?php
                                                $pro_categories = get_the_terms(get_the_ID(), 'category');
                                                if (!empty($pro_categories) && !is_wp_error($pro_categories)) :
                                                    // Get the first category
                                                    $first_category = $pro_categories[0];
                                                ?>
                                                    <a href="<?php echo get_term_link($first_category); ?>" class="first_category">
                                                        <?php echo esc_html($first_category->name); ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <?php if (!empty($settings['meta_part_show'] == 'yes')) :   ?>
                                                <div class="meta">
                                                    <?php if (!empty($settings['meta_admin_show'] == 'yes')) :   ?>
                                                        <span class="author cus_meta">
                                                            <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                <i class="fa-regular fa-user"></i>
                                                            <?php endif ?>
                                                            <?php echo get_the_author() ?>
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if (!empty($settings['meta_calender_show'] == 'yes')) :   ?>
                                                        <span class="time cus_meta">
                                                            <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                <i class="fa-regular fa-calendar"></i>
                                                            <?php endif ?>
                                                            <?php echo get_the_date() ?>
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if (!empty($settings['meta_comments_show'] == 'yes')) :   ?>
                                                        <a href="<?php comments_link(); ?>">
                                                            <span class="comment cus_meta">
                                                                <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                    <i class="fa-regular fa-comment"></i>
                                                                <?php endif ?>
                                                                <?php comments_number(); ?>
                                                            </span>
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            <?php endif ?>

                                            <?php if (!empty($settings['title_part_show'] == 'yes')) :   ?>
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>" class="cus_title">
                                                        <?php echo wp_trim_words(get_the_title(), (int)$settings['trim_words_count'], '...'); ?>
                                                    </a>
                                                </h5>
                                            <?php endif ?>

                                            <?php if (!empty($settings['content_part_show'] == 'yes')) :   ?>
                                                <p class="cus_content">
                                                    <?php echo wp_trim_words(get_the_content(), (int)$settings['trim_words_count_content'], '...'); ?>
                                                </p>
                                            <?php endif ?>

                                            <?php if (!empty($settings['button_part_show'] == 'yes')) :   ?>

                                                <?php if ($settings['blog_button_content_style'] == 'style_one') : ?>
                                                    <?php if (!empty($settings['blog_content_button'])) : ?>
                                                        <div class="btn_cta">
                                                            <a href="<?php the_permalink() ?>" class='cus_link'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                    <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                        <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                    <?php else : ?>
                                                                        <i class="fa-solid fa-arrow-right"></i>
                                                                    <?php endif; ?>
                                                                <?php endif ?>
                                                            </a>
                                                        </div>
                                                    <?php endif ?>
                                                <?php endif ?>
                                                <?php if ($settings['blog_button_content_style'] == 'style_two') : ?>
                                                    <?php if (!empty($settings['blog_content_button'])) : ?>
                                                        <div class="btn_cta">
                                                            <a href="<?php the_permalink() ?>" class='cus_blog_btn'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                    <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                        <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                    <?php else : ?>
                                                                        <i class="fa-solid fa-arrow-right"></i>
                                                                    <?php endif; ?>
                                                                <?php endif ?>
                                                            </a>
                                                        </div>
                                                    <?php endif ?>
                                                <?php endif ?>
                                                <?php if ($settings['blog_button_content_style'] == 'style_three') : ?>
                                                    <?php if (!empty($settings['blog_content_button'])) : ?>
                                                        <div class="btn_cta">
                                                            <a href="<?php the_permalink() ?>" class='cus_blog_btn cus_blog_btn_secondary'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                    <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                        <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                    <?php else : ?>
                                                                        <i class="fa-solid fa-arrow-right"></i>
                                                                    <?php endif; ?>
                                                                <?php endif ?>
                                                            </a>
                                                        </div>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="blog_pagination_area">
                                <?php
                                $big = 999999999; // need an unlikely integer
                                $pagination = paginate_links(array(
                                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format'    => '?paged=%#%',
                                    'current'   => max(1, get_query_var('paged')),
                                    'total'     => $query->max_num_pages,
                                    'type'      => 'list',
                                    'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                                    'next_text' => '<i class="fa-solid fa-angle-right"></i>',
                                ));
                                if ($pagination) {
                                    echo '<div class="pagination">' . $pagination . '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ==== / blog Grid end ==== -->
        <?php endif ?>

        <?php if ($settings['blog_content_style_selection'] == 'style_two') : ?>
            <!-- ==== blog Left Sidrbar start ==== -->
            <section class="blog_area section">
                <div class="container">
                    <div class="row gy-5 gy-lg-0">
                        <div class="col-12 col-lg-4">
                            <div class="sidebar wow fadeInDown" data-wow-duration="0.8s">
                                <?php get_sidebar() ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row g-4">
                                <?php
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                ?>
                                        <div class="col-12 col-md-6 col-xl-<?php echo esc_html($settings['product_grid_column']); ?>">
                                            <div class="blog_card">
                                                <div class="blog_thumb">
                                                    <?php if (has_post_thumbnail()) :   ?>
                                                        <a href="<?php the_permalink() ?>">
                                                            <img src="<?php the_post_thumbnail_url() ?>" alt="Image" class="w-100">
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if (!empty($settings['category_show'] == 'yes')) :   ?>
                                                        <?php
                                                        $pro_categories = get_the_terms(get_the_ID(), 'category');
                                                        if (!empty($pro_categories) && !is_wp_error($pro_categories)) :
                                                            // Get the first category
                                                            $first_category = $pro_categories[0];
                                                        ?>
                                                            <a href="<?php echo get_term_link($first_category); ?>" class="first_category">
                                                                <?php echo esc_html($first_category->name); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="content">
                                                    <?php if (!empty($settings['meta_part_show'] == 'yes')) :   ?>
                                                        <div class="meta">
                                                            <?php if (!empty($settings['meta_admin_show'] == 'yes')) :   ?>
                                                                <span class="author cus_meta">
                                                                    <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                        <i class="fa-regular fa-user"></i>
                                                                    <?php endif ?>
                                                                    <?php echo get_the_author() ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (!empty($settings['meta_calender_show'] == 'yes')) :   ?>
                                                                <span class="time cus_meta">
                                                                    <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                        <i class="fa-regular fa-calendar"></i>
                                                                    <?php endif ?>
                                                                    <?php echo get_the_date() ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (!empty($settings['meta_comments_show'] == 'yes')) :   ?>
                                                                <a href="<?php comments_link(); ?>">
                                                                    <span class="comment cus_meta">
                                                                        <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                            <i class="fa-regular fa-comment"></i>
                                                                        <?php endif ?>
                                                                        <?php comments_number(); ?>
                                                                    </span>
                                                                </a>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endif ?>

                                                    <?php if (!empty($settings['title_part_show'] == 'yes')) :   ?>
                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>" class="cus_title">
                                                                <?php echo wp_trim_words(get_the_title(), (int)$settings['trim_words_count'], '...'); ?>
                                                            </a>
                                                        </h5>
                                                    <?php endif ?>

                                                    <?php if (!empty($settings['content_part_show'] == 'yes')) :   ?>
                                                        <p class="cus_content">
                                                            <?php echo wp_trim_words(get_the_content(), (int)$settings['trim_words_count_content'], '...'); ?>
                                                        </p>
                                                    <?php endif ?>

                                                    <?php if (!empty($settings['button_part_show'] == 'yes')) :   ?>

                                                        <?php if ($settings['blog_button_content_style'] == 'style_one') : ?>
                                                            <?php if (!empty($settings['blog_content_button'])) : ?>
                                                                <div class="btn_cta">
                                                                    <a href="<?php the_permalink() ?>" class='cus_link'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                        <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                            <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                            <?php else : ?>
                                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php if ($settings['blog_button_content_style'] == 'style_two') : ?>
                                                            <?php if (!empty($settings['blog_content_button'])) : ?>
                                                                <div class="btn_cta">
                                                                    <a href="<?php the_permalink() ?>" class='cus_blog_btn'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                        <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                            <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                            <?php else : ?>
                                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php if ($settings['blog_button_content_style'] == 'style_three') : ?>
                                                            <?php if (!empty($settings['blog_content_button'])) : ?>
                                                                <div class="btn_cta">
                                                                    <a href="<?php the_permalink() ?>" class='cus_blog_btn cus_blog_btn_secondary'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                        <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                            <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                            <?php else : ?>
                                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="blog_pagination_area">
                                        <?php
                                        $big = 999999999; // need an unlikely integer
                                        $pagination = paginate_links(array(
                                            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                            'format'    => '?paged=%#%',
                                            'current'   => max(1, get_query_var('paged')),
                                            'total'     => $query->max_num_pages,
                                            'type'      => 'list',
                                            'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                                            'next_text' => '<i class="fa-solid fa-angle-right"></i>',
                                        ));
                                        if ($pagination) {
                                            echo '<div class="pagination">' . $pagination . '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ==== / blog Left Sidrbar end ==== -->
        <?php endif ?>

        <?php if ($settings['blog_content_style_selection'] == 'style_three') : ?>
            <!-- ==== blog Left Sidrbar start ==== -->
            <section class="blog_area section">
                <div class="container">
                    <div class="row gy-5 gy-lg-0">

                        <div class="col-12 col-lg-8">
                            <div class="row g-4">
                                <?php
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                ?>
                                        <div class="col-12 col-md-6 col-xl-<?php echo esc_html($settings['product_grid_column']); ?>">
                                            <div class="blog_card">
                                                <div class="blog_thumb">
                                                    <?php if (has_post_thumbnail()) :   ?>
                                                        <a href="<?php the_permalink() ?>">
                                                            <img src="<?php the_post_thumbnail_url() ?>" alt="Image" class="w-100">
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if (!empty($settings['category_show'] == 'yes')) :   ?>
                                                        <?php
                                                        $pro_categories = get_the_terms(get_the_ID(), 'category');
                                                        if (!empty($pro_categories) && !is_wp_error($pro_categories)) :
                                                            // Get the first category
                                                            $first_category = $pro_categories[0];
                                                        ?>
                                                            <a href="<?php echo get_term_link($first_category); ?>" class="first_category">
                                                                <?php echo esc_html($first_category->name); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="content">
                                                    <?php if (!empty($settings['meta_part_show'] == 'yes')) :   ?>
                                                        <div class="meta">
                                                            <?php if (!empty($settings['meta_admin_show'] == 'yes')) :   ?>
                                                                <span class="author cus_meta">
                                                                    <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                        <i class="fa-regular fa-user"></i>
                                                                    <?php endif ?>
                                                                    <?php echo get_the_author() ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (!empty($settings['meta_calender_show'] == 'yes')) :   ?>
                                                                <span class="time cus_meta">
                                                                    <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                        <i class="fa-regular fa-calendar"></i>
                                                                    <?php endif ?>
                                                                    <?php echo get_the_date() ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (!empty($settings['meta_comments_show'] == 'yes')) :   ?>
                                                                <a href="<?php comments_link(); ?>">
                                                                    <span class="comment cus_meta">
                                                                        <?php if (!empty($settings['meta_icon_show'] == 'yes')) :   ?>
                                                                            <i class="fa-regular fa-comment"></i>
                                                                        <?php endif ?>
                                                                        <?php comments_number(); ?>
                                                                    </span>
                                                                </a>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endif ?>

                                                    <?php if (!empty($settings['title_part_show'] == 'yes')) :   ?>
                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>" class="cus_title">
                                                                <?php echo wp_trim_words(get_the_title(), (int)$settings['trim_words_count'], '...'); ?>
                                                            </a>
                                                        </h5>
                                                    <?php endif ?>

                                                    <?php if (!empty($settings['content_part_show'] == 'yes')) :   ?>
                                                        <p class="cus_content">
                                                            <?php echo wp_trim_words(get_the_content(), (int)$settings['trim_words_count_content'], '...'); ?>
                                                        </p>
                                                    <?php endif ?>

                                                    <?php if (!empty($settings['button_part_show'] == 'yes')) :   ?>

                                                        <?php if ($settings['blog_button_content_style'] == 'style_one') : ?>
                                                            <?php if (!empty($settings['blog_content_button'])) : ?>
                                                                <div class="btn_cta">
                                                                    <a href="<?php the_permalink() ?>" class='cus_link'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                        <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                            <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                            <?php else : ?>
                                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php if ($settings['blog_button_content_style'] == 'style_two') : ?>
                                                            <?php if (!empty($settings['blog_content_button'])) : ?>
                                                                <div class="btn_cta">
                                                                    <a href="<?php the_permalink() ?>" class='cus_blog_btn'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                        <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                            <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                            <?php else : ?>
                                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php if ($settings['blog_button_content_style'] == 'style_three') : ?>
                                                            <?php if (!empty($settings['blog_content_button'])) : ?>
                                                                <div class="btn_cta">
                                                                    <a href="<?php the_permalink() ?>" class='cus_blog_btn cus_blog_btn_secondary'><?php echo esc_html($settings['blog_content_button']) ?>
                                                                        <?php if (!empty($settings['btn_icon_show'] == 'yes')) :   ?>
                                                                            <?php if (!empty($settings['btn_icon'])) :   ?>
                                                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                            <?php else : ?>
                                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="blog_pagination_area">
                                        <?php
                                        $big = 999999999; // need an unlikely integer
                                        $pagination = paginate_links(array(
                                            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                            'format'    => '?paged=%#%',
                                            'current'   => max(1, get_query_var('paged')),
                                            'total'     => $query->max_num_pages,
                                            'type'      => 'list',
                                            'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                                            'next_text' => '<i class="fa-solid fa-angle-right"></i>',
                                        ));
                                        if ($pagination) {
                                            echo '<div class="pagination">' . $pagination . '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="sidebar wow fadeInDown" data-wow-duration="0.8s">
                                <?php get_sidebar() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ==== / blog Right Sidrbar end ==== -->
        <?php endif ?>


<?php
    }
}

$widgets_manager->register(new TP_Blog_page());
