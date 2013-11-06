<?php if(isset($user_name)): ?>
    <h1>This is the profile for <?=$user_name?></h1>
<?php else: ?>
    <h1>No user specified</h1>
<?php endif; ?>

public function profile($user_name = NULL) {

    /*
    If you look at _v_template you'll see it prints a $content variable in the <body>
    Knowing that, let's pass our v_users_profile.php view fragment to $content so 
    it's printed in the <body>
    */
    $this->template->content = View::instance('v_users_profile');

    # $title is another variable used in _v_template to set the <title> of the page
    $this->template->title = "Profile";

    # Pass information to the view fragment
    $this->template->content->user_name = $user_name;

    # Render View
    echo $this-template;

}

$view->user_name = $user_name;

echo $view;