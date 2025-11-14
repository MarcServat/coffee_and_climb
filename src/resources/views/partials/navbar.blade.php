<nav class="fixed left-0 top-0 z-50 w-full bg-white shadow-md">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <a
        href="{{ url("/") }}"
        class="text-md flex-col justify-items-center font-semibold text-gray-700 hover:text-indigo-600"
      >
        @include("partials.logo")
        Coffee & Climb
      </a>

      <ul class="flex space-x-6">
        @foreach ($categories as $category)
          <li>
            <a
              href="{{ route("categories.index") . "/category/" . $category->id }}"
              class="{{ request()->is("category/" . $category->id) ? "border-b-2 border-indigo-600 pb-1 text-indigo-600" : "" }} font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600"
            >
              {{ $category->name }}
            </a>
          </li>
        @endforeach
      </ul>
      <a
        class="cursor-pointer p-1 transition-colors duration-200 hover:bg-indigo-800"
        href="{{ route('cart.index') }}"
      >
        <x-bi-cart-fill />
      </a>
    </div>
  </div>
</nav>

<div class="pt-20"></div>
