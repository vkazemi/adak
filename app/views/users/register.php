<?php require APPROOT.'/views/inc/header.php'; 
// Check user have access
if(!$_SESSION['user_access'])
            redirect('nafispanel');
?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2><?php echo $data['title'];  ?></h2>
                <p>Please fill out this form to register</p>
                <form action="<?php echo URLROOT; ?>/users/register" method="post">
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
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name='password' class="form-control form-control-lg <?php  echo(!empty
                        ($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name='confirm_password' class="form-control form-control-lg <?php  echo(!empty
                        ($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>

                    <label class="custom-control-label">Permissions</label>
                    <div class="card p-2">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="user_access">
                                        <label class="custom-control-label" for="user_access">Users</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="ship_access">
                                        <label class="custom-control-label" for="ship_access">Ships</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="destination_access">
                                        <label class="custom-control-label" for="destination_access">Destinations</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="sender_access">
                                        <label class="custom-control-label" for="sender_access">Senders</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="invoice_acccess">
                                        <label class="custom-control-label" for="invoice_access">invoice</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="driver_access">
                                        <label class="custom-control-label" for="driver_access">Drivers</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="cargo_access">
                                        <label class="custom-control-label" for="cargo_access">Cargoes</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="custom-control-input" name="owner_access">
                                        <label class="custom-control-label" for="owner_access">Owners</label>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
           
                    <div class="row">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>