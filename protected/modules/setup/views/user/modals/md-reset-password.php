<section class="modal" id="md-reset-password" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reestablecer Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-reset-password',
            'htmlOptions' => [
                'role' => 'form',
            ]
        ]);
        ?>
        <div class="row mrg-top-15 mrg-btm-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Nueva Contraseña</label>
              <?=
              CHtml::hiddenField("UserUpdate[id]", $model->user_id, [
                  "id"       => "txtid",
                  "class"    => "form-control",
                  "readonly" => "readonly",
                  "disabled" => "disabled"
              ]);
              ?>
              <?=
              CHtml::textField("UserUpdate[new_password]", '', [
                  "id"       => "txtnewpassword",
                  "class"    => "form-control",
                  "readonly" => "readonly"
              ]);
              ?>
              <div class="alert alert-info">
                <div class="checkbox ">
                  <?= CHtml::checkBox("UserUpdate[save_password]", false, []) ?>
                  <label for="UserUpdate_save_password"> He copiado esta contraseña en un lugar seguro.</label>
                </div>
                <span class="text-danger" id="UserUpdate_save_password_error"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="txtname">El usuario deberá cambiar la contraseña</label>
              <div>
                <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                  <?= CHtml::checkBox("UserUpdate[must_change_password]", false, []) ?>
                  <label for="UserUpdate_must_change_password"></label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="txtname">El usuario recibirá un correo con los datos de su cuenta</label>
              <div>
                <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                  <?= CHtml::checkBox("UserUpdate[send_mail]", false, []) ?>
                  <label for="UserUpdate_send_mail"></label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="button" id="btn-reset" class="btn btn-dark">Reestablecer</button>
            <button type="clear" id="btn-close" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</section>