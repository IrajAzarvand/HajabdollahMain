@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات گالری ')
@section('ContentHeader', 'مدیریت گالری')
@section('content')
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    مشاهده و ویرایش گالری
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('Gallery.update',[$SelectedGallery->id]) }}" method="post"
                  enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- /error box -->

                <input type="hidden" name="GalleryId" value="{{$SelectedGallery->id}}">
                <div class="mb3">


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <!-- /.error box -->

                <!-- file uploader -->
                <div class="col-6">
                    <div class="card">
                        <div class="form-group">
                            <label for="exampleInputFile">ارسال تصاویر گالری</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gallery_images[]" class="custom-file-input"
                                           id="fileUploader" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                {{-- show related images of product  --}}

                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                            <label>تصاویر مربوط به گالری <span
                                    style="color: red">(برای حذف تصویر روی آن کلیک کنید)</span></label>
                            <br>
                            @foreach($GalleryImages as $image)

                                <a href="{{ route('GalleryImageRemove', [$SelectedGallery->id,$image]) }}"><img
                                        class="col-3" style="padding-bottom: 10px;"
                                        src="{{asset('storage/Main/Gallery/' . $SelectedGallery->id . '/'. $image)}}"
                                        alt="Photo"></a>

                            @endforeach
                            <br>
                        </div>
                    </div>
                </div>

                {{-- image section end --}}

                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <label>نام گالری</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#g_title_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="g_title_{{$item['locale']}}">
                                            <div class="mb-3">
                                                @foreach ($SelectedGallery->contents as $content)
                                                    @if($content['element_title']=='g_title_'.$item['locale'])
                                                        <textarea id="editor1" name="g_title_{{$item['locale']}}"
                                                                  style="width: 100%">{{$content['element_content']}}</textarea>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- ./card -->
                    </div>
                    <!-- /.col -->
                </div>

                <button type="submit" class="btn btn-primary">ذخیره</button>
                &nbsp;
                <button type="button" onclick="returnBack()" class="btn btn-default">بازگشت</button>
            </form>
        </div>
    </div>
    <!-- /.card -->


    <script>
        function returnBack() {
            window.location.href = "/Gallery";
        }
    </script>

@endsection
