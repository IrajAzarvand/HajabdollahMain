{{-- @dd($Tags) --}}
@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات فوتر')
@section('ContentHeader', 'تنظیمات فوتر')
@section('content')

<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                آدرس و کپی رایت
            </h3>

        </div>
        <!-- /.card-header -->
        <form class="card-body" action="{{ route('Footer.store') }}" method="post">
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
                <!-- Address -->
                <div class="col-6">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#Address_{{$item['locale']}}" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="Address_{{$item['locale']}}">
                                    <div class="mb-3">
                                        <textarea id="editor1" name="Address_{{$item['locale']}}" style="width: 100%"></textarea>
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

                <!-- CopyRight -->
                <div class="col-6">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#CopyRight_{{$item['locale']}}" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="CopyRight_{{$item['locale']}}">
                                    <div class="mb-3">
                                        <textarea id="editor1" name="CopyRight_{{$item['locale']}}" style="width: 100%"></textarea>
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





<!-- Address -->

<div class="col-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                آدرس
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <ul class="todo-list">
                <?php
            foreach ($Address as $address) {
                echo '<li>';
                foreach (Locales() as $key=>$value) {
                    // tag text
                   echo '<span style="display: none;" class="text">'.$address->id .'</span>';
                   echo '<span class="text">' . $address->contents[$key]['element_content'] . '</span><br/><hr>';
                }
                // General tools such as edit or delete
                echo '<div class="tools">';

                    echo '<a onclick="editRow('.$address->contents[$key]['id'] .')"><i class="fa fa-edit"></i></a> &nbsp;';
                 echo '</div>';
                echo '</li>';
                }
                ?>
            </ul>
        </div>
        <!-- /.card-body -->

    </div>
</div>


<!-- CopyRight -->

<div class="col-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                کپی رایت
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <ul class="todo-list">
                <?php
            foreach ($CopyRight as $C) {
                echo '<li>';
                foreach (Locales() as $key=>$value) {
                    // tag text
                   echo '<span style="display: none;" class="text">'.$C->id .'</span>';
                   echo '<span class="text">' . $C->contents[$key]['element_content'] . '</span><br/><hr>';
                }
                // General tools such as edit or delete
                echo '<div class="tools">';

                    echo '<a onclick="editRow('.$C->contents[$key]['id'] .')"><i class="fa fa-edit"></i></a> &nbsp;';
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
    function editRow(r) {
        $.ajax({
            type: "GET",
            url: '/Footer/' + r + '/edit',

            success: function (data) {

                let TagId= (data['id']);
                $('#FooterEditModal').find('#FooterId').val(TagId);
                data['contents'].forEach(element => {
                    $('#FooterEditModal').find('#'+element['locale']+'edit').text(element['element_content']);
                    $('#FooterEditModal').find('#element_title').val(element['element_title']);
                });

                $("#FooterEditModal-form").attr("action", "/Footer/" + TagId);
                $('#FooterEditModal').modal('show');
            }
        });
    }
</script>
@include('PageElements.Dashboard.Setting.ModalEditFooter')
@endsection
