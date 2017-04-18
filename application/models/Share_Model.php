<?php
class Share_Model extends CI_Model{

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
		$this->db->select_sum($select);
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
	
	function get_rows_limit_order_by($table,$where,$select,$order_by,$order,$limit)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order_by,$order);
		$this->db->limit($limit);
		$query = $this->db->get();	
		return $query->result();
	}
		function get_rows_limit_order_by_group_by($table,$where,$select,$group_by,$order_by,$order,$limit)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		if($group_by != "")
		$this->db->group_by($group_by);
		if($order_by != "")
		$this->db->order_by($order_by,$order);
		if($limit != "")
		$this->db->limit($limit);
		$query = $this->db->get();	
		return $query->result();
	}
	
	function getStartRate($option_id)
	{
		$query = 
		"SELECT * FROM `ai_shares_log` where option_id = '".$option_id."' and deal_type = 'buy' and type = 'yes' order by id asc limit 0,1";
		$res = $this->db->query($query);
		$row = $res->row();	
		if( isset($row) )
		{
			$this->update_row('ai_options',array('id'=>$option_id), array('start'=>$row->buy_rate));
			return $row;
		}			
	}
	
	function getSumOfBuyOffers($option_id,$user_id)
	{
		$query = 
		"SELECT sum(unmatched_shares) as shares, deal_type, type FROM `ai_offered_shares` where offered_by = '".$user_id."' and option_id = '".$option_id."' and status =1 and deal_type='sell'";
		$res = $this->db->query($query);
		$row = $res->row();	
		if(!($row->shares == null))
		{
			return $row;
		}			
		return false;
	}
	
	function getSumOfSellOffers($option_id,$user_id)
	{
		$query = 
		"SELECT sum(unmatched_shares) as shares, deal_type, type FROM `ai_offered_shares` where offered_by = '".$user_id."' and option_id = '".$option_id."' and status =1 and deal_type='buy' and share_id != 0 ";
		$res = $this->db->query($query);
		$row = $res->row();
		if(!($row->shares == null))
		{
			return $row;
		}			
		return false;	
	}
	
	
	function getCurrentRisk($option_id, $user_id)
	{
		$query = 
		"SELECT sum(rate*shares) as risk FROM `ai_confirmed_shares` where option_id  = '".$option_id."' and owner_id = '".$user_id."' and status = 1 ";
		$res = $this->db->query($query);
		$row = $res->row();
		return $row;
					
		
	}
	
	function getLatestRateOfOption($option_id)
	{
		$query = 
		"SELECT * FROM `ai_shares_log` where option_id = '".$option_id."' and deal_type = 'buy' and type = 'yes' order by id desc limit 0,1";
		$res = $this->db->query($query);
		$row = $res->row();
	
		if( isset($row) )
		{ 
			$start_rate = $this->getStartRate($option_id);
			$deviation = ($start_rate->buy_rate - $row->buy_rate);
			$this->update_row('ai_options',array('id'=>$option_id), array('deviation'=>$deviation));
			$this->update_row('ai_options',array('id'=>$option_id), array('start'=>$row->buy_rate));
			return $row;
		}				
	}
} 
?>
