{{--
<!doctype html>
<html lang="tr" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css')}}">

  <!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />

  <title>ERP - ÇUKUROVA YAZILIM</title>
</head>

<body>

  <!--start wrapper-->
  <div class="wrapper">

       <!--start content-->
       <main class="authentication-content">
        <div class="container-fluid">
          <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="assets/images/error/login-img.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">ÇUKUROVA YAZILIM</h5>
                    <p class="card-text mb-5">See your growth and get consulting support!</p>
                    <form class="m-t-md form-body" action="{{ route('user.login') }}" method="POST">
                        @csrf

                      <div class="login-separater text-center mb-4">
                      </div>
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email Address">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Enter Password">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                              <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                            </div>
                          </div>
                          <div class="col-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                            </div>
                          </div>
                          <div class="col-12">
                            <marquee  behavior="" direction=""><b style="padding: 0%;">Programcılar, geleceği düşündükleri için sürekli olarak işleri gereğinden fazla karmaşıklaştırmaktadırlar. Geleceği boşverin. Bugün için programlayın.
                                Bekir Ünal KAYMAKÇI</b></marquee>
                          </div>
                        </div>
                    </form>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </main>

       <!--end page main-->

  </div>
  <!--end wrapper-->


  <!--plugins-->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>


</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> ÇUKUROVA CRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="ÇUKUROVA CRM" name="description" />
    <meta content="BEKİR ÜNAL KAYMAKÇI - bukaymakci@gmail.com" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css')}}">
    <!-- App css -->
    <link href="{{asset('logintemp/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('logintemp/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('logintemp/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    body{
        background: url('logintemp/bg-account.jpg');
        background-repeat: no-repeat;

    }
</style>
</head>

<body>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login">
                                    <img src="{{ asset('logintemp/sys.png') }}" height="600" width="452" alt="">
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="https://cukurovapatent.com/" target="_blank" class="text-dark font-size-22 font-family-secondary">
                                                 <b><img src="{{ asset('logintemp/softwarelogo.png') }}" height="120" width="250" alt=""></b>
                                            </a>
                                        </div>

                                        <p class="text-muted mb-4"></p>
                                        <form class="m-t-md" action="{{ route('user.login') }}" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user mb-3" id="exampleInputEmail" placeholder="Kullanıcı Adı">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user mb-3" id="exampleInputPassword" placeholder="Şifre">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light mb-3"> Giriş Yap </button>
                                        </form>
                                            <div class="text-center mt-4">
                                                <h5 class="text-muted font-size-16">Bize Ulaşın..!</h5>

                                                <ul class="list-inline mt-3 mb-5">
                                                    <li class="list-inline-item">
                                                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="fa-solid fa-globe"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript: void(0);" class="social-list-item border-success text-success"><i class="fa-solid fa-phone"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="fa-solid fa-envelope"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <hr>
                                            <marquee  behavior="" direction=""><b style="padding: 0%;">Programcılar, geleceği düşündükleri için sürekli olarak işleri gereğinden fazla karmaşıklaştırmaktadırlar. Geleceği boşverin. Bugün için programlayın.
                                                Bekir Ünal KAYMAKÇI</b></marquee>


                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{asset('logintemp/js/jquery.min.js')}}"></script>
    <script src="{{asset('logintemp/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('logintemp/js/metismenu.min.js')}}"></script>
    <script src="{{asset('logintemp/js/waves.js')}}"></script>
    <script src="{{asset('logintemp/js/simplebar.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('logintemp/js/theme.js')}}"></script>

</body>

</html>
