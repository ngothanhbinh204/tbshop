@include('backend.dashboard.components.heading', [
    'title' => config('apps.post.create.title'),
    'table' => config('apps.post.create.table'),
])
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

<form action="{{ route('post.update', ['id' => $post->id]) }}">
    @csrf
    @method('PUT')
    @if (isset($post))
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Chỉnh sửa bài viết bằng Summernote</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content no-padding">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group ibox-title">
                                        <label for="">Tiêu đề bài viết hiện tại</label>
                                        <input value="{{ $post->title }}" class="form-control" type="text"
                                            name="title">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group ibox-title">
                                        <label for="">Chủ đề bài viết hiện tại :
                                            <div class="text-danger">
                                                {{ $post->category_post()->first()->name }}</div>
                                        </label>
                                        <select class="form-control setupSelect2" name="category_id" id="">
                                            @if (isset($post->category_post()->first()->name))
                                                <option value="{{ $post->category_post()->first()->id }}">
                                                    {{ $post->category_post()->first()->name }}
                                                </option>
                                            @else
                                                <option value="0">[ Chọn Chủ Đề Bài Viết]</option>
                                            @endif

                                            @if (isset($categories))
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Tạo văn bản --}}
                            <textarea id="summernote" name="content">
                                {!! old('content', $post->content) !!}
                            </textarea>
                            {{-- Tạo văn bản --}}

                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="text-right btn btn-primary">Cập nhật</button>
        </div>
    @endif

</form>
