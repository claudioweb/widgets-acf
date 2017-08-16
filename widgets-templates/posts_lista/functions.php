<?php

$fields['icon'] = 'fa fa-list-ul';

$fields['select']['label'] = 'Selecione os posts';
$fields['select']['choices'] = post_lista_widgets_acf::get_posts();
$fields['select']['multiple'] = 1;

Class post_lista_widgets_acf {

	public function get_posts(){
		
		$posts_return = array();

		$args = array('posts_per_page'=>-1,	'order'=>'ASC', 'orderby'=>'post_date');

		$posts = get_posts($args);

		foreach ($posts as $key => $post) {
			$posts_return[$post->ID] = $post->post_title;
		}

		return $posts_return;
	}
	
}

?>