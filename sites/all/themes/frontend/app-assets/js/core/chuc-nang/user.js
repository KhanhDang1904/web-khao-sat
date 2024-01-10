$(document).ready(function () {
  function convertYMD($str) {
    var arrStr = $str.split('T');
    return arrStr[0];
  }
  if ($(".flatpickr-range").length) {
    $(".flatpickr-range").flatpickr({
      mode: 'range',
      dateFormat: 'm/d/Y',
    });
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
  $(document).on('change', '#field_tu_den_ngay', function (e) {
    tuNgay = $(this).val().split(' to ')[0]
    denNgay = $(this).val().split(' to ')[1]
    if (tuNgay===undefined){
      tuNgay = $(this).val()
    }
    if (denNgay===undefined){
      denNgay = $(this).val()
    }
    $("#created_min").val(tuNgay)
    $("#created_max").val(denNgay)

  });
  $(document).on('click', '.btn-sort', function (e) {
    $("#sort_bys").val($(this).attr('data-value'))
    $("#sort_orders").val($(this).attr('data-sort'))
    $(".btn-tim-kiem").click()
  })
  $(document).on('click', '#btn-them-moi-nguoi-dung', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-role',
      data: {token: $("#tokenbody").val()},
      dataType: 'json',
      type: 'post',
      beforeSend: function () {
        blockPage();
      },
      success: function (data) {
        $("#modal-nguoi-dung").modal('show');
        $('#form-nguoi-dung')[0].reset();
        $('.name').attr('readonly', false);
        $("#title-modal-nguoi-dung").text('Thêm người dùng');
        $('.field-role .form-check').remove();
        $.each(data, function (key, value) {
          $('.field-role').append('' +
            '<div class="form-check form-check-inline">\n' +
            '    <input class="form-check-input" type="checkbox" id="inlineCheckbox2'+key+'" name="field_role[]" value="' + value.rid + '" />\n' +
            '     <label class="form-check-label" for="inlineCheckbox2'+key+'">' + value.name + '</label>\n' +
            '</div>' +
            '');
        })
      },
      complete: function () {
        loadDate()
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });
  $(document).on('click', '.btn-doi-diem-user', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-diem',
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
        $("#modal-doi-diem").modal('show');
        $('#form-doi-diem')[0].reset();
        $("#title-modal-doi-diem").text('Đổi điểm');
        loadDataValue(data,'#form-doi-diem')
      },
      complete: function () {
        loadNumerical()
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });
  $(document).on('click', '.btn-xem', function (e) {
    e.preventDefault();
    var ID = $(this).attr("data-value");
    $("#modal-view-doi-diem").modal('show');
    getTableModal('/lich-su-doi-diem', {
      token: $("#tokenbody").val(),
      nid: ID
    }, "#table-lich-su-doi-diem", [
      getDataColumn('index', "class='text-center' width='1%'"),
      getDataColumn('created', "class='text-center' width='1%'"),
      getDataColumn('field_ho_ten',"width='1%'"),
      getDataColumn('field_so_diem',"class='text-right' width='1%'"),
      getDataColumn('field_phan_qua'),
    ])

  });
  $(document).on('click', '.btn-save-doi-diem', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/save-doi-diem',
      data: $('#form-doi-diem').serializeArray(),
      dataType: 'json',
      type: 'post',
      beforeSend: function () {
        blockForm($('#form-doi-diem'));
      },
      success: function (data) {
        getToastSuccess(data.content);
        setTimeout(function (){
          location.reload();
        },2000)
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });
  $(document).on('click', '.btn-sua-user', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-user',
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
        $("#modal-nguoi-dung").modal('show');
        $('#form-nguoi-dung')[0].reset();
        $("#title-modal-nguoi-dung").text('Cập nhật người dùng');
        $('.field-role .form-check').remove();
        $('.name').val(data.user.name);
        $('.name').attr('readonly', true);
        $('#uid').val(data.user.uid);
        $('.field_ho_ten').val(data.user.field_ho_ten);
        $('.field_dien_thoai').val(data.user.field_dien_thoai);
        $('.field_email').val(data.user.mail);
        $('.field_dia_chi').val(data.user.field_dia_chi);
        $('.field_ngay_sinh_thanh_lap').val(data.user.field_ngay_sinh_thanh_lap==''?'':convertYMD(data.user.field_ngay_sinh_thanh_lap));
        $.each(data.role, function (key, value) {
          $('.field-role').append('' +
            '<div class="form-check form-check-inline">\n' +
            '    <input class="form-check-input" type="checkbox" id="inlineCheckbox2'+key+'" name="field_role[]" value="' + value.rid + '" />\n' +
            '     <label class="form-check-label" for="inlineCheckbox2'+key+'">' + value.name + '</label>\n' +
            '</div>' +
            '');
        })
        $.each(data.user.roles, function (key, value) {
          $('.form-check input[value='+key+']').attr('checked',true)
        })
      },
      complete: function () {
        unblockPage();
        loadDate()
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });
  $(document).on('click', '.btn-save-user', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/save-user',
      data: $("#form-nguoi-dung").serializeArray(),
      dataType: 'json',
      type: 'post',
      beforeSend: function () {
        blockForm($("#form-nguoi-dung"));
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
    $("h2.brand-text").text('NGƯỜI DÙNG');
  },500)
  $(document).on('click', '.btn-xoa-user', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Xác nhận xóa người dùng',
      text: "Bạn có chắc chắn khi thực hiện thao tác này không !",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/xoa-user',
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
  $(document).on('change', '#name', function () {
    $('#edit-name').val($(this).val())
  })
  $(document).on('change', '#field_ho_ten', function () {
    $('#edit-field-ho-ten-value').val($(this).val())
  })
  $(document).on('click', '.btn-tim-kiem-nguoi-dung', function (e) {
    e.preventDefault();
    $("#views-exposed-form-page-nguoi-dung-page-nguoi-dung #edit-submit-page-nguoi-dung").click();
  })
  $(document).on('click', '.btn-khoi-phuc-luoi', function (e) {
    e.preventDefault();
    $("#edit-reset").click();
  });
})
