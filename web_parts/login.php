      </section>
      <section class="breadcrumb justify-content-center text-center"><span class="fw-500">Log in to your account</span></section>
      <section class="login">
        <div class="login-credentials"<?php if(isset($options["RestPassword"])): ?> style="transform:translateX(-100%);"<?php endif; ?>>
          <h2 class="text-uppercase"><i class="fa-regular fa-circle-user"></i> Login</h2>
          <?php if(isset($options["Error"])): ?>
          <div class="error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span><?php echo $options["Error"]; ?></span>
          </div>
          <?php endif; ?>
          <form method="post" action="/login/" class="login-form">
            <div class="l-f-box">
                <label class="input-label" for="email">Email address <span class="required">*</span></label>
                <input type="email" name="email" class="input" required/>
            </div>
            <div class="l-f-box">
                <label class="input-label" for="password">Password <span class="required">*</span></label>
                <input type="password" name="password" class="input" required/>
            </div>
            <a class="goToForgetPass">Forget your password?</a>
            <button type="submit" name="login">Sign in</button>
            <p>
              <span>New customer?</span>
              <a href="<?php echo $abro->baseUrl; ?>register/">Create your account</a>
            </p>
          </form>
        </div>
        <div class="reset-your-password"<?php if(isset($options["RestPassword"])): ?> style="transform:translateX(-100%);"<?php endif; ?>>
          <h2 class="text-uppercase">Reset your password</h2>
          <p>
            <span>Lost your password? Please enter your email address. You will receive a link to create a new password via email.</span>
          </p>
          <form class="login-form">
            <div class="l-f-box">
                <label class="input-label" for="email">Email address <span class="required">*</span></label>
                <input type="email" name="email" class="input" required/>
            </div>
            <button type="submit" name="resetPassword">Reset password</button>
            <button type="button" name="backToLogin">Cancel</button>
          </form>
        </div>
      </section>