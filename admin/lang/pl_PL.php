<?php
/****************************************************
* Polish language file / spolszczenie 
* @File:          		pl_PL.php
* @GetSimple Version:   3.1 - 3.2.1
* @Creation Date: 		10 Sep 2010
* @Revision:	    	04 May 2013
* @Translation Version:	1.3.6
* @Traductor:             Wojciech Jodła - www.WuJitsu.pl
* @additional notes: Translation is prepared to operate with GS transliteration functionality.
* @dodatkowe noty: Tłumaczenie jest przystosowane do działania z  funkcją automatycznej transliteracji (zmiana polskich znaków specjalnych na ascii w URL).
*****************************************************/

$i18n = array(

/* 
 * For: install.php
*/
"PHPVER_ERROR"			=>	"<strong>Kontynuacja niemożliwa:</strong> wymagane jest PHP 5.2.0, lub nowsze, na serwerze zainstalowane jest",
"SIMPLEXML_ERROR"		=>	"<strong>Kontynuacja niemożliwa:</strong> <em>SimpleXML</em> nie jest zainstalowany",
"CURL_WARNING"			=>	"<strong>Ostrzeżenie:</strong> <em>cURL</em> nie jest zainstalowany",
"TZ_WARNING"			=>	"<strong>Ostrzeżenie:</strong> <em>date_default_timezone_set</em> nie został ustawiony",
"WEBSITENAME_ERROR"		=>	"<strong>Błąd:</strong> Wystapił problem z tytułem twojej strony",
"WEBSITEURL_ERROR"		=>	"<strong>Błąd:</strong> Wystapił problem z URLem twojej strony",
"USERNAME_ERROR"		=>	"<strong>Błąd:</strong> Nazwa użytkownika nie została podana",
"EMAIL_ERROR"			=>	"<strong>Błąd:</strong> Wystapił problem z Twoim adresem e-mail",

"CHMOD_ERROR"			=>	"<strong>Kontynuacja niemożliwa:</strong> Nie można zapisac pliku konfiguracyjnego. Ustaw <em>CHMOD 777</em> dla katalogów  <b>/data</b> oraz <b>/backups</b> i ich podkatalogów, i spróbuj ponownie",
"EMAIL_COMPLETE"		=>	"Instalacja zakończona",
"EMAIL_USERNAME"		=>	"Twoje imię",
"EMAIL_PASSWORD"		=>	"Twoje nowe hasło",
"EMAIL_LOGIN"			=>	"Logowanie",
"EMAIL_THANKYOU"		=>	"Dziękujemy za korzystanie",


"NOTE_REGISTRATION"		=>	"Twoje dane rejestracji zostały wysłane",
"NOTE_REGERROR"			=>	"<strong>Błąd:</strong> Wystąpił problem z wysłaniem informacji rejestracyjnych na e-mail. Proszę zapisać poniższe hasło",
"NOTE_USERNAME"			=>	"Nazwa użytkownika to",
"NOTE_PASSWORD"			=>	"hasło to",
"INSTALLATION"			=>	"Instalacja",
"LABEL_WEBSITE"			=>	"Nazwa strony",
"LABEL_BASEURL"			=>	"URL strony głównej",
"LABEL_SUGGESTION"		=>	"Sugerowany",
"LABEL_USERNAME"		=>	"Użytkownik (login)",
"LABEL_DISPNAME"		=>	"Wyświetlana nazwa",
"LABEL_EMAIL"			=>	"Adres e-mail",
"LABEL_INSTALL"			=>	"Instaluj!",
"SELECT_LANGUAGE"		=> "Wybierz wersję językową",
"CONTINUE_SETUP" 		=> "Kontynuuj instalację",
"DOWNLOAD_LANG" 		=> "Pobierz dodatkowe pliki językowe </a>
                        <p>Spolszczenie dla Get-Simple CMS 3:<br>
                         Wojciech Jodła - <a href=\"http://www.wujitsu.pl\" target=\"_blank\" >www.WuJitsu.pl</a></p>",

/* 
 * For: pages.php
*/
"MENUITEM_SUBTITLE"		=>	"wyświetlana w menu",
"HOMEPAGE_SUBTITLE"		=>	"Strona główna",
"PRIVATE_SUBTITLE"		=>	"Prywatna",
"EDITPAGE_TITLE"  		=>	"Edytuj stronę",
"VIEWPAGE_TITLE"	  	=>	"Podgląd strony ",
"DELETEPAGE_TITLE"		=>	"Usuń stronę ",
"PAGE_MANAGEMENT"	  	=>	"Zarządzanie stronami",
"TOGGLE_STATUS"	  		=>	"Status strony w menu",
"TOTAL_PAGES"	    	=>	"- stron ogółem",
"ALL_PAGES"		    	=>	"Wszystkie strony",

/* 
 * For: edit.php
*/
"PAGE_NOTEXIST"			=>	"Strona nie istnieje",
"BTN_SAVEPAGE"			=>	"Zapisz stronę",
"BTN_SAVEUPDATES"		=>	"Zapisz aktualizację",
"DEFAULT_TEMPLATE"		=>	"Domyślny szablon",
"NONE"					=>	"Nie",
"PAGE"		    		=>	"Strona",
"NEW_PAGE"			  	=>	"Nowa strona",
"PAGE_EDIT_MODE"		=>	"Tryb edycji strony",
"CREATE_NEW_PAGE"		=>	"Nowa strona",

"VIEW"					=>	"Podgląd strony ", // 'v' is the accesskey identifier
"PAGE_OPTIONS"			=>	"Opcje strony", // 'o' is the accesskey identifier
"SLUG_URL"			  	=>	"nazwa pliku/URL strony",
"TAG_KEYWORDS"			=>	"Tagi i słowa kluczowe",
"PARENT_PAGE"		  	=>	"Podstrona",
"TEMPLATE"			  	=>	"Szablon",
"KEEP_PRIVATE"			=>	"Typ strony",
"ADD_TO_MENU"		  	=>	"Dodaj do menu",
"PRIORITY"			  	=>	"Kolejność",
"MENU_TEXT"			  	=>	"Tekst w menu",
"LABEL_PAGEBODY"		=>	"Body strony",
"CANCEL"				=>	"Anuluj edycję",
"BACKUP_AVAILABLE"		=>	"Dostępna kopia zapasowa strony",
"MAX_FILE_SIZE"			=>	"Maks. rozmiar pliku",
"LAST_SAVED"		  	=>	"Ostatnia aktualizacja",
"FILE_UPLOAD"	  		=>	"Załadowane pliki",
"OR"			      		=>	" lub ",
"SAVE_AND_CLOSE"		=>  "Zapisz i zamknij",
"PAGE_UNSAVED"			=>	"Na stronie dokonano niezapisanych zmian",

/* 
 * For: upload.php
*/

"ERROR_UPLOAD"			=>	"Problem z załadowaniem pliku",
"FILE_SUCCESS_MSG"		=>	"Sukces! Plik załadowany",
"FILE_MANAGEMENT"		=>	"Zarządzanie plikami",
"UPLOADED_FILES"		=>	"Przesłane pliki",
"SHOW_ALL"				=>	"Pokaż wszystkie",
"VIEW_FILE"				=>	"Podgląd pliku",
"DELETE_FILE"			=>	"Usuń plik",
"TOTAL_FILES"			=>	"- wszystkich plików",

/* 
 * For: logout.php
*/
"MSG_LOGGEDOUT"			=>	"Zostałeś wylogowany.",

/* 
 * For: index.php
*/
"LOGIN"			  		=>	"Zaloguj się",
"USERNAME"				=>	"Użytkownik",
"PASSWORD"				=>	"Hasło",
"FORGOT_PWD"			=>	"Zapomniałeś hasła ?",
"CONTROL_PANEL"  		=>	"Panel zarządzania",

/* 
 * For: navigation.php
*/
"CURRENT_MENU" 			=> 	"Aktualne menu",

"NO_MENU_PAGES" 		=> 	"Nie zdefiniowano żadnej strony dla menu głównego.",

/* 
 * For: theme-edit.php
*/
"TEMPLATE_FILE" 	=> 	"Pliki szablonu <strong>%s</strong> pomyślnie zaktualizowano!",
"THEME_MANAGEMENT"	=> 	"Zarządzanie szablonami",
"EDIT_THEME" 		=> 	"Edytuj szablon",
"EDITING_FILE" 		=> 	"Edytowanie pliku",
"BTN_SAVECHANGES" 	=> 	"Zapisz zmiany",
"EDIT" 				=> 	"Edytuj",

/* 
 * For: support.php
*/
"SETTINGS_UPDATED"	=> 	"Ustawienia zostały zaktualizowane",
"UNDO" 				=> 	"Przywróć",
"SUPPORT" 			=> 	"Wsparcie",
"SETTINGS" 			=> 	"Ustawienia",
"ERROR" 			=> 	"Błąd",
"BTN_SAVESETTINGS" 	=> 	"Zapisz ustawienia",
"VIEW_FAILED_LOGIN"	=> 	"Zobacz nieudane próby logowania</a></p></li></ul><br><br>

                        <h3>Tłumaczenie</h3>
						<ul><li><p>Spolszczenie dla Get-Simple CMS: Wojciech Jodła - <a href=\"http://www.wujitsu.pl\" target=\"_blank\" >www.WuJitsu.pl</a></p></li></ul>",

/* 
 * For: log.php
*/
"MSG_HAS_BEEN_CLR"	=> 	" zostało wyczyszczone",
"LOGS" 				=> 	"Logi",
"VIEWING" 			=> 	"Podgląd",
"LOG_FILE" 			=> 	"logu zapisanego w pliku",
"CLEAR_ALL_DATA" 	=> 	"Wyczyść wszystkie dane z",
"CLEAR_THIS_LOG" 	=> 	"Wy<em>c</em>zyść ten log", // 'c' is the accesskey identifier
"LOG_FILE_ENTRY" 	=> 	"WPIS LOGU",
"THIS_COMPUTER"		=>	"Ten komputer",

/* 
 * For: backup-edit.php
*/
"BAK_MANAGEMENT"		=>	"Zarządzanie kopią zapasową i archiwum",
"ASK_CANCEL"			=>	"Zrezygnuj", // 'c' is the accesskey identifier
"ASK_RESTORE"			=>	"Przywróć", // 'r' is the accesskey identifier
"ASK_DELETE"			=>	"Usuń", // 'd' is the accesskey identifier
"BACKUP_OF"				=>	"Kopia",
"PAGE_TITLE"			=>	"Tytuł strony",
"YES"					=>	"Tak",
"NO"					=>	"Nie",
"DATE"					=>	"Data",
"PERMS"					=>  "Permissions",

/* 
 * For: components.php
*/
"COMPONENTS"		  	=>	"Komponenty",
"DELETE_COMPONENT"		=>	"Usuń komponent",
"EDIT"					=>	"Edytuj",
"ADD_COMPONENT"			=>	"Dodaj komponent", // 'a' is the accesskey identifier
"SAVE_COMPONENTS"		=>	"Zapisz komponent",

/* 
 * For: sitemap.php
*/

"SITEMAP_CREATED"		=>	"Mapa strony została utworzona! Wysłany został również ping do 4 serwisów wyszukiwawczych z informacją o aktualizacji",
"SITEMAP_ERRORPING"	=>	"Mapa strony została utworzona, ale wystąpił błąd pingowania jednego lub więcej serwisów wyszukiwania",
"SITEMAP_ERROR"			=>	"<strong>Ostrzeżenie:</strong> mapa strony nie mogła zostać utworzona",
"SITEMAP_WAIT"			=>	"<strong>Proszę czekać:</strong> tworzona jest mapa witryny",

/* 
 * For: theme.php
*/

"THEME_CHANGED"			=>	"Twój szablon został zmieniony",
"CHOOSE_THEME"			=>	"Wybierz szablon",
"ACTIVATE_THEME"		=>	"Aktywuj szablon",
"THEME_SCREENSHOT"		=>	"Obrazek szablonu",
"THEME_PATH"			=>	"Ścieżka do aktualnego szablonu",

/* 
 * For: resetpassword.php
*/
"RESET_PASSWORD"		=>	"Reset hasła",
"YOUR_NEW"				=>	"Twoje nowe",
"PASSWORD_IS"			=>	"hasło to",
"ATTEMPT"				=>	"Próba",

"MSG_PLEASE_EMAIL"		=>	"Podaj adres e-mail zarejestrowanego użytkownika. Nowe hasło zostanie wysłane na ten adres",
"SEND_NEW_PWD"			=>	"Wyślij nowe hasło",

/* 
 * For: settings.php
*/
"GENERAL_SETTINGS"		=>	"Ustawienia główne",
"WEBSITE_SETTINGS"		=>	"Ustawienia strony",
"LOCAL_TIMEZONE"  		=>	"Czas lokalny",
"LANGUAGE"				=>	"Język",

"USE_FANCY_URLS"		=>	"<strong>Użyj przyjaznych URLi</strong> (wymaga włączonej obsługi mod_rewrite u hostingodawcy)",
"ENABLE_HTML_ED"		=>	"<strong>Włącz edytor HTML</strong>",
"WARN_EMAILINVALID"		=>	"Ostrzeżenie: E-mail jest niepoprawny!",

"ONLY_NEW_PASSWORD"		=>	"Wprowadzone poniżej hasło, stanie się nowym hasłem administratora",
"NEW_PASSWORD"			=>	"Nowe hasło",
"CONFIRM_PASSWORD"		=>	"Potwierdź hasło",
"PASSWORD_NO_MATCH"		=>	"Hasła nie pasują do siebie",

"PERMALINK" 			=> 	"Własna struktura linków",
"MORE" 					=> 	"Więcej...",
"HELP" 					=> 	"Pomoc",
"FLUSHCACHE"      		=>  "Wyczyść pamięć podręczną (cache)",
"FLUSHCACHE-SUCCESS"	=>  "Cache został wyczyszczony",
"DISPLAY_NAME"			=>  "(publiczna nazwa użytkownika, nie będąca loginem)",

/* 
 * For: health-check.php
*/
"WEB_HEALTH_CHECK"		=>	"Stan działania strony",
"VERSION"				=>	"Wersja",
"UPG_NEEDED"			=>	"- dostępna jest aktualizacja v.",
"CANNOT_CHECK"			=>	"Nie można sprawdzić. Twoja wersja to",
"LATEST_VERSION"		=>	"Zainstalowana najnowsza wersja",
"SERVER_SETUP"			=>	"Ustawienia serwera",
"OR_GREATER_REQ"		=>	"lub nowsza jest wymagana",
"OK"			     	=>	"OK",
"INSTALLED"			  	=>	"Zainstalowana",
"NOT_INSTALLED"			=>	"Nie zainstalowana",
"WARNING"				=>	"Ostrzeżenie",
"DATA_FILE_CHECK"		=>	"Sprawdzanie integralności plików danych",
"DIR_PERMISSIONS"		=>	"Prawa dostępu do katalogu",
"EXISTANCE"			  	=>	"%s - poprawność", /*lub występowanie/istnienie*/
"MISSING_FILE"			=>	"Nieistniejący plik",/*"Zagubiony plik",*/
"BAD_FILE"		  		=>	"Błędny plik",
"NO_FILE"				=>	"Brak pliku .htaccess",
"GOOD_D_FILE"	  		=>	 "Odmowa dostępu", /*"Good 'Deny' file", */
"GOOD_A_FILE"	  		=>	"Dostęp możliwy &nbsp; &nbsp;",/*"Good 'Allow' file",*/
"CANNOT_DEL_FILE"		=>	"Nie można usunąć pliku",
"DOWNLOAD"			  	=>	"Ściągnij",
"WRITABLE"		  		=>	"Zapisywalny",
"NOT_WRITABLE"			=>	"Nie zapisywalny! ",

/* 
 * For: footer.php
*/
"POWERED_BY"			=>	"Strona oparta na ",

/* 
 * For: backups.php
*/
"PAGE_BACKUPS"			=>	"Kopia zapasowa stron",
"ASK_DELETE_ALL"		=>	"Usuń wszystkie",
"DELETE_ALL_BAK"		=>	"Usunąć wszystkie kopie zapasowe?",
"TOTAL_BACKUPS"			=>	"- wszystkich kopii zapasowych",

/* 
 * For: archive.php
*/


"SUCC_WEB_ARCHIVE"		=>	"<strong>Sukces!</strong> Archiwizacja twojej strony przebiegła poprawnie!",
"SUCC_WEB_ARC_DEL"		=>	"Archiwum strony usunięte",
"WEBSITE_ARCHIVES"		=>	"Archiwa strony www",
"ARCHIVE_DELETED"		=>	"Archiwum zostało usunięte !",
"CREATE_NEW_ARC"		=>	"Utwórz nowe archiwum",
"ASK_CREATE_ARC"		=>	"Utwórz TERAZ nowe archiwum",
"CREATE_ARC_WAIT"		=>	"<strong>Proszę czekać:</strong> tworzenie archiwum strony w toku...",
"DOWNLOAD_ARCHIVES"		=>	"Ściągnij archiwum",
"DELETE_ARCHIVE"		=>	"Usuń archiwum",
"TOTAL_ARCHIVES"		=>	"- liczba wszystkich archiwów",

/* 
 * For: include-nav.php
*/
"WELCOME"			=>	"Zalogowany jako", // used as 'Welcome USERNAME!'
"TAB_PAGES"			=>	"Strony",
"TAB_FILES"			=>	"Pliki",
"TAB_THEME"			=>	"Szablony",
"TAB_BACKUPS"		=>	"Kopia zapasowa i archiwum",
"PLUGINS_NAV" 		=>  "Wtyczki",
"TAB_SETTINGS"		=>	"Ustawienia",
"TAB_SUPPORT"		=>	"Wsparcie",
"TAB_LOGOUT"		=>	"Wyloguj",

/* 
 * For: sidebar-files.php
*/
"BROWSE_COMPUTER"	=>	"Przeglądaj w poszukiwaniu pliku",
"UPLOAD"			=>	"Załaduj",

/* 
 * For: sidebar-support.php
*/
"SIDE_SUPPORT_LOG"		=>	"Wsparcie ustawień i logów",
"SIDE_HEALTH_CHK"	  	=>	"Stan działania strony",
"SIDE_DOCUMENTATION"	=>	"Dokumentacja",
"SIDE_VIEW_LOG"			=>	"Podgląd logów",

/* 
 * For: sidebar-theme.php
*/
"SIDE_VIEW_SITEMAP"	=>	"Zobacz mapę strony",
"SIDE_GEN_SITEMAP"	=>	"Generuj mapę strony",
"SIDE_COMPONENTS"	=>	"Edytuj komponenty",
"SIDE_EDIT_THEME"	=>	"Edytuj szablon",
"SIDE_CHOOSE_THEME"	=>	"Wybierz szablon",

/* 
 * For: sidebar-pages.php
*/
"SIDE_CREATE_NEW"		=>	"Dodaj nową stronę",
"SIDE_VIEW_PAGES"		=>	"Zobacz wszystkie strony",

/* 
 * For: sidebar-settings.php
*/
"SIDE_GEN_SETTINGS"		=>	"Ustawienia główne",
"SIDE_USER_PROFILE"		=>	"Profil użytkownika",

/* 
 * For: sidebar-backups.php
*/
"SIDE_VIEW_BAK"			=>	"Zobacz kopie zapasowe strony",
"SIDE_WEB_ARCHIVES"		=>	"Archiwum strony",
"SIDE_PAGE_BAK"			=>	"Kopia zapasowa stron",
/* 
 * For: error_checking.php
*/
"ER_PWD_CHANGE"			=>	"<strong>Uwaga!</strong> Nie zapomnij o <a href=\"settings.php\">zmianie swojego hasła</a> na takie, które zapamiętasz...",
"ER_BAKUP_DELETED"		=>	"Kopia bezpieczeństwa została skasowana dla %s",
"ER_REQ_PROC_FAIL"		=>	"<strong>Ostrzeżenie:</strong> zadanie nie zostało wykonane",
"ER_YOUR_CHANGES"		=>	"Twoje zmiany %s zostały zapisane",
"ER_HASBEEN_REST"		=>	"%s zostało przywrócone",
"ER_HASBEEN_DEL"		=>	"%s zostało usunięte",
"ER_CANNOT_INDEX"		=>	"Nie można zmienić URL strony głównej (index)",
"ER_SETTINGS_UPD"		=>	"Twoje ustawienia zostały zaktualizowane",
"ER_OLD_RESTORED"		=>	"Twoje stare ustawienia zostały przywrócone",

"ER_NEW_PWD_SENT"		=>	"Nowe hasło zostało wysłane na e-mail podany w konfiguracji",
"ER_SENDMAIL_ERR"		=>	"<strong>Ostrzeżenie:</strong> wystąpił problem z wysłaniem e-maila. Proszę spróbować ponownie",
"ER_FILE_DEL_SUC"		=>	"Plik pomyślnie skasowany",
"ER_PROBLEM_DEL"		=>	"<strong>Ostrzeżenie:</strong> wystąpił problem z usunięciem pliku",
"ER_COMPONENT_SAVE"	=>	"Twoje komponenty zostały zapisane",
"ER_COMPONENT_REST"	=>	"Twoje komponenty zostały przywrócone",
"ER_CANCELLED_FAIL"	=>	"<strong>Rezygnacja:</strong> Aktualizacja tego pliku została anulowana",

/* 
 * For: changedata.php
*/
"CANNOT_SAVE_EMPTY"		=>	"Nie można zapisać pustej strony",
"META_DESC" 			=>  "Opis podstrony (meta description)",
/* 
 * For: template_functions.php
*/
"FTYPE_COMPRESSED"	=>	"Skompresowane", //a file-type
"FTYPE_VECTOR"		=>	"Wektorowe", //a file-type
"FTYPE_FLASH"		=>	"Flash", //a file-type
"FTYPE_VIDEO"		=>	"Wideo", //a file-type
"FTYPE_AUDIO"		=>	"Audio", //a file-type
"FTYPE_WEB"			=>	"Web", //a file-type
"FTYPE_DOCUMENTS"	=>	"Dokumenty", //a file-type
"FTYPE_SYSTEM"		=>	"System", //a file-type
"FTYPE_MISC"		=>	"Różne", //a file-type
"IMAGES"			=>	"Obrazy",
/* 
 * For: login_functions.php
*/
"FILL_IN_REQ_FIELD"	=>	"Proszę wypełnić wszystkie wymagane pola",
"LOGIN_FAILED"		=>	"Podałeś zły login lub hasło. Sprawdź ponownie wpisane dane",
/* 
 * For: Date Format
*/

"DATE_FORMAT"			=>	"j.m.Y", //please keep short
"DATE_AND_TIME_FORMAT"	=>	"j.m.Y - G:i",

/***********************************************************************************
 * SINCE Version 2.0
***********************************************************************************/
/* 
 * For: welcome.php
*/


"WELCOME_MSG"			=>	"Dziękujemy za wybranie GetSimple jako systemu CMS!",
"WELCOME_P"				=>	"Get-Simple pozwala na zarządzanie twoją stroną w niezykle prosty sposób dzięki wysokiej klasy interfejsowi użytkownika i bardzo prostemu systemowi szablonów.",
"GETTING_STARTED"		=>	"Rozpocznij pracę",

/* 
 * For: image.php
*/
"CURRENT_THUMBNAIL"		=> "Aktualna miniaturka",
"RECREATE" 			  	=> "stwórz na nowo",
"CREATE_ONE" 		  	=> "stwórz",
"IMG_CONTROl_PANEL"		=> "Panel zarządzania grafikami",
"ORIGINAL_IMG" 			=> "Oryginalna grafika",
/*"CLIPBOARD_COPY" 		=> "Kopiuj do schowka",*/
"CLIPBOARD_INSTR"	 	=> "Zaznacz wszystko",/*, po czym kliknij <em>ctrl-c</em> lub <em>command-c</em>",*/
"CREATE_THUMBNAIL" 		=> "Stwórz miniaturkę",
"CROP_INSTR_NEW" 		=> "<em>ctrl-B</em> lub <em>command-B</em> aby zaznaczyć kwadrat",
"SELECT_DIMENTIONS" 	=> "Wybierz obszar",
"HTML_ORIG_IMG" 		=> "Kod HTML dla oryginalnej grafiki",
"LINK_ORIG_IMG" 		=> "Odnośnik do oryginalnej grafiki",
"HTML_THUMBNAIL" 		=> "Kod HTML dla miniaturki",
"LINK_THUMBNAIL" 		=> "Odnośnik do miniaturki",
"HTML_THUMB_ORIG" 		=> "Odnośnik w postaci miniaturki do oryginalnej grafiki",

/* 
 * For: plugins.php
*/
"PLUGINS_MANAGEMENT"	=> "Zarządzanie wtyczkami",
"PLUGINS_INSTALLED" 	=> "wtyczek zainstalowanych",
"SHOW_PLUGINS"		  	=> "Zainstalowane w<em>t</em>yczki",
"PLUGIN_NAME" 	  		=> "Nazwa",
"PLUGIN_DESC" 	  		=> "Opis",
"PLUGIN_VER" 			=> "Wersja",

/***********************************************************************************
 * SINCE Version 2.03
***********************************************************************************/

// tablica zamiany polskich znaków diakrytycznych w automatycznie generowanych linkach podstron

"TRANSLITERATION" => array(
  "Ą"=>"A","Ć"=>"C","Ę"=>"E",
  "Ł"=>"L","Ń"=>"N","Ó"=>"O",
  "Ś"=>"S","Ź"=>"Z","Ż"=>"Z",
  "ą"=>"a","ć"=>"c","ę"=>"e",
  "ł"=>"l","ń"=>"n","ó"=>"o",
  "ś"=>"s","ź"=>"z","ż"=>"z",
  "№"=>"#","—"=>"-","."=>"-",
  ","=>"-"
),

/***********************************************************************************
 * SINCE Version 2.04 / 3.0B
***********************************************************************************/

/* 
 * For: setup.php
 */

"ROOT_HTACCESS_ERROR"     => "<strong>Ostrzeżenie:</strong> nie było możliwe utworzenie pliku .htaccess w katalogu głównym! Skopiuj <b>%s</b> jako  <b>.htaccess</b> i zmień <code>%s</code> na <code>%s</code>",
"REMOVE_TEMPCONFIG_ERROR" => "<strong>Ostrzeżenie:</strong> nie można usunąć<b>%s</b>! Proszę usunąć plik własnoręcznie.",
"MOVE_TEMPCONFIG_ERROR"   => "<strong>Ostrzeżenie:</strong> nie można zmienić nazwy <b>%s</b> na <b>%s</b>! Proszę zrobić to własnoręcznie.",
"KILL_CANT_CONTINUE"      => "<strong>Ostrzeżenie:</strong> nie można kontynuować. Proszę poprawić błędy i spróbować ponownie.",
"REFRESH"                 => "Odśwież stronę",
"BETA"                    => "Beta / Bleeding Edge",
/*
 * Misc Cleanup Work
 */

# new to 3.0 
"HOMEPAGE_DELETE_ERROR" => "Nie możesz usunąć strony głównej",
"NO_ZIPARCHIVE"         => "rozszerzenie ZipArchive nie jest zainstalowane. Kontynuacja nie jest możliwa", //zip
"REDIRECT_MSG"          => "Jeśli Twoja przeglądarka nie przekieruje Cię automatycznie, <a href=\"%s\">kliknij tutaj</a>", //basic
"REDIRECT"              => "Przekierowanie", //basic
"DENIED"                => "Odmowa", //sitemap
"DEBUG_MODE"            => "Tryb debugowania", //nav-include
"DOUBLE_CLICK_EDIT"     => "Kliknij dwa razy aby edytować", //components
"THUMB_SAVED"           => "Zapisano miniaturkę", //image
"EDIT_COMPONENTS"       =>	"Edytuj komponenty", //components
"REQS_MORE_INFO"        => "<p>Więcej informacji o wymaganych modułach jest dostępnych na stronie z <a href=\"%s\" target=\"_blank\" >wymaganiami instalacyjnymi</a>.</p>", //install & health-check
"SYSTEM_UPDATE"         => "Aktualizacja systemu", // update.php
"AUTHOR" 				=> "Autor", //plugins.php
"ENABLE" 				=> "Włącz", //plugins.php
"DISABLE" 				=> "Wyłącz", //plugins.php
"NO_THEME_SCREENSHOT"   => "Miniatura szablonu nieodstępna", //theme.php
"UNSAVED_INFORMATION"   => "You are about to leave this page and will lose any unsaved information.", //edit.php
"BACK_TO_WEBSITE"       => "Powrót na stronę główną", //index & resetpassword
"SUPPORT_FORUM"         => "Forum pomocy", //support.php
"FILTER"                => "Filtr stron", //pages.php
"UPLOADIFY_BUTTON"      => "Załaduj pliki/obrazy...", //upload.php
"FILE_BROWSER"          => "Menedżer plików", //filebrowser.php
"SELECT_FILE"           => "Wybierz plik", //filebrowser.php
"CREATE_FOLDER"         => "Załóż nowy folder", //upload.php
"THUMBNAIL"             => "Miniaturka", //filebrowser.php
"ERROR_FOLDER_EXISTS"   => "<strong>Ostrzeżenie:</strong> folder który próbujesz utworzyć już istnieje!", //upload.php
"FOLDER_CREATED"        => "Nowy folder został założony: <strong>%s</strong>", //upload.php
"ERROR_CREATING_FOLDER" => "<strong>Ostrzeżenie:</strong> wystąpił problem podczas zakładania nowego folderu", //upload.php
"DELETE_FOLDER"         => "Usuń folder", //upload.php
"FILE_NAME"             => "Nazwa pliku", //multiple tr header rows
"FILE_SIZE"             => "Rozmiar", //multiple tr header rows
"ARCHIVE_DATE"          => "Data archiwum", //archive.php
"CKEDITOR_LANG" 		=> "pl", // edit.php ; set CKEditor language, don't forget to include CKEditor language file in translation zip


/***********************************************************************************
 * SINCE Version 3.1B
***********************************************************************************/

"XML_INVALID" => "plik XML nieprawidłowy", //template-functions.php
"XML_VALID" => "plik XML prawidłowy",
"UPDATE_AVAILABLE" => "Aktualizuj do", //plugins.php
"STATUS" => "Status", //plugins.php
"CLONE" => "Duplikuj stronę", //edit.php
"CLONE_SUCCESS" => "<strong>%s</strong> - zduplikowano poprawnie", //pages.php
"COPY" => "Kopiuj", //pages.php
"CLONE_ERROR" => "<strong>Ostrzeżenie:</strong> Wystapił problem podczas duplikowania <strong>%s</strong>",  //pages.php
"AUTOSAVE_NOTIFY" => 'Strona zapisana automatycznie o', //edit.php
"MENU_MANAGER" => '<em>M</em>enedżer menu', //edit.php
"GET_PLUGINS_LINK" => 'Pobierz dodatkowe pluginy', /*Download <em>M</em>ore Plugins',*/
"SITEMAP_REFRESHED" => "Mapa strony została odświeżona", //edit.php
"LOG_FILE_EMPTY" 		=> 	"Plik z logu jest pusty", //log.php
"SHARE" 		=> 	"Udostępnij", //footer.php
//"NO_PARENT" => "Nie posiada strony nadrzędnej", //edit.php
"NO_PARENT" => "Nie zagnieżdżona", //edit.php
"REMAINING" => "pozostało znaków", //edit.php
//"NORMAL" => "Zwykły", //edit.php
"NORMAL" => "Publiczna", //edit.php
"ERR_CANNOT_DELETE" => "<strong>Ostrzeżenie:</strong> Nie można usunąć %s automatycznie. Proponowane jest usunięcie ręczne", //common.php ręczniePlease do this manually.
"ADDITIONAL_ACTIONS" => "Pozostałe akcje", //edit.php
"ITEMS" => "items", //upload.php
"SAVE_MENU_ORDER" => "Zapisz strukturę menu", //menu-manager.php

"MENU_MANAGER_DESC" => "Chwytaj i przeciągaj elementy menu aby ustalać ich kolejność. Nie zapomnij zapisać zmian w strukturze menu.",//menu-manager.php
"MENU_MANAGER_SUCCESS" => "Nowa kolejność elementów w menu została zapisana", //menu-manager.php


/* 
 * For: api related pages
 */
"API_ERR_MISSINGPARAM" => 'podany parametr nie istnieje', /*parameter data does not exist',*/
"API_ERR_BADMETHOD" => 'metoda %s nie istnieje',
"API_ERR_AUTHFAILED" => 'uwierzytelnianie zakończone niepowodzeniem', /*authentication failed',*/
"API_ERR_AUTHDISABLED" => 'uwierzytelnianie wyłączone',
"API_ERR_NOPAGE" => 'strona %s nie istnieje',
"API_CONFIGURATION" => 'Konfiguracja API',
"API_ENABLE" => 'Uaktywnij API',
"API_REGENKEY" => 'Generuj nowy klucz dostępu',
"API_DISCLAIMER" => "Aktywując tę opcję umożliwisz zewnętrznym aplikacjom, posiadającym kopię klucza, dostęp do danych zawartych na twojej stronie. <strong>Używaj tej opcji wyłącznie w zaufanych aplikacjach.</strong>",
/*"API_DISCLAIMER" => "By enabling this API you are allowing any external application that has a copy of your key to have access to your website's data. <b>Only share this key with applications you trust.</b>",*/

"API_REGEN_DISCLAIMER" => "Nowy klucz dostępu do API, wymaga zmiany starego klucza w zewnętrznych aplikacjach korzystających z danych na Twojej stronie.",
"API_CONFIRM" => "Jesteś pewien?",

/*
 * Additions for 3.1
 */
"DEBUG_CONSOLE" => 'Konsola debugowania',
"X" => "not translated",
"" => "not translated"
);

?>
