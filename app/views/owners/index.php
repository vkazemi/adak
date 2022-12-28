<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['owner_access'])
            redirect('nafispanel');
?>
<?php flash('owner_message'); ?>
<a href="<?php echo URLROOT; ?>/owners/add" class="btn btn-success pull-right">Add owner</a> 
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Post code</th>
              <th>State</th>
            </tr>
          </thead>
          <tbody>
<?php foreach($data['owners'] as $owner) : ?>

            <tr>
              <td><?php echo $owner->id; ?></td>
              <td><?php echo $owner->name; ?></td>
              <td><?php echo $owner->address; ?></td>
              <td><?php echo $owner->phone; ?></td>
              <td><?php echo $owner->post_code; ?></td>
              <td><?php echo $owner->state == 1 ? 'Enabled' : 'Disabled'; ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/owners/delete/<?php echo $owner->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/owners/edit/<?php echo $owner->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
