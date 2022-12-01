<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0" style="vertical-align: middle;">
            <th width="25%">Name</th>
            <th>Owner</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($hotels)>0)
        @foreach($hotels as $hotel)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">

                <td class="sorting_1">
                    <div class="d-flex flex-column">
                        <div class="text-gray-800">   {{$hotel->name}}</div>
                        <span>{{ $hotel->total_room }} {{'- Rooms'}} </span> 
                        <span>{{ $hotel->guest }} {{'- Guest/room '}} </span>
                    </div>
                    </div>
                </td>
                <td>@if($hotel->owner) {{ $hotel->owner->full_name }} @else {{' - '}} @endif </td>
                <td>{{ $hotel->price }}</td>
                <td>{{ date('d-m-Y', strtotime($hotel->created_at)); }}</td>
                <td>
                    <?php
                    $checked = ($hotel->status == 1) ? "checked" : "";
                    ?>
                    <div class="form-check form-switch  form-check-custom form-check-solid">
                        <input class="form-check-input update_status" data-title="hotel" data-id="{{ $hotel->id }}" name="status" type="checkbox" href="{{ route('hotels.update_status')}}" {{$checked}} />
                    </div>
                </td>
                <td>
                    <!-- <a class="btn btn-sm btn-primary" href="{{route('hotels.edit',$hotel->id)}}"><i class="fas fa-edit" style="margin-left: 5px;"></i></a> -->

                    <button class="btn btn-sm btn-danger delete_row" data-title="hotel" data-href="{{route('hotels.destroy',$hotel->id)}}" data-user_id ="{{$hotel->id}}" data-kt-customer-table-filter="delete_row" ><i class="fas fa-trash" style="margin-left: 5px;"></i></button>
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
@if(count($hotels)>0)
    {{ $hotels->render('vendor.pagination.default') }}
@endif
</div>
{{-- END Pagination --}}

