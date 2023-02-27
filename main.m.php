<?php
if (empty($_ENV)) {
    $_ENV = getenv();
}
$directory_env = './.env';
if (file_exists($directory_env)) {
    $sub_env = explode("\n", file_get_contents($directory_env));
    foreach ($sub_env as $value) {
        if (strpos($value, '=') !== false) {
            [$k, $v] = explode('=', $value);
            $_ENV[trim($k)] = trim($v);
        }
    }
} else {
    echo 'you need to create .env file on project root';
}

class DB_MYSQLI
{

    public static function query($sql)
    {
        $localhost = $_ENV['db_host'] ?? "";
        $user = $_ENV['db_username'] ?? "";
        $password = $_ENV['db_password'] ?? "";
        $daname = $_ENV['db_name'] ?? "";
        $conn = new mysqli($localhost, $user, $password, $daname);
        return $conn->query($sql);
    }
}
