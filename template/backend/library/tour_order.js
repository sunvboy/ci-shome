$(document).ready(function(){



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
        let object = {
            'perpage' : perpage,
            'page'    : page,
            'keyword' : keyword,
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


    var time;
    $(document).on('keyup change','.filter', function(){
        let _this = $(this);
        let page = $('.pagination .active a').text();
        let perpage = $('.perpage').val();
        let keyword = $('input[name="keyword"]').val();
        let object = {
            'perpage' : perpage,
            'page'    : page,
            'keyword' : keyword,
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
    let ajaxUrl = 'tour/ajax/tour/listorderTour';
    $.get(ajaxUrl, {
            perpage : param.perpage,page : param.page,keyword : param.keyword},
        function(data){
            let json = JSON.parse(data);
            $('#ajax-content').html(json.html);
            $('#pagination').html(json.pagination);
            $('#total_row').html(json.total_row);
        });
}