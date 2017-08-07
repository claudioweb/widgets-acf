<?php 

Class Sidebars {

	public function __construct() {
		
		if(get_field('show_sidebars','options')){
			return $this->post_type();
		}
	}

	static function post_type(){
		$args = array(
			'labels' => array('name' => 'Sidebars', 'add_new' => 'Adicionar'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'exclude_from_search' => true,
			'rewrite' => array( 'slug' => 'sidebars' ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'taxonomies' => get_field('tax_widget_ativo','options'),
			'menu_position' => 1959,
			'supports' => array( 'title' ),
			'menu_icon' => 'dashicons-index-card'
			);

		register_post_type( 'sidebars', $args );
		flush_rewrite_rules();
	}

}

?>