<?php

echo hash_pbkdf2('sha3-256', "lowKey", "adminSalt", 3);

?>