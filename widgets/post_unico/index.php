<?php $content = post_unico::post_content($fields); ?>
<div class="column is-4 <?php echo $show_mobile; ?>">
	<a href="<?php echo get_permalink($content['post']->ID); ?>" rel="bookmark" title="<?php echo $content['post']->post_title; ?>">
		<div style="background-image: url('<?php echo $content['thumb']; ?>')" class="post-single" data-archive="viva-melhor">
			<div class="post-content" style="background:<?php echo $content['color']; ?>;">
				<div class="post-category">
					<p><?php echo $content['term']; ?></p>
				</div>
				<div class="post-title">
					<h1><?php echo $content['post']->post_title; ?></h1>
				</div>

				<div class="post-excerpt">
					<p><?php echo $content['post']->post_excerpt; ?></p>

					<button type="button" class="button button-default" style="color:<?php echo $content['color']; ?>;">Continuar lendo <span class="fa fa-caret-right"></span></button>
				</div>
			</div>
		</div>
	</a>
</div>