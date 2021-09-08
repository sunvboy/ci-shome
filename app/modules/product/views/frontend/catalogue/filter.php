<?php

$catalogueid = $detailCatalogue['id'];
$detailCatalogue = $this->Autoload_Model->_get_where(array(
    'select' => 'id, attrid',
    'table' => 'product_catalogue',
    'where' => array('id' => $catalogueid),
));
$attribute_catalogue = getListAttr($detailCatalogue['attrid']);
?>
<style>
    .filter-none {
        display: none;
    }

    .filter-none.open {
        display: inline-block !important;
    }
</style>
<div class="block filter">
    <div class="block-content filter-content">
        <?php if (check_array($attribute_catalogue)) {
            foreach ($attribute_catalogue as $key => $val) { ?>
                <div class="filter-options-item allow" id="<?php echo $val['keyword_cata'] ?>">
                    <div class="filter-label font-bold-stag expander open"
                         onclick="changefilterlabel('<?php echo $val['keyword_cata'] ?>')">
                        <?php echo $key ?>
                        <i aria-hidden="true" class="fa fa-angle-up"></i></div>
                    <div class="filter-none open">
                        <div class="filter-items" style="overflow-y: auto;">
                            <?php if (check_array($val)) {
                                foreach ($val as $sub => $subs) {
                                    if ($sub != 'keyword_cata') {
                                        $html = '<p><a href="javascript:void(0)" onclick="changeFilterREMOVE(' . $sub . ',\'' . $val['keyword_cata'] . '\')">' . $key . ': ' . $subs . '<span><i class="icon-close"></i></span></a></p>'; ?>
                                        <div class="item">
                                            <a href="javascript:void(0)" class="attr attr<?php echo $sub ?>"
                                               data-info="<?php echo base64_encode(json_encode($html)); ?>"
                                               data-id="<?php echo $sub ?>"
                                               data-keyword="<?php echo $val['keyword_cata'] ?>"
                                               onclick="changeFilter(<?php echo $sub ?>,'<?php echo $val['keyword_cata'] ?>')"><?php echo $subs ?></a>
                                        </div>
                                    <?php }
                                }
                            } ?>
                        </div>
                    </div> <!----></div>
            <?php } ?>
        <?php } ?>
        <div class="close-filter">Đóng</div>
    </div>
    <div class="banner-left-sidebar"></div>
</div>
<input type="text" class="hidden" name="attr" value="">
<script>
    function changefilterlabel(keyword_cata) {
        $('#' + keyword_cata).find('.filter-label').toggleClass('open');
        $('#' + keyword_cata).find('.filter-none').toggleClass('open');
    }
    function changeFilter(id, keyword_cata) {
        $('#' + keyword_cata).find('.attr').removeClass('checked');
        $('.attr' + id).addClass('checked');
        changeLOAD();
    }
    function changeFilterREMOVE(id, keyword_cata) {
        $('#' + keyword_cata).find('.attr').removeClass('checked');
        changeLOAD();
    }

    $(document).on('click', '#pagination .filter a', function () {
        let _this = $(this);
        let page = _this.attr('data-ci-pagination-page');
        time = setTimeout(function () {
            get_list_object(page);
        }, 500);
        return false;
    });

    function changeLOAD() {
        var attr = '';
        var html = '';
        $('.attr.checked').each(function (key, index) {
            let data = $(this).attr('data-info');
            data = window.atob(data); //decode base64
            let json = JSON.parse(data);
            let id = $(this).attr('data-id');
            let attr_id = $(this).attr('data-keyword');
            attr = attr + attr_id + ';' + id + ';';
            html = html + json;
        });
        $('#filter-items').html(html);
        $('input[name="attr"]').val(attr).change();
        time = setTimeout(function () {
            get_list_object();
        }, 500);
        return false;
    }
    function get_list_object(page = 1) {
        let attr = $('input[name="attr"]').val();
        let param = {
            'page': page,
            'perpage': 20,
            'catalogueid': <?php echo $detailCatalogue['id']?>,
            'attr': attr,
        };
        let ajaxUrl = 'filter.html';
        $.get(ajaxUrl, {
                perpage: param.perpage,
                page: param.page,
                catalogueid: param.catalogueid,
                attr: param.attr,
            },
            function (data) {
                let json = JSON.parse(data);
                $('#ajax-content').html(json.html);
                $('#pagination').html(json.pagination);
            });
    }
</script>
