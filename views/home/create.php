<form id="event_create_form" method="post" action="">
    			
	<p><input type="text" id="event_create_title" name="event_title" size="30" value="" /></p>

	<p>Location<br>
		<select name="location_id">
			<option value="1">Scout Pit</option>
			<option value="2">Homestead</option>
			<option value="new">+ New Location</option>
		</select>
	</p>
	
	<p>From<br> <input type="text" id="event_create_date_start" class="event_create_date" name="date_start" value="<?= $now_date ?>"> <input class="event_create_time" type="text" name="time_start" value="<?= $start_time?>"></p>

	<p>To<br> <input type="text" id="event_create_date_end" class="event_create_date" name="date_end" value="<?= $now_date ?>"> <input class="event_create_time" type="text" name="time_end" value="<?= $end_time ?>"></p>
	
	<p><?= form_dropdown('repeat', config_item('access'), $repeat) ?></p>
	
	<p>Access<br>
	<?= form_dropdown('access', config_item('access'), $access) ?></p>
					
	<p><textarea cols="28" rows="4" id="event_create_description" name="event_description"></textarea></p>
	
	<p><input type="submit" value="Create" /></p>
	
</form>