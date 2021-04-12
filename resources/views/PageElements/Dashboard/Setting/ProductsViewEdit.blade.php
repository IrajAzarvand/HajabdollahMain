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

                <input type="hidden" name="PtypeId" value="{{$Selectedptype}}">
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
                            <label for="exampleInputFile">ارسال تصاویر محصول تصاویر مربوط به محصول <span
                                    style="color: red">(نام فایل باید مطابق یکی از زبان های سایت باشد)</span></label>
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
                                <a href="{{ route('ProductImageRemove', [$Selectedproduct->id,$image['file']]) }}"><img
                                        class="col-3" style="padding-bottom: 10px;"
                                        src="{{$image['img']}}"
                                        alt="Photo"></a>

                            @endforeach
                            <br>
                        </div>
                    </div>
                </div>

                {{-- image section end --}}

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
