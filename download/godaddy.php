<?php
    $domain=$_GET["domain"];
    $keys=[
        "dLiW4LvErgT2_ASQ9L1jeKNDy6Lk5jHzLK7:ASQBRcugdLSdM6rRZhZ3KK",
        "dLiW4LvGJf4w_VnvyfMRRFxXWeHrG1LNnef:Vnw2imKohNwYRfJCNJCuEj",
        "dLiW4LvGKKeh_TGNE9a1fWCRwxs6nGnCVde:TGNHDpDznCzogMzysBcbhv",
        "dLiW4LvGKfWg_K3PNsVCoxGq7H6wcmqhfvM:K3PSBtgDUHz1rnYHJk5dG9",
        "dLiW4LvGM1Hh_Guj6JeaGAHDbqvZpeGxHLQ:Guj9KZYp5wB9pueyJv2RTr",
        "dLiW4LvHmyEd_MLD6hesZfvnLH6hW1UKa64:MLD9pQ1jThofnyxVJCVecx",
        "dLiW4M2eyF1J_EYWhhA51PLDnUa7dp55N77:EYWjsm6iiqMQL6wZ38A22Z",
        "dLiW4M2eyaV6_Lddnp2HpcLNWcydfDV2mNq:LddrL66TrbezGTZzzZcbXX",
        "dLiW4M2eyutd_SPPEgABPdvnJ9ugMbSg7Vo:SPPJSPF78CepfaKAK2Dnv1",
        "dLiW4M2gQsmD_X5dKgkAAbHjmbf5x3yXxcv:X5dNAqgjXA4k3tRP9HvRki",
        "dLiW4M2gQsmD_2ENKeQbjPbUiLUb1xzVooo:2ENMQ2M5bS3YC9q4Eozj93",
        "dLiW4M2gRYCE_8MXc9VhSfHucazwzJ7QkPj:8MXfytJtLWYGmJr7AttPEy",
        "dLiW4M2gRsq1_Div3ac3ButBQrpSeZakzHZ:Div7Xf8CHp2gW9xsHtvZ2T",
        "dLiW4M2gSDh2_MXts1L3AaqKBaohWyvQbaX:MXtuNm6AozRYa1QrDi78pf",
        "dLiW4M2gSZKk_Sq3opKqAzPM3gWZL5UBmpS:Sq3ryZuBHvprznB74X7pox",
        "dLiW4M2gTDbv_4nsrwb6H5BofMqJd8nJqcZ:4nsty2ibCDGBwx9eoywbBj",
        "dLiW4M2gTZ5q_BuCeZYvRBMyLaFC6DBLUpe:BuCgKzyiDngzN3tPiSRPe6",
        "dLiW4M2gTZcf_JcT4Qan4gUEg5JKnCKzPzK:JcT6SriKe5r2bYd56yD93h",
        "dLiW4M2gTu6d_SCpBrpRmtmVFR6xBPLaUei:SCpEb5DR4eQGjWz5R9vo42",
        "dLiW4M2hts3a_268GSdkFsQMNcEcasbpUry:268K7ZJ7gvf6C8qRyepqKT",
        "dLiW4M2huCgH_8PQMVdQcrsqktUYFxoJt5F:8PQQ842eAdgzfzQKNXZG57",
        "dLiW4M2huXrd_EMZHyubyhgMoQLnKfHq51x:EMZLy9xdxA1hX4xws3jEAz",
        "dLiW4M2hus7D_M8coG3QGGv97YfLQcHB2yT:M8dBWEfow1sG9hjCabyKHw",
        "dLiW4M2husZk_STBPzywsRQgJiiY1ee24Ux:STBTTiWjKKMUdgfJVxFvgp",
        "dLiW4M2hvCyM_2v9iZYNADG5KG1H5TYgF86:2v9n1Sd5GabfEqx75RL7qk",
        "dLiW4M2hvYE3_9BhBGNWm5TyH8xvKeBE9J5:9BhEyGLhDPEVv7k5RzRrmT",
        "dLiW4M2hwYty_Ns8JTnw6hu9AxpoJg4Q5c9:Ns8LTZwX9kJ3ggjotNrrCu",
        "dLiW4M2jPBjV_Tzvzq9PeZdpsPs6zUpdEhx:Tzw3W4wWPA8aymKqasdbAS",
        "dLiW4M2jPX8s_4bDxMemmkqb83XfJzs5XX4:4bDzVkseaaGG6g8SXbQCyt",
        "dLiW4M2jPrYQ_BAU37huoWuyjKzD2dRdScH:BAU6HnHkf3cNaPH4qv9V61",
        "dLiW4M2jQBwu_KhTpzzELahugDmCPFL5Twt:KhTszEazqBZaLVP1T5yd6v",
        "dLiW5qgH7zg7_MkxKsNa6jsHLZcayJcKnwR:MkxNqncp9knQkDKLGvdxcF",
        "dLiW5qgH8KrV_Sh9LCbWt2Bcy6gFtpyZAtd:Sh9P7gKp5iWjYmBCsXXNcd",
        "dLiW5qgH8LEU_WiVQHbypaCdXzTmppYoert:WiVTX1bZ4gsUyNeuxoffHS",
        "dLiW5qgH8fe7_7zcnCY5mbvgWgMqU5JhYhX:7zcos9ySnELNwGMvxUgX7X",
        "dLiW5qgH8ztf_CoqFYKFz9ESygh318VfmBp:CoqJFjjgUXDB4ycdvsS66v",
        "dLiW5qgH91CT_HW31r72B7MxHtZ9FBMmtoM:HW379TC4Ee7FFyE9h92dFh",
        "dLiW5qgH9LNj_A3d3bdV1nLZSvyqQVJFZrb:A3dcQrUS1pHrQbVV2JPL7M",
        "dLiW5qgJbK57_TJWywXk3QQvyq2WwSmThNq:TJX2FdZGHDS35iRDknpGg9",
        "dLiW5qgJbeQ9_3w7rwZEDviNqMUVgqquwRT:3w7uzy8cN8ns8qwdCok41X",
        "dLiW5qgJcKDD_EF292LmfMrFbsMTEQsPiKu:EF2BEcRGNXgsb9Bg6oeMDm",
        "dLiW5qgJcePS_Ld31KpJmR2H4uEntcLrNyE:Ld338mHtyDTCVRqyovhGFJ",
        "dLiW5qgJcyo4_SWQQeD6Y8uatAQkmmowZos:SWQSuoyvVwdTciJGPWYAeZ",
        "dLiW5qgJczQF_XYfHuHJuznhgSh3WXimwjg:XYfNUz1XEdFK9gVHTSj7sg",
        "dLiW5qgJdKWG_3nSF7snr4qPrtC6vzFm38Z:3nSJQceMugF7bco54Gy1Vw",
        "dLiW5qgL4Hkk_EURdSr9H4d2NsvnPXZr9Bb:EURfE8WWwdtrbrvxGGX3VF",
        "dLiW5qgL4xR4_UYHWS3wR6P5ZpFWRXjPcdq:UYHZ7ooDkVY7LHBXsDyxaX",
        "dLiW5qgL5HyQ_3zaYqKutiD8VDGBunMWNoL:3zacpsvjbuSEez4vCzRuzr",
        "dLiW5qgL5d9c_8aqvrSrL6KjtT9WZnZoBnu:8aqz4BrAudgBZoV8TwVDF3",
        "dLiW5qgL5dXf_CeSqQcgwZfWXCqmrF2grQm:CeSss3bcpMXqnpCksTuLa9",
        "dLiW5qgL5xwE_JX3b9QNHwF8DqS3uDvMrSJ:JX3dqAE6bMamMTj1ZQxCNz",
        "dLiW5qgL6JGH_ReChYWjRTWFAL7TepAExfw:ReCkrvCpyXQ4uo4KM4cv1j",
        "dLiW5qgL6Jir_WuUp2BnntzgXBoSXVg4bgt:WuUqq8mvTBremzVchFuUxx",
        "dLiW5qgL6dyS_4JkfKaWiaQMNttQEoroNBg:4Jkhcr1zcchcDSrFtSZwzn",
        "dLiW5qgL6yXr_CiAv2aCUybsnUrudP4ioRp:CiAxK1PpBE5BsHuPECuPki",
        "dLiW5qgL7K67_Kcoh9SBmWZXhveskxKDvU4:Kcom3zLwNivVmc3BzJdWkL",
        "dLiW5qgMYGf2_R4FuBhCbRsB6WjaWmprMhw:R4Fydu7h8QMHpZwvcaXcU5",
        "dLiW5qgMYbzB_3HWERhVYpeSH4ZieUa2djG:3HWGT97rwftoegZg9mfPJS",
        "dLiW5qgMYx9p_7EoY444ei8FNwB7d8aeUCM:7EoZc1UmBigdj41zADwWih",
        "dLiW5qgMZcRx_E8SW9aN13N2Esj5XSZBdQd:E8SYrAXkY4dcKtCu1VMxqX",
        "dLiW5qgMZd7f_MtT8PtBEpqKvoYywPW4kTJ:MtTCeRm6o8NZ3b1fz5Y8QY",
    ];
    $ch = curl_init();
    $url = "https://api.godaddy.com/v1/domains/available?domain=".$domain."&checkType=FAST&forTransfer=false";
    $header=[
        'accept: application/json',
        'Authorization: sso-key '.$keys[mt_rand(0,60)],
    ];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
//    echo $output;
    curl_close($ch);
    $res=0;
    $data=json_decode($output,true);
//    var_dump($data);
    if($data["available"]==false){
        $res=0;
    }elseif ($data["available"]==true){
        $res=1;
    }
    echo $res;
