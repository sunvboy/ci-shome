<div id="main" class="wrapper main-Handbook">



	<div class="top-title">
		<div class="container-fluid">
			<h2 class="title-primary1">TAG: <?php echo $detailTag['title'] ?></h2>
		</div>
	</div>
	<section class="content-Experimental">
		<div class="container-fluid">

			<div class="content-Handbook section-experience">
				<div class="row">

					<?php echo $this->load->view('article/frontend/catalogue/aside_left') ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<h2 class="title-primary1">Bài viết</h2>
						<?php if (isset($objectList) && is_array($objectList) && count($objectList)) {
							foreach ($objectList as $key => $val) {?>
								<?php echo listArticle($val); ?>

							<?php } ?>
						<?php } ?>
						<div class="clearfix"></div>
						<div class="pagenavi" id="pagination">
							<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

						</div>
					</div>
					<?php echo $this->load->view('article/frontend/catalogue/aside_right') ?>

				</div>
			</div>
		</div>
	</section>




	<?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>

</div>
<style>
	.tag-new-home, .title-title-small {
		display: none;
	}
</style>
<?php


function listArticle($val = '')
{


	$html = '';
	$title = $val['title'];
	$image = $val['image'];
	$href = rewrite_url($val['canonical'], TRUE, TRUE);
	$description = cutnchar(strip_tags($val['description']),100);
	$canonicalP = $href;
	$html = $html . '<div class="content-Handbook-center box">
                                        <div class="image">
                                            <a href="' . $href . '"><img src="' . $image . '" alt="' . $title . '"></a>
                                        </div>
                                        <h3 class="title"><a href="' . $href . '">' . $title . '</a></h3>

                                        <p class="title-ca"><a href="' . $href . '">' . $title . '</a><a href="' . $href . '" class="readmore1">Xem thêm</a></p>

                                        <p class="desc">' . $description . ' </p>

                                        <div class="center">
                                            <ul class="list-share">
                                                 <li><div class="fb-like" data-href="' . $canonicalP . '" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div></li>
                                                <li>' . $val['viewed'] . ' <img src="template/frontend/noithat-PC/images/i3.png" alt="Lượt xem">Lượt xem</li>
                                            </ul>
                                        </div>
                                    </div>';

	return $html;
}


?>
