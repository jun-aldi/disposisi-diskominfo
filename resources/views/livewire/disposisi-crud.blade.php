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
            <button wire:click="create()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create Posts</button>

            @if($isModalOpen)
            @include('livewire.create')
            @endif
            @if($isModalOpenEdit)
            @include('livewire.edit')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">ID</th>
                        <th class="px-4 py-2">Dari</th>
                        <th class="px-4 py-2">Tanggal Dibuat</th>
                        <th class="px-4 py-2">No Surat</th>
                        <th class="px-4 py-2">Isi Surat</th>
                        <th class="px-4 py-2">No Agenda</th>
                        <th class="px-4 py-2">Tanggal Diterima</th>
                        <th class="px-4 py-2">Kepada</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Users</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disposisi as $disposisi)
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
                        <td class="border px-4 py-2 text-succes fw-bold font-weight-bold">{{"Diterima"}}</td>
                        @elseif($disposisi->status_id == 2)
                        <td class="border px-4 py-2 text-danger fw-bold font-weight-bold">{{"Ditolak"}}</td>
                        @else
                        <td class="border px-4 py-2 text-primary fw-bold font-weight-bold">{{"Diproses"}}</td>
                        @endif
                        @if($disposisi->users_id == 1)
                        <td class="border px-4 py-2 text-succes fw-bold font-weight-bold">{{"Diskominfo_adm"}}</td>
                        @endif
                        <td class="border px-4 py-2">
                            <div class="row">
                                <button type="button" class="btn btn-secondary my-1 col-12">View</button>
                                <button wire:click="edit({{ $disposisi->id }})" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    class="btn btn-success my-1 col-12">Edit</button>
                                <button wire:click="delete({{ $disposisi->id }})"
                                    class="btn btn-danger my-1 col-12">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
