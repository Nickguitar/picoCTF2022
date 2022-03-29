## Description
```
Description
We found this weird message being passed around on the servers, we think we have a working decrpytion scheme.
Download the message here.
Take each number mod 37 and map it to the following character set: 0-25 is the alphabet (uppercase), 26-35 are the decimal digits, and 36 is an underscore.
Wrap your decrypted message in the picoCTF flag format (i.e. picoCTF{decrypted_message})
```

----

```txt
message.txt:
54 396 131 198 225 258 87 258 128 211 57 235 114 258 144 220 39 175 330 338 297 288
```

```php
#!/usr/bin/php
<?php

$message = file_get_contents("message.txt");
$msg_arr = explode(" ", $message);

$charset = array_merge(range("A", "Z"), range(0, 9), ["_"]);

echo "picoCTF{";
foreach($msg_arr as $byte)
	echo $charset[$byte % 37];
echo "}";
```

```
$ php decrypt.php
picoCTF{R0UND_N_R0UND_79C18FB3}
```