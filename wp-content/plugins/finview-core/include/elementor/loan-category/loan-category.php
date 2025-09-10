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
class TP_loan_category extends Widget_Base
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
        return 'tp-loan-category';
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
        return __('loan Category', 'tpcore');
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

    protected function get_taxonomy_terms($taxonomy)
    {
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false, // Include terms with no posts.
        ));

        $options = [];
        if (!is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }

        return $options;
    }

    protected function get_default_categories($taxonomy)
    {
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ));

        return !is_wp_error($terms) ? wp_list_pluck($terms, 'term_id') : [];
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
            'loan_cat_section_genaral',
            [
                'label' => esc_html__('Loan Category Section', 'finview-core')
            ]
        );

        $this->add_control(
            'loan_category_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'finview-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'finview-core'),
                    'style_two' => esc_html__('Style Two', 'finview-core'),
                    'style_three' => esc_html__('Style Three', 'finview-core'),
                    'style_four' => esc_html__('Style Four', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );



        $this->add_control(
            'loans_category',
            [
                'label' => __('Select Category', 'turio-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_taxonomy_terms('loans-cat'), // Adjust 'product_cat' to your taxonomy
                // 'default'     => [],
                'default' => $this->get_default_categories('loans-cat'),
            ]
        );


        $this->add_control(
            'loans_template_order_by',
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
            'loans_template_order',
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


        $this->add_control(
            'finview_heading_title',
            [
                'label' => esc_html__('Card Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Research & Explore', 'finview-core'),
                'placeholder' => esc_html__('Type your Title here', 'finview-core'),
                'label_block' => true,
                'condition' => [
                    'loan_category_content_style_selection' => 'style_three',
                ]
            ],
        );

        $this->end_controls_section();


        // Title 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'loan_category_content_style_selection' => 'style_three',
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
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <style>
            .sidebar .sidebar__part {
                border-radius: none;
                background: transparent;
                box-shadow: unset;
                padding: 0;
                border: none;
            }

            .sidebar-filter__part ul.query.p-0.m-0 a {
                display: block;
            }

            .sidebar-filter__part li {
                transition: var(--transition);
            }

            @media screen and (max-width: 575px) {

                .anyloan-wrapper .home-loan-items {
                    padding: 20px 16px;
                }

                .anyloan-wrapper .slider-navigation {
                    left: -14px;
                    width: 106%;
                }
            }
            @media screen and (max-width: 400px) {


                .anyloan-wrapper .slider-navigation {
                    width: 109%;
                }
            }
        </style>


        <script>
            jQuery(document).ready(function($) {
                // Hero Loan4
                jQuery(".hero-homelon-slider")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        speed: 1500,
                        arrows: true,
                        dots: false,
                        prevArrow: $(".prev-testimonials2"),
                        nextArrow: $(".next-testimonials2"),
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 4,
                                },
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 3,
                                },
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 2,
                                },
                            },
                            {
                                breakpoint: 0,
                                settings: {
                                    slidesToShow: 2,
                                },
                            }
                        ],
                    });

                // Hero Loan5
                jQuery(".hero-homelon-slider2")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        speed: 1500,
                        arrows: true,
                        dots: false,
                        prevArrow: $(".prev-testimonials2"),
                        nextArrow: $(".next-testimonials2"),
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 4,
                                },
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 3,
                                },
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 2,
                                },
                            },
                            {
                                breakpoint: 0,
                                settings: {
                                    slidesToShow: 2,
                                },
                            }
                        ],
                    });
            });
        </script>





        <?php
        if (empty($settings['loans_category'])) {
            echo '<p>' . esc_html__('No loan categories selected.', 'tpcore') . '</p>';
            return;
        }


        // Get all selected categories with proper ordering
        $term_args = array(
            'taxonomy'   => 'loans-cat',
            'include'    => $settings['loans_category'],
            'orderby'    => $settings['loans_template_order_by'],
            'order'      => $settings['loans_template_order'],
            'hide_empty' => false
        );

        // Special handling for random order
        if ($settings['loans_template_order_by'] === 'rand') {
            $selected_categories = $settings['loans_category'];
            shuffle($selected_categories);
        } else {
            $terms = get_terms($term_args);
            $selected_categories = wp_list_pluck($terms, 'term_id');
        }

        ?>
        <?php if ($settings['loan_category_content_style_selection'] == 'style_one') : ?>
            <div class="sidebar">
                <div class="sidebar-filter__part">
                    <ul class="query p-0 m-0">
                        <?php
                        // Loop directly through the selected categories
                        foreach ($settings['loans_category'] as $category_id) :
                            $category = get_term($category_id, 'loans-cat');

                            // Skip if category doesn't exist
                            if (!$category || is_wp_error($category)) continue;
                        ?>
                            <a href="<?php echo get_term_link($category); ?>">
                                <li class="d-flex justify-content-between align-items-center">
                                    <div class="query__label"><?php echo esc_html($category->name); ?></div>
                                    <div class="query_value"><?php echo esc_html($category->count); ?></div>
                                </li>
                            </a>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        <?php endif ?>

        <?php
        if ($settings['loan_category_content_style_selection'] == 'style_two') : ?>
            <div class="hero-version3">
                <div class="loan-tabbing-wrap d-flex flex-wrap">
                    <?php
                    foreach ($selected_categories as $category_id) :
                        $category = get_term($category_id, 'loans-cat');

                        // Skip if category doesn't exist
                        if (!$category || is_wp_error($category)) continue;

                        $loan_category_img = get_field('loan_category_img', $category);
                    ?>
                        <div class="loan-tab-items">
                            <?php if (!empty($loan_category_img)) : ?>
                                <img src="<?php echo esc_url($loan_category_img['url']); ?>" class="loan-thumb" alt="<?php echo esc_attr($category->name); ?>">
                            <?php endif; ?>

                            <h4 class="n700 mt-2">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            </h4>

                            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="mortgage-icon">
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($settings['loan_category_content_style_selection'] == 'style_three') : ?>
            <div class="hero hero-version4 pt-0 overflow-visible">
                <div class="container">
                    <div class="hero4-homeloan-wrap position-relative">
                        <?php if (!empty($settings['finview_heading_title'])) : ?>
                            <h5 class="title"><?php echo esc_html($settings['finview_heading_title']) ?></h5>
                        <?php endif ?>
                        <div class="hero-homelon-slider">
                            <?php
                            foreach ($selected_categories as $category_id) :
                                $category = get_term($category_id, 'loans-cat');

                                // Skip if category doesn't exist
                                if (!$category || is_wp_error($category)) continue;

                                $loan_category_img = get_field('loan_category_img', $category);
                            ?>
                                <div class="slide-card">
                                    <div class="home-loan-items">
                                        <?php if (!empty($loan_category_img)) : ?>
                                            <img src="<?php echo esc_url($loan_category_img['url']); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                        <?php endif; ?>
                                        <h4> <?php echo esc_html($category->name); ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="slider-navigation">
                            <button class="prev-testimonials2 pagination-button">
                                <i class="bi bi-arrow-left"></i>
                            </button>

                            <button class="next-testimonials2 pagination-button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($settings['loan_category_content_style_selection'] == 'style_four') : ?>
            <div class="anyloan-section overflow-visible ">
                <div class="container">
                    <div class="anyloan-wrapper position-relative">
                        <div class="hero-homelon-slider2">
                            <?php
                            foreach ($selected_categories as $category_id) :
                                $category = get_term($category_id, 'loans-cat');

                                // Skip if category doesn't exist
                                if (!$category || is_wp_error($category)) continue;

                                $loan_category_img = get_field('loan_category_img', $category);
                            ?>
                                <div class="slide-card">
                                    <div class="home-loan-items">
                                        <?php if (!empty($loan_category_img)) : ?>
                                            <img src="<?php echo esc_url($loan_category_img['url']); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                        <?php endif; ?>
                                        <h4> <?php echo esc_html($category->name); ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="slider-navigation">
                            <button class="prev-testimonials2 pagination-button">
                                <i class="bi bi-arrow-left"></i>
                            </button>

                            <button class="next-testimonials2 pagination-button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_loan_category());
