$(document).ready(function (){
  $(document).on("click",'.btn-next-page',function (){
    $page = parseInt($(this).attr("data-page"));
    $next_page = $page+1;
    $last_page = parseInt($(this).parent().parent().attr("data-page"));
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
  })
  $(document).on("click",".btn-back-page",function (){
    $page = parseInt($(this).attr("data-page"));
    $back_page = $page - 1;
    console.log($page)
    console.log($back_page)
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
})
