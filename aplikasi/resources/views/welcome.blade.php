@extends('layouts.appp')

@section('title', 'Home Sekolah')

@section('content')

</div>
</nav>
<!-- slider section -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($sliders as $key => $slider)
        <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"> </li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('storage/sliders/' . $slider->image) }}" class="w-100" alt="Slide {{ $key + 1 }}">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!-- end slider section -->
<div class="container-fluid mt-3 mb-5">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
<!-- berita section -->
<div class="col-md-12 mb-3">
<h4><i class="fas fa-book-open"></i> BERITA TERBARU</h4>
</div>
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

<!-- end berita section -->
<!-- foto section -->
<div class="col-md-12 mb-3 mt-4">
<h4><i class="fas fa-images"></i> FOTO TERBARU</h4>
</div>
@foreach($photos as $photo)
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded-lg">
            <div class="card-img">
                <img src="{{ asset('storage/images/' . $photo->image) }}" class="w-100" style="height: 200px; object-fit: cover; border-top-left-radius: .3rem; border-top-right-radius: .3rem;">
            </div>
            <div class="card-body">
                <a href="{{ route('foto', $photo->id) }}" class="text-dark text-decoration-none">
                    <h6>{{ $photo->caption }}</h6>
                </a>
            </div>
        </div>
    </div>
    @endforeach

<!-- send foto section -->
<!-- video section -->
<div class="col-md-12 mb-3 mt-4">
    <h4><i class="fas fa-video"></i> VIDEO TERBARU</h4>
</div>
@foreach($videos as $video)
<div class="col-md-6 mb-4">
    <div class="card h-100 shadow-sm border-0 rounded-lg">
        <div class="card-img" style="width:100%;height:200px;object-fit:cover;border-top-left-radius:.3rem;border-top-right-radius:.3rem;">
            <iframe width="100%" height="100%" src="{{ $video->embed }}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="card-body">
            <a href="{{ route('video', $video->id) }}" class="text-dark text-decoration-none">
                <h6>{{ $video->title }}</h6>
            </a>
        </div>
    </div>
</div>
@endforeach

<!-- end video section -->
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