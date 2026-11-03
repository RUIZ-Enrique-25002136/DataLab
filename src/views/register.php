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

use App\View\Input;
use App\View\Form;
use App\View\Layout;
use App\View\Head;
use App\View\Paragraph;
use App\View\Link;
use App\Core\Csrf;
use App\View\Button;

if ($success) {
    return new Layout($title, $user, [
            new Paragraph("Inscription réussie."),
            new Paragraph("Veuillez vérifier votre email.")
    ], $currentPath);
} else {
    if (!empty($error)) {
        foreach ($errors as $error) {
            echo '<ul><li>' . htmlspecialchars($error) . '</li></ul>';
        }
    }
}

return new Layout($title, $user, [
        new Head("S'inscrire"),
        new Form("post", "/register", [
                new Input("csrf", "", "hidden", Csrf::token()),
                new Paragraph([
                        new Input("email", "Email", "email"),
                ]),
                new Paragraph([
                        new Input("login", "Login", "text", "" , ["minlength" => 3, "maxlength" => 30, "pattern" => "[a-zA-Z0-9._-]{3,30}"]),
                ]),
                new Paragraph([
                        new Input("password", "Mot de passe", "password"),
                ]),
                new Paragraph([
                        new Input("confirmation", "Confirmation mot de passe", "password"),
                ]),
                new Button("S'inscrire", "action", "inscription", "submit"),
        ])
], $currentPath);
