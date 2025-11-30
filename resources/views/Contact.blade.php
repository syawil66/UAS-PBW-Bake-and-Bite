@extends('layouts.app')

@section('content')
<style>
    .contact-section {
    background-color: #f3f1f4;
    text-align: center;
    padding-top: 80px;
    padding-bottom: 80px;
  }

  .contact-section h1 {
    font-family: 'Merriweather', serif;
    font-size: 42px;
    letter-spacing: 2px;
    color: #262626;
    margin-bottom: 25px;
  }

  .contact-section p {
    font-size: 18px;
    color: #5c5753;
    margin: 8px 0;
  }

  .social-icons {
    margin-top: 40px;
  }

  .social-icons a {
    color: #000;
    font-size: 32px;
    margin: 0 18px;
    transition: transform 0.2s ease;
  }

  .social-icons a:hover {
    transform: scale(1.1);
    color: #4b4846;
  }
</style>
<section class="contact-section">
        <h1>CONTACT US</h1>
        <p>Banda Aceh</p>
        <p>+62 811 689 9931</p>

        <div class="social-icons">
            <a href="https://instagram.com/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
            <a href="https://facebook.com/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        </div>
    </section>
</div>
@endsection
