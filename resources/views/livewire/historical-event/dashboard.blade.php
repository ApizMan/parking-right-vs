<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="mt-4">Historical event</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>

        <div class="row justify-content-center">
            <div class="col-auto">
                <button type="button" class="btn btn-warning px-3 py-2" data-bs-toggle="modal"
                    data-bs-target="#createEvent">
                    Create New Event
                </button>
            </div>
        </div>
    </div>
    <!-- =======  Data-Table  = Start  ========================== -->
    <div class="row pb-4">
        <div class="col-12">
            <div class="data_table table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department Involve</th>
                            <th>Staff Involve</th>
                            <th>Area</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($datas) > 0)
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{ $data->getEventDateAttribute() }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->department_involved }}</td>
                            <td>{{ $data->staff_involved }}</td>
                            <td>{{ $data->zone_area }}</td>
                            <td>
                                <div class="d-flex mx-3 " style="gap: 10px;">
                                    <a class="btn btn-primary" role="button"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <button class="btn btn-danger" role="button"
                                        onclick="return confirmDelete({{ $data->id }});">
                                        <i class="fa-solid fa-trash"></i> Remove
                                    </button>

                                    <script>
                                        function confirmDelete(id) {
                                                if (confirm("Are you sure you want to delete this item?")) {
                                                    Livewire.dispatch('deleteEvent', {id});
                                                }
                                            }

                                            // function edit(id) {
                                            //         // Trigger the Livewire delete action
                                            //         Livewire.dispatch('editUser', {id});
                                            // }
                                    </script>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="13" style="text-align: center;">Data Not Found</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- =======  Data-Table  = End  ===================== -->

    <!-- Create User Modal -->
    <div wire:ignore.self class="modal fade" id="createEvent" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create New User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('department_involved') is-invalid @enderror"
                                id="inputDepartment" type="text" placeholder="Key-in Department Involve"
                                wire:model="department_involved" />
                            <label for="inputDepartment">Department Involve</label>
                            <div class="text-danger">
                                @error('department_involved') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model="date" type="datetime-local"
                                class="form-control @error('date') is-invalid @enderror" id="inputDate"
                                placeholder="Select Date">
                            <label for="inputDate">Date</label>
                            <div class="text-danger">
                                @error('date') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control @error('title') is-invalid @enderror" id="inputTitle" type="text"
                                wire:model="title" placeholder="Key-in Title Event" />
                            <label for="inputTitle">Title Event</label>
                            <div class="text-danger">
                                @error('title') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control @error('description') is-invalid @enderror" id="inputDescription"
                                type="text" wire:model="description" placeholder="Key-in Description Event" />
                            <label for="inputDescription">Description Event</label>
                            <div class="text-danger">
                                @error('description') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control @error('staff_involved') is-invalid @enderror" id="inputStaff"
                                type="text" wire:model="staff_involved" placeholder="Key-in Staff Name" />
                            <label for="inputStaff">Staff Involve</label>
                            <div class="text-danger">
                                @error('staff_involved') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-secondary px-2 py-1"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary px-2 py-1">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>