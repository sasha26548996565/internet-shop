<nav class="main-navbar">
    <div class="container">
        <!-- menu -->
        <ul class="main-menu">
            @foreach ($categories as $category)
                <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
