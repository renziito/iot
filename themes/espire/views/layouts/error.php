<?php
PackagesAssets::registerCore();
AppAssets::registerScript();
Yii::app()->clientScript->registerModuleScript("app");
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
    <link rel="shortcut icon" href="<?= Utils::host(Yii::app()->params["app-img-favicon"], true) ?>"/>
    <link rel="icon" type="image/x-icon" href="<?= Utils::host('favicon.ico', true) ?>" />

    <script type="text/javascript">
      var Request = {
        Host: '<?= Yii::app()->request->hostInfo ?>',
        BaseUrl: '<?= Yii::app()->baseUrl ?>',
        themeUrl: '<?= Yii::app()->theme->baseUrl ?>',
        _GET: <?= json_encode($_GET) ?>,
        UrlHash: {
          m: '<?= (!isset($this->module->id)) ? null : $this->module->id ?>',
          c: '<?= ($this->id) ?>',
          a: '<?= ($this->action->id) ?>'
        }
      };
    </script>
  </head>
  <body class="">
    <div class="app">
        <?= $content ?>
    </div>
  </body>
</html>
