<?php 

$sub_fields[] = array(
			'key' => 'field_radio_mobile_'.$prefixed_widget,
			'label' => 'Exibir Mobile?',
			'name' => 'mobile',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
				),
			'choices' => array(1=>'Sim',0=>'Não'),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 1,
			'layout' => 'horizontal',
			'return_format' => 'value',
			);