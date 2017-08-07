<?php
Class post_unico {

	static function set_fields(){

		$fields = array (
			'key' => 'post_unico_key',
			'name' => 'post_unico',
			'label' => 'Post único',
			'display' => 'line',
			'sub_fields' => array (
				array (
					'key' => 'field_select_post_unico',
					'label' => 'Selecione o post',
					'name' => 'select_post',
					'type' => 'select',
					'instructions' => 'Selecione apenas 1 POST de destaque',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'choices' => post_unico::get_posts(),
					'default_value' => array (
						),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 1,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
					),
				),
			'min' => '',
			'max' => '',
			);

		return $fields;
	}

	static function get_posts(){
		$posts = get_posts(array('post_type'=>'post','posts_per_page'=>100,'order'=>'DESC','orderby'=>'post_date'));

		$posts_arr = array();
		foreach ($posts as $key => $post) {
			$date_post = date('d/m/Y',strtotime($post->post_date));
			$posts_arr[$post->ID] = $date_post.' - '.$post->post_title;
		}

		return $posts_arr;
	}

	static function post_content($fields){
		$post = get_post($fields['field_select_post_unico']);

		$term = '';
		$term = wp_get_post_terms($fields['field_select_post_unico'],'category');
		$color = get_field('cor_padrao',$term[0]);
		if($term){ $term = $term[0]->name; }


		$thumb_widget = get_the_post_thumbnail_url($post->ID, 'size_widget');

		return array('post'=>$post,'term'=>$term,'thumb'=>$thumb_widget,'color'=>$color);
	}

}
?>