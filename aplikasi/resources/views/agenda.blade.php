@extends('layouts.appp')

@section('title', 'Home Sekolah')

@section('content')


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
        @foreach($events as $event)
        <div class="col-md-6 mb-3">
            <a href="{{ route('agendasingle', ['id' => $event->id]) }}" class="text-decoration-none text-dark">
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <h6>{{ $event->title }}</h6>
                        <hr>
                        <div>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $event->location }}
                        </div>
                        <div class="mt-2">
                            <i class="fa fa-calendar" aria-hidden="true"></i> {{ $event->formatted_date }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
 


        </div>
</div>
</div>

@endsection