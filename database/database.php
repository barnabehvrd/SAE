<?php
namespace database;


require_once 'utils/EnvLoader.php';

use PDO;
use utils\EnvLoader;

EnvLoader::loadEnv();

ini_set('display_errors', 1);


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
        foreach ($params as $key => &$val) {
            $htmlspecialchars = htmlspecialchars($val);
            if (is_int($val)) {
                $stmt->bindParam($key, $htmlspecialchars, PDO::PARAM_INT);
            } else {
                $stmt->bindParam($key, $htmlspecialchars, PDO::PARAM_STR);
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
            $stmt->bindParam($key, $htmlspecialchars);
        }
        return $stmt->execute();
    }


}