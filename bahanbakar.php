<?php

class Shell {
    private $harga;
    private $jenis;
    private $ppn;

    public function __construct($harga, $jenis, $ppn) {
        $this->harga = $harga;
        $this->jenis = $jenis;
        $this->ppn = $ppn;
    }

    public function getHarga() {
        return $this->harga;
    }

    public function getJenis() {
        return $this->jenis;
    }

    public function getPpn() {
        return $this->ppn;
    }
}

class Beli extends Shell {
    private $jumlah;
    private $totalBayar;
    public $jumlahLiter;

    public function __construct($harga, $jenis, $ppn, $jumlah) {
        parent::__construct($harga, $jenis, $ppn);
        $this->jumlah = $jumlah;
        $this->totalBayar = $this->calculateTotalBayar();
    }

    private function calculateTotalBayar() {
        $hargaPerLiter = $this->getHarga();
        $this->jumlahLiter = $this->jumlah;
        $ppnPercentage = $this->getPpn() / 100;
        $subTotal = $hargaPerLiter * $this->jumlahLiter;
        $ppnAmount = $subTotal * $ppnPercentage;
        $totalBayar = $subTotal + $ppnAmount;
        return $totalBayar;
    }

    public function getTotalBayar() {
        return $this->totalBayar;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenisBahanBakar = $_POST["tipeBahanBakar"];
    $jumlahLiter = $_POST["jumlahLiter"];

    $harga = 0;
    $ppn = 10;

    switch ($jenisBahanBakar) {
        case "Shell Super":
            $harga = 15420;
            break;
        case "SVPowerDiesel":
            $harga = 18310;
            break;
        case "V-Power":
            $harga = 16130;
            break;
        case "V-Power Nitro":
            $harga = 16510;
            break;
    }

    $beli = new Beli($harga, $jenisBahanBakar, $ppn, $jumlahLiter);

    echo "-------------------------------------------";
    echo "<br>";
    echo "Anda membeli bahan bakar minyak tipe ". $beli->getJenis(). "<br> dengan jumlah : ". $beli->jumlahLiter. " Liter<br>";
    echo "Total yang harus anda bayar : Rp. ". number_format($beli->getTotalBayar(), 2, '.', ','). "<br>";
    echo "-------------------------------------------";
    echo "<br>";
}

?>
<body style="text-align: center; background-color:blue;  color:aliceblue;">
<form method="post">
    <label for="jumlahLiter">Masukkan Jumlah Liter:</label>
    <input type="number" id="jumlahLiter" name="jumlahLiter"><br><br>
    <label for="tipeBahanBakar">Pilih Tipe Bahan Bakar:</label>
    <select id="tipeBahanBakar" name="tipeBahanBakar">
        <option value="Shell Super">Shell Super</option>
        <option value="SVPowerDiesel">SVPowerDiesel</option>
        <option value="V-Power">V-Power</option>
        <option value="V-Power Nitro">V-Power Nitro</option>
    </select><br><br>
    <input type="submit" value="Beli">
</form>
</body>