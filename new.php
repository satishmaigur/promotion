<?php
class Promotion {
	
	private $discount_percent = 0;
	Private $discount_amnt = 0;
	
	private function percentage_discount($user_type, $user_since_from = 0 ) {	
		if($user_type == 'employee') {
			$discount = 30;
		}
		else if($user_type == 'affiliate') {
			$discount = 10;
		}
		else if($user_type == 'customer') {
			if($user_since_from >= 2 ) # Old customers with 2 years and above will get 5% discount
				$discount = 5; 
			else 
				$discount = 0;
		}

		return $discount;
	}

	private function amount_discount($product_mrp) {
		if($product_mrp >= 100 ) {
			$discount_applicable = floor( $product_mrp / 100);
			return 5 * $discount_applicable;
		}else {
			return 0;
		}
	}

	
	/* Below function takes argument as -> Product Category : Grocery | Others
														MRP : MRP of the product
												User Type	: affiliate | employee | customer
	Customer since last how many years (in number of years)	: Since how many years the user is our customer (in years)
	*/
 	public function generate_bill($product_type, $product_mrp, $user_type, $user_since_from = 0 ) {
	
		$final_amount = $product_mrp;

		if($product_type == 'other') {
			$this->discount_percent = $this->percentage_discount($user_type , $user_since_from );
			$final_amount = $product_mrp - ($product_mrp * ($this->discount_percent/100));
		}

		$this->discount_amnt = $this->amount_discount($product_mrp);
		$final_amount = $final_amount - $this->discount_amnt;

		return [
				'User_Type' => $user_type,
				'Product_Type' => $product_type,
				'Discount_Percentage' => $this->discount_percent,
				'Discount_Amount' => $this->discount_amnt,
				'Original_Price' => $product_mrp,
				'Final_Price_After_Discount' => $final_amount
			];
	}
}

$obj = new Promotion();

# Examples
echo '<pre>';
$output = $obj->generate_bill('grocery', '50000', 'affiliate' );
print_r($output);
$output = $obj->generate_bill('other', '50000', 'affiliate' );
print_r($output);
$output = $obj->generate_bill('other', '50000', 'employee' );
print_r($output);
$output = $obj->generate_bill('other', '50000', 'customer', 2 ); # Old customer with 2 year
print_r($output);
$output = $obj->generate_bill('other', '50000', 'customer', 3 ); #Old customer with 3 year
print_r($output);
$output = $obj->generate_bill('other', '50000', 'customer', 1 );# Old customer with 1 year 
print_r($output);
?>