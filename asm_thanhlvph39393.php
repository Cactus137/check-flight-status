<?php 
    $flight_information = [
        [
            "so_hieu_chuyen_bay" => "VN330",
            "noi_di" => "Ha Noi",
            "noi_den" => "TP Ho Chi Minh",
            "tong_hanh_khach" => 500,
            "thoi_gian_di" => "2023-07-22 05:00:00",
            "thoi_gian_den" => "2023-07-22 10:00:00"
        ],
        [
            "so_hieu_chuyen_bay" => "VJ120",
            "noi_di" => "Hue",
            "noi_den" => "Da Nang",
            "tong_hanh_khach" => 200,
            "thoi_gian_di" => "2023-09-15 07:00:00",
            "thoi_gian_den" => "2023-09-15 12:00:00"
        ],
        [
            "so_hieu_chuyen_bay" => "VN330",
            "noi_di" => "Ha Noi",
            "noi_den" => "New York",
            "tong_hanh_khach" => 160,
            "thoi_gian_di" => "2023-07-22 20:00:00",
            "thoi_gian_den" => "2023-07-22 22:00:00"
        ],
        [
            "so_hieu_chuyen_bay" => "VN330",
            "noi_di" => "Da Lat",
            "noi_den" => "Bintulu",
            "tong_hanh_khach" => 2000,
            "thoi_gian_di" => "2023-07-23 08:00:00",
            "thoi_gian_den" => "2023-07-23 14:00:00"
        ],
        [
            "so_hieu_chuyen_bay" => "VN330",
            "noi_di" => "Ha Noi",
            "noi_den" => "Da Lat",
            "tong_hanh_khach" => 300,
            "thoi_gian_di" => "2023-07-31 14:00:00",
            "thoi_gian_den" => "2023-07-31 17:20:00"
        ],
        [
            "so_hieu_chuyen_bay" => "VN330",
            "noi_di" => "Ha Noi",
            "noi_den" => "Lao",
            "tong_hanh_khach" => 200,
            "thoi_gian_di" => "2023-07-16 17:00:00",
            "thoi_gian_den" => "2023-07-16 19:45:00"
        ],
        [
            "so_hieu_chuyen_bay" => "VN330",
            "noi_di" => "Hue",
            "noi_den" => "TP Ho Chi Minh",
            "tong_hanh_khach" => 170,
            "thoi_gian_di" => "2023-07-23 06:15:00",
            "thoi_gian_den" => "2023-07-23 10:15:00"
        ],
        [
            "so_hieu_chuyen_bay" => "US938",
            "noi_di" => "Hai Phong",
            "noi_den" => "England",
            "tong_hanh_khach" => 1200,
            "thoi_gian_di" => "2023-07-23 05:00:00",
            "thoi_gian_den" => "2023-07-23 09:00:00"
        ],
        [
            "so_hieu_chuyen_bay" => "GM202",
            "noi_di" => "TP Ho Chi Minh",
            "noi_den" => "Berlin",
            "tong_hanh_khach" => 300,
            "thoi_gian_di" => "2023-07-24 20:15:00",
            "thoi_gian_den" => "2023-08-24 23:20:00"
        ],
        [
            "so_hieu_chuyen_bay" => "LJ163",
            "noi_di" => "Ha Noi",
            "noi_den" => "ToKyo",
            "tong_hanh_khach" => 550,
            "thoi_gian_di" => "2023-07-24 09:40:00",
            "thoi_gian_den" => "2023-07-24 22:20:00"
        ]
    ];  

    $check_value = false;
    $arr_shcb = [];
    if (isset($_GET['search_so_hieu_chuyen_bay']) && isset($_GET['search_thoi_gian_di']) && isset($_GET['search_thoi_gian_di'])){
        $search_so_hieu_chuyen_bay = $_GET['search_so_hieu_chuyen_bay'];
        $search_thoi_gian_di = date('Y-m-d H:i:s', strtotime($_GET['search_thoi_gian_di']));
        $search_thoi_gian_den = date('Y-m-d H:i:s', strtotime($_GET['search_thoi_gian_den']));

        foreach($flight_information as $value){
            $shcb = $value['so_hieu_chuyen_bay'];
            $time_di = date('Y-m-d H:i:s', strtotime($value['thoi_gian_di']));
            $time_den = date('Y-m-d H:i:s', strtotime($value['thoi_gian_den']));
            if(($shcb === $search_so_hieu_chuyen_bay) || ($search_thoi_gian_di <= $time_di && $time_den <= $search_thoi_gian_den)){
                $arr_shcb[] = $value; 
            } 
        }   
        $check_value = true;    
    }
    
    function trang_thai($time_di, $time_den, $dateNow){
        $trang_thai = null;
        if(($time_di < $dateNow) && ($dateNow < $time_den)){
            $trang_thai = "Đang bay";
        }else
        if($time_di > $dateNow ){
            $trang_thai = "Chưa bay";
        }else
        if($time_di < $dateNow){
            $trang_thai = "Đã bay";
        }else {}
        return $trang_thai;
    }

    function style_trang_thai($trang_thai){
        $style = null;
        if($trang_thai == "Chưa bay"){
            $style = "background-color: #0a7fa9 ; color: white";
        }
        if($trang_thai == "Đã bay"){
            $style = "background-color: red ; font-weight: bold";
        }
        if($trang_thai == "Đang bay"){
            $style = "background-color: yellow";
        }
        return $style;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tra cuu chuyen bay</title>
    </head>
    <style>
        table, th, td {
            border:1px solid black; 
            border-collapse: collapse;
            text-align: center;
            padding: 2px 15px;
        }   
        input{
            margin: 3px 20px 3px 0;
        }
        button{
            margin: 7px 0;
        }
        label{
            width: 200px;
        }
    </style>
    <body>
        <form action="" method="get">
            <label for="search_so_hieu_chuyen_bay">Số hiệu chuyến bay:</label>
            <input type="text" name="search_so_hieu_chuyen_bay">

            <label for="search_thoi_gian_di">Thời gian đi:</label>
            <input type="text" name="search_thoi_gian_di">

            <label for="search_thoi_gian_den">Thời gian đến:</label>
            <input type="text" name="search_thoi_gian_den"><br>

            <button type="submit">Tìm kiếm</button>
        </form>

        <?php if ($check_value): ?>        
            <table>
                <thead>
                    <tr>
                        <th>Số hiệu chuyến bay</th>
                        <th>Thời gian đi</th>
                        <th>Thời gian đến</th>
                        <th>Nơi đi</th>
                        <th>Nơi đến</th>
                        <th>Tổng số hành khách</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr_shcb as $key => $inf):
                        $so_hieu = $inf['so_hieu_chuyen_bay'];
                        $time_di = date('Y-m-d H:i:s', strtotime($inf['thoi_gian_di']));
                        $time_den = date('Y-m-d H:i:s', strtotime($inf['thoi_gian_den']));
                        $noi_di = $inf['noi_di'];
                        $noi_den = $inf['noi_den'];
                        $tong_hanh_khach = $inf['tong_hanh_khach'];
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $dateNow = date('Y-m-d H:i:s');
                        
                        $trang_thai = trang_thai($time_di, $time_den, $dateNow);
                        $style_trang_thai = style_trang_thai($trang_thai);  
                    ?>
                    <tr style="<?php echo $style_trang_thai; ?>">
                        <td><?php echo $so_hieu?></td>
                        <td><?php echo $time_di?></td>
                        <td><?php echo $time_den?></td>
                        <td><?php echo $noi_di?></td>
                        <td><?php echo $noi_den?></td>
                        <td><?php echo $tong_hanh_khach?></td>
                        <td>
                            <?php 
                                echo $dateNow;
                            ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Số hiệu chuyến bay</th>
                        <th>Thời gian đi</th>
                        <th>Thời gian đến</th>
                        <th>Nơi đi</th>
                        <th>Nơi đến</th>
                        <th>Tổng số hành khách</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($flight_information as $key => $inf):
                        $so_hieu = $inf['so_hieu_chuyen_bay'];
                        $time_di = date('Y-m-d H:i:s', strtotime($inf['thoi_gian_di']));
                        $time_den = date('Y-m-d H:i:s', strtotime($inf['thoi_gian_den']));
                        $noi_di = $inf['noi_di'];
                        $noi_den = $inf['noi_den'];
                        $tong_hanh_khach = $inf['tong_hanh_khach']; 
                    ?>
                    <tr>
                        <td><?php echo $so_hieu?></td>
                        <td><?php echo $time_di?></td>
                        <td><?php echo $time_den?></td>
                        <td><?php echo $noi_di?></td>
                        <td><?php echo $noi_den?></td>
                        <td><?php echo $tong_hanh_khach?></td> 
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </body>
</html>