@include('backend.dashboard.components.heading', [
    'title' => config('apps.user.index.title'),
    'table' => config('apps.user.index.table'),
])

@include('backend.user.components.filter')
@include('backend.user.components.table', ['table' => config('apps.user.index.table')])
