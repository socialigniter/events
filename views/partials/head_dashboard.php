<style type="text/css">
#calendar {
	width: 900px;
	margin: 0;
}

table.calendar {
	width: 900px;
	margin: 0;
	border-collapse: collapse;
}

table.calendar th {
	padding: 0 0 15px 0;
}

#calendar_date_heading {
	margin: 0 15px;
	font-weight: bold;
	font-size: 18px;
	color: #333333;
	text-shadow: 1px 1px 1px #ffffff;
}

#calendar_day_heading {
	width: 75px;
	margin: 0 auto 0 30px;
	display: block;
	font-size: 12px;
	line-height: 12px; 
	color: #999;
	text-align: center;
}

td.day {	
	width: 128px; 
	height: 130px; 
	overflow: hidden;
	border: 1px solid #c3c3c3;
	vertical-align: top;
	text-align: left;
	padding: 0;
}

div.day_normal {
	width: 128px; 
	height: 130px; 
	color: #333333;
}

div.day_normal_hover {
	background-color: #f4f3f3;
}

div.day_normal_click {
	background-color: #e3e3e3;
}

div.day_today {
	width: 128px; 
	height: 130px; 
	background: #d6e3f0;
}

div.day_today_hover {
	background-color: #d6e3f0;
}

div.day_num {
	text-align: right;
	padding: 8px 8px 6px 0;
	text-shadow: 1px 1px 1px #fff;
}

div.day_event {
	color: #2078ce;
	padding: 3px 5px;
	margin: 0 3px;
	cursor: pointer;
}

div.day_event:hover {
	background: #2078ce;
	color: #F6F6F6;
	padding: 3px 5px;
	border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px;	
}	

/* Add */
#event_create {
	display: none;
	border-radius: 10px;  -webkit-border-radius: 10px; -moz-border-radius: 10px;
}
#event_create br {

}

#event_create_form {
}

#event_create_error {
	display: none;
}

input.event_create_date {
	width: 83px;
}

input.event_create_time {
	width: 63px;
}

#event_add_description {
	display: none;
}

</style>

<script type="text/javascript">
$(document).ready(function()
{
	$(".day").click(function()
	{
		var day_click = $(this).find('.day_num').html();
		
		if (day_click.length == 1)
		{
			day_click = '0'+day_click;
		}

		var date_start		= $('#event_create_date_start').val();
		var date_end		= $('#event_create_date_end').val();		
		var date_split		= date_start.split('/');
		var month			= date_split[0];
		var day				= date_split[1];
		var year			= date_split[2];
			
		$('#event_create_date_start').val(month + '/' + day_click + '/' + year);
		$('#event_create_date_end').val(month + '/' + day_click + '/' + year);
		
		$.fancybox.resize();

		$.fancybox({
			'autoScale'			: false,
			'autoDimensions'	: false,
			'scrolling'			: 'no',
			'cache'				: false,
			'href'				: '#event_create_form',
			'width'				: 350,
			'height'			: 500,
			'titleShow'			: false,
			'disableNavButtons' : true,
			'onClosed'			: function()
			{
			    $("#event_create_error").hide();
			}
		});	
	});

		
	$("#event_create_form").bind("submit", function()
	{
	
		if ($("#event_create_title").val().length < 1 || $("#event_create_date_start").val().length < 1) {
		    $("#event_create_error").show();
		    $.fancybox.resize();
		    return false;
		}
	
		$.fancybox.showActivity();
	
		$.ajax({
			type	: 'POST',
			cache	: false,
			url		: base_url + '/home/events/add',
			data	: $(this).serialize(),
			success : function(data)
			{
				$.fancybox.close();

				//$('#day_event-'+day).append(data).show('slow');
			
				$('#create_debug_log').append(data)
			}		
		});
	
		return false;
	});	
	
	$(".more_lightbox").bind("click", function()
	{
		var show_pannel = $(this).attr('href');

		$(this).hide('fast');
				
		$('#'+show_pannel).show('fast');
	
		$.fancybox.resize();
		
		return false;
		
	});	
		
		
	
	// Day Hover
	$('.day_normal').mouseenter(function() 
	{		
		$(this).addClass('day_normal day_normal_hover');
	});    
	$('.day_normal').mouseleave(function() 
	{
		$(this).removeClass('day_normal_hover');
	});
	
	// Day Click
	$('.day_normal').click(function() 
	{		
		$(this).addClass('day_normal day_normal_click');
	});    
	$('.day_normal').mouseleave(function() 
	{
		$(this).removeClass('day_normal_click');
	});


	

		
	// Placeholders	
	doPlaceholder('#event_create_title', 'Event Title');
	doPlaceholder('#event_create_description', 'More info...');
	
});
</script>
