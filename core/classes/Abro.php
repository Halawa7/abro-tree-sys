<?php

use PHPMailer\PHPMailer\PHPMailer;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Abro
{
    protected $db;
    public $lang = "en";
    public $sysPath;
    public $baseUrl;
    public $publicPath;
    public $mainPath;
    public $page;
    public $account = null;
    public $socialMediaLinks = [
        "facebook" => "https://www.facebook.com/ABROEGYPT",
        "instagram" => "https://www.instagram.com/abro.egypt/",
    ];
    public $fawryPortalURL = 'https://www.atfawry.com';
    public $merchantCode = '400000013644';
    public $merchant_sec_key = '5aa292cf-463f-4cf4-8bd0-f6cd0bb8e747';
    public $cardTypes = [
        [
            "mask" => "0000 0000 0000 0000",
            "regex" => "/^(5[1-5]\d{0,2}|22[2-9]\d{0,1}|2[3-7]\d{0,2})\d{0,12}/",
            "cardtype" => "mastercard",
        ],
        [
            "mask" => "0000 0000 0000 0000",
            "regex" => "/^(?:5[0678]\d{0,2}|6304|67\d{0,2})\d{0,12}/",
            "cardtype" => "meeza",
        ],
        [
            "mask" => "0000 0000 0000 0000",
            "regex" => "/^4\d{0,15}/",
            "cardtype" => "visa",
        ],
        [
            "mask" => "0000 0000 0000 0000",
            "cardtype" => "meeza",
        ],
    ];

    public function __construct($sysPath, $baseUrl, $publicPath, $mainPath)
    {
        $this->db = Database::instance();

        if (isset($_COOKIE['__Secure-LANG'])) {
            if ($_COOKIE['__Secure-LANG'] == "ar" || $_COOKIE['__Secure-LANG'] == "en") {
                $this->lang = $_COOKIE['__Secure-LANG'];
            } else {
                $_COOKIE['__Secure-LANG'] = $this->lang;
                setcookie('__Secure-LANG', $this->lang, time() + (10 * 365 * 24 * 60 * 60), '/', $_SERVER['HTTP_HOST'], true, true);
            }
        } else {
            $_COOKIE['__Secure-LANG'] = $this->lang;
            setcookie('__Secure-LANG', $this->lang, time() + (10 * 365 * 24 * 60 * 60), '/', $_SERVER['HTTP_HOST'], true, true);
        }

        $this->sysPath = $sysPath;
        $this->baseUrl = $baseUrl;
        $this->publicPath = $publicPath;
        $this->mainPath = $mainPath;

        if (isset($_SESSION['ID'])) {
            if ($account = $this->dbGet('accounts', array('ID' => $_SESSION['ID']))) {
                $this->account = new Account($account, $this->db);
            }
        }

        $this->routesHandler();
    }

    public function routesHandler()
    {
        Routes::handle($this, $this->sysPath, $this->baseUrl, $this->publicPath, $this->mainPath);
    }

    public function arEn($ar, $en)
    {
        return $_COOKIE["__Secure-LANG"] == "ar" ? $ar : $en;
    }

    public function dbGet($table, $fields = array())
    {
        $columns = implode(', ', array_keys($fields));

        $sql = "SELECT * FROM `{$table}` WHERE `{$columns}` = :{$columns}";
        if ($stmt = $this->db->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
    public function dbUpdate($table, $fields, $condition)
    {
        $columns    = "";
        $where      = " WHERE ";
        $i          = 1;

        foreach ($fields as $name => $value) {
            $columns .= "`{$name}` = :{$name}";
            if ($i < count($fields)) {
                $columns .= ", ";
            }
            $i++;
        }

        $sql = "UPDATE `{$table}` SET {$columns}";
        foreach ($condition as $name => $value) {
            $sql .= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }

        if ($stmt = $this->db->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
                foreach ($condition as $key => $value) {
                    $stmt->bindValue(":{$key}", $value);
                }
            }
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

    public function dbInsert($table, $fields = array(), $getLastID = false)
    {
        $columns = implode('`, `', array_keys($fields));
        $values = implode(', :', array_keys($fields));

        $sql = "INSERT INTO {$table} (`{$columns}`) VALUES (:{$values})";
        if ($stmt = $this->db->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }
            if ($getLastID) {
                $stmt->execute();
                return $this->db->lastInsertId();
            }
            return $stmt->execute();
        }
    }

    public function dbDelete($table, $fields = array())
    {
        $columns = implode('`, `', array_keys($fields));

        $sql = "DELETE FROM `{$table}` WHERE `{$columns}` = :{$columns}";
        if ($stmt = $this->db->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

    public function getAllData($table)
    {
        $sql = "SELECT * FROM `{$table}`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchBlogs($search)
    {
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $sql = "SELECT * FROM blogs WHERE `Author` LIKE :search OR `Title` LIKE :search OR `TitleAr` LIKE :search OR `Desc` LIKE :search OR `DescAr` LIKE :search OR `Body` LIKE :search OR `BodyAr` LIKE :search";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':search' => "%" . $search . "%"
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPopularBlogs()
    {
        $sql = "SELECT * FROM `blogs` ORDER BY `Visitors` DESC LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategoryProducts($categoryID, $limit = false)
    {
        $sql = "";
        if ($limit) {
            $limit = intval($limit);
            $sql = "SELECT * FROM `products` WHERE `CategoryID` = :categoryID LIMIT " . $limit;
        } else {
            $sql = "SELECT * FROM `products` WHERE `CategoryID` = :categoryID";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":categoryID", $categoryID);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTrendingProducts($limit = false)
    {
        $sql = "";
        if ($limit) {
            $limit = intval($limit);
            $sql = "SELECT * FROM `products` ORDER BY `Views` DESC LIMIT " . $limit;
        } else {
            $sql = "SELECT * FROM `products` ORDER BY `Views` DESC";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategoryByName($categoryName)
    {
        $sql = "SELECT * FROM `categories` WHERE `Name` = :categoryName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":categoryName", $categoryName);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getProductByName($productName)
    {
        $sql = "SELECT * FROM `products` WHERE `Name` = :productName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productName", $productName);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getProductByID($productID, $categoryID)
    {
        $sql = "SELECT * FROM `products` WHERE `ID` = :productID AND `CategoryID` = :categoryID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productID", $productID);
        $stmt->bindValue(":categoryID", $categoryID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getOneProductByID($productID)
    {
        $sql = "SELECT * FROM `products` WHERE `ID` = :productID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productID", $productID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getMultiProductsByIDs($IDs)
    {
        $concat = "";
        $i = 0;
        foreach ($IDs as $id) {
            if (is_numeric($id)) {
                if ($i > 0) {
                    $concat .= " OR";
                }
                $concat .= " ID = " . $id;
                $i += 1;
            }
        }
        $sql = "SELECT * FROM `products` WHERE$concat";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductsForOrder($products)
    {
        $concat = "";

        $i = 0;
        foreach ($products as $product) {
            if (is_numeric($product["id"])) {
                if ($i > 0) {
                    $concat .= " OR";
                }

                $concat .= " p.ID = " . $product["id"];
                $i += 1;
            }
        }

        $sql = "SELECT
                p.ID AS itemId,
                p.Name AS description,
                p.Price AS price,
                p.Weight AS productWeight,
                c.Name AS productCategory,
                pi.ImgPath AS productImage
            FROM `products` p
            LEFT JOIN `productimg` pi ON p.ID = pi.ProductID AND pi.Main = 1
            LEFT JOIN `categories` c ON p.CategoryID = c.ID
            WHERE$concat";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOrderProducts($orderID)
    {
        $sql = "SELECT
                        `ProductID`, `ProductName`, `ProductImage`, `ProductPrice`, `ProductQuantity`, `ProductWeight`
                    FROM `orderproducts` WHERE `OrderID` = :orderID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderID", $orderID);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductMainImg($productID)
    {
        $sql = "SELECT * FROM `productimg` WHERE `ProductID` = :productID AND `Main` = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productID", $productID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getProductUrl($productID)
    {
        $sql = "SELECT Url FROM `products` WHERE `ID` = :productID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productID", $productID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ)->Url;
    }

    public function getProductCategory($categoryID)
    {
        $sql = "SELECT * FROM `categories` WHERE `ID` = :categoryID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":categoryID", $categoryID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getAllProducts($type = false, $categoryID = false)
    {
        $sql = "";
        if ($type == "universal") {
            $sql = "SELECT
                    p.ID,
                    c.Name AS CategoryName,
                    p.Name,
                    p.Price,
                    p.Weight,
                    p.Stock,
                    p.SKU
                FROM `categories` c
                JOIN
                    `products` p ON p.CategoryID = c.ID
                ORDER BY c.ID ASC, p.ID ASC";
        } else {
            $categoryCondition = $categoryID ? "WHERE p.CategoryID = $categoryID" : "";

            $sql = "SELECT p.*, pi.ImgPath, c.Name as CategoryName, c.NameAr as CategoryNameAr
                FROM `products` p
                LEFT JOIN `productimg` pi ON p.ID = pi.ProductID AND pi.Main = 1
                LEFT JOIN `categories` c ON p.CategoryID = c.ID
                $categoryCondition
                ORDER BY p.CategoryID ASC";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateAllProducts($updateData)
    {
        $sql = "UPDATE `products`
            SET Price = CASE ID ";

        $idPlaceholders = [];
        $values = [];

        foreach ($updateData as $row) {
            $id = $row["ID"];
            $price = $row["Price"];
            $weight = $row["Weight"];
            $sku = $row["SKU"];
            $stock = $row["Stock"];

            $sql .= "WHEN :id$id THEN :price$id ";
            $values[":id$id"] = $id;
            $values[":price$id"] = $price;
            $idPlaceholders[] = ":id$id";
        }

        $sql .= "END, Weight = CASE ID ";

        foreach ($updateData as $row) {
            $id = $row["ID"];
            $weight = $row["Weight"];

            $sql .= "WHEN :id$id THEN :weight$id ";
            $values[":weight$id"] = $weight;
        }

        $sql .= "END, Stock = CASE ID ";

        foreach ($updateData as $row) {
            $id = $row["ID"];
            $sku = $row["Stock"];

            $sql .= "WHEN :id$id THEN :stock$id ";
            $values[":stock$id"] = $sku;
        }
        $sql .= "END, Stock = CASE ID ";

        foreach ($updateData as $row) {
            $id = $row["ID"];
            $sku = $row["Stock"];

            $sql .= "WHEN :id$id THEN :stock$id ";
            $values[":stock$id"] = $sku;
        }

        $sql .= "END WHERE ID IN (" . implode(",", $idPlaceholders) . ")";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($values);
    }
    public function updateProductsBySKU($products)
    {
        try {
            foreach ($products as $key => $prd) {
                $this->dbUpdate('products', $prd, ['SKU' => $prd['SKU']]);
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function emailExist($email)
    {
        $email = $this->dbGet('accounts', array('Email' => $email));
        return ((!empty($email))) ? $email : false;
    }

    public function IDExist($ID)
    {
        $ID = $this->dbGet('accounts', array('ID' => $ID));
        return ((!empty($ID))) ? $ID : false;
    }

    public function logout()
    {
        if ($this->account !== null) {
            $_SESSION = array();
            $this->account = null;

            session_destroy();
        }

        header("Location: " . $this->baseUrl);
    }

    public function passHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function IDHash($ID)
    {
        return hash('whirlpool', $ID);
    }

    public function neverRepeatID($uniqueID, $number, $email, $password, $firstName, $lastName)
    {
        if ($this->IDExist($uniqueID)) {
            return true;
        } else {
            date_default_timezone_set("Africa/Cairo");
            $DateNow = date("Y-m-d H:i:s");

            $this->dbInsert('accounts', array('ID' => $uniqueID, 'PhoneNumber' => $number, 'Email' => $email, 'Password' => $this->passHash($password), 'FirstName' => $firstName, 'LastName' => $lastName, 'DefaultAddressID' => 0, 'JoinedDate' => $DateNow));
            $_SESSION['ID'] = $uniqueID;

            header("Location: " . $this->baseUrl . "account/");

            return false;
        }
    }

    public function searchProducts($search, $bulk = false)
    {
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $sql = "SELECT * FROM products WHERE `Name` LIKE :search OR `NameAr` LIKE :search OR `Desc` LIKE :search OR `DescAr` LIKE :search OR `SKU` LIKE :search
            ORDER BY
                CASE
                    WHEN `Name` LIKE :search THEN 1
                    WHEN `NameAr` LIKE :search THEN 2
                    ELSE 3
                END" . ($bulk ? "" : " LIMIT 16");
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':search' => "%" . $search . "%"
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function visitHandle()
    {
        $sql = "INSERT INTO `visitors` (`Url`, `Date`, `IpAddress`) VALUES (:uUrl, :nowDate, :ipAddress)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":uUrl", $_SERVER['REQUEST_URI']);
        $stmt->bindValue(":nowDate", date("Y-m-d H:i:s"));
        $stmt->bindValue(":ipAddress", $this->getIPAddress());
        return $stmt->execute();
    }

    public function getWeeklyViews($lastWeek = false)
    {
        $sql = "SELECT * FROM `visitors` WHERE CAST(Date AS Date) >= :startDate AND CAST(Date AS Date) <= :endDate";
        $stmt = $this->db->prepare($sql);

        $startDate = $lastWeek ? date('Y-m-d', strtotime("-14 days")) : date('Y-m-d', strtotime("-7 days"));
        $stmt->bindValue(":startDate", $startDate);

        $endDate = $lastWeek ? date('Y-m-d', strtotime("-7 days")) : date("Y-m-d");
        $stmt->bindValue(":endDate", $endDate);

        $stmt->execute();
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getIPAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function getVisitsByType($type, $yesterday = false)
    {
        if ($type == "total") {
            $sql = "SELECT * FROM `visitors` WHERE CAST(Date AS Date) = :date";
            $stmt = $this->db->prepare($sql);

            $date = $yesterday ? date('Y-m-d', strtotime("-1 days")) : date("Y-m-d");
            $stmt->bindValue(":date", $date);

            $stmt->execute();
            return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
        } else if ($type == "unique") {
            $sql = "SELECT DISTINCT IpAddress FROM `visitors` WHERE CAST(Date AS Date) = :date";
            $stmt = $this->db->prepare($sql);

            $date = $yesterday ? date('Y-m-d', strtotime("-1 days")) : date("Y-m-d");
            $stmt->bindValue(":date", $date);

            $stmt->execute();
            return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }
    }

    public function getVisitsDays()
    {
        $sql = "SELECT DISTINCT CAST(`Date` AS Date) FROM `visitors` ORDER BY `Date` DESC LIMIT 9";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllVisitsOfDays($days)
    {
        if (is_array($days) && count($days) > 0) {
            $sql = "SELECT `Date`, COUNT(CAST(`Date` AS Date)) AS TotalVisits, COUNT(DISTINCT `IpAddress`) AS UniqueVisits FROM `visitors` WHERE";
            foreach ($days as $key => $value) {
                $value = reset($value);
                if (($key + 1) == count($days)) {
                    $sql .= " CAST(`Date` AS Date) = '$value' GROUP BY CAST(`Date` AS Date)";
                } else {
                    $sql .= " CAST(`Date` AS Date) = '$value' OR";
                }
            }

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function clicksHandle()
    {
        $sql = "INSERT INTO `clicks` (`Date`, `IpAddress`) VALUES (:nowDate, :ipAddress)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":nowDate", date("Y-m-d H:i:s"));
        $stmt->bindValue(":ipAddress", $this->getIPAddress());
        return $stmt->execute();
    }

    public function getClicksByType($yesterday = false)
    {
        $sql = "SELECT * FROM `clicks` WHERE CAST(Date AS Date) = :date";
        $stmt = $this->db->prepare($sql);

        $date = $yesterday ? date('Y-m-d', strtotime("-1 days")) : date("Y-m-d");
        $stmt->bindValue(":date", $date);

        $stmt->execute();
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getWeeklyClicks()
    {
        $sql = "SELECT * FROM `clicks` WHERE CAST(Date AS Date) >= :startDate AND CAST(Date AS Date) <= :endDate";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":startDate", date('Y-m-d', strtotime("-7 days")));
        $stmt->bindValue(":endDate", date("Y-m-d"));

        $stmt->execute();
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }
    public function getOrderingCustomers($limit = false)
    {
        $sql = 'SELECT o.FirstName, o.LastName, o.Email, o.PhoneNumber, o.Governorate, o.Area,
            COUNT(DISTINCT o.ID) AS TotalOrders,
            SUM(op.ProductPrice * op.ProductQuantity) AS TotalSpent,
            MAX(o.Date) AS LastOrderDate,
            CASE WHEN a.ID IS NOT NULL THEN 1 ELSE 0 END AS HasAccount
            FROM orders o 
            JOIN orderproducts op ON o.ID = op.OrderID
            LEFT JOIN accounts a ON a.ID = o.CustomerID
            WHERE o.Status = "proceeded"
            GROUP BY o.Email
            ORDER BY TotalSpent DESC';

        if ($limit) {
            $sql .= ' LIMIT :limit';
        }

        if ($stmt = $this->db->prepare($sql)) {
            if ($limit) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    function formatOrderDate($customers)
    {
        foreach ($customers as &$customer) {
            $lastOrderDate = new DateTime($customer['LastOrderDate']);
            $now = new DateTime();
            $interval = $now->diff($lastOrderDate);
            if ($interval->y > 0) {
                $customer['LastOrderDisplay'] = "منذ حوالى " . $interval->y . " " . ($interval->y > 1 & $interval->y < 11 ? "سنوات" : "سنة");
            } elseif ($interval->m > 0) {
                $customer['LastOrderDisplay'] = "منذ حوالى " . $interval->m . " " . ($interval->m > 1 & $interval->m < 11 ? "شهور" : "شهر");
            } elseif ($interval->d > 0) {
                $customer['LastOrderDisplay'] = "منذ حوالى " . $interval->d . " " . ($interval->d > 1 & $interval->d < 11 ? "أيام" : "يوم");
            } else {
                $customer['LastOrderDisplay'] = "اليوم";
            }
        }
        return $customers;
    }
    // PromoCodes
    public function checkUserPromoCode($promoCodeID)
    {
        $accountID = $this->account->ID;
        $sql = '
        SELECT up.Usage, p.ExpiresDate 
        FROM userpromocodes up
        JOIN promocodes p ON up.PromoCodeID = p.ID
        WHERE up.AccountID = :account_id 
        AND up.PromoCodeID = :promocode_id
    ';

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bindValue(':account_id', $accountID);
            $stmt->bindValue(':promocode_id', $promoCodeID);
            $stmt->execute();
            $userPromo = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userPromo) {
                $currentDate = new DateTime('now', new DateTimeZone('Africa/Cairo'));
                $expiresDate = new DateTime($userPromo['ExpiresDate'], new DateTimeZone('Africa/Cairo'));

                if ($userPromo['Usage'] == 1) {
                    // Promo code has already been used by the user
                    $result = false;
                } elseif ($currentDate > $expiresDate) {
                    // Promo code has expired
                    $result = false;
                } else {
                    // Promo code is valid and unused
                    $result = true;
                }
            } else {
                // Promo code not found in user records
                $result = true;
            }
        } else {
            return null;
        }

        return $result;
    }
    // public function handleUserPromoCode ($promoCodeID) {
    //         // $accountID = $this->account->ID;
    //         $accountID = "d2ec5baca49acd53194ba9cc0c34f0a1fa806b55290a45286ddb227ce52c59c0a42d0046b28a145250ac84eea86ec5bfdf61d17d10bbb2305829791c8fb67ee8";                $result = false;
    //         $sql = 'SELECT  * FROM `userpromocodes` where `AccountID` = :account_id And `PromoCodeID` = :promocode_id';
    //         if ($stmt = $this->db->prepare($sql)) {
    //         $stmt->bindValue(':account_id', $accountID);
    //         $stmt->bindValue(':promocode_id', $promoCodeID);
    //         $stmt->execute();
    //         $userPromo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //             if ($userPromo && $userPromo[0] && $userPromo[0]['Usage'] == 1) {
    //                 # deny
    //                 $result = false;
    //             }else{
    //             # allow using promoCode
    //             $this->dbInsert("userpromocodes",array("AccountID"=>$accountID,"PromoCodeID"=>$promoCodeID));
    //             $result = true;
    //             }
    //         }else {
    //             return null;
    //         }
    //         return $result;
    // }
    // reviews
    public function getProductRating($productID)
    {
        $sql = 'SELECT  avg(Stars) as Rating FROM `reviews` where `ProductID` = :product_id group by `ProductID`';
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bindValue(':product_id', $productID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    public function getAccountProductReview($accountID, $productID)
    {
        $sql = 'SELECT * FROM reviews WHERE ProductId = :product_id AND AccountId = :account_id';
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bindValue(':product_id', $productID);
            $stmt->bindValue(':account_id', $accountID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    public function createReview($productID, $accountID, $stars)
    {
        return $this->dbInsert('reviews', ['ProductID' => $productID, 'AccountId' => $accountID, 'Stars' => $stars]);
    }
    public function updateReview($productID, $accountID, $stars)
    {
        return $this->dbUpdate('reviews', ['stars' => $stars], ['ProductId' => $productID, 'AccountId' => $accountID,]);
        // $this->dbGet('reviews',['ProductId'=>$productID,'AccountId'=>$accountID]);
        // return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getLastOrderID()
    {
        $sql = "SELECT `ID` FROM `orders` ORDER BY `ID` DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOrders()
    {
        $sql = "SELECT * FROM `orders` ORDER BY `Date` DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getOrderByID($orderID)
    {
        $sql = "SELECT * FROM `orders` WHERE `ID` = :orderID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderID", $orderID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderByCustomerID($cutomerID)
    {
        $sql = "SELECT
                o.ID, o.PaymentMethod, o.PaymentStatus, o.Status, o.Date, o.CardNumber,
                (SUM(op.ProductPrice * op.ProductQuantity) - o.DiscountValue + o.ShippingFees + o.CODFees) AS Net
            FROM `orders` o
            LEFT JOIN `orderproducts` op ON op.OrderID = o.ID
            WHERE o.CustomerID = :cutomerID
            GROUP BY op.OrderID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":cutomerID", $cutomerID);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOrdersByType($yesterday = false)
    {
        $sql = "SELECT * FROM `orders` WHERE CAST(Date AS Date) = :date";
        $stmt = $this->db->prepare($sql);

        $date = $yesterday ? date('Y-m-d', strtotime("-1 days")) : date("Y-m-d");
        $stmt->bindValue(":date", $date);

        $stmt->execute();
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }
    public function getLowStockOrders($threshold = 2)
    {
        $sql = "SELECT ID, Name, Stock FROM products WHERE Stock <= :threshold ORDER BY Stock ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['threshold' => $threshold]);
        return $stmt->fetchAll();
    }
    public function getHighOrderedProducts()
    {
        $sql = "
        SELECT 
            p.ID, 
            p.Name, 
            SUM(op.ProductQuantity) AS totalOrdered
        FROM products p
        JOIN orderproducts op ON p.ID = op.ProductID
        GROUP BY p.ID, p.Name
        ORDER BY totalOrdered DESC LIMIT 10
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getOrdersEarningsLast30Days()
    {
        $sql = "
        SELECT
            o.ID, 
            o.PaymentMethod,    
            o.PaymentStatus, 
            o.Status, 
            o.Date, 
            o.CardNumber,
            (SUM(op.ProductPrice * op.ProductQuantity) - o.DiscountValue + o.ShippingFees + o.CODFees) AS Net
        FROM orders o
        LEFT JOIN orderproducts op ON op.OrderID = o.ID
        WHERE o.Date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
        AND o.Status = 'proceeded'
        GROUP BY o.ID";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getOrdersEarningsByDateRange($startDate = null, $endDate = null)
    {
        if (!$startDate || !$endDate) {
            $startDate = date('Y-m-d', strtotime('-30 days'));
            $endDate = date('Y-m-d');
        }

        $sql = "
        SELECT
            o.ID, 
            o.PaymentMethod,    
            o.PaymentStatus, 
            o.Status, 
            o.Date, 
            o.CardNumber,
            (SUM(op.ProductPrice * op.ProductQuantity) - o.DiscountValue + o.ShippingFees + o.CODFees) AS Net
        FROM orders o
        LEFT JOIN orderproducts op ON op.OrderID = o.ID
        WHERE o.Date BETWEEN :startDate AND :endDate
        AND o.Status = 'proceeded'
        GROUP BY o.ID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getWeeklyOrders()
    {
        $sql = "SELECT * FROM `orders` WHERE CAST(Date AS Date) >= :startDate AND CAST(Date AS Date) <= :endDate";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":startDate", date('Y-m-d', strtotime("-7 days")));
        $stmt->bindValue(":endDate", date("Y-m-d"));

        $stmt->execute();
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getAllOrders()
    {
        $sql =
            "SELECT
            o.ID,
            o.PaymentMethod,
            o.PaymentStatus,
            o.Status,
            o.Date,
            o.Email AS CustomerEmail,
            o.ShippingFees,
            o.CODFees,
            o.DiscountValue,
            o.IsCashbackEarned,
            o.Country,
            o.CustomerID,
            CONCAT(FirstName, ' ', LastName) AS CustomerName,
            o.Address,
            o.Governorate,
            (SUM(op.ProductPrice * op.ProductQuantity) - o.DiscountValue + o.ShippingFees + o.CODFees) AS Net,
            o.CardNumber
        FROM `orders` o
        LEFT JOIN `orderproducts` op ON op.OrderID = o.ID
        GROUP BY o.ID
        ORDER BY o.Date DESC
        LIMIT 100;";
        // old query not working any more on mysql v 8.
        // "SELECT
        //     o.ID, o.PaymentMethod, o.PaymentStatus, o.Status, o.Date, o.Email AS CustomerEmail, o.ShippingFees,
        //     o.CODFees, o.DiscountValue, o.Country, CONCAT(FirstName, ' ', LastName) AS CustomerName,
        //     o.Address, o.Governorate, (SUM(op.ProductPrice * op.ProductQuantity) - o.DiscountValue + o.ShippingFees + o.CODFees) AS Net,
        //     o.CardNumber
        // FROM `orders` o
        // LEFT JOIN `orderproducts` op ON op.OrderID = o.ID
        // GROUP BY op.OrderID DESC LIMIT 100";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function number_format_short($n, $precision = 1)
    {
        if ($n < 900) {
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }

    public function placeOrder($payment_method, $paymentInfo, $promoCode, $cashback_discount)
    {
        require_once $this->publicPath . 'GuzzleHttp/vendor/autoload.php';

        $merchantRefNum = $this->dbInsert("orders", array("PaymentMethod" => strtolower($payment_method), "Date" => date("Y-m-d H:i:s"), "Status" => "pending"), true);

        $amount = 0;
        $discountValue = 0;
        $shippingFees = 0;
        $cashBack = 0;

        $products = $this->getProductsForOrder($paymentInfo["products"]);
        if ($promoCode && $promoCode->FreeShipping) {
            $shippingFees = 0;
        } else {
            $shippingFees = $this->calculateShippingFees($paymentInfo["products"], $products, area: $paymentInfo["information"]["governorate"], nocart: false);
        }

        $orderProducts = array();
        foreach ($products as $key => $product) {
            $index = array_search($product["itemId"], array_column($paymentInfo["products"], 'id'));
            $quantity = intval($paymentInfo["products"][$index]["quantity"]);
            // add promoCode discount
            $amount += $product["price"] * $quantity;
            $products[$key]["quantity"] = $quantity;

            array_push($orderProducts, array(
                "OrderID" => $merchantRefNum,
                "ProductID" => $product["itemId"],
                "ProductCategory" => $product["productCategory"],
                "ProductName" => $product["description"],
                "ProductImage" => $product["productImage"],
                "ProductPrice" => $product["price"],
                "ProductQuantity" => $quantity,
                "ProductWeight" => $product["productWeight"],
            ));

            unset($products[$key]["productImage"]);
            unset($products[$key]["productCategory"]);
            unset($products[$key]["productWeight"]);
        }

        $this->insertOrderProducts($orderProducts);
        $no_discount_amount = $amount;
        $order_cashback_discount = 0;
        // moved here to reduce complicity
        // get current account
        if ($this->account && $this->account->ID) {
            $userCashback = $this->dbGet('cashbacks', ['UserId' => $this->account->ID]) ? $this->dbGet('cashbacks', ['UserId' => $this->account->ID]) : null;
            $userCashbackAmount = 0;
            // add cashback discount
            if ($userCashback != null && $userCashback->Amount > 0) {
                $userCashbackAmount += $userCashback->Amount;
                $user_cashback_percent = $userCashbackAmount * ($no_discount_amount / 100);
                if ($cashback_discount == 10 && $user_cashback_percent >= 10) {
                    $this->dbUpdate('cashbacks', ['amount' => $userCashbackAmount -  ($no_discount_amount * (10 / 100))], ['UserID' => $this->account->ID]);
                    $discountValue +=  ($no_discount_amount * (10 / 100));
                    $amount -= 10 * ($no_discount_amount / 100);
                    // add cashback discount to the order
                    $order_cashback_discount = 10;
                } elseif ($cashback_discount == 25 && $user_cashback_percent >= 25) {
                    $this->dbUpdate('cashbacks', ['amount' => $userCashbackAmount -  ($no_discount_amount * (25 / 100))], ['UserID' => $this->account->ID]);
                    $discountValue +=  ($no_discount_amount * (25 / 100));
                    $amount -= 25 * ($no_discount_amount / 100);
                    // add cashback discount to the order
                    $order_cashback_discount = 25;
                } elseif ($cashback_discount == 50 && $user_cashback_percent >= 50) {
                    $this->dbUpdate('cashbacks', ['amount' => $userCashbackAmount -  ($no_discount_amount * (50 / 100))], ['UserID' => $this->account->ID]);
                    $discountValue += ($no_discount_amount * (50 / 100));
                    $amount -= 50 * ($no_discount_amount / 100);
                    // add cashback discount to the order
                    $order_cashback_discount = 50;
                } else {
                    // rejected
                }
                // add earned cashbaack
                // $order_cashback_discount_value =  $order_cashback_discount *($no_discount_amount / 100);
                // $cashBack +=  ($no_discount_amount - $order_cashback_discount_value) * (5 / 100);
                // $this->handleCashBack($cashBack);
            }
        } else {
            //rejected
        }
        // 10% discount t to specific date
        $currentDate = new DateTime();
        $currentMonth = $currentDate->format('m');
        $currentYear = $currentDate->format('Y');
        if ($currentMonth < 12 && $currentYear == 2024) {
            $discountValue += ($no_discount_amount * (10 / 100));
            $amount -= $discountValue;
        }
        // add promoCode discount
        if ($promoCode && $promoCode->DiscountPercent) {
            $discountValue += ($no_discount_amount * ($promoCode->DiscountPercent / 100));
            $amount -= $discountValue;
        }
        //Calculate shipping fees
        $amount += $shippingFees;

        array_push($products, array(
            "itemId" => "ShippingFeesID",
            "description" => "Shipping Fees",
            "price" => number_format($shippingFees, 2, ".", ""),
            "quantity" => 1.00,
        ));
        // }

        $amount = number_format($amount, 2, ".", "");
        $phoneNumber = preg_replace("/[^0-9]/", "", $paymentInfo["information"]["phoneNumber"]);
        $email = $this->account === null ? $paymentInfo["information"]["email"] : $this->account->email;

        try {
            $orderInfo = array(
                "CustomerID" => $this->account !== null ? $this->account->ID : "",
                'Email' => $email,
                'Country' => 'Egypt',
                'FirstName' => $paymentInfo["information"]["firstName"],
                'LastName' => $paymentInfo["information"]["lastName"],
                'Address' => $paymentInfo["information"]["address"],
                'Area' => $paymentInfo["information"]["area"],
                'Governorate' => $paymentInfo["information"]["governorate"],
                'PostalCode' => $paymentInfo["information"]["postalCode"],
                'PhoneNumber' => $phoneNumber,
                'ShippingFees' => $shippingFees,
                'DiscountValue' => $discountValue,
                'CashbackDiscount' => $order_cashback_discount
            );

            if (isset($paymentInfo["information"]["Company"]) && strlen($paymentInfo["information"]["Company"]) > 0) {
                $orderInfo['Company'] = $paymentInfo["information"]["Company"];
            }

            if (isset($paymentInfo["information"]["extraAddress"]) && strlen($paymentInfo["information"]["extraAddress"]) > 0) {
                $orderInfo['AdditionalInformation'] = $paymentInfo["information"]["extraAddress"];
            }

            if ($payment_method != "COD") {
                $httpClient = new \GuzzleHttp\Client();
                $requestData = [
                    'merchantCode' => $this->merchantCode,
                    'merchantRefNum' => $merchantRefNum,
                    'customerMobile' => $phoneNumber,
                    'customerEmail' => $email,
                    'amount' => $amount,
                    'currencyCode' => 'EGP',
                    'language' => 'en-gb',
                    'chargeItems' => $products,
                    'paymentMethod' => $payment_method,
                    'description' => 'Checkout Order',
                    'orderWebHookUrl' => 'https://www.abroegypt.com/payment-notification'
                ];

                if ($payment_method == "CARD") {
                    if (isset($paymentInfo["cardInformation"]["cardName"]) && strlen($paymentInfo["cardInformation"]["cardName"]) > 0) {
                        $orderInfo['CardName'] = $paymentInfo["cardInformation"]["cardName"];
                    }

                    $cardNumber = preg_replace("/[^0-9]/", "", $paymentInfo["cardInformation"]["cardNumber"]);
                    // $orderInfo['CardNumber'] = $requestData['cardNumber'] = $cardNumber;
                    $requestData['cardNumber'] = $cardNumber;
                    $orderInfo['CardNumber'] = $this->encryptCardNumber($cardNumber);

                    $orderInfo['CardExpiryYear'] = $requestData['cardExpiryYear'] = $paymentInfo["cardInformation"]["cardExpiryYear"];
                    $orderInfo['CardExpiryMonth'] = $requestData['cardExpiryMonth'] = $paymentInfo["cardInformation"]["cardExpiryMonth"];
                    // $orderInfo['CVV'] = $requestData['cvv'] = $paymentInfo["cardInformation"]["cvv"];
                    $requestData['cvv'] = $paymentInfo["cardInformation"]["cvv"];
                    $orderInfo['CVV'] = $this->encryptCardNumber($paymentInfo["cardInformation"]["cvv"]);

                    $requestData['enable3DS'] = true;
                    $requestData['authCaptureModePayment'] = false;
                    $requestData['returnUrl'] = $this->baseUrl . "checkout-payment-handle";

                    $signature = hash('sha256', $this->merchantCode . $merchantRefNum . $payment_method . $amount . $requestData['cardNumber'] . $requestData['cardExpiryYear'] . $requestData['cardExpiryMonth'] . $requestData['cvv'] . $requestData['returnUrl'] . $this->merchant_sec_key);
                    $requestData['signature'] = $signature;
                } else {
                    $signature = hash('sha256', $this->merchantCode . $merchantRefNum . $payment_method . $amount . $this->merchant_sec_key);
                    $requestData['signature'] = $signature;
                }

                $response = $httpClient->request('POST', $this->fawryPortalURL . '/ECommerceWeb/Fawry/payments/charge', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept'       => 'application/json'
                    ],
                    'body' => json_encode($requestData, true)
                ]);
                $response = json_decode($response->getBody()->getContents(), true);

                if ($response["statusCode"] == 200) {
                    if ($payment_method == "PAYATFAWRY") {
                        $orderInfo['fawryRefNumber'] = $response["referenceNumber"];
                    }

                    $this->dbUpdate("orders", $orderInfo, array("ID" => $merchantRefNum));

                    if ($payment_method == "CARD") {
                        if (isset($response["nextAction"])) {
                            return array("nextAction" => $response["nextAction"], "id" => $merchantRefNum);
                        } else {
                            return array("id" => $merchantRefNum);
                        }
                    } else {
                        return array("ref" => $response["referenceNumber"], "id" => $merchantRefNum);
                    }
                } else {
                    $this->dbUpdate("orders", $orderInfo, array("ID" => $merchantRefNum));

                    error_log(json_encode($response));
                    return false;
                }
            } else {
                // if($firstOrder){
                //     $orderInfo['CODFees'] = 10;
                // }else{
                $orderInfo['CODFees'] = intval($amount + 10) > 1000 ? ceil(($amount + 10)  * 1 / 100) : 10;
                // echo json_encode(['cod'=>$orderInfo['CODFees']]);
                // echo json_encode(['amount'=>$amount,'orderInfo'=>$orderInfo]);
                // }
                $this->dbUpdate("orders", $orderInfo, array("ID" => $merchantRefNum));

                return true;
            }
        } catch (Exception $e) {
            $orderInfo["PaymentStatus"] = "failed";
            $orderInfo["FailureReason"] = "Apologies, an error has occurred. Try again later.";

            $this->dbUpdate("orders", $orderInfo, array("ID" => $merchantRefNum));
            // restore customer's cashback
            // if ($this->account && $this->account->ID) {
            //     $customerID = $this->account->ID;
            //     $cashback = $abro->dbGet("cashbacks", array("UserID"=> $customerID));
            //     $order =  $this->dbGet("orders", array("ID" => $merchantRefNum));
            //     $orderProducts = $abro->getOrderProducts($merchantRefNum);
            //     $subTotal = 0;
            //     foreach ($orderProducts as $i => $product) {
            //         $subTotal += $product["ProductQuantity"] * $product["ProductPrice"];
            //     }
            //     // restore used cashback to account
            //     if ($order->CashbackDiscount > 0) {
            //         $new_cashback_amount = $cashback->Amount + ($subTotal * ($order->CashbackDiscount / 100));
            //     }
            //     $abro->dbUpdate("cashbacks", array("Amount"=> $new_cashback_amount), array("UserID"=> $customerID));
            // }
            error_log($e->getMessage());
            return false;
        }
    }
    public function handleCashBack($cashBack)
    {
        if ($this->account != null && $this->account->ID) {
            $account_cashback =  $this->dbGet('cashbacks', ['UserId' => $this->account->ID]) ? $this->dbGet('cashbacks', ['UserId' => $this->account->ID]) : null;
            if ($account_cashback == null) {
                //add new cashback column
                $this->dbInsert('cashbacks', ['UserID' => $this->account->ID, 'Amount' => number_format($cashBack, 2)]);
            } else {
                //update the existing cashback column
                $this->dbUpdate('cashbacks', ['Amount' => $account_cashback->Amount + number_format($cashBack, 2)], ['UserID' => $this->account->ID]);
            }
        }
    }
    public function calculateShippingFees($cartProducts, $products = null, $area = "CA", $nocart = false)
    {
        $weight = 0;
        $amountForFirst2kg = 0;
        $eachAddKg = 0;
        $fees = 0;
        $hasOil = false;
        if ($products === null) {
            $products = $this->getProductsForOrder($cartProducts);
        }
        if ($nocart == false) {
            foreach ($products as $key => $product) {
                $index = array_search($product["itemId"], array_column($cartProducts, 'id'));
                $quantity = intval($cartProducts[$index]["quantity"]);
                $weight += $product["productWeight"] * $quantity;
                if ($product['productCategory'] == 'Engine Oils') {
                    $hasOil = true;
                }
            }
        } else {
            // echo json_encode(['weight'=>$products]);
            foreach ($products as $key => $product) {
                $weight += $product['ProductWeight'] * $product['ProductQuantity'];
                if ($product['productCategory'] == 'Engine Oils') {
                    $hasOil = true;
                }
                // echo json_encode(['sub'=>$product['ProductWeight'] * $product['ProductQuantity']]);
            }
        }
        $weight = ceil($weight);
        if ($area == "CA" || $area == "GIZA") {
            $amountForFirst2kg = 46;
            $eachAddKg = 7;
        } else if ($area == "ALX") {
            $amountForFirst2kg = 39;
            $eachAddKg = 5;
        } else {
            $amountForFirst2kg = 86;
            $eachAddKg = 14;
        }
        // calc weight and distance fees
        if ($weight <= 2) {
            $fees = $amountForFirst2kg;
        } else {
            $fees = $amountForFirst2kg + (($weight - 2) * $eachAddKg);
        }
        // add value-added tax 14%
        $vat = ($fees + 10) * 14 / 100;
        $fees = ceil($fees += $vat);
        if ($hasOil) {
            $fees = 0;
        }
        // echo json_encode([$fees]);
        // echo json_encode(['ship'=>$fees,'hasoil'=>$hasOil]);
        return $fees;
        // return 33;
    }

    public function insertOrderProducts($orderProducts)
    {
        $concat = "";
        foreach ($orderProducts as $key => $product) {
            $concat .= "(" . $product["OrderID"] . ", " . $product["ProductID"] . ", '" . $product["ProductCategory"] . "', '" . $product["ProductName"] . "', '" . $product["ProductImage"] . "', " . $product["ProductPrice"] . ", " . $product["ProductQuantity"] . ", " . $product["ProductWeight"] . ")";

            if ($key + 1 != count($orderProducts)) {
                $concat .= ", ";
            }
        }

        $sql = "INSERT INTO `orderproducts` (OrderID, ProductID, ProductCategory, ProductName, ProductImage, ProductPrice, ProductQuantity, ProductWeight)
            VALUES $concat";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    public function getCardType($encryptedCardNumber)
    {
        $decryptedCardNumber = $this->decryptCardNumber($encryptedCardNumber);
        foreach ($this->cardTypes as $cardType) {
            if (isset($cardType['regex']) && preg_match($cardType['regex'], $decryptedCardNumber)) {
                return $cardType['cardtype'];
            }
        }
    }
    public function encryptCardNumber($cardNumber)
    {
        $key = "info@treeegypt#card-ecrypt";
        $number = $cardNumber;
        $encryptedNumber = openssl_encrypt(strval($number), "AES-128-CBC", $key);
        return $encryptedNumber;
    }
    public function decryptCardNumber($encryptedCardNumber)
    {
        $key = "info@treeegypt#card-ecrypt";
        $number = $encryptedCardNumber;
        $encryptedNumber = openssl_decrypt(strval($number), "AES-128-CBC", $key);
        return $encryptedNumber;
    }

    public function sendOrderToMylerz($orderID)
    {
        require_once $this->publicPath . 'GuzzleHttp/vendor/autoload.php';

        $endpoint = 'https://integration.mylerz.net/api/Orders/AddOrders';
        // $token = 'BSqv6cv-UxKB_sntYxdWzZ5Mv-eIimKhNrumd0JBHXdBafFo7yiJvwjwTPm2TJWFikI8YFtuKGK1Ac_Mruvm8JbFKDh4GBqxqXkreWx_m_i13U9wWHB-n1uJL7isK-jYUXozUmIA2xru7z8PCGIkXn3KIOU82sJEHzO0rGbAsDfaWNU4v-G4zmF_V7cHsRY1S8OxkoK_uKusEsgnmS4Al-CcMvtIHFU0bVBLF8aipzs5_H94pDU4QTI4ieCcO4Z_4NSTGBNhwNBoMY27ExvuE7CsFdRWweHxB8Wuzct4X4IRbcYOFYZaB-z4c5muiNPrUL5IkUdyC6sa2pdtFs0Q5cRPNVMGJZFaLs2RHYowb8Qy3YIZuzDN2mW-dFQOd7Y5NXlENFq_9IAnzaJ0OTDpfSoJoJRMbuCBAUlAR91m4Dzh6CRCkTCOA041aw180nY9hZB1-dCpLgG_OQTM4nitb3-mfrZxslJMHUSVbWW8zQDBgMdekfTBWAXU6I5tCTIZ1-vuZo-z1Znchw_uPYeb5tPMF4GIyNAgQeEC3EzFs4o';
        // $token = 'n5LDSJMaeXTuk-2DUk2P2U0JzGVSPsduhqChVzbfqS7m0ybidrI0JgP9jVxZHueK7vx7HwRvxATCkgYGLlET66LEKMjKdjJy9pTWiImFb3Wf4GtxORIC4_DscoIZFW6AOVhAcSFHgjVArop8bi-s6fM8mJmszUJFgkfhzAdoIlQ0fzJtciz4DrqaIAGGCEO2uXeWQ46-5Q6O0-4DDKtWunZTVi3UtuYFwPU3sOMgrWdFltAkaM9cdLVVoKA94sCAbZm4Sj9dvmNgT24-cWZJoMz_0fKGqDF_VLhKq9NeCio5fSTri-p_ZEAnKxe0QBN8FpxVVsCNWuT3pC75Uocqxt7PeHbemc7FYhWgLrsJaKiLm0UYlmo_0lY9tBxpl8e95Q2ScEyxOisPMIpPRb-lPBklC5a5UEh5iHijKQCmk4aXiOkw9kYj79iAmFOBOe7tBVMe22ICmJQqlOUQORX4xeLdiVEGBmNJaEM02tsHu7ph8eadTTi7GSwl5dxqBeaPhGASeC0l37KgEURBctG3w1bl80sItqsLDUhBpbs1gC0';
        // created at 12/10/2024
        $token = 'GsG9a6kKPp5Aiw453pM-yScNuXHe1FH9jeiTNXoVAURYOdH1n3VEMcZkJ6FCb_9pPaUFNg_TPe7fLXeuZtcRL4ifeA_USogElhtP-4NeqflmX1Iwp1Mtbj2LT94m-uHUuqrHiQzg-w01UpZHTyzbs9VzZwDaTLJU_E2uNbRR1i_UzqUBlsBnzOOPilmR_fYsBiAdZqJy4fkT5dI3g-Nkloa1pSnn2udsI6uiP0BqnxNfMxprOsouVr_xle3xbvWPGjiaqocirHAyizLh_gfoycIvtLUcrHAvT2HDWEwgL3IcXChFWg3nUKPI1Ed6VCtXi2xRiT1C8Cm-jg2-qKdhlZ3pNvePM7VPXIAHU2w6vdJfLc6aTkub8b36TgQeNPo_BemJ4mMINhqu8Q0eNBdZxALZOVhWC2Ch2BSuw7uyoRh1a6sk_fJBlgEIaN4mZuXCHmOupQCnntftkr4QwXCo3bZ9FUIj9Qv7mphZbjuZEuZiVUu73IhZuR0zaJeyXc1WfYyUFGLHh6PuRphMdzoByAd0JyskHT9hirEq_2uBC6c';

        $order = $this->getOrderByID($orderID);

        $totalWeight = 0;
        $subTotal = 0;
        $productsCount = 0;
        $pieces = array();

        $orderProducts = $this->getOrderProducts($orderID);
        // echo json_encode(['prds'=>$orderProducts]);
        // $shipping_fees = $this->calculateShippingFees( $orderProducts,products:$orderProducts, area:$order['Governorate'], nocart:true);
        foreach ($orderProducts as $i => $product) {
            $totalWeight += $product["ProductQuantity"] * $product["ProductWeight"];
            $subTotal += $product["ProductQuantity"] * $product["ProductPrice"];
            $productsCount += $product["ProductQuantity"];

            // $pieceData = array_fill(0, $product["ProductQuantity"], array(
            //     'pieceNo' => $product['ProductID'],
            //     'Weight' => $product["ProductWeight"],
            // ));

            // $pieces = array_merge($pieces, $pieceData);
        }

        //To be removed if want to add more than one piece
        $pieces = array(
            array(
                "pieceNo" => $orderID,
                "Weight" => "$totalWeight"
            )
        );
        // modify after summer time ends
        $egyptDateTime = date_modify(date_create("now", timezone_open("Africa/Cairo")), '+1 hour');
        $egy_date =  date_format($egyptDateTime, 'Y-m-d\TH:i:s');
        // changed 'Service' => 'SD',
        $data = [
            [
                'Package_Serial' => $orderID,
                'Description' => 'A package with ' . $productsCount . ' items be sure that be received',
                'Total_Weight' => $totalWeight,
                'Service_Type' => 'DTD',
                'Service' => 'ND',
                'Service_Category' => 'Delivery',
                'Payment_Type' => $order['PaymentMethod'] == 'cod' ? 'COD' : 'PP',
                'COD_Value' => $order['PaymentMethod'] == 'cod' ? $subTotal - $order['DiscountValue'] + $order['ShippingFees'] + $order['CODFees']  : 0,
                'Customer_Name' => $order["FirstName"] . ' ' . $order["LastName"],
                'Mobile_No' => $order["PhoneNumber"],
                'Street' => $order["Address"],
                'Neighborhood' => $order["Area"],
                'Country' => $order["Country"],
                'Pieces' => $pieces,
                'PickupDueDate' => $egy_date,
                // 'PickupDueDate' => date('Y-m-d\TH:i:s'),
            ],
        ];

        // echo json_encode(['amount'=>$order['PaymentMethod']]);
        // echo json_encode($data);
        // echo json_encode(['Done'=>true]);
        // exit;

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post($endpoint, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'bearer ' . $token,
                ],
                'body' => json_encode($data),
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            $data['statusCode'] = $statusCode;
            if ($statusCode == 200 && json_decode($responseBody, true)["Value"]["Packages"][0]["BarCode"]) {
                $data = json_decode($responseBody, true);
                $this->dbUpdate("orders", array("Status" => "proceeded"), array("ID" => $orderID));
                $this->dbUpdate("orders", array("TrackingNumber" => $data["Value"]["Packages"][0]["BarCode"]), array("ID" => $orderID));
                foreach ($orderProducts as $key => $prd) {
                    $product = $this->getOneProductByID($prd['ProductID']);
                    if (($product['Stock'] - $prd["ProductQuantity"]) >= 0) {
                        // echo json_encode(['minus',$product['Stock'] - $prd["ProductQuantity"]]);
                        $this->dbUpdate('products', array("Stock" => $product['Stock'] - $prd["ProductQuantity"]), array("ID" => $prd['ProductID']));
                    }
                }
                // echo $data["Value"]["Packages"][0]["BarCode"];
            } else {
                $this->dbUpdate("orders", array("Status" => "not proceeded"), array("ID" => $orderID));
                error_log('Error ' . $statusCode . ': ' . $responseBody);
                echo 'Error ' . $statusCode . ': ' . $responseBody;
            }
        } catch (Exception $e) {
            $this->dbUpdate("orders", array("Status" => "not proceeded"), array("ID" => $orderID));
            error_log('Error: ' . $e->getMessage());
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getCityZoneList($type = 'city')
    {
        require_once $this->publicPath . 'GuzzleHttp/vendor/autoload.php';

        $endpoint = 'https://integration.mylerz.net/api/packages/GetCityZoneList';
        $token = 'BSqv6cv-UxKB_sntYxdWzZ5Mv-eIimKhNrumd0JBHXdBafFo7yiJvwjwTPm2TJWFikI8YFtuKGK1Ac_Mruvm8JbFKDh4GBqxqXkreWx_m_i13U9wWHB-n1uJL7isK-jYUXozUmIA2xru7z8PCGIkXn3KIOU82sJEHzO0rGbAsDfaWNU4v-G4zmF_V7cHsRY1S8OxkoK_uKusEsgnmS4Al-CcMvtIHFU0bVBLF8aipzs5_H94pDU4QTI4ieCcO4Z_4NSTGBNhwNBoMY27ExvuE7CsFdRWweHxB8Wuzct4X4IRbcYOFYZaB-z4c5muiNPrUL5IkUdyC6sa2pdtFs0Q5cRPNVMGJZFaLs2RHYowb8Qy3YIZuzDN2mW-dFQOd7Y5NXlENFq_9IAnzaJ0OTDpfSoJoJRMbuCBAUlAR91m4Dzh6CRCkTCOA041aw180nY9hZB1-dCpLgG_OQTM4nitb3-mfrZxslJMHUSVbWW8zQDBgMdekfTBWAXU6I5tCTIZ1-vuZo-z1Znchw_uPYeb5tPMF4GIyNAgQeEC3EzFs4o';

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get($endpoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            if ($statusCode == 200) {
                $data = json_decode($responseBody, true);

                $result;
                if ($type != 'city') {
                    foreach ($data['Value'] as $item) {
                        if ($item['Code'] === $type) {
                            $result = $item['Zones'];
                            break;
                        }
                    }
                } else {
                    $result = array_map(
                        function ($item) {
                            return [
                                "Code" => $item["Code"],
                                "EnName" => $item["EnName"]
                            ];
                        },
                        $data['Value']
                    );
                }

                return $result;
            } else {
                error_log('Error ' . $statusCode . ': ' . $responseBody);
                echo 'Error ' . $statusCode . ': ' . $responseBody;
            }
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            echo 'Error: ' . $e->getMessage();
        }
    }
    function sendMail($sendEmail, $type, $options = [])
    {
        require str_replace('/abro-tree-sys/core/classes', '', __DIR__) . '/vendor/autoload.php';

        $mail = new PHPMailer();
        if ($type == 'cashback_alert') {
            $is_in_if = true;
            $user = $options['user'];
            $earned_cashback = $options['earned_cashback'];
            $currentDate = date('Y-m-d');
            $subject = "مبروك كسبت Cashback من ABRO";
            $body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Abro Egypt Cashback Alert</title>
                    <style>
                        body {
                            font-family: "Arial", sans-serif;
                            line-height: 1.6;
                            margin: 0;
                            padding: 0;
                        }
                        p,h2{
                            color: #1c355e;
                        }
                        .container {
                            max-width: 600px;
                            margin: 20px auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            background-color: #eef7ff;
                            color: #1c355e;
                        }
                        .order-now {
                            background-color: #f5f5f5;
                            padding: 10px;
                            border-radius: 5px;
                            margin-top: 10px;
                            background-color: #007aff;
                            color: #fff;
                            font-weight: bold;
                            text-align: center;
                        }
                        .order-now p {
                            color:#fff;
                        }
                        .order-now a{
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            margin: 0.5rem auto;
                            margin-bottom: 0;
                            background-color: #fff;
                            border-radius: 4px;
                            color: #06529a;
                            font-weight: bold;
                            font-family: system-ui;
                            text-decoration: none;
                            width: 200px;
                            text-align: center;
                            padding: 7px 64px;
                            box-sizing: border-box;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                    <div class="image" style="width: 120px;">
                        <img style="width: 100%;" src="https://www.abroegypt.com/assets/img/header-logo.png?v=5" alt="abro logo">
                    </div>
                        <h2 style="width:100%; text-align:center;">🌟 Cashback Alert: You\'ve Earned Rewards! 🌟</h2>
                        <p>
                            Dear ' . $user->FirstName . ',
                        </p>
                        <p>
                            We\'re excited to inform you that your recent purchase with Abro Egypt has earned you a cashback reward. Enjoy Shopping From ABRO any Time
                        </p>
                        <p>
                            <strong>Details of Your Cashback:</strong><br>
                            <em>Amount Earned:</em> <b style="color:#008000"> ' . $earned_cashback . ' £ </b> <br>
                            <em>Date:</em> ' . $currentDate . '<br>
                        </p>
                        <p>
                            Your cashback is credited to your account and you can use it towards your next Abro Egypt purchase.
                        </p>
                        <div class="order-now">
                            <p>
                                Shop Now and Use Your Cashback as Discount and Earn more CASH !
                                <a href="https://www.abroegypt.com/">SHOP NOW</a>
                            </p>
                        </div>
                        <p>
                            Thank you for choosing Abro Egypt. We value your trust and loyalty, and we look forward to serving you again soon.
                        </p>
                        <p>
                            If you have any questions or need assistance, feel free to reply to this email, and our customer support team will be happy to help.
                        </p>
                        <p>
                            Happy shopping, and enjoy your cashback rewards!
                        </p>
                        <p>
                            Best regards,<br>
                            Abro Egypt Customer Support Team
                        </p>
                    </div>
                </body>
                </html>
                ';
        }


        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.abroegypt.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@abroegypt.com';                 //SMTP username
            $mail->Password   = 'wEx9(4o6EMEm';                         //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('info@abroegypt.com', 'ABRO EGYPT');
            $mail->addAddress($sendEmail);
            $mail->addReplyTo('info@abroegypt.com');

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->CharSet = 'UTF-8';
            $mail->send();
            return ['type' => $type, 'isin' => $is_in_if, 'subject' => $subject, 'body' => $body];
        } catch (Exception $e) {
            // error_log($e);
            return $e->getMessage();
        }
    }
    public function readExcelSheetColumns($row, $allToUpper = true)
    {
        // return row as array
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $rowData = [];
        if ($allToUpper) {
            foreach ($cellIterator as $key => $cell) {
                $cell_name = $key;
                $cell_value =  strtoupper($cell->getValue());
                $rowData[$cell_name] = $cell_value;
            }
        } else {
            foreach ($cellIterator as $key => $cell) {
                $cell_name = $key;
                $cell_value = $cell->getValue();
                $rowData[$cell_name] = $cell_value;
            }
        }
        return $rowData;
    }
    public function readExcelRow($row, $columns)
    {
        // return row as array
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $rowData = [];
        foreach ($cellIterator as $key => $cell) {
            $cell_name = $columns[$key];
            $cell_value = $cell->getValue();
            $rowData[$cell_name] = $cell_value;
        }
        return $rowData;
    }
    public function createExcelSheet()
    {
        spl_autoload_unregister('globalAutoload');
        // require_once $this->publicPath . 'Zipstream/vendor/autoload.php';
        require_once $this->publicPath . 'php-office/vendor/autoload.php';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('J1', 'اسم العميل');
        $sheet->setCellValue('I1', 'البريد الإلكتروني');
        $sheet->setCellValue('H1', 'رقم الهاتف');
        $sheet->setCellValue('G1', 'المحافظة');
        $sheet->setCellValue('F1', 'المنطقة');
        $sheet->setCellValue('E1', 'عدد الطلبات');
        $sheet->setCellValue('D1', 'اجمالي التكلفة');
        $sheet->setCellValue('C1', 'تاريخ آخر طلب');
        $sheet->setCellValue('B1', 'آخر طلب');
        $sheet->setCellValue('A1', 'لديه حساب؟');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF4F81BD',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
        $customers = $this->getOrderingCustomers();
        $customers = $this->formatOrderDate($customers);

        $row = 2;
        foreach ($customers as $customer) {
            $sheet->setCellValue('J' . $row, $customer['FirstName'] . ' ' . $customer['LastName']);
            $sheet->setCellValue('I' . $row, $customer['Email']);
            $sheet->setCellValue('H' . $row, $customer['PhoneNumber']);
            $sheet->setCellValue('G' . $row, $customer['Governorate']);
            $sheet->setCellValue('F' . $row, $customer['Area']);
            $sheet->setCellValue('E' . $row, $customer['TotalOrders']);
            $sheet->setCellValue('D' . $row, $customer['TotalSpent']);
            $lastOrderDate = new DateTime($customer['LastOrderDate']);
            $sheet->setCellValue('C' . $row, $lastOrderDate->format('Y-m-d'));
            $sheet->setCellValue('B' . $row, $customer['LastOrderDisplay']);
            $sheet->setCellValue('A' . $row, $customer['HasAccount'] ? 'نعم' : 'لا');
            $sheet->getStyle('A' . $row . ':J' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $row++;
        }

        $sheet->getColumnDimension('J')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(38);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(17);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('A')->setWidth(10);

        $writer = new Xlsx($spreadsheet);
        $file_name = 'Customers_Orders_Until_' . date('d-m-Y') . '.xlsx';
        // Save the file in the temp directory
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
    public function addPromoCode($promoCode, $discountPercent, $expiresDate, $freeShipping, $status = 1)
    {
        // Check if the promo code already exists
        $checkSql = "SELECT COUNT(*) FROM promocodes WHERE PromoCode = :promoCode";
        $checkStmt = $this->db->prepare($checkSql);
        $checkStmt->bindValue(":promoCode", $promoCode);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            return false;
        }

        // Insert the new promo code
        $sql = "INSERT INTO promocodes (PromoCode, DiscountPercent, ExpiresDate, FreeShipping, Status) 
                VALUES (:promoCode, :discountPercent, :expiresDate, :freeShipping, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":promoCode", $promoCode);
        $stmt->bindValue(":discountPercent", $discountPercent);
        $stmt->bindValue(":expiresDate", $expiresDate);
        $stmt->bindValue(":freeShipping", $freeShipping, PDO::PARAM_INT);
        $stmt->bindValue(":status", $status, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function readExcelSheet($sheet_path)
    {
        require_once $this->publicPath . 'php-office/vendor/autoload.php';
        $sheet_data = [];
        // Load the spreadsheet file
        $spreadsheet = IOFactory::load($sheet_path);
        $sheet = $spreadsheet->getActiveSheet();
        // get columns
        $columns = [];
        foreach ($sheet->getRowIterator() as $row) {
            $key = $row->getRowIndex() - 1;
            if ($key == 0) {
                $columns = $this->readExcelSheetColumns($row);
            } else {
                array_push($sheet_data, $this->readExcelRow($row, $columns));
            }
        }
        return $sheet_data;
    }
    public function getLastActivePromoCode()
    {
        $stmt = $this->db->prepare("SELECT * FROM promocodes WHERE Status = 1 ORDER BY ExpiresDate DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug: Check if result is empty
        if ($result === false) {
            echo "No active promo code found.";
        }

        return $result;
    }

    public function deletePromoCode($promoId)
    {
        $sql = "UPDATE promocodes SET Status = 0 WHERE ID = :promoId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":promoId", $promoId, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function getAllPromoCodes()
    {
        $sql = "SELECT * FROM promocodes 
                WHERE Status = 1 AND (ExpiresDate IS NULL OR ExpiresDate >= CURRENT_DATE)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addproductSize($GroupID, $productID, $Size, $GroupName)
    {
        $sql = "INSERT INTO productSizes (GroupID, productID, Size, GroupName) values  (:GroupID, :productID, :Size, :GroupName)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':GroupID', $GroupID);
        $stmt->bindValue(':productID', $productID);
        $stmt->bindValue(':Size', $Size);
        $stmt->bindValue(':GroupName', $GroupName);
        $stmt->execute();
    }
    public function updateProductsSizes($GroupID, $products, $GroupName)
    {
        $deleteSql = "DELETE FROM productSizes WHERE GroupID = :GroupID";
        $deleteStmt = $this->db->prepare($deleteSql);
        $deleteStmt->bindValue(':GroupID', $GroupID);
        $deleteStmt->execute();

        $insertSql = "INSERT INTO productSizes (GroupID, ProductID, Size, GroupName) VALUES (:GroupID, :ProductID, :Size, :GroupName)";
        $insertStmt = $this->db->prepare($insertSql);

        foreach ($products as $product) {
            // if (!empty($GroupName) && !empty($product['productID']) && !empty($product['size'])) {
            $insertStmt->bindValue(':GroupID', $GroupID);
            $insertStmt->bindValue(':ProductID', $product['productID']);
            $insertStmt->bindValue(':Size', $product['size']);
            $insertStmt->bindValue(':GroupName', $GroupName);
            $insertStmt->execute();
            // }
        }
    }
    public function getAllProductSizeGroups($CategoryID, $GroupID = false)
    {
        $sql = "";
        if ($GroupID) {
            $GroupID = intval($GroupID);
            $sql = "SELECT pz.*, products.Name, productimg.ImgPath
            FROM productSizes pz
            JOIN products ON products.ID = pz.productID
            join productimg ON productimg.ProductID = products.ID
            WHERE products.CategoryID = :CategoryID AND  pz.GroupID = :GroupID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':CategoryID', $CategoryID);
            $stmt->bindValue(':GroupID', $GroupID);
        } else {
            $sql = "SELECT GroupID, GroupName, GROUP_CONCAT(Size) AS Sizes, GROUP_CONCAT(products.ID) AS ProductIDs
            FROM productSizes pz
            JOIN products ON products.ID = pz.productID
            WHERE products.CategoryID = :CategoryID
            GROUP BY GroupID, GroupName";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':CategoryID', $CategoryID);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchSizesForProduct($productID)
    {
        $sql = "SELECT productSizes.*, products.* FROM productSizes
                JOIN products ON products.ID = productSizes.ProductID
                WHERE GroupID = (
                    SELECT GroupID
                    FROM productSizes
                    WHERE ProductID = :ProductID)
                    ORDER BY Size DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':ProductID', $productID);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateProductsColors($GroupID, $products, $GroupName)
    {
        $deleteSql = "DELETE FROM productColors WHERE GroupID = :GroupID";
        $deleteStmt = $this->db->prepare($deleteSql);
        $deleteStmt->bindValue(':GroupID', $GroupID);
        $deleteStmt->execute();

        $insertSql = "INSERT INTO productColors (GroupID, ProductID, Color, ColorName, GroupName) VALUES (:GroupID, :ProductID, :Color,:ColorName, :GroupName)";
        $insertStmt = $this->db->prepare($insertSql);

        foreach ($products as $product) {
            // if (!empty($GroupName) && !empty($product['productID']) && !empty($product['size'])) {
            $insertStmt->bindValue(':GroupID', $GroupID);
            $insertStmt->bindValue(':ProductID', $product['productID']);
            $insertStmt->bindValue(':Color', $product['color']);
            $insertStmt->bindValue(':ColorName', $product['colorName']);
            $insertStmt->bindValue(':GroupName', $GroupName);
            $insertStmt->execute();
            // }
        }
    }
    public function addproductColor($GroupID, $productID, $Color, $ColorName, $GroupName)
    {
        $sql = "INSERT INTO productColors (GroupID, productID, Color,ColorName, GroupName) values  (:GroupID, :productID, :Color,:ColorName, :GroupName)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':GroupID', $GroupID);
        $stmt->bindValue(':productID', $productID);
        $stmt->bindValue(':Color', $Color);
        $stmt->bindValue(':ColorName', $ColorName);
        $stmt->bindValue(':GroupName', $GroupName);
        $stmt->execute();
    }
    public function getAllProductColorGroups($CategoryID, $GroupID = false)
    {
        $sql = "";
        if ($GroupID) {
            $GroupID = intval($GroupID);
            $sql = "SELECT pc.*, products.Name, productimg.ImgPath
            FROM productColors pc
            JOIN products ON products.ID = pc.productID
            join productimg ON productimg.ProductID = products.ID
            WHERE products.CategoryID = :CategoryID AND  pc.GroupID = :GroupID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':CategoryID', $CategoryID);
            $stmt->bindValue(':GroupID', $GroupID);
        } else {
            $sql = "SELECT GroupID, GroupName, GROUP_CONCAT(Color) AS Colors,GROUP_CONCAT(ColorName) AS ColorsNames, GROUP_CONCAT(products.ID) AS ProductIDs
            FROM productColors pc
            JOIN products ON products.ID = pc.productID
            WHERE products.CategoryID = :CategoryID
            GROUP BY GroupID, GroupName";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':CategoryID', $CategoryID);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchColorsForProduct($productID)
    {
        $sql = "SELECT productColors.*, products.* FROM productColors
                JOIN products ON products.ID = productColors.ProductID
                WHERE GroupID = (
                    SELECT GroupID
                    FROM productColors
                    WHERE ProductID = :ProductID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':ProductID', $productID);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
