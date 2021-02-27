@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات تماس با ما')
@section('ContentHeader', 'تنظیمات تماس با ما')
@section('content')

    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن مشخصات جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('CU.store') }}" method="post" enctype="multipart/form-data">
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
                            <label>متن تماس با ما</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#CUDescription_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="CUDescription_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <textarea id="editor1" name="CUDescription_{{$item['locale']}}"
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

    <!-- /CU List -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست موارد اضافه شده</h3>
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
                    foreach ($CUList as $item) {
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
                url: '/CU/' + r,
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
                url: '/CU/' + r + '/edit',

                success: function (data) {
                    //display data...
                    let CUId = (data['id']);
                    $('#CUEditModal').find('#CU_Id').val(CUId);
                    data['contents'].forEach(element => {
                        if (element['element_title'] == 'CUTitle_' + element['locale']) {
                            $('#CUEditModal').find('#CU_Title_' + element['locale'] + 'edit').text(element['element_content']);
                        } else if (element['element_title'] == 'CUDescription_' + element['locale']) {
                            $('#CUEditModal').find('#CU_Desc_' + element['locale'] + 'edit').text(element['element_content']);

                        }
                    });
                    $("#CUEditModal-form").attr("action", "/CU/" + CUId);
                    $('#CUEditModal').modal('show');
                }
            });
        }
    </script>
    @include('PageElements.Dashboard.Setting.ModalEditCU')


@endsection
