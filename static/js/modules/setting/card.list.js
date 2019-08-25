(function ($) {
  'use strict';

  var SettingCardList = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("#tbCards");
  };

  SettingCardList.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      onPostBody: function (data) {
        
        $(".card-delete").on("click", function (e) {
          e.preventDefault();

          var href = this.href;
          _class.alert.confirm({
            type: "warning",
            title: "Adevertencia!",
            text: "¿Está seguro que desea eliminar el contenido?"
          }, function () {
            window.location.href = href;
          });
        });
      }
    });
    this.table.init();
  };
  SettingCardList.prototype.init = function () {

    this._initTable();

  };

  (new SettingCardList()).init();

})(window.jQuery);