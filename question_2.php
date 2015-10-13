<?php
namespace SoftwareEngineerTest;

// Question 2 & 3 & 4

/**
 * Class Customer
 */
abstract class Customer {
    protected $id;
    protected $balance = 0;

    public function __construct($id) {
        $this->id = $id;
    }

    public function get_balance() {
        return $this->balance;
    }
}


// question 2
/**
 * Class of Bronze Customer
 */
class Bronze_Customer extends Customer{
    protected $type = 'Bronze';
    /*
     * get customer balance
     * */
    protected function getCustomerBalance(){
        $balance = parent::get_balance();
        return $balance;
    }

    /*
     * make deposit
     * */
    public function deposit($value){
        if($this->type == 'Bronze'){
            $finalBalance = (float)$this->getCustomerBalance() + (float)$value;
        }
        return $finalBalance;
    }
    /*
     * question 4 generate username of Bronze type of customer
     * 20 digits random generated
     * */
    protected function generate_username(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return 'B'.$randomString;
    }
}

/**
 * Class of Silver Customer
 */
class Silver_Customer extends Customer{
    protected $type = 'Silver';
    /*
     * get customer balance
     * */
    protected function getCustomerBalance(){
        $balance = parent::get_balance();
        return $balance;
    }
    /*
     * make deposit
     * */
    public function deposit($value){
       if($this->type == 'Silver'){
          $finalBalance = (float)$this->getCustomerBalance() + (float)$value * 0.05;
        }
        return $finalBalance;
    }

    /*
     * question 4 generate username of Silver type of customer
     * 20 digits random generated
     * */
    protected function generate_username(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return 'S'.$randomString;
    }
}

/**
 * Class of Gold Customer
 */
class Gold_Customer extends Customer{
    protected $type = 'Gold';
    /*
     * get customer balance
     * */
    protected function getCustomerBalance(){
        $balance = parent::get_balance();
        return $balance;
    }

    /*
     * make deposit
     * */
    public function deposit($value){
        if($this->type == 'Gold'){
            $finalBalance = (float)$this->getCustomerBalance() + (float)$value * 0.1;
        }
        return $finalBalance;
    }
    /*
     * question 4 generate username of Gold type of customer
     * 20 digits random generated
     * */
    protected function generate_username(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return 'G'.$randomString;
    }
}

// question 3
/*
 * factory method of Customer
 * based on give ID, then use factory method to initiate correct
 * object
 * */
class CustomerFactory
{
    public static function get_instance($id)
    {
        $firstIdString = substr($id, 0, 1);
        switch($firstIdString){
            case 'B': return new Bronze_Customer($id);
                    break;
            case 'S': return new Silver_Customer($id);
                break;
            case 'G': return new Gold_Customer($id);
                break;
            default:
                throw new Exception('InvalidArgument .');
                break;
        }
    }
}

CustomerFactory::get_instance('G123456');
