@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات دسته بندی محصولات')
@section('ContentHeader', 'دسته بندی محصولات')
@section('content')

    <div class="col-md-9">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن دسته بندی جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('Category.store') }}" method="post" enctype="multipart/form-data">
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
                                <label>انتخاب نوع محصول</label>
                                <select name="ptype" class="form-control select2" style="width: 100%;">
                                    @foreach ($PTypes as $item)
                                        <option value="{{$item->id}}">{{$item->contents['0']->element_content}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <label>تصاویر دسته بندی محصول</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#file_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="file_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <input type="file" name="CatImg_{{$item['locale']}}">
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
            </form>
        </div>
    </div>
    <!-- /.card -->






    <div class="col-9">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    لیست دسته بندی ها
                </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="box-body">
                    <div class="row">
                        <label>انتخاب نوع محصول</label>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="ptype" id="ptypeId" onchange="showCategory()" class="form-control select2"
                                        style="width: 100%;">
                                    <option>یکی از انواع محصولات را انتخاب کنید</option>
                                    @foreach ($PTypes as $item)
                                        <option value="{{$item->id}}">{{$item->contents['0']->element_content}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="card">

                    <div class="card-body">

                        <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <label>دسته بندی های مربوط به نوع محصول <span
                                            style="color: red">(برای حذف تصویر روی آن کلیک کنید)</span></label>
                                    <button onclick="deleteAllCatalogs()" type="submit" class="btn btn-danger">حذف تمام دسته بندی ها</button>

                                    <br>
                                    <div class="col-12" id="CategoryList">

                                    </div>

                                    <br>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                </div>

            </div>
            <!-- /.card-body -->

        </div>
    </div>


    <script>
        function deleteRow(r) {
            let token = "{{ csrf_token() }}";
            $.ajax({
                type: 'DELETE',
                url: '/Category/' + r,
                data: {
                    _token: token,
                    r
                },
                success: function () {
                    location.reload();
                }
            });

        }

    </script>

    <script>
        function editRow(r) {
            $.ajax({
                type: "GET",
                url: '/Category/' + r + '/edit',

                success: function (data) {
                    //display data...
                    let CatId = (data['id']);
                    $('#CategoryEditModal').find('#CatId').val(CatId);
                    data['contents'].forEach(element => {
                        $('#CategoryEditModal').find('#' + element['locale'] + 'edit').text(element['element_content']);
                    });

                    $("#CategoryEditModal-form").attr("action", "/Category/" + CatId);
                    $('#CategoryEditModal').modal('show');
                }
            });
        }
    </script>


    <script>
        function showCategory() {
            let ptypeId = document.getElementById('ptypeId').value;
                $.ajax({
                    type: "GET",
                    url: '/Category/' + ptypeId,

                    success: function (data) {
                        $('#CategoryList').empty();
                        data.forEach(function (entry) {
                            let filename = entry[2].split('/').pop();
                            // create category list
                            let category_section = document.getElementById("CategoryList");
                            //
                            // Create <a> tag
                            let a_tag = document.createElement("a");
                            a_tag.setAttribute("onclick", "deleteCategory('" + entry[0] + "','"+ entry[1] + "','"+ filename + "')");

                            category_section.appendChild(a_tag);

                            // create img tag inside li
                            let last_a_tag = category_section.lastElementChild;
                            let img_obj = document.createElement("img");
                            img_obj.setAttribute("class", "col-3");
                            img_obj.setAttribute("src", entry[2]);
                            img_obj.setAttribute("style", "padding-bottom: 10px;");
                            img_obj.setAttribute("alt", "Photo");
                            last_a_tag.appendChild(img_obj);
                        });

                    }
                });
        }
    </script>
    @include('PageElements.Dashboard.Setting.ModalEditCategory')
@endsection
