<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะ COVID-19 ในประเทศไทย</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chonburi&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: normal;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f4f6;
        }

        .container {
            max-width: 600px;
            padding: 25px 100px 20px 100px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .stat {
            margin: 10px 0;
            font-size: 18px;
        }

        .stat strong {
            font-size: 24px;
            color: #e74c3c;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1> สถานการณ์ COVID-19 ในประเทศไทย </h1>
        <?php
        $url = "https://covid19.ddc.moph.go.th/api/Cases/today-cases-all";

        // ดึงข้อมูลจาก API โดยใช้ file_get_contents()
        $response = file_get_contents($url);

        if ($response !== false) {
            // แปลงข้อมูล JSON เป็น Array ใน PHP
            $data = json_decode($response, true);

            // ตรวจสอบว่าการแปลง JSON สำเร็จหรือไม่
            if (!is_null($data) && count($data) > 0) {
                $update_date = $data[0]['update_date']; // วันที่
                $newCases = $data[0]['new_case']; // จำนวนผู้ป่วยรายใหม่
                $totalCases = $data[0]['total_case']; // จำนวนผู้ป่วยสะสม
                $total_recovered = $data[0]['total_recovered']; // จำนวนการรักษา
                $new_death = $data[0]['new_death']; // จำนวนผู้เสียชีวิตรายใหม่
                $totalDeaths = $data[0]['total_death']; // จำนวนผู้เสียชีวิตสะสม
        ?>

                <div class="stat">วันที่: <strong><?php echo $update_date; ?></strong></div>
                <div class="stat">ผู้ป่วยรายใหม่: <strong><?php echo number_format($newCases); ?></strong></div>
                <div class="stat">ผู้ป่วยสะสม: <strong><?php echo number_format($totalCases); ?></strong></div>
                <div class="stat">ผู้เสียชีวิตรายใหม่: <strong><?php echo number_format($new_death); ?></strong></div>
                <div class="stat">ผู้เสียชีวิตสะสม: <strong><?php echo number_format($totalDeaths); ?></strong></div>

        <?php
            } else {
                echo "<p>เกิดข้อผิดพลาดในการดึงข้อมูลจาก API</p>";
            }
        } else {
            echo "<p>ไม่สามารถเชื่อมต่อกับ API ได้</p>";
        }
        ?>
        <div class="footer">
            *ข้อมูลจากกระทรวงสาธารณสุข* <br>
            @sk4let
        </div>
    </div>

</body>

</html>