'use strict';

var ManagerCreate = function (options) {
  this.config = $.extend(true, APP, {});
  this.options = this._setOptions(options);
  this.alert = new AlertPlugin();
  this.$btnOpen = $(this.options.btnOpen);
  this.$modal = $(this.options.modal);
  this.$form = $(this.options.form);
  this.validator = {};
  this.url = {
    create: this.config.url.moduleFullUrl + "/manage/create"
  };
};

ManagerCreate.prototype._openModal = function () {
  this.$modal.modal("show");
};

ManagerCreate.prototype._closeModal = function () {
  this.$modal.modal("hide");
};

ManagerCreate.prototype._clearForm = function () {
  this.$form.trigger("reset");
  this.validator.resetForm();
  this.$form
    .find(".form-control")
    .removeClass("error")
    .removeClass("valid");
};

ManagerCreate.prototype._submit = function (form) {
  var _class = this;

  return new Promise(function (resolve, reject) {
    $.post(_class.url.create, form, function (response) {
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

ManagerCreate.prototype._initForm = function () {
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

ManagerCreate.prototype._initModal = function () {
  var _class = this;

  this.$btnOpen.on("click", function () {
    _class._openModal();
  });

  this.$modal.on("show.bs.modal", function () {

  });

  this.$modal.on("hidden.bs.modal", function () {
    _class._clearForm();
  });
};

ManagerCreate.prototype._setOptions = function (options) {
  var defaultOptions = {
    btnOpen: "#btnManagerCreate",
    modal: "#md-create",
    form: "#form-create",
    onSubmit: function (data) {

    },
    onError: function (error) {

    },
  };

  return $.extend(true, defaultOptions, options);
};

ManagerCreate.prototype.init = function () {
  this._initForm();
  this._initModal();
};