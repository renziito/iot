<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 m-b-15">
      <h2 class="text-left">
        <strong>Cambia la contraseña</strong>
      </h2>
      <p>Elige una contraseña segura y no la utilices en otras cuentas</p>
      <p>Si cambias la contraseña, cerrarás sesión en todos los dispositivos donde hayas iniciado sesión anteriormente, y deberás introducir la nueva en todos ellos.</p>
    </div>
    <div class="col-12 col-sm-8">
      <div class="card">
        <div class="card-block">
          <?php
          $errors = Yii::app()->user->getFlash("errorChangePassword");
          $errors = ($errors) ? json_decode($errors, true) : [];

          $form = $this->beginWidget('CActiveForm', [
              'action'      => Yii::app()->createUrl("user/password/update"),
              'id'          => 'form-changePassword',
              'htmlOptions' => [
                  'role' => 'form',
              ]
          ]);
          ?>
          <?php if ($errors): ?>
            <div class="alert alert-danger" role="alert">
              <button class="close" data-dismiss="alert"></button>
              <strong>Error: </strong
              <ul>
                <?php foreach ($errors as $error): ?>
                  <?php foreach ($error as $message): ?>
                    <li><?= $message ?></li>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          <div class="form-group">
            <label class="no-margin">Contraseña actual</label>
            <?=
            $form->passwordField($model, 'password', [
                "id"           => "txtpaswoord",
                "class"        => "form-control input-lg",
                "autocomplete" => "off"
            ]);
            ?>
          </div>
          <div class="form-group">
            <label class="no-margin">Contraseña nueva</label>
            <div class="m-b-5">
              <small class="">Usa al menos 6 caracteres. No uses una contraseña de otro sitio ni algo demasiado obvio, como el nombre de tu mascota</small>
            </div>
            <?=
            $form->passwordField($model, 'new_password', [
                "id"           => "txtnewpaswoord",
                "class"        => "form-control input-lg",
                "autocomplete" => "off"
            ]);
            ?>
          </div>
          <div class="form-group">
            <label>Confirmar contraseña nueva</label>
            <?=
            $form->passwordField($model, 'confirm_new_password', [
                "id"           => "txtconfirmnewpaswoord",
                "class"        => "form-control input-lg",
                "autocomplete" => "off"
            ]);
            ?>
          </div>
          <div class="text-right m-t-20">
            <button class="btn btn-success">
              Guardar&nbsp;
              <i class="fa fa-save"></i>
            </button>
            <?php if (!Yii::app()->user->change_password): ?>
              <a href="<?= Yii::app()->createUrl("user/profile") ?>" class="btn btn-danger text-white">
                Cancelar&nbsp;
                <i class="fa fa-times"></i>
              </a>
            <?php endif; ?>
          </div>
          <?php $this->endWidget(); ?>
        </div>
      </div>
    </div>
  </div>
</div>