<?php
if (!$gioithieuContact = $this->cache->get('gioithieuContact')) {
    $gioithieuContact = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,description',
        'table' => 'page',
        'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)));
    $this->cache->save('gioithieuContact', $gioithieuContact, 200);
} else {
    $gioithieuContact = $gioithieuContact;
}
?>
<?php if(!empty($gioithieuContact)){?>
    <div class="info-contact-center box">
        <h3 class="title"><?php echo $gioithieuContact['title']?></h3>
        <?php echo $gioithieuContact['description']?>
    </div>
<?php }?>