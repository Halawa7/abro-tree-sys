<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
  <title>TREE Dashboard</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Noto+Kufi+Arabic" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="/assets/css/dashboard.css?v=2.2" rel="stylesheet" />
  <script src="/assets/js/jquery.min.js"></script>
  <script type="module" src="/assets/js/dashboard-main.js?v=6.5"></script>
  <!-- picker Css -->
  <!-- <link rel="stylesheet" href="/assets/css/pickr.min.css" /> -->
  <!-- picker js -->
  <!-- <script src="/assets/js/plugins/pickr.min.js"></script> -->


  <!-- Include Swiper's CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- Include Swiper's JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <style>
    .swiper-button-prev::after,
    .swiper-button-next::after {
      top: 30% !important;
      font-size: 28px;
      font-weight: bold;
      color: #33333396;
    }
  </style>

</head>

<body class="g-sidenav-show rtl bg-gray-100">
  <!-- session notification -->

  <div
    class="notification <?php if (isset($_SESSION["notificationError"])): ?>error<?php endif; ?> <?php if (isset($_SESSION["notification"])): ?>show<?php endif; ?>">
    <div class="n-i"><i
        class="fa-solid <?php if (isset($_SESSION["notificationError"])): ?>fa-circle-xmark<?php else: ?>fa-circle-check<?php endif; ?>"></i>
    </div>
    <span><?php if (isset($_SESSION["notification"])) echo $_SESSION["notification"]; ?></span><i
      class="fa-solid fa-xmark"></i>
    <?php
    // unset session notification
    if (isset($_SESSION['notification'])) {
      unset($_SESSION['notification']);
    }
    if (isset($_SESSION['notificationError'])) {
      unset($_SESSION['notificationError']);
    }
    ?>
  </div>
  <div class="notification <?php if (isset($options["notificationError"])) : ?>error<?php endif; ?> <?php if (isset($options["notification"])) : ?>show<?php endif; ?>">
    <div class="n-i"><i class="fa-solid <?php if (isset($options["notificationError"])) : ?>fa-circle-xmark<?php else : ?>fa-circle-check<?php endif; ?>"></i></div>
    <span><?php if (isset($options["notification"])) echo $options["notification"]; ?></span><i class="fa-solid fa-xmark"></i>
  </div>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://www.treeegypt.com " target="_blank">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="me-1 font-weight-bold">TREE Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $abro->baseUrl; ?>dashboard/">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>shop</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(0.000000, 148.000000)">
                        <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                        <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text me-1">لوحة القيادة</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $abro->baseUrl; ?>dashboard/products-management/">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-bottle-droplet"></i>
            </div>
            <span class="nav-link-text me-1">إدارة المنتجات</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $abro->baseUrl; ?>dashboard/orders-management/">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-box"></i>
            </div>
            <span class="nav-link-text me-1">إدارة الطلبات</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $abro->baseUrl; ?>logout/">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>spaceship</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(4.000000, 301.000000)">
                        <path class="color-background" d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                        <path class="color-background opacity-6" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                        <path class="color-background opacity-6" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"></path>
                        <path class="color-background opacity-6" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text me-1">تسجيل الخروج</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 pe-2 ms-sm-6 ms-5 mt-4">
            <li class="breadcrumb-item text-sm ps-2">
              <a class="text-white opacity-5" href="<?php echo $abro->baseUrl; ?>dashboard/products-management/">إدارة المنتجات</a>
            </li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">
              <?php echo $options["Category"]->Name; ?>
            </li>
          </ol>
          <h6 class="text-white font-weight-bolder me-2"><?php echo $options["Category"]->Name; ?></h6>
        </nav>
        <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2 justify-content-end" id="navbar">
          <ul class="navbar-nav justify-content-end p-0">
            <li class="nav-item dropdown pe-2 d-flex align-items-center d-none">
              <a href="javascript:;" class="nav-link text-white p-0" aria-expanded="false">
                <i class="fa fa-pen cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?php echo $abro->baseUrl; ?><?php echo $options["Category"]->BackgroundImg; ?>'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?php echo $abro->baseUrl; ?><?php echo $options["Category"]->Cover; ?>" alt="<?php echo $options["Category"]->Name; ?>" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $options["Category"]->Name; ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">Category
                <?php echo number_format($options["Category"]->Views); ?> مشاهدات
              </p>
            </div>
          </div>
          <div class="col-2 my-sm-auto me-sm-auto ms-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-fill p-1 bg-transparent">
                <li class="nav-item edit-category">
                  <a class="nav-link mb-0 px-0 py-1 active" href="javascript:;">
                    <i class="fa fa-pen cursor-pointer" aria-hidden="true"></i>
                    <span>تعديل</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">المنتجات</h6>
              <p class="text-sm mb-0">يمكنك تعديل او اضافة او حذف اي منتج من هذه الفئة</p>
            </div>
            <div class="card-body p-3 pt-0">
              <div class="row">
                <?php
                foreach ($options["CategoryProducts"] as $product) {
                ?>
                  <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 mt-4">
                    <div class="card h-100 card-blog card-plain">
                      <div class="position-relative">
                        <a class="d-block border-radius-xl">
                          <img src="<?php echo $abro->baseUrl; ?><?php echo $product["ImgPath"]; ?>" alt="img-blur-shadow" class="img-fluid border-radius-xl" />
                        </a>
                      </div>
                      <div class="card-body px-1 pb-0 d-flex flex-column justify-content-between">
                        <a href="javascript:;">
                          <h5><?php echo $product["Name"]; ?></h5>
                        </a>
                        <p class="mb-4 text-sm product-desc"><?php
                                                              if ($product["Desc"]) {
                                                                echo strip_tags($product["Desc"]);
                                                              } else {
                                                                echo $product["Name"] . ". API SP and ILSAC GF-6A Approved. API Certified Resource Conserving. Meets system requirements. Keeps System Operating Smoothly and Quietly. Reduces Wear and Slippage. Non-Foaming, Non-Corrosive. Economy Grade. Applications: API SP (SN Plus, SN, SM, SL).";
                                                              }
                                                              ?></p>
                        <form action="" method="post" class="d-flex align-items-center justify-content-between">
                          <!-- <button type="submit" name="deleteProduct" value="<?php echo $product["ID"]; ?>" class="btn btn-outline-danger btn-sm mb-0">
                            حذف
                          </button> -->
                          <div value="<?php echo $product["ID"]; ?>" class="btn btn-outline-danger btn-sm mb-0 perform-delete-product">
                            حذف
                          </div>
                          <button type="submit" name="viewProduct" value="<?php echo $product["ID"]; ?>" class="btn btn-primary btn-sm mb-0">
                            تعديل
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 mt-3">
                  <div class="card h-100 card-plain border">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                      <a href="javascript:;" id="addProductBtn">
                        <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                        <h5 class="text-secondary">منتج جديد</h5>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="popup-overlay position-fixed w-100 h-100" style="top:0; left:0; background-color: rgba(0, 0, 0, .5); z-index:10000; display:none;"></div>
    <div class="sub-popup-overlay position-fixed w-100 h-100" style="top:0; left:0; background-color: rgba(0, 0, 0, .5); z-index:10003; display:none;"></div>
    <section class="product-sizes" style="width:100%; position:relative; padding: 1rem 1.2rem;">
      <?php
      $CategoryID =  $options["Category"]->ID;
      $allProducts = $abro->getAlldata("productSizes");
      $productsWithSizesIDs = array_column($allProducts, 'ProductID'); ?>
      <div class="container-fluid py-3" style="background-color: #ffffff; border-radius:25px;box-shadow: 0px 2px 12px rgba(0, 0, 0, .2);">
        <h6 class="text-center m-0">اضافة احجام للمنتج</h6>
        <div class="groups">
          <?php $groups = $abro->getAllProductSizeGroups($CategoryID);
          if (!empty($groups)): ?>
            <div style="font-weight: bold;margin-bottom: -.9rem;">مجموعات الفئة</div>
            <div class="d-flex align-items-center flex-wrap" style="gap: 1rem;">
              <?php foreach ($groups as $index => $group):
                $productIDs = explode(',', $group['ProductIDs']);
                $sizes = explode(',', $group['Sizes']);
                $groupBG = $productIDs[0]; ?>
                <a class="group-link d-block" href="/view-group-products" data-base-url="<?php echo $abro->baseUrl; ?>" data-category-id="<?php echo $CategoryID ?>" data-group-id="<?php echo $group['GroupID']; ?>">
                  <div class="group position-relative overflow-hidden cursor-pointer my-4" style="width: 200px; border-radius: 4px; box-shadow: 0px 2px 15px rgba(0,0,0,.1)">
                    <div class="overlay-group-popup position-absolute w-100 h-100" style="top:0; left:0; background-color: rgba(0, 0, 0, .1); z-index:1000;"></div>
                    <img class="img-fluid" src="<?php echo $abro->baseUrl . $abro->getProductMainImg($groupBG)->ImgPath; ?>" alt="Group Image">
                    <div class="position-absolute" style="left: 50%;bottom: 0;transform: translateX(-50%);z-index: 1500;background-color: rgba(0, 0, 0, .5);width: 100%;height: 30px; display:flex; align-items:center;">
                      <div class="text-center mt-2" style="z-index: 9999;margin-top: 0 !important;color: #ffffff; position: relative;text-align: center !important;width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;padding: 2px 6px;direction: ltr;"><?php echo htmlspecialchars($group["GroupName"]); ?></div>
                    </div>
                  </div>
                </a>
              <?php endforeach; ?>
              <div class="group-popup position-fixed mw-100 p-4" style="display: none; background-color:#FFFFFF; width: 80%; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 8px; z-index:10002;height: 90vh;overflow-y: auto;">
                <i class="fa-solid fa-xmark close-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
                <label class="d-block text-center" for="" style="font-size: .9rem;">اسم المجموعة</label>
                <input class="group-name text-center mb-3 form-control" style="width: fit-content;margin: auto;font-weight: bold;font-size: 1.2rem;direction: ltr;" required>
                <div class="font-weight-bold mb-3">منتجات المجموعة</div>
                <div class="content resulte-content d-flex  align-items-center flex-wrap" id="sizes-content" style="gap: 1rem; background-color:#e9ecef; padding: 1rem; margin: 1rem 0px 2rem"></div>
                <h6 class="text-center mb-3">المنتجات الاخري في الفئة</h6>
                <div class="swiper-container  position-relative overflow-hidden" style="min-height: 210px;">
                  <!-- add-to-group -->
                  <div class="swiper-wrapper">
                    <?php
                    $categoryProducts = $abro->getCategoryProducts($CategoryID);
                    foreach ($categoryProducts as $product):
                      if (!in_array($product["ID"], $productsWithSizesIDs)):
                    ?>
                        <div class="swiper-slide text-center product-option cursor-pointer" style="max-width: 201px" data-product-id="<?php echo $product['ID']; ?>">
                          <img src="<?php echo $abro->baseUrl . $abro->getProductMainImg($product['ID'])->ImgPath; ?>" alt="Product Image" class="img-thumbnail" style="width: 90px; height: 90px;">
                          <div><?php echo htmlspecialchars($product['Name']); ?></div>
                        </div>
                    <?php endif;
                    endforeach; ?>
                  </div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                <button class="save-update btn btn-primary d-block mx-auto" type="button" style="margin: 3rem 0px 0px;padding: .7rem 2rem;">حفظ</button>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="popup-size-color" style="width: 40%; display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,.5); z-index: 10100;">
          <i class="fa-solid fa-xmark close-sub-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
          <h4 class="text-center">ادخل الحجم</h4>
          <div>
            <label for="size">الحجم:</label>
            <input type="text" id="size" class="form-control value-input" required>
          </div>
          <button type="button" class="save btn btn-success d-block mt-4 mb-0 mx-auto">حفظ</button>
        </div>
        <button class="add-btn btn btn-primary mb-0 mt-3" type="button">اضافة مجموعة جديدة</button>
        <div class="new-group position-fixed mw-100 p-4" style="background-color:#FFFFFF; width: 70%;top:50%; left:50%; transform: translate(-50%, -50%); border-radius: 8px; z-index:10001;display:none;">
          <i class="fa-solid fa-xmark close-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
          <form action="" method="post">
            <input type="hidden" class="hidden-selected" id="hidden-selected-sizes" name="selected-products" value="<?php //echo rtrim($hiddenInputValue, '|'); 
                                                                                                                    ?>">
            <input class="form-control mw-100 mb-3 mx-auto text-center" style="width: fit-content; font-weight: bold; font-size: 1rem;" type="text" name="group-name" placeholder="اسم المجموعة" required>
            <div class="group bg-light my-3 p-3" style="background-color: #FFFFFF; border-radius:4px; display:none;">
              <div class="content  d-flex flex-wrap align-items-center mb-4" style="gap:1rem;"></div>
              <button class="send-data btn btn-success d-block mx-auto mb-0" type="submit" name="add-value">حفظ</button>
            </div>
          </form>
          <div class="swiper-container categroy-products position-relative overflow-hidden cursor-pointer mw-100 mt-3" style="min-height: 230px;">
            <div class="text-center" style="font-weight: bold;font-size: .9rem;margin-bottom: .5rem;">منتجات الفئة</div>
            <div class="swiper-wrapper">
              <?php
              $allCategoryProducts = $abro->getCategoryProducts($CategoryID);
              if ($allCategoryProducts):
                foreach ($allCategoryProducts as $product):
                  if (!in_array($product["ID"], $productsWithSizesIDs)):
              ?>
                    <div class="swiper-slide text-center add-product product-option" id="product-<?php echo  $product["ID"]; ?>" data-product-id="<?php echo $product['ID']; ?>">
                      <img src="<?php echo $abro->baseUrl . $abro->getProductMainImg($product['ID'])->ImgPath; ?>" alt="Product Image" class="img-thumbnail" style="width: 90px; height: 90px;">
                      <div><?php echo htmlspecialchars($product['Name']); ?></div>
                    </div>
              <?php endif;
                endforeach;
              endif; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
        <div class="popup-add position-fixed p-4  justify-content-between align-items-center" style="flex-direction: column; background-color:#FFFFFF; width: 350px;height:300px; top:50%; left:50%; transform: translate(-50%, -50%); border-radius: 8px;  z-index:10004;display:none;">
          <i class="fa-solid fa-xmark close-sub-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
          <label for="">ادخل الحجم</label>
          <input class="value-input form-control mx-auto" style="width: fit-content;" type="text" name="value" id="" placeholder="ادخل الحجم" required>
          <button class="save-data btn btn-primary d-block mx-auto mb-0" type="button">حفظ</button>
        </div>
      </div>
    </section>
    <section class="products-colors" style="width:100%; position:relative; padding: 1rem 1.2rem;">
      <?php
      $allProductsColor = $abro->getAlldata("productColors");
      $productsWithColorsIDs = array_column($allProductsColor, 'ProductID'); ?>
      <div class="container-fluid py-3" style="background-color: #ffffff; border-radius:25px;box-shadow: 0px 2px 12px rgba(0, 0, 0, .2);">
        <h6 class="text-center m-0">اضافة الوان للمنتج</h6>
        <div class="groups">
          <?php $groups = $abro->getAllProductColorGroups($CategoryID);
          if (!empty($groups)): ?>
            <div style="font-weight: bold;margin-bottom: -.9rem;">مجموعات الفئة</div>
            <div class="d-flex align-items-center flex-wrap" style="gap: 1rem;">
              <?php foreach ($groups as $index => $group):
                $productIDs = explode(',', $group['ProductIDs']);
                $colors = explode(',', $group['Colors']);
                $colors = explode(',', $group['ColorsNames']);
                $groupBG = $productIDs[0]; ?>
                <a class="group-link d-block" href="/view-color-group" data-base-url="<?php echo $abro->baseUrl; ?>" data-category-id="<?php echo $CategoryID ?>" data-group-id="<?php echo $group['GroupID']; ?>">
                  <div class="group position-relative overflow-hidden cursor-pointer my-4" style="width: 200px; border-radius: 4px; box-shadow: 0px 2px 15px rgba(0,0,0,.1)">
                    <div class="overlay-group-popup position-absolute w-100 h-100" style="top:0; left:0; background-color: rgba(0, 0, 0, .1); z-index:1000;"></div>
                    <img class="img-fluid" src="<?php echo $abro->baseUrl . $abro->getProductMainImg($groupBG)->ImgPath; ?>" alt="Group Image">
                    <div class="position-absolute" style="left: 50%;bottom: 0;transform: translateX(-50%);z-index: 1500;background-color: rgba(0, 0, 0, .5);width: 100%;height: 30px; display:flex; align-items:center;">
                      <div class="text-center mt-2" style="z-index: 9999;margin-top: 0 !important;color: #ffffff; position: relative;text-align: center !important;width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;padding: 2px 6px;direction: ltr;"><?php echo htmlspecialchars($group["GroupName"]); ?></div>
                    </div>
                  </div>
                </a>
              <?php endforeach; ?>
              <div class="group-popup position-fixed mw-100 p-4" style="display: none; background-color:#FFFFFF; width: 80%; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 8px; z-index:10002;height: 90vh;overflow-y: auto;">
                <i class="fa-solid fa-xmark close-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
                <label class="d-block text-center" for="" style="font-size: .9rem;">اسم المجموعة</label>
                <input class="group-name text-center mb-3 form-control" style="width: fit-content;margin: auto;font-weight: bold;font-size: 1.2rem;     direction: ltr;
" required>
                <div class="font-weight-bold mb-3">منتجات المجموعة</div>
                <div class="content resulte-content d-flex align-items-center flex-wrap" id="colors-content" style="gap: 1rem; background-color:#e9ecef; padding: 1rem; margin: 1rem 0px 2rem"></div>
                <h6 class="text-center mb-3">المنتجات الاخري في الفئة</h6>
                <div class="swiper-container  position-relative overflow-hidden" style="min-height: 210px;">
                  <div class="swiper-wrapper">
                    <?php
                    $categoryProducts = $abro->getCategoryProducts($CategoryID);
                    foreach ($categoryProducts as $product):
                      if (!in_array($product["ID"], $productsWithColorsIDs)):
                    ?>
                        <div class="swiper-slide text-center product-option cursor-pointer" style="max-width: 201px" data-product-id="<?php echo $product['ID']; ?>">
                          <img src="<?php echo $abro->baseUrl . $abro->getProductMainImg($product['ID'])->ImgPath; ?>" alt="Product Image" class="img-thumbnail" style="width: 90px; height: 90px;">
                          <div><?php echo htmlspecialchars($product['Name']); ?></div>
                        </div>
                    <?php endif;
                    endforeach; ?>
                  </div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                <button class="color-update btn btn-primary d-block mx-auto" type="button" style="margin: 3rem 0px 0px;padding: .7rem 2rem;">حفظ</button>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="popup-size-color" style="width: 40%; display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,.5); z-index: 10100;">
          <i class="fa-solid fa-xmark close-sub-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
          <h4 class="text-center">ادخل اللون</h4>
          <div style="width: fit-content;margin: 2rem auto;">
            <div style="max-width: 165px;">
              <input class="value-input form-control form-control-color mx-auto" title="اختر لون" type="color" name="value" id="" placeholder="ادخل اللون" required>
              <input type="text" value="" class="color-name form-control form-control-sm text-center mt-2" placeholder="اسم اللون">
            </div>
          </div>
          <button type="button" class="save btn btn-success d-block mt-4 mb-0 mx-auto">حفظ</button>
        </div>
        <button class="add-btn btn btn-primary mb-0 mt-3" type="button">اضافة مجموعة جديدة</button>
        <div class="new-group position-fixed mw-100 p-4" style="background-color:#FFFFFF; width: 70%;top:50%; left:50%; transform: translate(-50%, -50%); border-radius: 8px; z-index:10001;display:none;">
          <i class="fa-solid fa-xmark close-popup" style="position: absolute; top: 10px; right: 15px; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
          <form action="" method="post">
            <input type="hidden" class="hidden-selected" id="hidden-selected-colors" name="selected-products-color" value="">
            <input class="form-control mw-100 mb-3 mx-auto text-center" style="width: fit-content; font-weight: bold; font-size: 1rem;" type="text" name="color-group-name" placeholder="اسم المجموعة" required>
            <div class="group bg-light my-3 p-3" style="background-color: #FFFFFF; border-radius:4px; display:none;">
              <div class="content  d-flex flex-wrap align-items-center mb-4" style="gap:1rem;"></div>
              <button class="send-data btn btn-success d-block mx-auto mb-0" type="submit" name="add-value">حفظ</button>
            </div>
          </form>
          <div class="swiper-container  position-relative categroy-products overflow-hidden cursor-pointer mw-100 mt-3" style="padding-bottom: 1rem; min-height: 230px;">
            <div class="text-center" style="font-weight: bold;font-size: .9rem;margin-bottom: .5rem;">منتجات الفئة</div>
            <div class="swiper-wrapper">
              <?php
              if ($allCategoryProducts):
                foreach ($allCategoryProducts as $product):
                  if (!in_array($product["ID"], $productsWithColorsIDs)):
              ?>
                    <div class="swiper-slide text-center add-product product-option" id="product-<?php echo  $product["ID"]; ?>" data-product-id="<?php echo $product['ID']; ?>">
                      <img src="<?php echo $abro->baseUrl . $abro->getProductMainImg($product['ID'])->ImgPath; ?>" alt="Product Image" class="img-thumbnail" style="width: 90px; height: 90px;">
                      <div><?php echo htmlspecialchars($product['Name']); ?></div>
                    </div>
              <?php endif;
                endforeach;
              endif; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
        <div class="popup-add position-fixed p-4  justify-content-between align-items-center" style="flex-direction: column; background-color:#FFFFFF; width: 350px;height:300px; top:50%; left:50%; transform: translate(-50%, -50%); border-radius: 8px;  z-index:10004;display:none;">
          <i class="fa-solid fa-xmark close-sub-popup" style="position: absolute; top: -2%; right: -1%; cursor: pointer;padding: 1rem;font-size: 1.6rem;"></i>
          <label for="" class="font-weigth-bold" style="font-size: .9rem;">ادخل اللون</label>
          <div style="max-width: 165px;">
            <input class="value-input form-control form-control-color mx-auto" title="اختر لون" type="color" name="value" id="" placeholder="ادخل اللون" required>
            <input type="text" value="" class="color-name form-control form-control-sm text-center mt-2" placeholder="اسم اللون">
          </div>
          <button class="save-data btn btn-primary d-block mx-auto my-0" type="button">حفظ</button>
        </div>
      </div>
    </section>
  </div>
  <?php if (isset($options["ViewProduct"])) : ?>
    <div class="popup">
      <form class="productForm" action="editPategory" method="post" enctype="multipart/form-data">
        <div class="input-container">
          <label for="name">اسم المنتج</label>
          <input type="text" name="name" id="name" dir="ltr" placeholder="الاسم" value="<?php if (isset($options["ViewProduct"]->Name)) echo $options["ViewProduct"]->Name; ?>" required>
        </div>
        <div class="input-container">
          <label for="nameAr">اسم المنتج باللغة العربية</label>
          <input type="text" name="nameAr" id="nameAr" placeholder="الاسم باللغة العربية" value="<?php if (isset($options["ViewProduct"]->NameAr)) echo $options["ViewProduct"]->NameAr; ?>">
        </div>
        <div class="input-container">
          <label for="sku">SKU</label>
          <input type="text" name="sku" dir="ltr" id="sku" value="<?php if (isset($options["ViewProduct"]->SKU)) echo $options["ViewProduct"]->SKU; ?>">
        </div>
        <div class="input-container">
          <label for="price">سعر المنتج</label>
          <input type="text" name="price" id="price" placeholder="10.00" value="<?php if (isset($options["ViewProduct"]->Price)) echo $options["ViewProduct"]->Price; ?>" required>
        </div>
        <div class="input-container">
          <label for="weight">وزن المنتج بالكيلوجرام</label>
          <input type="text" name="weight" id="weight" placeholder="الوزن بالكيلوجرام" value="<?php if (isset($options["ViewProduct"]->Weight) && $options["ViewProduct"]->Weight != 0) echo $options["ViewProduct"]->Weight; ?>" required>
        </div>
        <div class="input-container">
          <label for="stock">الكمية الموجودة بالمخازن</label>
          <input type="text" name="stock" id="stock" placeholder="الكمية" value="<?php if (isset($options["ViewProduct"]->Stock) && $options["ViewProduct"]->Stock != 0) echo $options["ViewProduct"]->Stock; ?>" required>
        </div>
        <div class="input-container">
          <label for="image">صورة المنتج</label>
          <div class="select-file">
            <input type="file" name="image" id="image" class="file-input" accept="image/*" />
            <button type="button" class="file-btn"><i class="fa-solid fa-cloud-arrow-up"></i> اختيار ملف</button>
            <span class="file-text">لم تقم باختيار ملف.</span>
          </div>
        </div>
        <div class="textarea-container">
          <label for="desc">وصف المنتج</label>
          <textarea name="desc" id="desc" dir="ltr" rows="4" placeholder="الوصف"><?php if (isset($options["ViewProduct"]->Desc)) echo $options["ViewProduct"]->Desc; ?></textarea>
        </div>
        <div class="textarea-container">
          <label for="descAr">وصف المنتج باللغة العربية</label>
          <textarea name="descAr" id="descAr" rows="4" placeholder="الوصف باللغة العربية"><?php if (isset($options["ViewProduct"]->DescAr)) echo $options["ViewProduct"]->DescAr; ?></textarea>
        </div>
        <div class="category-select" style="margin: 20px 0; display: flex; flex-direction: column; width: 100%;">
          <h6 style="text-align: center; margin:0px">تغير فئه المنتج</h6>
          <label for="category">اختر الفئة</label>
          <select class="form-select" name="categoryID" id="category" style="padding-right: 2rem">
            <option value="<?php echo $options["Category"]->ID; ?>">
              <?php echo $options["Category"]->Name; ?>
            </option>
            <?php
            $categories = $abro->getAllData("categories");
            foreach ($categories as $category):
              if ($category["ID"] !== $options["Category"]->ID): ?>
                <option value="<?php echo $category["ID"]; ?>">
                  <?php echo $category["Name"]; ?>
                </option>
            <?php endif;
            endforeach;
            ?>
          </select>
        </div>
        <h5 style="width: 100%; text-align:center; color:red; margin:1.25rem 0;">-- ! SEO Only ! --</h5>
        <!-- Seo tags -->
        <div class="input-container" style="align-items: center; justify-content:center; width:100%;">
          <label for="stock">Product URL</label>
          <input type="text" name="prd-url" id="prd-url" dir='ltr' style="width: 75%;" placeholder="URL" value="<?php if (isset($options["ViewProduct"]->Url)) echo $options["ViewProduct"]->Url; ?>">
        </div>
        <div class="textarea-container">
          <label for="meta-title">Meta Title</label>
          <textarea name="meta-title" id="meta-title" dir="ltr" rows="4" placeholder="Content for meta title tag"><?php if (isset($options["ViewProduct"]->Desc)) echo $options["ViewProduct"]->MetaTitle; ?></textarea>
        </div>
        <div class="textarea-container">
          <label for="meta-desc">Meta Description</label>
          <textarea name="meta-desc" id="meta-desc" dir="ltr" rows="4" placeholder="Content for meta description tag"><?php if (isset($options["ViewProduct"]->DescAr)) echo $options["ViewProduct"]->MetaDescription; ?></textarea>
        </div>
        <div class="btn-container">
          <button type="submit" name="editProduct" value="<?php echo $options["ViewProduct"]->ID; ?>"><i class="fa-solid fa-floppy-disk"></i> حفظ</button>
        </div>
      </form>
    </div>
  <?php endif; ?>
  <div class="popup" style="visibility:hidden;">
    <form class="productForm" action="addPategory" method="post" enctype="multipart/form-data">
      <div class="input-container">
        <label for="name">اسم المنتج</label>
        <input type="text" name="name" id="name" dir="ltr" placeholder="الاسم" required>
      </div>
      <div class="input-container">
        <label for="nameAr">اسم المنتج باللغة العربية</label>
        <input type="text" name="nameAr" id="nameAr" placeholder="الاسم باللغة العربية">
      </div>
      <div class="input-container">
        <label for="sku">SKU</label>
        <input type="text" name="sku" dir="ltr" id="sku">
      </div>
      <div class="input-container">
        <label for="price">سعر المنتج</label>
        <input type="text" name="price" id="price" placeholder="10.00" required>
      </div>
      <div class="input-container">
        <label for="weight">وزن المنتج بالكيلوجرام</label>
        <input type="text" name="weight" id="weight" placeholder="الوزن بالكيلوجرام" required>
      </div>
      <div class="input-container">
        <label for="stock">الكمية الموجودة بالمخازن</label>
        <input type="text" name="stock" id="stock" placeholder="الوزن بالكيلوجرام" required>
      </div>
      <div class="input-container">
        <label for="image">صورة المنتج</label>
        <div class="select-file">
          <input type="file" name="image" id="image" class="file-input" accept="image/*" required />
          <button type="button" class="file-btn"><i class="fa-solid fa-cloud-arrow-up"></i> اختيار ملف</button>
          <span class="file-text">لم تقم باختيار ملف.</span>
        </div>
      </div>
      <div class="textarea-container">
        <label for="desc">وصف المنتج</label>
        <textarea name="desc" id="desc" dir="ltr" rows="4" placeholder="الوصف"></textarea>
      </div>
      <div class="textarea-container">
        <label for="descAr">وصف المنتج باللغة العربية</label>
        <textarea name="descAr" id="descAr" rows="4" placeholder="الوصف باللغة العربية"></textarea>
      </div>
      <div class="btn-container">
        <button type="submit" name="addProduct"><i class="fa-solid fa-circle-plus"></i> إضافة</button>
      </div>
    </form>
  </div>
  <div id="remove-product" class="d-flex justify-content-center align-items-center text-center d-none" style="width:100vw; height:100vh; position: fixed; z-index:99999; background-color:rgba(0, 0, 0, 0.7); top:0;">
    <form action="" method="post" class="ms-auto me-auto pt-3 pb-0 ps-4 pe-4" style="background-color: white; border-radius:12px; box-shadow:0 3px 5px -1px rgba(0, 0, 0, 0.09), 0 2px 3px -1px rgba(0, 0, 0, 0.07);">
      <p style="font-size: 19px;">حذف هذا المنتج نهائيًا؟</p>
      <button type="submit" name="deleteProduct" class="btn btn-danger">حذف</button>
    </form>
  </div>
  <script>
    $('.perform-delete-product').click((e) => {
      let deleteLayout = $("#remove-product");
      deleteLayout.find('button[type=submit]').attr('value', $(e.currentTarget).attr('value'));
      deleteLayout.removeClass("d-none");
    });
    $('#remove-product').click((e) => {
      let deleteLayout = $("#remove-product");
      if ($(e.target).attr('id') == 'remove-product') {
        deleteLayout.addClass("d-none");
      }
    });
  </script>
  <script>

  </script>
  <!--   Core JS Files   -->
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>


  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="/assets/js/dashboard.min.js?v=1.0.7"></script>


</body>

</html>