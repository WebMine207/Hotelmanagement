<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0" style="vertical-align: middle;">
            <th>
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input type="checkbox" class="form-check-input" name="select_all" value="1" id="search-select-all">
                </div>
            </th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($pastors)>0)
        @foreach($pastors as $user)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">

                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input type="checkbox" name="users_id[]" value="{{$user->id}}" class="form-check-input selected_rows" id="bulk_update_id">
                    </div>
                </td>
                
                <td>{{$user->full_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{ date('m-d-Y', strtotime($user->created_at)); }}</td>
                <td>
                    <?php
                    $checked = ($user->status == 1) ? "checked" : "";
                    $ids=$user->id;
                    ?>
                    <div class="form-check form-switch  form-check-custom form-check-solid">
                        <input class="form-check-input update_status" data-title="pastor" name="status" type="checkbox" href="{{route('pastors.update_status',getEncrypted($user->id))}}" {{$checked}} />
                    </div>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{route('pastors.edit',getEncrypted($user->id))}}"><i class="fas fa-edit" style="margin-left: 5px;"></i></a>

                    <button class="btn btn-sm btn-danger delete_row" data-title="pastor" data-href="{{route('pastors.destroy',getEncrypted($user->id))}}" data-user_id ="{{getEncrypted($user->id)}}" data-kt-customer-table-filter="delete_row" ><i class="fas fa-trash" style="margin-left: 5px;"></i></button>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="7" class="text-center">
                No records found
            </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{ $pastors->render('vendor.pagination.default') }}
</div>
{{-- END Pagination --}}
