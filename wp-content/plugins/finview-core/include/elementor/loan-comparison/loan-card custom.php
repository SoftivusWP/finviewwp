<?php //

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
 * Elementor widget for loan cards.
 *
 * @since 1.0.0
 */
class TP_loan_card extends Widget_Base
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
        return 'tp-loan-card';
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
        return __('Loan Card', 'tpcore');
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

    protected function get_loan_card_titles()
    {
        $titles = [];

        // Get stored loan comparison interest data for all tables
        for ($table_number = 1; $table_number <= 5; $table_number++) {
            $loan_data = loancomparison_get_stored_interest($table_number);

            if (!empty($loan_data)) {
                foreach ($loan_data as $index => $loan) {
                    if (!empty($loan['alt'])) {
                        $titles[$loan['alt']] = $loan['alt']; // Use the loan title as both key and value
                    }
                }
            }
        }

        return $titles;
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
            'loan_card_section',
            [
                'label' => __('Loan Card Settings', 'tpcore'),
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
        // // Loan Card Selection
        // $this->add_control(
        //     'loan_card_index',
        //     [
        //         'label' => __('Select Loan Card', 'tpcore'),
        //         'type' => Controls_Manager::NUMBER,
        //         'default' => 0,
        //         'min' => 0,
        //         'max' => 10, // Adjust the max value based on the maximum number of cards per table
        //         'step' => 1,
        //         'description' => __('Enter the index of the loan card you want to display (starting from 0).', 'tpcore'),
        //     ]
        // );
        $this->add_control(
            'loan_card_title',
            [
                'label' => __('Select Loan Card', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_loan_card_titles(), // Dynamically populate options
                'default' => '',
                'label_block' => true,
                'description' => __('Select the loan card you want to display.', 'tpcore'),
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
        $selected_title = $settings['loan_card_title'];

        // Get stored loan comparison interest data
        $loan_data = loancomparison_get_stored_interest($table_number);

        if (empty($loan_data)) {
            echo '<p>No loan comparison data available for this table.</p>';
            return;
        }

        // Find the selected loan card by title
        $selected_loan = null;
        foreach ($loan_data as $loan) {
            if ($loan['alt'] === $selected_title) {
                $selected_loan = $loan;
                break;
            }
        }

        if (empty($selected_loan)) {
            echo '<p>No loan card found with the selected title.</p>';
            return;
        }



        // Get the selected loan card
        // $loan = $loan_data[$loan_card_index];
?>
        <div class="col-lg-12">
            <div class="loan-adjustment-details">
                <div class="loan-review-details-head gap-3 d-md-flex d-grid justify-content-between position-relative wow fadeInUp"
                    data-wow-duration="0.8s">
                    <div class="d-md-flex d-grid align-items-center gap-xxl-4 gap-md-3 gap-3">
                        <div class="loan-reviews__part-one">
                            <?php if (!empty($selected_loan['logo'])): ?>
                                <div class="reviews__thumb mb-xl-3 mb-2 m-auto text-center">
                                    <img src="<?php echo esc_url($selected_loan['logo']); ?>" alt="<?php echo esc_attr($selected_loan['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="d-flex gap-2 flex-column">
                                <div class="star_review">
                                    <?php
                                    // Dynamically generate star ratings based on $selected_loan['rating']
                                    $rating = isset($selected_loan['rating']) ? $selected_loan['rating'] : 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="bi bi-star-fill star-active"></i>';
                                        } elseif ($i - 0.5 <= $rating) {
                                            echo '<i class="bi bi-star-half star-active"></i>';
                                        } else {
                                            echo '<i class="bi bi-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <p class="k-review"><?php echo esc_html($selected_loan['count_reviews']); ?></p>
                            </div>
                        </div>
                        <div class="price-content me-xl-5 text-lg-start text-center">
                            <h5 class="mb-2"><?php echo esc_html($selected_loan['alt']); ?></h5>
                            <p class="fs-seven"><?php echo esc_html($selected_loan['example']); ?></p>
                        </div>
                    </div>
                    <div class="loan-reviews__part-three pt-xxl-3 pt-2">
                        <div class="btn-group d-grid position-initial">
                            <div class="text-center mb-2">
                                <a href="<?php echo esc_url($selected_loan['link']); ?>" class="btn_theme d-flex btn_theme_active"><?php echo esc_html(__('Visit Site', 'finview')); ?><i
                                        class="bi bi-arrow-up-right"></i><span></span></a>
                            </div>
                            <a href="<?php echo esc_url($selected_loan['termlink']); ?>" class="apply-text">
                                <?php echo esc_html($selected_loan['terms_condition']); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="loan-increment-wrap">
                    <div class="loan-increment-item">
                        <div class="icon d-center rounded-circle"><img src="assets/images/loan-review1.png" alt="img"></div>
                        <div class="cont">
                            <span class="amout-titles"><?php echo esc_html(__('Loan amount', 'finview')); ?></span>
                            <span class="prices"><?php echo esc_html('$' . $loan['min_loan'] . ' - $' . $loan['max_loan']); ?></span>
                        </div>
                    </div>
                    <div class="loan-increment-item">
                        <div class="icon d-center rounded-circle"><img src="assets/images/loan-review2.png" alt="img"></div>
                        <div class="cont">
                            <span class="amout-titles"><?php echo esc_html(__('Effective Interest', 'finview')); ?></span>
                            <span class="prices"><?php echo esc_html(__('From', 'finview')); ?> <?php echo esc_html($loan['mininterest'] . ' - ' . $loan['maxinterest']); ?></span>
                        </div>
                    </div>
                    <div class="loan-increment-item">
                        <div class="icon d-center rounded-circle"><img src="assets/images/loan-review3.png" alt="img"></div>
                        <div class="cont">
                            <span class="amout-titles"><?php echo esc_html(__('Running time', 'finview')); ?></span>
                            <span class="prices"><?php echo esc_html($loan['min_term'] . ' - ' . $loan['max_term']); ?></span>
                        </div>
                    </div>
                    <div class="loan-increment-item">
                        <div class="icon d-center rounded-circle"><img src="assets/images/loan-review4.png" alt="img"></div>

                    </div>
                </div>
                <div class="row g-xl-4 g-3">
                    <div class="col-lg-4 col-md-6">
                        <div class="terms-box">
                            <span class="text-uppercase fw-semibold title"><?php echo esc_html(__('TERMS', 'finview')); ?></span>
                            <ul>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Loan amount', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html('$' . $loan['min_loan'] . ' - $' . $loan['max_loan']); ?></span>
                                </li>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Repayment period', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html($loan['min_term'] . ' - ' . $loan['max_term']); ?></span>
                                </li>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Effective Interest', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html($loan['mininterest'] . ' - ' . $loan['maxinterest']); ?></span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="terms-box">
                            <span class="text-uppercase fw-semibold title"><?php echo esc_html(__('KEY INFO', 'finview')); ?></span>
                            <ul>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Effective Interest from', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html($loan['mininterest']); ?></span>
                                </li>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Minimum loan amount', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html('$' . $loan['min_loan']); ?></span>
                                </li>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Maximum loan amount', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html('$' . $loan['max_loan']); ?></span>
                                </li>
                                <li>
                                    <span class="loan-name"><?php echo esc_html(__('• Maturity', 'finview')); ?></span>
                                    <span class="loan-value"><?php echo esc_html($loan['max_term']); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="terms-ratting d-center text-center">
                            <div class="box">
                                <span class="fw-bold cmn-display"> <?php echo esc_html($loan['rating']) . esc_html(__('/5', 'finview')); ?></span>
                                <div class="star_review d-center mb-2">
                                    <?php
                                    // Dynamically generate star ratings based on $loan['rating']
                                    $rating = isset($loan['rating']) ? $loan['rating'] : 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="bi bi-star-fill star-active"></i>';
                                        } elseif ($i - 0.5 <= $rating) {
                                            echo '<i class="bi bi-star-half star-active"></i>';
                                        } else {
                                            echo '<i class="bi bi-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <span class="rat-title d-md-block"><?php echo esc_html($loan['count_reviews']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

$widgets_manager->register(new TP_loan_card());
