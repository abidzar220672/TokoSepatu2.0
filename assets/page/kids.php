<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/shop.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    <header>
    <nav>
      <div class="dropdown-icon">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"      aria-expanded="false" style="background-color: #000000;"> 
          More
        </button>
  <!-- isi dari dropdwon -->
  <?php include '../component/navbar.php'; ?>

<!-- logo dan icon Navbar -->
</div>
      </div>
      <div class="logo">
       <h1>Vans</h1>
      </div>
      <div class="icon">
        <div class="user">
          <i class="fa-regular fa-user" style="color: #000000;"></i>
        </div>
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"style="color: #000000;"></i>
        </div>
        <div class="cart">
          <i class="fa-solid fa-cart-shopping"style="color:#000000;"></i>
        </div>
      </div>
    </nav>
    
     <div class="container py-5">
  <h2 class="mb-4">Kids</h2>
  <div class="row g-4">
    
  
    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <img src="../img/9.jpg" class="card-img-top" alt="">
        <div class="card-body text-center">
          <h5 class="card-title">Little Kids Sk8-Hi Side Zip Shoe</h5>
          <p class="card-text text-muted">Top Seller</p>
          <p class="fw-bold">$45.00</p>
        
        </div>
      </div>
    </div>


    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <img src="../img/10.jpg" class="card-img-top" alt="">
        <div class="card-body text-center">
          <h5 class="card-title">Little Kids Loot Halloween T-Shirt</h5>
          <p class="card-text text-muted">New Arrival</p>
          <p class="fw-bold">$20.00</p>
         
        </div>
      </div>
    </div>

    
    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <img src="../img/11.jpg" class="card-img-top" alt="">
        <div class="card-body text-center">
          <h5 class="card-title">Old Skool Drop V Backpack</h5>
          <p class="card-text text-muted">Limited</p>
          <p class="fw-bold">$45.00</p>
          
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <img src="../img/12.jpg" class="card-img-top" alt="">
        <div class="card-body text-center">
          <h5 class="card-title">Kids Check-5 Loose Denim Pants</h5>
          <p class="card-text text-muted">Limited</p>
          <p class="fw-bold">$75.00</p>
          
        </div>
      </div>
    </div> 
  </div>
</div>

<?php include '../component/footer.php'; ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>