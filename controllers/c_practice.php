# Our SQL command
$q = "INSERT INTO users SET 
    first_name = 'Sam', 
    last_name = 'Seaborn',
    email = 'seaborn@whitehouse.gov'";

# Run the command
echo DB::instance(DB_NAME)->query($q);