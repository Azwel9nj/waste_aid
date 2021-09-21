@extends('layouts.appCouncil')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Add a Zone</h1>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('council.storeZones') }}">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="form-outline mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type=" text" id="name" class="form-control" name="name">
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </div>
            </form>

        </div>
    </div>
@endsection
