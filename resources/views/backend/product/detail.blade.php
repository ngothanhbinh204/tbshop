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
                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 2]
                                    </div>
                                </div>
                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 3]
                                    </div>
                                </div>


                            </div>

                        </div>
                        @if (isset($product))
                            <div class="col-md-7">

                                <h2 class="font-bold m-b-xs">
                                    {{ $product->name }}
                                </h2>
                                <small>Many desktop publishing packages and web page editors now.</small>
                                <hr>
                                <div>
                                    {{-- <button class="btn btn-primary pull-right">Add to cart</button> --}}
                                    <h1 class="product-main-price">${{ $product->price }} <small
                                            class="text-muted">Exclude Tax</small> </h1>
                                </div>
                                <hr>
                                <h4>Mô tả sản phẩm</h4>

                                <div class="small text-muted">
                                    {{ $product->description }}
                                </div>
                                <dl class="dl-horizontal m-t-md small">
                                    <dt>Danh mục :</dt>
                                    <dd>{{ $product->category_id }}</dd>
                                    <dt>Mã sản phẩm</dt>
                                    <dd>{{ $product->sku }}</dd>
                                    <dt>Xuất xứ</dt>
                                    <dd>{{ $product->origin }}</dd>
                                    <dt>Thương hiệu</dt>
                                    <dd>{{ $product->brand_id }}</dd>
                                </dl>
                                <div class="text-right">
                                    <div class="btn-group">
                                        <button class="btn btn-white btn-sm"><i class="fa fa-star"></i> Add to wishlist
                                        </button>
                                        <button class="btn btn-white btn-sm"><i class="fa fa-envelope"></i> Contact with
                                            author </button>
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
