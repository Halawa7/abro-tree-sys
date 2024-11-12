<?php
// $excel_products = $abro->readExcelSheet($abro->publicPath."htdocs/products.xlsx");
// echo '</br>';
// echo '</br>';
// echo json_encode($abro->updateProductsBySKU($excel_products));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
  if (isset($page) && str_starts_with($page, 'product')) {
    $product = $abro->getProductByID($options["Product"]->ID, $options["Category"]->ID);
  ?>
    <meta property="title" content="<?php echo $product->MetaTitle ? $product->MetaTitle : strip_tags($product->Name); ?>">
    <meta property="description" content="<?php echo $product->MetaDescription ? $product->MetaDescription : strip_tags($product->Desc) ?>" />
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="Abro Egypt">
    <meta property="og:title" content="<?php echo strip_tags($product->Name); ?>">
    <meta property="og:description" content="<?php echo strip_tags($product->Desc) ?>" />
    <meta property="og:image" content="<?php echo $abro->baseUrl . $abro->getProductMainImg($options["Product"]->ID)->ImgPath ?>" />
  <?php
  } else {
  ?>
    <meta property="og:image" content="<?php echo $abro->baseUrl . '/assets/icons/favicon.ico' ?>" />
  <?php
  }
  ?>
  <?php if ($abro->page == 'blog' && isset($blog->MetaTitle)) {
  ?>
    <meta name="title" content="<?php echo $blog->MetaTitle ?>">
  <?php
  }
  ?>
  <?php if ($abro->page == 'blog' && isset($blog->MetaDescription)) {
  ?>
    <meta name="description" content="<?php echo $blog->MetaDescription ?>">
  <?php
  }
  ?>
  <?php
  if (isset($page) && $page == 'home') {
  ?>
    <meta property="title" content="Shop now ABRO products: premium car oils & ABRO Air Fresheners" />
    <meta property="og:title" content="Shop now ABRO products: premium car oils & ABRO Air Fresheners">
    <meta name="description" content="Explore ABRO products like top-quality car oils and lubricant|Enhance your vehicle's performance and freshness with our air fresheners|car care products">
    <meta name="og:description" content="Explore ABRO products like top-quality car oils and lubricant|Enhance your vehicle's performance and freshness with our air fresheners|car care products">
  <?php
  }
  ?>
  <title>
    <?php
    echo (isset($page) && str_starts_with($page, 'product') && $product->MetaTitle)
      ? $product->MetaTitle
      : (isset($page) && $page == 'home' ? 'Shop now ABRO® products: premium car oils & ABRO Air Fresheners' : 'ABRO®');
    ?> </title>
  <?php
  if (isset($page) && $page == 'category') {
    if (str_contains($_SERVER['REQUEST_URI'], 'engine-oils')) {
  ?>
      <meta property="description" content="take a look at our - motor engine oil - which is one of the best oil brands in the market. shop now for the best - diesel engine oil additive in the market." />
      <meta property="og:description" content="take a look at our - motor engine oil - which is one of the best oil brands in the market. shop now for the best - diesel engine oil additive in the market." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'additives')) {
    ?>
      <meta property="description" content="Discover the best diesel engine oil additive for optimal performance | Explore oil additives to stop burning oil and find the best diesel oil additive." />
      <meta property="og:description" content="Discover the best diesel engine oil additive for optimal performance | Explore oil additives to stop burning oil and find the best diesel oil additive." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'air-freshners-and-scents')) {
    ?>
      <meta property="description" content="Discover a range of air fresheners for cars on our site. Choose from high-quality car air fresheners to keep your vehicle smelling fresh and inviting." />
      <meta property="og:description" content="Discover a range of air fresheners for cars on our site. Choose from high-quality car air fresheners to keep your vehicle smelling fresh and inviting." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'car-care')) {
    ?>
      <meta property="description" content="Discover top car care products including the best car seat cleaner | car parts cleaner | and car lens cleaner - for maintaining your vehicle's pristine condition." />
      <meta property="og:description" content="Discover top car care products including the best car seat cleaner | car parts cleaner | and car lens cleaner - for maintaining your vehicle's pristine condition." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'gearbox-oils')) {
    ?>
      <meta property="description" content="Shop premium gearbox oil and car products at our online store. Find top-quality gearbox oils to enhance your vehicle's performance and longevity." />
      <meta property="og:description" content="Shop premium gearbox oil and car products at our online store. Find top-quality gearbox oils to enhance your vehicle's performance and longevity." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'engine-and-radiator-coolants')) {
    ?>
      <meta property="description" content="buy premium radiator coolant and take expert advice on radiator coolant filters, and when to change radiator coolant. Quality car products at unbeatable prices." />
      <meta property="og:description" content="buy premium radiator coolant and take expert advice on radiator coolant filters, and when to change radiator coolant. Quality car products at unbeatable prices." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'lubricants-and-grease')) {
    ?>
      <meta property="description" content="Explore our selection of premium grease and lubricants for vehicles. Find top-quality lubricants, Benefit from our great deals to maintain peak performance." />
      <meta property="og:description" content="Explore our selection of premium grease and lubricants for vehicles. Find top-quality lubricants, Benefit from our great deals to maintain peak performance." />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'protection-and-detailing')) {
    ?>
      <meta property="description" content="buy top-quality car protection film at our online store. Ensure lasting car protection with Our new car paint protection film, and discover how much it cost" />
      <meta property="og:description" content="buy top-quality car protection film at our online store. Ensure lasting car protection with Our new car paint protection film, and discover how much it cost" />
    <?php
    } else if (str_contains($_SERVER['REQUEST_URI'], 'adhesives-and-sealants')) {
    ?>
      <meta property="description" content="Discover high-quality adhesives and glue products at competitive prices on our website. Explore a variety of adhesives and find the perfect solution for your needs." />
      <meta property="og:description" content="Discover high-quality adhesives and glue products at competitive prices on our website. Explore a variety of adhesives and find the perfect solution for your needs." />
  <?php
    }
  }
  ?>
  <link rel="shortcut icon" href="<?php echo $abro->baseUrl; ?>assets/icons/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Manrope:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $abro->baseUrl; ?>assets/css/swiper-bundle.min.css" />
  <script src="<?php echo $abro->baseUrl; ?>assets/js/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link rel="stylesheet" href="<?php echo $abro->baseUrl; ?>assets/css/style.css?v=46.1" />
  <script src="<?php echo $abro->baseUrl; ?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.4.2/libphonenumber-js.min.js"></script>
  <script id="mainScript" type="module" src="<?php echo $abro->baseUrl; ?>assets/js/main.js?v=40.0" weburl="<?php echo $abro->baseUrl; ?>"></script>
  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1364613517527482');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1364613517527482&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->
</head>
<!-- Google Tag Manager -->
<script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-M2BGPBRW');
</script>
<!-- End Google Tag Manager -->

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M2BGPBRW" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <?php if (isset($options["loadingScreen"])) : ?>
    <div class="main-loader no-select">
      <div class="logo-img">
        <img src="/assets/img/header-logo.png?v=5" alt="ABRO®">
      </div>
      <div class="signature">&copy; TREE Marketing</div>
    </div>
  <?php endif; ?>
  <main class="scroll">
    <header>
      <div class="top-header">
        <div class="row">
          <a class="icon-container" href="tel:201222290017">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/call.png" alt="Call" />
            <span>Call Us</span>
          </a>
          <a class="icon-container" href="mailto:info@abroegypt.com">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/mail.png" alt="Email" />
            <span>Email Us</span>
          </a>
        </div>
        <div class="row" style="display: none;">
          <div class="icon-container">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/gb.svg" />
            <span>EN</span>
            <i class="fa-solid fa-angle-down"></i>
          </div>
        </div>
      </div>
    </header>
    <!-- <div class="offer-header"> -->
    <!-- cashback offer sale -->
    <!-- <div class="offer-bar">
          <div class="offer-text" style="text-align:center">
          Up to 50% Cashback Discount !
          </div>
          <div class="offer-text">
          <a href="/register"style="text-decoration:underline; color:#FFEB3B;">REGISTER</a> > <span>ORDER</span> > <span style="color:#FFEB3B; font-size:17px;">EARN</span>
          </div>
        </div> -->
    <!-- sale offer -->
    <?php
    $endDateTime = date_create("01-12-2024", timezone_open("Africa/Cairo"));
    $currDateTime = date_create("now", timezone_open("Africa/Cairo"));
    $offer_days = date_diff($currDateTime, $endDateTime)->days;
    $offer_hours = date_diff($currDateTime, $endDateTime)->h;
    $offer_mins = date_diff($currDateTime, $endDateTime)->i;
    $offer_secs = date_diff($currDateTime, $endDateTime)->s;
    ?>
    <?php
    // if ($offer_days || $offer_hours || $offer_mins || $offer_secs) {
    if ($currDateTime < $endDateTime) {
    ?>
      <div class="offer-bar">
        <div class="offer-text">
          10% OFF FOR ALL ORDERS!!
        </div>
        <div class="offer-timer">
          <div class="days"><?php echo $offer_days; ?><sub>d</sub></div>:<div class="hours"><?php echo $offer_hours; ?><sub>hrs</sub></div>:<div class="minutes"><?php echo $offer_mins; ?><sub>mins</sub></div>:<div class="seconds"><?php echo $offer_secs; ?></div>
        </div>
        <div class="offer-text" style="margin-left: 10px;">
          <!-- <span>use promo</span> AUTOTECHXABRO -->
          ORDER NOW
        </div>
      </div>
    <?php
    }
    ?>
    <!-- </div> -->
    <div class="s-c-c">
      <div class="shopping-cart">
        <div class="s-c-h">
          <span>Shopping cart</span>
          <span class="close">&#x2715;</span>
        </div>
        <div class="s-c-i-c">
          <img src="<?php echo $abro->baseUrl; ?>assets/icons/shopping-bag.png" alt="">
          <span>Your cart is empty.</span>
        </div>
      </div>
    </div>
    <?php if ($abro->account === null && $abro->page != "login" && $abro->page != "register") : ?>
      <div class="l-r-c">
        <div class="account-panel login show">
          <div class="l-r-h">
            <span>Login</span>
            <span class="close">&#x2715;</span>
          </div>
          <form class="l-r-f" action="/login/" method="post">
            <div class="l-r-box mt-0">
              <label class="input-label">Email address <span class="required">*</span></label>
              <input type="email" name="email" class="input" required />
            </div>
            <div class="l-r-box mt-0">
              <label class="input-label">Password <span class="required">*</span></label>
              <input type="password" name="password" class="input" required />
            </div>
            <button type="submit" name="login" class="m-0">Sign in</button>
            <p class="m-0 mt-4">
              <span>New customer?</span>
              <a class="switchAccountPanel" data-target="register">Create your account</a>
            </p>
            <p class="m-0 mt-2">
              <span>Lost password?</span>
              <a class="switchAccountPanel" data-target="recover">Recover password</a>
            </p>
          </form>
        </div>
        <div class="account-panel register">
          <div class="l-r-h">
            <span>Register</span>
            <span class="close">&#x2715;</span>
          </div>
          <form class="l-r-f" action="/register/" method="post">
            <div class="l-r-box mt-0">
              <label class="input-label">First name</label>
              <input type="text" name="firstName" class="input" />
            </div>
            <div class="l-r-box mt-0">
              <label class="input-label">Last name</label>
              <input type="text" name="lastName" class="input" />
            </div>
            <div class="l-r-box mt-0">
              <label class="input-label">Phone number <span class="required">*</span></label>
              <input type="text" name="number" class="input" required />
            </div>
            <div class="l-r-box mt-0">
              <label class="input-label">Email address <span class="required">*</span></label>
              <input type="email" name="email" class="input" required />
            </div>
            <div class="l-r-box mt-0">
              <label class="input-label">Password <span class="required">*</span></label>
              <input type="password" name="password" class="input" required />
            </div>
            <button type="submit" name="register" class="m-0">Register</button>
            <p class="m-0 mt-4">
              <span>Already have an account?</span>
              <a class="switchAccountPanel" data-target="login">Login here</a>
            </p>
          </form>
        </div>
        <div class="account-panel recover">
          <div class="l-r-h">
            <span>Recover password</span>
            <span class="close">&#x2715;</span>
          </div>
          <form class="l-r-f">
            <div class="l-r-box mt-0">
              <label class="input-label">Email address <span class="required">*</span></label>
              <input type="email" class="input" required />
            </div>
            <button type="submit" class="m-0">Reset password</button>
            <p class="m-0 mt-4">
              <span>Remembered your password?</span>
              <a class="switchAccountPanel" data-target="login">Back to login</a>
            </p>
          </form>
        </div>
      </div>
    <?php endif; ?>
    <div class="side-nav-container">
      <div class="side-nav scroll">
        <div class="s-n-l">
          <div class="logo-container">
            <img src="<?php echo $abro->baseUrl; ?>assets/img/header-logo.png?v=5" alt="ABRO®">
          </div>
          <i class="fa-solid fa-xmark close-btn"></i>
        </div>
        <h3>All categories</h3>
        <div class="nav-links">
          <?php if ($abro->account != null && $abro->account->isAdmin) : ?>
            <a href="<?php echo $abro->baseUrl; ?>dashboard/">Dashboard <i class="fa-solid fa-circle-chevron-right"></i></a>
          <?php endif; ?>
          <?php
          foreach ($categories as $value) {
          ?>
            <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $value["Name"])); ?>/"><?php echo $value["Name"]; ?> <i class="fa-solid fa-circle-chevron-right"></i></a>
          <?php
          }
          ?>
          <a href="<?php echo $abro->baseUrl; ?>blogs/">Blogs <i class="fa-solid fa-circle-chevron-right"></i></a>
        </div>
        <div class="extra-info">
          <h4>Need help?</h4>
          <div class="e-i-i">
            <i class="fa-solid fa-headset"></i>
            <a href="tel:+201222290017">+20 122 2290017</a>
          </div>
          <div class="e-i-i">
            <i class="fa-regular fa-envelope"></i>
            <a href="mailto:support@abroegypt.com">support@abroegypt.com</a>
          </div>
        </div>
      </div>
    </div>
    <div class="search-container scroll">
      <div class="search">
        <div class="search-header">
          <span>Search our site</span>
          <span class="close">&#x2715;</span>
        </div>
        <div class="search-action">
          <form action="/search/" method="post" class="input-container">
            <input type="text" name="searchAll" placeholder="Search for products">
            <button type="submit"><img src="<?php echo $abro->baseUrl; ?>assets/icons/dark-search.png"></button>
          </form>
        </div>
      </div>
    </div>
    <section class="hero">
      <div class="header<?php if ($abro->page == "login" || $abro->page == "register" || $abro->page == "shop" || $abro->page == "product" || $abro->page == "wishlist" || $abro->page == "compare" || $abro->page == "accessibility" || $abro->page == "terms" || $abro->page == "refund" || $abro->page == "privacy" || $abro->page == "cookie" || $abro->page == "fraud" || $abro->page == "account" || $abro->page == "search" || $abro->page == "blogs" || $abro->page == "blog") : ?> no-float<?php endif; ?><?php if ($abro->page == "blog" || $abro->page == "accessibility" || $abro->page == "terms" || $abro->page == "refund" || $abro->page == "privacy" || $abro->page == "cookie" || $abro->page == "fraud") : ?> grey-bg<?php endif; ?>">
        <div class="header-menu">
          <img src="<?php echo $abro->baseUrl; ?>assets/icons/header-menu.png">
        </div>
        <a href="<?php echo $abro->baseUrl; ?>" class="header-logo">
          <img src="<?php echo $abro->baseUrl; ?>assets/img/header-logo.png?v=5" alt="ABRO®" />
        </a>
        <div class="header-links">
          <?php
          foreach ($categories as $value) {
          ?>
            <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $value["Name"])); ?>/"><?php echo $value["Name"]; ?></a>
          <?php
          }
          ?>
          <a href="<?php echo $abro->baseUrl; ?>blogs/">Blogs</a>
        </div>
        <div class="header-btns">
          <a class="search-btn"><img src="<?php echo $abro->baseUrl; ?>assets/icons/search.png" /></a>
          <?php if ($abro->page == "login" || $abro->page == "register") : ?>
            <a href="<?php echo $abro->baseUrl; ?>login/"><img src="<?php echo $abro->baseUrl; ?>assets/icons/account.png" /></a>
          <?php elseif ($abro->account === null) : ?>
            <a class="account-btn"><img src="<?php echo $abro->baseUrl; ?>assets/icons/account.png" /></a>
          <?php else : ?>
            <div class="h-a-c">
              <a><img src="<?php echo $abro->baseUrl; ?>assets/icons/account.png" /></a>
              <div class="account-details">
                <div class="a-d-c">
                  <?php if ($abro->account->isAdmin) : ?>
                    <a href="<?php echo $abro->baseUrl; ?>dashboard/"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                  <?php endif; ?>
                  <a href="<?php echo $abro->baseUrl; ?>account/"><i class="fa-solid fa-box"></i> My orders</a>
                  <a href="<?php echo $abro->baseUrl; ?>logout/"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <a href="<?php echo $abro->baseUrl; ?>wishlist/" class="wishlist-btn">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/wishlist.png" />
            <div class="wishlist">0</div>
          </a>
          <a class="cart-btn">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/cart.png" />
            <div class="cart">0</div>
          </a>
        </div>
      </div>