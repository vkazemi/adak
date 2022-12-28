<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['sender_access'])
            redirect('nafispanel');
?>
<?php flash('sender_message'); ?>
<a href="<?php echo URLROOT; ?>/senders/add" class="btn btn-success pull-right">Add sender</a> 
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
<?php foreach($data['senders'] as $sender) : ?>

            <tr>
              <td><?php echo $sender->id; ?></td>
              <td><?php echo $sender->name; ?></td>
              <td><?php echo $sender->state == 1 ? 'Enabled' : 'Disabled'; ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/senders/delete/<?php echo $sender->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/senders/edit/<?php echo $sender->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
