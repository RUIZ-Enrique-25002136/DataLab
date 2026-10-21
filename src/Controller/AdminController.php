<?php

namespace App\Controller;

use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\User;
use App\Models\UserRepository;

/**
 * Administration des rôles des membres, réservée aux administrateurs (role === 3).
 */
class AdminController
{
    private const PER_PAGE = 10;
    private const ALLOWED_ROLES = [1, 2, 3];

    /**
     * @param UserRepository $users Accès aux comptes utilisateurs
     * @param View           $view  Moteur de templates
     */
    public function __construct(
        private UserRepository $users,
        private View $view,
    ) {}

    /**
     * Affiche et traite la modification du rôle des membres (GET et POST /adminRole).
     */
    public function adminRole(Request $request): Response
    {
        $admin = $this->currentUser();
        if ($admin === null) {
            return Response::redirect('/login');
        }
        if ($admin->role !== 3) {
            return Response::redirect('/');
        }

        $errors = [];
        $success = false;

        if ($request->isPost()) {
            $targetId = filter_var($request->get('user_id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $newRole = filter_var($request->get('role'), FILTER_VALIDATE_INT);

            if (!Csrf::check()) {
                $errors[] = 'Session expirée, veuillez réessayer.';
            } elseif ($targetId === false || $newRole === false || !in_array($newRole, self::ALLOWED_ROLES, true)) {
                $errors[] = 'Données invalides.';
            } else {
                $targetUser = $this->users->findById($targetId);
                if ($targetUser === null) {
                    $errors[] = 'Utilisateur introuvable.';
                } elseif ($targetUser->id === $admin->id && $newRole !== 3) {
                    $errors[] = 'Vous ne pouvez pas retirer votre propre rôle administrateur.';
                } elseif ($this->users->updateRole($targetUser->id, $newRole)) {
                    $success = true;
                } else {
                    $errors[] = 'Une erreur est survenue.';
                }
            }
        }

        $total = $this->users->countMembers();
        $pages = max(1, (int) ceil($total / self::PER_PAGE));
        $page = filter_var($request->get('page', 1), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $page = $page === false ? 1 : min($page, $pages);

        return $this->view->render('admin_role', [
            'members' => $this->users->findPage(self::PER_PAGE, ($page - 1) * self::PER_PAGE),
            'page'    => $page,
            'pages'   => $pages,
            'total'   => $total,
            'errors'  => $errors,
            'success' => $success,
            'title'   => 'Gestion des rôles',
            'noindex' => true,
        ]);
    }

    /**
     * Retrouve en base l'utilisateur de la session, ou null si personne n'est connecté.
     */
    private function currentUser(): ?User
    {
        $id = $_SESSION['user']['id'] ?? null;

        return $id === null ? null : $this->users->findById((int) $id);
    }
}
