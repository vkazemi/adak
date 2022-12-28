<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['ship_access'])
            redirect('nafispanel');
?>
<?php flash('ship_message'); ?>
<a href="<?php echo URLROOT; ?>/ships/add" class="btn btn-success pull-right">Add ship</a> 
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Code</th>
              <th>State</th>
            </tr>
          </thead>
          <tbody>
<?php foreach($data['ships'] as $ship) : ?>

            <tr>
              <td><?php echo $ship->id; ?></td>
              <td><?php echo $ship->name; ?></td>
              <td><?php echo $ship->code; ?></td>
              <td><?php echo $ship->state == 1 ? 'Enabled' : 'Disabled'; ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/ships/delete/<?php echo $ship->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/ships/edit/<?php echo $ship->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
