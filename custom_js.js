

$(document).ready(function () {

    $('.js-example-basic-single').select2({
        dropdownParent: $('#myModal')
    });


    function initSelect2(selector, url, parent, data = {}) {
        $(selector).select2({
            dropdownParent: $(parent),
            width: '100%',
            ajax: {
                url: url,
                type: 'POST',
                data: function (params) {
                    return { _token: $('#token').val(), data, q: params.term };
                },
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return { id: item.id, text: item.name };
                        })
                    };
                },
                cache: true
            }
        });
    }

    initSelect2('#category_id', $('#category_id').data('action'), '#myModal');

    $('#category_id').on('change', function () {
        var categoryId = $(this).val();
        if (categoryId) {
            $('#subcategory_id').empty().append('<option value="">Select a sub category</option>');
            initSelect2('#subcategory_id', $('#subcategory_id').data('action'), '#myModal', { category_id: categoryId });
        }
    });


    var categoryId = $('#category_id').val();
    if (categoryId) {
        initSelect2('#subcategory_id', $('#subcategory_id').data('action'), '#myModal', { category_id: categoryId });
    }



    $(document).on('show.bs.modal', '#myModal', function () {
        if ($(".modal-backdrop").length > 1) {
            $(".modal-backdrop").not(':first').remove();
        }
    });
    $(document).on('hide.bs.modal', '#myModal', function () {
        if ($(".modal-backdrop").length > 1) {
            $(".modal-backdrop").remove();
        }
    });

    $('#description').summernote({
        height: 300
    });


    $("#commentForm").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            $('#description').val($('#description').summernote('code'));
            var api = $(form).attr("action");
            $.ajax({
                url: api,
                method: "POST",
                data: new FormData(form),
                dataType: 'JSON',
                beforeSend: function () {
                    $(form).find(`button[type="submit"]`).attr("disabled", true).text('Loading...');
                },
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        swal({
                            title: "Good job!",
                            text: response.result,
                            icon: "success"
                        }).then(function (isConfirm) {
                            $('#user_table').DataTable().ajax.reload();
                            $(form).find(`button[type="submit"]`).attr("disabled", false).text('Submit');
                            $(form).trigger("reset");
                            $('#myModal').modal('hide');
                        });
                    } else {
                        swal({
                            title: "Good job!",
                            text: response.result,
                            icon: "error"
                        });
                        $(form).find(`button[type="submit"]`).attr("disabled", false).text('Submit');
                    }
                },
                error: function (response) {
                    if (response.status == 422 && response.responseJSON) {
                        $.each(response.responseJSON, function (key, value) {
                            $("#" + key + "-error").text(value).show();
                        });

                        let firstKey = Object.keys(response.responseJSON)[0];

                        if (firstKey) {
                            let firstErrorField = $("#" + firstKey);

                            $('html, body').animate({
                                scrollTop: firstErrorField.parent().parent().offset().top - 100
                            }, 1000);

                            firstErrorField.focus();
                        }

                        $(form).find(`button[type="submit"]`).attr("disabled", false).text('Submit');
                    }
                }

            });

        }
    });


});
