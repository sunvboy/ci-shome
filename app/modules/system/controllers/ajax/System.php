<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class system extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0) redirect(BACKEND_DIRECTORY);
    }


    public function status()
    {
        $id = $this->input->post('objectid');
        $object = $this->Autoload_Model->_get_where(array(
            'select' => 'id, publish',
            'table' => 'system',
            'where' => array('id' => $id),
        ));

        $_update['publish'] = (($object['publish'] == 1) ? 0 : 1);
        $this->Autoload_Model->_update(array(
            'where' => array('id' => $id),
            'table' => 'system',
            'data' => $_update,
        ));
    }

    public function listsystem()
    {
        $system = (int)$this->input->get('system');
        $data['from'] = 0;
        $data['to'] = 0;
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $catalogueid = $this->input->get('catalogueid');
        $extend = '';
        if (!in_array('system/backend/system/viewall', json_decode($this->auth['permission'], TRUE))) {
            $extend = 'userid_created = ' . $this->auth['id'] . '';
        }

        if ($catalogueid > 0) {
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => 'system',
                'where_extend' => $extend,
                'where' => array('catalogueid' => $catalogueid),
                'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                'count' => TRUE,
            ));


        } else {
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => 'system',
                'where_extend' => $extend,
                'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                'count' => TRUE,
            ));
        }


        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-system="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_system'] = $perpage;
            $config['cur_system'] = $system;
            $config['system'] = $system;
            $config['uri_segment'] = 2;
            $config['use_system_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
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
            $listPagination = $this->pagination->create_links();
            $totalsystem = ceil($config['total_rows'] / $config['per_system']);
            $system = ($system <= 0) ? 1 : $system;
            $system = ($system > $totalsystem) ? $totalsystem : $system;
            $system = $system - 1;
            $data['from'] = ($system * $config['per_system']) + 1;
            $data['to'] = ($config['per_system'] * ($system + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_system'] * ($system + 1);
            if ($catalogueid > 0) {
                 $listCatalogue = $this->Autoload_Model->_get_where(array(
                    'select' => '*, (SELECT fullname FROM user WHERE user.id = system_catalogue.userid_created) as user_created',
                    'table' => 'system',
                    'where_extend' => $extend,
                    'where' => array('catalogueid' => $catalogueid),
                    'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                    'limit' => $config['per_system'],
                    'start' => $system * $config['per_system'],
                    'order_by' => 'catalogueid desc',
                ), TRUE);
            } else {
                $listCatalogue = $this->Autoload_Model->_get_where(array(
                    'select' => '*, (SELECT fullname FROM user WHERE user.id = system_catalogue.userid_created) as user_created',
                    'table' => 'system',
                    'where_extend' => $extend,
                    'keyword' => '(title LIKE \'%' . $keyword . '%\')',
                    'limit' => $config['per_system'],
                    'start' => $system * $config['per_system'],
                    'order_by' => 'catalogueid desc',
                ), TRUE);
            }


        }
       
        if (isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)) {
            foreach ($listCatalogue as $key => $val) {
                $image = getthumb($val['image']);
                $_catalogue_list = '';
                $catalogue = json_decode($val['catalogue'], TRUE);
                if (isset($catalogue) && is_array($catalogue) && count($catalogue)) {
                    $_catalogue_list = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title',
                        'table' => 'system_catalogue',
                        'where_in' => json_decode($val['catalogue'], TRUE),
                        'where_in_field' => 'id',
                    ), TRUE);
                }
                $html = $html . '<tr class="gradeX">';
                $html = $html . '<td>';
                $html = $html . '<input type="checkbox" name="checkbox[]" value="' . $val['id'] . '" class="checkbox-item">';
                $html = $html . '<label for="" class="label-checkboxitem"></label>';
                $html = $html . '</td>';
                $html = $html . '<td>';
                $html = $html . '' . $val['id'] . '';
                $html = $html . '</td>';
                $html = $html . '<td>' . $val['title'] . '';
                $html = $html . '</td>';
                $html = $html . '<td>' . $val['user_created'] . '</td>';
                $html = $html . '<td>' . gettime($val['created'], 'd/m/Y') . '</td>';
                $html = $html . '<td>';
                $html = $html . '<div class="switch">';
                $html = $html . '<div class="onoffswitch">';
                $html = $html . '<input type="checkbox" ' . (($val['publish'] == 0) ? 'checked=""' : '') . ' class="onoffswitch-checkbox publish" data-id="' . $val['id'] . '" id="publish-' . $val['id'] . '">';
                $html = $html . '<label class="onoffswitch-label" for="publish-' . $val['id'] . '">';
                $html = $html . '<span class="onoffswitch-inner"></span>';
                $html = $html . '<span class="onoffswitch-switch"></span>';
                $html = $html . '</label>';
                $html = $html . '</div>';
                $html = $html . '</div>';
                $html = $html . '</td>';
                $html = $html . '<td class="text-center">';
                $html = $html . '<a type="button" href="' . (site_url('system/backend/system/update/' . $val['id'] . '')) . '" class="btn btn-sm btn-primary mr5"><i class="fa fa-edit"></i></a>';
                $html = $html . '<a type="button" class="btn btn-sm btn-danger ajax-delete" data-title="Lưu ý: Khi bạn xóa danh mục, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này!" data-id="' . $val['id'] . '" data-module="system"><i class="fa fa-trash"></i></a>';
                $html = $html . '</td>';
                $html = $html . '</tr>';
            }
        } else {
            $html = $html . '<tr>
				<td colspan="9"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
			</tr>';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
            'total' => $config['total_rows'],
        ));
        die();
    }
}
