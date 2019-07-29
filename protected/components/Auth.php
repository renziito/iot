<?php

/**
 * Auth es la clase creada para controlar los accesos al sistema
 * 
 * Está clase filtra el acceso mediante permisos o roles especificos
 * configurados de manera general y obteniendo los permisos únicos de
 * un módulo en especifico.
 *
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class Auth extends Builder {

  public function filters() {
    return array('accessControl');
  }

  public function accessRules() {
    return $this->accesosModulo();
  }

  public function accesosModulo() {
    if (isset($this->module)) {
      $urlConfigModule  = "application.modules.{$this->module->id}.config";
      $pathConfigModule = Yii::getPathOfAlias($urlConfigModule);
      $RolesModule      = [];
      if (is_dir($pathConfigModule)) {
        $fileRoles = $pathConfigModule . DIRECTORY_SEPARATOR . 'AuthRoles.php';

        if (is_file($fileRoles)) {
          Yii::import($urlConfigModule . ".AuthRoles");
          foreach (AuthRoles::$Auth as $role) {
            $RolesModule[] = $role;
          }
          foreach ($this->accesoSistema() as $roleSistema) {
            $RolesModule[] = $roleSistema;
          }
          return $RolesModule;
        }
      }
    }
    return $this->accesoSistema();
  }

  public function accesoSistema() {
    return [
        ['allow',
            'users' => ['@'],
        ],
        ['allow',
            'controllers' => ['home'],
            'users'       => ['*'],
        ],
        ['allow',
            'controllers' => ['error', 'login'],
            'users'       => ['*'],
        ],
        ['deny',
            'users' => ['*'],
        ]
    ];
  }

}
