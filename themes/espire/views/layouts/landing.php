<?php
PackagesAssets::registerCore();
LandingAssets::registerScript();
Yii::app()->clientScript->registerModuleScript("landing");
$flashes = Yii::app()->user->getFlashes();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

    <!-- Title -->
    <title><?= CHtml::encode($this->pageTitle) ?></title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/favicon-16x16.png">
    <link rel="shortcut icon" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/favicon-16x16.png"/>
    <link rel="icon" type="image/x-icon" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>/favicon.ico" />
    
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase-database.js"></script>
    <script type="text/javascript">
      var Request = {
        Host: '<?= Yii::app()->request->hostInfo ?>',
        BaseUrl: '<?= Yii::app()->baseUrl ?>',
        themeUrl: '<?= Yii::app()->theme->baseUrl ?>',
        _GET: <?= json_encode($_GET) ?>,
        UrlHash: {
          m: '<?= (!isset($this->module->id)) ? '' : $this->module->id ?>',
          c: '<?= ($this->id) ?>',
          a: '<?= ($this->action->id) ?>'
        }
      };
    </script>
  </head>
  <body class="">
   <?= $content ?>
  </body>
</html>
