<?php require APPROOT.'/views/inc/header.php'; 
// Check user have access
if(!$_SESSION['user_access'])
            redirect('nafispanel');
?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['id']; ?>" method="post">
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name='name' class="form-control form-control-lg <?php  echo(!empty
                        ($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="username">Username: <sup>*</sup></label>
                        <input type="text" name='username' class="form-control form-control-lg <?php  echo(!empty
                        ($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>">
                        <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="current_password_err">Current Password: <sup>*</sup></label>
                        <input type="password" autocomplete ="new-password" name='current_password' class="form-control form-control-lg <?php  echo(!empty
                        ($data['current_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['current_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['current_password_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">New Password: <sup>*</sup></label>
                        <input type="password" autocomplete ="new-password" name='password' class="form-control form-control-lg <?php  echo(!empty
                        ($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password: <sup>*</sup></label>
                        <input type="password" autocomplete ="new-password" name='confirm_password' class="form-control form-control-lg <?php  echo(!empty
                        ($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>

                    <label class="custom-control-label">Permissions</label>
                    <div class="card p-2">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                        <input type="checkbox" <?php echo $data['user_access'] ? ' checked ' : ''; ?> name="access[]" value='user_access'>
                                        <label >Users</label>
                                </div>

                                <div class="form-group">
                                        <input type="checkbox" <?php echo $data['ship_access'] ? ' checked ' : ''; ?> name="access[]" value='ship_access'>
                                        <label >Ships</label>
                                </div>

                                <div class="form-group">
                                        <input type="checkbox" <?php echo $data['destination_access'] ? ' checked ' : ''; ?> name="access[]" value='destination_access'>
                                        <label >Destinations</label>
                                </div>

                                <div class="form-group">
                                        <input type="checkbox" <?php echo $data['sender_access'] ? ' checked ' : ''; ?> name="access[]" value='sender_access'>
                                        <label >Senders</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" <?php echo $data['invoice_access'] ? ' checked ' : ''; ?> name="access[]" value='invoice_access'>
                                    <label >invoice</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" <?php echo $data['driver_access'] ? ' checked ' : ''; ?> name="access[]" value='driver_access'>
                                    <label >Drivers</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" <?php echo $data['cargo_access'] ? ' checked ' : ''; ?> name="access[]" value='cargo_access'>
                                    <label >Cargoes</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" <?php echo $data['owner_access'] ? ' checked ' : ''; ?> name="access[]" value='owner_access'>
                                    <label >Owners</label>
                                </div>

                            </div>
                        </div>          
                    </div>

                    <div class="row">
                            <input type="submit" value="Update" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>