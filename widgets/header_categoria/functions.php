<?php
Class header_categoria {

	static function fields(){

		add_action( 'admin_enqueue_scripts', array('header_categoria', 'css_widget_admin_header_line') );

		$fields = array (
			'key' => 'header_categoria_key',
			'name' => 'header_categoria',
			'label' => 'Header categoria',
			'display' => 'table',
			'sub_fields' => array (
				array (
					'key' => 'field_select_categoria_line',
					'label' => 'Selecione a categoria',
					'name' => 'select_categoria_line',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'choices' => header_categoria::get_terms(),
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

	static function get_term($term_id){

		$term = get_term($term_id,'category');

		$term->color = get_field('cor_padrao',$term);

		return $term;

	}

	public function get_terms(){

		$terms = get_terms('category',array('hide_empty'=>false));

		$terms_arr = array();

		foreach ($terms as $key => $term) {

			$terms_arr[$term->term_id] = $term->name; 
		}

		return $terms_arr;

	}

	public function css_widget_admin_header_line() {
		wp_enqueue_style( 'css_widget_admin_header_line', plugins_url('css/admin.css',__FILE__));
	}

}
?>