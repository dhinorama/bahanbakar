<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Bahan Bakar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Bahan Bakar</h2>
        <form method="post" action="" class="mt-4">
            <div class="form-group">
                <label for="jumlahLiter">Masukkan Jumlah Liter:</label>
                <input type="number" id="jumlahLiter" name="jumlahLiter" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipeBahanBakar">Pilih Tipe Bahan Bakar:</label>
                <select id="tipeBahanBakar" name="tipeBahanBakar" class="form-control" required>
                    <option value="Shell Super">Shell Super</option>
                    <option value="SVPowerDiesel">SVPowerDiesel</option>
                    <option value="V-Power">V-Power</option>
                    <option value="V-Power Nitro">V-Power Nitro</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Beli</button>
        </form>

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
            
            echo "<div class='alert alert-info mt-4'>";
            echo "<h4>Rincian Pembelian</h4>";
            echo "Anda membeli bahan bakar minyak tipe <strong>". $beli->getJenis(). "</strong><br> Dengan jumlah : <strong>". $beli->jumlahLiter. " Liter</strong><br>";
            echo "Total yang harus anda bayar : <strong>Rp. ". number_format($beli->getTotalBayar(), 2, '.', ','). "</strong><br>";
            echo "</div>";
            echo "<a href='/4projrck/bahanbakar.php/' class='btn btn-secondary stretched-link w-25'>Reset</a>";
        }
        ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
