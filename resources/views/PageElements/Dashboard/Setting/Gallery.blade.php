@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات گالری تصاویر')
@section('ContentHeader', 'مدیریت گالری تصاویر')
@section('content')

<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                افزودن گالری تصاویر جدید
            </h3>

        </div>
        <!-- /.card-header -->
        <form class="card-body" action="{{ route('Gallery.store') }}" method="post" enctype="multipart/form-data">
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

            <!-- file uploader -->
            <div class="col-6">
                <div class="card">
                    <div class="form-group">
                        <label for="exampleInputFile">ارسال تصاویر گالری</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="gallery_images[]" class="custom-file-input" id="fileUploader" multiple>
                                <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <label>عنوان گالری</label>

                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#g_title_{{$item['locale']}}" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="g_title_{{$item['locale']}}">
                                    <div class="mb-3">
                                        <textarea id="editor1" name="g_title_{{$item['locale']}}" style="width: 100%"></textarea>
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

<!-- / =============================================================================== -->
<!-- /view products list -->
<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                مشاهده لیست گالری تصاویر
            </h3>

        </div>
        <!-- /.card-header -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    لیست گالری های ذخیره شده
                </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">جدول گالری ها</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="ProductsTable">
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان گالری</th>
                                        <th>عملیات</th>
                                    </tr>
                                    @foreach($GList as $key=>$glist)
                                    <tr id="GalleriesList">
                                        <td>{{$key+1}}</td>
                                        <td>{{$glist['title']}}</td>
                                        <td><button type="button" class="btn btn-primary"><a onclick="viewEditGallery({{$glist['id']}})"><i class="fa fa-eye"></i></a></button> &nbsp
                                            <button type="button" class="btn btn-danger"><a onclick="deleteGallery({{$glist['id']}})"><i class="fa fa-trash-o"></i></a></button></td>

                                    </tr>
                                    @endforeach
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
    function viewEditGallery(g) {
        window.location.href = "/Gallery/"+g+"/edit";
    }
</script>


<script>
    function deleteGallery(g) {
        let token = "{{ csrf_token() }}";
        $.ajax({
            type: 'DELETE',
            url: '/Gallery/' + g,
            data: {
            _token: token,
            g
            },
            success: function() {
                location.reload();
            }
        });

    }
</script>

@endsection
