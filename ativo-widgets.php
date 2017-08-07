<?php
/***************************************************************************
Plugin Name:  Ativo Widgets
Plugin URI:   https://www.advancedcustomfields.com/
Description:  Plugin dependente do ACF (Add Custom Fields)
Version:      1.0
Author:       Claudio Web (claudioweb)
Author URI:   http://www.claudioweb.com.br/
Text Domain:  ativo-widgets
**************************************************************************/

class AtivoWidgets {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array($this, 'load_custom_wp_admin_style') );
	}

	/*=========================================================
	=            Criando o Menu e os campos em acf            =
	=========================================================*/

	static function add_admin_menu() {

		$especialistas = Especialistas::disabled_menu();

		if($especialistas==false){

			$plugin_nome = 'Widgets ACF';

			$parent = acf_add_options_page(array(
				'page_title' 	=> $plugin_nome,
				'menu_title' 	=> $plugin_nome,
				'icon_url'		=> 'dashicons-layout',
				'redirect' 		=> false
				));
			// acf_add_options_sub_page(array(
			// 	'page_title' 	=> __('Home', 'ativo'),
			// 	'menu_title' 	=> __('Home', 'ativo'),
			// 	'parent_slug' 	=> $parent['menu_slug'],
			// 	));

		}
		add_theme_support('post-thumbnails');
		add_image_size( 'size_widget', 350, 350, array( 'center', 'center' ) );
		add_image_size( 'size_widget_thumb', 160, 120, array( 'center', 'center' ) );



		return $plugin_nome;

	}

	/*=====  End of Criando o Menu e os campos em acf  ======*/


	public function load_custom_wp_admin_style() {
		wp_enqueue_style( 'custom_wp_admin_css', plugins_url('back-end/css/widgets.css', __FILE__) );
		wp_enqueue_script( 'custom_wp_admin_js', plugins_url('back-end/js/admin.js', __FILE__) );
	}

}

function AtivoWidgets_init() {

	global $acf_action, $widgets, $actions;


	require("back-end/especialistas/functions.php");
	$especialistas = new Especialistas();

	$widgets = new AtivoWidgets();
	$plugin_nome = $widgets::add_admin_menu();
	require("back-end/functions.php");
	require("back-end/acf/fields_admin.php");


	require("back-end/actions.php");
	require("back-end/painel.php");
	$acf_action = new AcfAction();
	
	require("back-end/sidebars/functions.php");
	$sidebars = new Sidebars();

	require("front-end/actions.php");
	$actions = new ActionWidgets();
}

if( function_exists('acf_add_local_field_group') ){

	add_action( 'init', 'AtivoWidgets_init' );
}else{
	
	add_action( 'admin_notices', 'append_meta_links_plugin_widget_ativo' );
}

function append_meta_links_plugin_widget_ativo() {
	echo '<div class="error notice">Para o plugin <b>Widgets ACF</b> funcionar corretamente, precisa ser efetuado a instalação do plugin <a href="'.admin_url('plugins.php').'">(ACF PRO)</a>  / Site Plugin: <a href="https://www.advancedcustomfields.com/pro/" target="_blank">Advanced Custom Fields</a></div>';
}

?>