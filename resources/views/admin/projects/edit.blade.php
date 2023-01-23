@extends('layouts.app')

@section('content')

    <div class="container-fluid dc-proj">
        <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" name="name" value="{{old('name', $project->name)}}">
                @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" aria-describedby="client_name" name="client_name" value="{{old('client_name', $project->client_name)}}">
                @error('client_name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <div class="date w-50 me-5">
                    <label for="created" class="form-label">Project Creation Date</label>
                    <input type="date" class="form-control @error('created') is-invalid @enderror" id="created" aria-describedby="name" name="created" value="{{old('created', $project->created)}}">
                    @error('created')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="type w-50 mt-4">
                    <select class="form-select mt-2" name="type_id">
                        <option value="">Scegli una categoria di progetto</option>
                        @foreach ($types as $type)
                        <option
                        @if ($type->id == old('type_id', $project?->type_id)) selected @endif
                            value="{{$type->id}}">{{$type->name}}
                        </option>
                        @endforeach

                    </select>
                </div>

            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Descrizione Progetto</label><br>
                <textarea name="summary" id="summary" rows="8" class="w-100">{{old('summary', $project->summary)}}</textarea>
                @error('summary')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Immagine Progetto</label>
                <input
                onchange="showImage(event)"
                 type="file" class="form-control @error('cover_image') is-invalid @enderror"  id="cover_image" name="cover_image" value="{{old('cover_image')}}">
                @error('cover_image')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
                <div class="cover_image mt-2" >
                    <img id="project-img" width="150"
                    @if (str_contains($project->cover_image,'http')) src="{{$project->cover_image}}"
                    @else src="{{ asset('storage/'. $project->cover_image)}}"
                   @endif alt="{{$project->image_original_name}}" >
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Conferma modifiche</button>




        </form>
    </div>
    <script>
        ClassicEditor
                .create( document.querySelector( '#text' ),{
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                })
                .catch( error => {
                    console.error( error );
                } );
        function showImage(event){
            const tagImage = document.getElementById('project-img');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
        </script>
@endsection
