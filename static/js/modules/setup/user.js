/* ============================================================
 * User Form Validate
 * ============================================================ */

var UserFormValidate = function (form) {
  this.config = $.extend(true, APP, {});
  this.alert = new AlertPlugin();
  this.rules = {};
  this.messages = {};
  this.$form = form;

  this.init();
};

UserFormValidate.prototype._submitHandlerDefault = function (form) {
  var _class = this;
  this.alert.confirm({
    title: "Advertencia!",
    type: "warning",
    text: "¿Los datos ingresados son los correctos?",
    cancelButtonText: "No, cancelar",
    confirmButtonText: "Si, continuar"
  }, function () {
    form.submit();
    _class.alert.loading();
  });
};

UserFormValidate.prototype.getRules = function () {
  return this.rules;
};

UserFormValidate.prototype.setRules = function (rules = {}){
  this.rules = rules;
};

UserFormValidate.prototype.getMessages = function () {
  return this.messages;
};

UserFormValidate.prototype.setMessages = function (messages = {}){
  this.messages = messages;
};

UserFormValidate.prototype._rulesDefault = function () {
  this.rules = {
    "UsersModel[user_firstname]": {
      required: true
    },
    "UsersModel[user_lastname]": {
      required: true
    },
    "UsersModel[user_email]": {
      required: true,
      email: true
    },
    "UsersModel[user_username]": {
      required: true
    },
    "UsersModel[user_password]": {
      required: true
    }
  };
};

UserFormValidate.prototype._messagesDefault = function () {
  this.messages = {
    "UsersModel[user_firstname]": "Debes ingresar los nombres del usuario",
    "UsersModel[user_lastname]": "Debes ingresar los aapellidos del usuario",
    "UsersModel[user_email]": {
      required: "Debes ingresar el email del usuario",
      email: "Debes ingresar un correo electrónico válido"
    },
    "UsersModel[user_username]": "Debes ingresar el nombre de usuario",
    "UsersModel[user_password]": "Debes ingresar la contraseña del usuario"
  };
};

UserFormValidate.prototype.validate = function (submitHandler = false) {
  var _class = this;

  this.$form.validate({
    submitHandler: function (form) {
      if (submitHandler) {
        submitHandler(form);
      } else {
        _class._submitHandlerDefault(form);
      }
    },
    rules: this.getRules(),
    messages: this.getMessages()
  });
};

UserFormValidate.prototype.init = function () {
  this._rulesDefault();
  this._messagesDefault();
  this.$form.find("#UsersModel_user_birthdate").datepicker({
    format: "yyyy-mm-dd",
    language: "es",
    startView: 2,
    autoclose: true
  });
};

/* ============================================================
 * User Events
 * ============================================================ */

var UserEvents = function () {
  this.config = $.extend(true, APP, {});
  this.alert = new AlertPlugin();
  this.url = {
    changeStatus: this.config.url.controllerFullUrl + '/changeStatus',
    delete: this.config.url.controllerFullUrl + '/delete',
    password: this.config.url.controllerFullUrl + '/resetPassword'
  }
};

UserEvents.prototype.update = function (id, data, url, callbackSuccess, callbackError, nameDefault) {
  var callbackSuccess = callbackSuccess || false;
  var callbackError = callbackError || false;
  var nameDefault = nameDefault || true;

  $.post(this.url[url] + '/id/' + id, data, (response) => {
    if (!response.error) {
      Notify("success", response.message);
      if (callbackSuccess)
        callbackSuccess(response);
    }
  }).fail(function (error) {
    Notify("error", error.responseJSON.message);
    if (callbackError)
      callbackError(error);
  });
};

UserEvents.prototype.changeStatus = function (elm, id, status, callbackSuccess) {
  var _class = this;
  var callbackSuccess = callbackSuccess || false;

  var action = "activar";
  var value = 1;
  var checked = false;

  if (status == 1) {
    action = "desactivar";
    checked = true;
    value = 0
  }

  this.alert.confirm({
    title: "Advertencia!",
    type: "warning",
    text: '¿Está seguro que desea ' + action + ' al usuario (<strong>ID: ' + id + '</strong>)?',
    cancelButtonText: "No, cancelar",
    confirmButtonText: "Si, estoy seguro"
  }, function () {
    _class.update(id, {status: value}, 'changeStatus', callbackSuccess, function () {
      elm.prop("checked", checked);
    });
  }, function () {
    elm.prop("checked", checked);
  });
};

UserEvents.prototype.delete = function (id, callbackSuccess) {
  var _class = this;
  var callbackSuccess = callbackSuccess || false;

  this.alert.confirm({
    title: "Advertencia!",
    type: "warning",
    text: '¿Está seguro que desea <span class="text-danger">eliminar</span> al usuario (<strong>ID: ' + id + '</strong>)?',
    cancelButtonText: "No, cancelar",
    confirmButtonText: "Si, estoy seguro"
  }, function () {
    _class.update(id, {}, 'delete', callbackSuccess);
  });
};

UserEvents.prototype.resetPassword = function (id, data, callbackSuccess = false, callbackError = false) {
  var _class = this;
  var callbackSuccess = callbackSuccess || false;
  var callbackError = callbackError || false;

  this.alert.confirm({
    title: "Advertencia!",
    type: "warning",
    text: `¿Está seguro que desea reestableser la contraseña?`,
    cancelButtonText: "No, cancelar",
    confirmButtonText: "Si, estoy seguro"
  }, function () {
    _class.update(id, data, 'password', callbackSuccess, callbackError, false);
  });
};