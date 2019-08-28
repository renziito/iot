(function ($) {
  'use strict';

  var DeviceMaintenance = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.table = new TablePlugin("table#tbDeviceMaintenances");
    this.tableMaintenance = false;
    this.$btnAddMaintenance = $("#btnAdd");
    this.$modal = $("#md-maintenance");
    this.$form = $("#form-maintenance");
    this.validator = {};
    this.url = {
      list: this.config.url.controllerFullUrl + '/list/id/' + Request._GET.id,
      create: this.config.url.controllerFullUrl + '/create/',
      delete: this.config.url.controllerFullUrl + '/delete/',
    }
  };

  DeviceMaintenance.prototype._openModal = function () {
    this.$modal.modal("show");
  };

  DeviceMaintenance.prototype._closeModal = function () {
    this.$modal.modal("hide");
  };

  DeviceMaintenance.prototype._clearForm = function () {
    this.$form.trigger("reset");
    this.validator.resetForm();
    this.$form.find("select#DeviceMaintenancesModel_responsable_id")
      .val("")
      .select2('destroy');
    this.$form
      .find(".form-control")
      .removeClass("error")
      .removeClass("valid");
  };

  DeviceMaintenance.prototype._submit = function (data) {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.post(_class.url.create, data, function (response) {
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

  DeviceMaintenance.prototype._delete = function (id) {
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

  DeviceMaintenance.prototype._initSelect = function () {
    this.$form.find("#DeviceMaintenancesModel_responsable_id").select2({
      dropdownParent: this.$modal
    });
  };

  DeviceMaintenance.prototype._initForm = function () {
    var _class = this;

    this.validator = this.$form.validate({
      submitHandler: function (form) {
        var serialize = $(form).serialize();
        _class.alert.confirm({
          type: "warning",
          title: "Advertencia!",
          text: "¿Confirma que los datos ingresados son correctos?"
        }, function (result) {
          _class._submit(serialize)
            .then(function (data) {
              _class._closeModal();
              _class.table.refresh();
            });
        });
      },
      rules: {
        "DeviceMaintenancesModel[responsable_id]": {
          required: true
        },
        "DeviceMaintenancesModel[devicemaintenance_date]": {
          required: true
        }
      },
      messages: {
        "DeviceMaintenancesModel[responsable_id]": "Debes seleccionar un responsable",
        "DeviceMaintenancesModel[devicemaintenance_date]": "Debes ingresar la fecha del mantenimiento"
      }
    });

    this.$form.find("#DeviceMaintenancesModel_devicemaintenance_date").datepicker({
      format: "yyyy-mm-dd",
      language: "es",
      autoclose: true,
      orientation: 'bottom'
    });
  };
  
  DeviceMaintenance.prototype._initCreateResponsables = function () {
    var _class = this;
    var create = new ManagerCreate({
      btnOpen: "#btncreateResponsable",
      onSubmit: function (data) {
       window.location.reload();
      }
    });
    create.init();
  };

  DeviceMaintenance.prototype._initModal = function () {
    var _class = this;

    this.$btnAddMaintenance.on('click', function (e) {
      _class._openModal(_class.$modal);
    });

    this.$modal.on("show.bs.modal", function () {
      _class._initSelect();
    });

    this.$modal.on("hidden.bs.modal", function () {
      _class._clearForm();
    });

  };

  DeviceMaintenance.prototype._initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.url.list
    });

    this.table.columns([
      {field: "dmid", title: "ID"},
      {field: "dmdate", title: "Fecha"},
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
              _class._delete(row.dmid)
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

  DeviceMaintenance.prototype.init = function () {
    this._initCreateResponsables();
    this._initTable();
    this._initModal();
    this._initForm();
  };

  (new DeviceMaintenance()).init();

})(window.jQuery);