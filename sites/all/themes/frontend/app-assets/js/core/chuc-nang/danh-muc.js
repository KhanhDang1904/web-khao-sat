$(document).ready(function () {
  function convertYMD($str) {
    var arrStr = $str.split('T');
    return arrStr[0];
  }
  function loadDate(){
    if($(".flatpickr-basic").length > 0) {
      $('.flatpickr-basic').each(function (){
        $(this).flatpickr(
          {
            static: true,
          }
        )
      })
    }
  }
  function resetForm(){
    $('#edit-reset').click()
  }
  $(document).on('click', '#btn-them-moi-danh-muc', function (e) {
    e.preventDefault();
    $("#modal-danh-muc").modal('show');
    $('#form-danh-muc')[0].reset();
    $("#title-modal-danh-muc").text('Thêm danh mục');
  });
  $(document).on('click', '.btn-sua-danh-muc', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-danh-muc',
      dataType: 'json',
      data: {
        token: $("#tokenbody").val(),
        id: $(this).attr('data-value'),
      },
      type: 'post',
      beforeSend: function () {
        blockPage();
      },
      success: function (data) {
        $("#modal-danh-muc").modal('show');
        $('#form-danh-muc')[0].reset();
        $("#title-modal-danh-muc").text('Cập nhật danh mục');
        $('#nid').val(data.nid);
        $('#title_form').val(data.title_form);
        var str = '';
        $.each(data.field_ghi_chu_form,function (key,value){
          str += `
              <div class="input-group mb-1">
               <input type="text" class="form-control" name="field_ghi_chu_form[]" placeholder="Từ loại" value="`+value+`" aria-describedby="button-addon2" />
               <button class="btn btn-xoa-dong btn-outline-primary" type="button"><i data-feather='trash-2' class="text-danger"></i></button>
              </div>
            `
        })
        $(".danh-sach-tu-loai").html(str);
      },
      complete: function () {
        unblockPage();
        if (feather) {
          feather.replace({
            width: 14,
            height: 14
          });
        }
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });
  $(document).on('click', '.btn-xoa-dong', function (e) {
    $(this).parent().remove();
  })
  $(document).on('click', '.btn-them-dong', function (e) {
    $(".danh-sach-tu-loai").append(`
      <div class="input-group mb-1">
       <input type="text" class="form-control" name="field_ghi_chu_form[]" placeholder="Từ loại" aria-describedby="button-addon2" />
       <button class="btn btn-xoa-dong btn-outline-primary" type="button"><i data-feather='trash-2' class="text-danger"></i></button>
      </div>
    `)
    if (feather) {
      feather.replace({
        width: 14,
        height: 14
      });
    }
  })
  $(document).on('click', '.btn-save-danh-muc', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/save-danh-muc',
      data: $("#form-danh-muc").serializeArray(),
      dataType: 'json',
      type: 'post',
      beforeSend: function () {
        blockForm($("#form-danh-muc"));
      },
      success: function (data) {
        getToastSuccess(data.content);
        setTimeout(function (){
          location.reload();
        },2000)
        location.reload();
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });

  setTimeout(function (){
    $("h2.brand-text").text('DANH MỤC');
  },500)
  $(document).on('click', '.btn-xoa-danh-muc', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Xác nhận',
      text: "Bạn có chắc chắn khi thực hiện thao tác này không !",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/xoa-danh-muc',
          data: {
            token: $("#tokenbody").val(),
            id: $(this).attr('data-value'),
          },
          dataType: 'json',
          type: 'post',
          beforeSend: function () {
            blockPage();
          },
          success: function (data) {
            getToastSuccess(data.content);
            setTimeout(function (){
              location.reload();
            },2000)          },
          complete: function () {

            unblockPage();

          },
          error: function (r1, r2) {
            getToastError(r1);
          }
        });
      }
    })


  })
  $(document).on('change', '#title', function () {
    $('#edit-title').val($(this).val())
  })
  $(document).on('click', '.btn-tim-kiem-danh-muc', function (e) {
    e.preventDefault();
    $("#views-exposed-form-danh-sach-noi-dung-danh-muc #edit-submit-danh-sach-noi-dung").click();
  })
  $(document).on('click', '.btn-khoi-phuc-luoi', function (e) {
    e.preventDefault();
    $("#edit-reset").click();
  });
})
