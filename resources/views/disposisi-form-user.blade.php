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

    <div class="container-fluid mt-4 container-form my-4" data-aos="fade-down" data-aos-duration="1000">
        <div class="row">
            <div class="col-xl-8 p-0 mx-auto mt-4">
                <div class=" min-vh-100 m-0 d-flex flex-column justify-content-center pt-60">
                    <div class="card shadow ">
                        <div class="card-header">
                         <h1 class="fw-bolder text-center display-5">AGENDA SURAT MASUK</h1>
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
                                <label class="col-sm-3 col-form-label " for="surats_id"><h6 class="fw-bold">Jenis Surat</h6>  </label>
                                <div class="col-sm-4">
                                    <input class="form-control" list="surat_id" id="surats_id" name="surats_id" placeholder="Ketik dan pilih jenis surat...">
                                        <datalist id="surat_id" name="surats_id">
                                            @foreach ($jenis_surats as $jenis_surat)
                                            <option value="{{ $jenis_surat->id }}">{{ $jenis_surat->code }} {{ $jenis_surat->name }}</option>
                                         @endforeach
                                        </datalist>
                                    @error('surats_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="bidangs_id"><h6 class="fw-bold">Surat Kepada</h6> </label>
                                <div class="col-sm-4">
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
                                <label class="col-sm-3 col-form-label" for="no_surat"><h6 class="fw-bold">No Surat</h6> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomer Surat" required>
                                    @error('no_surat')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="sifat"><h6 class="fw-bold">Sifat Surat</h6> </label>
                                <div class="col-sm-4">
                                    <select  name="sifat" id="sifat" class="form-select" aria-label="Default select example">
                                        <option value="Biasa">Biasa</option>
                                        <option value="Segera">Segera</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Rahasia">Rahasia</option>
                                      </select>
                                    @error('sifat')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="surat_dari"><h6 class="fw-bold">Surat Dari</h6> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="dari" name="dari" placeholder="Surat Dari" required>
                                    @error('dari')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="tanggal_dibuat"><h6 class="fw-bold">Tanggal Surat</h6> </label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="Tanggal Dibuat" required>
                                    @error('tanggal_dibuat')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="surat_dari"><h6 class="fw-bold">Tanggal Diterima</h6> </label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" placeholder="Tanggal Diterima" required>
                                    @error('tanggal_diterima')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="isi_surat"><h6 class="fw-bold">Ringkasan Isi Surat</h6> </label>
                                <div class="col-sm-9">
                                    <textarea rows="15" name="isi_surat" class="form-control" id="isi_surat" placeholder="Isi Surat" required></textarea>
                                    @error('isi_surat')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="filename"><h6 class="fw-bold">Upload Surat</h6> </label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="filename" id="filename" >
                                    @error('filename')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <p class="bg-danger col-xl-4 col-sm-12" style="color:white">!!PDF UKURAN MAKSIMAL 2MB</p>
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
