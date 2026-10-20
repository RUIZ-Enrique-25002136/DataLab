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
use App\View\Paragraph;
use App\View\Link;
use App\Core\Csrf;
use App\View\Button;

if ($success) {
    return new Layout($title, $user, [
                new Paragraph('Mot de passe réinitialisé'),
                new Link('Vous Connecter', '/login', 'btn btn-primary')
            ], $currentPath);
} else {

    foreach ($errors as $error):
        //<ul><li><?= htmlspecialchars($error)</li></ul>
    endforeach;

    if ($isTokenValid) {
        return new Layout($title, $user, [
                new Form('post', '/reset-password', [
                        new Input('csrf', '', 'hidden', htmlspecialchars((Csrf::token()))),
                        new Input('token', '', 'hidden', htmlspecialchars(($token))),
                        new Paragraph([new Input('password', 'Nouveau mot de passe', 'password', "", ["required"])]),
                        new Paragraph([new Input('confirmation', 'Confirmation', 'password', "", ["required"])]),
                        new Button('Réinitialiser', '', '')
                ])
        ], $currentPath);
    } else {
        return new Layout($title, $user, [
                new Paragraph('Lien ivalide')
        ], $currentPath);
    }
}
?>