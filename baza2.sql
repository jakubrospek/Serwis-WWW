-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Cze 2016, 18:51
-- Wersja serwera: 10.0.17-MariaDB
-- Wersja PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `ID_kom` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `dodal` varchar(40) NOT NULL,
  `opinia` mediumtext NOT NULL,
  `ocena` int(11) NOT NULL,
  `data_dodania` date NOT NULL,
  `czas_dodania` time NOT NULL,
  `id_ksiazki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`ID_kom`, `ID_user`, `dodal`, `opinia`, `ocena`, `data_dodania`, `czas_dodania`, `id_ksiazki`) VALUES
(130, 6, 'admin', 'Monumentalna praca Edwarda Gibbona (1737-1794) The History of the Decline and Fali of the Roman Empire naleÅ¼y do kanonu klasyki historycznej, Znakomitym pisarstwem reprezentuje to, co w historiografii tradycyjnej najlepsze, a dziÄ™ki oÅ›wieceniowemu racjonalizmowi, inteligencji i odwadze intelektualnej autora wyrasta ponad Ã³wczesne ograniczenia ÅºrÃ³dÅ‚owe i metodologiczne. CaÅ‚oÅ›Ä‡ dzieÅ‚a obejmuje okres od pierwszych symptomÃ³w kryzysu imperium rzymskiego pod koniec II wieku aÅ¼ do zdobycia "Nowego Rzymu", Konstantynopola, przez TurkÃ³w w roku 1453. Kilkakrotnie wydawany przez PIW przekÅ‚ad poczÄ…tkowych tomÃ³w, ktÃ³remu nadano tytuÅ‚ Zmierzch Cesarstwa Rzymskiego, koÅ„czy siÄ™ Å›mierciÄ… cesarza Juliana Apostaty i wraz z niÄ… klÄ™skÄ… restytucji pogaÅ„stwa w Rzymie. Niniejsza kontynuacja tego przekÅ‚adu (lekturowe moÅ¼e byÄ‡ ona traktowana jako samodzielna ksiÄ…Å¼ka) doprowadza czytelnika do symbolicznego roku 476, kiedy germaÅ„scy najemnicy zdjÄ™li z tronu ostatniego cesarza zachodniorzymskiego, Romulusa Augustulusa. Dalsze dzieje wschodniej czÄ™Å›ci imperium skÅ‚adajÄ… siÄ™ juÅ¼, wedÅ‚ug naszej terminologii, na historiÄ™ Bizancjum.', 10, '2016-02-12', '14:00:50', 22),
(145, 6, 'admin', 'historyczna gra o tron', 0, '2016-02-03', '13:25:29', 18),
(149, 2, 'd', 'ujdzie w tÅ‚oku', 5, '2016-02-12', '14:03:52', 21),
(164, 6, 'admin', 'swietna!!!', 10, '2016-03-05', '20:24:24', 19),
(167, 6, 'admin', 'moÅ¼e byÄ‡', 3, '2016-03-05', '21:40:41', 21),
(168, 10, 'mama', 'Ciekawa marynistyka, jednak "Galeony Wojny" Jacka Komudy lepsze, nie wspominajÄ…c o "Czarnej banderze".', 6, '2016-04-10', '21:17:10', 21),
(169, 5, 'k', 'racja', 6, '2016-04-10', '21:15:46', 21),
(170, 17, 'Adam', 'Moim zdaniem bardzo sÅ‚aba. Zmarnowany potencjaÅ‚.', 5, '2016-03-30', '17:19:58', 21),
(171, 11, 'Marcin', 'Nie wiem o co wam chodzi. Åšwietna ksiÄ…Å¼ka!', 8, '2016-03-30', '17:31:10', 21),
(172, 12, 'kkk', 'kkkkkk', 0, '2016-03-30', '17:39:00', 21),
(178, 13, 'gggg', 'ggdd', 0, '2016-03-30', '18:22:19', 21),
(180, 6, 'admin', 'nieco gorsza niÅ¼ tomy z opowiadaniami ale i tak dobra', 8, '2016-04-05', '12:04:03', 30),
(182, 10, 'mama', 'Åšwietna powieÅ›Ä‡ historyczna. Najlepsza jakÄ… czytaÅ‚am od czasÃ³w ksiÄ…Å¼ek Bernarda Cornwella', 7, '2016-05-15', '18:34:18', 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazki`
--

CREATE TABLE `ksiazki` (
  `ID_ksiazki` int(11) NOT NULL,
  `Autor` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Tytul` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Cykl` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Tom` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Tlumaczenie` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `TytulOrg` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `ISBN` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `LStron` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Kategoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Jezyk` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `Opis` mediumtext NOT NULL,
  `Okladka` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `ksiazki`
--

INSERT INTO `ksiazki` (`ID_ksiazki`, `Autor`, `Tytul`, `Cykl`, `Tom`, `Tlumaczenie`, `TytulOrg`, `ISBN`, `LStron`, `Kategoria`, `Jezyk`, `Opis`, `Okladka`) VALUES
(18, 'Maurice Druon', 'KrÃ³lowie PrzeklÄ™ci', 'KrÃ³lowie przeklÄ™ci', '1', 'Adriana CeliÅ„ska', 'Les Rois mauditis', '9788375153675', '720', 'historia', 'polski', 'W pierwszym tomie nowego â€“ trzyczÄ™Å›ciowego â€“ wydania cyklu â€žKrÃ³lowie przeklÄ™ciâ€ znajdziesz powieÅ›ci â€žKrÃ³l z Å¼elazaâ€, â€žZamordowana krÃ³lowaâ€ i â€žTrucizna krÃ³lewskaâ€.\r\n\r\nTo pierwotna gra o tron.\r\n\r\nâ€žW KrÃ³lach przeklÄ™tych jest wszystko. KrÃ³lowie z Å¼elaza, zamordowane krÃ³lowe, bitwy i zdrady, kÅ‚amstwa i Å¼Ä…dze, oszustwo, rodowe rywalizacje, klÄ…twa templariuszy, podmieniane niemowlÄ™ta, wilczyce, grzech i miecze, wielka dynastia skazana na upadekâ€¦ A to wszystko (no, prawie wszystko) zaczerpniÄ™te Å¼ywcem z kart historii. I wierzcie mi: rody StarkÃ³w i LannisterÃ³w nie mogÄ… siÄ™ nawet rÃ³wnaÄ‡ z Kapetyngami i Plantagenetami.\r\nBez wzglÄ™du na to, czy jesteÅ› historycznym geekiem, czy miÅ‚oÅ›nikiem fantastyki, od ksiÄ…Å¼ek Druona nie bÄ™dziesz siÄ™ mÃ³gÅ‚ oderwaÄ‡.', 'KrÄ‚Å‚lowie przeklÃ„â„¢ci.jpg'),
(19, 'John Richard Rauel Tolkien', 'WÅ‚adca PierÅ›cieni. Wydanie jednotomowe.', 'WÅ‚adca PierÅ›cieni', '1', 'Maria Skibniewska', 'Lord of the Rings', '9788377582558', '1278', 'fantasy', 'polski', 'NieÅ‚atwo powiedzieÄ‡, na czym polega tajemnica uroku wywieranego przez WÅ‚adcÄ™ PierÅ›cieni. MiaÅ‚ niewÄ…tpliwie racjÄ™ C.S Lewis, piszÄ…c: "Dla nas, Å¼yjÄ…cych w paskudnym, zmaterializowanym i pozbawionym romantyzmu Å›wiecie moÅ¼liwoÅ›Ä‡ powrotu dziÄ™ki tej ksiÄ…Å¼ce do czasÃ³w heroicznych przygÃ³d, barwnych, przepysznych i wrÄ™cz bezwstydnie piÄ™knych opowieÅ›ci jest czymÅ› niezwykle waÅ¼nym". RÃ³wnie istotna jest przyjemnoÅ›Ä‡, jakÄ… Czytelnik czerpie z odkrywania zÅ‚oÅ¼onego, ale logicznie skonstruowanego uniwersum tej opowieÅ›ci. UmoÅ¼liwiajÄ… to doÅ‚Ä…czone do ksiÄ…Å¼ki mapy oraz obszerne dodatki.\r\nPrzepiÄ™kny Å›wiat stworzony przez Tolkiena i historia przez niego opowiedziana stanowi od lat pomost pomiÄ™dzy generacjami i nic nie wskazuje na to, by ten stan rzeczy ulegÅ‚ zmianie w przyszÅ‚oÅ›ci. NieÅ›miertelny klasyk, ktÃ³ry kaÅ¼dy fan dobrego kawaÅ‚ka literatury powinien przeczytaÄ‡. Nie kaÅ¼demu moÅ¼e odpowiadaÄ‡ ten osobliwy gatunek, ale warto pochyliÄ‡ siÄ™ nad pisarskim geniuszem twÃ³rcy.', 'WP.jpg'),
(21, 'Marcin Mortka', 'Listy lorda Bathursta', '---', '1', '---', '---', '9788375747973', '408', 'marynistyka', 'polski', 'Kapitan Peter Doggs znany jest ze swojej niezaleÅ¼noÅ›ci i braku pokory wobec rozkazÃ³w. PrÄ™dzej czy pÃ³Åºniej musiaÅ‚y go one zaprowadziÄ‡ przed pluton egzekucyjny...I gdyby nie tajemniczy lord Bathurst, zamiast na pokÅ‚adzie piÄ™knego Å¼aglowca dzielny kapitan wylÄ…dowaÅ‚by w dole z wapnem.\r\n\r\nTeraz Peter Dodds musi poÅ¼eglowaÄ‡ nie wiadomo gdzie i nie wiadomo po co. Kolejne etapy tajnej misji odsÅ‚aniaÄ‡ bÄ™dÄ… listy lorda Bathursta. Po drodze musi zatapiaÄ‡ obce statki i zabijaÄ‡ niewinnych cywilÃ³w. A gdyby do gÅ‚owy mu przyszÅ‚o protestowaÄ‡, pilnujÄ… go przekupieni lub zastraszeni przez Bathursta marynarze, pewna gnida nazwiskiem Stirling i Å›wiadomoÅ›Ä‡, Å¼e od jego subordynacji zaleÅ¼y los cÃ³rki, szesnastoletniej Emily.\r\n\r\nLord Bathurst przewidziaÅ‚ wszystko, z wyjÄ…tkiem jednego. Kapitan Dodds bardzo, ale to bardzo nie lubi byÄ‡ do czegoÅ› zmuszany...\r\n\r\nAby ocaliÄ‡ cÃ³rkÄ™, okrÄ™t i zaÅ‚ogÄ™, musi wykazaÄ‡ siÄ™ przebiegÅ‚oÅ›ciÄ…, odwagÄ… i spora dawkÄ… brawury.', 'LLB.jpg'),
(22, 'Edward Gibbon', 'Upadek Cesarstwa Rzymskiego na Zachodzie', '---', '1', 'Irena SzymaÅ„ska', 'The Fall of the Roman Empire', '8306027671', '580', 'historia', 'polski', 'Monumentalna praca Edwarda Gibbona (1737-1794) The History of the Decline and Fali of the Roman Empire naleÅ¼y do kanonu klasyki historycznej, Znakomitym pisarstwem reprezentuje to, co w historiografii tradycyjnej najlepsze, a dziÄ™ki oÅ›wieceniowemu racjonalizmowi, inteligencji i odwadze intelektualnej autora wyrasta ponad Ã³wczesne ograniczenia ÅºrÃ³dÅ‚owe i metodologiczne. CaÅ‚oÅ›Ä‡ dzieÅ‚a obejmuje okres od pierwszych symptomÃ³w kryzysu imperium rzymskiego pod koniec II wieku aÅ¼ do zdobycia "Nowego Rzymu", Konstantynopola, przez TurkÃ³w w roku 1453. Kilkakrotnie wydawany przez PIW przekÅ‚ad poczÄ…tkowych tomÃ³w, ktÃ³remu nadano tytuÅ‚ Zmierzch Cesarstwa Rzymskiego, koÅ„czy siÄ™ Å›mierciÄ… cesarza Juliana Apostaty i wraz z niÄ… klÄ™skÄ… restytucji pogaÅ„stwa w Rzymie. Niniejsza kontynuacja tego przekÅ‚adu (lekturowe moÅ¼e byÄ‡ ona traktowana jako samodzielna ksiÄ…Å¼ka) doprowadza czytelnika do symbolicznego roku 476, kiedy germaÅ„scy najemnicy zdjÄ™li z tronu ostatniego cesarza zachodniorzymskiego, Romulusa Augustulusa. Dalsze dzieje wschodniej czÄ™Å›ci imperium skÅ‚adajÄ… siÄ™ juÅ¼, wedÅ‚ug naszej terminologii, na historiÄ™ Bizancjum.', 'Upadek.jpg'),
(23, 'Bernard Cornwell', 'Ostatnie KrÃ³lestwo', 'Wojny WikingÃ³w', '1', 'Amanda BeÅ‚dowska', 'The Last Kingdom', '9788362329076', '544', 'historia', 'polski', 'Wyspy brytyjskie, dziewiÄ…ty wiek, czas wewnÄ™trznych niepokojÃ³w, gÅ‚odu i bezpardonowej walki o wÅ‚adzÄ™. Czas najwiÄ™kszego najazdu WikingÃ³w w historii.\r\nSyn jednego z angielskich wielmoÅ¼Ã³w, Uther, zostaje porwany w wieku 10 lat. Jako jedyny ocalaÅ‚y z pogromu caÅ‚ego rodu dorasta wÅ›rÃ³d szczÄ™ku mieczy, pod czuÅ‚Ä… opiekÄ… Å›miertelnych wrogÃ³w.\r\nChoÄ‡ nauczyÅ‚ siÄ™ Å¼yÄ‡ w zgodzie z zasadami WikingÃ³w, w gÅ‚Ä™bi duszy pozostaje synem Brytanii.\r\nNa jego oczach upadajÄ… kolejne krÃ³lestwa, dokonujÄ… siÄ™ zdrady, przewroty i krwawe rzezieâ€¦ Pewnego dnia bÄ™dzie musiaÅ‚ podjÄ…Ä‡ decyzjÄ™, kim jest i ktÃ³remu panu bÄ™dzie sÅ‚uÅ¼yÅ‚.\r\nLos zwiÄ…Å¼e go z Alfredem, wÅ‚adcÄ… ostatniego opierajÄ…cego siÄ™ Wikingom krÃ³lestwa, i da sposobnoÅ›Ä‡, by stawiÅ‚ czoÅ‚a legendarnym wikiÅ„skim wojom, przed ktÃ³rymi drÅ¼y caÅ‚a Å›redniowieczna Europa. SpÄ™tany wiÄ™zami honoru, lojalnoÅ›ci i miÅ‚oÅ›ci, Uther stanie siÄ™ tym, od ktÃ³rego zaleÅ¼eÄ‡ bÄ™dÄ… losy caÅ‚ej Brytanii.\r\nCornwell zanurza czytelnika w okrutnym Å›wiecie Ragnara, Ubby i innych legendarnych wikiÅ„skich wojÃ³w, przed ktÃ³rymi drÅ¼y caÅ‚a Europa.\r\nKolejnym tomem w cyklu jest Zwiastun burzy.', 'OK.jpg'),
(24, 'Andrzej Sapkowski', 'Ostatnie Å»yczenie', 'WiedÅºmin', '1', '---', '---', '9788375780635', '332', 'fantasy', 'polski', 'PÃ³Åºniej mÃ³wiono, Å¼e czÅ‚owiek Ã³w nadszedÅ‚ od pÃ³Å‚nocy, od Bramy PowroÅºniczej. Nie byÅ‚ stary, ale wÅ‚osy miaÅ‚ zupeÅ‚nie biaÅ‚e. Kiedy Å›ciÄ…gnÄ…Å‚ pÅ‚aszcz, okazaÅ‚o siÄ™, Å¼e na pasie za plecami ma miecz.\r\nBiaÅ‚owÅ‚osego przywiodÅ‚o do miasta krÃ³lewskie orÄ™dzie: trzy tysiÄ…ce orenÃ³w nagrody za odczarowanie nÄ™kajÄ…cej mieszkaÅ„cÃ³w Wyzimy strzygi.\r\nTakie czasy nastaÅ‚y. Dawniej po lasach jeno wilki wyÅ‚y, teraz namnoÅ¼yÅ‚o siÄ™ rozmaitego paskudztwa â€“ gdzie spojrzysz, tam upiory, bazyliszki, diaboÅ‚y, Å¼ywioÅ‚aki, wiÅ‚y i utopce plugawe. A i niebacznie uwolniony z amfory dÅ¼inn, potrafiÄ…cy zamieniÄ‡ Å¼ycie spokojnego miasta w koszmar, siÄ™ trafi.\r\nTu nie wystarczÄ… zwykÅ‚e czary ani osinowe koÅ‚ki. Tu trzeba zawodowca.\r\nWIEDÅ¹MINA.\r\nMistrza magii i miecza. TajemnÄ… sztukÄ… wyuczonego, by strzec na Å›wiecie moralnej i biologicznej rÃ³wnowagi.', 'OstatnieZycenie.jpg'),
(25, 'Andrzej Sapkowski', 'Miecz przeznaczenia', 'WiedÅºmin', '2', '---', '---', '9788375780642', '400', 'fantasy', 'polski', 'WiedÅºmiÅ„ski kodeks stawia tÄ™ sprawÄ™ w sposÃ³b jednoznaczny: wiedÅºminowi smoka zabijaÄ‡ siÄ™ nie godzi.\r\nTo gatunek zagroÅ¼ony wymarciem. Aczkolwiek w powszechnej opinii to gad najbardziej wredny. Na oszluzgi, widÅ‚ogony i latawce kodeks polowaÄ‡ przyzwala.\r\nAle na smoki â€“ nie.\r\nWiedÅºmin Geralt przyÅ‚Ä…cza siÄ™ jednak do zorganizowanej przez krÃ³la Niedamira wyprawy na smoka, ktÃ³ry skryÅ‚ siÄ™ w jaskiniach GÃ³r Pustulskich. Na swej drodze spotyka trubadura Jaskra oraz â€“ jakÅ¼eby inaczej â€“ czarodziejkÄ™ Yennefer. WÅ›rÃ³d zaproszonych przez krÃ³la co sÅ‚awniejszych smokobÃ³jcÃ³w jest Eyck z Denesle, rycerz bez skazy i zmazy, RÄ™bacze z Cinfrid i szÃ³stka krasnoludÃ³w pod komendÄ… Yarpena Zigrina. Motywacje sÄ… rÃ³Å¼ne, ale cel jeden.\r\nSmok nie ma szans.', 'mieczPrzeznaczenia.jpg'),
(27, 'Andrzej Sapkowski', 'Krew elfÃ³w', 'WiedÅºmin', '3', '---', '---', '9788375780659', '340', 'fantasy', 'polski', 'Andrzej Sapkowski, arcymistrz Å›wiatowej fantasy, zaprasza do swojego Neverlandu i przedstawia uwielbianÄ… przez czytelnikÃ³w i wychwalanÄ… przez krytykÄ™ wiedÅºmiÅ„skÄ… sagÄ™!\r\n\r\nTako rzecze Ithlinne, elfia wieszczka i uzdrowicielka:\r\nDrÅ¼yjcie, albowiem nadchodzi Niszczyciel NarodÃ³w.\r\nStratujÄ… waszÄ… ziemiÄ™ i sznurem jÄ… podzielÄ….\r\nMiasta wasze zostanÄ… zburzone i pozbawione mieszkaÅ„cÃ³w.\r\nNietoperz i kruk w domach waszych zamieszkajÄ…,\r\ndrzewo straci liÅ›Ä‡, zgnije owoc i zgorzknieje ziarno.\r\nZaprawdÄ™ powiadam wam, oto nadchodzi czas miecza i topora,\r\nwiek wilczej zamieci.\r\nMiasto pÅ‚onie, wÄ…skie uliczki ziejÄ… ogniem i Å¼arem.\r\nNarasta wrzask, odgÅ‚osy zajadÅ‚ej walki, murem wstrzÄ…sajÄ… gÅ‚uche uderzenia taranu.\r\nKrzyk, strach.\r\nObezwÅ‚adniajÄ…cy, paraliÅ¼ujÄ…cy, duszÄ…cy strach.', 'KrewElfow.jpg'),
(30, 'Andrzej Sapkowski', 'Czas pogardy', 'WiedÅºmin', '3', '---', '---', '8370540910', '318', 'fantasy', 'polski', 'Åšwiat Ciri i wiedÅºmina ogarniajÄ… pÅ‚omienie. Nilfgaard najeÅ¼dÅ¼a na sprzymierzone krÃ³lestwa. Czy speÅ‚ni siÄ™ zÅ‚owroga przepowiednia? \r\nTa proza pÃ³jdzie dalej w Å›wiat, juÅ¼ tam wystartowaÅ‚a. OdwoÅ‚uje siÄ™ przecieÅ¼ do tÄ™sknot, emocji i wartoÅ›ci wspÃ³lnych; w swojej klasie jest znakomita i niepowtarzalna... ''Polityka''\r\nChandler zrobiÅ‚ z kryminaÅ‚u moralitet, powieÅ›Ä‡ psychologicznÄ…. Sapkowski podobnie - z opowieÅ›ci o walkach ze smokami stworzyÅ‚ literaturÄ™ najwyÅ¼szej klasy. ''Å»ycie Warszawy''', 'czasPogardy.jpeg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loguj`
--

CREATE TABLE `loguj` (
  `ID_user` int(11) NOT NULL,
  `Login` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Haslo` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Imie` varchar(40) DEFAULT NULL,
  `Nazwisko` varchar(40) DEFAULT NULL,
  `Plec` varchar(1) DEFAULT NULL,
  `DataUrodz` date DEFAULT NULL,
  `Miasto` varchar(40) DEFAULT NULL,
  `Wojewodztwo` varchar(40) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Avatar` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `loguj`
--

INSERT INTO `loguj` (`ID_user`, `Login`, `Haslo`, `Imie`, `Nazwisko`, `Plec`, `DataUrodz`, `Miasto`, `Wojewodztwo`, `Email`, `Avatar`) VALUES
(2, 'd', '3c363836cf4e16666669a25da280a1865c2d2874', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(4, 'zenek', '395df8f7c51f007019cb30201c49e884b46b92fa', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(5, 'k', '13fbd79c3d390e5d6585a21e11ff5ec1970cff0c', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Jakub', 'RospÄ™k', 'M', '1988-08-27', 'KoÅ›cierzyna', 'Pomorskie', 'wyrzyn@wp.pl', 'Kot.jpg'),
(10, 'mama', '99df988b77e60a1718e9e6fecdaf22552047be28', 'mama', 'mama', 'K', '1940-12-01', 'kosc', 'kosc', '', NULL),
(11, 'Marcin', '1cf52227958603e9cfb4ae0794790e148035ce40', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(12, 'kkk', '5150d2104c8cd974b27fad3f25ec4e8098bb7bbe', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(13, 'gggg', '46295fcb2eee0ac3b097d6e78562910fe9d7f27b', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(14, 'tttt', '7278934df282ee1027073d9eedbfee4735c627a5', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(15, 'kuba', '13fbd79c3d390e5d6585a21e11ff5ec1970cff0c', 'Jakub', 'RospÄ™k', 'M', '1988-08-27', 'KoÅ›cierzyna', 'Pomorskie', '', 'zdjmarka.jpg'),
(16, 'PaweÅ‚', 'af3351e8f1a83796ddd46283f8739b8fc6380fa8', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(17, 'Adam', 'f941e1206abd4a2d8889da67be10151f429d95dc', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(24, 'x', '11f6ad8ec52a2984abaafd7c3b516503785c2072', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `ID_oceny` int(11) NOT NULL,
  `oceny_id_user` int(11) NOT NULL,
  `oceny_id_ksiazki` int(11) NOT NULL,
  `ocena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`ID_oceny`, `oceny_id_user`, `oceny_id_ksiazki`, `ocena`) VALUES
(49, 6, 22, 10),
(50, 2, 22, 1),
(51, 5, 22, 2),
(53, 6, 19, 10),
(54, 6, 21, 3),
(55, 2, 19, 8),
(56, 2, 21, 5),
(57, 6, 23, 8),
(58, 2, 23, 8),
(59, 6, 24, 10),
(60, 6, 25, 10),
(61, 6, 27, 8),
(63, 6, 30, 8),
(64, 10, 21, 6),
(65, 5, 21, 6),
(66, 17, 21, 5),
(67, 11, 21, 8),
(70, 14, 21, 6),
(71, 24, 30, 8),
(72, 10, 18, 7),
(73, 5, 18, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `znajomi`
--

CREATE TABLE `znajomi` (
  `ID_zalogowany` int(11) NOT NULL,
  `ID_znajomy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `znajomi`
--

INSERT INTO `znajomi` (`ID_zalogowany`, `ID_znajomy`) VALUES
(2, 6),
(5, 10),
(5, 2),
(5, 17),
(5, 6),
(6, 4),
(6, 5),
(5, 4),
(5, 18),
(6, 10),
(6, 24),
(6, 17),
(6, 16),
(6, 12);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`ID_kom`);

--
-- Indexes for table `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`ID_ksiazki`);

--
-- Indexes for table `loguj`
--
ALTER TABLE `loguj`
  ADD PRIMARY KEY (`ID_user`);

--
-- Indexes for table `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`ID_oceny`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `ID_kom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `ID_ksiazki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT dla tabeli `loguj`
--
ALTER TABLE `loguj`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `ID_oceny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
