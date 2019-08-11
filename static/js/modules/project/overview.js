(function ($) {
  'use strict';

  var ProjectList = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbProjects");
    this.url = {
      list: this.config.url.controllerFullUrl + '/list',
      delete: this.config.url.moduleFullUrl + '/manage/delete',
      update: this.config.url.moduleFullUrl + '/manage/update',
      users: this.config.url.moduleFullUrl + '/manage/users',
      devices: this.config.url.moduleFullUrl + '/manage/devices'
    };
  };

  ProjectList.prototype.delete = function (id) {
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

  ProjectList.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list,
      pageSize: 10,
      search: false,
      showHeader: false,
      onLoadSuccess: function () {
        $('[data-toggle="tooltip"]').tooltip({
          container: '.table'
        });
      }
    });

    this.table.columns([
      {
        label: 'project',
        width: "100%",
        cellStyle: function (value, row, index) {
          return {
            css: {
              padding: '0px !important',
              border: '0px solid white !important'
            }
          };
        },
        formatter: function (value, row, index) {
          var btnUpdate = '<a data-toggle="tooltip" title="Editar" href="' + _class.url.update + '/id/' + row.id + '" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>';
          var btnUsers = '<a data-toggle="tooltip" title="Usuarios" href="' + _class.url.users + '/id/' + row.id + '" class="btn btn-default btn-sm"><i class="fa fa-users"></i></a>';
          var btnDevices = '<a data-toggle="tooltip" title="Dispositivos" href="' + _class.url.devices + '/id/' + row.id + '" class="btn btn-default btn-sm"><i class="fa fa-cubes"></i></a>';
          var btnLogs = '<a data-toggle="tooltip" title="Log de actividades" href="' + _class.url.devices + '/id/' + row.id + '" class="btn btn-default btn-sm"><i class="fa fa-binoculars"></i></a>';
          var btnDelete = '<button data-toggle="tooltip" title="Eliminar" class="btn btn-danger btn-sm delete-project"><i class="fa fa-trash"></i></button>';

          var view = [
            '<div class="card mb-2">',
            '<div class="card-block">',
            '<div class="row">',
            '<div class="col-12 col-md-8">',
            '<h3 class="mb-0">' + row.name + '</h3>',
            '<h6 class="text-muted">ID: ' + row.code + '</h6>',
            '<p>' + row.description + '</9>',
            '</div>',
            '<div class="col-12 col-md-2 text-right">',
            '</div>',
            '<div class="col-12 col-md-2 text-right">'
          ];

          if (row.update) {
            view.push(btnUpdate);
          }
          if (row.users) {
            view.push(btnUsers);
          }
          if (row.devices) {
            view.push(btnDevices);
          }
          if (row.delete) {
            view.push(btnDelete);
          }
          view.push(btnLogs);

          view.push('</div>');
          view.push('</div>');
          view.push('</div>');
          view.push('</div>');

          return view.join("");
        },
        events: {
          "click .delete-project": function (e, value, row, index) {
            _class.alert.confirm({
              title: "Advertencia!",
              type: "warning",
              text: "¿Está seguro que desea eliminar el proyecto <strong>" + row.name + "</strong>?"
            }, function () {
              _class.delete(row.id)
                .then(function (data) {
                  _class.table.refresh();
                })
                .catch(function (error) {

                });
            });
          }
        }
      }
    ]);

    this.table.init();
  };

  ProjectList.prototype.init = function () {
    this._initTable();
  };

  (new ProjectList()).init();

})(window.jQuery);