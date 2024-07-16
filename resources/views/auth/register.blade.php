<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Library Register</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center bg-light">
                                <img src="img/library.png" alt="Library Image" class="img-fluid" style="max-width: 300px;">
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="p-5 w-100">
                                    <div class="text-center">
                                        <h1 class="h4 text-primary font-weight-bold">REGISTER</h1>
                                    </div>
                                    <div class="text-center text-dark mb-4">
                                        Already have an account? <span class="font-weight-bold text-primary"><a class="text-decoration-none" href="{{ route('login') }}">Login!</a></span>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- Username -->
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="inputName" aria-describedby="nameHelp" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Username">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                        </div>
                                        <!-- Email Address -->
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="inputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email..">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="inputPassword" name="password" required autocomplete="new-password" placeholder="Password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="inputPasswordConfirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            REGISTER
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.email') }}">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
