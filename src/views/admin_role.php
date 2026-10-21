<?php
/**
 * @var \App\Models\User[] $members
 * @var int                $page
 * @var int                $pages
 * @var int                $total
 * @var string[]           $errors
 * @var bool               $success
 */
use App\Core\Csrf;
?>
<div class="card members-card">
    <h1>Gestion des rôles</h1>
    <p class="members-count"><?= $total ?> membre<?= $total > 1 ? 's' : '' ?> inscrit<?= $total > 1 ? 's' : '' ?>.</p>

    <?php if ($success): ?>
        <div class="alert alert-success">Le rôle a été mis à jour.</div>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($members === []): ?>
        <p class="members-empty">Aucun membre pour le moment.</p>
    <?php else: ?>
        <table class="members-table">
            <thead>
                <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td class="member-login"><?= htmlspecialchars($member->login ?? 'Membre n°' . $member->id) ?></td>
                        <td><?= htmlspecialchars($member->email) ?></td>
                        <td>
                            <form method="post" action="/adminRole?page=<?= $page ?>" class="admin-role-form">
                                <input type="hidden" name="csrf" value="<?= htmlspecialchars(Csrf::token()) ?>">
                                <input type="hidden" name="user_id" value="<?= $member->id ?>">
                                <select name="role" aria-label="Rôle de <?= htmlspecialchars($member->login ?? $member->email) ?>">
                                    <option value="1" <?= $member->role === 1 ? 'selected' : '' ?>>Élève</option>
                                    <option value="2" <?= $member->role === 2 ? 'selected' : '' ?>>Professeur</option>
                                    <option value="3" <?= $member->role === 3 ? 'selected' : '' ?>>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($pages > 1): ?>
        <nav aria-label="Pagination">
            <?php if ($page > 1): ?>
                <a href="/adminRole?page=<?= $page - 1 ?>" class="btn btn-secondary btn-sm">« Précédent</a>
            <?php endif; ?>
            <span class="pagination-info">Page <?= $page ?> sur <?= $pages ?></span>
            <?php if ($page < $pages): ?>
                <a href="/adminRole?page=<?= $page + 1 ?>" class="btn btn-secondary btn-sm">Suivant »</a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>
</div>
