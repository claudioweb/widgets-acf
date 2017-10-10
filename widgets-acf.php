<?php
/***************************************************************************
Plugin Name:  Widgets ACF
Plugin URI:   https://github.com/claudioweb/widgets-acf
Description:  Plugin dependente do ACF (Add Custom Fields)
Version:      2.0
Author:       Claudio Web (claudioweb)
Author URI:   http://www.claudioweb.com.br/
Text Domain:  widgets-acf
**************************************************************************/

class WidgetsWidgets {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array($this, 'load_custom_wp_admin_style') );
		
		add_action( 'wp_enqueue_scripts', array($this, 'load_theme_widget_style') );

		// Definindo action ajax
		add_action('wp_ajax_fonts_widgets_acf', array('WidgetsAdmin','get_fonts_ajax'));
   		// Definindo action para acesso público
		add_action('wp_ajax_nopriv_fonts_widgets_acf', array('WidgetsAdmin','get_fonts_ajax')); 
	}

	/*=========================================================
	=            Criando o Menu e os campos em acf            =
	=========================================================*/

	static function add_admin_menu() {

		$plugin_nome = 'Widgets ACF';

		$parent = acf_add_options_page(array(
			'page_title' 	=> $plugin_nome,
			'menu_title' 	=> $plugin_nome,
			'icon_url'		=> 'dashicons-layout',
			'redirect' 		=> false
		));

		add_theme_support('post-thumbnails');
		add_image_size( 'size_widget', 350, 350, array( 'center', 'center' ) );
		add_image_size( 'size_widget_thumb', 160, 120, array( 'center', 'center' ) );

		return $plugin_nome;
	}

	/*=====  End of Criando o Menu e os campos em acf  ======*/

	public function load_custom_wp_admin_style() {
		wp_enqueue_style( 'custom_wp_admin_icon_css', plugins_url('back-end/css/icons.css', __FILE__) );
		wp_enqueue_style( 'custom_wp_admin_css', plugins_url('back-end/css/widgets.css', __FILE__) );
		wp_enqueue_script( 'ckeditor_widgets-acf', '//cdn.ckeditor.com/4.7.3/full/ckeditor.js');
		wp_enqueue_script( 'custom_wp_admin_js', plugins_url('back-end/js/admin.js', __FILE__) );
		wp_enqueue_script( 'custom_wp_widgets_js', plugins_url('back-end/js/widgets.js', __FILE__) );

		
	}

	public function load_theme_widget_style() {

		$show_bootstrap = get_field('widgets_acf_show_bootstrap','options');
		$show_fonts = get_field('widgets_acf_show_fonts','options');

		if($show_bootstrap==true){
			wp_enqueue_style( 'front_end_widget_acf_bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
			wp_enqueue_script( 'front_end_widget_acf_bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
		}

		if($show_fonts==true){
			$fonts_selected = get_field('fonts_types_widget_acf', 'options');
			foreach ($fonts_selected as $key => $font) {
				wp_enqueue_style('font_google_widgets_acf'.$font,'https://fonts.googleapis.com/css?family='.$font.'|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i');
			}
		}

		$show_css = get_field('widgets_acf_show_css','options');
		if($show_css==true){
			wp_enqueue_style( 'front_end_widget_acf', plugins_url('front-end/css/widget-acf.css', __FILE__) );
		}
	}

}

function widgetsWidgets_init() {

	global $widgets, $acf_action, $actions, $duplicate;

	$widgets = new WidgetsWidgets();
	$plugin_nome = $widgets::add_admin_menu();

	require("back-end/functions.php");
	require("back-end/acf/fields_admin.php");

	require("back-end/actions.php");
	require("back-end/painel.php");
	$acf_action = new AcfAction();

	require("front-end/actions.php");
	$actions = new ActionWidgets();

	require("back-end/duplicate.php");
	$duplicate = new Duplicate_acf_widgets();

}

if( function_exists('acf_add_local_field_group') ){

	add_action( 'init', 'widgetsWidgets_init' );
}else{
	
	add_action( 'admin_notices', 'append_meta_links_plugin_widget_widgets' );
}

function append_meta_links_plugin_widget_widgets() {
	echo '<div class="error notice">Para o plugin <b>Widgets ACF</b> funcionar corretamente, precisa ser efetuado a instalação do plugin <a href="'.admin_url('plugins.php').'">(ACF PRO)</a>  / Site Plugin: <a href="https://www.advancedcustomfields.com/pro/" target="_blank">Advanced Custom Fields</a></div>';
}

?>