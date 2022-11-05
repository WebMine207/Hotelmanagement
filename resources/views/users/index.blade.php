@extends('layouts.layout')
@section('title','Users')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header align-items-center">
                        <h1 class="card-title">Users</h1>
                        <a href="{{ route('users.create') }}" class="btn btn-primary float-right">Add User</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="users-datatable">
                            <thead>
                            <tr>
                                <th style="width: 20%">
                                    Name
                                </th>
                                <th style="width: 30%">
                                    Email
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 20%">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-user-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this user ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <form action="" method="post" id="delete_urlLink">
                        @method('delete')
                        @csrf
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>
<!-- /.content -->

@endsection
@section('script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        const users_list = "{{ route('users.lists') }}",users_update_status="{{ route('users.update_status') }}";
        $('#users-datatable').DataTable({
            columns: [

                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status',searchable:false },
                { data: "action", "name": "action" , "className": "text-center",searchable:false,sortable:false},

            ],
            processing: true,
            serverSide: true,
            responsive: true,
            "autoWidth": false,
            ajax: {
                url:users_list,
                type:'post',
            },
            order:[],
            columnDefs: [{
                    "targets": [0],
                    "searchable": true,
                    "bSortable": true
                },
            ]

        });

        $(document.body).on('click', '.update_status', function(event) {
            var id = ($(this).val());
            if ($(this).is(":checked")) {
                var status = 1;
            } else if ($(this).is(":not(:checked)")) {
                var status = 2;
            }
            $.ajax({
                type: 'POST',
                url: users_update_status,
                dataType: 'json',
                data: { _token: _token, id: id, status: status },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });


        $(document).on('click', 'a.button_user_delete', function() {
            // e.preventDefault();
            var url = $(this).data('url');
            $("#modal-user-delete").modal("show");

            $("#delete_urlLink").attr("action", url);
        });
    </script>

@endsection
