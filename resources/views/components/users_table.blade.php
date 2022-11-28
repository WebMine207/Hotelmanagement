<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0" style="vertical-align: middle;">
            <th>Full Name</th>
            <th>Mobile Number</th>
            <th>Created At</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($users)>0)
        @foreach($users as $user)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td class="sorting_1">
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <div class="text-gray-800"> @if(!empty($user->full_name))  {{$user->full_name}} @else {{ '-' }} @endif</div>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div>
                            <span>{{ $user->mobile_number }}</span>
                        </div>
                    </div>
                    <!--begin::User details-->
                </td>
                <td><span>@if($user->userType) {{ $user->userType->name }} @else {{'Customer'}} @endif</span></td>
                
                <td>{{ date('d-m-Y', strtotime($user->created_at)); }}</td>
                <td>
                    <?php
                    $checked = ($user->status == 1) ? "checked" : "";
                    $ids=$user->id;
                    ?>
                    <div class="form-check form-switch  form-check-custom form-check-solid">
                        <input class="form-check-input update_status" data-title="user" name="status" type="checkbox" href="#" {{$checked}} />
                    </div>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{route('users.edit',$user->id)}}"><i class="fas fa-edit" style="margin-left: 5px;"></i></a>

                    <button class="btn btn-sm btn-danger delete_row" data-title="user" data-href="{{route('users.destroy',$user->id)}}" data-user_id ="{{$user->id}}" data-kt-customer-table-filter="delete_row" ><i class="fas fa-trash" style="margin-left: 5px;"></i></button>
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
    {{ $users->render('vendor.pagination.default') }}
</div>
{{-- END Pagination --}}
