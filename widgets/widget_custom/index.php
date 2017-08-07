<div class="column <?php echo $show_mobile; ?>">
<?php $img = wp_get_attachment_image_src($fields['field_custom_img'],'size_widget'); ?>
<div style="background-image: url(<?php echo $img[0] ?>);" class="tape-measure" data-category="alimentacao">
		<a href="<?php echo $fields['field_custom_link']; ?>" class="button button-block button-large" style="background:<?php echo $fields['field_cor_widget']; ?>">
			<span class="fa fa-cogs"></span>
			<?php echo $fields['field_custom_titulo']; ?>
		</a>
	</div>
</div>