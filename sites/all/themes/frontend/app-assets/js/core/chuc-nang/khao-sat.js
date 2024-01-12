$(document).ready(function (){
  $(document).on("click",'.btn-next-page',function (){
    $loi = false;
    $page = parseInt($(this).attr("data-page"));
    $next_page = $page+1;
    $last_page = parseInt($(this).parent().parent().attr("data-page"));
    $(".page-"+$page+" .required").each(function (){

      $element =  $(this).parent().parent().find("input[name='dap_an[]']");
      if ($element.attr("type")=="radio"){
        $dap_an = $(this).parent().parent().find("input:checked").val();
      }else {
        $dap_an = $element.val();
      }
      $cauHoi = $(this).parent().text();
      if ($dap_an==""|| $dap_an==undefined){
        $loi = true;
        toastError("Vui lòng không để trống: "+$cauHoi);
        return false;
      }
    })
    if (!$loi){
      $(".page-"+$page).addClass("hidden")
      $(".page-"+$next_page).removeClass("hidden")
      if($next_page==$last_page){
        $(this).parent().parent().html(`
        <div class="col-6"><a data-page="`+$next_page+`" class="btn btn-primary btn-back-page"><i data-feather='arrow-left'></i> Quay lại</a>
        </div>
        <div class="col-6 text-right"><a class="btn btn-success btn-send-khao-sat">Gửi <i data-feather='send'></i></a></div>
      `)
      } else {
        $(this).parent().parent().html(`
        <div class="col-6"><a data-page="`+$next_page+`" class="btn btn-primary btn-back-page"><i data-feather='arrow-left'></i> Quay lại </a>
        </div>
        <div class="col-6 text-right"><a data-page="`+$next_page+`" class="btn btn-primary btn-next-page">Tiếp theo <i data-feather='arrow-right'></i></a>
        </div>
      `)
      }
      loadIcon()
    }
  })
  $(document).on("click",".btn-back-page",function (){
    $page = parseInt($(this).attr("data-page"));
    $back_page = $page - 1;
    $last_page = parseInt($(this).parent().parent().attr("data-page"));
    $(".page-"+$page).addClass("hidden")
    $(".page-"+$back_page).removeClass("hidden")

    if($back_page==1){
      $(this).parent().parent().html(`
        <div class="col-12 text-right"><a data-page="`+$back_page+`" class="btn btn-primary btn-next-page">Tiếp theo<i data-feather='arrow-right'></i></a>
        </div>
      `)
    } else {
      $(this).parent().parent().html(`
        <div class="col-6"><a data-page="`+$back_page+`" class="btn btn-primary btn-back-page">Quay lại <i data-feather='arrow-left'></i></a>
        </div>
        <div class="col-6 text-right"><a data-page="`+$back_page+`" class="btn btn-primary btn-next-page">Tiếp theo<i data-feather='arrow-right'></i></a>
        </div>
      `)
    }
    loadIcon()
  })
  $(document).on("click",".btn-send-khao-sat",function (){
    $loi = false;

    $(".required").each(function (){

      $element =  $(this).parent().parent().find("input[name='dap_an[]']");
      if ($element.attr("type")=="radio"){
        $dap_an = $(this).parent().parent().find("input:checked").val();
      }else {
        $dap_an = $element.val();
      }
      $cauHoi = $(this).parent().text();
      if ($dap_an==""|| $dap_an==undefined){
        $loi = true;
        toastError("Vui lòng không để trống: "+$cauHoi);
        return false;
      }
    })
    if (!$loi){
      $.ajax({
        url: '/save-khao-sat',
        data:$("#form-khao-sat").serializeArray() ,
        dataType: 'json',
        type: 'POST',
        beforeSend: function () {
          blockForm($('#form-khao-sat'))
        },
        success: function (data) {
          getToastSuccess(data.content);
          setTimeout(function () {
            location.reload()
          },500)
        },
        complete: function () {
          unblockPage();
        },
        error: function (r1, r2) {
          getToastError(r1);
          unblockPage();
        }
      });
    }
  })
})
