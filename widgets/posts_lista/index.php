<?php $posts = posts_lista::list_posts($fields); ?>
<div class="column is-4 <?php echo $show_mobile; ?> post-group">
	<?php foreach ($posts as $key => $post) : if($key==3){break;} ?>
		<div class="columns is-multiline is-mobile">
			<div class="column is-5">
				<a href="<?php echo get_permalink($post->ID); ?>" rel="bookmark">
					<div class="post-image">
						<!-- Não esquecer do ALT da imagem - importante para acessibilidade -->
						<?php echo get_the_post_thumbnail($post->ID, 'size_widget_thumb'); ?>
					</div>
				</a>
			</div>
			<div class="column is-7">
				<a href="<?php echo get_term_link($post->term_id,'category'); ?>">
					<div class="post-category">
						<!--
							- As categorias de cores são as mesmas apresentadas no site
							- viva-melhor, alimentacao, corpo e emagrecimento.
						-->
						<span class="viva-melhor" style="color:<?php echo $post->color ?>;"><?php echo $post->term; ?></span>
					</div>
				</a>
				<a href="<?php echo get_permalink($post->ID); ?>" rel="bookmark">
					<div class="post-title">
						<p><?php echo $post->post_title; ?></p>
					</div>
				</a>
			</div>
			<div class="column is-12 post-divider">
				<div class="divider">
					<hr>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>