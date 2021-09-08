
<div class="size-thick js_addtribute">


    <?php
    if (isset($attroldISHOME) && count($attroldISHOME) && is_array($attroldISHOME)) {
        $attrFinalDOCUNG = groupValue($attroldISHOME, 'titleC');
    } else {
        $attrFinalDOCUNG = [];
    }
    ?>
    <?php if (is_array($attrFinalDOCUNG) && count($attrFinalDOCUNG) && isset($attrFinalDOCUNG)) { ?>
        <?php foreach ($attrFinalDOCUNG as $keyP => $valP) { ?>
            <?php if (is_array($valP) && count($valP) && isset($valP)) { ?>
                <div class="items-option">
                    <span class="label"><?php echo $keyP ?></span>
                    <div data-v-138dff1d="" class="v-select">
                        <?php foreach ($valP as $key => $val) { if($key==0){?>
                            <button data-v-138dff1d="" type="button" class="v-select-toggle">
                                <div class="title-attr-2">
                                    <?php echo $val['title'] ?>
                                </div>
                                <div data-v-138dff1d="" class="arrow-down"></div>
                            </button>
                        <?php } ?>
                        <?php } ?>
                        <div data-v-138dff1d="" class="v-dropdown-container" style="display: none;">

                            <ul data-v-138dff1d="">
                                <?php foreach ($valP as $key => $val) { ?>
                                    <li data-v-138dff1d="" data-sub-title="<?php echo $keyP ?>: <?php echo $val['title'] ?>" data-id="<?php echo $val['id'] ?>" onclick="changeDrop(2,<?php echo $val['id'] ?>,'<?php echo $val['title'] ?>','<?php echo $keyP ?>: <?php echo $val['title'] ?>')" class="v-dropdown-item v-dropdown-item-2 v-dropdown-item-<?php echo $val['id'] ?> <?php if ($key == 0) { ?>selected js_choose<?php } ?>"><?php echo $val['title'] ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <?php if (is_array($list_version) && count($list_version) && isset($list_version)) { ?>
        <?php if (is_array($getCatalogueAttr) && count($getCatalogueAttr) && isset($getCatalogueAttr)) { ?>
            <div class="items-option">
                <span class="label"><?php echo $getCatalogueAttr['titleC'] ?></span>
                <div data-v-138dff1d="" class="v-select">
                    <?php foreach ($list_version as $key => $val) {
                        if ($key == 0) { ?>
                            <button data-v-138dff1d="" type="button" class="v-select-toggle">
                                <div data-v-138dff1d="" class="title-attr-1">
                                    <?php echo $val['title'] ?>
                                </div>
                                <div data-v-138dff1d="" class="arrow-down"></div>
                            </button>
                        <?php } ?>
                    <?php } ?>

                    <div data-v-138dff1d="" class="v-dropdown-container" style="display: none;">
                        <ul data-v-138dff1d="">
                            <?php foreach ($list_version as $key => $val) { ?>
                                <li data-v-138dff1d="" data-sub-title="<?php echo $getCatalogueAttr['titleC'] ?>: <?php echo $val['title'] ?>" data-id="<?php echo $val['id'] ?>" onclick="changeDrop(1,<?php echo $val['id'] ?>,'<?php echo $val['title'] ?>','<?php echo $getCatalogueAttr['titleC'] ?>: <?php echo $val['title'] ?>',<?php echo $val['price_version'] ?>)" class="v-dropdown-item v-dropdown-item-1 v-dropdown-item-<?php echo $val['id'] ?> <?php if ($key == 0) { ?>selected js_choose<?php } ?>"><?php echo $val['title'] ?></li>
                            <?php } ?>

                        </ul>
                    </div>

                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>