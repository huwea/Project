-- latihan

-- Nomer 5
-- biasanya
SELECT n.id_nasabah, n.nama_nasabah, n.alamat_nasabah FROM nasabah n INNER JOIN transaksi t ON n.id_nasabah = t.id_nasabahFK WHERE t.jenis_transaksi = 'kredit' GROUP BY n.id_nasabah;
-- subquery
SELECT * FROM nasabah WHERE nasabah.id_nasabah IN (SELECT DISTINCT transaksi.id_nasabahFK FROM transaksi WHERE jenis_transaksi = 'kredit');
-- Nomer 6
 SELECT * FROM nasabah WHERE  nasabah.id_nasabah NOT IN(SELECT DISTINCT transaksi.id_nasabahFK FROM transaksi);

-- Nomer 7
-- biasanya
SELECT cabang_bank.kode_cabang, cabang_bank.nama_cabang, AVG(rekening.saldo) AS rata2 FROM cabang_bank INNER JOIN rekening ON cabang_bank.kode_cabang = rekening.kode_cabangFK GROUP BY cabang_bank.kode_cabang ORDER BY AVG(rekening.saldo) DESC;
-- subquery
SELECT cabang_bank.kode_cabang, cabang_bank.nama_cabang, AVG(rekening.saldo) AS rata2 FROM cabang_bank, rekening WHERE cabang_bank.kode_cabang = rekening.kode_cabangFK GROUP BY cabang_bank.kode_cabang HAVING rata2 >= ALL(SELECT AVG(saldo) FROM rekening GROUP BY kode_cabangFK);

-- Nomer 8
SELECT * FROM transaksi WHERE jumlah > (SELECT AVG(jumlah) FROM transaksi);



-- TUGAS

-- NOMER 1
 SELECT MAX(jumlah) FROM transaksi;
-- NOMER 2
SELECT MIN(jumlah) FROM transaksi;
-- NOMER 3
-- kalau pakai cara ini hasil nya cuma 1 orang yang bisa muncul
SELECT n.nama_nasabah, MAX(t.jumlah) 
FROM nasabah n INNER JOIN transaksi t ON n.id_nasabah = t.id_nasabahFK;
-- cara benar
SELECT n.nama_nasabah, t.jumlah 
FROM nasabah n INNER JOIN transaksi t ON n.id_nasabah = t.id_nasabahFK WHERE t.jumlah = ALL(SELECT max(jumlah) FROM transaksi);
-- NOMER 4
SELECT c.kode_cabang, c.nama_cabang 
FROM cabang_bank c INNER JOIN rekening r ON c.kode_cabang = r.kode_cabangFK WHERE c.kode_cabang NOT IN(r.kode_cabangFK);

select nama_cabang 
from cabang_bank inner join rekening where kode_cabang not in(select kode_cabangFK from rekening) group by nama_cabang;
-- NOMER 5
 SELECT no_rekening, saldo 
 FROM rekening WHERE saldo > (SELECT AVG(saldo) FROM  rekening);

