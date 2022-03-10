@extends('layouts.master')

@section('konten')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
        <p>{{ $message }}</p>
        </div>
        @endif
        {{-- <div class="row">
            <div class="col-xl-12 p-0">
                <div class="jumbotron min-vh-100 m-0 d-flex flex-column justify-content-center">
                    <div class="row d-flex justify-content-center " > --}}
                        <div class="container">
                            <h1 class="text-center fw-bold">USER LIST</h1>
                        </div>

                                                    {{-- Edit Modal --}}
                                                    <div class="modal fade" id="ajaxEdit" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="modelHeading"></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="userEditForm" name="userEditForm" class="form-horizontal">
                                                                    <input type="hidden" name="id" id="id">
                                                                    <div class="form-group">
                                                                        <label for="name" class="col-sm-2 control-label">Nama</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="" maxlength="50" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" maxlength="50" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="username" class="col-sm-2 control-label">Username</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="" maxlength="50" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-10"><p id="saveError"></p></div>
                                                                    <div class="col-sm-offset-2 col-sm-10">
                                                                        <button type="submit" class="btn btn-primary" id="saveBtnEdit" value="create">Simpan Perubahan</button>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                        @if(session('status'))
                        <div class="alert alert-success">
                        {{ session('status') }}
                        </div>
                        @endif
                        {{-- <div class="table-responsive col-12"> --}}




                                <div class="table-responsive">

                                    <table class="table table-hover table-bordered table-striped " id="table-user">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Registration</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>





                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#table-user').DataTable({
            dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv', 'print'
                ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('users-dashboard.index') }}",
            order: [ [0, 'asc'] ],
            columns : [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'username', name: 'username'},
                {data: 'roles', name: 'roles'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ],
            'columnDefs': [ {
            'targets': [5], /* column index */
            'orderable': false, /* true or false */
             }],
            initComplete: function () {
            this.api().columns().every(function () {
            var column = this;
            var input = document.createElement("input");
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
            });
        }
        });





        $('body').on('click', '.editUser', function () {
            var users_id = $(this).data('id');
            $.get("{{ route('users-dashboard.index') }}" +'/' + users_id +'/edit', function (data) {
            $('#modelHeading').html("Edit User");
            $('#saveBtnEdit').val("edit-user");
            $('#ajaxEdit').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#username').val(data.username);
            })
        });
        $('#saveBtnEdit').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#userEditForm').serialize(),
                url: "{{ route('users-dashboard.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#userEditForm').trigger("reset");
                    $('#ajaxEdit').modal('hide');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveError').html('Error', data);
                    $('#saveBtnEdit').html('Simpan Perubahan');
                }
            });
        });


        $('body').on('click', '.deleteUser', function (){
            var users_id = $(this).data("id");
            var result = confirm("Anda Yakin Ingin Menghapus Data !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('users-dashboard.store') }}"+'/'+users_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }else{
                return false;
            }
        });

    });
</script>
@endsection

