@extends('layouts.app');

@section('content')
    <div class="container-fluid dc-proj">
        <div class="row justify-content-between">
            @foreach ($projects as $project)
            <div class="col-2 p-2">
                <div class="card h-100">

                    @if (str_contains($project->cover_image,'http'))
                    <img src="{{$project->cover_image}}"
                    class="card-img-top"
                    alt="{{$project->image_original_name}}">
                    @else
                    <img src="{{ asset('storage/'. $project->cover_image)}}"
                    class="card-img-top"
                    alt="{{$project->image_original_name}}">
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="upper-body text-center">
                            <h5 class="card-title">{{$project->name}}</h5>
                            <p class="card-text">{{$project->client_name}}</p>
                        </div>
                        <div class="bottom-body text-center">
                            <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-warning mt-1">Dettagli Progetto</a>

                        </div>

                    </div>
                  </div>
            </div>

            @endforeach
        </div>
    </div>
@endsection
