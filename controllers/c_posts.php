<?php
class posts_controller extends base_controller {

	public function __construct() {
		parent::__construct();

		# Make sure user is logged in if they want to use anything in this controller
			if(!$this->user) {
				die("Members only. <a href='/users/login'>Login</a>");
			}
	}

    public function add() {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

    }
	

	function idea() {
		$random_number = rand(1,10);


		if ($random_number == 1){
			echo 'When in Rome, do as the Romans.';
		}else if ($random_number == 2){
			echo 'The squeaky wheel gets the grease.';
		}else if ($random_number == 3){
			echo 'No man is an island.';
		}else if ($random_number == 4){
			echo 'Fortune favors the bold.';
		}else if ($random_number == 5){
			echo 'Discretion is the greater part of valor.';
		}else if ($random_number == 6){
			echo 'Never look a gift horse in the mouth.';
		}else if ($random_number == 7){
			echo 'If it ain\'t broke, don\'t fix it.';
		}else if ($random_number == 8){
			echo 'Absence makes the heart grow fonder.';
		}else if ($random_number == 9){
			echo 'Don\'t count your chickens before they hatch.';
		}else{
			echo 'If you want something done right, you have to do it yourself.';
		}

	}

	
	public function users() {

		# Set up the View
			$this->template->content = View::instance("v_posts_users");
			$this->template->title   = "Users";

		# Build the query to get all the users
			$q = "SELECT *
				FROM users";

		# Execute the query to get all the users. 
		# Store the result array in the variable $users
			$users = DB::instance(DB_NAME)->select_rows($q);

		# Build the query to figure out what connections does this user already have? 
		# I.e. who are they following
			$q = "SELECT * 
				FROM users_users
				WHERE user_id = ".$this->user->user_id;

		# Execute this query with the select_array method
		# select_array will return our results in an array and use the "users_id_followed" field as the index.
		# This will come in handy when we get to the view
		# Store our results (an array) in the variable $connections
			$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		# Pass data (users and connections) to the view
			$this->template->content->users       = $users;
			$this->template->content->connections = $connections;

		# Render the view
			echo $this->template;
	}
	
	
	public function follow($user_id_followed) {

    # Prepare the data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
        );

		# Do the insert
			DB::instance(DB_NAME)->insert('users_users', $data);

		# Send them back
			Router::redirect("/posts/users");

	}

	public function unfollow($user_id_followed) {

		# Delete this connection
			$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
			DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# Send them back
			Router::redirect("/posts/users");

	}
	
	
	
	public function index() {

		# Set up the View
			$this->template->content = View::instance('v_posts_index');
			$this->template->title   = "Posts";

		# Build the query
			$q = "SELECT 
					posts .* , 
					users.first_name, 
					users.last_name
				FROM posts
				INNER JOIN users 
					ON posts.user_id = users.user_id";

		# Run the query
			$posts = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
			$this->template->content->posts = $posts;

		# Render the View
			echo $this->template;

	}

    public function p_add() {

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Quick and dirty feedback
        echo "Your post has been added. <a href='/posts/add'>Add another</a>";

    }
}