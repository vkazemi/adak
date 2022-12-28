<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['destination_access'])
            redirect('nafispanel');
?>
<?php flash('destination_message'); ?>
<a href="<?php echo URLROOT; ?>/destinations/add" class="btn btn-success pull-right">Add destination</a> 
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>State</th>
            </tr>
          </thead>
          <tbody>
<?php foreach($data['destinations'] as $destination) : ?>

            <tr>
              <td><?php echo $destination->id; ?></td>
              <td><?php echo $destination->name; ?></td>
              <td><?php echo $destination->state == 1 ? 'Enabled' : 'Disabled'; ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/destinations/delete/<?php echo $destination->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/destinations/edit/<?php echo $destination->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
