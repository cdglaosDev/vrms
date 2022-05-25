<!-- Detail Modal -->
<div class="modal fade" id="detailModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-11 text-center">
                    <h3 class="text-center">{{trans('sidebar.action_log')}}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="" id="editform" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('title.tbl_name')}}:</label>
                                <input type="text" name="tbl_name" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label class="validationCustom01">{{trans('title.user_id')}}:</label>
                                <input type="text" name="user_id" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('title.active_action')}}:</label>
                                <input type="text" name="active_action" class="form-control" id="validationCustom01" value="" >
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('title.active_date')}}:</label>
                                <input type="text" name="date" class="date form-control" id="validationCustom01" value="" >
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('title.ip_address')}}:</label>
                                <input type="text" name="ip_address" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('Action Detail')}}:</label>
                                <textarea name="action_detail" id="validationCustom01" cols="10" rows="10" class="form-control" value="" placeholder="Enter Comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                </div>

            </form>
        </div>
    </div>
</div>