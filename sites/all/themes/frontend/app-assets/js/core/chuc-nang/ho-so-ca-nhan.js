$(document).ready(function (){
  $(".brand-text").html('HỒ SƠ CÁ NHÂN')
  $(document).on("click",".btn-save-logo",function (){
    var file_data = $(".file-upload-input")[0].files[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("tokenForm", $("#tokenbody").val());
    $.ajax({
      url: "/save-logo",
      dataType: 'Json',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      beforeSend: function (){
        blockPage()
      },
      success: function (data){
        getToastSuccess(data.content);
        setTimeout(function (){
          location.reload();

        },2000)
      },
      complete: function (){
        unblockPage();
      },
      error: function (r1, r2){
        getToastError(r1);
        unblockPage();
      }
    });

  })
})
