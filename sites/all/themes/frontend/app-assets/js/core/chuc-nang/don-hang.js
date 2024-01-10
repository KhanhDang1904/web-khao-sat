$(document).ready(function () {
  let scroll = 0;
  $(window).scroll(function (event) {
    scroll = $(window).scrollTop();
  });
  setInterval(function () {
    $("#views-exposed-form-danh-sach-noi-dung-page-view-don-hang #edit-submit-danh-sach-noi-dung").click()
  },5000)
  setInterval(function () {
    var dt = new Date();
    if (dt.getMinutes() < 10) {
      time = dt.getHours() + ":0" + dt.getMinutes();
    } else
      time = dt.getHours() + ":" + dt.getMinutes();
    $(".block-time").text(time)
  }, 1000)
  setInterval(function () {
    if ($("#customSwitch111").prop("checked")) {
      if (scroll >= parseInt($(".fix-scoll").height()) - parseInt($(window).height()) + 100) {
        $('html, body').animate({scrollTop: 0}, 500)
        scroll = 0
      } else {
        scroll += 30;
        $('html, body').animate({scrollTop: scroll}, 1000);
      }
    }
  }, 5000)

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
        if ($(".block-row-new .load_cuoc_select").length > 0) {
          $(".block-row-new .load_cuoc_select").each(function () {
            var $this = $(this);
            if (!$this.hasClass('select2-done')) {
              $this.select2({
                dropdownParent: $this.parent()
              }).addClass('select2-done');
            }
          });
        }
        var sum = 0;
        $(".total_price").each(function () {
          if ($(this).html() != "") {
            total = parseInt($(this).html().replaceAll(',', ''));
            sum = parseInt(sum) + total
          }
        })
        $("#field_tong_tien_form").val(sum)
        if ($("input:checked.input-thanh-toan").val() == "Chưa thanh toán") {
          $("#field_khach_tra_form").val(0).prop("readonly", true)
        }
        if ($("input:checked.input-thanh-toan").val() == "Thanh toán một phần") {
          $("#field_khach_tra_form").val(0).prop("readonly", false)
        }
        if ($("input:checked.input-thanh-toan").val() == "Đã thanh toán") {
          $("#field_khach_tra_form").val($("#field_tong_tien_form").val()).prop("readonly", true)
        }
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
  $(document).on('change', '.load_cuoc_select', function (e) {
    $elm = $(this)
    $.ajax({
      url: '/get-cuoc-dan',
      dataType: 'json',
      data: {
        token: $("#tokenbody").val(),
        id: $(this).val(),
      },
      type: 'post',
      beforeSend: function () {
        blockForm($('#form-don-hang'))
      },
      success: function (data) {
        $elm.parent().parent().find('.total_price').html(data.field_gia)
        $elm.parent().parent().find('.total_price_input').val(data.field_gia.replaceAll(',', ''))
        $elm.parent().parent().find('.block_total_price').removeClass('hidden')
        $elm.parent().parent().find('.ten_san_pham').val(data.field_ten_san_pham)
        var sum = 0;
        $(".total_price").each(function () {
          if ($(this).html() != "") {
            total = parseInt($(this).html().replaceAll(',', ''));
            sum = parseInt(sum) + total
          }
        })
        $("#field_tong_tien_form").val(sum)

        if ($("input:checked.input-thanh-toan").val() == "Chưa thanh toán") {
          $("#field_khach_tra_form").val(0).prop("readonly", true)
        }
        if ($("input:checked.input-thanh-toan").val() == "Thanh toán một phần") {
          $("#field_khach_tra_form").val(0).prop("readonly", false)
        }
        if ($("input:checked.input-thanh-toan").val() == "Đã thanh toán") {
          $("#field_khach_tra_form").val($("#field_tong_tien_form").val()).prop("readonly", true)
        }
      },
      complete: function () {
        unblockPage();
        loadNumerical()
      },
      error: function (r1, r2) {
        getToastError(r1);
      }
    })
  })
  $(document).on('click', '#btn-them-moi', function (e) {
    e.preventDefault();
    $("#modal-don-hang").modal('show');
    $('#form-don-hang')[0].reset();
    $("#title-modal-dong-hang").text('Thêm đơn hàng');
    $("#field_khach_hang_id_form").html("").prop('disabled', false)
    $("#list_image").html("")
    $html = $(".block-row").html()
    $("#listbody").html('<tr class="block-row hidden">' + $html + '</tr>')
    loadDate()
    loadNumerical()
    loadSelect2Ajax()
  });
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
  $(document).on('click', '.btn-sua', function (e) {
    $html = $(".block-row").html()
    e.preventDefault();
    $.ajax({
      url: '/load-don-hang',
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
        $("#modal-don-hang").modal('show');
        $('#form-don-hang')[0].reset();
        $("#title-modal-don-hang").text('Cập nhật đơn hàng');
        $("#field_khach_hang_id_form").html("<option  value='" + data.field_khach_hang_form + "'>" + data.field_khach_hang_form + "</option>").prop('disabled', true)
        loadDataValue(data, '#form-don-hang')
        $("#field_khach_hang_form").val(data.field_khach_hang_form)
        $("#list_image").html(data.list_image)
        $("#list_image").html(data.list_image)
        $("#listbody").html(data.listbody)
        $("#listbody").append('<tr class="block-row hidden">' + $html + '</tr>')
        $("input[value='" + data.field_trang_thanh_toan + "'].input-thanh-toan").prop("checked", true)
        $("input[value='" + data.field_trang_thai_form + "'].input_field_trang_thai").prop("checked", true)
        loadNumerical()
        loadIcon()
        if ($(".block-row-new .load_cuoc_select").length > 0) {
          $(".block-row-new .load_cuoc_select").each(function () {
            var $this = $(this);
            if (!$this.hasClass('select2-done')) {
              $this.select2({
                dropdownParent: $this.parent()
              }).addClass('select2-done');
            }
          });
        }
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

  });
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
  $(document).on('click', '.btn-remove-row', function (e) {
    getToastSuccess("Xóa dòng thành công")
    $(this).parent().parent().remove()
    if ($(".block-row-new").length > 0) {
      $(".block-row-new").each(function (key, value) {
        $(".block-row-new").each(function (key, value) {
          $(this).find('input[name="anh_truoc[]"]').attr("name", "anh_truoc[" + key + "]")
          $(this).find('input[name="anh_sau[]"]').attr("name", "anh_sau[" + key + "]")
          $(this).find('input[name="anh_sau_text[]"]').attr("name", "anh_sau_text[" + key + "]")
          $(this).find('input[name="anh_truoc_text[]"]').attr("name", "anh_truoc_text[" + key + "]")
          $(this).find('input[name="price[]"]').attr("name", "price[" + key + "]")
          $(this).find('input[name="trang_thai[]"]').attr("name", "trang_thai[" + key + "]")
          $(this).find('input[name="ten_vot[]"]').attr("name", "ten_vot[" + key + "]")
          $(this).find('input[name="tinh_trang[]"]').attr("name", "tinh_trang[" + key + "]")
          $(this).find('input[name="loai_cuoc[]"]').attr("name", "loai_cuoc[" + key + "]")
          $(this).find('input[name="muc_cang[]"]').attr("name", "muc_cang[" + key + "]")
          $(this).find('select[name="don_vi[]"]').attr("name", "don_vi[" + key + "]")
          $(this).find('select[name="id[]"]').attr("name", "id[" + key + "]")
          $(this).find('textarea[name="yeu_cau_khac[]"]').attr("name", "yeu_cau_khac[" + key + "]")
        })
      })
    }
  })
  $(document).on('change', '.input-thanh-toan', function (e) {
    if ($(this).val() == "Chưa thanh toán") {
      $("#field_khach_tra_form").val(0).prop("readonly", true)
    }
    if ($(this).val() == "Thanh toán một phần") {
      $("#field_khach_tra_form").val(0).prop("readonly", false)
    }
    if ($(this).val() == "Đã thanh toán") {
      $("#field_khach_tra_form").val($("#field_tong_tien_form").val()).prop("readonly", true)
    }
  })
  $(document).on('click', '.btn-them-row', function (e) {
    e.preventDefault()
    getToastSuccess("Thêm dòng thành công")
    $("#danh_sach_vot tbody").append("<tr class='block-row-new'>" + $(".block-row").html() + "</tr>")
    if ($(".block-row-new .load_cuoc_select").length > 0) {
      $(".block-row-new .load_cuoc_select").each(function () {
        var $this = $(this);
        if (!$this.hasClass('select2-done')) {
          $this.select2({
            dropdownParent: $this.parent()
          }).addClass('select2-done');
        }
      });
    }
    if ($(".block-row-new").length > 0) {
      $(".block-row-new").each(function (key, value) {
        $(".block-row-new").each(function (key, value) {
          $(this).find('input[name="anh_sau_text[]"]').attr("name", "anh_sau_text[" + key + "]")
          $(this).find('input[name="anh_truoc_text[]"]').attr("name", "anh_truoc_text[" + key + "]")
          $(this).find('input[name="anh_truoc[]"]').attr("name", "anh_truoc[" + key + "]")
          $(this).find('input[name="anh_sau[]"]').attr("name", "anh_sau[" + key + "]")
          $(this).find('input[name="price[]"]').attr("name", "price[" + key + "]")
          $(this).find('input[name="trang_thai[]"]').attr("name", "trang_thai[" + key + "]")
          $(this).find('input[name="ten_vot[]"]').attr("name", "ten_vot[" + key + "]")
          $(this).find('input[name="tinh_trang[]"]').attr("name", "tinh_trang[" + key + "]")
          $(this).find('input[name="loai_cuoc[]"]').attr("name", "loai_cuoc[" + key + "]")
          $(this).find('input[name="muc_cang[]"]').attr("name", "muc_cang[" + key + "]")
          $(this).find('select[name="don_vi[]"]').attr("name", "don_vi[" + key + "]")
          $(this).find('select[name="id[]"]').attr("name", "id[" + key + "]")
          $(this).find('textarea[name="yeu_cau_khac[]"]').attr("name", "yeu_cau_khac[" + key + "]")
        })
      })
    }
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
  $(document).on('click', '.btn-save', function (e) {
    $html = $(".block-row").html()
    $(".block-row").html("")
    e.preventDefault();
    $.ajax({
      url: '/save-don-hang',
      data: new FormData(document.getElementById("form-don-hang")),
      dataType: 'json',
      type: 'POST',
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      beforeSend: function () {
        blockForm($('#form-don-hang'))
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
        $(".block-row").html($html)
        getToastError(r1);
        unblockPage();
      }
    });
  });
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
    $("h2.brand-text").text('ĐƠN HÀNG');
  }, 500)
  $(document).on('click', '.btn-xoa', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Xác nhận xóa đơn hàng',
      text: "Bạn có chắc chắn khi thực hiện thao tác này không !",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/xoa-don-hang',
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
