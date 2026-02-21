<?php
// clear.php - Hapus semua log
if(file_exists('logs.txt')) {
    file_put_contents('logs.txt', '');
    echo "Logs dihapus, bang!";
} else {
    echo "Gak ada file logs!";
}
?>