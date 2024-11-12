<?php

// use Orhanerday\OpenAi\OpenAi;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

class Routes
{


    static function handle($abro, $sysPath, $baseUrl, $publicPath, $mainPath)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["saveClick"])) {
                $abro->clicksHandle();
            } elseif (isset($_POST["selected-products"]) && isset($_POST["group-name"])) {
                $selectedProducts = explode("|", $_POST["selected-products"]);
                $GroupName = $_POST["group-name"];
                foreach ($selectedProducts as $productData) {
                    $productInfo = explode(',', $productData);
                    list($GroupID, $productID, $size) = $productInfo;
                    if (!empty($GroupName) && !empty($productID) && !empty($size)) {
                        $abro->addProductSize($GroupID, $productID, $size, $GroupName);
                    }
                }
                $url = substr($_SERVER["REQUEST_URI"], 1);
                $url = str_replace("/", "", $url);
                $url = str_replace("dashboardproducts-management", "", $url);
                $categoryID = intval($url);
                $_SESSION['notification'] = 'تم اضافة الحجم بنجاح';
                header(header: "Location: " . $baseUrl . "dashboard/products-management/$categoryID/");
                exit;
            } elseif ($_SERVER["REQUEST_URI"] == "/view-group-products") {
                if (isset($_POST["categoryID"]) && isset($_POST["GroupID"])) {
                    $categoryID = $_POST["categoryID"];
                    $GroupID = $_POST["GroupID"];
                    $products = $abro->getAllProductSizeGroups($categoryID, $GroupID);
                    header('Content-Type: application/json');
                    if ($products) {
                        echo json_encode([
                            "success" => true,
                            "data" => $products
                        ]);
                    } else {
                        echo json_encode([
                            "success" => false,
                            "message" => "لم يتم العثور على منتجات"
                        ]);
                    }
                    exit;
                } else {
                    echo json_encode([
                        "success" => false,
                        "message" => "لم يتم العثور على منتجات"
                    ]);
                    exit;
                }
            } elseif ($_SERVER["REQUEST_URI"] == "/update-products-size") {
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);
                if (isset($data['update'])) {
                    $GroupName = $data['groupName'];
                    $GroupID = $data['groupId'];
                    $products = $data['update'];
                    $abro->updateProductsSizes($GroupID, $products, $GroupName);
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "لم يتم إرسال البيانات"]);
                }
            } elseif (isset($_POST["selected-products-color"]) && isset($_POST["color-group-name"])) {
                $selectedProducts = explode("|", $_POST["selected-products-color"]);
                $GroupName = $_POST["color-group-name"];
                foreach ($selectedProducts as $productData) {
                    $productInfo = explode(',', $productData);

                    list($GroupID, $productID, $color, $colorName) = $productInfo;

                    if (!empty($GroupName) && !empty($productID) && !empty($color)) {
                        $abro->addproductColor($GroupID, $productID, $color, $colorName, $GroupName);
                    }
                }
                $url = substr($_SERVER["REQUEST_URI"], 1);
                $url = str_replace("/", "", $url);
                $url = str_replace("dashboardproducts-management", "", $url);
                $categoryID = intval($url);
                $_SESSION['notification'] = 'تم اضافة اللون بنجاح';
                header(header: "Location: " . $baseUrl . "dashboard/products-management/$categoryID/");
                exit;
            } elseif ($_SERVER["REQUEST_URI"] == "/view-color-group") {
                if (isset($_POST["categoryID"]) && isset($_POST["GroupID"])) {
                    $categoryID = $_POST["categoryID"];
                    $GroupID = $_POST["GroupID"];
                    $products = $abro->getAllProductColorGroups($categoryID, $GroupID);
                    header('Content-Type: application/json');
                    if ($products) {
                        echo json_encode([
                            "success" => true,
                            "data" => $products
                        ]);
                    } else {
                        echo json_encode([
                            "success" => false,
                            "message" => "لم يتم العثور على منتجات"
                        ]);
                    }
                    exit;
                }
            } elseif ($_SERVER["REQUEST_URI"] == "/update-products-color") {
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);
                if (isset($data['update'])) {
                    $GroupName = $data['groupName'];
                    $GroupID = $data['groupId'];
                    $products = $data['update'];
                    $abro->updateProductsColors($GroupID, $products, $GroupName);
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "لم يتم إرسال البيانات"]);
                }
            } else if (isset($_POST["download-all-clients"])) {
                $abro->createExcelSheet();
            } else if (isset($_POST["addPromoCode"])) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $promoCode = Validate::escape($_POST["promoCode"]);
                    $discountPercent = Validate::escape($_POST["discountPercent"]);
                    $expiresDate = Validate::escape($_POST["expiresDate"]);
                    $freeShipping = isset($_POST["freeShipping"]) ? 1 : 0;

                    if (!empty($promoCode) && !empty($discountPercent) && !empty($expiresDate)) {
                        if ($abro->addPromoCode($promoCode, $discountPercent, $expiresDate, $freeShipping)) {
                            $_SESSION["notification"] = "Promo code added successfully.";
                            header("Location: " . $baseUrl . "dashboardproducts-management/");
                        } else {
                            $_SESSION["notificationError"] = "Promo code already exists.";
                        }
                    } else {
                        $_SESSION["notificationError"] = "All fields are required.";
                    }
                }
                header("Location: " . $baseUrl . 'dashboardproducts-management/');
                exit();
            }
            if (isset($_POST["deletePromoCode"])) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $promoId = Validate::escape($_POST["promoId"]);
                    if ($abro->deletePromoCode($promoId)) {
                        $_SESSION["notification"] = "Promo code deactivated successfully.";
                    } else {
                        $_SESSION["notificationError"] = "Failed to delete promo code.";
                    }
                }
                header("Location: " . $baseUrl . 'dashboardproducts-management/');
                exit();
            } else if (isset($_POST["search"])) {
                $search = Validate::escape($_POST["search"]);
                if (strlen($search) > 0) {
                    $data = array();
                    $data["search"] = $search;
                    if ($products = $abro->searchProducts($search)) {
                        $data["products"] = '';
                        foreach ($products as $product) {
                            if ($abro->getProductMainImg($product["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
                                $productUrl = isset($product["Url"]) && $product["Url"] ? $product["Url"] : $product["ID"] . "/p-" . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $product["Name"]))));
                                $productUrl = $abro->baseUrl . "shop/" . strtolower(str_replace(" ", "-", $abro->getProductCategory($product["CategoryID"])->Name)) . "/product/" . $productUrl;
                                $productImg = $abro->baseUrl . $abro->getProductMainImg($product["ID"])->ImgPath;
                                $productName = ucwords(str_replace(strtolower($search), '<b class="underline">' . strtolower($search) . "</b>", strtolower($product["Name"])));

                                $data["products"] .= '<a href="' . $productUrl . '" class="s-p-i">
                                        <img src="' . $productImg . '" alt="' . $product["Name"] . '">
                                        <div class="s-p-i-t">
                                            <h2>' . $productName . '</h2>
                                            <span>LE ' . number_format($product["Price"], 2) . '</span>
                                        </div>
                                    </a>';
                            }
                        }

                        if (count($products) == 16) {
                            $data["more"] = count($abro->searchProducts($search, true));
                        }
                    } else {
                        $data["message"] = "No products were found matching your selection.";
                    }

                    echo json_encode($data);
                    exit();
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (isset($_POST["searchAll"])) {
                $search = Validate::escape($_POST["searchAll"]);
                if (strlen($search) > 0) {
                    $products = $abro->searchProducts($search, true);

                    self::layoutHandler($abro, $sysPath, "search", array("Search" => $search, "Products" => $products));
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (isset($_POST["blogSearch"])) {
                $search = Validate::escape($_POST["blogSearch"]);
                if (strlen($search) > 0) {
                    self::layoutHandler($abro, $sysPath, "blogs", array("search" => $search));
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (isset($_POST["login"])) {
                $email      = Validate::escape($_POST["email"]);
                $password   = $_POST['password'];

                if ($account = $abro->emailExist($email)) {
                    $hash = $account->Password;
                    if (password_verify($password, $hash)) {
                        $_SESSION['ID'] = $account->ID;

                        header("Location: " . $baseUrl . "account/");
                    } else {
                        self::layoutHandler($abro, $sysPath, "login", array("Error" => "Incorrect email or password."));
                    }
                } else {
                    self::layoutHandler($abro, $sysPath, "login", array("Error" => "Incorrect email or password."));
                }
            } else if (isset($_POST["register"])) {
                $firstName  = Validate::escape($_POST["firstName"]);
                $lastName   = Validate::escape($_POST["lastName"]);
                $number     = Validate::escape($_POST["number"]);
                $email      = Validate::escape($_POST["email"]);
                $password   = $_POST['password'];

                if ($account = $abro->emailExist($email)) {
                    self::layoutHandler($abro, $sysPath, "register", array("Error" => 'This email address is already associated with an account. if this account is yours, you can <a href="' . $baseUrl . 'login/reset-your-password/">reset your password</a>'));
                } else if (strlen($email) < 3 || strlen($password) < 3 || strlen($number) < 3) {
                    self::layoutHandler($abro, $sysPath, "register", array("Error" => "All fields are required."));
                } else if (!preg_match('/^[0-9]+$/', $number)) {
                    self::layoutHandler($abro, $sysPath, "register", array("Error" => "Please enter a valid phone number.", "Email" => $email, "FirstName" => $firstName, "LastName" => $lastName));
                } else if (preg_match('/\s/', $password)) {
                    self::layoutHandler($abro, $sysPath, "register", array("Error" => "Password must not contain whitespace.", "Number" => $number, "Email" => $email, "FirstName" => $firstName, "LastName" => $lastName));
                } else if (strlen($password) < 5) {
                    self::layoutHandler($abro, $sysPath, "register", array("Error" => "Password is too short (minimum is 5 characters).", "Number" => $number, "Email" => $email, "FirstName" => $firstName, "LastName" => $lastName));
                } else {
                    $repeat = true;

                    while ($repeat) {
                        if ($repeat) {
                            $repeat = $abro->neverRepeatID($abro->IDHash(uniqid()), $number, $email, $password, $firstName, $lastName);
                        }
                    }
                }
            } else if (isset($_POST["accountCashback"])) {
                if ($abro->account && $abro->account->ID) {
                    $userCashback = $abro->dbGet('cashbacks', ['UserId' => $abro->account->ID]) ? $abro->dbGet('cashbacks', ['UserId' => $abro->account->ID]) : null;
                    $userCashbackAmount = 0;
                    if ($userCashback != null) {
                        $userCashbackAmount += $userCashback->Amount;
                    }
                    echo json_encode(['userStatus' => 'signed', 'cashbackAmount' => $userCashbackAmount]);
                } else {
                    echo json_encode(['userStatus' => 'not signed']);
                }
            } else if (isset($_POST["isCheckoutShipping"])) {
                $data = array();
                if (isset($_POST["email"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["address"]) && isset($_POST["area"]) && isset($_POST["governorate"]) && isset($_POST["postalCode"]) && isset($_POST["phoneNumber"]) && isset($_POST["products"]) && is_array($_POST["products"]) && count($_POST["products"])) {
                    if (strlen($_POST["email"]) > 0 && strlen($_POST["firstName"]) > 0 && strlen($_POST["lastName"]) > 0 && strlen($_POST["address"]) > 0 && strlen($_POST["area"]) > 0 && strlen($_POST["governorate"]) > 0 && strlen($_POST["postalCode"]) > 0 && strlen($_POST["phoneNumber"]) > 0) {
                        $data["success"] = true;
                        // $hasOil = false;
                        // check if oil product
                        // foreach ($_POST["products"] as $prd) {
                        //     if($abro->getOneProductCtegoryID($prd['id'])['CategoryID'] == 1){
                        //         $hasOil = true;
                        //         break;
                        //     }
                        // }
                        $data["shippingFees"] = $abro->calculateShippingFees($_POST["products"], area: $_POST["governorate"]);
                        echo json_encode($data);
                    } else {
                        $data["success"] = false;

                        $missingData = "";

                        foreach (array("email", "firstName", "lastName", "address", "area", "governorate", "postalCode", "phoneNumber") as $key) {
                            if (strlen($_POST[$key]) <= 0) {
                                $missingData .= "<br>" . ucfirst(strtolower(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key)));
                            }
                        }

                        $data["message"] = "Please fill the following data:<br>" . $missingData;

                        echo json_encode($data);
                    }
                } else {
                    $data["success"] = false;

                    $missingData = "";

                    foreach (array("email", "firstName", "lastName", "address", "area", "governorate", "postalCode", "phoneNumber") as $key) {
                        if (!isset($_POST[$key])) {
                            $missingData .= "<br>" . ucfirst(strtolower(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key)));
                        }
                    }

                    $data["message"] = "Please fill the following data:<br>" . $missingData;

                    echo json_encode($data);
                }
            } else if (isset($_POST["placeOrder"])) {
                $data = array();
                $data['promoCode'] = null;

                if (isset($_POST["information"])) {
                    if (isset($_POST["products"]) && is_array($_POST["products"]) && count($_POST["products"])) {
                        $information    = $_POST["information"];

                        $address        = isset($information["address"]) ? $information["address"] : "";
                        $area           = isset($information["area"]) ? $information["area"] : "";
                        $email          = isset($information["email"]) ? $information["email"] : "";
                        $firstName      = isset($information["firstName"]) ? $information["firstName"] : "";
                        $lastName       = isset($information["lastName"]) ? $information["lastName"] : "";
                        $governorate    = isset($information["governorate"]) ? $information["governorate"] : "";
                        $phoneNumber    = isset($information["phoneNumber"]) ? $information["phoneNumber"] : "";
                        $postalCode     = isset($information["postalCode"]) ? $information["postalCode"] : "";

                        if (strlen($address) > 0 && strlen($area) > 0 && strlen($email) > 0 && strlen($firstName) > 0 && strlen($lastName) > 0 && strlen($governorate) > 0 && strlen($phoneNumber) > 0 && strlen($postalCode) > 0) {
                            if (isset($_POST["paymentMethod"])) {
                                if ($_POST["paymentMethod"] == "fawrypay" || $_POST["paymentMethod"] == "card" || $_POST["paymentMethod"] == "cod") {
                                    $paymentMethod = $_POST["paymentMethod"] == "fawrypay" ? "PAYATFAWRY" : ($_POST["paymentMethod"] == "card" ? "CARD" : "COD");

                                    $paymentInformation = array();
                                    if ($paymentMethod == "CARD") {
                                        if (isset($_POST["cardInformation"])) {
                                            $cardInformation    = $_POST["cardInformation"];

                                            $cardName           = isset($cardInformation["cardName"]) ? $cardInformation["cardName"] : "";
                                            $cardNumber         = isset($cardInformation["cardNumber"]) ? $cardInformation["cardNumber"] : "";
                                            $cardExpiryYear     = isset($cardInformation["cardExpiryYear"]) ? $cardInformation["cardExpiryYear"] : "";
                                            $cardExpiryMonth    = isset($cardInformation["cardExpiryMonth"]) ? $cardInformation["cardExpiryMonth"] : "";
                                            $cvv                = isset($cardInformation["cvv"]) ? $cardInformation["cvv"] : "";

                                            if (strlen($cardName) <= 0 || strlen($cardNumber) != 16 || strlen($cardExpiryYear) != 2 || strlen($cardExpiryMonth) != 2 || (strlen($cvv) != 3 && strlen($cvv) != 4)) {
                                                $data["success"] = false;
                                                $data["message"] = "Please provide your debit/credit card information.";

                                                echo json_encode($data);
                                                exit;
                                            }

                                            $paymentInformation["cardInformation"] = $_POST["cardInformation"];
                                        } else {
                                            $data["success"] = false;
                                            $data["message"] = "Please provide your debit/credit card information.";

                                            echo json_encode($data);
                                            exit;
                                        }
                                    }

                                    $paymentInformation["information"] = $information;
                                    $paymentInformation["products"] = $_POST["products"];
                                    // check if promocode
                                    if ($abro->account !== null && $_POST["promoCode"] && $promoCode = $abro->dbGet('promocodes', array('PromoCode' => strtoupper($_POST["promoCode"])))) {
                                        if ($promoCode->Status == 1) {
                                            if (new DateTime() < new DateTime($promoCode->ExpiresDate)) {
                                                if ($abro->checkUserPromoCode($promoCode->ID)) {
                                                    $abro->dbInsert("userpromocodes", array("AccountID" => $abro->account->ID, "PromoCodeID" => $promoCode->ID));
                                                    $data['promoCode'] = $promoCode;
                                                } else {
                                                    $data["success"] = false;
                                                    $data["message"] = "This promo code was already used.";
                                                }
                                            } else {
                                                $data["success"] = false;
                                                $data["message"] = "The promo code has expired.";
                                            }
                                        } else {
                                            $data["success"] = false;
                                            $data["message"] = "The promo code is not valid.";
                                        }
                                    } else {
                                        $data["success"] = false;
                                        $data["message"] = "The promo code does not exist.";
                                    }
                                    if ($result = $abro->placeOrder($paymentMethod, $paymentInformation, $data['promoCode'], $_POST['cashbackDiscount'])) {
                                        $data["success"] = true;

                                        if ($paymentMethod == "PAYATFAWRY" || $paymentMethod == "CARD") {
                                            if ($paymentMethod == "PAYATFAWRY") {
                                                $data["ref"] = $result["ref"];
                                            } else {
                                                if (isset($result["nextAction"])) {
                                                    $data["nextAction"] = $result["nextAction"];
                                                }
                                            }

                                            $data["id"] = $result["id"];
                                        }
                                    } else {
                                        $data["success"] = false;
                                        $data["message"] = "Apologies, an error has occurred. Try again later.";
                                    }
                                } else {
                                    $data["success"] = false;
                                    $data["message"] = "Apologies, an error has occurred. Try again later.";
                                }
                            } else {
                                $data["success"] = false;
                                $data["message"] = "Please choose a payment method.";
                            }
                        } else {
                            $data["success"] = false;
                            $data["message"] = "Please provide your information.";
                        }
                    } else {
                        $data["success"] = false;
                        $data["message"] = "Kindly choose at least one product.";
                    }
                } else {
                    $data["success"] = false;
                    $data["message"] = "Please provide your information.";
                }

                echo json_encode($data);
            } else if (isset($_POST["viewProduct"]) || isset($_POST["deleteProduct"])) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $url = substr($_SERVER["REQUEST_URI"], 1);
                    $url = str_replace("/", "", $url);
                    $url = str_replace("dashboardproducts-management", "", $url);
                    $url = intval($url);

                    if ($url != 0) {
                        if ($category = $abro->dbGet('categories', array('ID' => $url))) {
                            $layoutOptions = array(
                                "isDashboard" => true,
                                "Category" => $category,
                            );

                            if (isset($_POST["deleteProduct"])) {
                                $productID = intval($_POST["deleteProduct"]);
                                if ($abro->dbDelete('products', array('ID' => $productID))) {
                                    $layoutOptions["notification"] = "تم حذف المنتج بنجاح";
                                }
                            }

                            $layoutOptions["CategoryProducts"] = $abro->getAllProducts(false, $category->ID);

                            if (isset($_POST["viewProduct"])) {
                                $productID = intval($_POST["viewProduct"]);
                                if ($product = $abro->dbGet('products', array('ID' => $productID))) {
                                    $layoutOptions["ViewProduct"] = $product;
                                }
                            }

                            self::layoutHandler($abro, $sysPath, "dashboardviewcategory", $layoutOptions);
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    } else {
                        header("Location: " . $baseUrl);
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (isset($_POST["updateExcelProducts"])) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    if (isset($_FILES['excelSheet']) && $_FILES['excelSheet']['tmp_name']) {
                        $sheetName = uniqid() . pathinfo($_FILES["excelSheet"]["name"], PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES['excelSheet']['tmp_name'], $mainPath . $sheetName);
                        $excel_products = $abro->readExcelSheet($mainPath . $sheetName);
                        $updateResult = $abro->updateProductsBySKU($excel_products);
                        // remove the file
                        unlink($mainPath . $sheetName);
                        if ($updateResult) {
                            $_SESSION["notification"] = "تم تعديل المنتجات بنجاح";
                            header("Location: " . $baseUrl . '/dashboard/products-management');
                        } else {
                            $_SESSION["notificationError"] = "حدثت مشكلة أثناء التعديل";
                            header("Location: " . $baseUrl . '/dashboard/products-management');
                        }
                    } else {
                        header("Location: " . $baseUrl);
                    }
                }
            } else if (isset($_POST["editProduct"])) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $url = substr($_SERVER["REQUEST_URI"], 1);
                    $url = str_replace("/", "", $url);
                    $url = str_replace("dashboardproducts-management", "", $url);
                    $url = intval($url);

                    if ($url != 0) {
                        if ($category = $abro->dbGet('categories', array('ID' => $url))) {
                            $productID = intval($_POST["editProduct"]);
                            if (isset($_POST["name"]) && strlen($_POST["name"]) > 0 && isset($_POST["price"]) && strlen($_POST["price"]) > 0 && isset($_POST["weight"]) && strlen($_POST["weight"]) > 0 && isset($_POST["stock"]) && strlen($_POST["stock"]) > 0) {
                                $isUploaded = false;

                                $name = strip_tags($_POST["name"]);

                                $productInfo = array(
                                    'Name' => $name,
                                    'Price' => floatval($_POST["price"]),
                                    'Weight' => floatval($_POST["weight"]),
                                    'Stock' => floatval($_POST["stock"]),
                                );
                                if (isset($_POST["categoryID"])) {
                                    $productInfo["CategoryID"] = intval($_POST["categoryID"]);
                                }
                                if (isset($_POST["nameAr"]) && strlen($_POST["nameAr"]) > 0) {
                                    $productInfo["NameAr"] = strip_tags($_POST["nameAr"]);
                                }
                                if (isset($_POST["sku"]) && strlen($_POST["sku"]) > 0) {
                                    $productInfo["SKU"] = strip_tags($_POST["sku"]);
                                }
                                if (isset($_POST["prd-url"]) && $_POST["prd-url"] != $abro->getProductUrl($productID)) {
                                    $productInfo["Url"] = str_replace(' ', '-', strip_tags($_POST["prd-url"]));
                                }
                                if (isset($_POST["meta-title"]) && strlen($_POST["meta-title"]) > 0) {
                                    $productInfo["MetaTitle"] = strip_tags($_POST["meta-title"]);
                                }
                                if (isset($_POST["meta-desc"]) && strlen($_POST["meta-desc"]) > 0) {
                                    $productInfo["MetaDescription"] = strip_tags($_POST["meta-desc"]);
                                }

                                if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["tmp_name"] && exif_imagetype($_FILES["image"]["tmp_name"])) {
                                    $productImg = $abro->getProductMainImg($productID)->ImgPath;
                                    if ($productImg != "assets/img/products/noimage.jpg") {
                                        unlink($mainPath . $productImg);
                                    }

                                    $imgName = str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $name)))) . "-" . uniqid();
                                    $imgPath = "assets/img/products/$imgName." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                                    move_uploaded_file($_FILES["image"]["tmp_name"], $mainPath . $imgPath);
                                    $isUploaded = $abro->dbUpdate("productimg", array("ImgPath" => $imgPath), array("ProductID" => $productID, "Main" => 1));
                                }

                                if (isset($_POST["desc"]) && strlen($_POST["desc"]) > 0) {
                                    $productInfo["Desc"] = strip_tags($_POST["desc"], "<p><strong><br><ul><li>");
                                    $productInfo["Desc"] = preg_replace("/<(p|strong|br|ul|li) [^>]*>/", "<$1>", $productInfo["Desc"]);
                                }

                                if (isset($_POST["descAr"]) && strlen($_POST["descAr"]) > 0) {
                                    $productInfo["DescAr"] = strip_tags($_POST["descAr"], "<p><strong><br><ul><li>");
                                    $productInfo["DescAr"] = preg_replace("/<(p|strong|br|ul|li) [^>]*>/", "<$1>", $productInfo["DescAr"]);
                                }

                                if ($abro->dbUpdate("products", $productInfo, array("ID" => $productID)) || $isUploaded) {
                                    self::layoutHandler($abro, $sysPath, "dashboardviewcategory", array(
                                        "isDashboard" => true,
                                        "Category" => $category,
                                        "CategoryProducts" => $abro->getAllProducts(false, $category->ID),
                                        "notification" => "تم حفظ المنتج بنجاح",
                                    ));
                                } else {
                                    self::layoutHandler($abro, $sysPath, "dashboardviewcategory", array(
                                        "isDashboard" => true,
                                        "Category" => $category,
                                        "CategoryProducts" => $abro->getAllProducts(false, $category->ID),
                                    ));
                                }
                            } else {
                                header("Location: " . $baseUrl);
                            }
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    } else {
                        header("Location: " . $baseUrl);
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (isset($_POST["addProduct"])) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $url = substr($_SERVER["REQUEST_URI"], 1);
                    $url = str_replace("/", "", $url);
                    $url = str_replace("dashboardproducts-management", "", $url);
                    $url = intval($url);

                    if ($url != 0) {
                        if ($category = $abro->dbGet('categories', array('ID' => $url))) {
                            if (isset($_POST["name"]) && strlen($_POST["name"]) > 0 && isset($_POST["price"]) && strlen($_POST["price"]) > 0 && isset($_FILES["image"]["tmp_name"]) && exif_imagetype($_FILES["image"]["tmp_name"]) && isset($_POST["weight"]) && strlen($_POST["weight"]) > 0) {
                                $name = strip_tags($_POST["name"]);

                                $productInfo = array(
                                    "CategoryID" => $category->ID,
                                    'Name' => $name,
                                    'Price' => floatval($_POST["price"]),
                                    'Weight' => floatval($_POST["weight"]),
                                );

                                if (isset($_POST["nameAr"]) && strlen($_POST["nameAr"]) > 0) {
                                    $productInfo["NameAr"] = strip_tags($_POST["nameAr"]);
                                }

                                if (isset($_POST["sku"]) && strlen($_POST["sku"]) > 0) {
                                    $productInfo["SKU"] = strip_tags($_POST["sku"]);
                                }

                                if (isset($_POST["desc"]) && strlen($_POST["desc"]) > 0) {
                                    $productInfo["Desc"] = strip_tags($_POST["desc"], "<p><strong><br><ul><li>");
                                    $productInfo["Desc"] = preg_replace("/<(p|strong|br|ul|li) [^>]*>/", "<$1>", $productInfo["Desc"]);
                                }

                                if (isset($_POST["descAr"]) && strlen($_POST["descAr"]) > 0) {
                                    $productInfo["DescAr"] = strip_tags($_POST["descAr"], "<p><strong><br><ul><li>");
                                    $productInfo["DescAr"] = preg_replace("/<(p|strong|br|ul|li) [^>]*>/", "<$1>", $productInfo["DescAr"]);
                                }

                                if (isset($_POST["stock"]) && strlen($_POST["stock"]) > 0) {
                                    $productInfo["Stock"] = strip_tags($_POST["stock"]);
                                }

                                if ($productID = $abro->dbInsert("products", $productInfo, true)) {
                                    $imgName = str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $name)))) . "-" . uniqid();
                                    $imgPath = "assets/img/products/$imgName." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                                    move_uploaded_file($_FILES["image"]["tmp_name"], $mainPath . $imgPath);
                                    $abro->dbInsert("productimg", array("ProductID" => $productID, "ImgPath" => $imgPath, "Main" => 1));

                                    self::layoutHandler($abro, $sysPath, "dashboardviewcategory", array(
                                        "isDashboard" => true,
                                        "Category" => $category,
                                        "CategoryProducts" => $abro->getAllProducts(false, $category->ID),
                                        "notification" => "تم إضافة المنتج بنجاح",
                                    ));
                                } else {
                                    header("Location: " . $baseUrl);
                                }
                            } else {
                                header("Location: " . $baseUrl);
                            }
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    } else {
                        header("Location: " . $baseUrl);
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (isset($_POST["paidCheckType"]) && isset($_POST["id"])) {
                $data = array();

                if ($order = $abro->dbGet('orders', array("ID" => $_POST["id"]))) {
                    if ($order->PaymentStatus == "paid" || $order->PaymentStatus == "failed") {
                        if ($order->PaymentStatus == "paid") {
                            $data["paid"] = 1;
                        } else {
                            $data["failed"] = 1;
                            $data["reason"] = $order->FailureReason;
                        }
                    }
                }

                echo json_encode($data);
            } else if ($_SERVER["REQUEST_URI"] == "/payment-notification") {
                $rawData = file_get_contents('php://input');
                $data = json_decode($rawData, true);

                if (isset($data["fawryRefNumber"]) && isset($data["merchantRefNumber"]) && isset($data["paymentAmount"]) && isset($data["orderAmount"]) && isset($data["orderStatus"]) && isset($data["paymentMethod"]) && $order = $abro->dbGet('orders', array("ID" => intval($data["merchantRefNumber"])))) {
                    $expectedSignature = hash('sha256', $data["fawryRefNumber"] . $data["merchantRefNumber"] . number_format($data["paymentAmount"], 2, ".", "") . number_format($data["orderAmount"], 2, ".", "") . $data["orderStatus"] . $data["paymentMethod"] . (isset($data["paymentRefrenceNumber"]) ? $data["paymentRefrenceNumber"] : "") . $abro->merchant_sec_key);
                    if ($data['messageSignature'] === $expectedSignature) {
                        if (strtolower($data['orderStatus']) == "paid" || strtolower($data['orderStatus']) == "canceled" || strtolower($data['orderStatus']) == "expired") {
                            $abro->dbUpdate("orders", array("PaymentStatus" => strtolower($data['orderStatus'])), array("ID" => $data["merchantRefNumber"]));

                            // paid
                            if (strtolower($data['orderStatus']) == "paid") {
                                $abro->sendOrderToMylerz($data["merchantRefNumber"]);
                                // add earned cashbaack points
                                $order = $abro->dbGet("orders", array("ID" => $data["merchantRefNumber"]));
                                $orderProducts = $abro->getOrderProducts($order->ID);
                                $subTotal = 0;
                                $cashBack = 0;
                                foreach ($orderProducts as $i => $product) {
                                    $subTotal += $product["ProductQuantity"] * $product["ProductPrice"];
                                }
                                $no_discount_amount = $subTotal;
                                $order_discount = $order->CashbackDiscount + $order->DiscountValue;
                                $order_cashback_discount_value =  $order_discount * ($no_discount_amount / 100);
                                $cashBack +=  ($no_discount_amount - $order_cashback_discount_value) * (5 / 100);
                                $abro->handleCashBack($cashBack);
                                $abro->dbUpdate("orders", ['IsCashbackEarned' => 1], array("ID" => $data["merchantRefNumber"]));
                            }
                        } else if (strtolower($data['orderStatus']) == "failed") {
                            $reason = "Apologies, an error has occurred. Try again later.";
                            if (isset($data['failureReason']) && strtolower($data['failureReason']) != "something went wrong") {
                                $reason = $data['failureReason'];
                            }

                            $abro->dbUpdate("orders", array("PaymentStatus" => strtolower($data['orderStatus']), "FailureReason" => $reason), array("ID" => $data["merchantRefNumber"]));
                        }

                        http_response_code(200);
                        error_log("Success 200: " . json_encode($data));
                    } else {
                        http_response_code(401);
                        error_log("Error 401: " . json_encode($data));

                        echo "Unauthorized: Invalid FawryPay signature.";
                    }
                } else {
                    http_response_code(400);
                    error_log("Error 400: " . json_encode($data));
                    echo "Bad Request";
                }
            } else if ($_SERVER["REQUEST_URI"] == "/get-checkout-products") {
                if (isset($_POST["ProductsIDs"]) && parse_url($baseUrl)['host'] == $_SERVER['SERVER_NAME']) {
                    $data = array();
                    $products = $abro->getMultiProductsByIDs($_POST["ProductsIDs"]);
                    $data["products"] = $products;
                    // general dicount
                    $currentDate = new DateTime();
                    $currentMonth = $currentDate->format('m');
                    $currentYear = $currentDate->format('Y');
                    if ($currentMonth < 12 && $currentYear == 2024) {
                        $data["generalDiscount"] = 10;
                    }
                    // $data["success"] = true;
                    echo json_encode($data);
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($_SERVER["REQUEST_URI"] == "/proceed-cod") {
                if (isset($_POST["OrderID"]) && $abro->account !== null && $abro->account->isAdmin) {
                    $data = array();
                    $order = $abro->getOrderByID($_POST["OrderID"]);
                    $abro->sendOrderToMylerz($order["ID"]);
                    $data["success"] = true;
                    echo json_encode($data);
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($_SERVER["REQUEST_URI"] == "/cancel-cod-order") {
                if (isset($_POST["OrderID"]) && $abro->account !== null && $abro->account->isAdmin) {
                    $data = array();
                    if ($abro->dbUpdate("orders", array("Status" => "cancelled"), array("ID" => $_POST["OrderID"]))) {
                        $data['success'] = true;
                    } else {
                        $data['success'] = false;
                    }
                    echo json_encode($data);
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($_SERVER["REQUEST_URI"] == "/confirm-order-cashback") {
                if (isset($_POST["orderID"]) && $abro->account !== null && $abro->account->isAdmin) {
                    $data = array();
                    // add earned cashbaack points
                    $order = $abro->dbGet("orders", array("ID" => $_POST['orderID']));
                    $data['isCashbackearned'] = $order->IsCashbackEarned;
                    if (!$order->IsCashbackEarned > 0) {
                        $orderProducts = $abro->getOrderProducts($order->ID);
                        $subTotal = 0;
                        $cashBack = 0;
                        foreach ($orderProducts as $i => $product) {
                            $subTotal += $product["ProductQuantity"] * $product["ProductPrice"];
                        }
                        $no_discount_amount = $subTotal;
                        // $order_discount = $order->CashbackDiscount + $order->DiscountValue;
                        // $order_cashback_discount_value =  $order_discount * ($no_discount_amount / 100);
                        $cashBack +=  ($no_discount_amount - $order->DiscountValue) * (5 / 100);
                        $abro->handleCashBack($cashBack);
                        $abro->dbUpdate("orders", ['IsCashbackEarned' => 1], array("ID" => $_POST['orderID']));
                        $data['success'] = true;
                        // send cashback mail to user mail
                        try {
                            $user_id = $order->CustomerID;
                            $earned_cashback = $cashBack;
                            $user = $abro->dbGet('accounts', ['ID' => $user_id]);
                            $mail_action = $abro->sendMail($user->Email, 'cashback_alert', ['user' => $user, 'earned_cashback' => $earned_cashback]);
                            $data['email_sent_to_user'] = true;
                            $data['earned_cashback'] = $earned_cashback;
                            $data['account_email'] = $user->Email;
                            $data['mail_action'] = $mail_action;
                        } catch (\Exception $e) {
                            $data['email_sent_to_user'] = false;
                            $data['email_err'] = $e->getMessage();
                            // echo json_encode(['err msg'=>$e->getMessage()]);
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = 'already earned';
                    }
                    echo json_encode($data);
                } else {
                    header("Location: " . $baseUrl);
                }
            }
            // else if ($_SERVER["REQUEST_URI"] == "/send-cahback-mail") {
            //     try {
            //         $user_id = $_POST['userID'];
            //         $earned_cashback = $_POST['earnedCashback'];
            //         $user = $abro->dbGet('Accounts',['ID'=>$user_id]);
            //         $abro->sendMail('neldeen8@gmail.com','cashback_alert',['user'=>$user,'earned_cashback'=>$earned_cashback]);
            //         echo json_encode(['msg'=>'success']);
            //     } catch (\Exception $e) {
            //         echo json_encode(['err msg'=>$e->getMessage()]);
            //     }
            // }
            else if ($_SERVER["REQUEST_URI"] == "/check-promo-code") {
                $data = array();

                if ($abro->account !== null && isset($_POST["promoCode"])) {
                    if ($promoCode = $abro->dbGet('promocodes', array('PromoCode' => strtoupper($_POST["promoCode"])))) {
                        if ($promoCode->Status == 1) {
                            // Check if the promo code has expired based on the current date
                            $currentDate = new DateTime();
                            $expirationDate = new DateTime($promoCode->ExpiresDate);

                            if ($currentDate < $expirationDate) {
                                // Check if the user has already used this promo code
                                if ($abro->checkUserPromoCode($promoCode->ID)) {
                                    $data["success"] = true;
                                    $data["message"] = "The promo code has been applied.";
                                    $data["percent"] = $promoCode->DiscountPercent;
                                    $data["freeShipping"] = $promoCode->FreeShipping;
                                } else {
                                    $data["success"] = false;
                                    $data["message"] = "This promo code was already used.";
                                }
                            } else {
                                $data["success"] = false;
                                $data["message"] = "This promo code has expired.";
                            }
                        } else {
                            $data["success"] = false;
                            $data["message"] = "The promo code is inactive.";
                        }
                    } else {
                        $data["success"] = false;
                        $data["message"] = "The promo code does not exist.";
                    }
                    echo json_encode($data);
                } else {
                    if ($abro->account == null) {
                        $data["success"] = false;
                        $data["message"] = "You must login first";
                        echo json_encode($data);
                    } else {
                        header("Location: " . $baseUrl);
                    }
                }
            } else if ($_SERVER["REQUEST_URI"] == "/get-order-info") {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    if (!empty($_POST["OrderID"]) && is_numeric($_POST["OrderID"])) {
                        if (($order = $abro->getOrderByID($_POST["OrderID"])) && ($products = $abro->getOrderProducts($_POST["OrderID"]))) {
                            $data = array();

                            $paymentMethod = '<div class="payment-inner">
                                    <span>Visa **56</span>
                                    <div class="payment-icon-box visa"><img src="/assets/img/visa.png"></div>
                                </div>';

                            if ($order["PaymentMethod"] == "cod") {
                                $paymentMethod = '<div class="payment-inner">
                                        <div class="payment-icon-box m-0"><img src="/assets/icons/cod.png"></div>
                                    </div>';
                            } else if ($order["PaymentMethod"] == "payatfawry") {
                                $paymentMethod = '<div class="payment-inner">
                                        <div class="payment-icon-box m-0"><img src="/assets/img/brand/fawrypay-logo.png"></div>
                                    </div>';
                            } else if ($order["PaymentMethod"] == "card") {
                                $card = "meeza-logo.svg";
                                if ($abro->getCardType($order["CardNumber"]) == "mastercard") {
                                    $card = "mastercard-logo.svg";
                                } else if ($abro->getCardType($order["CardNumber"]) == "visa") {
                                    $card = "visa-logo.svg";
                                }

                                $cardType = $abro->getCardType($order["CardNumber"]) ? $abro->getCardType($order["CardNumber"]) : "Mezza";
                                $paymentMethod = '<div class="payment-inner">
                                        <span>' . ucfirst($cardType) . ' **' . mb_substr($abro->decryptCardNumber($order["CardNumber"]), -2) . '</span>
                                        <div class="payment-icon-box"><img src="/assets/img/brand/' . $card . '"></div>
                                    </div>';
                            }

                            $orderProducts = '';
                            $subTotal = 0;
                            $noStock = false;
                            for ($i = 0; $i < count($products); $i++) {
                                $originPrd = $abro->getOneProductByID($products[$i]['ProductID']);
                                if (!$originPrd['Stock'] && !$noStock) {
                                    $noStock = true;
                                }
                                $subTotal += ($products[$i]["ProductPrice"] * $products[$i]["ProductQuantity"]);
                                $orderProducts .= '<div class="order-menu-oder-item">
                                        <div class="order-item-info">
                                            <div class="order-item-image-box"><img src="/' . $products[$i]["ProductImage"] . '" alt="' . $products[$i]["ProductName"] . '"></div>
                                            <div class="order-item-text">
                                                <div class="order-item-name">' . $products[$i]["ProductName"] . '</div>
                                            </div>
                                        </div>
                                        <div class="order-item-price-box">
                                            <div class="order-item-price"><span class="order-item-price-num">' . number_format(($products[$i]["ProductPrice"] * $products[$i]["ProductQuantity"]), 2) . ' ج.م</span></div>
                                            <div class="order-item-quantitiy"><span>الكمية: </span>' . $products[$i]["ProductQuantity"] . '<span class="order-item-quantitiy-num"></span></div>
                                        </div>
                                    </div>';

                                if ($i + 1 != count($products)) {
                                    $orderProducts .= '<div class="horizontal-line my-3"></div>';
                                }
                            }
                            $totalOrder = $subTotal - $order["DiscountValue"] + $order["ShippingFees"] + $order["CODFees"];
                            $cod_button_display = strtolower($order['Status']) == "pending" && !$noStock ? "flex" : "none";
                            $cod_success_display = $order['Status'] == 'proceeded' ? "inintial" : "none";
                            $noStock_display = $noStock ? "inintial" : "none";
                            $data["html"] = '
                                <div class="order-header">
                                    <div class="order-right">
                                        <div class="order-menu-id">رقم الطلب: <span dir="ltr">#' . $order["ID"] . '</span></div>
                                        <div class="oreder-menu-order-date"><span><i class="far fa-calendar-alt" aria-hidden="true"></i> ' . date("M d, Y", strtotime($order["Date"])) . '</span></div>
                                    </div>
                                    ' . ($order['Status'] == "cancelled" ? '<div style="color:red;">تم إلغاء الطلب</div>' : "") . '
                                    ' . (!$noStock && $order['Status'] == "pending" ? '<button class="cancel-order" value="' . $order["ID"] . '">إلغاء الطلب</button>' : "") . '
                                    ' . ($noStock && $order['Status'] == "pending" ? '<div style="color:red;">هناك كمية منتهية</div> ' : "") . '
                                    ' . ($order["PaymentMethod"] == "cod" ? '<button style="display:' . $cod_button_display . '" class="confirm-order" value="' . $order["ID"] . '">تأكيد الطلب <img src="/assets/icons/confirm.png" /> </button> <div class="cod-success" value="' . $order["ID"] . '" style="display: ' . $cod_success_display . '">تم تأكيد الطلب</div>' : '') . '
                                </div>
                                <div class="horizontal-line"></div>
                                <div class="order-menu-order-items">
                                    ' . $orderProducts . '
                                </div>
                                <div class="horizontal-line"></div>
                                <div class="order-menu-payment-info">
                                    <div class="order-menu-delivery">
                                        <div class="delivery-header">التوصيل</div>
                                        <div class="delivery-inner">
                                            <div class="delivery-inner-address">العنوان</div>
                                            <div class="delivery-inner-container" dir="ltr">
                                            <span>' . $order["Address"] . '</span>
                                            <span>' . $order["Governorate"] . ', ' . $order["Country"] . '</span>
                                            <span>' . $order["PostalCode"] . '</span>
                                            <span>' . $order["PhoneNumber"] . '</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-menu-payment">
                                        <div class="payment-header">طريقة الدفع	</div>
                                        ' . $paymentMethod . '
                                    </div>
                                    <div class="total-order">' . number_format($totalOrder, 2) . ' ج.م</div>
                                </div>';

                            echo json_encode($data);
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    } else {
                        header("Location: " . $baseUrl);
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            }
            // else if ($_SERVER["REQUEST_URI"] == "/get-review") {
            //     // if (true) {
            //     if ($abro->account !== null) {
            //             // get review if signed
            //             $data = array();
            //             $productID = $_POST["productID"];
            //             $accountID = $abro->account->ID;
            //             // $accountID = 'fakeid';
            //             $data["success"] = true;
            //             $review = $abro->getAccountProductReview($accountID,$productID);
            //             if (isset($review) && $review) {
            //                 $data['review'] = $review;
            //                 http_response_code(201);
            //                 echo json_encode($data);
            //             }else {
            //                 //get rating
            //                 $review = $abro->getProductRating($productID);
            //                 $data['review'] = $review;
            //                 http_response_code(201);
            //                 echo json_encode($data);
            //             }
            //     } else {
            //         // get rating
            //         $data = array();
            //         $productID = $_POST["productID"];
            //         $accountID = 'fakeid';
            //         $review = $abro->getProductRating($productID);
            //         $data['review'] = $review;
            //         http_response_code(201);
            //         echo json_encode($data);
            //     }
            // } 
            else if ($_SERVER["REQUEST_URI"] == "/review-product") {
                // if (true) {
                if ($abro->account !== null) {
                    $data = array();
                    $productID = $_POST["productID"];
                    $accountID = $abro->account->ID;
                    // $accountID = 'fakeid';
                    $stars = $_POST["stars"] <= 5 ? $_POST["stars"] : 5;
                    // get prd review 
                    $review = $abro->getAccountProductReview($accountID, $productID);
                    if (isset($review) && $review) {
                        // update existing review
                        $abro->updateReview($productID, $accountID, $stars);
                    } else {
                        $abro->createReview($productID, $accountID, $stars);
                    }
                    $data["success"] = true;
                    $data["msg"] = "Done 200: review stars =" . json_encode($_POST["stars"]);
                    http_response_code(200);
                    echo json_encode($data);
                } else {
                    header("Location: " . $baseUrl);
                }
            }
            // update review
            // else if ($_SERVER["REQUEST_URI"] == "/update-review") {
            //     // if (true) {
            //     if ($abro->account !== null) {
            //             $data = array();
            //             $productID = $_POST["productID"];
            //             $accountID = $abro->account->ID;
            //             // $accountID = 'fakeid';
            //             $stars = $_POST["stars"] <= 5? $_POST["stars"] : 5;
            //             //update
            //             $abro->updateReview($productID, $accountID, $stars);
            //             $data["success"] = true;
            //             $data["msg"] = "Updated 200: review stars =".json_encode($_POST["stars"]);
            //             http_response_code(200);
            //             echo json_encode($data);
            //     } else {
            //         header("Location: " . $baseUrl);
            //     }
            // }
            else if ($_SERVER["REQUEST_URI"] == "/update-products-info") {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    if (isset($_POST["products"]) && is_array($_POST["products"]) && count($_POST["products"]) > 0) {
                        $data = array();

                        $data["success"] = true;
                        $data["msg"] = "Products has been updated successfully";

                        $abro->updateAllProducts($_POST["products"]);

                        echo json_encode($data);
                    } else {
                        header("Location: " . $baseUrl);
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($_SERVER["REQUEST_URI"] == "/return-to-pending") {
                if (isset($_POST["OrderID"])) {
                    $orderID = $_POST["OrderID"];
                    $result = $abro->dbUpdate("orders", array("Status" => "pending"), array("ID" => $orderID));
                    if ($result) {
                        echo json_encode(["success" => true]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Failed to update order status."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "No order ID provided."]);
                }
            } else if ($_SERVER["REQUEST_URI"] == "/date-range") {
                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    $startDate = $_POST['start_date'];
                    $endDate = $_POST['end_date'];
                    if ($startDate && $endDate) {
                        $allprice = $abro->getOrdersEarningsByDateRange($startDate, $endDate);
                    } else {
                        $allprice = $abro->getOrdersEarningsLast30Days();
                    }

                    $card = 0;
                    $cod = 0;
                    $payatfawry = 0;

                    foreach ($allprice as $row) {
                        if ($row["PaymentMethod"] == "card") {
                            $card += $row["Net"];
                        } elseif ($row["PaymentMethod"] == "cod") {
                            $cod += $row["Net"];
                        } else {
                            $payatfawry += $row["Net"];
                        }
                    }

                    echo json_encode([
                        "success" => true,
                        "data" => [
                            "card" => number_format($card, 2, ".", ','),
                            "cod" => number_format($cod, 2, ".", ','),
                            "fawry" => number_format($payatfawry, 2, ".", ','),
                        ]
                    ]);
                } else {
                    echo json_encode(["success" => false, "message" => "Start date and end date are required."]);
                }
            } else if ($_SERVER["REQUEST_URI"] == "/get-city-zone-list") {
                if (isset($_POST["governorate"])) {
                    $zones = $abro->getCityZoneList($_POST["governorate"]);
                    foreach ($zones as $zone) {
?>
                        <option value="<?php echo $zone["Code"]; ?>"><?php echo $zone["EnName"]; ?></option>
                    <?php
                    }
                } else {
                    $cities = $abro->getCityZoneList();
                    foreach ($cities as $city) {
                    ?>
                        <option value="<?php echo $city["Code"]; ?>"><?php echo $city["EnName"]; ?></option>
<?php
                    }
                }
            } else {
                header("Location: " . $baseUrl);
            }
        } else {
            $url = substr($_SERVER["REQUEST_URI"], 1);

            if (strpos($url, "en") === 0 || strpos($url, "ar") === 0) {
                if (strpos($url, "en") === 0) {
                    if ($_COOKIE['__Secure-LANG'] != "en") {
                        $_COOKIE['__Secure-LANG'] = "en";
                        setcookie('__Secure-LANG', "en", time() + (10 * 365 * 24 * 60 * 60), '/', $_SERVER['HTTP_HOST'], true, true);
                    }
                } else {
                    if ($_COOKIE['__Secure-LANG'] != "ar") {
                        $_COOKIE['__Secure-LANG'] = "ar";
                        setcookie('__Secure-LANG', "ar", time() + (10 * 365 * 24 * 60 * 60), '/', $_SERVER['HTTP_HOST'], true, true);
                    }
                }

                $abro->lang = $_COOKIE['__Secure-LANG'];
                $url = substr($url, 2);
            }

            $originalUrl = $url;
            $url = str_replace("/", "", $url);

            if ($url == "") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, "home");
            } else if ($url == "shop") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, $url);
            } else if (strpos($url, "shop") === 0) {
                $categoryName = substr($url, strlen("shop"));

                if (strpos($url, "product") !== false) {
                    $categoryName = substr($categoryName, 0, strpos($categoryName, "product"));
                }

                $categoryName = Validate::escape($categoryName);
                $categoryName = str_replace("-", " ", $categoryName);
                $categoryName = ucwords($categoryName);
                if (isset(oldCategories()[$categoryName])) {
                    $oldCategory = $categoryName;
                    $categoryName = oldCategories()[$categoryName];
                    $newUrl =  $baseUrl . str_replace(strtolower(str_replace(" ", "-", $oldCategory)), strtolower(str_replace(" ", "-", $categoryName)), $originalUrl);
                    header("Location: " . $newUrl, true, 301);
                    exit;
                }

                if ($category = $abro->getCategoryByName($categoryName)) {
                    $categoryName = str_replace(" ", "-", $categoryName);
                    $categoryName = strtolower($categoryName);
                    $categoryName = "shop" . $categoryName;

                    if ($url == $categoryName) {
                        $abro->visitHandle();

                        $category->Views += 1;
                        $abro->dbUpdate('categories', array('Views' => $category->Views), array('ID' => $category->ID));

                        self::layoutHandler($abro, $sysPath, "category", array("Category" => $category));
                    } else if (count(explode('/', trim($originalUrl, '/'))) < 5) {
                        $lastSegment = explode('/', trim($originalUrl, '/'));
                        if ($product = $abro->dbGet('products', ['Url' => end($lastSegment)])) {
                            self::layoutHandler($abro, $sysPath, "product", array("Category" => $category, "Product" => $product));
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    } else {
                        $productID = str_replace($categoryName, "", $url);
                        $productID = str_replace("product", "", $productID);
                        $productID = intval($productID);

                        if ($product = $abro->getProductByID($productID, $category->ID)) {
                            $abro->visitHandle();
                            $product->Views += 1;

                            $abro->dbUpdate('products', array('Views' => $product->Views), array('ID' => $product->ID));
                            $product = $abro->dbGet('products', ['ID' => $productID]);
                            if ($product->Url) {
                                $urlCategoryName = explode('/', trim(substr($originalUrl, strlen("shop")), '/'))[0];
                                header("Location: " . $baseUrl . 'shop/' . strtolower(str_replace(" ", "-", $urlCategoryName)) . '/product/' . $product->Url, true, 301);
                            } else {
                                self::layoutHandler($abro, $sysPath, "product", array("Category" => $category, "Product" => $product));
                            }
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($url == "wishlist") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, $url);
            } else if ($url == "compare") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, $url);
            } else if ($url == "accessibility") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, $url);
            } else if ($url == "terms-and-conditions") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, "terms");
            } else if ($url == "privacy-notices") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, "privacy");
            } else if ($url == "cookie-policy") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, "cookie");
            } else if ($url == "fraud-and-scam-alert") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, "fraud");
            } else if ($url == "refund-policy") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, "refund");
            } else if ($url == "checkout") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, $url, array("Checkout" => true));
            } else if (strpos($url, "checkout-payment-handle") === 0) {
                self::layoutHandler($abro, $sysPath, "", array("loadingScreen" => true));
            } else if ($url == "login") {
                if ($abro->account === null) {
                    $abro->visitHandle();
                    self::layoutHandler($abro, $sysPath, $url);
                } else {
                    header("Location: " . $baseUrl . "account/");
                }
            } else if ($url == "loginreset-your-password") {
                if ($abro->account === null) {
                    $abro->visitHandle();
                    self::layoutHandler($abro, $sysPath, "login", array("RestPassword" => true));
                } else {
                    header("Location: " . $baseUrl . "account/");
                }
            } else if ($url == "register") {
                if ($abro->account === null) {
                    $abro->visitHandle();
                    self::layoutHandler($abro, $sysPath, $url);
                } else {
                    header("Location: " . $baseUrl . "account/");
                }
            } else if ($url == "account") {
                if ($abro->account === null) {
                    header("Location: " . $baseUrl);
                } else {
                    $abro->visitHandle();
                    $orders = $abro->getOrderByCustomerID($abro->account->ID);
                    self::layoutHandler($abro, $sysPath, $url, array("Orders" => $orders));
                }
            } else if ($url == "blogs") {
                $abro->visitHandle();
                self::layoutHandler($abro, $sysPath, $url);
            } else if ($url == "logout") {
                $abro->logout();
            } else if ($url == "logoutcheckout") {
                $abro->logout();
                header("Location: " . $baseUrl . "checkout/");
            } else if (strpos($url, "blogs") === 0) {
                $abro->page = "blog";

                $url = str_replace("blogs", "", $url);
                $url = intval($url);

                if ($blog = $abro->dbGet('blogs', array("ID" => $url))) {
                    $abro->visitHandle();
                    $blog->Visitors += 1;

                    $abro->dbUpdate('blogs', array('Visitors' => $blog->Visitors), array('ID' => $blog->ID));
                    self::blogHandler($abro, $sysPath, $blog);
                } else {
                    header("Location: " . $baseUrl . "blogs/");
                }
            } else if ($url == "dashboard") {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $totalVisits    = $abro->getVisitsByType("total");
                    $uniqueVisits   = $abro->getVisitsByType("unique");
                    $clicks         = $abro->getClicksByType();
                    $orders         = $abro->getOrdersByType();

                    $yesterdayTotalVisits   = $abro->getVisitsByType("total", true);
                    $yesterdayUniqueVisits  = $abro->getVisitsByType("unique", true);
                    $yesterdayClicks        = $abro->getClicksByType(true);
                    $yesterdayOrders        = $abro->getOrdersByType(true);

                    $totalVisitsDiff    = $totalVisits - $yesterdayTotalVisits;
                    $uniqueVisitsDiff   = $uniqueVisits - $yesterdayUniqueVisits;
                    $clicksDiff         = $clicks - $yesterdayClicks;
                    $ordersDiff         = $orders - $yesterdayOrders;

                    if ($totalVisits > $yesterdayTotalVisits) {
                        $totalVisitsPercent = (abs($totalVisitsDiff) / ($totalVisits ?: 1)) * 100;
                    } else {
                        $totalVisitsPercent = (abs($totalVisitsDiff) / ($yesterdayTotalVisits ?: 1)) * 100;
                    }

                    if ($uniqueVisits > $yesterdayUniqueVisits) {
                        $uniqueVisitsPercent = (abs($uniqueVisitsDiff) / ($uniqueVisits ?: 1)) * 100;
                    } else {
                        $uniqueVisitsPercent = (abs($uniqueVisitsDiff) / ($yesterdayUniqueVisits ?: 1)) * 100;
                    }

                    if ($clicks > $yesterdayClicks) {
                        $clicksPercent = (abs($clicksDiff) / ($clicks ?: 1)) * 100;
                    } else {
                        $clicksPercent = (abs($clicksDiff) / ($yesterdayClicks ?: 1)) * 100;
                    }

                    if ($orders > $yesterdayOrders) {
                        $ordersPercent = (abs($ordersDiff) / ($orders ?: 1)) * 100;
                    } else {
                        $ordersPercent = (abs($ordersDiff) / ($yesterdayOrders ?: 1)) * 100;
                    }

                    $lastWeekTotalVisitsArray = false;
                    if ($lastWeekTotalVisits = $abro->getWeeklyViews(true)) {
                        $weekTotalVisits = $abro->getWeeklyViews();

                        $weekTotalVisitsDiff = $weekTotalVisits - $lastWeekTotalVisits;

                        if ($weekTotalVisits > $lastWeekTotalVisits) {
                            $weekTotalVisitsPercent = (abs($weekTotalVisitsDiff) / ($weekTotalVisits ?: 1)) * 100;
                        } else {
                            $weekTotalVisitsPercent = (abs($weekTotalVisitsDiff) / ($lastWeekTotalVisits ?: 1)) * 100;
                        }

                        $lastWeekTotalVisitsArray = array($weekTotalVisits, $weekTotalVisitsDiff, ($weekTotalVisitsDiff > 0 ? $weekTotalVisitsPercent : -1 * abs($weekTotalVisitsPercent)));
                    }

                    $visitsDays = array_reverse($abro->getVisitsDays());
                    $visitsDays = $abro->getAllVisitsOfDays($visitsDays);

                    $chartLineLabel = [];
                    $chartLineTotalVisits = [];
                    $chartLineUniqueVisits = [];
                    foreach ($visitsDays as $value) {
                        array_push($chartLineLabel, date("D", strtotime($value["Date"])));
                        array_push($chartLineTotalVisits, $value["TotalVisits"]);
                        array_push($chartLineUniqueVisits, $value["UniqueVisits"]);
                    }

                    self::layoutHandler($abro, $sysPath, $url, array(
                        "isDashboard" => true,
                        "TotalVisits" => array($totalVisits, $totalVisitsDiff, ($totalVisitsDiff > 0 ? $totalVisitsPercent : -1 * abs($totalVisitsPercent))),
                        "UniqueVisits" => array($uniqueVisits, $uniqueVisitsDiff, ($uniqueVisitsDiff > 0 ? $uniqueVisitsPercent : -1 * abs($uniqueVisitsPercent))),
                        "Clicks" => array($clicks, $clicksDiff, ($clicksDiff > 0 ? $clicksPercent : -1 * abs($clicksPercent))),
                        "Orders" => array($orders, $ordersDiff, ($ordersDiff > 0 ? $ordersPercent : -1 * abs($ordersPercent))),
                        "WeeklyTotalVisits" => $lastWeekTotalVisitsArray,
                        "WeeklyClicks" => $abro->getWeeklyClicks(),
                        "WeeklyOrders" => $abro->getWeeklyOrders(),
                        "chartLineLabel" => json_encode($chartLineLabel),
                        "chartLineTotalVisits" => json_encode($chartLineTotalVisits),
                        "chartLineUniqueVisits" => json_encode($chartLineUniqueVisits),
                    ));
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($url == "dashboardproducts-management") {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $categories = $abro->getAllData("categories");

                    self::layoutHandler($abro, $sysPath, $url, array(
                        "isDashboard" => true,
                        "Categories" => $categories,
                    ));
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if (strpos($url, "dashboardproducts-management") === 0) {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $url = str_replace("dashboardproducts-management", "", $url);
                    $url = intval($url);

                    if ($url != 0) {
                        if ($category = $abro->dbGet('categories', array('ID' => $url))) {
                            self::layoutHandler($abro, $sysPath, "dashboardviewcategory", array(
                                "isDashboard" => true,
                                "Category" => $category,
                                "CategoryProducts" => $abro->getAllProducts(false, $category->ID),
                            ));
                        } else {
                            header("Location: " . $baseUrl);
                        }
                    } else {
                        header("Location: " . $baseUrl);
                    }
                } else {
                    header("Location: " . $baseUrl);
                }
            } else if ($url == "dashboardorders-management") {
                if ($abro->account !== null && $abro->account->isAdmin) {
                    $orders = $abro->getAllOrders();
                    self::layoutHandler($abro, $sysPath, $url, array(
                        "isDashboard" => true,
                        "Orders" => $orders,
                    ));
                } else {
                    header("Location: " . $baseUrl);
                }
            } else {
                header("Location: " . $baseUrl);
            }
        }
    }

    static function layoutHandler($abro, $sysPath, $page, $options = array())
    {
        //adding security headers
        // header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'");
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains");

        $abro->page = $page;

        if (isset($options["Checkout"]) || (isset($options["isDashboard"]) && $options["isDashboard"])) {
            include_once($sysPath . "web_parts/$page.php");
        } else {
            $categories = $abro->getAllData("categories");

            if (isset($options["loadingScreen"])) {
                include_once($sysPath . "web_parts/header.php");
                include_once($sysPath . "web_parts/footer.php");
            } else {
                include_once($sysPath . "web_parts/header.php");
                include_once($sysPath . "web_parts/$page.php");
                include_once($sysPath . "web_parts/footer.php");
            }
        }
    }

    static function blogHandler($abro, $sysPath, $blog)
    {
        $categories = $abro->getAllData("categories");

        include_once($sysPath . "web_parts/header.php");
        include_once($sysPath . "web_parts/blog.php");
        include_once($sysPath . "web_parts/footer.php");
    }
}
?>