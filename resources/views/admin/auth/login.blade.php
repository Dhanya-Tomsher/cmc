@extends('admin.layouts.auth', ['body_class' => 'authentication-bg', 'title' => 'Login'])
<!-- @section('content') -->
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">

                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-10">
                        <div class="card p-0 rounded-4 m-0">
                           
                            <div class="card-body p-0"> 
                  <div class="row">

                    <div class="col-5 login_img">
                        <img src="{{ asset('assets/images/login_img.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-7 p-5">
                        <div class="text-start mt-2">
                                <a href="#" class="mb-5 d-block auth-logo">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo logo-dark">
                                </a>
                     
                            <h5 class="text-primary">Account Login</h5>
                        </div>
                        <div class="mt-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="username">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                   
                                </div>
        
                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
                                
                                <div class="mt-3 text-start">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">LOGIN</button>
                                </div>

                            </form>
                        </div>
                    </div>

                  </div>
            
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        @push('footer')