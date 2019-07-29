
<?php
$form = $this->beginWidget('CActiveForm', [
    'id'          => 'form-setting-user',
    'htmlOptions' => [
        'role'  => 'form',
        'class' => 'form-horizontal'
    ]
  ]);
?>
<div class="row">
  <div class="col-12 col-lg-7">
    <div class="card">
      <div class="card-heading border bottom">
        <div class="card-title">Datos Generales</div>
      </div>
      <div class="card-block mrg-top-10 pdd-right-30">
        <div class="form-group row">
          <label for="UsersModel_user_firstname" class="col-md-2 control-label">Nombres</label>
          <div class="col-md-10">
            <?=
            $form->textField($model, 'user_firstname', [
                "class" => "form-control"
            ]);
            ?>
          </div>
        </div>
        <div class="form-group row">
          <label for="UsersModel_user_lastname" class="col-md-2 control-label">Apellidos</label>
          <div class="col-md-10">
            <?=
            $form->textField($model, 'user_lastname', [
                "class" => "form-control"
            ]);
            ?>
          </div>
        </div>
        <div class="form-group row">
          <label for="UsersModel_user_email" class="col-md-2 control-label">Email</label>
          <div class="col-md-10">
            <?=
            $form->textField($model, 'user_email', [
                "class" => "form-control"
            ]);
            ?>
          </div>
        </div>
        <div class="form-group row">
          <label for="UsersModel_typeuser_id" class="col-md-2 control-label">Rol</label>
          <div class="col-md-10">
            <?php 
            $role = '';
            if (isset($model->user_id)){
              $dataRole = UserQuery::getRole($model->user_id);
              $role = $dataRole["role_id"];
            }
            ?>
            <?=
            CHtml::dropDownList('UsersModel[role_id]', '',CHtml::listData(RolesQuery::getAll(), "role_id", "role_name"), [
                "class" => "form-control",
            ]);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-5">
    <div class="card">
      <div class="card-heading border bottom">
        <div class="card-title">Datos de la Cuenta</div>
      </div>
      <div class="card-block mrg-top-10 pdd-right-30">
        <div class="form-group row">
          <label for="UsersModel_user_username" class="col-md-3 col-lg-5 col-xl-4 control-label">Usuario</label>
          <div class="col-md-9 col-lg-7 col-xl-8">
            <?=
            $form->textField($model, 'user_username', [
                "class" => "form-control"
            ]);
            ?>
          </div>
        </div>
        <div class="form-group row">
          <label for="UsersModel_user_password" class="col-md-3 col-lg-5 col-xl-4 control-label">Contraseña</label>
          <div class="col-md-9 col-lg-7 col-xl-8">
            <?php if (!isset($model->user_id)): ?>
              <?=
              $form->textField($model, 'user_password', [
                  "class"    => "form-control",
                  "readonly" => true,
                  "value"    => Utils::token("sha1", uniqid(), 8)
              ]);
              ?>
            <?php else: ?>
              <?=
              $form->passwordField($model, 'user_password', [
                  "class"    => "form-control",
                  "readonly" => true,
                  "value"    => "..........."
              ]);
              ?>
              <button type="button" id="btn-user-resetpassword" class="btn btn-sm btn-dark mrg-top-15">
                <i class="fa fa-key"></i>&nbsp;
                Resetear Contraseña
              </button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-heading border bottom">
        <div class="card-title">Configuración de la Cuenta</div>
      </div>
      <div class="card-block mrg-top-10 pdd-right-30">
        <div class="form-group row">
          <label for="UsersModel_user_firstname" class="col-9 col-md-7 col-lg-10 col-xl-9 control-label">La cuenta está activa</label>
          <div class="col-3 col-md-5 col-lg-2 col-xl-3">
            <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
              <?=
              $form->checkBox($model, 'user_status', []);
              ?>
              <label for="UsersModel_user_status"></label>
            </div>
          </div>
        </div>
        <?php if (!isset($model->user_id)): ?>
          <div class="form-group row">
            <label for="UsersModel_user_lastname" class="col-9 col-md-7 col-lg-10 col-xl-9 control-label">El usuario deberá cambiar la contraseña</label>
            <div class="col-3 col-md-5 col-lg-2 col-xl-3">
              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                <?=
                $form->checkBox($model, 'user_must_change_password', []);
                ?>
                <label for="UsersModel_user_must_change_password"></label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="UsersModel_user_lastname" class="col-9 col-md-7 col-lg-10 col-xl-9 control-label">El usuario recibirá un correo con los datos de su cuenta</label>
            <div class="col-3 col-md-5 col-lg-2 col-xl-3">
              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                <?= CHtml::checkBox("UsersModel[send_mail]", false, []) ?>
                <label for="UsersModel_send_mail"></label>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="text-center mrg-top-20">
      <a href="<?= Yii::app()->createUrl("setup/user") ?>" class="btn btn-sm btn-danger text-white">
        <i class="fa fa-times"></i>&nbsp;
        Cancelar
      </a>
      <button class="btn btn-sm btn-success">
        <i class="fa fa-save"></i>&nbsp;
        Guardar
      </button>
    </div>
  </div>
</div>

<?php $this->endWidget(); ?>