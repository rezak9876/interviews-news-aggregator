@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin News Dashboard</h1>

    @if ($message = Session::get('success'))
    <div class="alert alert-success mt-2">
        {{ $message }}
    </div>
    @endif

    <div class="card mt-2">
        <div class="card-header">
            Last Updates
        </div>
        <div class="card-body">
            <p>Last Manual Update: {{ $lastManualUpdate ? $lastManualUpdate->created_at->toDateTimeString() : 'Never' }}</p>
            <p>Last Automatic Update: {{ $lastAutomaticUpdate ? $lastAutomaticUpdate->created_at->toDateTimeString() : 'Never' }}</p>
        </div>
    </div>

    <form id="updateForm" action="{{ route('admin.news.update') }}" method="POST" class="mt-3">
        @csrf
        <button id="updateButton" type="submit" class="btn btn-primary">
            Update News
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    </form>
</div>
@endsection