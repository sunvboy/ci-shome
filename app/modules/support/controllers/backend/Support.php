<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends MY_Controller
{

    public $module;

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0) redirect(BACKEND_DIRECTORY);
        $this->load->library(array('configbie'));
        // $this->load->library('nestedsetbie', array('table' => 'support'));
        $this->load->library('nestedsetbie', array('table' => 'support_catalogue'));

    }

    public function View($page = 1)
    {
        $page = (int)$page;
        $data['from'] = 0;
        $data['to'] = 0;

        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $keyword = $this->input->get('keyword');
        $catalogueid = (int)$this->input->get('catalogueid');
        if (!empty($keyword)) {
            $keyword = '(title LIKE \'%' . $keyword . '%\')';
        }
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'support',
            'count' => TRUE,
            'where' => ($catalogueid == 0) ? '' : array('catalogueid' => $catalogueid),
            'keyword' => '(fullname LIKE \'%' . $keyword . '%\')',
        ));
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = base_url('support/backend/support/view');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 5;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul class="pagination no-margin">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a class="btn-primary">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $data['PaginationList'] = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);
            $data['listSupport'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id, catalogueid, fullname, email, phone, zalo, address, image, publish,(SELECT title FROM support_catalogue WHERE support_catalogue.id = support.catalogueid) as catalogueTitle',
                'table' => 'support',
                'where' => ($catalogueid == 0) ? '' : array('catalogueid' => $catalogueid),
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\')',
                'start' => $page * $config['per_page'],
                'limit' => $config['per_page'],
                'order_by' => 'fullname asc',
            ), TRUE);
        }

        $data['script'] = 'support';
        $data['config'] = $config;
        $data['template'] = 'support/backend/support/view';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data) ? $data : NULL);
    }

    public function Create()
    {
        if ($this->input->post('create')) {
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('', ' /');
            $this->form_validation->set_rules('fullname', 'Tên cửa hàng', 'trim|required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
            //$this->form_validation->set_rules('email', 'Email ', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại ', 'trim|required');
            // $this->form_validation->set_rules('zalo', 'Zalo', 'trim|required');
            // $this->form_validation->set_rules('skype', 'Skype', 'trim|required');
            //$this->form_validation->set_rules('catalogueid', 'Nhóm hỗ trợ', 'trim|is_natural_no_zero');
            if ($this->form_validation->run($this)) {

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='.slug($this->input->post('address')).'&key=AIzaSyBPYwKdcUYplwZuW9gSMfSB7naz42TcUE0',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $data = json_decode($response);
                if(!empty($data)){

                    $lat = $data->results[0]->geometry->location->lat;
                    $long = $data->results[0]->geometry->location->lng;


                }

                $_insert = array(
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'cityid' => $this->input->post('cityid'),
                    'districtid' => $this->input->post('districtid'),
                    'lat' => !empty($lat)?$lat:'',
                    'long' => !empty($long)?$long:'',
                    //'zalo' => $this->input->post('zalo'),
                    //'skype' => $this->input->post('skype'),
                    'catalogueid' => $this->input->post('catalogueid'),
                    'image' => $this->input->post('avatar'),
                    'publish' => $this->input->post('publish'),
                );
                // echo '<pre>';
                // print_r($_insert);die();
                $resultid = $this->Autoload_Model->_create(array(
                    'table' => 'support',
                    'data' => $_insert,
                ));
                if ($resultid > 0) {


                    $this->session->set_flashdata('message-success', 'Thêm mới thành công');
                    redirect('support/backend/support/view');
                }
            }
        }
        $data['script'] = 'support';
        $data['template'] = 'support/backend/support/create';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data) ? $data : NULL);
    }

    public function Update($id = 0)
    {
        $id = (int)$id;
        $detailSupport = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'support',
            'where' => array('id' => $id),
        ));
        if (!isset($detailSupport) || is_array($detailSupport) == false || count($detailSupport) == 0) {
            $this->session->set_flashdata('message-danger', 'Cửa hàng không tồn tại');
            redirect('support/backend/support/view');
        }
        if ($this->input->post('update')) {
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('', ' /');
            $this->form_validation->set_rules('fullname', 'Họ tên ', 'trim|required');
            $this->form_validation->set_rules('address', 'Địa chỉ ', 'trim|required');
            //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại ', 'trim|required');
            // $this->form_validation->set_rules('zalo', 'Zalo', 'trim|required');
            // $this->form_validation->set_rules('skype', 'Skype', 'trim|required');
            //$this->form_validation->set_rules('catalogueid', 'Nhóm hỗ trợ', 'trim|is_natural_no_zero');
            if ($this->form_validation->run($this)) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='.slug($this->input->post('address')).'&key=AIzaSyBPYwKdcUYplwZuW9gSMfSB7naz42TcUE0',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $data = json_decode($response);
                if(!empty($data)){

                    $lat = $data->results[0]->geometry->location->lat;
                    $long = $data->results[0]->geometry->location->lng;


                }

                $_update = array(
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'lat' => !empty($lat)?$lat:'',
                    'long' => !empty($long)?$long:'',
                    'cityid' => $this->input->post('cityid'),
                    'districtid' => $this->input->post('districtid'),
                    'image' => $this->input->post('image'),
                    'publish' => $this->input->post('publish'),
                    'catalogueid' => $this->input->post('catalogueid'),
                );
                $flag = $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'support',
                    'data' => $_update,
                ));
                if ($flag > 0) {
                    $this->session->set_flashdata('message-success', 'Cập nhật thành công');
                    redirect('support/backend/support/update/' . $id . '');
                } else {
                    $this->session->set_flashdata('message-error', 'Cập nhật không thành công, vui lòng kiểm tra lại');
                    redirect('support/backend/support/update/' . $id . '');
                }
            }
        }
        $data['detailSupport'] = $detailSupport;
        $data['template'] = 'support/backend/support/update';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data) ? $data : NULL);
    }

}
/* $listCity = getLocation(array(
           'select' => 'name, provinceid',
           'table' => 'vn_province',
           'field' => 'provinceid',
           'text' => 'Chọn Tỉnh/Thành Phố'
       ));
       $i=0;foreach ($listCity as $k=>$v){ $i++;
           if($k!=''){
               if(!empty($k)){
                   $district = $this->Autoload_Model->_get_where(array(
                       'select' =>'districtid,name',
                       'table' => 'vn_district',
                       'where' => array('provinceid'=>$k),
                   ),true);
                   foreach ($district as $key=>$val){
                       $curl = curl_init();
                       $string  = str_replace(' ','+',$val['name'].'+'.$v);
                       curl_setopt_array($curl, array(
                           CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='.$string.'&key=AIzaSyBPYwKdcUYplwZuW9gSMfSB7naz42TcUE0',
                           CURLOPT_RETURNTRANSFER => true,
                           CURLOPT_ENCODING => '',
                           CURLOPT_MAXREDIRS => 10,
                           CURLOPT_TIMEOUT => 0,
                           CURLOPT_FOLLOWLOCATION => true,
                           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                           CURLOPT_CUSTOMREQUEST => 'GET',
                       ));
                       $response = curl_exec($curl);
                       curl_close($curl);
                       $data = json_decode($response);
                       if(!empty($data)){
                           $this->Autoload_Model->_update(array(
                               'where' => array('districtid' => $val['districtid']),
                               'table' => 'vn_district',
                               'data' => array('lat'=>$data->results[0]->geometry->location->lat,'lng'=>$data->results[0]->geometry->location->lng),
                           ));

                       }
                   }
               }
           }
       }

       die;*/