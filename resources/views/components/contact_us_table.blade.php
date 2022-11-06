<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input type="checkbox" class="form-check-input" name="select_all" value="1" id="search-select-all">
                </div>
            </th>
            <th>Customer Info</th>
            <th>Business Info</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($contact_us)>0)
        @foreach($contact_us as $contact)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input type="checkbox" name="contacts_id[]" value="{{$contact->id}}" class="form-check-input selected_rows" id="bulk_update_id">
                    </div>
                </td>
                <td class="mw-200 px-2">
                    {{ $contact->name }}
                    <br>
                    {{ $contact->email }}
                    <br>
                    <span class="mobile_input_mask"> {{ $contact->mobile_number }} </span>
                </td>

                <td class="mw-200 px-2">
                    {{ isset($contact->get_business_details) ? $contact->get_business_details->business_name : '' }}
                    <br>
                    {{ isset($contact->get_business_details) ? $contact->get_business_details->business_email : '' }}
                </td>

                <td class="mw-200 px-2">{{ $contact->description }}</td>

                <!--begin::created at date-->
                <td class="px-2">{{ date('m-d-Y h:i A', strtotime($contact->created_at)); }}</td>
                <!--end::created at date-->

                <td>
                    <button class="btn btn-sm btn-danger delete_row" data-title="contact" data-href="{{route('contact_us.destroy',getEncrypted($contact->id))}}" data-contact_id ="{{getEncrypted($contact->id)}}" data-kt-customer-table-filter="delete_row" ><i class="fas fa-trash" style="margin-left: 5px;"></i></button>
                </td>

            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="6" class="text-center"> No records found </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<section class="custom-pagination">
    {{ $contact_us->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}

