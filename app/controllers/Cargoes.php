<?php
class Cargoes extends Controller{

    public function __construct()
    {
        $this->cargoModel = $this->model('Cargo');
    }

    public function index(){
        // Get all cargoes
        $cargoes = $this->cargoModel->getCargoes();
        $data =[
            'cargoes'=> $cargoes
        ];

        $this->view('cargoes/index', $data);
    }

    public function add(){
        //Check POST form submited
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           //Process form

         // Check user access
         if(!$_SESSION['cargo_access']){
           redirect('nafispanel');
          }

           $data = [
               'title' =>'Add cargo',
               'name' => trim($_POST['name']),
               'unit' => trim($_POST['unit']),
               'price' => trim($_POST['price']),
               'unit_err' =>'',
               'name_err' =>'',
               'price_err' =>'',
              ];

           // Validate name
           if(empty($data['name'])){
               $data['name_err'] = 'Please enter name';
           }

           // Validate unit
           if(empty($data['unit'])){
                $data['unit_err'] = 'Please enter unit';
           }

           // Validate price
           if(empty($data['price'])){
                $data['price_err'] = 'Please enter price';
           }

           //Make sure errors are empty
           if(empty($data['name_err']) && empty($data['unit_err']) && empty($data['price_err'])){
               //Validated

               // Add cargo
               if($this->cargoModel->add($data)){
                   flash('cargo_message', 'Cargo added.');
                   redirect('cargoes/index');
               }
               else{
                   die('Something went wrong');
               }
           }
           else{
               //Load view with error
               $this->view('cargoes/add', $data);
           }
       }
       else{
           //Init data
          $data = [
           'title' =>'Add cargo',
           'name' =>'',
           'unit' =>'',
           'price' =>'',
          ];

          //Load view
          $this->view('cargoes/add', $data);
       }
   }

   public function edit($id){
       if($_SERVER['REQUEST_METHOD'] == 'POST'){

         $data = [
           'id' => $id,
           'title' => 'Edit cargo',
           'name' => trim($_POST['name']),
           'unit' => trim($_POST['unit']),
           'price' => trim($_POST['price']),
           'name_err' =>'',
           'unit_err' =>'',
          ];

           // Validate name
           if(empty($data['name'])){
               $data['name_err'] = 'Please enter name';
           }

           // Validate unit
           if(empty($data['unit'])){
               $data['unit_err'] = 'Please enter unit';
           }

            // Validate price
           if(empty($data['price'])){
               $data['price_err'] = 'Please enter price';
           }


           // Make sure errors are empty
           if(empty($data['name_err']) && empty($data['unit_err']) && empty($data['price_err'])){

               // Validated

               if($this->cargoModel->updateCargo($data)){
                   flash('cargo_message', 'Cargo updated');
                   redirect('cargoes');
               } 
               else {
               die('Something went wrong');
               }
           } 
           else {
               // Load view with errors
               $this->view('cargoes/edit', $data);
           }
 
    } 
    else {
        // Get existing cargo from model
        $cargo = $this->cargoModel->getCargoById($id);
           
        // Check user access
        if(!$_SESSION['cargo_access']){
            redirect('nafispanel');
        }
    
        //Init data
        $data = [
            'title' => 'Edit cargo',
            'id' => $id,
            'name' => $cargo->name,
            'unit' => $cargo->unit,
            'price' => $cargo->price,
        ];

        $this->view('cargoes/edit', $data);

    }
}

   public function delete($id){
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
         // Get existing cargo from model
         $user = $this->cargoModel->getCargoById($id);
         
           // Check user access
           if(!$_SESSION['cargo_access']){
               redirect('nafispanel');
           }
 
         if($this->cargoModel->deleteCargo($id)){
           flash('cargo_message', 'Cargo removed');
           redirect('cargoes');
         } 
         else {
           die('Something went wrong');
         }
       } 
       else {
         redirect('cargoes');
       }
   }
}
