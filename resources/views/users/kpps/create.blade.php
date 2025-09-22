@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>Tambah User</h1> --}}
    <form action="{{ route('kpps-users.store') }}" method="POST">
        @csrf
        @include('users.kpps.form')
        {{-- <button type="submit" class="btn btn-success">Simpan</button> --}}
    </form>
</div>
@endsection
