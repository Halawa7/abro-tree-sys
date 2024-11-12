      </section>
      <section class="breadcrumb justify-content-center text-center"><span class="fw-500">Track your orders</span></section>
      <section class="my-orders">
        <div class="m-o-nav">
            <a class="active"><i class="fa-solid fa-box"></i> My orders</a>
            <a class="accountWishlist" href="<?php echo $abro->baseUrl; ?>wishlist/"><i class="fa-regular fa-heart"></i> <span>Wishlist (0)</span></a>
            <a href="<?php echo $abro->baseUrl; ?>logout/"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
        <div class="m-o-c">
            <span>Hello <b><?php echo $abro->account->info->Name; ?></b> (not <b><?php echo $abro->account->info->Name; ?></b>? <a href="<?php echo $abro->baseUrl; ?>logout/">Log out</a>)</span>
            <h3>Order History</h3>
            <?php if(count($options["Orders"]) > 0): ?>
            <table>
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Payment Status</th>
                    <th>Fulfillment Status</th>
                    <th>Total</th>
                </tr>
            <?php
            foreach ($options["Orders"] as $order) {
                ?>
                <tr>
                    <td><span class="order-id">#<?php echo $order["ID"]; ?></span></td>
                    <td><?php echo date("F d, Y", strtotime($order["Date"])); ?></td>
                    <td><?php if($order["PaymentMethod"] == "cod"): ?>
                    <img class="table-payment-method" src="/assets/icons/cod.png">
                    <?php elseif($order["PaymentMethod"] == "payatfawry"): ?>
                    <img class="table-payment-method" src="/assets/img/brand/fawrypay-logo.png">
                    <?php elseif($order["PaymentMethod"] == "card"): ?>
                    <?php $card = "meeza-logo.svg";
                    if ($abro->getCardType($order["CardNumber"]) == "mastercard") {
                        $card = "mastercard-logo.svg";
                    } else if ($abro->getCardType($order["CardNumber"]) == "visa") {
                        $card = "visa-logo.svg";
                    }?>
                    <img class="table-payment-method" src="/assets/img/brand/<?php echo $card; ?>">
                    <?php endif; ?></td>
                    <td><?php echo ucfirst($order["Status"]); ?></td>
                    <td>LE <?php echo $order["Net"]; ?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php else: ?>
            <div class="o-h-message">
                <img src="<?php echo $abro->baseUrl; ?>assets/icons/check-mark.png">
                <a href="<?php echo $abro->baseUrl; ?>">Make your first order</a>
                <span>You haven't placed any orders yet.</span>
            </div>
            <?php endif; ?>
            <h3>Account details:</h3>
            <table>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $abro->account->info->Name; ?></td>
                </tr>
                <?php if(strlen($abro->account->info->PhoneNumber)): ?>
                <tr>
                    <th>Phone number:</th>
                    <td><?php echo $abro->account->info->PhoneNumber; ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th>E-mail:</th>
                    <td><?php echo $abro->account->info->Email; ?></td>
                </tr>
            </table>
        </div>
      </section>
