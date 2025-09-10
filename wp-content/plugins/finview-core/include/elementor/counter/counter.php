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
class TP_counter extends Widget_Base
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
        return 'tp-counter';
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
        return __('Counter', 'tpcore');
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
        $start = is_rtl() ? 'right' : 'left';
        $end = ! is_rtl() ? 'right' : 'left';
        // ====================================== Content One ============================================//

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Counter', 'finview-core'),
            ]
        );


        $this->add_responsive_control(
            'finview_heading_content_align',
            [
                'label'         => esc_html__('Text Align', 'finview-core'),
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
                ],
                'default'         => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .countdown__content' => 'align-items: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'gameplex_heading_content_align',
            [
                'label'         => esc_html__('Justify Content', 'finview-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'start'         => [
                        'title' => esc_html__('Start', 'finview-core'),
                        'icon'     => 'eicon-flex eicon-justify-start-h',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'finview-core'),
                        'icon'     => 'eicon-flex eicon-justify-center-h',
                    ],
                    'end'     => [
                        'title' => esc_html__('End', 'finview-core'),
                        'icon'     => 'eicon-flex eicon-justify-end-h',
                    ],
                    'space-between'     => [
                        'title' => esc_html__('Space Between', 'finview-core'),
                        'icon'     => 'eicon-flex eicon-justify-space-between-h',
                    ],
                    'space-around'     => [
                        'title' => esc_html__('Space Around', 'finview-core'),
                        'icon'     => 'eicon-justify-space-around-h',
                    ],
                    'space-evenly'     => [
                        'title' => esc_html__('Space Evenly', 'finview-core'),
                        'icon'     => 'eicon-justify-space-evenly-h',
                    ],
                ],
                'default'         => 'between',
                'selectors'     => [
                    '{{WRAPPER}} .countdown__area' => 'justify-content: {{VALUE}} !important;',
                ],
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'width_counter_part',
            [
                'label'   => esc_html__('Width', 'finview-core'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown .countdown__area .countdown__part' => 'width: {{SIZE}}{{UNIT}} ;',
                ],
            ]
        );





        $this->add_control(
            'section_pt_show',
            [
                'label' => esc_html__('Padding Top', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'section_pb_show',
            [
                'label' => esc_html__('Padding Bottom', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'card_icon_hide',
            [
                'label' => esc_html__('Icon Show', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'finview-core'),
                'label_off' => esc_html__('Hide', 'finview-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );



        $this->add_responsive_control(
            'title_position',
            [
                'label' => esc_html__('Icon Position', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'before' => [
                        'title' => esc_html__('Before', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'after' => [
                        'title' => esc_html__('After', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],

                    'start' => [
                        'title' => esc_html__('Start', 'elementor'),
                        'icon' => "eicon-h-align-$start",
                    ],
                    'end' => [
                        'title' => esc_html__('End', 'elementor'),
                        'icon' => "eicon-h-align-$end",
                    ],
                ],
                'selectors_dictionary' => [
                    'before' => 'flex-direction: column;',
                    'after' => 'flex-direction: column-reverse;',
                    'start' => 'flex-direction: row;',
                    'end' => 'flex-direction: row-reverse;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown__part' => '{{VALUE}}',
                ],
                'condition' => [
                    'card_icon_hide' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_position',
            [
                'label' => esc_html__('Text Content Position', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'before' => [
                        'title' => esc_html__('Before', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'after' => [
                        'title' => esc_html__('After', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'start' => [
                        'title' => esc_html__('Start', 'elementor'),
                        'icon' => 'eicon-h-align-left', // Fixed icon
                    ],
                    'end' => [
                        'title' => esc_html__('End', 'elementor'),
                        'icon' => 'eicon-h-align-right', // Fixed icon
                    ],
                ],
                'selectors_dictionary' => [
                    'before' => 'flex-direction: column !important;',
                    'after' => 'flex-direction: column-reverse !important;',
                    'start' => 'flex-direction: row !important;',
                    'end' => 'flex-direction: row-reverse !important;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown__content' => '{{VALUE}}',
                ],
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'finview_counter_card_icon',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'finview-users',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'finview_counter_number',
            [
                'label' => esc_html__('Counter Number', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('66.6', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'counter_suffix',
            [
                'label' => esc_html__('Counter Sign', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('k', 'finview-core'),
                'placeholder' => esc_html__('Type your number here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'finview_counter_text',
            [
                'label' => esc_html__('Title', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 10,
                'default' => esc_html__('Total Services Loan', 'finview-core'),
                'placeholder' => esc_html__('Type your description here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'card_repeater',
            [
                'label' => esc_html__('Counter Card', 'finview-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'finview_counter_number' => esc_html__('66.6', 'finview-core'),
                        'finview_counter_text' => esc_html__('Total Services Loan', 'finview-core'),
                    ],
                    [
                        'finview_counter_number' => esc_html__('99.5', 'finview-core'),
                        'finview_counter_text' => esc_html__('Customer Satisfaction', 'finview-core'),
                    ],
                    [
                        'finview_counter_number' => esc_html__('33.9', 'finview-core'),
                        'finview_counter_text' => esc_html__('Compare Loan', 'finview-core'),
                    ],
                    [
                        'finview_counter_number' => esc_html__('504', 'finview-core'),
                        'counter_suffix' => esc_html__('+', 'finview-core'),
                        'finview_counter_text' => esc_html__('Awards Won', 'finview-core'),
                    ],
                ],
                'title_field' => '{{{ finview_counter_text }}}',

            ]
        );


        $this->end_controls_section();


        // ======================= Style =================================//

        // counter_card_bg_style
        $this->start_controls_section(
            'counter_bg_style',
            [
                'label' => esc_html__('Counter', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_bg_style_color',
            [
                'label'     => esc_html__('BG Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown:after ' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'counter_box_style_color',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );



        $this->end_controls_section();

        // counter_number_style
        $this->start_controls_section(
            'counter_number_style',
            [
                'label' => esc_html__('Counter Number', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'counter_number_style_typ',
                'selector' => '{{WRAPPER}} .countdown__title',

            ]
        );

        $this->add_control(
            'number_tag',
            [
                'label' => esc_html__('Number HTML Tag', 'finview-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h2' =>  esc_html__('H2', 'finview-core'),
                    'h3' =>  esc_html__('H3', 'finview-core'),
                    'h4' =>  esc_html__('H4', 'finview-core'),
                    'h5' =>  esc_html__('H5', 'finview-core'),
                    'h6' =>  esc_html__('H6', 'finview-core'),
                    'p' =>  esc_html__('p', 'finview-core'),
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'display_class',
            [
                'label' => esc_html__('Display Class', 'finview-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'display-1' =>  esc_html__('Display 1', 'finview-core'),
                    'display-2' =>  esc_html__('Display 2', 'finview-core'),
                    'display-3' =>  esc_html__('Display 3', 'finview-core'),
                    'display-4' =>  esc_html__('Display 4', 'finview-core'),
                    'display-5' =>  esc_html__('Display 5', 'finview-core'),
                    'display-6' =>  esc_html__('Display 6', 'finview-core'),
                ],
                'default' => 'display-4',
                'condition' => [
                    'number_tag' => 'h2',
                ],
            ]
        );

        $this->add_control(
            'number_add_class',
            [
                'label' => esc_html__('Add Class', 'finview-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fs-3xl' => esc_html__('32px', 'finview-core'),
                    'fs-2xl' => esc_html__('24px', 'finview-core'),
                    'fs-xl' => esc_html__('20px', 'finview-core'),
                    'fs-lg' => esc_html__('18px', 'finview-core'),
                    'fs-base ' => esc_html__('16px', 'finview-core'),
                    'fs-sm' => esc_html__('14px', 'finview-core'),
                    'fs-xs' => esc_html__('12px', 'finview-core'),
                ],
                'default' => 'fs_base',
                'condition' => [
                    'number_tag' => ['p', 'span', 'div'],
                ],
            ]
        );


        $this->add_control(
            'counter_number_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_number_counter_suffix_style_color',
            [
                'label'     => esc_html__('Suffix Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter_suffix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // counter_text
        $this->start_controls_section(
            'counter_text_style',
            [
                'label' => esc_html__('Counter Text', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'counter_text_style_typ',
                'selector' => '{{WRAPPER}} .counter_text',

            ]
        );

        $this->add_control(
            'counter_text_style_color',
            [
                'label'     => esc_html__('Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h2' =>  esc_html__('H2', 'finview-core'),
                    'h3' =>  esc_html__('H3', 'finview-core'),
                    'h4' =>  esc_html__('H4', 'finview-core'),
                    'h5' =>  esc_html__('H5', 'finview-core'),
                    'h6' =>  esc_html__('H6', 'finview-core'),
                    'div' =>  esc_html__('div', 'finview-core'),
                    'span' =>  esc_html__('span', 'finview-core'),
                    'p' =>  esc_html__('p', 'finview-core'),
                ],
                'default' => 'p',
            ]
        );

        $this->add_control(
            'title_display_class',
            [
                'label' => esc_html__('Display Class', 'finview-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'display-1' =>  esc_html__('Display 1', 'finview-core'),
                    'display-2' =>  esc_html__('Display 2', 'finview-core'),
                    'display-3' =>  esc_html__('Display 3', 'finview-core'),
                    'display-4' =>  esc_html__('Display 4', 'finview-core'),
                    'display-5' =>  esc_html__('Display 5', 'finview-core'),
                    'display-6' =>  esc_html__('Display 6', 'finview-core'),
                ],
                'default' => 'display-4',
                'condition' => [
                    'title_tag' => 'h2',
                ],
            ]
        );


        $this->add_control(
            'title_add_class',
            [
                'label' => esc_html__('Add Class', 'finview-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fs-3xl' => esc_html__('32px', 'finview-core'),
                    'fs-2xl' => esc_html__('24px', 'finview-core'),
                    'fs-xl' => esc_html__('20px', 'finview-core'),
                    'fs-lg' => esc_html__('18px', 'finview-core'),
                    'fs-base ' => esc_html__('16px', 'finview-core'),
                    'fs-sm' => esc_html__('14px', 'finview-core'),
                    'fs-xs' => esc_html__('12px', 'finview-core'),
                ],
                'default' => 'fs_base',
                'condition' => [
                    'title_tag' => ['p', 'span', 'div'],
                ],
            ]
        );


        $this->end_controls_section();



        // counter Icon 
        $this->start_controls_section(
            'counter_icon_style',
            [
                'label' => esc_html__('Counter Icon', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .countdown__icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .countdown__icon:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_icon_bgcolor',
            [
                'label'     => esc_html__('Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_bdr_color',
            [
                'label' => esc_html__('Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'bdr_counter_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown__icon:hover' => 'border:1px solid {{VALUE}}',
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
                    '{{WRAPPER}} .countdown__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .countdown__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown__icon svg' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .countdown__icon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


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
                    '{{WRAPPER}} .countdown__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .countdown__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        // ======================= Style End=================================//

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
            jQuery(function($) {
                "use strict";

                jQuery(document).ready(function() {
                    // odometer counter
                    $(".odometer").each(function() {
                        $(this).isInViewport(function(status) {
                            if (status === "entered") {
                                for (
                                    var i = 0; i < document.querySelectorAll(".odometer").length; i++
                                ) {
                                    var el = document.querySelectorAll(".odometer")[i];
                                    el.innerHTML = el.getAttribute("data-odometer-final");
                                }
                            }
                        });
                    });

                });
            })
        </script>
        <!-- ==== counter section start ==== -->
        <section class="countdown section <?php echo ($settings['section_pt_show'] == 'yes') ? '' : 'pt-0' ?> <?php echo ($settings['section_pb_show'] == 'yes') ? '' : 'pb-0' ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="countdown__area justify-content-center justify-content-md-between">
                            <?php foreach ($settings['card_repeater'] as $item) : ?>
                                <div class="countdown__part wow fadeInUp" data-wow-duration="0.8s">
                                    <?php if (!empty($settings['card_icon_hide'] == 'yes')) :   ?>
                                        <?php if (!empty($item['finview_counter_card_icon'])) :   ?>
                                            <div class="countdown__icon">
                                                <?php \Elementor\Icons_Manager::render_icon($item['finview_counter_card_icon'], ['aria-hidden' => 'true']); ?>
                                            </div>
                                        <?php endif ?>
                                    <?php endif ?>
                                    <div class="countdown__content d-flex flex-column gap-2">
                                        <?php if (!empty($item['finview_counter_number'])) : ?>
                                            <?php
                                            $number_tag = !empty($settings['number_tag']) ? $settings['number_tag'] : 'h2';
                                            $display_class = ($number_tag === 'h2' && !empty($settings['display_class'])) ? esc_attr($settings['display_class']) : '';
                                            $number_add_class = ($number_tag === 'p' && !empty($settings['number_add_class'])) ? esc_attr($settings['number_add_class']) : '';
                                            ?>
                                            <<?php echo esc_attr($number_tag); ?> class="countdown__title <?php echo $display_class; ?> <?php echo $number_add_class; ?> m-0">
                                                <span class="odometer" data-odometer-final="<?php echo esc_html($item['finview_counter_number']) ?>"></span>
                                                <span class="counter_suffix"><?php echo esc_html($item['counter_suffix']) ?></span>
                                            </<?php echo esc_attr($number_tag); ?>>
                                        <?php endif; ?>

                                        <?php if (!empty($item['finview_counter_text'])) : ?>
                                            <?php
                                            $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'p';
                                            $title_display_class = ($title_tag === 'h2' && !empty($settings['title_display_class'])) ? esc_attr($settings['title_display_class']) : '';
                                            $title_add_class = (in_array($title_tag, ['p', 'span', 'div'], true) && !empty($settings['title_add_class'])) ? esc_attr($settings['title_add_class']) : '';
                                            ?>
                                            <<?php echo esc_attr($title_tag); ?> class="counter_text  text-nowrap <?php echo $title_display_class; ?> <?php echo $title_add_class; ?>">

                                                <?php echo wp_kses($item['finview_counter_text'], wp_kses_allowed_html('post')); ?>
                                            </<?php echo esc_attr($title_tag); ?>>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <span class="v-line d-none d-lg-block"></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== / counter section end ==== -->
<?php
    }
}

$widgets_manager->register(new TP_counter());
