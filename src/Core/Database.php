<?php
namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    /**
     * Instance unique de PDO (Singleton).
     */
    private static ?PDO $instance = null;

    /**
     * Constructeur privé pour empêcher l'instanciation directe avec 'new Database()'.
     */
    private function __construct() {}

    /**
     * Empêche le clonage de l'instance.
     */
    private function __clone() {}

    /**
     * Ouvre ou récupère la connexion PDO unique à MariaDB avec les paramètres du fichier .env.
     * En cas d'échec, l'erreur est écrite dans le journal du serveur et le visiteur voit une erreur 500.
     *
     * @return PDO Connexion configurée (exceptions, tableaux associatifs, vraies requêtes préparées)
     */
    public static function connexion(): PDO
    {
        if (self::$instance === null) {
            if (!extension_loaded('pdo_mysql')) {
                die("Erreur configuration : l'extension PHP pdo_mysql n'est pas activée.");
            }

            foreach (['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS'] as $cle) {
                if (Env::get($cle) === null) {
                    die("Erreur configuration : clé $cle absente du fichier .env.");
                }
            }

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                Env::get('DB_HOST'),
                Env::get('DB_PORT', '3306'),
                Env::get('DB_NAME')
            );

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new PDO($dsn, Env::get('DB_USER'), Env::get('DB_PASS'), $options);
            } catch (PDOException $e) {
                error_log('Connexion BDD échouée : ' . $e->getMessage());
                http_response_code(500);
                die('Service momentanément indisponible.');
            }
        }
        return self::$instance;
    }
}