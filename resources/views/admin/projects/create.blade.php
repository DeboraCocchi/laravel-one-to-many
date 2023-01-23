@extends('layouts.app')

@section('content')

    <div class="container-fluid dc-proj">
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" name="name" value="{{old('name')}}">
                @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" aria-describedby="client_name" name="client_name" value="{{old('client_name')}}">
                @error('client_name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Descrizione Progetto</label><br>
                <textarea name="summary" id="summary" rows="8" class="w-100">{{old('summary')}}</textarea>
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
                    <img id="project-img" width="150" src="" alt="">
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Aggiungi nuovo</button>




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
