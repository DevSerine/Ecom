<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>كوسميتيك Glowing</title>

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml" />

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="./style.css" />

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- 
    - preload images
  -->
    <link rel="preload" as="image" href="./images/logo.png" />
    <link rel="preload" as="image" href="./images/hero-banner-1.jpg" />
    <link rel="preload" as="image" href="./images/hero-banner-2.jpg" />
    <link rel="preload" as="image" href="./images/hero-banner-3.jpg" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

  </head>

  <body id="top">
    <!-- 
    - #HEADER
  -->

    <header class="header">
      <div class="alert">
        <div class="container">
          <p class="alert-text"> ++الشحن المجاني على جميع الطلبات بقيمة 50 دينارا أو أكثر</p>
        </div>
      </div>

      <div class="header-top" data-header>
        <div class="container">
          <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
            <span class="line line-1"></span>
            <span class="line line-2"></span>
            <span class="line line-3"></span>
          </button>

          <div class="input-wrapper"><input        
       type="search"
        name="search"
        placeholder="Search product"
        class="search-field"
        onkeyup="fetchSuggestions(this.value)"
        
    />

    <button class="search-submit" aria-label="search">
        <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
    </button>
    <a href="#scrolesearsh"><div class="suggestions" id="suggestions"></div>
</div>
</a>
<script>
function fetchSuggestions(query) {
    if (query.length === 0) {
        document.getElementById('suggestions').innerHTML = '';
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_suggestions.php?query=' + query, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('suggestions').innerHTML = xhr.responseText;
            // Déplacer l'appel à attachClickEvents() ici après avoir généré les éléments de suggestion
            attachClickEvents();
        }
    };
    xhr.send();
}
</script>

          <a href="#" class="logo">
            <img
              src="./images/logo.png"
              width="179"
              height="26"
              alt="Glowing"
            />
          </a>

          <div class="header-actions">
           

<style>
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff; /* Couleur de fond de la liste déroulante */
    border: 1px solid #ccc; /* Bordure de la liste déroulante */
    padding: 5px;
}

.dropdown-menu li {
    list-style-type: none;
}

.dropdown-menu li a {
    text-decoration: none;
    color: #333; /* Couleur du texte des éléments de liste */
}
</style>

<a href="/login system/login_form.php" onmouseover="showDropdown(event)" onmouseout="hideDropdown()">
    <button class="header-action-btn" aria-label="user">
        <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
        <?php
        // Vérifie si le nom d'utilisateur est défini dans la session
        if (isset($_SESSION['user_name'])) {
            echo "Hi, " . $_SESSION['user_name']; // Affiche "Hi, [Nom de l'utilisateur]"
        }
        ?>
    </button>
</a>

<?php if(isset($_SESSION['user_name'])): ?>
<div class="dropdown-menu" id="dropdownMenu" onmouseover="keepDropdown()" onmouseout="hideDropdown()">
    <ul>
        <li><a href="#">الإعدادات</a></li>
        <li><a href="#">الملف الشخصي</a></li>
        <li><a href="/login system/logout.php"><ion-icon name="log-out-outline"></ion-icon></a></li>
    </ul>
</div>
<?php endif; ?>

<script>
function showDropdown(event) {
    event.stopPropagation();
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.style.display = "block";
}

function hideDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.style.display = "none";
}

function keepDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.style.display = "block";
}
</script>


            <button class="header-action-btn" aria-label="favourite item">
            <ul class="dropdown wishlist-list">
        <!-- Wishlist items will be added here dynamically -->
    </ul>
           



              <ion-icon
                name="star-outline"
                aria-hidden="true"
                aria-hidden="true"
              ></ion-icon>

              <span class="btn-badge">0</span>
            </button>

            <button class="header-action-btn" aria-label="cart item">
               <ul class="dropdown cart-list">
        <!-- Cart items will be added here dynamically -->
    </ul>
              <data class="btn-text" value="0">دج 0.00</data>

              <ion-icon
                name="bag-handle-outline"
                aria-hidden="true"
                aria-hidden="true"
              ></ion-icon>

              <span class="btn-badge">0</span>
            </button>
            
          </div>
         

          <script>
document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.action-btn[aria-label="add to cart"]');
    const cartCounter = document.querySelector('.header-action-btn[aria-label="cart item"] .btn-badge');
    const wishlistButtons = document.querySelectorAll('.action-btn[aria-label="add to wishlist"]');
    const totalPriceDisplay = document.querySelector('.header-action-btn[aria-label="cart item"] .btn-text');
    const wishlistCounter = document.querySelector('.header-action-btn[aria-label="favourite item"] .btn-badge');
    const cartList = document.querySelector('.cart-list');
    const wishlistList = document.querySelector('.wishlist-list');

    let cartItemCount = 0;
    let totalPrice = 0;
    let wishlistItemCount = 0;

    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            cartItemCount++;
            const shopCard = button.closest('.shop-card');
            const priceString = shopCard.querySelector('.price .span').textContent;
            const itemPrice = parseFloat(priceString.replace('$', ''));
            totalPrice += itemPrice;
            updateCartCounter();
            updateTotalPrice();
            updateCartList(shopCard);
        });
    });

    wishlistButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            wishlistItemCount++;
            const shopCard = button.closest('.shop-card');
            updateWishlistCounter();
            updateWishlistList(shopCard);
        });
    });

    function updateCartCounter() {
        cartCounter.textContent = cartItemCount;
    }

    function updateTotalPrice() {
        totalPriceDisplay.textContent = '$' + totalPrice.toFixed(2);
    }

    function updateWishlistCounter() {
        wishlistCounter.textContent = wishlistItemCount;
    }

    function updateCartList(shopCard) {
        const productName = shopCard.querySelector('h3 a').textContent;
        const priceString = shopCard.querySelector('.price .span').textContent;
        const productImageSrc = shopCard.querySelector('img').src;
        const listItem = document.createElement('li');

        const itemInfo = document.createElement('div');
        itemInfo.className = 'item-info';

        const itemName = document.createElement('span');
        itemName.className = 'item-name';
        itemName.textContent = productName;

        const itemPrice = document.createElement('span');
        itemPrice.className = 'item-price';
        itemPrice.textContent = priceString;

        itemInfo.appendChild(itemName);
        itemInfo.appendChild(itemPrice);

        const productImage = document.createElement('img');
        productImage.src = productImageSrc;

        const likeIcon = document.createElement('ion-icon');
        likeIcon.name = 'checkmark-outline';
        likeIcon.addEventListener('click', function() {
            alert('Achat réussi');
        });

        const printIcon = document.createElement('ion-icon');
        printIcon.name = 'print-outline';
        printIcon.addEventListener('click', function() {
            downloadPDF(productName, priceString, productImageSrc);
        });

        listItem.appendChild(productImage);
        listItem.appendChild(itemInfo);
        listItem.appendChild(likeIcon);
        listItem.appendChild(printIcon);

        cartList.appendChild(listItem);
    }

    function updateWishlistList(shopCard) {
        const productName = shopCard.querySelector('h3 a').textContent;
        const productImageSrc = shopCard.querySelector('img').src;
        const listItem = document.createElement('li');

        const itemInfo = document.createElement('div');
        itemInfo.className = 'item-info';

        const itemName = document.createElement('span');
        itemName.className = 'item-name';
        itemName.textContent = productName;

        itemInfo.appendChild(itemName);

        const productImage = document.createElement('img');
        productImage.src = productImageSrc;

        const likeIcon = document.createElement('ion-icon');
        likeIcon.name = 'checkmark-outline';
        likeIcon.addEventListener('click', function() {
            alert('Achat réussi');
        });

        const printIcon = document.createElement('ion-icon');
        printIcon.name = 'print-outline';
        printIcon.addEventListener('click', function() {
            downloadPDF(productName, null, productImageSrc);
        });

        listItem.appendChild(productImage);
        listItem.appendChild(itemInfo);
        listItem.appendChild(likeIcon);
        listItem.appendChild(printIcon);

        wishlistList.appendChild(listItem);
    }

    async function downloadPDF(productName, priceString, productImageSrc) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Product Name: " + productName, 10, 10);
    if (priceString) {
        doc.text("Price: " + priceString, 10, 20);
    }
    try {
        const image = await getBase64ImageFromURL(productImageSrc);
        doc.addImage(image, 'JPEG', 10, 30, 50, 50);
        doc.save('product-info.pdf');
    } catch (error) {
        console.error('Error loading image:', error);
    }
}


function getBase64ImageFromURL(url) {
    return new Promise((resolve, reject) => {
        let img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = () => {
            let canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            let ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);
            let dataURL = canvas.toDataURL('image/jpeg');
            resolve(dataURL);
        };
        img.onerror = error => reject(error);
        img.src = 'https://cors-anywhere.herokuapp.com/' + url; // Utiliser un proxy pour contourner CORS
    });
}

});
</script>


          <nav class="navbar">
            <ul class="navbar-list">
              <li>
                <a href="#home" class="navbar-link has-after">الرئيسية</a>
              </li>

              <li>
                <a href="#collection" class="navbar-link has-after"
                  >مجموعة</a
                >
              </li>

              <li>
                <a href="#shop" class="navbar-link has-after">شراء</a>
              </li>

              <li>
                <a href="#offer" class="navbar-link has-after">عروض</a>
              </li>

              <li>
                <a href="#blog" class="navbar-link has-after">مدونة</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <!-- 
    - #MOBILE NAVBAR
  -->

    <div class="sidebar">
      <div class="mobile-navbar" data-navbar>
        <div class="wrapper">
          <a href="#" class="logo">
            <img
              src="./images/logo.png"
              width="179"
              height="26"
              alt="Glowing"
            />
          </a>

          <button
            class="nav-close-btn"
            aria-label="close menu"
            data-nav-toggler
          >
            <ion-icon name="close-outline" aria-hidden="true">الرئيسية</ion-icon>
          </button>
        </div>

        <ul class="navbar-list">
          <li>
            <a href="#home" class="navbar-link" data-nav-link></a>
          </li>

          <li>
            <a href="#collection" class="navbar-link" data-nav-link
              >مجموعة</a
            >
          </li>

          <li>
            <a href="#shop" class="navbar-link" data-nav-link>شراء</a>
          </li>

          <li>
            <a href="#offer" class="navbar-link" data-nav-link>عروض</a>
          </li>

          <li>
            <a href="#blog" class="navbar-link" data-nav-link>مدونة</a>
          </li>
        </ul>
      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>
    </div>

    <main>
      <article>
        <!-- 
        - #HERO
      -->

        <section class="section hero" id="home" aria-label="hero" data-section>
          <div class="container">
            <li class="scrollbar-item"><ul class="has-scrollbar">
              <li class="scrollbar-item">
                <div
                  class="hero-card has-bg-image"
                  style="
                    background-image: url('./images/hero-banner-1.jpg');
                  "
                >
                  <div class="card-content">
                    <h1 class="h1 hero-title">
                    اكشفي عن<br />
                    جمال البشرة
                    </h1>

                    <p class="hero-text">
                    مصنوعة باستخدام مكونات نظيفة وغير سامة، منتجاتنا مصممة للجميع.
                    </p>

                    <p class="price">ابتداءً من دج 7.99</p>

                    <a href="#" class="btn btn-primary">اشتري الان</a>
                  </div>
                </div>
              </li>

              <li class="scrollbar-item">
                <div
                  class="hero-card has-bg-image"
                  style="
                    background-image: url('./images/hero-banner-2.jpg');
                  "
                >
                  <div class="card-content">
                  <h1 class="h1 hero-title">
                    اكشفي عن<br />
                    جمال البشرة
                    </h1>

                    <p class="hero-text">
                    مصنوعة باستخدام مكونات نظيفة وغير سامة، منتجاتنا مصممة للجميع.
                    </p>

                    <p class="price">ابتداءً من دج 7.99</p>

                    <a href="#" class="btn btn-primary">اشتري الان</a>
                  </div>
                </div>
              </li>

              <li class="scrollbar-item">
                <div
                  class="hero-card has-bg-image"
                  style="
                    background-image: url('./images/hero-banner-3.jpg');
                  "
                >
                  <div class="card-content">
                  <h1 class="h1 hero-title">
                    اكشفي عن<br />
                    جمال البشرة
                    </h1>

                    <p class="hero-text">
                    مصنوعة باستخدام مكونات نظيفة وغير سامة، منتجاتنا مصممة للجميع.
                    </p>

                    <p class="price">ابتداءً من دج 7.99</p>

                    <a href="#" class="btn btn-primary">اشتري الان</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <!-- 
        - #COLLECTION
      -->

        <section
          class="section collection"
          id="collection"
          aria-label="collection"
          data-section
        >
          <div class="container">
            <ul class="collection-list">
              <li>
                <div class="collection-card has-before hover:shine">
                  <h2 class="h2 card-title">مجموعة الصيف</h2>

                  <p class="card-text">ابتداءً من 17.99 دج</p>

                  <a href="#" class="btn-link">
                    <span class="span">اشتري الان</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>

                  <div
                    class="has-bg-image"
                    style="
                      background-image: url('./images/collection-1.jpg');
                    "
                  ></div>
                </div>
              </li>

              <li>
                <div class="collection-card has-before hover:shine">
                  <h2 class="h2 card-title">ما الجديد؟</h2>

                  <p class="card-text">احصل على إشراقة</p>

                  <a href="#" class="btn-link">
                    <span class="span">اكتشف الآن</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>

                  <div
                    class="has-bg-image"
                    style="
                      background-image: url('./images/collection-2.jpg');
                    "
                  ></div>
                </div>
              </li>
              

              <li>
                <div class="collection-card has-before hover:shine">
                  <h2 class="h2 card-title">اشترِ 1 واحصل على 1</h2>

                  <p class="card-text">ابتداءً من 7.99 دج</p>

                  <a href="#" class="btn-link">
                    <span class="span">اكتشف الآن</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>

                  <div
                    class="has-bg-image"
                    style="
                      background-image: url('./images/collection-3.jpg');
                    "
                  ></div>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <!-- 
        - #SHOP
      -->

        <section class="section shop" id="shop" aria-label="shop" data-section>
          <div class="container">
            <div class="title-wrapper">
              <h2 class="h2 section-title">أفضل المبيعات</h2>

              <a href="#" class="btn-link">
                <span class="span">تسوق جميع المنتجات</span>

                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
              </a>
            </div>
            <?php
@include 'config.php';
// Récupérer les produits depuis la base de données
$select = mysqli_query($conn, "SELECT * FROM products");
$products = [];

// Initialiser le compteur de critiques
$total_reviews = 0;

while ($row = mysqli_fetch_assoc($select)) {
    $products[] = $row;
    // Incrémenter le compteur de critiques pour chaque produit
    $total_reviews += isset($row['reviews']) ? $row['reviews'] : 0;
}

?>



<ul class="has-scrollbar" id="scrolesearsh">
    <?php foreach ($products as $product) { ?>
        <li class="scrollbar-item product-item" id="scrolesearsh" >
            <div class="shop-card">
                <div class="card-banner img-holder" style="--width: 100px; --height: 100px;">
                    <!-- Utilisez le chemin d'accès correct pour charger les images -->
                    <img src="uploaded_img/<?php echo isset($product['image']) ? $product['image'] : 'default.jpg'; ?>" width="100" height="100" loading="lazy" alt="<?php echo isset($product['name']) ? $product['name'] : 'Product Name'; ?>" class="img-cover" />

                    <?php if (isset($product['discount']) && $product['discount'] > 0) { ?>
                        <span class="badge" aria-label="<?php echo $product['discount']; ?>% off">-<?php echo $product['discount']; ?>%</span>
                    <?php } ?>

                    <div class="card-actions">
                        <button class="action-btn" aria-label="add to cart">
                            <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                        </button>

                        <button class="action-btn" aria-label="add to wishlist">
                            <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                        </button>

                        <button class="action-btn" aria-label="compare">
                            <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                        </button>
                    </div>
                </div>

                <div class="card-content">
                    <div class="price">
                        <?php if (isset($product['discount']) && $product['discount'] > 0) { ?>
                            <del class="del">$<?php echo isset($product['regular_price']) ? $product['regular_price'] : '0.00'; ?></del>
                        <?php } ?>
                        <span class="span">$<?php echo isset($product['price']) ? $product['price'] : '0.00'; ?></span>
                    </div>

                    <h3>
                        <a href="#" class="card-title"><?php echo isset($product['name']) ? $product['name'] : 'Product Name'; ?></a>
                    </h3>

                    <div class="card-rating">
                        <div class="rating-wrapper" aria-label="<?php echo isset($product['rating']) ? $product['rating'] : '0'; ?> star rating">
                            <?php 
                                $rating = isset($product['rating']) ? $product['rating'] : '0';
                                for ($i = 0; $i < $rating; $i++) { ?>
                                    <ion-icon name="star" aria-hidden="true"></ion-icon>
                            <?php } ?>
                        </div>
                        <p class="rating-text"><?php echo isset($product['reviews']) ? $product['reviews'] : '0'; ?> <p>Total Reviews: <?php echo $total_reviews; ?></p>
                    </div>
                </div>
            </div>
        </li>
    <?php } ?>
</ul>





          </div>
        </section>

        <section class="section shop" id="shop" aria-label="shop" data-section>
          <div class="container">
            <div class="title-wrapper">
              <h2 class="h2 section-title">أقل من 100 دج</h2>

              <a href="#" class="btn-link">
                <span class="span">تسوق جميع المنتجات</span>

                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
              </a>
            </div>

            <ul class="has-scrollbar" id="scrolesearsh">
    <?php foreach ($products as $product) { 
        // Vérifier si le prix du produit est inférieur à 100
        if (isset($product['price']) && $product['price'] < 100) { ?>
            <li class="scrollbar-item" id="scrolesearsh" >
                <div class="shop-card">
                    <div class="card-banner img-holder" style="--width: 100px; --height: 100px;">
                        <img src="uploaded_img/<?php echo isset($product['image']) ? $product['image'] : 'default.jpg'; ?>" width="100" height="100" loading="lazy" alt="<?php echo isset($product['name']) ? $product['name'] : 'Product Name'; ?>" class="img-cover" />

                        <?php if (isset($product['discount']) && $product['discount'] > 0) { ?>
                            <span class="badge" aria-label="<?php echo $product['discount']; ?>% off">-<?php echo $product['discount']; ?>%</span>
                        <?php } ?>

                        <div class="card-actions">
                            <button class="action-btn" aria-label="add to cart">
                                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                            </button>

                            <button class="action-btn" aria-label="add to wishlist">
                                <ion-icon name="star-outline" aria-hidden="true"></ion-icon>
                            </button>

                            <button class="action-btn" aria-label="compare">
                                <ion-icon name="repeat-outline" aria-hidden="true"></ion-icon>
                            </button>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="price">
                            <?php if (isset($product['discount']) && $product['discount'] > 0) { ?>
                                <del class="del">$<?php echo isset($product['regular_price']) ? $product['regular_price'] : '0.00'; ?></del>
                            <?php } ?>
                            <span class="span">$<?php echo isset($product['price']) ? $product['price'] : '0.00'; ?></span>
                        </div>

                        <h3>
                            <a href="#" class="card-title"><?php echo isset($product['name']) ? $product['name'] : 'Product Name'; ?></a>
                        </h3>

                        <div class="card-rating">
                            <div class="rating-wrapper" aria-label="<?php echo isset($product['rating']) ? $product['rating'] : '0'; ?> star rating">
                                <?php 
                                    $rating = isset($product['rating']) ? $product['rating'] : '0';
                                    for ($i = 0; $i < $rating; $i++) { ?>
                                        <ion-icon name="star" aria-hidden="true"></ion-icon>
                                <?php } ?>
                            </div>
                            <p class="rating-text"><?php echo isset($product['reviews']) ? $product['reviews'] : '0'; ?> <p>Total Reviews: <?php echo $total_reviews; ?></p>
                        </div>
                    </div>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>

          </div>
        </section>

        <!-- 
        - #BANNER
      -->

        <section class="section banner" aria-label="banner" data-section>
          <div class="container">
            <ul class="banner-list">
              <li>
                <div class="banner-card banner-card-1 has-before hover:shine">
                  <p class="card-subtitle">مجموعة جديدة</p>

                  <h2 class="h2 card-title">اكتشف مستحضرات العناية بالبشرة بالخريف</h2>

                  <a href="#" class="btn btn-secondary">Explore More</a>

                  <div
                    class="has-bg-image"
                    style="
                      background-image: url('./images/banner-1.jpg');
                    "
                  ></div>
                </div>
              </li>

              <li>
                <div class="banner-card banner-card-2 has-before hover:shine">
                  <h2 class="h2 card-title">خصم 25% على كل شيء</h2>

                  <p class="card-text">
                  مستحضرات التجميل بمجموعة متنوعة من الألوان لكل إنسان.
                  </p>

                  <a href="#" class="btn btn-secondary">تسوق البيع</a>

                  <div
                    class="has-bg-image"
                    style="
                      background-image: url('./images/banner-2.jpg');
                    "
                  ></div>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <!-- 
        - #FEATURE
      -->

        <section class="section feature" aria-label="feature" data-section>
          <div class="container">
            <h2 class="h2-large section-title">لماذا التسوق مع Glowing?</h2>

            <ul class="flex-list">
              <li class="flex-item">
                <div class="feature-card">
                  <img
                    src="./images/feature-1.jpg"
                    width="204"
                    height="236"
                    loading="lazy"
                    alt="Guaranteed PURE"
                    class="card-icon"
                  />

                  <h3 class="h3 card-title">نضمن النقاء</h3>

                  <p class="card-text">
                  كل تركيبات Grace تلتزم بمعايير النقاء الصارمة ولن تحتوي أبدًا على مكونات قاسية أو سامة.
                  </p>
                </div>
              </li>

              <li class="flex-item">
                <div class="feature-card">
                  <img
                    src="./images/feature-2.jpg"
                    width="204"
                    height="236"
                    loading="lazy"
                    alt="Completely Cruelty-Free"
                    class="card-icon"
                  />

                  <h3 class="h3 card-title">منتجاتنا خالية تمامًا من التجارب على الحيوانات</h3>

                  <p class="card-text">
                  جميع تركيبات Grace تلتزم بمعايير النقاء الصارمة ولن تحتوي أبدًا على مكونات قاسية أو سامة.
                  </p>
                </div>
              </li>

              <li class="flex-item">
                <div class="feature-card">
                  <img
                    src="./images/feature-3.jpg"
                    width="204"
                    height="236"
                    loading="lazy"
                    alt="Ingredient Sourcing"
                    class="card-icon"
                  />

                  <h3 class="h3 card-title">توريد المكونات</h3>

                  <p class="card-text">
                  جميع تركيبات Grace تلتزم بمعايير النقاء الصارمة ولن تحتوي أبدًا على مكونات قاسية أو سامة.
                  </p>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <!-- 
        - #OFFER
      -->

        <section
          class="section offer"
          id="offer"
          aria-label="offer"
          data-section
        >
          <div class="container">
            <figure class="offer-banner">
              <img
                src="./images/offer-banner-1.jpg"
                width="305"
                height="408"
                loading="lazy"
                alt="offer products"
                class="w-100"
              />

              <img
                src="./images/offer-banner-2.jpg"
                width="450"
                height="625"
                loading="lazy"
                alt="offer products"
                class="w-100"
              />
            </figure>

            <div class="offer-content">
              <p class="offer-subtitle">
                <span class="span">عرض خاص</span>

                <span class="badge" aria-label="20% off">-20%</span>
              </p>

              <h2 class="h2-large section-title">زيت الاستحمام بالصنوبر</h2>

              <p class="section-text">
              مصنوعة باستخدام مكونات نظيفة وغير سامة، منتجاتنا مصممة للجميع.
              </p>

              <div class="countdown">
    <span class="time" aria-label="days">15</span>
    <span class="time" aria-label="hours">21</span>
    <span class="time" aria-label="minutes">46</span>
    <span class="time" aria-label="seconds">08</span>
</div>

<script>
    // Get references to the countdown elements
    const daysElement = document.querySelector('.countdown [aria-label="days"]');
    const hoursElement = document.querySelector('.countdown [aria-label="hours"]');
    const minutesElement = document.querySelector('.countdown [aria-label="minutes"]');
    const secondsElement = document.querySelector('.countdown [aria-label="seconds"]');

    // Set the target date for the countdown (YYYY-MM-DD HH:MM:SS format)
    const targetDate = new Date('2024-06-15T21:46:08Z').getTime();

    // Update the countdown every second
    const interval = setInterval(() => {
        // Get the current date and time
        const now = new Date().getTime();

        // Calculate the remaining time
        const remainingTime = targetDate - now;

        // Calculate days, hours, minutes, and seconds
        const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        // Update the countdown elements with the new values
        daysElement.textContent = days.toString().padStart(2, '0');
        hoursElement.textContent = hours.toString().padStart(2, '0');
        minutesElement.textContent = minutes.toString().padStart(2, '0');
        secondsElement.textContent = seconds.toString().padStart(2, '0');

        // If the countdown is finished, clear the interval
        if (remainingTime <= 0) {
            clearInterval(interval);
        }
    }, 1000); // Update every second
</script>


              <a href="#" class="btn btn-primary">احصل عليه بسعر 39.00 دج فقط</a>
            </div>
          </div>
        </section>

        <!-- 
        - #BLOG
      -->

        <section class="section blog" id="blog" aria-label="blog" data-section>
          <div class="container">
            <h2 class="h2-large section-title">ادق التقاصيل</h2>

            <ul class="flex-list">
              <li class="flex-item">
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder has-before hover:shine"
                    style="--width: 700; --height: 450"
                  >
                    <img
                      src="./images/blog-1.jpg"
                      width="700"
                      height="450"
                      loading="lazy"
                      alt="Find a Store"
                      class="img-cover"
                    />
                  </figure>

                  <h3 class="h3">
                    <a href="#" class="card-title">لايجاد المتجر</a>
                  </h3>

                  <a href="#" class="btn-link">
                    <span class="span">Our Store</span>

                    <ion-icon
                      name="arrow-forward-outline"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li class="flex-item">
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder has-before hover:shine"
                    style="--width: 700; --height: 450"
                  >
                    <img
                      src="./images/blog-2.jpg"
                      width="700"
                      height="450"
                      loading="lazy"
                      alt="From Our Blog"
                      class="img-cover"
                    />
                  </figure>

                  <h3 class="h3">
                    <a href="#" class="card-title">من المدونة</a>
                  </h3>

                  <a href="#" class="btn-link">
                    <span class="span">متجرنا</span>

                    <ion-icon
                      name="arrow-forward-outline"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li class="flex-item">
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder has-before hover:shine"
                    style="--width: 700; --height: 450"
                  >
                    <img
                      src="./images/blog-3.jpg"
                      width="700"
                      height="450"
                      loading="lazy"
                      alt="Our Story"
                      class="img-cover"
                    />
                  </figure>

                  <h3 class="h3">
                    <a href="#" class="card-title">البدايات</a>
                  </h3>

                  <a href="#" class="btn-link">
                    <span class="span">متجرنا</span>

                    <ion-icon
                      name="arrow-forward-outline"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </section>
      </article>
    </main>

    <!-- 
    - #FOOTER
  -->

    <footer class="footer" data-section>
      <div class="container">
        <div class="footer-top">
          <ul class="footer-list">
            <li>
              <p class="footer-list-title">Company</p>
            </li>

            <li>
              <p class="footer-list-text">
                Find a location nearest you. See
                <a href="#" class="link">Our Stores</a>
              </p>
            </li>

            <li>
              <p class="footer-list-text bold">+391 (0)35 2568 4593</p>
            </li>

            <li>
              <p class="footer-list-text">hello@domain.com</p>
            </li>
          </ul>

          <ul class="footer-list">
            <li>
              <p class="footer-list-title">Useful links</p>
            </li>

            <li>
              <a href="#" class="footer-link">New Products</a>
            </li>

            <li>
              <a href="#" class="footer-link">Best Sellers</a>
            </li>

            <li>
              <a href="#" class="footer-link">Bundle & Save</a>
            </li>

            <li>
              <a href="#" class="footer-link">Online Gift Card</a>
            </li>
          </ul>

          <ul class="footer-list">
            <li>
              <p class="footer-list-title">Infomation</p>
            </li>

            <li>
              <a href="#" class="footer-link">Start a Return</a>
            </li>

            <li>
              <a href="#" class="footer-link">Contact Us</a>
            </li>

            <li>
              <a href="#" class="footer-link">Shipping FAQ</a>
            </li>

            <li>
              <a href="#" class="footer-link">Terms & Conditions</a>
            </li>

            <li>
              <a href="#" class="footer-link">Privacy Policy</a>
            </li>
          </ul>

          <div class="footer-list">
            <p class="newsletter-title">Good emails.</p>

            <p class="newsletter-text">
              Enter your email below to be the first to know about new
              collections and product launches.
            </p>

            <form action="" class="newsletter-form">
              <input
                type="email"
                name="email_address"
                placeholder="Enter your email address"
                required
                class="email-field"
              />

              <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
          </div>
        </div>

        <div class="footer-bottom">
          <div class="wrapper">
            <p class="copyright">&copy; 2024 SerineDev</p>

            <ul class="social-list">
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-youtube"></ion-icon>
                </a>
              </li>
            </ul>
          </div>

          <a href="#" class="logo">
            <img
              src="./images/logo.png"
              width="179"
              height="26"
              loading="lazy"
              alt="Glowing"
            />
          </a>

          <img
            src="./images/pay.png"
            width="313"
            height="28"
            alt="available all payment method"
            class="w-100"
          />
        </div>
      </div>
    </footer>

    <!-- 
    - #BACK TO TOP
  -->

    <a
      href="#top"
      class="back-top-btn"
      aria-label="back to top"
      data-back-top-btn
    >
      <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
    </a>

    <!-- 
    - custom js link
  -->
    <script src="./script.js" defer></script>

    <!-- 
    - ionicon link
  -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    
  </body>
</html><li class="scrollbar-item"><span>Product12 - $546</span></li><li class="scrollbar-item"><span>Product8 - $89</span></li><li class="scrollbar-item"><span>Product15 - $435</span></li><li class="scrollbar-item"><span>savonette - $5</span></li>