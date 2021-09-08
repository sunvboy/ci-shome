<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route[BACKEND_DIRECTORY] = 'user/backend/auth/login';
$route['default_controller'] = 'homepage/home/index';
$route['404_override'] = 'homepage/api/error404';
$route['translate_uri_dashes'] = FALSE;
//API
$route['login'] = 'user/api/user/login';
$route['register'] = 'user/api/user/register';
$route['detailUser'] = 'user/api/user/detailUser';
$route['changPassword'] = 'user/api/user/changPassword';
$route['editProfile'] = 'user/api/user/editProfile';
$route['uploadAvatar'] = 'user/api/user/uploadAvatar';

$route['wishlist/view'] = 'user/api/wishlist/view';
$route['wishlist/create'] = 'user/api/wishlist/create';
$route['wishlist/(:num)/delete']["DELETE"] = 'user/api/wishlist/delete/$1';

$route['orders/view'] = 'user/api/order/view';
$route['orders/detail'] = 'user/api/order/detail';

$route['address/detail'] = 'user/api/address/detail';
$route['address/all'] = 'user/api/address/all';
$route['address/view'] = 'user/api/address/view';
$route['address/create'] = 'user/api/address/create';
$route['address/update']["put"] = 'user/api/address/update';
$route['address/(:num)/delete']["DELETE"] = 'user/api/address/remove/$1';
//API Menu
$route['fcSystem'] = 'homepage/api/fcSystem';
$route['actCheckSlug'] = 'homepage/api/actCheckSlug';
$route['listMenu'] = 'homepage/api/menu';
$route['sitemap'] = 'homepage/api/sitemap';

//API article catalogues
$route['listArticleCatalogue'] = 'article/api/catalogue/listArticleCatalogue';
$route['listArticleCatalogueRow'] = 'article/api/catalogue/listArticleCatalogueRow';
//API article
$route['listArticle'] = 'article/api/article/listArticle';
$route['detailArticle'] = 'article/api/article/detailArticle';
$route['listArticleAuth'] = 'article/api/article/listArticleAuth';
$route['listArticleByCatalogue'] = 'article/api/catalogue/listArticleByCatalogue';
//API comment
$route['listComment'] = 'comment/api/comment/listComment';
$route['createComment'] = 'comment/api/comment/createComment';
//API product
$route['listProductByCatalogue'] = 'product/api/catalogue/view';
$route['detailProduct'] = 'product/api/product/view';
//API giaohangtietkiem
$route['shipment'] = 'homepage/apiGHTK/shipment';
$route['address'] = 'homepage/apiaddress/address';
$route['payment'] = 'cart/api/cart/payment';
$route['detailPayment'] = 'cart/api/cart/detailPayment';


//END API



//user_frotnend
//$route['login-google'] = 'user/ajax/user/Login_google';
//$route['login-fbcallback'] = 'user/ajax/user/fbcallback';
//$route['register'] = 'user/frontend/user/register';
//$route['register-modal'] = 'user/frontend/user/registerajax';
//$route['login'] = 'user/frontend/user/login';
//$route['login-modal'] = 'user/frontend/user/loginajax';
//$route['logout'] = 'user/frontend/user/logout';
//$route['forgot-password'] = 'user/frontend/user/forgotpassword';
//$route['forgot-modal'] = 'user/frontend/user/forgotpasswordajax';
//$route['xac-minh'] = 'user/frontend/user/verify';
//
//$route['information'] = 'user/frontend/manage/information';
//$route['information-shop'] = 'user/frontend/manage/information_shop';
//$route['upload'] = 'user/frontend/manage/upload';
//$route['uploadQr'] = 'user/frontend/manage/uploadQr';
//$route['uploadVideo'] = 'user/frontend/manage/uploadVideo';
//$route['change-pass'] = 'user/frontend/manage/change_pass';
//$route['history/([0-9]+)'] = 'user/frontend/manage/history/$1';
//$route['history'] = 'user/frontend/manage/history';
//
//$route['order-history/([0-9]+)'] = 'user/frontend/manage/order_history/$1';
//$route['order-history'] = 'user/frontend/manage/order_history';
//$route['order-information'] = 'user/frontend/manage/order_information';
//$route['list-product/([0-9]+)'] = 'user/frontend/product/view/$1';
//$route['list-product'] = 'user/frontend/product/view';
//$route['create-product'] = 'user/frontend/product/create';
//$route['update-product'] = 'user/frontend/product/update';
//$route['uploaddropzone'] = 'user/frontend/product/uploaddropzone';
//
//
//
//$route['wish-list/([0-9]+)'] = 'user/frontend/manage/wishlist/$1';
//$route['wish-list'] = 'user/frontend/manage/wishlist';
//$route['quickview'] = 'product/ajax/frontend/quickview';
//
//
//$route['chinh-sach-ban-hang'] = 'homepage/policy/index';
//$route['video'] = 'homepage/video/index';
//$route['mat-bang'] = 'homepage/matbang/index';
//
//
//$route['gio-hang'] = 'cart/frontend/cart/cart';
//$route['thanh-toan'] = 'cart/frontend/cart/payment';
//$route['dat-mua-thanh-cong'] = 'cart/frontend/cart/success';
//$route['html-quantity'] = 'cart/frontend/cart/quantity';
//
//$route['listComment'] = 'comment/frontend/comment/listComment';
//$route['sentcomment'] = 'comment/frontend/comment/sent_comment';
//$route['lien-he'] = 'contact/frontend/contact/view';
//$route['mailsubricre'] = 'contact/frontend/contact/create';
//$route['product-contact'] = 'contact/frontend/contact/createProduct';
//$route['phone-contact'] = 'contact/frontend/contact/phone_contact';
//$route['tim-kiem/trang-([0-9]+)'] = 'search/frontend/search/view/$1';
//$route['tim-kiem'] = 'search/frontend/search/view';
//$route['tim-kiem-nang-cao/trang-([0-9]+)'] = 'search/frontend/search/viewNangCao/$1';
//$route['tim-kiem-nang-cao'] = 'search/frontend/search/viewNangCao';
//$route['search-filter/trang-([0-9]+)'] = 'search/frontend/search/searchFilter/$1';
//$route['search-filter'] = 'search/frontend/search/searchFilter';
//$route['filter'] = 'product/ajax/frontend/filter';
//$route['([a-zA-Z0-9-]+)/trang-([0-9]+)'] = 'homepage/router/index/$1/$2';
//$route['([a-zA-Z0-9-]+)'] = 'homepage/router/index/$1';
//$route['filenotfound'] = 'homepage/filenotfound/index';


