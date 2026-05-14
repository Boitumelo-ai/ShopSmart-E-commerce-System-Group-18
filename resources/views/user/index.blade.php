@extends('layouts.app')

@section('content')

<h1 class="mb-4">Users</h1>

<div class="card p-4">

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>

            @foreach($user as $user)

            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection