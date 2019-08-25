(function ($) {
  'use strict';

  var SettingPartnerCreate = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-partner");
    this.btnChangeImg = $("#btnPartnerChangeImage");
    this.$img = $("#PartnersModel_image_id");
    this.$imgPreview = $("#partnerPreview");
  };

  SettingPartnerCreate.prototype._initForm = function () {
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
        "PartnersModel[partner_name]": {
          required: true
        },
        "PartnersModel[partner_url]": {
          required: true
        },
      },
      messages: {
        "PartnersModel[partner_name]": "Debes ingresar el nombre de la institución",
        "PartnersModel[partner_url]": "Debes ingresar la url de la institución"
      }
    });


    if (this.$form.find("#PartnersModel_image_id").attr("data-exists") == 0) {
      this.$form.find("#PartnersModel_image_id").rules("add", {
        required: true,
        messages: {
          required: "Debes seleccionar una imagen."
        }
      });
    }
  };


  SettingPartnerCreate.prototype._initClickImage = function () {
    var _class = this;
    this.btnChangeImg.on("click", function () {
      _class.$img.trigger("click");
    });

    this.$img.on("change", function () {
      var file = this.files[0];
      var src = _class.$imgPreview.attr("src");


      var reader = new FileReader();

      reader.onloadend = () => {
        _class.$imgPreview.attr("src", reader.result);
      }
      var onlyImg = new RegExp("(.*?)\.(jpg|jpeg|png|JPG|JPEG|PNG)$");
      if (file && onlyImg.test(file.name)) {
        reader.readAsDataURL(file);
      } else {
        _class.$imgPreview.attr("src", src);
      }
    });
  }

  SettingPartnerCreate.prototype.init = function () {
    this._initForm();
    this._initClickImage();
  };

  (new SettingPartnerCreate()).init();

})(window.jQuery);


