<div>
    <p class="lead">Categories</p>
    <div class="list-group">
        @foreach($categories as $category)
            <a href="#" class="list-group-item {{ $category->id == $current_category ? 'active' : '' }}">{{ $category->name }}</a>
        @endforeach
    </div>
</div>