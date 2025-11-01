<div
  class="fixed bottom-0 left-0 z-50 w-full bg-white p-4 text-center shadow-md"
>
  <a
    href="{{ route("admin.index") }}"
    class="{{ request()->is("admin") ? "border-b-2 border-indigo-600 pb-1 text-indigo-600" : "" }} font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600"
  >
    ADMIN
  </a>
</div>

<div class="pt-20"></div>
