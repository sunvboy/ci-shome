$(document).ready(function(){
	$('.js_close_windown').click(function(){
		close();
	});
	$('.js_change_input_1').click(function(){
		$('.js_change_input').trigger('click');
	});
	$('.js_change_input').click(function(){
		let _this = $(this);
		let val = _this.attr('data-val').trim();
		_this.hide();
		_this.next().val(val);
		_this.next().show().trigger('change');
	});
	$('.js_open_windown').click(function(){
		let h = screen.availHeight;
		let w = screen.availWidth;
		window.open(this.href, 'chorme', 'top='+h*10/100+', left='+w*10/100+', width='+w*80/100+',height='+h*80/100);
		return false;
	});
	if($('#article_catalogue').length){
		select2($('#article_catalogue'));
	}
	if(typeof catalogueid !='undefined'  ){
		pre_select2('article_catalogue',catalogueid);
	}
	
	
	if($('#tag').length){
		select2($('#tag'));
	}
	
	
	if(typeof tag !='undefined'  ){
		clearTimeout(time);
		time = setTimeout(function(){
			pre_select2('tag',tag)
		},100);
	}
	
	

	
	// Cập nhật trạng thái
	
	$(document).on('click','.pagination li a', function(){
		let _this = $(this);
        let page = _this.attr('data-ci-pagination-page');
		let perpage = $('.perpage').val();
		let keyword = $('input[name="keyword"]').val();
		let promotionalid = $('select[name="promotionalid"]').val();
		let couponid = $('select[name="couponid"]').val();
		let date_added = $('input[name="date_added"]').val();
		let date_modified = $('input[name="date_modified"]').val();
		let status = $('select[name="status"]').val();
		let object = {
			'perpage' : perpage,
			'page'    : page,
			'keyword' : keyword,
			'promotionalid' : promotionalid,
			'couponid' : couponid,
			'date_added' : date_added,
			'date_modified' : date_modified,
			'status' : status,
		}
		keyword = keyword.trim();
		
		clearTimeout(time);
		if(keyword.length > 2){
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}else{
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}
		return false;
	});
	
	$(document).on('change','.publish',function(){
		let _this = $(this);
		let objectid = _this.attr('data-id');
		let formURL = 'article/ajax/article/status';
			$.post(formURL, {
				objectid: objectid},
				function(data){
					
				});
	});
	var time;
	$(document).on('keyup change','.filter', function(){
		let _this = $(this);
		let page = $('.pagination .active a').text();
		let perpage = $('.perpage').val();
		let keyword = $('input[name="keyword"]').val();
		let promotionalid = $('select[name="promotionalid"]').val();
		let couponid = $('select[name="couponid"]').val();
		let date_added = $('input[name="date_added"]').val();
		let date_modified = $('input[name="date_modified"]').val();
		let status = $('select[name="status"]').val();
		let object = {
			'perpage' : perpage,
			'page'    : page,
			'keyword' : keyword,
			'promotionalid' : promotionalid,
			'couponid' : couponid,
			'date_added' : date_added,
			'date_modified' : date_modified,
			'status' : status,
		}
		keyword = keyword.trim();
		console.log(object);
		clearTimeout(time);
		if(keyword.length > 2){
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}else{
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}
	});
	
	
	
	
	
});

function get_list_object(param){
	let ajaxUrl = 'order/ajax/order/listorder';
	$.get(ajaxUrl, {
		perpage : param.perpage,page : param.page,keyword : param.keyword,promotionalid :param.promotionalid,couponid : param.couponid,date_added : param.date_added,date_modified : param.date_modified,status : param.status},
		function(data){
			let json = JSON.parse(data);
			$('#ajax-content').html(json.html);
			$('#pagination').html(json.pagination);
			$('#total_row').html(json.total_row);
			$('#totalALL').html(json.listTotal);
			$('#totalCompleted').html(json.listTotalCompleted);
			$('#totalCompletedAfter').html(json.listTotalCompletedAfter);
		});
}
$(document).on('click','.ajax-delete-order',function(){
	let _this = $(this);
	let param = {
		'title' : _this.attr('data-title'),
		'id'    : _this.attr('data-id'),

	}
	let parent = _this.attr('data-parent'); // Đây là khối mà sẽ ẩn sau khi xóa
	swal({
			title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
			text: param.title,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Thực hiện!",
			cancelButtonText: "Hủy bỏ!",
			closeOnConfirm: false,
			closeOnCancel: false },
		function (isConfirm) {

			if (isConfirm) {
				let ajax_url = 'order/ajax/order/ajax_delete';
				$.post(ajax_url, {id: param.id},
					function(data){
						if(data == 0){
							sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại')
						}else{
							swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
							window.location.href = "order/backend/order/view.html";

						}
					});

			} else {
				swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
			}
		});
});