// chọn nhiều ảnh cho từng phiên bản
$(document).on('click','.js_choose_album',function(){
	let _this = $(this)
	window.KCFinder = {
		callBackMultiple: function(files) {
			window.KCFinder = null;
			let html = '';
			let valInput = '';
			for (var i = 0; i < files.length; i++){
				valInput = valInput + ',"' +files[i]+'"';
				html = html + '<img src="'+files[i]+'" class="m-r" alt="">';
			}
			valInput = valInput.substr(1,valInput.length);
			valInput = '['+ valInput + ']';
			valInput = btoa(valInput);
			_this.parents('tr').find("input[name='image_version[]']").val(valInput);
			html = '<tr class="js_album_extend"><td colspan=100>'+html+'</td></tr>';
			if(_this.parents('tr').next().hasClass('js_album_extend')){
				_this.parents('tr').next().remove();
			}
			_this.parents('tr').after(html);
		}
	};
	window.open(BASE_URL + 'plugin/kcfinder-3.12/browse.php?type=images&dir=images/public', 'kcfinder_image',
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable=1, scrollbars=0, width=1080, height=800'
	);
});
function openKCFinderAlbum(field, type, result) {
	window.KCFinder = {
		callBack: function (url) {
			field.attr('src', url);
			field.parent().next().val(url);
			window.KCFinder = null;
		}
	};
	if (typeof(type) == 'undefined') {
		type = 'images';
	}
	window.open('<?php echo BASE_URL;?>plugin/kcfinder-3.12-frontend/browse.php?type=' + type + '&dir=images/public', 'kcfinder_image',
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable=1, scrollbars=0, width=1080, height=800'
	);
	return false;
}
$(document).on('click', '.image_small', function(){
	openKCFinderAlbum($(this).find('img'));
});
function image_render(src = ''){
	let html ='<li class="ui-state-default">';
	html = html+ '<div class="thumb">';
	html = html+ '<span class="image img-scaledown">';
	html = html+ '<img src="'+src+'" alt="" /> <input type="hidden" value="'+src+'" name="album[]" />';
	html = html+ '</span>';
	html = html+ '<div class="overlay"></div>';
	html = html+ '<div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>';
	html = html+ '</div>';
	html = html+ '</li>';
	return html;
}
function openKCFinderImage(button) {
	window.KCFinder = {
		callBackMultiple: function(files) {
			window.KCFinder = null;
			for (var i = 0; i < files.length; i++){
				$('.upload-list .row #sortable').prepend(image_render(files[i]));
				$('.click-to-upload ').hide();
				$('.upload-list').removeClass('hidden');
				$('.upload-list').show();
			}
		}
	};
	window.open(BASE_URL + 'plugin/kcfinder-3.12-frontend/browse.php?type=images&dir=images/public', 'kcfinder_image',
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable=1, scrollbars=0, width=1080, height=800'
	);
}
$(document).on('click' ,'.price' ,function(){
	let _this = $(this);
	_this.find('span').hide();
	_this.find('input').show();
	_this.parents('tr').find('input[name="checkbox[]"]').prop('checked', true);
	_this.parents('tr').find('.label-checkboxitem').addClass('checked');
});
function slug(title){
	title = cnvVi(title);
	return title;
}
function cnvVi(str) {
	str = str.toLowerCase();
	str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
	str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
	str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
	str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
	str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
	str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
	str = str.replace(/đ/g, "d");
	str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
	str = str.replace(/-+-/g, "-");
	str = str.replace(/^\-+|\-+$/g, "");
	return str;
}
function replace(Str=''){
	if(Str==''){
		return '';
	}else{
		Str = Str.replace(/\./gi, "");
		return Str;
	}
}
$(document).on('keyup ', '.title', function(){
	let _this = $(this);
	let metaTitle = _this.val();
	let totalCharacter = metaTitle.length;
	if(totalCharacter > 70){
		$('.meta-title').addClass('input-error');
	}else{
		$('.meta-title').removeClass('input-error');
	}
	let slugTitle = slug(metaTitle);
	if($('.meta-title').val() == ''){
		$('.g-title').text(metaTitle);
		$('.canonical').val(metaTitle);
	}
	let canonical = $('.canonical');
	if(canonical.attr('data-flag') == 0){
		canonical.val(slugTitle);
		$('.g-link').text(BASE_URL + slugTitle + '.html');
		$('.canonical').text(slugTitle);
	}
});
//đoạn js này để kéo thả ảnh
$( function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
});

if(typeof(layoutid) != 'undefined' && layoutid != ''){
	let type = media_loading(layoutid, 'post');
}

$(document).on('change','.layout', function(){
	let _this = $(this);
	let catid = _this.val();
	media_loading(catid);
	return false;
});
$(document).on('click','.delete-image', function(){
	let _this = $(this);
	_this.parents('li').remove();
	if($('.upload-list li').length <= 0){
		$('.click-to-upload').show();
		$('.upload-list').hide();
	}
	return false;
});
// $(document).on('change keyup blur','.int',function(){
// 	let data = $(this).val();
// 	if(data == '' ){
// 		$(this).val();
// 		return false;
// 	}
// 	data = data.replace(/\./gi, "");
// 	$(this).val(addCommas(data));
// 	// khi Ä‘Ã¡nh chá»¯ thÃ¬ vá» 0
// 	data = data.replace(/\./gi, "");
// 	if(isNaN(data)){
// 		$(this).val();
// 		return false;
// 	}
// });
$(document).on('change blur','.float',function(){
	let data = $(this).val();
	if(data == '' ){
		$(this).val();
		return false;
	}
	// khi Ä‘Ã¡nh chá»¯ thÃ¬ vá» 0
	data = data.replace(/\./gi, "");
	if(isNaN(data)){
		$(this).val();
		return false;
	}
});
