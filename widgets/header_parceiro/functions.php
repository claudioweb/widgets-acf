<?php
Class header_parceiro {

	static function set_fields(){

		add_action( 'admin_enqueue_scripts', array('header_parceiro', 'css_widget_admin_header_line') );

		$fields = array (
			'key' => 'header_parceiro_key',
			'name' => 'header_parceiro',
			'label' => 'Header parceiro',
			'display' => 'table',
			'sub_fields' => array (
				array (
					'key' => 'field_select_parceiro_line',
					'label' => 'Selecione a parceiro',
					'name' => 'select_parceiro_line',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'choices' => header_parceiro::get_posts(),
					'default_value' => array (
						),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 1,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
					),
				)
			);
		return $fields;
	}

	static function get_post($post_id){

		$post = get_post($post_id);

		$post->color = get_field('cor_parceiro',$post);
		$post->thumb = get_field('logo_parceiro',$post);
		$post->redes = get_field('redes_sociais_parceiro',$post);

		return $post;

	}

	public function get_posts(){

		$posts = get_posts(array('post_type'=>'parceiros','posts_per_page'=>-1));

		$posts_arr = array();

		foreach ($posts as $key => $post) {

			$posts_arr[$post->ID] = $post->post_title; 
		}

		return $posts_arr;

	}

	public function css_widget_admin_header_line() {
		wp_enqueue_style( 'css_widget_admin_header_line_parceiro', plugins_url('css/admin.css',__FILE__));
	}

}
?>