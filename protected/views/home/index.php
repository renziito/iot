<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Navbar</a>
    <div class="navbar-collapse collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= Yii::app()->createUrl("dashboard/overview") ?>">Ingresar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<section id="banner">
  <div class="ph-item p-0 border-0">
    <div class="ph-col-12 p-0">
      <div class="ph-picture" style="min-height: 500px; max-height: 500px;"></div>
    </div>
  </div>
</section>
<section id="about" class="py-5">
  <div class="container">
    <div class="row" id="content">
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="col-12 col-md-4">
          <div class="ph-item border-0 p-0">
            <div class="ph-col-12">
              <div class="ph-row">
                <div class="ph-col-10 big"></div>
                <div class="ph-col-2 empty big"></div>
                <div class="ph-col-6"></div>
                <div class="ph-col-6 empty"></div>
                <div class="ph-col-12"></div>
                <div class="ph-col-8"></div>
                <div class="ph-col-4 empty"></div>
                <div class="ph-col-10"></div>
                <div class="ph-col-2 empty"></div>
                <div class="ph-col-6"></div>
                <div class="ph-col-6 empty"></div>
                <div class="ph-col-12"></div>
              </div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
<section class="bg-light py-5">
  <div class="container py-5">
    <div class="row">
      <div class="col-12">
        <div>
          <div class="glide partners">
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides" id="partners">
                <li class="glide__slide">
                  <div class="ph-item p-0 border-0">
                    <div class="ph-col-12 p-0">
                      <div class="ph-picture mb-0" style="min-height: 150px; max-height: 150px;"></div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="lists" class="py-5">
  <div class="container">
    <div class="row">
      <?php for ($i = 1; $i <= 3; $i++): ?>
      <div class="col-12 col-md-4">
        <div class="ph-item">
          <div class="ph-col-12">
            <div class="ph-picture"></div>
            <div class="ph-row">
              <div class="ph-col-6 big"></div>
              <div class="ph-col-4 empty big"></div>
              <div class="ph-col-2 big"></div>
              <div class="ph-col-4"></div>
              <div class="ph-col-8 empty"></div>
              <div class="ph-col-6"></div>
              <div class="ph-col-6 empty"></div>
              <div class="ph-col-12"></div>
            </div>
          </div>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
<section id="footer" class="bg-dark p-2 text-white">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
      </div>
      <div class="col-12 col-md-6 text-right">
        © IOT 2019
      </div>
    </div>
  </div>
</section>