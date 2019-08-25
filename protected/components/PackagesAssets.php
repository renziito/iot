<?php

class PackagesAssets {

  public static $packages = [
      'moment'            => [
          'baseUrl' => 'static/third_party/moment/min',
          'js'      => ['moment-with-locales.min.js'],
          'depends' => [],
      ],
      'jquery'            => [
          'baseUrl' => 'static/third_party/jquery/dist',
          'js'      => ['jquery.min.js'],
          'depends' => ['moment'],
      ],
      'jquery-ui'         => [
          'baseUrl' => 'static/third_party/jquery-ui',
          'js'      => ['jquery-ui.min.js'],
          'css'     => ['themes/flick/jquery-ui.min.css', "themes/flick/theme.css"],
          'depends' => ['jquery'],
      ],
      'popper'            => [
          'baseUrl' => 'static/third_party/popper.js/dist',
          'js'      => [
              'umd/popper.min.js'
          ],
          'depends' => ["jquery"]
      ],
      'bootstrap'         => [
          'baseUrl' => 'static/third_party/bootstrap/dist',
          'js'      => ['js/bootstrap.min.js'],
          'css'     => ['css/bootstrap.min.css'],
          'depends' => ["jquery-ui", "popper"],
      ],
      'animate-css'       => [
          'baseUrl' => 'static/third_party/animate-css',
          'js'      => [],
          'css'     => ['animate.min.css'],
          'depends' => ['jquery'],
      ],
      'pace'              => [
          'baseUrl' => 'static/third_party/pace',
          'js'      => ["pace.min.js"],
          'css'     => ['themes/blue/pace-theme-minimal.css'],
          'depends' => ['bootstrap'],
      ],
      'perfect-scrollbar' => [
          'baseUrl' => 'static/third_party/perfect-scrollbar',
          'js'      => ["js/perfect-scrollbar.jquery.min.js"],
          'css'     => ['css/perfect-scrollbar.min.css'],
          'depends' => ['bootstrap'],
//          'depends' => ['pace'],
      ],
      'sweetalert'        => [
          'baseUrl' => 'static/third_party/sweetalert2/dist',
          'js'      => ['sweetalert2.min.js'],
          'css'     => ['sweetalert2.min.css'],
          'depends' => ["jquery"],
      ],
      'bootstrap-table'   => [
          'baseUrl' => 'static/third_party/bootstrap-table/dist',
          'js'      => [
              'bootstrap-table.min.js',
              'locale/bootstrap-table-es-ES.min.js'],
          'css'     => ['bootstrap-table.min.css'],
          'depends' => ["bootstrap"],
      ],
      'noty'              => [
          'baseUrl' => 'static/third_party/noty/lib',
          'js'      => ['noty.js'],
          'css'     => ['noty.css'],
          'depends' => ["bootstrap"],
      ],
      'jquery-validation' => [
          'baseUrl' => 'static/third_party/jquery-validation/dist',
          'js'      => ['jquery.validate.min.js'],
          'depends' => ["jquery"],
      ],
      'espire'            => [
          'baseUrl' => 'static',
          'js'      => [
              'js/espire.js',
              'js/app.js'
          ],
          'css'     => [
              'css/ei-icon.min.css',
              'css/themify-icons.min.css',
              'css/font-awesome.min.css',
              'css/espire.min.css',
              'css/app.css'
          ],
          'depends' => ["perfect-scrollbar", "noty", "animate-css"],
      ],
      "tablePlugin"       => [
          'baseUrl' => 'static/plugins/nolbertovilchez',
          'js'      => ['TablePlugin.js'],
          'depends' => ["bootstrap-table"],
      ],
      "alertPlugin"       => [
          'baseUrl' => 'static/plugins/nolbertovilchez',
          'js'      => ['AlertPlugin.js'],
          'depends' => ["sweetalert"],
      ],
      'select2'           => [
          'baseUrl' => 'static/third_party/select2/dist',
          'js'      => [
              'js/select2.full.min.js',
              'js/i18n/es.js'
          ],
          'css'     => ['css/select2.min.css'],
          'depends' => ["bootstrap"],
      ],
      'datepiker'         => [
          'baseUrl' => 'static/third_party/bootstrap-datepicker/dist',
          'js'      => [
              'js/bootstrap-datepicker.min.js',
              'locales/bootstrap-datepicker.es.min.js'
          ],
          'css'     => ['css/bootstrap-datepicker3.min.css'],
          'depends' => ["bootstrap"],
      ],
      'sortable'          => [
          'baseUrl' => 'static/third_party/sortablejs',
          'js'      => [
              'Sortable.min.js'
          ],
          'css'     => [],
          'depends' => ["jquery"],
      ],
      'placeholder'          => [
          'baseUrl' => 'static/third_party/placeholder-loading/dist',
          'js'      => [],
          'css'     => ["css/placeholder-loading.min.css"],
          'depends' => ["jquery"],
      ],
      'glide'             => [
          'baseUrl' => 'static/third_party/glidejs--glide/dist',
          'js'      => [
              'glide.min.js'
          ],
          'css'     => ["css/glide.core.min.css", "css/glide.theme.min.css"],
          'depends' => ["jquery"],
      ]
  ];

  public static function registerCore() {
    foreach (self::$packages as $package => $scripts) {
      Yii::app()->clientScript->addPackage($package, $scripts);
    }

    Yii::app()->clientScript->coreScriptPosition        = CClientScript::POS_END;
    Yii::app()->clientScript->defaultScriptFilePosition = CClientScript::POS_END;
  }

}
