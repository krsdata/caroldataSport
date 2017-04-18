<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Sports {
	
	private $CI;

	function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->model('Share_Model');
	   $this->CI->load->library('session');
	}


	public function showBucks($cents)
	{
		$amt = $cents/100;
		return '$'.round($amt, 2);
	}
 
	public function get_options_details($id)
	{
		$result = array();
		$opkey = "";
		$select = "";
		$select_img = "";
		$folder = "";
		$featured_op = $this->CI->Share_Model->get_join('ai_options','ai_option_type','option_type_id','ai_option_type.id',array('question_id'=>$id,'ai_options.status'=>1),'ai_options.id as optionId,ai_options.option_id as optionTypeId ,ai_options.image as optionImage,ai_option_type.option_type as optionTypeName,ai_option_type.table_name as optionTypeTable');
		$i=0; 
		foreach($featured_op as $featured_options)
		{
			
			if($featured_options->optionTypeName == 'Game'){ $opkey = 'g_id';$select = "game_title"; $select_img = "image"; $folder = IMG_GAMES_ADMIN; }elseif($featured_options->optionTypeName == 'Team'){ $opkey = 't_id'; $select = "team_name"; $select_img = "image"; $folder = IMG_TEAMS_ADMIN; }else{ $opkey='id'; $select = "player_name"; $select_img = "image"; $folder = IMG_PLAYER_ADMIN; }
			$row = $this->CI->Share_Model->get_row($featured_options->optionTypeTable,array($opkey=>$featured_options->optionTypeId),$select.','.$select_img);
			
			$result[$i]['option_id'] = $featured_options->optionId;
			$result[$i]['option_name'] = $row->$select;
			if($row->$select_img != '-'){
			if($featured_options->optionTypeName == 'Team'){
			$result[$i]['option_image'] = $row->$select_img;
			}else{
			$result[$i]['option_image'] = $folder.$row->$select_img;
			}
		
			}else{
			$result[$i]['option_image'] = '-';
			}
			$result[$i]['option_type_name'] = $featured_options->optionTypeName;  
			$user = $this->CI->session->userdata('id');
			$result[$i]['option_u'] = $user;  
			if(!empty($user))
			{
				
				$where['offered_by']  = $user;
				$where['option_id'] =   $featured_options->optionId;
				$where['status']  = 1;
				$where['deal_type']  = 'sell';
				//$where['']
				$group_by = 'deal_type' ;
				$order_by = '' ;
				$order = '' ;
				$limit = '' ;				
				$select = 'type, sum(unmatched_shares) as shares, deal_type';
				$buyoffercount = $this->CI->Share_Model->get_rows( 'ai_offered_shares' , $where , $select , $group_by , $order_by , $order , $limit );
				
				$result[$i]['buyoffercount'] = $buyoffercount;
				
				$where2['offered_by']  = $user;
				$where2['option_id'] =   $featured_options->optionId;
				$where2['status']  = 1;
				$where2['deal_type']  = 'buy';
				$where2['share_id !=']  = 0;
				//$where['']
				$group_by2 = 'deal_type' ;
				$order_by2 = '' ;
				$order2 = '' ;
				$limit2 = '' ;				
				$select2 = 'type, sum(unmatched_shares) as shares, deal_type';
				$selloffercount = $this->CI->Share_Model->get_rows( 'ai_offered_shares' , $where2 , $select2 , $group_by2 , $order_by2 , $order2 , $limit2 );
				
				$result[$i]['selloffercount'] = $selloffercount;
				
				$where1['owner_id']  = $user;
				$where1['option_id'] =   $featured_options->optionId;
				$where1['status']  = 1;
				//$where['']
				$select1 = 'sum(shares) as rowcount,type';
				$sharecount = $this->CI->Share_Model->get_row( 'ai_confirmed_shares' , $where1 , $select1 );
				
				$result[$i]['sharecount'] = $sharecount;
				
			}
			else
			{
				$result[$i]['buyoffercount'] = '';
				$result[$i]['selloffercount'] = '';
				$result[$i]['sharecount'] = '';
			}
			
		$i++;
		}
		return $result;
	}
 
	public function get_available_offers($option_id,$type,$deal_type)
	{
		//$result = array();
		$where =  array('option_id'=>$option_id,'type'=>$type,'deal_type'=>$deal_type);
		$select = "ai_offered_shares.*,sum(unmatched_shares) as shares,rate as rates";
		$order_by = "rate";
			if($deal_type == "sell")
			{
				$order = "desc";
			}
			else
			{
				$order = "asc";	
			}
		$limit = "5";
		$group_by = "rate";
  		return $this->CI->Share_Model->get_rows_limit_order_by_group_by('ai_offered_shares',$where,$select,$group_by,$order_by,$order,$limit);
		//return $result;
	
	}
 
	public function get_min_max_rate($option_id,$type,$deal_type)
	{
		$result = array();
		$where = array('option_id'=>$option_id,'type'=>$type,'deal_type'=>$deal_type);
		$select = "";
		if($deal_type == 'sell')
		{
			$select = "max(rate) as rate";
		}
		else
		{
			$select = "min(rate) as rate";
		}
		$result = $this->CI->Share_Model->get_row('ai_offered_shares',$where,$select);
		
			return $result->rate;	
		
	}
	
	public function get_user_fav_on_option( $option_id , $user_id )
	{
		/* $where['offered_by']  = $user_id;
		$where['option_id'] =   $option_id;
		$where['status']  = 1;
		$where['']
		$select = 'type';
 		$offercount = $this->CI->get_row( 'ai_offered_shares' , $where , $select );
		
		$where['owner_id']  = $user_id;
		$where['option_id'] =   $option_id;
		$where['status']  = 1;
		$where['']
		$select = 'count(*) as rowcount';
 		$sharecount = $this->CI->get_row( 'ai_confirmed_shares' , $where , $select ); */
		
	}
	
	public function  do_matched_deals($option_id,$type,$deal_type,$share_count,$rate)
	{
		
		$result = array();
		
		$where['option_id'] =  $option_id;
		$where['type'] = $type;
		$where['deal_type'] = $deal_type; 
			if($deal_type == 'sell')
			{
				$where['rate >='] = $rate;
				$order_by = "rate";
				$order = "desc";
			}
			else
			{
				$where['rate <='] = $rate;
				$order_by = "rate";
				$order = "desc";
			}
			$select = "*";
			$group_by = "";
			$limit = "";
		
		$matched_shares = $this->CI->Share_Model->get_rows_limit_order_by_group_by('ai_offered_shares',$where,$select,$group_by,$order_by,$order,$limit);
		//return $result;
		$user_id = 1; //$this->CI->session->userdata('id');
		if(!empty($matched_shares))
		{
			foreach($matched_shares as $matched_s)
			{
				$share_count  =  $share_count - $matched_s->unmatched_shares;
				if($share_count > 0)
				{
					/* $arrMatch['owner_id'] =  $matched_shares->offered_by;	
					$arrMatch['option_id'] = $matched_shares->option_id;
					$arrMatch['rate'] = $matched_shares->rate;
					$arrMatch['type'] = $matched_shares->type;
					$arrMatch['shares'] = $matched_shares->shares;
					$arrMatch['from_offer_id'] = $matched_shares->from_offer_id;
					$arrMatch['linked_offer_id'] = $matched_shares->linked_offer_id;
					$arrMatch['is_from_sell_offer'] = $matched_shares->is_from_sell_offer;
					$arrMatch['total_investment'] = $matched_shares->total_investment;
					$arrMatch['under_sell_offer'] = $matched_shares->under_sell_offer;
					$arrMatch['status'] = 2; */
					
					//$this->CI->Share_Model->insert_row('ai_confirmed','')'
				}
				else
				{
						
				}
			}
		}
		else
		{
			if($deal_type == 'buy')
			{
				$primaryArr['offered_by']   =  $user_id;           
				$primaryArr['option_id']	=  $option_id;
				$primaryArr['rate']			=  $rate;	
				$primaryArr['type']			=	$type;
				$primaryArr['total_expected_shares']	=	$share_count;
				$primaryArr['deal_type']	=	$deal_type;
				$primaryArr['share_id']		=	0;
				$primaryArr['matched_shares']	= 0;	
				$primaryArr['unmatched_shares']	= $share_count;
				$primaryArr['linked_offer_id']	=  0;
				$primaryArr['status']  = 1;
				
				if($type == "yes"){ $sec_type = "no"; } else { $sec_type = "yes"; }
				if($deal_type == "sell"){ $sec_deal_type = "buy"; } else { $sec_deal_type = "sell"; }
				
				$secondryArr['offered_by']   =  $user_id;          
				$secondryArr['option_id']	=  $option_id;
				$secondryArr['rate']			=  100 - $rate;	
				$secondryArr['type']			=	$sec_type;
				$secondryArr['total_expected_shares']	=	$share_count;
				$secondryArr['deal_type']	=	$sec_deal_type;
				$secondryArr['share_id']		=	0;
				$secondryArr['matched_shares']	= 0;	
				$secondryArr['unmatched_shares']	= $share_count;
				$secondryArr['linked_offer_id']	=  0;
				$secondryArr['status']  = 1;
				
				$resp = $this->create_new_buy_offer($primaryArr,$secondryArr);
			}
			else
			{
				
				
				$primaryArr['offered_by']   =  $user_id;             
				$primaryArr['option_id']	=  $option_id;
				$primaryArr['rate']			=  $rate;	
				$primaryArr['type']			=	$type;
				$primaryArr['total_expected_shares']	=	$share_count;
				$primaryArr['deal_type']	=	$deal_type;
				$primaryArr['share_id']		=	0;
				$primaryArr['matched_shares']	= 0;	
				$primaryArr['unmatched_shares']	= $share_count;
				$primaryArr['linked_offer_id']	=  0;
				$primaryArr['status']  = 1;
			}
		}
		
		return $resp;
	}

	public function create_new_buy_offer($primaryArr,$secondryArr)
	{
			$primary_id = $this->CI->Share_Model->insert_row('ai_offered_shares',$primaryArr);
			if($primary_id)
			{
				$secondryArr['linked_offer_id'] = $primary_id;
				$secondary_id = $this->CI->Share_Model->insert_row('ai_offered_shares',$secondryArr);
				$resp = $this->CI->Share_Model->update_row('ai_offered_shares',array('id'=>$primary_id),array('linked_offer_id'=>$secondary_id));
			}
			return $resp ;			
	}	
	
	public function new_sell_offer_submit($primaryArr)
	{
			$primary_id = $this->CI->Share_Model->insert_row('ai_offered_shares',$primaryArr);
			if($primary_id)
			{
				$secondryArr['linked_offer_id'] = $primary_id;
				$secondary_id = $this->CI->Share_Model->insert_row('ai_offered_shares',$secondryArr);
				$resp = $this->CI->Share_Model->update_row('ai_offered_shares',array('id'=>$primary_id),array('linked_offer_id'=>$secondary_id));
			}
			return $resp ;			
	}	
	
	public function get_sell_partitions($option_id,$type,$deal_type,$user_id)
	{
		$table_name = "ai_offered_shares";
		$where = array( 'type'=>$type,'deal_type'=>$deal_type,'option_id'=>$option_id,'status'=>1,'offered_by'=>$user_id,'share_id !='=>0 );
		$select = '*'; 
		$group_by = "";
		$order_by = "created_date";
		$order = "asc";
		$limit = "";
		$res = $this->CI->Share_Model->get_rows_limit_order_by_group_by($table_name,$where,$select,$group_by,$order_by,$order,$limit);
		return $res;
	}
	
	public function create_new_sell_offer($option_id,$type,$deal_type,$user_id,$share_count)
	{
		$new_count = $share_count;
		
		$shares_in_offer  =  $this->CI->Share_Model->get_sum('ai_offered_shares',array( 'type'=>$type,'deal_type'=>$deal_type,'option_id'=>$option_id,'status'=>1,'offered_by'=>$user_id,'share_id !='=>0 ),'unmatched_shares');
		
		$shares_overall  =  $this->CI->Share_Model->get_sum('ai_confirmed_shares',array( 'type'=>$type,'option_id'=>$option_id,'status'=>1,'owner_id'=>$user_id,'share_id !='=>0 ),'unmatched_shares');
		
		$diff_shares = $shares_overall - $shares_in_offer;
		if( $diff_shares >= $share_count )
		{
			//insert
		}
		else
		{
			$sell_parts = $this->get_sell_partitions($option_id,$type,$deal_type,$user_id);
			if(!empty($sell_parts))
			{
				foreach( $sell_parts as $sell_p )
				{
					$new_count = $new_count - $sell_p->unmatched_shares; 
					if( $new_count <= 0 )
					{
						//insert 
						
						//update
						
					}
					else
					{
						
						//update
					}		
				}
			}
		}
	}	
	
	
}

