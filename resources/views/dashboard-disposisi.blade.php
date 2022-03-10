
    @extends('layouts.master')
    @section('konten')

    <div class="container my-4">
        <h1 class="text-center fw-bold">DISPOSISI LIST DISKOMINFO KABUPATEN KARANGANYAR</h1>
    </div>


    @if(session('status'))
    <div class="alert alert-success">
    {{ session('status') }}
    </div>
    @endif

        <div class="col-md-12 mb-4 text-left">
            <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">Buat Baru</a>
        </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped" id="table-disposisi">
                    <thead>
                        <tr>
                            <th>Surat</th>
                            <th>ID</th>
                            <th>Dari</th>
                            <th>Tanggal Dibuat</th>
                            <th>No Surat</th>
                            <th>Isi Surat</th>
                            <th>No Agenda</th>
                            <th>Tanggal Diterima</th>
                            <th>Kepada</th>
                            <th>Status</th>
                            <th>User</th>
                            <th>Disposisi</th>
                            <th>Edit</th>
                            <th>Hapus</th>
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
            </div>



        <div class="modal fade" id="ajaxEdit" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="disposisiEditForm" name="disposisiEditForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="users_id" id="users_id">
                        <input type="hidden" name="filename" id="filename">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">No Surat</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Masukan No Surat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dari" class="col-sm-2 control-label">Surat Dari</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="dari" name="dari" placeholder="Surat Dari" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_dibuat" class="col-sm-2 control-label">Tanggal Dibuat</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="Tanggal Dibuat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_diterima" class="col-sm-2 control-label">Tanggal Diterima</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" placeholder="Tanggal Diterima" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Isi Surat</label>
                            <div class="col-sm-12">
                                <textarea id="isi_surat" name="isi_surat" required="" placeholder="Isi Surat" class="form-control" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_agenda" class="col-sm-2 control-label">Nomor Agenda</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_agenda" name="no_agenda" placeholder="Nomor Agenda" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kepada" class="col-sm-2 control-label">Surat Kepada</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Surat Kepada" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_id" class="col-sm-2 control-label">Status</label>
                            <select  name="status_id" id="status_id" class="form-select" aria-label="Default select example">
                                <option value="1">Diterima</option>
                                <option value="2">Ditolak</option>
                                <option value="3">Diproses</option>
                              </select>
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

        {{-- Create New --}}
        <div class="modal fade" id="ajaxCreate" aria-hidden="true" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('store-disposisi-user2')}}" id="disposisiCreateForm" name="disposisiCreateForm" class="form-horizontal" enctype="multipart/form-data" method="post" >
                            @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="users_id" id="users_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">No Surat</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Masukan No Surat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dari" class="col-sm-2 control-label">Surat Dari</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="dari" name="dari" placeholder="Surat Dari" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_dibuat" class="col-sm-2 control-label">Tanggal Dibuat</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="Tanggal Dibuat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_diterima" class="col-sm-2 control-label">Tanggal Diterima</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" placeholder="Tanggal Diterima" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Isi Surat</label>
                            <div class="col-sm-12">
                                <textarea id="isi_surat" name="isi_surat" required="" placeholder="Isi Surat" class="form-control" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_agenda" class="col-sm-2 control-label">Nomor Agenda</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_agenda" name="no_agenda" placeholder="Nomor Agenda" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kepada" class="col-sm-2 control-label">Surat Kepada</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Surat Kepada" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label" for="filename">Upload Surat:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="filename" id="filename">
                                <p>!!PDF UKURAN MAKSIMAL 2MB</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_id" class="col-sm-2 control-label">Status</label>
                            <select  name="status_id" id="status_id" class="form-select" aria-label="Default select example">
                                <option value="1">Diterima</option>
                                <option value="2">Ditolak</option>
                                <option value="3">Diproses</option>
                              </select>
                        </div>
                        <div class="col-sm-10"><p id="saveError"></p></div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtnCreate" value="create">Simpan Perubahan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Delete Product Modal -->



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
        var table = $('#table-disposisi').DataTable({
            dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv', 'print'
                ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('disposisis.index') }}",
            order: [ [1, 'desc'] ],
            columns : [
                {data: 'action', name: 'action'},
                {data: 'id', name: 'id'},
                {data: 'dari', name: 'dari'},
                {data: 'tanggal_dibuat', name: 'tanggal_dibuat'},
                {data: 'no_surat', name: 'no_surat'},
                {data: 'isi_surat', name: 'isi_surat'},
                {data: 'no_agenda', name: 'no_agenda'},
                {data: 'tanggal_diterima', name: 'tanggal_diterima'},
                {data: 'kepada', name: 'kepada'},
                {data: 'status_id', name: 'status_id'},
                {data: 'users.name', name: 'users.name'},
                {data: 'lihatpdf', name: 'lihatpdf'},
                {data: 'edit', name: 'edit'},
                {data: 'delete', name: 'delete'},
            ],
            'columnDefs': [ {
                'targets': [0,10,11,12,13], /* column index */
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


        $('#createNewProduct').click(function () {
            $('#saveBtnCreate').val("create-product");
            $('#id').val('');
            $('#disposisiCreateForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxCreate').modal('show');
        });





        $('body').on('click', '.editDisposisi', function () {
            var disposisi_id = $(this).data('id');
            $.get("{{ route('disposisis.index') }}" +'/' + disposisi_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Disposisi");
            $('#saveBtnEdit').val("edit-user");
            $('#ajaxEdit').modal('show');
            $('#id').val(data.id);
            $('#no_surat').val(data.no_surat);
            $('#dari').val(data.dari);
            $('#tanggal_dibuat').val(data.tanggal_dibuat);
            $('#tanggal_diterima').val(data.tanggal_diterima);
            $('#isi_surat').val(data.isi_surat);
            $('#no_agenda').val(data.no_agenda);
            $('#kepada').val(data.kepada);
            $('#status_id').val(data.status_id);
            $('#users_id').val(data.users_id);
            })
        });
        $('#saveBtnEdit').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#disposisiEditForm').serialize(),
                url: "{{ route('disposisis.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#disposisiEditForm').trigger("reset");
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


        $('body').on('click', '.deleteDisposisi', function (){
            var disposisi_id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('disposisis.store') }}"+'/'+disposisi_id,
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    AOS.init();
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

@endsection
