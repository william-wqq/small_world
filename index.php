<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);

if($_SERVER['SERVER_NAME'] == 'small.world') {
    defined('YII_ENV') or define('YII_ENV', 'dev');
}elseif($_SERVER['SERVER_NAME'] == 'tsw.njqhm.com') {
    defined('YII_ENV') or define('YII_ENV', 'pro');
}else {
    defined('YII_ENV') or define('YII_ENV', 'pro');
}

//define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');



require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/common/function.php';

$config = require __DIR__ . '/config/web.php';

(new yii\web\Application($config))->run();
