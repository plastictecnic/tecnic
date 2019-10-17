<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        @yield('title')
    </title>

    {{-- reset css --}}
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        div.header {
            display: block;
            position: running(header);
        }
        div.footer {
            display: block; text-align: center;
            position: running(footer);
        }
        @page {
            @top-center { content: element(header) }
        }
        @page {
            @bottom-center { content: element(footer) }
        }
        /* header{
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
        footer{
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        } */
        .address{


        }
        .address p{
            padding: 0px;
            margin: 0px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <section class="p-4">
        <div class="header">
            <table style="width:100%;">
                <tr>
                    <td style="width:60px; vertical-align: middle;">
                        <img width="50px" style="display:inline;" src="{{ asset('images/logo.png') }}" alt="Plastictecnic (M) Sdn. Bhd.">
                    </td>

                    <td colspan="3">
                        <div class="mt-2">
                            <p style="display:inline;"><strong>PLASTICTECNIC (M) SDN BHD - <small>REG: 197601004542 (30481-V)</small></strong></p>
                        </div>
                    </td>

                    <td style="text-align:right; width:110px; vertical-align: middle;">
                        <img width="50px" src="{{ asset('images/iso.png') }}" alt="Plastictecnic (M) Sdn. Bhd.">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="address">
                            <p>Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1, Peti Surat 30,</p>
                            <p>43650 Bandar Baru Bangi, Selangor Darul Ehsan, Malaysia</p>
                            <p>Tel: (6) 03-8925 6950 (8 lines) Fax: (6) 03-8925 6955</p>
                            <p>www.plastictecnic.com</p>
                        </div>
                    </td>
                    <td>
                        <div class="address">
                            <p>Lot 1804 Jalan Lengkok Emas, Kawasan Perindustrian Nilai</p>
                            <p>71800 Nilai, Negeri Sembilan, Malaysia</p>
                            <p>Tel: (6) 06-799 0010 Fax: (6) 06-799 0016</p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <hr>
        </div>

        @yield('content')

        <div class="footer">
            
        </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
