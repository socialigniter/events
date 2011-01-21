{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

{heading_row_start}<tr>{/heading_row_start}

{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
{heading_title_cell}<th align="center" colspan="{colspan}"><span id="calendar_date_heading">{heading}</span></th>{/heading_title_cell}
{heading_next_cell}<th align="right"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

{heading_row_end}</tr>{/heading_row_end}

{week_row_start}<tr>{/week_row_start}
	{week_day_cell}<td><span id="calendar_day_heading">{week_day}</span></td>{/week_day_cell}
{week_row_end}</tr>{/week_row_end}

{cal_row_start}<tr class="days">{/cal_row_start}
	{cal_cell_start}<td class="day">{/cal_cell_start}
					
					{cal_cell_content}
					<div class="day_normal">
						<div class="day_num">{day}</div>
						<div id="day_event-{day}" class="day_event">{content}</div>
					</div>	
					{/cal_cell_content}
					
					{cal_cell_content_today}
					<div class="day_today">
						<div class="day_num">{day}</div>
						<div id="day_event-{day}" class="day_event">{content}</div>
					</div>
					{/cal_cell_content_today}
					
					{cal_cell_no_content}
					<div class="day_normal">
						<div class="day_num">{day}</div>
					</div>	
					{/cal_cell_no_content}
					
					{cal_cell_no_content_today}
					<div class="day_today">
						<div class="day_num highlight">{day}</div>
					</div>
					{/cal_cell_no_content_today}

		{cal_cell_blank}&nbsp;{/cal_cell_blank}
	{cal_cell_end}</td>{/cal_cell_end}

{cal_row_end}</tr>{/cal_row_end}
{table_close}</table>{/table_close}