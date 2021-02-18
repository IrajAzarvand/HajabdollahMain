@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات دسته بندی محصولات')
@section('ContentHeader', 'دسته بندی محصولات')
@section('content')

<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                افزودن دسته بندی جدید
            </h3>

        </div>
        <!-- /.card-header -->
        <form class="card-body" action="{{ route('Category.store') }}" method="post">
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
                        <label>دسته بندی جدید</label>

                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#{{$item['locale']}}" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{$item['locale']}}">
                                    <div class="mb-3">
                                        <textarea id="editor1" name="{{$item['locale']}}" style="width: 100%"></textarea>
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
                لیست دسته بندی ها بر اساس نوع محصول (فارسی - انگلیسی - روسی - عربی)
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <div class="box-body">
                <div class="row">
                    <label>انتخاب نوع محصول</label>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="ptype" id="ptypeId" onchange="showCategory()" class="form-control select2" style="width: 100%;">
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

            <ul class="todo-list" id="CategoryList">
                {{-- category list shows here --}}
            </ul>
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
            success: function() {
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
                let CatId= (data['id']);
                $('#CategoryEditModal').find('#CatId').val(CatId);
                data['contents'].forEach(element => {
                    $('#CategoryEditModal').find('#'+element['locale']+'edit').text(element['element_content']);
                });

                $("#CategoryEditModal-form").attr("action", "/Category/" + CatId);
                $('#CategoryEditModal').modal('show');
            }
        });
    }
</script>


<script>
    function showCategory() {
        let ptypeId=document.getElementById('ptypeId').value;
        $.ajax({
            type: "GET",
            url: '/Category/' + ptypeId,

            success: function (data) {

                // create category list
                function createElementLi(obj) {
                    let ul_obj = document.getElementById(obj);

                    // Create li
                    let li_obj = document.createElement("li");
                    ul_obj.appendChild(li_obj);

                    //create span inside li
                    let last_li = ul_obj.lastElementChild;
                    let span_obj = document.createElement("span");
                    span_obj.setAttribute("class", "text");
                    last_li.appendChild(span_obj);
                }


                //show content
                let list='';
                let Cat_id='';
                $('#CategoryList').empty();
                data.forEach(function(entry){
                    entry.forEach(function(childrenEntry) {
                        list = list + ' (' +  childrenEntry.element_content + ') ';
                        Cat_id=childrenEntry.element_id;
                    });
                    createElementLi("CategoryList");
                    let lst_LI=document.getElementById("CategoryList").lastElementChild;
                    let spn=lst_LI.getElementsByTagName("span");
                    spn[0].innerHTML='<a onclick="editRow('+ Cat_id +')"><i class="fa fa-edit"></i></a> &nbsp; <a onclick="deleteRow('+ Cat_id +')"><i class="fa fa-trash-o"></i></a>' + list;
                    list='';
                });


            }
        });
    }
</script>
@include('PageElements.Dashboard.Setting.ModalEditCategory')
@endsection
