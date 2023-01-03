-- LATIHAN 
-- NOMER 5
SELECT nama_cabang, alamat_cabang FROM cabang_bank ORDER BY nama_cabang;

-- NOMER 6
SELECT no_rekening, pin, saldo FROM rekening ORDER BY saldo DESC;

-- NOMER 7
SELECT rekening.no_rekening, nasabah.nama_nasabah, nasabah.alamat_nasabah FROM rekening, nasabah, nasabah_has_rekening WHERE nasabah.id_nasabah = nasabah_has_rekening.id_nasabahFK AND rekening.no_rekening = nasabah_has_rekening.no_rekeningFK ORDER BY nasabah.nama_nasabah


-- NOMER 8
SELECT rekening.no_rekening, nasabah.nama_nasabah, rekening.saldo FROM rekening, nasabah, nasabah_has_rekening WHERE nasabah.id_nasabah = nasabah_has_rekening.id_nasabahFK AND rekening.no_rekening = nasabah_has_rekening.no_rekeningFK ORDER BY nasabah.nama_nasabah;

-- TUGAS

-- NOMER 1 
 SELECT nasabah.nama_nasabah, nasabah.alamat_nasabah, transaksi.jenis_transaksi, transaksi.jumlah FROM nasabah INNER JOIN transaksi ON nasabah.id_nasabah = transaksi.id_nasabahFK WHERE transaksi.jenis_transaksi = 'kredit' ORDER BY nasabah.nama_nasabah;

-- NOMER 2
SELECT no_rekeningFK, nama_nasabah, jenis_transaksi, jumlah FROM nasabah INNER JOIN transaksi ON id_nasabah = id_nasabahFK WHERE tanggal = '2009-11-21';

-- NOMER 3
SELECT no_rekeningFK, nama_nasabah, jenis_transaksi, jumlah FROM nasabah INNER JOIN transaksi ON id_nasabah = id_nasabahFK WHERE jumlah = 20000;

-- NOMER 4
SELECT no_rekeningFK, nama_nasabah, alamat_nasabah FROM nasabah INNER JOIN nasabah_has_rekening ON id_nasabah = id_nasabahFk WHERE nama_nasabah LIKE 'Su%';


-- NOMER 5
SELECT no_rekeningFK AS 'Nomor Rekening', nama_nasabah AS 'Nama Nasabah', jumlah AS 'Jumlah Transaksi' FROM nasabah INNER JOIN transaksi ON id_nasabah = id_nasabahFK WHERE jenis_transaksi = 'debit' ORDER BY nama_nasabah;




