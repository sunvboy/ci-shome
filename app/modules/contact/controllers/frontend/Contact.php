<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public $module;
	public function __construct(){
		parent::__construct();
		$this->load->helper(array("form", "url", "captcha"));
        $this->fc_lang = $this->config->item('fc_lang');

    }

	public function view(){

		$data['header'] = FALSE;
		$data['meta_title'] = 'Liên hệ';
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
        /*if(svl_ismobile() == 'is mobile'){
			$data['template'] = 'contact/mobile/view';
			$this->load->view('homepage/mobile/layout/home', isset($data) ? $data : NULL);
		}else{

		}*/
        $data['template'] = 'contact/frontend/contact/view';
        $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}

    public function ajaxSendcontact(){
        $alert = array(
            'error' => '',
            'message' => 'Gửi thông tin liên hệ thành công!',
            'result' => ''
        );
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname','Họ và tên', 'trim|required');
//        $this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
//        $this->form_validation->set_rules('title','Tiêu đề', 'trim|required');
        $this->form_validation->set_rules('message','Nội dung', 'trim|required');

        if ($this->form_validation->run()) {

            $insert = array(
                'title' => 'Gửi thông tin liên hệ',
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'message' => $this->input->post('message'),
                'type' => 0,
                'created' => $this->currentTime,
            );
            $this->Autoload_Model->_create(array(
                'table' => 'contact',
                'data' => $insert
            ));
        } else {
            $alert['error'] = validation_errors();
        }
        echo json_encode($alert);
        die();
    }
	public function create(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname','Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
		if ($this->form_validation->run()){
			$insert = array(
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				//'message' => $this->input->post('message'),
				'title' => 'Đăng kí nhận bản tin khuyến mãi',
				'type' => 1,
				'created' => $this->currentTime,
			);
			$this->Autoload_Model->_create(array(
				'table' => 'contact',
				'data' => $insert
			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	public function createProduct(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname','Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
//		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
		if ($this->form_validation->run()){
			$insert = array(
				'fullname' => $this->input->post('fullname'),
//				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'message' => $this->input->post('message'),
				'title' => 'Đăng kí tư vấn',
				'type' => 1,
				'created' => $this->currentTime,
			);
			$this->Autoload_Model->_create(array(
				'table' => 'contact',
				'data' => $insert
			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	public function phone_contact(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
//		$this->form_validation->set_rules('fullname','Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
//		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
		if ($this->form_validation->run()){
			$insert = array(
//				'fullname' => $this->input->post('fullname'),
//				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
//				'message' => $this->input->post('message'),
				'title' => 'CHƯƠNG TRÌNH KHUYẾN MÃI',
				'type' => 1,
				'created' => $this->currentTime,
			);
			$this->Autoload_Model->_create(array(
				'table' => 'contact',
				'data' => $insert
			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	public function createBG(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname','Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
//		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
		if ($this->form_validation->run()){
			$insert = array(
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'message' => $this->input->post('hinhthucthanhtoan'),
				'productTitle' => $this->input->post('productTitle'),
				'title' => 'Đăng ký nhận báo giá',
				'type' => 1,
				'created' => $this->currentTime,
			);
			$this->Autoload_Model->_create(array(
				'table' => 'contact',
				'data' => $insert
			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}

	public function listAddress(){

		$page = $this->input->post('page');
		$page = (int)$page;
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'support',
			'count' => TRUE,
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] ='#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 8;
			$config['cur_page'] = $page;
			$config['page'] = $page;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = '<div class="pagenavi" id="pagination"><ul style="list-style: none">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a >';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$listPagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['from'] = ($page * $config['per_page']) + 1;
			$data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);

			$listSupport = $this->Autoload_Model->_get_where(array(
				'select' => 'id, fullname, email, phone, address, image',
				'table' => 'support',
				'start' => $page * $config['per_page'],
				'limit' => $config['per_page'],
				'order_by' => 'id desc',
			), TRUE);

		}
		$html = '';
		if(svl_ismobile()){
			if(isset($listSupport) && is_array($listSupport) && count($listSupport)){
				foreach($listSupport as $key => $val){
					$html = $html . '<div class="item-footer item-footer3">
                        <div class="item">
                            <h3 class="title">'.$val['fullname'].'</h3>
                            <div class="nav-item">
                                <div class="item22">
                                    <div class="item21">
                                        <img src="template/frontend/noithat-PC/images/i4.png" alt="'.$val['fullname'].'">
                                        <h3 class="title2">địa chỉ</h3>
                                        <p>'.$val['address'].'</p>
                                    </div>
                                    <div class="item21">
                                        <img src="template/frontend/noithat-PC/images/i6.png" alt="Điện thoại">
                                        <h3 class="title2">Điện thoại</h3>
                                        <p>'.$val['email'].'</p>
                                    </div>
                                    <div class="item21">
                                        <img src="template/frontend/noithat-PC/images/i7.png" alt="phone">
                                        <h3 class="title2">phone</h3>
                                        <p>'.$val['phone'].'</p>
                                    </div>
                                </div>
                                <div class="nav-item-map">
                                    <div class="map"><img src="'.$val['image'].'" alt="'.$val['fullname'].'"></div>
                                </div>
                            </div>
                        </div>


                    </div>';
				}
				$html = $html . '<div class="ajax-pagination">'.$listPagination.'</li>';
			}else{
				$html = $html.'Dữ liệu đang được cập nhập';
			}
		}else{
			if(isset($listSupport) && is_array($listSupport) && count($listSupport)){
				$i=0; foreach($listSupport as $key => $val){ $i++;
					if($i%2==0){
						$html = $html . '
                        <div class="col-md-4 col-sm-4">
                            <div class="item-footer item-footer3">
                                <div class="item">
                                    <h3 class="title">'.$val['fullname'].'</h3>
                                    <div class="nav-item">

                                        <div class="item21">
                                            <img src="template/frontend/noithat-PC/images/i4.png" alt="'.$val['address'].'">
                                            <h3 class="title2">địa chỉ</h3>
                                            <p>'.$val['address'].'</p>
                                        </div>
                                        <div class="item21">
                                            <img src="template/frontend/noithat-PC/images/i6.png" alt="'.$val['email'].'">
                                            <h3 class="title2">Email</h3>
                                            <p>'.$val['email'].'</p>
                                        </div>
                                        <div class="item21">
                                            <img src="template/frontend/noithat-PC/images/i7.png" alt="'.$val['phone'].'">
                                            <h3 class="title2">phone</h3>
                                            <p>'.$val['phone'].'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
					}else{
						$html = $html . '<div class="col-md-8 col-sm-8">
                            <div class="item-footer item-footer3">
                                <div class="item">
                                    <h3 class="title">'.$val['fullname'].'</h3>
                                    <div class="nav-item">
                                        <div class="item22">
                                            <div class="item21">
                                                <img src="template/frontend/noithat-PC/images/i4.png" alt="'.$val['address'].'">
                                                <h3 class="title2">địa chỉ</h3>
                                                <p>'.$val['address'].'</p>
                                            </div>
                                            <div class="item21">
                                                <img src="template/frontend/noithat-PC/images/i6.png" alt="'.$val['email'].'">
                                                <h3 class="title2">Email</h3>
                                                <p>'.$val['email'].'</p>
                                            </div>
                                            <div class="item21">
                                                <img src="template/frontend/noithat-PC/images/i7.png" alt="'.$val['phone'].'">
                                                <h3 class="title2">phone</h3>
                                                <p>'.$val['phone'].'</p>
                                            </div>

                                        </div>
                                        <div class="nav-item-map">
                                            <div class="icon">
                                                <img src="template/frontend/noithat-PC/images/i5.png" alt="'.$val['fullname'].'">
                                            </div>
                                            <div class="map">
                                                <img src="'.$val['image'].'" alt="'.$val['fullname'].'">
                                            </div>


                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                       ';
					}

				}
				$html = $html . '<div class="ajax-pagination">'.$listPagination.'</li>';
			}else{
				$html = $html.'Dữ liệu đang được cập nhập';
			}
		}






		echo json_encode(array(
			'html' => $html,
		));
		die();
	}

}
