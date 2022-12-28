<?php require APPROOT.'/views/inc/header.php'; 
// Check user have access
if(!$_SESSION['driver_access'])
            redirect('nafispanel');
?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2><?php echo $data['title'];  ?></h2>
                <form action="<?php echo URLROOT; ?>/drivers/add" method="post">

                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name='name' class="form-control form-control-lg <?php  echo(!empty
                        ($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">address: <sup>*</sup></label>
                        <input type="text" name='address' class="form-control form-control-lg <?php  echo(!empty
                        ($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>">
                        <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">phone: <sup>*</sup></label>
                        <input type="text" name='phone' class="form-control form-control-lg <?php  echo(!empty
                        ($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
                        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Car tag: <sup>*</sup></label>
                        <input type="text" name='cartag' class="form-control form-control-lg <?php  echo(!empty
                        ($data['cartag_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['cartag']; ?>">
                        <span class="invalid-feedback"><?php echo $data['cartag_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Card number: <sup>*</sup></label>
                        <input type="text" name='card_number' class="form-control form-control-lg <?php  echo(!empty
                        ($data['cartag_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['card_number']; ?>">
                        <span class="invalid-feedback"><?php echo $data['cartag_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" name="state" class="form-control form-control-lg <?php  echo(!empty
                        ($data['state_err'])) ? 'is-invalid' : ''; ?>">
                            <option value="1"<?php echo $data['state'] == 1 ? ' selected' : ''; ?>>Enabled</option>
                            <option value="0"<?php echo $data['state'] == 0 ? ' selected' : ''; ?>>Disabled</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['state_err']; ?></span>
                    </div>
           
                    <div class="row">
                            <input type="submit" value="Create" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>