@extends('layouts.app')

@section('content')

<h1 class="mb-4">Roles</h1>

<div class="card p-4">

    <ul class="list-group">

        @foreach($role as $role)

        <li class="list-group-item">

            {{ $role->role }}

        </li>

        @endforeach

    </ul>

</div>

@endsection