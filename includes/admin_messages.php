<div class="mb-4 d-flex justify-content-between align-items-center my-5">
    <div>
        <h3 class="fw-light">Customer Inquiries</h3>
        <p class="text-muted mb-0">List of all messages sent via contact form.</p>
    </div>
    <span class="badge bg-dark rounded-pill px-3">
        <?php 
            $count = $conn->query("SELECT COUNT(*) FROM messages")->fetchColumn();
            echo $count . " Messages Total";
        ?>
    </span>
</div>
<div class="table-responsive bg-white shadow-sm rounded">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Date & Time</th>
                <th>Sender</th>
                <th>Email</th>
                <th>Message Content</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM messages ORDER BY sent_at DESC";
            $messages = $conn->query($query)->fetchAll();

            if(count($messages) > 0):
                foreach($messages as $m):
            ?>
            <tr id="message-row-<?= $m->id ?>">
                <td class="ps-4 text-muted small">
                    <?= date("d/m/Y H:i", strtotime($m->sent_at)) ?>
                </td>
                <td>
                    <span class="fw-bold"><?= htmlspecialchars($m->full_name) ?></span>
                </td>
                <td>
                    <a href="mailto:<?= $m->email ?>" class="text-dark"><?= $m->email ?></a>
                </td>
                <td>
                    <div class="message"
                         title="<?= htmlspecialchars($m->message) ?>">
                        <?= htmlspecialchars($m->message) ?>
                    </div>
                </td>
                <td class="text-end pe-4">
                    <button class="btn btn-sm btn-outline-danger delete-message" data-id="<?= $m->id ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                    <i class="bi bi-envelope-open d-block mb-2 fs-2"></i>
                    No messages found in database.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>