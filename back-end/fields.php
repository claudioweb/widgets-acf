<?php

Class get_fields_acf_widgets {

	public function get_field($widget, $fields) {
		$fields = get_fields_acf_widgets::set_field($widget, $fields);

		$fields_base = array (
			'key' => $widget['name'].'_widget_acf_key',
			'name' => $widget['name'].'_widget_acf',
			'label' => key_exists('title', $widget) && !empty($widget['title']) ? $widget['title'] : ucfirst(str_replace('-',' ',str_replace('_', ' ', $widget['name']))),
			'display' => 'line',
			'sub_fields' => $fields,
			'min' => '',
			'max' => '',
			);

		return $fields_base;
	}

	public function set_field($widget,$fields){

		$fields_return = array();

		if(!empty($fields)){

			$icon = $fields['icon'];
			unset($fields['icon']);

			// var_dump($fields);
			foreach ($fields as $key_field => $field) {

				$field['icon'] = $icon;

				if(empty($field['icon'])){
					$field['icon'] = 'fa fa-cube';
				}

				$field['wrapper']['class'] = $field['wrapper']['class'].' '.$field['icon'];

				$fd = $field;

				$key_field_name = $key_field;

				$key_field = explode('__',$key_field);

				$dir = plugin_dir_path( __FILE__ ).'fields/'.$key_field[0].'.php';
				if(file_exists($dir)){
					include $dir;
				}

				if($key_field[0]=='repeater'){

					if(empty($key_field[1])){
						$key_field[1] = rand(100,1000);
					}

					$fd = get_fields_acf_widgets::sub_fields($fd,$key_field[1]);
				}

				$fields_return[] = array_merge($field,$fd);

				$icon = 'not-icon';

			}

		}

		return $fields_return;

	}

	public function sub_fields($fd,$parent){

		$subs_fields = array();

		foreach ($fd['sub_fields'] as $key_sub => $sub) {

			$key_field_name = $parent.'_sub_'.$key_sub;

			$key_sub = explode('__',$key_sub);

			$dir = plugin_dir_path( __FILE__ ).'fields/'.$key_sub[0].'.php';
			if(file_exists($dir)){
				include $dir;
			}

			if(!empty($field)){

				$subs_fields[] = array_merge($field,$sub);
			}
		}

		$fd['sub_fields'] = $subs_fields;

		foreach ($fd['sub_fields'] as $key_k_sub => $field) {

			if($field['type']=='repeater'){

				if(empty($key_sub[1])){
					$key_sub[1] = rand(100,1000);
				}

				$fd['sub_fields'][$key_k_sub] = get_fields_acf_widgets::sub_fields($field,$key_sub[1]);

			}

		}


		return $fd;

	}

}

?>