
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
use App\View\Meta;
use App\View\Button;

if ($success) {
    return new Layout($title, $user, [
            new Paragraph(["Connexion réussie. Redirection..."], "success-message"),
            new Meta("refresh", "", "", "1;url=/"),
            new Paragraph([
                    new Link("Cliquez ici si vous n'êtes pas redirigé", "/", "btn btn-primary")
            ])
    ], $currentPath);
} else {
    if (!empty($error)) {
        foreach ($errors as $error) {
            echo '<ul><li>' . htmlspecialchars($error) . '</li></ul>';
        }
    }
}

return new Layout($title, $user, [
        new Head("Connexion"),
        new Form("post", "/login", [
                new Input("csrf", "", "hidden" , Csrf::token()),
                new Paragraph([
                        new Input("email", "Email", "email"),
                ]),
                new Paragraph([
                        new Input("password", "Mot de passe", "password"),
                ]),
                new Link("Mot de passe oublié ?", "/forgot-password", "btn btn-primary"),
                new Button("Se connecter", "action", "connexion", "submit"),
        ])
], $currentPath);
