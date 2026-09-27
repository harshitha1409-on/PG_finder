<?php session_start(); ?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>My Profile | VizagPG Finder</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="assets/style.css"></head>
<body class="pglife-body">
<nav class="site-nav"><div class="container nav-inner"><a class="brand-logo" href="index.php"><span class="brand-mark">⌂</span><span class="brand-pg">PG</span><span class="brand-life">Life</span></a><div class="nav-right"><a href="index.php" class="nav-link-btn">Home</a><a href="listings.php?city=Visakhapatnam" class="nav-link-btn">PGs</a><button id="profileLogout" class="nav-link-btn">↪ Logout</button></div></div></nav>
<main class="container profile-page"><div id="profileContent" class="profile-loading">Loading profile...</div></main>
<script src="assets/profile.js?v=20260926"></script>
</body></html>