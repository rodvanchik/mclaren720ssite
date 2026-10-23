<?php
session_start(); 

echo "<h3>spysok:</h3>";

echo "<pre>"; 
if (isset($_SESSION['users_array']) && !empty($_SESSION['users_array'])) {
    print_r($_SESSION['users_array']); 
} else {
    echo "nikogo(";
}
echo "</pre>";
?>