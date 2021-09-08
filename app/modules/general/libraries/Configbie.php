<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class ConfigBie{



    function __construct($params = NULL){

        $this->params = $params;

    }



    // meta_title là 1 row -> seo_meta_title

    // contact_address

    // chưa có thì insert

    // có thì update
    public function system(){
        $data['homepage'] =  array(
            'label' => 'Thông tin chung',
            'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu website. Logo của website và icon website trên tab trình duyệt',
            'value' => array(
                'brandname' => array('type' => 'text', 'label' => 'Tên thương hiệu'),
                'company' => array('type' => 'text', 'label' => 'Tên công ty'),
                'logo' => array('type' => 'images', 'label' => 'Logo'),
                'logof' => array('type' => 'images', 'label' => 'Logo footer'),
                'favicon' => array('type' => 'images', 'label' => 'Favicon'),



            ),

        );

        $data['contact'] =  array(
            'label' => 'Thông tin liên lạc',
            'description' => 'Cấu hình đầy đủ thông tin liên hệ giúp khách hàng dễ dàng tiếp cận với dịch vụ của bạn',
            'value' => array(
                'address' => array('type' => 'text', 'label' => 'Địa chỉ'),
                'hotline' => array('type' => 'text', 'label' => 'Hotline'),
                 'phone' => array('type' => 'text', 'label' => 'Số điện thoại'),
                'email' => array('type' => 'text', 'label' => 'Email'),
                'website' => array('type' => 'text', 'label' => 'Website'),
                'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
                'contact' => array('type' => 'editor', 'label' => 'Liên hệ'),
                'timelv' => array('type' => 'text', 'label' => 'Giờ làm việc'),
            ),
        );


        $data['seo'] =  array(
            'label' => 'Cấu hình thẻ tiêu đề',
            'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
            'value' => array(
                'meta_title' => array('type' => 'text', 'label' => 'Tiêu đề trang','extend' => ' trên 70 kí tự', 'class' => 'meta-title', 'id' => 'titleCount'),
                'meta_description' => array('type' => 'textarea', 'label' => 'Mô tả trang','extend' => ' trên 320 kí tự', 'class' => 'meta-description', 'id' => 'descriptionCount'),
                'meta_images' => array('type' => 'images', 'label' => 'Ảnh'),
            ),
        );

        $data['social'] =  array(
            'label' => 'Cấu hình mạng xã hội',
            'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
            'value' => array(
                'facebook' => array('type' => 'text', 'label' => 'Facebook'),
                'facebookm' => array('type' => 'text', 'label' => 'Facebook message'),
                 'instagram' => array('type' => 'text', 'label' => 'Instagram'),
                'youtube' => array('type' => 'text', 'label' => 'Youtube'),
               'zalo' => array('type' => 'text', 'label' => 'Số zalo'),
            ),
        );
       
        $data['script'] =  array(
            'label' => 'Script',
            'description' => '',
            'value' => array(
                'header' => array('type' => 'textarea', 'label' => 'Script header'),
                'footer' => array('type' => 'textarea', 'label' => 'Script footer'),
            ),
        );


        return $data;

    }

}

