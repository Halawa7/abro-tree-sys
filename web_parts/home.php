        <div class="swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="bg" style="background-image: url('assets/img/hero/event-banner.png')"></div>
              <!-- <div class="slide-info">
                <h2 style="color: white; margin-bottom:1.5rem;">
                  Enjoy Event 10% Discount
                </h2>
                <a href="<?php echo $abro->baseUrl; ?>shop/">
                  Shop now <i class="fa-solid fa-angles-right"></i>
                </a>
              </div> -->
            </div>
            <div class="swiper-slide">
              <div class="bg" style="background-image: url('assets/img/hero/bg-img-1.jpg')"></div>
              <div class="slide-info">
                <h1>
                  Place for everything for your car with an excellent American
                  manufacture.
                </h1>
                <a href="<?php echo $abro->baseUrl; ?>shop/">
                  Shop now <i class="fa-solid fa-angles-right"></i>
                </a>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="bg" style="background-image: url('assets/img/hero/bg-img-2.jpg')"></div>
              <div class="slide-info">
                <h1>
                  Place for everything for your car with an excellent American
                  manufacture.
                </h1>
                <a href="<?php echo $abro->baseUrl; ?>shop/">
                  Shop now <i class="fa-solid fa-angles-right"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
        </section>
        <section class="categories">
          <h2>Welcome to ABRO®</h2>
          <span>ABRO® is proud of its American origin, it has won a high place for
            every user, and more than 300 products that meet all the customer’s
            needs for his car.</span>
          <div class="categories">
            <?php
            foreach ($categories as $value) {
              $productCount = count($abro->getCategoryProducts($value["ID"]));
            ?>
              <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $value["Name"])); ?>/" class="category">
                <img src="<?php echo $abro->baseUrl; ?><?php echo $value["Cover"]; ?>" alt="<?php echo $value["Name"]; ?>" />
                <div class="category-title">
                  <h3><?php echo $value["Name"]; ?></h3>
                  <span><?php echo ($productCount > 1 ? $productCount . " products" : $productCount . " product"); ?></span>
                </div>
              </a>
            <?php
            }
            ?>
          </div>
        </section>
        <section class="testimonials">
          <h2>What Our Clients Say</h2>
          <span>We value our customers' feedback and are grateful to them.</span>
          <div class="swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="<?php echo $abro->baseUrl; ?>assets/img/clients/client-1.jpg" alt="Mohamed Hesham" />
                <div class="testimonial-name">Mohamed Hesham</div>
                <div class="testimonial-pos">
                  From <i class="fa-brands fa-facebook"></i>Facebook
                </div>
                <div class="rating">
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                </div>
                <p>
                  The store has a variety of high quality products that are very
                  effective. Honestly ABRO® is the best car care brand in Egypt.
                </p>
              </div>
              <div class="swiper-slide">
                <img src="<?php echo $abro->baseUrl; ?>assets/img/clients/client-2.jpg" alt="Karim Abu Zeidan" />
                <div class="testimonial-name">Karim Abu Zeidan</div>
                <div class="testimonial-pos">
                  From <i class="fa-brands fa-facebook"></i>Facebook
                </div>
                <div class="rating">
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                  <i class="fa-solid fa-star check"></i>
                </div>
                <p>ABRO® company excellent products and the best in the world.</p>
              </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </section>
        <?php
        $categories = $abro->getAllData("categories");
        foreach ($categories as $value) {
          $products = $abro->getCategoryProducts($value["ID"], 9);
          if (count($products) > 2) {
        ?>
            <section class="single-category">
              <h2><?php echo $value["Name"]; ?></h2>
              <div class="category-container">
                <div class="swiper">
                  <div class="swiper-wrapper">
                    <?php
                    foreach ($products as $pValue) {
                      if ($abro->getProductMainImg($pValue["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
                    ?>
                        <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $value["Name"])); ?>/product/<?php echo isset($pValue["Url"]) && $pValue["Url"] ? $pValue["Url"] : $pValue["ID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $pValue["Name"])))) . '/'; ?>" class="swiper-slide product" data-id="<?php echo $pValue["ID"]; ?>">
                          <div class="product-img">
                            <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($pValue["ID"])->ImgPath; ?>" alt="<?php echo $pValue["Name"]; ?>" />
                            <div class="top-left-btns">
                              <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                              <div class="exchange"><img src="/assets/icons/exchange.png" alt=""></div>
                            </div>
                            <div class="center-btns">
                              <button><i class="fa-solid fa-eye iconholder"></i><span>Quick View</span><span class="placeholder">Quick View</span><i class="fa-solid fa-eye"></i></button>
                              <button style="<?php echo !$pValue['Stock'] ? "display:none" : "display:initial" ?>;" data-stock="<?php echo $pValue['Stock'] ?>" class="atcBtn"><i class="fa-solid fa-cart-shopping iconholder"></i><span>Add to Cart</span><span class="placeholder">Add to Cart</span><i class="fa-solid fa-cart-shopping"></i>
                                <div class="loader"><i class="fa-solid fa-spinner"></i></div>
                              </button>
                            </div>
                          </div>
                          <div class="product-name"><?php echo $pValue["Name"]; ?></div>
                          <div class="product-price">LE <?php echo number_format($pValue["Price"], 2); ?></div>
                        </a>
                    <?php
                      }
                    }
                    ?>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
                <img class="category-cover" src="<?php echo $abro->baseUrl; ?><?php echo $value["SubCover"]; ?>" alt="<?php echo $value["Name"]; ?>" />
              </div>
            </section>
        <?php
          }
        }
        ?>
        <section class="products-slider">
          <h2>Trending Products</h2>
          <div class="swiper products-swiper">
            <div class="swiper-wrapper">
              <?php
              $products = $abro->getTrendingProducts(8);
              foreach ($products as $value) {
                if ($abro->getProductMainImg($value["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
              ?>
                  <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $abro->getProductCategory($value["CategoryID"])->Name)); ?>/product/<?php echo $value["Url"] ? $value["Url"] : $value["ID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Name"])))); ?>/" class="swiper-slide product" data-id="<?php echo $value["ID"]; ?>">
                    <div class="product-img">
                      <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($value["ID"])->ImgPath; ?>" alt="<?php echo $value["Name"]; ?>" />
                      <div class="top-left-btns">
                        <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                        <div class="exchange"><img src="/assets/icons/exchange.png" alt=""></div>
                      </div>
                      <div class="center-btns">
                        <button><i class="fa-solid fa-eye iconholder"></i><span>Quick View</span><span class="placeholder">Quick View</span><i class="fa-solid fa-eye"></i></button>
                        <button style="<?php echo !$value['Stock'] ? "display: none" : "display:initial" ?>;" class="atcBtn" data-stock="<?php echo $value['Stock'] ?>"><i class="fa-solid fa-cart-shopping iconholder"></i><span>Add to Cart</span><span class="placeholder">Add to Cart</span><i class="fa-solid fa-cart-shopping"></i>
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
              ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </section>