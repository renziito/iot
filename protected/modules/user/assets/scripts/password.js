class Password{
  
  constructor(){
    this.config = $.extend(true, APP, {});
    this.$form = $("#form-user-profile");
  }
  
  _init_form(){
    this.$form.validate({
      submitHandler: (form) => {
        this.alert.loading();
        form.submit();
      },
      rules: {
        "UsersModel[user_firstname]":{
          required: true
        },
        "UsersModel[user_lastname]":{
          required: true
        },
        "UsersModel[user_email]":{
          required: true
        }
      },
      messages: {
        "UsersModel[user_firstname]": "Debes ingresar tu nombre",
        "UsersModel[user_lastname]": "Debes ingresar tus apellidos",
        "UsersModel[user_email]": "Debes ingresar tu email"
      }
    });
  }
  
  init(){
    this._init_form();
  }
  
}

$(()=>{
  (new Password()).init();
});