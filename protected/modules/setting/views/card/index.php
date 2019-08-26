<?php
$this->breadcrumbs = [
    "Configuración del Sitio" => Yii::app()->createUrl("setting"),
    "Contenido"
];
?>

<div class="row">
  <div class="col-12">
    <div class="text-right">
      <a href="<?= Yii::app()->createUrl("setting/card/create") ?>" class="btn btn-success">
        <i class="fa fa-plus"></i>
        Nuevo Contenido
      </a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table id="tbCards" data-toggle="bootstrap-table" class="table table-hover">
            <thead>
              <tr>
                <th class="text-center" width="5%">ID</th>
                <th width="25%">Título</th>
                <th>Descripción</th>
                <th class="text-center" width="10%">...</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cards as $card): ?>
                <tr>
                  <td class="text-center">
                    <?= $card["cid"] ?>
                  </td>
                  <td>
                    <?= $card["ctitle"] ?>
                  </td>
                  <td>
                    <?= $card["cdescription"] ?>
                  </td>
                  <td>
                    <div class="wrapper text-center" action="toolbar">
                      <div class="btn-group btn-group-sm" action="group">
                        <a href="<?= Yii::app()->createUrl("setting/card/update/id/{$card["cid"]}") ?>" class="card-edit btn btn-outline-info" data-action="edit">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <a href="<?= Yii::app()->createUrl("setting/card/delete/id/{$card["cid"]}") ?>" class="card-delete btn btn-outline-danger" data-action="delete">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>