<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['driver_access'])
            redirect('nafispanel');
?>
<?php flash('driver_message'); ?>
<a href="<?php echo URLROOT; ?>/drivers/add" class="btn btn-success pull-right">Add driver</a> 
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Car tag</th>
              <th>Card number</th>
              <th>State</th>
            </tr>
          </thead>
          <tbody>
<?php foreach($data['drivers'] as $driver) : ?>

            <tr>
              <td><?php echo $driver->id; ?></td>
              <td><?php echo $driver->name; ?></td>
              <td><?php echo $driver->address; ?></td>
              <td><?php echo $driver->phone; ?></td>
              <td><?php echo $driver->cartag; ?></td>
              <td><?php echo $driver->card_number; ?></td>
              <td><?php echo $driver->state == 1 ? 'Enabled' : 'Disabled'; ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/drivers/delete/<?php echo $driver->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/drivers/edit/<?php echo $driver->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
