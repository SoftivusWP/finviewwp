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
class TP_apps extends Widget_Base
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
        return 'tp-Apps';
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
        return __('Apps', 'tpcore');
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
                'default' => esc_html__('Download Our Apps', 'finview-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_heading_content_title',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Get Our Apps for Easy Financial Management', 'finview-core'),
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
                'default' => esc_html__('Take advantage of our convenient mobile apps to access our services anytime, anywhere. Download our apps today and experience the ease of managing your finances', 'finview-core'),
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
                'default' => esc_html__('Lorem Ipsum is simply.', 'finview-core'),
                'placeholder' => esc_html__('Type your list content here', 'finview-core'),
            ]
        );

        $this->add_control(
            'list_repeater',
            [
                'label' => esc_html__('Card', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_list_content' => esc_html__('Quick Loan Application', 'finview-core'),
                    ],
                    [
                        'finview_list_content' => esc_html__('Secure and Private', 'finview-core'),
                    ],
                    [
                        'finview_list_content' => esc_html__('User-Friendly Interface', 'finview-core'),
                    ],
                    [
                        'finview_list_content' => esc_html__('Stay Connected', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_list_content }}}',
            ]
        );



        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'finview_card_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'bi bi-google-play',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'finview_card_icon_link',
            [
                'label' => esc_html__('Icon Link', 'finview-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://example.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'apps_repeater',
            [
                'label' => esc_html__('Apps', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_card_icon' => esc_html__('Application', 'finview-core'),
                    ],
                    [
                        'finview_card_icon' => esc_html__('Application', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_card_icon }}}',
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
            'card_title_style',
            [
                'label' => esc_html__('List', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'card_title_style_typ',
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

            <!-- download-app start -->
            <section class="download-app section">
                <div class="container">
                    <div class="row justify-content-center justify-content-lg-between align-items-center gy-5 gy-lg-0">
                        <div class="col-12 col-sm-7 col-lg-5 order-1 order-lg-0">
                            <?php if (!empty($settings['finview_about_content_image']['url'])) : ?>
                                <div class="download-app__thumb me-lg-5 me-xxl-0  wow fadeInDown" data-wow-duration="0.8s">
                                    <img src="<?php echo esc_url($settings['finview_about_content_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>">
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

                                <ul class="cus_list section__content-list wow fadeInUp" data-wow-duration="0.8s">
                                    <?php foreach ($settings['list_repeater'] as $item) : ?>
                                        <li class="headingFive"> <?php echo !empty($item['finview_list_content']) ? esc_html($item['finview_list_content']) : ''; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="btn-group mt_40 wow fadeInDown" data-wow-duration="0.8s">
                                    <?php foreach ($settings['apps_repeater'] as $items) : ?>
                                        <?php if (!empty($items['finview_card_icon'])) : ?>
                                            <a href="<?php echo esc_url($items['finview_card_icon_link']['url']); ?>" class="btn_theme btn_alt">
                                                <?php \Elementor\Icons_Manager::render_icon($items['finview_card_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php endif ?>
                                    <?php endforeach ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- download-app end -->
        <?php endif; ?>
        <!-- ==== about section one start ==== -->


<?php
    }
}

$widgets_manager->register(new TP_apps());
