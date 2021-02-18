<!-- /edit modal -->

<div id="CHEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ویرایش گواهینامه</h4>
            </div>
            <div class="modal-body" id="modal-body">
                <form id="CHEditModal-form" action="" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!-- file uploader -->
                    <div class="col-12">
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

                        <img id="CH_img" class="col-3" style="padding-bottom: 10px;" alt="">


                    <!-- Custom Tabs -->
                    <input type="hidden" name="CHId" id="CHId">
                    <div class="card">
                        <label>عنوان گواهینامه</label>
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                    <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#CH_Title_{{$item['locale']}}box"
                                                            data-toggle="tab">{{$item['name']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                    <div class="tab-pane @if ($loop->first) active @endif" id="CH_Title_{{$item['locale']}}box">
                                        <div class="mb-3">
                                            <textarea id="CH_Title_{{$item['locale']}}edit" name="CH_Title_{{$item['locale']}}" style="width: 100%"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                    <div class="card">
                        <label>شرح گواهینامه</label>
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                    <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#CH_Desc_{{$item['locale']}}box"
                                                            data-toggle="tab">{{$item['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $item)
                                    <div class="tab-pane @if ($loop->first) active @endif" id="CH_Desc_{{$item['locale']}}box">
                                        <div class="mb-3">
                                            <textarea id="CH_Desc_{{$item['locale']}}edit" name="CH_Desc_{{$item['locale']}}" style="width: 100%"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                    <button type="submit" class="btn btn-primary">ذخیره</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </form>
            </div>

        </div>

    </div>

</div>
