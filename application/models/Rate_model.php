<?

class Rate_model extends CI_Model {

    // @todo make cur_id link later

    var $id = 0;
    var $cur_nam = '';
    var $dat;
    var $price = 0;

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
	* получить список курсов указанной валюты
	*/
	function get_currency_list_by_nam($currency_nam){
		$res = array();

		$this->db->order_by('dat', 'asc');
		$this->db->where('cur_nam',trim($currency_nam));
		$query = $this->db->get('curs');

		foreach ($query->result_array() as $row_array) {
			$res[] = $row_array;
		}	

		return $res;
	}

	/** 
	* получить курс на указанную дату по указанной валюте
	*/
	function get_rate_by_curr_dat($currency_nam, $dat){
		$res = 0;

        $dat = date('Y-m-d', strtotime($dat));

        $this->db->where(array('cur_nam' => trim($currency_nam), 'dat <=' => $dat));
		$this->db->order_by('dat','desc');
		$query = $this->db->get('curs',1);
		foreach ($query->result() as $row) {
			$res = $row->price;
        }

		return $res;
	}

	/**
	* установить указанный курс по ИД указанной валюты на указанную дату
	*/
	function add_rate($currency_id, $dat, $new_price){

        //get cur_id
        $this->load->model('Currency_model');
        $currency_nam = $this->Currency_model->get_nam_by_id($currency_id);

        $ar = array(
				'cur_nam'=>$currency_nam,
				'dat'=>$dat,
				'price'=>$new_price, 
			);

        $dat = date('Y-m-d', strtotime($dat));

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

        $dat = date('Y-m-d', strtotime($dat));

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

        $dat = date('Y-m-d', strtotime($dat));

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

        $dat = date('Y-m-d', strtotime($dat));

		$this->db->where('cur_nam',$currency_nam);
		$this->db->where('dat', $dat);
		$query = $this->db->get('curs');
		foreach ($query->result() as $row) {
			$res = $row->id;
		}

		return $res;
	}

    /**
     * получить строку по id ввиде массива
     * @param $id
     * @return array
     */
    function get_row_by_id($id){
        $res = array();

        $this->db->where('id', $id);
        $query = $this->db->get('curs',1);
        foreach($query->result_array() as $row){
            $res = $row;
            break;
        }

        return $res;
    }

    /**
     * delete row by id
     * @param $id
     */
    function delete_by_id($id){
        $this->db->delete('curs', array('id' => $id));
    }

}

?>