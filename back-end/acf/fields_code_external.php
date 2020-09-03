<?php

include_once('WidgetsLocation.php');

$location = new WidgetsLocation;

$widgets = $location->get_codes();

$fields = array();

$label_index = 'index.php';
if(function_exists('\App\template') || function_exists('\Roots\view')){
    $label_index = 'index.blade.php - <b>Utiliza o Template Engine <a href="https://laravel.com/docs/7.x/blade" target="_blank">Blade<a></b>';
}

foreach ($widgets as $key => $widget) {

    $fields[] = array(
        'key' => 'field_aba_'.$key,
        'label' => $widget['title'].'<span class="aba_widgets_acf_delete">X</span>',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'placement' => 'left',
        'endpoint' => 0,
    );

    $fields[] = array(
        'key' => 'field_group_'.$key,
        'label' => $widget['title'],
        'name' => 'widget_'.$key,
        'type' => 'group',
        'instructions' => 'Cuidado para não inserir código impeditivos de funcionamento do wordpress como <b>die(); break();</b><br><br><div class="acf-button-group"><label class="selected" style="padding: 7px 10px;" onclick="javascript:window.open(\''.admin_url('post-new.php?post_type=acf-field-group&location_widget_acf='.$key).'\',\'_blank\');"">Adicionar Campos no ACF</label></div> | Utilize o <a href="'.admin_url('edit.php?post_type=acf-field-group&page=acf-tools').'" target="_blank">Generate PHP</a> para exportar seus campos na aba <b>PHP</b>',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => 'acf-code-external',
            'id' => '',
        ),
        'layout' => 'block',
        'sub_fields' => array(
            array (
                'key' => 'field_name_'.$key,
                'label' => 'Nome do widget',
                'name' => 'name',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '40%',
                    'class' => '',
                    'id' => '',
                    ),
                'default_value' => $widget['name'],
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                ),
            array(
                'key' => 'field_capa_'.$key,
                'label' => 'Imagem de capa',
                'name' => 'capa_imagem',
                'type' => 'image',
                'instructions' => '<img src="'.$widget['capa'].'" style="height:75px; position: absolute; right: 0; top: -10px;" />',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '60%',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_estilo_'.$key,
                'label' => 'Estilo',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_style_'.$key,
                'label' => 'style.scss',
                'name' => 'style',
                'type' => 'textarea',
                'instructions' => 'utilize a classe <code>.widget-acf.'.str_replace('_','-', $key).' {}</code> para criar somente no widget',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => $widget['style'],
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_template_'.$key,
                'label' => 'Template',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_index_'.$key,
                'label' => $label_index,
                'name' => 'index',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => $widget['index'],
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_tab_javascript_'.$key,
                'label' => 'Javascript',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_javascript_'.$key,
                'label' => 'app.js',
                'name' => 'app',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => $widget['js'],
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_php_'.$key,
                'label' => 'PHP',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_functions_'.$key,
                'label' => 'functions.php',
                'name' => 'functions',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => $widget['functions'],
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
        ),
    );
}

acf_add_local_field_group(array(
    'key' => 'group_widgets_all',
    'title' => 'Todos os widgets',
    'fields' => $fields,
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-todos-os-widgets',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));

acf_add_local_field_group(array(
    'key' => 'group_salvar_widget_acf',
    'title' => 'Adicionar widget',
    'fields' => array(
        array(
            'key' => 'field_salvar_widget_acf',
            'label' => 'Título do widget',
            'name' => 'salvar_widget_acf',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
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
        array(
            'key' => 'field_button_salvar_widget_acf',
            'label' => 'Clique em salvar para criar um novo widget',
            'name' => 'button_salvar_widget_acf',
            'type' => 'button_group',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => 'external-field-save',
                'id' => '',
            ),
            'choices' => array(
                'Salvar' => 'Salvar',
            ),
            'allow_null' => 0,
            'default_value' => '',
            'layout' => 'horizontal',
            'return_format' => 'value',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-todos-os-widgets',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'acf_after_title',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));
