# Školení WIGYM 22. 2. 2019 #

## Registrace, přihlášení, session a cookies ##

Body školení byly:

1) Registrace uživatele
2) Přihlášení uživatele + udržování přihlášení v session
3) Hashování hesel
4) Základy bezpečnosti registračních systémů
5) Persistentní přihlášení přes cookies
6) Práce s MySQL databází

Dostali jsme se bohužel jenom k bodu 4), ale v kódu najdete aplikované i body 5) a 6).

### Persistentní přihlášení přes cookies ###

Je více možností, jak toto řešit a ukládat přímo přihlašovací údaje do cookies je nebezpečné. V příkladu je to řešeno tak, že při přihlášení je vygenerován náhodný řetězec (unixový timestamp + náhodný hash). Ten je potom do cookies uložen ve tvaru `{uživatelské jméno}:{náhodný řetězec}`. Stejný řetězec se zahashovaný uloží do databáze jako `cookie_id`.

Při přístupu na stránku se potom kontroluje, jestli má uživatel nastavenou naši cookie a pokud ano, rozdělí si její hodnotu na už. jméno a náhodný řetězec. Ten pak porovná s hashem pro daného uživatele.

Je to podobné jako autentizace heslem, ale oproti heslu můžeme `cookie_id` měnit pravidelně (např. v časovém intervalu) a uživatel pro to nemusí udělat nic.

### Práce s MySQL databází ###

Ze začátku byl připraven soubor `database.php`, který obsahoval funkce pro práci s daty v souboru `database.json`. Ten je teď přejmenován na `database_file.php`, pokud jej chcete používat, stačí ho přejmenovat zpátky na `database.php`.

Soubor `database.php` teď obsahuje funkce pro práci s MySQL databází. Aby vám to fungovalo, musíte v souboru `config.php` nastavit přístupové údaje k databázi, která vám běží na vašem stroji.

*Pozn.: ukázka neobsahuje ošetření proměnných před vložením do databázových požadavků a stejně tak neobsahuje ošetření při práci s `$_POST` proměnnými. Více v materiálech níže.*

### Doplňující materiály ###

 - [Prezentace v PPTX](https://drive.google.com/file/d/1lODCO7FL1Papsi84-DMluviVkM5KppfN/view?usp=sharing)
 - [PHP - Bezpečná příprava dotazů do MySQL](https://www.w3schools.com/php/php_mysql_prepared_statements.asp)
 - [PHP - Ošetření dat z formuláře](https://wp-mix.com/php-sanitize-form-data/)
 - [Jak správně ukládat hesla](https://www.kutac.cz/blog/weby-a-vse-okolo/jak-spravne-ukladat-hesla/)
 - [Bezpečnost a expirace sessions v PHP](https://www.kutac.cz/blog/weby-a-vse-okolo/bezpecnost-a-expirace-sessions-v-php/)
 - [Přechod ze starších hashů na bcrypt](https://www.kutac.cz/blog/weby-a-vse-okolo/prechod-na-bezpecnejsi-bcrypt/)
 - [Změna hashování existujících hesel](https://www.michalspacek.cz/zmena-hashovani-existujicich-hesel)
 - [Crackování hesel z úniku Mall.cz](https://www.michalspacek.cz/crackovani-hesel-z-uniku-mall.cz)
 - [Secure Salted Password Hashing](https://crackstation.net/hashing-security.htm)