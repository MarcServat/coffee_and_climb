@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="p-8 space-y-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold text-center">Login</h2>
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="w-md space-y-4" method="POST" action="{{ route('login.authenticate') }}">
            @csrf
            @include("partials.login")
        </form>
    </div>
</div>
@endsection

