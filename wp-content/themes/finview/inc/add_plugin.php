<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function my_theme_register_required_plugins()
{
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = [
		[
			'name'     => esc_html__('Elementor Page Builder', 'finview'),
			'slug'     => 'elementor',
			'required' => true,
		],
		[
			'name'         => esc_html__('Finview Core ', 'finview'),
			'slug'         => 'finview-core',
			'source'       => esc_url('https://pixelaxis.net/finview/source/finview-core.zip'),
			'required'     => true,
			'external_url' => esc_url('https://pixelaxis.net/finview/source/finview-core.zip'),
		],
		[
			'name'         => esc_html__('Advanced Custom Fields Pro Master', 'finview'),
			'slug'         => 'advanced-custom-fields-pro-master',
			'source'       => esc_url('https://pixelaxis.net/finview/source/advanced-custom-fields-pro-master.zip'),
			'required'     => true,
			'external_url' => esc_url('https://pixelaxis.net/finview/source/advanced-custom-fields-pro-master.zip'),
		],
		[
			'name'         => esc_html__('Loan Comparison', 'finview'),
			'slug'         => 'loan-comparison',
			'source'       => esc_url('https://pixelaxis.net/finview/source/loan-comparison.zip'),
			'required'     => true,
			'external_url' => esc_url('https://pixelaxis.net/finview/source/loan-comparison.zip'),
		],
		[
			'name'     =>  esc_html__('Kirki Customizer Framework', 'finview'),
			'slug'     => 'kirki',
			'required' => true,
		],
		[
			'name'     => esc_html__('WP Classic Editor', 'finview'),
			'slug'     => 'classic-editor',
			'required' => false,
		],
		[
			'name'     => esc_html__('Contact Form 7', 'finview'),
			'slug'     => 'contact-form-7',
			'required' => false,
		],
		[
			'name'     => esc_html__('One Click Demo Import', 'finview'),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		],
		array(
			'name'     =>  esc_html__('Breadcrumb NavXT', 'finview'),
			'slug'     => 'breadcrumb-navxt',
			'required' => false,
		),
		array(
			'name'     =>  esc_html__('Loan Comparison', 'finview'),
			'slug'     => 'loan-comparison',
			'required' => false,
		),
		array(
			'name'     =>  esc_html__('Loan Calculator', 'finview'),
			'slug'     => 'loan-calculator-wp',
			'required' => false,
		),
		array(
			'name'     => esc_html__('WooCommerce', 'finview'),
			'slug'     => 'woocommerce',
			'required' => false,
		),
	];

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


		'strings'      => array(
			'page_title'                      => __('Install Required Plugins', 'finview'),
			'menu_title'                      => __('Install Plugins', 'finview'),
			// translators: %s: plugin name.
			'installing'                      => __('Installing Plugin: %s', 'finview'),
			// translators: %s: plugin name.
			'updating'                        => __('Updating Plugin: %s', 'finview'),
			'oops'                            => __('Something went wrong with the plugin API.', 'finview'),
			'notice_can_install_required'     => _n_noop(
				// translators: 1: plugin name(s).
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'finview'
			),
			'notice_can_install_recommended'  => _n_noop(
				// translators: 1: plugin name(s).
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'finview'
			),
			'notice_ask_to_update'            => _n_noop(
				// translators: 1: plugin name(s).
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'finview'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				// translators: 1: plugin name(s).
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'finview'
			),
			'notice_can_activate_required'    => _n_noop(
				// translators: 1: plugin name(s).
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'finview'
			),
			'notice_can_activate_recommended' => _n_noop(
				// translators: 1: plugin name(s).
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'finview'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'finview'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'finview'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'finview'
			),
			'return'                          => __('Return to Required Plugins Installer', 'finview'),
			'plugin_activated'                => __('Plugin activated successfully.', 'finview'),
			'activated_successfully'          => __('The following plugin was activated successfully:', 'finview'),
			// translators: 1: plugin name.
			'plugin_already_active'           => __('No action taken. Plugin %1$s was already active.', 'finview'),
			// translators: 1: plugin name.
			'plugin_needs_higher_version'     => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'finview'),
			// translators: 1: dashboard link.
			'complete'                        => __('All plugins installed and activated successfully. %1$s', 'finview'),
			'dismiss'                         => __('Dismiss this notice', 'finview'),
			'notice_cannot_install_activate'  => __('There are one or more required or recommended plugins to install, update or activate.', 'finview'),
			'contact_admin'                   => __('Please contact the administrator of this site for help.', 'finview'),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa($plugins, $config);
}
