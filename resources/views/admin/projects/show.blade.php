@extends('layouts.app')

@section('content')
    <div class="container w-50 m-auto text-center mt-5">
        @if (str_contains($project->cover_image,'http'))
        <img src="{{$project->cover_image}}"
        class="card-img-top dc-proj-image"
        alt="{{$project->image_original_name}}">
        @else
        <img src="{{ asset('storage/'. $project->cover_image)}}"
        class="card-img-top dc-proj-image"
        alt="{{$project->image_original_name}}">
        @endif

        <h2 class="mb-2 mt-4"><strong>Nome Progetto: </strong>{{$project->name}}</h2>
        <h4  class="my-2"><strong>Cliente: </strong>{{$project->client_name}}</h4>
        <p  class="my-2"><strong>Descrizione: </strong>{!!$project->summary!!}</p>
        <div class="btns">
            <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning" title="Edit Project"><i class="fa-solid fa-pencil"></i></a>
            @include('admin.partials.form-delete')
        </div>
        <a href="{{route('admin.projects.index')}}" class="btn btn-dark mt-5">Torna all'elenco progetti</a>
    </div>
@endsection
