<head>
    <style>
        .pegeypay-step,
        .fpx-step {
            counter-reset: section;
            list-style: none;
        }

        .pegeypay-step li,
        .fpx-step li {
            margin: 0 0 10px 0;
            line-height: 40px;
        }

        .pegeypay-step li:before,
        .fpx-step li:before {
            content: counter(section);
            counter-increment: section;
            display: inline-block;
            width: 40px;
            height: 40px;
            margin: 0 20px 0 0;
            border: 1px solid #ccc;
            border-radius: 100%;
            text-align: center;
        }
    </style>

    <script>
        // Hide the error alert after 10 seconds (10,000 ms)
        setTimeout(function() {
            var errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                errorAlert.style.display = 'none';
            }

            var statusAlert = document.getElementById('status-alert');
            if (statusAlert) {
                statusAlert.style.display = 'none';
            }
        }, 5000); // 10000 milliseconds = 5 seconds
    </script>
</head>

<div id="layoutSidenav">
    <!-- Include the Sidebar -->
    @include('layouts.sidebar')

    <div id="layoutSidenav_content">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="status-alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger" id="error-alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <main>
            <div class="container-fluid px-4 mb-4">
                <h1 class="mt-4">Settings</h1>
            </div>
            <!-- Change Password Column -->
            <div class="card mx-4 mb-4" style="width: 90%;">
                <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <h6 class="card-subtitle mb-4 text-body-secondary">You can change your password here:</h6>
                    <form action="{{ route('setting.change_password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">New Password</span>
                            <input type="password" name="newPassword" class="form-control"
                                placeholder="Enter new password" aria-label="newPassword"
                                aria-describedby="basic-addon1" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Confirm Password</span>
                            <input type="password" name="newPassword_confirmation" class="form-control"
                                placeholder="Enter confirm new password" aria-label="newPassword_confirmation"
                                aria-describedby="basic-addon1" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="float: right;">Change</button>
                    </form>
                </div>
            </div>

        </main>

        @include('layouts.footer')
    </div>
</div>