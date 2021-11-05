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
    $cmd = "SELECT COUNT(DISTINCT `id_device`) AS totall FROM `surasole` WHERE DATE_FORMAT(`action`,'%Y-%m-%d')  = DATE(?)";
    foreach ($dates as $d) {
        $stmt = $objConnect->prepare($cmd);
        if ($stmt->bind_param('s', $d)) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
               // var_dump($d);
                if ($result->num_rows != 0) {
                    $total = $result->fetch_assoc()['totall'];
                    $data = ['date'=> $d, 'value' => $total == null ? 0:$total];
                } else {
                    $data = ['date'=> $d, 'value' => 0];
                }
                $dateSet[] = $data;

            }
        }
    }

    // $output = [
    //     'labels' => $labels,
    //     'datasets' => [
    //         'label' => 'ORDER',
    //         'data' => $dateSet
    //     ]
    // ];


    $output = [
        'labels' => $labels,
        'datasets' => [
            'label' => 'ยอดการใช้งาน',
            'data' => $dateSet
        ]
    ];

     echo json_encode($dateSet);
}