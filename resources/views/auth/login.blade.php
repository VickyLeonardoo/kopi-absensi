<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PENKOPI - Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .custom-input {
              display: block;
              width: 100%;
              padding: 0.375rem 0.75rem;
              font-size: 1rem;
              line-height: 1.5;
              color: #495057;
              background-color: #d9d9d9;
              background-clip: padding-box;
              border: 1px solid #f4f4f4;
              transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
              border-radius: 30px;
            }

          </style>
</head>

<body class="hold-transition login-page" style="background: rgb(244,244,244)">
    <div class="login-box">
            <h3 style="text-align: center">Absensi</h3>
            <h1 style="text-align: center"><b>Penkopi To Go</b></h1>
        <!-- /.login-logo -->
                <form action="/prosesLogin" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="custom-input" name="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="custom-input" name="password" autocomplete="off" placeholder="Password" value="{{ old('password') }}">
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12" style="text-align: center">
                            <input type="submit" class="btn btn-primary" style="border-radius: 30px; width: 30%" value="Login">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->
    @include('sweetalert::alert')

    <!-- jQuery -->
    <script src="{{ asset('asset') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('asset') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('asset') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
