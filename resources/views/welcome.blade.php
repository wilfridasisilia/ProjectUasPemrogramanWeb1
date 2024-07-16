<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PerpustakaanUMDP</title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-primary text-light">

    <div class="container" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="row align-items-center p-4 rounded-3 bg-white">
            <div class="col-md-6">
                <h1 class="display-5 text-primary">Welcome To PerpustakaanUMDP</h1>
                <p class="text-dark">Perpustakaan UMDP (Universitas Multi Data Palembang) adalah pusat sumber daya dan informasi akademik yang dirancang untuk mendukung kebutuhan penelitian, belajar, dan mengajar di lingkungan kampus inovasi.</p>
                
                <p class="text-dark">Perpustakaan UMDP dilengkapi dengan beberapa fasilitas sebagai berikut: Tempat penitipan barang Buku materi perkuliahan Meja baca Stop Kontak Pendingin Udara (AC) Wifi.</p>
                <img src="{{ asset('img/mdp.jpg') }}" alt="MDP Image" class="img-fluid rounded shadow-sm mb-4">
            </div>
            <div class="col-md-6 text-center signup-section">
                <img src="{{ asset('img/ruangperpusmdp.jpg') }}" alt="Ruang Perpustakaan MDP" class="img-fluid rounded shadow-sm mb-4">
                <h2 class="my-5 text-dark"><a href="{{ route('register') }}" class="text-decoration-none">Register Now</a><a href="{{ route('login') }}" class="text-decoration-none"> Or Login!</a> and continue to our incredible page</h2>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg my-4">Sign Up</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg my-4">Login</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
