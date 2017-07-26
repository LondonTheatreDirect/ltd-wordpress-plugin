<?php
/**
 * Admin Notice for imported and synced data.
 *
 * Handles the admin notice indicating imported and update posts and taxonomies.
 *
 * @since      1.0.0
 * @package    Ltd_Tickets
 * @subpackage Ltd_Tickets/includes
 * @author     Ben Campbell <ben.campbell@londontheatredirect.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class LTD_Tickets_Import_Notice {


	public function __construct( $imports, $type, $plugin_name) {


        $note = ($type == "import" ? __("imported", $plugin_name) : __("updated", $plugin_name) );
        $possible_issue = false;
        $message = __("You have successfully ", $plugin_name);
        $message .= $note . ":";
        if (isset($imports['categories'])) {
            $message.= "<br />";
            $message.= $imports['categories'] . " " . __("Categories", $plugin_name);
            if ($imports['categories'] == 0) $possible_issue = true;
        }
        if (isset($imports['products'])) {
            $message.= "<br />";
            $message.= $imports['products'] . " " . __("Products", $plugin_name);
            if ($imports['products'] == 0) $possible_issue = true;
        }

        if (isset($imports['venues'])) {
            $message.= "<br />";
            $message.= $imports['venues'] . " " . __("Venues", $plugin_name);
            if ($imports['venues'] == 0) $possible_issue = true;
        }

        if ($possible_issue) {
        $message.= "<br /><br />";
        $message.= __("Not imported what you expected? Check the <a href='/admin.php?page=$plugin_name-log'>Log</a> for import errors.");

        }


        add_settings_error(
            'import_notice',
            esc_attr( 'settings_updated' ),
            $message,
            'updated'
        );


    }

}