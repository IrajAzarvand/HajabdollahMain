@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات گواهینامه و افتخارات')
@section('ContentHeader', 'تنظیمات گواهینامه و افتخارات')
@section('content')

    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن گواهینامه جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('CH.store') }}" method="post" enctype="multipart/form-data">
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
                            <label for="exampleInputFile">ارسال تصویر گواهینامه</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="CH_image" class="custom-file-input" id="fileUploader">
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
                            <label>عنوان گواهینامه</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#ChTitle_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="ChTitle_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <textarea id="editor1" name="ChTitle_{{$item['locale']}}" style="width: 100%"></textarea>
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
                            <label>شرح گواهینامه</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#ChDescription_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="ChDescription_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <textarea id="editor1" name="ChDescription_{{$item['locale']}}" style="width: 100%" rows="10"></textarea>
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


    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    لیست گواهینامه ها (فارسی - انگلیسی - روسی - عربی)
                </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list">
                    <?php
                    foreach ($CH as $item) {
                        echo '<li>';
                        foreach (Locales() as $key => $value) {
                            // tag text
                            echo '<span style="display: none;" class="text">' . $item->id . '</span>';
                            echo '<span class="text">' . $item->contents[$key]['element_content'] . '</span>' . '| &nbsp; ';
                        }
                        // General tools such as edit or delete
                        echo '<div class="tools">';

                        echo '<a onclick="editRow(' . $item->id . ')"><i class="fa fa-edit"></i></a> &nbsp;';
                        echo '<a onclick="deleteRow(' . $item->id . ')"><i class="fa fa-trash-o"></i></a>';
                        echo '</div>';
                        echo '</li>';
                    }
                    ?>
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
                url: '/CH/' + r,
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
                url: '/CH/' + r + '/edit',

                success: function (data) {
                    //display data...
                    let CHId = (data[0]['id']);
                    $('#CHEditModal').find('#CHId').val(CHId);
                    data[0]['contents'].forEach(element => {
                        if(element['element_title']=='ChTitle_'+ element['locale']) {
                            $('#CHEditModal').find('#CH_Title_' + element['locale'] + 'edit').text(element['element_content']);
                        }
                        else if(element['element_title']=='ChDescription_'+ element['locale']){
                            $('#CHEditModal').find('#CH_Desc_' + element['locale'] + 'edit').text(element['element_content']);

                        }
                    });
console.log('"'+data[1]+'"');
                    $('#CHEditModal').find('#CH_img').attr("src",data[1]);

                    $("#CHEditModal-form").attr("action", "/CH/" + CHId);
                    $('#CHEditModal').modal('show');
                }
            });
        }
    </script>
    @include('PageElements.Dashboard.Setting.ModalEditCertificate')


@endsection
