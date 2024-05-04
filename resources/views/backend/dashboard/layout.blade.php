<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.components.head')
</head>

<body>

    <div id="wrapper">
        @include('backend.dashboard.components.leftSidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('backend.dashboard.components.nav')

            {{-- Content Thay Đổi --}}
            @include($template)
            {{-- Content Thay Đổi --}}

            @include('backend.dashboard.components.footer')
        </div>
        @include('backend.dashboard.components.rightSidebar')
    </div>
    @include('backend.dashboard.components.script')
</body>

</html>
