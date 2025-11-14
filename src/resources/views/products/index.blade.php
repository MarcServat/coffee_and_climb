@extends("layouts.app")

@section("title", $category->name)

@section("content")
  <div class="flex items-center justify-center">
    <div class="mx-auto w-full max-w-4xl p-4">
      <h1 class="mb-6 text-center text-3xl font-bold">
        Products in {{ $category->name }}
      </h1>
      <div class="grid grid-cols-2 justify-center gap-6 sm:grid-cols-1">
        <!-- Product Card -->
        @foreach ($category->products as $product)
          <a
            href="{{ route("products.show", [$category->id, $product->id]) }}"
          >
            <div
              class="pointer-events-auto flex justify-center gap-6 rounded-lg bg-white p-4 shadow-md transition-shadow duration-300 hover:shadow-xl"
            >
              <div class="flex flex-shrink-0 items-center justify-center">
                <img
                  width="200px"
                  height="100px"
                  class="mx-auto object-contain"
                  src="{{ asset("images/" . Str::slug($category->name) . "/" . Str::slug($product->name)) . ".webp" }}"
                  alt="{{ $product->name }}"
                />
              </div>
              <div class="ml-6 flex flex-col justify-center">
                <h2 class="mb-2 text-left text-xl font-semibold text-gray-700">
                  {{ $product->name }}
                </h2>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
@endsection
