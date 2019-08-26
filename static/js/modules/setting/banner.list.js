(function ($) {
  'use strict';

  var SettingBannerList = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-banner");
    this.$btnDelete = $(".delete-banner");
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

  SettingBannerList.prototype._initDelete = function () {
    var _class = this;
     this.$btnDelete.on("click", function(e){
       e.preventDefault();
       var href = $(this).attr("href");
       _class.alert.confirm({
         type: "warning",
         title: "Adevertencia!",
         text: "¿Está seguro que desea eliminar el registro?"
       }, function(){
         window.location.href = href;
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
    this._initDelete();
  };

  (new SettingBannerList()).init();

})(window.jQuery);