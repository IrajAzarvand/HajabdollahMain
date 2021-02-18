<!-- /edit modal -->

<div id="MessageViewModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">مشاهده پیام دریافت شده</h4>
            </div>
            <div class="modal-body" id="modal-body">
                <form id="MessageViewModal-form" action="" method="post">
                @csrf
                <!-- Custom Tabs -->
                    <input type="hidden" name="MessageId" id="MessageId">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <label for="SenderName">نام فرستنده</label>
                                <input type="text" name="SenderName" id="SenderName">
                            </div>
                            <br>
                            <div class="tab-content">
                                <label for="SenderEmail">ایمیل فرستنده</label>
                                <input type="text" name="SenderEmail" id="SenderEmail">
                            </div>
                            <br>
                            <div class="tab-content">
                                <label for="MessageSubject">موضوع</label>
                                <input type="text" name="MessageSubject" style="width:100%" id="MessageSubject">
                            </div>
                            <br>
                            <div class="tab-content">
                                <label for="Message">متن پیام</label>
                                <textarea name="Message" id="Message" style="width: 100%" rows="7"></textarea>
                            </div>
                        </div><!-- /.card-body -->
                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </form>
            </div>

        </div>

    </div>

</div>
