(function ($) {
  'use strict';

  var DeviceList = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbDevices");
    this.url = {
      list: this.config.url.controllerFullUrl + '/list',
      update: this.config.url.moduleFullUrl + '/manage/update',
      delete: this.config.url.moduleFullUrl + '/manage/delete',
    };
  };

  DeviceList.prototype._delete = function (id) {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.post(_class.url.delete, {id: id}, function (response) {
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

  DeviceList.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list
    });

    this.table.columns([
      {field: "did", title: "ID"},
      {field: "dtypename", title: "Tipo"},
      {field: "dcode", title: "Código"},
      {field: "dserie", title: "Serie"},
      {field: "dlatitude", title: "latitud"},
      {field: "dlongitude", title: "Longitud"},
      {
        field: "dtypmodem",
        title: "¿Modem?",
        formatter: function (value, row, index) {
          var status = (value == 1) ? "SI" : "NO";
          return '<strong>' + status + '</strong>';
        }
      },
      {field: "dmodemnumber", title: "# Modem"},
      {field: "dmodemprovider", title: "Proveedor Modem"},
      {
        label: "action",
        formatter: function (value, row, index) {
          var html = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
            '<a href="' + _class.url.update + '/id/' + row.did + '" class="edit btn btn-outline-info" data-action="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>',
            '<button type="button" class="delete btn btn-outline-danger" data-action="delete"><i class="fa fa-trash" aria-hidden="true"></i></button>',
            '</div>',
            '</div>'
          ];

          return html.join("");
        },
        events: {
          "click .delete": function (e, value, row, index) {
            _class.alert.confirm({
              type: "warning",
              title: "Advertencia!",
              text: "¿Está seguro que desea eliminar el registro?"
            }, function (result) {
              _class._delete(row.vid)
                .then(function (data) {
                  _class.table.refresh();
                });
            });

          }
        }
      }
    ]);

    this.table.init();
  };

  DeviceList.prototype.init = function () {
    this._initTable();
  };

  (new DeviceList()).init();

})(window.jQuery);