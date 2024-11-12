      <footer class="footer-section">
        <div class="container">
          <div class="footer-cta pt-5 pb-5">
            <div class="row">
              <div class="col-xl-4 col-md-4 mb-30">
                <div class="single-cta">
                  <i class="fas fa-map-marker-alt"></i>
                  <div class="cta-text">
                    <h4>Headquarters</h4>
                    <span>Mostafa Kamel St, Smouha - Alexandria</span>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4 mb-30">
                <div class="single-cta">
                  <i class="fas fa-phone"></i>
                  <div class="cta-text">
                    <h4>Call us</h4>
                    <span>+20 122 2290017</span>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4 mb-30">
                <div class="single-cta">
                  <i class="far fa-envelope-open"></i>
                  <div class="cta-text">
                    <h4>Mail us</h4>
                    <span>info@abroegypt.com</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-content pt-5 pb-5">
            <div class="row">
              <div class="col-xl-4 col-lg-4 mb-50">
                <div class="footer-widget">
                  <div class="footer-logo">
                    <a href="<?php echo $abro->baseUrl; ?>"
                      ><img
                        src="<?php echo $abro->baseUrl; ?>assets/img/header-logo.png?v=5"
                        class="img-fluid"
                        alt="logo"
                    /></a>
                  </div>
                  <div class="footer-text">
                    <p>
                      ABRO® is proud of its American origin, it has won a high
                      place for every user, and more than 300 products that meet
                      all the customer’s needs for his car.
                    </p>
                  </div>
                  <div class="footer-social-icon">
                    <span>Follow us</span>
                    <a href="<?php echo $abro->socialMediaLinks["facebook"]; ?>"
                      ><i class="fab fa-facebook-f facebook-bg"></i
                    ></a>
                    <a href="<?php echo $abro->socialMediaLinks["instagram"]; ?>"><i class="fab fa-instagram"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                <div class="footer-widget">
                  <div class="footer-widget-heading">
                    <h3>Useful Links</h3>
                  </div>
                  <ul>
                    <?php
                      foreach ($categories as $value) {
                        ?>
                          <li><a href="<?php echo $abro->baseUrl; ?>shop/<?php echo strtolower(str_replace(" ", "-", $value["Name"])); ?>/"><?php echo $value["Name"]; ?></a></li>
                        <?php
                      }
                    ?>
                    <li><a href="<?php echo $abro->baseUrl; ?>blogs/">Blogs</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                <div class="footer-widget">
                  <div class="footer-widget-heading">
                    <h3>Subscribe</h3>
                  </div>
                  <div class="footer-text mb-25">
                    <p>
                      Don’t miss to subscribe to our new feeds, kindly fill the
                      form below.
                    </p>
                  </div>
                  <div class="subscribe-form">
                    <form action="#">
                      <input type="text" placeholder="Email Address" />
                      <button><i class="fab fa-telegram-plane"></i></button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 mb-30 privacy-terms">
                <div class="footer-widget">
                  <div class="footer-widget-heading">
                    <h3>Information</h3>
                  </div>
                  <ul>
                    <li><a href="<?php echo $abro->baseUrl; ?>accessibility/">Accessibility</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>terms-and-conditions/">Terms and conditions</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>refund-policy/">Refund Policy</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>privacy-notices/">Privacy notices</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>cookie-policy/">Cookie policy</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>accessibility/">Accessibility</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>fraud-and-scam-alert/">Fraud and scam alert</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-area">
          <div class="container p-0">
            <div class="row align-items-center">
              <div class="col-xl-4 col-lg-6 text-center text-lg-left p-0">
                <div class="copyright-text">
                  <p>Designed and developed by <a href="https://www.treeegypt.com/">TREE Marketing</a></p>
                </div>
              </div>
              <div class="col-xl-8 col-lg-6 d-none d-lg-block text-right p-0">
                <div class="footer-menu">
                  <ul>
                    <li><a href="<?php echo $abro->baseUrl; ?>accessibility/">Accessibility</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>terms-and-conditions/">Terms and conditions</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>refund-policy/">Refund Policy</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>privacy-notices/">Privacy notices</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>cookie-policy/">Cookie policy</a></li>
                    <li><a href="<?php echo $abro->baseUrl; ?>fraud-and-scam-alert/">Fraud and scam alert</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <div class="toolbar-mobile">
        <a href="<?php echo $abro->baseUrl; ?>wishlist/" class="t-i">
          <div class="t-i-i">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/wishlist.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/wishlist.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/wishlist.png">
            <div class="wishlist">0</div>
          </div>
          <span>Wishlist</span>
        </a>
        <div class="t-i cart-btn">
          <div class="t-i-i">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/cart.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/cart.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/cart.png">
            <div class="cart">0</div>
          </div>
          <span>Cart</span>
        </div>
        <?php if($abro->account === null): ?>
        <a class="t-i account-btn">
        <?php else: ?>
        <a href="<?php echo $abro->baseUrl; ?>account/" class="t-i">
        <?php endif; ?>
          <div class="t-i-i">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/account.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/account.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/account.png">
          </div>
          <span>Account</span>
        </a>
        <div class="t-i search-btn">
          <div class="t-i-i">
            <img src="<?php echo $abro->baseUrl; ?>assets/icons/search.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/search.png">
            <img class="pseudo" src="<?php echo $abro->baseUrl; ?>assets/icons/search.png">
          </div>
          <span>Search</span>
        </div>
      </div>
    </main>
  </body>
</html>