<?

class Curs_model extends CI_Model {

	//constructor\
	function __construct(){
		parent::__construct();
	}

	/**
	* get all rows ordered by nam, dat
	*/
	function get_list(){
		$res = array();	

		$this->db->order_by('cur_nam', 'asc');
		$this->db->order_by('dat', 'asc');	
		$query = $this->db->get('curs');
		foreach ($query->result_array() as $row_array) {
			$res[] = $row_array();
		}
		return $res;
	}

	/**
	* получить список кусов указанной валюты
	*/
	function get_currency_list($currency_nam){
		$res = array();

		$this->db->order_by('dat', 'asc');
		$this->db->where(array('cur_nam' => trim($currency_nam)));
		$query = $this->db->get('curs');
		foreach ($query->result_array() as $row_array) {
			$res[] = $row_array;
		}	

		return $res;
	}

	/** 
	* получить курс на указанную дату по указанной валюте
	*/
	function get_curs_by_curr_dat($currency_nam, $dat){
		$res = 0;

		$this->db->where(array('cur_nam' => trim($currency_nam), 'dat <=' => $dat));
		$this->db->order_by('dat','desc');
		$query = $this->db->get('curs',1);
		foreach ($query->result() as $row) {
			$res = $row->price;
		}
		return $res;
	}

	/**
	* установить указанный курс по указанной валюте на указанную дату
	*/
	function add_curs($currency_nam, $dat, $new_price){

		$ar = array(
				'cur_nam'=>$currency_nam,
				'dat'=>$dat,
				'price'=>$new_price, 
			);
			
		if($this->test_currency_dat_exist($currency_nam, $dat)){
			//get id
			$id = $this->get_id_by_currency_dat($currency_nam, $dat);
			//update
			$this->db->where('id',$id);
			$this->db->update('curs', $ar);
		}	
		else{
			//insert	
			$this->db->insert('curs', $ar);	
		}
	} 

	/** 
	* удалить запись о курсе по указанной валюте на указанную дату
	* усли есть и было удалено - вернет истину
	*/
	function delete_by_currency_dat($currency_nam, $dat){
		//test existing
		$id = $this->db->get_id_by_currency_dat($currency_nam, $dat);

		//delete
		if($id != 0){
			$this->db->where('cur_nam', $currency_nam);
			$this->db->where('dat', $dat);
			$this->db->delete('curs');

			return true;	
		}
		else{
			return false;
		}

	}

	/** 
	* проверить сущствует ли запись по указанной валюте на указанную дату
	*
	*/ 
	function test_currency_dat_exist($currency_nam, $dat)
	{
		$res = false;

		$this->db->where('cur_nam',$currency_nam);
		$this->db->where('dat', $dat);
		$cnt = $this->db->count_all_results('curs');
		if($cnt != 0) $res = true;

		return $res;
	}

	/**
	* получить ИД для записи с указ валютой и датой
	* вернет 0 если такой записи нет
	*/
	function get_id_by_currency_dat($currency_nam, $dat){
		$res = 0;

		$this->db->where('cur_nam',$currency_nam);
		$this->db->where('dat', $dat);
		$query = $this->db->get('curs');
		foreach ($query->result() as $row) {
			$res = $row->id;
		}

		return $res;
	}

}

?>