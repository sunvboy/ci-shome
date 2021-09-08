<style>
    .lqt-total p{
        margin-bottom: 0px;
    }
    .button-group-1 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .button-group-1 a {
        -webkit-transition: all .3s;
        transition: all .3s;
        text-align: center;
        width: 49%;
        border-radius: 4px;
        text-transform: uppercase;
        font-weight: 600;
        font-size: 18px;
        color: #20315c !important;
        border: 1px solid #20315c;
        padding: 10px 15px;
    }

    .button-group-1 a img {
        margin-right: 2px;
    }
    @media (min-width: 992px){
        .col-md-5 {
            width: 41.66666667%;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .col-md-3 {
            width: 25% !important;
        }
        #col_qu .col-md-6 {
            width: 50%;
        }
    }
    .product-detail-main-content .product-detail-first-block .column-left,.product-detail-main-content .product-detail-first-block .product-detail,.catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column{
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
        padding-right: 15px;
    }
    .map-bt .label ,.why-buy .label {
        font-size: 13px;
        font-weight: 500;
        background: #d89b0f;
        color: #fff;
        margin-bottom: 10px;
        text-transform: uppercase;
        position: relative;
        padding: 8px 15px;
        width: 100%;
        margin-top: 10px;
        border-radius: 3px;
        box-shadow: 0 3px 4px 0 rgb(10 31 68 / 10%), 0 0 1px 0 rgb(10 31 68 / 8%);
    }
    .map-bt{
        box-shadow: 0 3px 4px 0 rgb(10 31 68 / 10%), 0 0 1px 0 rgb(10 31 68 / 8%);

    }
    .scroll-map-bt {
        overflow-y: scroll;
    }
   .scroll-map-bt::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

   .scroll-map-bt::-webkit-scrollbar
    {
        width: 5px;
        background-color: #F5F5F5;
    }

   .scroll-map-bt::-webkit-scrollbar-thumb
    {
        background-color:#d89b0f
    }

    .box-see-more-news {
        float: left;
        margin-top: 3px;
        font-size: 16px;
        padding-left: 10px;
    }
    .box-see-more-news i.fa.fa-map-marker {
        float: left;
        margin-top: 3px;
        font-size: 16px;
        color: #d89b0f;
    }
    .box-see-text {
        padding-left: 15px;
    }
    .map-bt p {
        margin: 0px;
        color: #333;
        font-size: 15px;
        font-weight: 400;
        line-height: 22px;
    }
    .product-detail-main-content .product-detail-first-block .product-detail .title{
        line-height: 1.4;

    }
    .wsupport-s li {
        width: 31.33%;
        border: 1px solid #ddd;
        border-radius: 5px;
        list-style: none;
        padding: 12px 0;
        -webkit-box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        margin: 1%;
        float: left;
        height:140px;
    }
    .wsupport-s img {
        padding-bottom: 5px;
        max-width: 100%;
        height: 37px;
        object-fit: contain;
    }
    .wsupport-s li p {
        font-size: 11px;
        line-height: 1.4;
        margin-bottom: 0px;
        padding: 0px 5px;
    }
    .wsupport-s {
        margin: 0 -1%;
        text-align: center;
        overflow: hidden;
        clear: both;
    }
    .textprice-detail-product {
        padding: 10px;
        border: 1px dashed #d4353b;
        border-radius: 10px;
        margin-bottom: 15px;
        background: #fff;
    }
    .final-price del{
        margin: 0;
        display: inline-block;
        padding: 0;
        color: #999;
        font-size: 15px;
        font-weight: 400;
    }
    .product-detail-main-content .product-detail-first-block .product-detail .price-status .final-price .price {
        color: #f43a3a;
        font-size: 23px;
    }
    .btn_phone {
        font-size: 16px;
        font-weight: 500;
        background: #9c9c9c;
        color: #fff;
        text-transform: uppercase;
        position: relative;
        padding: 14px 38px;
        width: 100%;
        height: 45px;
        border-radius: 3px;
        box-shadow: 0 3px 4px 0 rgb(10 31 68 / 10%), 0 0 1px 0 rgb(10 31 68 / 8%);
        float: left;
        margin: 10px 0px;
        border: 0;
        bottom: 1px;
        background-image: linear-gradient(to left,#9c9c9c,#9c9c9c);
        text-align: center;
    }
    .box_support {
        margin-bottom: 10px;
        padding: 20px 0px;
        text-align: center;
        -webkit-box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        background: #f43a3a;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        width: 100%;
    }
    .box_support .hotline {
        text-align: center;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        padding: 0;
        font-size: 18px;
        display: block;
        margin-bottom: 0px;
        margin-top: 0px;
    }
    .box_support .value {
        padding-top: 5px;
        text-align: center;
        font-size: 18px;
        padding-bottom: 10px;
        color: #d89b0f;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 0px;
    }
    .text-nhapnhay {
        animation: blinker 1s step-start infinite;
    }
    .product-call-requests {
        padding: 0px 30px;
        position: relative;
        width: 100%;
    }
    .product-call-requests .ty-control-group__title {
        width: 100%;
        margin: 0;
        padding: 0;
        display: inline-block;
        position: relative;
        font-weight: bold !important;
        font-size: 12px;
        color: #004c91;
    }
    .product-call-requests .ty-control-group__title input[type="tel"] {
        padding-left: 10px;
        display: inline-block;
        background: none;
        height: 32px;
        background: #fff;
        font-size: 12px;
        border: 1px solid #fff;
        border-radius: 5px ;
        width: 100%;
    }
    .product-call-requests .cm-call-requests {
        color: #fff;
        cursor: pointer;
        display: inline-block;
        background-color: #d89b0f;
        border: none;
        font-weight: bold;
        font-size: 12px;
        border-radius: 0 5px 5px 0;
        margin-bottom: 0px;
        height: 32px;
        position: absolute;
        top: 0px;
        right: 0px;
    }
    .product-call-requests .call-note {
        width: 100%;
        font-size: 11px;
        text-align: center;
        display: inline-block;
        padding-left: 5px;
        line-height: 12px;
        margin-top: 5px;
        color: #fff;
        vertical-align: middle;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    .whotline li {
        width: 50%;
        float: left;
        padding: 0px 5px;


    }
    .whotline{
        list-style: none;
    }
    .boxx_li{
        border: 1px dashed #ddd;
        border-radius: 5px;
        list-style: none;
        -webkit-box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 8%);
        background: #f7f7f7;
        padding: 12px 5px;
        float: left;
        width: 100%;
    }
    .whotline {
        overflow: hidden;
        text-align: center;
        clear: both;
        width: 100%;
        float: left;
    }
    .whotline li span {
        display: block;
        font-size: 12px;
    }
    .whotline li p.tdtv {
        font-size: 18px;
        font-weight: 600;
        color: #e00;
        margin-bottom: 0px;
    }
    .whotline li p.hotline {
        font-size: 18px;
        font-weight: 500;
        color: #e00;
        display: block;
        margin: 0px;
        font-weight: bold;
    }
    .catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column .customer-review{
        width: 100%;
        float: left;
    }

    .box-thong-tin-thanh-toan {
        float: left;
        width: 100%;
        border-radius: 10px;
        padding: 10px;
    }
    .content-thong-tin-thanh-toan{
        border: 2px solid #d89b0f;
        float: left;
        width: 100%;
        border-radius: 10px;
        padding: 10px 20px;
    }
    .left-thong-tin-thanh-toan img {
        width: 100%;
        height: 100%;
        max-height: 385px;
        margin-top: auto;
        margin-bottom: auto;
    }
    .title-thong-tin-tt {
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .text-thong-tin-tt {
        padding-bottom: 20px;
        text-align: center;
    }
    .item-thong-tin-tt {
        padding-bottom: 15px;
    }
    .item-thong-tin-tt input, .item-thong-tin-tt textarea {
        width: 100%;
        padding: 5px !important;
        border-radius: 5px;
        border: 1px solid #ccc !important;
    }
    .btn-thong-tin-tt a {
        color: #fff;
    }
    .btn-thong-tin-tt {
        padding: 5px 10px;
        text-align: center;
        background: #d89b0f;
        color: #fff;
        text-transform: uppercase;
        margin: 0px;
        border-radius: 5px;
        float: left;
        width: 100%;
    }
    .text-thong-tin-tt p{
        margin: 0px;
    }
        .lec{
        display: -webkit-box;   /* OLD - iOS 6-, Safari 3.1-6, BB7 */
        display: -ms-flexbox;  /* TWEENER - IE 10 */
        display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
        display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
    }
    .block-discount{
        background-color: #d89b0f9c;
    }
    .product-detail .number-qty .label-status{
        margin-right: 5px;
    }
    #product-detail-product-info-detail span.dtit{
        font-size: 20px;
        font-weight: bold;
        color: #20315c;
        margin: 5px;
    }
    .style-2.products-grid .col-md-6{
        width: 20%;
    }
    .lqt {
        margin: 30px 0;
        height: 200px;
        border: 1px solid #ddd;
    }
    .lqt-tit {
        background: #f5f5f5;
        width: 28%;
        height: 100%;
        position: relative;
    }
    .lqt-data {
        width: 56%;
        height: 100%;
        border-left: 1px solid #ddd;
    }
    .flexJus, .anv ul, .shock-p, .pw {
        display: flex;
        justify-content: space-between;
        align-items: center;
        float: left;
    }
    .lqt-total {
        width: 16%;
        height: 100%;
    }
    .flexCen, .pn, .pn2, .pi, .ser, .dv li, .camket li, .follow, .psnext, .psback, .op, .op0, .search {
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;

    }
    .lqt-tit p b {
        display: block;
        color:#d89b0f;
        font-size: 20px;
        margin-bottom: 4px;
    }
    .lqt-tit p {
        width: calc(100% - 160px);
        float: left;
    }
    .lqt-tit span {
        display: block;
        width: 80px;
        height: 80px;
        font: bold 15px/80px arial;
        text-align: center;
        color: #fff;
        background: #ed1b24;
        border-radius: 50%;
        margin-left: 30px;
        float: left;
    }
    .lqt-data a {
        width: 350px;
        height: 100%;
        border-right: 1px solid #ddd;
        text-align: center;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lqt-data a h5 {
        font-size: 15px;
        color: #333;
        height: 30px;
        margin: 0px;
        line-height: 1.4;
    }
    .lqt-data a p {
        font-size: 12px;
        color: #555;
        display: block;
    }
    .lqt-data a img {
        height: 100px;
        margin-top: 10px;
        width: 100px;
        object-fit: cover;
        border-radius: 100%;
    }
    .lqt-total p {
        text-align: center;
    }
    .lqt-total p:before {
        content: "\f06b";
        font: 15px/26px FontAwesome;
        padding-right: 3px;
    }
    .lqt-total p b {
        color: red;
        font-size: 25px;
        display: block;
    }
    .lqt-data a p span {
        color: red;
        font-size: 15px ;
    }
    .view-mores a.learn-more .circle {

        background: #d89b0f;
    }
    .view-mores a.learn-more .button-text {

        color: #d89b0f;

    }
    .catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column .add-customer-review #review-form .add-review .review-input,.catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column .add-customer-review #review-form .add-review textarea{
        color: #d89b0f;

        border: 1px solid #d89b0f;
    }
    .catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column .add-customer-review #review-form .add-review .review-form-actions{
        background-color: #d89b0f;
        border: #d89b0f;
    }
    .detail_bep .rating{
        height: 20px;
        line-height: 20px;
        color: #fac917;
        font-family: FontAwesome;
        font-size: 20px;
        letter-spacing: 5px;
    }
    .detail_bep .rating-5:before {
        content: "\F005" "\F005" "\F005" "\F005" "\F005";

    } .detail_bep .rating-4:before {
        content: "\F005" "\F005" "\F005" "\F005";

    } .detail_bep .rating-3:before {
        content: "\F005" "\F005" "\F005";

    } .detail_bep .rating-2:before {
        content: "\F005" "\F005";

    } .detail_bep .rating-1:before {
        content: "\F005";

    } .detail_bep .rating-0:before {
        content: '';

    }
    .alert {
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>