# Serwis-WWW
(projekt dyplomowy zrealizowany w ramach kwalifikacjii inżyniera)




serwis internetowy pozwalający użytkownikom na ocenianie i dzielenie się ze znajomymi ulubionymi książkami.



- do serwisu można się zalogować jako administrator lub zwykły użytkownik,

-------------------------------------------------------------------------------------------------------------------------------

- zwykły użytkownik musi się najpierw zarejestrować wypełniając formularz unikatowym loginem i dowolnym hasłem powtarzając je         dwukrotnie. Pomyłka w powtórzonym haśle spowoduje, że rejestracja zostanie zatrzymana i pojawi się komunikat z prośbą o poprawne    wypełnienie formularza rejestracjii.



- Formularz logowania wymaga podania poprawnego loginu i hasła, jeśli którykolwiek z tych warunków nie jest spełniony wyświetla się odpowiedni komunikat.



- po zalogowaniu na swoje koto użytkownik widzi strone główną, znajdują się tutaj sekcje:

  * po prawej znajduje się menu z takimi hiperłączami jak: strona główna, profil, obserwowani, moja półka, szukaj, wyloguj,
    Profil - użytkownik może tu edytować swój avatar i dane osobowe,
    obserwowani - lista wszystkich znajomych,
    moja półka - lista wszystkich ocenionych przez użytkownika książek,
    szukaj - wyszukiwarka umożliwiająca znalezienie danej ksiązki w serwisie po tytule lub autorze (także niepełne frazy)
    
    niżej znajduje się kolumna z 5 użytkownikami którzy ostatnio zarejestrowali się w serwisie.
    Z dowolnego poziomu serwisu można wejść na profil danego użytkownika klikając na jego avatar. Jeśli nie należy do grona znajomych użytkownik widzi tylko 3 ostatnio ocenione książki, przycisk "obserwuj"(czyli dodaj do znajomych), natomiast szczegółowe dane profilowe są zakryte. Po dodaniu do znajomych pojawia się przycisk "usuń z obserwowanych", "zobacz półke" natomiast dane profilowe stają się widoczne.
    
  * "ostatnio dodane przez administratora" - tutaj zawsze wyświetlana jest najnowsza książka dodana do bazy przez admina, po kliknięciu w to hiperłącze wyświetla się lista wszystkich książek w całej bazie danych.
  
  * "ostatnio ocenione" i "skomentowane" przez znajomych - tutaj wyświetlają się maksymalnie 3 pozycje wraz z komentarzem oceniających znajomych (jeśli dany użytkownik ma co najmniej 3 znajomych którzy ocenili lub ocenili i skomentowali jakieś książki). Klikając w hiperłącze "ostatnio ocenione" wyświetla się pełna lista książek ocenionych przez wszystkich znajomych. Klikając w hiperłącze "skometowane" wyświetla się pełna lista książek ocenionych i skomentowanych przez wszystkich znajomych.
  
  * "Zarejestrowanych" użytkowników - klikając w hiperłącze "Zarejestrowanych" wyświetla się lista wszystkich zarejestrowanych użytkowników.
  
  * Poniżej znajduje się informacja o ilości książek w całej bazie danych.

- z każdego poziomu serwisu użytkownik może wejść w panel interesującej go ksiązki (klikając w okładkę) widok panelu składa się:
  * okładki, pełnego opisu bibliograficznego, pola radiobutton w 10 stopniowej skali, średniej oceny danej książki, opisu danej ksiązki, sekcjii na komentarze użytkowników. Każdy użytkownik może usunąć tylko swój komentarz. Po dokonaniu oceny książki ląduje ona automatycznie w sekcjii "moja półka"

--------------------------------------------------------------------------------------------------------------------------------


- administrator może korzystać ze wszystkich funkcjonalności co zwykły użytkownik a ponadto:
  * może dodawać nowe książki do bazy danych poprzez specjalny formularz dostępny w panelu użytkownika tylko na jego profilu,
  * po wejściu na profil danego użytkownika może je usunąć specjalnym przyciskiem,
  * po wejściu w panel danej książki może edytować takie dane jak: 
    Autor - walidacja uniemożliwiająca wpisywanie cyfr,
    Tytuł,
    Cykl,
    Tom - walidacja uniemożliwiająca wpisywanie liter,
    Tlumaczenie - walidacja uniemożliwiająca wpisywanie cyfr,
    Tytul oryginału,
    ISBN,
    Liczba stron - walidacja uniemożliwiająca wpisywanie liter,
    Kategoria - walidacja uniemożliwiająca wpisywanie cyfr,
    Język - walidacja uniemożliwiająca wpisywanie cyfr,
    Zdjęcie okładki,
    Opis,
   lub może daną książkę usunąć specjalnym przyciskiem,
   
   * po wejściu w panel danej książki może usuwać komentarze wszystkich użytkowników specjalnym przyciskiem,
