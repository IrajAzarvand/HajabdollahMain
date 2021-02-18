{{-- @dd($Tags) --}}
@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات آخرین اخبار')
@section('ContentHeader', 'تنظیمات آخرین اخبار')
@section('content')

<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                افزودن خبر جدید
            </h3>

        </div>
        <!-- /.card-header -->
        <form class="card-body" action="{{ route('LatestNews.store') }}" method="post">
            @csrf

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


            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
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
                                        <textarea id="editor1" name="{{$item['locale']}}_title" style="width: 100%" placeholder="عنوان"></textarea>
                                        <br />
                                        <textarea id="editor1" name="{{$item['locale']}}_description" style="width: 100%" placeholder="شرح" rows="10"></textarea>

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






<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                لیست اخبار (به ترتیب نزولی)
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <ul class="todo-list">
                <?php

            foreach ($LN as $news) {
                echo '<li>';
                foreach ($news->contents as $key=>$value) {
                    // tag text
                //    echo '<span class="text">'.$news->id .'</span>';
                   echo '<span class="text">' . $value['element_content'] . '</span><br/>';
                }
                // General tools such as edit or delete
                echo '<div class="tools">';

                    echo '<a onclick="editRow('.$news->id.')"><i class="fa fa-edit"></i></a> &nbsp;';
                     echo '<a onclick="deleteRow('.$news->id.')"><i class="fa fa-trash-o"></i></a>';
                 echo '</div>';
                echo '</li>';
                echo '<hr>';
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
                url: '/LatestNews/' + r,
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

            url: '/LatestNews/' + r + '/edit',

            success: function (data) {
                console.log(data);
                //display data...
                let LNId= (data['id']);
                $('#LatestNewsEditModal').find('#LNId').val(LNId);
                data['contents'].forEach(element => {
                    if(element['element_title']=='news_title'){
                        $('#LatestNewsEditModal').find('#'+element['locale']+'_title').text(element['element_content']);
                    }
                    else if(element['element_title']=='news_description'){
                    $('#LatestNewsEditModal').find('#'+element['locale']+'_description').text(element['element_content']);
                    }
                });

                $("#LatestNewsEditModal-form").attr("action", "/LatestNews/" + LNId);
                $('#LatestNewsEditModal').modal('show');
            }
        });
    }
</script>
@include('PageElements.Dashboard.Setting.ModalEditLatestNews')
@endsection
