@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات رویدادها')
@section('ContentHeader', 'رویدادها')
@section('content')

    <div class="col-md-9">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن رویداد جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('Events.store') }}" method="post" enctype="multipart/form-data">
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
                        <div class="col-12">


                            <div class="card">
                                <label>عنوان رویداد</label>

                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-pills ml-auto p-2">
                                        @foreach (Locales() as $item)
                                            <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                    href="#E_Title_{{$item['locale']}}"
                                                                    data-toggle="tab">{{$item['name']}}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach (Locales() as $item)
                                            <div class="tab-pane @if ($loop->first) active @endif"
                                                 id="E_Title_{{$item['locale']}}">

                                                <div class="mb-3">
                                                    <textarea id="editor1" name="E_Title_{{$item['locale']}}"
                                                              style="width: 100%" required></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- ./card -->

                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <label>توضیحات رویداد</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#E_Desc_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="E_Desc_{{$item['locale']}}">

                                            <div class="mb-3">
                                                <textarea id="editor1" name="E_Desc_{{$item['locale']}}"
                                                          style="width: 100%" required></textarea>
                                                <br>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--file uploader--}}
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="form-group">
                                                <label for="exampleInputFile">ارسال تصویر رویداد</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="E_Img" class="custom-file-input"
                                                               id="fileUploader" required>
                                                        <label class="custom-file-label" for="exampleInputFile">انتخاب
                                                            فایل</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                    <h3 class="card-title">جدول رویدادها</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list">
                        <?php
                        foreach ($E_List as $events) {
                            echo '<li>';

                                // tag text
                                echo '<span class="text">'.$events['id'] .'</span>';
                                echo '<span class="text">' . $events['title'] . '</span>';

                            // General tools such as edit or delete
                            echo '<div class="tools">';

                            echo '<a onclick="editRow('.$events['id'].')"><i class="fa fa-edit"></i></a> &nbsp;';
                            echo '<a onclick="deleteRow('.$events['id'].')"><i class="fa fa-trash-o"></i></a>';
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <!-- /.card -->


        <script>
            function deleteRow(r) {
                let token = "{{ csrf_token() }}";

                $.ajax({
                    type: 'DELETE',
                    url: '/Events/' + r,
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
                    url: '/Events/' + r + '/edit',

                    success: function (data) {
                        //display data...
                        let EId = (data['id']);
                        $('#EventEditModal').find('#EId').val(EId);
                        data['contents'].forEach(element => {
                            if(element['element_title'].includes("E_Title_")){
                                $('#EventEditModal').find('#E_Title_' + element['locale'] + 'edit').text(element['element_content']);
                            }
                            if(element['element_title'].includes("E_Desc_")){
                                $('#EventEditModal').find('#E_Desc_' + element['locale'] + 'edit').text(element['element_content']);
                            }
                        });
                        $("#E_Img").attr("src", data['image']);
                        $("#EventEditModal-form").attr("action", "/Events/" + EId);
                        $('#EventEditModal').modal('show');
                    }
                });
            }
        </script>

    @include('PageElements.Dashboard.Setting.ModalEditEvent')
@endsection
