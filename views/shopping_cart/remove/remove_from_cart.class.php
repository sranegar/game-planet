<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/25/2021
 * File: remove_from_cart.class.php
 * Description:
 */
class RemoveFromCart extends IndexView
{
    public function display($remove, $rows)
    {
        parent::displayHeader("Shopping Cart");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $cart = $_SESSION['cart'];
        //variables for a user's login, name, and role

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
                <div class="row-header"><?= $count ?> items in your cart</div>
                <?php
                if ($cart === 0) {
                    echo "You have no games added to your cart yet.";
                } else {

                    foreach ($rows as $x => $x_value) {
                        $id = $x_value['games_id'];
                        $title = $x_value['title'];
                        $price = $x_value['price'];
                        $image = $x_value['image'];
                        $year = $x_value['publish_year'];
                        $system = $x_value['name'];
                        $qty = $cart[$id];
                        $subtotal = $qty * $price;
                        $total = $subtotal * $count;
                        $tax = $total * .0523;
                        $estimated_total = $total + $tax;

                        if ($estimated_total > 49) {
                            $shipping = 0;
                        } else {
                            $shipping = $count * 3.24;
                        }

                        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                            $image = BASE_URL . "/" . GAME_IMG . $image;
                        }
                        if ($x % 1 == 0) {
                            echo "<div class='row'>";
                        }


                        echo "<form method='get' action=" . BASE_URL . "/cart/remove/" . $id . "><div class='row-right'><div class='col1-cart'><input type='hidden' name='games_id' id='id' value=' . $id . '/><a href='" . BASE_URL . "/game/details/" . $id . "'><img style='padding: 6px; width: 120px; height: 175px' src='" . $image .
                            "'></a><p><strong style='font-size: 14px; color: #0e50a7'>$title</strong><br><i style='font-family: Lora; font-size: 13px; color: black; opacity: 70%;'>$system</i><br>$year</p></div><div class='col2-cart'>$$price</div><div class='col3-cart'>QTY: $qty<div><input class='remove-button' name='remove' type='submit' value='Remove'></div></div><div class='col4-cart'><strong style='font-size: 18px; color: #e41f49;'>$", number_format($subtotal, 2, '.'), "</strong></div></div></form>";

                        ?>
                        <?php

                        if ($x % 1 == 0 || $x == count($rows) - 1) {
                            echo "</div>";
                        }
                    }

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
                        <h4 style="margin-top: 2px">$<?= number_format($total, 2, '.') ?><br><br>
                            $<?= number_format($shipping, 2, '.') ?><br><br>
                            $<?= number_format($tax, 2, '.') ?></h4><br>
                        <h3 style="font-size: 21px;">
                            $<?= number_format($estimated_total, 2, '.') ?>
                        </h3>
                    </div>
                </div>
                <button class="cart-button">CHECKOUT</button>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <?php
        parent::displayFooter();
    }
}