<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vans</title>
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
  <header>
    <?php include 'assets/component/navbar.php'; ?>

    <!-- Hero Carousel -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/hero.jpg" class="d-block w-100" alt="Hero">
        </div>
        <div class="carousel-item">
          <img src="assets/img/img2.PNG" class="d-block w-100" alt="Hero 2">
        </div>
        <div class="carousel-item">
          <img src="assets/img/hero.jpg" class="d-block w-100" alt="Hero 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </header>

  <section class="category-section">
    <div class="category-list">
      <h2>
        Women's Shoes <br>
        Men's Shoes <br>
        Kids' Shoes <br>
        Backpacks & Bags
      </h2>
    </div>
    <div class="category-img">
      <img src="assets/img/img2.PNG" alt="Shoes Category">
    </div>
  </section>

  <section class="product-section">
    <h2>School & Recess Ready</h2>
    <div class="product-grid">
      <div class="product-card">
        <img src="assets/img/sepatu4.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Shoe</h3><p>$45.00</p></div>
      </div>
      <div class="product-card">
        <img src="assets/img/sepatu1.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Shoe</h3><p>$45.00</p></div>
      </div>
      <div class="product-card">
        <img src="assets/img/sepatu2.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Hoodie</h3><p>$45.00</p></div>
      </div>
      <div class="product-card">
        <img src="assets/img/sepatu3.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Pants</h3><p>$45.00</p></div>
      </div>
    </div>
  </section>

  <section class="promo-section">
    <div class="promo-card">
      <img src="assets/img/SZA joins Vans as Artistic Director.“I’ve learned that bravery and curiosity are the cures for u.jpg">
      <div class="promo-overlay">
        <h3>Our Artistic Director, SZA</h3>
        <a href="assets/page/new.php">Shop Now</a>
      </div>
    </div>
    <div class="promo-card">
      <img src="assets/img/The OTW by Vans x S.R. STUDIO. LA. CA. collection is now live on vans.com-otwPhotography- @noua_.jpg" alt="OTW by Vans">
      <div class="promo-overlay">
        <h3>OTW by Vans X S.R. STUDIO. LA. CA</h3>
        <a href="assets/page/new.php">Shop Now</a>
      </div>
    </div>
    <div class="promo-card">
      <img src="assets/img/@jnelv’s fits in the Super Lowpro. 🤎 🩵 ❤️.jpg">
      <div class="promo-overlay">
        <h3>The Super LowPro</h3>
        <a href="assets/page/new.php">Shop Now</a>
      </div>
    </div>
  </section>

  <section class="product-section">
    <h2>School & Recess Ready</h2>
    <div class="product-grid">
      <div class="product-card">
        <img src="assets/img/sepatu4.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Shoe</h3><p>$45.00</p></div>
      </div>
      <div class="product-card">
        <img src="assets/img/sepatu1.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Shoe</h3><p>$45.00</p></div>
      </div>
      <div class="product-card">
        <img src="assets/img/sepatu2.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Hoodie</h3><p>$45.00</p></div>
      </div>
      <div class="product-card">
        <img src="assets/img/sepatu3.jpg" alt="">
        <div class="product-info"><h3>Little Kids Knu Skool Pants</h3><p>$45.00</p></div>
      </div>
    </div>
  </section>

  <?php include 'assets/component/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>