var page_set = new Array();

page_set['style_NowPageP'] = "<a class='on'>";
page_set['style_NowPageN'] = "</a>";
page_set['view_icon_pre'] = "";
page_set['view_icon_nxt'] = "";
page_set['view_icon_last'] = "";
page_set['view_icon_frist'] = "";
page_set['style_A_tag'] = " class=''";
page_set['return_val'] = "P";
page_set['onepage_select'] = "";


function setPaging() {

	var tot_page, first_page, last_page, direct_page;
	var prev_block, next_block;
	var show_P_page, show_page, show_N_page, show_P_B_page, show_N_B_page, show_P_O_page, show_N_O_page;
	var show_one_page_select;
	var chk_javascript;

	tot_page = Math.ceil( page_set['tot'] / page_set['one_page'] );
	show_P_page = show_N_page = show_P_B_page = show_N_B_page = show_P_O_page = show_N_O_page = show_page = "";

	prev_block = Math.ceil(tot_page / page_set['one_block']);
	next_block = Math.ceil(page_set['now_page'] / page_set['one_block']);

	prev_page_b = Math.ceil(page_set['now_page'] / page_set['one_block']) * page_set['one_block'] - (page_set['one_block']*2-1);
	next_page_b = Math.ceil(page_set['now_page'] / page_set['one_block']) * page_set['one_block'] + 1;

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

	for (direct_page = first_page; direct_page <= last_page; direct_page++) {
		if (direct_page == page_set['now_page']) {
			show_page += page_set['style_NowPageP'] +"&nbsp" +  direct_page + "&nbsp;" + page_set['style_NowPageN'];
		} else {
			//	loading_board( type, code, no, page, q, s)
			show_page += "<a onClick=\"goPage( '" + direct_page + "' );\" " + page_set['style_A_tag'] + " >&nbsp;" + direct_page + "&nbsp;</a>";
		}
	}

	if (last_page < tot_page) {
		show_N_page = "<a onClick=\"goPage( '" + tot_page + "' );\" " + page_set['style_A_tag'] + " >&nbsp;" + page_set['view_icon_last'] + "&nbsp;</a>";
	}

	if (prev_page_b >= 1) {
		show_P_B_page = "<a onClick=\"goPage(  '" + prev_page_b + "' );\" class='pprev fa fa-angle-double-left' aria-hidden='true' title='이전 10페이지'></a>";
	}

	if (next_page_b < tot_page) {
		show_N_B_page = "<a onClick=\"goPage( '" + next_page_b + "' );\" class='nnext fa fa-angle-double-right' aria-hidden='true' title='다음 10페이지'></a>";
	}

	if (page_set['now_page'] > 1) {
		show_P_O_page = "<a onClick=\"goPage(  '" + prev_page_o + "' );\"   class='prev fa fa-angle-left' aria-hidden='true' title='이전페이지'></a>";
	}

	if (page_set['now_page'] < tot_page) {
		show_N_O_page = "<a onClick=\"goPage( '" + next_page_o + "' );\"  class='next fa fa-angle-right' aria-hidden='true'  title='다음페이지'></a>";
	}

	if( page_set['onepage_select'] == "Y" ) {
		show_one_page_select = "<span>";
		show_one_page_select += "<select name=\"opn\" onchange=\"setOnePageNum( this.value )\">";
		show_one_page_select += "<option value=\"20\">20개씩 보기</option>";
		show_one_page_select += "<option value=\"30\">30개씩 보기</option>";
		show_one_page_select += "<option value=\"50\">50개씩 보기</option>";
		show_one_page_select += "<option value=\"100\">100개씩 보기</option>";
		show_one_page_select += "<option value=\"300\">300개씩 보기</option>";
		show_one_page_select += "<option value=\"500\">500개씩 보기</option>";
		show_one_page_select += "</select>";
		show_one_page_select += "</span>";
	}

//	document.writeln(show_P_B_page + show_P_O_page + show_page + show_N_O_page + show_N_B_page);



	if( page_set['return_val'] == "V" || page_set['return_val'] == "VPOP" || page_set['return_val'] == "VINL" )
		return show_P_B_page + show_P_O_page + show_page + show_N_O_page + show_N_B_page + show_one_page_select;
	else
		document.writeln(show_P_B_page + show_P_O_page + show_page + show_N_O_page + show_N_B_page);

}

function setOnePageNum( i_NUM ) {
	if( page_set['return_val'] == "V" ) {
		var params = getParams();
		params.opn = i_NUM;
		console.log(params);
		setParams(params);
		$('.tb_wrap').scrollTop(0);
	} else if( page_set['return_val'] == "VPOP" ) {
		setOnePageNumPop( i_NUM );
	} else if( page_set['return_val'] == "VINL" ) {
		setOnePageNumInline( i_NUM );
	}
}

function goPage( i_PG ) {
	if( page_set['return_val'] == "V" ) {

		var params = getParams();
		params.pg = i_PG;
		console.log(params);
		setParams(params);
	} else if( page_set['return_val'] == "VPOP" ) {

		goPagePop( i_PG );

	} else if( page_set['return_val'] == "VINL" ) {

		goPageInline( i_PG );


	} else {

		var t_qry = location.search.substring(1);
		t_qry = t_qry.replace(/pg=[0-9]+/,'');

		if( t_qry && t_qry.substring(0,1) != '&' )
		{
			t_qry = '&'+t_qry;
		}
		replaceUrl("?pg="+ i_PG + t_qry);

	}
}


function setPagingIn(tot, one_page, one_block, now_page, onepage_select, refer) {

	var tot_page, first_page, last_page, direct_page;
	var prev_block, next_block;
	var show_P_page, show_page, show_N_page, show_P_B_page, show_N_B_page, show_P_O_page, show_N_O_page;
	var show_one_page_select;
	var chk_javascript;

	tot_page = Math.ceil( tot / one_page );
	show_P_page = show_N_page = show_P_B_page = show_N_B_page = show_P_O_page = show_N_O_page = show_page = "";

	prev_block = Math.ceil(tot_page / one_block);
	next_block = Math.ceil(now_page / one_block);

	prev_page_b = Math.ceil(now_page / one_block) * one_block - (one_block*2-1);
	next_page_b = Math.ceil(now_page / one_block) * one_block + 1;


	prev_page_o = now_page - 1;
	next_page_o = now_page + 1;

	first_page = ( next_block - 1 ) * one_block + 1;
	last_page = (prev_block <= next_block) ? tot_page : next_block * one_block;

	if( first_page < 1 ) first_page = 1;
	if( last_page > tot_page ) last_page = tot_page;

	if( prev_page_b < 0 ) prev_page_b = 0;
	if( next_page_b > tot_page ) next_page_b = tot_page;

	if( prev_page_o < 0 ) prev_page_o = 0;
	if( next_page_o > tot_page ) next_page_o = tot_page;

	for (direct_page = first_page; direct_page <= last_page; direct_page++) {
		if (direct_page == now_page) {
			show_page +="<a class='on'>&nbsp" +  direct_page + "&nbsp;</a>";
		} else {
			//	loading_board( type, code, no, page, q, s)
			show_page += "<a onClick=\"goPageIn( '" + direct_page + "', '"+refer+"' );\"  >&nbsp;" + direct_page + "&nbsp;</a>";
		}
	}

	if (last_page < tot_page) {
		show_N_page = "<a onClick=\"goPageIn( '" + tot_page + "', '"+refer+"' );\"  >&nbsp;&nbsp;</a>";
	}

	if (prev_page_b >= 1) {
		show_P_B_page = "<a onClick=\"goPageIn(  '" + prev_page_b + "', '"+refer+"' );\" class='pprev fa fa-angle-double-left' aria-hidden='true' title='이전 10페이지'></a>";
	}

	if (next_page_b < tot_page) {
		show_N_B_page = "<a onClick=\"goPageIn( '" + next_page_b + "', '"+refer+"' );\" class='nnext fa fa-angle-double-right' aria-hidden='true' title='다음 10페이지'></a>";
	}

	if (now_page > 1) {
		show_P_O_page = "<a onClick=\"goPageIn(  '" + prev_page_o + "', '"+refer+"' );\"   class='prev fa fa-angle-left' aria-hidden='true' title='이전페이지'></a>";
	}

	if (now_page < tot_page) {
		show_N_O_page = "<a onClick=\"goPageIn( '" + next_page_o + "', '"+refer+"' );\"  class='next fa fa-angle-right' aria-hidden='true'  title='다음페이지'></a>";
	}

	if( onepage_select == "Y" ) {
		show_one_page_select = "<span>";
		show_one_page_select += "<select name=\"opn\" onchange=\"setOnePageNumIn( this.value, '"+refer+"' )\">";
		show_one_page_select += "<option value=\"20\">20개씩 보기</option>";
		show_one_page_select += "<option value=\"30\">30개씩 보기</option>";
		show_one_page_select += "<option value=\"50\">50개씩 보기</option>";
		show_one_page_select += "<option value=\"100\">100개씩 보기</option>";
		show_one_page_select += "<option value=\"300\">300개씩 보기</option>";
		show_one_page_select += "<option value=\"500\">500개씩 보기</option>";
		show_one_page_select += "</select>";
		show_one_page_select += "</span>";
	}

	return show_P_B_page + show_P_O_page + show_page + show_N_O_page + show_N_B_page + show_one_page_select;

}

function setOnePageNumIn( i_NUM, c_REFER ) {
	if( c_REFER == "inline" ) {
		setOnePageNumInline( i_NUM );
	} else if( c_REFER == "pop" ) {
		setOnePageNumPop( i_NUM );
	}

}

function goPageIn( i_PG, c_REFER ) {
	if( c_REFER == "inline" ) {
		goPageInline( i_PG );
	} else if( c_REFER == "pop" ) {
		goPagePop( i_PG );
	}
}
