<div id="main" class="wrapper">


    <section class="category-services category-services2 wow fadeInUp">
        <div class="container">
            <h2 class="title-primary">- <?php echo $detailCatalogue['title'] ?> - </h2>
            <div class="nav-category-services">
                <div class="row">
                    <?php if (isset($danhmuc) && is_array($danhmuc) && count($danhmuc)) { ?>
                        <?php foreach ($danhmuc as $keyC => $valC) {
                            $hrefC = rewrite_url($valC['canonical'], TRUE, TRUE); ?>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="item">
                                    <div class="image">
                                        <a href="<?php echo $hrefC ?>"><img src="<?php echo $valC['images'] ?>"
                                                                            alt="<?php echo $valC['title'] ?>"></a>
                                    </div>
                                    <div class="item-img">
                                        <div class="icon">
                                            <a href="<?php echo $hrefC ?>"><img
                                                        src="<?php echo $valC['image'] ?>"
                                                        alt="<?php echo $valC['title'] ?>"></a>
                                        </div>
                                        <h3 class="title"><a
                                                    href="<?php echo $hrefC ?>"><?php echo $valC['title'] ?></a>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    </section>


</div>
