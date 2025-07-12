<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateExcelController extends Controller
{
    public function export(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(50);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);


        // Add data
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Periode Bulan');
        $sheet->setCellValue('C1', $request->periode_bulan);

        $sheet->mergeCells('A2:B2');
        $sheet->setCellValue('A2', 'Periode Tahun');
        $sheet->setCellValue('C2', strval($request->periode_tahun));
        $sheet->getStyle('C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);


        $sheet->mergeCells('A3:B3');
        $sheet->setCellValue('A3', 'Status Pembayaran');
        $sheet->setCellValue('C3', $request->status_pembayaran);

        $headerRange = 'A5:G5';
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($headerRange)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('FFCCCCCC');

        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Kode Transaksi');
        $sheet->setCellValue('C5', 'Nama Warga');
        $sheet->setCellValue('D5', 'Alamat Warga');
        $sheet->setCellValue('E5', 'Jenis Tagihan');
        $sheet->setCellValue('F5', 'Jumlah Tagihan');
        $sheet->setCellValue('G5', 'Total Tagihan');

        $transaksi = DB::table('transaksis')
                    ->join('warga_penduduks', 'transaksis.warga_penduduks_id', '=', 'warga_penduduks.id')
                    ->select(
                        'transaksis.id',
                        'transaksis.kode_transaksi as kode_transaksi',
                        'warga_penduduks.nama as nama_warga',
                        'warga_penduduks.alamat as alamat_warga',
                    )
                    ->where('transaksis.periode_bulan', $request->periode_bulan)
                    ->where('transaksis.periode_tahun', $request->periode_tahun)
                    ->where('transaksis.status_pembayaran', $request->status_pembayaran)
                    ->orderBy('transaksis.id', 'asc')
                    ->get();

        $startRow = 6;
        $nomer = 1;
        foreach ($transaksi as $data_transaksi) {
            $sheet->setCellValue('A' . $startRow, $nomer);
            $sheet->setCellValue('B' . $startRow, $data_transaksi->kode_transaksi);
            $sheet->setCellValue('C' . $startRow, $data_transaksi->nama_warga);
            $sheet->setCellValue('D' . $startRow, $data_transaksi->alamat_warga);

            $detail_transaksi = DB::table('detail_transaksis')
                            ->join('tagihans', 'detail_transaksis.tagihan_id', '=', 'tagihans.id')
                            ->select(
                                'tagihans.kode_tagihan as kode_tagihan',
                                'detail_transaksis.qty as qty',
                                'detail_transaksis.harga_tagihan as harga_tagihan'
                            )
                            ->where('detail_transaksis.transaksi_id', $data_transaksi->id)
                            ->get();

            $tmp_total_tagihan = 0;
            foreach ($detail_transaksi as $data_detail_transaksi) {
                $sheet->setCellValue('E' . $startRow, $data_detail_transaksi->kode_tagihan);
                $sheet->setCellValue('F' . $startRow, $data_detail_transaksi->qty * $data_detail_transaksi->harga_tagihan);
                $sheet->getStyle('F' . $startRow)
                        ->getNumberFormat()
                        ->setFormatCode('""#,##0');
                $startRow++;
                $tmp_total_tagihan += $data_detail_transaksi->qty * $data_detail_transaksi->harga_tagihan;
            }


            $sheet->setCellValue('G' . $startRow - 3, $tmp_total_tagihan);
            $sheet->getStyle('G' . $startRow - 3)
                ->getNumberFormat()
                ->setFormatCode('""#,##0');
            $startRow++;
            $nomer++;
        }

        // Save to temporary file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Transaksi_Tagihan.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);

        return Response::download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}
