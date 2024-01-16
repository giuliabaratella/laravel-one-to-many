@extends('layouts.app')
@section('content')
    <section class="container">
        <div class="card">
            <div class="card-header">
                <h1>All {{ $category->name }} projects</h1>
            </div>
            <div class="card-body">

                <ul>
                    @forelse ($category->projects as $project)
                        <li>{{ $project->title }}</li>
                    @empty
                        <li>No projects</li>
                    @endforelse
                </ul>


            </div>

        </div>


    </section>
@endsection
