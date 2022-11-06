<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>Title</th>
            <th>Created At</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($cms_modules)>0)
        @foreach($cms_modules as $value)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td>{{ getCMSTitle($value->slug) }}</td>
                <!--begin::created at date-->
                <td>{{ date('m-d-Y', strtotime($value->created_at)); }}</td>
                <!--end::created at date-->
                <td>
                    <a class="btn btn-sm btn-primary edit_user" href="{{route('cms.update',$value->slug)}}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="4" class="text-center"> No records found </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<section class="custom-pagination">
    {{ $cms_modules->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}
