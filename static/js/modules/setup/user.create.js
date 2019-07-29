(function ($) {
  'use strict';

  var UserCreate = function () {
    this.config = $.extend(true, APP, {});
    this.$form = $("#form-setting-user");
  };

  UserCreate.prototype.init = function () {
    var form = new UserFormValidate(this.$form);
    form.validate();
  };

  (new UserCreate()).init();

})(window.jQuery);