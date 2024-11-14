<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Admin Parking Right</title>
    @php
    include_once app_path('constants.php');
    $favicon = FAVICON;
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $favicon }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @livewireStyles
</head>

<body class="bg-primary">
    <livewire:admin.auth.login>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
        @livewireScripts
</body>

</html>