<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>TTS</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            Muốn nghe cái gì nhập đê:<br><br>
            <textarea id="input" name="input" rows="5" cols="40"></textarea>

            <br><br>Tốc độ:
            <select name="speed">
                <option value="1.0">Bình thường</option>
                <option value="0.8">Chậm</option>
                <option value="1.2">Nhanh</option>
            </select><br>

            <br>Giọng:
            <select name="speaker_id">
                <option value="1">Nữ miền Nam</option>
                <option value="2">Nữ miền Bắc</option>
                <option value="3">Nam miền Nam</option>
                <option value="4">Nam miền Bắc</option>
            </select>
            <br><br>

            <button type="submit">OK</button>
        </form>
    </div>
    <!-- apikey:"nJPzQor3aPBoBvHPskwPPqAlFZXLtV2E" -->
    <!-- Chào mọi người, hôm nay trời mưa to quá -->
    <!-- Xin chào, hôm nay là ngày 19/4/2021 -->
    <?php
    if (isset($_POST["input"]) && $_POST["input"] != "") {
        $input = $_POST["input"];
        $speed = $_POST["speed"];
        $speaker_id = $_POST["speaker_id"];

        $url = 'https://api.zalo.ai/v1/tts/synthesize';

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
                'input' => $input,
                'speed' => $speed,
                'speaker_id' => $speaker_id
            )),
            CURLOPT_HTTPHEADER => array('apikey:nJPzQor3aPBoBvHPskwPPqAlFZXLtV2E'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        } else {
            $decoded = json_decode($response);
            $result = $decoded->data->url;
                        echo '<div class="container">
                <audio controls="controls">
                    <source src="' . $result . '" type="audio/mpeg">
                </audio>
            </div>';
        }

        curl_close($ch);
    }
    ?>
</body>

</html>
