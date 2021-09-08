<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('BACKEND_DIRECTORY', 'ovn-admin');
define('AUTH', 'SUNVBOY_');
define('AUTH_FRONTEND', 'FT_');
define('BASE_URL', 'http://api-ci.local/api/');
define('FC_ENCRYPTION', '_'.sprintf("%u", crc32(BASE_URL)));
define('SUNSUFFIX', '.html');
define('DEBUG', 0);
define('COMPRESS', 0);
define('FC_UPLOAD', '/upload/images/');
define('CODE', 'SUNCODE');
define('CODE_PRODUCT', 'SP');
define('CODE_IMPORT', 'IM');
define('CODE_EXPORT', 'EX');
define('CODE_SUPPLIER', 'NCC');
define('CODE_ORDER', 'ORD');
define('SUNDBHOST', 'localhost');
define('SUNDBUSER', 'root');
define('SUNDBPASS', '');
define('SUNDBNAME', 'api_codeigniter');
//giaohangtietkiem
define('URL_GHTK', 'https://services.ghtklab.com');
define('TOKEN_GHTK', '2BEbAc88EFB9A9cAB21779D293E11c13D7E3F808');
