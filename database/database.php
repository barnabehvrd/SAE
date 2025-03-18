<?php
namespace database;


require_once 'utils/EnvLoader.php';
use utils\EnvLoader;

EnvLoader::loadEnv();


class database
{

    private $user;
    private $pdo;



    public function __construct()
    {
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
        $this->host = getenv('DB_HOST');
        $this->database = getenv('DB_NAME');


        $this->pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);
    }


    // $request = "SELECT * FROM PRODUIT WHERE id = :id";
    // $params = [':id' => 1];
    // $result = $db->select($request, $params);
    public function select($request, $params = [])
    {
        $stmt = $this->pdo->prepare($request);
        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
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
            $stmt->bindParam($key, $val);
        }
        return $stmt->execute();
    }


}