<?php $this->load->view('homepage/frontend/core/notification'); ?>
<style>
    .toast-title{font-weight: 700}.toast-message{-ms-word-wrap: break-word;word-wrap: break-word}.toast-message a, .toast-message label{color: #fff}.toast-message a:hover{color: #ccc;text-decoration: none}.toast-close-button{position: relative;right: -.3em;top: -.3em;float: right;font-size: 20px;font-weight: 700;color: #fff;-webkit-text-shadow: 0 1px 0 #fff;text-shadow: 0 1px 0 #fff;opacity: .8;-ms-filter: alpha(Opacity=80);filter: alpha(opacity=80)}.toast-close-button:focus, .toast-close-button:hover{color: #000;text-decoration: none;cursor: pointer;opacity: .4;-ms-filter: alpha(Opacity=40);filter: alpha(opacity=40)}button.toast-close-button{padding: 0;cursor: pointer;background: 0 0;border: 0;-webkit-appearance: none}.toast-top-center{top: 0;right: 0;width: 100%}.toast-bottom-center{bottom: 0;right: 0;width: 100%}.toast-top-full-width{top: 0;right: 0;width: 100%}.toast-bottom-full-width{bottom: 0;right: 0;width: 100%}.toast-top-left{top: 12px;left: 12px}.toast-top-right{top: 12px;right: 12px}.toast-bottom-right{right: 12px;bottom: 12px}.toast-bottom-left{bottom: 12px;left: 12px}#toast-container{position: fixed;z-index: 999999}#toast-container *{-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box}#toast-container > div{position: relative;overflow: hidden;margin: 0 0 6px;padding: 15px 15px 15px 50px;width: 300px;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;background-position: 15px center;background-repeat: no-repeat;-moz-box-shadow: 0 0 12px #999;-webkit-box-shadow: 0 0 12px #999;box-shadow: 0 0 12px #999;color: #fff;opacity: .8;-ms-filter: alpha(Opacity=80);filter: alpha(opacity=80)}#toast-container > :hover{-moz-box-shadow: 0 0 12px #000;-webkit-box-shadow: 0 0 12px #000;box-shadow: 0 0 12px #000;opacity: 1;-ms-filter: alpha(Opacity=100);filter: alpha(opacity=100);cursor: pointer}#toast-container > .toast-info{background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGwSURBVEhLtZa9SgNBEMc9sUxxRcoUKSzSWIhXpFMhhYWFhaBg4yPYiWCXZxBLERsLRS3EQkEfwCKdjWJAwSKCgoKCcudv4O5YLrt7EzgXhiU3/4+b2ckmwVjJSpKkQ6wAi4gwhT+z3wRBcEz0yjSseUTrcRyfsHsXmD0AmbHOC9Ii8VImnuXBPglHpQ5wwSVM7sNnTG7Za4JwDdCjxyAiH3nyA2mtaTJufiDZ5dCaqlItILh1NHatfN5skvjx9Z38m69CgzuXmZgVrPIGE763Jx9qKsRozWYw6xOHdER+nn2KkO+Bb+UV5CBN6WC6QtBgbRVozrahAbmm6HtUsgtPC19tFdxXZYBOfkbmFJ1VaHA1VAHjd0pp70oTZzvR+EVrx2Ygfdsq6eu55BHYR8hlcki+n+kERUFG8BrA0BwjeAv2M8WLQBtcy+SD6fNsmnB3AlBLrgTtVW1c2QN4bVWLATaIS60J2Du5y1TiJgjSBvFVZgTmwCU+dAZFoPxGEEs8nyHC9Bwe2GvEJv2WXZb0vjdyFT4Cxk3e/kIqlOGoVLwwPevpYHT+00T+hWwXDf4AJAOUqWcDhbwAAAAASUVORK5CYII=) !important}#toast-container > .toast-error{background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHOSURBVEhLrZa/SgNBEMZzh0WKCClSCKaIYOED+AAKeQQLG8HWztLCImBrYadgIdY+gIKNYkBFSwu7CAoqCgkkoGBI/E28PdbLZmeDLgzZzcx83/zZ2SSXC1j9fr+I1Hq93g2yxH4iwM1vkoBWAdxCmpzTxfkN2RcyZNaHFIkSo10+8kgxkXIURV5HGxTmFuc75B2RfQkpxHG8aAgaAFa0tAHqYFfQ7Iwe2yhODk8+J4C7yAoRTWI3w/4klGRgR4lO7Rpn9+gvMyWp+uxFh8+H+ARlgN1nJuJuQAYvNkEnwGFck18Er4q3egEc/oO+mhLdKgRyhdNFiacC0rlOCbhNVz4H9FnAYgDBvU3QIioZlJFLJtsoHYRDfiZoUyIxqCtRpVlANq0EU4dApjrtgezPFad5S19Wgjkc0hNVnuF4HjVA6C7QrSIbylB+oZe3aHgBsqlNqKYH48jXyJKMuAbiyVJ8KzaB3eRc0pg9VwQ4niFryI68qiOi3AbjwdsfnAtk0bCjTLJKr6mrD9g8iq/S/B81hguOMlQTnVyG40wAcjnmgsCNESDrjme7wfftP4P7SP4N3CJZdvzoNyGq2c/HWOXJGsvVg+RA/k2MC/wN6I2YA2Pt8GkAAAAASUVORK5CYII=) !important}#toast-container > .toast-success{background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==) !important}#toast-container > .toast-warning{background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGYSURBVEhL5ZSvTsNQFMbXZGICMYGYmJhAQIJAICYQPAACiSDB8AiICQQJT4CqQEwgJvYASAQCiZiYmJhAIBATCARJy+9rTsldd8sKu1M0+dLb057v6/lbq/2rK0mS/TRNj9cWNAKPYIJII7gIxCcQ51cvqID+GIEX8ASG4B1bK5gIZFeQfoJdEXOfgX4QAQg7kH2A65yQ87lyxb27sggkAzAuFhbbg1K2kgCkB1bVwyIR9m2L7PRPIhDUIXgGtyKw575yz3lTNs6X4JXnjV+LKM/m3MydnTbtOKIjtz6VhCBq4vSm3ncdrD2lk0VgUXSVKjVDJXJzijW1RQdsU7F77He8u68koNZTz8Oz5yGa6J3H3lZ0xYgXBK2QymlWWA+RWnYhskLBv2vmE+hBMCtbA7KX5drWyRT/2JsqZ2IvfB9Y4bWDNMFbJRFmC9E74SoS0CqulwjkC0+5bpcV1CZ8NMej4pjy0U+doDQsGyo1hzVJttIjhQ7GnBtRFN1UarUlH8F3xict+HY07rEzoUGPlWcjRFRr4/gChZgc3ZL2d8oAAAAASUVORK5CYII=) !important}#toast-container.toast-bottom-center > div, #toast-container.toast-top-center > div{width: 300px;margin: auto}#toast-container.toast-bottom-full-width > div, #toast-container.toast-top-full-width > div{width: 96%;margin: auto}.toast{background-color: #030303}.toast-success{background-color: #51a351}.toast-error{background-color: #bd362f}.toast-info{background-color: #2f96b4}.toast-warning{background-color: #f89406}.toast-progress{position: absolute;left: 0;bottom: 0;height: 4px;background-color: #000;opacity: .4;-ms-filter: alpha(Opacity=40);filter: alpha(opacity=40)}@media all and (max-width: 240px){#toast-container > div{padding: 8px 8px 8px 50px;width: 11em}#toast-container .toast-close-button{right: -.2em;top: -.2em}}@media all and (min-width: 241px) and (max-width: 480px){#toast-container > div{padding: 8px 8px 8px 50px;width: 18em}#toast-container .toast-close-button{right: -.2em;top: -.2em}}@media all and (min-width: 481px) and (max-width: 768px){#toast-container > div{padding: 15px 15px 15px 50px;width: 25em}}
</style>
<script src="template/backend/js/plugins/toastr/toastr.min.js"  type="text/javascript"></script>



<script src="template/acore/js/core.js"  type="text/javascript"></script>
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    function changeDrop(stt,id,title,sub_title,price = 0){
        $('.title-attr-'+stt).text(title);
        $('.v-dropdown-item-'+stt).removeClass('js_choose');
        $('.v-dropdown-item-'+stt).removeClass('selected');
        $('.v-dropdown-item-'+id).addClass('selected');
        $('.v-dropdown-item-'+id).addClass('js_choose');
        $('.v-dropdown-container').css('display','none');
        $('.js_buy').attr('data-option', sub_title);
        if(stt == 1){
            $('#js_prd_info').attr('data-price',price);
            $('.js_buy').attr('data-price',price);
            $('.price').html(number_format(price, 0, '.', '.')+' VNĐ');
        }

        loadChange();
    }
    function loadChange() {
        var attr = '';
        var attr_sub_title = '';
        $('.v-dropdown-item.selected').each(function (key, index) {
            let id = $(this).attr('data-id');
            let sub_title = $(this).attr('data-sub-title');
            attr = attr + id + ',';
            attr_sub_title = attr_sub_title + sub_title + '<br>';
        });
        $('.js_buy').attr('data-attrids',attr);
        $('.js_buy').attr('data-option',attr_sub_title);
    }
    loadChange();
</script>
<?php /*<script>
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
        if(color_check === 'true' && color === ''){
            $('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
            $('.errorDetails').html('Vui lòng chọn màu sắc');return false;
        }
        if(mattrai_check === 'true' && mattrai === ''){
            $('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
            $('.errorDetails').html('Vui lòng chọn mắt trái');return false;
        }
        if(matphai_check === 'true' && matphai === ''){
            $('.errorDetails').removeClass('alert alert-danger').addClass('alert alert-danger');
            $('.errorDetails').html('Vui lòng chọn mắt phải');return false;
        }
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

</script>
*/?>