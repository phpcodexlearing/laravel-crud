<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   

    <style>
    .error:not(.form-control) {
            color: red;
        }

    .modal-backdrop+.modal-backdrop {
        opacity: 0;
    }
    </style>
</head>

<body>

    <div class="container mt-3">
        <h3>Large Modal Example</h3>
        <p>Click on the button to open the modal.</p>

        <button type="button" class="btn btn-primary openModal" onclick="productAddEdit('{{ route('product.edit') }}')"
            data-bs-toggle="modal" data-bs-target="#myModal">
            Open modal
        </button>
    </div>

    <!-- The Modal -->
    <div class="modal_div"></div>

    <div class="container">
        <div class="table-responsive">
            <table id="user_table" class="table table-bordered table-striped" action="{{ route('product.list') }}">
                <thead>
                    <tr>
                        <th width="20%">Name</th>
                        <th width="20%">Category</th>
                        <th width="20%">SubCategory</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script src="{{ asset('js/custom_js.js') }}"></script>
    <script>
    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $('#user_table').attr("action"),
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
                data: 'title',
                name: 'title'
            },
            {
            data: 'category',
            name: 'category',
            },
            {
                data: 'subCategory',
                name: 'subCategory',
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    function productAddEdit(api) {

        $.ajax({
            url: api,
            method: "GET",
            dataType: 'JSON',

            success: function(response) {
                if (response.success == true) {
                    $(".modal_div").html(response.result);
                    $('#myModal').modal('show');
                }
            }

        });
    }

    function productView(api) {
        $.ajax({
            url: api,
            method: "GET",
            dataType: 'JSON',
            success: function(response) {
                if (response.success == true) {
                    $(".modal_div").html(response.result);
                    $('#myModalView').modal('show');
                }
            }
        });
    }


    function deleteFunction(api) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: api,
                    method: "GET",
                    dataType: 'JSON',

                    success: function(response) {
                        if (response.success == true) {
                            swal({
                                title: "Deleted!",
                                text: response.result,
                                icon: "success"
                            });
                            $('#user_table').DataTable().ajax.reload();
                        }
                    }

                });
              
            } 
        });
    }
    </script>
</body>

</html>
