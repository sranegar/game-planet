<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/20/2021
 * File: view_cart.class.php
 * Description:
 */

class ViewCart extends IndexView
{
    public function display($rows)
    {
        parent::displayHeader("Shopping Cart");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        $count = 0;

        //retrieve cart content
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            if ($cart) {
                $count = array_sum($cart);

            }
        }

        ?>
        <div class="top-row">Shopping Cart</div>
        <!--  display shopping cart content -->
        <div class="cart-wrapper">
            <div>
                <?php
                if ($count > 0) {
                    echo "<div class='row-header'>You have $count item(s) in your cart.</div>";
                    foreach ($rows as $x => $x_value) {
                        $games_id = $x_value['games_id'];
                        $title = $x_value['title'];
                        $price = $x_value['price'];
                        $image = $x_value['image'];
                        $year = $x_value['publish_year'];
                        $system = $x_value['name'];
                        $qty = $cart[$games_id];
                        $subtotal = $qty * $price;
                        $total = $subtotal * $count;
                        $tax = $total * .0523;
                        $estimated_total = $total + $tax;

                        //calculate shipping cost
                        if ($estimated_total > 49) {
                            $shipping = 0;
                        } else {
                            $shipping = $count * 3.24;
                        }

                        //retrieve game images
                        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                            $image = BASE_URL . "/" . GAME_IMG . $image;
                        }
                        if ($x % 1 == 0) {
                            echo "<div class='row'>";
                        }


                        echo "<div class='row-right'><div class='col1-cart'><a href='" . BASE_URL . "/game/details/" . $games_id . "' style='text-decoration: none;'><img style='padding: 3px; width: 120px; height: 175px' src='" . $image .
                            "' alt='game'><p><strong style='font-size: 14px; color: #0e50a7'>$title</strong></a><br><i style='font-family: Lora; font-size: 13px; color: black; opacity: 70%;'>$system</i><br>$year</p></div><div class='col2-cart'>$$price</div>
                            <div class='col3-cart'><div class='cart-info quantity'>QTY: $qty</div><input class='gm-id' type='hidden' id='g_id' name='games_id' value='$games_id'><div><button type='button' onclick='remove($games_id)' id='remove' value='$games_id' class='remove-button'>Remove</button></div></div><div class='col4-cart'><strong style='font-size: 18px; color: #e41f49;'>$", number_format($subtotal, 2, '.'), "</strong></div><div class='col5-cart'><i class='far fa-times-circle x' type='button' onclick='deleteAll($games_id)' value='$games_id' style='font-size: 1.35em'></i></div></div>";

                        ?>
                        <?php
                        if ($x % 1 == 0 || $x == count($rows) - 1) {
                            echo "</div>";
                        }
                    }
                } else {
                    echo "<div class='row-header'>You have $count items in your cart.</div>";
                    echo "<h2 style='padding: 10px'>Your cart is empty.</h2>";
                }
                ?>
            </div>
            <div class="order-summary">
                <div class="order-summary-header">Order Summary</div>
                <div class="summary-wrapper">
                    <div class="left-col">
                        <h4>Subtotal:<br><br>
                            Shipping & Handling:<br><br>
                            Estimated Tax:</h4><br>
                        <h3 style="font-size: 22px; color: #132ea3">
                            Estimated Total:
                        </h3>
                    </div>
                    <div class="right-col">
                        <?php
                        //display pricing order summary
                        if (!empty($cart)) {
                            ?>
                            <h4 style="margin-top: 2px">$<?= number_format($total, 2, '.') ?><br><br>
                                $<?= number_format($shipping, 2, '.') ?><br><br>
                                $<?= number_format($tax, 2, '.') ?></h4><br>
                            <h3 style="font-size: 21px;">
                                $<?= number_format($estimated_total, 2, '.') ?>
                            </h3>
                            <?php
                        } else {
                            ?>
                            <h4 style="margin-top: 2px">$0.00<br><br>
                                $0.00<br><br>
                                $0.00</h4><br>
                            <h3 style="font-size: 21px;">
                                $0.00
                            </h3>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <button class="cart-button">Checkout</button>
                <form action="<?= BASE_URL ?>/cart/reset">
                    <input class="secondary-button empty-btn" type="submit" class='remove-button' value="Empty Cart">
                </form>
            </div>
        </div>
        <br>
        <br>
        <script src='<?= BASE_URL ?>/www/js/cart.js'></script>
        <?php
        parent::displayFooter();
    }
}