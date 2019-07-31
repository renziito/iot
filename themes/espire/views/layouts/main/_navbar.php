<div class="header navbar">
  <div class="header-container">
    <ul class="nav-left">
      <li>
        <a class="side-nav-toggle" href="javascript:void(0);">
          <i class="ti-view-grid"></i>
        </a>
      </li>
      <?php if ($this->id != "error" && !Yii::app()->user->change_password): ?>
        <li class="dropdown">
          <?php
          $active_favorite = NavigationQuery::validateFavorite(Yii::app()->user->id, Yii::app()->request->url);
          ?>
          <a href="#" id="navigation-favorite" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="<?= (!$active_favorite) ? "fa fa-star-o" : "fa fa-star text-warning" ?>"></i>
          </a>
          <ul class="dropdown-menu" id="navigation-favorite-content">
            <?php foreach (NavigationQuery::getFavoritesByUserID(Yii::app()->user->id) as $row => $favorite): ?>
              <li>
                <a class="dropdown-item <?= ($active_favorite == $favorite["navigationfavorite_id"]) ? " active " : "" ?>" href="<?= $favorite["navigationfavorite_url"] ?>">
                  <i class="ti-link"></i>&nbsp;
                  <?= $favorite["navigationfavorite_name"] ?>
                </a>
              </li>
            <?php endforeach; ?>
            <li role="separator" class="divider"></li>
            <?php if ($this->link_favorites && !$active_favorite): ?>
              <li class="navigation-favorite">
                <a id="navigation-add-favorite" data-url="<?= Yii::app()->request->url ?>" class="dropdown-item" href="#">
                  <i class="ti-plus"></i>&nbsp;
                  añadir esta página
                </a>
              </li>
            <?php endif; ?>
            <li>
              <a class="dropdown-item" href="#">
                <strong>
                  <i class="ti-settings"></i>&nbsp;
                  Administrar favoritos
                </strong>
              </a>
            </li>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
    <ul class="nav-right">
      <li class="user-profile dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
          <img class="profile-img" height="38" width="38" src="<?= Utils::host(User::imagenProfile("XS"), true); ?>" alt="">
          <div class="user-info">
            <span class="name pdd-right-5">
              <?= Yii::app()->user->firstname ?>&nbsp;<?= Yii::app()->user->lastname ?>
            </span>
            <i class="ti-angle-down font-size-10"></i>
          </div>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="">
              <i class="ti-settings pdd-right-10"></i>
              <span>Setting</span>
            </a>
          </li>
          <li>
            <a href="<?= Yii::app()->createUrl("user/profile") ?>">
              <i class="ti-user pdd-right-10"></i>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="ti-email pdd-right-10"></i>
              <span>Inbox</span>
            </a>
          </li>
          <li role="separator" class="divider"></li>
          <li>
            <a href="<?= Yii::app()->createUrl("/logout") ?>">
              <i class="ti-power-off pdd-right-10"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>