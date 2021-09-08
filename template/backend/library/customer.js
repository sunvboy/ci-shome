
$(document).ready(function(){
    $(document).on('change','.publish',function(){
        let _this = $(this);
        let objectid = _this.attr('data-id');
        let formURL = 'customer/ajax/customer/status';
        $.post(formURL, {
                objectid: objectid},
            function(data){

            });
    });
    /* XÓA RECORD */
    $(document).on('click','.ajax-group-delete',function(){
        //xóa nhiều:
        // 		+ lấy hết giá trị trong all ô đc tích => lưu vào mảng
        //		+ gửi đi controller để xử lý
        let _this = $(this);
        let idCheck = []; //khai báo mảng

        //quét qua toàn bộ input đang checked
        $('.checkbox-item:checked').each(function(){
            idCheck.push($(this).val()); //lưu giá trị của input vào mảng
        });

        //nếu không có bản ghi nào đc check thì show lỗi và thoát
        if(idCheck.length <= 0){
            sweet_error_alert('Có vấn đề xảy ra','Bạn phải chọn ít nhất 1 bản ghi để thực hiện chức năng này');
            return false;
        }


        let param = {
            'title' : _this.attr('data-title'),
            'name'  : _this.attr('data-name'),
            'module': _this.attr('data-module'),
            'list'	: idCheck, //lưu toàn bộ id vào mảng
        }
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
                    let ajax_url = 'customer/ajax/customer/ajax_group_delete';
                    $.post(ajax_url, {
                            param: param },
                        function(data){
                            let json = JSON.parse(data);
                            if(json.error.flag == 1){
                                sweet_error_alert('Có vấn đề xảy ra',json.error.message);
                            }else{
                                $('#listCatalogue tr.bg-active').each(function(){
                                    $(this).hide('slow').remove();
                                });
                                swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
                            }
                        });

                } else {
                    swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
                }
            });
    });

    /* XÓA RECORD */
    $(document).on('click','.ajax-delete',function(){
        let _this = $(this);
        let param = {
            'title' : _this.attr('data-title'),
            'name'  : _this.attr('data-name'),
            'module': _this.attr('data-module'),
            'id'    : _this.attr('data-id')
        }
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
                    let ajax_url = 'customer/ajax/customer/ajax_delete';
                    $.post(ajax_url, {
                            module: param.module, id: param.id},
                        function(data){
                            let json = JSON.parse(data);
                            if(json.error.flag == 1){
                                sweet_error_alert('Có vấn đề xảy ra',json.error.message);
                            }else{
                                _this.parents('tr').hide('slow').remove();
                                swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
                            }
                        });

                } else {
                    swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
                }
            });
    });


    /* LẤY LIST DANH SÁCH THEO customer */
    $(document).on('change','.customer-catalogue',function(){
        let _this = $(this);
        let keyword = $('.keyword').val();
        keyword = $.trim(keyword);
        let catalogueid = _this.val();
        get_list_customer({'keyword' : keyword,'catalogueid' : catalogueid, 'page': 1});
    });



    /* RESET MẬT KHẨU */
    $(document).on('click','.p-reset',function(){
        let _this = $(this);
        let customerID = _this.attr('data-customerid');
        if(customerID == 0){
            sweet_error_alert('Có vấn đề xảy ra','Bạn phải chọn thành viên để thực hiện thao tác này');
        }else{
            swal({
                    title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
                    text: "Mật khẩu sẽ được cài về giá trị mặc định là : 123456xyz sau thao tác này",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Thực hiện!",
                    cancelButtonText: "Hủy bỏ!",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function (isConfirm){
                    if (isConfirm) {
                        let ajaxUrl = 'customer/ajax/customer/reset_password';
                        $.post(ajaxUrl, {
                                customerID: customerID},
                            function(data){
                                let json = JSON.parse(data);
                                if(json.flag == 1){
                                    sweet_error_alert('Có vấn đề xảy ra',json.message);
                                }else{
                                    swal("Cập nhật thành công!", "Reset mật khẩu thành công.", "success");
                                }
                            });

                    } else {
                        swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
                    }
                });
        }
    });
    /* CLICK VÀO THÀNH VIÊN*/
    $(document).on('click','.choose',function(){
        let _this = $(this);
        $('.choose').removeClass('bg-choose'); //remove all trong các thẻ có class = choose
        _this.toggleClass('bg-choose');
        let data  = _this.attr('data-info');
        data = window.atob(data); //decode base64
        let json = JSON.parse(data);
        setTimeout(function(){
            $('.loader').hide();
            $('.p-reset').attr('data-customerid',json.id);
            $('.fullname').html('').html(json.fullname);
            $('#image').attr('src', json.avatar);
            $('.phone').html('').html(json.phone);
            $('.gender').html('').html((json.gender == 1)?'Nam':'Nữ');
            $('.email').html('').html(json.email);
            $('.tencuahang').html('').html(json.account);
            $('.loaihinh').html('').html(json.catalogue_title);
            $('.linkcuahang').html('').html('<a href="'+json.shop_link+'" target="_blank">'+json.shop_link+'</a>');
            $('.address').html('').html(json.address);
            $('.updated').html('').html(json.created);
            $('.catalogue-title').html('').html(json.catalogue_title);
        }, 100); //sau 100ms thì mới thực hiện
    });
    /* END customer */
    if($('#page_catalogue').length){
        select2($('#page_catalogue'));
    }
    if(typeof catalogueid !='undefined'  ){
        pre_select2('page_catalogue',catalogueid);
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
        let keyword = $('.keyword').val();
        let perpage = $('.perpage').val();
        let catalogueid = $('.catalogueid').val();
        let object = {
            'keyword' : keyword,
            'perpage' : perpage,
            'page'    : page,
            'catalogueid' : catalogueid,
        }

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


    var time;
    $(document).on('keyup change','.filter', function(){
        let keyword = $('.keyword').val();
        let perpage = $('.perpage').val();
        let catalogueid = $('.catalogueid').val();
        let object = {
            'keyword' : keyword,
            'perpage' : perpage,
            'catalogueid' : catalogueid,
            'page'    : 1,
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
    });





});

function get_list_object(param){
    let ajaxUrl = 'customer/ajax/customer/listpage';
    $.get(ajaxUrl, {
            perpage: param.perpage, keyword: param.keyword, page: param.page, catalogueid: param.catalogueid},
        function(data){
            let json = JSON.parse(data);
            $('#ajax-content').html(json.html);
            $('#paginationList').html(json.pagination);
            $('#total_row').html(json.total_row);
        });
}
