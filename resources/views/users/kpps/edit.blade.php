@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>Edit User</h1> --}}
    <form action="{{ route('kpps-users.update', $user) }}" method="POST">
        @csrf 
        @method('PUT')
        @include('users.kpps.form')
        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
    </form>
</div>
@endsection
