
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title')</title>
</head>
<body style="background:#e2e8f0">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="border-top: 0px solid rgb(175, 140, 226);">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="SMK INDONESIA Logo" style="height: auto; max-height: 30px;"> ALFERENDI SCHOOL
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" arialabel="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('beritas') }}"><i class="fa fa-book-open"
                            aria-hidden="true"></i> BERITA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agenda') }}"><i class="fa fa-book-open"
                            aria-hidden="true"></i> AGENDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('foto') }}"><i class="fa fa-image"
                            aria-hidden="true"></i> GALERI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('video') }}"><i class="fa fa-video"
                            aria-hidden="true"></i> VIDEO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kontak') }}"><i class="fa fa-phone"
                            aria-hidden="true"></i> KONTAK</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container-fluid mt-3 mb-5">
        @yield('content')
    </div>

    <footer>
        <div class="container-fluid" style="background: white;">
            <div class="row p-4">
                <div class="col-md-4">
                    <h5>TENTANG</h5>
                    <hr>
                    <p>
                    Alfrendi International School adalah lembaga pendidikan yang berkomitmen untuk memberikan 
                    pengalaman belajar yang mendalam dan beragam bagi siswa-siswinya. Dengan motto "Menyongsong Masa Depan",
                    
                    </p>
                </div>
                <div class="col-md-4">
    <h5>TAGS</h5>
    <hr>
    <div class="btn-group-horizontal">
        @foreach($tags as $tag)
            <a href="{{ route('beritas', ['tag_id' => $tag->id]) }}" class="btn btn-outline-secondary mb-2">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>
                <div class="col-md-4">
                    <h5>KONTAK</h5>
                    <hr>
                    <p>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> Telepon Nomor telepon sekolah yang dapat dihubungi
                         untuk pertanyaan atau informasi lebih lanjut.
                        <i class="fas fa-phone"></i> +62813-3184-7703
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark">
            <div class="row p-3">
                <div class="text-center text-white font-weight-bold">
                    Copyright © 2024 ALFERENDI SCHOOL. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="js/slider.js"></script>
    <script>
        $(document).ready(function() {
            $('#myCarousel').carousel();
        });
    </script>
</body>
</html>
