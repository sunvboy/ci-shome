<div id="page-wrapper" class="gray-bg dashboard-1  ">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar');?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Thêm mới Tỉnh/Thành phố - Quận/Huyện</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Thêm mới</strong></li>
			</ol>
		</div>
	</div>
	<!-- --------------------------- -->
	<form method="post" action="" class="form-horizontal box">
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':''; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="panel-head">
						<h2 class="panel-title">Thông tin chung</h2>
						<div class="panel-description">
							Một số thông tin cơ bản của nhóm hỗ trợ.
						</div>
					</div>
				</div>
				<div class="col-lg-3">
				</div>
				<div class="col-lg-6">
					<div class="ibox-content">
						<div class="row" style="margin-bottom:20px;">
							<div class="form-row col-lg-12">
								<label class="control-label text-left panel-head-1">
									<span>Tên<b class="text-danger">(*)</b></span>
								</label>
								<?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title'))), 'class="form-control title" placeholder="" id="title" autocomplete="off"') ;?>
							</div>
							<div class="form-row col-lg-12 ">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label panel-head-1">
										<span>Danh mục cha</span>
									</label>
								</div>
								<div class="outer">
									<div class="uk-flex uk-flex-middle">
                                        <?php echo form_dropdown('parentid', dropdown(array(
                                            'text'=>'Danh mục cha',
                                            'select'=>'id, title',
                                            'table'=>'support_catalogue',
                                            'field'=>'id',
                                            'value'=>'title',
                                            'order_by'=>'id DESC'
                                        )), set_value('parentid') ,'class="form-control input-sm perpage filter parentid" style="height:34px !important"'); ?>

									</div>
								</div>
							</div>
						</div>

						<div class="row" >
							<div class="form-row col-lg-6">
								<label class="control-label text-left panel-head-1 " style="margin-bottom:20px !important;">
									<span>Quản lí thiết lập hiển thị cho blog này</span>
								</label>
								<div class="block setup-display uk-clearfix col-lg-6" >
									<div class="i-checks mr30" style="width: 100%;"><span style="color:#000;"><input type="radio" <?php echo (null == $this->input->post('publish') || $this->input->post('publish') == '0') ? 'checked' : '' ?> class="popup_gender_0 gender" value="0"  name="publish">Hiển thị</span></div>
								</div>
								<div class="block setup-display uk-clearfix col-lg-6">
									<div class="i-checks" style="width:100%;"><span style="color:#000;"> <input type="radio" <?php echo ($this->input->post('publish') == '1') ? 'checked' : '' ?>  class="popup_gender_1 gender" value="1" name="publish">Tắt </span></div>
								</div>

							</div>
						</div>
						<div class="toolbox action clearfix">
							<div class="uk-flex uk-flex-middle uk-button pull-right">
								<button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Tạo mới</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- --------------------------- -->
		
	</form>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>