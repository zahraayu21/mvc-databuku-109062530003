<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/BukuController.php';

$controller = new BukuController($pdo);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;

    case 'create':
        $controller->create();
        break;

    case 'detail':
    case 'edit':
    case 'delete':
        if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Metode permintaan tidak diizinkan.');
        }

        $rawId = $action === 'delete'
            ? ($_POST['id'] ?? '')
            : ($_GET['id'] ?? '');

        $id = filter_var($rawId, FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id < 1) {
            http_response_code(400);
            exit('ID buku tidak valid.');
        }

        if ($action === 'detail') {
            $controller->detail($id);
        } elseif ($action === 'edit') {
            $controller->edit($id);
        } else {
            $controller->delete($id);
        }
        break;

    default:
        http_response_code(404);
        echo 'Halaman tidak ditemukan.';
        break;
}
