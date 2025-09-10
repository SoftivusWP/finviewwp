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
class TP_image extends Widget_Base
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
        return 'tp-image-area';
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
        return __('Image', 'tpcore');
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

        //Heading Section
        $this->start_controls_section(
            'image_one_section_genaral',
            [
                'label' => esc_html__('Image', 'aikeu-core')
            ]
        );

        $this->add_responsive_control(
            'image_style_selection',
            [
                'label'   => esc_html__('Select Style', 'aikeu-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'aikeu-core'),
                    // 'style_two' => esc_html__('Style Two used section', 'aikeu-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->add_responsive_control(
            'image_unset',
            [
                'label' => esc_html__('Image Unset', 'aikeu-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'aikeu-core'),
                'label_off' => esc_html__('Hide', 'aikeu-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'image_rtl',
            [
                'label' => esc_html__('Image RTL', 'aikeu-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'aikeu-core'),
                'label_off' => esc_html__('Hide', 'aikeu-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        // $this->add_responsive_control(
        //     'image_position',
        //     [
        //         'label'   => esc_html__('Select Position', 'aikeu-core'),
        //         'type'    => Controls_Manager::SELECT,
        //         'options' => [
        //             '' => esc_html__('Default', 'aikeu-core'),
        //             'position-absolute' => esc_html__('absolute', 'aikeu-core'),
        //             'position-relative' => esc_html__('relative', 'aikeu-core'),
        //         ],
        //         'default' => '',
        //     ]
        // );

        $this->add_control(
            'choose_image',
            [
                'label' => esc_html__('Choose Image', 'aikeu-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->end_controls_section();


        // ======================= Heading Style =================================//



        // Border Radius 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Image Area ', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .image_thumb img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'aikeu-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .image_thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
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
            @media (min-width: 1399px) {
                .unset {
                    max-width: unset !important;
                }
            }



            .dir-rtl {
                direction: rtl;
            }
        </style>


        <?php if ($settings['image_style_selection'] == 'style_one') : ?>
            <?php if (!empty($settings['choose_image']['url'])) : ?>
                <div class="image_thumb <?php echo ($settings['image_rtl'] == 'yes') ? 'dir-rtl d-block' : ''; ?>">
                    <img src="<?php echo esc_url($settings['choose_image']['url']) ?>" alt="<?php echo esc_attr('Image') ?>" class="<?php echo ($settings['image_unset'] == 'yes') ? 'unset' : ''; ?>">
                </div>
            <?php endif ?>
        <?php endif ?>






<?php

    }
}
$widgets_manager->register(new TP_image());
