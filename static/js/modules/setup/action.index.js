(function ($) {
  'use-strict';

  var ActionIndex = function () {
    this.$btnCreate = $("#btn-create");
    this.table = new TablePlugin("#tbActions");
    this.$modal = $("#md-manage-action");
    this.$modalDevare = $("#md-devare-action");
    this.$form = $("form#form-manage-action");
    this.$title = this.$modal.find("#md-title-action");
    this.$formDevare = $("form#form-devare-action");
    this.$validate = {};
    this.config = $.extend(true, {}, APP);
  };

  ActionIndex.prototype._openModal = function (modal) {
    modal.modal("show");
  };

  ActionIndex.prototype._closeModal = function (modal) {
    modal.modal("hide");
  };

  ActionIndex.prototype._clearForm = function (form) {
    form.trigger("reset");
  };

  ActionIndex.prototype._submitManage = function (data) {
    var _class = this;

    $.post(this.config.url.moduleFullUrl + "/action/manage", data, function (response) {
      if (!response.error) {
        _class.table.refresh();
        _class._closeModal(_class.$modal);
        Notify("success", response.message, "bottomRight");
      } else {
        Notify("error", response.message, "bottomRight");
      }
    });
  };

  ActionIndex.prototype._submitDevare = function (data) {
    var _class = this;

    $.post(this.config.url.moduleFullUrl + "/action/devare", data, function (response) {
      if (!response.error) {
        _class.table.refresh();
        _class._closeModal(_class.$modalDevare);
        Notify("success", response.message, "bottomRight");
      } else {
        Notify("error", response.message, "bottomRight");
      }
    });
  };

  ActionIndex.prototype.initFormValidate = function () {
    var _class = this;

    jQuery.validator.addMethod("notDuplicated", function (value, element, params) {
      var data = _class.table.getData();
      var obj = data.find(unidad => unidad.name === value);
      return (params === (typeof obj === "undefined"));
    }, 'La Acción ingresada ya existe.');
  };

  ActionIndex.prototype.initFormManage = function () {
    var _class = this;

    this.$validate = this.$form.validate({
      submitHandler(form) {
        var data = $(form).serialize();
        _class._submitManage(data);
      },
      rules: {
        "Action[groupaction_id]": {
          required: true
        },
        "Action[action_name]": {
          required: true,
          notDuplicated: true
        },
        "Action[action_key]": {
          required: true
        }
      }
    });
  };

  ActionIndex.prototype.initFormDevare = function () {
    var _class = this;

    this.$formDevare.on("submit", function (e) {
      e.preventDefault();
      var data = _class.$formDevare.serialize();
      _class._submitDevare(data);
    });
  };

  ActionIndex.prototype.initModal = function () {
    var _class = this;

    this.$btnCreate.on("click", function (e) {
      _class._openModal(_class.$modal);
      _class.$title.html("Nueva Acción");
      _class.$form.find("#txtidaction").val('');
    });

    this.$modal.on("shown.bs.modal", function (e) {
      _class.$form.find("#txtaction").focus();
    });

    this.$modal.on("hidden.bs.modal", function (e) {
      _class._clearForm(_class.$form);
      _class.$validate.resetForm();
    });
  };

  ActionIndex.prototype.initModalDevare = function () {
    var _class = this;

    this.$modalDevare.on("hidden.bs.modal", function (e) {
      _class._clearForm(_class.$formDevare);
    });
  };

  ActionIndex.prototype.initTable = function () {
    var _class = this;

    this.table.setOptions({
      url: this.config.url.moduleFullUrl + '/action/list',
      pageSize: 10,
      sortOrder: "asc",
      queryParams: function (params) {
        return params;
      },
    });
    this.table.columns([
      {field: 'action_id', title: 'ID', sortable: true, align: 'center', width: '70px', class: 'table_id'},
      {field: 'groupaction_name', title: 'Grupo', sortable: true, class: 'bold'},
      {field: 'action_name', title: 'Nombre de la Acción', sortable: true, class: 'bold'},
      {field: 'action_key', title: 'Key de la Acción', sortable: true, class: 'bold'},
      {field: 'action_description', title: 'Descripción de la Acción', sortable: true, class: 'bold'},
      {
        field: 'action',
        title: '<i class="fa fa-ellipsis-h" aria-hidden="true"></i>',
        align: 'center',
        width: '70px',
        formatter(value, row, index, field) {
          var view = [
            '<div class="wrapper text-center" action="toolbar">',
            '<div class="btn-group btn-group-sm" action="group">',
            '<button type="button" class="edit btn btn-outline-info" data-action="modify"><i class="fa fa-pencil" aria-hidden="true"></i></button>',
            '<button type="button" class="devare btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>',
            '</div>',
            '</div>'
          ];

          return view.join("");
        },
        events: {
          'click .edit': function (e, value, row, index) {
            _class._openModal(_class.$modal);
            _class.$title.html("Actualizar Acción");
            _class.$form.find("select#Action_groupaction_id").val(row.groupaction_id);
            _class.$form.find("input#txtaction").val(row.action_name);
            _class.$form.find("input#txtactionkey").val(row.action_key);
            _class.$form.find("input#txtidaction").val(row.action_id);
            _class.$form.find("textarea#txtactiondescription").html(row.action_description);
          },
          'click .devare': function (e, value, row, index) {
            _class._openModal(_class.$modalDevare);
            _class.$formDevare.find("input#txtidaction").val(row.action_id);
            _class.$formDevare.find("h5#lblidaction").html(row.action_id);
            _class.$formDevare.find("h5#lblaction").html(row.action_name);
          }
        }
      }
    ]);
    this.table.init();
  };

  ActionIndex.prototype.init = function () {
    this.initTable();
    this.initModal();
    this.initModalDevare();
    this.initFormValidate();
    this.initFormManage();
    this.initFormDevare();
  };

  ActionIndex.prototype.refreshTable = function () {
    this.table.refresh();
  };

  (new ActionIndex()).init();

})(window.jQuery);