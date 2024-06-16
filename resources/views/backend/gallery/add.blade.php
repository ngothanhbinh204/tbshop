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
                                <div class="lightBoxGallery" id="gallery_load">
                                    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                                    <div id="blueimp-gallery" class="blueimp-gallery">
                                        <div class="slides"></div>
                                        <h3 class="title"></h3>
                                        <a class="prev">‹</a>
                                        <a class="next">›</a>
                                        <a class="close">×</a>
                                        <a class="play-pause"></a>
                                        <ol class="indicator"></ol>
                                    </div>

                                </div>
                                {{-- <div class="table-responsive" id="gallery_load">
                                </div> --}}
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa ảnh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="gal_id" id="modal_gal_id">
                    <div class="form-group">
                        <label for="file_image">Chọn ảnh mới:</label>
                        <input type="file" class="form-control-file" name="file_image" id="file_image"
                            accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>

<script>
    // var a =  document.querySelectorAll('.gallery-item');
    // document.querySelectorAll('.gallery-item').forEach(item => {
    //     item.addEventListener('mouseenter', () => {
    //         item.querySelector('.overlay').style.opacity = '1';
    //     });
    //     item.addEventListener('mouseleave', () => {
    //         item.querySelector('.overlay').style.opacity = '0';
    //     });
    // });
</script>
