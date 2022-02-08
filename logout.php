<?php

setcookie("id", "", time() - 3600*24*30*12, "/"); // обнуляем куки
setcookie("hash", "", time() - 3600*24*30*12, "/");
header("Location: /"); exit; // и перенаправляем на главную

?>