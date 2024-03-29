/* ============================================================
 * Banner
 * ============================================================ */

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
        if (data.length > 0) {
          _class.$banner.html(_class._templateHTML(data));
          _class._initCarousel();
        }
      });
  };

  LandingBanner.prototype._initCarousel = function () {
    new Glide('.glide', {
      type: 'slider',
      startAt: 0,
      perView: 1,
      gap: 0,
      autoplay: 5000,
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

/* ============================================================
 * Cards
 * ============================================================ */

(function ($) {
  'use strict';

  var LandingContent = function () {
    this.config = $.extend(true, APP, {});
    this.$content = $("#content");
  }

  LandingContent.prototype._templateHTMLItem = function (item) {
    var html = [
      '<div class="col-12 col-md-4">',
      '<h2 class="mb-3">' + item.ctitle + '</h2>',
      '<p class="mb-5">' + item.cdescription + '</p>',
      '</div>'
    ];

    return html.join("")
  };

  LandingContent.prototype._templateHTML = function (items) {
    var html = [];

    for (var item in items) {
      html.push(this._templateHTMLItem(items[item]));
    }

    return html.join("");
  };

  LandingContent.prototype._loadData = function () {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.get(_class.config.url.baseFullUrl + "/api/page/contents", function (response) {
        resolve(response.data);
      });
    });
  };

  LandingContent.prototype._buildHTML = function () {
    var _class = this;

    this._loadData()
      .then(function (data) {
        if (data.length > 0) {
          _class.$content.html(_class._templateHTML(data));
        }
      });
  };

  LandingContent.prototype.init = function () {
    this._buildHTML();
  };

  (new LandingContent()).init();


})(window.jQuery);

/* ============================================================
 * Pages Partners
 * ============================================================ */

(function ($) {
  'use strict';

  var LandingPartners = function () {
    this.config = $.extend(true, APP, {});
    this.$partner = $("#partners");
  }

  LandingPartners.prototype._templateHTMLItem = function (item) {
    var html = [
      '<li class="glide__slide text-center">',
      '<a target="_blank" href="' + item.purl + '">',
      '<img class="img-thumbnail" alt="' + item.pname + '" src="' + item.iurl + '" style="min-height: 150px; max-height: 150px;">',
      '</a>',
      '</li>'
    ];

    return html.join("")
  };

  LandingPartners.prototype._templateHTML = function (items) {
    var html = [];

    for (var item in items) {
      html.push(this._templateHTMLItem(items[item]));
    }

    return html.join("");
  };

  LandingPartners.prototype._loadData = function () {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.get(_class.config.url.baseFullUrl + "/api/page/partners", function (response) {
        resolve(response.data);
      });
    });
  };

  LandingPartners.prototype._buildHTML = function () {
    var _class = this;

    this._loadData()
      .then(function (data) {
        if (data.length > 0) {
          _class.$partner.html(_class._templateHTML(data));
          _class._initCarousel();
        }
      });

  };

  LandingPartners.prototype._initCarousel = function () {
    new Glide('.partners', {
      type: 'carousel',
      startAt: 0,
      perView: 3,
      autoplay: 3000,
      breakpoints: {
        800: {
          perView: 2
        },
        500: {
          perView: 1
        }
      }
    }).mount();
  };

  LandingPartners.prototype.init = function () {
    this._buildHTML();
  };

  (new LandingPartners()).init();


})(window.jQuery);

/* ============================================================
 * Lists
 * ============================================================ */

(function ($) {
  'use strict';

  var LandingLists = function () {
    this.config = $.extend(true, APP, {});
    this.$lists = $("#lists");
  }

  LandingLists.prototype._templateHTMLItem = function (position, item) {
    var active = (position == 0) ? "active" : "";
    var html = [
      '<a class="nav-item nav-link ' + active + '" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">',
      item.lname,
      '</a>'
    ];

    return html.join("")
  };

  LandingLists.prototype._templateHTML = function (items) {
    var html = [
      '<nav>',
      '<div class="nav nav-tabs" id="nav-tab" role="tablist">'
    ];
    var i = 0;
    for (var item in items) {
      html.push(this._templateHTMLItem(i, items[item]));
      i++;
    }

    html.push("</div>", "</nav>");
    html.push('<div class="tab-content" id="nav-tabContent">');
    html.push('<div class=" border tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">');
    html.push('<div class="row">');
    html.push('<div class="col-12 col-md-10 pr-0">');
    html.push('<img class="border-right img-fluid" src="' + this.config.url.baseFullUrl + '/static/img/default/maps.png">');
    html.push('</div>');
    html.push('<div class="col-12 col-md-2 py-2">');
    html.push('<h5 class="mb-3">Variables</h5>');
    html.push('<div class="text-muted"><strong>Temperatura Max.</strong></div>');
    html.push('<div class="mb-2">17°</div>');
    html.push('<div class="text-muted"><strong>Temperatura Med.</strong></div>');
    html.push('<div class="mb-2">13.5°</div>');
    html.push('<div class="text-muted"><strong>Temperatura Min.</strong></div>');
    html.push('<div class="mb-2">10°</div>');
    html.push('</div>');
    html.push('</div>');
    html.push('</div>');
    html.push('</div>');

    return html.join("");
  };

  LandingLists.prototype._loadData = function () {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.get(_class.config.url.baseFullUrl + "/api/page/lists", function (response) {
        resolve(response.data);
      });
    });
  };

  LandingLists.prototype._buildHTML = function () {
    var _class = this;

    this._loadData()
      .then(function (data) {
        if (data.length > 0) {
          _class.$lists.html(_class._templateHTML(data));
        }
      });

  };

  LandingLists.prototype.init = function () {
    this._buildHTML();
  };

  (new LandingLists()).init();


})(window.jQuery);