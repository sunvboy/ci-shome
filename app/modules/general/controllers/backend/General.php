<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller{

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	

	public function View(){
		$this->commonbie->permission("general/backend/general/view", $this->auth['permission']);
		$data['tab'] = $this->configbie->system();
		
		$general = $this->Autoload_Model->_get_where(array(
			'select' => 'keyword, content,content_lang,content_lang_korea',
			'table' => 'general',
			'order_by' => 'keyword asc'
		), TRUE);
		if(isset($general) && is_array($general) && count($general)){
			foreach($general as $key => $val){

                if($this->fclang == 'vietnamese'){
                    $language = $val['content'] ;
                }else if($this->fclang == 'japan'){
                    $language = $val['content_lang'] ;
                }else if($this->fclang == 'korea'){
                    $language = $val['content_lang_korea'] ;
                }
				$data['systems'][$val['keyword']] = $language;
                
			}
		}


		
		if($this->input->post('save')){
			$config = $this->input->post('config');
			if(isset($config) && is_array($config) && count($config)){
				foreach($config as $key => $val){
                    if($this->fclang == 'vietnamese'){
                        $language = 'content' ;
                    }else if($this->fclang == 'japan'){
                        $language = 'content_lang' ;
                    }else if($this->fclang == 'korea'){
                        $language = 'content_lang_korea' ;
                    }

					$_update = NULL;
					$_update['keyword'] = $key;
					$_update[''.$language.''] = $val;
					$_update['userid_created'] = $this->auth['id'];
					$_update['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
					$flag = $this->_Check($key);
					if($flag == FALSE){
						$this->Autoload_Model->_create(array(
							'table' => 'general',
							'data' => $_update,
						));
					} else {
						$this->Autoload_Model->_update(array(
							'where' => array('keyword' => $key),
							'table' => 'general',
							'data' => $_update,
						));
					}
				}
			}
			$this->session->set_flashdata('message-success', 'Lưu thông tin cấu hình hệ thống thành công');
			redirect('general/backend/general/view');
		}
		$data['template'] = 'general/backend/general/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function isview(){
	    //thêm trường vào cơ sở dữ liệu
//        $this->load->dbforge();
//        $fields = array(
//            'preferences' => array('type' => 'VARCHAR', 'constraint'=>255)
//        );
//        $this->dbforge->add_column('general_is', $fields);
        //end
        //xóa
        //$this->dbforge->drop_column('general_is', 'preferences');

        //end xóa


        $data['listIS'] = $this->Autoload_Model->_get_where(array(
           'table' => 'general_is',
           'select' => '*'
        ),TRUE);



        $data['template'] = 'general/backend/general/isview';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
    }
    public function ajax_isview(){
        $alert = array(
            'error' => '',
            'message' => 'Gửi thông tin liên hệ thành công!',
            'result' => ''
        );
        $IDtype = $this->input->post('IDtype');
        $isColum = $this->input->post('isColum');
        $listIS = $this->Autoload_Model->_get_where(array(
            'table' => 'general_is',
            'select' => '*',
            'where' => array('module'=>$IDtype,'is' => $isColum)
        ),TRUE);

        if(isset($listIS) && count($listIS) && is_array($listIS)){
            $alert['error'] = 'Bản ghi đã tồn tại';
        }else{
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('isColum', 'Tên trường', 'trim|required|callback__Checktitle');
            $this->form_validation->set_rules('isTitle', 'Tiêu đề', 'trim|required');
            if ($this->form_validation->run()) {

                $insert = array(
                    'is' => $this->input->post('isColum'),
                    'module' => $this->input->post('IDtype'),
                    'title' => $this->input->post('isTitle'),
                    'publish' => $this->input->post('isPublish'),
                );

                $this->Autoload_Model->_create(array(
                    'table' => 'general_is',
                    'data' => $insert
                ));
            } else {
                $alert['error'] = validation_errors();
            }
        }
        echo json_encode($alert);
        die();

    }
	public function _Check($keyword = ''){
		$result = $this->Autoload_Model->_get_where(array(
			'select' => 'keyword',
			'table' => 'general',
			'where' => array('keyword' => $keyword),
			'count' => TRUE
		));
		return (($result >= 1) ? TRUE : FALSE);
	}
    public function _Checktitle()
    {
        $title = $this->input->post('isTitle');
        $IDtype = $this->input->post('IDtype');
        $listIS = $this->Autoload_Model->_get_where(array(
            'table' => 'general_is',
            'select' => '*',
            'where' => array('module'=>$IDtype,'title' => $title)
        ));
        if ($listIS['title'] == $title) {
            $this->form_validation->set_message('_Checktitle', 'Tiêu đề đã tồn tại');
            return FALSE;
        }
        return TRUE;
    }
    public function status(){
        $id = $this->input->post('objectid');
        $object = $this->Autoload_Model->_get_where(array(
            'select' => 'id, publish',
            'table' => 'general_is',
            'where' => array('id' => $id),
        ));
        $_update['publish'] = (($object['publish'] == 1)?0:1);
        $this->Autoload_Model->_update(array(
            'where' => array('id' => $id),
            'table' => 'general_is',
            'data' => $_update,
        ));
    }
    public function editTitle(){
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $this->Autoload_Model->_update(array(
            'where' => array('id' => $id),
            'table' => 'general_is',
            'data' => array('title'=>$title),
        ));
    }
}
