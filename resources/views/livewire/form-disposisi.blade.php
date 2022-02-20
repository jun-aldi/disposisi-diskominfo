<form method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="no_suart">No Surat</label>
            <input wire:model="no_surat" type="text" class="form-control" id="no_surat" placeholder="Nomor Agenda">
            @error('no_surat') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
        <label for="dari">Surat Dari</label>
        <input wire:model="dari" type="text" class="form-control" id="dari" placeholder="Nama Pengirim Surat">
        @error('dari') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label>Tgl Dibuat</label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                    <input wire:model="tanggal_dibuat" placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tanggal_dibuat" id="tanggal_dibuat" value="2015-02-24">
                    @error('tanggal_dibuat') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group col-6">
                <label>Tgl Diterima</label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                    <input wire:model="tanggal_diterima" id="tanggal_diterima" placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tanggal_diterima">
                    @error('tanggal_diterima') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label for="isi_surat">Isi Surat</label>
                <textarea wire:model="isi_surat" class="form-control" id="isi_surat" placeholder="Isi Surat"></textarea>
                @error('isi_surat') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="no_agenda">No Agenda</label>
                <input wire:model="no_agenda" type="text" class="form-control" id="no_agenda" placeholder="Nomor Agenda">
                @error('no_agenda') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="kepada">Surat Kepada</label>
                <input wire:model="kepada" type="text" class="form-control" id="kepada" placeholder="Nama Penerima Surat">
                @error('kepada') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="file">File *pdf</label>
                <input type="file" class="form-control" wire:model="filename">

                @error('filename') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status_id">Status</label>
                <select wire:model="status_id" name="status" id="status_id" class="form-select" aria-label="Default select example">
                    <option value="1">Diterima</option>
                    <option value="2">Ditolak</option>
                    <option value="3">Diproses</option>
                  </select>
                @error('status_id') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button wire:click.prevent="store()" type="submit" class="btn btn-primary"  data-bs-dismiss="modal">Submit</button>
    </div>
