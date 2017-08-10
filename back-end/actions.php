<?php

// Cria e define a grid de widget via ADM

Class AcfAction {

	public function __construct() {

		require("acf/widgets_base.php");

		return $this->set_widgets_list();
	}

	public function set_widgets_list(){

		if( function_exists('acf_add_local_field_group') ){

			$acf_base = AcfWidget::get_base();

			$directory_widgets = $this->get_folders_widgets();

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
				$widget['sub_fields'][] = $this->set_mobile_fields($widget['key']);
				$acf_base['fields'][0]['sub_fields'][2]['layouts'][] = $widget;
			}

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
		$taxonomies_admin = get_field('tax_widget_acf','options');

		$pgs = array();

		$pgs['post_type'] = $posttypes_admin;
		$pgs['page'] = $pages_admin;
		$pgs['taxonomy'] = $taxonomies_admin;

		return $pgs;
	}

	public function set_mobile_fields($prefixed_widget=null){

		$sub_fields = array (
			'key' => 'field_radio_mobile_'.$prefixed_widget,
			'label' => 'Exibir Mobile?',
			'name' => 'mobile',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
				),
			'choices' => array(1=>'Sim',0=>'Não'),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'value',
			);

		return $sub_fields;
	}

	public function get_folders_widgets(){

		$path = plugin_dir_path( __FILE__ )."../widgets";
		$dir = new DirectoryIterator($path);
		$widgets = array();

		foreach ($dir as $fileinfo) {

			if ($fileinfo->isDir() && !$fileinfo->isDot()) {

				require($path."/".$fileinfo->getFilename()."/functions.php");

				$widgets[] = call_user_func(array($fileinfo->getFilename(),'fields'));
			}
		}

		// get widgets theme
		$widgets = AcfAction::get_folders_widgets_theme($widgets);

		return $widgets;
	}

	public function get_folders_widgets_theme($widgets){
		$path =  get_template_directory()."/widgets-acf";

		if(is_dir($path)){
			$dir = new DirectoryIterator($path);

			foreach ($dir as $fileinfo) {

				if ($fileinfo->isDir() && !$fileinfo->isDot()) {

					require($path."/".$fileinfo->getFilename()."/functions.php");

					$widgets[] = call_user_func(array($fileinfo->getFilename(),'fields'));
				}
			}
		}

		return $widgets;
	}

}

?>