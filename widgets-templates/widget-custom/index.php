<!-- <pre><?php var_dump($fields); die(); ?> -->
<div class="row">
	<div class="col-sm-12">
		<div class="image_widget_custom">
			<?php $img = $fields['field_image_widget_custom_key']; ?>
			<?php if(!empty($img)): ?>

				<?php $img = $img['sizes']['medium']; ?>

				<img src="<?php echo $img; ?>" class="img-responsive" alt="<?php echo $fields['field_text_widget_custom_key']; ?>">
			<?php endif; ?>
			<div class="caption_widget_custom" 
			style="background: <?php echo $fields['field_color_picker_widget_custom_key']; ?>;">
			<a href="<?php echo $fields['field_text__1_widget_custom_key']; ?>">
				<?php echo $fields['field_text_widget_custom_key']; ?>
			</a>
		</div>
	</div>
</div>
</div>