<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Survey Results: What is your skin type?</h5>
        </div>
        <div class="card-body">
            <?php foreach($pollData as $data): 
                $perc = ($totalVotes > 0) ? round(($data->vote_count / $totalVotes) * 100) : 0;
            ?>
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span><?= $data->option_text ?></span>
                    <span class="text-muted"><?= $perc ?>% (<?= $data->vote_count ?> votes)</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-primary" role="progressbar" 
                         style="width: <?= $perc ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>