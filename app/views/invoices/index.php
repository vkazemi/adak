<?php require APPROOT.'/views/inc/header.php';
// Check user have access
if(!$_SESSION['invoice_access'])
            redirect('nafispanel');
?>
<?php flash('invoice_message'); ?>
  <form class='pull-left ml-2' action="<?php echo URLROOT ?>/invoices/index" method="post">	
    <div class="row">	

      <div class="form-group col-md-3">
          <input type="text" class="search form-control" id="driver_name_param" name="driver_name_param" placeholder="By driver"
          value="<?php echo isset($_POST['driver_name_param']) ? $_POST['driver_name_param'] : ''; ?>">			
      </div>

      <div class="form-group col-md-3">
        <input type="text" class="search form-control" id="owner_name_param" name="owner_name_param" placeholder="By owner"
         value="<?php echo isset($_POST['owner_name_param']) ? $_POST['owner_name_param'] : ''; ?>">			
      </div>

      <div class="form-group col-md-3">
        <input type="text" class="search form-control" id="cargo" name="cargo_name_param" placeholder="By cargo"
         value="<?php echo isset($_POST['cargo_name_param']) ? $_POST['cargo_name_param'] : ''; ?>">			
      </div>

      <div class="form-group col-md-3">
        <input type="submit" class="btn btn-primary" value="Filter">
      </div>
    </div>
  </form> 


<a href="<?php echo URLROOT; ?>/invoices/add" class="btn btn-success pull-right">Add invoice</a> 

<div class="field-holder has-selectmenu">
  <span>
    <form class='pull-left ml-2' action="<?php echo URLROOT ?>/invoices/exportexcel" method="post">	
      <input type="hidden" name="driver_name_param" value="<?php echo (isset($_POST['driver_name_param'])) ? $_POST['driver_name_param'] : ''; ?>" />
      <input type="hidden" name="cargo_name_param" value="<?php echo (isset($_POST['cargo_name_param'])) ? $_POST['cargo_name_param'] : ''; ?>" />
      <input type="hidden" name="owner_name_param" value="<?php echo (isset($_POST['owner_name_param'])) ? $_POST['owner_name_param'] : ''; ?>" />
      <input id="excel_btn" type="submit" name="export" class="btn btn-info pull-left" value="Export" />
    </form>                         
  </span>
</div>

<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Owner</th>
              <th>Driver</th>
              <th>Sender</th>
              <th>Destination</th>
              <th>Ship</th>
              <th>Exit date</th>
              <th>Cargo</th>
              <th>Amount</th>
              <th>price</th>
              <th>Total price</th>
            </tr>
          </thead>
          <tbody>
       <?php foreach($data['invoices'] as $invoices_array) : ?>
          <?php foreach($invoices_array as $invoice) : ?>

            <tr>
              <td><?php echo $invoice->id; ?></td>
              <td>
                <?php 
                foreach($data['owners'] as $owner){
                  if($owner->id == $invoice->owner)
                    echo $owner->name;
                }
                ?>
              </td>
              <td>
                <?php
                foreach($data['drivers'] as $driver){
                  if($driver->id == $invoice->driver)
                    echo $driver->name;
                }
                ?>
              </td>
              <td>
              <?php
                foreach($data['senders'] as $sender){
                  if($sender->id == $invoice->sender)
                    echo $sender->name;
                }
                ?>
              </td>
              <td>
              <?php
                foreach($data['destinations'] as $destination){
                  if($destination->id == $invoice->destination)
                    echo $destination->name;
                }
                ?>
              </td>
              <td>
              <?php
                foreach($data['ships'] as $ship){
                  if($ship->id == $invoice->ship)
                    echo $ship->name;
                }
                ?>
              </td>
              <td><?php echo $invoice->date_exit; ?></td>
              <td>
              <?php
                foreach($data['cargoes'] as $cargo){
                  if($cargo->id == $invoice->cargo)
                    echo $cargo->name;
                }
                ?>
              </td>
              <td><?php echo $invoice->amount; ?></td>
              <td>
                <?php 
                // Get price for cargo types 
                foreach($data['cargoes'] as $cargo){
                  if($cargo->id == $invoice->cargo){
                    $price = $cargo->price;
                    echo convert_to_price($price);
                  }   
                }
                
              ?>
              </td>
              <td><?php 
              // Calculate total price for this invoice
              $total_price = $price * $invoice->amount;
              echo convert_to_price($total_price); ?></td>
              <td>
                <form class='pull-right ml-2' action="<?php echo URLROOT ?>/invoices/delete/<?php echo $invoice->id; ?>"
                 method="post" onclick="return confirm('Are you sure?');">
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form> 
                <a href="<?php echo URLROOT; ?>/invoices/edit/<?php echo $invoice->id; ?>" class="btn btn-dark btn-sm pull-right">Edit</a>
                <a href="<?php echo URLROOT; ?>/invoices/exportpdf/<?php echo $invoice->id; ?>" class="btn btn-dark btn-sm pull-right mx-2">Pdf</a>

              </td>
            </tr>
 
<?php endforeach; ?>
<?php endforeach; ?>
    </table>
 </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
