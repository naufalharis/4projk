<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            border: 2px solid black;
        }
        h1{
            text-align: center;
        }
        .kuning{
            background-color: yellow;
        }
        .hijau{
            background-color: green;
        }
        .biru{
            background-color: blue;
        }
        .sejajar{
            margin-left: 30px;
            display: flex;
        }
        .output{
            margin-top: 100px;
            width: 100%;
        }
        .dataksg{
            margin-top: 10px;
            font-size: 50px;
            text-align: center;
            padding: 10px;
        }
        .hapus{
            width: 20px;
        }
    </style>
</head>
<body>
    <h1 style="font-size: 50px;">Masukan Data Siswa</h1>
    <form method="POST" action="">
        <table class="satu" align="center" style="border: 2px solid black;
            border-bottom-right-radius: 30px;
            border-bottom-left-radius: 30px;
            width: 300px;">
        <tr class="kuning">
            <td><label for="nama">Nama :</label></td>
            <td><input type="text" placeholder="Nama" name="nama" id="nama"/></td>
        </tr>
        <tr class="hijau">
            <td><label for="nis">Nis :</label></td>
            <td><input type="text" placeholder="NIS" name="nis" id="nis"/></td>
        </tr>
        <tr class="biru">
            <td><label for="rayon">Rayon :</label></td>
            <td><input type="text" placeholder="Rayon" name="rayon" id="rayon"/></td>
        </tr>
        <tr class="sejajar">
            <td><button type="submit" name="kirim" >Kirim</button></td>
            <td><button type="submit" name="reset" >Reset</button></td>
        </tr>
        </table>
    </form>
    <!-- pembuka php -->
    <?php
    //memulai sesi
    session_start();

    if(isset($_POST['reset'])){
        session_unset();
    }

    if(!isset($_SESSION["datasiswa"])){
        $_SESSION['datasiswa'] = array();
    }

    if(isset($_SESSION['datasiswa'])){
        $_SESSION['datasiswa'] = array();
    }

    if(isset($_POST['kirim'])){
    if(@$_POST['nama'] && @$_POST['nis'] && @$_POST['rayon']){
            if (isset($_SESSION['datasiswa'])){
            $data = [
                'nama' => $_POST['nama'],
                'nis' => $_POST['nis'],
                'rayon' => $_POST['rayon'],
            ];
            array_push($_SESSION['datasiswa'], $data);
            }
        }
    }

    if(!empty ($_SESSION['datasiswa'])){
        echo '<table class= "output">';
        echo '<tr>';
        echo '<td class ="kuning">NAMA</td>';
        echo '<td class ="hijau">NIS</td>';
        echo '<td class ="biru">RAYON</td>';
        echo '</tr>';   

    foreach($_SESSION['datasiswa'] as $index => $value){
        echo '<tr>';
        echo '<td>'. $value ['nama'] . '</td>';
        echo '<td>'. $value ['nis'] . '</td>';
        echo '<td>'. $value ['rayon'] . '</td>';
        echo '<td class="hapus"><a href=?hapus=' . $index . ">HAPUS</a></td>";
        echo '</tr>';
    }
    echo '</table>';
    } else {
        echo "<p class = dataksg>" . "Data Masih Kosong Brooo!!" . "</p>";
    }
    ?>
</body>
</html>