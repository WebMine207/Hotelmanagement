<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>Church Details</th>
            <!-- <th>Email</th> -->
            <th>Pastor Details</th>
            <th>Denomination</th>
            <th>Created At</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($church)>0)
        @foreach($church as $churchies)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <!-- <td>{{ $churchies->name }}</td> -->
                <td>
                    <div class="d-flex flex-column">
                        <div class="text-gray-800">{{$churchies->church_details->church_name}}</div>
                        <span>{{ $churchies->church_details->church_email }}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column">
                        <div class="text-gray-800">{{$churchies->name}}</div>
                        <span>{{ $churchies->email }}</span>
                    </div>
                </td>

                <td>{{ ($churchies->church_details == null)? " - " : (($churchies->church_details->church_type)? $churchies->church_details->church_type->name : ' - ') }}
                @if($churchies->church_details->church_type)
                    @if ($churchies->church_details->church_type->name == 'Other')
                    {{($churchies->church_details->new_denomination) ?'('. $churchies->church_details->new_denomination .')' :'' }}
                    @endif
                @endif
                </td>
                  <!--begin::created at date-->
                  <td>{{ date('m-d-Y', strtotime($churchies->created_at)); }}</td>
                  <!--end::created at date-->
                <td>
                    <?php
                    $checked = ($churchies->status == 1) ? "checked" : "";
                    $ids=$churchies->id;
                    ?>
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input update_status" name="status" type="checkbox" data-title="church" href="{{route('church.update_status',getEncrypted($churchies->id))}}" {{$checked}} />
                    </label>

                </td>
                <td>
                    <a class="btn btn-sm btn-primary edit_church" href="{{route('church.edit',getEncrypted($churchies->id))}}"><i class="fas fa-edit" style="margin-left:7px;"></i></a>
                    <button class="btn btn-sm btn-danger delete_row" data-title="church" data-href="{{route('church.destroy',getEncrypted($churchies->id))}}" data-banner_id ="{{getEncrypted($churchies->id)}}" data-kt-banner-content-table-filter="delete_row" ><i style="margin-left:6px;" class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="5" class="text-center"> No records found </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<section class="custom-pagination">
    {{ $church->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}
