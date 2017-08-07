<?php
require("functions.php");

Class ActionWidgets {

	public function __construct() {
		add_shortcode( 'ativo_widget', array( $this, 'init' ) );
	}

	public function init($attr=null){

		$p_id = get_queried_object();

		if(!empty($attr['sidebar'])){
			$p_id = $this->get_sidebar($p_id);
		}

		$widgets = $this->widgets($p_id,$attr);

		return $widgets;
	}

	public function widgets($type, $attr=null){

		$widgets = array();

		if (have_rows('select-the-contents',$type)) {

			while (have_rows('select-the-contents',$type)) {

				the_row();

				$widgets[] = array('layout' => get_row_layout(), 'content' => get_row());
			}

		}

		return TemplatesWidgets::get_templates($widgets,$attr);
	}

	public function get_sidebar($id_post){
		$taxonomies = get_post_taxonomies($id_post);
		if(!empty($taxonomies)){
			foreach ($taxonomies as $key => $tax) {

				$categoria = wp_get_post_terms( $id_post, $tax);
				if(!empty($categoria)){
					$tax = array(
						'taxonomy' => $tax,
						'field' => 'term_id',
						'terms' => $categoria->term_id,
						);
				}
				
			}
		}

		$sidebar = get_posts(array(
			'post_type'=>'sidebars',
			'posts_per_page'=>1,
			'orderby'=>'post_date',
			'order'=>'DESC',
			'tax_query' => array($tax)
			)
		);

		$sidebar = $sidebar[0]->ID;
		if(empty($sidebar)){
			$sidebar = get_field('page_sidebar_ativo','options');
		}

		return $sidebar;
	}

}
?>