
(function ($) {
	$.fn.extend({
		n2_paging: function (options) {
			var settings = $.extend({
				page_total: 0,              //  total page number
				page_step_one: 10,          //  show 1 page of number line
				page_block : 10,            //  show page number 
				page_now : 1,               //  now page
				name_next : 'Next',
				name_prev : 'Prev',
				name_first : 'First',
				name_last : 'Last',
				opt_next : true,
				opt_prev : true,
				opt_first : true,
				opt_last : true,
				class_first : '',			//  first go page
				class_last : '',			//  last go page
				class_next : '',			//  next go page
				class_prev : '',			//  prev go page
				class_this_page : '',		//  this page
				class_name : '',            //  another class set 
				o_target : null,			//
				onchange: null,
				type_view: 1                //  show type paging
			}, options);
			return this.each(function () {



var     i_page_tot = Math.ceil( settings.page_total / settings.page_step_one );
var     i_step_half = parseInt( Math.ceil( settings.page_block / 2 ) );
var     i_page_first, i_page_last;
var     i_page_go, i_page_tmp;
var     i_block_prev, i_block_next, i_block_now, i_block_tot;


if( settings.type_view == 1 )
{
	if( settings.page_now > i_page_tot - i_step_half ) {
		i_page_first = i_page_tot - settings.page_block + 1;
	} else {
		i_page_first = settings.page_now - i_step_half + 1;
	}

	if( settings.page_now <= i_step_half ) {
		i_page_last = settings.page_block;
	} else if( settings.page_now <= i_page_tot - i_step_half ) {
		i_page_last = settings.page_now + i_step_half;
	} else {
		i_page_last = i_page_tot;
	}
} else {
	i_block_tot = Math.ceil( i_page_tot / settings.page_block );
	i_block_now = Math.ceil( settings.page_now / settings.page_block );

	i_page_first = ( i_block_now - 1 ) * settings.page_block + 1;

	if( i_block_tot <= i_block_now ) {
		i_page_last = i_page_tot;
	} else {
		i_page_last = i_block_now * settings.page_block;    
	}
}

if( i_page_first < 1 ) i_page_first = 1;
if( i_page_last > i_page_tot ) i_page_last = i_page_tot;

console.log("n2story : wfwef");

$(this).empty();

if( settings.opt_first ) {
	if ( i_page_first > 1 ) {
		$(this).append( $("<a>" + settings.name_first + "</a>").addClass(settings.class_first).addClass('hand').bind('click', function ( ){ settings.onchange( 1 ); } ) );
	} else {
		$(this).append( $("<a>" + settings.name_first + "</a>").addClass(settings.class_first).addClass('disabled') );
	}
}

if( settings.opt_prev ) {
	if ( settings.page_now > 1 ) {
		$(this).append( $("<a>" + settings.name_prev + "</a>").addClass(settings.class_prev).addClass('hand').bind('click', function ( ){ settings.onchange( settings.page_now-1 ); } ) );
	} else {
		$(this).append( $("<a>" +  settings.name_prev + "</a>").addClass(settings.class_prev) );
	}
}

for ( i_page_go = i_page_first; i_page_go <= i_page_last; i_page_go++) {
	if( i_page_go == settings.page_now ) {
		$(this).append( $("<a>" +  i_page_go + " </a>").addClass(settings.class_this_page) );
	} else  {
		$(this).append( $("<a>" +  i_page_go + "</a>").addClass('hand').bind('click', function ( ){ settings.onchange( $(this).text() ); } ) );
	}
}

if( settings.opt_next ) {
	if ( settings.page_now < i_page_tot ) {
		$(this).append( $("<a>" + settings.name_next + "</a>").addClass(settings.class_next).addClass('hand').bind('click', function ( ){ settings.onchange( settings.page_now+1 ); } ) );
	} else {
		$(this).append( $("<a>" + settings.name_next + "</a>").addClass(settings.class_next).addClass('disabled') );
	}
}

if( settings.opt_last ) {
	if ( i_page_last < i_page_tot ) {
		$(this).append( $("<a>" + settings.name_last + "</a>").addClass(settings.class_last).addClass('hand').bind('click', function ( ){ settings.onchange( i_page_tot ); } ) );
	} else {
		$(this).append( $('<a>' + settings.name_last + '</a>').addClass(settings.class_last).addClass('disabled') );
	}
}


			});
		}
	});
})(jQuery);

