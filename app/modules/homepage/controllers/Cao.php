<?php
//cào sản phẩm
//        include('lib/simple_html_dom.php');
//        include('lib/plugin.php');
//        $arrContextOptions = array(
//            "ssl" => array(
//                "verify_peer" => false,
//                "verify_peer_name" => false,
//            ),
//        );
//        $replaceQ = array(
//            'https://bepnamduong.vn/' => '',
//            'Xem thêm tổng quan' => '',
//            'Xem thêm thông số kĩ thuật' => '',
//            'Xem thêm đặc điểm nổi bật' => '',
//
//
//        );
//        $html = file_get_html('http://traicaynhapkhauhn.com/', false, stream_context_create($arrContextOptions));
//        $tieudeh1 = $html->find('#Product a');

//echo count($tieudeh1);die;
//        foreach ($tieudeh1 as $a) {
//            $htmlChild = file_get_html('https://bepnamduong.vn/' . $a->href, false, stream_context_create($arrContextOptions));
//            //Lấy tiêu đề sản phẩm
//            $tieudehH1 = $htmlChild->find('h1', 0)->innertext;
//            //Lấy xuất xứ
//            $xuatxu = $htmlChild->find('.bgb.bmi', 0)->innertext;
//            //lấy giá sản phẩm
//            $tieudehPrice = $htmlChild->find('#pri', 0)->value;
//            //lấy id sản phẩm
//            $tieudehID = $htmlChild->find('#id', 0)->value;
//            //lấy mô tả sản phẩm
//            $tieudehDescription = $htmlChild->find('.f.padb.dbi', 0);
//            //Lấy thương hiệu
//
//             $tmp_breadcrumb = [];
//             foreach ($htmlChild->find('.breadcrumb a') as $v) {
//                 $tmp_breadcrumb[] =  $v->plaintext;
//             }
//             if(!empty($tmp_breadcrumb)){
//                 $count_breadcrumb =(count($tmp_breadcrumb)-1);
//                 //echo "<pre>";var_dump($);die;
//
//             }
//            //ảnh đại diện và albums ảnh
//            //tạo đường dẫn sản phẩm
//            if (!file_exists('images/' . slug($tieudehID))) {
//                mkdir('images/' . slug($tieudehID), 0777, true);
//            }
//            $tmp_album = [];
//            foreach ($htmlChild->find('#ProImg img') as $img) {
//                $list = explode('/', $img->attr['data-src']);
//                $k = 0;
//                foreach ($list as $keyL => $images) {
//                    $k++;
//                    if (count($list) == $k) {
//                        download_remote_file(url_get . $img->attr['data-src'], 'images/' . slug($tieudehID) . '/' . $images);
//                        $tmp_album[] = 'images/' . slug($tieudehID) . '/' . $images;
//                    }
//                }
//            }
//            //echo "<pre>";var_dump($tmp_album);die;
//
//            //lấy .tabdetail.flexJus
//            $content = '';
//            foreach ($htmlChild->find('.tabdetail.flexJus span') as $v) {
//                if ($v->attr['data-id'] != 'sosanh' && $v->attr['data-id'] != 'danhgia' && $v->attr['data-id'] != 'binhluan') {
//                    //$content .="<h2>".$v->innertext."</h2>";
//                    $content .= $htmlChild->find('#' . $v->attr['data-id'], 0);
//                    foreach ($htmlChild->find('#' . $v->attr['data-id'] . ' img') as $img) {
//                        if (!empty($img->attr['src'])) {
//                            save_image($img->attr['src']);
//                        } else {
//                            save_image($img->attr['data-src']);
//                        }
//                    }
//
//
//                }
//            }
//            /*echo '<h1 style="color: red">' . $tieudehH1 . '</h1>';
//            echo '<h2 style="color: red">' . $xuatxu . '</h2>';
//            echo "<h2 style='color: green'>$tieudehPrice</h2>";
//            if (!empty($tieudehDescription)) {
//                echo "<h2 style='color: green'>Mô tả sản phẩm: </h2>";
//                echo $tieudehDescription;
//            }
//            */
//            $contentI =  strReplaceAssoc($replaceQ, $content);
//            $code= CodeRender('product');
//            $this->Autoload_Model->_create(array(
//                'table'=>'product',
//                'data'=> array(
//                    'title' => htmlspecialchars_decode(html_entity_decode($tieudehH1)),
//                    'slug' => slug(htmlspecialchars_decode(html_entity_decode($tieudehH1))),
//                    'canonical' => slug($tieudehH1),
//                    'description' => !empty($tieudehDescription)?$tieudehDescription:'',
//                    'content' => !empty($contentI)?$contentI:'',
//                    'price' => str_replace('.','',$tieudehPrice),
//                    'price_sale' => 0,
//                    'code' => $code,
//                    'alanguage' => $this->fclang,
//                    'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
//                    'publish_time' => gmdate('Y-m-d H:i:s', time() + 7*3600),
//                    'userid_created' => 4,
//                    'image' => is($tmp_album[0]),
//                    'albums' => json_encode($tmp_album),
//                    'catalogueid' => 87,
//                    'image_json' => is(base64_encode(json_encode($tmp_album))),
//                    'thuonghieu' => !empty($tmp_breadcrumb)?$tmp_breadcrumb[$count_breadcrumb]:'',
//                )
//            ));
//
//
//        }
die;
?>