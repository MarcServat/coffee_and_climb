<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
<h1>Categories</h1>

<ul>
    @foreach($categories as $category)
        <li><a href="{{ route($category->name.join("_")) }}">{{ $category->name }}</a></li>
    @endforeach
</ul>
</body>
</html>
