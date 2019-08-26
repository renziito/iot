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
        "TypeDevicesModel[typedevice_maintenance_frequency]": {
          required: true,
          number: true,
          min: 0.1
        },
      },
      messages: {
        "TypeDevicesModel[typedevice_denomination]": "Debes ingresar la denominación del tipo de dispositivo",
        "TypeDevicesModel[typedevice_origin]": "Debes ingresar el origen del tipo de dispositivo",
        "TypeDevicesModel[typedevice_maintenance_frequency]": {
          required: "Debes ingresar la frecuencia del mantenimiento.",
          number: "La frecuencia de mantenimiento debe ser expresa en números.",
          min: "No puede declarar la frecuencia de mantenimiento como cero."
        }
      }
    });
  };

  SettingDeviceCreate.prototype.init = function () {
    this._initForm();
  };

  (new SettingDeviceCreate()).init();

})(window.jQuery);


