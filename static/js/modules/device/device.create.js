(function ($) {
  'use strict';

  var DeviceCreate = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-device");
    this.modem = false
  };

  DeviceCreate.prototype._initModemFields = function () {
    if (this.modem) {
      $(".modem-required").removeClass("d-none");
      $(".modem").prop("disabled", false);
      $("#DevicesModel_device_number_modem").rules("add", {
        required: true,
        messages: {
          required: "Debes ingresar el número del Modem"
        }
      });
      $("#DevicesModel_device_provider_modem").rules("add", {
        required: true,
        messages: {
          required: "Debes ingresar el proveedor del Modem"
        }
      });
    } else {
      $(".modem-required").addClass("d-none");
      $(".modem").prop("disabled", true);
      $("#DevicesModel_device_number_modem").rules("remove");
      $("#DevicesModel_device_provider_modem").rules("remove");
    }
  };

  DeviceCreate.prototype._getTypeDevice = function (typedevice_id) {
    var _class = this;
    return new Promise(function (resolve, reject) {
      $.post(_class.config.url.controllerFullUrl + "/typeDevice", {id: typedevice_id}, function (response) {
        if (!response.error) {
          resolve(response.data);
        }
      });
    });
  };

  DeviceCreate.prototype._initTypeDevice = function () {
    var _class = this;
    $("#DevicesModel_typedevice_id").on("change", function () {
      if (this.value != "") {
        _class._getTypeDevice(this.value)
          .then(function (data) {
            _class.modem = (data.dmodem == 1) ? true : false;
            _class._initModemFields();
          });
      } else {
        _class.modem = false;
        _class._initModemFields();
      }
    });
  };

  DeviceCreate.prototype._initForm = function () {
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
        "DevicesModel[typedevice_id]": {
          required: true
        },
        "DevicesModel[device_code]": {
          required: true
        },
        "DevicesModel[device_latitude]": {
          required: true
        },
        "DevicesModel[device_longitude]": {
          required: true
        }
      },
      messages: {
        "DevicesModel[typedevice_id]": "Debes seleccionar el tipo de dispositivo",
        "DevicesModel[device_code]": "Debes ingresar el código",
        "DevicesModel[device_latitude]": "Debes ingresar la latitud del dispositivo",
        "DevicesModel[device_longitude]": "Debes ingresar la longitud del dispositivo"
      }
    });
  };

  DeviceCreate.prototype.init = function () {
    this._initForm();
    this._initTypeDevice();
  };

  (new DeviceCreate()).init();

})(window.jQuery);


