@extends('admin.layouts.app')
@section('title')
    ANA MENÜ
@endsection
@section('topheader')
    ANA MENÜ
@endsection
@section('contents')
<style>
    .card-y{
        background-position: center;
        background-size:cover;
        height: 600px;
        border-radius: 5px;




    }


    .card-container {
    position: relative; /* Absolute öğenin referans alacağı div */
    width: 100%; /* Kartın genişliği */
    height: 250px; /* Kartın yüksekliği */
    padding: 10px 0;
    box-shadow: rgba(3, 18, 31, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;
    transition: transform 0.3s ease-in-out;

}
.card-container:hover {
    transform: scale(1.05);
    cursor: pointer;
}
.widget-icon2 {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%; /* Resmin genişliği */
    border: none !important;
}
.card-body{
    padding: 0;
}
.card-body img{
    width: 100px;
    height: 100px;
}
.widget-icon2 img {
    width: 100%; /* Resmi tam boyutlandır */
    height: auto;
}
/* style=" background-image: url('{{asset('resim/8.png')}}')" */
</style>
<div class="error-404 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="card-y py-5" >
            <div class="row " style="padding: 0 5rem ">
                <div class="col-lg-2 " >
                    <div class="card radius-5 card-container">
                        <div class="card-body text-center" >
                         <img src="{{asset('resim/hesap.gif')}}"  alt="">

                        </div>
                        <div class="widget-icon2">
                            <img src="{{asset('resim/muhasebe.png')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center" style="color: rgb(136, 132, 132)">Muhasebe</h5>

                    </div>
                </div>
                <div class="col-lg-2" >
                    <div class="card radius-5 card-container">
                        <div class="card-body text-center">
                         <img src="{{asset('resim/erp.gif')}}"  alt="">

                        </div>
                        <div class="widget-icon2">
                            <img src="{{asset('resim/muhasebe.png')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center" style="color: rgb(136, 132, 132)">İnsan Kaynakları</h5>
                    </div>
                </div>
                <div class="col-lg-2" >
                    <div class="card radius-5 card-container">
                        <div class="card-body text-center">
                         <img src="{{asset('resim/depo.gif')}}"  alt="">

                        </div>
                        <div class="widget-icon2">
                            <img src="{{asset('resim/muhasebe.png')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center" style="color: rgb(136, 132, 132)">Bakım Onarım</h5>
                    </div>
                </div>
                <div class="col-lg-2" >
                    <div class="card radius-5 card-container">
                        <div class="card-body text-center">
                         <img src="{{asset('resim/idari.gif')}}"  alt="">

                        </div>
                        <div class="widget-icon2">
                            <img src="{{asset('resim/muhasebe.png')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center" style="color: rgb(136, 132, 132)">İdari İşler</h5>
                    </div>
                </div>
                <div class="col-lg-2" >
                    <div class="card radius-5 card-container">
                        <div class="card-body text-center">
                         <img src="{{asset('resim/depo.gif')}}"  alt="">

                        </div>
                        <div class="widget-icon2">
                            <img src="{{asset('resim/muhasebe.png')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center" style="color: rgb(136, 132, 132)">Bakım Onarım</h5>
                    </div>
                </div>
                <div class="col-lg-2" >
                    <div class="card radius-5 card-container">
                        <div class="card-body text-center">
                         <img src="{{asset('resim/kargo.gif')}}"  alt="">

                        </div>
                        <div class="widget-icon2">
                            <img src="{{asset('resim/muhasebe.png')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center" style="color: rgb(136, 132, 132)">Bakım Onarım</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
