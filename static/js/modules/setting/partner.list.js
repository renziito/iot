(function ($) {
  'use strict';

  var SettingPartnerList = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbPartners");
    this.url = {
      list: this.config.url.controllerFullUrl + '/list',
      update: this.config.url.controllerFullUrl + '/update',
      delete: this.config.url.controllerFullUrl + '/delete',
    };
  };

  SettingPartnerList.prototype._delete = function (id) {
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

  SettingPartnerList.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list
    });

    this.table.columns([
      {field: "pid", title: "ID"},
      {
        field: "iid",
        title: "Imagen",
        formatter: function (value, row, index) {
          return '<img class="img-thumbnail" src="' + row.iurl + '" width="100">';
        }
      },
      {field: "pname", title: "Nombre"},
      {
        field: "purl",
        title: "URL",
        formatter: function (value, row, index) {
          return '<a target="_blank" href="' + value + '">' + value + '</a>';
        }
      },
      {field: "pdescription", title: "Descripción"},
      {
        label: "action",
        formatter: function (value, row, index) {
          var html = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
            '<a href="' + _class.url.update + '/id/' + row.pid + '" class="edit btn btn-outline-info" data-action="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>',
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
              _class._delete(row.pid)
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

  SettingPartnerList.prototype.init = function () {
    this._initTable();
  };

  (new SettingPartnerList()).init();

})(window.jQuery);