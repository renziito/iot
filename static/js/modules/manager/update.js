'use strict';

var ManagerUpdate = function (options) {
  this.config = $.extend(true, APP, {});
  this.alert = new AlertPlugin();
  this.options = this._setOptions(options);
  this.$modal = $(this.options.modal);
  this.$form = $(this.options.form);
  this.validator = {};
  this.url = {
    update: this.config.url.baseFullUrl + "/manager/manage/update"
  };

  this._init();
};


ManagerUpdate.prototype._closeModal = function () {
  this.$modal.modal("hide");
};

ManagerUpdate.prototype._clearForm = function () {
  this.$form.trigger("reset");
  this.validator.resetForm();
  this.$form
    .find(".form-control")
    .removeClass("error")
    .removeClass("valid");
};

ManagerUpdate.prototype._submit = function (form) {
  var _class = this;

  return new Promise(function (resolve, reject) {
    $.post(_class.url.update, form, function (response) {
      if (!response.error) {
        Notify("success", response.message);
        resolve(response.data);
      }
    }).fail(function (error) {
      Notify("error", "La operación no pudo completarse correctamente");
      reject(error);
    });
  });
};

ManagerUpdate.prototype._initForm = function () {
  var _class = this;

  this.validator = this.$form.validate({
    submitHandler: function (form) {
      var serialize = $(form).serialize();
      _class.alert.confirm({
        type: "warning",
        title: "Advertencia!",
        text: "¿Confirma que los datos ingresados son correctos?"
      }, function (result) {
        _class._submit(serialize)
          .then(function (data) {
            _class._closeModal();
            _class.options.onSubmit(data);
          })
          .catch(function (error) {
            _class.options.onError(error);
          });
      });
    },
    rules: {
      "ResponsablesModel[responsable_name]": {
        required: true
      }
    },
    messages: {
      "ResponsablesModel[responsable_name]": "Debes ingresar el nombre del responsable"
    }
  });
};

ManagerUpdate.prototype._initModal = function () {
  var _class = this;

  this._openModal();

  this.$modal.on("show.bs.modal", function () {

  });

  this.$modal.on("hidden.bs.modal", function () {
    _class._clearForm();
  });
};

ManagerUpdate.prototype._setOptions = function (options) {
  var defaultOptions = {
    modal: "#md-update",
    form: "#form-update",
    data: {},
    onSubmit: function (data) {

    },
    onError: function (error) {

    },
  };

  return $.extend(true, defaultOptions, options);
};

ManagerUpdate.prototype._openModal = function () {
  this.$modal.modal("show");
};

ManagerUpdate.prototype._setData = function () {
  for (var field in this.options.data) {
    this.$form.find("#"+field).val(this.options.data[field]);
  }
};

ManagerUpdate.prototype._init = function () {
  this._setData();
  this._initForm();
  this._initModal();
};