<section class="modal" id="md-create" data-backdrop="static" tabindex="-1" action="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" action="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title-action">Nuevo Responsable</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-create',
            'htmlOptions' => [
                'action' => 'form',
            ]
        ]);
        ?>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="rname">Nombre del Responsable</label>
              <?=
              $form->textField($model, 'responsable_name', [
                  "class" => "form-control",
                  "id"    => "rname"
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="rposition">Cargo</label>
              <?=
              $form->textField($model, 'responsable_position', [
                  "class" => "form-control",
                  "id"    => "rposition"
              ]);
              ?>
            </div>
          </div>
        </div>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <div class="form-group">
              <label for="rphone">Teléfono/Celular</label>
              <?=
              $form->textField($model, 'responsable_phone', [
                  "class" => "form-control",
                  "id" => "rphone"
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