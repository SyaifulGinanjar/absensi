<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$pesertum->nama}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
            color-adjust: exact !important;                 /* Firefox 48 – 96 */
            print-color-adjust: exact !important;           /* Firefox 97+, Safari 15.4+ */
        }
        body,html{
            margin: 0;
            font-family: 'Montserrat' !important;
        }
        #id-card{
            width: 447px;
            height: 625px;
            background-color: blue;
            background-image: url('/imgs/id-card.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        #id-card #photo{
            width: 180px;
            height: 180px;
            background-color: #ddd;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-size: cover;
            background-position: top;
            margin-top: -15px;
        }
        #id-card #name{
            width: 80%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-top: 130px;
            text-align: center;
            color: #fff;
            text-transform: uppercase;
        }
        #id-card h1{
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 18px;
        }
        #id-card p{
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
        }
        #id-card #qr{
            width: 114px;
            height: 114px;
            background-color: #fff;
            position: absolute;
            bottom: 8px;
            right: 8px;
            padding: 8px;
        }
        @media print {
            .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }
    </style>
</head>
<body>
    <div id="id-card" style="background-image: url('/imgs/{{ $pesertum->angkatan }}.png')">
        @if($pesertum->foto)
            <div id="photo" style="background-image: url('{{ $pesertum->foto->getUrl() }}')">
            
            </div>
        @endif
        
        <div id="name">
            <h1>{{$pesertum->nama}}</h1>
            <p>DPRD {{$pesertum->asal_dprd}}</p>
        </div>
        <div id="qr">
            <img src="/qrcodes/{{$pesertum->uuid}}.svg" style="width: 100%">
        </div>
    </div>
    <div class="pagebreak"></div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        window.print();
    });
</script> -->