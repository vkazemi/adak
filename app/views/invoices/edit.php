<?php require APPROOT.'/views/inc/header.php'; 
// Check user have access
if(!$_SESSION['invoice_access'])
            redirect('nafispanel');
?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2><?php echo $data['title'];  ?></h2>
                <form action="<?php echo URLROOT; ?>/invoices/edit/<?php echo $data['id']; ?>" method="post">

                <div class="form-group">
                        <label for="ownner">Cargo<sup>*</sup></label>
                        <select class="form-control" name="owner" class="form-control form-control-lg <?php  echo(!empty
                        ($data['owner_err'])) ? 'is-invalid' : ''; ?>">
                            <?php foreach($data['owner_items'] as $id => $name):  ?>
                                <option value="<?php echo $id; ?>"<?php echo $data['owner'] == $id ? ' selected' : ''; ?>><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['owner_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="driver">Driver<sup>*</sup></label>
                        <select class="form-control" name="driver" class="form-control form-control-lg <?php  echo(!empty
                        ($data['driver_err'])) ? 'is-invalid' : ''; ?>">
                            <?php foreach($data['driver_items'] as $id => $name):  ?>
                                <option value="<?php echo $id; ?>"<?php echo $data['driver'] == $id ? ' selected' : ''; ?>><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['cargo_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="cargo">Cargo<sup>*</sup></label>
                        <select class="form-control" name="cargo" class="form-control form-control-lg <?php  echo(!empty
                        ($data['cargo_err'])) ? 'is-invalid' : ''; ?>">
                            <?php foreach($data['cargo_items'] as $id => $name):  ?>
                                <option value="<?php echo $id; ?>"<?php echo $data['cargo'] == $id ? ' selected' : ''; ?>><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['cargo_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="sender">Sender<sup>*</sup></label>
                        <select class="form-control" name="sender" class="form-control form-control-lg <?php  echo(!empty
                        ($data['sender_err'])) ? 'is-invalid' : ''; ?>">
                            <?php foreach($data['sender_items'] as $id => $name):  ?>
                                <option value="<?php echo $id; ?>"<?php echo $data['sender'] == $id ? ' selected' : ''; ?>><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['sender_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination<sup>*</sup></label>
                        <select class="form-control" name="destination" class="form-control form-control-lg <?php  echo(!empty
                        ($data['destination_err'])) ? 'is-invalid' : ''; ?>">
                            <?php foreach($data['destination_items'] as $id => $name):  ?>
                                <option value="<?php echo $id; ?>"<?php echo $data['destination'] == $id ? ' selected' : ''; ?>><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['destination_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="ship">Ship<sup>*</sup></label>
                        <select class="form-control" name="ship" class="form-control form-control-lg <?php  echo(!empty
                        ($data['ship_err'])) ? 'is-invalid' : ''; ?>">
                            <?php foreach($data['ship_items'] as $id => $name):  ?>
                                <option value="<?php echo $id; ?>"<?php echo $data['ship'] == $id ? ' selected' : ''; ?>><?php echo $name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['ship_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount: <sup>*</sup></label>
                        <input type="text" name='amount' class="form-control form-control-lg <?php  echo(!empty
                        ($data['amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['amount']; ?>">
                        <span class="invalid-feedback"><?php echo $data['amount_err']; ?></span>
                    </div>

                    <div class="row">
                            <input type="submit" value="Update" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>