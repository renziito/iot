(function ($) {
  'use strict';

  var SettingVariableCreate = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-variable");
  };

  SettingVariableCreate.prototype._initForm = function () {
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
        "TypeVariablesModel[typevariable_denomination]": {
          required: true
        },
        "TypeVariablesModel[typevariable_key]": {
          required: true
        },
      },
      messages: {
        "TypeVariablesModel[typevariable_denomination]": "Debes ingresar la denominación de la variable",
        "TypeVariablesModel[typevariable_key]": "Debes ingresar el key de la variable"
      }
    });
  };

  SettingVariableCreate.prototype.init = function () {
    this._initForm();
  };

  (new SettingVariableCreate()).init();

})(window.jQuery);


