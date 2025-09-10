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
class TP_service_category extends Widget_Base
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
        return 'tp-service-category';
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
        return __('Service Category', 'tpcore');
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


        $this->start_controls_section(
            'finview_category_box_card_section_genaral',
            [
                'label' => esc_html__('Category', 'bankio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_category_box_color',
            [
                'label' => esc_html__('Color', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li a span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_category_box_hover_color',
            [
                'label' => esc_html__('Hover Color', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li a:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_category_bg_color',
            [
                'label' => esc_html__('List BG', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li a' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_category_bg_color_hover',
            [
                'label' => esc_html__('List Hover BG', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li a:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .category li',
            ]
        );
        $this->add_responsive_control(
            'button_category_box_border_radius',
            [
                'label'      => __('Border Radius', 'bankio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .category li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'space_between_widgets',
            [
                'label'     => esc_html__('Gap', 'finview-core'),
                'type'      => Controls_Manager::GAPS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} .category' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_category_box_style_margin',
            [
                'label' => esc_html__('Margin', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_category_box_style_padding',
            [
                'label'      => __('Padding', 'bankio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sidebar .sidebar__part .category li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->end_controls_section();

        
        // Icon 
        $this->start_controls_section(
            'counter_icon_style',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

      
        $this->add_control(
            'counter_icon_color',
            [
                'label'     => esc_html__('Icon Color For SVG, I', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category__icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .category__icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hover_color',
            [
                'label'     => esc_html__('Hover Color For SVG, I', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category__icon:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .category__icon:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_icon_bgcolor',
            [
                'label'     => esc_html__('Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li a .category__icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li:hover a .category__icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .category li a .category__icon',
            ]
        );

        $this->add_control(
            'bdr_counter_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category li:hover a .category__icon' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .category li a .category__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .category__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .category__icon svg' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .category__icon img' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .sidebar .sidebar__part .category li .category__icon' => 'height: {{SIZE}}{{UNIT}} !important;width: {{SIZE}}{{UNIT}}!important;min-width: {{SIZE}}{{UNIT}} !important;',


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
                    '{{WRAPPER}} .category__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .category__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                // 'posts_per_page' => $settings['services_posts_per_page'],
                // 'orderby'        => $settings['services_template_order_by'],
                // 'order'          => $settings['services_template_order'],
                'offset'         => 0,
                'post_status'    => 'publish',
            )
        );

?>

        <style>
            .sidebar .sidebar__part {
                border-radius: none;
                background: transparent;
                box-shadow: unset;
                padding: 0;
                border: none;
            }

            .category li {
                overflow: hidden;
            }
            .category__icon{
                transition: var(--transition);
                overflow: hidden;
            }
        </style>





        <div class="sidebar">
            <div class="sidebar__part">
                <ul class="category p-0">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'services-cat',
                        'hide_empty' => false,
                    ));

                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $service_category_icon = get_field('service_category_icon', $category);
                    ?>
                            <li>
                                <a href="<?php echo get_term_link($category); ?>">
                                    <span class="category__icon">
                                        <?php if (!empty($service_category_icon)) : ?>
                                            <img src="<?php echo esc_url($service_category_icon['url']); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                        <?php endif ?>
                                    </span>
                                    <span class="category__content"><?php echo esc_html($category->name); ?></span>
                                </a>
                            </li>
                    <?php
                        }
                    } else {
                        echo '<li>No categories found for this post type.</li>';
                    }
                    ?>

                </ul>
            </div>
        </div>


<?php
    }
}

$widgets_manager->register(new TP_service_category());
