(function ($) {
  'use strict';

  var LandingBanner = function () {
    this.config = $.extend(true, APP, {});
    this.$banner = $("#banner");
  }

  LandingBanner.prototype._templateHTMLItem = function (item) {
    var html = [
      '<li class="glide__slide m-0">',
      '<div style="background-image:url(' + item.iurl + ');background-position: center center;background-repeat: no-repeat;background-size: cover;width: 100%; min-height: 500px; max-height: 500px;">',
      '</div>',
      '</li>'
    ];

    return html.join("")
  };
  LandingBanner.prototype._templateHTML = function (items) {
    var html = [
      '<div class="glide">',
//      '<div data-glide-el="controls">',
//      '<button data-glide-dir="<<">start</button>',
//      '<button data-glide-dir=">>">end</button>',
//      '</div>',
      '<div class="glide__track" data-glide-el="track">',
      '<ul class="glide__slides">'
    ];

    for (var item in items) {
      html.push(this._templateHTMLItem(items[item]));
    }

    html.push('</ul>', '</div>', '</div>');

    return html.join("");
  };

  LandingBanner.prototype._loadData = function () {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.get(_class.config.url.baseFullUrl + "/api/page/banners", function (response) {
        resolve(response.data);
      });
    });
  };

  LandingBanner.prototype._buildHTML = function () {
    var _class = this;

    this._loadData()
      .then(function (data) {
        _class.$banner.html(_class._templateHTML(data));
        _class._initCarousel();
      });
  };

  LandingBanner.prototype._initCarousel = function () {
    new Glide('.glide', {
      type: 'slider',
      startAt: 0,
      perView: 1,
      gap: 0,
      autoplay: 3000,
      rewind: true,
      rewindDuration: 0
//      animationDuration:6000,
    }).mount();
  };


  LandingBanner.prototype.init = function () {
    this._buildHTML();
  };

  (new LandingBanner()).init();


})(window.jQuery);