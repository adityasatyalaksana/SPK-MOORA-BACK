<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SPK MOORA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{url('/')}}storage/assets/gunung/bootsrap.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .wrapper {
            display: flex;
            align-items: stretch;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="wrapper">
    @include('layouts.sidebar')

    <div id="content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>