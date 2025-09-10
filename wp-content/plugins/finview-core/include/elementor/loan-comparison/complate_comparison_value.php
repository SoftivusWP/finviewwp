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

        // Columns to Display
        $this->add_control(
            'display_columns',
            [
                'label' => __('Select Display Columns', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'default' => ['logo', 'rating', 'interest', 'bankname', 'loanamount'],
                'options' => [
                    'logo' => __('Logo', 'tpcore'),
                    'rating' => __('Rating', 'tpcore'),
                    'interest' => __('Interest', 'tpcore'),
                    'bankname' => __('Bank Name', 'tpcore'),
                    'loanamount' => __('Loan Amount', 'tpcore'),
                    'interestamount' => __('Interest Amount', 'tpcore'),
                    'loan' => __('Loan', 'tpcore'),
                    'fees' => __('Fees', 'tpcore'),
                    'repayment' => __('Repayment', 'tpcore'),
                    'total' => __('Total', 'tpcore'),
                    'term' => __('Term', 'tpcore'),
                    'infolink' => __('Info Link', 'tpcore'),
                    'loancost' => __('Loan Cost', 'tpcore'),
                    'otherinfo' => __('Other Info', 'tpcore'),
                    'example' => __('Example', 'tpcore'),
                    'interestamountlabel' => __('Total Interest', 'tpcore'),
                    'totallabel' => __('Total Cost', 'tpcore'),
                    'loanslider' => __('Amount', 'tpcore'),
                    'termslider' => __('Term', 'tpcore'),
                ],
            ]
        );

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
        $display_columns = $settings['display_columns'];

        // Get stored loan comparison interest data
        $loan_data = loancomparison_get_stored_interest($table_number);

        if (empty($loan_data)) {
            echo '<p>No loan comparison data available for this table.</p>';
            return;
        }
?>
        <div class="tp-loan-comparison-table">
            <table>
                <thead>
                    <tr>
                        <?php foreach ($display_columns as $column): ?>
                            <th><?php echo ucfirst($column); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loan_data as $loan): ?>
                        <tr>
                            <?php foreach ($display_columns as $column): ?>
                                <td>
                                    <?php
                                    switch ($column) {
                                        case 'logo':
                                            if (!empty($loan['logo'])) {
                                                echo '<img src="' . $loan['logo'] . '" style="max-width:150px;overflow:hidden;">';
                                            } else {
                                                echo $loan['alt'];
                                            }
                                            break;
                                        case 'rating':
                                            echo esc_html($loan['rating'] ?? 'N/A') . '/5';
                                            break;
                                            
                                        case 'interest':
                                            if (isset($loan['mininterest'], $loan['maxinterest'])) {
                                                echo esc_html($loan['mininterest'] . '% - ' . $loan['maxinterest'] . '%');
                                            } else {
                                                echo __('--', 'tpcore');
                                            }
                                            break;
                                        case 'bankname':
                                            echo $loan['alt'];
                                            break;
                                        case 'loanamount':
                                            echo '$' . $loan['min_loan'] . ' - $' . $loan['max_loan'];
                                            break;
                                        case 'interestamount':
                                            // You might need to calculate this based on specific loan calculation
                                            echo 'Calculated Interest';
                                            break;
                                        case 'loan':
                                            echo $loan['link'] ? '<a href="' . esc_url($loan['link']) . '">Apply</a>' : 'N/A';
                                            break;
                                        case 'fees':
                                            echo '$' . $loan['startupfee'];
                                            break;
                                        case 'repayment':
                                            // This would require actual loan calculation
                                            echo 'Calculated Repayment';
                                            break;
                                        case 'total':
                                            // This would require actual loan calculation
                                            echo 'Total Loan Cost';
                                            break;
                                        case 'term':
                                            echo $loan['min_term'] . ' - ' . $loan['max_term'] . ' months';
                                            break;
                                        case 'loancost':
                                            echo 'Loan Cost Calculation';
                                            break;
                                        case 'otherinfo':
                                            echo $loan['otherinfo'];
                                            break;
                                        case 'example':
                                            echo $loan['example'];
                                            break;
                                        case 'interestamountlabel':
                                            echo $loan['interestamountlabel'];
                                            break;
                                        case 'totallabel':
                                            echo $loan['totallabel'];
                                            break;
                                        case 'loanslider':
                                            echo $loan['loanslider'];
                                            break;
                                        case 'termslider':
                                            echo $loan['termslider'];
                                            break;
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php
    }
}

$widgets_manager->register(new TP_loan_comparison());
