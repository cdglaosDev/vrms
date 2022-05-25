<table class="table table-bordered" id="app-document">
        <thead>
            <tr>
                <th width="400">{{ trans('app_form.doc_type') }}</th>
                <th>{{ trans('app_form.doc_filename') }} (<span id="pre_license">{{ $pre_lic }}</span>)</th>
                <th>Action</th>
            </tr>
        </thead>
        <!-- import car -->
        <input type="hidden" class="duplicate_file" value="{{ trans('title.duplicate_file') }}">
        <tr class="attach_doc">
            <td>
                <div>
                    <input type="hidden" name="doc_type_id[]" class="form-control"  value="2">
                    <h5>{{ trans('doc_type.lic_import_car') }}</h5>
                </div>
            </td>
            <td>
                <div>
                    @if(!empty($app_doc))
                    <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                    @isset($app_doc[2])  
                        <input type="hidden" class="old_file" name="2" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[2])}}" class="filename_image" target="_blank">{{$app_doc[2]}}</a>
                    @endisset
                    @else
                    <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>
        <!-- end import car -->

        <!-- Licenses of import goods of Department -->
        <tr class="attach_doc">
            <td>
                <div >
                    <input type="hidden" name="doc_type_id[]" class="form-control" value="5">
                    <h5>{{ trans('doc_type.import_good') }}</h5>
                </div>
            </td>
            <td>
                <div>
                    @if(!empty($app_doc))
                    <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value=""   id="filename" />
                    @isset($app_doc[5])
                        <input type="hidden" class="old_file" name="5" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[5])}}" class="filename_image" target="_blank">{{$app_doc[5]}}</a>
                    @endisset
                    @else
                    <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>

        <!-- Vehicle License Technician License -->
        <tr class="attach_doc">
            <td>
                <div >
                    <input type="hidden" name="doc_type_id[]" class="form-control" value="4">
                    <h5>{{ trans('doc_type.veh_lic_tech') }}</h5>
                </div>
            </td>
            <td>
                <div >
                    @if(!empty($app_doc))
                    <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value=""   id="filename" />
                    @isset($app_doc[4])
                        <input type="hidden" class="old_file" name="4" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[4])}}" class="filename_image" target="_blank">{{$app_doc[4]}}</a>
                    @endisset
                    @else
                    <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>
        <!-- Licenses Of the Ministry of Industry and Commerce -->
        <tr class="attach_doc">
            <td>
                <div >
                    <input type="hidden" name="doc_type_id[]" class="form-control" value="3">
                    <h5>{{ trans('doc_type.lic_ministry') }}</h5>
                </div>
            </td>
            <td>
                <div >
                    @if(!empty($app_doc))
                    <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value=""   id="filename" />
                    @isset($app_doc[3])
                        <input type="hidden" class="old_file" name="3" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[3])}}" class="filename_image" target="_blank">{{$app_doc[3]}}</a>
                    @endisset
                    @else
                    <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>

        <!-- Tax returns -->
        <tr class="attach_doc">
            <td>
                <div >
                    <input type="hidden" name="doc_type_id[]" class="form-control" value="6">
                    <h5>{{ trans('doc_type.tax_return') }}</h5>
                </div>
            </td>
            <td>
                <div >
                    @if(!empty($app_doc))
                    <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value=""   id="filename" />
                    @isset($app_doc[6])
                        <input type="hidden" class="old_file" name="6" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[6])}}" class="filename_image" target="_blank">{{$app_doc[6]}}</a>
                    @endisset
                    @else
                    <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>

        <!-- Tax Relief certificate -->
        <tr class="attach_doc">
            <td>
                <div >
                    <input type="hidden" name="doc_type_id[]" class="form-control" value="7">
                    <h5>{{ trans('doc_type.tax_relief') }}</h5>
                </div>
            </td>
            <td>
                <div >
                    @if(!empty($app_doc))
                    <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value=""   id="filename" />
                    @isset($app_doc[7])
                        <input type="hidden" class="old_file" name="7" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[7])}}" class="filename_image" target="_blank">{{$app_doc[7]}}</a>
                    @endisset
                    @else
                    <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>

        <!-- Record of solving the case(option) -->
        <tr class="attach_doc">
            <td>
                <div >
                    <input type="hidden" name="doc_type_id[]" class="form-control" value="8">
                    <h5>{{ trans('doc_type.record') }}</h5>
                </div>
            </td>
            <td>
                <div >
                    @if(!empty($app_doc))
                    <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value=""   id="filename" />
                    @isset($app_doc[8])
                        <input type="hidden" class="old_file" name="8" value="1">
                        <a href="{{asset('images/doc/'.$pre_app_no.'/'.$app_doc[8])}}" class="filename_image" target="_blank">{{$app_doc[8]}}</a>
                    @endisset
                    @else
                    <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                    @endif
                </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
        </tr>

</table>