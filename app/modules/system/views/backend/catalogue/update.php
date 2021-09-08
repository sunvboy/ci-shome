<div id="page-wrapper" class="gray-bg dashbard-1 fix-wrapper">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cập nhật nhóm config</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhật nhóm config</strong></li>
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
				<div class="col-lg-12 clearfix">
					<div class="ibox mb20">
						<div class="ibox-title" style="padding: 9px 15px 0px;">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<h5>Thông tin cơ bản <small class="text-danger">Điền đầy đủ các thông tin được mô tả dưới đây</small></h5>
								<div class="ibox-tools">
									<button type="submit" name="update" value="update" class="btn btn-success block full-width m-b">Lưu</button>
								</div>
							</div>
						</div>
						<div class="ibox-content">

							<div class="row mb15">
								<div class="col-lg-12">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Tiêu đề danh mục <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title', $detailCatalogue['title']))), 'class="form-control title" placeholder="" id="title" autocomplete="off"');?>
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

