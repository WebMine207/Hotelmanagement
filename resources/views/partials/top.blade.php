<div class="toolbar">
    <!--begin::Toolbar-->
    <div
        class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-5">
            <!--begin::Title-->
            <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">{{'Hotel Management'}}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                <!--begin::Item-->
                {!! setBreadCrumb('Home', route('home') ,1) !!}
                <!--end::Item-->
                @yield('title')
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
                <!--begin::Notifications-->
                        <div class="d-flex align-items-center">
                            <!--begin::Menu- wrapper-->
                            <a href="#"  class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary"
                            data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                            data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                           
                            <!--end::Svg Icon-->
                        </a>
      
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::Notifications-->
    </div>
    <!--end::Toolbar-->
</div>
