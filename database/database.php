<?php
namespace database;


require_once __DIR__ . '/../utils/EnvLoader.php';

use PDO;
use utils\EnvLoader;

EnvLoader::loadEnv();


class database
{

    private $user;
    private $password;
    private $host;
    private $database;
    private $pdo;



    public function __construct()
    {
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
        $this->host = getenv('DB_HOST');
        $this->database = getenv('DB_NAME');


        $this->pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password,
            array(
                PDO::ATTR_TIMEOUT => 5, // in seconds
                //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
    }


    // $request = "SELECT * FROM PRODUIT WHERE id = :id";
    // $params = [':id' => 1];
    // $result = $db->select($request, $params);
    public function select($request, $params = [])
    {
        $stmt = $this->pdo->prepare($request);
        foreach ($params as $key => $val) {
            if (is_int($val)) {
                $stmt->bindValue($key, $val, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($key, htmlspecialchars($val), PDO::PARAM_STR);
            }
        }
        $stmt->execute();

        return $stmt->fetchAll();
    }


    // Example of using the insert method
    // $request = "INSERT INTO PRODUIT (nom, description) VALUES (:nom, :description)";
    // $params = [':nom' => 'Product Name', ':description' => 'Product Description'];
    // $result = $db->insert($request, $params);
    public function query($request, $params = [])
    {
        $stmt = $this->pdo->prepare($request);
        foreach ($params as $key => &$val) {
            $htmlspecialchars = htmlspecialchars($val);
            $stmt->bindValue($key, $htmlspecialchars);
        }
        return $stmt->execute();
    }
}