<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand">
      <div class="mobile-toggle-icon d-xl-none">
          <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar d-none d-xl-block">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item" style="display: flex; justify-content: center;">
                    <a class="nav-link" style="font-size: 16px; font-weight: 400;  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">@yield('topheader')</a>
                </li>
            </ul>
        </div>

        <div class="top-navbar-right ms-3 ms-auto">
          <ul class="navbar-nav align-items-center ">
          <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" style=" padding:0px; border-radius:5px;text-decoration: underline; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
              <div class="user-setting d-flex align-items-center gap-1">
                <img src="{{asset('resim/1725460898-BEKİR-ÜNAL-KAYMAKÇI.jpeg')}}" class="user-img" alt="" style="border-radius: 50%; ">
                @if(Auth::check())


                <div class="user-name d-none d-sm-block">{{ Auth::user()->ad_soyad }}</div>
                @endif

              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                      <img src="{{asset('resim/1725441039-BEKİR-ÜNAL-KAYMAKÇI.jpeg')}}" alt="" class="rounded-circle" width="60" height="60">
                      @if(Auth::check())
                      <div class="ms-3">
                          <h6 class="mb-0 dropdown-user-name">{{ Auth::user()->ad_soyad }}</h6>
                          <small class="mb-0 dropdown-user-designation text-secondary">{{ Auth::user()->departman }}</small>
                      </div>
                  @endif
                   </div>
                 </a>
               </li>
               <li><hr class="dropdown-divider"></li>
               <li>
                  <a class="dropdown-item" href="{{route('register.index')}}">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                       <div class="setting-text ms-3"><span>Kullanıcılar</span></div>
                     </div>
                   </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                       <div class="setting-text ms-3"><span>Setting</span></div>
                     </div>
                   </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{route('toplusms.index')}}">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                       <div class="setting-text ms-3"><span>Toplu SMS</span></div>
                     </div>
                   </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{route('toplumail.index')}}">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                         <div class="setting-text ms-3"><span>Toplu Mail</span></div>
                       </div>
                     </a>
                  </li>
                <li>
                  <a class="dropdown-item" href="{{route('aktiflog.index')}}">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-piggy-bank-fill"></i></div>
                       <div class="setting-text ms-3"><span>Loglar</span></div>
                     </div>
                   </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{route('entegrasyonmenu')}}">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-cloud-arrow-down-fill"></i></div>
                       <div class="setting-text ms-3"><span>Entegrasyonlar</span></div>
                     </div>
                   </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="{{route('admin.logout')}}">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                       <div class="setting-text ms-3"><span>Logout</span></div>
                     </div>
                   </a>
                </li>
            </ul>
          </li>

          </ul>
          </div>
    </nav>
  </header>
     <!--end top header-->

     <!--start sidebar -->
     <aside class="sidebar-wrapper">
        <div class="iconmenu">
          <div class="nav-toggle-box">
            <div class="nav-toggle-icon"><i style="font-size:16px; display: flex; justify-content: center; align-items: center; height: 100%;" class="fi fi-br-grid"></i></div>
          </div>
          <ul class="nav nav-pills flex-column">
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="CRM" >
              <button class="nav-link  {{ request()->is('anasayfa') || request()->is('anasayfa/*') ? 'active' : '' }} {{ request()->is('toplusms') || request()->is('toplusms/*') ? 'active' : '' }} {{ request()->is('toplumail') || request()->is('toplumail/*') ? 'active' : '' }} {{ request()->is('muhasebemenu') || request()->is('muhasebemenu/*') ? 'show active' : '' }} {{ request()->is('idariislermenu') || request()->is('idariislermenu/*') ? 'show active' : '' }} {{ request()->is('anamenu') || request()->is('anamenu/*') ? 'show active' : '' }}
                                        {{ request()->is('entegrasyonmenu') || request()->is('entegrasyonmenu/*') ? 'active' : '' }} {{ request()->is('ikmenu') || request()->is('ikmenu/*') ? 'show active' : '' }} {{ request()->is('makinemenu') || request()->is('makinemenu/*') ? 'show active' : '' }}
                                        {{ request()->is('cariler') || request()->is('cariler/*') ? 'active' : '' }} {{ request()->is('tedarikciler') || request()->is('tedarikciler/*') ? 'active' : '' }}
                                         {{ request()->is('kontaklistesi') || request()->is('kontaklistesi/*') ? 'active' : '' }}
                                      {{ request()->is('gorusmelistesi') || request()->is('gorusmelistesi/*') ? 'active' : '' }} {{ request()->is('aktiflog') || request()->is('aktiflog/*') ? ' active' : '' }}
                                      {{ request()->is('teklifler') || request()->is('onaylananteklifler') || request()->is('onaylanmayanteklifler') || request()->is('bekleyenteklifler') || request()->is('teklifler/*') ? 'active' : '' }}
                                       {{ request()->is('hizmetler') || request()->is('hizmetler/*') ? 'active' : '' }} {{ request()->is('satisfisineaktar') || request()->is('satisfisineaktar/*') ? 'active' : '' }}

                                         {{ request()->is('hizmetlerkategori') || request()->is('hizmetlerkategori/*') ? 'active' : '' }}
                                          {{ request()->is('resmievraklarr') || request()->is('resmievraklarr/*') ? 'active' : '' }}" data-bs-toggle="pill" data-bs-target="#pills-dashboards" type="button"><i style="font-size:18px;" class="bi bi-house-door-fill"></i></button>

            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="ÖN MUHASEBE">
              <button class="nav-link {{ request()->is('satislar') || request()->is('satislar/*') ? 'active' : '' }} {{ request()->is('tahsilatplan') || request()->is('tahsilatplan/*') ? 'active' : '' }} {{ request()->is('odemeplanlari') || request()->is('odemeplanlari/*') ? 'active' : '' }}
                                      {{ request()->is('alislar') || request()->is('alislar/*') ? 'active' : '' }} {{ request()->is('gidenefaturalar') || request()->is('gidenefaturalar/*') ? 'active' : '' }}
                                      {{ request()->is('tahsilat') || request()->is('tahsilat/*') ? 'active' : '' }} {{ request()->is('gelenfaturayialisaktar') || request()->is('gelenfaturayialisaktar/*') ? 'active' : '' }}
                                      {{ request()->is('odemeler') || request()->is('odemeler/*') ? 'active' : '' }} {{ request()->is('gelenefaturalar') || request()->is('gelenefaturalar/*') ? 'active' : '' }}
                                       {{ request()->is('cekodeme') || request()->is('cekodeme/*') ? 'active' : '' }} {{ request()->is('cektahsilat') || request()->is('cektahsilat/*') ? 'active' : '' }} {{ request()->is('cekodeme') || request()->is('cekodeme/*') ? 'active' : '' }}
                                                 {{ request()->is('raporlar') || request()->is('raporlar/*') ? 'active' : '' }} " data-bs-toggle="pill" data-bs-target="#pills-application" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-calculator"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="MARKA">
              <button class="nav-link  {{ request()->is('markatakip') || request()->is('markatakip/*') ? 'active' : '' }}
                                        {{ request()->is('markatakipfiltre') || request()->is('markatakipfiltre/*') ? 'active' : '' }}
                                        {{ request()->is('itiraztakipp') || request()->is('itiraztakipp/*') ? 'active' : '' }}
                                         {{ request()->is('itiraztakipfiltre') || request()->is('itiraztakipfiltre/*') ? 'active' : '' }}
                                         {{ request()->is('tescilnoksan') || request()->is('tescilnoksan/*') ? 'active' : '' }}
                                          {{ request()->is('tescilnoksanfiltre') || request()->is('tescilnoksanfiltre/*') ? 'active' : '' }}
              " data-bs-toggle="pill" data-bs-target="#pills-widgets" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-registered"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="ISO">
              <button class="nav-link {{ request()->is('isotakipp') || request()->is('isotakipp/*') ? 'show active' : '' }}
                                       {{ request()->is('isotakipfiltre') || request()->is('isotakipfiltre/*') ? 'active' : '' }}             " data-bs-toggle="pill" data-bs-target="#pills-ecommerce" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-certificate"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="DOMAİN">
                <button class="nav-link {{ request()->is('domaintakip') || request()->is('domaintakip/*') ? 'active' : '' }}
                " data-bs-toggle="pill" data-bs-target="#pills-forms" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-globe"></i></button>
              </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="İNSAN KAYNAKLARI">
              <button class="nav-link {{ request()->is('zimmet') || request()->is('zimmet/*') ? 'show active' : '' }} {{ request()->is('yillikizinhaklari') || request()->is('yillikizinhaklari/*') ? 'show active' : '' }}
                {{ request()->is('performansdegerleme') || request()->is('performansdegerleme/*') ? 'show active' : '' }} {{ request()->is('pyillikhedefler') || request()->is('pyillikhedefler/*') ? 'show active' : '' }}
                 {{ request()->is('isbasvurulari') || request()->is('isbasvurulari/*') ? 'show active' : '' }} {{ request()->is('yillikhedefkonulari') || request()->is('yillikhedefkonulari/*') ? 'show active' : '' }}
              " data-bs-toggle="pill" data-bs-target="#pills-components" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-user-tie"></i></button>
            </li>


            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="İDARİ İŞLER">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-tables" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-file-word"></i></button>
            </li>

            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="SOSYAL MEDYA">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-authentication" type="button"><i style="font-size:24px; display: flex; justify-content: center; align-items: center;" class="fa-solid fa-thumbs-up"></i></button>
            </li>
            {{--
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Icons">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-icons" type="button"><i class="bi bi-cloud-arrow-down-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Content">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-content" type="button"><i class="bi bi-cone-striped"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Charts">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-charts" type="button"><i class="bi bi-pie-chart-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Maps">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-maps" type="button"><i class="bi bi-pin-map-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pages">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-pages" type="button"><i class="bi bi-award-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Charts">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-charts" type="button"><i class="bi bi-pie-chart-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Maps">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-maps" type="button"><i class="bi bi-pin-map-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pages">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-pages" type="button"><i class="bi bi-award-fill"></i></button>
            </li> --}}
          </ul>
        </div>
        <div class="textmenu">
          <div class="brand-logo">
            <a href="{{route('anasayfa')}}"><img src="{{asset('logintemp/softwarelogo.png')}}" width="140" alt=""/></a>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade {{ request()->is('teklifler') || request()->is('onaylananteklifler') || request()->is('onaylanmayanteklifler') || request()->is('bekleyenteklifler') || request()->is('teklifler/*') ? 'show active' : '' }} {{ request()->is('muhasebemenu') || request()->is('muhasebemenu/*') ? 'show active' : '' }} {{ request()->is('makinemenu') || request()->is('makinemenu/*') ? 'show active' : '' }} {{ request()->is('ikmenu') || request()->is('ikmenu/*') ? 'show active' : '' }}
                {{ request()->is('cariler') || request()->is('cariler/*') ? 'show active' : '' }} {{ request()->is('toplusms') || request()->is('toplusms/*') ? 'show active' : '' }} {{ request()->is('toplumail') || request()->is('toplumail/*') ? 'show active' : '' }} {{ request()->is('anasayfa') || request()->is('anasayfa/*') ? 'show active' : '' }} {{ request()->is('entegrasyonmenu') || request()->is('entegrasyonmenu/*') ? 'show active' : '' }} {{ request()->is('register') || request()->is('register/*') ? 'show active' : '' }} {{ request()->is('idariislermenu') || request()->is('idariislermenu/*') ? 'show active' : '' }} {{ request()->is('tedarikciler') || request()->is('tedarikciler/*') ? 'show active' : '' }}
                 {{ request()->is('kontaklistesi') || request()->is('kontaklistesi/*') ? 'show active' : '' }} {{ request()->is('gorusmelistesi') || request()->is('gorusmelistesi/*') ? 'show active' : '' }} {{ request()->is('aktiflog') || request()->is('aktiflog/*') ? 'show active' : '' }} {{ request()->is('smsapi') || request()->is('smsapi/*') ? 'show active' : '' }} {{ request()->is('smtp') || request()->is('smtp/*') ? 'show active' : '' }} {{ request()->is('efaturaapi') || request()->is('efaturaapi/*') ? 'show active' : '' }}
                  {{ request()->is('satisfisineaktar') || request()->is('satisfisineaktar/*') ? 'show active' : '' }} {{ request()->is('resmievraklarr') || request()->is('resmievraklarr/*') ? 'show active' : '' }} " id="pills-dashboards">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-0 fw-bold text-center">CRM <span style=" font-size:12px; font-weight: 200; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">(Çukurova Yazılım)</span></h6>
                  </div>
                </div>
                <a href="{{ route('anamenu.index') }}" class="list-group-item {{ request()->is('anamenu') || request()->is('anamenu/*') ? 'active' : '' }} "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg> Ana Menü</a>


                <a href="{{ route('cariler.index') }}" class="list-group-item {{ request()->is('cariler') || request()->is('cariler/*') ? 'active' : '' }} {{ request()->is('tedarikciler') || request()->is('tedarikciler/*') ? 'active' : '' }}"><i class="fas fa-users"></i>Cariler</a>
                <a href="{{route('kontaklistesi.index')}}" class="list-group-item {{ request()->is('kontaklistesi') || request()->is('kontaklistesi/*') ? 'active' : '' }}"><i class="fas fa-address-book"></i>Kontak Listesi</a>
                <a href="{{route('gorusmelistesi.index')}}" class="list-group-item {{ request()->is('gorusmelistesi') || request()->is('gorusmelistesi/*') ? 'active' : '' }}"><i class="fas fa-comments"></i>Görüşme Listesi</a>
                <a href="{{route('teklifler.index')}}" class="list-group-item {{ request()->is('teklifler') || request()->is('onaylanmayanteklifler') || request()->is('bekleyenteklifler') || request()->is('onaylananteklifler') || request()->is('satisfisineaktar/*') || request()->is('teklifler/*') ? 'active' : '' }}"><i class="fas fa-file-invoice"></i>Teklifler</a>
                <a href="{{route('hizmetler.index')}}" class="list-group-item {{ request()->is('hizmetler') || request()->is('hizmetler/*') ? 'active' : '' }}"><i class="fa-solid fa-laptop"></i>Hizmetler</a>
                <a href="{{route('hizmetlerkategori.index')}}" class="list-group-item {{ request()->is('hizmetlerkategori') || request()->is('hizmetlerkategori/*') ? 'active' : '' }}"><i class="fa-solid fa-laptop-file"></i>Hizmetler Kategori</a>
                <a href="{{route('resmievraklarr.index')}}" class="list-group-item {{ request()->is('resmievraklarr') || request()->is('resmievraklarr/*') ? 'active' : '' }}"><i class="fa-solid fa-folder-open"></i>Resmi Evraklar</a>
                <a href="{{route('gorevatama.index')}}" class="list-group-item {{ request()->is('gorevatama') || request()->is('gorevatama/*') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked"></i>Görev Atama</a>


                <a href="{{route('pano.index')}}" class="list-group-item {{ request()->is('pano') || request()->is('pano/*') ? 'active' : '' }}"><i style="font-size: 14px" class="fa-solid fa-rectangle-list"></i>Pano</a>


              </div>
            </div>
            <div class="tab-pane fade {{ request()->is('satislar') || request()->is('satislar/*') ? 'show active' : '' }}
                                      {{ request()->is('cektahsilat') || request()->is('cektahsilat/*') ? 'show active' : '' }}
                                      {{ request()->is('cekodeme') || request()->is('cekodeme/*') ? 'show active' : '' }}
                                      {{ request()->is('alislar') || request()->is('alislar/*') ? 'show active' : '' }}
                                      {{ request()->is('tahsilat') || request()->is('tahsilat/*') ? 'show active' : '' }}
                                      {{ request()->is('odemeler') || request()->is('odemeler/*') ? 'show active' : '' }}
                                      {{ request()->is('bankalar') || request()->is('bankalar/*') ? 'show active' : '' }}
                                      {{ request()->is('virman') || request()->is('virman/*') ? 'show active' : '' }}
                                       {{ request()->is('odemeplanlari') || request()->is('odemeplanlari/*') ? 'show active' : '' }}
                                       {{ request()->is('tahsilatplan') || request()->is('tahsilatplan/*') ? 'show active' : '' }}
                                       {{ request()->is('gelenefaturalar') || request()->is('gelenefaturalar/*') ? 'show active' : '' }}
                                        {{ request()->is('gelenfaturayialisaktar') || request()->is('gelenfaturayialisaktar/*') ? 'show active' : '' }}
                                         {{ request()->is('gidenefaturalar') || request()->is('gidenefaturalar/*') ? 'show active' : '' }}
                                       {{ request()->is('raporlar') || request()->is('raporlar/*') ? 'show active' : '' }}" id="pills-application">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Ön Muhasebe</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="{{route('satislar.index')}}" class="list-group-item {{ request()->is('satislar') || request()->is('satislar/*') ? 'active' : '' }}"><i class="bi bi-envelope"></i>Satışlar</a>
                <a href="{{route('alislar.index')}}" class="list-group-item {{ request()->is('alislar') || request()->is('alislar/*') ? 'active' : '' }}"><i class="bi bi-chat-left-text"></i>Alışlar</a>
                <a href="{{route('tahsilat.index')}}" class="list-group-item {{ request()->is('tahsilat') || request()->is('tahsilat/*') ? 'active' : '' }}"><i class="bi bi-archive"></i>Tahsilat</a>
                <a href="{{route('odemeler.index')}}" class="list-group-item {{ request()->is('odemeler') || request()->is('odemeler/*') ? 'active' : '' }}"><i class="bi bi-check2-square"></i>Ödemeler</a>
                <a href="{{route('ceksenet.index')}}" class="list-group-item {{ request()->is('cekodeme') || request()->is('cekodeme/*') ? 'active' : '' }} {{ request()->is('cektahsilat') || request()->is('cektahsilat/*') ? 'active' : '' }} {{ request()->is('cekodeme') || request()->is('cekodeme/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Çek/Senet</a>
                <a href="{{route('gider.index')}}" class="list-group-item {{ request()->is('gider') || request()->is('gider/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Giderler</a>
                <a href="{{route('giderkategori.index')}}" class="list-group-item {{ request()->is('giderkategori') || request()->is('giderkategori/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Giderler Kategori</a>
                <a href="{{route('kasalar.index')}}" class="list-group-item {{ request()->is('kasalar') || request()->is('kasalar/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Kasalar</a>
                <a href="{{route('bankalar.index')}}" class="list-group-item {{ request()->is('bankalar') || request()->is('bankalar/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Bankalar</a>

                <a href="{{route('virman.index')}}" class="list-group-item {{ request()->is('virman') || request()->is('virman/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Virman</a>
                <a href="{{route('odemeplanlari.index')}}" class="list-group-item {{ request()->is('odemeplanlari') || request()->is('odemeplanlari/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Ödeme Plan</a>

                <a href="{{route('tahsilatplan.index')}}" class="list-group-item {{ request()->is('tahsilatplan') || request()->is('tahsilatplan/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Tahsilat Plan</a>
                <a href="{{route('gelenefaturalar.index')}}" class="list-group-item {{ request()->is('gelenefaturalar') || request()->is('gelenefaturalar/*') ? 'active' : '' }}  {{ request()->is('gelenfaturayialisaktar') || request()->is('gelenfaturayialisaktar/*') ? 'show active' : '' }}"><i class="bi bi-check2-square"></i>Gelen E-Faturalar</a>
                <a href="{{route('gidenefaturalar.index')}}" class="list-group-item {{ request()->is('gidenefaturalar') || request()->is('gidenefaturalar/*') ? 'active' : '' }}"><i class="bi bi-check2-square"></i>Giden E-Faturalar</a>

                <a href="{{route('raporlar.index')}}" class="list-group-item {{ request()->is('raporlar') || request()->is('raporlar/*') ? 'active' : '' }}"><i class="bi bi-receipt"></i>Raporlar</a>



              </div>
            </div>
            <div class="tab-pane fade {{ request()->is('markatakip') || request()->is('markatakip/*') ? 'show active' : '' }}
                                         {{ request()->is('markatakipfiltre') || request()->is('markatakipfiltre/*') ? 'show active' : '' }}
                                        {{ request()->is('itiraztakipp') || request()->is('itiraztakipp/*') ? 'show active' : '' }}
                                         {{ request()->is('itiraztakipfiltre') || request()->is('itiraztakipfiltre/*') ? 'show active' : '' }}
                                        {{ request()->is('tescilnoksan') || request()->is('tescilnoksan/*') ? 'show active' : '' }}
                                         {{ request()->is('tescilnoksanfiltre') || request()->is('tescilnoksanfiltre/*') ? 'show active' : '' }}
                                            " id="pills-widgets">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">MARKA</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="{{route('markatakip.index')}}" class="list-group-item {{ request()->is('markatakip') || request()->is('markatakip/*') ? 'active' : '' }} {{ request()->is('markatakipfiltre') || request()->is('markatakipfiltre/*') ? 'active' : '' }}"><i class="bi bi-box"></i>Marka Takip</a>
                <a href="{{route('itiraztakipp.index')}}" class="list-group-item {{ request()->is('itiraztakipp') || request()->is('itiraztakipp/*') ? 'active' : '' }} {{ request()->is('itiraztakipfiltre') || request()->is('itiraztakipfiltre/*') ? 'active' : '' }}"><i class="bi bi-bar-chart"></i>İtiraz Takip</a>
                <a href="{{route('tescilnoksan.index')}}" class="list-group-item {{ request()->is('tescilnoksan') || request()->is('tescilnoksan/*') ? 'active' : '' }} {{ request()->is('tescilnoksanfiltre') || request()->is('tescilnoksanfiltre/*') ? 'active' : '' }}"><i class="bi bi-bar-chart"></i>Tescil Noksan Takip</a>
                <a href="#" class="list-group-item"><i class="bi bi-bar-chart"></i>Marka Yenileme</a>
              </div>
            </div>
            <div class="tab-pane fade  {{ request()->is('isotakipfiltre') || request()->is('isotakipfiltre/*') ? 'show active' : '' }}
                                             {{ request()->is('isotakipp') || request()->is('isotakipp/*') ? 'show active' : '' }}" id="pills-ecommerce">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Kalite</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="#" class="list-group-item"><i class="bi bi-box-seam"></i>ISO Doküman Sistemi</a>
                <a href="{{route('isotakipp.index')}}"  class="list-group-item {{ request()->is('isotakipp') || request()->is('isotakipp/*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i>ISO Takip</a>
                {{-- <a href="ecommerce-products-categories.html" class="list-group-item"><i class="bi bi-card-text"></i>Products Categories</a>
                <a href="ecommerce-orders.html" class="list-group-item"><i class="bi bi-plus-square"></i>Orders</a>
                <a href="ecommerce-orders-detail.html" class="list-group-item"><i class="bi bi-handbag"></i>Orders Detail</a>
                <a href="ecommerce-add-new-product.html" class="list-group-item"><i class="bi bi-handbag"></i>Add New Product</a>
                <a href="ecommerce-add-new-product-2.html" class="list-group-item"><i class="bi bi-handbag"></i>Add New Product 2</a>
                <a href="ecommerce-transactions.html" class="list-group-item"><i class="bi bi-handbag"></i>Transactions</a> --}}
              </div>
            </div>
            <div class="tab-pane fade
                {{ request()->is('personell') || request()->is('personell/*') ? 'show active' : '' }} {{ request()->is('performansdegerleme') || request()->is('performansdegerleme/*') ? 'show active' : '' }}
                 {{ request()->is('zimmet') || request()->is('zimmet/*') ? 'show active' : '' }} {{ request()->is('pyillikhedefler') || request()->is('pyillikhedefler/*') ? 'show active' : '' }} {{ request()->is('yillikhedefkonulari') || request()->is('yillikhedefkonulari/*') ? 'show active' : '' }}
                  {{ request()->is('yillikizinhaklari') || request()->is('yillikizinhaklari/*') ? 'show active' : '' }} {{ request()->is('isbasvurulari') || request()->is('isbasvurulari/*') ? 'show active' : '' }}
            " id="pills-components">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">İnsan Kaynakları</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="{{route('personellistesi')}}" class="list-group-item"><i class="bi bi-person-badge"></i>Personel Listesi</a>

                <a href="{{route('personell.index')}}" class="list-group-item"><i class="bi bi-person-badge"></i>Personel Özlük Dosyası</a>
                <a href="{{route('izinler.index')}}" class="list-group-item"><i class="bi bi-arrows-collapse"></i>İzinler</a>
                <a href="{{route('yillikizin.index')}}" class="list-group-item"><i class="bi bi-table"></i>Yıllık İzinler</a>
                <a href="{{route('zimmet.index')}}" class="list-group-item {{ request()->is('zimmet') || request()->is('zimmet/*') ? 'active' : '' }}"><i class="bi bi-badge-8k"></i>Zimmet</a>
                <a href="{{route('isbasvurulari.index')}}" class="list-group-item {{ request()->is('isbasvurulari') || request()->is('isbasvurulari/*') ? 'active' : '' }}"><i class="bi bi-menu-button"></i>İş Başvuruları</a>
                <a href="{{route('degerlendirmekriterleri')}}" class="list-group-item {{ request()->is('kriterler') || request()->is('kriterler/*') ? 'active' : '' }}"><i class="bi bi-menu-button"></i>Değerleme Kriterleri</a>
                <a href="{{route('performansdegerleme.index')}}" class="list-group-item {{ request()->is('performansdegerleme') || request()->is('performansdegerleme/*') ? 'active' : '' }}"><i class="bi bi-menu-button"></i>Performans Değerleme</a>
                <a href="{{route('pyillikhedefler.index')}}" class="list-group-item {{ request()->is('pyillikhedefler') || request()->is('pyillikhedefler/*') ? 'active' : '' }} {{ request()->is('yillikhedefkonulari') || request()->is('yillikhedefkonulari/*') ? 'active' : '' }}"><i class="bi bi-badge-8k"></i>Personel Yıllık Hedefleri</a>

              </div>
            </div>
            <div class="tab-pane fade    {{ request()->is('domaintakip') || request()->is('domaintakip/*') ? 'show active' : '' }}
            " id="pills-forms">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Domain Takip</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="{{route('domaintakip.index')}}" class="list-group-item {{ request()->is('domaintakip') || request()->is('domaintakip/*') ? 'active' : '' }} "><i class="bi bi-bar-chart"></i>Domain Takip</a>
                {{-- <a href="form-input-group.html" class="list-group-item"><i class="bi bi-back"></i>Input Groups</a>
                <a href="form-layouts.html" class="list-group-item"><i class="bi bi-bookmark-check"></i>Form Layouts</a>
                <a href="form-validations.html" class="list-group-item"><i class="bi bi-broadcast-pin"></i>Form Validations</a>
                <a href="form-file-upload.html" class="list-group-item"><i class="bi bi-cloud-upload"></i>File Upload</a>
                <a href="form-date-time-pickes.html" class="list-group-item"><i class="bi bi-calendar-date"></i>Date Pickers</a>
                <a href="form-select2.html" class="list-group-item"><i class="bi bi-check2-circle"></i>Select2</a> --}}
              </div>
            </div>
            <div class="tab-pane fade {{ request()->is('kargotakip') || request()->is('kargotakip/*') ? 'show active' : '' }}
            " id="pills-tables">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">İdari İşler</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="{{route('kargotakip.index')}}" class="list-group-item"><i class="bi bi-menu-button"></i>Kargo Takip</a>

                {{-- <a href="table-basic-table.html" class="list-group-item"><i class="bi bi-table"></i>Basic Tables</a>
                <a href="table-advance-tables.html" class="list-group-item"><i class="bi bi-basket3"></i>Advance Tables</a>
                <a href="table-datatable.html" class="list-group-item"><i class="bi bi-graph-up"></i>Data Tables</a> --}}
              </div>
            </div>
            <div class="tab-pane fade" id="pills-authentication">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Sosyal Medya</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="authentication-signin-with-header-footer.html" class="list-group-item d-flex align-items-center"><i style="font-size: 14px" class="fa-brands fa-instagram"></i>İnstagram</a>
                <a href="authentication-signup.html" class="list-group-item"><i class="fa-brands fa-facebook"></i>Facebook</a>
                <a href="authentication-signup-with-header-footer.html" class="list-group-item d-flex align-items-center"><i class="fa-brands fa-square-x-twitter"></i>X</a>
                <a href="authentication-forgot-password.html" class="list-group-item"><i class="fa-brands fa-linkedin"></i>LinkedIn</a>
                <a href="{{route('sosyalmedya.index')}}" class="list-group-item"><i class="bi bi-easel"></i>Gönderi Oluştur</a>
                <a href="{{route('smhesaplarilist.index')}}" class="list-group-item"><i class="fa-solid fa-star"></i>Sosyal Medya Hesapları</a>
                {{-- <a href="authentication-reset-password.html" class="list-group-item"><i class="bi bi-gem"></i>Reset Password</a> --}}
              </div>
            </div>
            <div class="tab-pane fade" id="pills-icons">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Icons</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="icons-line-icons.html" class="list-group-item"><i class="bi bi-brightness-low"></i>Line Icons</a>
                <a href="icons-boxicons.html" class="list-group-item"><i class="bi bi-chat"></i>Boxicons</a>
                <a href="icons-feather-icons.html" class="list-group-item"><i class="bi bi-droplet"></i>Feather Icons</a>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-charts">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Charts</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="charts-chartjs.html" class="list-group-item"><i class="bi bi-bar-chart"></i>Chart JS</a>
                <a href="charts-apex-chart.html" class="list-group-item"><i class="bi bi-pie-chart"></i>Apex Chart</a>
                <a href="charts-highcharts.html" class="list-group-item"><i class="bi bi-graph-up"></i>Highcharts</a>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-maps">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Maps</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="map-google-maps.html" class="list-group-item"><i class="bi bi-geo-alt"></i>Google Map</a>
                <a href="map-vector-maps.html" class="list-group-item"><i class="bi bi-geo"></i>Vector Map</a>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-pages">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Pages</h5>
                  </div>
                  <small class="mb-0">Çukurova Yazılım</small>
                </div>
                <a href="pages-user-profile.html" class="list-group-item"><i class="bi bi-alarm"></i>User Profile</a>
                <a href="pages-timeline.html" class="list-group-item"><i class="bi bi-archive"></i>Timeline</a>
                <a href="pages-faq.html" class="list-group-item"><i class="bi bi-question-diamond"></i>FAQ</a>
                <a href="pages-pricing-tables.html" class="list-group-item"><i class="bi bi-tags"></i>Pricing</a>
                <a href="pages-errors-404-error.html" class="list-group-item"><i class="bi bi-bug"></i>404 Error</a>
                <a href="pages-errors-500-error.html" class="list-group-item"><i class="bi bi-diagram-2"></i>500 Error</a>
                <a href="pages-errors-coming-soon.html" class="list-group-item"><i class="bi bi-egg-fried"></i>Coming Soon</a>
                <a href="pages-blank-page.html" class="list-group-item"><i class="bi bi-flag"></i>Blank Page</a>
              </div>
            </div>
          </div>
        </div>
     </aside>
     <!--start sidebar -->
<!--start content-->
<main class="page-content">
