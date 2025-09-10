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

class TP_loan_comparison extends Widget_Base
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
        return 'tp-Loan-comparison';
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
        return __('Loan Comparison', 'tpcore');
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

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        // Register js
        add_action('wp_enqueue_scripts', [$this, 'custom_register_widget_script']);
    }

    public function custom_register_widget_script()
    {
        $dir = plugin_dir_url(__FILE__);
        wp_enqueue_script('loan_comparisonfff', $dir . 'include/elementor/loan-comparison/loancomparison.js', ['jquery'], false, true);
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

        // Content Section
        $this->start_controls_section(
            'loan_comparison_section',
            [
                'label' => __('Loan Comparison Settings', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Table Number Selection
        $this->add_control(
            'table_number',
            [
                'label' => __('Select Loan Comparison Table', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Table 1', 'tpcore'),
                    '2' => __('Table 2', 'tpcore'),
                    '3' => __('Table 3', 'tpcore'),
                    '4' => __('Table 4', 'tpcore'),
                    '5' => __('Table 5', 'tpcore'),
                ],
            ]
        );

        // // Columns to Display
        // $this->add_control(
        //     'display_columns',
        //     [
        //         'label' => __('Select Display Columns', 'tpcore'),
        //         'type' => \Elementor\Controls_Manager::SELECT2,
        //         'label_block' => true,
        //         'multiple'    => true,
        //         'default' => ['logo', 'rating', 'interest', 'bankname', 'loanamount'],
        //         'options' => [
        //             'logo' => __('Logo', 'tpcore'),
        //             'rating' => __('Rating', 'tpcore'),
        //             'interest' => __('Interest', 'tpcore'),
        //             'bankname' => __('Bank Name', 'tpcore'),
        //             'loanamount' => __('Loan Amount', 'tpcore'),
        //             'interestamount' => __('Interest Amount', 'tpcore'),
        //             'loan' => __('Loan', 'tpcore'),
        //             'fees' => __('Fees', 'tpcore'),
        //             'repayment' => __('Repayment', 'tpcore'),
        //             'total' => __('Total', 'tpcore'),
        //             'term' => __('Term', 'tpcore'),
        //             'infolink' => __('Info Link', 'tpcore'),
        //             'loancost' => __('Loan Cost', 'tpcore'),
        //             'otherinfo' => __('Other Info', 'tpcore'),
        //             'example' => __('Example', 'tpcore'),
        //             'interestamountlabel' => __('Total Interest', 'tpcore'),
        //             'totallabel' => __('Total Cost', 'tpcore'),
        //             'loanslider' => __('Amount', 'tpcore'),
        //             'termslider' => __('Term', 'tpcore'),
        //         ],
        //     ]
        // );

        $this->end_controls_section();

        // ======================= Style =================================//

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


        $table_number = $settings['table_number'];
        // $display_columns = $settings['display_columns'];

        // Get stored loan comparison interest data
        $loan_data = loancomparison_get_stored_interest($table_number);

        if (empty($loan_data)) {
            echo '<p>No loan comparison data available for this table.</p>';
            return;
        }

        echo do_shortcode('[loancomparison]');
?>
<?php
    }
}

$widgets_manager->register(new TP_loan_comparison());
