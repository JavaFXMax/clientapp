<?php

class DashboardController extends BaseController {
	/**
	 * 	MANAGING PAGES BEYOND USER URL '/user/*'
	 *  Create orders page
	 **/
	public function showOrders(){
		Session::forget('orderitems');
		$client=DB::table('clients')
	            ->join('users','clients.id','=','users.id')
	            ->select('clients.id as id')
	            ->where('clients.id',Confide::User()->id)
	            ->first();                				

		$orders_list = DB::table('erporders')
                ->select('*')
                ->where('client_id',$client->id)
                ->orderBy('order_number','DESC')
                ->groupBy('order_number')
                ->get();

		return View::make('home.orders', compact('orders_list'));
	}


	// Create products page
	public function showProducts($id){
		//Session::forget('orderitems');
		$client=DB::table('clients')
	            ->join('users','clients.id','=','users.id')
	            ->select('clients.id as id')
	            ->where('clients.id',Confide::User()->id)
	            ->first();   
	     //Select product name, quantity and price
	    $client_products=DB::table('erporders')
			    ->join('erporderitems', 'erporders.id', '=', 'erporderitems.erporder_id')
			    ->join('items', 'items.id', '=', 'erporderitems.item_id')
			    ->select('erporderitems.id as product_id','erporders.id as ord_id','items.name as name','erporderitems.quantity as qty','erporderitems.price as prc')
			    ->where('erporders.id', $id)
			    ->orderBy('erporders.id','asc')
			    ->get();						    
			       
		//select order number, order date and client
		$client_top_details=DB::table('erporders')	
				->join('clients','erporders.client_id','=','clients.id')
				->select('erporders.order_number as ord_num','erporders.id as erpid','clients.name as clien_name','erporders.date as date_placed')
				->where('erporders.id',$id)
				->get();
		return View::make('home.products',compact('client_products','client_top_details'));
	}

	// Create invoices page
	public function showInvoices(){
		return View::make('home.invoices');
	}

	// Create statements page
	public function showStatements(){
		return View::make('home.statements');
	}

	// Create new order page
	public function showNewOrder(){
		$count = DB::table('erporders')->count();
		$order_number = date("Y/m/d/").str_pad($count+1, 4, "0", STR_PAD_LEFT);

		date_default_timezone_set('Africa/Nairobi');
		$order_date = date("Y-m-d");
                
        $client=DB::table('clients')
                ->join('users','clients.id','=','users.id')
                ->select('*')
                ->where('clients.id',Confide::User()->id)
                ->first();
        
		$client_name = $client->name;
		$client_id = $client->id;	
                
		$items = DB::table('items')->select('name', 'id')->get();

		return View::make('home.neworder', compact('order_number', 'order_date', 'client_name', 'client_id', 'items'));
	}

	// Add order to list
	public function setOrder(){
		$data = Input::all();

		//$itemID = array_get($data, 'item');
		$item = Item::findOrFail(array_get($data, 'item'));
		$item_qty = array_get($data, 'qty');
		$item_name = $item->name;
		$item_price = $item->selling_price;
		$item_id = $item->id;
		$order_status='new';
		$order_type = 'purchases';

		Session::push('orderitems', [
				'item_id' => $item_id,
				'item_name' => $item_name,
				'item_price' => $item_price,
				'item_qty' => $item_qty,
				'order_type' => $order_type,
				'order_status'=>$order_status
			]);

		$orderitems = Session::get('orderitems');

		$count = DB::table('erporders')->count();
		$order_number = date("Y/m/d/").str_pad($count+1, 4, "0", STR_PAD_LEFT);

		date_default_timezone_set('Africa/Nairobi');
		
                
        $order_date = date("Y-m-d");
        
        $client=DB::table('clients')
                ->join('users','clients.id','=','users.id')
                ->select('*')
                ->where('clients.id',Confide::User()->id)
                ->first();
                
		$client_name = $client->name;
		$client_id = $client->id;		

		$items = DB::table('items')->select('name', 'id')->get();
		//dd($orders);
		return View::make('home.neworder', compact('order_number', 'order_date', 'client_name', 'client_id', 'items', 'orderitems'));
	}


	/**
	 * SAVE ORDERS TO DB
	 * 
	 */
	public function saveOrder(){
		$erporders = Session::get('orderitems');
		$data = Input::all();

		foreach($erporders as $orders){			
			$order_type  =   $orders['order_type'];
			$order_status=   $orders['order_status'];			
		}		

		$order_number = array_get($data, 'order_number');
		$client_id = array_get($data, 'client_id');
		$order_date = array_get($data, 'order_date');
		$total = array_get($data, 'total');
                
        DB::table('erporders')->insert(array(
				'client_id'=>$client_id,
				'date'=>$order_date,
				'type'=>$order_type,
				'status'=>$order_status,
				'order_number'=>$order_number
		));

        $lastID = DB::table('erporders')->max('id');
		foreach($erporders as $orders){
		$item_id     =   $orders['item_id'];
		$item_qty    =   $orders['item_qty'];
		$item_price  =   $orders['item_price'];					            
				
		DB::table('erporderitems')->insert(array(
				'item_id'=>$item_id,
				'quantity'=>$item_qty,
				'erporder_id'=>$lastID,
				'price'=>$item_price
			));
		}		           
                
		Session::forget('orderitems');
                
        $client=DB::table('clients')
                ->join('users','clients.id','=','users.id')
                ->select('*')
                ->where('clients.id',Confide::User()->id)
                ->first();
        //dd($client->id);
        $orders_list=DB::table('erporders')
                ->select('*')
                ->where('client_id',$client->id)
                ->orderBy('order_number','DESC')
                ->get();
		//Redirecting user                
		return View::make('home.orders', compact('orders_list'));		
	}


	//Remit edit order items
	public function editItem($id){
		$ord_details=DB::table('items')
			->join('erporderitems','erporderitems.item_id','=','items.id')
			->select('erporderitems.id as id','items.name as name','items.selling_price as selling_price')
			->where('erporderitems.id',$id)				
			->get();
			//dd($ord_details);		
		return View::make('home.edit_item',compact('ord_details'));
	}	

	//Update item quantity
	public function updateItem(){
		$user_quan=Input::get('edit_order_quantity');
		$data=array($user_quan);
		$rules = array('edit_order_quantity' => 'numeric|min:1|max:4');
		$validator = Validator::make($rules,$data);
		$chck=$validator->passes();	  

		switch($chck){
			case 0:
				return Redirect::back()->with('message','INVALID QUANTITY VALUE PROVIDED.Please provide the correct quantity value.');
			break;

			case 1:
				if($user_quan<1){
					return Redirect::back()->with('message','INVALID QUANTITY VALUE PROVIDED.The quantity must be more than zero.');
				}else{
					$id=Input::get('order_number');
					DB::table('erporderitems')
						->where('id',$id)
						->update(array('quantity'=>$user_quan));
					//return $user_quan;
					return Redirect::back()->with('message','Order item successfully updated.');
				}
			break;
		}			
	}

	//Deleting an item from an order
	public function deleteItem($id){
		DB::table('erporderitems')
			->where('id',$id)
			->delete();
		return Redirect::back()->with('message','Order item successfully deleted.');
	}

	//Make payments for orders
	public function makePayment(){
		return View::make('home.payment',compact('id','total'));
	}

	//Complete payment transaction
	public function completeTransaction(){
		$pay_details=Session::get('pay_details');
		$inv_number=$pay_details['ord_id'];
		$sum=$pay_details['total_amount'];
		//Check the transaction id and the amount provided from the backend
		$user_transact_id= Input::get('transaction_id');
		$check_id=DB::table('transaction')
				->where('transaction_number',$user_transact_id)
				->count();
		//compare the transaction id with the user provided id
		switch($check_id){
			//Redirect with a failure message
			case 0:
				return Redirect::back()->with('message','PAYMENT FAILURE. THE TRANSACTION ID DOES NOT EXIST.');
			break;
			//If the IDs match,subtract the amount paid from the total amount supposed to be paid
			case 1:
				//Insert into payment table and check the inserted record id
				$check_if=DB::table('payment')
					->insertGetId(array(
						'order_number'=>$inv_number,
						'total'=>$sum,
						'created_at'=>date('Y-m-d H:m:s'),
						'updated_at'=>date('Y-m-d H:m:s')
						)
					);
				//Get the last ID of payment table
				/*$check_if=DB::table('payment')
					->insertGetId(array(
						'order_number'=>$inv_number,
						'total'=>$sum,						
						)
					);*/
				//insert into transaction table
				$cur_date=date('Y-m-d');
				$transact_if=DB::table('transaction')
						->where('transaction_date','0000-00-00')
						->count();

				if($transact_if===0){
					return Redirect::back()->with('message','PAYMENT FAILURE. THE TRANSACTION ID ALREADY USED.');	
				}else{
					DB::table('transaction')
					->where('transaction_number',$user_transact_id)
					->update(array(
						'pay_id'=>$check_if,
						'transaction_date'=>$cur_date,
						'created_at'=>date('Y-m-d H:m:s'),
						'updated_at'=>date('Y-m-d H:m:s')
						)
					);
					return Redirect::back()->with('message','PAYMENT SUCCESS. Payment successfully processed.');					
				}				
			break;
			default:
				return Redirect::back()->with('message','PAYMENT FAILURE. INVALID TRANSACTION ID');
			break;
		}				
		//dd($id);
	}

}
