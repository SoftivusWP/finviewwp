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
class TP_faq extends Widget_Base
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
        return 'tp-faq';
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
        return __('FAQ', 'tpcore');
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


        //faq Section
        $this->start_controls_section(
            'finview_faq_section_genaral',
            [
                'label' => esc_html__('FAQ', 'finview-core')
            ]
        );


        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_cont_faq_title',
            [
                'label' => esc_html__('cont_card Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('How do I apply for a loan through your platform?', 'finview-core'),
                'placeholder' => esc_html__('Type your title here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'finview_cont_faq_content',
            [
                'label' => esc_html__('Short Description', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Absolutely. We strive to provide reliable and up-to-date information. Our team follows strict editorial guidelines to ensure the accuracy and integrity of our content. However,', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
            ]
        );

        $this->add_control(
            'faq_repeater',
            [
                'label' => esc_html__('FAQ Content', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_cont_faq_title' => esc_html__('How do I apply for a loan through your platform?', 'finview-core'),
                    ],
                    [
                        'finview_cont_faq_title' => esc_html__('What types of loans do you review and compare?', 'finview-core'),
                    ],
                    [
                        'finview_cont_faq_title' => esc_html__('Can I trust the information provided on your website?', 'finview-core'),
                    ],
                    [
                        'finview_cont_faq_title' => esc_html__('Do you offer financial advice or recommendations?', 'finview-core'),
                    ],
                    [
                        'finview_cont_faq_title' => esc_html__('How do I apply for a loan through your platform?', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_cont_faq_title }}}',
            ]
        );

        $this->end_controls_section();

        // ======================= Style =================================//



        // Facility  Icon 
        $this->start_controls_section(
            'facility_icon_style',
            [
                'label' => esc_html__('Icon', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        // Icon Size
        $this->add_responsive_control(
            'icon_custom_box_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'plugin-name'),
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
                    '{{WRAPPER}} .accordion .accordion-button::after' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Box Size', 'plugin-name'),
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
                    '{{WRAPPER}} .accordion .accordion-button::after' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'facility_icon_color',
            [
                'label'     => esc_html__('Active Icon Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .accordion-button::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'facility_icon_active_color',
            [
                'label'     => esc_html__('Active Icon Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .accordion-button:not(.collapsed)::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'facility_icon_box_bg',
            [
                'label'     => esc_html__('Icon Box Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .accordion-button::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'facility_icon_box_bg_active',
            [
                'label'     => esc_html__('Icon Box Active Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .accordion-button:not(.collapsed)::after' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        // Faq Color
        $this->start_controls_section(
            'facility_faq_color_style',
            [
                'label' => esc_html__('FAQ Color', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'facility_faq_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'facility_faq_active_color_hover',
            [
                'label'     => esc_html__('Active Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .accordion-button:not(.collapsed)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'facility_faq_color_hover',
            [
                'label'     => esc_html__('Details Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-body p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'facility_faq_bg',
            [
                'label'     => esc_html__('Background', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'facility_faq_bg_active',
            [
                'label'     => esc_html__('Active Background', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item.accordion_bg' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_faq_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_faq_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();



        // Typography
        $this->start_controls_section(
            'facility_faq_style',
            [
                'label' => esc_html__('FAQ Typography', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Title Typography', 'plugin-name'),
                'name'     => 'facility_faq_style_typ',
                'selector' => '{{WRAPPER}} .accordion-header .accordion-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Details Typography', 'plugin-name'),
                'name'     => 'facility_faq_det_style_typ',
                'selector' => '{{WRAPPER}} .accordion-body p',
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



        <!-- faq start -->
        <div class="col-12">
            <?php $faqId = 'faq-' . uniqid(); ?>
            <div class="accordion" id="<?php echo esc_attr($faqId); ?>">
                <?php foreach ($settings['faq_repeater'] as $key => $item) : ?>
                    <div class="accordion-item">
                        <h5 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-<?php echo esc_html($key); ?>-<?php echo esc_attr($faqId); ?>" aria-expanded="true" aria-controls="faq-accordion-<?php echo esc_html($key); ?>-<?php echo esc_attr($faqId); ?>">
                                <?php echo esc_html($item['finview_cont_faq_title']); ?>
                            </button>
                        </h5>
                        <div id="faq-accordion-<?php echo esc_html($key); ?>-<?php echo esc_attr($faqId); ?>" class="accordion-collapse collapse" data-bs-parent="#<?php echo esc_attr($faqId); ?>">
                            <div class="accordion-body">
                                <p class="mb-0">
                                    <?php echo esc_html($item['finview_cont_faq_content']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <!-- faq end -->


<?php
    }
}

$widgets_manager->register(new TP_faq());
