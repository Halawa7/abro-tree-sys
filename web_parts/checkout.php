<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABRO® - Checkout</title>
    <link rel="shortcut icon" href="<?php echo $abro->baseUrl; ?>assets/icons/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300;400;600&family=Rock+Salt&family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $abro->baseUrl; ?>assets/css/swiper-bundle.min.css" />
    <script src="<?php echo $abro->baseUrl; ?>assets/js/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $abro->baseUrl; ?>assets/css/style.css?v=44" />
    <script src="<?php echo $abro->baseUrl; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.4.2/libphonenumber-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js"></script>
    <script id="mainScript" type="module" src="<?php echo $abro->baseUrl; ?>assets/js/main.js?v=39.5" weburl="<?php echo $abro->baseUrl; ?>"></script>
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
    <!-- temp 10% offer -->
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
        <div class="offer-bar" style="position: fixed; z-index: 2;">
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
    <div class="side-alert">
        <div class="s-a"><i class="fa-solid fa-circle-xmark"></i></div><span></span><i class="fa-solid fa-xmark close-btn"></i>
    </div>
    <main class="scroll">
        <div class="checkout-container">
            <div class="c-l-c">
                <a href="<?php echo $abro->baseUrl; ?>" class="logo">
                    <img src="<?php echo $abro->baseUrl; ?>assets/img/header-logo.png?v=5" alt="ABRO®">
                </a>
            </div>
            <div class="order-summary-control">
                <div class="o-s-c-c">
                    <div class="summary-ctrl-btn">
                        <img src="<?php echo $abro->baseUrl; ?>assets/icons/dark-cart.png">
                        <span class="ml-2 mr-2">Show order summary</span>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <span class="total">LE -</span>
                </div>
            </div>
            <div class="user-info" data-isLoggedIn="<?php echo ($abro->account !== null); ?>" <?php if ($abro->account !== null && !$abro->dbGet('orders', array('CustomerID' => $abro->account->ID))) : ?> data-offer="firstOrder" <?php endif; ?>>
                <form class="u-i-c">
                    <a href="<?php echo $abro->baseUrl; ?>" class="logo">
                        <img src="<?php echo $abro->baseUrl; ?>assets/img/header-logo.png?v=5" alt="ABRO®">
                    </a>
                    <div class="breadcrumb">
                        <a>Cart</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span class="active">Information</span>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Shipping</span>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Payment</span>
                    </div>
                    <div class="i-t">
                        <h3>Contact information</h3>
                        <span>
                            <?php if ($abro->account !== null) : ?>Another email address? <a href="<?php echo $abro->baseUrl; ?>logout/checkout/">Log out</a>
                            <?php else : ?>Already have an account? <a href="<?php echo $abro->baseUrl; ?>login/">Log in</a>
                        <?php endif; ?>
                        </span>
                    </div>
                    <div class="input-box">
                        <!-- <label class="input-label">Email address</label> -->
                        <input placeholder="Email address" type="<?php echo ($abro->account !== null ? "text" : "email"); ?>" name="email" class="input" <?php if ($abro->account !== null) : ?>value="<?php echo $abro->account->info->FirstName; ?> <?php echo $abro->account->info->LastName; ?> (<?php echo $abro->account->info->Email; ?>)" data-email="<?php echo $abro->account->info->Email; ?>" disabled<?php else : ?>value="" required<?php endif; ?> />
                    </div>
                    <div class="i-t">
                        <h3>Shipping address</h3>
                    </div>
                    <div class="input-box">
                        <!-- <label class="input-label">Country/Region</label> -->
                        <input type="text" placeholder="Country/Region" class="input" name="country" value="Egypt" disabled />
                    </div>
                    <div class="i-b-c">
                        <div class="input-box half-width m-0">
                            <!-- <label class="input-label">First name</label> -->
                            <input type="text" name="firstName" placeholder="First name" value="<?php echo isset($abro->account->defaultAddress->FirstName) ? $abro->account->defaultAddress->FirstName : ""; ?>" class="input" required />
                        </div>
                        <div class="input-box half-width m-0 mt-3">
                            <!-- <label class="input-label">Last name</label> -->
                            <input placeholder="Last name" type="text" name="lastName" value="<?php echo isset($abro->account->defaultAddress->LastName) ? $abro->account->defaultAddress->LastName : ""; ?>" class="input" required />
                        </div>
                    </div>
                    <div class="input-box">
                        <!-- <label class="input-label">Company (optional)</label> -->
                        <input type="text" placeholder="Company (optional)" name="company" value="<?php echo isset($abro->account->defaultAddress->Company) ? $abro->account->defaultAddress->Company : ""; ?>" class="input" />
                    </div>
                    <div class="input-box m-0">
                        <!-- <label class="input-label">Address</label> -->
                        <input type="text" name="address" placeholder="Address" value="<?php echo isset($abro->account->defaultAddress->Address) ? $abro->account->defaultAddress->Address : ""; ?>" class="input" required />
                    </div>
                    <div class="input-box">
                        <!-- <label class="input-label">Apartment, suite, etc. (optional)</label> -->
                        <input type="text" placeholder="Apartment, suite, etc. (optional)" name="extraAddress" value="<?php echo isset($abro->account->defaultAddress->ExtraAddress) ? $abro->account->defaultAddress->ExtraAddress : ""; ?>" class="input" />
                    </div>
                    <div class="i-b-c">
                        <div class="input-box third-width m-0">
                            <!-- <label class="input-label">Area</label> -->
                            <input type="text" name="area" placeholder="Area" value="<?php echo isset($abro->account->defaultAddress->Area) ? $abro->account->defaultAddress->Area : ""; ?>" class="input" required />
                        </div>
                        <div class="input-box third-width m-0 my-3">
                            <!-- <label class="input-label">Governorate</label> -->
                            <select class="input" id="goveronate-select" placeholder="Governorate" name="governorate" value="<?php echo isset($abro->account->defaultAddress->Governorate) ? $abro->account->defaultAddress->Governorate : ""; ?>" required>
                                <!-- <option value="" hidden></option> -->
                            </select>
                            <div class="arrow"><i class="fa-solid fa-caret-down"></i></div>
                        </div>
                        <div class="input-box third-width m-0">
                            <!-- <label class="input-label">Postal code</label> -->
                            <input type="text" placeholder="Postal code" name="postalCode" value="<?php echo isset($abro->account->defaultAddress->PostalCode) ? $abro->account->defaultAddress->PostalCode : ""; ?>" class="input" required />
                        </div>
                    </div>
                    <div class="input-box">
                        <!-- <label class="input-label">Phone number</label> -->
                        <input type="text" pattern="^[0][0-9]{3}[ ][0-9]{3}[ ][0-9]{4}$" title="Enter a Valid Phone Number(0123)" placeholder="Phone number" name="phoneNumber" value="<?php echo isset($abro->account->defaultAddress->PhoneNumber) ? $abro->account->defaultAddress->PhoneNumber : ""; ?>" class="input" required />
                    </div>
                    <label class="checkbox-container">
                        <span>Save this information for next time</span>
                        <input type="checkbox">
                        <span class="checkmark"><i class="fa-solid fa-check"></i></span>
                    </label>
                    <div class="btn-container checkout-form-btn-container">
                        <button class="no-select" type="submit"><span>Continue to shipping</span> <i class="fa-solid fa-circle-right"></i></button>
                        <button class="no-select return-to-shopping-btn"><i class="fa-solid fa-circle-left"></i> <span>Return to Shopping</span></button>
                    </div>
                </form>
            </div>
            <div class="cart-info">
                <div class="c-i-c">
                    <div class="cart-contents checkout-products"></div>
                    <div class="promo-offer d-none"><span class="promo-info"></span><button id="cancel-promocode"><span>x</span></button></div>
                    <form class="cart-contents flex-row promo-code" method="post">
                        <div class="input-box w-auto flex-grow-1 m-0">
                            <input type="text" placeholder="Promo code (optional)" class="input text-uppercase" value="" required />
                        </div>
                        <button type="submit" name="promoCode">Apply</button>
                    </form>
                    <?php if ($abro->account != null && $abro->account->ID) {
                    ?>
                        <form id='cashback-form' class="cart-contents flex-column" method="post" style="user-select: none;">
                            <div style="width:100%">
                                <h6 style="color: #06529a; margin-bottom:1rem; width:100%; display:flex;">Add CashBack Discount <span style="color:#071833; font-weight:500; margin-inline-start:auto;">Cash Left: <span id="cashback-left" style="font-size:19px; color:#06529a"></span></span></h6>
                                <label style="cursor:pointer; display:block;" id="cashback-discount-0">
                                    <input checked type="radio" name="cashbackDiscount" value="0">
                                    0% Discount <span style="color:#06529a; opacity:.8; margin-inline-start:10px; font-size:13px">Minimun 10%</span>
                                    <br>
                                </label>
                                <label class="d-none" style="cursor:pointer; display:block;" id="cashback-discount-10">
                                    <input type="radio" name="cashbackDiscount" value="10">
                                    10% Discount
                                    <br>
                                </label>
                                <label class="d-none" style="cursor:pointer; display:block;" id="cashback-discount-25">
                                    <input type="radio" name="cashbackDiscount" value="25">
                                    25% Discount
                                    <br>
                                </label>
                                <label class="d-none" style="cursor:pointer; display:block;" id="cashback-discount-50">
                                    <input type="radio" name="cashbackDiscount" value="50">
                                    50% Discount
                                    <br>
                                </label>
                            </div>
                            <button name="cashback" style="max-width:50%; padding:.75rem 2.5rem; margin:0 auto;" type="submit" name="cashback">Apply</button>
                        </form>
                    <?php
                    }
                    ?>
                    <div class="cart-contents">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span class="s-t">Subtotal</span>
                            <span class="s-t subtotal">LE -</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between w-100 mt-2">
                            <span class="s-t">Shipping fees</span>
                            <span class="s-t shipping small">Calculated at next step</span>
                        </div>
                    </div>
                    <div class="cart-contents border-0 pb-0 d-none">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span class="c-t">Before Discount</span>
                            <span class="c-t big">
                                EGP
                                <span class="old-total" style="text-decoration:line-through">LE </span>
                            </span>
                        </div>
                    </div>
                    <div class="cart-contents border-0 pb-0">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span class="c-t">Total</span>
                            <span class="c-t big">
                                EGP
                                <span class="total">LE -</span>
                            </span>
                        </div>
                    </div>
                    <?php if ($abro->account && $abro->account->ID) {
                    ?>
                        <div class="cart-contents border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <span class="c-b">Earned CashBack $</span>
                                <span class="c-b big">
                                    EGP
                                    <span class="cashback">LE -</span>
                                </span>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if (!$abro->account) {
                ?>
                    <div class="cashback-sale">
                        <h1 class="headline">cashback</h1>
                        <div class="body">
                            <div class="text">
                                Register Now & get 5% of Your Order Back
                                <div><a href="/register">REGISTER</a></div>
                            </div>
                            <div class="image">
                                <img src="/assets/img/cashback.webp" alt="cashback">
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>