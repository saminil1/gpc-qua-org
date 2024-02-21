var page_set = new Array();

page_set['view_icon_pre'] = "<img src='/_img/ico_view_icon_pre.gif' style='vertical-align:middle' />";	//이전페이지 
page_set['view_icon_nxt'] = "<img src='/_img/ico_view_icon_nxt.gif' style='vertical-align:middle' />";	//다음페이지
page_set['view_icon_last'] = "<img src='/_img/ico_view_icon_last.gif' style='vertical-align:middle' />";	//다음 10페이지
page_set['view_icon_frist'] = "<img src='/_img/ico_view_icon_frist.gif' style='vertical-align:middle' />";	//이전 10페이지


function Set_board_paging()
{ 

	var tot_page, first_page, last_page, direct_page;
	var prev_block, next_block;
	var show_P_page, show_page, show_N_page, show_P_B_page, show_N_B_page, show_P_O_page, show_N_O_page;
	
	var chk_javascript;
	
	tot_page = Math.ceil( page_set['tot'] / page_set['one_page'] );
	show_P_page = show_N_page = show_P_B_page = show_N_B_page = show_P_O_page = show_N_O_page = show_page = "";

	prev_block = Math.ceil(tot_page / page_set['one_block']);
	next_block = Math.ceil(page_set['now_page'] / page_set['one_block']);
	
	prev_page_b = Math.ceil(page_set['now_page'] / page_set['one_block']) * 10 - (page_set['one_block']*2-1);
	next_page_b = Math.ceil(page_set['now_page'] / page_set['one_block']) * 10 + 1;
	
	prev_page_o = page_set['now_page'] - 1;
	next_page_o = page_set['now_page'] + 1;
	
	first_page = ( next_block - 1 ) * page_set['one_block'] + 1;
	last_page = (prev_block <= next_block) ? tot_page : next_block * page_set['one_block'];

	if( first_page < 1 ) first_page = 1;
	if( last_page > tot_page ) last_page = tot_page;
	
	if( prev_page_b < 0 ) prev_page_b = 0;
	if( next_page_b > tot_page ) next_page_b = tot_page;
	
	if( prev_page_o < 0 ) prev_page_o = 0;
	if( next_page_o > tot_page ) next_page_o = tot_page;

	for (direct_page = first_page; direct_page <= last_page; direct_page++)
	{
		if (direct_page == page_set['now_page']) 
		{
			show_page += page_set['style_NowPageP'] +"&nbsp" +  direct_page + "&nbsp;" + page_set['style_NowPageN']; 
		}
		else 
		{
			//	loading_board( type, code, no, page, q, s)
			show_page += "<a style='cursor:pointer' onClick=\"Go_page( '" + direct_page + "' );\" " + page_set['style_A_tag'] + " >&nbsp;" + direct_page + "&nbsp;</a>"; 
		}
	}
	
	if (last_page < tot_page)
	{
		show_N_page = "&nbsp;&nbsp;<a style='cursor:pointer' onClick=\"Go_page( '" + tot_page + "' );\" " + page_set['style_A_tag'] + " >&nbsp;" + page_set['view_icon_last'] + "&nbsp;</a>"; 
	}

	if (prev_page_b >= 1)
	{
		show_P_B_page = "<a style='cursor:pointer' onClick=\"Go_page(  '" + prev_page_b + "' );\" " + page_set['style_A_tag'] + " title='이전 10페이지'>" + page_set['view_icon_frist'] + "</a>&nbsp;";
	}

	if (next_page_b < tot_page)
	{
		show_N_B_page = "&nbsp;<a style='cursor:pointer' onClick=\"Go_page( '" + next_page_b + "' );\" " + page_set['style_A_tag'] + "  title='다음 10페이지'>" + page_set['view_icon_last'] + "</a>"; 
	}

	if (page_set['now_page'] > 1)
	{
		show_P_O_page = "<a style='cursor:pointer' onClick=\"Go_page(  '" + prev_page_o + "' );\" " + page_set['style_A_tag'] + "  title='이전페이지'>" + page_set['view_icon_pre'] + "</a>";
	}

	if (page_set['now_page'] < tot_page)
	{
		show_N_O_page = "<a style='cursor:pointer' onClick=\"Go_page( '" + next_page_o + "' );\" " + page_set['style_A_tag'] + "   title='다음페이지'>" + page_set['view_icon_nxt'] + "</a>"; 
	}

	return show_P_B_page + show_P_O_page + show_page + show_N_O_page + show_N_B_page;

}

