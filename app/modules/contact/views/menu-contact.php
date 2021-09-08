<?php
if (!$menuContact = $this->cache->get('menuContact')) {
    $menuContact = slide(array('keyword' => 'menu-contact'), $this->fc_lang);
    $this->cache->save('menuContact', $menuContact, 200);
} else {
    $menuContact = $menuContact;
}
?>
<?php if (isset($menuContact) && is_array($menuContact) && count($menuContact)) {?>
    <section class="Experimental-page">
        <div class="container-fluid">
            <div class="nav-Experimental">
                <div class="row">

                    <?php foreach ($menuContact as $key => $val) {?>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="item">
                                <div class="image">
                                    <a href="<?php echo $val['link']?>"><img src="<?php echo $val['src']?>" alt="<?php echo $val['title']?>"></a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title"><a href="<?php echo $val['link']?>"><?php echo $val['title']?></a></h3>
                                </div>
                            </div>
                        </div>
                    <?php }?>


                </div>
            </div>
        </div>
    </section>
<?php }?>