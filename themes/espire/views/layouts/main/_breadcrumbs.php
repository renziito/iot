<div class="header-breadcrumbs <?=(!$this->current_title)?" not-title ":""?>">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <?php if ($this->breadcrumbs): ?>
          <!-- START BREADCRUMB -->
          <?php
          $this->widget('zii.widgets.CBreadcrumbs', array(
              'links'                => $this->breadcrumbs,
              'homeLink'             => '<li class="breadcrumb-item"><a href="' . Yii::app()->baseUrl . '">Inicio</a></li>', // home link template
              'htmlOptions'          => array('class' => 'breadcrumb'),
              'tagName'              => 'ol',
              'separator'            => '',
              'activeLinkTemplate'   => '<li class="breadcrumb-item"><a href="{url}">{label}</a></li>',
              'inactiveLinkTemplate' => '<li class="breadcrumb-item active">{label}</li>',
          ));
          ?>
          <!-- END BREADCRUMB -->
        <?php endif; ?>
        <!--        <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>-->
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-md-12">
      <?php if ($this->current_title): ?>
        <div class="page-title">
          <h2 class="no-mrg">
            <?= $this->current_title ?>
          </h2>
        </div>
      <?php endif; ?>
    </div>
<!--        <div class="col-12 col-md-6">
          <div class="text-right text-left-sm mt-3 mt-md-0">
            <button class="btn btn-default btn-inverse btn-sm no-mrg">
              <i class="fa fa-star"></i>
            </button>
          </div>
        </div>-->
  </div>
</div>