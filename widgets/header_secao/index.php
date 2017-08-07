<?php $post = header_secao::get_post($fields['field_select_secao_line']); ?>
<div class="column is-12 column-archive <?php echo $show_mobile; ?>" data-archive="viva-melhor">
	<a href="<?php echo get_permalink( $post->ID ); ?>">
		<div class="viva-melhor">
			<h1><?php echo $post->post_title; ?></h1>
			<hr style="background:<?php echo $post->color; ?>;">
		</div>
	</a>
</div>