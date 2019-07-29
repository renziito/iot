<section class="modal" id="md-delete-action" tabindex="-1" data-backdrop="static" action="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" action="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Estás seguro que deseas eliminar la Acción?</h5>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-delete-action',
            'htmlOptions' => [
                'action' => 'form',
            ]
        ]);
        ?>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <?= CHtml::hiddenField('Action[id]', '', ["id" => "txtidaction"]); ?>
            <div class="form-group">
              <label for="txtname">ID de la Acción</label>
              <h5 id="lblidaction" class="no-margin"></h5>
            </div>
            <div class="form-group">
              <label for="txtname">Nombre de la Acción</label>
              <h5 id="lblaction" class="no-margin"></h5>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12 text-center">
            <button type="submit" id="btn-save" class="btn btn-danger">Si, Eliminar</button>
            <button type="clear" id="btn-close" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</section>