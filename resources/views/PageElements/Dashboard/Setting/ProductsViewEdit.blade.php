@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات محصولات')
@section('ContentHeader', 'مدیریت محصولات')
@section('content')
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    مشاهده و ویرایش محصول
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('Product.update',[$Selectedproduct->id]) }}" method="post"
                  enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- /error box -->

                <input type="hidden" name="ProductId" value="{{$Selectedproduct->id}}">
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

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> نوع و دسته بندی محصول</label>
                                <select name="ptype" class="form-control select2" onchange="collectCategories(this)"
                                        disabled style="width: 100%;">
                                    <option value="">یکی از انواع اصلی محصولات را انتخاب کنید</option>
                                    @foreach ($product_ptypes as $id=>$ptype)
                                        <option value="{{$id}}"
                                                @if($id==$Selectedptype) selected @endif>{{$ptype}}</option>
                                    @endforeach
                                </select>
                                <hr>
                                {{-- ======================================= --}}
                                <div class="form-group">
                                    <select name="category" id="categories_list" class="form-control select2"
                                            style="width: 100%;">
                                        <option value="">یکی از دسته بندی های محصولات را انتخاب کنید</option>
                                        @foreach ($ptype_categories as $key=>$value)
                                            <option value="{{$value['id']}}"
                                                    @if($value['id']==$Selectedproduct->cat_id) selected @endif>{{$value['contents']['0']['element_content']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- file uploader -->
                <div class="col-6">
                    <div class="card">
                        <div class="form-group">
                            <label for="exampleInputFile">ارسال تصاویر محصول</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="product_images[]" class="custom-file-input"
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
                            <label>تصاویر مربوط به محصول <span
                                    style="color: red">(برای حذف تصویر روی آن کلیک کنید)</span></label>
                            <br>
                            @foreach($ProductImages as $image)

                                <a href="{{ route('ProductImageRemove', [$Selectedproduct->id,$image]) }}"><img
                                        class="col-3" style="padding-bottom: 10px;"
                                        src="{{asset('storage/Main/Products/' . $Selectedproduct->id . '/'. $image)}}"
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
                            <label>نام محصول</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#p_name_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="p_name_{{$item['locale']}}">
                                            <div class="mb-3">
                                                @foreach ($Selectedproduct->contents as $content)
                                                    @if($content['element_title']=='p_name_'.$item['locale'])
                                                        <textarea id="editor1" name="p_name_{{$item['locale']}}"
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


                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <label>معرفی محصول</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#p_introduction_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="p_introduction_{{$item['locale']}}">
                                            <div class="mb-3">
                                                @foreach ($Selectedproduct->contents as $content)
                                                    @if($content['element_title']=='p_introduction_'.$item['locale'])
                                                        <textarea id="editor1" name="p_introduction_{{$item['locale']}}"
                                                                  style="width: 100%"
                                                                  rows="10">{{$content['element_content']}}</textarea>
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


                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <label>ارزش غذایی</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#nutritionalValue_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="nutritionalValue_{{$item['locale']}}">
                                            <div class="mb-3">
                                                @foreach($Selectedproduct->contents as $content)
                                                    @if($content['element_title']=='nutritionalValue_'.$item['locale'])
                                                        <textarea id="editor1"
                                                                  name="nutritionalValue_{{$item['locale']}}"
                                                                  style="width: 100%"
                                                                  rows="10">{{$content['element_content']}}</textarea>
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
        function collectCategories(ptype) {

            let selectedPType = ptype.value;
            let selectedCategory =@JSON($Selectedproduct->cat_id);

            $.ajax({
                type: "GET",
                url: '/Category/' + selectedPType,

                success: function (data) {
                    console.log(data);
                    $('#categories_list').empty();
                    data.forEach(function (entry) {
                        let list = '';
                        let Cat_id = '';
                        entry.forEach(function (childrenEntry) {
                            list = list + ' (' + childrenEntry.element_content + ') ';
                            Cat_id = childrenEntry.element_id;

                        });
                        let select = document.getElementById("categories_list");
                        select.options[select.options.length] = new Option(list, Cat_id);
                        $("#categories_list option[value='" + selectedCategory + "']").attr("selected", "selected");
                    });
                }
            });
        }
    </script>


    <script>
        function returnBack() {
            window.location.href = "/Product";
        }
    </script>

@endsection
