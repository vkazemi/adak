<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Invoices extends Controller{

    public function __construct()
    {
        $this->invoiceModel = $this->model('Invoice');
        $this->cargoModel = $this->model('Cargo');
        $this->senderModel = $this->model('Sender');
        $this->destinationModel = $this->model('Destination');
        $this->driverModel = $this->model('Driver');
        $this->shipModel = $this->model('Ship');
        $this->ownerModel = $this->model('Owner');
    }

    public function index(){
        $invoices = array();
        // Check POST search form submited 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Set filter params entered by user
            $sqlConditions['where'] = array();
            if(!empty($_POST['driver_name_param'])){
                // Get driver id by name
                $drivers = $this->driverModel->getDriversByName($_POST['driver_name_param']);
                if(empty($drivers)){
                    // Display the alert box if entered name not exist  
                    flash('invoice_message', 'Driver not exist.');
                    redirect('invoices/index');
                }
               foreach($drivers as $driver){
                $sqlConditions['where'][] = array('driver'=>$driver->id);
    
               }
            }
            if(!empty($_POST['owner_name_param'])){
                // Get owners by name
                $owners = $this->ownerModel->getownersByName($_POST['owner_name_param']);
                if(empty($owners)){
                    // Display the alert box if entered owner not exist  
                    flash('invoice_message', 'Owner not exist.');
                    redirect('invoices/index');
                    
                }
               foreach($owners as $owner){
                $sqlConditions['where'][] = array('owner'=>$owner->id);
 
               }
            }
  
            if(!empty($_POST['cargo_name_param'])){
                // Get cargo id by name
                $cargoes = $this->cargoModel->getCargoesByName($_POST['cargo_name_param']);
                if(empty($cargoes)){
                    // Display the alert box if entered name not exist  
                    flash('invoice_message', 'Cargo not exist.');
                    redirect('invoices/index');
                }
               foreach($cargoes as $cargo){
                $sqlConditions['where'][] = array('cargo'=>$cargo->id);
    
               }
            }
            // to remove indexes from sqlConditions created sqlConditionsClean to send in searchResult function
            $sqlConditionsClean = array();
            $key_old ="";
            foreach($sqlConditions['where'] as $sqlCondition){
                foreach($sqlCondition as $key => $value){
                           
                    if($key_old == $key)
                        $sqlConditionsClean['where'][$key][] = $value;
                    else
                        $sqlConditionsClean['where'][$key][] = $value;
                        $key_old = $key;
                }
            }
            $invoices[] = $this->invoiceModel->searchResult($sqlConditionsClean);

        }
        // if invoices page call and we dont post params for search
        else{
            // if no filter set get all invoices
            $invoices[0] = $this->invoiceModel->getInvoices();
        }

        // Get all cargoes 
        $cargoes = $this->cargoModel->getCargoes();
        //Get all senders
        $senders = $this->senderModel->getSenders();
        // Get all destinations
        $destinations = $this->destinationModel->getDestinations();
        // Get all owners
        $owners = $this->ownerModel->getOwners();
        // Get all drivers
        $drivers = $this->driverModel->getDrivers();
        // Get all ships
        $ships = $this->shipModel->getShips();

        $data =[
            'invoices'=> $invoices,
            'cargoes'=> $cargoes,
            'senders'=> $senders,
            'destinations'=> $destinations,
            'owners'=> $owners,
            'drivers'=> $drivers,
            'ships'=> $ships,
        ];

        $this->view('invoices/index', $data);
    }
    

    public function add(){
        // Get all cargoes 
        $cargoes = $this->cargoModel->getCargoes();
        //Get all senders
        $senders = $this->senderModel->getSenders();
        // Get all destinations
        $destinations = $this->destinationModel->getDestinations();
        // Get all owners
        $owners = $this->ownerModel->getOwners();
        // Get all drivers
        $drivers = $this->driverModel->getDrivers();
        // Get all ships
        $ships = $this->shipModel->getShips();

        // Make array of cargoes for select box
        $cargo_items = array();
        foreach ($cargoes as $cargo) {
            $cargo_items[$cargo->id] = $cargo->name;
        }

        // Make array of senders for select box
        $sender_items = array();
        foreach ($senders as $sender) {
            $sender_items[$sender->id] = $sender->name;
        }

        // Make array of destinations for select box
        $destination_items = array();
        foreach ($destinations as $destination) {
            $destination_items[$destination->id] = $destination->name;
        }

        // Make array of owners for select box
        $owner_items = array();
        foreach ($owners as $owner) {
            $owner_items[$owner->id] = $owner->name;
        }

        // Make array of drivers for select box
        $driver_items = array();
        foreach ($drivers as $driver) {
            $driver_items[$driver->id] = $driver->name;
        }

        // Make array of ships for select box
        $ship_items = array();
        foreach ($ships as $ship) {
            $ship_items[$ship->id] = $ship->name;
        }

         //Check POST form submited
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form

          // Check user access
          if(!$_SESSION['invoice_access']){
            redirect('nafispanel');
           }

            $data = [
                'title' =>'Add invoice',
                'owner' => trim($_POST['owner']),
                'driver' => trim($_POST['driver']),
                'cargo' => trim($_POST['cargo']),
                'sender' => trim($_POST['sender']),
                'destination' => trim($_POST['destination']),
                'ship' => trim($_POST['ship']),
                'amount' => trim($_POST['amount']),
                'cargo_items'=> $cargo_items,
                'sender_items'=> $sender_items,
                'destination_items'=> $destination_items,
                'owner_items'=> $owner_items,
                'driver_items'=> $driver_items,
                'ship_items'=> $ship_items,
                'owner_err' =>'',
                'driver_err' =>'',
                'cargo_err' =>'',
                'sender_err' =>'',
                'destination_err' =>'',
                'ship_err' =>'',
                'amount_err' =>'',
               ];

            // Validate owner
            if(empty($data['owner'])){
                $data['owner_err'] = 'Please select owner';
            }

            // Validate driver
            if(empty($data['driver'])){
                $data['driver_err'] = 'Please select driver';
            }

            // Validate cargo
            if(empty($data['cargo'])){
                $data['cargo_err'] = 'Please select cargo';
            }

            // Validate sender
            if(empty($data['sender'])){
                $data['sender_err'] = 'Please select sender';
            }


            // Validate destination
            if(empty($data['destination'])){
                 $data['destination_err'] = 'Please select destination';
            }

            // Validate ship
            if(empty($data['ship'])){
                $data['ship_err'] = 'Please select ship';
            }

            // Validate amount
            if(empty($data['amount'])){
                $data['amount_err'] = 'Please select amount';
            }


            //Make sure errors are empty
            if(empty($data['owner_err']) && empty($data['driver_err']) && empty($data['cargo_err']) 
            && empty($data['sender_err']) && empty($data['destination_err']) 
            && empty($data['amount_err'])  && empty($data['ship_err'])){
                //Validated

                // Add invoice
                if($this->invoiceModel->add($data)){
                    flash('invoice_message', 'Invoice added.');
                    redirect('invoices/index');
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with error
                $this->view('invoices/add', $data);
            }
        }
        else{
            //Init data
           $data = [
            'title' =>'Add invoice',
            'owner' =>'',
            'driver' =>'',
            'cargo' =>'',
            'sender' =>'',
            'destination' =>'',
            'ship' =>'',
            'amount' =>'',
            'cargo_items'=> $cargo_items,
            'sender_items'=> $sender_items,
            'destination_items'=> $destination_items,
            'owner_items'=> $owner_items,
            'driver_items'=> $driver_items,
            'ship_items'=> $ship_items,
           ];

           //Load view
           $this->view('invoices/add', $data);
        }
    }

    public function edit($id){

        // Get all cargoes 
        $cargoes = $this->cargoModel->getCargoes();
        //Get all senders
        $senders = $this->senderModel->getSenders();
        // Get all destinations
        $destinations = $this->destinationModel->getDestinations();
        // Get all owners
        $owners = $this->ownerModel->getOwners();
        // Get all drivers
        $drivers = $this->driverModel->getDrivers();
        // Get all ships
        $ships = $this->shipModel->getShips();

        // Make array of cargoes for select box
        $cargo_items = array();
        foreach ($cargoes as $cargo) {
            $cargo_items[$cargo->id] = $cargo->name;
        }

        // Make array of senders for select box
        $sender_items = array();
        foreach ($senders as $sender) {
            $sender_items[$sender->id] = $sender->name;
        }

        // Make array of destinations for select box
        $destination_items = array();
        foreach ($destinations as $destination) {
            $destination_items[$destination->id] = $destination->name;
        }

        // Make array of owners for select box
        $owner_items = array();
        foreach ($owners as $owner) {
            $owner_items[$owner->id] = $owner->name;
        }

        // Make array of drivers for select box
        $driver_items = array();
        foreach ($drivers as $driver) {
            $driver_items[$driver->id] = $driver->name;
        }

        // Make array of ships for select box
        $ship_items = array();
        foreach ($ships as $ship) {
            $ship_items[$ship->id] = $ship->name;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $data = [
            'id' => $id,
            'owner' => trim($_POST['owner']),
            'driver' => trim($_POST['driver']),
            'cargo' => trim($_POST['cargo']),
            'sender' => trim($_POST['sender']),
            'destination' => trim($_POST['destination']),
            'ship' => trim($_POST['ship']),
            'amount' => trim($_POST['amount']),
            'cargo_items'=> $cargo_items,
            'sender_items'=> $sender_items,
            'destination_items'=> $destination_items,
            'owner_items'=> $owner_items,
            'driver_items'=> $driver_items,
            'ship_items'=> $ship_items,
            'owner_err' =>'',
            'driver_err' =>'',
            'cargo_err' =>'',
            'sender_err' =>'',
            'destination_err' =>'',
            'ship_err' =>'',
            'amount_err' =>'',
           ];

            // Validate owner
            if(empty($data['owner'])){
                $data['owner_err'] = 'Please select owner';
            }

            // Validate driver
            if(empty($data['driver'])){
                $data['driver_err'] = 'Please select driver';
            }

            // Validate cargo
            if(empty($data['cargo'])){
                $data['cargo_err'] = 'Please select cargo';
            }

            // Validate sender
            if(empty($data['sender'])){
                $data['sender_err'] = 'Please select sender';
            }


            // Validate destination
            if(empty($data['destination'])){
                 $data['destination_err'] = 'Please select destination';
            }

            // Validate ship
            if(empty($data['ship'])){
                $data['ship_err'] = 'Please select ship';
            }

            // Validate amount
            if(empty($data['amount'])){
                $data['amount_err'] = 'Please select amount';
            }

            //Make sure errors are empty
            if(empty($data['owner_err']) && empty($data['driver_err']) && empty($data['cargo_err']) 
            && empty($data['sender_err']) && empty($data['destination_err']) 
            && empty($data['amount_err'])  && empty($data['ship_err'])){
                //Validated

                if($this->invoiceModel->updateInvoice($data)){
                    flash('invoice_message', 'Invoice updated');
                    redirect('invoices');
                } 
                else {
                die('Something went wrong');
                }
            } 
            else {
                // Load view with errors
                $this->view('invoices/edit', $data);
            }
  
        } 
        else {
            // Get existing invoice from model
            $invoice = $this->invoiceModel->getInvoiceById($id);

             // Check user access
             if(!$_SESSION['invoice_access']){
                 redirect('nafispanel');
             }
  
            //Init data
            $data = [
                'title' => 'Edit invoice',
                'id' => $id,
                'owner' => $invoice->owner,
                'driver' => $invoice->driver,
                'cargo' => $invoice->cargo,
                'sender' => $invoice->sender,
                'destination' => $invoice->destination,
                'ship' => $invoice->ship, 
                'amount' => $invoice->amount, 
                'cargo_items'=> $cargo_items,
                'sender_items'=> $sender_items,
                'destination_items'=> $destination_items,
                'owner_items'=> $owner_items,
                'driver_items'=> $driver_items,
                'ship_items'=> $ship_items,
               ];
    
            $this->view('invoices/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing invoice from model
          $user = $this->invoiceModel->getInvoiceById($id);
          
            // Check user access
            if(!$_SESSION['invoice_access']){
                redirect('nafispanel');
            }
  
          if($this->invoiceModel->deleteInvoice($id)){
            flash('invoice_message', 'Invoice removed');
            redirect('invoices');
          } 
          else {
            die('Something went wrong');
          }
        } 
        else {
          redirect('invoices');
        }
    }
    // export invoices data that are displayed on the screen to excel and download
    public function exportexcel(){

        $styleArray = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'font'  => array(
                'bold'  => false,
                'color' => array('rgb' => '000000'),
                'size'  => 12,
                'name'  => 'Tahoma'
            )
        ];




        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()
            ->applyFromArray($styleArray);

        // right-to-left worksheet
        $spreadsheet->getActiveSheet()
            ->setRightToLeft(false);

        $column=1;
        $table_columns = array("#", "Owner", "Driver", "Sender",'Destination', "Ship","Exit date","Cargo","Amount","Price","Total Price");
        $spreadsheet->getActiveSheet()->mergeCells('A1:H2');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Company name");

        foreach($table_columns as $field)
        {
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 6, $field);
            $column++;
        }

        $invoices = array();
        // Check POST search form submited 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Set filter params entered by user
            $sqlConditions['where'] = array();
            if(!empty($_POST['driver_name_param'])){
                // Get driver id by name
                $drivers = $this->driverModel->getDriversByName($_POST['driver_name_param']);
                if(empty($drivers)){
                    // Display the alert box if entered name not exist  
                    flash('invoice_message', 'Driver not exist.');
                    redirect('invoices/index');
                }
               foreach($drivers as $driver){
                $sqlConditions['where'][] = array('driver'=>$driver->id);
    
               }
            }
            if(!empty($_POST['owner_name_param'])){
                // Get owners by name
                $owners = $this->ownerModel->getownersByName($_POST['owner_name_param']);
                if(empty($owners)){
                    // Display the alert box if entered owner not exist  
                    flash('invoice_message', 'Owner not exist.');
                    redirect('invoices/index');
                    
                }
               foreach($owners as $owner){
                $sqlConditions['where'][] = array('owner'=>$owner->id);
 
               }
            }
  
            if(!empty($_POST['cargo_name_param'])){
                // Get cargo id by name
                $cargoes = $this->cargoModel->getCargoesByName($_POST['cargo_name_param']);
                if(empty($cargoes)){
                    // Display the alert box if entered name not exist  
                    flash('invoice_message', 'Cargo not exist.');
                    redirect('invoices/index');
                }
               foreach($cargoes as $cargo){
                $sqlConditions['where'][] = array('cargo'=>$cargo->id);
    
               }
            }
            // to remove indexes from sqlConditions created sqlConditionsClean to send in searchResult function
            $sqlConditionsClean = array();
            $key_old ="";
            foreach($sqlConditions['where'] as $sqlCondition){
                foreach($sqlCondition as $key => $value){
                           
                    if($key_old == $key)
                        $sqlConditionsClean['where'][$key][] = $value;
                    else
                        $sqlConditionsClean['where'][$key][] = $value;
                        $key_old = $key;
                }
            }
            $invoices[] = $this->invoiceModel->searchResult($sqlConditionsClean);

        }
        // if invoices page call and we dont post params for search
        else{
            // if no filter set get all invoices
            $invoices[0] = $this->invoiceModel->getInvoices();
        }

         $item_list =$invoices;

        $excel_row = 7;


        $i = 1;
        $array = [];
        foreach($item_list as $item){
            array_push($array,$item);
        }

        $createdate = date("Y-m-d h:i");

        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 4, "Date");
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, 4, $createdate);

        foreach($item_list as $items)
        {
            foreach($items as $item)
            {
                $owner = $this->ownerModel->getOwnerById($item->owner);
                $driver = $this->driverModel->getDriverById($item->driver);
                $sender = $this->senderModel->getSenderById($item->sender);
                $destination = $this->destinationModel->getDestinationById($item->destination);
                $ship = $this->shipModel->getShipById($item->ship);
                $exit_date = $item->date_exit;
                $cargo = $this->cargoModel->getCargoById($item->cargo);
                $amount = $item->amount;
                $price = $cargo->price;
                $total_price = $price * $amount;

                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, strval($i));
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $owner->name);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $driver->name);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $sender->name);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $destination->name);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $ship->name);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $exit_date);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $cargo->name);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $amount);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $price);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $total_price);


                $excel_row++;
                $i++;
            }
        }

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getStyle("A6:F".strval($excel_row+1))->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                )
            )
        ));

        $sheet->getStyle("A1:G2")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                )
            )
        ));


        foreach(range('A','G') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // (D) SEND DOWNLOAD HEADERS
        // ob_clean();
        // ob_start();
        $writer = new Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"2-download.xlsx\"");
        header("Cache-Control: max-age=0");
        header("Expires: Fri, 11 Nov 2011 11:11:11 GMT");
        header("Last-Modified: ". gmdate("D, d M Y H:i:s") ." GMT");
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");
        $writer->save("php://output");
            // ob_end_flush();
    }
    // export specific invoice as pdf file
    public function exportpdf($id)
	{

        $invoice = $this->invoiceModel->getInvoiceById($id);

        $owner = $this->ownerModel->getOwnerById($invoice->owner);
        $driver = $this->driverModel->getDriverById($invoice->driver);
        $sender = $this->senderModel->getSenderById($invoice->sender);
        $destination = $this->destinationModel->getDestinationById($invoice->destination);
        $ship = $this->shipModel->getShipById($invoice->ship);
        $exit_date = $invoice->date_exit;
        $cargo = $this->cargoModel->getCargoById($invoice->cargo);
        $amount = $invoice->amount;
        $price = $cargo->price;
        $total_price = $price * $amount;

        $createdate = date("Y-m-d h:i");

        ini_set("memory_limit","128M");

        $company = "Company name";
        $sub = "subtitle";
        $owner = $owner->name;
        $date = $createdate;
        $html = '
        <style>
       
        body {
            font-family: "tahoma";
            font-size: 20pt;
            direction:ltr;
            float:left;
        }
        h4 {
            font-variant: small-caps;
        }
        h5 {
            margin-bottom: 0;
            color: #110044;
        }
        dl {
            margin: 0;
        }
        td, th, .col {  
          border: 1px solid #ddd;
          float:right;
        }
        
        .borderno{
            border:0px;
        }
        .without-border tr td{
            border:0px;
        }
        table {
          border-collapse: collapse;
          width: 100%;
          margin-top:20px;
        }
        
        th, td, .col {
          padding: 15px;
        }
        img{
            width:150px;
            float:right;
        }
        .sum{
            float:left!important;
            display:inline;
        }
        .company{
            font-family: "tahoma";
            font-size: 52px;
            white-space:pre-line;
            font-weight: 800;
            line-height: 0.4;
            text-align: center;
        }
        
        .column1 {
        float: right;
        width: 15%;
        }
        .column2 {
        float: right;
        width: 60%;
        }
        .column3 {
        float: right;
        width: 25%;
        }
        .column-full{
        width: 100%;
        }
        .column-half{
        float: right;
        width: 46.8%;
        }
        .column-three{
        float: right;
        width: 30.1%;
        }
        /* The floats after the columns are cleared */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
        </style>
        <div class="row">
                <div class="column1"><span><img src= "'.URLROOT.'/public/img/logo_invoice.png"/></span></div>
                <div class="column2"> <p class="company">'.$company.'</p><p class="company">'.$sub.'</p> </div>
                <div class="column3">       
                    <p>Date: '.$date.'</p>
                    <p> Nomber: </p>
                 </div>

        </div> 
        
        <div id="content" class="divContent">
       
    
        
      
        </br>
        <div>
      
        <table class="without-border">
        <tbody>
            <tr>
                
                <td> Owner: '.$owner.' </td>
                 <td> Cargo: '.$cargo->name.'</td>
            </tr>

            <tr>
            <td> </td>

        </tr>
        </tbody></table></div>
        
        </div>
        </br>
        <div>
        
        <div class="row">
            <div class="column-full col"><span>Destination: '.$destination->name.'</span></div>
        </div>
        
        <div class="row">
            <div class="column-three col"><span> Ship: '.$ship->name.'</span></div>
            <div class="column-three col"><span> Sender: '.$sender->name.'</span></div>
            <div class="column-three col"><span> Driver: '.$driver->name.'</span></div>

        </div>
        
        <div class="row">
            <div class="column-three col"><span> Car tag: '.($driver->cartag).'</span></div>
            <div class="column-three col"><span>  Amount: '.$amount.'</span></div>
            <div class="column-three col"><span> Price: '.$price.'</span></div>

        </div>
        
        <div class="row">
            <div class="column-half col"><span> Exit date: '.$exit_date.'</span></div>
            <div class="column-half col"><span> Total price: '.$total_price.'</span></div>
        </div>';
        

        
        //==============================================================
        //==============================================================
        
        
        
        $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-L'
        ]);
        
        $mpdf->WriteHTML($html);
        
        $mpdf->Output();
        exit;
        
        //==============================================================
        //==============================================================
        

      
       
	}

}