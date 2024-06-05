@extends('layouts.appp')

@section('title', 'Home Sekolah')

@section('content')

</div>
</nav>
<header class="pt-5 border-bottom bg-light">
<div class="container pt-md-1 pb-md-1">
<h1 class="bd-title mt-4 font-weight-bold"><i class="fa fa-bookopen" aria-hidden="true"></i> BERITA
</h1>
<p class="bd-lead">Berita terbaru tentang ALFERENDI SCHOOL.</p>
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
<li class="breadcrumb-item active">
<a href="#" class="text-decoration-none">
Judul Berita</a>
</li>
</ol>
</nav>
<!-- end breadcrumb -->
<div class="container-fluid mt-3 mb-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>{{ $post->title }}</h3>
                    <hr>
                    <img src="{{ asset('storage/posts/' . $post->image) }}" class="w-100 rounded">
                    <div class="mt-3">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
   
        <div class="col-md-4">
    <!-- agenda section -->
    <div class="title mb-4">
        <h4><i class="fa fa-calendar" aria-hidden="true"></i> AGENDA TERBARU</h4>
    </div>
    @foreach($events as $event)
    <div class="card mb-3 shadow-sm border-0">
        <div class="card-body">
        <a href="{{ route('agendasingle', ['id' => $event->id]) }}" class="text-decoration-none text-dark">
            <h6>{{ $event->title }}</h6>
            <hr>
            <div>
                <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $event->location }}
            </div>
            <div class="mt-2">
                <i class="fa fa-calendar" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}
            </div>
        </div>
    </div>
    @endforeach
<!-- end agenda section -->
<!-- kategori section -->
<div class="title mb-4 mt-5">
    <h4><i class="fa fa-folder" aria-hidden="true"></i> KATEGORI BERITA</h4>
</div>
<div class="list-group">
    @foreach($categories as $category)
        <a href="{{ route('beritas', ['category_id' => $category->id]) }}" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
            <i class="fa fa-folder-open" aria-hidden="true"></i> {{ $category->name }}
        </a>
    @endforeach
</div>
<!-- end kategori section -->
</div>
</div>
</div>

@endsection