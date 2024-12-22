<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>الصفحة الرئيسية</title>

    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Font (Tajawal) -->
    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }

        @font-face {
            font-family: 'Tajawal';
            src: url('{{ asset('assets/admin/fonts/Tajawal/Tajawal-Regular.ttf') }}');
        }

        .btn-primary{
            background-color: #4d0800;
            border-color: #4d0800;
            color: #fff;
        }

        .btn-primary:hover{
            background-color: #050100;
            border-color: #4d0800;
            color: #fff;
        }

        .btn-success{
            background-color: #4d0800;
            border-color: #4d0800;
            color: #fff;
        }

        .btn-success:hover{
            background-color: #050100;
            border-color: #4d0800;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    @include('web.layouts.header')

    <!-- Content Section -->
    @include('web.layouts.content')

    <!-- Footer Section -->
    @include('web.layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle (Depends on jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    @yield('script')

</body>
</html>
