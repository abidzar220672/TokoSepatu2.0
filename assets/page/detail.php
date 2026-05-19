<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav>
            <div class="dropdown-icon">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="background-color: #000000;">
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
                    <i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i>
                </div>
                <div class="cart">
                    <i class="fa-solid fa-cart-shopping" style="color:#000000;"></i>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="product-images">
                <img src="img/1.jpg" alt="shoe">
                <img src="img/1.jpg" alt="shoe">
                <img src="img/1.jpg" alt="shoe">
                <img src="img/1.jpg" alt="shoe">
            </div>

            <div class="product-info">
                <p style="color: red; font-weight: bold;">New</p>
                <h2>Knu Skool Shoe</h2>
                <p class="subtitle">Lifestyle, Retro Chunky, Suede</p>
                <p class="hargadetail">$80.00</p>

                <label>Size</label>
                <select>
                    <option>Choose Your Size</option>
                    <option>38</option>
                    <option>39</option>
                    <option>40</option>
                    <option>41</option>
                    <option>42</option>
                </select>


                <div class="shipping-option">
                    <input type="radio" name="shipping" checked> Ship to Home (3–5 business days)
                </div>
                <div class="shipping-option">
                    <input type="radio" name="shipping"> In-Store Pickup (Check Availability)
                </div>

                <div class="accordion">
                    <div class="accordion-item">
                        <button onclick="toggleAccordion(this)">Description</button>
                        <div class="accordion-content">High-quality suede sneaker with retro chunky style.</div>
                    </div>
                    <div class="accordion-item">
                        <button onclick="toggleAccordion(this)">Details</button>
                        <div class="accordion-content">Available in multiple colors and sizes.</div>
                    </div>
                    <div class="accordion-item">
                        <button onclick="toggleAccordion(this)">Shipping & Return</button>
                        <div class="accordion-content">Free shipping & 30-day returns.</div>
                    </div>
                </div>
            </div>
        </div>

        <script>

            function toggleAccordion(btn) {
                btn.classList.toggle("active");
                let content = btn.nextElementSibling;
                content.classList.toggle("show");
            }

        </script>






       <?php include '../component/footer.php'; ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

</html>