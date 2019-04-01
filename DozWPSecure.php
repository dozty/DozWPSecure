<?php
/*
Plugin Name: DozWPSecure
Plugin URI: https://www.dozty.net/dozwpsecure/
Description: Security Plugin for WordPress
Tags: security, dozwpsecure, hardening, protect, secure, version, rest, customize
Author: Dozty
Author URI: https://www.dozty.net
Contributors: Dozty
Donate link: https://www.dozty.net/contact/
Requires at least: 4.4
Tested up to: 5.1.1
Stable tag: 1.2
Version: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

//Initialization
add_action( 'admin_menu', 'DozWPSecure_admin_menu' );
add_action( 'admin_init', 'DozWPSecure_settings_init' );

//function
function DozWPSecure_admin_menu(){
	add_menu_page( 'DozWPSecure Settings', 'DozWPSecure', 'manage_options', 'DozWPSecure', 'DozWPSecure_options_page' );
}

//function
function DozWPSecure_settings_init(){ 

	register_setting( 'pluginPage', 'DozWPSecure_settings' );

	//===Basic WP Security Settings
	add_settings_section(
		'DozWPSecure_General_Settings', 
		__( 'Basic WP Security Hardening', 'DozWPSecure' ), 
		'DozWPSecure_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_RemoveVersion', 
		__( 'Remove WP Version Details', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_RemoveVersion_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_DisableXMLRPC', 
		__( 'Disable XMLRPC', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_DisableXMLRPC_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_DisablePingback', 
		__( 'Disable Pingback', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_DisablePingback_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_DisableWLW', 
		__( 'Disable Windows Live Writer', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_DisableWLW_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_DisableRSSFeeds', 
		__( 'Disable RSS Feeds', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_DisableRSSFeeds_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_DisableJSONRESTAPI', 
		__( 'Disable JSON & REST API', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_DisableJSONRESTAPI_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);	
	add_settings_field( 
		'DozWPSecure_Basic_chk_SecurityHeaders', 
		__( 'Enable Security Headers', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_SecurityHeaders_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_Remove_PHPVersion', 
		__( 'Remove PHP Version', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_Remove_PHPVersion_render', 
		'pluginPage', 
		'DozWPSecure_General_Settings' 
	);
	//Basic WP Security Settings===
	//===Optional Settings
	add_settings_section(
		'DozWPSecure_Optional_Settings', 
		__( 'Optional Settings', 'DozWPSecure' ), 
		'DozWPSecure_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_RemoveHTMLCommentTags', 
		__( 'Remove HTML Comment Tags', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_RemoveHTMLCommentTags_render', 
		'pluginPage', 
		'DozWPSecure_Optional_Settings' 
	);
	add_settings_field( 
		'DozWPSecure_Basic_chk_TrimHTMLContent', 
		__( 'Trim HTML Response', 'DozWPSecure' ), 
		'DozWPSecure_Basic_chk_TrimHTMLContent_render', 
		'pluginPage', 
		'DozWPSecure_Optional_Settings' 
	);
	//Optional Settings Settings===
	
	//===Custom URL
	add_settings_section(
		'DozWPSecure_Custom_URL', 
		__( 'Custom Login URL', 'DozWPSecure' ), 
		'DozWPSecure_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'DozWPSecure_txt_CustomLoginURL', 
		__( 'Custom Login URL', 'DozWPSecure' ), 
		'DozWPSecure_txt_CustomLoginURL_render', 
		'pluginPage', 
		'DozWPSecure_Custom_URL' 
	);
	add_settings_field( 
		'DozWPSecure_txt_CustomLoginLogo', 
		__( 'Custom Login Logo URL', 'DozWPSecure' ), 
		'DozWPSecure_txt_CustomLoginLogo_render', 
		'pluginPage', 
		'DozWPSecure_Custom_URL' 
	);
	add_settings_field( 
		'DozWPSecure_chk_EnforceHTTPS', 
		__( 'Enforce HTTPS Login', 'DozWPSecure' ), 
		'DozWPSecure_chk_EnforceHTTPS_render', 
		'pluginPage', 
		'DozWPSecure_Custom_URL' 
	);
	//Custom URL===
}

//function
function DozWPSecure_settings_section_callback(){ 
	esc_html_e(__( '', 'DozWPSecure' ));
}

function DozWPSecure_Basic_chk_RemoveVersion_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_RemoveVersion]' <?php if(isset($options['DozWPSecure_Basic_chk_RemoveVersion'])){esc_html_e('checked');};?>> [WordPress Generator, CSS, JavaScript Version Number]
	<?php
}

function DozWPSecure_Basic_chk_DisableXMLRPC_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_DisableXMLRPC]' <?php if(isset($options['DozWPSecure_Basic_chk_DisableXMLRPC'])){esc_html_e('checked');};?>> [WordPress XMLRPC]
	<?php
}

function DozWPSecure_Basic_chk_DisablePingback_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_DisablePingback]' <?php if(isset($options['DozWPSecure_Basic_chk_DisablePingback'])){esc_html_e('checked');};?>> [WordPress Pingback]
	<?php
}

function DozWPSecure_Basic_chk_DisableWLW_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_DisableWLW]' <?php if(isset($options['DozWPSecure_Basic_chk_DisableWLW'])){esc_html_e('checked');};?>> [wlwmanifest, EditURI(rsd)]
	<?php
}

function DozWPSecure_Basic_chk_DisableRSSFeeds_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_DisableRSSFeeds]' <?php if(isset($options['DozWPSecure_Basic_chk_DisableRSSFeeds'])){esc_html_e('checked');};?>> [RSS Feeds]
	<?php
}

function DozWPSecure_Basic_chk_DisableJSONRESTAPI_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_DisableJSONRESTAPI]' <?php if(isset($options['DozWPSecure_Basic_chk_DisableJSONRESTAPI'])){esc_html_e('checked');};?>> [Disable /wp-json/ and REST API, Link: <http://example.com/wp-json/>; rel="https://api.w.org/" header]
	<?php
}

function DozWPSecure_Basic_chk_SecurityHeaders_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_SecurityHeaders]' <?php if(isset($options['DozWPSecure_Basic_chk_SecurityHeaders'])){esc_html_e('checked');};?>> [Add Security Headers: X-Frame-Options, X-XSS-Protection, X-Content-Type-Options]
	<?php
}

function DozWPSecure_Basic_chk_Remove_PHPVersion_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_Remove_PHPVersion]' <?php if(isset($options['DozWPSecure_Basic_chk_Remove_PHPVersion'])){esc_html_e('checked');};?>> [Remove "X-Powered-By: PHP Version" header]
	<?php
}

function DozWPSecure_Basic_chk_RemoveHTMLCommentTags_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_RemoveHTMLCommentTags]' <?php if(isset($options['DozWPSecure_Basic_chk_RemoveHTMLCommentTags'])){esc_html_e('checked');};?>> [&lt;!-- comments --&gt;]
	<?php
}

function DozWPSecure_Basic_chk_TrimHTMLContent_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_Basic_chk_TrimHTMLContent]' <?php if(isset($options['DozWPSecure_Basic_chk_TrimHTMLContent'])){esc_html_e('checked');};?>> [Extra break lines, tabs]
	<?php
}

function DozWPSecure_txt_CustomLoginURL_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	esc_html_e(get_bloginfo('url').'/');
	?>
	<input type='text' name='DozWPSecure_settings[DozWPSecure_txt_CustomLoginURL]' value="<?php if(isset($options['DozWPSecure_txt_CustomLoginURL'])){esc_html_e($options['DozWPSecure_txt_CustomLoginURL']);};?>"/><br>[<strong>Note</strong>: Please do remember the Custom Login URL. You have to remove the plugin if you forget the Custom Login URL.<br>You may leave it as empty if you would like to use default /wp-admin URL]
	<?php
}

function DozWPSecure_txt_CustomLoginLogo_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='text' name='DozWPSecure_settings[DozWPSecure_txt_CustomLoginLogo]' size="80" value="<?php if(isset($options['DozWPSecure_txt_CustomLoginLogo'])){esc_html_e($options['DozWPSecure_txt_CustomLoginLogo']);};?>"/><br/>[e.g. /wp-contents/uploads/2019/03/logo.png]
	<?php
}

function DozWPSecure_chk_EnforceHTTPS_render(){ 
	$options = get_option( 'DozWPSecure_settings' );
	?>
	<input type='checkbox' name='DozWPSecure_settings[DozWPSecure_chk_EnforceHTTPS]' <?php if(isset($options['DozWPSecure_chk_EnforceHTTPS'])){esc_html_e('checked');};?>> [Force login using https://]
	<?php
}

function DozWPSecure_options_page(){ 
	?>
	<form action='options.php' method='post'>
		<h2>DozWPSecure v1.2</h2>
		<?php
		settings_fields('pluginPage');
		do_settings_sections('pluginPage');
		submit_button();
		?>
	</form>
	<h3>Cookie Hardening</h4>
	Add the following settings in your wp-config.php
	<pre>
	@ini_set('session.cookie_httponly','On');
	@ini_set('session.use_only_cookies','On');
	</pre>
	<?php
}

//Hardening Actions
$DozWPSecure_options = get_option('DozWPSecure_settings');

function DozWPSecure_remove_wp_ver() { return ''; }

function DozWPSecure_remove_wp_ver_par($src) {
	if (strpos($src,'ver='))
		$src=remove_query_arg('ver',$src);
	return $src;
}

//DozWPSecure_Basic_chk_RemoveVersion
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_RemoveVersion'])){
	add_filter('the_generator', 'DozWPSecure_remove_wp_ver');
	add_filter('style_loader_src', 'DozWPSecure_remove_wp_ver_par', 9999);
	add_filter('script_loader_src', 'DozWPSecure_remove_wp_ver_par', 9999);
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head');
}

//DozWPSecure_Basic_chk_DisableXMLRPC
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_DisableXMLRPC'])){
	add_filter( 'xmlrpc_enabled','__return_false');
	remove_action('wp_head', 'rsd_link');
}

//DozWPSecure_Basic_chk_DisablePingback
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_DisablePingback'])){
	add_filter('wp_headers', 'DozWPSecure_remove_x_pingback');
	header_remove("X-Pingback");
}

function DozWPSecure_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}

//DozWPSecure_Basic_chk_DisableWLW
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_DisableWLW'])){
	remove_action('wp_head', 'wlwmanifest_link');
}

//DozWPSecure_Basic_chk_DisableRSSFeeds
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_DisableRSSFeeds'])){
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head','feed_links_extra', 3 );
}

//DozWPSecure_Basic_chk_DisableJSONRESTAPI
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_DisableJSONRESTAPI'])){
	add_action( 'after_setup_theme', 'DozWPSecure_remove_json_api' );
	add_action( 'after_setup_theme', 'DozWPSecure_disable_json_api' );
}

//DozWPSecure_Basic_chk_SecurityHeaders
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_SecurityHeaders'])){
	header_remove("X-Frame-Options");
	header('X-Frame-Options: SAMEORIGIN');
	header_remove("X-Content-Type-Options");
	header('X-Content-Type-Options: nosniff');	
	header_remove("X-XSS-Protection");
	header('X-XSS-Protection: 1; mode=block');	
}

//DozWPSecure_Basic_chk_Remove_PHPVersion
if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_Remove_PHPVersion'])){
	header_remove("X-Powered-By");
}

//Cleanup Response Contents (required to cleanup pingback etc..
add_action('template_redirect', 'DozWPSecure_cleanup_the_content_start', -1);
add_action('get_header', 'DozWPSecure_cleanup_the_content_start');
add_action('wp_head', 'DozWPSecure_cleanup_the_content_end', 999);

function DozWPSecure_cleanup_the_content($text){
	$DozWPSecure_options = get_option('DozWPSecure_settings');
	
	//DozWPSecure_Basic_chk_RemoveHTMLCommentTags
	if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_RemoveHTMLCommentTags'])){
		$text = preg_replace('/(<!--[\w\d\s<\/>\"\=\-\#]+-->)|(<!--(.*?)-->)/i','',$text);
	}
	//DozWPSecure_Basic_chk_TrimHTMLContent
	if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_TrimHTMLContent'])){
		$text = preg_replace('/\s{2,}/', "\n", $text);
		$text = preg_replace('/> </', '><', $text);
		$text = preg_replace('/[\t]+/', '', $text);
		$text = preg_replace('/[\r\n]+/', "\n", $text);
	}
	if(isset($DozWPSecure_options['DozWPSecure_Basic_chk_DisablePingback'])){
		$text = preg_replace('/(<!--.*Pingbacks.*-->)/i','',$text);
		$text = preg_replace('/(<link.*?rel=("|\')pingback("|\').*?href=("|\')(.*?)("|\')(.*?)?\/?>|<link.*?href=("|\')(.*?)("|\').*?rel=("|\')pingback("|\')(.*?)?\/?>)/i', '', $text);
	}
	return $text;
}

function DozWPSecure_cleanup_the_content_start() {
	ob_start("DozWPSecure_cleanup_the_content");
}

function DozWPSecure_cleanup_the_content_end() {
	ob_flush();
}

function DozWPSecure_remove_json_api () {
	remove_action('template_redirect', 'rest_output_link_header', 11);
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
}

function DozWPSecure_disable_json_api () {
	if (version_compare(get_bloginfo('version'), '4.7', '>=')) {
		add_filter('rest_authentication_errors', 'DozWPSecure_disable_wp_rest_api');
	} else {
		DozWPSecure_disable_wp_rest_api_legacy();
	}
}

function DozWPSecure_disable_wp_rest_api($access) {
	if (!is_user_logged_in()) {
		$message = apply_filters('disable_wp_rest_api_error', __('REST API restricted to authenticated users only.', 'disable-wp-rest-api'));
		return new WP_Error('rest_login_required', $message, array('status' => rest_authorization_required_code()));
	}
	return $access;
}

function DozWPSecure_disable_wp_rest_api_legacy() {
    // REST API 1.x
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');
    // REST API 2.x
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');
}

//force HTTPS Login
function DozWPSecure_validate_login_url() {
	$DozWPSecure_options = get_option('DozWPSecure_settings');
	
	$dozblogurl=get_bloginfo('url');

	//check current protocol
	$scheme = strtolower($_SERVER['REQUEST_SCHEME']).'://';	
	
	//to make the scheme in blogurl as same as current scheme
	if($scheme=='https://'){
		$dozblogurl=str_replace('http://','https://',$dozblogurl);
	}
	
	$current_url=$scheme.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'];
	$current_url=rtrim($current_url,"/");
		
	//allow to access login page if the url is correct
	if ($current_url == $dozblogurl.'/'.$DozWPSecure_options['DozWPSecure_txt_CustomLoginURL']){
		$hashurl=str_replace('http://','https://',$dozblogurl); //hashurl is always based on https
		$url_hash=hash('sha512',$hashurl.'/'.$DozWPSecure_options['DozWPSecure_txt_CustomLoginURL'].'/');
		if($scheme=='http://'){
			setcookie('DozWPSecure_valid_url',$url_hash,time()+3600,'/','','',true);
		}else{
			setcookie('DozWPSecure_valid_url',$url_hash,time()+3600,'/','',true,true); //add secure flag for https
		}
		//if enforce https is on then replace to https://
		if(isset($DozWPSecure_options['DozWPSecure_chk_EnforceHTTPS'])){
			$dozblogurl=str_replace('http://','https://',$dozblogurl);
		}
		header( 'Location: '.$dozblogurl.'/wp-login.php');
	}
}

// custom login link/page
function DozWPSecure_check_login_url() {
	$DozWPSecure_options = get_option('DozWPSecure_settings');
	
	$dozblogurl=get_bloginfo('url');

	//check current protocol
	$scheme = strtolower($_SERVER['REQUEST_SCHEME']).'://';
	
	//to make the scheme in blogurl as same as current scheme
	if($scheme=='https://'){
		$dozblogurl=str_replace('http://','https://',$dozblogurl);
	}	

	$current_url=$scheme.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'];
	$hashurl=str_replace('http://','https://',$dozblogurl); //hashurl is always based on https
	$url_hash=hash('sha512',$hashurl.'/'.$DozWPSecure_options['DozWPSecure_txt_CustomLoginURL'].'/');

	if (preg_match("/(\/wp-login.php.*)/i", $current_url) && ($_COOKIE['DozWPSecure_valid_url']!=$url_hash)){
		unset($_COOKIE['DozWPSecure_valid_url']);
		setcookie('DozWPSecure_valid_url', '', time() - 3600, '/');
		header( 'Location: '.$dozblogurl.'/');
	}else{
		//force https login
		if(isset($DozWPSecure_options['DozWPSecure_chk_EnforceHTTPS'])){
			if($scheme!='https://')header( 'Location: https://'.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI']);
		}
	}
}

if(isset($DozWPSecure_options['DozWPSecure_txt_CustomLoginURL'])){
	$DozWPSecure_options = get_option('DozWPSecure_settings');
	if(trim($DozWPSecure_options['DozWPSecure_txt_CustomLoginURL'])!=""){
		add_action('wp_head', 'DozWPSecure_validate_login_url');
		//validate_login_url();
		add_action('login_head', 'DozWPSecure_check_login_url');
	}	
}

function DozWPSecure_LoginLogo(){
	$DozWPSecure_options = get_option('DozWPSecure_settings');
	echo '<style type="text/css">
			h1 a { background-image:url('.esc_url($DozWPSecure_options["DozWPSecure_txt_CustomLoginLogo"]).') !important; 	height:50px !important; background-size: auto auto !important; width: auto !important;}
	</style>';
}

if(isset($DozWPSecure_options['DozWPSecure_txt_CustomLoginLogo'])){
	$DozWPSecure_options = get_option('DozWPSecure_settings');
	if(trim($DozWPSecure_options['DozWPSecure_txt_CustomLoginLogo'])!=""){
		// Change the default Login page Logo
		add_action('login_head', 'DozWPSecure_LoginLogo');
	}
}
?>