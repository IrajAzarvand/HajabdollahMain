@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات معرفی شرکت')
@section('ContentHeader', 'تنظیمات معرفی شرکت')
@section('content')

    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن متن جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('CI.store') }}" method="post" enctype="multipart/form-data">
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

                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <label>عنوان</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#CITitle_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="CITitle_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <textarea id="editor1" name="CITitle_{{$item['locale']}}"
                                                          style="width: 100%"></textarea>
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
                            <label>متن اصلی</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#CIDescription_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="CIDescription_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <textarea id="editor1" name="CIDescription_{{$item['locale']}}"
                                                          style="width: 100%" rows="10"></textarea>
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

    <!-- /CI List -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست متن های وارد شده</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    $counter = 1;
                    foreach ($CIList as $item) {
                        echo '<tr style="alignment: center;">';
                        echo '<td>' . $counter++ . '</td>';
                        echo '<td>' . $item['title'] . '</td>';

                        echo '<td>' . '<a onclick="editRow('.$item['id'].')"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>&nbsp<a onclick="deleteRow('.$item['id'].')"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>&nbsp</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>



    <script>
        function deleteRow(r) {
            let token = "{{ csrf_token() }}";
            $.ajax({
                type: 'DELETE',
                url: '/CI/' + r,
                data: {
                    _token: token,
                    r
                },
                success: function (data) {
                    location.reload();

                }
            });

        }

    </script>

    <script>
        function editRow(r) {
            $.ajax({
                type: "GET",
                url: '/CI/' + r + '/edit',

                success: function (data) {
                    //display data...
                    let CHId = (data['id']);
                    $('#CIEditModal').find('#CI_Id').val(CHId);
                    data['contents'].forEach(element => {
                        if (element['element_title'] == 'CITitle_' + element['locale']) {
                            $('#CIEditModal').find('#CI_Title_' + element['locale'] + 'edit').text(element['element_content']);
                        } else if (element['element_title'] == 'CIDescription_' + element['locale']) {
                            $('#CIEditModal').find('#CI_Desc_' + element['locale'] + 'edit').text(element['element_content']);

                        }
                    });
                    $("#CIEditModal-form").attr("action", "/CI/" + CHId);
                    $('#CIEditModal').modal('show');
                }
            });
        }
    </script>
    @include('PageElements.Dashboard.Setting.ModalEditCI')


@endsection
