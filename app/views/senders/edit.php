<?php require APPROOT.'/views/inc/header.php'; 
// Check user have access
if(!$_SESSION['sender_access'])
            redirect('nafispanel');
?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2><?php echo $data['title'];  ?></h2>
                <form action="<?php echo URLROOT; ?>/senders/edit/<?php echo $data['id']; ?>" method="post">

                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name='name' class="form-control form-control-lg <?php  echo(!empty
                        ($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
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
                            <input type="submit" value="Update" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>