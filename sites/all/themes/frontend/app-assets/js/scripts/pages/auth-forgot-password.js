/*=========================================================================================
  File Name: auth-forgot-password.js
  Description: Auth forgot password js file.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function () {
  $(document).on("click", '.btn-forgot-pass', function () {
    if ($("#forgot-password-email").val() == "") {
      toastError("Vui lòng nhập email")
      return false
    }
    if (!validateEmail($("#forgot-password-email").val())) {
      toastError("Email không đúng định dạng")
      return false
    }
    $("#edit-name").val($("#forgot-password-email").val())
    $("#edit-submit").click()
  })
})
$(document).keyup(function (e) {
  var code = (e.keyCode ? e.keyCode : e.which);
  if (code == 32 || code == 13 || code == 188 || code == 186) {
    if ($("#forgot-password-email").val() == "") {
      toastError("Vui lòng nhập email")
      return false
    } else if (!validateEmail($("#forgot-password-email").val())) {
      toastError("Email không đúng định dạng")
      return false
    }
    $("#edit-name").val($("#forgot-password-email").val())
    $("#edit-submit").click()
  }
});

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test($email);
}

$(function () {
  'use strict';

  var pageForgotPasswordForm = $('.auth-forgot-password-form');

  // jQuery Validation
  // --------------------------------------------------------------------
  if (pageForgotPasswordForm.length) {
    pageForgotPasswordForm.validate({
      /*
      * ? To enable validation onkeyup
      onkeyup: function (element) {
        $(element).valid();
      },*/
      /*
      * ? To enable validation on focusout
      onfocusout: function (element) {
        $(element).valid();
      }, */
      rules: {
        'forgot-password-email': {
          required: true,
          email: true
        }
      }
    });
  }
});
