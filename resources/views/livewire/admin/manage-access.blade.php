<main>
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="mt-4">Manage Access User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Parking Right</li>
                </ol>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Manage Access
            </div>
            <div class="card-body">
                <table id="datatablesSimple2">
                    <thead>
                        @if (count($accessData) > 0)
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if (count($accessData) > 0)
                        @php
                        $index = 1; // Initialize index before the loop
                        @endphp
                        @foreach ($accessData as $data)
                        <tr>
                            <td>{{ $index}}</td>
                            <td>{{ $data->title }}</td>
                            <td>
                                <div class="d-flex mx-3" style="gap: 10px;">

                                    {{-- <script>
                                        function confirmDelete() {
                                                    return confirm("Are you sure you want to delete this item?");
                                                }
                                    </script> --}}
                                </div>
                            </td>
                        </tr>
                        @php
                        $index++; // Increment index after each iteration
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">No data found</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Access User
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($datas) > 0)
                        @php
                        $index = 1; // Initialize index before the loop
                        @endphp
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{ $index}}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                <div class="d-flex mx-3" style="gap: 10px;">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editUser-{{$data->id}}" wire:click="edit({{ $data->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit Access
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit User Modal -->
                        <div wire:ignore.self class="modal fade" id="editUser-{{$data->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form wire:submit.prevent="update">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Access</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @php
                        $index++; // Increment index after each iteration
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4">No data found</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>