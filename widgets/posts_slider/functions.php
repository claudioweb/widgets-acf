<?php
Class posts_slider {

	static function set_fields(){

		$fields = array (
			'key' => 'posts_slider_key',
			'name' => 'posts_slider',
			'label' => 'Slide de posts',
			'display' => 'line',
			'sub_fields' => array (
				array (
					'key' => 'field_select_posts_slide',
					'label' => 'Selecione os posts',
					'name' => 'select_posts',
					'type' => 'select',
					'instructions' => 'Quantidade determinada pelo layout',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'choices' => posts_slider::get_posts(),
					'default_value' => array (
						),
					'allow_null' => 0,
					'multiple' => 1,
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

	static function list_posts($fields){
		$posts_ids = $fields['field_select_posts_slide'];
		$args = array(
			'post__in' => $posts_ids,
			'orderby' => 'post__in'
			);

		$posts = get_posts($args);
		foreach ($posts as $key => $post) {
			$term = '';
			$term = wp_get_post_terms($post->ID,'category');

			$post->color = get_field('cor_padrao',$term[0]);


			$post->term_id = $term[0]->term_id;
			if($term){ $term = $term[0]->name; }

			$post->term = $term;

			$post->thumb = get_the_post_thumbnail_url($post->ID, 'size_widget');
		}
		
		return $posts; 
	}

}
?>