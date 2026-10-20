<?php

/**
 * @var string $title
 * @var array{id: int, email: string}|null $user
 * @var bool $success
 * @var string $currentPath
 */

    use App\View\Layout;
    use App\View\Link;
    use App\View\Paragraph;
    use App\View\Head;

    if ($success):
        return new Layout($title, $user, [
            new Head('Email vérifié'),
            new Paragraph('Votre adresse est confirmée, vous pouvez maintenant vous connecter.'),
            new Link("Se connecter", '/login', 'btn btn-primary')]
        , $currentPath);
    else :
        return new Layout($title, $user, [
                new Head('Lien invalide'),
                new Paragraph('Ce lien de confirmation est invalide ou a déjà été utilisé.'),
                new Link("Retour a l'acceuil", '/', 'btn btn-primary')]
        , $currentPath);
    endif;