@extends('layouts.app')

@section('content')
<div class="container">
    <div class="border-bottom py-3 mb-3">
        <h1>Advanced</h1>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ route('advanced.store') }}">
        @csrf
        <div class="form-group">
            <label for="values">Available Values</label>
            <textarea class="form-control" rows="50" id="values" name="values">{{ implode("\n", $values) }}</textarea>
        </div>
        <div class="form-group">
            <label for="count">Top x values</label>
            <input type="text" class="form-control" id="count" name="count" value="{{ $count }}">
        </div>
        <div class="alert alert-danger" role="alert">
            WARNING: Submitting this form will reset your quiz.
        </div>
        <button type="submit" class="btn btn-primary" name="action" value="update">Update</button>
        <button type="submit" class="btn btn-warning" name="action" value="reset">Reset</button>
    </form>

</div>
@endsection
