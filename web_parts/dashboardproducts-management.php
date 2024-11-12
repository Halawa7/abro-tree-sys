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
    <script src="/assets/js/jquery.min.js"></script>
    <script type="module" src="/assets/js/dashboard-main.js?v=6.5"></script>
</head>

<body class="g-sidenav-show rtl bg-gray-100">
    <div
        class="notification <?php if (isset($options["notificationError"])): ?>error<?php endif; ?> <?php if (isset($options["notification"])): ?>show<?php endif; ?>">
        <div class="n-i"><i
                class="fa-solid <?php if (isset($options["notificationError"])): ?>fa-circle-xmark<?php else: ?>fa-circle-check<?php endif; ?>"></i>
        </div>
        <span><?php if (isset($options["notification"])) echo $options["notification"]; ?></span><i
            class="fa-solid fa-xmark"></i>
    </div>
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
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
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
                    <a class="nav-link active" href="<?php echo $abro->baseUrl; ?>dashboard/products-management/">
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
                            <a class="opacity-5 text-dark" href="<?php echo $abro->baseUrl; ?>dashboard/">لوحة
                                القيادة</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            إدارة المنتجات
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">إدارة المنتجات</h6>
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
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-1">الفئات</h6>
                            <p class="text-sm mb-0">يمكنك تعديل او اضافة او حذف اي فئة</p>
                        </div>
                        <div class="card-body p-3 pt-0">
                            <div class="row">
                                <?php
                                foreach ($options["Categories"] as $category) {
                                ?>
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 mt-4">
                                        <a href="<?php echo $abro->baseUrl; ?>dashboard/products-management/<?php echo $category["ID"]; ?>/"
                                            class="card card-blog card-plain">
                                            <div class="position-relative">
                                                <div class="d-block border-radius-xl">
                                                    <img src="<?php echo $abro->baseUrl; ?><?php echo $category["Cover"]; ?>"
                                                        alt="img-blur-shadow" class="img-fluid border-radius-xl" />
                                                </div>
                                                <div class="card-title m-0 text-center">
                                                    <h5><?php echo $category["Name"]; ?></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 mt-3">
                                    <div class="card h-100 card-plain border">
                                        <div class="card-body d-flex flex-column justify-content-center text-center">
                                            <a href="javascript:;" id="addCategoryBtn">
                                                <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                                                <h5 class="text-secondary">فئة جديد</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="clo-12">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-1">إدارة عامة</h6>
                            <p class="text-sm mb-0">يمكنك تعديل المنتجات جماعياً</p>
                        </div>
                        <div class="card-body p-3 pt-0">
                            <div class="row">
                                <div class="col-xl-3 col-md-3 mb-xl-0 mb-4 mt-3">
                                    <div class="card h-100 card-plain border">
                                        <div class="card-body d-flex flex-column justify-content-center text-center">
                                            <a href="javascript:;" id="productsManagement">
                                                <i class="fa-solid fa-list-check text-secondary mb-3 fs-4"
                                                    aria-hidden="true"></i>
                                                <h5 class="text-secondary">إدارة المنتجات</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 mb-xl-0 mb-4 mt-3">
                                    <div class="card h-100 card-plain border">
                                        <div class="card-body d-flex flex-column justify-content-center text-center">
                                            <a href="javascript:;" id="productsExcelManagement">
                                                <!-- <i class="fa-solid fa-list-check text-secondary mb-3 fs-4" aria-hidden="true"></i> -->
                                                <i class="fa fa-table text-secondary mb-3 fs-4" aria-hidden="true"></i>
                                                <h5 class="text-secondary">التعديل الفوري</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <!-- Add Promo Code Form -->
                    <div class="col-md-6" style="height:505px;">
                        <div class="card">
                            <div class="card-header">
                                <h4 style="font-weight: 900;font-size: 20px;">إضافة Promocode</h4>
                            </div>
                            <div class="card-body" style="margin-top: -35px;">
                                <form method="POST" action="/Requests/">
                                    <div class="mb-3">
                                        <label for="promoCode" class="form-label">Promo Code</label>
                                        <input type="text" class="form-control" id="promoCode" name="promoCode"
                                            placeholder="Enter Promo Code" required style="cursor: text">
                                    </div>

                                    <div class="mb-3">
                                        <label for="discountPercent" class="form-label">نسبة الخصم</label>
                                        <input type="number" class="form-control" id="discountPercent"
                                            name="discountPercent" placeholder="Enter Discount %" required
                                            style="cursor: text">
                                    </div>

                                    <div class="mb-3">
                                        <label for="expiresDate" class="form-label">تاريخ انتهاء الصلاحية</label>
                                        <input type="date" class="form-control" id="expiresDate" name="expiresDate"
                                            required style="cursor: pointer">
                                    </div>

                                    <div class="mb-3">
                                        <label for="freeShipping" class="form-label" style="cursor: pointer">شحن
                                            مجاني</label>
                                        <input type="checkbox" id="freeShipping" name="freeShipping" value="1"
                                            style="cursor: pointer">
                                    </div>

                                    <button type="submit" name="addPromoCode" class="btn btn-primary">Add Promo
                                        Code</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="height: 467px; overflow-y: auto; scrollbar-width: none;">
                            <div class="card-header">
                                <h3 style="text-align: center; font-size: 20px; margin: 10px 0;font-weight: 900;">إلغاء
                                    تفعيل ال
                                    Promocodes</h3>
                            </div>
                            <div class="card-body" style="padding: 0;">
                                <table class="table table-bordered table-sm"
                                    style="width: 100%; margin: 0; border-top:1px solid #e3e6e8;">
                                    <thead>
                                        <tr style="text-align: center; font-size: 14px;">
                                            <th style="width: 40%;font-weight: 600;color: black;">Promo Code</th>
                                            <th style="width: 30%;font-weight: 600;color: black;">نسبة الخصم</th>
                                            <th style="width: 30%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $promoCodes = $abro->getAllPromoCodes();
                                        foreach ($promoCodes as $promo) {
                                            echo '<tr style="background-color: #e3e6e8;">';
                                            echo '<td style="padding: 8px; text-align: center; vertical-align: middle; font-size: 14px;font-weight: 600; color: #999ea1;">' . htmlspecialchars($promo['PromoCode']) . '</td>';
                                            echo '<td style="padding: 8px; text-align: center; vertical-align: middle; font-size: 14px;font-weight: 600;color: black;">' . htmlspecialchars($promo['DiscountPercent']) . '%</td>';
                                            echo '<td style="padding: 8px; text-align: center; vertical-align: middle;">';
                                            echo '<form method="POST" action="/Requests/" style="margin: 0;">';
                                            echo '<input type="hidden" name="promoId" value="' . htmlspecialchars($promo['ID']) . '">';
                                            echo '<button type="submit" name="deletePromoCode" style="margin: 0.5rem;" class="btn btn-danger btn-sm">إلغاء تفعيل</button>';
                                            echo '</form>';
                                            echo '</td>';
                                            echo '</tr>';
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

        </div>

    </main>
    <!-- edit by excel popup -->
    <div class="popup" id="edit-by-excel-popup" style="visibility:hidden;">
        <form class="excel-form" action="updateExcelProducts" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <label for="excelSheet">برجاء رفع ملف Excel يتضمن ال SKU</label>
                <div class="select-file">
                    <input type="file" name="excelSheet" class="file-input"
                        accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        required />
                    <button type="button" class="file-btn"><i class="fa-solid fa-cloud-arrow-up"></i> اختيار
                        ملف</button>
                    <span class="file-text">لم تقم باختيار ملف.</span>
                </div>
            </div>
            <div class="btn-container">
                <button type="submit" name="updateExcelProducts"> <i class="fa-solid fa-floppy-disk"></i> تعديل</button>
            </div>
        </form>
    </div>
    <!--  -->
    <div class="popup" style="visibility:hidden;">
        <form class="categoryForm" action="addCategory" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <label for="name">اسم الفئة</label>
                <input type="text" name="name" id="name" placeholder="الاسم"
                    value="<?php if (isset($options["POST"]["name"])) echo $options["POST"]["name"]; ?>" required>
            </div>
            <div class="input-container">
                <label for="nameEn">اسم الفئة باللغة الأنجليزية</label>
                <input type="text" name="nameEn" id="nameEn" placeholder="الاسم باللغة الأنجليزية"
                    value="<?php if (isset($options["POST"]["nameEn"])) echo $options["POST"]["nameEn"]; ?>" required>
            </div>
            <div class="input-container">
                <label for="icon">أيقونة</label>
                <div class="select-file">
                    <input type="file" name="icon" class="file-input" accept="image/*" required />
                    <button type="button" class="file-btn"><i class="fa-solid fa-cloud-arrow-up"></i> اختيار
                        ملف</button>
                    <span class="file-text">لم تقم باختيار ملف.</span>
                </div>
            </div>
            <div class="input-container">
                <label for="coverPhoto">صورة الغلاف</label>
                <div class="select-file">
                    <input type="file" name="coverPhoto" class="file-input" accept="image/*" required />
                    <button type="button" class="file-btn"><i class="fa-solid fa-cloud-arrow-up"></i> اختيار
                        ملف</button>
                    <span class="file-text">لم تقم باختيار ملف.</span>
                </div>
            </div>
            <div class="textarea-container">
                <label for="desc">وصف البرنامج</label>
                <textarea name="desc" rows="4" placeholder="الوصف"
                    required><?php if (isset($options["POST"]["desc"])) echo $options["POST"]["desc"]; ?></textarea>
            </div>
            <div class="btn-container">
                <button type="submit" name="addCategory"><i class="fa-solid fa-circle-plus"></i> إضافة</button>
            </div>
        </form>
    </div>
    <div class="popup" style="visibility:hidden;">
        <form class="productsManagement" action="productsManagement" method="post">
            <?php
            $currentCategory = "";

            $products = $abro->getAllProducts("universal");
            foreach ($products as $i => $product) {
                // echo $product['Stock'];
                if ($currentCategory != $product["CategoryName"]) {
            ?>
                    <div class="input-container product-name<?php if ($i > 0): ?> mt-5<?php endif; ?>">
                        <label><?php echo $product["CategoryName"]; ?></label>
                        <input type="text" value="<?php echo $product["Name"]; ?>" disabled>
                    </div>
                    <div class="input-container<?php if ($i > 0): ?> mt-5<?php endif; ?>">
                        <label>سعر المنتج</label>
                        <input type="text" name="price" value="<?php echo $product["Price"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                    <div class="input-container<?php if ($i > 0): ?> mt-5<?php endif; ?>">
                        <label>وزن المنتج بالكيلو</label>
                        <input type="text" name="weight" value="<?php echo $product["Weight"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                    <div class="input-container<?php if ($i > 0): ?> mt-5<?php endif; ?>">
                        <label>الكمية</label>
                        <input type="text" name="stock" value="<?php echo $product["Stock"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                    <div class="input-container<?php if ($i > 0): ?> mt-5<?php endif; ?>">
                        <label>SKU</label>
                        <input type="text" name="sku" value="<?php echo $product["SKU"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                <?php
                    $currentCategory = $product["CategoryName"];
                } else {
                ?>
                    <div class="input-container product-name">
                        <input type="text" value="<?php echo $product["Name"]; ?>" disabled>
                    </div>
                    <div class="input-container">
                        <input type="text" name="price" value="<?php echo $product["Price"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                    <div class="input-container">
                        <input type="text" name="weight" value="<?php echo $product["Weight"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                    <div class="input-container">
                        <input type="text" name="stock" value="<?php echo $product["Stock"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
                    <div class="input-container">
                        <input type="text" name="sku" value="<?php echo $product["SKU"]; ?>"
                            data-id="<?php echo $product["ID"]; ?>">
                    </div>
            <?php
                }
            }
            ?>
            <div class="btn-container">
                <button type="submit" name="saveProductsManagement"><i class="fa-solid fa-floppy-disk"></i> حفظ</button>
            </div>
        </form>
    </div>
    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $(document).on('click', '#productsExcelManagement', (e) => {
                $('#edit-by-excel-popup').css('visibility', 'visible');
            });
        });
    </script>
    <script>
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
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6,
                    },
                    {
                        label: "Websites",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
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
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="/assets/js/dashboard.min.js?v=1.0.7"></script>
</body>

</html>