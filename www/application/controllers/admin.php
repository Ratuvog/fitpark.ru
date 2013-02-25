<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('grocery_CRUD');	
	}
	
	function render($output = null)
	{
		$this->load->view('admin.php',$output);	
	}
	
	function categories()
	{
                $crud = new grocery_CRUD();
                $crud->set_table("service_category");
		$crud->set_field_upload('icon','assets/uploads/files');
                
                $crud->set_relation_n_n('options', 'ref_category_options',
                    'category_options', 'categoryid', 
                    'optionid', 'name', 'priority');
                
                $crud->set_relation_n_n('item', 'ref_category_item',
                'sale_item', 'categoryid', 
                'itemid', 'name', 'priority');
                
                $output = $crud->render();
		$this->render($output);
                
	}
        
        function options()
	{
                $crud = new grocery_CRUD();
                $crud->set_table("category_options");
                
                $crud->set_relation_n_n('value', 'ref_option_value',
                'options_value', 'optionid', 
                'valueid', 'name', 'priority');
                
		$crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
	}
	
        function values()
	{
                $crud = new grocery_CRUD();
                $crud->set_table("options_value");
                
                $crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
	}
        
        function items()
        {
                $crud = new grocery_CRUD();
                $crud->set_theme('datatables');
                $crud->set_table("sale_item");
                $crud->set_field_upload('icon','assets/uploads/files');
                $crud->set_field_upload('head_picture','assets/uploads/files');
                
                $crud->set_relation_n_n('groups', 'ref_item_group',
                'item_group', 'itemid', 
                'groupid', 'name', 'priority');
                
                $crud->set_relation_n_n('option_values', 'ref_item_optionvalue',
                'options_value', 'itemid', 
                'valueid', 'name', 'priority');
                
                $crud->set_relation_n_n('discounts', 'ref_item_discount',
                'item_discount', 'discountid', 
                'itemid', 'name', 'priority');
                
                $output = $crud->render();
                $this->render($output);
        }

        function descriptions()
        {
                $crud = new grocery_CRUD();
                $crud->set_table("item_description");
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function news()
        {
                $crud = new grocery_CRUD();
                $crud->set_table("item_news");
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }

        function reviews()
        {
                $crud = new grocery_CRUD();
                $crud->set_table("item_review");
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function discounts()
        {
                $crud = new grocery_CRUD();
                $crud->set_table("item_discount");
                $output = $crud->render();
                $this->render($output);
        }
        
        function photos()
        {
                $crud = new grocery_CRUD();
                $crud->set_table("item_photo");
                $crud->set_relation('itemId','sale_item','name');
                $crud->set_field_upload('photo','assets/uploads/files');
                $output = $crud->render();
                $this->render($output);
        }
        
        function item_ratings()
        {
                $crud = new grocery_CRUD();
                $crud->set_table("item_rating");
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function groups()
        {
            $crud = new grocery_CRUD();
            $crud->set_table("item_group");
            $crud->set_field_upload('icon','assets/uploads/files');
            $output = $crud->render();
            $this->render($output);
        }
        
        function index()
	{
		$this->render((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
	
	function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			
			$crud->required_fields('lastName');
			
			$crud->set_field_upload('file_url','assets/uploads/files');
			
			$output = $crud->render();

			$this->_example_output($output);
	}
	
	function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
			
			$output = $crud->render();
			
			$this->_example_output($output);
	}	
	
	function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->_example_output($output);
	}
	
	function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			
			$output = $crud->render();
			
			$this->_example_output($output);
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
	function film_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');
		
		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		
		$output = $crud->render();
		
		$this->_example_output($output);
	}
	
}
?>