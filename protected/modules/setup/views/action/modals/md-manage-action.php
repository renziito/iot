<section class="modal" id="md-manage-action" data-backdrop="static" tabindex="-1" action="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" action="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title-action">Actualizar Acción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-manage-action',
            'htmlOptions' => [
                'action' => 'form',
            ]
        ]);
        ?>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Grupo de Acciones</label>
              <?= CHtml::dropDownList("Action[groupaction_id]", "", CHtml::listData(GroupActionsModel::model()->findAll(), "groupaction_id", "groupaction_name"), ["class" =>"form-control"]) ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Nombre de la Acción</label>
              <?= Chtml::hiddenField('Action[id]', '', ["id" => "txtidaction"]); ?>
              <?=
              CHtml::textField('Action[action_name]', '', [
                  "id"    => "txtaction",
                  "class" => "form-control",
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Key de la Acción</label>
              <?=
              CHtml::textField('Action[action_key]', '', [
                  "id"    => "txtactionkey",
                  "class" => "form-control",
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="txtname">Descripción de la Acción</label>
              <?=
              CHtml::textArea('Action[action_description]', '', [
                  "id"    => "txtactiondescription",
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