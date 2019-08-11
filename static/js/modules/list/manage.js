(function ($) {
  'use strict';

  var ListManage = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-list");
  };

  ListManage.prototype.initForm = function () {
    var _class = this;
    this.$form.validate({
      submitHandler: function (form) {
        _class.alert.confirm({
          title: "Advertencia!",
          type: "warning",
          text: "¿Está seguro que los datos ingresados son los correctos?",
        }, function () {
          form.submit();
        });
      },
      rules: {
        "ListsModel[list_name]": {
          required: true
        },
        "ListsModel[list_code]": {
          required: true
        }
      }
    });
  };

  ListManage.prototype.init = function () {
    this.initForm();
  };

  (new ListManage()).init();

})(window.jQuery);