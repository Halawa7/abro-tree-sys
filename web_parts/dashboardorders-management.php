<!DOCTYPE html>
<html class="overflow-x-hidden" lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
  <title>TREE Dashboard</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:300,400,600,700" rel="stylesheet" />
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
  <script type="module" src="/assets/js/dashboard-main.js?v=6.8"></script>
</head>

<body class="g-sidenav-show rtl bg-gray-100">
  <div class="side-alert">
    <div class="s-a"><i class="fa-solid fa-circle-xmark"></i></div><span></span><i class="fa-solid fa-xmark close-btn"></i>
  </div>
  <div class="order-menu">
    <div class="order-menu-container"></div>
  </div>
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end ms-3 rotate-caret"
    id="sidenav-main">
    <div class="sidenav-header">
      <i
        class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true"
        id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://www.treeegypt.com" target="_blank">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo" />
        <span class="me-1 font-weight-bold">TREE Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div class="collapse navbar-collapse px-0 w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $abro->baseUrl; ?>dashboard/">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <svg
                width="12px"
                height="12px"
                viewBox="0 0 45 40"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>shop</title>
                <g
                  stroke="none"
                  stroke-width="1"
                  fill="none"
                  fill-rule="evenodd">
                  <g
                    transform="translate(-1716.000000, -439.000000)"
                    fill="#FFFFFF"
                    fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(0.000000, 148.000000)">
                        <path
                          class="color-background opacity-6"
                          d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                        <path
                          class="color-background"
                          d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
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
          <a class="nav-link active" href="<?php echo $abro->baseUrl; ?>dashboard/orders-management/">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-box"></i>
            </div>
            <span class="nav-link-text me-1">إدارة الطلبات</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $abro->baseUrl; ?>logout/">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <svg
                width="12px"
                height="20px"
                viewBox="0 0 40 40"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>spaceship</title>
                <g
                  stroke="none"
                  stroke-width="1"
                  fill="none"
                  fill-rule="evenodd">
                  <g
                    transform="translate(-1720.000000, -592.000000)"
                    fill="#FFFFFF"
                    fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(4.000000, 301.000000)">
                        <path
                          class="color-background"
                          d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                        <path
                          class="color-background opacity-6"
                          d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                        <path
                          class="color-background opacity-6"
                          d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"></path>
                        <path
                          class="color-background opacity-6"
                          d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"></path>
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
  <main class="main-content position-relative h-100 border-radius-lg overflow-x-hidden">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
            <li class="breadcrumb-item text-sm ps-2">
              <a class="opacity-5 text-dark" href="<?php echo $abro->baseUrl; ?>dashboard/">لوحة القيادة</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
              إدارة الطلبات
            </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">إدارة الطلبات</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>الطلبات</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="transform:rotate(180deg)">
                <table class="table align-items-center mb-0" style="transform:rotate(-180deg)">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        العميل
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        العنوان
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        الحالة
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        التاريخ
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        طريقة الدفع
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        الصافي
                      </th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($options["Orders"] as $order) {
                    ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $order["CustomerName"]; ?></h6>
                              <p class="text-xs text-secondary mb-0">
                                <?php echo $order["CustomerEmail"]; ?>
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="text-end" dir="ltr">
                          <p class="text-xs font-weight-bold mb-0"><?php echo $order["Address"]; ?></p>
                          <p class="text-xs text-secondary mb-0">
                            <?php echo $order["Governorate"]; ?>, <?php echo $order["Country"]; ?>
                          </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-secondary /*bg-gradient-success*/"
                            style="background-image:<?php
                                                    $color = '';
                                                    if ($order["Status"] == "proceeded") {
                                                      $color = 'linear-gradient(310deg, rgb(0 110 0) 0%, rgb(0 155 0) 100%)';
                                                    } else if ($order["Status"] == "not proceeded") {
                                                      $color = 'linear-gradient(310deg, rgb(100 0 0) 0%, rgb(155 0 0) 100%)';
                                                    } else if ($order["Status"] == "cancelled") {
                                                      $color = 'linear-gradient(310deg, rgb(218 221 41) 0%, rgb(159 139 21) 100%)';
                                                    }
                                                    echo $color;
                                                    ?>"><?php echo $order["Status"]; ?></span>
                          <?php if ($order["Status"] == "cancelled") { ?>
                            <button class="return-order btn text-light mx-auto d-block px-3 mt-2" data-order-id="<?= $order['ID'] ?>" style="background-color: #3F51B5; padding-top: .2rem; padding-bottom: .2rem; font-weight:bold;">RETURN</button>
                          <?php } ?>
                          <?php if ($order["Status"] == "proceeded" && !$order['IsCashbackEarned']) {
                          ?>
                            <button class="confirm-cashback btn btn-success" data-id="<?php echo $order['ID'] ?>" style="border:none; display:block; background-image:linear-gradient(134deg, rgb(0 110 0) 0%, rgb(0 155 0) 100%); color:#ffffff; padding:5px 10px; border-radius:6px; font-weight:bold; margin:.5rem auto;"><i style="color:#ffffff;" class="fa-solid fa-paper-plane"></i> Cash Back</button>
                            <div class="btn btn-secondary d-block d-none" style="letter-spacing:1px; max-height:35px; margin:10px; padding:4px 8px;">loading</div>
                          <?php
                          }
                          ?>
                        </td>
                        <td class="align-middle text-center" dir="ltr">
                          <span class="text-secondary text-xs font-weight-bold">
                            <?php echo $order["Date"]; ?>
                          </span>
                        </td>
                        <td class="align-middle text-center">
                          <?php if ($order["PaymentMethod"] == "cod"): ?>
                            <img class="table-payment-method" src="/assets/icons/cod.png">
                          <?php elseif ($order["PaymentMethod"] == "payatfawry"): ?>
                            <img class="table-payment-method" src="/assets/img/brand/fawrypay-logo.png">
                          <?php elseif ($order["PaymentMethod"] == "card"): ?>
                            <?php $card = "meeza-logo.svg";
                            // $abro->getCardType($abro->decryptCardNumber($order["CardNumber"]))
                            if ($abro->getCardType($order["CardNumber"]) == "mastercard") {
                              $card = "mastercard-logo.svg";
                            } else if ($abro->getCardType($order["CardNumber"]) == "visa") {
                              $card = "visa-logo.svg";
                            } ?>
                            <img class="table-payment-method" src="/assets/img/brand/<?php echo $card; ?>">
                          <?php endif; ?>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">
                            <?php echo $order["Net"]; ?> ج.م
                          </span>
                        </td>
                        <td class="align-middle">
                          <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-id="<?php echo $order["ID"]; ?>" data-toggle="tooltip" data-original-title="View order">
                            <div class="view-order">
                              <i class="fa-solid fa-eye"></i>
                            </div>
                          </a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf("Win") > -1;
    if (win && document.querySelector("#sidenav-scrollbar")) {
      var options = {
        damping: "0.5",
      };
      Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="/assets/js/dashboard.min.js?v=1.0.8"></script>
</body>

</html>