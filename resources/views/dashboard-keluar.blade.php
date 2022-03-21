
    @extends('layouts.master')
    @section('konten')

    <div class="container my-4">
        <h1 class="text-center fw-bold">SURAT KELUAR LIST DISKOMINFO KABUPATEN KARANGANYAR</h1>

        @if(session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
        @endif
    </div>


    <div class="col-4 border my-2 mx-2 py-2 py-3">
        <div class="form-group">
            <label for="bidang_filter" class="control-label fw bolder">Pengolah</label>
            <select  name="bidang_filter" id="bidang_filter" class="form-select" aria-label="Default select example">
                <option value="">Semua</option>
                <option value="2">Sekretariat Diskominfo</option>
                <option value="3">Bidang Tata Kelola Informatika</option>
                <option value="4">Bidang Informasi dan Komunikasi Publik</option>
              </select>
        </div>
    </div>




            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped" id="table-keluar">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Kepada</th>
                            <th>Pengolah Surat</th>
                            <th>Ringkasan Isi Surat</th>
                            <th>Sifat Surat</th>
                            <th>Jenis Surat</th>
                            <th>Lihat Surat</th>
                            <th>User</th>
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
                            <label for="surats_id" class="col-sm-2 control-label">Jenis Surat</label>
                            <select  name="surats_id" id="surats_id" class="form-select col-sm-12" aria-label="Default select example">
                                <option value="1">Surat Keputusan</option>
                                <option value="2">Surat Undangan</option>
                                <option value="3">Surat Permohonan</option>
                                <option value="4">Surat Pemberitahuan</option>
                                <option value="5">Surat Peminjaman</option>
                                <option value="6">Surat Pernyataan</option>
                                <option value="7">Surat Mandat</option>
                                <option value="8">Surat Tugas</option>
                                <option value="9">Surat Keterangan</option>
                                <option value="10">Surat Rekomendasi</option>
                                <option value="11">Surat Balasan</option>
                                <option value="12">Surat Perintah Perjalanan Dinas</option>
                                <option value="13">Sertifikat</option>
                                <option value="14">Perjanjian Kerja</option>
                                <option value="15">Surat Pengantar</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="no_surat" class="col-sm-2 control-label">No Surat</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sifat" class="col-sm-2 control-label">Sifat</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="sifat" name="sifat" placeholder="Sifat Surat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_surat" class="col-sm-2 control-label">Tanggal Surat</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kepada" class="col-sm-2 control-label">Kepada</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Kepada" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-10 bg-danger"><p id="saveError"></p></div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtnEdit" value="create">Simpan Perubahan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Create New
        <div class="modal fade" id="ajaxCreate" aria-hidden="true" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form  id="disposisiCreateForm" name="disposisiCreateForm" class="form-horizontal" action="{{url('store-disposisi-user2')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="users_id" id="users_id">
                        <div class="form-group">
                            <label for="surats_id" class="col-sm-2 control-label">Jenis Surat</label>
                            <select  name="surats_id" id="surats_id" class="form-select" aria-label="Default select example">
                                <option value="1">Surat Keputusan</option>
                                <option value="2">Surat Undangan</option>
                                <option value="3">Surat Permohonan</option>
                                <option value="4">Surat Pemberitahuan</option>
                                <option value="5">Surat Peminjaman</option>
                                <option value="6">Surat Pernyataan</option>
                                <option value="7">Surat Mandat</option>
                                <option value="8">Surat Tugas</option>
                                <option value="9">Surat Keterangan</option>
                                <option value="10">Surat Rekomendasi</option>
                                <option value="11">Surat Balasan</option>
                                <option value="12">Surat Perintah Perjalanan Dinas</option>
                                <option value="13">Sertifikat</option>
                                <option value="14">Perjanjian Kerja</option>
                                <option value="15">Surat Pengantar</option>
                              </select>
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
                            <label for="no_surat" class="col-sm-2 control-label">No Surat</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sifat" class="col-sm-2 control-label">Sifat</label>
                            <div class="col-sm-12">
                                <input type="text" class="sifat" id="sifat" name="sifat" placeholder="Sifat Surat" value="" maxlength="50" required="">
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
                                <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" placeholder="Tanggal Diterima" value="" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Isi Surat</label>
                            <div class="col-sm-12">
                                <textarea id="isi_surat" name="isi_surat" required="" placeholder="Isi Surat" class="form-control" maxlength="200"></textarea>
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
        </div> --}}





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
        var table = $('#table-keluar').DataTable({
            lengthMenu: [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Semua"]],

            dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv', 'print'
                ],
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('keluar-dashboard.index') }}",
            data: function (d) {
                    d.bidang_filter = $('#bidang_filter').val(),
                    d.search = $('input[type="search"]').val()
                }
            },

            order: [ [0, 'desc'] ],
            columns : [

                {data: 'id', name: 'id'},
                {data: 'no_surat', name: 'no_surat'},
                {data: 'tanggal_surat', name: 'tanggal_surat'},
                {data: 'kepada', name: 'kepada'},
                {data: 'bidang.name', name: 'bidangs.name'},
                {data: 'isi', name: 'isi'},
                {data: 'sifat', name: 'sifat'},
                {data: 'surat.name', name: 'surats.name'},
                {data: 'action', name: 'action'},
                {data: 'users.name', name: 'users.name'},
                {data: 'edit', name: 'edit'},
                {data: 'delete', name: 'delete'},
            ],
            'columnDefs': [ {
                'targets': [8,10,11], /* column index */
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


        $('body').on('click', '.editDisposisi', function () {
            var surat_keluars_id = $(this).data('id');
            $.get("{{ route('keluar-dashboard.index') }}" +'/' + surat_keluars_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Surat Keluar");
            $('#saveBtnEdit').val("edit-user");
            $('#ajaxEdit').modal('show');
            $('#id').val(data.id);
            $('#no_surat').val(data.no_surat);
            $('#tanggal_surat').val(data.tanggal_surat);
            $('#kepada').val(data.kepada);
            $('#bidangs_id').val(data.bidangs_id);
            $('#isi').val(data.isi);
            $('#sifat').val(data.sifat);
            $('#surats_id').val(data.surats_id);
            })
        });
        $('#saveBtnEdit').click(function (e) {
            e.preventDefault();
            $('#saveError').html();
            $(this).html('Menyimpan..');

            $.ajax({
                data: $('#disposisiEditForm').serialize(),
                url: "{{ route('keluar-dashboard.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#saveBtnEdit').html('Simpan');
                    $('#disposisiEditForm').trigger("reset");
                    $('#ajaxEdit').modal('hide');

                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveError').html('Kesalahan dalam mengisi form pastikan semua terisi dan benar');
                    $('#saveBtnEdit').html('Simpan');
                    $('#saveBtnEdit').html('Simpan Perubahan');
                }
            });
        });

        // $('body').on('click', .'createNewAgenda', function(){
        //     $('#ajaxCreateNewAgenda').modal('show');
        //     $('#modalHeading').html('Buat Agenda');
        // });


        $('body').on('click', '.deleteDisposisi', function (){
            var surat_keluars_id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('keluar-dashboard.store') }}"+'/'+surat_keluars_id,
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
