<script type='text/javascript' src='plugin/dimage-360/photo-sphere-viewer.min.js?ver=1'></script>
<script type='text/javascript' src='plugin/dimage-360/three.min.js?ver=1'></script>
<div id="main" class="wrapper main-Experimental">

	<div id="banner" class="banner-child">
		<div class="dimage-360-area img-banner" style="height: 400px;border-radius: 10px;width: 100%;" id="dtcontainer_1"></div>

		<script>
			var div = document.getElementById('dtcontainer_1');
			var PSV = new PhotoSphereViewer({
				panorama: '<?php echo $detailMedia['image']?>',
				container: div,
				default_position: {long: 0/60},
				time_anim: false,
				navbar: false,
				zoom_level: 0,
				anim_speed: '2rpm',
				navbar_style: {
					backgroundColor: 'rgba(58, 67, 77, 0.7)'
				},
			});
		</script>
		<h3 class="title-category"><a href="javascript:void(0);"><?php echo $detailMedia['title'] ?></a></h3>

	</div>


	<section class="content-Experimental content-Experimental-bottom">
		<div class="container-fluid">
			<h2 class="title-primary1">XEM <?php echo $detailCatalogue['title'] ?></h2>

			<div class="row">
				<div class="content-Experimental-right">


					<?php if (isset($relatedmedia) && is_array($relatedmedia) && count($relatedmedia)) { ?>
						<?php foreach ($relatedmedia as $key => $val) {
							$href = rewrite_url($val['canonical'], TRUE, TRUE);
							$canonicalP = BASE_URL . $href; ?>
							<div class="col-xs-12">
								<div class="item1">
									<div class="image">
										<a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
																		   alt="<?php echo $val['title'] ?>"></a>
									</div>
									<div class="nav-image">
										<h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
										</h3>
										<ul>
											<li>
												<div class="fb-like" data-href="<?php echo $canonicalP ?>" data-width=""
													 data-layout="button" data-action="like" data-size="small"
													 data-share="true"></div>
											</li>

											<?php if ($val['viewed'] > 0) { ?>
												<li><?php echo $val['viewed'] ?> <img
														src="template/frontend/noithat-PC/images/i3.png" alt="lượt xem">
												</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>


				</div>
			</div>
		</div>
	</section>


	<?php echo $this->load->view('homepage/frontend/common/tag') ?>


	<?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>


</div>
