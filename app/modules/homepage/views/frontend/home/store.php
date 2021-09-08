<script>
    $("body").removeAttr('class');
    $("body").attr('class', "smile-store-locator-store-search page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPYwKdcUYplwZuW9gSMfSB7naz42TcUE0&callback=initMap"></script>

<main id="maincontent" class="page-main">

    <a id="contentarea" tabindex="-1"></a>
    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Tìm kiếm cửa hàng</span>
        </h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">
            <div id="store-locator-search-wrapper" class="store-search">
                <div class="contextual-bar">

                    <div class="shop-search">
                        <?php
                        $groupValue = [];
                        if (isset($Liststores)) {
                            $groupValue = groupValue($Liststores, 'cityid');
                        }
                        ?>
                        <?php if (is_array($groupValue) && count($groupValue) && isset($groupValue)) { ?>
                            <div class="fulltext-search-wrapper">
                                <div class="geocoder-wrapper">
                                    <div class="form">
                                        <div class="geolocalize-container">


                                            <div class="field col-md-12 col-sm-24 col-sx-24">
                                                <p class="title-map">Chọn tỉnh thành</p>
                                                <select name="showroom_city_id" class="showroom_city_id">
                                                    <option label=" -- Thành phố / Tỉnh -- " value="0"
                                                            lat-city="14.058324" long-city="108.277199"> -- Thành phố /
                                                        Tỉnh --
                                                    </option>
                                                    <?php $i = 0;
                                                    foreach ($groupValue as $key => $val) { ?>
                                                        <?php
                                                        $province = $this->Autoload_Model->_get_where(array(
                                                            'select' => '*',
                                                            'table' => 'vn_province',
                                                            'where' => array('provinceid' => $key)
                                                        )); ?>
                                                        <?php if (isset($province)) {
                                                            $i++; ?>
                                                            <option label="<?php echo $province['name'] ?>"
                                                                    value="<?php echo $i ?>"
                                                                    lat-city="<?php echo $province['lat'] ?>"
                                                                    long-city="<?php echo $province['lng'] ?>"
                                                                    data-key='<?php echo $key ?>'
                                                            ><?php echo $province['name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="field col-md-12 col-sm-24 col-sx-24">
                                                <p class="title-map">Chọn quận/huyện</p>
                                                <select name="showroom_districtid" id="showroom_districtid">
                                                    <option value=""> -- Quận / Huyện --</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).on('change', '.showroom_city_id', function (e, data) {
                                    var value = $(this).val();
                                    var keyword = $(this).find(':selected').attr('data-key');
                                    let formURL = 'getLocation-store.html';
                                    $.post(formURL, {keyword: keyword, value: value},
                                        function (data) {
                                            let json = JSON.parse(data);
                                            $('#showroom_districtid').html(json.html);
                                            $('.count_store').html(json.count);
                                        });
                                });
                                $(document).on('change', '#showroom_districtid', function (e, data) {
                                    var value = $(this).val();
                                    var keyword = $(this).find(':selected').attr('data-key');
                                    var provinceid = $(this).find(':selected').attr('data-province');
                                    let formURL = 'getDistrict-store.html';
                                    $.post(formURL, {keyword: keyword, provinceid: provinceid},
                                        function (data) {
                                            let json = JSON.parse(data);
                                            $('.city-wrapper').hide();
                                            $('.city_' + value).html(json.html);
                                            $('.city_' + value).show();
                                            $('.count_store').html(json.count);

                                        });
                                });
                            </script>

                        <?php } ?>
                        <div class="search-result-list list-level">
                            <div class="search-result-header">
                                <p><span class="count_store"><?php echo !empty($Liststores)?count($Liststores):0?></span> kết quả</p>
                            </div>
                            <ul class="city_0 city-wrapper" style="display: block;">

                                <?php if (is_array($Liststores) && count($Liststores) && isset($Liststores)) { ?>
                                    <?php foreach ($Liststores as $key => $val) { ?>
                                        <li class="showroom-item loc_link result-item"
                                            data-brand="<?php echo $val['address_distric'] ?>"
                                            data-address="<?php echo $val['address'] ?>"
                                            data-phone="<?php echo $val['phone'] ?>"
                                            data-lat="<?php echo $val['lat'] ?>"
                                            data-long="<?php echo $val['long'] ?>">
                                            <div class="heading" style="display: flex">

                                                <p class="name-label" style="flex: 1">
                                                    <span><?php echo $key + 1 ?></span>.<strong
                                                            data-bind="text: name"><?php echo $val['fullname'] ?></strong>
                                                </p>
                                            </div>
                                            <div class="details">
                                                <p class="address" style="flex:1"><em><?php echo $val['address'] ?></em>
                                                </p>

                                                <p class="button-desktop button-view">
                                                    <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
                                                    <a class="arrow-right"><span><i class="fa fa-angle-right"
                                                                                    aria-hidden="true"></i></span></a>
                                                </p>
                                                <p class="button-mobile button-view">
                                                    <a target="_blank" href="https://www.google.com/maps/dir//<?php echo $val['lat'] ?>,<?php echo $val['long'] ?>">Tìm đường</a>
                                                    <a class="arrow-right" target="_blank" href="https://www.google.com/maps/dir//<?php echo $val['lat'] ?>,<?php echo $val['long'] ?>"><span><i class="fa fa-angle-right"
                                                                                    aria-hidden="true"></i></span></a>
                                                </p>
                                            </div>
                                        </li>
                                    <?php } ?>
                                <?php } ?>


                            </ul>
                            <?php if (is_array($groupValue) && count($groupValue) && isset($groupValue)) { ?>
                                <?php $i = 0;
                                foreach ($groupValue as $key => $valC) { ?>
                                    <?php
                                    $province = $this->Autoload_Model->_get_where(array(
                                        'select' => '*',
                                        'table' => 'vn_province',
                                        'where' => array('provinceid' => $key)
                                    )); ?>
                                    <?php if (isset($province)) {
                                        $i++; ?>
                                        <ul class="city_<?php echo $i ?> city-wrapper" style="display: none;">
                                            <?php if (is_array($valC) && count($valC) && isset($valC)) { ?>
                                                <?php foreach ($valC as $keyC => $val) { ?>
                                                    <li class="showroom-item loc_link result-item"
                                                        data-brand="<?php echo $val['address_distric'] ?>"
                                                        data-address="<?php echo $val['address'] ?>"
                                                        data-phone="<?php echo $val['phone'] ?>"
                                                        data-lat="<?php echo $val['lat'] ?>"
                                                        data-long="<?php echo $val['long'] ?>">
                                                        <div class="heading" style="display: flex">

                                                            <p class="name-label" style="flex: 1">
                                                                <span><?php echo $key + 1 ?></span>.<strong
                                                                        data-bind="text: name"><?php echo $val['fullname'] ?></strong>
                                                            </p>
                                                        </div>
                                                        <div class="details">
                                                            <p class="address" style="flex:1">
                                                                <em><?php echo $val['address'] ?></em>
                                                            </p>

                                                            <p class="button-desktop button-view">
                                                                <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
                                                                <a class="arrow-right"><span><i
                                                                                class="fa fa-angle-right"
                                                                                aria-hidden="true"></i></span></a>
                                                            </p>
                                                            <p class="button-mobile button-view">
                                                                <a target="_blank" href="https://www.google.com/maps/dir//<?php echo $val['lat'] ?>,<?php echo $val['long'] ?>">Tìm đường</a>
                                                                <a class="arrow-right" target="_blank" href="https://www.google.com/maps/dir//<?php echo $val['lat'] ?>,<?php echo $val['long'] ?>"><span><i
                                                                                class="fa fa-angle-right"
                                                                                aria-hidden="true"></i></span></a>
                                                            </p>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>

                        </div>

                    </div>

                </div>
                <div class="map">
                    <fieldset class="gllpLatlonPicker">
                        <div class="gllpMap" id="map"></div>
                        <input type="hidden" class="gllpLatitude" value="14.058324" name="showroom_lat">
                        <input type="hidden" class="gllpLongitude" value="108.277199" name="showroom_lon">
                        <input type="button" class="gllpUpdateButton" value="update map">
                        <input type="hidden" class="gllpZoom" value="17">
                    </fieldset>
                </div>


            </div>
        </div>

    </div>

</main>


<script type="text/javascript">
    var locations;

    $(document).ready(function () {
        $(document).on('click', '.showroom-item', function (e, data) {
            $('.showroom-item').removeClass('active');
            $(this).addClass('active');

        });

        $('.showroom-item').hover(
            function () {
                $(this).addClass('hover');
            },
            function () {
                $(this).removeClass('hover');
            }
        );
        $('.geolocalize-container select').change(function () {
            var city_id = $('.showroom_city_id option:selected').val();
            $('.city-wrapper').css('display', 'none');
            $('.city_' + city_id).css('display', 'block');
        });
    });
    var icon = {
        url: "<?php echo $this->fcSystem['homepage_icon']?>", // url
        scaledSize: new google.maps.Size(54, 70), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };

    function initialize() {
        locations = [

            <?php if (is_array($Liststores) && count($Liststores) && isset($Liststores)) { ?>
            <?php foreach ($Liststores as $key => $val) { ?>


            ['<?php echo $val['address_distric']?><br><?php echo $val['address']?><br><?php echo $val['phone']?>', <?php echo $val['lat']?>, <?php echo $val['long']?>, <?php echo $key + 1?>],
            <?php }?>
            <?php }?>

        ];
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5.2,
            center: new google.maps.LatLng(14.058324, 108.277199),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: icon
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    $('.showroom_city_id').on('change', function initialize() {
        <?php if (is_array($groupValue) && count($groupValue) && isset($groupValue)) { ?>
        <?php $i = 0;
        foreach ($groupValue as $key => $valC) { ?>
        <?php
        $province = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'vn_province',
            'where' => array('provinceid' => $key)
        )); ?>
        <?php if (isset($province)) { $i++; ?>
        <?php if($i == 1){?>
        if (this.value == <?php echo $i?>) {
            locations = [


                <?php if (is_array($valC) && count($valC) && isset($valC)) { ?>
                <?php foreach ($valC as $keyC => $val) { ?>
                ['<?php echo $val['address_distric']?><br><?php echo $val['address']?><br><?php echo $val['phone']?>', <?php echo $val['lat']?>, <?php echo $val['long']?>, <?php echo $keyC + 1?>],
                <?php }?>
                <?php }?>


            ];
        }

        <?php }else{?>
        else if (this.value == <?php echo $i?>) {
            locations = [

                <?php if (is_array($valC) && count($valC) && isset($valC)) { ?>
                <?php foreach ($valC as $keyC => $val) { ?>
                ['<?php echo $val['address_distric']?><br><?php echo $val['address']?><br><?php echo $val['phone']?>', <?php echo $val['lat']?>, <?php echo $val['long']?>, <?php echo $keyC + 1?>],
                <?php }?>
                <?php }?>


            ];
        }

        <?php }?>



        <?php } ?>
        <?php } ?>
        <?php } ?>
        else {
            locations = [


                <?php if (is_array($Liststores) && count($Liststores) && isset($Liststores)) { ?>
                <?php foreach ($Liststores as $key => $val) { ?>
                ['<?php echo $val['address_distric']?><br><?php echo $val['address']?><br><?php echo $val['phone']?>', <?php echo $val['lat']?>, <?php echo $val['long']?>, <?php echo $key + 1?>],
                <?php }?>
                <?php }?>


            ];
        }


        var lat = $('option:selected', this).attr('lat-city');
        var lon = $('option:selected', this).attr('long-city');
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: new google.maps.LatLng(lat, lon),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: icon
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    });


    $(document).on('click', '.showroom-item', function initialize() {

        var lat = $(this).attr('data-lat');
        var lon = $(this).attr('data-long');
        var latLng = new google.maps.LatLng(lat, lon);
        var mapOptions = {
            zoom: 16,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var contentString = '<div><strong>' + $(this).attr('data-brand') + '</strong></div>' +
            '<div>Địa chỉ: ' + $(this).attr('data-address') + '</div>' +
            '<div>Điện thoại: ' + $(this).attr('data-phone') + '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
            icon: icon
        });
        infowindow.open(map, marker);
    });
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
    #map {
        height: 523px;
    }
</style>
<style>
    .loc_link.active p.button-view {
        background-color: #292bb7 !important;
    }

    input[type="text"], input[type="email"], input[type="tel"], input[type="password"], textarea.form-control, select.form-control {
        border-radius: 0;
        outline: none;
        box-shadow: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: 1px solid #e1e1e1
    }

    input[type="text"]:focus, input[type="email"]:focus, input[type="tel"]:focus, input[type="password"]:focus, textarea.form-control:focus, select.form-control:focus {
        outline: none;
        box-shadow: none
    }


    .btn-blues {
        color: #fff;
        background-color: #f54337;
        border-color: #f54337;
        border-radius: 2px !important;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
        z-index: 1
    }

    .btn-blues:after {
        position: absolute;
        bottom: 0;
        left: 0;
        display: block;
        content: " ";
        width: 100%;
        height: 100%;
        background-color: #f65a4f;
        border-radius: inherit;
        z-index: -1;
        -webkit-transform-origin: 0 100%;
        -moz-transform-origin: 0 100%;
        transform-origin: 0 100%;
        -webkit-transform: scaleY(0);
        -moz-transform: scaleY(0);
        transform: scaleY(0);
        -webkit-transition: -webkit-transform .25s ease-in-out;
        -moz-transition: -moz-transform .25s ease-in-out;
        transition: transform .25s ease-in-out
    }

    .btn-blues:hover {
        color: #fff
    }

    .btn-blues:hover:after {
        -webkit-transform: scaleY(1);
        -moz-transform: scaleY(1);
        transform: scaleY(1)
    }


    @media (max-width: 767px) {
        header .topbar {
            padding: 4px 0;
            font-size: 13px
        }
    }


    @-webkit-keyframes pulse {
        0% {
            -webkit-transform: scale(1.1);
            transform: scale(1.1)
        }
        50% {
            -webkit-transform: scale(0.8);
            transform: scale(0.8)
        }
        100% {
            -webkit-transform: scale(1.1);
            transform: scale(1.1)
        }
    }

    @keyframes pulse {
        0% {
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1)
        }
        50% {
            -webkit-transform: scale(0.8);
            -ms-transform: scale(0.8);
            transform: scale(0.8)
        }
        100% {
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1)
        }
    }

    .animated {
        animation-duration: 1s;
        animation-fill-mode: both
    }

    .animated.infinite {
        animation-iteration-count: infinite
    }

    .animated.hinge {
        animation-duration: 2s
    }

    .animated.flipOutX, .animated.flipOutY, .animated.bounceIn, .animated.bounceOut {
        animation-duration: .75s
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3)
        }
        50% {
            opacity: 1
        }
    }

    .zoomIn {
        animation-name: zoomIn
    }

    @keyframes pulse {
        from {
            transform: scale3d(1, 1, 1)
        }
        50% {
            transform: scale3d(1.05, 1.05, 1.05)
        }
        to {
            transform: scale3d(1, 1, 1)
        }
    }

    .pulse {
        animation-name: pulse
    }

    @keyframes rubberBand {
        from {
            transform: scale3d(1, 1, 1)
        }
        30% {
            transform: scale3d(1.25, 0.75, 1)
        }
        40% {
            transform: scale3d(0.75, 1.25, 1)
        }
        50% {
            transform: scale3d(1.15, 0.85, 1)
        }
        65% {
            transform: scale3d(0.95, 1.05, 1)
        }
        75% {
            transform: scale3d(1.05, 0.95, 1)
        }
        to {
            transform: scale3d(1, 1, 1)
        }
    }


    .showroom-list {
        background-color: #000;
        height: 500px
    }

    .showroom-list .city-selector {
        background-color: #f54337;
        padding: 20px 10px
    }

    .showroom-list .city-selector h2 {
        font-size: 15px;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 10px
    }

    .showroom-list .showroom-item {
        margin: 15px 10px;
        cursor: pointer
    }

    .showroom-list .showroom-item.active h2.title {
        color: #f54337
    }

    .showroom-list h2.title {
        color: #fff;
        text-transform: uppercase;
        font-size: 16px;
        margin-top: 0
    }

    .showroom-list p {
        color: #858585;
        font-size: 12px !important;
        margin: 5px 0px;
        line-height: 1.5em;
        display: table;
        width: 100%
    }

    .showroom-list p i {
        display: table-cell;
        width: 15px
    }

    .showroom-list p a {
        color: #858585
    }

    .showroom-list p:last-child {
        border-bottom: 1px solid #333333;
        padding-bottom: 15px
    }

    .showroom-list select {
        display: block;
        outline: none;
        box-shadow: none;
        border-radius: 0;
        background-color: #fff;
        background: url(data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0Ljk1IDEwIj48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2ZmZjt9LmNscy0ye2ZpbGw6IzQ0NDt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPmFycm93czwvdGl0bGU+PHJlY3QgY2xhc3M9ImNscy0xIiB3aWR0aD0iNC45NSIgaGVpZ2h0PSIxMCIvPjxwb2x5Z29uIGNsYXNzPSJjbHMtMiIgcG9pbnRzPSIxLjQxIDQuNjcgMi40OCAzLjE4IDMuNTQgNC42NyAxLjQxIDQuNjciLz48cG9seWdvbiBjbGFzcz0iY2xzLTIiIHBvaW50cz0iMy41NCA1LjMzIDIuNDggNi44MiAxLjQxIDUuMzMgMy41NCA1LjMzIi8+PC9zdmc+) no-repeat 100% 50% #fff;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none
    }

    .city-wrapper {
        overflow-y: scroll
    }

    .city-wrapper .has-scrollbar .content {
        outline: none;
        box-shadow: none;
        border: none
    }

    .city-wrapper::-webkit-scrollbar {
        width: 5px
    }

    .city-wrapper::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.5);
        border-radius: 10px
    }

    .city-wrapper::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.5)
    }

    .gllpMap {
        width: 100%;
        height: 500px
    }

    .gllpUpdateButton {
        display: none
    }

    .gllpLatlonPicker {
        padding: 0;
        border: 0px;
    }


    input[type="text"], input[type="search"], input[type="password"], input[type="email"], input[type="file"], input[type="number"], input[type="tel"], textarea, select {
        border: 1px solid #e1e1e1;
        padding: 0 20px;
        width: 100% !important;
        max-width: 100%;
        display: block;
    }


</style>