<?php 

Class Painel {


	static function field_color($taxonomies) {

		$tax = array();
		foreach ($taxonomies as $key => $value) {
			$tax[][] = array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => $value
				);
		}

		acf_add_local_field_group(array (
			'key' => 'group_cor_padrao',
			'title' => 'Configurações',
			'fields' => array (
				array (
					'key' => 'field_cor_padrao',
					'label' => 'Cor padrão',
					'name' => 'cor_padrao',
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
				),
			'location' => $tax,
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
			));

	}
}
?>