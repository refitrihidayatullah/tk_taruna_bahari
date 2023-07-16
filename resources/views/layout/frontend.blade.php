<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="{{ asset('asset_ku/js/owlcarousel/dist/assets/owl.carousel.min.css')}}"
    />
    <link
      rel="stylesheet"
      href="{{asset('asset_ku/js/owlcarousel/dist//assets/owl.theme.default.min.css')}}"
    />
    <link rel="stylesheet" href="{{ asset('asset_ku/css/css.css') }}" />
    <title>TK Taruna Bahari</title>
  </head>
  <body>
    <header>
      @php
      $profile_sekolah = DB::table('tb_profile_sekolah')->first();
      $sosmed_sekolah = DB::table('tb_sosmed')->get();
  @endphp
      <div class="header-email">
        <ul>
          <li><i class="fa-sharp fa-solid fa-envelope"></i></li>
          <li>{{ $profile_sekolah->email_sekolah }}</li>
        </ul>
      </div>
      <div class="header-alamat">
      {{$profile_sekolah->alamat}}
      </div>
    </header>
    <nav class="nav-box type3" id="nav-scroll">
      <div class="logo">
        <ul>
          <li>
            <img src="{{asset('asset_ku/img/logo.png')}}" alt="logo" />
          </li>
          <li>
            <h3 style="text-transform: uppercase" class="logo-name text-md text-sm">{{ $profile_sekolah->nama_sekolah }}</h3>
          </li>
        </ul>
      </div>
      <ul class="menu">
        <li>
          <a
            class="link-offset-2 link-underline link-underline-opacity-0"
            href="{{url('/')}}"
            >Home</a
          >
        </li>
        <li>
          <a
            class="link-offset-2 link-underline link-underline-opacity-0"
            href="{{url('/profile')}}"
            >Profil</a
          >
        </li>
        <li>
          <a
            class="link-offset-2 link-underline link-underline-opacity-0"
            href="{{url('/galeri')}}"
            >Galeri</a
          >
        </li>
        <li>
          <a
            class="link-offset-2 link-underline link-underline-opacity-0"
            href="{{url('/dataguru')}}"
            >Data Guru</a
          >
        </li>
        <li>
          <a
            class="link-offset-2 link-underline link-underline-opacity-0"
            href="#ppdb"
            ><span>PPDB</span></a
          >
        </li>
      </ul>
      <div class="hamburger">
        <input type="checkbox" />
        <i class="fa-sharp fa-solid fa-bars"></i>
      </div>
    </nav>

    @yield('content');

      <footer>
        <div style="overflow: hidden">
          <svg
            preserveAspectRatio="none"
            viewBox="0 0 1200 120"
            xmlns="http://www.w3.org/2000/svg"
            style="fill: #ffffff; width: 100%; height: 60px"
          >
            <path
              d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
              opacity=".25"
            />
            <path
              d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
              opacity=".5"
            />
            <path
              d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z"
            />
          </svg>
        </div>

        <div class="content-header-footer">
          <div class="header-footer-sosmed">
            <ul>
              @foreach ($sosmed_sekolah as $sosmed)
                  @if($sosmed->nama_sosmed == "facebook")
                    <li>
                      <a target="_blank" href="{{$sosmed->link_sosmed}}"
                        ><i class="fa-brands fa-facebook"></i
                      ></a>
                    </li>
                  @elseif($sosmed->nama_sosmed == "instagram")
                  <li>
                    <a target="_blank" href="{{$sosmed->link_sosmed}}"
                      ><i class="fa-brands fa-instagram"></i
                    ></a>
                  </li>
                  @else
                  <li>
                    <a target="_blank" href="{{$sosmed->link_sosmed}}">
                      <i class="fa-brands fa-youtube"></i>
                    </a>
                  </li>
                  @endif
              @endforeach 
            </ul>
          </div>
          <div class="header-footer-hubungi">
            <h3>Hubungi Kami</h3>
            <ul>
              <li><h5>Alamat :</h5></li>
              <li>
                <p>
                  Perum Graha Permata Indah Blok AF-22, Krajan, Kranjingan, Kec.
                  Sumbersari, Kabupaten Jember, Jawa Timur 68126
                </p>
              </li>
              <li><h5>Email :</h5></li>
              <li><p>tktarunabahari@gmail.com</p></li>
              <li><h5>Whatsapp :</h5></li>
              <li><p>+62989897423</p></li>
            </ul>
          </div>
          <div class="header-footer-lokasi">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.054699462177!2d113.71945567612205!3d-8.197244782217712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69702adcf058f%3A0x69393c67c824adf7!2sTK%20Taruna%20Bahari%201!5e0!3m2!1sen!2sid!4v1687749478781!5m2!1sen!2sid"
              width="300"
              height="300"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>

        <div class="content-footer-footers">
          <h6>&copy 2023 Tk Taruna Bahari. All Right Reserved</h6>
        </div>
      </footer>
    </div>

    <script src="js/js.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
      integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="{{asset('asset_ku/js/owlcarousel/dist/owl.carousel.min.js')}}"></script>
    <script src="{{asset('asset_ku/js/banner.js')}}"></script>
  </body>
</html>
