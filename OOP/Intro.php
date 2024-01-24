<?php
// Classes
// class PaymentGateway{
//     // Properties
//     public $sender = "PJJx098765";

//     // Construcor
//     public function __construct($sender){

//     }

//     // Method
//     function confirm_receipt($msg){
//         echo $msg;
//     }

//     // Destructor
//     public function __destructor(){

//     }
// }

// var_dump(PaymentGateway);

// class DatabseConnection{
//     // Properties
//     public $hostname = "localhost";
//     public $username = "root";
//     public $password = "";
//     public $db_name = "eshop";

//     // Method
//     public function print_database_info(){
//         echo "Database Host: " .$this->hostname. "<br>";
//         echo "Username: " .$this->username. "<br>";
//         echo "Password: " .$this->password. "<br>";
//         echo "DB Name: " .$this->db_name."<hr>";
//     }

// }

// // Objects
// $database_connection = new DatabseConnection();
// //echo "<p>Hostname: ". $database_connection->hostname ."</p>";  //Object access operator
// $database_connection->print_database_info();
// // var_dump($database_connection);

// class Person{
//     public $id;
//     public $username;
//     public $email;
//     public $password;

//     public function __construct($id, $username, $email, $password){
//         $this->id = $id. "<br>";
//         $this->username = $username. "<br>";
//         $this->email = $email. "<br>";
//         $this->password = $password."<br>";
//     }

//     public function print_user_info(){
//         echo "{$this->id} {$this->username} {$this->email} {$this->password}";
//     }
// }

// $person = new Person(1, "admin", "admin@gmail.com", "blablabla");
// $person->print_user_info();

// Inheritance
class Account{
    public $account_number;
    public $account_name;

    public function __construct($account_number, $account_name) {
        $this->account_number = $account_number;
        $this->account_name = $account_name;
    }

    public function print_account_info() {
        echo "Account Number: {$this->account_number} <br> Account Name: {$this->account_name}";
    }
}

class SavingsAccount extends Account{

}

class FixedAccount extends Account{
    public $interest;

    public function __construct($account_number, $account_name, $interest) {
        parent::__construct($account_number, $account_name);
        $this->interest = $interest;
    }

    public function print_account_info() {
        echo "Fixed Account Information <br>",parent::print_account_info(),"<br>"
        ,"Interest Rate: {$this->interest}%";
    }
}

$fixed_account = new FixedAccount(1234567890987, "John Doe", 1.5);
$fixed_account->print_account_info();

?>