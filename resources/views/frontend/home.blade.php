@extends('layout.frontend')

@section('content')
    

    <div class="content content-height">
      <div class="banner">
        <div class="banner-header">
          <img width="300px" src="{{asset('asset_ku/img/grid2.png')}}" alt="" />
          <div class="banner-content">
            <h1 style="text-transform: uppercase">{{$profile_sekolah->nama_sekolah}}</h1>
            @foreach ($informasi_pendaftaran as $pendaftaran)
                
         
            <h3>{{ $pendaftaran->judul_informasi }}</h3>
           <h5>{{strip_tags($pendaftaran->isi_informasi)}}</h5>
            @endforeach
          </div>
        </div>
        <div class="owl-carousel owl-theme">
          @foreach ($slide_gambar as $slide)
          <div class="item">
            <img style="height:220px;" src="{{url('tk_taruna_images').'/'.$slide->image}}" alt="" />
          </div>
          @endforeach
        </div>
      </div>
      <div class="information">
        <marquee>
          <p>
            Selamat Datang di Website
            <span style="font-weight: 600">TK TARUNA BAHARI</span>
          </p>
        </marquee>
        <div class="header-information">Information</div>
      </div>

      <div class="content-opening">
        <div class="content-foto">
          <div class="kotak-foto"></div>
          <img src="{{asset('asset_ku/img/foto_content2.png')}}" alt="" />
        </div>
        <div class="content-sambutan">
          <h1 class="text-center">TK TARUNA BAHARI</h1>
          <h3>
            “Membantu anak didik mengembangkan berbagai potensi yang dimiliki
            untuk siap memasuki pendidikan dasar melalui kegiatan bermain sambil
            belajar”
          </h3>
          <p>
            TK Taruna Bahari senantiasa berupaya mengembangkan segenap potensi
            yang dimiliki anak melalui kegiatan bermain. Bagi anak usia dini
            bermain adalah belajar. Bermain adalah suatu kegiatan berulang-ulang
            dan menimbulkan kesenangan/kepuasan bagi diri anak. Bermain sebagai
            sarana sosialisasi diharapkan dapat memberi kesempatan anak untuk
            bereksplorasi, menemukan, mengekspresikan perasaan, berkreasi dan
            belajar secara menyenangkan.
          </p>
        </div>
      </div>

      <div class="wrapper-content">
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
        <div class="content-program">
          <div class="card">
            <i class="fa-sharp fa-solid fa-star-and-crescent"></i>
            <h3>Nilai Agama dan Moral</h3>
            <p>
              “Mewujudkan suasana belajar untuk berkembangnya perilaku bersumber
              dari nilai agama, moral dan kehidupan bermasyarakat. Diberikan
              melalui pembiasaan sehari-hari baik di sekolah maupun di luar
              sekolah”
            </p>
          </div>
          <div class="card">
            <i class="fa-sharp fa-solid fa-brain"></i>
            <h3>Motorik dan Kognitif</h3>
            <p>
              “Mewujudkan suasana untuk berkembangnya kematangan kinestetik,
              kematangan proses berfikir dan berlogika”
            </p>
          </div>
          <div class="card">
            <i class="fa-sharp fa-solid fa-palette"></i>
            <h3>Bahasa dan Seni</h3>
            <p>
              Mewujudkan suasana untuk berkembangnya kematangan bahasa dan seni
              melalui kemampuan berkomunikasi melalui berbicara, mendengarkan,
              membaca dan mengekplorasi seni”
            </p>
          </div>
        </div>
      </div>
      <div class="content-video-wrapper dot">
        <div class="content-video-title">
          <h1>Foto & Video</h1>
        </div>
        <div class="content-video-video">
          <div class="item-videos" data-merge="1">
            <iframe
              width="250"
              height="250"
              src="https://www.youtube.com/embed/lLYi4LsDsTw"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          </div>
          <div class="item-videos" data-merge="2">
            <iframe
              width="250"
              height="250"
              src="https://www.youtube.com/embed/2mt1vYwRtWQ"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          </div>
          <div class="item-videos" data-merge="3">
            <iframe
              width="250"
              height="250"
              src="https://www.youtube.com/embed/_Zkbsk1P74o"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          </div>
        </div>
        <div class="content-foto-foto">
          <div class="item-foto">
            <img src="{{asset('asset_ku/img/siswa1.jpg')}}" alt="" />
          </div>
          <div class="item-foto">
            <img src="{{asset('asset_ku/img/siswa2.jpg')}}" alt="" />
          </div>
          <div class="item-foto">
            <img src="{{asset('asset_ku/img/siswa3.jpg')}}" alt="" />
          </div>
        </div>
        <div class="content-video-footer">
          <a href="galeri.html">Selengkapnya</a>
        </div>
      </div>

@endsection