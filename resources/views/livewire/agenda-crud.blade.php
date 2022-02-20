
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <div class="container my-3">
                <div class="row">
                    <div class="col">
                        <button wire:click="create()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropCreate">Tambah Agenda</button>
                    </div>
                    <div class="col">
                        <form class="form-inline" method="GET">
                            <div class="form-group">
                              <label for="filter" class="form-label mx-2">Tanggal Dibuat</label>
                              <input type="date" class="form-control" id="filter" name="filter" placeholder="Tanggal" value="{{$filter}}">
                            </div>
                            <button type="submit" class="btn btn-default mb-2">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            @if($isModalOpen)
            @include('livewire.create-agenda')
            @endif
            @if($isModalOpenEdit)
            @include('livewire.edit-agenda')
            @endif
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead">
                        <tr class="bg-gray-100">
                            <th width="80px">@sortablelink('id')</th>
                            <th class="px-4 py-2">@sortablelink('disposisi_id')</th>
                            <th class="px-4 py-2">@sortablelink('jam_agenda')</th>
                            <th class="px-4 py-2">@sortablelink('tanggal_agenda')</th>
                            <th class="px-4 py-2">@sortablelink('isi')</th>
                            <th class="px-4 py-2">@sortablelink('tempat')</th>
                            <th class="px-4 py-2">@sortablelink('keterangan')</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($agendas->count())
                        @foreach($agendas as $agenda)
                        <tr>
                            <td class="border px-4 py-2">{{ $agenda->id }}</td>
                            <td class="border px-4 py-2">{{ $agenda->disposisi_id }}</td>
                            <td class="border px-4 py-2">{{ $agenda->jam_agenda }}</td>
                            <td class="border px-4 py-2">{{ $agenda->tanggal_agenda}}</td>
                            <td class="border px-4 py-2">{{ $agenda->isi }}</td>
                            <td class="border px-4 py-2">{{ $agenda->tempat }}</td>
                            <td class="border px-4 py-2">{{ $agenda->keterangan }}</td>
                            <td class="border px-12 py-2">
                                <div class="row">
                                    <button type="button" wire:click="edit({{ $agenda->id }})" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        class="btn btn-success mx-1 px-2 my-1 col-xl-4" style="font-size: 8px">Edit</button>
                                    <button type="button" wire:click="delete({{ $agenda->id }})"
                                        class="btn btn-danger mx-1 my-1 px-2 col-xl-4" style="font-size: 8px">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {!! $agendas->appends(Request::except('page'))->render() !!}
                <div class="mt-3">
                    <p class="display-footer-count mt-3">
                        Displaying {{$agendas->count()}} of {{ $agendas->total() }} Agenda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



