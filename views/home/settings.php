<form name="blog_settings" method="post" action="<?= base_url() ?>home/blog/settings" enctype="multipart/form-data">
	
	<h3>Events</h3>

	<p>Display Categories
	<?= form_dropdown('categories_display', config_item('yes_or_no'), $categories_display) ?>
	</p>

	<p>Display Tags
	<?= form_dropdown('tags_display', config_item('yes_or_no'), $tags_display) ?>
	</p>	

	<p>URL
	<?= form_dropdown('url_style', config_item('url_style_types'), $url_style) ?>
	</p>

	<p>Date
	<?= form_dropdown('date_style', config_item('date_style_types'), $date_style) ?>
	</p>

	<p>Abbreviate
	<?= form_dropdown('abbreviate_post', config_item('yes_or_no'), $abbreviate_post) ?>
	<input type="text" size="4" name="abbreviate_length" value="<?= $abbreviate_length ?>" /> characters
	</p>

	<p>Events Per-Page
	<?= form_dropdown('events_per_page', config_item('amount_increments_all'), $events_per_page) ?>
	</p>
	
	<div class="content_line"></div>	
		
	<h3>Comments</h3>	

	<p>Allow
	<?= form_dropdown('comments_allow', config_item('yes_or_no'), $comments_allow) ?>
	</p>

	<p>Comments Per-Page
	<?= form_dropdown('comments_per_page', config_item('amount_increments_five'), $comments_per_page) ?>
	</p>

	<p><input type="submit" name="save" value="Save" /></p>

</form>

