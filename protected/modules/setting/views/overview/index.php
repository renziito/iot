<?php
$this->breadcrumbs = [
    "Configuración del Sitio"
];
?>

<div class="row">
  <div class="col-12 col-md-6">
    <div class="card">
      <div class="card-block">
        <i class="fa fa-image fa-5x mb-2"></i>
        <h1 class="mb-3">Banners</h1>
        <p>Administra las imágenes que se visualizaran en la sección del banner del portal principal. </p>
        <div class="">
          <a href="<?=Yii::app()->createUrl("setting/banner")?>" class="btn text-info ml-0 pl-0">
            <strong>Administrar</strong>
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="card">
      <div class="card-block">
        <i class="fa fa-align-left fa-5x mb-2"></i>
        <h1 class="mb-3">Contenido</h1>
        <p>Administra la información relevante que se visualizará en el portal principal.</p>
        <div class="">
          <a href="<?=Yii::app()->createUrl("setting/card")?>" class="btn text-info ml-0 pl-0">
            <strong>Administrar</strong>
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="card">
      <div class="card-block">
        <i class="fa fa-briefcase fa-5x mb-2"></i>
        <h1 class="mb-3">Instituciones</h1>
        <p>Administra la datos de las Instituciones aliadas ingresando logo, Url y descripción.</p>
        <div class="">
          <a href="<?=Yii::app()->createUrl("setting/partner")?>" class="btn text-info ml-0 pl-0">
            <strong>Administrar</strong>
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>