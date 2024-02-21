var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

function fixedTable( o_OBJ ) {
	var tmp_table = o_OBJ.find('.obj_fixed_table').clone();
	o_OBJ.find('.table_head').empty().append(tmp_table);
	o_OBJ.find('.table_head > table').removeClass('obj_fixed_table').find('tbody.init').remove();
	o_OBJ.find('.table_head > table').removeClass('obj_fixed_table').find('tbody').removeAttr('id');
	o_OBJ.find('.table_head > table tbody').find('input[type=checkbox]').attr('name', 'tmp[]');
	o_OBJ.find('.obj_fixed_table > table thead').find('input[type=checkbox]').attr('name', 'chk_all_tmp');

	var th_height = o_OBJ.find('.obj_fixed_table thead').height()+1;
	var th_width = o_OBJ.find('.obj_fixed_table').width();
	o_OBJ.find('.table_head').height(th_height);
	o_OBJ.find('.table_box').width(th_width);

	o_OBJ.find('.tb_wrap').scroll( function() {
		o_OBJ.find('.table_head').css('top',o_OBJ.find('.tb_wrap').scrollTop()+'px').height(o_OBJ.find('.obj_fixed_table thead').height()+1);
	}).scrollTop(0).find("input[name='chk_all']:checkbox").prop("checked",false);

	$(window).resize(function() {
		o_OBJ.find('.table_box').width(o_OBJ.find('.tb_wrap').width());
	});
}

function getSetting() {
	$('body').addClass('loading');
	$.post( '/account/pop/setting.html', { 'RDATA' : 'SETTING' },function(d){
		$('body').append(d);
		popInit('setting');
	});
}

function setKeyLogin() { // 엔터키 함수 호출
	if( window.event.keyCode==13 ) {
		setLogin();
	}
}

function setLogin() { // 로그인

	if( document.referrer ) {
		$('form[name=loginfm]').find('[name=goto]').val(document.referrer);
	} else {
		//$('form[name=loginfm]').find('[name=goto]').val('/');
	}

	var o_CHK = inputfieldCheck( $('form[name=loginfm]') );

	if( o_CHK == true ) {

		var o_OBJ = {};
			o_OBJ = $('form[name=loginfm]').serialize();

		$.ajax({
			url: '/admin/html/_proc/put_login.php',
			data : o_OBJ,
			dataType: "json",
			type : 'POST',
			timeout : 1000,
			error : function( xhr, ajaxOptions, thrownError ) {
				alert( "오류가 발생하였습니다.\n잠시후에 시도해주세요." );
				$('body').removeClass('loading');
			},
			beforeSend: function(xhr) {
				$('body').addClass('loading');
			},
			success: function(data) {
				if( data.code == "OK" ) {
					goUrl( data.ary_data.goto );
				} else if( data.code == "ERR" ) {
					alert( data.msg );
				}
			},
			complete: function(xhr) {
				$('body').removeClass('loading');
			}
		});
	}

}

function setLogout() { // 로그아웃

	if( !confirm('로그아웃 하시겠습니까?') ) {
		return false;
	}

	var 	o_OBJ = {};
			o_OBJ['hand'] = 'logout';
			o_OBJ['goto'] = '/';

	$.ajax({
		url: '/admin/html/_proc/put_login.php',
		data : o_OBJ,
		dataType: "json",
		type : 'POST',
		timeout : 1000,
		error : function( xhr, ajaxOptions, thrownError ) {
			alert( "오류가 발생하였습니다.\n잠시후에 시도해주세요." );
			$('body').removeClass('loading');
		},
		beforeSend: function(xhr) {
			$('body').addClass('loading');
		},
		success: function(data) {

			if( data.code == "OK" ) {
				//goUrl( '/' );
				document.location.reload();
			} else if( data.code == "ERR" ) {
				alert( data.msg );
			}
		},
		complete: function(xhr) {
			$('body').removeClass('loading');
		}
	});

}

function setUploadSubmit( i_NO ) { // 첨부파일 업로드

	if( $('form[name=infofm]').find('input[name=file_hand]').val() != "" ) {
		//alert('이미지가 업로더가 작업중입니다.');
		return false;
	}

	$('form[name=infofm]').find('input[name=file_hand]').val('reg');
	$('form[name=infofm]').find('input[name=file_no]').val(i_NO);

	$('form[name=infofm]').ajaxSubmit({
			url: '/admin/html/_proc/put_file_upload.php',
			dataType:  'json',
			error : function( xhr, ajaxOptions, thrownError ) {
				alert( "잠시후 다시 시도해주세요." );
				$('body').removeClass('loading');
			},
			beforeSend: function() {
				$('body').addClass('loading');
			},
			uploadProgress: function(event, position, total, percentComplete) { },
			success: function(rdata) {

				$('form[name=infofm]').find('input[name=file_hand]').val('');

				if(rdata.code == 'OK') {
					console.log(rdata.ary_data);

					$('form[name=infofm]').find('input[name="att_file_path['+i_NO+']"]').val(rdata.ary_data.file_path_abs);
					$('form[name=infofm]').find('.obj_file_btn[data-no='+i_NO+']').empty().html('파일선택<input type="file" name="att_file['+i_NO+']" placeholder="파일을 첨부해주세요." onchange="$(this).parent().prev().val($(this).val());setUploadSubmit('+i_NO+');" >');

					if( $('form[name=infofm]').find('.obj_file_sec[data-no='+i_NO+']').length > 0 ) {
						$('form[name=infofm]').find('.obj_file_sec[data-no='+i_NO+']').attr('onclick','goWin("'+rdata.ary_data.file_path_abs+'");').addClass('is_file').text(rdata.ary_data.file_name+'.'+rdata.ary_data.file_ext);
					} else {
						if( $('form[name=infofm]').find('.obj_thum_sec[data-no='+i_NO+']').find('.obj_detail_btn').length > 0 ) {
							$('form[name=infofm]').find('.obj_thum_sec[data-no='+i_NO+']').css('background-image', 'url('+rdata.ary_data.file_path_abs+')').parent().addClass('is_thum');
							$('form[name=infofm]').find('.obj_thum_sec[data-no='+i_NO+']').find('.obj_detail_btn').attr('onclick','goWin("'+rdata.ary_data.file_path_abs+'");');
						} else {
							$('form[name=infofm]').find('.obj_thum_sec[data-no='+i_NO+']').css('background-image', 'url('+rdata.ary_data.file_path_abs+')').attr('onclick','goWin("'+rdata.ary_data.file_path_abs+'");').parent().addClass('is_thum');
						}
					}

				} else {
					alert(rdata.msg);
				}

			},
			complete: function(xhr) {
				$('body').removeClass('loading');
			}
	});

}


var charts = { // 차트 그리기

    index: function ( c_hand ) {

		var o_OBJ = {};
			o_OBJ['hand'] = c_hand;

		$.ajax({
			url: './_proc/get_main_chart.php',
			data : o_OBJ,
			dataType: "json",
			type : 'POST',
			timeout : 1000,
			error : function( xhr, ajaxOptions, thrownError ) {
				alert( "오류가 발생하였습니다.\n잠시후에 시도해주세요." );
				$('body').removeClass('loading');
			},
			beforeSend: function(xhr) {
				$('body').addClass('loading');
			},
			success: function(rdata) {

				console.log(JSON.parse(rdata.ary_data.xAxis));

				if( rdata.code == "OK" ) {

					var yy_max = undefined;
					if( parseInt(rdata.ary_data.max) > 0 ) {
						yy_max = parseInt(rdata.ary_data.max);
					}

				    $('#container_breakdown').highcharts({
				        chart: {
				            type: 'line'
				        },
				        title: {
				            text: '<font style="color:#edf2f6;font-size:15px;display:none;">일일 매출/지원금</font>'
				        },
				        subtitle: {
				            text: ''
				        },
				        xAxis: {
				            categories: JSON.parse(rdata.ary_data.xAxis),
				            gridLineWidth: 0,
				        },
				        yAxis: [{
				            min: 0,
				            labels: {
				                formatter: function () {
				                    //return this.value / 1000 + 'k';
				                    return this.value;
				                },
				                enabled: false
				            },
				            title: {
   				                enabled: false

				            }


				        }, {
				            min: 0,
				            labels: {
				                formatter: function () {
				                    //return this.value / 1000 + 'k';
									return this.value;
				                },
				                enabled: false
				            },
				            title: {
   				                enabled: false
				            },
				            opposite: true
				        }],
				        legend: {
				            shadow: false
				        },
				        tooltip: {
				            headerFormat: '<span style="font-size:12px;border-bottom:1px solid #ddd;padding-bottom:3px;margin-bottom:5px;display:block;color:#777;"><b>{point.key}</b></span>',
				            pointFormat: '<table width="130"><tr><td style="color:{series.color};padding:0;font-size:11px;">■ {series.name} </td>' +
				                '<td style="padding:0 0 0 5px;letter-spacing:normal;font-size:11px;color:#888;text-align:right;" align="right"><b>{point.y}</b></td></tr>',
				            footerFormat: '</table>',
				            shared: true,
				            useHTML: true
				        },

				        plotOptions: {
				            line: {
				                dataLabels: {
				                    enabled: false
				                },
				                enableMouseTracking: true
				            }
				        },
				        series: JSON.parse(rdata.ary_data.xValue)
				    });
				} else if( data.code == "ERR" ) {
					alert( data.msg );
				}
			},
			complete: function(xhr) {
				$('body').removeClass('loading');
			}
		});
    }
}

$(document).ready( function( ) {

	$(document).on("click", ".btn_toggle", function() {

		var t_role = $(this).attr('data-role');
		var t_opened = $(this).hasClass('opened');

		$('.btn_toggle').removeClass('opened');
		if( !t_opened ) {
			$(this).addClass('opened');
		}

	});

/*
	$(document).on("click", ".overview > li", function() {

		var t_role = $(this).attr('data-role');

		$('.overview > li').removeClass('on');
		$(this).addClass('on');
		$('.charts').attr('data-role',t_role);

	});
*/

	$(document).on("click", ".btn_main_nav", function() {

		if( $(this).parent().attr('data-type') == 'opened' ) {
			$(this).parent().parent().find('li').attr('data-type', '');
			$(this).parent().parent().find('li').find('dl').addClass('hide');
		} else {
			$(this).parent().parent().find('li').attr('data-type', '');
			$(this).parent().parent().find('li').find('dl').addClass('hide');
			$(this).parent().attr('data-type', 'opened');
			$(this).parent().find('dl').removeClass('hide');
		}
	});

	$(document).on("click", ".obj_cnts_box .tb_wrap .sort", function() {// 테이블에서 TR의 sort 방법 번경시

		var t_sort = $(this).attr('data-sort');
		var t_key = $(this).attr('data-key');

		$(this).closest(".tb_wrap").find(".sort").attr("data-sort","");

		if( !t_sort ) {
			t_sort = 'ASC';
		} else if( t_sort == "ASC" ) {
			t_sort = 'DESC';
		} else if( t_sort == "DESC" ) {
			t_sort = '';
		}

		$(this).closest(".tb_wrap").find(".sort[data-key='"+t_key+"']").attr("data-sort",t_sort);

		var params = getParams();
		if( t_sort ) {
			params.sort = t_key+" "+t_sort;
		} else {
			params.sort = '';
		}
		setParams(params);

	});

	$(document).on("click", ".btn_history_back", function() { // 뒤로가기
		window.history.go(-1);
	});

	$(document).on("change", "select[data-role=wrap]", function() { // 검색 셀렉트 옵션

		var t_val = $(this).val();
		var t_txt = $(this).find('option:selected').text();

		$('.obj_search_opt_wrap').addClass('hide');
		if( t_val == 'date' ) {
			$('.obj_search_opt_wrap[data-name=date]').removeClass('hide');
		} else {
			$('.obj_search_opt_wrap[data-name=goods]').removeClass('hide');
		}

	});

	$(document).on("change", "select[name=select_sort]", function() { // 정렬 옵션

		var t_val = $(this).val();
		$('form[name=fm_search]').find('[name=orderby]').val(t_val);
		fm_search.submit();

	});

	$(document).on("change", "select[name=appr_select]", function() { // 검수 옵션

		var t_val = $(this).val();
		$('form[name=infofm]').find('[data-type=appr_select]').val(t_val);

		var obj_return_reason = $('form[name=infofm]').find('.obj_return_reason');
		if( t_val == 16 ) {
			obj_return_reason.removeClass('hide').find('[data-type="return_reason"]').prop('required',true);
		} else {
			obj_return_reason.addClass('hide').find('[data-type="return_reason"]').prop('required',false).val('');
		}

	});

	$(document).on("click", "table input[name='chk_all']:checkbox", function() { // 리스트 전체선택
		var t_form = $(this).closest('form');

		if( $(this).prop("checked") )
			$(t_form).find("input[name='chk[]']:checkbox").prop("checked",true);
		else
			$(t_form).find("input[name='chk[]']:checkbox").prop("checked",false);
	});

	$(document).on("click", "table input[name='chk[]']:checkbox", function() { // 리스트 개별선택시 전체선택 체크

		var t_form = $(this).closest('form');

		$(t_form).find("input[name='chk[]']:checkbox").each(function(){
			if( !$(this).prop('checked') )
			{
				$(t_form).find("input[name='chk_all']:checkbox").prop("checked",false);
				return false;
			}

			$(t_form).find("input[name='chk_all']:checkbox").prop('checked',true);
		});
	});

	$( 'input[name=sdate], input[name=edate]' ).datetimepicker({ // 달력 보이기
			timepicker:false,
			format:'Y-m-d',
			lang:'kr',
	});


	$(document).on("change", "select[name=page_num]", function() { // 한페이지에 볼 목록 갯수 설정

		var t_val = $(this).val();
		$('[name=one_page_num]').val(t_val);
		fm_search.submit();

	});

	$(document).on("click", "nav.tab_submit li", function() { // 탭 메뉴 클릭시
		var t_tab = $(this).attr('data-tab');

		$('form[name=fm_search] [name=tab]').val(t_tab);

		fm_search.submit();

	});

	$(document).on("click", ".btn_user_play", function() { // 회원 활동 내역
		var t_idx = $(this).attr('data-idx');
		var t_tab = $(this).attr('data-tab');

		var t_url = 'user_play.html?idx='+t_idx;

		if( t_tab ) {
			t_url += '&tab='+t_tab
		}

		goPop(t_url, 'user_play', 1200);

	});

	$(document).on("click", ".btn_delivery_tracking_row", function() { // 목록 배송조회
		var tracking_no = $(this).attr('data-tracking');
		if( !tracking_no ) {
			alert('송장번호가 없습니다.');
			return false;
		}

		var t_url = $(this).attr('data-url');
		var n_url = t_url.replace('|trackingNo|', tracking_no);

		goPop(n_url, 'delivery_tracking');

	});

	$(document).on("click", ".btn_agency_contract", function() { // 회원 활동 내역
		var t_idx = $(this).attr('data-idx');
		var t_url = '/agency/pop/agency_contract.html?idx='+t_idx;
		goPop(t_url, 'agency_contract', 1100);
	});

	$(document).on("click", ".btn_partner_contract", function() { // 회원 활동 내역
		var t_idx = $(this).attr('data-idx');
		var t_url = '/partner/pop/partner_contract.html?idx='+t_idx;
		goPop(t_url, 'partner_contract', 1100);
	});

	$(document).on("click", ".btn_password_tmp", function() { // 임시비밀번호 발급
		var t_idx = $(this).attr('data-idx');

		if( t_idx ) {
			if( !confirm('임시비밀번호를 SMS로 전송하시겠습니까?') ) {
				return false();
			}

			var o_OBJ = {};
				o_OBJ['hand'] = 'password_tmp';
				o_OBJ['idx'] = t_idx;

			$.ajax({
				url: './_proc/set_password_tmp.php',
				data : o_OBJ,
				dataType: "json",
				type : 'POST',
				timeout : 10000,
				error : function( xhr, ajaxOptions, thrownError ) {
					alert( "잠시후 다시 시도해주세요." );
					$('body').removeClass('loading');
				},
				beforeSend: function(xhr) {
					$('body').addClass('loading');
				},
				success: function(data) {
					if( data.code == "OK" ) {
						alert( data.msg );
					} else if( data.code == "ERR" ) {
						alert( data.msg );
					}
				},
				complete: function(xhr) {
					$('body').removeClass('loading');
				}
			});

		}

	});



	$(document).on("click", ".btn_sort_act", function() { // 게시물 정렬 변경(위 아래)

		if( $('input[name=stxt]').val() ) {
			alert('검색결과 목록에서는 정렬순서 변경이 불가합니다.');
			return false;
		}

		var o_OBJ = {};
			o_OBJ['hand'] = 'sort';
			o_OBJ['idx'] = $(this).parent().attr('data-idx');
			o_OBJ['ctype'] = $(this).attr('data-type');
			o_OBJ['tab'] = tab;


		$.ajax({
				url: './_proc/set_article.php',
				data : o_OBJ,
				dataType: "json",
				type : 'POST',
				timeout : 50000,
				error : function( xhr, ajaxOptions, thrownError ) {
					alert( "오류가 발생하였습니다.\n잠시후에 시도해주세요." );
					$('body').removeClass('loading');
				},
				beforeSend: function(xhr) {
					$('body').addClass('loading');
				},
				success: function(rdata) {

					if( rdata.code == "OK" ) {
						get_faq.list();
					}


				},
				complete: function(xhr) {
					$('body').removeClass('loading');
				}
			});

	});


	$(document).on("click", "[data-pop]", function(){

		var t_pop = $(this).attr('data-pop');
		var t_idx = $(this).attr('data-idx');

		if( t_pop == 'close' ) {
			$(this).closest(".modal").remove();
		} else {
			var pop_name = 'pop_'+t_pop;
			$('body').addClass('loading');
			$.post( pop_name+'.html', { 'hand' : t_pop, 'idx' : t_idx },function(d){
				$('body').append(d).removeClass('loading');
			});
		}
	});

	$(document).on("click", "[data-declear]", function(){

		var t_hand = $(this).attr('data-declear');
		var pop_name = 'pop_declear';

		$('body').addClass('loading');
		$.post( '/'+pop_name+'.html', { 'hand' : t_hand },function(d){
			$('body').append(d).removeClass('loading');
		});

	});

	$(document).on("click", ".btn_member_account", function() { // 일반 회원 계정 정보

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'member_account';

		$('body').addClass('loading');
		$.post( '/account/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_member_point", function() {

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'member_point';

		$('body').addClass('loading');
		$.post( '/account/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_member_cash", function() {

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'member_cash';

		$('body').addClass('loading');
		$.post( '/account/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_affiliates_account", function() { // 제휴 회원 계정 정보

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'affiliates_account';

		$('body').addClass('loading');
		$.post( '/account/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_agency_account", function() { // 공급 제휴사 계정 정보

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'agency_account';

		$('body').addClass('loading');
		$.post( '/account/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_partner_account", function() { // 공급 제휴사 계정 정보

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'partner_account';

		$('body').addClass('loading');
		$.post( '/account/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_cs_notice", function() { // 공지사항

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'cs_notice';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_cs_faq", function() { // FAQ

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'cs_faq';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_cs_qna_contact", function() { // 1:1문의

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'cs_qna_contact';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_cs_qna", function() { // 1:1문의

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'cs_qna';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_online_cancel_apply", function() { // 1:1문의

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'cancel_apply';

		$('body').addClass('loading');
		$.post( '/order/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_cs_event", function() { // 이벤트

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'cs_event';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_cs_review", function() { // 후기

		var t_idx = $(this).attr('data-idx');
		var t_code = $(this).attr('data-code');
		var pop_name = '';

		if( t_code == 'BR0001' ) {
			pop_name = 'cs_review_goods';
		} else if( t_code == 'BR0002' ) {
			pop_name = 'cs_review_refund';
		} else {
			return false;
		}

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_display_keyword", function() { // 인트로, 배너

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'display_keyword';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'type' : t_type, 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_display_banner", function() { // 인트로, 배너

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'display_banner';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'type' : t_type, 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_display_popup", function() { // 팝업

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'display_popup';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_notification_push", function() { // PUSH

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'notification_push';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_notification_sms", function() { // SMS

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'notification_sms';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_notification_email", function() { // EMAIL

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'notification_email';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_policy_info", function() { // EMAIL

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'policy_info';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_policy_code", function() { // EMAIL

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'policy_code';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_form_qna", function() { // 문의답변 양식

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var pop_name = 'form_qna';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_form_notification", function() { // 자동알람설정

		var t_idx = $(this).attr('data-idx');
		var t_whr = $(this).attr('data-whr');
		var t_type = $(this).attr('data-type');
		var pop_name = 'form_notification';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx, 'whr' : t_whr, 'type' : t_type },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_form_goodsinfo", function() { // 문의답변 양식

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'form_goodsinfo';

		$('body').addClass('loading');
		$.post( '/operate/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_agency_company", function() { // 에이전시

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'agency_company';

		$('body').addClass('loading');
		$.post( '/agency/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_agency_contract_info", function() { // 에이전시 계약정보

		var t_idx = $(this).attr('data-idx');
		var t_parent = $(this).attr('data-parent');
		var pop_name = 'agency_contract_info';

		$('body').addClass('loading');
		$.post( '/agency/pop/'+pop_name+'.html', { 'parent' : t_parent, 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_partner_income_detail", function() { // 정산서

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'partner_income_detail';

		$('body').addClass('loading');
		$.post( '/partner/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_partner_income_docs", function() { // 정산 내역
		var t_idx = $(this).attr('data-idx');
		var t_url = '/partner/pop/partner_income_docs.html?idx='+t_idx;
		goPop(t_url, 'partner_income_docs', 900);
	});

	$(document).on("click", ".btn_partner_income_history", function() { // 정산 내역
		var t_idx = $(this).attr('data-idx');
		var t_url = '/partner/pop/partner_income_history.html?idx='+t_idx;
		goPop(t_url, 'partner_income_history', 1100);
	});

	$(document).on("click", ".btn_partner_company", function() { // 파트너

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'partner_company';

		$('body').addClass('loading');
		$.post( '/partner/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_partner_contract_info", function() { // 파트너 계약정보

		var t_idx = $(this).attr('data-idx');
		var t_parent = $(this).attr('data-parent');
		var pop_name = 'partner_contract_info';

		$('body').addClass('loading');
		$.post( '/partner/pop/'+pop_name+'.html', { 'parent' : t_parent, 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});


	$(document).on("click", ".btn_code_goods", function() { // 상품 코드

		var t_idx = $(this).attr('data-idx');
		var t_type = $(this).attr('data-type');
		var pop_name = 'code_goods';

		$('body').addClass('loading');
		$.post( '/goods/pop/'+pop_name+'.html', { 'idx' : t_idx, 'type' : t_type },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_refund_info", function() { // 리펀드 정보

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'refund_info';

		$('body').addClass('loading');
		$.post( '/order/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_order_goods", function() { // 주문

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'order_goods';

		$('body').addClass('loading');
		$.post( '/order/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_order_price", function() { // 주문

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'order_price';

		$('body').addClass('loading');
		$.post( '/order/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});


	$(document).on("click", ".btn_order_affiliate", function() { // 주문

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'order_affiliate';

		$('body').addClass('loading');
		$.post( '/order/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});



	$(document).on("click", ".btn_mall_material", function() { // 상품

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'mall_material';

		$('body').addClass('loading');
		$.post( '/goods/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_mall_option", function() { // 상품

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'mall_option';

		$('body').addClass('loading');
		$.post( '/goods/pop/'+pop_name+'.html', { 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_mall_display", function() { // 인트로, 배너

		var t_idx = $(this).attr('data-idx');
		var pop_name = 'mall_display';

		$('body').addClass('loading');
		$.post( '/goods/pop/'+pop_name+'.html', { 'type' : t_type, 'idx' : t_idx },function(d){
			$('body').append(d);
			popInit(pop_name);
		});

	});

	$(document).on("click", ".btn_agency_company_selecter", function() { // 제휴사 선택
		var pop_name = 'agent_selecter';
		var t_depth = $(this).attr('data-depth');
		var t_partner = $(this).attr('data-partner');
		goPop('/agency/pop/'+pop_name+'.html', pop_name, 1000);
	});

	$(document).on("click", ".btn_agency_company_del", function() { // 제휴사 선택
		$(this).addClass('hide').closest('span').find('input').val('');
	});

	$(document).on("click", ".btn_partner_company_selecter", function() { // 제휴사 선택
		var pop_name = 'partner_company_selecter';
		var t_depth = $(this).attr('data-depth');
		var t_partner = $(this).attr('data-partner');
		goPop('/partner/pop/'+pop_name+'.html?depth='+t_depth+'&partner='+t_partner, pop_name, 1000);
	});

	//	회원가입 > 정규식
	$(document).on("keyup", "form input[data-type=name]", function(){
		var str = $(this).val();
		str = str.replace(/[^ㄱ-ㅎ가-힣a-zA-Z]/g, '');
		$(this).val(str);
	});
	$(document).on("keyup", "form input[data-type=date]", function(){

		var str = $(this).val();
		str = str.replace(/[^0-9]/g, '');
		if(str.length < 4){ str=str; }
		else if(str.length < 6){ str=str.substr(0, 4)+'-'+str.substr(4); }
		else { str=str.substr(0, 4)+'-'+str.substr(4, 2)+'-'+str.substr(6); }

		$(this).val(str);
	});
	$(document).on("keyup", "form input[data-type=hp]", function(){
		var str = $(this).val();
		str = str.replace(/[^0-9]/g, '');
		str = str.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/,"$1-$2-$3");
		$(this).val(str);
	});
	$(document).on("keyup", "form input[data-type=email]", function(){
		var str = $(this).val();
		str = str.replace(/[^-A-Za-z0-9_.@]/g, '');
		$(this).val(str);
	});
	$(document).on("keyup", "form input[data-type=id]", function(){
		var str = $(this).val();
		str = str.replace(/[^A-Za-z0-9]/g, '');
		$(this).val(str);
	});
	$(document).on("keyup", "form input[data-type=bank_number]", function(){
		var str = $(this).val();
		str = str.replace(/[^0-9-]/g, '');
		$(this).val(str);
	});
	$(document).on("keyup", "form input[data-type=passport]", function(){
		var str = $(this).val();
		str = str.replace(/[^A-Za-z0-9-]/g, '');
		$(this).val(str);
	});

	$(document).on("click", "[data-tab]", function(){
		var $this = $(this);
		var tabName = $this.attr("data-tab");

		$this.siblings().removeClass("on");
		$this.addClass("on");

		$("[data-intab]").removeClass("on");
		$("[data-intab='"+tabName+"']").addClass("on");
	});

	$(document).on("click", "[data-toggle]", function(){
		var $this = $(this);
		var target = $this.attr("data-toggle");
		var $target = $("[data-target='"+ target +"']");
		var chk = $target.hasClass("hide");
		if (chk) {
			$target.removeClass("hide");
		} else {
			$target.addClass("hide");
		};
	});


	$(document).on("click", "[data-list=toggle]", function(){
		var $this = $(this);
		$this.toggleClass("on");
	});

	$(document).on("click", ".use_all_list dd.toggle", function(){
		$(this).closest("dl.tbody").toggleClass("on");
	});

	$(document).on("click", ".btn_question", function(){
		$('.obj_answer').toggle();
	});



});
