<main>
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Parking Right</li>
                </ol>
            </div>

            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUser">
                        Create New User
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
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
                    <td>{{ $data->email }}</td>
                    <td>
                        <div class="d-flex mx-3" style="gap: 10px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editUser-{{$data->id}}" wire:click="edit({{ $data->id }})">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button wire:click="delete({{ $data->id }})" class="btn btn-danger" role="button"
                                onclick="return confirmDelete();">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <script>
                                function confirmDelete() {
                                            return confirm("Are you sure you want to delete this item?");
                                        }
                            </script>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit New User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('name') is-invalid @enderror" id="inputName"
                                            type="text" placeholder="Key-in user name" wire:model="name"
                                            value="{{ old('name', $name) }}" />
                                        <label for="inputName">Name</label>
                                        <div class="text-danger">
                                            @error('name') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                                            type="email" placeholder="name@example.com" wire:model="email"
                                            value="{{ old('email', $email) }}" />
                                        <label for="inputEmail">Email</label>
                                        <div class="text-danger">
                                            @error('email') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            id="inputPassword" type="password" wire:model="password"
                                            placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                        <div class="text-danger">
                                            @error('password') {{ $message }} @enderror
                                        </div>
                                    </div>
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

        <!-- Create User Modal -->
        <div wire:ignore.self class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <input class="form-control @error('name') is-invalid @enderror" id="inputName"
                                    type="text" placeholder="Key-in user name" wire:model="name" />
                                <label for="inputName">Name</label>
                                <div class="text-danger">
                                    @error('name') {{ $message }} @enderror
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                                    type="email" placeholder="name@example.com" wire:model="email" />
                                <label for="inputEmail">Email</label>
                                <div class="text-danger">
                                    @error('email') {{ $message }} @enderror
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                    type="password" wire:model="password" placeholder="Password" />
                                <label for="inputPassword">Password</label>
                                <div class="text-danger">
                                    @error('password') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</main>

<script>
    // Listen to the close-modal event to close the modal after a successful form submission
    Livewire.on('close-modal', () => {
        var modal = new bootstrap.Modal(document.getElementById('createUser'));
        modal.hide();
    });
</script>