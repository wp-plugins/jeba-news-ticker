<?php 
/*
Plugin Name: Jeba news ticker
Plugin URI: http://prowpexpert.com/
Description: This plugin to use awesome news ticker in your wordpress site.
Author: Md Jahed
Author URI: http://prowpexpert.com/
Version: 1.1.0
*/

/* Adding Latest jQuery from Wordpress */
function jeba_ajaxss_plugin_wp() {
	wp_enqueue_script('jquery');
}
add_action('init', 'jeba_ajaxss_plugin_wp');

/*Some Set-up*/
define('jeba_ajax_PLUGIN_WP', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


function jeba_ajax_authss_init(){	
	wp_register_style( 'ajax-authss-style', jeba_ajax_PLUGIN_WP.'css/li-scroller.css' );
	wp_enqueue_style('ajax-authss-style');
	
	wp_register_script('validatess-script', jeba_ajax_PLUGIN_WP.'js/jquery.li-scroller.1.0.js', array('jquery') ); 
    wp_enqueue_script('validatess-script');
}
add_action('init', 'jeba_ajax_authss_init');


function jebas_slider_shortcode_awosome($atts){
	extract( shortcode_atts( array(
		'category' => '',
		'post_type' => 'post',
		'count' => '-1',
		'time' => '1',
		'id' => '02',
		'title' => 'Latest News',
		'title_color' => '#fff',
		'title_bg' => '#005',
		
	), $atts) );
	
	?>
<script>
jQuery(function(){
	jQuery("ul#ticker<?php echo $id; ?>").liScroll({travelocity: 0.<?php echo $time; ?>});
});
</script>
<style>
.jeba_ntitle > p {
  background: none repeat scroll 0 0 <?php echo $title_bg; ?>;
  color: <?php echo $title_color; ?>;
  border: 1px solid <?php echo $title_bg; ?>;
}
</style>
<?php
	
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => $post_type, 'category_name' => $category)
        );		
		
		$plugins_url = plugins_url();
		
	$list = ' <div class="jeba_nticker"><div class="jeba_ntitle"><p style="">'.$title.'</p></div>
<div class="jeba_ticker"><ul id="ticker'.$id.'"> ';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();
		
		$list .= '
		
		<li>'.get_the_date('D').' at '.get_the_time().' </span><a href="'.get_permalink().'">'.get_the_title().'</a></li>

		
		';        
	endwhile;
	$list.= ' </ul></div></div> ';
	wp_reset_query();
	return $list;
}
add_shortcode('jeba_ticker', 'jebas_slider_shortcode_awosome');
 




 
?>