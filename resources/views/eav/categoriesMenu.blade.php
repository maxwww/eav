<div>
    <p class="lead">Categories</p>
    <div class="list-group">
        @foreach($categories as $category)
            <a href="{{ URL::to('/categories/'. $category->id) }}" class="list-group-item {{ $category->name == $current_category ? 'active' : '' }}">{{ $category->name }}</a>
        @endforeach
    </div>
</div>