@extends('layouts.appp')

@section('title', 'Home Sekolah')

@section('content')


</div>
</nav>
<header class="pt-5 border-bottom bg-light">
<div class="container pt-md-1 pb-md-1">
<h1 class="bd-title mt-4 font-weight-bold"><i class="fa fa-bookopen" aria-hidden="true"></i> BERITA
</h1>
<p class="bd-lead">Berita terbaru tentang WIBU SCHOOL.</p>
</div>
</header>
<!-- breadcrumb -->
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a hre="#" class="text-decoration-none"><i class="fa fahome"></i> Home
</a>
</li>
<li class="breadcrumb-item">
<a href="#" class="text-decoration-none"><i class="fa fa-bookopen"></i>
Berita</a>
</li>
</ol>
</nav>
<!-- end breadcrumb -->
<div class="container-fluid mt-3 mb-5">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
                <div class="card-img">
                    <img src="{{ asset('storage/posts/' . $post->image) }}" class="w-100" style="height: 200px; object-fit: cover; border-top-left-radius: .3rem; border-top-right-radius: .3rem;">
                </div>
                <div class="card-body">
                    <a href="{{ route('berita', ['id' => $post->id]) }}" class="text-dark text-decoration-none">
                        <h6>{{ $post->title }}</h6>
                    </a>
                </div>
                <div class="card-footer bg-white">
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}
                </div>
            </div>
        </div>
        @endforeach
</div>
</div>
</div>

@endsection