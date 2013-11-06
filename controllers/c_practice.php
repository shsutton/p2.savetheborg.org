<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
			
	}
	
} # eoc



# Our SQL command
$q = "UPDATE users
    SET email = 'samseaborn@whitehouse.gov'
    WHERE email = 'seaborn@whitehouse.gov'"

# Run the command
echo DB::instance(p2_savetheborg_org)->query($q);

# Our SQL command
$q = "INSERT INTO users SET 
    first_name = 'Sally', 
    last_name = 'Seaborn',
    email = 'sally@whitehouse.gov'";

# Run the command
echo DB::instance(db_savetheborg_org)->query($q);



# Our SQL command
$q = "DELETE FROM users
    WHERE email = 'samseaborn@whitehouse.gov'";

# Run the command
echo DB::instance(DB_NAME)->query($q);