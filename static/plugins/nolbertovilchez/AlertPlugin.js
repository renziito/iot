
'use strict';

var AlertPlugin = function () {
  this.$options = {};
};

AlertPlugin.prototype._getOptions = function () {
  return this.$options;
};

AlertPlugin.prototype._setOptions = function (params) {
  this.$options = $.extend(true, this.$options, params);
};

AlertPlugin.prototype.loading = function () {
  var defaultOptions = {
    title: '¡Procesando!',
    html: '',
    type: 'info',
    text: 'Por favor, espere...',
    showCancelButton: false,
    showConfirmButton: false,
    allowOutsideClick: false,
    onOpen: function () {
      swal.showLoading();
    }
  };

  swal(defaultOptions);
}

AlertPlugin.prototype.confirm = function (params, cbSuccess, cbCancel) {
  var params = params || {};
  var cbSuccess = cbSuccess || function () {};
  var cbCancel = cbCancel || function () {};

  var defaultOptions = {
    title: params.title || '¡Advertencia!',
    html: params.text || '',
    type: params.type || 'question',
    showCancelButton: true,
    cancelButtonText: params.cancelButtonText || 'Cancelar',
    confirmButtonText: params.confirmButtonText || 'Confirmar'
  };

  this._setOptions(defaultOptions);

  swal(this._getOptions())
          .then(function (result) {
            if (result.value) {
              cbSuccess(result);
            } else if (result.dismiss === 'cancel') {
              cbCancel(result);
            }
          });
}

AlertPlugin.prototype.show = function (params, cbSuccess, cbCancel) {
  var params = params || {};
  var cbSuccess = cbSuccess || function () {};
  var cbCancel = cbCancel || function () {};

  let defaultOptions = {
    title: params.title || '¡Conforme!',
    html: params.text || '',
    type: params.type || 'success',
    confirmButtonText: params.confirmButtonText || 'Aceptar',
    width: "22rem"
  };

  swal(defaultOptions)
          .then(function (result) {
            if (result.value) {
              cbSuccess(result);
            }
          });

};

AlertPlugin.prototype.close = function () {
  swal.close();
};
