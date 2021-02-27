@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات آدرس')
@section('ContentHeader', 'تنظیمات آدرس')
@section('content')

    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    افزودن آدرس جدید
                </h3>

            </div>
            <!-- /.card-header -->
            <form class="card-body" action="{{ route('Address.store') }}" method="post" enctype="multipart/form-data">
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
                            <label>متن آدرس</label>

                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach (Locales() as $item)
                                        <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif"
                                                                href="#AddressDescription_{{$item['locale']}}"
                                                                data-toggle="tab">{{$item['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (Locales() as $item)
                                        <div class="tab-pane @if ($loop->first) active @endif"
                                             id="AddressDescription_{{$item['locale']}}">
                                            <div class="mb-3">
                                                <textarea id="editor1" name="AddressDescription_{{$item['locale']}}"
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

    <!-- /Address List -->
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
                    foreach ($ADList as $item) {
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
                url: '/Address/' + r,
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
                url: '/Address/' + r + '/edit',

                success: function (data) {
                    //display data...
                    let AddressId = (data['id']);
                    $('#AddressEditModal').find('#Address_Id').val(AddressId);
                    data['contents'].forEach(element => {
                        if (element['element_title'] == 'AddressTitle_' + element['locale']) {
                            $('#AddressEditModal').find('#Address_Title_' + element['locale'] + 'edit').text(element['element_content']);
                        } else if (element['element_title'] == 'AddressDescription_' + element['locale']) {
                            $('#AddressEditModal').find('#Address_Desc_' + element['locale'] + 'edit').text(element['element_content']);

                        }
                    });
                    $("#AddressEditModal-form").attr("action", "/Address/" + AddressId);
                    $('#AddressEditModal').modal('show');
                }
            });
        }
    </script>
    @include('PageElements.Dashboard.Setting.ModalEditAddress')


@endsection
