<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>Full Name</th>
            <th>Created At</th>
            <th>Display Order</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($denominations)>0)
        @foreach($denominations as $denomination)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td>{{ $denomination->name }}</td>

                  <!--begin::created at date-->
                  <td>{{ date('m-d-Y', strtotime($denomination->created_at)); }}</td>
                  <!--end::created at date-->
                  <td>{{ $denomination->display_order }}</td>
                <td>
                    <?php
                    $checked = ($denomination->status == 1) ? "checked" : "";
                    $ids=$denomination->id;
                    ?>
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input update_status" name="status" type="checkbox" data-title="denomination" href="{{route('denomination.update_status',getEncrypted($denomination->id))}}" {{$checked}} />
                    </div>
                </td>
                <td>
                    @if($denomination->name != 'Other')
                    <a class="btn btn-sm btn-primary edit_denomination" href="{{route('denomination.edit',getEncrypted($denomination->id))}}"><i class="fas fa-edit" style="margin-left:7px;"></i></a>
                    <button class="btn btn-sm btn-danger delete_row" data-title="denomination" data-href="{{route('denomination.destroy',getEncrypted($denomination->id))}}" data-banner_id ="{{getEncrypted($denomination->id)}}" data-kt-banner-content-table-filter="delete_row" ><i style="margin-left:6px;" class="fas fa-trash"></i></button>
                    @else
                     <div class="text-mute">Not editable</div>   
                    @endif
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
    {{ $denominations->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}
