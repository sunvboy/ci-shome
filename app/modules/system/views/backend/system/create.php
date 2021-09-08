<div id="page-wrapper" class="gray-bg dashbard-1 fix-wrapper">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Thêm mới nội dung tĩnh</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Thêm mới nội dung tĩnh</strong></li>
			</ol>
		</div>
	</div>
	<form method="post" action="" class="form-horizontal box" >
		<script type="text/javascript">
			var submit = '<?php echo $this->input->post('create'); ?>';
			var catalogueid = '<?php echo json_encode($this->input->post('catalogue')); ?>';
		</script>
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
				</div><!-- /.box-body -->
			</div>
			<div class="row">
				<div class="col-lg-12 clearfix">
					<div class="ibox mb20">
						<div class="ibox-title" style="padding: 9px 15px 0px;">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<h5>Thông tin cơ bản <small class="text-danger">Điền đầy đủ các thông tin được mô tả dưới đây</small></h5>
								<div class="ibox-tools">
									<button type="submit" name="create" value="create" class="btn btn-success block full-width m-b">Tạo mới</button>
								</div>
							</div>
						</div>
						<div class="ibox-content">
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Tiêu đề nội dung tĩnh <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title'))), 'class="form-control title" placeholder="" id="title" autocomplete="off"');?>
									</div>
								</div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Danh mục chính <b class="text-danger">(*)</b></span>
                                        </label>
                                        <div class="form-row">
                                            <?php echo form_dropdown('catalogueid',dropdown(array(
                                                'text'=>'Chọn danh mục',
                                                'select'=>'id, title',
                                                'table'=>'system_catalogue',
                                                'field'=>'id',
                                                'value'=>'title',
                                                'order_by'=>'id DESC'
                                            )), set_value('catalogueid'), 'class="form-control m-b select3"');?>
                                        </div>
                                    </div>
                                </div>
							</div>


							
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
