<div class="header navbar">
  <div class="header-container">
    <ul class="nav-left">
      <li>
        <a class="side-nav-toggle" href="javascript:void(0);">
          <i class="ti-view-grid"></i>
        </a>
      </li>
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
            <a href="<?= Yii::app()->createUrl("user/profile") ?>">
              <i class="ti-user pdd-right-10"></i>
              <span>Mi cuenta</span>
            </a>
          </li>
          <li role="separator" class="divider"></li>
          <li>
            <a href="<?= Yii::app()->createUrl("/logout") ?>">
              <i class="ti-power-off pdd-right-10"></i>
              <span>Salir</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>