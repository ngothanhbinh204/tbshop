<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox product-detail">
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-5">


                            <div class="product-images">

                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 1]
                                    </div>
                                </div>
                            </div>

                        </div>
                        @if (isset($product))
                            <div class="col-md-7">

                                <h2 class="font-bold m-b-xs">
                                    {{ $product->name }}
                                </h2>
                                <hr>
                                <div>
                                    {{-- <button class="btn btn-primary pull-right">Add to cart</button> --}}
                                    <h1 class="product-main-price">{{ $product->price }} VNĐ</h1>
                                </div>
                                <hr>
                                <h4>Mô tả sản phẩm</h4>

                                <div class="small text-muted">
                                    {{ $product->description }}
                                </div>
                                <dl class="dl-horizontal m-t-md small">
                                    <dt>Danh mục :</dt>
                                    <dd>{{ $product->name_category }}</dd>
                                    <dt>Mã sản phẩm</dt>
                                    <dd>{{ $product->sku }}</dd>
                                    <dt>Xuất xứ</dt>
                                    <dd>{{ $product->origin }}</dd>
                                    <dt>Thương hiệu</dt>
                                    <dd>{{ $product->name_brand }}</dd>
                                </dl>
                                <div class="text-right">
                                    <div class="btn-group">
                                        <button class="btn btn-white btn-sm"><i class="fa fa-edit"></i>
                                            <a href="{{ route('product.edit', ['id' => $product->id]) }}">Chỉnh sửa</a>
                                        </button>
                                        <button class="btn btn-white btn-sm"><i class="fa fa-upload"></i> Đăng bán
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>




</div>
