(function ($) {
  'use strict';

  var UserList = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.events = new UserEvents();
    this.table = new TablePlugin("table#tbUsers");
    this.url = {
      list: this.config.url.controllerFullUrl + '/list',
      update: this.config.url.controllerFullUrl + '/update'
    };
  };

  UserList.prototype._init_table = function () {
    var _class = this;
    
    this.table.setOptions({
      url: this.url.list
    });
    this.table.events({
      onClickCell: (field, value, row, e) => {
        if (field !== 10 && field != 'status') {
          window.location.href = this.url.update + '/id/' + row.id;
        }
      }
    });
    this.table.columns([
      {field: 'id', title: "ID", sortable: true, class: 'table_id', width: "50px", align: "center"},
      {
        field: 'img_profile',
        title: "Avatar",
        formatter: function (value, row, index) {
          var view = [
            '<div class="text-center">',
            '<img class="rounded-circle" src="' + _class.config.url.baseFullUrl + '/' + value + '" width="38" height="38">',
            '</div>'
          ];
          return view.join('');
        },
      },
      {field: 'r_name', title: "Rol", sortable: true},
      {field: 'usrname', title: "usuario", sortable: true},
      {field: 'firstname', title: "Nombres", sortable: true},
      {field: 'lastname', title: "Apellidos", sortable: true},
      {field: 'date_registered', title: "F. Registro", sortable: true, align: "center"},
      {field: 'date_updated', title: "F. Actualización", sortable: true, align: "center"},
      {field: 'lastlogin', title: "F. Último Acceso", sortable: true, align: "center"},
      {
        field: 'status',
        title: "Activo?",
        width: "80px",
        sortable: true,
        formatter: function (value, row, index) {
          var checked = (value == 1) ? "checked" : "";
          var view = [
            '<div class="text-center">',
            '<div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">',
            '<input type="checkbox" value="' + value + '" name="status" id="user-status-' + row.id + '" class="change_user_status" ' + checked + '>',
            '<label for="user-status-' + row.id + '"></label>',
            '</div>',
            '</div>'
          ];

          return view.join('');

        },
        events: {
          "change .change_user_status": function (e, value, row, index) {
            _class.events.changeStatus($(`#user-status-${row.id}`), row.id, value, () => {
              _class.table.refresh();
            });
          }
        }
      },
      {
        label: 'action',
        title: "...",
        align: 'center',
        sortable: false,
        formatter: function (value, row, index) {
          var view = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
            '<a href="' + _class.url.update + '/id/' + row.id + '" class="btn btn-outline-info">',
            '<i class="fa fa-pencil"></i>',
            '</a>',
            '<button type="button" class="btn btn-outline-danger delete-user" id="#user-delete-' + row.id + '">',
            '<i class="fa fa-trash"></i>',
            '</button>',
            '</div>',
            '</div>'
          ];

          return view.join('');
        },
        events: {
          "click .delete-user": function (e, value, row, index) {
            _class.events.delete(row.id, function () {
              _class.table.refresh();
            });
          }
        }
      }
    ]);
    this.table.init();
  };

  UserList.prototype.init = function () {
    this._init_table();
  };

  (new UserList()).init();

})(window.jQuery);