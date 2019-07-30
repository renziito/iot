<?php
$errors = yii::app()->user->getFlash("errorLogin");
?>
<div class="authentication">
  <div class="sign-in-2">
    <!--<div class="container-fluid no-pdd-horizon bg" style="background-image: url('<?= Utils::host(Yii::app()->params["app-img"] . "/others/img-30.jpg", true); ?>')">-->
    <div class="container-fluid no-pdd-horizon bg">
      <div class="row">
        <div class="col-md-10 mr-auto ml-auto">
          <div class="row">
            <div class="mr-auto ml-auto full-height height-100">
              <div class="vertical-align full-height">
                <div class="table-cell">
                  <div class="card" style="padding: 48px 40px 48px; border-radius: 8px">
                    <div class="card-body">
                      <div class="">
                        <div class="mrg-btm-10 text-center">
                          <img class="img-responsive inline-block mt-3" src="<?= Utils::host(Yii::app()->params["app-img-logo"], true); ?>" width="200" alt="">
                        </div>
                        <h1 class="text-center mb-0">Iniciar Sesión</h1>
                        <h4 class="text-center mrg-btm-15">Acceder a ioT</h4>
                        <p class="mrg-btm-15 font-size-14">Por favor ingrese sus credenciales de acceso.</p>
                        <?php
                        $form   = $this->beginWidget('CActiveForm', [
                            'action'      => (!$continue) ? Yii::app()->createUrl("signin") : Yii::app()->createUrl("signin", ["continue" => $continue]),
                            'id'          => 'form-login',
                            'htmlOptions' => [
                                'role' => 'form'
                            ]
                        ]);
                        ?>
                        <?php if (!empty($errors)) : ?>
                          <div class="alert alert-danger alert-white-alt rounded">
                            <i class="fa fa-times-circle"></i>&nbsp;
                            <strong>Algo pasó!</strong> <br>
                            <?= $errors["password"][0] ?>
                          </div>
                        <?php endif; ?>
                        <div class="form-group">
                          <?=
                          $form->textField($model, 'username', [
                              "id"          => "txtusername",
                              "class"       => "form-control",
                              "placeholder" => "Ingresa tu nombre de usuario",
                              "autofocus"   => true
                          ]);
                          ?>
                        </div>
                        <div class="form-group">
                          <?=
                          $form->passwordField($model, 'password', [
                              "id"          => "txtpaswoord",
                              "class"       => "form-control",
                              "placeholder" => "Ingresa tu contraseña"
                          ]);
                          ?>
                        </div>
                        <div class="mrg-top-20 text-right">
                          <button class="btn btn-primary">Continuar</button>
                        </div>
                        <?php $this->endWidget(); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>