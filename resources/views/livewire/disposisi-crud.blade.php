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
                        <button wire:click="create()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropCreate">Create Posts</button>
                    </div>
                    <div class="col">
                        <form class="form-inline" method="GET">
                            <div class="form-group">
                              <label for="filter" class="form-label mx-2">Tanggal Dibuat</label>
                              <input type="date" class="form-control" id="filter" name="filter" placeholder="Tanggal" value="{{$filter}}">
                              <label for="filter2" class="form-label mx-2">Dari</label>
                              <input type="text" class="form-control" id="filter2" name="filter2" placeholder="Tanggal" value="{{$filter2}}">
                            </div>
                            <button type="submit" class="btn btn-default mb-2">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            @if($isModalOpen)
            @include('livewire.create')
            @endif
            @if($isModalOpenEdit)
            @include('livewire.edit')
            @endif
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead">
                        <tr class="bg-gray-100">
                            <th width="80px">@sortablelink('id')</th>
                            <th>@sortablelink('dari')</th>
                            <th class="px-4 py-2">@sortablelink('tanggal_dibuat')</th>
                            <th class="px-4 py-2">@sortablelink('no_surat')</th>
                            <th class="px-4 py-2">@sortablelink('isi_surat')</th>
                            <th class="px-4 py-2">@sortablelink('no_agenda')</th>
                            <th class="px-4 py-2">@sortablelink('tanggal_diterima')</th>
                            <th class="px-4 py-2">@sortablelink('kepada')</th>
                            <th class="px-4 py-2">@sortablelink('status_id')</th>
                            <th class="px-4 py-2">@sortablelink('users_id')</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($disposisis->count())
                        @foreach($disposisis as $disposisi)
                        <tr>
                            <td class="border px-4 py-2">{{ $disposisi->id }}</td>
                            <td class="border px-4 py-2">{{ $disposisi->dari }}</td>
                            <td class="border px-4 py-2">{{ date('d/m/Y',strtotime($disposisi->tanggal_dibuat)) }}</td>
                            <td class="border px-4 py-2">{{ $disposisi->no_surat }}</td>
                            <td class="border px-4 py-2">{{ $disposisi->isi_surat}}</td>
                            <td class="border px-4 py-2">{{ $disposisi->no_agenda }}</td>
                            <td class="border px-4 py-2">{{ date('d/m/Y',strtotime($disposisi->tanggal_diterima)) }}</td>
                            <td class="border px-4 py-2">{{ $disposisi->kepada }}</td>
                            @if($disposisi->status_id == 1)
                            <td class="border px-4 py-2 text-success fw-bold font-weight-bold">{{"Diterima"}}</td>
                            @elseif($disposisi->status_id == 2)
                            <td class="border px-4 py-2 text-danger fw-bold font-weight-bold">{{"Ditolak"}}</td>
                            @else
                            <td class="border px-4 py-2 text-primary fw-bold font-weight-bold">{{"Diproses"}}</td>
                            @endif
                            @if($disposisi->users_id == 1)
                            <td class="border px-4 py-2 fw-bold font-weight-bold">{{"Diskominfo_adm"}}</td>
                            @endif
                            <td class="border px-12 py-2">
                                <div class="row">
                                    <button wire:click="generatePDF({{ $disposisi->id }})" type="button" class="btn btn-secondary px-2 mx-1 my-1 col-xl-4" style="font-size: 8px">View</button>
                                    <button type="button" wire:click="edit({{ $disposisi->id }})" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        class="btn btn-success mx-1 px-2 my-1 col-xl-4" style="font-size: 8px">Edit</button>
                                    <button type="button" wire:click="delete({{ $disposisi->id }})"
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
                {!! $disposisis->appends(Request::except('page'))->render() !!}
                <div class="mt-3">
                    <p class="display-footer-count mt-3">
                        Displaying {{$disposisis->count()}} of {{ $disposisis->total() }} disposi(s).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



