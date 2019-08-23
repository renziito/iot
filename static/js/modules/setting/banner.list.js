(function ($) {
  'use strict';

  var SettingBannerList = function () {
    this.config = $.extend(true, APP, {});
    this.$form = $("#form-banner");
    this.list = document.getElementById('bannerList');
  };

  SettingBannerList.prototype._submit = function () {
    var _class = this;
    var form = $(this.$form).serialize();
    return new Promise(function (resolve, reject) {
      $.post(_class.config.url.controllerFullUrl + "/sort", form, function (response) {
        
      });
    });
  };

  SettingBannerList.prototype._initSortable = function () {
    var _class = this;

    new Sortable(this.list, {
      animation: 150,
      ghostClass: "bg-gray", // Class name for the drop placeholder
      draggable: ".banner-item",
      onEnd: function (e) {
        _class._submit();
      }
    });
  };

  SettingBannerList.prototype.init = function () {
    this._initSortable();
  };

  (new SettingBannerList()).init();

})(window.jQuery);