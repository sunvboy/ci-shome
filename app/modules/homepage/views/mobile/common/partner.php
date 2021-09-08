<?php
if (!$icon = $this->cache->get('icon')) {
    $icon = slide(array('keyword' => 'partner'), $this->fc_lang);
    $data['icon'] = $icon;
    $this->cache->save('icon', $icon, 200);
} else {
    $data['icon'] = $icon;
}
if (isset($icon) && is_array($icon) && count($icon)) { ?>
    <section class="logo-bottom">
        <div class="container-fluid">

            <?php foreach ($icon as $key => $val) { ?>
                <div class="item">
                    <a href="<?php echo $val['link'] ?>"> <img src="<?php echo $val['src'] ?>"
                                                               alt="<?php echo $val['title'] ?>"></a>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </section>
<?php } ?>