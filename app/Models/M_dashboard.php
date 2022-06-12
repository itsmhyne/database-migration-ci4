<?php

namespace App\Models;

class M_dashboard extends BaseModel
{

    function getGrafikRuangan()
    {
        return $this->db->table('peminjaman as p')
            ->select('ruangan_nama, sum(jumlah) as jumlah')
            ->join('ruangan as r', 'r.ruangan_id = p.ruangan_id')
            ->groupBy('p.ruangan_id')
            ->get()->getResultArray();
    }

    function getGrafikPeminjaman($param)
    {
        if ($param['month'] != 00) {
            $days = $this->days($param['year'], $param['month']);
            $data['labels'] = $days;
            $result = $this->db->table('peminjaman')
                ->get()
                ->getResultArray();
            $finalData = [];
            foreach ($days as $key => $val) {
                $getDayMonth = $param['month'] . '-' . $val;
                $finalData[$getDayMonth][] = '';
                foreach ($result as $key => $value) {
                    $time = strtotime($value['created_time']);
                    $dayMonth = date('m-d', $time);
                    if ($getDayMonth == $dayMonth) {
                        $finalData[$getDayMonth][] = $value;
                    }
                }
            }
            $data['dataPeminjaman'] = $finalData;
        } else {
            $month = $this->months();
            $data['labels'] = $month;
            $result = $this->db->table('peminjaman')
                ->get()
                ->getResultArray();
            $finalData = [];
            foreach ($month as $key => $val) {
                $getMonthYear = $param['year'] . '-' . $val;

                $finalData[$getMonthYear][] = '';
                foreach ($result as $key => $value) {
                    $time = strtotime($value['created_time']);
                    $monthYear = date('Y-m', $time);

                    if ($getMonthYear == $monthYear) {
                        $finalData[$getMonthYear][] = $value;
                    }
                }
            }
            $data['dataPeminjaman'] = $finalData;
        }
        return $data;
    }

    /*getting the total months*/
    private function months()
    {
        return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    }

    private function days($year, $month)
    {
        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '09' || $month == '11') {
            $end = 31;
        } else if ($month == '04' || $month == '06' || $month == '08' || $month == '10' || $month == '12') {
            $end = 30;
        } else {
            if ($year % 4 == 0) {
                $end = 29;
            } else {
                $end = 28;
            }
        }
        for ($i = 1; $i <= $end; $i++) {
            $days[] = sprintf("%02d", $i);
        }
        return $days;
    }
}
