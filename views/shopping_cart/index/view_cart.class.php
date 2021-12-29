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


                        echo "<form method='get' action=" . BASE_URL . "/cart/remove/><div class='row-right'><div class='col1-cart'><input type='hidden' name='games_id' id='id' value=' . $games_id . '/><a href='" . BASE_URL . "/game/details/" . $games_id . "' style='text-decoration: none;'><img style='padding: 3px; width: 120px; height: 175px' src='" . $image .
                            "'><p><strong style='font-size: 14px; color: #0e50a7'>$title</strong></a><br><i style='font-family: Lora; font-size: 13px; color: black; opacity: 70%;'>$system</i><br>$year</p></div><div class='col2-cart'>$$price</div><div class='col3-cart'>QTY: $qty<div><input class='remove-button' name='remove' type='submit' value='Remove'></div></div><div class='col4-cart'><strong style='font-size: 18px; color: #e41f49;'>$", number_format($subtotal, 2, '.'), "</strong></div></div></form>";

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