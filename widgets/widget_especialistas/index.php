<?php 
$especialistas = widget_especialistas::get_especialistas($fields);
$cor = $fields['field_cor_especialistas'];
?>
<div class="column is-12 <?php echo $show_mobile; ?>">
	<div class="experts-list" data-category="viva-melhor">
		<div class="experts-title">
			<a href="<?php echo site_url('especialistas'); ?>">
				<p style="background:<?php echo $cor; ?>;">Especialistas</p>
			</a>
		</div>
		<div class="columns experts-columns ">

			<?php foreach ($especialistas as $key => $especialista) : ?>
				<div class="column">
					<article class="media">
						<figure class="media-left">
							<p class="image">
								<a href="<?php echo site_url('especialistas?author='.$especialista['slug']); ?>">
									<img src="<?php echo $especialista['thumb']; ?>" class="image-rounded">
								</a>
							</p>
						</figure>
						<div class="media-author">
							<a href="<?php echo site_url('especialistas?author='.$especialista['slug']); ?>">
								<span class="fa fa-quote-left" data-category="viva-melhor" style="color:<?php echo $cor; ?>"></span>
								<p><?php echo $especialista['nome']; ?></p>
							</a>
						</div>
						<div class="media-content">
							<a href="<?php echo get_permalink($especialista['post_id']); ?>">
								<p class="media-category" data-category="viva-melhor" style="color:<?php echo $cor; ?>">
									<?php echo $especialista['categoria']; ?>
								</p>
								<p class="media-title"><?php echo $especialista['post']; ?></p>
							</a>
						</div>
					</article>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
</div>