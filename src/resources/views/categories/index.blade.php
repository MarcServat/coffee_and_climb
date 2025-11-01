@extends("layouts.app")

@section("title", "Categories")

@section("content")
  <section class="mx-auto flex max-w-4xl justify-center p-4">
    <ul>
      @foreach ($categories as $category)
        <li>
          <a
            class="flex items-center p-2"
            href="{{ route("categories.index") . "/category/" . $category->id }}"
          >
            <img
              width="200px"
              height="100px"
              class="mr-2"
              src="{{ asset("images/categories/" . Str::slug($category->name)) . ".webp" }}"
              alt="{{ $category->name }}"
            />
            <p
              class="font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600"
            >
              {{ $category->name }}
            </p>
          </a>
        </li>
      @endforeach
    </ul>
  </section>
@endsection
