<?php

/**
 * Log Trait.
 *
 * Used throughout the plugin, this trait handles the logging of 
 * info and errors generated by the plugin.
 *
 * @since      1.0.0
 * @package    Ltd_Tickets
 * @subpackage Ltd_Tickets/includes
 * @author     Ben Campbell <ben.campbell@londontheatredirect.com>
 */

trait LTD_Tickets_Logging {

   // =================
   // LOGGING
   // =================
   // idx (auto)                    x
   // type (INFO / ERROR)
   // message
   // stack
   // url                           x
   // userid                        x
   // basketid                      x
   // ip                            x
   // useragent                     x
   // timestamp (auto)              x


   public function Log($log) {
        global $wpdb;
        global $user;
        $table_name = $wpdb->prefix . "ltd_log";

        $basketid = 0; //; get_basket_id();

        $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $log['message'] = (!isset($log['message']) ? 'Unhandled Exception' : $log['message']);
        $log['timestamp'] = current_time( 'mysql' );
        $log['type'] = (!isset($log['type']) ? 'INFO' : $log['type']);
        $log['url'] = $escaped_url;
        $log['user_id'] = get_current_user_id();
        $log['basket_id'] = (!$basketid ? '0' : $basketid);
        $log['ip']  = $_SERVER['REMOTE_ADDR'];
        $log['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        $wpdb->insert(
		    $table_name,
            $log
	    );
   }

   public function GetLog($limit = 1000) {
       global $wpdb;
       $table_name = $wpdb->prefix . "ltd_log";
       $result = $wpdb->get_results(
               "
                SELECT *
                FROM $table_name
                ORDER BY idx DESC
                LIMIT $limit
                "
       );
       return $result;
   }


   public function ClearLog() {
       global $wpdb;
       $table_name = $wpdb->prefix . "ltd_log";
       $result = $wpdb->get_results(
              "
            TRUNCATE $table_name
            "
      );
       return $result;

   }
}

class InlineLog {
    use LTD_Tickets_Logging;
}

?>