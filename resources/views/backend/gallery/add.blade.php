@include('backend.dashboard.components.heading', [
    'title' => config('apps.product.create.title'),
])
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    {{-- xuất lỗi  --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session::put('message', null);
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <form action="{{ route('admin.gallery.insert', $pro_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3"></div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <input type="file" class="form-control" id="file" name="fileImage[]"
                                accept="image/*" multiple>
                            <span id="error_gallery"></span>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <input class="btn btn-success" type="submit" name="upload" name="taianh" value="Tải ảnh">
                        </div>
                    </div>
                </form>
                <ul class="nav nav-tabs">
                    {{-- <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin cơ bản</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"> Dữ liệu sản phẩm</a></li> --}}
                    {{-- <li class=""><a data-toggle="tab" href="#tab-3"> Discount</a></li> --}}
                    <li class="active"><a data-toggle="tab" href="#tab-4"> Hình ảnh</a></li>
                </ul>
                <div class="tab-content">

                    <form action="">
                        @csrf
                        <input type="hidden" value="{{ $pro_id }}" name="pro_id" class="pro_id">
                        <div id="tab-4" class="tab-pane active">
                            <div class="panel-body">
                                <div class="table-responsive" id="gallery_load">
                                </div>
                            </div>
                        </div>
                    </form>

                    <script></script>

                </div>
            </div>
            <div class="text-right">
                <div class="form-group col-sm-12 m-t-xl"> <button type="submit" class="btn btn-primary">Lưu
                        lại</button> </div>
            </div>
        </div>
    </div>

</div>
