<?php $posts = posts_slider::list_posts($fields); ?>
<div class="" data-script="Slider">
	<div class="slider js_slider">
		<div class="frame js_frame">
			<ul class="slides js_slides">
				<?php foreach ($posts as $key => $post) : if($key==3){break;} ?>

					<li class="js_slide">
						<div style="background-image: url('<?php echo $post->thumb; ?>');" class="post-single" data-category="viva-melhor">
							<div class="post-content" style="background:<?php echo $post->color; ?>;">
								<a href="<?php echo get_permalink($post->ID); ?>">
									<div class="post-category">
										<p><?php echo $post->term; ?></p>
									</div>
									<div class="post-title">
										<h1><?php echo $post->post_title; ?></h1>
									</div>
								</a>
							</div>
						</div>
					</li>

				<?php endforeach; ?>
			</ul>
		</div>
		<span class="js_prev prev">
			<span class="fa fa-angle-left"></span>
		</span>
		<span class="js_next next">
			<span class="fa fa-angle-right"></span>
		</span>

		<ul class="js_dots dots"></ul>
	</div>
</div>