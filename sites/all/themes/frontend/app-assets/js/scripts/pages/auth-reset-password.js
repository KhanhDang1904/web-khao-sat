/*=========================================================================================
  File Name: auth-reset-password.js
  Description: Auth reset password js file.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function (){
  $(document).on("click",'.btn-reset-pass',function (){
    if ($("#reset-password-new").val()==""){
      toastError("Vui lòng nhập mật khẩu mới")
      return false
    }
    if ($("#reset-password-new").val().length<6){
      toastError("Mật khẩu mới tối thiểu 6 kí tự")
      return false
    }
    if ($("#reset-password-confirm").val()==""){
      toastError("Vui lòng nhập xác nhận mật khẩu")
      return false
    }
    if ($("#reset-password-confirm").val()!==$("#reset-password-new").val()){
      toastError("Nhập lại mật khẩu không trùng khớp")
      return false
    }
    $("#edit-pass-pass1").val($("#reset-password-new").val())
    $("#edit-pass-pass2").val($("#reset-password-confirm").val())
    $("#edit-submit").click()
  })
})

$(function () {
  'use strict';

  var pageResetPasswordForm = $('.auth-reset-password-form');

  // jQuery Validation
  // --------------------------------------------------------------------
  if (pageResetPasswordForm.length) {
    pageResetPasswordForm.validate({
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
        'reset-password-new': {
          required: true
        },
        'reset-password-confirm': {
          required: true,
          equalTo: '#reset-password-new'
        }
      }
    });
  }
});
