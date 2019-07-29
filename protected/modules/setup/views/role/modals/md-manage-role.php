<section class="modal" id="md-manage-role" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title-role">Actualizar Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-manage-role',
            'htmlOptions' => [
                'role' => 'form',
            ]
        ]);
        ?>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Nombre del Rol</label>
              <?= Chtml::hiddenField('Role[id]', '', ["id" => "txtidrole"]); ?>
              <?=
              CHtml::textField('Role[role_name]', '', [
                  "id"    => "txtrole",
                  "class" => "form-control",
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Key del Rol</label>
              <?=
              CHtml::textField('Role[role_key]', '', [
                  "id"    => "txtrolekey",
                  "class" => "form-control",
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Descripción del Rol</label>
              <?=
              CHtml::textArea('Role[role_description]', '', [
                  "id"    => "txtroledescription",
                  "class" => "form-control",
                  "style" => "height:50px",
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" id="btn-save" class="btn btn-success">Guardar</button>
            <button type="clear" id="btn-close" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</section>