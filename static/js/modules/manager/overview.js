(function ($) {
  'use strict';

  var ManagerIndex = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbManagers");
    this.url = {
      list: this.config.url.controllerFullUrl + '/list'
    };
  };

  ManagerIndex.prototype._initCreate = function () {
    var _class = this;
    var create = new ManagerCreate({
      onSubmit: function (data) {
        _class.table.refresh();
      }
    });
    create.init();
  };

  ManagerIndex.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list
    });

    this.table.columns([
      {field: "rid", title: "ID"},
      {field: "rname", title: "Nombres"},
      {field: "rphone", title: "Teléfono/Celular"},
      {field: "rposition", title: "Cargo"},
      {
        label: "action",
        formatter: function (value, row, index) {
          var html = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
            '<button type="button" class="edit btn btn-outline-info" data-action="edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>',
            '<button type="button" class="delete btn btn-outline-danger" data-action="delete"><i class="fa fa-trash" aria-hidden="true"></i></button>',
            '</div>',
            '</div>'
          ];

          return html.join("");
        },
        events: {
          "click .edit": function (e, value, row, index) {
            new ManagerUpdate({
              data: row,
              onSubmit: function (data) {
                _class.table.refresh();
              }
            });
          },
          "click .delete": function (e, value, row, index) {
            new ManagerDelete({
              id: row.rid,
              onSubmit: function (data) {
                console.log(data);
                _class.table.refresh();
              }
            });
          }
        }
      }
    ]);

    this.table.init();
  };

  ManagerIndex.prototype.init = function () {
    this._initTable();
    this._initCreate();
  };

  (new ManagerIndex()).init();

})(window.jQuery);