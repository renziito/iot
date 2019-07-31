(function ($) {
  'use strict';

  var ProjectManage = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-project");
  };

  ProjectManage.prototype.initForm = function () {
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
        "ProjectsModel[project_name]": {
          required: true
        },
        "ProjectsModel[project_code]": {
          required: true
        }
      }
    });
  };

  ProjectManage.prototype.init = function () {
    this.initForm();
  };

  (new ProjectManage()).init();

})(window.jQuery);