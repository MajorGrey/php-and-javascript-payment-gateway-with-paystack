<?php  

class Db{
	private $host = '127.0.0.1';
	private $db_name = 'pay';
	private $username = 'root';
	private $password = '';
	private $socket_type = 'mysql';

	public function con(){
		$db = new PDO(''.$this->socket_type.':host='.$this->host.';dbname='.$this->db_name.';charset=utf8mb4', $this->username, $this->password);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		return $db;
	}
}

class AddTransaction extends Db {
	private $name;
	private $email;
	private $mobile;
	private $amount;
	private $ref;

	public function __construct ($name, $email, $mobile, $amount, $ref){
		$this->name = $name;
		$this->email = $email;
		$this->mobile = $mobile;
		$this->amount = $amount;
		$this->ref = $ref;
	}

	public function addPay(){
		$sql = "INSERT INTO transactions(name, email, mobile, amount, ref) VALUES (?, ?, ?, ?, ?)";
		$query = $this->con()->prepare($sql);
		$tt = $query->execute([$this->name, $this->email, $this->mobile, $this->amount, $this->ref]);
		if ($tt) {
			return "Inserted sucessfully";
		}else {
			return "error inserting";
		}
	}
}
?>