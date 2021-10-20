<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php if (!$shoppingDisabled) {
    ?>
<div class="store-utility-links <?= (0 == $itemCount ? 'store-cart-empty' : ''); ?>">
    <?php if ($showSignIn || $showGreeting) {
        ?>
    <p class="store-utility-links-login padding-top-15">
        <?php if ($showSignIn) {
            $u = new User();
            if (!$u->isLoggedIn()) {
                echo '<a href="' . \Concrete\Core\Support\Facade\Url::to('/login') . '">' . t("Sign In") . '</a>';
            }
        } ?>
        <?php if ($showGreeting) {
            $u = new User();
            if ($u->isLoggedIn()) {
                $msg = '<span class="store-welcome-message">' . t("Welcome back") . '</span>';
                $ui = $app->make(\Concrete\Core\User\UserInfoRepository::class)->getByID($u->getUserID());
                if ($ui && $firstname = $ui->getAttribute('billing_first_name')) {
                    $msg = '<span class="store-welcome-message">' . t("Welcome back, ") . '<span class="first-name">' . $firstname . '</span></span>';
                }
                echo $msg;
            }
        } ?>
        </p>
    <?php
    } ?>

<div class="grid-container">
    <div class="grid-row">
        <div class="column-4">
            <?php if ($showCartItems || $showCartTotal) {
                ?>
                <p class="store-utility-links-totals padding-top-25">
                    <?php if ($showCartItems) {
                    ?>
                        <span class="store-items-in-cart"><?= $itemsLabel; ?> (<span class="store-items-counter"><?= $itemCount; ?></span>)</span>
                    <?php
                } ?>

                    <?php if ($showCartTotal) {
                    ?>
                        <span class="store-total-cart-amount text-bold"><?= $total; ?></span>
                    <?php
                } ?>
                </p>
            <?php
            } ?>
        </div>
        <div class="column-8 text-right padding-top-15">
            <?php if (!$inCart) {
            ?>
            <span class="store-utility-links-cart-link">
                <?php if ($popUpCart && !$inCheckout) {
                ?>
                    <a href="#" class="store-cart-link store-cart-link-modal button button-primary margin-right-5"><?= $cartLabel; ?></a>
                <?php
            } else {
                ?>
                    <a href="<?= \Concrete\Core\Support\Facade\Url::to($langpath . '/cart'); ?>" class="store-cart-link"><?= $cartLabel; ?></a>
                <?php
            } ?>
            </span>
            <?php
            } ?>
        
        <?php if (!$inCheckout) {
        ?>
            <?php if ($showCheckout) {
                ?>
            <span  class="store-utility-links-checkout-link">
                <a href="<?= \Concrete\Core\Support\Facade\Url::to($langpath . '/checkout'); ?>" class="store-cart-link button button-primary"><?= t("Checkout"); ?></a>
            </span>
            <?php
            } ?>
        <?php
        } ?>
        </div>
    </div>
</div>
</div>
<?php
} ?>