<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý danh mục config</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('admin'); ?>">Home</a>
                </li>
                <li class="active"><strong>Quản lý danh mục config</strong></li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Danh sách danh mục config</h5>

                    </div>
                    <div class="ibox-content" style="position:relative;">
                        <div class="table-responsive">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <div class="perpage">
                                    <div class="uk-flex uk-flex-middle mb10">
                                    </div>
                                </div>
                                <div class="toolbox">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">

                                        <div class="uk-button">
                                            <a href="<?php echo site_url('system/backend/catalogue/create'); ?>"
                                               class="btn btn-danger"><i class="fa fa-plus"></i> Thêm  mới</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <div class="text-small mb10">Hiển thị từ <?php echo $from; ?> đến <?php echo $to ?> trên  tổng số <?php echo $config['total_rows']; ?> bản ghi
                                </div>

                            </div>

                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>

                                    <th style="width:45px;">ID</th>
                                    <th>Tiêu đề</th>
                                    <th style="width:175px;">Người tạo</th>
                                    <th style="width:100px;">Ngày tạo</th>

                                    <th style="width:150px;" class="text-center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody id="ajax-content">
                                <?php if (isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)) { ?>
                                    <?php foreach ($listCatalogue as $key => $val) { ?>
                                        <?php
                                        $count = $this->Autoload_Model->_get_where(array(
                                            'table' => 'system',
                                            'select' => 'id',
                                            'catalogueid' => $val['id'],
                                            'count' => TRUE
                                        ));
                                        ?>
                                        <tr class="gradeX" id="cat-<?php echo $val['id']; ?>">

                                            <td><?php echo $val['id']; ?></td>
                                            <td><?php echo $val['title'] ?> (<?php echo $count; ?>)</td>

                                            <td><?php echo $val['user_created']; ?></td>
                                            <td><?php echo gettime($val['created'], 'd/m/Y'); ?></td>


                                            <td class="text-center">
                                                <a type="button"
                                                   href="<?php echo site_url('system/backend/catalogue/update/' . $val['id'] . '') ?>"
                                                   class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="9">
                                            <small class="text-danger">Không có dữ liệu phù hợp</small>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination">
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                        </div>
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>