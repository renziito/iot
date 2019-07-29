<section class="modal" id="md-delete-role" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Estás seguro que deseas eliminar el Rol?</h5>
      </div>
      <div class="modal-body">
        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id'          => 'form-delete-role',
            'htmlOptions' => [
                'role' => 'form',
            ]
        ]);
        ?>
        <div class="row m-t-15 m-b-15">
          <div class="col-12">
            <?= CHtml::hiddenField('Role[id]', '', ["id" => "txtidrole"]); ?>
            <div class="form-group">
              <label for="txtname">ID del Rol</label>
              <h5 id="lblidrole" class="no-margin"></h5>
            </div>
            <div class="form-group">
              <label for="txtname">Nombre del Rol</label>
              <h5 id="lblrole" class="no-margin"></h5>
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