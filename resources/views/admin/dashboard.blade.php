@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">@lang('messages.Hello') {{ auth()->guard('admin')->user()->name }}! 🎉</h5>
                                    <p class="mb-4">@lang('messages.You are now in the private control panel on the Safi platform. Where you can control the platform')</p>

                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-label-primary">@lang('messages.View Users')</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <span class="d-block fw-semibold mb-1">@lang('messages.Users')</span>
                                    <h3 class="card-title mb-1">{{ $parameters['count'] }}</h3>
                                </div>
                                <div id="orderChart" class="mb-3"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}"
                                                 alt="Credit Card" class="rounded">
                                        </div>

                                    </div>
                                    <span>@lang('messages.Total Systems')</span>
                                    <h3 class="card-title text-nowrap mb-1 pt-2 pb-3">{{ $parameters['station'] }}</h3>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                                <div id="totalRevenueChart" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-label-primary dropdown-toggle"
                                                    type="button" id="growthReportId" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                2022
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                 aria-labelledby="growthReportId">
                                                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="growthChart"></div>
                                <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                                    <span class="badge bg-label-primary p-2"><i
                                                            class="bx bx-dollar text-primary"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>2022</small>
                                            <h6 class="mb-0">$32.5k</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="me-2">
                                                    <span class="badge bg-label-info p-2"><i
                                                            class="bx bx-wallet text-info"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>2021</small>
                                            <h6 class="mb-0">$41.2k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="Credit Card"
                                                 class="rounded">
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                 aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="javascript:void(0);">View
                                                    More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">@lang('messages.Total Update Phases')</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $parameters['phase'] }}</h3>
                                    <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i>
                                        +{{ $parameters['total_phase_percentage'] }}%</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body pb-2">
                                    <span class="d-block fw-semibold mb-1">Revenue</span>
                                    <h3 class="card-title mb-1">425k</h3>
                                    <div id="revenueChart"></div>
                                </div>
                            </div>
                        </div>
                        <!-- </div>
                      <div class="row"> -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                            <div class="card-title">
                                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                            </div>
                                            <div class="mt-sm-auto">
                                                <small class="text-success text-nowrap fw-semibold"><i
                                                        class='bx bx-chevron-up'></i> 68.2%</small>
                                                <h3 class="mb-0">$84,686k</h3>
                                            </div>
                                        </div>
                                        <div id="profileReportChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- pricingModal -->
            <!--/ pricingModal -->

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <!-- Footer-->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear())

                    </script>
                    , made with ❤️ by <a href="https://themeselection.com/" target="_blank"
                                         class="footer-link fw-bolder">ThemeSelection</a>
                </div>
            </div>
        </footer>
        <!--/ Footer-->
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>
{{--    <div class="row mx-auto w-100 g-0 mt-3">--}}
{{--        <div class="col-md-12">--}}
{{--            <h5 class="text-end pe-5 font-13 text-muted mb-2">Last Scan : <span>since 11 hours</span></h5>--}}
{{--        </div>--}}
{{--        <div class="col-md-8 my-2 my-md-0">--}}
{{--            <div class="row w-100 mx-auto">--}}
{{--                <div class="col-md-4 my-2 my-md-auto">--}}
{{--                    <div class="first-card card-padding rounded-card">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-9">--}}
{{--                                <img src="{{ asset('assets/images/asset-active.svg') }}" class="align-middle" width="17" alt="image">--}}
{{--                                <h5 class="font-17 d-inline-block ms-1 mb-0 align-middle">Users</h5>--}}
{{--                                <p class="mt-2 text-muted font-10">{{ $parameters['count'] }} user in Safi system</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-3">--}}
{{--                                <h5 class="font-25">{{ $parameters['count'] }}</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 my-2 my-md-auto">--}}
{{--                    <div class="second-card card-padding rounded-card">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-9">--}}
{{--                                <img src="{{ asset('assets/images/icon-devices.svg') }}" class="align-middle" width="17" alt="image">--}}
{{--                                <h5 class="font-17 d-inline-block ms-1 mb-0 align-middle">Systems</h5>--}}
{{--                                <p class="mt-2 text-muted font-10">{{ $parameters['totalSystems'] }} System in Safi System </p>--}}
{{--                            </div>--}}
{{--                            <div class="col-3">--}}
{{--                                <h5 class="font-25">{{ $parameters['totalSystems'] }}</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 my-2 my-md-auto">--}}
{{--                    <div class="third-card card-padding rounded-card">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-9">--}}
{{--                                <img src="{{ asset('assets/images/icon-bug.svg') }}" class="align-middle" width="17" alt="image">--}}
{{--                                <h5 class="font-17 d-inline-block ms-1 mb-0 align-middle">Threats</h5>--}}
{{--                                <p class="mt-2 text-muted font-10">20 Threats in manea system </p>--}}
{{--                            </div>--}}
{{--                            <div class="col-3">--}}
{{--                                <h5 class="font-25">20</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-4 my-2 my-md-0">--}}
{{--            <div class="px-2 ps-md-5 pe-md-3">--}}
{{--                <div class="rounded-card-scan bg-sub padding-card-scan text-center">--}}
{{--                    <img src="{{ asset('assets/images/logo.jpeg') }}" width="30" alt="safi">--}}
{{--                    <h5 class="font-size-20 d-inline-block ms-1 align-middle mb-0">Manea</h5>--}}
{{--                    <p class="font-13 fw-400 text-muted mt-2">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentum magna pharetra sit sit mattis. Sodales risus vehicula diam duis sed praesent.</p>--}}
{{--                    <div class="row mx-auto w-100 mt-2">--}}
{{--                        <div class="col-6 my-2 my-md-auto text-start">--}}
{{--                            <h5 class="font-14 mb-0">Last updated Safi</h5>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 my-2 my-md-auto text-end">--}}
{{--                            <h5 class="text-primary font-14 mb-0">Safi-2024</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row mx-auto w-100 g-0 mt-3">--}}
{{--        <div class="col-md-8 my-2 my-md-auto">--}}
{{--            <div class="row w-100 mx-auto">--}}
{{--                <div class="col-md-4 my-2 my-md-auto">--}}
{{--                    <div class="card-padding-statistics bg-sub shadow-card rounded-card-scan text-center">--}}
{{--                        <img src="{{ asset('assets/images/bug-danger.svg') }}" class="align-middle" width="22" alt="image">--}}
{{--                        <h5 class="font-25 d-inline-block ms-1 mb-0 align-middle">Threats</h5>--}}
{{--                        <p class="my-4 text-center text-muted fw-400 font-13">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentuam duis sed .</p>--}}
{{--                        <div class="width-85 height-85 overflow-hidden bg-sub-progress rounded-circle d-flex justify-content-center position-relative align-items-center mx-auto">--}}
{{--                            <div class="bg-danger-progress-circle w-100 height-100 position-absolute" style="left: calc(-100% + 70%)"></div>--}}
{{--                            <div class="width-70 height-70 bg-sub d-flex justify-content-center align-items-center mx-auto rounded-circle" style="position: absolute ; z-index: 10">--}}
{{--                                <h5 class="font-14 mb-0">70%</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 my-2 my-md-auto">--}}
{{--                    <div class="card-padding-statistics position-relative bg-sub shadow-card rounded-card-scan text-center">--}}
{{--                        <img src="{{ asset('assets/images/bug-success.svg') }}" class="align-middle" width="22" alt="image">--}}
{{--                        <h5 class="font-25 d-inline-block ms-1 mb-0 align-middle">No Threats</h5>--}}
{{--                        <p class="my-4 text-center text-muted fw-400 font-13">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentuam duis sed .</p>--}}
{{--                        <div class="width-85 height-85 overflow-hidden bg-sub-progress rounded-circle d-flex justify-content-center position-relative align-items-center mx-auto">--}}
{{--                            <div class="bg-success w-100 height-100 position-absolute" style="left: calc(-100% + 50%)"></div>--}}
{{--                            <div class="width-70 height-70 bg-sub d-flex justify-content-center align-items-center mx-auto rounded-circle" style="position: absolute ; z-index: 10">--}}
{{--                                <h5 class="font-14 mb-0">50%</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 my-2 my-md-auto">--}}
{{--                    <div class="card-padding-statistics bg-sub shadow-card rounded-card-scan text-center">--}}
{{--                        <h5 class="font-25 d-inline-block ms-1 mb-0 align-middle">Threats Details</h5>--}}
{{--                        <p class="my-4 text-center text-muted fw-400 font-13">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentuam duis sed .</p>--}}
{{--                        <div class="width-85 height-85 overflow-hidden bg-sub-progress rounded-circle d-flex justify-content-center position-relative align-items-center mx-auto">--}}
{{--                            <div class="bg-warning w-100 height-100 position-absolute" style="left: calc(-100% + 30%)"></div>--}}
{{--                            <div class="width-70 height-70 bg-sub d-flex justify-content-center align-items-center mx-auto rounded-circle" style="position: absolute ; z-index: 10">--}}
{{--                                <h5 class="font-14 mb-0">30%</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-4 my-2 my-md-auto">--}}
{{--            <div class="px-2 ps-md-5 pe-md-3">--}}
{{--                <div class="rounded-card-scan bg-sub padding-card-progress text-start">--}}
{{--                    <h5 class="font-size-20 mb-0">Warning levels</h5>--}}
{{--                    <div class="py-3">--}}
{{--                        <div class="progress-content">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h5 class="text-muted font-13">Low</h5>--}}
{{--                                <h5 class="text-muted font-13">10</h5>--}}
{{--                            </div>--}}
{{--                            <div class="progress mb-3">--}}
{{--                                <div class="progress-bar rounded-right-3 bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress-content">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h5 class="text-muted font-13">Medium</h5>--}}
{{--                                <h5 class="text-muted font-13">2</h5>--}}
{{--                            </div>--}}
{{--                            <div class="progress mb-3">--}}
{{--                                <div class="progress-bar rounded-right-3 bg-warning" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress-content">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h5 class="text-muted font-13">High</h5>--}}
{{--                                <h5 class="text-muted font-13">12</h5>--}}
{{--                            </div>--}}
{{--                            <div class="progress mb-3">--}}
{{--                                <div class="progress-bar rounded-right-3 bg-danger" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress-content">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h5 class="text-muted font-13">Critical</h5>--}}
{{--                                <h5 class="text-muted font-13">8</h5>--}}
{{--                            </div>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar rounded-right-3 bg-very-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
