<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APV IAC Sabilulungan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --aspal:#1B1C1E; --aspal-2:#26282B; --krom:#D7DADD; --krom-dim:#9CA1A6;
    --sinyal:#E8590C; --hijau:#33513A; --krem:#F1E9D8; --dashboard-orange:#F0A202;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{background:var(--aspal);color:var(--krem);font-family:'Inter',sans-serif;overflow-x:hidden;}
  h1,h2,h3,.plat{font-family:'Rajdhani',sans-serif;font-weight:700;letter-spacing:.02em;}
  a{color:inherit;text-decoration:none;} img{max-width:100%;display:block;}

  nav{position:fixed;top:0;left:0;right:0;z-index:50;display:flex;align-items:center;justify-content:space-between;
    padding:18px 6vw;background:linear-gradient(to bottom, rgba(27,28,30,.95), rgba(27,28,30,0));}
  .brand{display:flex;align-items:center;gap:10px;font-family:'Rajdhani',sans-serif;font-weight:700;font-size:1.1rem;letter-spacing:.05em;}
  .brand-mark{width:34px;height:24px;border:2px solid var(--sinyal);border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:.6rem;color:var(--sinyal);}
  nav .links{display:flex;gap:6px;font-size:.85rem;color:var(--krom-dim);align-items:center;}
  nav .links a{padding:8px 14px;border-radius:6px;transition:background .2s ease, color .2s ease;}
  nav .links a:hover{background:var(--dashboard-orange);color:#20242B;}
  .burger{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:6px;}
  .burger span{width:24px;height:2px;background:var(--krem);display:block;}
  @media(max-width:720px){
    nav .links{position:fixed;top:0;right:-100%;height:100svh;width:74%;background:var(--aspal-2);
      flex-direction:column;justify-content:center;align-items:flex-start;padding:0 40px;gap:26px;
      transition:right .35s ease;font-size:1.1rem;}
    nav .links.open{right:0;}
    .burger{display:flex;}
  }

  .hero{position:relative;min-height:100svh;display:flex;flex-direction:column;justify-content:flex-end;padding:0 6vw 8vh;
    background:radial-gradient(ellipse at 70% 20%, rgba(232,89,12,.16), transparent 55%), linear-gradient(180deg, var(--aspal) 0%, #151618 100%);}
  .route-svg{position:absolute;inset:0;width:100%;height:100%;opacity:.5;}
  .eyebrow{font-family:'Rajdhani',sans-serif;font-size:.85rem;letter-spacing:.35em;text-transform:uppercase;color:var(--sinyal);margin-bottom:18px;}
  .hero h1{font-size:clamp(2.6rem,8vw,6.4rem);line-height:.95;text-transform:uppercase;color:var(--krem);}
  .hero h1 span{color:var(--sinyal);}
  .hero p.lede{max-width:520px;margin-top:22px;color:var(--krom-dim);font-size:1.05rem;line-height:1.6;}
  .hero-cta{display:flex;gap:14px;margin-top:34px;flex-wrap:wrap;}
  .btn{padding:14px 28px;border-radius:2px;font-weight:600;font-size:.9rem;letter-spacing:.03em;
    transition:transform .2s ease, background .2s ease;display:inline-flex;align-items:center;gap:8px;border:none;cursor:pointer;}
  .btn-solid{background:var(--sinyal);color:#1B1C1E;}
  .btn-solid:hover{transform:translateY(-2px);background:#ff6b1f;}
  .btn-ghost{border:1px solid var(--krom-dim);color:var(--krem);}
  .btn-ghost:hover{border-color:var(--krem);transform:translateY(-2px);}

  .plat-strip{position:absolute;bottom:0;left:0;right:0;display:flex;border-top:1px solid #333;background:var(--aspal-2);}
  .plat-strip .cell{flex:1;padding:14px 6vw;text-align:center;font-family:'Rajdhani',sans-serif;font-size:.75rem;
    letter-spacing:.15em;color:var(--krom-dim);text-transform:uppercase;border-right:1px solid #333;}
  .plat-strip .cell:last-child{border-right:none;}
  .plat-strip .cell b{display:block;font-size:1.4rem;color:var(--krem);margin-top:2px;letter-spacing:.02em;}
  @media(max-width:720px){.plat-strip{flex-wrap:wrap;position:static;margin-top:40px;}.plat-strip .cell{min-width:50%;border-bottom:1px solid #333;}}

  section{padding:110px 6vw;position:relative;scroll-margin-top:90px;}
  .section-head{max-width:640px;margin-bottom:64px;}
  .section-head .eyebrow{margin-bottom:14px;}
  .section-head h2{font-size:clamp(2rem,4vw,3.2rem);text-transform:uppercase;color:var(--krem);}
  .section-head p{color:var(--krom-dim);margin-top:14px;line-height:1.6;}

  .rute{position:relative;}
  .rute-line{position:absolute;left:23px;top:10px;bottom:10px;width:2px;
    background:repeating-linear-gradient(to bottom, var(--sinyal) 0 10px, transparent 10px 20px);}
  @media(max-width:720px){.rute-line{left:19px;}}
  .waypoint{position:relative;padding-left:70px;padding-bottom:56px;}
  .waypoint:last-child{padding-bottom:0;}
  .waypoint .pin{position:absolute;left:0;top:0;width:48px;height:48px;border-radius:50%;background:var(--aspal-2);
    border:2px solid var(--sinyal);color:var(--sinyal);display:flex;align-items:center;justify-content:center;font-family:'Rajdhani';font-weight:700;}
  .waypoint h3{font-size:1.4rem;color:var(--krem);text-transform:uppercase;margin-bottom:8px;}
  .waypoint p{color:var(--krom-dim);line-height:1.65;max-width:560px;}

  .grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:#333;border:1px solid #333;}
  @media(max-width:860px){.grid3{grid-template-columns:1fr;}}
  .grid3 .card{background:var(--aspal);padding:36px 30px;}
  .grid3 .card .num{font-family:'Rajdhani';color:var(--sinyal);font-size:.85rem;letter-spacing:.2em;}
  .grid3 .card h3{margin:14px 0 12px;font-size:1.3rem;text-transform:uppercase;color:var(--krem);}
  .grid3 .card p{color:var(--krom-dim);font-size:.92rem;line-height:1.6;}

  .galeri-strip{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;}
  .galeri-strip .frame{aspect-ratio:4/3;border:1px solid #3a3a3a;position:relative;overflow:hidden;background:#17181a;}
  .galeri-strip .frame img{width:100%;height:100%;object-fit:cover;}
  .galeri-strip .frame .cap{position:absolute;bottom:0;left:0;right:0;padding:20px 12px 10px;
    font-family:'Rajdhani';font-size:.75rem;letter-spacing:.1em;color:var(--krem);text-transform:uppercase;
    background:linear-gradient(to top, rgba(0,0,0,.75), transparent);}
  .galeri-strip .frame.kosong{display:flex;align-items:center;justify-content:center;color:var(--krom-dim);
    font-size:.8rem;background:linear-gradient(135deg,#232427,#17181a);}

  .sponsor-wrap{position:relative;overflow:hidden;
    mask-image:linear-gradient(to right, transparent, black 8%, black 92%, transparent);
    -webkit-mask-image:linear-gradient(to right, transparent, black 8%, black 92%, transparent);}
  .sponsor-track{display:flex;gap:64px;width:max-content;animation:sponsor-scroll 28s linear infinite;}
  .sponsor-wrap:hover .sponsor-track{animation-play-state:paused;}
  .sponsor-item{display:flex;align-items:center;justify-content:center;height:70px;min-width:140px;}
  .sponsor-item img{max-height:56px;max-width:140px;object-fit:contain;filter:grayscale(1) brightness(1.6);opacity:.75;transition:filter .25s ease, opacity .25s ease;}
  .sponsor-item:hover img{filter:none;opacity:1;}
  .sponsor-kosong{color:var(--krom-dim);font-size:.85rem;}
  @keyframes sponsor-scroll{
    from{transform:translateX(0);}
    to{transform:translateX(-50%);}
  }

  .join{background:var(--hijau);border:1px solid #46654e;padding:64px 6vw;display:flex;justify-content:space-between;
    align-items:center;gap:40px;flex-wrap:wrap;}
  .join h2{font-size:clamp(1.8rem,4vw,2.8rem);text-transform:uppercase;max-width:520px;}
  .join .syarat{list-style:none;color:#cfe0d3;font-size:.9rem;line-height:2;}
  .join .syarat li::before{content:'— ';color:var(--sinyal);}

  footer{padding:50px 6vw;border-top:1px solid #333;display:flex;justify-content:space-between;flex-wrap:wrap;gap:24px;color:var(--krom-dim);font-size:.85rem;}
  footer .kontak a{display:block;margin-top:6px;}
  footer .kontak a:hover{color:var(--sinyal);}
  footer .admin-link{opacity:.5;font-size:.75rem;}
  footer .admin-link:hover{opacity:1;color:var(--sinyal);}

  @media (prefers-reduced-motion: no-preference){
    .fade-up{opacity:0;transform:translateY(24px);transition:opacity .7s ease, transform .7s ease;}
    .fade-up.in{opacity:1;transform:translateY(0);}
  }
  :focus-visible{outline:2px solid var(--sinyal);outline-offset:3px;}
</style>
</head>
<body>

<nav>
  <div class="brand"><span class="brand-mark">D</span> APV IAC SABILULUNGAN</div>
  <div class="links" id="navLinks">
    <a href="#rute">Perjalanan Kami</a>
    <a href="#kegiatan">Kegiatan</a>
    <a href="#galeri">Galeri</a>
    <a href="#sponsor">Sponsor</a>
    <a href="#gabung">Gabung</a>
  </div>
  <button class="burger" id="burgerBtn" aria-label="Buka menu"><span></span><span></span><span></span></button>
</nav>

<header class="hero">
  <svg class="route-svg" viewBox="0 0 1000 600" preserveAspectRatio="none">
    <path d="M -50 500 C 200 500, 250 300, 500 320 S 800 150, 1050 180" fill="none" stroke="#E8590C" stroke-width="2" stroke-dasharray="6 10" opacity="0.5"/>
  </svg>
  <div class="eyebrow">Sabilulungan — Silih Asih, Silih Asah, Silih Asuh</div>
  <h1>{{ $settings['hero_title_1'] ?? 'Satu Jalur,' }}<br>{{ $settings['hero_title_2'] ?? 'Sejuta' }} <span>Kilometer</span><br>{{ $settings['hero_title_3'] ?? 'Kebersamaan.' }}</h1>
  <p class="lede">{{ $settings['hero_lede'] ?? '' }}</p>
  <div class="hero-cta">
    <a href="#gabung" class="btn btn-solid">Gabung Komunitas →</a>
    <a href="#rute" class="btn btn-ghost">Lihat Perjalanan Kami</a>
  </div>

  <div class="plat-strip">
    <div class="cell">Berdiri sejak <b>{{ $settings['tahun_berdiri'] ?? '—' }}</b></div>
    <div class="cell">Anggota aktif <b>{{ $jumlahAnggota }}+</b></div>
    <div class="cell">Kota &amp; kabupaten <b>{{ $jumlahWilayah }}</b></div>
    <div class="cell">Kopdar rutin <b>Tiap Bulan</b></div>
  </div>
</header>

<section id="rute" class="rute">
  <div class="section-head fade-up">
    <div class="eyebrow">Perjalanan Kami</div>
    <h2>Rute Sabilulungan</h2>
    <p>Dari obrolan warung kopi hingga konvoi lintas provinsi — begini urutan perjalanan komunitas ini terbentuk.</p>
  </div>
  <div class="rute-line"></div>
  <div class="waypoint fade-up">
    <div class="pin">01</div>
    <h3>Kopdar Perdana</h3>
    <p>Sekumpulan pemilik APV di Bandung Raya bertemu, berbagi cerita seputar perawatan dan modifikasi kendaraan.</p>
  </div>
  <div class="waypoint fade-up">
    <div class="pin">02</div>
    <h3>Deklarasi Sabilulungan</h3>
    <p>Nama "Sabilulungan" dipilih sebagai semangat gotong royong khas Sunda yang menjadi nilai utama komunitas.</p>
  </div>
  <div class="waypoint fade-up">
    <div class="pin">03</div>
    <h3>Ekspansi Regional</h3>
    <p>Chapter baru tumbuh di berbagai kota, memperluas jaringan silaturahmi anggota.</p>
  </div>
  <div class="waypoint fade-up">
    <div class="pin">04</div>
    <h3>Konvoi &amp; Bakti Sosial</h3>
    <p>Rutin menggelar konvoi wisata dan aksi sosial ke daerah terdampak bencana di Jawa Barat.</p>
  </div>
</section>

<section id="kegiatan">
  <div class="section-head fade-up">
    <div class="eyebrow">Kegiatan</div>
    <h2>Yang Kami Kerjakan Bersama</h2>
  </div>
  <div class="grid3 fade-up">
    @forelse($activities as $activity)
      <div class="card">
        <div class="num">{{ $activity->label }}</div>
        <h3>{{ $activity->judul }}</h3>
        <p>{{ $activity->deskripsi }}</p>
      </div>
    @empty
      <div class="card"><p>Belum ada kegiatan ditambahkan.</p></div>
    @endforelse
  </div>
</section>

<section id="galeri">
  <div class="section-head fade-up">
    <div class="eyebrow">Galeri</div>
    <h2>Jejak Konvoi</h2>
  </div>
  <div class="galeri-strip fade-up">
    @forelse($photos as $photo)
      <div class="frame">
        <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->caption }}" loading="lazy">
        <span class="cap">{{ $photo->caption }}</span>
      </div>
    @empty
      <div class="frame kosong">Belum ada foto galeri</div>
    @endforelse
  </div>
</section>

<section id="sponsor">
  <div class="section-head fade-up">
    <div class="eyebrow">Didukung Oleh</div>
    <h2>Sponsor &amp; Mitra</h2>
  </div>
  @if($sponsors->count())
    <div class="sponsor-wrap fade-up">
      <div class="sponsor-track">
        @foreach($sponsors->concat($sponsors) as $sponsor)
          <div class="sponsor-item">
            @if($sponsor->url)
              <a href="{{ $sponsor->url }}" target="_blank" rel="noopener">
                <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->nama }}" loading="lazy">
              </a>
            @else
              <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->nama }}" loading="lazy">
            @endif
          </div>
        @endforeach
      </div>
    </div>
  @else
    <p class="sponsor-kosong fade-up">Belum ada sponsor ditambahkan.</p>
  @endif
</section>

<section id="gabung">
  <div class="join fade-up">
    <h2>Siap Jadi Bagian dari Sabilulungan?</h2>
    <ul class="syarat">
      <li>Pemilik atau pengguna Suzuki APV</li>
      <li>Bersedia mengikuti kopdar minimal 1x</li>
      <li>Mengisi formulir pendaftaran anggota</li>
      <li>Menjunjung nilai silih asih, silih asah, silih asuh</li>
    </ul>
    @if(!empty($settings['wa_url']) && $settings['wa_url'] !== '#')
      <a href="{{ $settings['wa_url'] }}" target="_blank" rel="noopener" class="btn btn-solid">Daftar via WhatsApp →</a>
    @else
      <a href="#" class="btn btn-solid">Daftar Sekarang →</a>
    @endif
  </div>
</section>

<footer>
  <div>
    <div class="brand"><span class="brand-mark">D</span> APV IAC SABILULUNGAN</div>
    <p style="margin-top:10px;max-width:320px;">Komunitas pemilik &amp; pecinta Suzuki APV se-Jawa Barat.</p>
    <a href="{{ route('login') }}" class="admin-link">Login Admin</a>
  </div>
  <div class="kontak">
    <b style="color:var(--krem);">Kontak</b>
    @if(!empty($settings['ig_url']) && $settings['ig_url'] !== '#')
      <a href="{{ $settings['ig_url'] }}" target="_blank" rel="noopener">Instagram</a>
    @endif
    @if(!empty($settings['wa_url']) && $settings['wa_url'] !== '#')
      <a href="{{ $settings['wa_url'] }}" target="_blank" rel="noopener">WhatsApp Grup Pendaftaran</a>
    @endif
    @if(!empty($settings['email']))
      <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
    @endif
  </div>
</footer>

<script>
  const items = document.querySelectorAll('.fade-up');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target);} });
  },{threshold:.15});
  items.forEach(i=>io.observe(i));

  const burger = document.getElementById('burgerBtn');
  const navLinks = document.getElementById('navLinks');
  burger.addEventListener('click', () => navLinks.classList.toggle('open'));
  navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));
</script>

</body>
</html>
