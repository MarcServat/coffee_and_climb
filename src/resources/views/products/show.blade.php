@extends("layouts.app")

@section("title", $product->name)

@section("content")
  <div class="flex items-center justify-center">
    <div class="mx-auto w-full max-w-4xl p-4">
      <h1 class="mb-6 text-center text-3xl font-bold text-gray-800">
        {{ $product->name }}
      </h1>
      <div class="grid grid-cols-2 justify-center gap-6 sm:grid-cols-1">
        <!-- Product Details -->
        <div
          class="pointer-events-auto flex justify-center gap-6 rounded-lg bg-white p-4 shadow-md transition-shadow duration-300 hover:shadow-xl"
        >
          <div class="flex flex-shrink-0 items-center justify-center">
            <img
              width="300px"
              height="200px"
              class="mx-auto object-contain"
              src="{{ asset("images/" . Str::slug($category->name) . "/" . Str::slug($product->name)) . ".webp" }}"
              alt="{{ $product->name }}"
            />
          </div>
          <div class="ml-6 flex flex-col justify-between">
            <h2 class="mb-2 text-left text-xl font-semibold text-gray-700">
              {{ $product->name }}
            </h2>
            <p class="text-left font-medium text-gray-600">
              {{ $product->description }}
            </p>
            <div class="flex justify-between">
              <p class="text-left text-xxl text-gray-600">
                ${{ number_format($product->price, 2) }}
              </p>
              <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary">Add to cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
