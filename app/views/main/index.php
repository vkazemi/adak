<?php require APPROOT.'/views/inc/header.php'; ?>
<div class="container">
    <ul class="main-items">
            <?php if(isset($_SESSION['user_access']) && $_SESSION['user_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/users" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/users.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Users'; ?></span>
                    </a>
                </li>

            <?php endif; ?>

            <?php if(isset($_SESSION['ship_access']) && $_SESSION['ship_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/ships" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/ships.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Ship'; ?></span>
                    </a>
                </li>

            <?php endif; ?>

            <?php if(isset($_SESSION['cargo_access']) && $_SESSION['cargo_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/cargoes" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/cargo.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Cargo'; ?></span>
                    </a>
                </li>

            <?php endif; ?>

            <?php if(isset($_SESSION['destination_access']) && $_SESSION['destination_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/destinations" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/destinations.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Destinations'; ?></span>
                    </a>
                </li>

            <?php endif; ?>

            <?php if(isset($_SESSION['sender_access']) && $_SESSION['sender_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/senders" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/senders.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Senders'; ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(isset($_SESSION['owner_access']) && $_SESSION['owner_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/owners" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/owners.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Owners'; ?></span>
                    </a>
                </li>
            <?php endif; ?>



            <?php if(isset($_SESSION['driver_access']) && $_SESSION['driver_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/drivers" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/drivers.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Drivers'; ?></span>
                    </a>
                </li>
            <?php endif; ?>



            <?php if(isset($_SESSION['invoice_access']) && $_SESSION['invoice_access']) :?>
                <li class="list-member">
                    <a href="<?php echo URLROOT; ?>/invoices" target="_blank">
                        <img src="<?php echo URLROOT.'/public/img/items/invoice.png'; ?>" alt="" />
                        <span class="item-title"><?php echo 'Invoices'; ?></span>
                    </a>
                </li>

            <?php endif; ?>
    </ul>
</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
