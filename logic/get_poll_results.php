<?php
$query = "SELECT o.option_text, COUNT(r.id_result) AS vote_count 
          FROM survey_options o 
          LEFT JOIN survey_results r ON o.id_option = r.option_id 
          WHERE o.survey_id = 1 
          GROUP BY o.id_option";

$res = $conn->query($query);
$pollData = $res->fetchAll();

$totalVotes = 0;
foreach($pollData as $row) {
    $totalVotes += $row->vote_count;
}
?>