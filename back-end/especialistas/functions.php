<?php 

Class Especialistas {

	public function __construct() {
		
		if(get_field('show_especialistas','options')){
			include "acf.php";
			return $this->post_type();
		}
	}

	static function post_type(){
		$args = array(
			'labels' => array('name' => 'Notícias dos Especialistas', 'add_new' => 'Adicionar'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'exclude_from_search' => true,
			'rewrite' => array( 'slug' => 'especialistas' ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'taxonomies' => array('category'),
			'menu_position' => 1959,
			'supports' => array( 'title', 'editor', 'author', 'revisions', 'excerpt','thumbnail' ),
			'menu_icon' => 'dashicons-welcome-learn-more'
			);

		register_post_type( 'especialistas', $args );
		flush_rewrite_rules();

		return Especialistas::set_user();
	}

	static function set_user(){

		$new_role = add_role(
			'especialista', 'Especialista',
			array(
				'read' => false,
				'edit_posts' => false,
				'edit_pages' => false,
				'edit_others_posts' => false,
				'create_posts' => false,
				'manage_categories' => false,
				'publish_posts' => false,
				'edit_themes' => false,
				'install_plugins' => false,
				'update_plugin' => false,
				'update_core' => false
				)
			);

		return Especialistas::set_permission();
	}

	static function set_permission(){

		if ( current_user_can( 'especialista' ) ) {

			$redirect = false;

			if($_GET['post_type']!='especialistas' && basename($_SERVER['PHP_SELF']) == 'post-new.php'){
				$redirect = true;	
			}

			$pages_blocked=array('edit-comments.php','tools.php','admin.php','post-new.php');
			foreach ($pages_blocked as $key => $page) {
				if(basename($_SERVER['PHP_SELF']) == $page){
					$redirect = true;
				}

			}

			if($redirect==true){
				wp_safe_redirect( 'profile.php' );
				exit;
			}
		}

	}

	static function disabled_menu(){
		global $menu;
		error_reporting(E_ERROR | E_PARSE);
		$disabled=false;

		if ( current_user_can( 'especialista' )) {
			$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));

			end ($menu);
			while (prev($menu)){
				$value = explode(' ',$menu[key($menu)][0]);
				if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
			}

			$disabled=true;

		}

		return $disabled;

	}

}

?>