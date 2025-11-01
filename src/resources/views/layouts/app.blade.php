<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>@yield("title", "My Laravel App")</title>
    @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
      @vite(["resources/css/app.css", "resources/js/app.js"])
    @else
      <style></style>
    @endif
  </head>
  <body>
    @include("partials.navbar")

    <div class="container mt-4">
      @yield("content")
    </div>

    @include("partials.admin")

    <script src="{{ asset("js/app.js") }}"></script>
  </body>
</html>
