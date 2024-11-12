<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
    <title>TREE Dashboard</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Kufi+Arabic" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/dashboard.css?v=2.2" rel="stylesheet" />
    <!-- JQuery -->
    <script src="<?php echo $abro->baseUrl; ?>assets/js/jquery.min.js"></script>
    <!-- date picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>

<body class="g-sidenav-show rtl bg-gray-100">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://www.treeegypt.com" target="_blank">
                <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo" />
                <span class="me-1 font-weight-bold">TREE Dashboard</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0" />
        <div class="collapse navbar-collapse px-0 w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $abro->baseUrl; ?>dashboard/">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
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
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-bottle-droplet"></i>
                        </div>
                        <span class="nav-link-text me-1">إدارة المنتجات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $abro->baseUrl; ?>dashboard/orders-management/">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <span class="nav-link-text me-1">إدارة الطلبات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $abro->baseUrl; ?>logout/">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>spaceship</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(4.000000, 301.000000)">
                                                <path class="color-background"
                                                    d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z">
                                                </path>
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
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                        <li class="breadcrumb-item text-sm ps-2">
                            <a class="opacity-5 text-dark" href="javascript:;">لوحة القيادة</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            لوحة القيادة
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">لوحة القيادة</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
                    <ul class="navbar-nav me-auto ms-0 justify-content-end">
                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            إجمالي الزيارات
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo number_format($options["TotalVisits"][0]); ?>
                                            <span
                                                class="<?php echo ($options["TotalVisits"][1] < 0 ? "text-danger" : "text-success"); ?> text-sm font-weight-bolder"><?php echo ($options["TotalVisits"][1] < 0 ? "-" : "+"); ?><?php echo abs(intval($options["TotalVisits"][2])); ?>%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa-solid fa-eye text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            زيارات فريدة
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo number_format($options["UniqueVisits"][0]); ?>
                                            <span
                                                class="<?php echo ($options["UniqueVisits"][1] < 0 ? "text-danger" : "text-success"); ?> text-sm font-weight-bolder"><?php echo ($options["UniqueVisits"][1] < 0 ? "-" : "+"); ?><?php echo abs(intval($options["UniqueVisits"][2])); ?>%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa-solid fa-fingerprint text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            النقرات
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo number_format($options["Clicks"][0]); ?>
                                            <span
                                                class="<?php echo ($options["Clicks"][1] < 0 ? "text-danger" : "text-success"); ?> text-sm font-weight-bolder"><?php echo ($options["Clicks"][1] < 0 ? "-" : "+"); ?><?php echo abs(intval($options["Clicks"][2])); ?>%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa-solid fa-computer-mouse text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            عدد الطلبات
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo number_format($options["Orders"][0]); ?>
                                            <span
                                                class="<?php echo ($options["Orders"][1] < 0 ? "text-danger" : "text-success"); ?> text-sm font-weight-bolder"><?php echo ($options["Orders"][1] < 0 ? "-" : "+"); ?><?php echo abs(intval($options["Orders"][2])); ?>%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-start">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa-solid fa-envelopes-bulk text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <?php if (true == false): ?>
                                <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                                    <div class="chart">
                                        <canvas id="chart-bars" class="chart-canvas" height="170px"></canvas>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <h6 class="ms-2<?php if (true == false): ?> mt-4<?php endif; ?> mb-0">بيانات المستخدمين</h6>
                            <p class="text-sm ms-2">
                                <?php if ($options["WeeklyTotalVisits"]): ?>
                                    (<span
                                        class="font-weight-bolder"><?php echo ($options["WeeklyTotalVisits"][1] < 0 ? "-" : "+"); ?><?php echo abs(intval($options["WeeklyTotalVisits"][2])); ?>%</span>)
                                    من الأسبوع الماضي
                                <?php else: ?>
                                    (<span
                                        class="font-weight-bolder"><?php echo ($options["TotalVisits"][1] < 0 ? "-" : "+"); ?><?php echo abs(intval($options["TotalVisits"][2])); ?>%</span>)
                                    من أمس
                                <?php endif; ?>
                            </p>
                            <div class="container border-radius-lg">
                                <div class="row">
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center ms-2 d-flex align-items-center justify-content-center">
                                                <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>document</title>
                                                    <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g id="Rounded-Icons"
                                                            transform="translate(-1870.000000, -591.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g id="Icons-with-opacity"
                                                                transform="translate(1716.000000, 291.000000)">
                                                                <g id="document"
                                                                    transform="translate(154.000000, 300.000000)">
                                                                    <path class="color-background"
                                                                        d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                        id="Path" opacity="0.603585379"></path>
                                                                    <path class="color-background"
                                                                        d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"
                                                                        id="Shape"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <p class="text-xs mt-1 mb-0 font-weight-bold">
                                                الزيارات
                                            </p>
                                        </div>
                                        <h4 class="font-weight-bolder">
                                            <?php echo ($options["WeeklyTotalVisits"] ? $abro->number_format_short($options["WeeklyTotalVisits"][0]) : $abro->number_format_short($options["TotalVisits"][0])); ?>
                                        </h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center ms-2 d-flex align-items-center justify-content-center">
                                                <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>spaceship</title>
                                                    <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g id="Rounded-Icons"
                                                            transform="translate(-1720.000000, -592.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g id="Icons-with-opacity"
                                                                transform="translate(1716.000000, 291.000000)">
                                                                <g id="spaceship"
                                                                    transform="translate(4.000000, 301.000000)">
                                                                    <path class="color-background"
                                                                        d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"
                                                                        id="Shape"></path>
                                                                    <path class="color-background"
                                                                        d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"
                                                                        id="Path"></path>
                                                                    <path class="color-background"
                                                                        d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"
                                                                        id="color-2" opacity="0.598539807"></path>
                                                                    <path class="color-background"
                                                                        d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"
                                                                        id="color-3" opacity="0.598539807"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <p class="text-xs mt-1 mb-0 font-weight-bold">نقرات</p>
                                        </div>
                                        <h4 class="font-weight-bolder">
                                            <?php echo ($options["WeeklyTotalVisits"] ? $abro->number_format_short($options["WeeklyClicks"]) : $abro->number_format_short($options["Clicks"][0])); ?>
                                        </h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center ms-2 d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-envelopes-bulk" aria-hidden="true"></i>
                                            </div>
                                            <p class="text-xs mt-1 mb-0 font-weight-bold">
                                                عدد الطلبات
                                            </p>
                                        </div>
                                        <h4 class="font-weight-bolder">
                                            <?php echo ($options["WeeklyTotalVisits"] ? $abro->number_format_short($options["WeeklyOrders"]) : $abro->number_format_short($options["Orders"][0])); ?>
                                        </h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-30" role="progressbar" aria-valuenow="30"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- تقرير الكميات المنتهية -->
                    <?php
                    $lowStockProducts = $abro->getLowStockOrders();
                    ?>
                    <div class="card col-12"
                        style="width: 100%; height:200px; margin-top:1rem; max-height: 280px; overflow-x: hidden; border-radius: 10px;scrollbar-width: none;">
                        <div class="card-header pb-0" style="padding: 5px;">
                            <h6 style="font-size: 19px; margin-right: 10px; margin-bottom: 0px; margin-top:1rem;">
                                تنبيهات المخزون المنخفض</h6>
                        </div>
                        <div class="card-body p-2 custom-scrollbar"
                            style="padding: 20px;overflow-y:scroll; scroll-behavior: smooth;">
                            <?php if (!empty($lowStockProducts)): ?>
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0" style="font-size: 10px;">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2"
                                                    style="font-size: 11px; width: 70%;">اسم المنتج</th>
                                                <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7"
                                                    style="font-size: 11px; width: 30%; padding:0.75rem 1rem;">كمية المخزون
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lowStockProducts as $product): ?>
                                                <tr>
                                                    <td
                                                        style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <p class="text-xs font-weight-bold mb-0" style="font-size: 10px;">
                                                            <?php echo htmlspecialchars($product['Name']); ?></p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="badge badge-sm <?php echo ($product['Stock'] <= 2) ? 'bg-danger' : 'bg-warning'; ?>"
                                                            style="font-size: 8px;">
                                                            <?php echo htmlspecialchars($product['Stock']); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-muted" style="font-size: 10px;">لا توجد منتجات بكمية منخفضة في
                                    المخزون.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <style>
                        .custom-scrollbar {
                            overflow-y: auto;
                            scrollbar-width: thin;
                            scrollbar-color: #6c757d transparent;
                        }

                        .custom-scrollbar::-webkit-scrollbar {
                            width: 8px;
                        }

                        .custom-scrollbar::-webkit-scrollbar-track {
                            background: transparent;
                        }

                        .custom-scrollbar::-webkit-scrollbar-thumb {
                            width: 10px;
                            background-color: #6c757d;
                            border-radius: 10px;
                        }

                        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                            background-color: #5a6268;
                            border-radius: 10px;
                        }
                    </style>
                    <?php
                    $highOrderedProducts = $abro->getHighOrderedProducts();
                    ?>
                    <div class="card mt-3 col-12"
                        style="width: 100%; height: 298px; overflow-x: hidden; border-radius: 10px; margin-top: 20px; box-shadow: 0 2px 8px rgb(0 0 0 / 13%);">
                        <div class="card-header pb-0" style="padding: 5px;">
                            <h6 style="font-size: 19px; margin-right: 10px; margin-bottom: 0px; margin-top:1rem;">
                                المنتجات الأكثر طلباً</h6>
                        </div>
                        <div class="card-body p-4 custom-scrollbar"
                            style="padding: 10px !important; overflow-y: scroll; overflow-x: hidden; scroll-behavior: smooth; background-color: #ffffff;">
                            <?php if (!empty($highOrderedProducts)): ?>
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0"
                                        style="font-size: 10px; white-space: normal;">
                                        <thead style="white-space: normal">
                                            <tr>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2"
                                                    style="font-size: 11px; width: 10%; white-space: normal;"></th>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2"
                                                    style="font-size: 11px; width: 65%; white-space: normal;">اسم المنتج
                                                </th>
                                                <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7"
                                                    style="font-size: 11px; width: 25%; padding: 0.75rem 1rem; white-space: normal;">
                                                    الكميات المطلوبة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($highOrderedProducts as $index => $product): ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <?php echo ($index + 1); ?>
                                                    </td>
                                                    <td
                                                        style="max-width: 150px;text-align: end; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; direction: ltr;">
                                                        <p class="text-xs font-weight-bold mb-0" style="font-size: 10px;">
                                                            <?php echo htmlspecialchars($product['Name']); ?>
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="badge badge-sm bg-info" style="font-size: 8px;">
                                                            <?php echo htmlspecialchars($product['totalOrdered']); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-muted" style="font-size: 10px;">لا توجد منتجات بكمية منخفضة في
                                    المخزون.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>نظرة عامة على الزيارات</h6>
                            <p class="text-sm">
                                <i
                                    class="fa <?php echo ($options["TotalVisits"][1] < 0 ? "fa-arrow-down text-danger" : "fa-arrow-up text-success"); ?>"></i>
                                <span class="font-weight-bold"><?php echo abs(intval($options["TotalVisits"][2])); ?>%
                                    <?php echo ($options["TotalVisits"][1] < 0 ? "أقل" : "أكثر"); ?></span> من أمس
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <?php
                        $card = 0;
                        $cod = 0;
                        $payatfawry = 0;

                        $allprice = $abro->getOrdersEarningsLast30Days();
                        foreach ($allprice as $row) {
                            if ($row["PaymentMethod"]  == "card") {
                                $card += $row["Net"];
                            } elseif ($row["PaymentMethod"]  == "cod") {
                                $cod += $row["Net"];
                            } else {
                                $payatfawry += $row["Net"];
                            }
                        }
                        ?>
                        <div class="card-body p-3 position-relative overflow-hidden">
                            <h6 class="ms-2 mb-1">التقرير المالي</h6>
                            <div class="mb-3">
                                <p class="text-sm ms-2 mb-0 mb-1">حساب تحصيلات اخر ثلاثين يوما بطرق الدفع المختلفة</p>
                                <div>
                                    من <span class="startDate" style="color:#0fafe2;"></span>
                                    الي <span class="endDate" style="color:#0fafe2;"></span>
                                </div>
                            </div>
                            <div class="done-btn" style="position: absolute;
                  top: 12%;
                  left: 19%;
                  width: 45px;
                  height: 45px;
                  border-radius: 50%;
                  border: 2px dotted;
                  background-color: rgb(130 214 44);
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  color: #ffffff;
                  transition: .35s;
                  opacity: 0;">تم
                            </div>
                            <div class="border-radius-lg">
                                <form id="date-range-form" method="post" action="">
                                    <div class="d-flex align-items-end">
                                        <div class="col pe-0  ms-3 text-right">
                                            <label for="startDate">تاريخ البدء:</label>
                                            <input type="text" class="form-control" id="startDate" name="start_date" placeholder="اختر تاريخ البدء" autocomplete="off" style="cursor: pointer;">
                                        </div>
                                        <div class="col ms-3 text-right">
                                            <label for="endDate">تاريخ الانتهاء:</label>
                                            <input type="text" class="form-control" id="endDate" name="end_date" placeholder="اختر تاريخ الانتهاء" autocomplete="off" style="cursor: pointer;">
                                        </div>
                                        <div class="col align-self-end">
                                            <button type="submit" class="btn btn-primary m-0">عرض الأرباح</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row data-container justify-content-center">
                                    <div class="col-3 pt-4 pb-1 ps-0 text-right">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center ms-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 20px;">
                                                <i class="fa-solid fa-truck" style="font-size: 12px;"></i>
                                            </div>
                                            <p class="mb-0 text-uppercase" style="color: #001d4e; font-weight: bold; font-size: 18px;">Cod</p>
                                        </div>
                                        <h6><?php echo number_format($cod,  2, ".", ','); ?> LE</h6>
                                    </div>
                                    <div class="col-3 pt-4 pb-1 ps-0 text-right">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon icon-shape icon-xxs shadow border-radius-sm  text-center ms-2" style="width: 50px; height: 20px; margin-top: -8px;">
                                                <img class="img-fluid" src="<?php echo $abro->baseUrl; ?>assets/img/brand/fawrypay-logo.png" alt="fawrypay" />
                                            </div>
                                            <p class="mb-0" style="color: #001d4e; font-weight: bold; font-size: 18px;">Fawry</p>
                                        </div>
                                        <h6><?php echo number_format($payatfawry,   2, ".", ','); ?> LE</h6>
                                    </div>
                                    <div class="col-3 pt-4 pb-1 ps-0 text-right">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center ms-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 20px;">
                                                <i class="fa-solid fa-credit-card" style="font-size: 12px;"></i>
                                            </div>
                                            <p class="mb-0" style="color: #001d4e; font-weight: bold; font-size: 18px;">Card</p>
                                        </div>
                                        <h6><?php echo number_format($card, 2,  '.', ','); ?> LE</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid pb-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary" style="color: white; padding-bottom: 0;">
                        <h6 class="mb-0" style="color: white; display: inline;">العملاء المميزون</h6>
                        <small style="font-size: x-small;">(افضل عشرة عملاء)</small>
                        <div class="row text-sm ">
                            <div class="col-4 py-3 ps-0">
                                <i class="fas fa-user" style="color: #ff5733;" aria-hidden="true"></i>
                                العميل
                            </div>
                            <div class="col-2 py-3 ps-0 text-center">
                                <i class="fas fa-map-marker-alt" style="color: #9E9E9E;" aria-hidden="true"></i>
                                المنطقة
                            </div>
                            <div class="col-2 py-3 ps-0 text-center">
                                <i class="fa-solid fa-envelopes-bulk" style="color: #8BC34A;" aria-hidden="true"></i>
                                عدد الطلبات
                            </div>
                            <div class="col-2 py-3 ps-0 text-center">
                                <i class="fas fa-calendar-alt" style="color: var(--bs-green);" aria-hidden="true"></i>
                                تاريخ آخر طلب
                            </div>
                            <div class="col-2 py-3 ps-0 text-center">
                                <i class="fas fa-coins" style="color: var(--bs-yellow);" aria-hidden="true"></i>
                                اجمالي التكلفة
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-top: 0;">
                        <?php
                        $customers = $abro->getOrderingCustomers(10);
                        $users = $abro->formatOrderDate($customers);

                        foreach ($users as $value) {
                        ?>
                            <div class="row border-bottom align-items-center">
                                <div class="col-4 py-3 ps-0">
                                    <div class="fw-bold" style="display: inline;">
                                        <?php echo $value["FirstName"] . " " . $value["LastName"]; ?>
                                    </div>
                                    <?php if ($value["HasAccount"]) { ?>
                                        <i class="fas fa-check-circle" style="color: blue;"></i>
                                        <small style="color: blue; font-size: small;">- مُسجل</small>
                                    <?php } ?>
                                    <div class="text-muted"><?php echo $value["PhoneNumber"]; ?></div>
                                    <div class="text-muted"><?php echo $value["Email"]; ?></div>
                                </div>
                                <div class="col-2 py-3 ps-0 text-center">
                                    <div class="badge text-white" style="background-color: #607D8B;"><?php echo $value["Governorate"] . ", " . $value["Area"] ?></div>
                                </div>
                                <div class="col-2 py-3 ps-0 text-center">
                                    <div class="badge text-white" style="background-color: #28a745;"><?php echo $value["TotalOrders"]; ?></div>
                                </div>
                                <div class="col-2 py-3 ps-0 text-center">
                                    <div class="badge text-white" style="background-color: #17a2b8;"><?php echo $value["LastOrderDisplay"] ?></div>
                                </div>
                                <div class="col-2 py-3 ps-0 text-center">
                                    <div class="badge text-white" style="background-color: #F44336;"><?php echo $value["TotalSpent"]; ?> جنيه</div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                        <form method="POST" action="" target="blank">
                            <div class="text-center">
                                <button type="submit" name="download-all-clients" class="btn text-white mt-3 w-50 h6" style="transition: background-color 0.3s; background-color: #28a745;">تحميل بيانات العملاء<i class="fas fa-table me-2"></i><i class="fas fa-table me-2" style="margin: 0 !important; margin-right: -2px !important;"></i></button>
                            </div>
                        </form>
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
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <script>
        <?php if (true == false): ?>
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                        maxBarThickness: 6,
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    interaction: {
                        intersect: false,
                        mode: "index",
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                                color: "#fff",
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                display: false,
                            },
                        },
                    },
                },
            });
        <?php endif; ?>

        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
        gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
        gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, "rgba(20,23,39,0.2)");
        gradientStroke2.addColorStop(0.2, "rgba(72,72,176,0.0)");
        gradientStroke2.addColorStop(0, "rgba(20,23,39,0)"); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: <?php echo $options["chartLineLabel"]; ?>,
                datasets: [{
                        label: "إجمالي الزيارات",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: <?php echo $options["chartLineTotalVisits"]; ?>,
                        maxBarThickness: 6,
                    },
                    {
                        label: "الزيارات الفريدة",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: <?php echo $options["chartLineUniqueVisits"]; ?>,
                        maxBarThickness: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: "#b2b9bf",
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: "normal",
                                lineHeight: 2,
                            },
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5],
                        },
                        ticks: {
                            display: true,
                            color: "#b2b9bf",
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: "normal",
                                lineHeight: 2,
                            },
                        },
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf("Win") > -1;
        if (win && document.querySelector("#sidenav-scrollbar")) {
            var options = {
                damping: "0.5",
            };
            Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
        }
    </script>
    <script>
        $(document).ready(function() {


            let baseUrl = "<?php echo $abro->baseUrl; ?>"

            const today = new Date();
            const thirtyDaysAgo = new Date();
            thirtyDaysAgo.setDate(today.getDate() - 31);

            const formattedToday = today.toISOString().split('T')[0];
            const formattedThirtyDaysAgo = thirtyDaysAgo.toISOString().split('T')[0];
            $('#startDate').val(formattedThirtyDaysAgo);
            $('#endDate').val(formattedToday);
            $('.startDate').text(`(${formattedThirtyDaysAgo})`);
            $('.endDate').text(`(${formattedToday})`);

            $(document).on('change', '#startDate', function() {
                var startDate = new Date($(this).val());
                let formattedDay = startDate.toISOString().split('T')[0];
                $('#endDate').attr('min', formattedDay);
                var endDate = new Date($('#endDate').val());
                $('.startDate').text(`(${formattedDay})`);
                if (endDate < startDate) {
                    $('#endDate').val(formattedDay);
                    $('.endDate').text(`(${formattedDay})`);
                    setTimeout(function() {
                        $('#endDate').datepicker('setDate', formattedDay);
                        $('#endDate').datepicker('show');
                    }, 0);
                }

            });

            $(document).on('change', '#endDate', function() {
                var endDate = new Date($(this).val());
                formattedDay = endDate.toISOString().split('T')[0]
                $('.endDate').text(`(${formattedDay})`);
            });

            $('#startDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,

                endDate: formattedToday
            }).on('changeDate', function(e) {
                $('#endDate').datepicker('setStartDate', e.date);
            });

            $('#endDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                endDate: formattedToday
            });
            $('#date-range-form').on('submit', function(event) {
                event.preventDefault();

                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                $(".done-btn").css({
                    "opacity": "1",
                    "transition": ".4s linear"
                });
                setTimeout(function() {
                    $(".done-btn").css({
                        "opacity": "0",
                    });
                }, 1850);
                $.ajax({
                    type: 'POST',
                    url: '/date-range',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.success) {
                            $('.data-container').html(`
                  <div class="col-3 py-3 ps-0">
                      <div class="d-flex align-items-center mb-2">
                        <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center ms-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 20px;">
                        <i class="fa-solid fa-truck" style="font-size: 12px;"></i>
                        </div>
                        <p class="mb-0 text-uppercase" style="color: #001d4e; font-weight: bold; font-size: 18px;">Cod</p>
                      </div>
                      <h6>${response.data.cod} LE</h6>
                    </div>
                    <div class="col-3 py-3 ps-0">
                      <div class="d-flex align-items-center mb-2">
                        <div class="icon icon-shape icon-xxs shadow border-radius-sm  text-center ms-2" style="width: 50px; height: 20px;">
                        <img class="img-fluid"  src="${baseUrl}assets/img/brand/fawrypay-logo.png" alt="fawrypay" />
                        </div>
                        <p class="mb-0" style="color: #001d4e; font-weight: bold; font-size: 18px;">Fawry</p>
                      </div>
                      <h6>${response.data.fawry} LE</h6>
                    </div>
                    <div class="col-3 py-3 ps-0">
                      <div class="d-flex align-items-center mb-2">
                        <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center ms-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 20px;">
                        <i class="fa-solid fa-credit-card" style="font-size: 12px;"></i>
                        </div>
                        <p class="mb-0" style="color: #001d4e; font-weight: bold; font-size: 18px;">Card</p>
                      </div>
                      <h6>${response.data.card} LE</h6>
                    </div>
            `);
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        })
    </script>
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="/assets/js/dashboard.min.js?v=1.0.7"></script>
</body>

</html>