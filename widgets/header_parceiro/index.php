<?php $post = header_parceiro::get_post($fields['field_select_parceiro_line']); ?>
<div class="column is-12 column-archive <?php echo $show_mobile; ?>" data-archive="viva-melhor">
	<a href="<?php echo get_permalink( $post->ID ); ?>">
		<div class="viva-melhor">
			<div class="sponsor-image">
				<img src="<?php echo $post->thumb['sizes']['logo_medium']; ?>" alt="<?php echo $post->post_title; ?>">
			</div>

			<div class="sponsor-social" style="display:none;">
				<ul style="color: #FFF;">
					<?php foreach ($post->redes as $key => $rede) : ?>
						<li>
							<a href="<?php echo $rede['link_rede_parceiro'] ?>" target="_blank" 
								style="background-color: <?php echo $post->color; ?>;">
								<span class="<?php echo $rede['rede_social_parceiro']; ?>"></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<hr style="background:<?php echo $post->color; ?>;">

		</div>
	</a>
</div>