        <div class="hero-cover">
            <img src="<?php echo $abro->baseUrl; ?><?php echo $options["Category"]->BackgroundImg; ?>" alt="">
            <div class="h-t-c">
                <h2>Introducing our <?php echo $options["Category"]->Name; ?></h2>
                <h3>With ABRO®, your drive is always safe.</h3>
            </div>
        </div>
        </section>
        <script>
            let ga4Products = [];
            let product;
            let category = '<?php echo $options["Category"]->Name; ?>';
        </script>
        <section class="products text-left">
            <h2><?php echo $options["Category"]->Name; ?></h2>
            <div class="products-container">
                <?php
                $products = $abro->getCategoryProducts($options["Category"]->ID);
                foreach ($products as $value) {
                    if ($abro->getProductMainImg($value["ID"])->ImgPath != "assets/img/products/noimage.jpg") {
                ?>
                        <script>
                            <?php $jsProduct = $value;
                            unset($jsProduct['Desc']); ?>
                            product = '';
                            product = JSON.parse(`<?php echo json_encode($jsProduct) ?>`);
                            ga4Products.push({
                                item_id: product['ID'],
                                item_name: product['Name'],
                                affiliation: category,
                                coupon: "",
                                discount: 0,
                                index: 0,
                                item_brand: "Abro",
                                item_category: category,
                                item_category2: Number(product['Weight']) <= 1 ? 'Light Weight' : Number(product['Weight']) > 1 && Number(product['Weight']) < 2 ? 'Medium Weight' : 'Heavy Weight',
                                item_list_id: product['CategoryID'],
                                item_list_name: category,
                                item_variant: product['Weight'],
                                location_id: "",
                                price: product['Price'],
                                quantity: product['Stock']
                            });
                        </script>
                        <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $options["Category"]->Name)); ?>/product/<?php echo isset($value["Url"]) && $value["Url"] ? $value["Url"] :  $value["ID"] . '/p-' . str_replace(".", "", strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Name"])))) . '/'; ?>" class="product" data-id="<?php echo $value["ID"]; ?>">
                            <div class="product-img">
                                <img src="<?php echo $abro->baseUrl; ?><?php echo $abro->getProductMainImg($value["ID"])->ImgPath; ?>" alt="<?php echo $value["Name"]; ?>">
                                <div class="top-left-btns">
                                    <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                                    <div class="exchange"><img src="/assets/icons/exchange.png"></div>
                                </div>
                                <div class="center-btns">
                                    <button><i class="fa-solid fa-eye iconholder"></i><span>Quick View</span><span class="placeholder">Quick View</span><i class="fa-solid fa-eye"></i></button>
                                    <button <?php echo !$value['Stock'] ? 'disabled' : ""; ?> data-stock="<?php echo $value['Stock'] ?>" style="<?php echo !$value['Stock'] ? "display: none" : "display:initial" ?>;" class="atcBtn"><i class="fa-solid fa-cart-shopping iconholder"></i><span>Add to Cart</span><span class="placeholder">Add to Cart</span><i class="fa-solid fa-cart-shopping"></i>
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
        </section>
        <!-- add GA4 Events -->
        <script>
            dataLayer.push({
                ecommerce: null
            }); // Clear the previous ecommerce object.
            dataLayer.push({
                event: "view_item_list",
                ecommerce: {
                    item_list_id: product['CategoryID'],
                    item_list_name: category,
                    items: ga4Products
                }
            });
        </script>