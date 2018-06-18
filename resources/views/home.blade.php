@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3">

            <div class="border-bottom py-3 mb-3">
                <h1>Core Values</h1>
            </div>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="pb-4">
                <div class="border progress">
                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">{{ $progress }}% Complete</span>
                    </div>
                </div>
            </div>

            @if (is_null($compare))
            <ul class="list-group">
                @foreach ($sorted as $item)
                <li class="list-group-item">{{ $item }}</li>
                @endforeach
            </ul>
            @else
            <form method="POST" action="{{ route('home.store') }}" class="border bg-light p-4">
                @csrf
                <input type="hidden" name="idx" value="{{ $idx }}">
                <input type="submit" name="choice" value="{{ $compare }}" class="btn btn-primary btn-lg"> vs
                <input type="submit" name="choice" value="{{ $sorted[$idx] }}" class="btn btn-primary btn-lg">
            </form>
            @endif

            <div class="text-center p-4">
            <form method="POST" action="{{ route('home.reset') }}">
                @csrf
                <input type="submit" name="reset" value="Reset Quiz" class="btn btn-warning btn-sm">
            </form>
            </div>

        </div>
    </div>
</div>
@endsection
