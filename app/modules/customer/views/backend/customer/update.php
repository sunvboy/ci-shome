<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cập nhật khách hàng</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhật khách hàng</strong></li>
			</ol>
		</div>
	</div>
	<form method="post" action="" class="form-horizontal box" >
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
				</div><!-- /.box-body -->
			</div>
			<div class="row">
				<div class="col-lg-5">
					<div class="panel-head">
						<h2 class="panel-title">Thông tin chung</h2>
						<div class="panel-description">
							Một số thông tin cơ bản của người sử dụng.
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="ibox m0">
						<div class="ibox-content">
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Tài khoản </span>
										</label>
										<?php echo form_input('account', htmlspecialchars_decode(html_entity_decode(set_value('account', $detailCustomer['account']))), 'class="form-control" placeholder="" autocomplete="off"');?>
										<?php echo form_hidden('account_original', htmlspecialchars_decode(html_entity_decode(set_value('account_original', $detailCustomer['account']))), 'class="form-control"  placeholder="" autocomplete="off"');?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Họ tên <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_input('fullname', set_value('fullname', $detailCustomer['fullname']), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Email <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_input('email', set_value('email', $detailCustomer['email']), 'class="form-control " placeholder="" autocomplete="off"');?>
										<?php echo form_hidden('email_original', htmlspecialchars_decode(html_entity_decode(set_value('email_original', $detailCustomer['email']))), 'class="form-control" readonly="true" placeholder="" autocomplete="off"');?>
									</div>
								</div>
								<?php 
									$dropdown = dropdown(array(
										'select' => 'id, title',
										'table' => 'customer_catalogue',
										'order_by' => 'id asc',
										'text' => 'Chọn Nhóm khách hàng',
										'field' => 'id',
										'value' => 'title'
									));
								?>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Nhóm khách hàng <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_dropdown('catalogueid', $dropdown, set_value('catalogueid', $detailCustomer['catalogueid']), 'class="form-control m-b city"');?>
									</div>
								</div>
							</div>
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Ngày sinh <b class="text-danger"></b></span>
										</label>
										<?php echo form_input('birthday', set_value('birthday', gettime($detailCustomer['birthday'],'d/m/Y')), 'class="form-control datetimepicker" placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<?php 
								if($this->input->post('gender')){
									$gender = (int)$this->input->post('gender');
								}else{
									$gender = (int)$detailCustomer['gender'];
								}
							?>
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Giới tính <b class="text-danger"></b></span>
										</label>
										<div class="uk-flex uk-flex-middle">
											<div class="i-checks mr30"><label> <input <?php echo ($gender == 1) ? 'checked' : '' ?> class="popup_gender_1 gender" type="radio" value="1"  name="gender"> <i></i> Nam</label></div>
											<div class="i-checks"><label> <input type="radio" <?php echo ($gender == 0) ? 'checked' : '' ?> class="popup_gender_0 gender" required value="0" name="gender"> <i></i> Nữ </label></div>
										</div>
									</div>
								</div>
							</div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row"><label class="control-label text-left">
                                            <span>Ảnh đại diện</span> </label>
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="avatar" style="cursor: pointer;"><img
                                                        style="border-radius: 100%"
                                                        src="<?php echo ($this->input->post('avatar')) ? $this->input->post('avatar') : ((!empty($detailCustomer['avatar'])) ? $detailCustomer['avatar'] : 'template/not-found.png') ?>"
                                                        class="img-thumbnail" alt="">
                                            </div> <?php echo form_input('avatar', htmlspecialchars_decode(html_entity_decode(set_value('avatar',$detailCustomer['avatar']))), 'class="form-control " placeholder="Đường dẫn của ảnh" onclick="openKCFinder(this)"  autocomplete="off"'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-5">
					<div class="panel-head">
						<h2 class="panel-title">Địa chỉ</h2>
						<div class="panel-description">
							Các thông tin liên hệ chính với người sử dụng này.
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="ibox m0">
						<div class="ibox-content">
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Địa chỉ</span>
										</label>
										<?php echo form_input('address', htmlspecialchars_decode(html_entity_decode(set_value('address', $detailCustomer['address']))), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Số điện thoại</span>
										</label>
										<?php echo form_input('phone', htmlspecialchars_decode(html_entity_decode(set_value('phone', $detailCustomer['phone']))), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
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
										<?php
											if(isset($cityPost) && !empty($cityPost)){
										?>
										<script>
											var cityid = '<?php echo $this->input->post('cityid') ?>';
											var districtid = '<?php echo $this->input->post('districtid') ?>';
											var wardid = '<?php echo $this->input->post('wardid') ?>';
										</script>
											<?php }else{ ?>
										<script>
											var cityid = '<?php echo $detailCustomer['cityid']; ?>';
											var districtid = '<?php echo $detailCustomer['districtid'] ?>';
											var wardid = '<?php echo $detailCustomer['wardid'] ?>';
										</script>	
										
											<?php } ?>
										<?php echo form_dropdown('cityid', $listCity, '', 'class="form-control m-b city"  id="city"');?>
									</div>
								</div>
								
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
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Phường xã</span>
										</label>
										<select name="wardid" id="ward" class="form-control m-b location">
											<option value="0">Chọn Phường/Xã</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Ghi chú</span>
										</label>
										<?php echo form_input('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $detailCustomer['description']))), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="toolbox action clearfix">
								<div class="uk-flex uk-flex-middle uk-button pull-right">
									<button class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhật</button>
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
