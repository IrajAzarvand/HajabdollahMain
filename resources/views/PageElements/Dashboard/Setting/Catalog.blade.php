@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات کاتالوگ')
@section('ContentHeader', 'مدیریت کاتالوگ')
@section('content')

    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن کاتالوگ جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('Catalog.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- /error box -->
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>انتخاب نوع و دسته بندی محصول جدید</label>
                                    <select name="ptype" class="form-control select2" onchange="collectCategories(this)"
                                            style="width: 100%;">
                                        <option value="">یکی از انواع اصلی محصولات را انتخاب کنید</option>
                                        @foreach ($product_ptypes as $id=>$ptype)
                                            <option value="{{$id}}">{{$ptype}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- ======================================= --}}
                                <div class="form-group">
                                    <select name="category" id="categories_list" class="form-control select2"
                                            onchange="collectProducts(this)"
                                            style="width: 100%;">
                                        <option value="">یکی از دسته بندی های محصولات را انتخاب کنید</option>
                                    </select>
                                </div>
                                {{-- ======================================= --}}
                                <div class="form-group">
                                    <select name="product" id="products_list" class="form-control select2" onchange="showProductCatalogs(this)"
                                            style="width: 100%;">
                                        <option value="">یکی از محصولات را انتخاب کنید</option>
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
                            <label for="exampleInputFile">ارسال تصاویر کاتالوگ محصول</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="catalog_images[]" class="custom-file-input"
                                           id="fileUploader" multiple required>
                                    <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>
    <!-- /.card -->

    <!-- / =============================================================================== -->
    <!-- /view products list -->
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    مشاهده لیست کاتالوگ محصول
                </h3>

            </div>
            <!-- /.card-header -->

            <div class="card">

                <div class="card-body">

                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <label>کاتالوگ های مربوط به محصول <span
                                        style="color: red">(برای حذف تصویر روی آن کلیک کنید)</span></label>
                                <button onclick="deleteAllCatalogs()" type="submit" class="btn btn-danger">حذف تمام کاتالوگ های محصول</button>

                                <br>
                                <div class="col-12" id="catalogs_list">

                                </div>

                                <br>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

            </div>


        </div>
    </div>
    <!-- /.card -->






    <script>
        function collectCategories(ptype) {
            let selectedPType = ptype.value;
            $.ajax({
                type: "GET",
                url: '/Category/' + selectedPType,

                success: function (data) {

                    $('#categories_list').empty();
                    document.getElementById("categories_list").options[0] = new Option("یکی از دسته بندی های محصولات را انتخاب کنید", "disabled");
                    data.forEach(function (entry) {
                        let list = '';
                        let Cat_id = '';
                        entry.forEach(function (childrenEntry) {
                            list = list + ' (' + childrenEntry.element_content + ') ';
                            Cat_id = childrenEntry.element_id;

                        });
                        let select = document.getElementById("categories_list");
                        select.options[select.options.length] = new Option(list, Cat_id);
                    });
                }
            });
        }
    </script>


    <script>
        function collectProducts(category) {
            let selectedCategory = category.value;
            $.ajax({
                type: "GET",
                url: '/Product/' + selectedCategory,

                success: function (data) {
                    let count = 0;

                    $('#products_list').empty();
                    document.getElementById("products_list").options[0] = new Option("یکی از محصولات را انتخاب کنید", "disabled");

                    data.forEach(function (entry) {
                        count++;
                        entry.forEach(function (childrenEntry) {
                            Product_id = childrenEntry.element_id;
                        });
                        Product_name = entry[0]['element_content'];
                        let select = document.getElementById("products_list");
                        select.options[select.options.length] = new Option(Product_name, Product_id);
                    });
                }
            });
        }
    </script>



    <script>
        function showProductCatalogs(product) {
            let selectedProduct = product.value;
            $.ajax({
                type: "GET",
                url: '/Catalog/' + selectedProduct,

                success: function (data) {
                    $('#catalogs_list').empty();

                    data.forEach(function (entry) {
                        let filename = entry[1].split('/').pop()

                        // create catalogs list
                        let catalog_section = document.getElementById("catalogs_list");

                        // Create <a> tag
                        let a_tag = document.createElement("a");
                        a_tag.setAttribute("onclick", "deleteCatalog('" + selectedProduct +"','"+ filename + "')");

                        catalog_section.appendChild(a_tag);

                        //create img tag inside li
                        let last_a_tag = catalog_section.lastElementChild;
                        let img_obj = document.createElement("img");
                        img_obj.setAttribute("class", "col-3");
                        img_obj.setAttribute("src", entry[1]);
                        img_obj.setAttribute("style", "padding-bottom: 10px;");
                        img_obj.setAttribute("alt", "Photo");
                        last_a_tag.appendChild(img_obj);
                    });

                }
            });
        }
    </script>


    <script>
        function deleteCatalog(product, catalog) {
            $.ajax({
                type: 'GET',
                url: '/Catalog/' + product +'/'+catalog+'/delete',

                success: function (data) {
                    location.reload();

                }

            });

        }
    </script>


    <script>
        function deleteAllCatalogs() {
            let selectedProduct=document.getElementById('products_list').value;
            if(selectedProduct) {
                    let token = "{{ csrf_token() }}";
                    $.ajax({
                    type: 'DELETE',
                    url: '/Catalog/' + selectedProduct,
                    data: {
                    _token: token,
                        selectedProduct
                },
                    success: function() {
                    location.reload();
                }
                });
            }

        }
    </script>

@endsection
