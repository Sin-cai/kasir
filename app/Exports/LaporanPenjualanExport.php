<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;
class LaporanPenjualanExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;
    protected $totalHarga = 0;
    protected $totalKeuntungan = 0;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    public function collection()
    {
        return Penjualan::with(['pelanggan', 'detailPenjualan.produk'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Customer',
            'No. Invoice',
            'Tgl. Invoice',
            'Sub Total',
            'Diskon',
            'Total Harga',
            'Keuntungan',
        ];
    }

    public function map($penjualan): array
    {
        static $index = 1;

        // Ambil subtotal, diskon, dan total harga langsung dari database
        $subtotal = $penjualan->detailPenjualan->sum('sub_total');
        $diskon = $penjualan->diskon;
        $totalHarga = $penjualan->total_harga;

        // Hitung keuntungan dari setiap produk dalam detail_penjualans
          // Hitung total harga jual x qty
          $totalHargaJualQty = $penjualan->detailPenjualan->sum(function ($detail) {
            return $detail->produk->harga_beli * $detail->qty;
        });

        // Hitung keuntungan: Total Harga - (Harga Jual * Qty)
        $keuntungan = $totalHarga - $totalHargaJualQty;


        // Tambahkan ke total keseluruhan
        $this->totalHarga += $totalHarga;
        $this->totalKeuntungan += $keuntungan;

        return [
            $index++,
            $penjualan->pelanggan->nama ?? 'Umum',
            '000' . $penjualan->id , // Format invoice
            Carbon::parse($penjualan->created_at)->format('Y-m-d'),
            number_format($subtotal, 2, ',', '.'),
            number_format($diskon, 2, ',', '.'),
            number_format($totalHarga, 2, ',', '.'),
            number_format($keuntungan, 2, ',', '.'),
        ];
    }

    public function startCell(): string
    {
        return 'A1'; // Mulai dari A1
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $row = count($this->collection()) + 2;
                $event->sheet->setCellValue('D' . $row, 'Total');
                $event->sheet->setCellValue('G' . $row, number_format($this->totalHarga, 2, ',', '.'));
                $event->sheet->setCellValue('H' . $row, number_format($this->totalKeuntungan, 2, ',', '.'));
            }
        ];
    }
}