<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0" style="vertical-align: middle;">

             <th class="">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input type="checkbox" class="form-check-input" name="select_all" value="1" id="search-select-all">
                </div>
            </th>
            <th>User Info.</th>
            <th>Business Info.</th>
            <th class="pr-1">Created At</th>
            <th class="pr-1">Approval</th>
            <th class="pr-1">status</th>
            <th class="pr-1 text-center">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($users)>0)
        @foreach($users as $key => $user)

            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">

                <!--begin::bulk update selection box-->
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input type="checkbox" name="users_id[]" value="{{$user->id}}" class="form-check-input selected_rows"  id="bulk_update_id">
                    </div>
                </td>
                <!--end::bulk update selection box-->

                <!--begin::user info-->
                <td class="sorting_1">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-square symbol-50px overflow-hidden me-3">
                            <a href="{{route('business.show',getEncrypted($user->id))}}">
                                <div class="symbol-label">
                                    <img src="{{$user->users_details->user_profile}}" alt="{{$user->users_details->name}}" class="w-100">
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="text-gray-800">{{$user->users_details->full_name}}</div>
                            <span>{{ $user->users_details->email }}</span>
                            @if (!empty($user->users_details->mobile_number))
                            <span>{{  ($user->country) ? '+'. $user->users_details->country_code : '' }} <span class="mobile_input_mask">{{ $user->users_details->mobile_number }}</span></span>
                            @endif
                        </div>
                    </div>
                </td>
                <!--end::user info-->

                <!--begin::business info-->
                <td class="sorting_1">
                    <div class="d-flex flex-column">
                        <div class="text-gray-800">{{$user->business_name}}</div>
                        <span>{{ $user->business_email }}</span>
                        @if (!empty($user->business_mobile_number))
                        <span>{{  ($user->country) ? '+'. $user->country_code : '' }} <span class="mobile_input_mask">{{ $user->business_mobile_number }}</span></span>
                        @endif
                    </div>
                </td>
                <!--end::business info-->

                <!--begin::created at date-->
                <td>{{ date('m-d-Y', strtotime($user->created_at)); }}</td>
                <!--end::created at date-->
                 <!--begin::aprroval-->
                 <td>
                    @if($user->get_revision != null && $user->users_details->email_verified_at != "" && $user->church_approval == 1)
                        @if($user->get_revision->is_approved == 0)
                            <a href="javascript:void(0)"  class="change_status_class" data-status="{{$user->is_approved}}" data-url="{{route('business.update_approval_status',getEncrypted($user->id))}}" data-from="userlisting">
                                <span class="badge badge-light-warning">Pending</span>
                            </a>
                        @else
                            <span class="badge badge-light-danger">Rejected</span>
                        @endif
                    @else
                        @if($user->is_approved == 1)
                            <span class="badge badge-light-success">Approved</span>
                        @elseif($user->is_approved == 2)
                            <span class="badge badge-light-danger">Rejected</span>
                        @elseif($user->church_approval == 2)
                            <span class="cursor-pointer badge badge-light-danger" data-bs-toggle="popover" data-bs-html="true" data-bs-placement="top" title="<span><b>Note</b></span>" data-bs-trigger="hover" data-bs-content="<span class='bg-light-danger text-danger p-2 d-block mb-1'><i class='fa fa-info-circle text-danger'></i>&nbsp;{{'Church rejected this business'}} <br> {{'Reason : '. $user->church_reject_reason}}</span>">
                                        <i class="fas fa-info-circle text-danger"></i> Rejected
                            </span>
                        @else
                                @if($user->users_details->email_verified_at == "" || $user->church_approval != 1)
                                @php
                                    $content = "";
                                    if($user->users_details->email_verified_at == "" && $user->church_approval != 1){
                                        $content = "<span class='bg-light-danger text-danger p-2 d-block mb-1'><i class='fa fa-info-circle text-danger'></i> email verification pending</span><span class='bg-light-warning text-warning p-2 d-block mb-1'><i class='fa fa-info-circle text-warning'></i> church verification pending</span>";
                                    }elseif($user->users_details->email_verified_at == ""){
                                        $content = "<span class='bg-light-danger text-danger p-2 d-block mb-1'><i class='fa fa-info-circle text-danger'></i>email verification pending</span>";
                                        
                                    }elseif($user->church_approval != 1){
                                            $content = "<span class='bg-light-warning text-warning p-2 d-block mb-1'><i class='fa fa-info-circle text-warning'></i>church verification pending</span>";
                                    }
                                @endphp
                                <span class="cursor-pointer badge badge-light-warning" data-bs-toggle="popover" data-bs-html="true" data-bs-placement="top" title="<span><b>Note</b></span>" data-bs-content="{{$content}}" data-bs-trigger="hover">
                                    <i class="fas fa-info-circle text-warning"></i> Pending
                                </span>
                                @else
                                <span class="badge badge-light-warning"> Pending </span>
                                @endif
                        @endif
                    @endif
                </td>
                {{-- /*badge badge-light-danger*/ --}}
                <!--end::aprroval-->

                 <!--begin::status-->
                 <td class="text-center">
                    <?php
                        $checked = ($user->status == 1) ? "checked" : "";
                        $ids=$user->id;
                    ?>
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input update_status" data-title="business" name="status" type="checkbox" href="{{route('business.update_status',getEncrypted($user->id))}}" {{$checked}} />
                    </label>
                </td>
                <!--end::status-->
                <!--begin::Action-->
                <td class="text-start">
                    <a class="menu-link btn btn-sm btn-light btn-active-light-primary p-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">Actions
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon--></a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <a class="menu-link px-3" href="{{route('business.show',getEncrypted($user->id))}}" title="view Business"><i class="fas fa-eye"></i> &nbsp; View</a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3" href="{{route('business.edit',getEncrypted($user->id))}}" title="Edit Business"><i class="fas fa-edit"></i> &nbsp; Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete_row" title="Delete Business" data-href="{{route('business.destroy',getEncrypted($user->id))}}" data-title="Business" data-user_id ="{{getEncrypted($user->id)}}"><i class="fas fa-trash"></i>&nbsp; Delete</a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3" title="Contact Us" href="{{route('contact_us.index',getEncrypted($user->user_id))}}" ><i class="far fa-address-book" ></i>  &nbsp;Contact Us</a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3" title="Ask Quotes" href="{{route('ask_quotes.index',getEncrypted($user->user_id))}}"><i class="fa fa-question-circle" ></i>&nbsp;Ask Quotes</a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 business_reviews" title="Business Review" data-href="{{route('business.all_review')}}" data-user_id ="{{getEncrypted($user->id)}}"><i class="fa fa-star" ></i>&nbsp; Reviews</a>
                        </div>
                    </div>
                    <!--end::Menu-->
                </td>
                <!--end::action-->
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="9" class="text-center">
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
