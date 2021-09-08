(function($) {
	"use strict";
    var TP = {};
    var time = 100;
	/* MAIN VARIABLE */
    var $window            		= $(window),
		$document           	= $(document),
		$countDownTimer     	= $('.countdown-timer'),
		$owl					= $('.owl-slide .owl-carousel'),
		$cart					= $('#cart');
	// Check if element exists
    $.fn.elExists = function() {
        return this.length > 0;
    };
	// Check if element exists
	TP.niceInit = function() {
		$(document).on('mouseenter', '.nice-select .mCSB_scrollTools', function(event) {
		  var $dropdown = $(this).parents('.nice-select');
		  $dropdown.addClass('open_scroll');
		});
		$(document).on('click.nice_select', function(event) {
		  if ($(event.target).closest('.nice-select').length === 0) {
		    $('.nice-select').removeClass('open_scroll');
		    setTimeout(function() { $('.nice-select').removeClass('open'); }, 50);
		  }
		});
		$(document).on('click.nice_select', '.nice-select .option:not(.disabled)', function(event) {
		  $('.nice-select').removeClass('open_scroll open');
		  setTimeout(function() { $('.nice-select').removeClass('open'); }, 50);
		});
    };
	/*
		COUNT DOWN SETTING
	*/

	TP.countDown = function() {
		if ($countDownTimer.elExists()) {

			var countInstances = [];
			$countDownTimer.each(function(index, element) {

				var $this = $(this);

				// Fetching from data attibutes
				var year    = $this.attr("data-countdown-year") ? $this.attr("data-countdown-year") : 2019;
				var month   = $this.attr("data-countdown-month") ? $this.attr("data-countdown-month") : 6;
				var day     = $this.attr("data-countdown-day") ? $this.attr("data-countdown-day") : 28;

				// Adding instances for multiple use
				$this.addClass("instance-0" + index);

				// Initializing the count down
				countInstances[index] = simplyCountdown(".instance-0" + index, {
					year: year,
					month: month,
					day: day,
					words: {                            // Words displayed into the countdown
						days: 'day',
						hours: 'hr',
						minutes: 'min',
						seconds: 'sec',
						pluralLetter: 's'
					},
					plural: true,                       // Use plurals
					inline: false,
					enableUtc: false,
					refresh: 1000,                      // Default refresh every 1s
					sectionClass: 'countdown-section',  // Section css class
					amountClass: 'countdown-amount',    // Amount css class
					wordClass: 'countdown-word'         // Word css class
				});
			});
		}
	};
	/************************************************************
       CART LABEL CHECKED
    *************************************************************/
	TP.CartLabel = function() {
		if ($cart.elExists()) {
			var $label = '.cart-label';
			var $cartPayment = '.cart-payment';
			var $cartTransport = '.cart-transport';
			var $radioLabel = '.cart-radio';
			var $lbTitle = '.lb-title';


			$(document).on('click', $label,function(){
				let _this = $(this);
				_this.toggleClass('checked');
				if(_this.parents('.option-1').find('input:checked').length){
					_this.parents('.option-1').find('input').prop( "checked", false );
				}else{
					_this.parents('.option-1').find('input').prop( "checked", true );
				}
				_this.parents('.option-1').find('.extend').toggleClass('uk-hidden');
			});

			$(document).on('click', $radioLabel,function(){
				let _this = $(this);
				_this.parents($cartPayment).find($radioLabel).removeClass('checked');
				_this.parents($cartPayment).find('.extend').addClass('uk-hidden');

				_this.addClass('checked');
				// if(_this.parents('.option-2').find('input:checked').length){
				// 	_this.parents('.option-2').find('input').prop( "checked", false );
				// }else{
					_this.parents('.option-2').find('input').prop( "checked", true );
				// }
				_this.parents('.option-2').find('.extend').removeClass('uk-hidden');
			});

			$(document).on('click', $lbTitle,function(){
				let _this = $(this);
				_this.siblings('.label').trigger('click');
			});

		}
	};
	/************************************************************
        Price Range Slider
    *************************************************************/

	//TP.rangeSlider = function() {
     //   if ($priceRange.elExists()) {
     //   	let post_min_price = $( "#min_price" ).val();
     //   	post_min_price = parseInt(post_min_price)
     //   	let post_max_price = $( "#max_price" ).val();
     //   	post_max_price = parseInt(post_max_price)
    //
     //   	let min_price = parseInt($( "#min_price" ).attr('data-min'));
     //   	let max_price = parseInt($( "#max_price" ).attr('data-max'));
     //       $priceRange.slider({
     //           range: true,
     //           min: min_price,
     //           max: max_price,
     //           values: [ post_min_price, post_max_price ],
     //           slide: function( event, ui ) {
     //           	console.log(ui.values[ 0 ]);
     //               $( "#min_price" ).val(addCommas(ui.values[ 0 ]) + 'Ä‘');
     //               $( "#max_price" ).val(addCommas(ui.values[ 1 ]) + 'Ä‘');
    //
    //
     //               $('.lds-css').removeClass('hidden');
     //
	//				let page = $('.pagination .uk-active span').text();
	//				get_list_object(page);
	//				$('.lds-css').addClass('hidden');
     //           }
     //       });
     //       $( "#min_price" ).val(addCommas(post_min_price) + 'Ä‘'  );
	//	    $( "#max_price" ).val(addCommas(post_max_price) + 'Ä‘');
     //   }
    //};
    //
	//TP.owl = function() {
	//	let owl = $(this);
	//	$owl.each(function(key, value){
	//		let _this = $(this);
	//		let owlInit = _this.attr('data-option');
	//		owlInit = atob(owlInit);
	//		owlInit = JSON.parse(owlInit);
	//		_this.owlCarousel(owlInit);
	//	});
	//};


  // Document ready functions
  //  $document.on('ready', function() {
	//	TP.niceInit(),
	//		TP.CartLabel(),
	//		TP.owl();
  //  });

})(jQuery);
 $(window).load(function() {
	$(document).on('submit' , '#form-baogia', function(){
		let _this = $(this);
		let loader = _this.find('.bg-loader');
		loader.show();
		let modalTks = UIkit.modal("#md-thanks");
		let prd_name = _this.find('.order_prd_name').val();
		let fullname = _this.find('.order-fullname').val();
		let email = _this.find('.order-email').val();
		let phone = _this.find('.order-phone').val();
		let message = _this.find('.order-message').val();
		let data = $(this).serializeArray();
		let ajaxUrl = 'contact/ajax/contact/save_info_contact';
		clearTimeout(time);
		//gửi ajax
		time = setTimeout(function(){
			$.ajax({
				method: "POST",
				url: ajaxUrl,
				data: {data: data, prd_name: prd_name, fullname: fullname, email: email, phone: phone, message: message,},
				dataType: "json",
				cache: false,
				success: function(json){
					loader.hide();
					if(json.error == ''){
						//không có lỗi ẩn error và show câu cảm ơn
						_this.find('.error').addClass('hidden');
						_this.find('.input-text').val('');
						modalTks.show();
					}else{
						_this.find('.error').removeClass('hidden');
						_this.find('.error .alert').html(json.error);
					}
				}
			});
		}, 300);
		return false;
	});
	$(document).on('submit' , '#form-register', function(){
		
		let _this = $(this);
		let loader = _this.find('.bg-loader');
		loader.show();
		let modalTks = UIkit.modal("#md-thanks");
		let email = _this.find('.email').val();
		let data = $(this).serializeArray();
		let ajaxUrl = 'contact/ajax/contact/save_contact_register';
		clearTimeout(time);
		//gửi ajax
		time = setTimeout(function(){
			$.ajax({
				method: "POST",
				url: ajaxUrl,
				data: {data: data, email: email},
				dataType: "json",
				cache: false,
				success: function(json){
					loader.hide();
					if(json.error == ''){
						//không có lỗi ẩn error và show câu cảm ơn
						_this.find('.error').addClass('hidden');
						_this.find('.input-text').val('');
						modalTks.show();
					}else{
						_this.find('.error').removeClass('hidden');
						_this.find('.error .alert').html(json.error);
					}
				}
			});
		}, 300);
		return false;
	});
	// var h_header = $('.pc-header').outerHeight();
	// var target;

 	// $(window).scroll(function(){
 	// 	let scroll = $(window).scrollTop();
 	// 	if (scroll >= h_header) {
 	// 		$('body').addClass('fixed-header');
 	// 		$('.pc-header').addClass('fixed');
 	// 	}else{
 	// 		$('body').removeClass('fixed-header');
 	// 		$('.pc-header').removeClass('fixed');
 	// 	}
 	
	 // 	$('.scroll-menu').each(function(i, e){
	 // 		let id = $(e).attr('id');
	 // 		target = $(e).offset().top;
	 // 		if(target <= scroll){
	 // 			$('.main-menu li> a').removeClass('active');
	 // 			$('.main-menu li> a[href="#'+id+'"]').addClass('active');
	 // 		}
	 // 	});
 	// });

 	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++GENANER++++++++++++++++++++++++++++++++
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$(document).on('change','#city',function(e, data){
		let _this = $(this);
		let param = {
			'parentid' : _this.val(),
			'select' : 'districtid',
			'table'  : 'vn_district',
			'trigger_district': (typeof(data) != 'undefined') ? true : false,
			'text'   : 'Chọn Quận/ Huyện',
			'parentField'  : 'provinceid',
		}
		getLocation(param, '#district');
	});
	if(typeof(cityid) != 'undefined' && cityid != ''){
		$('#city').val(cityid).trigger('change', [{'trigger':true}]);
	}
	$(document).on('change','#district', function(e, data){
		let _this = $(this);
		let param = {
			'parentid' : _this.val(),
			'select' : 'wardid',
			'trigger_ward': (typeof(data) != 'undefined') ? true : false,
			'table'  : 'vn_ward',
			'text'   : 'Chọn Phường/ Xã',
			'parentField'   : 'districtid',
		}
		getLocation(param, '#ward');
	});
	$(document).on('change','#city_receive',function(e, data){
		let _this = $(this);
		let param = {
			'parentid' : _this.val(),
			'select' : 'districtid',
			'table'  : 'vn_district',
			'trigger_district': (typeof(data) != 'undefined') ? true : false,
			'text'   : 'Chọn Quận/ Huyện',
			'parentField'  : 'provinceid',
			'district' : districtid_receive,
			'ward' : wardid_receive,
		}

		getLocation(param, '#district_receive');
	});
	if(typeof(cityid_receive) != 'undefined' && cityid_receive != ''){
		$('#city_receive').val(cityid_receive).trigger('change', [{'trigger':true}]);
	}
	$(document).on('change','#district_receive', function(e, data){
		let _this = $(this);
		let param = {
			'parentid' : _this.val(),
			'select' : 'wardid',
			'trigger_ward': (typeof(data) != 'undefined') ? true : false,
			'table'  : 'vn_ward',
			'text'   : 'Chọn Phường/ Xã',
			'parentField'   : 'districtid',
			'district' : districtid_receive,
			'ward' : wardid_receive,
		}
		getLocation(param, '#ward_receive');
	});
 	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 	// +++++++++++++++++Xá»¨ LĂ JS á» TRANG HOME++++++++++++++++++++++++++++
 	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 	//+++++++++láº¥y dá»¯ liá»‡u Ä‘á»• vĂ o popup chi tiáº¿t sp á»Ÿ trang home+++++++++
    $(document).on('click' ,'.js_prd_popup',function(){
		let _this = $(this);
		let id = _this.attr('data-id');
		let ajax_url = 'homepage/ajax/home/prdPopup';
		$.ajax({
            url : ajax_url,
            type : "post",
            cache: 	false ,
            dataType:"text",
            data : {
                id: id
            },
            	success : function (result){
            	let json = JSON.parse(result);
				setTimeout(function(){
					$('#sync3').attr('src',json.prd_list_image1);
					// $('#sync1').html('').html(json.prd_list_image);
					// $('#sync2').html('').html(json.prd_list_image);
					$('.prd-title').html('').html(json.prd_title);
					$('.js_result_attr').html(json.js_addtribute);
					$('.wrap-info').html('').html(json.js_info);
					if(json.js_block_promotional !=''){
						$('.prd-buy').after('<div class="js_block_promotional"></div>');
						$('.js_block_promotional').html('').html(json.js_block_promotional);
					}
					$('.js_wholesale').html('');
					$('.js_wholesale').after(json.js_wholesale);
					$('.js_addtribute').after('<div id="js_prd_info"></div>');
					$('#js_prd_info').attr('data-info', json.data_info);
					$('#js_prd_info').attr('data-price', json.price);
					$('#js_prd_info').attr('data-id', json.id);
					$('#js_prd_info').attr('data-name', json.title);
					owl_intilize('#sync1', '#sync2');
					$('.js_block_promotional input:eq(0)').attr('checked', true);
				},100)
				owl_intilize('#sync1', '#sync2');

            }
        });
	})
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++Xá»¬ LĂ á» TRANG CHI TIáº¾T SP ++++++++++++++++++++++
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// +++++++++++++hiá»ƒn thá»‹ láº¡i giĂ¡ cho sáº£n pháº©m+++++++++++++
	if($('#js_prd_info').length){
 		render_price()
 	}

 	//Cập nhập số lượng sản phẩm
	$(document).on('click' ,'.js_addtribute .js_btn_choose' ,function(){
		let _this = $(this);
		_this.parent().find('.js_choose').removeClass('js_choose');
		_this.addClass('js_choose');
		render_price();
	});
	$(document).on('click' ,'.js_quantity_minus' ,function(){
		let _this = $(this);
		let qty = _this.parent().find('.js_quantity').val();
		if(qty == 0){
			return false;
		}
		_this.parent().find('.js_quantity').val(sub(qty, 1));
		render_price();
	});
	$(document).on('click' ,'.js_quantity_plus' ,function(){
		let _this = $(this);
		let qty = _this.parent().find('.js_quantity').val();
		_this.parent().find('.js_quantity').val(sum(qty, 1));
		render_price();
	});
	$(document).on('click change' ,'.js_quantity' ,function(){
		render_price()
	});
	$(document).on('change ' ,'.js_block_promotional input' ,function(){
		render_price()
	});


	//add nhanh sản phẩm vào giỏ hàng có mã gift
	$(document).on('click' ,'.ajax_add_prd_gift' ,function(){
		let _this = $(this);
		let param = {
			'id' : _this.attr('data-id'),
			'quantity' : 1,
			'attrids'  : '',
			'promotionalid': '',
			'name': _this.attr('data-name'),
		}
		let ajax_url = 'cart/ajax/cart/addCart';
		$.ajax({
            url : ajax_url,
            type : "post",
            cache: 	false ,
            dataType:"text",
            data : {
                name: param.name,quantity: param.quantity, attrids: param.attrids, promotionalid: param.promotionalid, id: param.id
            },
            	success : function (result){

            	toastr.success('Thêm sản phẩm vào giỏ hàng thành công','');
            	let ajax_url = 'cart/ajax/cart/refeshCart';
				$.ajax({
		            url : ajax_url,
		            type : "post",
		            cache: 	false ,
		            dataType:"text",
		            data : {},
		            	success : function (data){
		            		let json = JSON.parse(data);
		            		if(json.result == true){
								$('.list-item').html(json.list_item);
								$('.total_quantity b').html(json.total_quantity);
								$('.cart-total .content').html(json.cart_total);
		            		}else{
		            			toastr.error('Có lỗi xảy ra, vui lòng thử lại','');
		            		}
		            }
		        });
            }
        });
	})

	//lấy tỉnh thành quận huyện
	$(document).on('change','select[name=cityid], select[name=districtid]' , function(){
		let _this = $(this);
		let ajax_url = 'cart/ajax/cart/render_discount_ship';
		clearTimeout(time);
		var time = setTimeout(function(){
			$.ajax({
	            url : ajax_url,
	            type : "post",
	            cache: 	false ,
	            dataType:"text",
	            data : {
	            	cityid: $('select[name=cityid]').val(),
	            	districtid: $('select[name=districtid]').val(),
	            },
	            	success : function (result){
	        			$('.js_discount_ship').html('-'+addCommas(result)+'đ')
	        			$('.js_discount_ship').attr('data-val', result)

	        			 // tính lại giá cuối cùng
				        let discount_ship = $('.js_discount_ship').attr('data-val');
				        let ship = $('.js_ship').attr('data-val');
				        let totalCart = $('.js_cart_coupon').attr('data-val');
				        let totalShip = sub(ship, discount_ship);
				        if(totalShip < 0){
				        	totalShip = 0;
				        }
				        $('.js_total_ship').html('-'+addCommas(totalShip)+'đ');
				        //$('.js_cart_coupon').html('<b>'+addCommas(sum(totalCart, totalShip))+'đ</b>');


	        			// toastr.success('Bạn được giảm '+addCommas(result)+' tiền ship','');
	            }
	        });
        }, 500);


	})
	$(document).on('change','select[name=cityid], select[name=districtid]' , function(){
		let _this = $(this);
		let ajax_url = 'cart/ajax/cart/render_ship';
		clearTimeout(time);
		var time = setTimeout(function(){
    		$.ajax({
	            url : ajax_url,
	            type : "post",
	            cache: 	false ,
	            dataType:"text",
	            data : {
	            	cityid: $('select[name=cityid]').val(),
	            	districtid: $('select[name=districtid]').val(),
	            },
	            	success : function (result){
	            		$('.js_ship').html(addCommas(result)+'đ')
            			$('.js_ship').attr('data-val', result)

            			 // tính lại giá cuối cùng
				        let discount_ship = $('.js_discount_ship').attr('data-val');
				        let ship = $('.js_ship').attr('data-val');
				        let totalCart = $('.js_cart_coupon').attr('data-val');
				        let totalShip = sub(ship, discount_ship);
				        if(totalShip < 0){
				        	totalShip = 0;
				        }
				        $('.js_total_ship').html('-'+addCommas(totalShip)+'đ');
				        //$('.js_cart_coupon').html('<b>'+addCommas(sum(totalCart, totalShip))+'đ</b>');
	            }
	        });
		}, 500);
	})

	




	//Lọc sản phẩm
	//$(document).on('click','.attr' , function(){
	//	if($(this).find('input[name="attr[]"]:checked').length){
	//		$(this).find('input[name="attr[]"]').prop('js_choose', false);
	//		$(this).find('label a').addClass('js_choose');
	//	}else{
	//		$(this).find('input[name="attr[]"]').prop('js_choose', true);
	//		$(this).find('label a').removeClass('js_choose');
	//	}
	//	let attr = '';
	//	$('input[name="attr[]"]:checked').each(function(key, index){
	//		let id= $(this).val();
	//		let text= $(this).parent('div').text();
	//		let attr_id= $(this).attr('data-keyword');
	//		attr = attr + attr_id + ';' + id + ';';
	//	});
	//	// console.log(attr);
	//	$('#choose_attr > input').val(attr).change();
	//})
	//var time;
	//$(document).on('change','.filter', function(){
	//	// $("html, body").animate({ scrollTop: 0 }, "400");
	//	// console.log(2);
	//	$('.lds-css').removeClass('hidden');
	//	let page = $('.pagination .uk-active span').text();
    //
	//	clearTimeout(time);
	//	time = setTimeout(function(){
	//		get_list_object(page);
	//		$('.lds-css').addClass('hidden');
	//	},500);
	//	return false;
	//});
    //
	//$(document).on('click','.pagination li span', function(){
	//	$("html, body").animate({ scrollTop: 0 }, "400");
    //
	//	$('.lds-css').removeClass('hidden');
	//	let page = $(this).text();
	//	clearTimeout(time);
	//	time = setTimeout(function(){
	//		get_list_object(page);
	//		$('.lds-css').addClass('hidden');
	//	},500);
	//	return false;
	//});

	$(document).on('click','.list-time .btn-time', function(){
		let _this = $(this);
		if(_this.hasClass('disable')){
			return false;
		}
		_this.parents('.list-time').find('.btn-time').removeClass('choose');
		_this.addClass('choose')
		let id = _this.attr('data-id');
		$("input[name=input_time]").val(id);
	});

 //    if($('.rating')){
	// 	rating();
	// }

});

// HĂ m tĂ­nh sá»‘ sao Ä‘Ă¡nh giĂ¡
function rating(start = 0, selector = '.rating', inputForm = 'input.data-rate'){
	var input = $(inputForm);
	var ratings = $(selector);
	for (var i = start; i < ratings.length; i++) {
		var r = new SimpleStarRating(ratings[i]);
		ratings[i].addEventListener('rate', function(e) {
			var numStar = e.detail; // tĂ­nh sá»‘ sao
			input.val(numStar);
			get_title_rate(numStar);
		});
	}
}
function get_title_rate(numStar = 0){
	let ajaxUrl = 'comment/ajax/comment/get_title_rate';
	$.ajax({
		method: "POST",
		url: ajaxUrl,
		data: {numStar: numStar},
		dataType: 'json',
		success: function(json){
			$('.title-rating').text(json.htmlReview);
		}
	});
}
//function get_list_object(page){
//	let keyword = $('.keyword').val();
//	let perpage = $( ".js_perpage option:selected" ).text();
//	if(perpage == 'undefined' || perpage == '' ){
//		perpage = $('.js_perpage').val();
//	}
//
//	sort = $('.js_sort').val();
//	if(sort == 'undefined' || sort == '' ){
//		let sort = $( ".js_sort option:selected" ).text();
//	}
//
//	let catalogueid = $('#choose_attr').attr('data-catalogueid');
//
//	let attr = $('input[name="attr"]').val();
//	let brand = [];
//	$('input[name="brand[]"]:checked').each(function(){
//		brand.push($(this).val());
//	});
//	let min_price = $('#min_price').val();
//	let length_min = min_price.length;
//	min_price = min_price.substr(0, length_min - 1);
//	min_price = min_price.replace(/\./gi, "");
//
//
//
//	let max_price = $('#max_price').val();
//	let length_max = max_price.length;
//	max_price = max_price.substr(0, length_max - 1);
//	max_price = max_price.replace(/\./gi, "");
//
//	let param = {
//		'page'    : page,
//		'keyword' : keyword,
//		'perpage' : perpage,
//		'catalogueid' : catalogueid,
//		'attr' : attr,
//		'brand' : brand,
//		'sort' : sort,
//		'min_price' : min_price,
//		'max_price' : max_price,
//	}
//
//	let pathname = window.location.pathname;
//	// ?mod=course&view=main
//	let href = pathname+'?';
//	$.each( param, function( key, value ) {
//		if(value != '' && value != undefined){
//			href = href+key+'='+value+'&';
//		}
//	});
//    history.pushState('', 'New URL: '+href, href);
//	let ajaxUrl = 'product/ajax/frontend/get_list_prd_cat';
//	$.get(ajaxUrl, {
//		page: param.page,
//		keyword: param.keyword,
//		perpage: param.perpage,
//		catalogueid: param.catalogueid,
//		attr: param.attr,
//		brand: param.brand,
//		sort: param.sort,
//		min_price: param.min_price,
//		max_price: param.max_price,
//		},
//		function(data){
//			let json = JSON.parse(data);
//			$('#ajax-content').html(json.html);
//			$('.pagination').html(json.pagination);
//			$('.total_row').html(json.total_row);
//			$('.from').html(json.from);
//			$('.to').html(json.to);
//			TP.countDown();
//	});
//};
function GetURLParameter(sParam){
	var sPageURL = window.location.search.substring(1);

    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}
function render_price(){
	let price = $('#js_prd_info').attr('data-price');
	let price_contact = $('#js_prd_info').attr('data-price_contact');
	let price_sale = $('#js_prd_info').attr('data-price_sale');
	let id = $('#js_prd_info').attr('data-id');
	let name = $('#js_prd_info').attr('data-name');
	var info = $('#js_prd_info').attr('data-info');
	var redirect = $('#js_prd_info').attr('data-redirect');
	info = window.atob(info);
	let json = JSON.parse(info);
	let quantity = $('.js_quantity').val();
	if(quantity == 'undefined' || quantity == '' ){
		quantity = 1;
	}

	attrids = new Array();
	let data_cart = '';
	let promotionalid = [];
	let conditionChoose = 1;
	let product_versionId = $('#js_prd_info').attr('product-versionId');
	let wholesale = false;
	let content = '';
	if($('.js_addtribute').length){
		$('.js_addtribute .js_choose').each(function() {
			let attrid = $(this).attr('data-id');
			// console.log(attrid);
			let version = $(this).attr('data-version');
			if(typeof $(this).attr('data-content') != 'undefined' ){
				content = content + '</br>' + $(this).attr('data-content');
			}
			if(version == 0){
				return;
			}
			if(typeof attrid != 'undefined' ){
				if(attrid.indexOf('-') != -1){
					attrids = attrid.split('-');
				}else{
					attrids.push(attrid) ;
				}
			}

		});
		//console.log(attrids);
		$('.js_addtribute option:selected').each(function() {
			let attrid = $(this).attr('data-id');
			let version = $(this).attr('data-version');
			content = content + '</br>' + $(this).attr('data-content');
			if(version == 0){
				return;
			}
			if(attrid.indexOf('-') != -1){
				attrids = attrid.split('-');
			}else{
				attrids.push(attrid);
			}
			// console.log(attrids);
		});

		//console.log(attrids.length);
		if(attrids.length >=1){
			let product_version = json.product_version;
			if(product_version != ''){
				if(attrids.length == 1){
					product_version.forEach(function(item, index, array) {
						// console.log(item);
						// console.log(attrids);
					    if(item.attribute1 == attrids[0] || item.attribute2 == attrids[0]	){
					     	price = item.price_version;
					     	product_versionId = item.id;
					    }
					});
					price = price.trim();
				}else{
					product_version.forEach(function(item, index, array) {
						//console.log(item);
						//console.log(attrids);
					    if((item.attribute1 == attrids[0] && item.attribute2 == attrids[1]) || (item.attribute2 == attrids[0] && item.attribute1 == attrids[1])){
					     	price = item.price_version;
					     	product_versionId = item.id;
					    }
					});
					price = price.trim();
				}

			}
		}
	}
	//console.log(price);
	if($('.js_wholesale .js_btn_choose').length){
		let quantity_start = '';
		json.product_wholesale.forEach(function(item, index, array) {
		   	if( parseFloat(quantity) >= item.quantity_start && parseFloat(quantity) <= item.quantity_end){
		   		price = item.price_wholesale;
		   		quantity_start = item.quantity_start
		   	}else{
		   		if(parseFloat(quantity) >= item.quantity_end){
		   			price = item.price_wholesale;
			   		quantity_start = item.quantity_start
		   		}
		   	}
		   	if(parseFloat(quantity) >= item.quantity_start){
		   		$('.js_block_promotional').find('input').prop('disabled', true);
		   		conditionChoose = 1;
		   		wholesale = true;
		   	}
		});
	 	$('.js_wholesale .js_btn_choose').removeClass('js_choose_wholesale')
		$('.js_wholesale .js_btn_choose').each(function() {
			let li_qty_start= $(this).attr('data-quantity_start');
			if(li_qty_start == quantity_start){
				$(this).addClass('js_choose_wholesale')
			}
		});
	}
	if(wholesale != true){
		if($('.js_block_promotional').length){
			let data = $('.js_block_promotional input:checked').attr('data-id');
			if(data != undefined){
				if(data.indexOf('-') != -1){
					promotionalid = data.split('-');
				}else{
					promotionalid.push(data)
				}
				let promotional = json.promotional;
				price_old = price.replace(/\./gi, "");
				price = price.replace(/\./gi, "");
				price = parseFloat(price);
				promotionalid.forEach(function(item, index, array) {
					promotional.forEach(function(item1, index1, array1) {
					  	if(item == item1.promotionalid){
					  		if(item1.condition_type_1 == 'condition_quantity'){
					  			let condition_quantity = parseFloat(item1.condition_value_1);
					  			if(parseFloat(quantity) >= condition_quantity){
					  				let discount_value = parseFloat(item1.discount_value);
							  		if(item1.discount_type == 'price'){

							  			price = price - discount_value;
							  		}
									if(item1.discount_type == 'same'){
							  			price = discount_value;
							  		}
							  		if(item1.discount_type == 'percent'){
							  			price = price - price_old*(discount_value)/100;
							  			price = Math.round(price);
							  		}
					  			}
					  		}

					  	}
					});
				});
				conditionChoose = 1;
			}else{
				conditionChoose = 0;
			}
		}
	}
	// console.log(conditionChoose);

	if( ( conditionChoose == 1) || ($('.js_addtribute ul ').length == 0 && $('.js_block_promotional').length == 0 )){
		$('.js_buy').attr('data-id', id);
		$('.js_buy').attr('data-conditon', 'true');
		$('.js_buy').attr('data-quantity', quantity);
		$('.js_buy').attr('data-attrids', attrids);
		$('.js_buy').attr('data-promotionalid', promotionalid);
		$('.js_buy').attr('data-name', name);
		$('.js_buy').attr('data-content', content);
		$('.js_buy').attr('data-redirect',redirect);
		$('.js_buy').attr('data-price',price);
	}
	if(price_contact == 1){
		$('.js_newprice').html('').html('Giá liên hệ');
	}else{
		if(price_sale == 0){
			// console.log(price);
			$('.js_newprice').html('').html(addCommas(price) + '<sup>đ</sup>');
		}else{
			$('.js_newprice').html('').html(addCommas(price_sale) + '<sup>đ</sup>');
		}
	}
};
function addCommas(nStr){
	nStr = String(nStr);

	nStr = nStr.replace(/\./gi, "");
	let str ='';
	for (i = nStr.length; i > 0; i -= 3){
		a = ( (i-3) < 0 ) ? 0 : (i-3);
		str= nStr.slice(a,i) + '.' + str;
	}
	str= str.slice(0,str.length-1);
	return str;
}
function getLocation(param, object){
	let tempWard = wardid;
	let tempDistrict = districtid;
	if(typeof param.district != 'undefined'){
		tempDistrict = param.district;
	}
	if(typeof param.ward != 'undefined'){
		tempWard = param.ward;
	}

	if(typeof tempDistrict == 'undefined' || tempDistrict == ''  || param.trigger_district == false) tempDistrict = 0;
	if(typeof tempWard == 'undefined' || tempWard == ''  || param.trigger_ward == false) tempWard = 0;

	let formURL = 'dashboard/ajax/dashboard/getLocation';
	$.post(formURL, {
		parentid: param.parentid, select: param.select, table: param.table, text: param.text, parentField: param.parentField},
		function(data){
			let json = JSON.parse(data);
			if(param.select == 'districtid'){
				if(param.trigger_district == true){
					$(object).html(json.html).val(tempDistrict).trigger('change', [{'trigger':true}]);
				}else{
					$(object).html(json.html).val(tempDistrict).trigger('change');
				}
			}else if(param.select == 'wardid'){
				$(object).html(json.html).val(tempWard);
			}
		});
}
function sum(a = 0 ,b = 0){
	return parseFloat(a) + parseFloat(b);
}
function sub(a = 0 ,b = 0){
	return parseFloat(a) - parseFloat(b);
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// +++++++++++++++++++++++++++Xá»¬ LI GIá» HĂ€NG CART++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// +++++++++++++++++++++++xĂ³a sáº£n pháº©m+++++++++++++++++++++++
$(document).on('click' ,'.js_del_prd' ,function(){

	let _this = $(this);
	let param = {
		'rowid' : _this.parents('.js_data_prd').attr('data-rowid'),
		'quantity' :0,
	}
	let ajax_url = 'cart/ajax/cart/refeshCart';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			param: param
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success('Xoá sản phẩm thành công','');
				resultResfeshCart(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error('Có lỗi xảy ra','');
			}
		}
	});
});

// +++++++++++++++++++++++Cáº­p nháº­t sá»‘ lÆ°á»£ng+++++++++++++++++++++++
$(document).on('change' ,'.js_update_quantity' ,function(){
	let _this = $(this);
	let param = {
		'rowid' : _this.parents('.js_data_prd').attr('data-rowid'),
		'quantity' : _this.val(),
	}
	let ajax_url = 'cart/ajax/cart/refeshCart';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			param: param
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success('Cập nhật sản phẩm thành công','');
				resultResfeshCart(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error('Có lỗi xảy ra','');
			}

		}
	});
})
// +++++++++++++++++++++++cáº­p nháº­p sá»‘ lÆ°á»£ng vá» 0+++++++++++++++++++++++
$(document).on('click' ,'.js_refesh_quantity' ,function(){
	let _this = $(this);
	let param = {
		'rowid' : _this.parents('.js_data_prd').attr('data-rowid'),
		'quantity' : 1,
	}
	let ajax_url = 'cart/ajax/cart/refeshCart';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			param: param
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success('Cập nhật sản phẩm thành công','');
				resultResfeshCart(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error('Có lỗi xảy ra','');
			}

		}
	});
})

// +++++++++++++++++++++++ThĂªm mĂ£ coupn+++++++++++++++++++++++
$(document).on('click' ,'.js_btn_coupon' ,function(){
	let _this = $(this);
	let code_cp = $('.js_input_coupon').val();
	let ajax_url = 'cart/ajax/cart/refeshCart';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			type:'add', code_cp: code_cp
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success(json.notifi,'');
				resultResfeshCart(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error(json.notifi,'');
			}
		}
	});
})

// +++++++++++++++++++++++XĂ³a mĂ£ coupn+++++++++++++++++++++++
$(document).on('click' ,'.js_del_coupon' ,function(){
	let _this = $(this);
	let code_cp = _this.attr('data-coupon');
	let ajax_url = 'cart/ajax/cart/refeshCart';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			type:'del_coupon', code_cp: code_cp
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success(json.notifi,'');
				resultResfeshCart(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error(json.notifi,'');
			}
		}
	});
})



// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// +++++++++++++++++Xá»¬ LĂ TRANG THANH TOĂN PAYMENT+++++++++++++++++
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



// +++++++++++++++++++XĂ³a mĂ£ Coupon+++++++++++++++++++
$(document).on('click' ,'.js_del_coupon_payment' ,function(){
	let _this = $(this);
	let code_cp = _this.attr('data-coupon');
	let ajax_url = 'cart/ajax/cart/refeshPayment';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			type:'del_coupon', code_cp: code_cp
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success(json.notifi,'');
				resultResfeshPayment(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error(json.notifi,'');
			}
		}
	});
})


//  +++++++++++++++++++++ThĂªm mĂ£ Coupon+++++++++++++++++++++
$(document).on('click' ,'.js_btn_coupon_payment' ,function(){
	let _this = $(this);
	let code_cp = $('.js_input_coupon_payment').val();
	let ajax_url = 'cart/ajax/cart/refeshPayment';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {
			type:'add', code_cp: code_cp
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				toastr.success(json.notifi,'');
				resultResfeshPayment(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error(json.notifi,'');
			}
		}
	});
})


// ++++++++++++++++++++++++ cập nhật số lượng ++++++++++++++++++++++++
$(document).on('change' ,'.js_update_quantity_payment' ,function(){
	let _this = $(this);
	let param = {
		'rowid' : _this.parents('.js_data_prd').attr('data-rowid'),
		'quantity' : _this.val(),
	}
	let ajax_url = 'cart/ajax/cart/refeshPayment';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType :"text",
		data : {
			param : param,
		},
		success : function (data){
			_this.val('');
			let json = JSON.parse(data);
			if(json.result == 'true'){
				resultResfeshPayment(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error(json.notifi,'');
			}
		}
	});
})
$(document).on('click' ,'.js_del_prd_payment' ,function(){
	let _this = $(this);
	let param = {
		'rowid' : _this.parents('.js_data_prd').attr('data-rowid'),
		'quantity' :0,
	}
	let ajax_url = 'cart/ajax/cart/refeshPayment';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache:  false ,
		dataType :"text",
		data : {
			param : param,
		},
		success : function (data){
			_this.val('');

			let json = JSON.parse(data);
			if(json.result == 'true'){
				resultResfeshPayment(json);
				return false;
			}
			if(json.result == 'false'){
				toastr.error(json.notifi,'');
			}
		}
	});
})


// +++++++++++++++tÄƒng giáº£m sá»‘ lÆ°á»£ng thĂªm 1 Ä‘Æ¡n vá»‹+++++++++++++++
$(document).on('click' ,'.btn-abatement' ,function(){
	let _this = $(this);
	let quantity = _this.parent().find('input').val();
	_this.parent().find('input').val(sum(quantity, 1)).trigger('change');
	_this.parent().find('.qty-input').html(sum(quantity, 1)).trigger('change');
	return false;
})
$(document).on('click' ,'.btn-augment' ,function(){
	let _this = $(this);
	let quantity = _this.parent().find('input').val();
	_this.parent().find('input').val(sub(quantity, 1)).trigger('change');
	_this.parent().find('.qty-input').html(sub(quantity, 1)).trigger('change');
	return false;
})
$(document).on('click' ,'.js_post_payment_1' ,function(){
	$('.js_post_payment').trigger('click');
})
function resultResfeshCart(json =''){
	// $('.js_list_prd').html(json.html_giohang);
	// $('.js_total_prd').html(json.total_quantity);
	// $('.js_total_cart').html(json.total_cart);
	// $('.js_cart_promo').html(json.cart_promo);
	// $('.js_cart_coupon').html(json.cart_coupon);
	// $('.js_list_promo').html(json.list_promo);
	// $('.js_list_coupon').html(json.html_cart_coupon);
	// //custom
	// $('.js_shoppingcart_box').html(json.html_header_cart);
	// $('.js_total_item_cart').html(json.total_quantity);
	// $('.js_total').html(json.total_cart);
	// $('.js_list_html_giohang').html(json.html_giohang);
	$('.js_discount_coupon').html(json.discount_coupon+' đ');
    $('.cart_listheader').html(json.html);
    $('.number-items').html(json.total_quantity);
	$('.cart_totalprice').html(json.total+' đ');
	$('.js_list_coupon').html(json.html_coupon);
	$('.cart_total_counpon').html(json.cart_coupon+' đ');

	return true;
}
function resultResfeshPayment(json =''){
	// $('.js_list_prd').html(json.html_giohang);
	// $('.js_total_prd').html(json.total_quantity);
	// $('.js_total_cart').html(json.total_cart+'đ');
	// $('.js_cart_promo').html(json.cart_promo);
	// $('.js_cart_coupon').html(json.cart_coupon);
	// $('.js_cart_coupon').attr('data-val', json.cart_coupon_val);
	// $('.js_list_promo').html(json.list_promo);
	// $('.js_discount_promo').html(json.discount_promo);
	$('.js_discount_coupon').html(json.discount_coupon+' đ');
	$('.js_list_coupon').html(json.list_coupon);
	// $('.js_total_item_cart').html(json.total_quantity);
	// $('.js_list_html_giohang').html(json.html_giohang);
	// $('select[name=cityid]').trigger('change');
	// $('select[name=districtid]').trigger('change');
    $('.cart_listheader').html(json.html);
    $('.number-items').html(json.total_quantity);
	$('.cart_totalprice').html(json.total+' đ');
	$('.cart_total_counpon').html(json.cart_coupon+' đ');
	//$('.html_coupon').html(json.html_coupon);
	return true;


}
//gửi đăng ký email
$(document).ready(function () {
	$('#mailsubricre .error').hide();
	var uri = $('#mailsubricre').attr('action');
	$('#mailsubricre').on('submit', function () {
		var postData = $(this).serializeArray();
		$.post(uri, {post: postData, fullname: $('#mailsubricre .fullname').val(),phone: $('#mailsubricre .phone').val(),email: $('#mailsubricre .email').val()}, function (data) {
			var json = JSON.parse(data);
			$('#mailsubricre .error').show();
			if (json.error.length) {
				$('#mailsubricre .error').removeClass('alert alert-success').addClass('alert alert-danger');
				$('#mailsubricre .error').html('').html(json.error);
			} else {

				$('#mailsubricre .error').removeClass('alert alert-danger').addClass('alert alert-success');
				$('#mailsubricre .error').html('').html('Đăng ký thành công.');
				$('#mailsubricre').trigger("reset");
				setTimeout(function () {
					location.reload();
				}, 5000);
			}
		});
		return false;
	});
});
//login
$(document).ready(function(){
	$('.login-error').hide();
	$('#login_form').on('submit',function(){
		var _this = $(this);
		//$('#btn-submit').val('Loading....');
		var email = _this.find('#input_email').val();
		var password = _this.find('#input_password').val();
		var checked = _this.find('#cookieLogin').prop("checked");
		var formURL = 'login-modal.html';
		var url = window.location.href;
		$.post(formURL, {email: email,password:password,checked:checked},
			function(data){
				$('#btn-submit').val('Đăng nhập');
				$('.login-error').show();
				var json = JSON.parse(data);
				if(json.flag == false){
					$('.login-error').removeClass('alert alert-success').addClass('alert alert-danger');

					$('.login-error').html(json.message);
				}else{
					$('.login-error').removeClass('alert alert-danger').addClass('alert alert-success');

					$('.login-error').html(json.message);

					setTimeout(function(){ window.location.href = url; }, 1200);

				}
			});
		return false;
	});
});
//dangky

$(document).ready(function(){
	$('.dangky-error').hide();
	$('#dangky_form').on('submit',function(){
		var _this = $(this);
		var catalogueid = _this.find('#input_catalogueid_reg').val();
		var email = _this.find('#input_email_reg').val();
		var fullname = _this.find('#input_fullname_reg').val();
		var phone = _this.find('#input_phone_reg').val();
		var address = _this.find('#input_address_reg').val();
		var password = _this.find('#input_password_reg').val();
		//var reg_password = _this.find('#input_reg_password_reg').val();
		//var captcha = _this.find('#input_captcha_reg').val();
		var account = _this.find('#input_account_reg').val();
		var input_image_reg = _this.find('#input_image_reg').val();
		//var cityid = _this.find('#city_reg').val();
		//var product_catalogue_id = _this.find('#product_catalogue_id_reg').val();
		var formURL = 'register-modal.html';
		$.post(formURL, {email: email,fullname: fullname,phone: phone,address: address,password:password,catalogueid:catalogueid,account:account,input_image_reg:input_image_reg},
			function(data){
				$('.dangky-error').show();
				var json = JSON.parse(data);
				if(json.flag == false){
					$('.dangky-error').removeClass('alert alert-success').addClass('alert alert-danger');
					$('.dangky-error').html(json.message);
					$('#input_captcha_reg').val('');
					$('#captImg').html(json.capcha);
				}else{
					$('.dangky-error').removeClass('alert alert-danger').addClass('alert alert-success');
					$('.dangky-error').html(json.message);
					setTimeout(function(){ window.location.href = ''; }, 1200);
				}
			});
		return false;
	});
});

//quickview-click
$(document).on('click' ,'.js_quickview' ,function(){
	let _this = $(this);

	let ajax_url = 'quickview.html';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache:  false ,
		dataType :"text",
		data : {'id' : _this.attr('data-id')},
		success : function (data){
			let json = JSON.parse(data);
			if(json.result == 1){
				$('#myModal-quickview').html(json.html);
				$('#myModal-quickview').modal('show');
			}else{
				toastr.error(json.notifi,'');
			}
		}
	});
});
//cartadd button
function cartadd(id){
	let _this = $(this);
	console.log(_this.attr('data-redirect'));
	let ajax_url = 'cart/ajax/cart/addCartFunction';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {id: id},
		success : function (result){
			let json = JSON.parse(result);
			if(json.result == "true"){
				toastr.success('Thêm sản phẩm vào giỏ hàng thành công','');
				//cập nhập html giỏ hàng header
				$('.js_shoppingcart_box').html(json.html_header_cart);
				$('.js_total_item_cart').html(json.total_cart);
				$('.js_total').html(json.total);
			}else{
				toastr.error('Đã xảy ra lỗi','');
			}
		}
	});
	if(_this.attr('data-redirect') == "true"){
		window.location= "/thanh-toan";
	}
	return false;

}
$('.cartadd').click(function () {
	let _this = $(this);
	id = _this.attr('data-id');
	quantity = _this.attr('data-quantity');
	color = _this.attr('data-color');
	mattrai = _this.attr('data-mattrai');
	matphai = _this.attr('data-matphai');
	color_check = _this.attr('data-color-check');
	mattrai_check = _this.attr('data-mattrai-check');
	matphai_check = _this.attr('data-matphai-check');
	let ajax_url = 'cart/ajax/cart/addCartFunction';
	/*if(color_check === 'true' && color === ''){
		$('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
		$('.errorDetails').html('Vui lòng chọn màu sắc');return false;
	}*/
	if(mattrai_check === 'true' && mattrai === ''){
		$('.errorDetails').show();
		$('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
		$('.errorDetails').html('Vui lòng chọn độ cận');return false;
	}else{
		$('.errorDetails').hide();
	}
	if(quantity <= 0){
		$('.errorDetails').show();

		$('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
		$('.errorDetails').html('Vui lòng chọn số lượng sản phẩm');return false;
	}else{
		$('.errorDetails').hide();
	}
	// if(matphai_check === 'true' && matphai === ''){
	// 	$('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
	// 	$('.errorDetails').html('Vui lòng chọn mắt phải');return false;
	// }
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {id: id,quantity: quantity,color: color,mattrai: mattrai,matphai: matphai,color_check:color_check,mattrai_check:mattrai_check,matphai_check:matphai_check},
		success : function (result){
			let json = JSON.parse(result);
			if(json.result == "true"){
				toastr.success('Thêm sản phẩm vào giỏ hàng thành công','');
				$('.cart_count').html(json.total_cart);
				if(_this.attr('data-redirect') == "true"){
					window.location= "thanh-toan.html";
				}
			}else{
				toastr.error('Đã xảy ra lỗi','');
			}
		}
	});

	return false;
})
function wishlistadd(id,customerid){
	let _this = $(this);
	let ajax_url = 'cart/ajax/cart/wishlistadd';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {id: id,customerid: customerid},
		success : function (result){
			let json = JSON.parse(result);
			if(json.result == 1){
				toastr.success(json.success,'');
			}else{
				toastr.error(json.error,'');
			}
		}
	});
	return false;
}
function delele_wishlistadd(id,customerid){
	let _this = $(this);
	let ajax_url = 'cart/ajax/cart/delele_wishlistadd';
	$.ajax({
		url : ajax_url,
		type : "post",
		cache: 	false ,
		dataType:"text",
		data : {id: id,customerid: customerid},
		success : function (result){
			let json = JSON.parse(result);
			if(json.result == 1){
				toastr.success(json.success,'');
				setTimeout(function(){ window.location.href = 'wish-list.html'; }, 1200);
			}else{
				toastr.error(json.error,'');
			}
		}
	});
	return false;

}
//add sản phẩm vào giỏ hàng
$(document).on('click touch' ,'.js_buy' ,function(){
	render_price();
	let _this = $(this);
	let conditon = _this.attr('data-conditon');
	if(conditon == 'true'){

		let param = {
			'id' : _this.attr('data-id'),
			'quantity' : _this.attr('data-quantity'),
			'attrids'  : _this.attr('data-attrids'),
			'promotionalid': _this.attr('data-promotionalid'),
			'name': _this.attr('data-name'),
			'content': _this.attr('data-content'),
			'price': _this.attr('data-price'),
			'option': _this.attr('data-option'),

		};
		let ajax_url = 'cart/ajax/cart/addCart';
		$.ajax({
			url : ajax_url,
			type : "post",
			cache: 	false ,
			dataType:"text",
			data : {
				content: param.content, name: param.name, quantity: param.quantity, attrids: param.attrids, promotionalid: param.promotionalid, id: param.id, price: param.price, option: param.option
			},
			success : function (result){
				let json = JSON.parse(result);
				if(json.result == "true"){
					toastr.success('Thêm sản phẩm vào giỏ hàng thành công','');
					//cập nhập html giỏ hàng header
					$('.cart_listheader').html(json.html_header_cart);
					$('.cart_count').html(json.total_cart);
					$('.number-items').html(json.total_cart);
					$('.cart_totalprice').html(json.total+'đ');
					$('#mini-cart-block').addClass('active')

				}else{
					toastr.error('Đã xảy ra lỗi','');
				}
			}
		});
		// if(_this.attr('data-redirect') == "true"){
		// 	 window.location = "thanh-toan.html";
		// }
	}else{
		toastr.error('Bạn phải chọn chương trình khuyến mãi hoặc phiên bản (nếu có)','');
	}
	return false;
});