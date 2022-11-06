<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>Title</th>
            <th>Created At</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($category)>0)
        @foreach($category as $categories)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td>{{ $categories->title }}</td>

                  <!--begin::created at date-->
                  <td>{{ date('m-d-Y', strtotime($categories->created_at)); }}</td>
                  <!--end::created at date-->
                <td>
                    <?php
                    $checked = ($categories->status == 1) ? "checked" : "";
                    $ids=$categories->id;
                    ?>
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input update_status" name="status" type="checkbox" data-title="category" href="{{route('category.update_status',getEncrypted($categories->id))}}" {{$checked}} />
                    </div>

                </td>
                <td>
                    <a class="btn btn-sm btn-primary edit_user" href="{{route('category.edit',getEncrypted($categories->id))}}"><i class="fas fa-edit" style="margin-left:7px;"></i></a>
                    <button class="btn btn-sm btn-danger delete_row" data-title="category" data-href="{{route('category.destroy',getEncrypted($categories->id))}}" data-banner_id ="{{getEncrypted($categories->id)}}" data-kt-banner-content-table-filter="delete_row" ><i style="margin-left:6px;" class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="3" class="text-center"> No records found </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<section class="custom-pagination">
    {{ $category->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}
