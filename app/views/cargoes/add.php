<?php require APPROOT.'/views/inc/header.php'; 
// Check user have access
if(!$_SESSION['cargo_access'])
            redirect('nafispanel');
?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2><?php echo $data['title'];  ?></h2>
                <form action="<?php echo URLROOT; ?>/cargoes/add" method="post">

                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name='name' class="form-control form-control-lg <?php  echo(!empty
                        ($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit: <sup>*</sup></label>
                        <input type="text" name='unit' class="form-control form-control-lg <?php  echo(!empty
                        ($data['unit'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['unit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['unit_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="price">Unit: <sup>*</sup></label>
                        <input type="text" name='price' class="form-control form-control-lg <?php  echo(!empty
                        ($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                        <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                    </div>
           
                    <div class="row">
                            <input type="submit" value="Create" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>