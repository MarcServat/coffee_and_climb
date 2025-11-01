@extends("layouts.app")

@section("title", $category->name)

@section("content")
  <div class="mx-auto max-w-4xl p-4">
    <h1 class="mb-6 text-3xl font-bold text-gray-800">
      Products in {{ $category->name }}
    </h1>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <!-- Product Card -->
      @foreach ($category->products as $product)
        <div
          class="rounded-lg bg-white p-4 shadow-md transition-shadow duration-300 hover:shadow-xl"
        >
          <h2 class="mb-2 text-xl font-semibold text-gray-700">
            {{ $product->name }}
          </h2>
          <p class="font-medium text-gray-600">
            ${{ number_format($product->price, 2) }}
          </p>
        </div>
        <button>Add to cart</button>
      @endforeach
    </div>
  </div>
@endsection
