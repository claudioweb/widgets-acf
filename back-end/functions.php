<?php

Class WidgetsAdmin {

	public function __construct() {}

	static function get_post_types(){

		$all_types = get_post_types();

		unset(
			// $all_types['post'],
			$all_types['page'],
			$all_types['attachment'],
			$all_types['revision'],
			$all_types['nav_menu_item'],
			$all_types['custom_css'],
			$all_types['customize_changeset'],
			$all_types['acf-field-group'],
			$all_types['acf-field']
		);

		return $all_types;
	}

	static function get_models(){

		$templates = wp_get_theme()->get_page_templates();

		$models = array();

		foreach ( $templates as $template_name => $template_filename ) {
			$models[$template_name] = $template_filename;
		}

		return $models;
	}

	static function get_pages(){

		$pages = get_posts(array('post_type'=>'page','posts_per_page'=>'-1'));

		$all_pages = array();

		foreach ($pages as $key => $page) {
			$all_pages[$page->ID] = $page->post_title;
		}

		return $all_pages;
	}

	static function get_fonts(){

		$credencial_default = 'AIzaSyApghjlJklghhHAwfHTPsqbEimDUIvdEXM';

		if(!empty(get_field('widget_key_credenticalgoogle_widget_acf', 'options'))){
			$credencial_default = get_field('widget_key_credenticalgoogle_widget_acf', 'options');
		}

		$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=".$credencial_default;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		$result_fonts = array();

		$result = json_decode($result);

		if(!empty($result->items)){
			foreach ($result->items as $key => $font) {
				$result_fonts[$font->family.'--'.implode(';',$font->variants)] = $font->family;
			}
		}	

		return $result_fonts;

	}

	static function get_fonts_ajax(){
		header( "Content-type: application/json");

		$show_fonts = get_field('widgets_acf_show_fonts','options');
		
		if($show_fonts==false){
			die(json_encode(array()));
		}

		$fonts_selected = get_field('fonts_types_widget_acf', 'options');

		$fonts_selected_strings = array();

		$weights = array();

		foreach ($fonts_selected as $key => $font) {
			$font_string = explode('--', $font);
			$weights[] = array(str_replace(' ', '_', $font_string[0]) => $font_string[1]);
			$fonts_selected_strings[] = $font_string[0];
		}


		die(json_encode(array('fonte'=>$fonts_selected_strings,'weights'=>$weights)));
	}

	static function get_taxonomies(){
		
		$all_taxonomies = get_taxonomies();

		$all_taxonomies['category'] = 'Categoria Padrão / Category';

		unset(
			$all_taxonomies['post_tag'],
			$all_taxonomies['nav_menu'],
			$all_taxonomies['link_category'],
			$all_taxonomies['post_format']
		);

		return $all_taxonomies;
	}

}

?>