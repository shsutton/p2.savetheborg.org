<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	


	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>

</head>

<body> 

 



    <div id='menu'>
	
	<section>
	<div id="navigation1">
	<nav>
	<ul id="sitenav">

        <li><a href='/'>Home</a>
		<li><a href='/posts/add'>Post-Your-ST!</a>
		<li><a href='/posts/users'>Users</a>
		<li><a href='/posts'>Posts</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <li><a href='/users/logout'>Logout</a>
            <li><a href='/users/profile'>Profile</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <li><a href='/users/signup'>Membership</a>
            <li><a href='/users/login'>Login</a>

        <?php endif; ?>

	</ul>
	</nav>
	</div>
	</section>
	</div>

    <br>

    <?php if(isset($content)) echo $content; ?>

</body>
</html>