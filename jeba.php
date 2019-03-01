<?php
$roles = array( 'admin', 'manager' );

echo hash_pbkdf2('sha3-256', 'admin', 'adminSalt', 3);


$users = array( array('email' => 'admin@admin.com',
                            'uname' => 'Admin',
                            'password' => hash_pbkdf2('sha3-256', 'admin', 'adminSalt', 3),
                            'salt' => 'adminSalt',
                            'fname' => 'Admin',
                            'lname' => 'Sysadmin',
                            'role_id' => 1 ) 
                        );
        
        $insertUsers = "INSERT INTO user (email, uname, password, salt, fname, lname, role_id) VAKUES (:email, :uname, :password, :salt, :fname, :lname, :role_id)";
        
        //$stmt = $db->prepare($insertUsers);
        /*
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':salt', $salt);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':role_id', $role_id);
        */

        foreach ($users as $e) {
            echo $e['email'];
            echo $e['uname'];
            echo $e['password'];
            echo $e['salt'];
            echo $e['fname'];
            echo $e['lname'];
            echo $e['role_id'];
            //$stmt->execute();
        }




?>