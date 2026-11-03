<?php
/** @var bool $success */
/** @var string[] $errors */
/** @var bool $isTokenValid */
/** @var string $token */
/**
 * @var string $title
 * @var array{id: int, email: string}|null $user
 * @var string $currentPath
 */

use App\View\Card;
use App\View\Form;
use App\View\Strong;
use App\View\Layout;
use App\View\Head;
use App\View\Paragraph;
use App\View\Link;
use App\View\Button;

return new Layout($title, $user, [
        new Card([
                new Head("Bienvenue"),
                ( $user !== null ? [new Paragraph(["Bonjour" . new Strong($user['email']) . ", vous êtes connecté."], "welcome-text"),
                                    new Form("post", "/logout", [
                                            new Button("Déconnexion", "", "", "submit", "btn btn-secondary")
                                    ], "card-actions")]
                                 :
                                    [new Paragraph("Vous n'êtes pas connecté.", "welcome-text"),
                                     new Paragraph("Veuillez vous identifier ou créer un compte pour accéder à votre espace"),
                                     new Card([
                                             new Link("Connexion", "/login", "btn btn-primary"),
                                             new Link("Créer un compte", "/register", "btn btn-secondary")
                                     ], "card-actions")]
                )
        ], "card welcome-card")
], $currentPath)

?>