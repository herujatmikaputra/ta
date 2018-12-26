<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Kartu Member</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css') }}">
    <style>
        .borders{
            border: 2px solid black;
        }
    </style>

</head>

<body>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content">
            <table>
                <tr>
                    <td rowspan="2"><img src="{!! asset('member/'.$member->id.'.png') !!}"></td>
                    <td class="text-center"><h3>KARTU MEMBER</h3></td>
                </tr>
                <tr>
                    <td class="text-center"><h4>GARUDA FUTSAL</h4></td>
                </tr>
                <tr>
                    <td style="padding-left: 10px">Nama</td>
                    <td style="padding-left: 10px">{!! $member->user->name !!}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px">Tanggal Lahir</td>
                    <td style="padding-left: 10px">{!! $member->tanggal_lahir->format('d-m-Y') !!}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px">Nomor HP</td>
                    <td style="padding-left: 10px">{!! $member->no_hp !!}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px">Tipe</td>
                    <td style="padding-left: 10px">{!! config('variable.tipe_member')[$member->tipe] !!}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px">Masa Berlaku</td>
                    <td style="padding-left: 10px">{!! $member->masa_berlaku->format('d-m-Y') !!}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jquery.min.js') }}"></script>
<script src="{{asset('js/bootstrap.min.js') }}"></script>
<script>
    window.print();
</script>
</body>
</html>