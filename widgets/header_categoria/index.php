<?php $term = header_categoria::get_term($fields['field_select_categoria_line']); ?>
<div class="column is-12 column-archive <?php echo $show_mobile; ?>" data-archive="viva-melhor">
	<a href="<?php echo get_term_link( $term, 'category'); ?>">
		<div class="viva-melhor">
			<h1><?php echo $term->name; ?></h1>
			<hr style="background:<?php echo $term->color; ?>;">
		</div>
	</a>
</div>