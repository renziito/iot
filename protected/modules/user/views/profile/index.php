<?php 
$this->breadcrumbs = [
    "Usuario" => "#",
    "Perfil"
];
?>
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-4">
        <div class="widget-profile-1 card">
          <div class="profile border bottom">
            <img class="mrg-top-30 rounded-circle" height="128" width="128" src="<?= Utils::host(User::imagenProfile("SM"), true); ?>" alt="">
            <h4 class="mrg-top-20 no-mrg-btm text-semibold">
              <?= Yii::app()->user->firstname ?>&nbsp;<?= Yii::app()->user->lastname ?>
            </h4>
            <p><?=Yii::app()->user->role()->role_name?></p>
            <div>
              <a href="<?= Yii::app()->createUrl("changePassword") ?>" class="btn btn-dark text-white">
                <i class="fa fa-key"></i>&nbsp;
                Cambiar Contraseña
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'action'      => $this->createUrl("update"),
            'id'          => 'form-user-profile',
            'htmlOptions' => array(
                'role'    => 'form',
                'class'   => 'form-horizontal',
                'enctype' => "multipart/form-data"
            )
        ));
        ?>
        <div class="card">
          <div class="card-heading border bottom">
            <h4 class="card-title">Información General</h4>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-md-3">
                <p class="mrg-top-10 text-dark"> <b>Nombre de Usuario</b></p>
              </div>
              <div class="col-md-6">
                <?= $form->textField($model, 'user_username', ["class" => "form-control", "disabled" => true]); ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <p class="mrg-top-10 text-dark"> <b>Nombres</b></p>
              </div>
              <div class="col-md-6">
                <?= $form->textField($model, 'user_firstname', ["class" => "form-control"]); ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <p class="mrg-top-10 text-dark"> <b>Apellidos</b></p>
              </div>
              <div class="col-md-6">
                <?= $form->textField($model, 'user_lastname', ["class" => "form-control"]); ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <p class="mrg-top-10 text-dark"> <b>Email</b></p>
              </div>
              <div class="col-md-6">
                <?= $form->textField($model, 'user_email', ["class" => "form-control"]); ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <p class="mrg-top-10 text-dark"> <b>Avatar</b></p>
              </div>
              <div class="col-md-6">
                <div>
                  <label for="img-upload" class="pointer">
                    <img src="<?= Utils::host(User::imagenProfile("SM"), true); ?>" width="117" alt="">
                    <button type="button" id="btn-change-avatar" class="btn btn-default display-block no-mrg-btm mrg-top-10">Cambiar Avatar</button>
                    <?= $form->fileField($model, 'user_img_profile', ["class" => "d-none"]); ?>
                  </label>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">

              </div>
              <div class="col-md-6">
                <div class="mrg-top-10">
                  <button class="btn btn-lg btn-success btn-submit">
                    <i class="ti-save"></i>&nbsp;
                    <span>Guardar</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</div>