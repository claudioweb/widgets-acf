<?php 

Class widget_custom {
	
	static function set_fields(){

		$fields = array (
			'key' => 'widget_custom_key',
			'name' => 'widget_custom',
			'label' => 'Widget Custom',
			'display' => 'line',
			'sub_fields' => array (
				array (
					'key' => 'field_custom_img',
					'label' => 'Imagem fundo',
					'name' => 'custom_imagem_fundo',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'return_format' => 'url',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
					),
				array (
					'key' => 'field_cor_widget',
					'label' => 'Cor padrão',
					'name' => 'cor_widget',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'default_value' => '#ee434c',
					),
				array (
					'key' => 'field_custom_titulo',
					'label' => 'Título',
					'name' => 'custom_titulo',
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
					'key' => 'field_custom_link',
					'label' => 'Link',
					'name' => 'custom_link',
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
					'maxlength' => ''
					)
				)
			);

				return $fields; 
			}


		}

		?>