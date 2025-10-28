@extends('layouts.app')

@section('title', '$categories')

@section('content')
<h1>Categories</h1>

<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('categories.index') . '/' . Str::slug($category->name) }}">
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
@endsection
