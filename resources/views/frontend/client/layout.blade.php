<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.client.components.head')
</head>

<body>
    @include('frontend.client.components.header')
    {{-- Content Thay Đổi --}}
    @include($template)
    {{-- Content Thay Đổi --}}
</body>
@include('frontend.client.components.footer')
@include('frontend.client.components.search')
@include('frontend.client.components.script')

</html>
