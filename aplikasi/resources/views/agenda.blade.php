<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<title>Home Sekolah</title>
</head>
<body style="background:#e2e8f0">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"
style="border-top: 0px solid rgb(175, 140, 226);">
<div class="container-fluid">
<a class="navbar-brand" href="{{ route('welcome') }}">
    <img src="{{ asset('images/logo1.png') }}" alt="SMK INDONESIA Logo" style="height: auto; max-height: 30px;"> WIBU SCHOOL
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse"
data-target="#navbarCollapse"
aria-controls="navbarCollapse" aria-expanded="false" arialabel="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<ul class="navbar-nav mr-auto mb-2 mb-md-0">
<li class="nav-item">
<a class="nav-link" href="{{ route('berita') }}"><i class="fa fa-book-open"
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
<header class="pt-5 border-bottom bg-light">
<div class="container pt-md-1 pb-md-1">
<h1 class="bd-title mt-4 font-weight-bold"><i class="fa fa-bell"
aria-hidden="true"></i> AGENDA
</h1>
<p class="bd-lead">Agenda terbaru tentang WIBU SCHOOL.</p>
</div>
</header>
<!-- breadcrumb -->
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="#" class="text-decoration-none"><i class="fa fahome"></i> Home
</a>
</li>
<li class="breadcrumb-item">
<a href="#" class="text-decoration-none"><i class="fa fabell"></i>
Agenda</a>
</li>
</ol>
</nav>
<!-- end breadcrumb -->
<div class="container-fluid mt-3 mb-5">
<div class="row">
<div class="col-md-6 mb-3" v-for="event in events" :key="event.id">
<a href="{{ route('agendasingle') }}" class="text-decoration-none text-dark">
<div class="card mb-3 shadow-sm border-0">
<div class="card-body">
<h6>Judul Agenda</h6>
<hr>
<div>
<i class="fa fa-map-marker" ariahidden="true"></i> Lokasi Agenda
</div>
<div class="mt-2">
<i class="fa fa-calendar" ariahidden="true"></i> 09-11-2020
</div>
</div>
</div>
</a>
</div>
<div class="col-md-6 mb-3" v-for="event in events" :key="event.id">
<a href="" class="text-decoration-none text-dark">
<div class="card mb-3 shadow-sm border-0">
<div class="card-body">
<h6>Judul Agenda</h6>
<hr>
<div>
<i class="fa fa-map-marker" ariahidden="true"></i> Lokasi Agenda
</div>
<div class="mt-2">
<i class="fa fa-calendar" ariahidden="true"></i> 09-11-2020
</div>
</div>
</div>
</a>
</div>
<div class="col-md-6 mb-3" v-for="event in events" :key="event.id">
<a href="" class="text-decoration-none text-dark">
<div class="card mb-3 shadow-sm border-0">
<div class="card-body">
<h6>Judul Agenda</h6>
<hr>
<div>
<i class="fa fa-map-marker" ariahidden="true"></i> Lokasi Agenda
</div>
<div class="mt-2">
<i class="fa fa-calendar" ariahidden="true"></i> 09-11-2020
</div>
</div>
</div>
</a>
</div>
<div class="col-md-6 mb-3" v-for="event in events" :key="event.id">
<a href="" class="text-decoration-none text-dark">
<div class="card mb-3 shadow-sm border-0">
<div class="card-body">
<h6>Judul Agenda</h6>
<hr>
<div>
<i class="fa fa-map-marker" ariahidden="true"></i> Lokasi Agenda
</div>
<div class="mt-2">
<i class="fa fa-calendar" ariahidden="true"></i> 09-11-2020
</div>
</div>
</div>
</a>
</div>
</div>
</div>
<footer>
<div class="container-fluid" style="background: white;">
<div class="row p-4">
<div class="col-md-4">
<h5>TENTANG</h5>
<hr>
<p>
This example is a quick exercise to illustrate how the
top-aligned navbar works. As you scroll, this navbar remains in its original41
position.
</p>
</div>
<div class="col-md-4">
<h5>TAGS</h5>
<hr>
<button class="btn btn-sm btn-outline-secondary mb-
2">ISLAM</button>
<button class="btn btn-sm btn-outline-secondary mb-
2">BUDAYA</button>
<button class="btn btn-sm btn-outline-secondary mb-
2">OSIS</button>
<button class="btn btn-sm btn-outline-secondary mb-
2">KEGIATAN</button>
<button class="btn btn-sm btn-outline-secondary mb-2">KERJA
BAKTI</button>
<button class="btn btn-sm btn-outline-secondary mb-
2">PENGUMUMAN</button>
<button class="btn btn-sm btn-outline-secondary mb-
2">INFO</button>
<button class="btn btn-sm btn-outline-secondary mb-
2">PRAMUKA</button>
</div>
<div class="col-md-4">
<h5>KONTAK</h5>
<hr>
<p>
<i class="fa fa-map-marker" aria-hidden="true"></i> This
example is a quick exercise to illustrate how the top-aligned navbar works
<i class="fas fa-phone"></i> +62857-8585-2224
</p>
</div>
</div>
</div>
<div class="container-fluid bg-dark">
<div class="row p-3">
<div class="text-center text-white font-weight-bold">
Copyright © 2024 WIBU SCHOOL. All rights reserved.
</div>
</div>
</div>
</footer>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>