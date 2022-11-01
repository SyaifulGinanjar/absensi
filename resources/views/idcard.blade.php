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
            height: 659px;
            background-color: blue;
            background-image: url('/imgs/id-card.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        #id-card #photo{
            width: 175px;
            height: 175px;
            background-color: #ddd;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -48%);
            background-size: cover;
            background-position: top;
        }
        #id-card #name{
            width: 80%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-top: 150px;
            text-align: center;
            color: #fff;
            text-transform: uppercase;
        }
        #id-card h1{
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 20px;
        }
        #id-card p{
            margin-top: 0;
            margin-bottom: 0;
            font-size: 15px;
        }
        #id-card #qr{
            width: 116px;
            height: 116px;
            background-color: #fff;
            position: absolute;
            bottom: 8px;
            right: 7px;
            padding: 4px;
        }
    </style>
</head>
<body>
    <div id="id-card">
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
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        window.print();
    });
</script>