<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>Title</th>
            <!-- <th>Category</th> -->
            <th>Created At</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($sub_categories)>0)
        @foreach($sub_categories as $sub_category)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td>{{ $sub_category->title }}
                    {{--Begining:: Business service appoval --}}
                    @if($sub_category)
                        @if($sub_category->status == 2 && $sub_category->created_by != null)

                        @php
                            $user_first_name ='';
                            $user_last_name ='';
                            $user_email ='';
                            if($sub_category->userDetails){
                                $user_first_name = $sub_category->userDetails->first_name;
                                $user_last_name = $sub_category->userDetails->last_name;
                                $user_email = $sub_category->userDetails->email;
                            }
                            $content ='';
                            $content = "<span class='text-info p-1 d-block mt-0 mb-1'>Name : $user_first_name  $user_last_name <br> Email : $user_email</span>";
                        @endphp
                                <span class="cursor-pointer badge badge-light-warning created_by_popover" data-bs-toggle="popover" data-bs-html="true" data-bs-placement="top"  title="<span class ='p-1'><b>Created By</b></span>" data-bs-content="{{$content}}" data-bs-trigger="hover">
                                    <i class="fas fa-info-circle text-warning"></i> Pending
                                </span>
                        @elseif($sub_category->status == 2)
                              <span class="badge badge-light-warning"><i class="fas fa-info-circle text-warning"></i> Pending</span>
                        @endif
                    @endif
                {{--End:: Business service appoval --}}
                </td>


                <!-- <td>{{ ($sub_category->category)? $sub_category->category->title :' - ' }}</td> -->

                  <!--begin::created at date-->
                  <td>{{ date('m-d-Y', strtotime($sub_category->created_at)); }}</td>
                  <!--end::created at date-->
                  <td>
                    <?php
                    $checked = ($sub_category->status == 1) ? "checked" : "";
                    $ids=$sub_category->id;
                    ?>
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input update_status" name="status" type="checkbox" data-title="service" href="{{route('sub_category.update_status',getEncrypted($sub_category->id))}}" {{$checked}} />
                    </div>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary edit_user" href="{{route('business_services.edit',getEncrypted($sub_category->id))}}"><i class="fas fa-edit" style="margin-left:7px;"></i></a>
                    <button class="btn btn-sm btn-danger delete_row" data-title="subcategory" data-href="{{route('business_services.destroy',getEncrypted($sub_category->id))}}" data-banner_id ="{{getEncrypted($sub_category->id)}}" data-kt-banner-content-table-filter="delete_row" ><i style="margin-left:6px;" class="fas fa-trash"></i></button>
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
    {{ $sub_categories->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}
