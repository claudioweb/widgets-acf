<?php 

Class Painel {


	static function field_color($taxonomies) {
		if(!empty($taxonomies)){
			$tax = array();
			foreach ($taxonomies as $key => $value) {
				$tax[][] = array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => $value
					);
			}

			acf_add_local_field_group(array (
				'key' => 'group_cor_padrao_widget_acf',
				'title' => 'Configurações Widgets ACF',
				'fields' => array (
					array (
						'key' => 'field_cor_padrao_widget_acf',
						'label' => 'Cor categoria Widget ACF',
						'name' => 'color_widget_acf',
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
}
?>