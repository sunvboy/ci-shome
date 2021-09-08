<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->fcDevice = $this->config->item('fcDevice');
        $this->load->library('session');
    }

    public function index()
    {


        //end
        $this->cache->clean();
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7 * 3600);

        if (!$slide = $this->cache->get('slide')) {
            $slide = slide(array('keyword' => 'main-banner'), $this->fc_lang);
            $data['slide'] = $slide;
            $this->cache->save('slide', $slide, 200);
        } else {
            $data['slide'] = $slide;
        }

        if (!$albums = $this->cache->get('albums')) {
            $albums = slide(array('keyword' => 'banner-ads'), $this->fc_lang);
            $data['albums'] = $albums;
            $this->cache->save('albums', $albums, 200);
        } else {
            $data['albums'] = $albums;
        }

        if (!$HomeCategoryNem = $this->cache->get('HomeCategoryNem')) {
            $HomeCategoryNem = slide(array('keyword' => 'HomeCategoryNem'), $this->fc_lang);
            $data['HomeCategoryNem'] = $HomeCategoryNem;
            $this->cache->save('HomeCategoryNem', $HomeCategoryNem, 200);
        } else {
            $data['HomeCategoryNem'] = $HomeCategoryNem;
        }
         if (!$HomepageSize = $this->cache->get('HomepageSize')) {
             $HomepageSize = slide(array('keyword' => 'HomepageSize'), $this->fc_lang);
            $data['HomepageSize'] = $HomepageSize;
            $this->cache->save('HomepageSize', $HomepageSize, 200);
        } else {
            $data['HomepageSize'] = $HomepageSize;
        }


        /*
        if (!$anh360 = $this->cache->get('anh360')) {
            $anh360 = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical',
                'table' => 'media_catalogue',
                'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($anh360) && is_array($anh360) && count($anh360)) {
                foreach ($anh360 as $key => $val) {
                    $anh360[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'media',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 5,
                        'order_by' => '`object`.`order` asc, `object`.`id` asc',
                    ));
                }
            }
            $data['anh360'] = $anh360;
            $this->cache->save('anh360', $anh360, 200);
        } else {
            $data['anh360'] = $anh360;
        }

        */
        if (!$danhmuc = $this->cache->get('danhmuc')) {
            $danhmuc = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical,description',
                'table' => 'article_catalogue',
                'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($danhmuc) && is_array($danhmuc) && count($danhmuc)) {
                foreach ($danhmuc as $key => $val) {

                    $danhmuc[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'article',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`description`, `object`.`created`, `object`.`viewed`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 3,
                        'order_by' => '`object`.`order` asc, `object`.`id` desc',
                    ));
                }
            }
            $data['danhmuc'] = $danhmuc;
            $this->cache->save('danhmuc', $danhmuc, 200);
        } else {
            $data['danhmuc'] = $danhmuc;
        }


        if (!$tintuc = $this->cache->get('tintuc')) {
            $tintuc = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical,description',
                'table' => 'article_catalogue',
                'limit' => 1,
                'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($tintuc) && is_array($tintuc) && count($tintuc)) {
                foreach ($tintuc as $key => $val) {
                    $tintuc[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'article',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`description`, `object`.`created`, `object`.`viewed`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 6,
                        'order_by' => '`object`.`order` asc, `object`.`id` desc',
                    ));
                }
            }
            $data['tintuc'] = $tintuc;
            $this->cache->save('tintuc', $tintuc, 200);
        } else {
            $data['tintuc'] = $tintuc;
        }



//        $data['sanphambanchay'] = $this->Autoload_Model->_get_where(array(
//            'select' => 'id, title, canonical,image,price,price_sale,price_contact,albums',
//            'table' => 'product',
//            'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang),
//            'order_by' => 'order asc, id desc'), true);
        //danh mục sản phẩm
        if (!$product_catalog_ishome = $this->cache->get('product_catalog_ishome')) {
            $product_catalog_ishome = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, canonical,image',
                'table' => 'product_catalogue',
                'limit' => 3,
                'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang),
                'order_by' => 'order asc, id desc'), true);
            /*if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) {
                foreach ($product_catalog_ishome as $key => $val) {
                    // Danh mục con
                    $product_catalog_ishome[$key]['child'] = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title, slug, canonical, lft, rgt',
                        'table' => 'product_catalogue',
                        'where' => array('publish' => 0, 'parentid' => $val['id']),'order_by' => 'order asc, id desc'), true);
                }
            }*/
            if (isset( $product_catalog_ishome) && is_array( $product_catalog_ishome) && count( $product_catalog_ishome)) {
                foreach ($product_catalog_ishome as $keyC => $valC) {
                    // Sản phẩm thuộc danh mục con
                    $product_catalog_ishome[$keyC]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'product',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`price`, `object`.`price_sale`, `object`.`price_contact`,`object`.`description`,`object`.`image_json`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                        'catalogueid' => $valC['id'],
                        'limit' => 6,
                        'order_by' => '`object`.`order` asc, `object`.`id` desc',
                    ));

                }
            }
            $data['product_catalog_ishome'] = $product_catalog_ishome;
            $this->cache->save('product_catalog_ishome', $product_catalog_ishome, 200);
        } else {
            $data['product_catalog_ishome'] = $product_catalog_ishome;
        }
        //echo "<pre>";var_dump($product_catalog_ishome);die;

        /*
                if (!$product_catalog_highlight = $this->cache->get('product_catalog_highlight')) {
                    $product_catalog_highlight = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title, slug, canonical, lft, rgt',
                        'table' => 'product_catalogue',
                        'limit' => 10,
                        'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);

                    if (isset($product_catalog_highlight) && is_array($product_catalog_highlight) && count($product_catalog_highlight)) {
                        foreach ($product_catalog_highlight as $key => $val) {
                            // Danh mục con
                            $product_catalog_highlight[$key]['child'] = $this->Autoload_Model->_get_where(array(
                                'select' => 'id, title, slug, canonical, lft, rgt',
                                'table' => 'product_catalogue',
                                'limit' => 5,
                                'where' => array('publish' => 0, 'parentid' => $val['id'])), true);

                    // Sản phẩm thuộc danh mục lớn
                    $product_catalog_highlight[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'product',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`price`, `object`.`price_sale`, `object`.`price_contact`,`object`.`customerid`',
                        'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                        'catalogueid' => $val['id'],
                        'limit' => 4,
                        'order_by' => '`object`.`order` asc, `object`.`id` asc',
                    ));
                }
            }

            $data['product_catalog_highlight'] = $product_catalog_highlight;
            $this->cache->save('product_catalog_highlight', $product_catalog_highlight, 200);
        } else {
            $data['product_catalog_highlight'] = $product_catalog_highlight;
        }
        */
        $data['canonical'] = base_url();
        $data['meta_title'] = $this->fcSystem['seo_meta_title'];
        $data['meta_description'] = $this->fcSystem['seo_meta_description'];
        $data['meta_image'] = $this->fcSystem['seo_meta_images'];
        $data['og_type'] = 'product';


        /*if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'homepage/mobile/home/index';
            $this->load->view('homepage/mobile/layout/home', isset($data) ? $data : NULL);
        }else{

        }*/

        $data['template'] = 'homepage/frontend/home/index';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);

    }

    public function tra_gop_online()
    {
        $product_catalog_highlight = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, canonical,image,image_json',
            'table' => 'product_catalogue',
            'limit' => 3,
            'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang),
            'order_by' => 'order asc, id desc'), true);

        if (isset( $product_catalog_highlight) && is_array( $product_catalog_highlight) && count( $product_catalog_highlight)) {
            foreach ($product_catalog_highlight as $keyC => $valC) {
                // Sản phẩm thuộc danh mục con
                $product_catalog_highlight[$keyC]['post'] = $this->Autoload_Model->_condition(array(
                    'module' => 'product',
                    'select' => '`object`.`id`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`price`, `object`.`price_sale`, `object`.`price_contact`,`object`.`description`,`object`.`image_json`',
                    'where' => '`object`.`publish_time` <= \'' . gmdate('Y-m-d H:i:s', time() + 7 * 3600) . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'catalogueid' => $valC['id'],
                    'limit' => 8,
                    'order_by' => '`object`.`order` asc, `object`.`id` desc',
                ));

            }
        }

        $data['product_catalog_highlight'] = $product_catalog_highlight;
        $data['canonical'] = 'tra-gop-online.html';
        $data['meta_title'] = 'Trả góp online';
        $data['meta_description'] = 'Trả góp online';
        $data['meta_image'] = '';
        $data['og_type'] = 'product';
        $data['template'] = 'homepage/frontend/home/tra_gop_online';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }
    public function store()
    {

        $data['Liststores'] = $this->Autoload_Model->_get_where(array(
            'select' =>'phone,email,address,lat,long,fullname,cityid,districtid,(SELECT name FROM vn_province WHERE support.cityid = vn_province.provinceid) as address_city, (SELECT name FROM vn_district WHERE support.districtid = vn_district.districtid) as address_distric',
            'table' =>'support',
            'where' =>array('publish'=>0)
        ),TRUE);



        $data['canonical'] = 'store.html';
        $data['meta_title'] = 'Hệ thống cửa hàng';
        $data['meta_description'] = 'Hệ thống cửa hàng';
        $data['meta_image'] = '';
        $data['og_type'] = 'product';
        $data['template'] = 'homepage/frontend/home/store';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }
    public function doi_tac()
    {




        $data['canonical'] = 'store.html';
        $data['meta_title'] = 'Đối tác';
        $data['meta_description'] = 'Đối tác';
        $data['meta_image'] = '';
        $data['og_type'] = 'product';
        $data['template'] = 'homepage/frontend/home/doi-tac';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function getLocation_store(){
        $keyword = $this->input->post('keyword');
        $value = $this->input->post('value');
        $Liststores = $this->Autoload_Model->_get_where(array(
            'select' =>'districtid',
            'table' =>'support',
            'query' => '(cityid = \''.$keyword.'\'  AND `publish` = 0 ) ',
        ),TRUE);

        $groupValue = [];
        if (isset($Liststores)) {
            $groupValue = groupValue($Liststores, 'districtid');
            $count = count($Liststores);
        }else{
            $count = 0;
        }
        $html = '<option data-key="" value="0" data-province="'.$keyword.'">-- Quận / Huyện --</option>';
        if(isset($groupValue)){
            foreach ($groupValue as $k=>$v){
                $district = $this->Autoload_Model->_get_where(array(
                    'select' => 'name,provinceid',
                    'table' => ' vn_district',
                    'where' => array('districtid' => $k)
                ));
                if(isset($district)){
                    $html .= '<option data-province="'.$district['provinceid'].'" data-key="'.$k.'" value="'.$value.'">'.$district['name'].'</option>';

                }
            }
        }
        echo json_encode(array('html' => $html,'count'=>$count));

    }
    public function getDistrict_store(){
        $keyword = $this->input->post('keyword');
        $provinceid = $this->input->post('provinceid');
        if($keyword != ''){
            $Liststores = $this->Autoload_Model->_get_where(array(
                'select' =>'phone,email,address,lat,long,fullname,cityid,districtid,(SELECT name FROM vn_province WHERE support.cityid = vn_province.provinceid) as address_city, (SELECT name FROM vn_district WHERE support.districtid = vn_district.districtid) as address_distric',
                'table' =>'support',
                'query' => '(districtid = \''.$keyword.'\'  AND `publish` = 0 ) ',
            ),TRUE);

        }else{

            $Liststores = $this->Autoload_Model->_get_where(array(
                'select' =>'phone,email,address,lat,long,fullname,cityid,districtid,(SELECT name FROM vn_province WHERE support.cityid = vn_province.provinceid) as address_city, (SELECT name FROM vn_district WHERE support.districtid = vn_district.districtid) as address_distric',
                'table' =>'support',
                'query' => '(cityid = \''.$provinceid.'\'  AND `publish` = 0 ) ',
            ),TRUE);

        }


        $html = '';
        if(isset($Liststores)){
            foreach ($Liststores as $k=>$val){
                $count = count($Liststores);
                $html .= '<li class="showroom-item loc_link result-item"
                                            data-brand="'.$val['address_distric'].'"
                                            data-address="'.$val['address'].'"
                                            data-phone="'.$val['phone'].'"
                                            data-lat="'.$val['lat'].'"
                                            data-long="'.$val['long'].'">
                                            <div class="heading" style="display: flex">

                                                <p class="name-label" style="flex: 1">
                                                    <span>'.($k + 1).'</span>.<strong
                                                            data-bind="text: name">'.$val['fullname'].'</strong>
                                                </p>
                                            </div>
                                            <div class="details">
                                                <p class="address" style="flex:1"><em>'.$val['address'].'</em>
                                                </p>

                                                <p class="button-desktop button-view">
                                                    <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
                                                    <a class="arrow-right"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                                </p>
                                                <p class="button-mobile button-view">
                                                    <a target="_blank" href="https://www.google.com/maps/dir//'.$val['lat'].','. $val['long'].'">Tìm đường</a>
                                                    <a class="arrow-right" target="_blank" href="https://www.google.com/maps/dir//'.$val['lat'].','. $val['long'].'"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                                </p>
                                            </div>
                                        </li>';

            }
        }else{
            $count = 0;
        }
        echo json_encode(array('html' => $html,  'count' =>$count));

    }
    public function search_autocomplete(){
        $keyword = $this->input->get('keyword');
        $productITEM = $this->Autoload_Model->_get_where(array(
            'distinct' => 'true',
            'select' => 'id,title,price,price_sale,canonical,image',
            'table' =>'product',
            'limit' =>6,
            'order_by' =>'id desc',
            'keyword' => '(title LIKE \'%'.$keyword.'%\'  AND `publish` = 0  AND  `alanguage` = \''.$this->fc_lang.'\') ',
        ),TRUE);
        $productITEMCount = $this->Autoload_Model->_get_where(array(
            'distinct' => 'true',
            'table' =>'product',
            'count' =>'true',
            'keyword' => '(title LIKE \'%'.$keyword.'%\'  AND `publish` = 0  AND  `alanguage` = \''.$this->fc_lang.'\') ',
        ),TRUE);
        $count = 0;
        if(!empty($productITEMCount)){
            $count = (int)((int)($productITEMCount)-6);

        }
        $html = '';

        if(isset($productITEM) && count($productITEM) && is_array($productITEM)){



                $html .= '<div class="searchsuite-autocomplete" id="searchsuite-autocomplete"><div class="products-result">
                                                <ul id="product">';
            foreach ($productITEM as $key=>$val) {
                $getPrice = getPriceFrontend(array('productDetail' => $val));
                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                $html .= '<li>
                                                        <a href="' . $href . '">
                                                            <div class="qs-option-image"><img
                                                                        alt="' . $val['title'] . '"
                                                                        src="' . $val['image'] . '"></div>
                                                            <div class="qs-option-info">
                                                                <div class="qs-option-title">' . $val['title'] . '
                                                                </div>
                                                                <div class="qs-option-price">
                                                                    <div class="price-box">
                                                                        <div class="normal-price"><span class="price">' . $getPrice['price_final'] . '</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>';
            }
            $html .= '</ul>
                                            </div>
                                            
                                            
                                            <div class="title"><a style="    border: 1px solid #20315c;
    border-radius: 4px;
    color: #20315c;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 15px;
    cursor: pointer;
    display: inline-block;" href="tim-kiem.html?keyword='.$keyword.'" class="all-result">Xem tất cả ('.$count.' sản phẩm)</a></div></div>';


        }else{
            $html .='<div class="body-no-result"><div class="icon-no-result"></div> <div class="description-no-result">Vui lòng tìm kiếm cho <br> kết quả khác</div></div>';
        }


        echo json_encode(array('html' => $html));
    }


    public function ajaxCatalogue()
    {
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
        $ta = '';
        $id = $this->input->post('id');
        $anh360 = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title,canonical,isaside',
            'table' => 'media_catalogue',
            'where' => array('id' => $id)));
        $html = '';
        if (!empty($anh360)) {

            $anh360POST = $this->Autoload_Model->_condition(array(
                'module' => 'media',
                'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`viewed`, `object`.`video_iframe`',
                'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                'catalogueid' => $anh360['id'],
                'limit' => 3,
                'order_by' => '`object`.`order` asc, `object`.`id` asc',
            ));
            if (!empty($anh360POST)) {

                $html .= '<div class="container-fluid">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">';
                $html .= '<div class="content-Experimental-left">
                        <div class="item">
                            <h2 class="title-primary1">TRẢI NGHIỆM ' . $anh360['title'] . '</h2>';
                foreach ($anh360POST as $key => $val) {
                    if ($anh360['isaside'] == 1) {
                        $ta = 'target="_blank"';
                        $href = $val['video_iframe'];
                    } else {
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                    }
                    if ($key == 0) {

                        $html .= '<div class="image">
                                        <a href="' . $href . '" ' . $ta . '><img src="' . $val['image'] . '" alt="' . $val['title'] . '"></a>

                                        <h3 class="title-category"><a ' . $ta . ' href="' . $href . '">' . $val['title'] . '</a></h3>
                                    </div>';
                    }
                }
                $html .= '</div></div>

                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="content-Experimental-right">

                        <h2 class="title-primary1">' . $anh360['title'] . '</h2>';
                foreach ($anh360POST as $key => $val) {
                    if ($anh360['isaside'] == 1) {
                        $ta = 'target="_blank"';
                        $href = $val['video_iframe'];
                    } else {
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                    }
                    if ($key > 0) {


                        $html .= '<div class="item1 item11">
                                <div class="image">
                                    <a ' . $ta . ' href="' . $href . '"><img src="' . $val['image'] . '" alt="' . $val['title'] . '"></a>

                                    <div class="icon"><img src="template/frontend/noithat-PC/images/icon14.png" alt="' . $val['title'] . '">
                                    </div>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title"><a ' . $ta . ' href="' . $href . '">' . $val['title'] . '</a></h3>
                                    <ul class="hidden">
                                         <li>
                                                <div class="fb-like" data-href="' . $href . '" data-width=""
                                                     data-layout="button" data-action="like" data-size="small"
                                                     data-share="true"></div>
                                            </li>
                                        <li>' . $val['viewed'] . ' <img src="template/frontend/noithat-PC/images/i3.png" alt=""></li>
                                    </ul>
                                </div>
                            </div>';


                    }
                }


                $html .= '</div>
                </div>
            </div>
        </div>';

            } else {
                $html .= '<div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 20px;">Dữ liệu đang được cập nhập</div></div></div>';
            }
        }
        echo json_encode(array('html' => $html));
        die;
    }


}

