<ul class="product-filter-menu">
    @foreach ($categories as $category)
        <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
    @endforeach
</ul>
