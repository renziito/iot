
<div class="row">
  <div class="col-12">
    <div class="card mb-0">
      <div class="tab-primary pt-1">
        <ul class="nav nav-tabs" role="tablist">
          <?php foreach (ListsQuery::getAll() as $row => $list): ?>
            <?php $active = ($row == 0) ? "active" : "active" ?>
            <li class="nav-item">
              <a href="#" class="nav-link <?= $active ?>"><?= $list["name"] ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="card">
      <div class="card-block p-0">
        <img class="img-fluid border-bottom" src="<?= Utils::host(Yii::app()->params["app-img"] . "/default/maps.png", true) ?>">
        <div class="p-5">
          <div class="table-responsive">
            <table id="tbVariables" class="table table-hover">
              <thead>
                <tr>
                  <th>Variable</th>
                  <th>Valor</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Temperatura Min.</td>
                  <td>10°</td>
                </tr>
                <tr>
                  <td>Temperatura Media.</td>
                  <td>13.5°</td>
                </tr>
                <tr>
                  <td>Temperatura Max.</td>
                  <td>17°</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>