
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
				class_name : '',            //  another class set 
				onchange: null,
				type_view: 1                //  show type paging
			}, options);
			return this.each(function () {


			});
		}
	});
})(jQuery);


