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
        @guest
            <a href="{{ route('login.index') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Login</a>
        @endguest
        @auth
            <div class="flex flex-col items-center space-x-4">
                <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="text-center">
                    @csrf
                    <button type="submit" class="cursor-pointer text-sm text-gray-600 hover:text-indigo-800 underline">Logout</button>
                </form>
            </div>
        @endauth
      <a
        class="cursor-pointer p-2 transition-colors duration-200 rounded-2xl hover:bg-indigo-300"
        href="{{ route('cart.index') }}"
      >
        <x-bi-cart-fill />
      </a>
    </div>
  </div>
</nav>

<div class="pt-20"></div>
