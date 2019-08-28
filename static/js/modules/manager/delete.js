'use strict';

var ManagerDelete = function (options) {
  this.config = $.extend(true, APP, {});
  this.alert = new AlertPlugin();
  this.options = this._setOptions(options);
  this.url = {
    delete: this.config.url.baseFullUrl + "/manager/manage/delete"
  };

  this._init();
};

ManagerDelete.prototype._submit = function (id) {
  var _class = this;

  return new Promise(function (resolve, reject) {
    $.post(_class.url.delete, {id: _class.options.id}, function (response) {
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

ManagerDelete.prototype._setOptions = function (options) {
  var defaultOptions = {
    id: 0,
    onSubmit: function (data) {

    },
    onError: function (error) {

    },
  };

  return $.extend(true, defaultOptions, options);
};

ManagerDelete.prototype._init = function () {
  var _class = this;

  this.alert.confirm({
    type: "warning",
    title: "Advertencia!",
    text: "¿Está seguro que desea eliminar el registro?"
  }, function (result) {
    _class._submit()
      .then(function (data) {
        _class.options.onSubmit(data);
      })
      .catch(function (error) {
        _class.options.onError(error);
      });
  });
};