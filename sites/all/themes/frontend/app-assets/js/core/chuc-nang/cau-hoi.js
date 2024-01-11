$(document).ready(function () {
  $(document).on('click', '#btn-them-moi', function (e) {
    e.preventDefault();
    $("#modal-cau-hoi").modal('show');
    $('#form-cau-hoi')[0].reset();
    $("#title-modal-cau-hoi").text('Thêm danh sách câu hỏi');
    $(".block-cau-hoi").html(`<tr>
      <td >
        <div class="row">
          <div class="col-md-8 col-12 mb-1 mb-md-0">
            <label class="form-label">Câu hỏi 1</label>
            <input type="text" class="form-control" name="cau_hoi[]" placeholder="Câu hỏi"
                   aria-describedby="button-addon2"/>
          </div>
          <div class="col-md-2 col-6">
            <label class="form-label">Yêu cầu</label>
            <select name="bat_buoc[]" class="form-select ">
              <option value="1">Bắt buộc</option>
              <option value="0">Không bắt buộc</option>
            </select>
          </div>
          <div class="col-md-2 col-6">
            <label class="form-label">Loại</label>
            <select name="type[]" class="form-select ">
              <option value="1">Đúng/Sai</option>
              <option value="0">Văn bản</option>
            </select>
          </div>
        </div>
      </td>
      <td width="1%" class="text-center">
        <a class=" btn-xoa-dong " type="button"><i data-feather='trash-2' class="text-danger"></i></a>
      </td>
    </tr>`)
    loadIcon()
  });
  $(document).on('click', '.btn-save', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/save-cau-hoi',
      data:$("#form-cau-hoi").serializeArray() ,
      dataType: 'json',
      type: 'POST',
      beforeSend: function () {
        blockForm($('#form-cau-hoi'))
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
  });
  $(document).on('click', '#price_1', function (e) {
    $(this).parent().append(`
      <input class="hidden" name="field_gia_value_1[min]" value="` + $(this).attr('data-min') + `">
      <input class="hidden" name="field_gia_value_1[max]" value="` + $(this).attr('data-max') + `">
    `)
  })
  $(document).on('change', '#sort_page', function (e) {
    if ($(this).val() === "") {
      window.location.href = '/view-san-pham'
    } else {
      $(".sort_by_page").val($("#sort_page option:selected").attr('data-value'))
      $(".sort_order_page").val($(this).val())
      $(this).parent().find('button').click()
    }

  })
  $(document).on('click', '.btn-sort', function (e) {
    $("#sort_bys").val($(this).attr('data-value'))
    $("#sort_orders").val($(this).attr('data-sort'))
    $(".btn-tim-kiem").click()
  })
  $(document).on('click', '.btn-sua', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-cau-hoi',
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
        $("#modal-cau-hoi").modal('show');
        $('#form-cau-hoi')[0].reset();
        $("#title-modal-cau-hoi").text('Cập nhật câu hỏi');
        loadDataValue(data, '#form-cau-hoi')
        $(".block-cau-hoi").html(data.block_cau_hoi)
        loadIcon()
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        $(".block-row").html($html)
        getToastError(r1);
      }
    })

  });
  $(document).on('change', '.btn-active', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/active',
      dataType: 'json',
      data: {
        token: $("#tokenbody").val(),
        id: $(this).attr('data-value'),
        value: $(this).val(),
      },
      type: 'post',
      beforeSend: function () {
        blockPage();
      },
      success: function (data) {
        getToastSuccess(data.content);
        setTimeout(function (){
          location.reload()
        },500)
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })

  });

  function convertYMD($str) {
    var arrStr = $str.split('T');
    return arrStr[0];
  }

  function loadDate() {
    if ($(".flatpickr-basic").length > 0) {
      $('.flatpickr-basic').each(function () {
        $(this).flatpickr(
          {
            static: true,
          }
        )
      })
    }
  }

  function resetForm() {
    $('#edit-reset').click()
  }

  $(document).on('click', '.btn-in', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-mau-in',
      data: {id: $(this).attr('data-value'), token: $("#tokenbody").val()},
      dataType: 'json',
      type: 'post',
      beforeSend: function () {
        blockPage();
      },
      success: function (data) {
        $(".print-block").html('<style></style>');
        $(".print-block").append(data).printArea();
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })
    $("#modal-xem-thu-chi").printArea();
  });
  $(document).on('change', '#field_khach_hang_id_form', function (e) {
    $html = $(".block-row").html()
    $(".block-row").html("")
    $.ajax({
      url: '/load-khach-hang',
      dataType: 'json',
      data: {
        token: $("#tokenbody").val(),
        id: $(this).val(),
        name: $("#field_khach_hang_form").val(),
      },
      type: 'post',
      beforeSend: function () {
        blockForm($('#form-don-hang'))
      },
      success: function (data) {
        loadDataValue(data, '#form-don-hang')
        $("#list_image").html(data.list_image)
        $("#listbody").html(data.listbody)
        $("#listbody").append('<tr class="block-row hidden">' + $html + '</tr>')
        loadNumerical()
      },
      complete: function () {

        unblockPage();
        loadDate()
      },
      error: function (r1, r2) {
        $(".block-row").html($html)
        getToastError(r1);
      }
    })
  })

  $(document).on('click', '.btn-luu-mau-in', function (e) {
    $.ajax({
      url: '/save-mau-in',
      data: {
        token: $("#tokenbody").val(),
        content: CKEDITOR.instances['editor'].getData()
      },
      dataType: 'json',
      type: 'post',
      beforeSend: function () {
        blockPage();
      },
      success: function (data) {
        getToastSuccess(data.content);
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        unblockPage();
        getToastError(r1);
      }
    })
  })
  $(document).on('click', '.btn-cap-nhat-trang-thai-thanh-toan', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-trang-thai',
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
        $("#modal-don-hang-trang-thai-thanh-toan").modal('show');
        $('#form-don-hang-trang-thai-thanh-toan')[0].reset();
        $("#title-modal-don-hang-trang-thai-thanh-toan").text('Cập nhật trạng thái thanh toan');
        loadDataValue(data, '#form-don-hang-trang-thai-thanh-toan')
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
  $(document).on('click', '.btn-cap-nhat-trang-thai', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/load-trang-thai',
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
        $("#modal-don-hang-trang-thai").modal('show');
        $('#form-don-hang-trang-thai')[0].reset();
        $("#title-modal-don-hang-trang-thai").text('Cập nhật trạng thái');
        loadDataValue(data, '#form-don-hang-trang-thai')
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
        $('.field_ngay_sinh_thanh_lap').val(data.user.field_ngay_sinh_thanh_lap == '' ? '' : convertYMD(data.user.field_ngay_sinh_thanh_lap));
        $.each(data.role, function (key, value) {
          $('.field-role').append('' +
            '<div class="form-check form-check-inline">\n' +
            '    <input class="form-check-input" type="checkbox" id="inlineCheckbox2' + key + '" name="field_role[]" value="' + value.rid + '" />\n' +
            '     <label class="form-check-label" for="inlineCheckbox2' + key + '">' + value.name + '</label>\n' +
            '</div>' +
            '');
        })
        $.each(data.user.roles, function (key, value) {
          $('.form-check input[value=' + key + ']').attr('checked', true)
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
  $(document).on('click', '.btn-xoa-dong', function (e) {
    getToastSuccess("Xóa dòng thành công")
    $(this).parent().parent().remove()
  })
  $(document).on('click', '.btn-add-row', function (e) {
    getToastSuccess("Thêm dòng thành công")
    $sttCauHoi = parseInt($(".block-cau-hoi tr").length)+1 ;
    $(".block-cau-hoi").append(`
    <tr>
      <td >
        <div class="row">
          <div class="col-md-8 col-12 mb-1 mb-md-0">
            <label class="form-label">Câu hỏi `+$sttCauHoi+`</label>
            <input type="text" class="form-control" name="cau_hoi[]" placeholder="Câu hỏi"
                   aria-describedby="button-addon2"/>
          </div>
          <div class="col-md-2 col-6">
            <label class="form-label">Yêu cầu</label>
            <select name="bat_buoc[]" class="form-select ">
              <option value="1">Bắt buộc</option>
              <option value="0">Không bắt buộc</option>
            </select>
          </div>
          <div class="col-md-2 col-6">
            <label class="form-label">Loại</label>
            <select name="type[]" class="form-select ">
              <option value="1">Đúng/Sai</option>
              <option value="0">Văn bản</option>
            </select>
          </div>
        </div>
      </td>
      <td width="1%" class="text-center">
        <a class=" btn-xoa-dong " type="button"><i data-feather='trash-2' class="text-danger"></i></a>
      </td>
    </tr>`)
    loadIcon()
  })
  $(document).on('click', '.btn-xem', function (e) {
    var ID = $(this).attr("data-value");
    $("#modal-xem-don-hang").modal("show");
    getTableModal('/xem-don-hang', {
      token: $("#tokenbody").val(),
      nid: ID
    }, "#table-trang-thai", [
      getDataColumn('index', "class='text-center' width='1%'"),
      getDataColumn('field_ngay_nhap', "class='text-center' width='1%'"),
      getDataColumn('field_trang_thai'),
    ])
  })
  $(document).on('click', '.btn-save-trang-thai', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/save-trang-thai',
      data: new FormData(document.getElementById("form-don-hang-trang-thai")),
      dataType: 'json',
      type: 'POST',
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      beforeSend: function () {
        blockForm($('#form-don-hang-trang-thai'))
      },
      success: function (data) {
        getToastSuccess(data.content);
        setTimeout(function () {
          location.reload()
        })
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
        unblockPage();
      }
    });
  });
  $(document).on('click', '.btn-save-trang-thai-thanh-toan', function (e) {
    e.preventDefault();
    $.ajax({
      url: '/save-trang-thai-thanh-toan',
      data: new FormData(document.getElementById("form-don-hang-trang-thai-thanh-toan")),
      dataType: 'json',
      type: 'POST',
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      beforeSend: function () {
        blockForm($('#form-don-hang-trang-thai-thanh-toan'))
      },
      success: function (data) {
        getToastSuccess(data.content);
        setTimeout(function () {
          location.reload()
        })
      },
      complete: function () {
        unblockPage();
      },
      error: function (r1, r2) {
        getToastError(r1);
        unblockPage();
      }
    });
  });
  setTimeout(function () {
    $("h2.brand-text").text('SẢN PHẨM');
  }, 500)
  $(document).on('click', '.btn-xoa', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Xác nhận xóa danh sách câu hỏi',
      text: "Bạn có chắc chắn khi thực hiện thao tác này không !",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/xoa-node',
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
            setTimeout(function () {
              location.reload();
            }, 1000)
          },
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
