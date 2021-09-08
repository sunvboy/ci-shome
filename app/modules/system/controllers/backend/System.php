<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class system extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'system_catalogue'));
	}
	
	public function view($system = 1){
		//$this->commonbie->permission("system/backend/system/view", $this->auth['permission']);
		$system = (int)$system;
		$data['from'] = 0;
		$data['to'] = 0;
		
		$extend = (!in_array('system/backend/system/viewall', json_decode($this->auth['permission'], TRUE))) ? 'userid_created = '.$this->auth['id'].'' : '';
		
		
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$catalogueid = (int)$this->input->get('catalogueid');
		if($catalogueid > 0){
			 $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => 'system',
                'where_extend' => $extend,
                'where' => array('catalogueid' => $catalogueid),
                'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                'count' => TRUE,
            ));
		}else{
			$config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => 'system',
                'where_extend' => $extend,
                'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                'count' => TRUE,
            ));
		}
		
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('system/backend/system/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_system'] = $perpage;
			$config['uri_segment'] = 5;
			$config['use_system_numbers'] = TRUE;
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
			$totalsystem = ceil($config['total_rows']/$config['per_system']);
			$system = ($system <= 0)?1:$system;
			$system = ($system > $totalsystem)?$totalsystem:$system;
			$system = $system - 1;
			$data['from'] = ($system * $config['per_system']) + 1;
			$data['to'] = ($config['per_system']*($system+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_system']*($system+1);
			if($catalogueid > 0){
				$data['listsystem'] = $this->Autoload_Model->_get_where(array(
					'select' => '*, (SELECT fullname FROM user WHERE user.id = system.userid_created) as user_created',
                    'table' => 'system',
                    'where_extend' => $extend,
                    'where' => array('catalogueid' => $catalogueid),
                    'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                    'limit' => $config['per_system'],
                    'start' => $system * $config['per_system'],
                    'order_by' => 'catalogueid desc',
				), TRUE);
			}else{
				$data['listsystem'] = $this->Autoload_Model->_get_where(array(
                    'select' => '*, (SELECT fullname FROM user WHERE user.id = system.userid_created) as user_created',
                    'table' => 'system',
                    'where_extend' => $extend,
                    'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                    'limit' => $config['per_system'],
                    'start' => $system * $config['per_system'],
                    'order_by' => 'catalogueid desc',
				), TRUE);	
			}
		}
		$data['script'] = 'system';
		$data['config'] = $config;
		$data['template'] = 'system/backend/system/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Create(){
		//$this->commonbie->permission("system/backend/system/create", $this->auth['permission']);
		if($this->input->post('create')){
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('',' / ');
            $catalogueid = $this->input->post('catalogueid');
            $title = $this->input->post('title');
            if($catalogueid == 1){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/homepage/views/frontend/common/header/$title.php";
            }elseif ($catalogueid == 3){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/homepage/views/frontend/common/footer/$title.php";
            }elseif($catalogueid == 2){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/homepage/views/frontend/home/$title.php";
            }elseif($catalogueid == 5){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/product/views/frontend/product/$title.php";

            }elseif($catalogueid == 4){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/product/views/frontend/catalogue/$title.php";

            }elseif($catalogueid == 7){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/article/views/frontend/article/$title.php";

            }elseif($catalogueid == 6){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/article/views/frontend/catalogue/$title.php";
            }elseif($catalogueid == 8){
                $file = $_SERVER['DOCUMENT_ROOT'] . "/app/modules/contact/views/frontend/contact/$title.php";
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/app/modules/homepage/views/frontend/home/$title.php")) {
                $this->session->set_flashdata('message-danger', 'File đã tồn tại');
                redirect('system/backend/system/view');
            }
			$this->form_validation->set_rules('title', 'Tiêu đề nội dung tĩnh', 'trim|required|callback__CheckFile');
			$this->form_validation->set_rules('catalogueid', 'Danh mục', 'trim|is_natural_no_zero');
			if($this->form_validation->run($this)){

				$_insert = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'catalogueid' => $this->input->post('catalogueid'),
					'userid_created' => $this->auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				$resultid = $this->Autoload_Model->_create(array(
					'table' => 'system',
					'data' => $_insert,
				));
				if($resultid > 0){
				    //tạo file vào thư mực
                    $fp = fopen($file,"wb");
                    $content = "";
                    fwrite($fp,$content);
                    fclose($fp);
                    //end
					$this->session->set_flashdata('message-success', 'Thêm nội dung tĩnh mới thành công');
					redirect('system/backend/system/view');
				}
			}
		}
		$data['script'] = 'system';
		$data['template'] = 'system/backend/system/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Update($id = 0){
		//$this->commonbie->permission("system/backend/system/update", $this->auth['permission']);
		$id = (int)$id;
		$detailsystem = $this->Autoload_Model->_get_where(array(
			'select' => '*',
			'table' => 'system',
			'where' => array('id' => $id),
		));
		if(!isset($detailsystem) || is_array($detailsystem) == false || count($detailsystem) == 0){
			$this->session->set_flashdata('message-danger', 'Nội dung không tồn tại');
			redirect('system/backend/system/view');
		}
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề nội dung tĩnh', 'trim|required');
			if($this->form_validation->run($this)){
				$_update = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'catalogueid' => $this->input->post('catalogueid'),
					'publish' => $this->input->post('publish'),
					'userid_updated' => $this->auth['id'],
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'system',
					'data' => $_update,
				));
				if($flag > 0){
					
					
					
					
					$this->session->set_flashdata('message-success', 'Cập nhật thành công');
					redirect('system/backend/system/view');
				}
			}
		}
		
		
		$data['script'] = 'system';
		$data['detailsystem'] = $detailsystem;
		$data['template'] = 'system/backend/system/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

    public function _CheckFile(){
        $title = $this->input->post('title');
        $catalogueid = $this->input->post('catalogueid');
        $system = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'system',
            'where' => array(
                'title' => $title,
                'catalogueid' => $catalogueid,
            ),
        ));
        if(isset($system) && is_array($system) && count($system)){
            $this->form_validation->set_message('_CheckFile','File đã tồn tại');
            return FALSE;
        }

        return TRUE;
    }
	
	
	
}
