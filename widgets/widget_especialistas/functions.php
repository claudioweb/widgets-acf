<?php
Class widget_especialistas {

	static function set_fields(){

		add_action( 'admin_enqueue_scripts', array('widget_especialistas', 'css_widget_admin_especialistas') );

		$fields = array (
			'key' => 'widget_especialistas_key',
			'name' => 'widget_especialistas',
			'label' => 'Especialistas',
			'display' => 'table',
			'sub_fields' => array (
				array (
					'key' => 'field_cor_especialistas',
					'label' => 'Cor Widget',
					'name' => 'cor',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'default_value' => '',
					),
				array (
					'key' => 'field_select_widget_especialistas',
					'label' => 'Selecione as categorias',
					'name' => 'select_categories',
					'type' => 'select',
					'instructions' => 'Quantidade determinada pelo layout',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'choices' => widget_especialistas::get_terms(),
					'default_value' => array (
						),
					'allow_null' => 0,
					'multiple' => 1,
					'ui' => 1,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
					),
				),
			'min' => '',
			'max' => 3,
			);
		return $fields;
	}

	static function get_terms(){

		$terms = get_terms('category', array('hide_empty'=>false) );
		$terms_arr = array();
		foreach ($terms as $key => $term) {
			$terms_arr[$term->term_id] = $term->name;
		}

		return $terms_arr;

	}

	public function css_widget_admin_especialistas() {
		wp_enqueue_style( 'css_widget_admin_especialistas', plugins_url('css/admin.css',__FILE__));
	}

	public function get_especialistas($fields){
		$terms = $fields['field_select_widget_especialistas'];

		$limit = array(1,1,1);
		if(count($terms)==1){ $limit = array(3); }

		if(count($terms)==2){ $limit = array(1,2); }

		$return_arr = array();
		foreach ($terms as $key => $term) {

			$categoria = get_term($term);
			$posts = get_posts(array('post_type'=>'especialistas','posts_per_page'=>$limit[$key]));

			foreach ($posts as $key => $post) {
				$author_id = $post->post_author;
				$user_login = get_the_author_meta('user_login', $author_id);
				$first_name = get_the_author_meta('first_name', $author_id);
				$last_name = get_the_author_meta('last_name', $author_id);
				$thumb = get_field('foto_especialista','user_'.$author_id);

				$return_arr[] = array(
					'categoria'=>$categoria->name,
					'nome'=>$first_name.' '.$last_name,
					'slug'=>$user_login,
					'post'=>$post->post_title,
					'post_id'=>$post->ID,
					'thumb'=>$thumb['sizes']['thumbnail']
					);
			}

		}

		return $return_arr;

	}

}
?>