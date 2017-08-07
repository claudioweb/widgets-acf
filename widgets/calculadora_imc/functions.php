<?php
Class calculadora_imc {

	static function set_fields(){

		$fields = array (
			'key' => 'calculadora_imc_key',
			'name' => 'calculadora_imc',
			'label' => 'Calculadora IMC',
			'display' => 'line',
			'sub_fields' => array (
				array (
					'key' => 'field_nome_origem',
					'label' => 'Nome origem',
					'name' => 'nome_origem',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					),
				array (
					'key' => 'field_id_origem',
					'label' => 'ID Origem',
					'name' => 'id_origem',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					)
				)
			);
		return $fields;
	}

	static function content($fields){

		
		$pages = get_posts(array('post_type'=>'page','posts_per_page'=>-1,'order'=>'ASC','orderby'=>'menu_order',
			'meta_key'=>'_wp_page_template','meta_value'=>'template-imc.php'));

		$pages[0]->nome_origem = $fields['field_nome_origem'];
		$pages[0]->id_origem = $fields['field_id_origem'];

		return $pages[0];

	}

}
?>