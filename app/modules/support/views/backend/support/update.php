<div id="page-wrapper" class="gray-bg dashboard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar');?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cửa hàng</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhập</strong></li>
			</ol>
		</div>
	</div>
	<!-- ----------------- -->
	<div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" action="" class="form-horizontal box">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':''; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 ">
					<div class="panel-head">
						<h2 class="panel-title">Thông tin chung</h2>
						<div class="panel-description">Một số thông tin cơ bản.</div>
					</div>
				</div>
				<div class="col-lg-3 hidden">
					<div class="ibox mb20">
						<div class="ibox-title">
							<h5>Ảnh đại diện</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content p-support-update">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-row">

										<div class="avatar p-avatar" style="cursor: pointer;"><img src="<?php echo ($this->input->post('image')) ? $this->input->post('image') : ((!empty($detailSupport['image'])) ? $detailSupport['image'] : 'template/avatar.png'); ?>" class="img-thumbnail" alt=""></div>
										
										<?php echo form_input('image', htmlspecialchars_decode(html_entity_decode(set_value('image', $detailSupport['image']))), 'class="form-control " placeholder="Đường dẫn của ảnh" onclick="openKCFinder(this)"  autocomplete="off"');?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="ibox-content">
						<div class="row mb15">
							<div class="form-row col-lg-12 mb15">
								<label class="control-label text-left panel-head-1">
									<span>Tên cửa hàng<b class="text-danger">(*)</b></span>
								</label>
								<?php echo form_input('fullname', set_value('fullname' , $detailSupport['fullname']), 'class="form-control " placeholder="" autocomplete="off"');?>
							</div>
							<div class="form-row col-lg-12 mb15">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label panel-head-1">
										<span>Email</span>
									</label>
								</div>
								<div class="outer">
									<div class="uk-flex uk-flex-middle">
										<?php echo form_input('email', set_value('email', $detailSupport['email']), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="form-row col-lg-12">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label panel-head-1">
										<span>Địa chỉ<b class="text-danger">(*)</b></span>
									</label>
								</div>
								<div class="outer">
									<div class="uk-flex uk-flex-middle">
										<?php echo form_input('address', set_value('address', $detailSupport['address']), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
						</div>
						<div class="row mb15">
							<div class="form-row col-lg-12">
								<label class="control-label text-left panel-head-1">
									<span>Số điện thoại <b class="text-danger">(*)</b></span>
								</label>
								<?php echo form_input('phone', set_value('phone', $detailSupport['phone']), 'class="form-control " placeholder="" autocomplete="off"');?>
							</div>

						</div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label text-left">
                                        <span>Tỉnh/Thành Phố</span>
                                    </label>
                                    <?php
                                    $listCity = getLocation(array(
                                        'select' => 'name, provinceid',
                                        'table' => 'vn_province',
                                        'field' => 'provinceid',
                                        'text' => 'Chọn Tỉnh/Thành Phố'
                                    ));
                                    ?>
                                    <?php echo form_dropdown('cityid', $listCity, $detailSupport['cityid'], 'class="form-control m-b city"  id="city"');?>
                                </div>
                            </div>

                            <script>
                                var cityid = '<?php echo !empty($detailSupport['cityid'])?$detailSupport['cityid']:$this->input->post('cityid'); ?>';
                                var districtid = '<?php echo !empty($detailSupport['districtid'])?$detailSupport['districtid']:$this->input->post('districtid') ?>';
                                var wardid = '<?php echo $this->input->post('wardid') ?>';
                            </script>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label text-left">
                                        <span>Quận/Huyện</span>
                                    </label>
                                    <select name="districtid" id="district" class="form-control m-b location">
                                        <option value="0">Chọn Quận/Huyện</option>
                                    </select>
                                </div>
                            </div>
                        </div>
						<div class="row mb15 hidden">

                            <div class="form-row col-lg-12">
                                <label class="control-label text-left panel-head-1">
                                    <span>Chọn Nhóm Thành Viên <b class="text-danger">(*)</b></span>
                                </label>
                                <?php echo form_dropdown('catalogueid', dropdown(array(
                                    'text'=>'Chọn nhóm hỗ trợ',
                                    'select'=>'id, title',
                                    'table'=>'support_catalogue',
                                    'field'=>'id',
                                    'value'=>'title',
                                    'order_by'=>'id DESC'
                                )), set_value('catalogueid', $detailSupport['catalogueid']) ,'class="form-control input-sm perpage filter catalogueid" style="height:34px !important"'); ?>

                            </div>
						</div>


						<div class="row mb15">
							<div class="form-row col-lg-12">
								<label class="control-label text-left panel-head-1">
									<span>Quản lí thiết lập hiển thị cho blog này</span>
								</label>
								<div class="row">
                                    <div class="block uk-clearfix col-lg-6">
                                        <div class="i-checks" style="width:100%;">
										<span style="color:#000;">
											<input type="radio" <?php echo ($detailSupport['publish'] == 0) ? 'checked' : ''	;?>  class="popup_gender_0 gender"  value="0"  name="publish">Hiển thị
										</span>
                                        </div>
                                    </div>
                                    <div class="block uk-clearfix col-lg-6">
                                        <div class="i-checks" style="width:100%;">
										<span style="color:#000;">
											<input type="radio" <?php echo ($detailSupport['publish'] == 1) ? 'checked' : '' ;?>  class="popup_gender_1 gender" required value="1" name="publish">Tắt
										</span>
                                        </div>
                                    </div>

                                </div>
							</div>


						</div>

						<div class="toolbox action clearfix">
							<div class="uk-flex uk-flex-middle uk-button pull-right">
								<button class="btn btn-success btn-sm" name="update" value="update" type="submit">Lưu</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- ----------------- -->
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>