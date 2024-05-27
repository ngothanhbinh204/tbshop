<base href="{{ env('APP_URl') }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Laravel - AdminManager</title>

{{-- Link TailWind CSS --}}
<link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
{{-- css checkbox --}}
{{-- <link href="{{ asset('css/plugins/iCheck/custom.css') }}"
    rel="stylesheet"> --}}
<link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

<link href="{{ asset('backend/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">

{{-- table product --}}
<link href="{{ asset('backend/css/plugins/footable/footable.core.css') }}" rel="stylesheet">

<link href="{{ asset('backend/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@latest/dist/css/select2.min.css" rel="stylesheet">
<link href="{{ asset('backend/css/customize.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

{{-- Biểu đồ --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
