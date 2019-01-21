# Soda
A simple PHP MVC framework

*Includes just the basics and a few helper classes and functions*

You can understand how it works by simply configuring your webserver to run Soda and start browsing the included `HomeController`. It's also helpful to take a look at `bootstrap.php` and overal project structure (folder structure).

# Configuring the SQL database
1- Define your models in `/app/models` directory (Should extend `Illuminate\Database\Eloquent\Model`). As an example:

```
/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model{}
```

2- Execute the command `vendor/bin/phinx create MyFirstMigration -c phinx.config.php` inside project root.
Phinx will create a new migration file in the migrations directory (inside `db/migrations`)

3- Open the migration file and remove the `change` method and instead create `up` and `down` methods.

4- Fill `up()` and `down()` with your schema creation codes. As an example:

```
function up() {
    $this->schema->create('users', function(Illuminate\Database\Schema\Blueprint $table){
        // Auto-increment id
        $table->increments('id');
        $table->integer('serial_number');
        $table->string('name');
        // Required for Eloquent's created_at and updated_at columns
        $table->timestamps();
    });
}

function down() {
    $this->schema->drop('users');
}
```

5- Now it's time to run the migration:

`vendor/bin/phinx migrate -c phinx.config.php`

6- Test the program:

```
$users = \App\Models\User::all();
foreach ($users as $u) {
    echo "<h1>$u->name</h1>";
}
```