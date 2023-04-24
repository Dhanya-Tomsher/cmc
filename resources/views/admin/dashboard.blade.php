@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dashboard'])
@section('content')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body py-4">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                                            <p class="text-muted mb-0">No. of Registered Cats</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col">
                                <div class="card">
                                    <div class="card-body py-4">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"></span></h4>
                                            <p class="text-muted mb-0">No. of Registered Caretakers</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col">
                                <div class="card">
                                    <div class="card-body py-4">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">97</span></h4>
                                            <p class="text-muted mb-0">Total no. of neutered cats  </p>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col">
                                <div class="card">
                                    <div class="card-body py-4">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart" data-colors='["--bs-warning"]'></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">140</span></h4>
                                            <p class="text-muted mb-0">Total no. of spayed females </p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chartd" data-colors='["--bs-warning"]'></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">275</span></h4>
                                            <p class="text-muted mb-0">Total no. of castrated males</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Search Caretaker</h4>
                                        <form>
                                            <div class="hstack gap-3">
                                                <input class="form-control me-auto" type="search" placeholder="Search by : Reg No, Name, Mobile Number, ED" aria-label="Add your item here...">
                                                <a href="#" class="btn btn-primary waves-effect waves-light w-xl">Search Caretaker</a>
                                            </div>
                                        </form>

                                        <a href="{{ route('caretaker.create') }}" class="btn btn-primary waves-effect waves-light w-xl mt-3">Register Caretaker</a>

                                    </div><!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Search Cat</h4>
                                        <form>
                                            <div class="hstack gap-3">
                                                <input class="form-control me-auto" name="serch" value="{{ request()->serch }}" type="search" placeholder="Search by : Name, Color, Gender, Microchip, Fur Color, Eye Color" aria-label="Add your item here...">
                                                <button class="btn btn-primary waves-effect waves-light w-xl">Search Cat</button>
                                            </div>
                                        </form>


                                        <a href="{{ route('cat.create') }}" class="btn btn-primary waves-effect waves-light w-xl mt-3">Register Cat</a>

                                    </div><!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->

                 

                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row mb-4 align-items-center">
                                            <div class="col-6">
                                                <h4 class="card-title mb-4">Contact Directory</h4>
                                            </div>
                                            <div class="col-6">
                                                <form>
                                                    <div class="hstack gap-3">
                                                        <input class="form-control me-auto" type="search" placeholder="Search by : Name, Phone, Email">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xl">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                 
                                                        <td>Perry Scope </td>
                                                        <td>perryscope@gmail.com</td>
                                                        <td>
                                                            +971 55 820 2720
                                                        </td>
                                                        <td>
                                                            Jebel Ali, Dubai
                                                        </td>
                                                        <td>
                                                            <a href="#;" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                            <a href="#" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                        </td>

                                                    </tr>
                                                    <tr>

                                                        <td>Rhoda Report </td>
                                                        <td>rhodareport@gmail.com</td>
                                                        <td>
                                                            +971 55 518 9166
                                                        </td>
                                                        <td>
                                                            Al Aweer,  Dubai
                                                        </td>
                                                        <td>
                                                            <a href="#;" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                            <a href="#" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                         
                                                        <td>Bess Twishes </td>
                                                        <td>besstwishes@gmail.com</td>
                                                        <td>
                                                            +971 55 152 2435
                                                        </td>
                                                        <td>
                                                            Lahbab, Dubai
                                                        </td>
                                                        <td>
                                                            <a href="#;" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                            <a href="#" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                        </td>

                                                    </tr>


                                                  
                                                 
                                                 
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                @endsection
@push('header')
@endpush