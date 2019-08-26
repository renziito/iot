(function ($) {
  'use strict';

  var SettingDeviceVariables = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbDeviceVariables");
    this.$select = $("#cboVariables");
    this.$form = $("#form-device-variable");
    this.url = {
      list: this.config.url.controllerFullUrl + '/listVariables/id/' + Request._GET.id,
      delete: this.config.url.controllerFullUrl + '/deleteVariable',
    };
  };

  SettingDeviceVariables.prototype._delete = function (id) {
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

  SettingDeviceVariables.prototype._initForm = function () {
    var _class = this;
    this.$form.validate({
      submitHandler: function (form) {
        _class.alert.confirm({
          title: "Advertencia!",
          type: "warning",
          text: "¿Está seguro que los datos ingresados son los correctos?",
        }, function () {
          form.submit();
        });
      },
      rules: {
        "TypeDeviceVariablesModel[typevariable_id]": {
          required: true
        }
      },
      messages: {
        "TypeDeviceVariablesModel[typevariable_id]": "Debes seleccionar la variable"
      }
    });
  };

  SettingDeviceVariables.prototype._initSelect = function () {
    this.$select.select2();
  };

  SettingDeviceVariables.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list
    });

    this.table.columns([
      {field: "dvid", title: "ID"},
      {field: "vdenomination", title: "Denominación"},
      {field: "vkey", title: "Key"},
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
              _class._delete(row.dvid)
                .then(function (data) {
                  window.location.reload();
                });
            });

          }
        }
      }
    ]);

    this.table.init();
  };

  SettingDeviceVariables.prototype.init = function () {
    this._initTable();
    this._initForm();
    this._initSelect();
  };

  (new SettingDeviceVariables()).init();

})(window.jQuery);