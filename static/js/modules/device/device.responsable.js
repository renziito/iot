(function ($) {
  'use strict';

  var DeviceResponsable = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbDeviceResponsables");
    this.tableResponsable = false;
    this.$btnAddUser = $("#btnAddUser");
    this.$modalAddUser = $("#md-add-user");
    this.url = {
      list: this.config.url.controllerFullUrl + '/list/id/' + Request._GET.id,
      listResponsables: this.config.url.controllerFullUrl + '/listResponsables/id/' + Request._GET.id,
      create: this.config.url.controllerFullUrl + '/create/',
      delete: this.config.url.controllerFullUrl + '/delete/',
    }
  };

  DeviceResponsable.prototype._openModal = function () {
    this.$modalAddUser.modal("show");
  };

  DeviceResponsable.prototype._closeModal = function () {
    this.$modalAddUser.modal("hide");
  };
  
  DeviceResponsable.prototype._addUser = function (responsable_id) {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.post(_class.url.create, {
        adduser: {
          device_id: Request._GET.id,
          responsable_id: responsable_id
        }
      }, function (response) {
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

  DeviceResponsable.prototype._delete = function (id) {
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

  DeviceResponsable.prototype._initModalAddUser = function () {
    var _class = this;

    this.$btnAddUser.on('click', function (e) {
      _class._openModal(_class.$modalAddUser);
    });

    this.$modalAddUser.on("show.bs.modal", function () {
      _class._initTableResponsables();
    });

    this.$modalAddUser.on("hidden.bs.modal", function () {
      _class.tableResponsable.destroy();
      _class.tableResponsable = false;
    });

  };

  DeviceResponsable.prototype._initTableResponsables = function () {
    var _class = this;

    this.tableResponsable = new TablePlugin("table#tbListResponsable");
    this.tableResponsable.setOptions({
      url: this.url.listResponsables
    });
    this.tableResponsable.columns([
      {field: "rid", title: "ID"},
      {field: "rname", title: "Nombres"},
      {field: "rphone", title: "Teléfono/Celular"},
      {field: "rposition", title: "Cargo"},
      {
        label: 'action',
        title: '...',
        formatter: function (value, row, index, field) {
          var view = [
            '<button class="btn btn-success btn-sm add-user">',
            '<i class="fa fa-plus"></i>',
            '</button>'
          ];

          return view.join("");
        },
        events: {
          'click .add-user': function (e, value, row, index) {
            _class._addUser(row.rid)
              .then(function (data) {
                _class.table.refresh();
                _class.tableResponsable.refresh();
              })
              .catch(function (error) {

              });
          }
        }
      }
    ]);
    this.tableResponsable.init();
  };

  DeviceResponsable.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list
    });

    this.table.columns([
      {field: "drid", title: "ID"},
      {field: "rname", title: "Nombres"},
      {field: "rphone", title: "Teléfono/Celular"},
      {field: "rposition", title: "Cargo"},
      {
        label: "action",
        formatter: function (value, row, index) {
          var html = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
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

  DeviceResponsable.prototype.init = function () {
    this._initTable();
    this._initModalAddUser();
  };

  (new DeviceResponsable()).init();

})(window.jQuery);