<?php
// Deteksi halaman aktif
$current = basename($_SERVER['PHP_SELF']);
// Tentukan base path relatif tergantung kedalaman folder
$depth = substr_count($_SERVER['PHP_SELF'], '/');
// index.php ada di root (depth=1), pages ada di /assets/page/ (depth=3)
$base = ($current === 'index.php' && $depth <= 2) ? 'assets/page/' : '';
?>
<nav class="vans-navbar">
  <!-- Logo Kiri -->
  <div class="vans-logo">
    <a href="<?= ($current === 'index.php' && $depth <= 2) ? 'index.php' : '../../index.php' ?>">
      <strong>VANS</strong>
    </a>
  </div>

  <!-- Menu Tengah -->
  <ul class="vans-menu">
    <li>
      <a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/new.php' : 'new.php' ?>"
         class="<?= $current === 'new.php' ? 'active' : '' ?>">NEW ARRIVALS</a>
    </li>
    <li>
      <a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/men.php' : 'men.php' ?>"
         class="<?= $current === 'men.php' ? 'active' : '' ?>">MEN</a>
    </li>
    <li>
      <a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/women.php' : 'women.php' ?>"
         class="<?= $current === 'women.php' ? 'active' : '' ?>">WOMEN</a>
    </li>
    <li>
      <a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/kids.php' : 'kids.php' ?>"
         class="<?= $current === 'kids.php' ? 'active' : '' ?>">KIDS</a>
    </li>
    <li>
      <a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/shopall.php' : 'shopall.php' ?>"
         class="<?= $current === 'shopall.php' ? 'active' : '' ?>">SHOP ALL</a>
    </li>
  </ul>

  <!-- Kanan: Search + Icon -->
  <div class="vans-right">
    <div class="vans-search">
      <input type="text" placeholder="Search..." id="vansSearchInput">
      <button type="button" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <a href="#" class="vans-icon" aria-label="Account"><i class="fa-regular fa-user"></i></a>
    <a href="#" class="vans-icon" aria-label="Cart"><i class="fa-solid fa-cart-shopping"></i></a>
  </div>

  <!-- Hamburger Mobile -->
  <button class="vans-hamburger" id="vansHamburger" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- Mobile menu overlay -->
<div class="vans-mobile-menu" id="vansMobileMenu">
  <ul>
    <li><a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/new.php' : 'new.php' ?>">NEW ARRIVALS</a></li>
    <li><a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/men.php' : 'men.php' ?>">MEN</a></li>
    <li><a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/women.php' : 'women.php' ?>">WOMEN</a></li>
    <li><a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/kids.php' : 'kids.php' ?>">KIDS</a></li>
    <li><a href="<?= ($current === 'index.php' && $depth <= 2) ? 'assets/page/shopall.php' : 'shopall.php' ?>">SHOP ALL</a></li>
  </ul>
</div>

<style>
/* ===== VANS NAVBAR ===== */
.vans-navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  border-bottom: 2px solid #000;
  padding: 0 32px;
  height: 62px;
  position: sticky;
  top: 0;
  z-index: 999;
  gap: 16px;
}

/* Logo */
.vans-logo a {
  text-decoration: none;
  color: #000;
  font-size: 1.5rem;
  font-weight: 900;
  letter-spacing: 1px;
  font-family: 'Arial Black', Arial, sans-serif;
}

/* Center menu */
.vans-menu {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 0;
  flex: 1;
  justify-content: center;
}
.vans-menu li a {
  display: block;
  padding: 0 18px;
  height: 62px;
  line-height: 62px;
  text-decoration: none;
  color: #222;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.5px;
  border-bottom: 3px solid transparent;
  transition: border-color 0.15s, color 0.15s;
  white-space: nowrap;
}
.vans-menu li a:hover,
.vans-menu li a.active {
  border-bottom: 3px solid #000;
  color: #000;
}

/* Right section */
.vans-right {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-shrink: 0;
}

/* Search box */
.vans-search {
  display: flex;
  align-items: center;
  border: 1.5px solid #ccc;
  border-radius: 4px;
  overflow: hidden;
  height: 36px;
}
.vans-search input {
  border: none;
  outline: none;
  padding: 0 10px;
  font-size: 13px;
  width: 150px;
  height: 100%;
  background: #fff;
  color: #333;
}
.vans-search button {
  border: none;
  background: #fff;
  padding: 0 10px;
  height: 100%;
  cursor: pointer;
  font-size: 13px;
  color: #333;
  border-left: 1.5px solid #ccc;
  transition: background 0.15s;
}
.vans-search button:hover { background: #f5f5f5; }

/* Icon links */
.vans-icon {
  color: #000;
  font-size: 17px;
  text-decoration: none;
  padding: 6px;
  transition: opacity 0.15s;
}
.vans-icon:hover { opacity: 0.6; }

/* Hamburger (hidden desktop) */
.vans-hamburger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px;
}
.vans-hamburger span {
  display: block;
  width: 24px;
  height: 2px;
  background: #000;
  border-radius: 2px;
  transition: all 0.3s;
}

/* Mobile menu */
.vans-mobile-menu {
  display: none;
  background: #fff;
  border-bottom: 2px solid #000;
  padding: 0;
}
.vans-mobile-menu.open { display: block; }
.vans-mobile-menu ul { list-style: none; margin: 0; padding: 0; }
.vans-mobile-menu ul li a {
  display: block;
  padding: 14px 24px;
  font-size: 14px;
  font-weight: 600;
  color: #000;
  text-decoration: none;
  border-bottom: 1px solid #eee;
  letter-spacing: 0.5px;
}
.vans-mobile-menu ul li a:hover { background: #f5f5f5; }

/* Old nav reset — make sure old styles don't interfere */
nav.vans-navbar { background-color: #fff !important; }

/* Responsive */
@media (max-width: 900px) {
  .vans-menu { display: none; }
  .vans-search input { width: 100px; }
  .vans-hamburger { display: flex; }
}
@media (max-width: 560px) {
  .vans-navbar { padding: 0 16px; }
  .vans-search { display: none; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('vansHamburger');
  var menu = document.getElementById('vansMobileMenu');
  if (btn && menu) {
    btn.addEventListener('click', function () {
      menu.classList.toggle('open');
    });
  }
});
</script>