# Description

```
Description
A new modular challenge!
Download the message here.
Take each number mod 41 and find the modular inverse for the result. Then map to the following character set: 1-26 are the alphabet, 27-36 are the decimal digits, and 37 is an underscore.
Wrap your decrypted message in the picoCTF flag format (i.e. picoCTF{decrypted_message})
```


```txt
message.txt:
268 413 110 190 426 419 108 229 310 379 323 373 385 236 92 96 169 321 284 185 154 137 186
```

```php
#!/usr/bin/php
<?php

$message = file_get_contents("message.txt");
$msg_arr = explode(" ", $message);
$charset = array_merge(range("A", "Z"), range(0, 9), ["_"]);

echo "picoCTF{";
foreach($msg_arr as $byte)
	echo $charset[inverse($byte, 41)-1];
echo "}";

function inverse($num, $mod){
	for($i=0;$i<$mod;$i++){
		$result = ($num*$i) % $mod;
		if($result == 1)
			return $i;
	}
}

```

`picoCTF{1NV3R53LY_H4RD_C680BDC1}`