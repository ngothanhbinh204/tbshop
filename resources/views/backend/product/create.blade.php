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
    <div class="row">
        <form action="{{ route('product.store') }}" method="post">
            @csrf
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin cơ bản</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"> Dữ liệu sản phẩm</a></li>
                        {{-- <li class=""><a data-toggle="tab" href="#tab-3"> Discount</a></li> --}}
                        <li class=""><a data-toggle="tab" href="#tab-4"> Hình ảnh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">

                                <fieldset class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">Tên sản phẩm:</label>
                                        <div class="col-sm-10"><input value="{{ old('name') }}" name="name"
                                                type="text" class="form-control" placeholder="Tên sản phẩm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Giá:</label>
                                        <div class="col-sm-10"><input value="{{ old('price') }}" name="price"
                                                id="priceInput" type="number" class="form-control"
                                                placeholder="$160.00" min="0" max="1000000000"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Mô tả:</label>
                                        <div class="col-sm-10">

                                            <textarea class="summernoteProduct" name="description">

                                        </textarea>

                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Giá khuyến
                                            mãi:</label>
                                        <div class="col-sm-10"><input value="{{ old('price_sale') }}" name="price_sale"
                                                id="" type="number" class="form-control"
                                                placeholder="$160.00"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Mã hàng hóa:</label>
                                        <div class="col-sm-10">
                                            <input value="{{ old('sku') }}" name="sku" type="text"
                                                class="form-control" placeholder="SKU123..">
                                        </div>
                                    </div>

                                </fieldset>

                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <fieldset class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">Trọng lượng:</label>
                                        <div class="col-sm-10">
                                            <input value="{{ old('weight') }}" name="weight" type="number"
                                                class="form-control" placeholder="560gram">
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Trạng thái:</label>
                                        <div class="col-sm-10">
                                            <select value="{{ old('status') }}" name="status" id=""
                                                class="form-control">
                                                <option value="1">Kích hoạt</option>
                                                <option value="0">Không kích hoạt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Danh mục:</label>
                                        <div class="col-sm-10">
                                            <select value="{{ old('category_id') }}" name="category_id" id=""
                                                class="setupSelect2 form-control">
                                                <option value="">[ Chọn danh mục ]</option>
                                                @if (isset($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Thương hiệu:</label>
                                        <div class="col-sm-10">
                                            <select value="{{ old('brand_id') }}" name="brand_id" id=""
                                                class="setupSelect2 form-control">
                                                <option value="">[ Chọn thương hiệu ]</option>
                                                @if (isset($brands))
                                                    @foreach ($brands as $brands)
                                                        <option value="{{ $brands->id }}">
                                                            {{ $brands->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Xuất xứ:</label>
                                        <div class="col-sm-10">
                                            <select value="{{ old('origin') }}" class="setupSelect2 from-control"
                                                name="origin" id="">
                                                @if (isset($provinces))
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->name }}">
                                                            {{ $province->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group"><label class="col-sm-2 control-label">Màu sắc</label>
                                        <div class="col-sm-10">
                                            @if (isset($colors))
                                                @foreach ($colors as $color)
                                                    <label class="checkbox-inline">
                                                        <input value="{{ $color->id }}" name="id_attr[]"
                                                            type="checkbox" value="{{ $color->type }}"
                                                            id="inlineCheckbox1">
                                                        <i style="color: {{ $color->value }}"
                                                            class="fa fa-circle"></i>
                                                    </label>
                                                @endforeach
                                            @endif


                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Kích thước</label>
                                        <div class="col-sm-10">
                                            @if (isset($sizes))
                                                @foreach ($sizes as $size)
                                                    <label class="checkbox-inline">
                                                        <input value="{{ $size->id }}" name="id_attr[]" type="checkbox"
                                                            value="{{ $size->type }}" id="inlineCheckbox1">
                                                        {{ $size->value }}
                                                    </label>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Số lượng:</label>
                                        <div class="col-sm-10">
                                            <input value="{{ old('quantity') }}" name="quantity" type="number"
                                                class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Image preview
                                                </th>
                                                <th>
                                                    Image url
                                                </th>
                                                <th>
                                                    Sort order
                                                </th>
                                                <th>
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/2s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image1.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="1">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/1s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image2.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="2">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/3s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image3.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="3">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/4s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image4.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="4">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/5s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image5.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="5">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/6s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image6.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="6">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/gallery/7s.jpg">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="http://mydomain.com/images/image7.png">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="7">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="form-group col-sm-12 m-t-xl"> <button type="submit" class="btn btn-primary">Lưu
                            lại</button> </div>
                </div>
            </div>

        </form>
    </div>

</div>
