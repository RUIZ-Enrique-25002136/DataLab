<?php

namespace App\Controller;

use App\Models\User;
use App\Models\UserRepository;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Csrf;

/**
 * Page « Mon compte », réservée aux membres connectés : voir ses informations,
 * modifier son login, modifier son mot de passe et supprimer son compte.
 */
class AccountController
{
    /**
     * @param UserRepository $users Accès aux comptes utilisateurs
     * @param View           $view  Moteur de templates
     */
    public function __construct(
        private UserRepository $users,
        private View $view,
    ) {}

    /**
     * Affiche la page du compte (GET /account).
     */
    public function show(Request $request): Response
    {
        $user = $this->currentUser();
        if ($user === null) {
            return Response::redirect('/login');
        }

        return $this->showAccount($user, [], false);
    }

    /**
     * Modifie le login du compte connecté (POST /account).
     */
    public function updateLogin(Request $request): Response
    {
        $user = $this->currentUser();
        if ($user === null) {
            return Response::redirect('/login');
        }

        $login = trim((string) $request->get('login', ''));
        $errors = [];
        $success = false;

        if (!Csrf::check()) {
            $errors[] = 'Session expirée, veuillez réessayer.';
        } elseif (!User::isValidLogin($login)) {
            $errors[] = 'Le login doit contenir entre 3 et 30 caractères : lettres, chiffres, - ou _.';
        } elseif ($login !== $user->login && $this->users->loginExists($login)) {
            $errors[] = 'Ce login est déjà utilisé.';
        } elseif ($this->users->updateLogin($user->id, $login)) {
            $success = true;
            $user = $this->users->findById($user->id) ?? $user;
        } else {
            $errors[] = 'Une erreur est survenue.';
        }

        return $this->showAccount($user, $errors, $success);
    }

    /**
     * Modifie le mot de passe du compte connecté (POST /account/password).
     */
    public function updatePassword(Request $request): Response
    {
        $user = $this->currentUser();
        if ($user === null) {
            return Response::redirect('/login');
        }

        $currentPassword = (string) $request->get('current_password', '');
        $newPassword = (string) $request->get('new_password', '');
        $confirmation = (string) $request->get('password_confirmation', '');
        $errors = [];
        $passwordSuccess = false;

        if (!Csrf::check()) {
            $errors[] = 'Session expirée, veuillez réessayer.';
        } elseif (!$user->verifyPassword($currentPassword)) {
            $errors[] = 'Le mot de passe actuel est incorrect.';
        } elseif (strlen($newPassword) < 8) {
            $errors[] = 'Le nouveau mot de passe doit contenir au moins 8 caractères.';
        } elseif ($newPassword !== $confirmation) {
            $errors[] = 'Les nouveaux mots de passe ne correspondent pas.';
        } elseif ($this->users->updatePassword($user->id, $newPassword)) {
            $passwordSuccess = true;
            $user = $this->users->findById($user->id) ?? $user;
        } else {
            $errors[] = 'Une erreur est survenue.';
        }

        return $this->showAccount($user, $errors, false, $passwordSuccess);
    }

    /**
     * Supprime le compte connecté après vérification du mot de passe (POST /account/delete).
     */
    public function delete(Request $request): Response
    {
        $user = $this->currentUser();
        if ($user === null) {
            return Response::redirect('/login');
        }

        $password = (string) $request->get('password', '');

        if (!Csrf::check()) {
            return $this->showAccount($user, ['Session expirée, veuillez réessayer.'], false);
        }
        if (!$user->verifyPassword($password)) {
            return $this->showAccount($user, ['Mot de passe incorrect, le compte n\'a pas été supprimé.'], false);
        }

        $this->users->delete($user->id);
        $_SESSION = [];
        session_destroy();

        return Response::redirect('/');
    }

    /**
     * Retrouve en base l'utilisateur de la session, ou null si personne n'est connecté.
     */
    private function currentUser(): ?User
    {
        $id = $_SESSION['user']['id'] ?? null;

        return $id === null ? null : $this->users->findById((int) $id);
    }

    /**
     * Prépare la réponse de la page du compte.
     *
     * @param User     $user            Utilisateur connecté
     * @param string[] $errors          Messages d'erreur à afficher
     * @param bool     $success         true si le login vient d'être modifié
     * @param bool     $passwordSuccess true si le mot de passe vient d'être modifié
     */
    private function showAccount(User $user, array $errors, bool $success, bool $passwordSuccess = false): Response
    {
        return $this->view->render('account', [
            'account'         => $user,
            'errors'          => $errors,
            'success'         => $success,
            'passwordSuccess' => $passwordSuccess,
            'title'           => 'Mon compte',
            'noindex'         => true,
        ]);
    }
}
