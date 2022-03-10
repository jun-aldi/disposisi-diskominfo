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
                                <label class="col-sm-3 col-form-label" for="no_surat">No Surat:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="No Surat" required>
                                    @error('no_surat')
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
                                <label class="col-sm-3 col-form-label" for="tanggal_dibuat">Tanggal Dibuat:</label>
                                <div class="col-sm-9">
                                    <input placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tanggal_dibuat" id="tanggal_dibuat" required >
                                    @error('tanggal_dibuat')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="tanggal_diterima">Tanggal Diterima:</label>
                                <div class="col-sm-9">
                                    <input id="tanggal_diterima" placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tanggal_diterima" required>
                                    @error('tanggal_diterima')
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
                                <label class="col-sm-3 col-form-label" for="kepada">Surat Kepada:</label>
                                <div class="col-sm-9">
                                    <input  type="text" name="kepada" class="form-control" id="kepada" placeholder="Surat Kepada" required>
                                    @error('kepada')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="filename">Upload Surat:</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="filename" id="filename" >
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
