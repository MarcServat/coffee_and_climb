@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="max-w-sm mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Admin Login</h1>
    @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.auth.login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1" for="username">Username</label>
            <input id="username" name="username" type="text" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1" for="password">Password</label>
            <input id="password" name="password" type="password" required class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded">Login</button>
    </form>
</div>
@endsection
