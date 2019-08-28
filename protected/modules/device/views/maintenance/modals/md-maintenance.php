<section class="modal" id="md-maintenance" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title-role">Agregar Mantenimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-maintenance',
            'htmlOptions' => [
                'action' => 'form',
            ]
        ]);

        $model->device_id = $device->device_id;
        ?>
        
        <?=$form->hiddenField($model, 'device_id', []);?>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="DeviceMaintenancesModel_responsable_id">Responsable</label>
              <?=
              $form->dropDownList($model, 'responsable_id',DeviceUtil::listResponsables(), [
                  "class" => "form-control",
                  "empty" => "Seleecionar Responsable",
                  "style" => "width:100%"
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="DeviceMaintenancesModel_devicemaintenance_date">Fecha</label>
              <?=
              $form->textField($model, 'devicemaintenance_date', [
                  "class" => "form-control",
                  "readonly" => true
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row mt-3">
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