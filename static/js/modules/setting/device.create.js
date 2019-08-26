(function ($) {
  'use strict';

  var SettingDeviceCreate = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-device");
  };

  SettingDeviceCreate.prototype._initForm = function () {
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
        "TypeDevicesModel[typedevice_denomination]": {
          required: true
        },
        "TypeDevicesModel[typedevice_origin]": {
          required: true
        },
      },
      messages: {
        "TypeDevicesModel[typedevice_denomination]": "Debes ingresar la denominación del tipo de dispositivo",
        "TypeDevicesModel[typedevice_origin]": "Debes ingresar el origen del tipo de dispositivo"
      }
    });
  };

  SettingDeviceCreate.prototype.init = function () {
    this._initForm();
  };

  (new SettingDeviceCreate()).init();

})(window.jQuery);


