<div class="side-nav">
  <div class="side-nav-inner">
    <div class="side-nav-logo">
      <a href="#">
        <div class="logo logo-dark" style="background-image: url('<?= Utils::host(Yii::app()->params["app-img-logo"], true); ?>')"></div>
        <div class="logo logo-white" style="background-image: url('<?= Utils::host(Yii::app()->params["app-img-logo-white"], true); ?>')"></div>
      </a>
      <div class="mobile-toggle side-nav-toggle">
        <a href="">
          <i class="ti-arrow-circle-left"></i>
        </a>
      </div>
    </div>
    <ul class="side-nav-menu scrollable">
      <li class="nav-item dropdown <?=(isset($this->module) && $this->module->id == "dashboard") ? "open" : ""?>">
        <a class="mrg-top-30" href="<?= Yii::app()->createUrl("dashboard") ?>">
          <span class="icon-holder">
            <i class="ti-home"></i>
          </span>
          <span class="title">Inicio</span>
        </a>
      </li>
      <?php
      $navigation = User::navigation($this);
      if ($navigation):
        foreach ($navigation as $parent_id => $parent):
          $parent_open = "";
          if ($parent["active"]) {
            $parent_open = "open";
          }
          $parent_url = (!$parent["url"]) ? "javascript:void(0);" : Yii::app()->createUrl($parent["url"]);
          ?>
          <!-- active open-->
          <li class="nav-item dropdown <?= $parent_open ?>">
            <a class="dropdown-toggle" href="<?= $parent_url ?>">
              <span class="icon-holder">
                <i class="<?= $parent["icon"] ?>"></i>
              </span>
              <span class="title"><?= $parent["name"] ?></span>
              <?php if ($parent["items"]): ?>
                <span class="arrow">
                  <i class="ti-angle-right"></i>
                </span>
              <?php endif; ?>
            </a>
            <?php if ($parent["items"]): ?>
              <ul class="dropdown-menu">
                <?php foreach ($parent["items"] as $child_id => $child): ?>
                  <?php
                  $child_open = "";
                  if ($child["items"] && $child["active"]) {
                    $child_open = "open";
                  } elseif (!$child["items"] && $child["active"]) {
                    $child_open = "active";
                  }
                  $child_url = (!$child["url"]) ? "javascript:void(0);" : Yii::app()->createUrl($child["url"]);
                  ?>
                  <li class="nav-item <?= ($child["items"]) ? " dropdown " : " " ?> <?= $child_open ?>">
                    <a href="<?= $child_url ?>">
                      <span><?= $child["name"] ?></span>
                      <?php if ($child["items"]): ?>
                        <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                      <?php endif; ?>
                    </a>
                    <?php if ($child["items"]): ?>
                      <ul class="dropdown-menu">
                        <?php foreach ($child["items"] as $item_id => $item): ?>
                          <?php
                          $item_url = (is_null($item["url"])) ? "javascript:void(0);" : Yii::app()->createUrl($item["url"]);
                          ?>
                          <li class="<?= ($item["active"]) ? " active " : "" ?>">
                            <a href="<?= $item_url ?>"><?= $item["name"] ?></a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
          <?php
        endforeach;
      endif;
      ?>
    </ul>
  </div>
</div>