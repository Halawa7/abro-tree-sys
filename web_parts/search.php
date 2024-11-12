    </section>
    <section class="breadcrumb justify-content-center text-center"><span class="fw-500 text-transform-unset"><?php echo (count($options["Products"]) > 0 ? count($options["Products"]) . " " : ""); ?>Search Results for : "<?php echo $options["Search"]; ?>"</span></section>
    <section class="products">
        <?php
        if (count($options["Products"]) > 0) {
        ?>
            <div class="products-container">
                <?php
                foreach ($options["Products"] as $value) {
                    if ($abro->getProductMainImg($value["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
                ?>
                        <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $abro->getProductCategory($value["CategoryID"])->Name)); ?>/product/<?php echo isset($value["Url"]) && $value["Url"] ? $value["Url"] : $value["ID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Name"])))); ?>/" class="product" data-id="<?php echo $value["ID"]; ?>">
                            <div class="product-img">
                                <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($value["ID"])->ImgPath; ?>" alt="<?php echo $value["Name"]; ?>">
                                <div class="top-left-btns">
                                    <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                                    <div class="exchange"><img src="/assets/icons/exchange.png"></div>
                                </div>
                                <div class="center-btns">
                                    <button><i class="fa-solid fa-eye iconholder"></i><span>Quick View</span><span class="placeholder">Quick View</span><i class="fa-solid fa-eye"></i></button>
                                    <button class="atcBtn" data-stock="<?php echo $value['Stock'] ?>" style="<?php echo !$value["Stock"] ? "display:none" : "" ?>;"><i class="fa-solid fa-cart-shopping iconholder"></i><span>Add to Cart</span><span class="placeholder">Add to Cart</span><i class="fa-solid fa-cart-shopping"></i>
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
        <?php
        } else {
        ?>
            <img class="wishlist-img" src="<?php echo $abro->baseUrl; ?>assets/icons/no-results.png" alt="No results">
            <h3>No result found</h3>
            <span>No products were found matching your selection.</span>
        <?php
        }
        ?>
    </section>