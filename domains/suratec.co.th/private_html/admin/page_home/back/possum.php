<?php
if (isset($_GET['pos'])) {
    require('../../library/connect.php');
    $date = new DateTime();
    $dates = [];
    $labels = [];
    for ($i = 1; $i < 30; $i++) {
        $labels[] = $date->format('d-m-Y');
        $dates[] = $date->format('Y-m-d');
        $date = $date->modify('-1 day');
    }

    $dateSet = [];
    $cmd = "SELECT sum(transaction_wholesale_price) as total FROM mod_pos_transaction WHERE DATE(created_at) = DATE(?)";
    foreach ($dates as $d) {
        $stmt = $objConnect->prepare($cmd);
        if ($stmt->bind_param('s', $d)) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                //var_dump($d);
                if ($result->num_rows != 0) {
                    $total = $result->fetch_assoc()['total'];
                    $data = ['date'=> $d, 'value' => $total == null ? 0:$total];
                } else {
                    $data = ['date'=> $d, 'value' => 0];
                }
                $dateSet[] = $data;

            }
        }
    }

    $output = [
        'labels' => $labels,
        'datasets' => [
            'label' => 'POS',
            'data' => $dateSet
        ]
    ];

    echo json_encode($dateSet);
}