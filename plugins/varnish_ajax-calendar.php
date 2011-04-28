<?php
/*
 * Support for purges for the ajax calendar widget 
 * Url http://urbangiraffe.com/plugins/ajax-calendar/
 * 
 */


class WPVarnish_WPAjaxCalendar extends WPVarnishAbstract {
   var $plugin="ajax-calendar";
   
   function mustActivate(){
      echo "\nmust activate ajax calendar";
      return array_key_exists('ajax-calendar/ajax-calendar.php', get_site_option( 'active_sitewide_plugins') ); 
   }
     
   function addActions(){
      echo "\nadd action ajax calendar";
        add_action('edit_post', array(&$this, 'WPVarnishPurgeAjaxCalendar'), 99);     
   }
   
   // Purge Ajax Calendar for a post
   function WPVarnishPurgeAjaxCalendar($wpv_postid){             
        $month=str_replace(get_bloginfo('wpurl'),"",get_month_link(get_post_time('Y',false,$wpv_postid), get_post_time('m',true,$wpv_postid)));
        $this->WPVarnishPurgeObject($month.'?ajax=true');     
  }
}

$wpvarnishAjaxCalendar = & new WPVarnish_WPAjaxCalendar();