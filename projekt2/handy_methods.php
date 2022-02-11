<?php
// Starta en session för att användaren ska kunna
// "hållas" inloggad trots att den inte skickar
// username och password till servern varje refresh
session_start();

// En funktion som tar bort whitespace med trim,
// backkslashes (escape char), och konverterar 
// eventuella skadliga html tecken som < eller > 
// till deras html representationer &lt;script&gt;
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>