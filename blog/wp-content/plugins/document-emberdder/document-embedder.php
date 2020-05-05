<?php 
/*
 * Plugin Name: Document Embedder
 * Plugin URI:  https://bplugins.com/document-embedder-demo/
 * Description: Embed Any document easily in wordpress such as word, excel, powerpoint, pdf and more
 * Version:     1.2
 * Author:      Abu Hayat Polash
 * Author URI:  http://abuhayatpolash.com
 * License:     GPLv3
 * Text Domain:  document-emberdder
 * Domain Path:  /languages
 */

function svp_load_textdomain() {
    load_plugin_textdomain( 'document-emberdder', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", 'svp_load_textdomain' );

/*Some Set-up*/
define('PPV_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' ); 

// Guten Block

include_once('gutenblock/index.php');

//Remove post update massage and link
function ppv_updated_messages( $messages ) {
 $messages['ppt_viewer'][1] = __('Updated ');
return $messages;
}
add_filter('post_updated_messages','ppv_updated_messages');



/*-------------------------------------------------------------------------------*/
/*   Register Custom Post Types
/*-------------------------------------------------------------------------------*/	   
add_action( 'init', 'ppv_create_post_type' );
function ppv_create_post_type() {
		register_post_type( 'ppt_viewer',
				array(
						'labels' => array(
								'name' => __( 'Document Embedder'),
								'singular_name' => __( 'Document Embedder' ),
								'add_new' => __( 'Add New Doc' ),
								'add_new_item' => __( 'Add New Doc' ),
								'edit_item' => __( 'Edit' ),
								'new_item' => __( 'New item' ),
								'view_item' => __( 'View item' ),
								'search_items'       => __( 'Search'),
								'not_found' => __( 'Sorry, we couldn\'t find the power point file you are looking for.' )
						),
				'public' => false,
				'show_ui' => true, 									
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'menu_position' => 14,
				'show_in_rest' => true,
				'menu_icon' =>PPV_PLUGIN_DIR .'/img/doc.png',
				'has_archive' => false,
				'hierarchical' => false,
				'capability_type' => 'post',
				'rewrite' => array( 'slug' => 'ppt_viewer' ),
				'supports' => array( 'title' )
				)
		);
}	
			
/*-------------------------------------------------------------------------------*/
/*  Metabox
/*-------------------------------------------------------------------------------*/			

include_once('metabox/meta-box-class/my-meta-box-class.php');
include_once('metabox/class-usage-demo.php');
//include_once('tinymce/ewic-tinymce.php');

/*-------------------------------------------------------------------------------*/
/*   Hide & Disabled View, Quick Edit and Preview Button
/*-------------------------------------------------------------------------------*/
function ppv_remove_row_actions( $idtions ) {
	global $post;
    if( $post->post_type == 'ppt_viewer' ) {
		unset( $idtions['view'] );
		unset( $idtions['inline hide-if-no-js'] );
	}
    return $idtions;
}

if ( is_admin() ) {
add_filter( 'post_row_actions','ppv_remove_row_actions', 10, 2 );}

/*-------------------------------------------------------------------------------*/
/* HIDE everything in PUBLISH metabox except Move to Trash & PUBLISH button
/*-------------------------------------------------------------------------------*/

function ppv_hide_publishing_actions(){
        $my_post_type = 'ppt_viewer';
        global $post;
        if($post->post_type == $my_post_type){
            echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                </style>
            ';
        }
}
add_action('admin_head-post.php', 'ppv_hide_publishing_actions');
add_action('admin_head-post-new.php', 'ppv_hide_publishing_actions');	

/*-------------------------------------------------------------------------------*/
/* Change publish button to save.
/*-------------------------------------------------------------------------------*/
 
add_filter( 'gettext', 'ppv_change_publish_button', 10, 2 );

function ppv_change_publish_button( $translation, $text ) {
if ( 'ppt_viewer' == get_post_type())
if ( $text == 'Publish' )
    return 'Save';

return $translation;
}


// ONLY MOVIE CUSTOM TYPE POSTS
add_filter('manage_ppt_viewer_posts_columns', 'ST4_columns_head_only_ppt_viewer', 10);
add_action('manage_ppt_viewer_posts_custom_column', 'ST4_columns_content_only_ppt_viewer', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function ST4_columns_head_only_ppt_viewer($defaults) {
    $defaults['directors_name'] = 'ShortCode';
    return $defaults;
}
function ST4_columns_content_only_ppt_viewer($column_name, $post_ID) {
    if ($column_name == 'directors_name') {
        // show content of 'directors_name' column
		echo '<input onClick="this.select();" value="[doc id='. $post_ID . ']" >';
    }
}

/*-------------------------------------------------------------------------------*/
// sub menu page
/*-------------------------------------------------------------------------------*/
add_action('admin_menu', 'ppv_custom_submenu_page');

function ppv_custom_submenu_page() {
	add_submenu_page( 'edit.php?post_type=ppt_viewer', 'Developer', 'Developer', 'manage_options', 'ppv_submenu_page', 'ppv_submenu_page_callback' );
}

function ppv_submenu_page_callback() {
	
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>Developer</h2>
		<h2>Md Abu hayat polash</h2>
		<h4>Professional Web Developer (Freelancer)</h4>
		<h5>Web : <a href="http://abuhayatpolash.com">www.abuhayatpolash.com</h5></a>
		<h5>Hire Me : <a href="http://fiverr.com/abuhayat">www.fiverr.com/abuhayat</h5></a>
		Email: <a href="mailto:abuhayat.du@gmail.com">abuhayat.du@gmail.com </a>
		<h5>Skype: ah_polash</h5> 
		<br />
		
		';
	echo '</div>';

}
//How to use
add_action('admin_menu', 'svp_howto_page');

function svp_howto_page() {
	add_submenu_page( 'edit.php?post_type=ppt_viewer', 'How To Use', 'How To Use', 'manage_options', 'ppv_howto', 'ppv_howto_page_callback' );
}

function ppv_howto_page_callback() {
	
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>How to use </h2>
		<h2>Watch the video to learn how to use the plugin. </h2>
		<br/>
		Coming Soon...
		<br />
		
		';
	echo '</div>';

}

/*
<iframe width="789" height="375" src="https://www.youtube.com/embed/LJym2Pe1h2k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
*/


/*-------------------------------------------------------------------------------*/
// Dashboard widget
/*-------------------------------------------------------------------------------*/


function ppv_add_dashboard_widgets() {
 	wp_add_dashboard_widget( 'ppv_example_dashboard_widget', 'Support Document Embedder', 'ppv_dashboard_widget_function' );
 
 	global $wp_meta_boxes;
 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
 	$example_widget_backup = array( 'ppv_example_dashboard_widget' => $normal_dashboard['ppv_example_dashboard_widget'] );
 	unset( $normal_dashboard['ppv_example_dashboard_widget'] );
	$sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
} 
function ppv_dashboard_widget_function() {

// Display whatever it is you want to show.
	echo '
<p>It is hard to continue development and support for this plugin without contributions from users like you. If you enjoy using the plugin and find it useful, please consider support by <b>DONATION</b> or <b>BUY THE PRO VERSION (Ad Less)</b> of the Plugin. Your support will help encourage and support the plugin’s continued development and better user support.</p>
<center>
<a target="_blank" href="https://gum.co/wpdonate"><div><img width="200" src="'.PPV_PLUGIN_DIR.'img/donation.png'.'" alt="Donate Now" /></div></a>
</center>
<br />


	
	';}
add_action( 'wp_dashboard_setup', 'ppv_add_dashboard_widgets' );


// Adds a box to the main column on the Post and Page edit screens.

function ppv_myplugin_add_meta_box() {
	add_meta_box(
		'donation',
		__( 'Upgrade to Pro', 'myplugin_textdomain' ),
		'ppv_callback_donation',
		'ppt_viewer'
	);	
	add_meta_box(
		'myplugin_sectionid',
		__( 'Try LightBox Addons', 'myplugin_textdomain' ),
		'ppv_addons_callback',
		'ppt_viewer',
		'side'
	);
	add_meta_box(
		'myplugin',
		__( 'Please show some love', 'myplugin_textdomain' ),
		'ppv_callback',
		'ppt_viewer',
		'side'
	);		
}
add_action( 'add_meta_boxes', 'ppv_myplugin_add_meta_box' );
function ppv_callback_donation( ) {echo '
<script src="https://gumroad.com/js/gumroad-embed.js"></script>
<div class="gumroad-product-embed" data-gumroad-product-id="depro" data-outbound-embed="true"><a target="_blank" href="https://gumroad.com/l/depro">Loading...</a></div>
';};
function ppv_addons_callback(){echo'<a target="_blank" href="http://bit.ly/2GiuI2G"><img style="width:100%" src="'.PPV_PLUGIN_DIR.'/img/upwork.png" ></a>
<p>LightBox Addons enable you to open any doc in a Nice LightBox</p>
<table>
	<tr>
		<td><a class="button button-primary button-large" href="http://bit.ly/2IHqXpc" target="_blank">See Demo </a></td>
		<td><a class="button button-primary button-large" href="http://bit.ly/327b8A9" target="_blank">Buy Now</a></td>
	</tr>
</table>
';};

function ppv_callback( ) {echo 'If you like <strong>Document Embedder </strong> Plugin, please leave us a <a href="https://wordpress.org/support/plugin/document-emberdder/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733; rating.</a> Your Review is very important to us as it helps us to grow more.
<p>Need some improvement ? <a href="mailto:abuhayat.du@gmail.com">Please let me know </a> how can i improve the Plugin.</p>';};


// Add shortcode area 	

add_action('edit_form_after_title','ppv_shortcode_area');
function ppv_shortcode_area(){
global $post;	
if($post->post_type=='ppt_viewer'){
?>	
<div>
	<label style="cursor: pointer;font-size: 13px; font-style: italic;" for="h5vp_shortcode">Copy this shortcode and paste it into your post, page, or text widget content:</label>
	<span style="display: block; margin: 5px 0; background:#1e8cbe; ">
		<input type="text" id="h5vp_shortcode" style="font-size: 12px; border: none; box-shadow: none;padding: 4px 8px; width:100%; background:transparent; color:white;"  onfocus="this.select();" readonly="readonly"  value="[doc id=<?php echo $post->ID; ?>]" /> 
		
	</span>
</div>
 <?php   
}}


// Add Sortcode
function ppv_cpt_content_func($atts){
	extract( shortcode_atts( array(

		'id' => null,

	), $atts ) ); 

 	$file_url=get_post_meta($id,'_groupped_ppv_file_url', true);
	$ext_url=get_post_meta($id,'_groupped_ppv_ext_url', true); 
		if (is_array($file_url)){$url=$file_url['url'];}else{$url=$ext_url;}
			
	$width=get_post_meta($id,'ppt_ppv_width', true); 
	$height= get_post_meta($id,'ppt_ppv_height', true); 
	
		if ($width==''){$width='100%';} else{$width=$width.'px';}
		if ($height==''){$height='600px'; }  else {$height=$height.'px';}
		$frame_style= 'width:'.$width.'; '. 'height:'. $height. ';';
		$base_url = '//docs.google.com/gview?embedded=true&url=';
?>
<?php ob_start(); ?>		
	<?php 
if($url==''){ echo '<h2>Ooops... You forgot to Select a document. Please select a file or paste a external document link to show here. </h2>';} else{
		// show file name
		$file_name=get_post_meta($id,'ppt_ppv_file_name', true); 
		if($file_name=='on'){$file_name=basename($url); echo '<p style="padding-left:10px;">File Name: '.$file_name.'</p>';} 
		
		// Download button
		if(get_post_meta($id,'ppt_ppv_download',true)=='on'){ 
		$down_btn_color= get_post_meta($id,'ppt_ppv_download_btn_color', true);
		echo '<p style="padding-left:10px;"><a class="s_pdf_download_link" href="'.$url.'" download><button style="margin-bottom:10px;'.'background-color:'.$down_btn_color.';" class="ppv_download_bttn">'.get_post_meta($id,'ppt_ppv_download_btn_text',true).'</button></a></p>';}
		
		
echo '<iframe id="s_pdf_frame" src="' . $base_url . $url . '" style="float:left; padding:10px;' . $frame_style . '" frameborder="0"></iframe>';
}
?>
<?php  $output = ob_get_clean();return $output;//print $output; // debug ?>

<?php
}
add_shortcode('doc','ppv_cpt_content_func');