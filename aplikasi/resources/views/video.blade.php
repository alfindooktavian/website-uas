@extends('layouts.appp')

@section('title', 'Home Sekolah')

@section('content')

</div>
</nav>
<header class="pt-5 border-bottom bg-light">
<div class="container pt-md-1 pb-md-1">
<h1 class="bd-title mt-4 font-weight-bold"><i class="fa fa-video"
aria-hidden="true"></i> GALERI VIDEO
</h1>
<p class="bd-lead">Galeri Video terbaru tentang WIBU SCHOOL.</p>
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
<a href="#" class="text-decoration-none"><i class="fa favideo"></i>
Galeri Video</a>
</li>
</ol>
</nav>
<!-- end breadcrumb -->
<div class="container-fluid mt-3 mb-5">
    <div class="row">
        @foreach($videos as $video)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
                <div class="card-img" style="width:100%;height:300px;border-top-left-radius:.3rem;border-top-right-radius:.3rem;">
                    <iframe width="100%" height="100%" src="{{ $video->embed }}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="card-body text-center">
                    <h6>{{ $video->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
@endsection