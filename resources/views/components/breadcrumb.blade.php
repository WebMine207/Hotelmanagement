<!--begin::Breadcrumb-->
<ul class="breadcrumb-separatorless fw-bold fs-7 pt-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin.home')}}"
            class="text-muted text-hover-primary">Home1</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-dark">@yield('title')</li>
    <!--end::Item-->

</ul>
<!--end::Breadcrumb-->
