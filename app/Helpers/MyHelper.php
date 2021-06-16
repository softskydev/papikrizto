<?php

	function rupiah($angka){
		$hasil_rupiah = number_format($angka,0,',','.');
		return "Rp.".$hasil_rupiah;
	}

	function terbilang($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = terbilang($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = terbilang($nilai/10)." puluh". terbilang($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . terbilang($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = terbilang($nilai/100) . " ratus" . terbilang($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . terbilang($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = terbilang($nilai/1000) . " ribu" . terbilang($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = terbilang($nilai/1000000) . " juta" . terbilang($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = terbilang($nilai/1000000000) . " milyar" . terbilang(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = terbilang($nilai/1000000000000) . " trilyun" . terbilang(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

	function format($tgl){
		$tanggal = explode("-", $tgl);
		$bulan = array(
			'01' => "Januari",
			'02' => "Februari",
			'03' => "Maret",
			'04' => "April",
			'05' => "Mei",
			'06' => "Juni",
			'07' => "Juli",
			'08' => "Agustus",
			'09' => "September",
			'10' => "Oktober",
			'11' => "November",
			'12' => "Desember"
		); 
		return $tanggal['2']." ".$bulan[$tanggal['1']]." ".$tanggal['0'];
	}

	function format_pendek($tgl){
		$tanggal = explode("-", $tgl);
		return $tanggal['2']."/".$tanggal['1']."/".$tanggal['0'];
	}

	function f_tgl_bln($tgl){
		$tanggal = explode("-", $tgl);

		$bulan = array(
			'01' => "Jan",
			'02' => "Feb",
			'03' => "Mar",
			'04' => "Apr",
			'05' => "Mei",
			'06' => "Jun",
			'07' => "Jul",
			'08' => "Agu",
			'09' => "Sep",
			'10' => "Okt",
			'11' => "Nov",
			'12' => "Des"
		);
		return $tanggal['2']." ".$bulan[$tanggal['1']];
	}

	function f_bln_tgl($tgl){
		$tanggal = explode("-", $tgl);

		$bulan = array(
			'01' => "Jan",
			'02' => "Feb",
			'03' => "Mar",
			'04' => "Apr",
			'05' => "Mei",
			'06' => "Jun",
			'07' => "Jul",
			'08' => "Agu",
			'09' => "Sep",
			'10' => "Okt",
			'11' => "Nov",
			'12' => "Des"
		);
		return $bulan[$tanggal['1']]."-".$tanggal['2'];
	}	

	function f_tahun($tgl){
		$tanggal = explode("-", $tgl);

		return $tanggal[0];
	}

	function str_bulan($int_bulan){
		$bulan = array(
			'1' => "Januari",
			'2' => "Februari",
			'3' => "Maret",
			'4' => "April",
			'5' => "Mei",
			'6' => "Juni",
			'7' => "Juli",
			'8' => "Agustus",
			'9' => "September",
			'10' => "Oktober",
			'11' => "November",
			'12' => "Desember"
		);

		return $bulan[$int_bulan];
	}

	function str_bulan_pendek($int_bulan){
		$bulan = array(
			'1' => "Jan",
			'2' => "Feb",
			'3' => "Mar",
			'4' => "Apr",
			'5' => "Mei",
			'6' => "Jun",
			'7' => "Jul",
			'8' => "Agu",
			'9' => "Sep",
			'10' => "Okt",
			'11' => "Nov",
			'12' => "Des"
		);

		return $bulan[$int_bulan];
	}

	function format_2tanggal($tgl1, $tgl2){
		$tanggal1 = explode("-", $tgl1);
		$tanggal2 = explode("-", $tgl2);

		$bulan = array(
			'01' => "Januari",
			'02' => "Februari",
			'03' => "Maret",
			'04' => "April",
			'05' => "Mei",
			'06' => "Juni",
			'07' => "Juli",
			'08' => "Agustus",
			'09' => "September",
			'10' => "Oktober",
			'11' => "November",
			'12' => "Desember"
		); 
		
		if ($tgl1 != $tgl2) {
			if ($tanggal1['1'] == $tanggal2['1']) {
				return $tanggal1['2']." - ".$tanggal2['2']." ".$bulan[$tanggal1['1']]." ".$tanggal1['0'];
			}else{
				return $tanggal1['2']." ".$bulan[$tanggal1['1']]." - ".$tanggal2['2']." ".$bulan[$tanggal2['1']]." ".$tanggal1['0'];
			}
		}else{
			return $tanggal1['2']." ".$bulan[$tanggal1['1']]." ".$tanggal1['0'];
		}
	}
 ?>