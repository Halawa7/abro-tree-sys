      </section>
      <section class="breadcrumb justify-content-center">
        <div>
          <a href="<?php echo $abro->baseUrl; ?>">Home</a>
          <i class="fa-solid fa-angles-right"></i>
        </div>
        <?php if(isset($options["search"])): ?>
        <div>
          <a href="<?php echo $abro->baseUrl; ?>blogs/">Blogs</a>
          <i class="fa-solid fa-angles-right"></i>
        </div>
        <span><?php echo $options["search"]; ?></span>
        <?php else: ?>
        <span>Blogs</span>
        <?php endif; ?>
      </section>
      <section class="blogs-container">
        <div class="blogs">
            <?php
                $blogs = isset($options["search"]) ? $abro->searchBlogs($options["search"]) : $abro->getAllData("blogs");
                if (count($blogs) > 0) {
                    foreach ($blogs as $value) {
                        $blogUrl = $abro->baseUrl."blogs/".$value["ID"]."/b-".strtolower(str_replace(" ","-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Title"])))."/";
                        ?>
                        <div class="blog">
                            <a href="<?php echo $blogUrl; ?>" class="blog-img">
                                <img src="<?php echo $abro->baseUrl; ?><?php echo $value["Img"]; ?>" alt="<?php echo $value["Title"]; ?>">
                            </a>
                            <div class="blog-text">
                                <a href="<?php echo $blogUrl; ?>"><?php echo $value["Title"]; ?></a>
                                <p><?php echo $value["Desc"]; ?></p>
                            </div>
                            <div class="blog-info">
                                <div class="b-i">
                                    <i class='bx bx-calendar'></i>
                                    <?php echo date("d M Y", strtotime($value["Date"])); ?>
                                </div>
                                <div class="b-i">
                                    <i class="fa-regular fa-eye"></i>
                                    <?php echo $value["Visitors"]; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p>No blogs were found matching your selection.</p>
                    <?php
                }
            ?>
        </div>
        <div class="blogs-actions">
            <form action="/blogs/search/" method="post" class="blogs-search">
                <input type="text" name="blogSearch" placeholder="Search">
                <button type="submit"><img src="<?php echo $abro->baseUrl; ?>assets/icons/dark-search.png"></button>
            </form>
            <div class="b-e-i">
                <h3>About us</h3>
                <p>ABRO® is proud of its American origin, it has won a high place for every user, and more than 300 products that meet all the customer’s needs for his car.</p>
                <div class="sm-c">
                    <a href="https://www.facebook.com/ABROEGYPT" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/abro.egypt/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <div class="b-e-i">
                <h3>Popular posts</h3>
                <div class="side-blogs">
                    <?php
                        $blogs = $abro->getPopularBlogs();
                        foreach ($blogs as $value) {
                            $blogUrl = $abro->baseUrl."blogs/".$value["ID"]."/b-".strtolower(str_replace(" ","-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Title"])))."/";
                            ?>
                            <div class="s-b">
                                <a href="<?php echo $blogUrl; ?>" class="blog-img">
                                    <img src="<?php echo $abro->baseUrl; ?><?php echo $value["Img"]; ?>" alt="<?php echo $value["Title"]; ?>">
                                </a>
                                <div class="blog-text">
                                    <a href="<?php echo $blogUrl; ?>"><?php echo $value["Title"]; ?></a>
                                    <div class="blog-info">
                                        <div class="b-i">
                                            <i class='bx bx-calendar'></i>
                                            <?php echo date("d M Y", strtotime($value["Date"])); ?>
                                        </div>
                                        <span class="dot"></span>
                                        <div class="b-i">
                                            <i class="fa-regular fa-eye"></i>
                                            <?php echo $value["Visitors"]; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
      </section>