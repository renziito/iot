(function ($) {
  'use strict';

  var SettingBannerCreate = function () {
    this.config = $.extend(true, APP, {});
    this.alert = new AlertPlugin();
    this.$form = $("#form-banner");
    this.btnChangeImg = $("#btnBannerChangeImage");
    this.$img = $("#BannersModel_image_id");
    this.$imgPreview = $("#bannePreview");
  };
  
  SettingBannerCreate.prototype._initForm = function () {
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
        "BannersModel[image_id]": {
          required: true
        }
      },
      messages:{
        "BannersModel[image_id]": "Debes seleccionar una imagen."
      }
    });
  };


  SettingBannerCreate.prototype._initClickImage = function () {
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

  SettingBannerCreate.prototype.init = function () {
    this._initForm();
    this._initClickImage();
  };

  (new SettingBannerCreate()).init();

})(window.jQuery);


