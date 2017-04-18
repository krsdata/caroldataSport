<?php
class Common_model extends CI_Model{

	function get_row($table,$where,$select)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	
	function get_row_not_in($table,$where,$select,$notinkey,$notinval,$orwhere)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		if($orwhere == 1)
		{
		$this->db->or_where('type',1);
		}
		$this->db->where_not_in($notinkey,$notinval);
		//print $this->db->return_query();
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function get_row_where_cat($table,$categoryName,$select)
	{
		$query  = $this->db->query('SELECT '.$select.' FROM '.$table.' where categoryName = "'.$categoryName.'" and (type=1 or type=0)');
		/*$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where('type',0);
		$this->db->or_where('type',1);*/
		//$query = $this->db->get();
		
		$test = $query->result();
		return $test;
	}
	
	function get_row_where_subcat($table,$subCategoryName,$categoryId,$select)
	{
		$query  = $this->db->query('SELECT '.$select.' FROM '.$table.' where subcategoryName = "'.$subCategoryName.'" and categoryId = "'.$categoryId.'" and (type=1 or type=0)');
		/*$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where('type',0);
		$this->db->or_where('type',1);*/
		//$query = $this->db->get();
		
		$test = $query->result();
		return $test;
	}
	
	function get_rows($table,$where,$select)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_sum($table,$where,$select)
	{
		$this->db->sum($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	
	function get_join($table1,$table2,$key1,$key2,$where,$select)
	{
       $this->db->select($select);
	   $this->db->from($table1);
	   $this->db->join($table2,$key1.'='.$key2);
	   $this->db->where($where);
	   $query = $this->db->get();
	   return $query->result();
	   
	}
	
	function insert_row($table,$data) 
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	function update_row($table,$where,$data)
	{
		$this->db->set($data);
	    $this->db->where($where);
	    $this->db->update($table);
		
		return $this->db->affected_rows();
	}
	
	function delete_row($table,$where)
	{
	    $this->db->where($where);
	    $this->db->delete($table);
		
		return $this->db->affected_rows();
	}
	
	function get_multi_join($tables,$keys,$where,$select)
	{
       $this->db->select($select);
	   $this->db->from($tables[0]);
	   $t = count($tables);
	   $k = count($keys);
	   for($i=1,$j=0;$i<$t && $j<$k;$i++,$k++)
	   {
		   $this->db->join($tables[$i],$keys[$k].'='.$keys[$k++]);
	   }
	  // $this->db->join($table2,$key1.'='.$key2);
	   $this->db->where($where);
	   $query = $this->db->get();
	   return $query->result();
	}
	
	function isExists($table,$where)
	{
	   $this->db->select('*');
	   $this->db->from($table);
	   $this->db->where($where);
	   $query = $this->db->get();
	   if(count($query->row())>0)
	   {
		   return true;
	   }	
	   else
	   {
	 	   return false;
	   }
	}
	
	function get_avrage($table,$where,$field)
	{
		$this->db->select_avg($field);
		$this->db->from($table);
		$this->db->where($where);
		$resp = $this->db->get();
		return $resp->row();
	}
	
	function get_count($table,$where)
	{
	    $this->db->count_all_results($table);
		$this->db->from($table);
		$this->db->where($where);
		
		return  $this->db->count_all_results();	
	}
	
    function get_field($table,$where,$select)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row()->$select;
	}
	
	/* ------------------------------------------------------------------------------------------- */
    /* <!--GET ALL RECORD FROM SINGLE TABLE USING WHERE CONDITION--> */
    /* ---GET SINGLE RECORD--- */
	
    function getsingle($table, $where = '', $fld = NULL, $order_by = '', $order = '') {

        if ($fld != NULL) {
            $this->db->select($fld);
        }
		
        $this->db->limit(1);
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($where != '') {
            $this->db->where($where);
        }

        $q = $this->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        } else {
            return 'no record found';
        }
    }
	
	/* <!--UPDATE RECORD FROM SINGLE TABLE--> */
    function updateFields($table, $data, $where) {
        $this->db->update($table, $data, $where);
        return TRUE;
    }
	
	
	function get_entry_by_data($table_name, $single = false, $data = array(), $select = "", $order_by = '', $orderby_field = '', $limit = '', $offset = 0, $group_by = '') {

        if (!empty($select)) {
            $this->db->select($select);
        }

        if (empty($data)) {
            $id = $this->input->post('id');
            if (!$id)
                return false;
            $data = array('id' => $id);
        }

        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }

        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }

        if (!empty($order_by) && !empty($orderby_field)) {
            $this->db->order_by($orderby_field, $order_by);
        }

        $query = $this->db->get_where($table_name, $data);
        $res = $query->result_array();
        //echo $this->db->last_query();exit;
		
        if (!empty($res)) {
            if ($single)
                return $res[0];
            else
                return $res;
        } else
            return false;
    }
	
} 
?>
