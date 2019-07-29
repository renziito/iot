(function ($) {
  'use-strict';

  var UserUpdate = function () {
    this.config = $.extend(true, APP, {});
    this.$form = $("#form-setting-user");
    this.$btnDevare = $("#btn-user-devare");
    this.$btnResetpassword = $("#btn-user-resetpassword");
    this.$modalResetpassword = $("#md-reset-password");
    this.events = new UserEvents();
  };

  UserUpdate.prototype._generate_new_password = function () {
    var _class = this;

    $.get(this.config.url.controllerFullUrl + '/getNewPassword', function (response) {
      _class.$modalResetpassword.find("form#form-reset-password input#txtnewpassword").val(response.new_password);
    });
  };

  UserUpdate.prototype._init_devare = function () {
    var _class = this;
    
    this.$btnDevare.on("click", function () {
      var id = _class.$btnDevare.attr("data-id");
      _class.events.devare(id, function () {
        window.location.href = this.config.url.controllerFullUrl+'/';
      });
    });
  };

  UserUpdate.prototype._init_form = function () {
    var form = new UserFormValidate(this.$form);
    form.validate();
  };

  UserUpdate.prototype._init_reset_password = function () {
    var _class = this;
    
    this.$btnResetpassword.on("click", function(){
      _class._generate_new_password();
      _class.$modalResetpassword.modal("show");
    });
  };

  UserUpdate.prototype._init_modal_reset_password = function () {
    var _class = this;
    
    this.$modalResetpassword.find("button#btn-reset").on("click", function(){
      var copy = _class.$modalResetpassword.find("input#UserUpdate_save_password");
      var form = _class.$modalResetpassword.find("form#form-reset-password");
      var id = _class.$modalResetpassword.find("input#txtid").val();
      var data = form.serialize();
      
      if (copy.prop("checked") == true) {

        _class.events.resetPassword(id, data, function(response){
          _class.$modalResetpassword.modal("hide");
        }, function(error){
          _class.$modalResetpassword.modal("hide");
        });

        _class.$modalResetpassword.find("span#UserUpdate_save_password_error").empty();
      } else {
        _class.$modalResetpassword.find("span#UserUpdate_save_password_error").html('Debes marcar la casilla');
      }
    });
  };

  UserUpdate.prototype.init = function () {
    this._init_form();
    this._init_devare();
    this._init_reset_password();
    this._init_modal_reset_password();
  };

  (new UserUpdate()).init();

})(window.jQuery);