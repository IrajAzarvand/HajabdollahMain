@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات پیام ها')
@section('ContentHeader', 'دفاتر فروش')
@section('content')

    <!-- / =============================================================================== -->
    <!-- /view Office list -->
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    مشاهده لیست پیام ها
                </h3>

            </div>
            <!-- /.card-header -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        لیست پیام های دریافت شده
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">جدول پیام ها</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover" id="ProductsTable">
                                        <tr>
                                            <th>#</th>
                                            <th>ایمیل فرستنده</th>
                                            <th>عملیات</th>
                                        </tr>
                                        @foreach($MSG as $Message)
                                            <tr>
                                                <td>{{$Message['row']}}</td>
                                                <td>{{$Message['sender_email']}}</td>
                                                <td><button type="button" class="btn btn-primary"><a onclick="viewMessage({{$Message['id']}})"><i class="fa fa-eye"></i></a></button> &nbsp; &nbsp; <button type="button" class="btn btn-danger"><a onclick="deleteMessage({{$Message['id']}})"><i class="fa fa-trash-o"></i></a></button> </td>
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




    {{-- ====================for show all products=============== --}}

    <script>
        function deleteMessage(M_Id) {
            let token = "{{ csrf_token() }}";
            $.ajax({
                type: 'DELETE',
                url: '/CUMessages/' + M_Id,
                data: {
                    _token: token,
                    M_Id
                },
                success: function () {
                    location.reload();
                }
            });

        }
    </script>

    <script>
        function viewMessage(r) {
            $.ajax({
                type: "GET",
                url: '/CUMessages/' + r,

                success: function (data) {
                    //display data...

                   console.log(data);
                    let MId= (data['id']);
                    let SenderName= (data['name']);
                    let SenderMail= (data['email']);
                    let MessageSubject= (data['subject']);
                    let Message= (data['message']);
                    $('#MessageViewModal').find('#MessageId').val(MId);
                    $('#MessageViewModal').find('#SenderName').val(SenderName);
                    $('#MessageViewModal').find('#SenderEmail').val(SenderMail);
                    $('#MessageViewModal').find('#MessageSubject').val(MessageSubject);
                    $('#MessageViewModal').find('#Message').val(Message);
                    $('#MessageViewModal').modal('show');
                }
            });
        }
    </script>
    @include('PageElements.Dashboard.Setting.ModalViewMessage')
@endsection
