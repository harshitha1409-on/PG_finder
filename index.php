<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VizagPG Finder | PG Life</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body class="pglife-body">
<nav class="site-nav">
  <div class="container nav-inner">
    <a class="brand-logo" href="index.php"><span class="brand-mark">⌂</span><span class="brand-pg">PG</span><span class="brand-life">Life</span></a>
    <div class="nav-right">
      <span id="userGreeting" class="user-greeting"></span>
      <a class="nav-link-btn" href="profile.php">👤 Profile</a>
      <span class="nav-divider"></span>
      <button class="nav-link-btn" data-bs-toggle="modal" data-bs-target="#authModal">↪ <span id="authNavText">Login</span></button>
    </div>
  </div>
</nav>

<section class="hero-home">
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <h1>Happiness per Square Foot</h1>
    <form id="homeSearch" class="home-search">
      <input id="homeCity" list="citySuggestions" type="text" placeholder="Enter your city to search for PGs" autocomplete="off">
      <datalist id="citySuggestions">
        <option value="Vizag"></option><option value="Delhi"></option><option value="Mumbai"></option><option value="Bengaluru"></option><option value="Hyderabad"></option>
      </datalist>
      <button type="submit" aria-label="Search">⌕</button>
    </form>
  </div>
</section>

<section class="major-cities section-white">
  <div class="container">
    <h2>Major Cities</h2>
    <div class="city-grid">
      <a class="city-card" href="listings.php?city=Delhi"><span class="city-icon"><img src="assets/cities/delhi.svg" alt="Red Fort"></span><span>DELHI</span></a>
      <a class="city-card" href="listings.php?city=Mumbai"><span class="city-icon"><img src="assets/cities/mumbai.svg" alt="Gateway of India"></span><span>MUMBAI</span></a>
      <a class="city-card" href="listings.php?city=Bengaluru"><span class="city-icon"><img src="assets/cities/bengaluru.svg" alt="Bengaluru IT buildings"></span><span>BENGALURU</span></a>
      <a class="city-card" href="listings.php?city=Hyderabad"><span class="city-icon"><img src="assets/cities/hyderabad.svg" alt="Charminar"></span><span>HYDERABAD</span></a>
      <a class="city-card city-active" href="listings.php?city=Visakhapatnam"><span class="city-icon"><img src="assets/cities/vizag.svg" alt="Vizag port"></span><span>VIZAG</span></a>
    </div>
  </div>
</section>

<section class="home-feature section-soft">
  <div class="container feature-grid">
    <div><span class="eyebrow">VIZAG PG FINDER</span><h2>Comfortable stays for students and working professionals.</h2><p>Explore PGs around MVP Colony, Siripuram, Gajuwaka, Madhurawada, Rushikonda, Dwaraka Nagar and NAD Junction.</p><a href="listings.php?city=Visakhapatnam" class="primary-btn">Explore PGs in Vizag</a></div>
    <div class="feature-points"><div>✓ Easy city & budget search</div><div>✓ Boys, Girls & Co-living options</div><div>✓ Save properties to your shortlist</div><div>✓ Detailed amenities and ratings</div></div>
  </div>
</section>

<footer class="site-footer">
  <div class="container footer-cities">
    <a href="listings.php?city=Delhi">PG in Delhi</a><a href="listings.php?city=Mumbai">PG in Mumbai</a><a href="listings.php?city=Bengaluru">PG in Bengaluru</a><a href="listings.php?city=Hyderabad">PG in Hyderabad</a><a href="listings.php?city=Visakhapatnam">PG in Vizag</a>
  </div>
  <div class="container footer-copy">© 2026 VizagPG Finder · Student accommodation project</div>
</footer>

<div class="modal fade" id="authModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content auth-card">
 <div class="modal-header"><h5 class="modal-title">Login / Sign up</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
 <div class="modal-body">
  <ul class="nav nav-tabs mb-3"><li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#loginTab">Login</button></li><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#signupTab">Sign up</button></li></ul>
  <div class="tab-content">
   <div class="tab-pane fade show active" id="loginTab"><form id="loginForm"><input class="form-control mb-2" name="email" type="email" placeholder="Email" required><input class="form-control mb-3" name="password" type="password" placeholder="Password" required><button class="primary-btn w-100">Login</button></form></div>
   <div class="tab-pane fade" id="signupTab"><form id="signupForm"><input class="form-control mb-2" name="name" placeholder="Full name" required><input class="form-control mb-2" name="email" type="email" placeholder="Email" required><input class="form-control mb-2" name="phone" placeholder="Phone"><input class="form-control mb-3" name="password" type="password" placeholder="Password (6+ characters)" required><button class="primary-btn w-100">Create account</button></form></div>
  </div><div id="authMessage" class="small mt-3"></div>
 </div>
</div></div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/home.js?v=20260926"></script>
</body></html>
