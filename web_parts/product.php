      </section>
      <section class="breadcrumb">
        <div>
          <a href="<?php echo $abro->baseUrl; ?>">Home</a>
          <i class="fa-solid fa-angles-right"></i>
        </div>
        <div>
          <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/"><?php echo $options["Category"]->Name; ?></a>
          <i class="fa-solid fa-angles-right"></i>
        </div>
        <span><?php echo $options["Product"]->Name; ?></span>
      </section>
      <section class="product-container" data-id="<?php echo $options["Product"]->ID; ?>">
        <div class="p-i-c product-img">
          <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($options["Product"]->ID)->ImgPath; ?>" alt="">
        </div>
        <div class="product-info">
          <h3 class="product-free-shipping" style="display:<?php echo $options["Product"]->CategoryID != 1 ? 'none' : 'block'; ?>">Free Shipping</h3>
          <h1 class="product-name"><?php echo $options["Product"]->Name; ?></h1>
          <p class="product-last-peices"><?php
                                          echo $options["Product"]->Stock > 1 && $options["Product"]->Stock < 5 ? "only " . $options["Product"]->Stock . " peices in stock" : ($options["Product"]->Stock == 1 ? "Last Peice" : ($options["Product"]->Stock == 0 ? "Out Of Stock" : "")) ?></p>
        <div class="reviews">
            <?php
            // if (true){
            $data = array();
            if ($abro->account !== null) {
              // get review if signed
              $productID = $options["Product"]->ID;
              $accountID = $abro->account->ID;
              // $accountID = 'fakeid';
              $data["success"] = true;
              $review = $abro->getAccountProductReview($accountID, $productID);
              if (isset($review) && $review) {
                $data['Stars'] = $review[0]['Stars'];
                // echo json_encode($data);
              } else {
                //get rating
                $review = $abro->getProductRating($productID);
                if (!$review) {
                  $data['Stars'] = 0;
                } else {
                  $data['Stars'] = ceil($review[0]['Rating']);
                }
                // echo json_encode($data);
              }
            } else {
              // get rating
              $productID = $options["Product"]->ID;
              $review = $abro->getProductRating($productID);
              if (!$review) {
                $data['Stars'] = 0;
              } else {
                $data['Stars'] = ceil($review[0]['Rating']);
              }
            }
            //show Stars
            if ($abro->account !== null) {
              for ($i = 1; $i <= intval($data['Stars']); $i++) {
            ?>
                <button id="star-<?php echo $i; ?>" style="color:#f7b604;cursor:pointer;"><i class="fa-solid fa-star"></i></button>
              <?php
              }
              for ($i = intval($data['Stars']) + 1; $i <= 5; $i++) {
              ?>
                <button id="star-<?php echo $i; ?>" style="cursor:pointer;"><i class="fa-solid fa-star"></i></button>
              <?php
              }
            } else {
              ?>
              <?php
              for ($i = 1; $i <= intval($data['Stars']); $i++) {
              ?>
                <button id="star-<?php echo $i; ?>" dis='true' style="color:#f7b604"><i class="fa-solid fa-star"></i></button>
              <?php
              }
              for ($i = intval($data['Stars']) + 1; $i <= 5; $i++) {
              ?>
                <button id="star-<?php echo $i; ?>" dis='true' style="color:#b9c6d9;"><i class="fa-solid fa-star"></i></button>
              <?php
              }
              ?>
              <!-- <button id="star-1" dis = 'true'><i class="fa-solid fa-star"></i></button>
        <button id="star-2" dis = 'true'><i class="fa-solid fa-star"></i></button>
        <button id="star-3" dis = 'true'><i class="fa-solid fa-star"></i></button>
        <button id="star-4" dis = 'true'><i class="fa-solid fa-star"></i></button>
        <button id="star-5" dis = 'true'><i class="fa-solid fa-star"></i></button> -->
            <?php
            }
            ?>
            - Review
        </div>

        <?php 
function sizeComparator($a, $b) {
        preg_match('/(\d+)([a-zA-Z]+)/', $a["Size"], $matchA);
        preg_match('/(\d+)([a-zA-Z]+)/', $b["Size"], $matchB);
        if (!isset($matchA[1]) || !isset($matchB[1])) {
            return 0; 
        }
        $valueA = (int)$matchA[1];
        $valueB = (int)$matchB[1];
        if ($valueA === $valueB) {
            return strcmp($matchA[2], $matchB[2]);
        }
        return $valueB - $valueA; 
    }
  ?>
        <?php $productId = $options["Product"]->ID;
              $allProductSizes = $abro->fetchSizesForProduct($productId);
              usort($allProductSizes, 'sizeComparator');
              if($allProductSizes):?>
                <div class="product-sizes w-100 mw-100">
                  <p class="title mt-3">OTHER SIZES</p>
                  <div class="sizes d-flex align-items-center flex-wrap mb-3" style="gap:.5rem;">
                    <?php foreach($allProductSizes as $productSize): 
                          if($productId == $productSize["ProductID"]):?>
                            <a class="box-size col-3 p-0" href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/product/<?php echo isset($productSize["Url"]) && $productSize["Url"] ? $productSize["Url"] : $productSize["ProductID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $productSize["Name"])))); ?>/">
                              <div class="size" style="color:#ffffff; background-color: #06529a;"><?php echo $productSize["Size"]; ?></div>
                            </a>
                            <?php  else:?>
                            <a class="box-size col-3 p-0" href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/product/<?php echo isset($productSize["Url"]) && $productSize["Url"] ? $productSize["Url"] : $productSize["ProductID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $productSize["Name"])))); ?>/">
                              <div class="size"><?php echo $productSize["Size"]; ?></div>
                            </a>
                          <?php endif;endforeach;?>
                    </div>
                </div>
        <?php endif; ?>
        <?php  
    $allProductsColors = $abro->fetchColorsForProduct($productId); 
    if($allProductsColors):?>
    <div class="product-colors w-100 mw-100">
    <p class="title">OTHER COLORS</p>
    <div class="container-colors d-flex flex-wrap mb-3" style="gap:.5rem;">
      <?php foreach($allProductsColors as $productColor): 
        if($productId == $productColor["ProductID"]):?>
    <a class="box d-flex align-items-center position-relative" style="flex-direction: column;" href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/product/<?php echo isset($productColor["Url"]) && $productColor["Url"] ? $productColor["Url"] : $productColor["ProductID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $productColor["Name"])))); ?>/">
          <span class="color-name" style=""><?php echo $productColor["ColorName"]; ?></span>
          <div class="box-color">
            <div class="color" style="border: 2px solid #fff; background-color:<?php echo $productColor["Color"]; ?>"></div>
          </div>
    </a>
    <?php  else:?>
      <a class="box d-flex align-items-center position-relative" style="flex-direction: column;" href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/product/<?php echo isset($productColor["Url"]) && $productColor["Url"] ? $productColor["Url"] : $productColor["ProductID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $productColor["Name"])))); ?>/">
          <span class="color-name" style=""><?php echo $productColor["ColorName"]; ?></span>
          <div class="box-color">
            <div class="color" style="background-color:<?php echo $productColor["Color"]; ?>"></div>
          </div>
    </a>
    <?php endif;endforeach;?>
  </div>
    </div>
  <?php endif;?>

  <style>
    .color-name{
    display: block;
    min-width: 53px;
    text-align: center;
    background-color: #1c355e;
    color: #ffffff;
    position: absolute;
    bottom: 100%; 
    left: 50%;
    transform: translateX(-50%);
    border-radius: 2px;
    padding: 0rem .5rem;
    margin-bottom: .5rem;
    opacity: 0; 
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: translate(-50%, 10px);
    }

.color-name::after {
    content: '';
    position: absolute;
    bottom: -5px; 
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #1c355e; 
}
.box:hover .color-name {
    opacity: 1;
    transform: translate(-50%, 0);
}
  </style>
          <span class="price product-price">LE <?php echo number_format($options["Product"]->Price, 2); ?></span>
          <div class="product-action">
            <div class="input-counter" data-stock="<?php echo $options["Product"]->Stock; ?>" style="<?php echo !$options["Product"]->Stock ? "display:none" : "" ?>;">
              <span class="minus no-select">-</span>
              <input type="text" value="1" />
              <span class="plus no-select">+</span>
            </div>
            <button class="a-t-c hasQuantity" data-stock="<?php echo $options["Product"]->Stock ?>" style="<?php echo !$options["Product"]->Stock ? "display:none" : "display:initial" ?>;">Add to Cart<div class="loader"><i class="fa-solid fa-spinner"></i></div></button>
            <div class="w-e-c">
              <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
              <div class="exchange no-select"><img src="/assets/icons/black-exchange.png" alt=""></div>
            </div>
          </div>
          <?php if (strlen($options["Product"]->SKU) > 0) : ?>
            <span>Product SKU: <b><?php echo $options["Product"]->SKU; ?></b></span>
          <?php endif; ?>
          <span>Availability: <?php if ($options["Product"]->Stock > 0) : ?><b class="in"><?php echo $options["Product"]->Stock; ?> in stock</b><?php else : ?><b class="out">Out of stock</b><?php endif; ?></span>
          <div class="social-media">
            <?php $prd_url = $abro->baseUrl . "shop/" . strtolower(str_replace(" ", "-", $options["Category"]->Name)) . "/product/" . (isset($options["Product"]->Url) && $options["Product"]->Url ? $options["Product"]->Url : $options["Product"]->ID . "/p-" . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $options["Product"]->Name))) . "/")); ?>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($prd_url) ?>" target="_blank" style="color:inherit;"><i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="https://twitter.com/intent/tweet?url=<?php echo $prd_url ?>" target="_blank" style="color:inherit;"><i class="fa-brands fa-twitter"></i>
            </a>

            <a href="mailto:?subject=Check out this Product at Abroeg.com&amp;body=<?php echo $options["Product"]->Name ?><?php echo $prd_url ?>" target="_blank" style="color:inherit;"><i class="fa-solid fa-envelope"></i>
            </a>
            <a href="https://wa.me/?text=<?php echo $prd_url ?>" target="_blank" style="color:inherit;"><i class="fa-brands fa-whatsapp"></i>
            </a>
          </div>
        </div>
      </section>
      <section class="product-information">
        <button class="accordion active">Description</button>
        <div class="panel" style="max-height:unset;">
          <?php if (strlen($options["Product"]->Desc) > 0) : ?>
            <?php echo $options["Product"]->Desc; ?>
          <?php else : ?>
            <p><strong><?php echo $options["Product"]->Name; ?></strong>.</p>
            <ul>
              <li>API SP and ILSAC GF-6A Approved.</li>
              <li>API Certified Resource Conserving.</li>
              <li>Meets system requirements.</li>
              <li>Keeps System Operating Smoothly and Quietly.</li>
              <li>Reduces Wear and Slippage.</li>
              <li>Non-Foaming, Non-Corrosive.</li>
              <li>Economy Grade.</li>
              <li>Applications: <strong>API SP (SN Plus, SN, SM, SL)</strong>.</li>
            </ul>
            <br>
          <?php endif; ?>
        </div>
      </section>
      <section class="products-slider">
        <h2>You may also like</h2>
        <div class="swiper products-swiper">
          <div class="swiper-wrapper">
            <?php
            $products = $abro->getCategoryProducts($options["Category"]->ID, 8);
            foreach ($products as $value) {
              if ($value["ID"] != $options["Product"]->ID) {
                if ($abro->getProductMainImg($value["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
            ?>
                  <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/product/<?php echo isset($value["Url"]) && $value["Url"] ? $value["Url"] : $value["ID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Name"])))); ?>/" class="swiper-slide product" data-id="<?php echo $value["ID"]; ?>">
                    <div class="product-img">
                      <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($value["ID"])->ImgPath; ?>" alt="<?php echo $value["Name"]; ?>" />
                      <div class="top-left-btns">
                        <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                        <div class="exchange"><img src="/assets/icons/exchange.png" alt=""></div>
                      </div>
                      <div class="center-btns">
                        <button><i class="fa-solid fa-eye iconholder"></i><span>Quick View</span><span class="placeholder">Quick View</span><i class="fa-solid fa-eye"></i></button>
                        <button class="atcBtn" data-stock="<?php echo $options["Product"]->Stock ?>" style="<?php echo !$value['Stock'] ? "display:none" : "display:initial" ?>;"><i class="fa-solid fa-cart-shopping iconholder"></i><span>Add to Cart</span><span class="placeholder">Add to Cart</span><i class="fa-solid fa-cart-shopping"></i>
                          <div class="loader"><i class="fa-solid fa-spinner"></i></div>
                        </button>
                      </div>
                    </div>
                    <div class="product-name"><?php echo $value["Name"]; ?></div>
                    <div class="product-price">LE <?php echo number_format($value["Price"], 2); ?></div>
                  </a>
            <?php
                }
              }
            }
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </section>
      <section class="products-slider">
        <h2>Trending Products</h2>
        <div class="swiper products-swiper">
          <div class="swiper-wrapper">
            <?php
            $products = $abro->getTrendingProducts(8);
            foreach ($products as $value) {
              if ($value["ID"] != $options["Product"]->ID) {
                if ($abro->getProductMainImg($value["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
            ?>
                  <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $abro->getProductCategory($value["CategoryID"])->Name)); ?>/product/<?php echo isset($value["Url"]) && $value["Url"] ? $value["Url"] : $value["ID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Name"])))); ?>/" class="swiper-slide product" data-id="<?php echo $value["ID"]; ?>">
                    <div class="product-img">
                      <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($value["ID"])->ImgPath; ?>" alt="<?php echo $value["Name"]; ?>" />
                      <div class="top-left-btns">
                        <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                        <div class="exchange"><img src="/assets/icons/exchange.png" alt=""></div>
                      </div>
                      <div class="center-btns">
                        <button><i class="fa-solid fa-eye iconholder"></i><span>Quick View</span><span class="placeholder">Quick View</span><i class="fa-solid fa-eye"></i></button>
                        <button class="atcBtn" data-stock="<?php echo $options["Product"]->Stock ?>" style="<?php echo !$value['Stock'] ? "display:none" : "display:initial" ?>;"><i class="fa-solid fa-cart-shopping iconholder"></i><span>Add to Cart</span><span class="placeholder">Add to Cart</span><i class="fa-solid fa-cart-shopping"></i>
                          <div class="loader"><i class="fa-solid fa-spinner"></i></div>
                        </button>
                      </div>
                    </div>
                    <div class="product-name"><?php echo $value["Name"]; ?></div>
                    <div class="product-price">LE <?php echo number_format($value["Price"], 2); ?></div>
                  </a>
            <?php
                }
              }
            }
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
        <script>
          let prd = JSON.parse(`<?php echo json_encode($options["Product"]); ?>`);
          let categories = JSON.parse(`<?php echo json_encode($categories); ?>`);
          let category = {};
          categories.forEach(cat => {
            if (cat['ID'] == prd['CategoryID']) {
              category = cat;
            }
          });
          // start data layers
          dataLayer.push({
            ecommerce: null
          }); // Clear the previous ecommerce object.
          dataLayer.push({
            event: "select_item",
            ecommerce: {
              item_list_id: prd['CategoryID'],
              item_list_name: category['Name'],
              items: [{
                item_id: prd['ID'],
                item_name: prd['Name'],
                affiliation: "",
                coupon: "",
                discount: 0,
                index: 0,
                item_brand: "Abro",
                item_category: category['Name'],
                item_category2: Number(prd['Weight']) <= 1 ? 'Light Weight' : Number(prd['Weight']) > 1 && Number(prd['Weight']) < 2 ? 'Medium Weight' : 'Heavy Weight',
                item_list_id: prd['CategoryID'],
                item_list_name: category['Name'],
                item_variant: "",
                location_id: "",
                price: prd['Price'],
                quantity: 1
              }]
            }
          });
        </script>
      </section>