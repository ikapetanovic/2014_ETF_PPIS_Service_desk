INSERT INTO `generalno_pravilo` (`id`, `pravilo`) VALUES
(1, 'Svi dobavljači moraju biti iz Bosne i Hercegovine.');

INSERT INTO `specificno_pravilo` (`id`, `vrijednost`, `trajanje`, `grad`) VALUES
(1, 10000, 6, 'Sarajevo');

INSERT INTO `dobavljaci` (`id`, `naziv`, `grad`, `adresa`, `vrsta`, `dostupnost`, `vrijednost`, `utjecaj`, `rizik`, `kategorija`) VALUES
(1, 'Media Market', 'Sarajevo', 'Milana Preloga 8', 'Hardver', '1', '1', '1', 'Nizak', 'Commodity'),
(2, 'DOMOD', 'Sarajevo', 'Srđana Aleksića 20', 'Hardver', '1', '3', '3', 'Visok', 'Taktički'),
(3, 'Microsoft', 'Sarajevo', 'Fra Anđela Zvizdovića 1', 'Softver', '2', '2', '2', 'Srednji', 'Operativni'),
(4, 'PHOENIX BIH', 'Zenica', 'Stefana Dečanskog b.b.', 'Logistika', '3', '3', '3', 'Ekstreman', 'Strateški');

INSERT INTO `ugovori` (`id`, `naziv`, `vrsta`, `broj`, `vrijednost`, `pocetni_datum`, `krajnji_datum`, `period_obnavljanja`, `opis`) VALUES
(1, 'DOMOD', 'Hardver', '1', '1000', '2014-06-04', '2014-06-12', '2', 'Supplier Management je sklopio ugovor sa DOMOD-om.'),
(2, 'Media Market', 'Hardver', '1', '1800', '2014-06-04', '2014-12-04', '2', 'Supplier Management je sklopio ugovor sa Media Market-om.');