<?php
$this->breadcrumbs = [
    "Configuración del Sitio"=> Yii::app()->createUrl("setting"),
    "Banners"
];
?>
<?php
$form              = $this->beginWidget('CActiveForm', [
    'id'          => 'form-banner',
    'htmlOptions' => [
        'role'    => 'form',
        'enctype' => 'multipart/form-data',
        'class'   => 'form-horizontal form-product'
    ]
  ]);
?>
<div class="row">
  <div class="col-12">
    <div class="text-right mb-2">
      <a href="<?=Yii::app()->createUrl("setting/banner/create")?>" class="btn btn-success">
        <i class="fa fa-plus"></i>
        Nuevo Banner
      </a>
    </div>
  </div>
</div>
<div class="alert alert-info mb-1">
  Para modifcar el orden de las imágenes debes arrastrar a la posición que deseas
</div>
<div id="bannerList" class="row">
  <?php foreach (BannersQuery::getAll() as $banner): ?>
    <div class="banner-item px-0 col-12 col-md-4">
      <?= CHtml::hiddenField("BannersModel[order][]", $banner["bid"]) ?>
      <div class=" p-3">
        <div class="card m-0">
          <div class="card-media">
            <?php
            //https://via.placeholder.com/800x300
            $path = "storage/images";
            $src  = Utils::buildUrlThumbnail($path, $banner["iname"], "XS");
            ?>
            <div class="" style="background-position: center center;background-repeat: no-repeat;background-size: cover;background-image: url('<?= $src ?>');width: 100%; min-height: 180px; max-height: 180px;"></div>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-default no-mrg-btm btn-sm">
              <i class="fa fa-pencil"></i>
            </button>
            <button type="button" class="btn btn-danger no-mrg-btm btn-sm">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php $this->endWidget(); ?>
