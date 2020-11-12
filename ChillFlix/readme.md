# Trello Link :

> https://trello.com/b/cnZQTKyB/chillflix

# Variable names (Abbreviations)

```
fn  --> First Name
ln  --> Last Name
un  --> Username
em  --> email
em2 --> email2
pw  --> password
pw2 --> password2
```

# References

### Using a PHP class from another php File

> login.php, register.php

```
require_once('class.php');
```

- https://stackoverflow.com/questions/14350803/how-to-use-a-php-class-from-another-file

### PHP Materials

> Account.php

```
public function __construct($con) { }
```

- https://www.w3schools.com/php/php_oop_constructor.asp

### TimeZone

> config.php

```
date_default_timezone_set('Asia/Kolkata');
```

- https://stackoverflow.com/questions/13340737/get-current-ist-time-in-php
- https://stackoverflow.com/questions/34428563/set-timezone-in-php-and-mysql

### Database connection

> config.php

```
PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING
```

- https://www.php.net/manual/en/class.pdoexception.php
- https://www.youtube.com/watch?v=QtCdk459NFg
- https://www.quora.com/What-is-SetAttribute-PDO-ATTR_ERRMODE-PDO-ERRMODE_EXCEPTION-in-PHP

### bindValue()

> Account.php

```
$query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
$query->bindValue(":un", $un);
```

- https://use-the-index-luke.com/sql/where-clause/bind-parameters
- https://www.geeksforgeeks.org/difference-between-bindparam-and-bindvalue-in-php/#:~:text=The%20PDOStatement%3A%3AbindValue(),used%20to%20prepare%20the%20statement.

### Validating emails

> Account.php

```
filter_var($em, FILTER_VALIDATE_EMAIL)
```

- https://www.w3schools.com/php/filter_validate_email.asp

### PDO::FETCH_ASSOC)

> PreviewProvider.php

```
$query->fetch(PDO::FETCH_ASSOC);
```

- https://stackoverflow.com/questions/16846531/how-to-read-fetchpdofetch-assoc/16858666
- https://www.ibm.com/support/knowledgecenter/SSEPGG_10.5.0/com.ibm.swg.im.dbclient.php.doc/doc/t0023505.html

### Displaying Errors

> ErrorMessage.php

```
exit("<span class='errorBanner'>$text</span>")
```

- https://www.geeksforgeeks.org/php-exit-function/

### Using \$this

```
$this->con = $con;
```

- https://www.geeksforgeeks.org/this-keyword-in-php/

### Using access modifiers PHP

- https://www.w3schools.com/php/php_oop_access_modifiers.asp

### Using new keyword

```
$account = new Account($con);
```

- https://www.w3schools.com/php/keyword_new.asp#:~:text=The%20new%20keyword%20is%20used%20to%20create%20an%20object%20from%20a%20class.

### Embedding font awesome

```
<script src="https://kit.fontawesome.com/c09edbcfe1.js" crossorigin="anonymous"></script>
```

- https://www.w3schools.com/icons/fontawesome_icons_intro.asp

### Using scope resolution operator

```
ErrorMessage::show("No ID passed into page")
```

- https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php

### Using ternary operator PHP

- https://www.geeksforgeeks.org/php-ternary-operator/

### Hashing in PHP

```
$pw = hash("sha512", $password);
```

- https://www.geeksforgeeks.org/php-md5-sha1-hash-functions/

### Execute function after video ended

```
<video controls autoplay onended="showUpNext()">
```

- https://stackoverflow.com/questions/14517639/executing-function-at-end-of-html5-video

### Custom Cursor

- https://www.youtube.com/watch?v=TpwpAYi-p2w
