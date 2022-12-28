<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['ship_access'])
            redirect('nafispanel');
?>
<?php flash('cargo_message'); ?>
<a href="<?php echo URLROOT; ?>/cargoes/add" class="btn btn-success pull-right">Add cargo</a> 
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Unit</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
<?php foreach($data['cargoes'] as $cargo) : ?>

            <tr>
              <td><?php echo $cargo->id; ?></td>
              <td><?php echo $cargo->name; ?></td>
              <td><?php echo $cargo->unit; ?></td>
              <td><?php echo convert_to_price($cargo->price); ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/cargoes/delete/<?php echo $cargo->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/cargoes/edit/<?php echo $cargo->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
