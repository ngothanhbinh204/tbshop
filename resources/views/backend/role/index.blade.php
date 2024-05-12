@include('backend.dashboard.components.heading', [
    'title' => config('apps.role.index.title'),
    'table' => config('apps.role.index.table'),
])

@include('backend.role.components.filter')
@include('backend.role.components.table', ['table' => config('apps.role.index.table')])
