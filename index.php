<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>TTS</title>
    <script src="scripts.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            Chuyển ký tự thành giọng nói sử dụng Zalo AI
            <br><br>
            <textarea id="input" name="input" rows="5" cols="40"><?php if (isset($_POST['input'])) echo $_POST['input']; ?>
            </textarea>

            <br><br>Tốc độ:
            <select name="speed">
                <option value="1.0" <?php if (isset($_POST['speed']) && ($_POST['speed'] == 1.0)) echo "selected='selected'"; ?>>Bình thường</option>
                <option value="0.8" <?php if (isset($_POST['speed']) && ($_POST['speed'] == 0.8)) echo "selected='selected'"; ?>>Chậm</option>
                <option value="1.2" <?php if (isset($_POST['speed']) && ($_POST['speed'] == 1.2)) echo "selected='selected'"; ?>>Nhanh</option>
            </select>
            <br>

            <br>
            Giọng:
            <select name="speaker_id">
                <option value="1" <?php if (isset($_POST['speaker_id']) && ($_POST['speaker_id'] == 1)) echo "selected='selected'"; ?>>Nữ miền Nam</option>
                <option value="2" <?php if (isset($_POST['speaker_id']) && ($_POST['speaker_id'] == 2)) echo "selected='selected'"; ?>>Nữ miền Bắc</option>
                <option value="3" <?php if (isset($_POST['speaker_id']) && ($_POST['speaker_id'] == 3)) echo "selected='selected'"; ?>>Nam miền Nam</option>
                <option value="4" <?php if (isset($_POST['speaker_id']) && ($_POST['speaker_id'] == 4)) echo "selected='selected'"; ?>>Nam miền Bắc</option>
            </select>
            <br>
            <br>

            Encode Type:
            <select name="encode_type">
                <option value="0" <?php if (isset($_POST['encode_type']) && ($_POST['encode_type'] == 0)) echo "selected='selected'"; ?>>WAV</option>
                <option value="1" <?php if (isset($_POST['encode_type']) && ($_POST['encode_type'] == 1)) echo "selected='selected'"; ?>>MP3</option>
                <option value="2" <?php if (isset($_POST['encode_type']) && ($_POST['encode_type'] == 2)) echo "selected='selected'"; ?>>AAC</option>
            </select>
            <br><br>

            <button type="submit">Chuyển đổi</button>&nbsp;&nbsp;
            <input type="button" onclick="change()" value="Mẫu">
        </form>
    </div>

    <?php
    if ((isset($_POST["input"])) && ($_POST["input"] != "")) {
        $input = $_POST["input"];
        $speed = $_POST["speed"];
        $speaker_id = $_POST["speaker_id"];
        $encode_type = $_POST["encode_type"];

        $url = 'https://api.zalo.ai/v1/tts/synthesize';

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
                'input' => $input,
                'speed' => $speed,
                'speaker_id' => $speaker_id,
                'encode_type' => $encode_type
            )),
            CURLOPT_HTTPHEADER => array('apikey:nJPzQor3aPBoBvHPskwPPqAlFZXLtV2E'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($ch);

        if ($error = curl_error($ch)) {
            echo $error;
        } else {
            $decoded = json_decode($response);
            $result = $decoded->data->url;
            echo '<br><br><div class="container">
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