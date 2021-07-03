<!-- /edit modal -->

<div id="EventEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ویرایش رویداد</h4>
            </div>
            <div class="modal-body" id="modal-body">
                <form id="EventEditModal-form" action="" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <!-- Custom Tabs -->
                    <input type="hidden" name="EId" id="EId">

                        <!-- Event title -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#{{$item['locale']}}titlebox" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{$item['locale']}}titlebox">
                                    <div class="mb-3">
                                        <textarea name="E_Title_{{$item['locale']}}" id="E_Title_{{$item['locale']}}edit" style="width: 100%"></textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                        <!-- Event description -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#{{$item['locale']}}descbox" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{$item['locale']}}descbox">
                                    <div class="mb-3">
                                        <textarea name="E_Desc_{{$item['locale']}}" id="E_Desc_{{$item['locale']}}edit" style="width: 100%"></textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                        <!-- /image content -->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h6>تصویر رویداد</h6>
                            </div>
                                <img id="E_Img" alt="" style="width: 45%">
                        </div>
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h6>انتخاب تصویر دیگر</h6>
                            </div>
                            <input type="file" name="Event_New_Img" >
                        </div>
                        <!-- /.image content -->


                    <button type="submit" class="btn btn-primary">ذخیره</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </form>
            </div>

        </div>

    </div>

</div>
