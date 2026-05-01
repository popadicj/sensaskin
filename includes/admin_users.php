<?php

$query = "SELECT id_user, first_name, last_name, email, role_name 
          FROM users u 
          JOIN roles r ON u.role_id = r.id_role";
$users = $conn->query($query)->fetchAll();
?>

<div class="container-fluid pt-4">
    <h2 class="mb-4">👥 User List</h2>
    <div class="table-responsive bg-white shadow-sm p-3">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $u): ?>
                <tr>
                    <td>#<?= $u->id_user ?></td>
                    <td><?= $u->first_name . " " . $u->last_name ?></td>
                    <td><?= $u->email ?></td>
                    <td>
                        <span class="badge <?= $u->role_name == 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                            <?= $u->role_name ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger border-0 btn-delete-user" 
                                data-id="<?= $u->id_user ?>">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>