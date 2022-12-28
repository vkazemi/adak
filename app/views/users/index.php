<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['user_access'])
            redirect('nafispanel');
?>
<?php flash('user_message'); ?>
<a href="<?php echo URLROOT; ?>/users/register" class="btn btn-success pull-right">Add user</a> 
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Username</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php foreach($data['users'] as $user) : ?>

            <tr>
              <td><?php echo $user->id; ?></td>
              <td><?php echo $user->name; ?></td>
              <td><?php echo $user->username; ?></td>
              <td>
                <?php 
                  // User admin must not be able to delete
                  if($user->username != 'admin' ): ?>
                    <form class='pull-right ml-2' action="<?php echo URLROOT ?>/users/delete/<?php echo $user->id; ?>"
                     method="post" onclick="return confirm('Are you sure?');">
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                    </form> 
                  <?php endif; ?>
                 <a href="<?php echo URLROOT; ?>/users/edit/<?php echo $user->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>

              </td>
            </tr>
 
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
