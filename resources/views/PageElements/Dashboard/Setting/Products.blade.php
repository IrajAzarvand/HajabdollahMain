@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات محصولات')
@section('ContentHeader', 'مدیریت محصولات')
@section('content')

<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                افزودن محصول جدید
            </h3>

        </div>
        <!-- /.card-header -->
        <form class="card-body" action="{{ route('Product.store') }}" method="post" enctype="multipart/form-data">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>انتخاب نوع و دسته بندی محصول جدید</label>
                            <select name="ptype" class="form-control select2" onchange="collectCategories(this)" style="width: 100%;">
                                <option value="">یکی از انواع اصلی محصولات را انتخاب کنید</option>
                                @foreach ($product_ptypes as $id=>$ptype)
                                <option value="{{$id}}">{{$ptype}}</option>
                                @endforeach
                            </select>
                            <hr>
                            {{-- ======================================= --}}
                            <div class="form-group">
                                <select name="category" id="categories_list" class="form-control select2" style="width: 100%;">
                                    <option value="">یکی از دسته بندی های محصولات را انتخاب کنید</option>
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
                    <h6 style="color: red">نام فایل مطابق زبان مورد نظر باشد (fa, en, ru, tr)</h6>

                    <div class="form-group">
                        <label for="exampleInputFile">ارسال تصاویر محصول</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="product_images[]" class="custom-file-input" id="fileUploader" multiple required>
                                <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

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
                مشاهده لیست محصولات
            </h3>

        </div>
        <!-- /.card-header -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    لیست محصولات ثبت شده
                </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-4">
                            <label>انتخاب نوع و دسته بندی محصول جدید</label>
                            <select name="ptypeList" class="form-control select2" onchange="collectAllCategories(this)" style="width: 100%;">
                                <option value="">یکی از انواع اصلی محصولات را انتخاب کنید</option>
                                @foreach ($product_ptypes as $id=>$ptype)
                                <option value="{{$id}}">{{$ptype}}</option>
                                @endforeach
                            </select>
                            <hr>
                            {{-- ======================================= --}}
                            <div class="form-group">
                                <select name="categoryList" id="ShowcategoriesList" class="form-control select2" onchange="showCategoryProducts(this)" style="width: 100%;">
                                    <option value="">یکی از دسته بندی های محصولات را انتخاب کنید</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>




                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">جدول محصولات</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="ProductsTable">
                                    <tr>
                                        <th>#</th>
                                        <th>محصول</th>
                                        <th>عملیات</th>
                                    </tr>
                                    <tr id="ProductsList">

                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div><!-- /.row -->
            </div>
            <!-- /.card-body -->

        </div>


    </div>
</div>
<!-- /.card -->






<script>
{{--    for adding new products section--}}
    function collectCategories(ptype)
{
    let selectedPType=ptype.value;


        $.ajax({
            type: "GET",
            url: '/Category/' + selectedPType,

            success: function (data) {

                $('#categories_list').empty();
                data.forEach(function(entry){
                let list='';
                let Cat_id='';
                    entry.forEach(function(childrenEntry) {
                        list = list + ' (' +  childrenEntry.element_content + ') ';
                        Cat_id=childrenEntry.element_id;

                    });
                        let select = document.getElementById("categories_list");
                        select.options[select.options.length] = new Option(list, Cat_id);
                });
            }
        });
}
</script>



{{--<script>--}}
{{--    function showCategory() {--}}
{{--        let ptypeId=document.getElementById('ptypeId').value;--}}
{{--        $.ajax({--}}
{{--            type: "GET",--}}
{{--            url: '/Category/' + ptypeId,--}}

{{--            success: function (data) {--}}

{{--                // create category list--}}
{{--                function createElementLi(obj) {--}}
{{--                    let ul_obj = document.getElementById(obj);--}}

{{--                    // Create li--}}
{{--                    let li_obj = document.createElement("li");--}}
{{--                    ul_obj.appendChild(li_obj);--}}

{{--                    //create span inside li--}}
{{--                    let last_li = ul_obj.lastElementChild;--}}
{{--                    let span_obj = document.createElement("span");--}}
{{--                    span_obj.setAttribute("class", "text");--}}
{{--                    last_li.appendChild(span_obj);--}}
{{--                }--}}


{{--                //show content--}}
{{--                let list='';--}}
{{--                let Cat_id='';--}}
{{--                $('#CategoryList').empty();--}}
{{--                data.forEach(function(entry){--}}
{{--                    entry.forEach(function(childrenEntry) {--}}
{{--                        list = list + ' (' +  childrenEntry.element_content + ') ';--}}
{{--                        Cat_id=childrenEntry.element_id;--}}
{{--                    });--}}
{{--                    createElementLi("CategoryList");--}}
{{--                    let lst_LI=document.getElementById("CategoryList").lastElementChild;--}}
{{--                    let spn=lst_LI.getElementsByTagName("span");--}}
{{--                    spn[0].innerHTML='<a onclick="editRow('+ Cat_id +')"><i class="fa fa-edit"></i></a> &nbsp; <a onclick="deleteRow('+ Cat_id +')"><i class="fa fa-trash-o"></i></a>' + list;--}}
{{--                    list='';--}}
{{--                });--}}


{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}





{{-- ====================for show all products=============== --}}
<script>

{{--    after selecting ptype, this will show categories related to that ptype--}}
    function collectAllCategories(ptype)
{
    let selectedPType=ptype.value;
        $.ajax({
            type: "GET",
            url: '/Category/' + selectedPType,

            success: function (data) {

                $('#ShowcategoriesList').empty();
                document.getElementById("ShowcategoriesList").options[0] = new Option("یکی از دسته بندی های محصولات را انتخاب کنید", "disabled");
                data.forEach(function(entry){
                let list='';
                let Cat_id='';
                    entry.forEach(function(childrenEntry) {
                        list = list + ' (' +  childrenEntry.element_content + ') ';
                        Cat_id=childrenEntry.element_id;

                    });
                        let select = document.getElementById("ShowcategoriesList");
                        select.options[select.options.length] = new Option(list, Cat_id);
                });
            }
        });
}
</script>

<script>
{{--    after selecting category, this will show products related to that category--}}
    function showCategoryProducts(category) {
        let selectedCategory=category.value;

        $.ajax({
            type: "GET",
            url: '/Product/' + selectedCategory,

            success: function (data) {
                //show content
                console.log(data);
                let Product_id='';
                let Product_image='';
                let count=0;
                let table = document.getElementById("ProductsTable");
                $('#ProductsTable').empty();
                let row = table.insertRow();
                row.insertCell(0).innerHTML= "#";
                row.insertCell(1).innerHTML= "محصول";
                row.insertCell(2).innerHTML= "عملیات";

                data.forEach(function(entry){
                    count++;
                    // entry.forEach(function(childrenEntry) {
                        Product_id = entry.id;
                    // });
                    Product_image = entry.image;
                    let rowCount = table.rows.length;
                    let row = table.insertRow(rowCount);

                    row.insertCell(0).innerHTML= count;
                    row.insertCell(1).innerHTML= '<img src="'+Product_image+'" style="width: 25%"/>';

                    row.insertCell(2).innerHTML= '<button type="button" class="btn btn-primary"><a onclick="viewEditProduct('+ Product_id +')"><i class="fa fa-eye"></i></a></button> &nbsp <button type="button" class="btn btn-danger"><a onclick="deleteProduct('+ Product_id +')"><i class="fa fa-trash-o"></i></a></button>';
                });


            }
        });
    }
</script>



<script>
    function viewEditProduct(product) {
        window.location.href = "/Product/"+product+"/edit";
    }
</script>



<script>
    function deleteProduct(product) {
        let token = "{{ csrf_token() }}";
        $.ajax({
            type: 'DELETE',
            url: '/Product/' + product,
            data: {
            _token: token,
            product
            },
            success: function() {
                location.reload();
            }
        });

    }
</script>


@endsection
