(function ($) {
  'use-strict';

  var RoleSetting = function () {
    this.config = $.extend(true, {}, APP);
    this.$actions = $(".actions");
  };

  RoleSetting.prototype._change_permission = function (id, status) {
    $.post(this.config.url.controllerFullUrl + '/savePermission/id/' + Request._GET.id, {
      action: {
        id: id,
        status: status
      }
    }, function (response) {
      if (!response.error) {
        Notify("success", response.message);
      }
    });
  };

  RoleSetting.prototype._init_actions = function () {
    var _class = this;
    
    this.$actions.on("change", function(e){
      var elm = e.currentTarget;
      var checked = $(elm).prop("checked");
      var status = (checked) ? 1 : 0;

      _class._change_permission(elm.value, status);
    });
  };

  RoleSetting.prototype.init = function () {
    this._init_actions();
  };

  (new RoleSetting()).init();

})(window.jQuery);