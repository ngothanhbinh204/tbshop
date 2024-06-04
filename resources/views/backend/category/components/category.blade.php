<option value="{{ $category->id }}">
    {{ str_repeat('-- ', $level) }} {{ $category->name }}
</option>
@if (isset($category->children))
    @foreach ($category->children as $child)
        @include('backend.category.components.category', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
