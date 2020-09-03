<?php

include "fields.php";

// Cria e define a grid de widget via ADM
Class AcfAction {

	public function __construct() {
		require("acf/widgets_base.php");

		return $this->set_widgets_list();
	}

	public function set_widgets_list(){

		if( function_exists('acf_add_local_field_group') ){
			add_action('admin_head', array($this, 'my_custom_css_widget'), 1);

			$acf_base = AcfWidget::get_base();

			$directory_widgets = 
				function_exists('\App\template') || function_exists('\Roots\view') ? 
					$this->getWidgets(get_template_directory() . '/views/widgets-templates') :
					$this->getWidgets(get_template_directory() . '/widgets-templates');

			if(empty($directory_widgets)){
				$directory_widgets = $this->getWidgets(plugin_dir_path(__FILE__) . '../more-widgets-templates');
			}

			$widget_adm = $this->get_pages_selected();


			Painel::field_color($widget_adm['taxonomy']);

			// Define widget em post_type selecionados
			if(!empty($widget_adm['post_type'])){
				foreach ($widget_adm['post_type'] as $key => $page) {

					$acf_base['location'][][] = array(
						'param'=>'post_type',
						'operator'=>'==',
						'value'=>$page
						);

					$posts = get_post(array('post_type'=>$page,'posts_per_page'=>-1));
					foreach ($posts as $key => $post) {
						if($post->post_content!='[acf_widgets]'){
							$my_post = array('ID' => $post->ID, 'post_content' => '[acf_widgets]');
							wp_update_post($my_post);
						}
					}

				}
			}

			// Define widget em  paginas selecionadas
			if(!empty($widget_adm['page'])){
				foreach ($widget_adm['page'] as $key => $page) {

					$acf_base['location'][][] = array(
						'param'=>'page',
						'operator'=>'==',
						'value'=>$page
						);

					$post = get_post($page);
					if($post->post_content!='[acf_widgets]'){
						$my_post = array('ID' => $post->ID, 'post_content' => '[acf_widgets]');
						wp_update_post($my_post);
					}

				}
			}

			// Define widget em  modelos selecionadas
			if(!empty($widget_adm['models'])){

				foreach ($widget_adm['models'] as $key => $model) {

					$acf_base['location'][][] = array(
						'param'=>'page_template',
						'operator'=>'==',
						'value'=>$model
						);

					$pages = get_posts(array(
						'post_type' => 'page',
						'meta_key' => '_wp_page_template',
						'meta_value' => $model
					));

					foreach($pages as $page){

						if($page->post_content!='[acf_widgets]'){
							$my_post = array('ID' => $page->ID, 'post_content' => '[acf_widgets]');
							wp_update_post($my_post);
						}
					}

				}
			}

			// Define widget em categorias selecionadas
			if(!empty($widget_adm['taxonomy'])){
				foreach ($widget_adm['taxonomy'] as $key => $page) {

					$acf_base['location'][][] = array(
						'param'=>'taxonomy',
						'operator'=>'==',
						'value'=>$page
						);

					$terms = get_terms( $page, array('hide_empty' => false) );

					foreach ($terms as $key => $term) {
						if($term->description!='[acf_widgets]'){
							$my_term = wp_update_term($term->term_id,$page,array('name' => $term->name,'description'=>'[acf_widgets]'));
						}
					}

				}
			}

			$acf_base['fields'][0]['sub_fields'][2]['wrapper']['class'] = 'column_3';

			foreach ($directory_widgets as $key => $widget) {
				$widget['sub_fields'] = $this->set_mobile_fields($widget['sub_fields'],$widget['key']);
				$acf_base['fields'][0]['sub_fields'][2]['layouts'][] = $widget;
			}

			// var_dump($acf_base);

			$layouts_widget = acf_add_local_field_group($acf_base);

			if($layouts_widget){
				return true;
			}else{
				return false;
			}

		}

	}

	public function get_pages_selected(){

		$posttypes_admin = get_field('type_widget_acf','options');
		$pages_admin = get_field('page_widget_acf','options');
		$models_admin = get_field('models_widget_acf','options');
		$taxonomies_admin = get_field('tax_widget_acf','options');

		$pgs = array();

		$pgs['post_type'] = $posttypes_admin;
		$pgs['page'] = $pages_admin;
		$pgs['models'] = $models_admin;
		$pgs['taxonomy'] = $taxonomies_admin;

		return $pgs;
	}

	public function set_mobile_fields($sub_fields,$prefixed_widget=null){

		include "fixed_fields/mobile.php";
		include "fixed_fields/layouts.php";

		return $sub_fields;
	}
	
	/**
	 * getWidgets Recupera todos os widgets do caminho informado
	 *
	 * @param  mixed $path Caminho dos widgets
	 * @return array Array de widgets encontrados no diretório informado
	 */
	public function getWidgets($path) {
		$widgets = array();

		if(!is_dir($path))
			return $widgets;

		$dir = new DirectoryIterator($path);

		foreach($dir as $fileinfo):
			if($fileinfo->isDir() && !$fileinfo->isDot()):
				$file = "{$path}/{$fileinfo->getFilename()}/functions.php";
				
				if(!file_exists($file))
					continue;

				$fields=array();
				$widget = WidgetsWidgets::parseWidgetHeaders($file);

				require($file);

				$widgets[$widget['name']] = get_fields_acf_widgets::get_field($widget, $fields);
			endif;
		endforeach;

		return $widgets;
	}

	public function my_custom_css_widget() {

		$path =
        function_exists('\App\template') || function_exists('\Roots\view') ? 
        get_template_directory() . '/views/widgets-templates' :
		get_template_directory() . '/widgets-templates';
		
		$temp =
        function_exists('\App\template') || function_exists('\Roots\view') ? 
        get_template_directory_uri() . '/views/widgets-templates/' :
        get_template_directory_uri() . '/widgets-templates/';

		if(!is_dir($path)){

			$path = plugin_dir_path( __FILE__ )."../more-widgets-templates";

			$temp = plugins_url( '/more-widgets-templates/' , dirname(__FILE__));
			
		}

			$dir = new DirectoryIterator($path);

			foreach ($dir as $fileinfo) {

				$widget_name = $fileinfo->getFilename();

				$widget_class = str_replace('-','_', str_replace('-','_', str_replace('-','_',$widget_name)));

				echo '<style>
					.acf-field-the-contents .acf-flexible-content .values .layout[data-layout="'.$widget_class.'_widget_acf"] .acf-fc-layout-handle, .acf-fc-popup a[data-layout="'.$widget_class.'_widget_acf"]:hover {
					background-image: url("'.$temp.$widget_name.'/main.png") !important;
				}
				</style>';
			}
	  
	}

}

?>