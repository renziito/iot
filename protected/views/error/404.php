<?php if (APP_DEBUG): ?>
  <?php Console::log($error, false, "Track del Error"); ?>
<?php else: ?>
  <div class="authentication">
    <div class="page-404 container">
      <div class="row">
        <div class="col-md-6">
          <div class="full-height">
            <div class="vertical-align full-height pdd-horizon-70">
              <div class="table-cell">
                <h1 class="text-dark font-size-80 text-light">Opps!</h1>
                <p class="lead lh-1-8">Hello there, You seem to be lost, but don't worry,<br>we'ill get you back on track...</p>
                <a href="<?=Yii::app()->createUrl("/")?>" class="btn btn-warning">Get Me Back!</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 ml-auto hidden-sm hidden-xs">
          <div class="full-height height-100">
            <div class="vertical-align full-height">
              <div class="table-cell">
                <img class="img-responsive" src="<?= Utils::host(Yii::app()->params["app-img"] . "/others/404.png", true); ?>" alt="">
              </div>
            </div>
          </div>	
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>