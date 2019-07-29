class Profile {

  constructor() {
    this.config = $.extend(true, APP, {});
    this.$form = $("#form-changePassword");
    this.$btnAvatar = $("#btn-change-avatar");
  }

  _init_avatar() {
    this.$btnAvatar.on("click", () => {
      $("#UsersModel_user_img_profile").trigger("click");
    });
  }

  _init_form() {
    this.$form.validate({
      submitHandler: (form) => {
        this.alert.loading();
        form.submit();
      },
      rules: {
        "PasswordModel[password]": {
          required: true
        },
        "PasswordModel[new_password]": {
          required: true
        },
        "PasswordModel[confirm_new_password]": {
          required: true
        }
      },
      messages: {
        "PasswordModel[password]": "Debes ingresar la contraseña actual",
        "PasswordModel[new_password]": "Debes ingresar la nueva contraseña",
        "PasswordModel[confirm_new_password]": "Debes volver a ingresar la contrseña nueva"
      }
    });
  }

  init() {
    this._init_form();
    this._init_avatar();
  }

}

$(() => {
  (new Profile()).init();
});