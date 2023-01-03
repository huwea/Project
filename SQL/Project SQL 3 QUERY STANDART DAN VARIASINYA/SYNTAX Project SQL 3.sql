-- LATIHAN

-- NOMER 5
SELECT nama_cabang, alamat_cabang FROM cabang_bank ORDER BY nama_cabang;

-- NOMER 6
SELECT no_rekening, pin, saldo FROM rekening ORDER BY saldo DESC;


--TUGAS

-- NOMER 1
SELECT nama_nasabah, alamat_nasabah FROM nasabah ORDER BY nama_nasabah;

-- NOMER 2
SELECT jenis_transaksi, jumlah FROM transaksi WHERE jenis_transaksi LIKE 'kredit';

-- NOMER 3
SELECT jenis_transaksi, jumlah FROM transaksi WHERE tanggal = '2009-11-21';

-- NOMER 4
 SELECT jenis_transaksi, jumlah FROM transaksi WHERE jumlah = 20000;

-- NOMER 5
SELECT nama_nasabah, alamat_nasabah FROM nasabah WHERE nama_nasabah LIKE 'Su%';

-- NOMER 6
SELECT no_rekening FROM rekening WHERE kode_cabangFK = 'BRUS' AND saldo > 50000;

-- NOMER 7
SELECT id_nasabahFK FROM transaksi WHERE jenis_transaksi = 'kredit' AND tanggal > '2009-11-20' AND jumlah > 50000;

-- NOMER 8
SELECT no_rekening FROM rekening ORDER BY saldo LIMIT 5 OFFSET 2;

-- NOMER 9
SELECT nama_nasabah FROM nasabah WHERE alamat_nasabah IS NOT NULL AND nama_nasabah LIKE 'S%';

-- NOMER 10
SELECT nama_nasabah FROM nasabah WHERE nama_nasabah LIKE '%o%' AND nama_nasabah IS NOT NULL ORDER BY id_nasabah LIMIT 3 OFFSET 1;