      </section>
      <section class="blog-header">
        <h1><?php echo $blog->Title; ?></h1>
        <div class="blog-info">
            <div class="b-i">
                <i class='bx bx-calendar'></i>
                <?php echo date("d M Y", strtotime($blog->Date)); ?>
            </div>
            <span class="dot"></span>
            <div class="b-i">
                <i class="fa-regular fa-eye"></i>
                <?php echo $blog->Visitors; ?>
            </div>
        </div>
      </section>
      <section class="blog-details">
        <img src="<?php echo $abro->baseUrl; ?><?php echo $blog->Img; ?>" alt="<?php echo $blog->Title; ?>">
        <div class="b-d-t">
            <?php echo $blog->Body; ?>
            <div class="breakline"></div>
            <h3>You might also like</h3>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                        $blogs = $abro->getPopularBlogs();
                        foreach ($blogs as $value) {
                            $blogUrl = $abro->baseUrl."blogs/".$value["ID"]."/b-".strtolower(str_replace(" ","-", preg_replace("/[^a-zA-Z0-9 ]+/", "", $value["Title"])))."/";
                            ?>
                            <div class="swiper-slide">
                                <a href="<?php echo $blogUrl; ?>" class="blog-img">
                                    <img src="<?php echo $abro->baseUrl; ?><?php echo $value["Img"]; ?>" alt="<?php echo $value["Title"]; ?>">
                                </a>
                                <a class="blog-title" href="<?php echo $blogUrl; ?>"><?php echo $value["Title"]; ?></a>
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
                            <?php
                        }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>