(function ($) {
  'use-strict';

  var RoleIndex = function () {
    this.$btnCreate = $("#btn-create");
    this.table = new TablePlugin("#tbRoles");
    this.$modal = $("#md-manage-role");
    this.$modalDelete = $("#md-delete-role");
    this.$form = $("form#form-manage-role");
    this.$title = this.$modal.find("#md-title-role");
    this.$formDelete = $("form#form-delete-role");
    this.$validate = {};
    this.config = $.extend(true, {}, APP);
  };

  RoleIndex.prototype._openModal = function (modal) {
    modal.modal("show");
  };

  RoleIndex.prototype._closeModal = function (modal) {
    modal.modal("hide");
  };

  RoleIndex.prototype._clearForm = function (form) {
    form.trigger("reset");
  };

  RoleIndex.prototype._submitManage = function (data) {
    var _class = this;

    $.post(this.config.url.moduleFullUrl + "/role/manage", data, function (response) {
      if (!response.error) {
        _class.table.refresh();
        _class._closeModal(_class.$modal);
        Notify("success", response.message, "bottomRight");
      } else {
        Notify("error", response.message, "bottomRight");
      }
    });
  };

  RoleIndex.prototype._submitDelete = function (data) {
    var _class = this;

    $.post(this.config.url.moduleFullUrl + "/role/delete", data, function (response) {
      if (!response.error) {
        _class.table.refresh();
        _class._closeModal(_class.$modalDelete);
        Notify("success", response.message, "bottomRight");
      } else {
        Notify("error", response.message, "bottomRight");
      }
    });
  };

  RoleIndex.prototype.initFormValidate = function () {
    var _class = this;

    jQuery.validator.addMethod("notDuplicated", function (value, element, params) {
      var data = _class.table.getData();
      var obj = data.find(unidad => unidad.name === value);
      return (params === (typeof obj === "undefined"));
    }, 'El Rol ingresado ya existe.');
    
  };

  RoleIndex.prototype.initFormManage = function () {
    var _class = this;

    this.$validate = this.$form.validate({
      submitHandler(form) {
        var data = $(form).serialize();
        _class._submitManage(data);
      },
      rules: {
        "Role[role_name]": {
          required: true,
          notDuplicated: true
        }
      }
    });
  };

  RoleIndex.prototype.initFormDelete = function () {
    var _class = this;

    this.$formDelete.on("submit", function (e) {
      e.preventDefault();
      var data = _class.$formDelete.serialize();
      _class._submitDelete(data);
    });
  };

  RoleIndex.prototype.initModal = function () {
    var _class = this;

    this.$btnCreate.on("click", function (e) {
      _class._openModal(_class.$modal);
      _class.$title.html("Nuevo Rol");
      _class.$form.find("#txtidrole").val('');
    });

    this.$modal.on("shown.bs.modal", function (e) {
      _class.$form.find("#txtrole").focus();
    });

    this.$modal.on("hidden.bs.modal", function (e) {
      _class._clearForm(_class.$form);
      _class.$validate.resetForm();
    });
  };

  RoleIndex.prototype.initModalDelete = function () {
    var _class = this;
    
    this.$modalDelete.on("hidden.bs.modal", function (e) {
      _class._clearForm(_class.$formDelete);
    });
  };

  RoleIndex.prototype.initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.config.url.moduleFullUrl + '/role/list',
      pageSize: 10,
      sortOrder: "asc",
      queryParams: function (params) {
        return params;
      },
    });
    this.table.columns([
      {field: 'role_id', title: 'ID', sortable: true, align: 'center', width: '70px', class: 'table_id'},
      {field: 'role_name', title: 'Nombre del Rol', sortable: true, class: 'bold'},
      {field: 'role_key', title: 'Key del Rol', sortable: true, class: 'bold'},
      {field: 'role_description', title: 'Descripción del Rol', sortable: true, class: 'bold'},
      {
        field: 'action',
        title: '<i class="fa fa-ellipsis-h" aria-hidden="true"></i>',
        align: 'center',
        width: '160px',
        formatter(value, row, index, field) {
          if (row.admin == 0 && !row.role_status) {
            return "";
          }

          var view = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
            '<button type="button" class="edit btn btn-outline-info" data-action="modify"><i class="fa fa-pencil" aria-hidden="true"></i></button>',
            '<button type="button" class="setting btn btn-outline-warning" data-action="modify"><i class="fa fa-cogs" aria-hidden="true"></i></button>',
            '<button type="button" class="delete btn btn-outline-danger" data-action="delete"><i class="fa fa-trash" aria-hidden="true"></i></button>',
            '</div>',
            '</div>'
          ];

          return view.join("");
        },
        events: {
          'click .edit': function (e, value, row, index) {
            _class._openModal(_class.$modal);
            _class.$title.html("Actualizar Rol");
            _class.$form.find("input#txtrole").val(row.role_name);
            _class.$form.find("input#txtrolekey").val(row.role_key);
            _class.$form.find("input#txtidrole").val(row.role_id);
            _class.$form.find("textarea#txtroledescription").html(row.role_description);
          },
          'click .setting': function (e, value, row, index) {
            window.location.href = _class.config.url.controllerFullUrl + '/setting/id/'+row.role_id;
          },
          'click .delete': function (e, value, row, index) {
            _class._openModal(_class.$modalDelete);
            _class.$formDelete.find("input#txtidrole").val(row.role_id);
            _class.$formDelete.find("h5#lblidrole").html(row.role_id);
            _class.$formDelete.find("h5#lblrole").html(row.role_name);
          }
        }
      }
    ]);
    
    this.table.init();
  };

  RoleIndex.prototype.init = function () {
    this.initTable();
    this.initModal();
    this.initModalDelete();
    this.initFormValidate();
    this.initFormManage();
    this.initFormDelete();
  };

  RoleIndex.prototype.refreshTable = function () {
    this.table.refresh();
  };

  (new RoleIndex()).init();

})(window.jQuery);