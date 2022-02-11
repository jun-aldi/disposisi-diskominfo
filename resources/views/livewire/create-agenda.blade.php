

<div wire:ignore.self class="modal fade" id="staticBackdropCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
    <div class="modal-content ">
        <div class="modal-header  bg-primary">
        <h5 class="modal-title" id="staticBackdropLabel">Formulir Agenda</h5>
        <button type="button" wire:click="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Disosisi Id</label>
                        <input wire:model="disposisi_id" type="text" class="form-control" id="disposisi_id" placeholder="Nomor Disposisi">
                        @error('disposisi_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                    <label for="dari">Jam Agenda</label>
                    <input wire:model="jam_agenda" type="time" class="form-control" id="jam_agenda" placeholder="Jam Agenda">
                    @error('jam_agenda') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Tgl Agenda</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                                <input wire:model="tanggal_agenda" placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tanggal_agenda" id="tanggal_agenda">
                                @error('tanggal_agenda') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi Agenda</label>
                            <textarea wire:model="isi" class="form-control" id="isi" placeholder="Isi"></textarea>
                            @error('isi') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input wire:model="tempat" type="text" class="form-control" id="tempat" placeholder="Tempat">
                            @error('tempat') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">keterangan</label>
                            <input wire:model="keterangan" type="text" class="form-control" id="keterangan" placeholder="Keterangan">
                            @error('keterangan') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button wire:click.prevent="store()" type="submit" class="btn btn-primary"  data-bs-dismiss="modal">Submit</button>
                </div>
                @csrf

                @method('PUT')
                </form>
            </div>
        </div>
        <div class="modal-footer">
        <button wire:click="closeModal()" type="button " class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
