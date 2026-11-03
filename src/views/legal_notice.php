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

use App\View\Layout;
use App\View\Head;
use App\View\Paragraph;
use App\View\Link;
use App\View\Card;
use App\View\Strong;
use App\View\ItemList;

return new Layout($title, $user, [
        new Card([
                new Head("Mentions légales"),
                new Paragraph([
                        new Head("1. Présentation du site et cadre pédagogique", 2),
                        new Paragraph([
                                "Le présent site web est développé dans le cadre de la Situation d'Apprentissage et d'Évaluation (" .
                                new Strong("SAÉ S3") .
                                "de 2e année du Bachelor Universitaire de Technologie" .
                                new Strong("BUT") .
                                "en Informatique à l'IUT d'Aix-Marseille (Aix-Marseille Université)."
                        ])
                ], "mentions-section"),
                new Paragraph([
                        new Head("2. Éditeur et équipe de développement", 2),
                        new Paragraph([ new Strong("Projet :") . " SAÉ S3 — Développement Web côté serveur" ]),
                        new Paragraph([ new Strong("Équipe de réalisation :") . " Hugo BANTI, Timothée BEGHIN, Vladislav DUMONT, Leny ROSSINES, Enrique RUIZ"]),
                        new Paragraph([ new Strong("Directeur de la publication :") . " Enrique RUIZ (représentant de l'équipe étudiante SAÉ S3)"]),
                        new Paragraph([ new Strong("Établissement d'enseignement :") . " IUT d'Aix-Marseille &bull; Département Informatique (Aix-Marseille Université)"]),
                        new Paragraph([ new Strong("Statut :") . " Projet d'études universitaires sans finalité commerciale"])
                ], "mentions-section"),
                new Paragraph([
                        new Head("3. Hébergement", 2),
                        new Paragraph(["Le site est hébergé par la société " . new Strong("ALWAYSDATA")]),
                        new Paragraph([
                                new Strong("ALWAYSDATA") . ", SARL au capital de 200 000 €, RCS Paris 492 893 490",
                                "Siège social : 91 rue du Faubourg Saint-Honoré, 75008 Paris, France",
                                "Site web : " . new Link("www.alwaysdata.com", "https://www.alwaysdata.com", "")
                        ]),
                ], "mentions-section"),
                new Paragraph([
                        new Head("4. Propriété intellectuelle & crédits", 2),
                        new Paragraph(["L'ensemble des contenus, codes sources, architectures et documentations élaborés dans le cadre de ce projet sont la propriété intellectuelle de leurs auteurs respectifs, conformément aux réglementations académiques applicables."]),
                        new Paragraph([ new Strong("Ressources tierces et attributions :")]),
                        new ItemList([
                                "Icônes : créations fournies par " . new Link("Icons8", "https://icons8.com", "") .  "utilisées avec attribution conformément à leurs conditions d'utilisation.",
                                "Typographies : polices système multiplateformes (pile sans-serif système standard)"
                        ])
                ], "mentions-section"),
                new Paragraph([
                        new Head("5. Données personnelles et confidentialité (RGPD)", 2),
                        new Paragraph(["Conformément au Règlement Général sur la Protection des Données (RGPD 2016/679) et à la loi « Informatique et Libertés » modifiée :"]),
                        new ItemList([
                                new Strong("Données collectées :") . " Les adresses e-mail ainsi que les mots de passe nécessaires à la création, à l'accès et à la gestion du compte utilisateur.",
                                new Strong("Finalité du traitement :") . " Gestion exclusive de l'authentification et de l'accès aux fonctionnalités du site réservées aux membres.",
                                new Strong("Durée de conservation :") . " Les données sont conservées strictement pendant la période d'évaluation et de soutenance pédagogique du projet. Aucune donnée n'est cédée, vendue ou transmise à des tiers.",
                                new Strong("Exercice de vos droits :") . " Conformément à la réglementation, vous bénéficiez d'un droit d'accès, de rectification et d'effacement de vos données personnelles sur simple demande auprès des administrateurs du site."
                        ])
                ], "mentions-section"),
                new Paragraph([
                        new Head("6. Cookies et sessions techniques", 2),
                        new Paragraph(["Ce site utilise uniquement des cookies techniques de session (PHP), indispensables au maintien de la connexion utilisateur et au bon fonctionnement de la navigation. Aucun cookie publicitaire, d'analyse d'audience ou traceur tiers n'est utilisé."])
                ], "mentions-section"),
                new Paragraph([
                        new Head("7. Avertissement & limitation de responsabilité", 2),
                        new Paragraph(["Ce site est une réalisation étudiante à vocation strictement académique et expérimentale. L'équipe décline toute responsabilité en cas de dysfonctionnements temporaires, bogues ou interruptions de service liés à l'environnement d'hébergement ou de développement."])
                ], "mentions-section"),
                new Card([new Link("Retour à l'accueil", "/", "btn-secondary")], "card mentions-card"),
        ], "card mentions-card")
], $currentPath)

?>
