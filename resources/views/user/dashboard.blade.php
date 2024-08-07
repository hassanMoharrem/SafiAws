@extends('user.layouts.app')
@section('content')
            <div class="row mx-auto w-100 g-0">
                <div class="col-md-12">
                    <h5 class="text-end pe-5 font-13 text-muted mb-2">Last Scan: <span>since 11 hours</span></h5>
                </div>
                <div class="col-md-8 my-2 my-md-0">
                    <div class="row w-100 mx-auto">
                        <div class="col-md-4 my-2 my-md-auto">
                            <div class="first-card card-padding rounded-card">
                                <div class="row">
                                    <div class="col-9">
                                        <img src="{{ asset("assets/images/asset-active.svg") }}" class="align-middle" width="17" alt="image">
                                        <h5 class="font-17 d-inline-block ms-1 mb-0 align-middle">Assets</h5>
                                        <p class="mt-2 text-muted font-10">40 Assets in manea system </p>
                                    </div>
                                    <div class="col-3">
                                        <h5 class="font-25">40</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-auto">
                            <div class="second-card card-padding rounded-card">
                                <div class="row">
                                    <div class="col-9">
                                        <img src="{{ asset("assets/images/icon-devices.svg") }}" class="align-middle" width="17" alt="image">
                                        <h5 class="font-17 d-inline-block ms-1 mb-0 align-middle">Devices</h5>
                                        <p class="mt-2 text-muted font-10">80 Devices in manea system </p>
                                    </div>
                                    <div class="col-3">
                                        <h5 class="font-25">80</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-auto">
                            <div class="third-card card-padding rounded-card">
                                <div class="row">
                                    <div class="col-9">
                                        <img src="{{ asset("assets/images/icon-bug.svg") }}" class="align-middle" width="17" alt="image">
                                        <h5 class="font-17 d-inline-block ms-1 mb-0 align-middle">Threats</h5>
                                        <p class="mt-2 text-muted font-10">20 Threats in manea system </p>
                                    </div>
                                    <div class="col-3">
                                        <h5 class="font-25">20</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 my-2 my-md-0">
                    <div class="px-2 ps-md-5 pe-md-3">
                        <div class="rounded-card-scan bg-sub padding-card-scan text-center">
                            <img src="assets/images/logo.jpeg" width="30" alt="manea logo">
                            <h5 class="font-size-20 d-inline-block ms-1 align-middle mb-0">Manea</h5>
                            <p class="font-13 fw-400 text-muted mt-2">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentum magna pharetra sit sit mattis. Sodales risus vehicula diam duis sed praesent.</p>
                            <div class="row mx-auto w-100 mt-2">
                                <div class="col-6 my-2 my-md-auto text-start">
                                    <h5 class="font-14 mb-0">Last updated cve</h5>
                                </div>
                                <div class="col-6 my-2 my-md-auto text-end">
                                    <h5 class="text-primary font-14 mb-0">CVE-2012-3287</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-auto w-100 g-0 mt-3">
                <div class="col-md-8 my-2 my-md-auto">
                    <div class="row w-100 mx-auto">
                        <div class="col-md-4 my-2 my-md-auto">
                            <div class="card-padding-statistics bg-sub shadow-card rounded-card-scan text-center">
                                <img src="assets/images/bug-danger.svg" class="align-middle" width="22" alt="image">
                                <h5 class="font-25 d-inline-block ms-1 mb-0 align-middle">Threats</h5>
                                <p class="my-4 text-center text-muted fw-400 font-13">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentuam duis sed .</p>
                                <div class="width-85 height-85 overflow-hidden bg-sub-progress rounded-circle d-flex justify-content-center position-relative align-items-center mx-auto">
                                    <div class="bg-danger-progress-circle w-100 height-100 position-absolute" style="left: calc(-100% + 70%)"></div>
                                    <div class="width-70 height-70 bg-sub d-flex justify-content-center align-items-center mx-auto rounded-circle" style="position: absolute ; z-index: 10">
                                        <h5 class="font-14 mb-0">70%</h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-auto">
                            <div class="card-padding-statistics position-relative bg-sub shadow-card rounded-card-scan text-center">
                                <img src="assets/images/bug-success.svg" class="align-middle" width="22" alt="image">
                                <h5 class="font-25 d-inline-block ms-1 mb-0 align-middle">No Threats</h5>
                                <p class="my-4 text-center text-muted fw-400 font-13">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentuam duis sed .</p>
                                <div class="width-85 height-85 overflow-hidden bg-sub-progress rounded-circle d-flex justify-content-center position-relative align-items-center mx-auto">
                                    <div class="bg-success w-100 height-100 position-absolute" style="left: calc(-100% + 50%)"></div>
                                    <div class="width-70 height-70 bg-sub d-flex justify-content-center align-items-center mx-auto rounded-circle" style="position: absolute ; z-index: 10">
                                        <h5 class="font-14 mb-0">50%</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-auto">
                            <div class="card-padding-statistics bg-sub shadow-card rounded-card-scan text-center">
                                <h5 class="font-25 d-inline-block ms-1 mb-0 align-middle">Threats Details</h5>
                                <p class="my-4 text-center text-muted fw-400 font-13">Lorem ipsum dolor sit amet consectetur. Nulla non morbi fermentuam duis sed .</p>
                                <div class="width-85 height-85 overflow-hidden bg-sub-progress rounded-circle d-flex justify-content-center position-relative align-items-center mx-auto">
                                    <div class="bg-warning w-100 height-100 position-absolute" style="left: calc(-100% + 30%)"></div>
                                    <div class="width-70 height-70 bg-sub d-flex justify-content-center align-items-center mx-auto rounded-circle" style="position: absolute ; z-index: 10">
                                        <h5 class="font-14 mb-0">30%</h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-2 my-md-auto">
                    <div class="px-2 ps-md-5 pe-md-3">
                        <div class="rounded-card-scan bg-sub padding-card-progress text-start">
                            <h5 class="font-size-20 mb-0">Warning levels</h5>
                            <div class="py-3">
                                <div class="progress-content">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-muted font-13">Low</h5>
                                        <h5 class="text-muted font-13">10</h5>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar rounded-right-3 bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-content">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-muted font-13">Medium</h5>
                                        <h5 class="text-muted font-13">2</h5>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar rounded-right-3 bg-warning" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-content">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-muted font-13">High</h5>
                                        <h5 class="text-muted font-13">12</h5>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar rounded-right-3 bg-danger" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-content">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-muted font-13">Critical</h5>
                                        <h5 class="text-muted font-13">8</h5>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar rounded-right-3 bg-very-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
