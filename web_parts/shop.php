      </section>
      <section class="breadcrumb justify-content-center text-center"><span class="fw-500">Shop in our categories</span></section>
      <section class="categories">
        <h2>Welcome to ABRO®</h2>
        <span
          >ABRO® is proud of its American origin, it has won a high place for
          every user, and more than 300 products that meet all the customer’s
          needs for his car.</span
        >
        <div class="categories">
          <?php
            foreach ($categories as $value) {
                $productCount = count($abro->getCategoryProducts($value["ID"]));
                ?>
                <a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $value["Name"])); ?>/" class="category">
                  <img src="<?php echo $abro->baseUrl; ?><?php echo $value["Cover"]; ?>" alt="<?php echo $value["Name"]; ?>" />
                  <div class="category-title">
                    <h3><?php echo $value["Name"]; ?></h3>
                    <span><?php echo ($productCount > 1 ? $productCount." products" : $productCount." product");?></span>
                  </div>
                </a>
                <?php
            }
          ?>
        </div>
      </section>
