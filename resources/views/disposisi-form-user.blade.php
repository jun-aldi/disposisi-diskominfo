<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <script>
        // Self-executing function
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <style>
        .container-form{
            background: rgb(63,190,251);
            background: radial-gradient(circle, rgba(63,190,251,0.6446953781512605) 0%, rgba(252,70,202,0.3253676470588235) 100%);
        }
    </style>
</head>
<body>
    @include('navbar-top')

    <div class="container-fluid mt-4 container-form" data-aos="fade-down" data-aos-duration="1000">
        <div class="row">
            <div class="col-xl-8 p-0 mx-auto mt-4">
                <div class=" min-vh-100 m-0 d-flex flex-column justify-content-center pt-60">
                    <div class="card shadow ">
                        <div class="card-header">
                         <h3 class="fw-bolder text-center">FORM SURAT MASUK</h3>
                         @if(session('status'))
                         <div class="alert alert-success">
                         {{ session('status') }}
                         </div>
                         @endif
                        </div>
                        <div class="card-body">
                          <form action="{{url('store-disposisi-user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="surats_id">Jenis Surat :</label>
                                <div class="col-sm-9">
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
                                    @error('surats_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="bidangs_id">Surat Kepada:</label>
                                <div class="col-sm-9">
                                    <select  name="bidangs_id" id="bidangs_id" class="form-select" aria-label="Default select example">
                                        <option value="1">Kepala Diskominfo</option>
                                        <option value="2">Sekretariat Diskominfo</option>
                                        <option value="3">Bidang Tata Kelola Informatika</option>
                                        <option value="4">Bidang Informasi dan Komunikasi Publik</option>
                                      </select>
                                    @error('bidangs_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="surat_dari">Surat Dari:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="dari" name="dari" placeholder="Surat Dari" required>
                                    @error('dari')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="isi_surat">Isi Surat:</label>
                                <div class="col-sm-9">
                                    <textarea rows="10" name="isi_surat" class="form-control" id="isi_surat" placeholder="Isi Surat" required></textarea>
                                    @error('isi_surat')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="filename">Upload Surat:</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="filename" id="filename" >
                                    @error('filename')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <p>!!PDF UKURAN MAKSIMAL 2MB</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary"  data-bs-dismiss="modal">Submit</button>
                                    <input type="reset" class="btn btn-secondary ms-2" value="Reset">
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
    @include('script-foot')
</body>
</html>
