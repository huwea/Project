--(6) membuat tabel nasabah dengan script berikut
CREATE TABLE nasabah (
    id_nasabah INTEGER PRIMARY KEY,
    nama_nasabah VARCHAR(45) NOT NULL,
    alamat_nasabah VARCHAR((255) NOT NULL
);

CREATE TABLE nasabah(id_nasabah INTEGER PRIMARY KEY, nama_nasabah VARCHAR(45) NOT NULL, alamat_nasabah VARCHAR((255) NOT NULL);

create table nasabah(
    id_nasabah integer primary key,
    nama_nasabah varchar(45) not null,
    alamat_nasabah varchar(255) not null);


--(7) membuat tabel cabang_bank dengan script berikut
CREATE TABLE cabang_bank(
    kode_cabang VARCHAR(20) PRIMARY KEY,
    nama_cabang VARCHAR(45) UNIQUE NOT NULL,
    alamat_cabang VARCHAR(255) NOT NULL
);

--(8) membuat tabel rekening dengan script berikut
CREATE TABLE rekening(
    no_rekening INTEGER PRIMARY KEY,
    kode_cabangFK VARCHAR(20) REFERENCES cabang_bank(kode_cabang) ON DELETE CASCADE ON UPDATE CASCADE, pin VARCHAR(20) DEFAULT '1234' NOT NULL, saldo INTEGER DEFAULT 0 NOT NULL
);


--(9) membuat table transaksi dengan scritp berikut ini
CREATE TABLE transaksi (
    no_transaksi SERIAL PRIMARY KEY,
    id_nasabahFK INTEGER REFERENCES nasabah(id_nasabah) ON DELETE SET NULL ON UPDATE CASCADE, 
    jenis_transaksi VARCHAR(20) DEFAULT 'debit' NOT NULL,
    tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    jumlah INTEGER NOT NULL CHECK (jumlah>=20000)
);

CREATE TABLE IF NOT EXISTS `transaksi` (
`no_transaksi` bigint(20) unsigned NOT NULL,
  `id_nasabahFK` int(11) DEFAULT NULL,
  `no_rekeningFK` int(11) DEFAULT NULL,
  `jenis_transaksi` varchar(20) NOT NULL DEFAULT 'debit',
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--(10) membuat tabel nasabah_has_rekening dengan script berikut ini
CREATE TABLE nasabah_has_rekening (
    id_nasabahFK INTEGER REFERENCES nasabah(id_nasabah) ON DELETE CASCADE ON UPDATE CASCADE,
    no_rekeningFK INTEGER REFERENCES rekening(no_rekening) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(id_nasabahFK,no_rekeningFK)
);











