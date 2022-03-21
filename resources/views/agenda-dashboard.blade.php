@extends('layouts.master')

@section('konten')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
        <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-xl-12 p-0">
                <div class="jumbotron min-vh-100 m-0 d-flex flex-column">
                    <div class="row d-flex  my-auto" >
                        <div class="container my-4">
                            <h1 class="text-center fw-bold">AGENDA LIST DISKOMINFO KARANGANYAR</h1>
                        </div>

                        <div class="col-4 border my-2 mx-2 py-2 py-3" style="text-align: left">
                            <div class="form-group">
                                <label for="bidang_filter" class="control-label fw bolder">Agenda</label>
                                <select  name="bidang_filter" id="bidang_filter" class="form-select" aria-label="Default select example">
                                    <option value="">Semua</option>
                                    <option value="1">Kepala Diskominfo</option>
                                    <option value="2">Sekretariat Diskominfo</option>
                                    <option value="3">Bidang Tata Kelola Informatika</option>
                                    <option value="4">Bidang Informasi dan Komunikasi Publik</option>
                                  </select>
                            </div>
                        </div>

                        @if(session('status'))
                        <div class="alert alert-success">
                        {{ session('status') }}
                        </div>
                        @endif
                        {{-- <div class="col-12"> --}}



                            {{-- <div class="row justify-content-center"> --}}

                                {{-- <div class="col-auto"> --}}
                                    <div class="col-12 mb-4 text-left">
                                        <a class="btn btn-primary" href="javascript:void(0)" id="createNewAgenda">Buat Baru</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped" id="table-agenda">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    {{-- <th>No Disposisi</th> --}}
                                                    <th>Bidang</th>
                                                    <th>Jam Agenda</th>
                                                    <th>Tanggal Agenda</th>
                                                    <th>Isi</th>
                                                    <th>Tempat</th>
                                                    <th>Keterangan</th>
                                                    <th>Disposisi</th>
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
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                {{-- </div> --}}
                              {{-- </div> --}}



                            <div class="modal fade" id="ajaxEdit" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modelHeading"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="agendaEditForm" name="agendaEditForm" class="form-horizontal">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Disposisi id</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="disposisis_id" name="disposisis_id" placeholder="Masukan ID Disposisi" value="" maxlength="50" required="" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="bidangs_id" class="col-sm-2 control-label">Kepada</label>
                                                <select  name="bidangs_id" id="bidangs_id" class="form-select" aria-label="Default select example">
                                                    <option value="1">Kepala Diskominfo</option>
                                                    <option value="2">Sekretariat Diskominfo</option>
                                                    <option value="3">Bidang Tata Kelola Informatika</option>
                                                    <option value="4">Bidang Informasi dan Komunikasi Publik</option>
                                                  </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jam_agenda" class="col-sm-2 control-label">Jam Agenda</label>
                                                <div class="col-sm-12">
                                                    <input type="time" class="form-control" id="jam_agenda" name="jam_agenda" placeholder="Jam Agenda" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_agenda" class="col-sm-2 control-label">Tanggal Agenda</label>
                                                <div class="col-sm-12">
                                                    <input type="date" class="form-control" id="tanggal_agenda" name="tanggal_agenda" placeholder="Tanggal Agenda" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="isi" class="col-sm-2 control-label">Isi</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="isi" name="isi" placeholder="Isi Agenda" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Tempat</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Agenda" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Agenda" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disposisi" class="col-sm-2 control-label">Disposisi</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="disposisi" name="disposisi" placeholder="Disposisi" value="" maxlength="50" required="">
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

                            {{-- Create New --}}
                            <div class="modal fade" id="ajaxCreate" aria-hidden="true" >
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modelHeading"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('store-disposisi-user2')}}" id="agendaCreateForm" name="agendaCreateForm" class="form-horizontal" enctype="multipart/form-data" method="post" >
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label">Disposisi id</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="disposisis_id" name="disposisis_id" placeholder="Masukan ID Disposisi" value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bidangs_id" class="col-sm-2 control-label">Kepada</label>
                                                    <select  name="bidangs_id" id="bidangs_id" class="form-select" aria-label="Default select example">
                                                        <option value="1">Kepala Diskominfo</option>
                                                        <option value="2">Sekretariat Diskominfo</option>
                                                        <option value="3">Bidang Tata Kelola Informatika</option>
                                                        <option value="4">Bidang Informasi dan Komunikasi Publik</option>
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_agenda" class="col-sm-2 control-label">Jam Agenda</label>
                                                    <div class="col-sm-12">
                                                        <input type="time" class="form-control" id="jam_agenda" name="jam_agenda" placeholder="Jam Agenda" value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_agenda" class="col-sm-2 control-label">Tanggal Agenda</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="tanggal_agenda" name="tanggal_agenda" placeholder="Tanggal Agenda" value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="isi" class="col-sm-2 control-label">Isi</label>
                                                    <div class="col-sm-12">
                                                        <textarea name="isi" id="isi" placeholder="Isi Agenda" class="col-sm-12"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Tempat</label>
                                                    <div class="col-sm-12">
                                                        <input type="dtext" class="form-control" id="tempat" name="tempat" placeholder="Tempat Agenda" value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Agenda" value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="disposisi" class="col-sm-2 control-label">Disposisi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="disposisi" name="disposisi" placeholder="Disposisi" value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-10"><p id="saveError"></p></div>
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary" id="saveBtnCreate" value="create">Simpan</button>
                                                </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
        var table = $('#table-agenda').DataTable({
            lengthMenu: [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Semua"]],
            dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv', 'print'
                ],
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('agenda-dashboard.index') }}",
            data: function (d) {
                    d.bidang_filter = $('#bidang_filter').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            order: [ [0, 'desc'] ],
            columns : [
                {data: 'id', name: 'id'},
                // {data: 'disposisis.no_agenda', name: 'disposisis.no_agenda'},
                {data: 'bidang.name', name: 'bidang.name'},
                {data: 'jam_agenda', name: 'jam_agenda'},
                {data: 'tanggal_agenda', name: 'tanggal_agenda'},
                {data: 'isi', name: 'isi'},
                {data: 'tempat', name: 'tempat'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'disposisi', name: 'disposisi'},
                {data: 'action', name: 'action'},
            ],
            'columnDefs': [ {
            'targets': [2,4,8], /* column index */
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

        $('#bidang_filter').change(function(){
        table.draw();
    });



        $('#createNewAgenda').click(function () {
            $('#saveBtnCreate').val("create-agenda");
            $('#id').val('');
            $('#agendaCreateForm').trigger("reset");
            $('#modelHeading').html("Buat Disposisi");
            $('#ajaxCreate').modal('show');
        });


        $('#saveBtnCreate').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#agendaCreateForm').serialize(),
                url: "{{ route('agenda-dashboard.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#agendaCreateForm').trigger("reset");
                    $('#ajaxCreate').modal('hide');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveError').html('Error', error);
                    $('#saveBtnCreate').html('Save Changes');
                }

            });
        });



        $('body').on('click', '.editAgenda', function () {
            var agendas_id = $(this).data('id');
            $.get("{{ route('agenda-dashboard.index') }}" +'/' + agendas_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Agenda");
            $('#saveBtnEdit').val("edit-user");
            $('#ajaxEdit').modal('show');
            $('#id').val(data.id);
            $('#disposisis_id').val(data.disposisis_id);
            $('#bidangs_id').val(data.bidangs_id);
            $('#jam_agenda').val(data.jam_agenda);
            $('#tanggal_agenda').val(data.tanggal_agenda);
            $('#isi').val(data.isi);
            $('#tempat').val(data.tempat);
            $('#keterangan').val(data.keterangan);
            $('#disposisi').val(data.disposisi);
            })
        });
        $('#saveBtnEdit').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#agendaEditForm').serialize(),
                url: "{{ route('agenda-dashboard.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#agendaEditForm').trigger("reset");
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


        $('body').on('click', '.deleteAgenda', function (){
            var agenda_id = $(this).data("id");
            var result = confirm("Anda Yakin Ingin Menghapus Data !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('agenda-dashboard.store') }}"+'/'+agenda_id,
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

