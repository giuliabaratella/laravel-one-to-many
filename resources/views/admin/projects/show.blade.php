@extends('layouts.app')
@section('content')
    <section class="container">
        <div class="card">
            @if ($project->image)
                <div>
                    <img class="card-img-top" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                </div>
            @endif
            <div class="card-body">
                <h1>{{ $project->title }}</h1>
                <h3><a href="{{ $project->link }}">{{ $project->link }}</a></h3>
                <p>{{ $project->description }}</p>

            </div>

        </div>


    </section>
@endsection
