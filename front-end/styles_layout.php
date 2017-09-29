<?php

$style_attr = array();
$style_bg = array();

$style_attr['padding'] = 'padding: '.
$layout['attr']['padding_layout_setting']['padding_top_layout_setting'].'px '.
$layout['attr']['padding_layout_setting']['padding_right_layout_setting'].'px '.
$layout['attr']['padding_layout_setting']['padding_bottom_layout_setting'].'px '.
$layout['attr']['padding_layout_setting']['padding_left_layout_setting'].'px;';

if(!empty($layout['attr']['imagem_layout_setting'])){ 

	if(is_array($img_bg)){
		$img_bg = $layout['attr']['imagem_layout_setting']['sizes']['full'];
	}else{
		$img_bg = wp_get_attachment_url($layout['attr']['imagem_layout_setting']);
	}

	$style_bg['background_image'] = 'background-image: url('.$img_bg.');';
	$style_bg['background_size'] = 'background-size: 100%;';
	$style_bg['background_repeat'] = 'background-repeat: no-repeat;';
	$style_bg['background_position'] = 'background-position: top center;';

}

$style_bg['background_color'] = 'background-color: '.$layout['attr']['cor_layout_setting'].';';

$class_setting = $layout['attr']['id_class_layout_setting']['class_layout_setting'];

$id_setting = $layout['attr']['id_class_layout_setting']['id_layout_setting'];