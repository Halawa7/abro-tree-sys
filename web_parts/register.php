      </section>
      <section class="breadcrumb justify-content-center text-center"><span class="fw-500">Create a new account</span></section>
      <section class="register">
        <h2 class="text-uppercase"><i class="fa-regular fa-address-card"></i> Register</h2>
        <?php if(isset($options["Error"])): ?>
        <div class="error">
          <i class="fa-solid fa-triangle-exclamation"></i>
          <span><?php echo $options["Error"]; ?></span>
        </div>
        <?php endif; ?>
        <form method="post" action="/register/" class="register-form">
          <div class="r-f-box">
            <label class="input-label" for="firstName">First name</label>
            <input type="text" name="firstName"<?php if(isset($options["FirstName"])): ?> value="<?php echo $options["FirstName"]; ?>"<?php endif; ?> class="input"/>
          </div>
          <div class="r-f-box">
            <label class="input-label" for="lastName">Last name</label>
            <input type="text" name="lastName"<?php if(isset($options["LastName"])): ?> value="<?php echo $options["LastName"]; ?>"<?php endif; ?> class="input"/>
          </div>
          <div class="r-f-box">
              <label class="input-label" for="number">Phone number <span class="required">*</span></label>
              <input type="text" name="number"<?php if(isset($options["Number"])): ?> value="<?php echo $options["Number"]; ?>"<?php endif; ?> class="input" required/>
          </div>
          <div class="r-f-box">
              <label class="input-label" for="email">Email address <span class="required">*</span></label>
              <input type="email" name="email"<?php if(isset($options["Email"])): ?> value="<?php echo $options["Email"]; ?>"<?php endif; ?> class="input" required/>
          </div>
          <div class="r-f-box">
              <label class="input-label" for="password">Password <span class="required">*</span></label>
              <input type="password" name="password" class="input" required/>
          </div>
          <button type="submit" name="register">Register</button>
          <p>
            <span>Already have an account?</span>
            <a href="<?php echo $abro->baseUrl; ?>login/">Login here</a>
          </p>
        </form>
      </section>