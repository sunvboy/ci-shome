<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'system_catalogue'));
	}
	
	public function view($system = 1){
		//$this->commonbie->permission("system/backend/catalogue/view", $this->auth['permission']);
		$system = (int)$system;
		$data['from'] = 0;
		$data['to'] = 0;
		
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')';
		}
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'system_catalogue',
			'keyword' => $keyword,
			'count' => TRUE,
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('system/backend/catalogue/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_system'] = 1000;
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
			$data['listCatalogue'] = $this->Autoload_Model->_get_where(array(
				'select' => '*, (SELECT fullname FROM user WHERE user.id = system_catalogue.userid_created) as user_created',
				'table' => 'system_catalogue',
				'limit' => $config['per_system'],
				'start' => $system * $config['per_system'],
				'keyword' => $keyword,
				'order_by' => 'id desc',
			), TRUE);
		}
		
		
		$data['script'] = 'system_catalogue';
		$data['config'] = $config;
		$data['template'] = 'system/backend/catalogue/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Create(){
		//$this->commonbie->permission("system/backend/catalogue/create", $this->auth['permission']);
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề danh mục', 'trim|required');
			if($this->form_validation->run($this)){
				$_insert = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'userid_created' => $this->auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),

				);
				$resultid = $this->Autoload_Model->_create(array(
					'table' => 'system_catalogue',
					'data' => $_insert,
				));
				if($resultid > 0){
					
					$this->session->set_flashdata('message-success', 'Thêm danh mục mới thành công');
					redirect('system/backend/catalogue/view');
				}
			}
		}
		
		$data['template'] = 'system/backend/catalogue/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Update($id = 0){
		//$this->commonbie->permission("system/backend/catalogue/update", $this->auth['permission']);
		$id = (int)$id;
		$detailCatalogue = $this->Autoload_Model->_get_where(array(
			'select' => '*',
			'table' => 'system_catalogue',
			'where' => array('id' => $id),
		));
		if(!isset($detailCatalogue) || is_array($detailCatalogue) == false || count($detailCatalogue) == 0){
			$this->session->set_flashdata('message-danger', 'Danh mục nội dung tĩnh không tồn tại');
			redirect('system/backend/catalogue/view');
		}
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề danh mục', 'trim|required');
			if($this->form_validation->run($this)){
				$_update = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'userid_updated' => $this->auth['id'],
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'system_catalogue',
					'data' => $_update,
				));
				if($flag > 0){
					
					$this->session->set_flashdata('message-success', 'Cập nhật thành công');
					redirect('system/backend/catalogue/view');
				}
			}
		}
		
		
		
		$data['detailCatalogue'] = $detailCatalogue;
		$data['template'] = 'system/backend/catalogue/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	
	
}
