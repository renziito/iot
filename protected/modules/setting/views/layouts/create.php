<?php
$tabs = [
    [
        "name"   => "Datos Generales",
        "url"    => "#",
        "disabled" => false,
        "active" => true
    ],
    [
        "name"     => "Variables",
        "url"      => "#",
        "disabled" => true,
        "active"   => false
    ]
];
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row justify-content-center">
  <div class="col-12">
    <div class="card mb-0">
      <div class="tab-primary pt-1">
        <ul class="nav nav-tabs" role="tablist">
          <?php foreach ($tabs as $tab): ?>
            <li class="nav-item">
              <a href="<?= $tab["url"] ?>" class="nav-link <?= ($tab["active"]) ? "active " : "" ?><?= ($tab["disabled"]) ? "disabled" : "" ?>"><?= $tab["name"] ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?= $content ?>
<?php $this->endContent(); ?>