<?php

Class WidgetsAdmin {

	public function __construct() {}

	static function get_post_types(){

		$all_types = get_post_types();

		unset(
			$all_types['post'],
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

	static function get_pages(){

		$pages = get_posts(array('post_type'=>'page','posts_per_page'=>'-1'));

		$all_pages = array();

		foreach ($pages as $key => $page) {
			$all_pages[$page->ID] = $page->post_title;
		}

		return $all_pages;
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

	static function get_columns(){

		$columns_options = array(
			3=>'3 Colunas',
			2=>'2 Colunas'
			);

		return $columns_options;
	}

}

?>