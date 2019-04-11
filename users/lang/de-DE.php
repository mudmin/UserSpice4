<?php
/*
TO CREATE A NEW LANGUAGE, COPY THE en-us.php to your own localization code name.
We are going to keep these files in the iso xx-xx format because that will also
allow us to autoformat numbers on the sites.

PLEASE put your name somewhere at the top of the language file so we can get in touch with
you to update it and thank you for your hard work!

PLEASE NOTE: DO NOT ADD RANDOM KEYS in the middle of the translations.  In order to make it easier to tell what language keys are missing, from this point forward, we are going to add all new language keys at the BOTTOM of this file. The number of lines in your language file will tell you which keys still need to be translated.  If you have questions please ask on the forums or on Discord.

UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*
%m1% - Dymamic markers which are replaced at run time by the relevant index.
*/

$lang = array();
//important strings
$lang = array_merge($lang,array(
"THIS_LANGUAGE"	=>"Deutsch",
"THIS_CODE"			=>"de-DE",
"MISSING_TEXT"	=>"Missing Text",
));
// Signup
$lang = array_merge($lang,array(
	"SIGNUP_TEXT"					=> "Registrieren",
	"SIGNUP_BUTTONTEXT"		=> "Registrieren",
	"SIGNUP_AUDITTEXT"		=> "Registriert",
	));

// Signin
$lang = array_merge($lang,array(
	"SIGNIN_FAIL"				=> "** Anmeldung fehlgeschlagen **",
	"SIGNIN_PLEASE_CHK" => " Anmeldungsdaten bitte überfrüfen, und erneut versuchen",
	"SIGNIN_UORE"				=> "Benutzername oder Email",
	"SIGNIN_PASS"				=> "Passwort",
	"SIGNIN_TITLE"			=> "Bitte anmelden",
	"SIGNIN_FORGOTPASS"		=>"Passwort vergessen",
	"SIGNIN_TEXT"				=> "Anmelden",
	"SIGNOUT_TEXT"			=> "Abmelden",
	"SIGNIN_BUTTONTEXT"	=> "Anmelden",
	"SIGNIN_REMEMBER"		=> "Angemeldet bleiben",
	"SIGNIN_AUDITTEXT"	=> "Angemeldet",
	"SIGNOUT_AUDITTEXT"	=> "Abgemeldet",
	));

// Account Page
$lang = array_merge($lang,array(
	"ACCT_EDIT"					=> "Konto bearbeiten",
	"ACCT_2FA"					=> "2Faktor-Authentisierung verwalten",
	"ACCT_SESS"					=> "Sitzungen verwalten",
	"ACCT_HOME"					=> "Kontoseite",
	"ACCT_SINCE"				=> "Mitglieder seit",
	"ACCT_LOGINS"				=> "Anzal der Anmeldungen",
	"ACCT_SESSIONS"			=> "Anzal der aktiven Sitzungen",
	"ACCT_MNG_SES"			=> "F&uuml;r weitere Informationen, bitte auf - Sitzungen verwalten - links klickenClick.",
	));

	//General Terms
	$lang = array_merge($lang,array(
		"GEN_ENABLED"			=> "Aktiviert",
		"GEN_DISABLED"		=> "Deaktivert",
		"GEN_ENABLE"			=> "Aktivieren",
		"GEN_DISABLE"			=> "Deaktiviren",
		"GEN_NO"					=> "Nein",
		"GEN_YES"					=> "Ja",
		"GEN_MIN"					=> "min",
		"GEN_MAX"					=> "max",
		"GEN_CHAR"				=> "char", //as in characters
		"GEN_SUBMIT"			=> "Senden",
		"GEN_MANAGE"			=> "Verwalten",
		"GEN_VERIFY"			=> "Überprüfen",
		"GEN_SESSION"			=> "Sitzung",
		"GEN_SESSIONS"		=> "Sitzungen",
		"GEN_EMAIL"				=> "Email",
		"GEN_FNAME"				=> "Vorname",
		"GEN_LNAME"				=> "Nachname",
		"GEN_UNAME"				=> "Benutzername",
		"GEN_PASS"				=> "Passwort",
		"GEN_MSG"					=> "Nachricht",
		"GEN_TODAY"				=> "Heute",
		"GEN_CLOSE"				=> "Schlie&szlig;en",
		"GEN_CANCEL"			=> "Abbrechen",
		"GEN_CHECK"				=> "[ Alles selektieren / deslektieren ]",
		"GEN_WITH"				=> "mit",
		"GEN_UPDATED"			=> "aktualisiert",
		"GEN_UPDATE"			=> "Aktulisieren",
		"GEN_BY"					=> "bei",
		"GEN_ENABLE"			=> "Aktivieren",
		"GEN_DISABLE"			=> "Deaktiviren",
		"GEN_FUNCTIONS"		=> "Funktionen",
		"GEN_NUMBER"			=> "Zahl",
		"GEN_NUMBERS"			=> "Zahlen",
		"GEN_INFO"				=> "Information",
		"GEN_REC" 				=> "Recorded",
		"GEN_DEL" 				=> "Entfernen",
		"GEN_NOT_AVAIL" 	=> "nicht verf&uml;gbar",
		"GEN_AVAIL" 			=> "verf&uml;gbar",
		"GEN_BACK" 				=> "Zur&uuml;ck",
		"GEN_RESET" 			=> "Zur&uuml;ck stzten",
		"GEN_REQ"					=> "required",
		"GEN_AND"					=> "and",
		"GEN_SAME"				=> "must be the same",
		));

//validation class
	$lang = array_merge($lang,array(
		"VAL_SAME"				=> "must be the same",
		"VAL_EXISTS"			=> "already exists. Please choose another",
		"VAL_DB"					=> "Database Error",
		"VAL_NUM"					=> "must be a number",
		"VAL_INT"					=> "must be a whole number",
		"VAL_EMAIL"				=> "must be a valid email addresss",
		"VAL_NO_EMAIL"		=> "cannot be an email addresss",
		"VAL_SERVER"			=> "must belong to a valid server",
		"VAL_LESS"				=> "must be less than",
		"VAL_GREAT"				=> "must be greater than",
		"VAL_LESS_EQ"			=> "must be less than or equal to",
		"VAL_GREAT_EQ"		=> "must be greater than or equal to",
		"VAL_NOT_EQ"			=> "must not be equal to",
		"VAL_EQ"					=> "must be equal to",
		"VAL_TZ"					=> "has to be a valid time zone name",
		"VAL_MUST"				=> "must be",
		"VAL_MUST_LIST"		=> "must be one of the following",
		"VAL_TIME"				=> "must be a valid time",
		"VAL_SEL"					=> "is not a valid selection",
		"VAL_NA_PHONE"		=> "must be a valid North American phone number",
	));
		//Time
	$lang = array_merge($lang,array(
		"T_YEARS"			=> "Jahre",
		"T_YEAR"			=> "Jahr",
		"T_MONTHS"		=> "Monate",
		"T_MONTH"			=> "Monat",
		"T_WEEKS"			=> "Wochen",
		"T_WEEK"			=> "Woche",
		"T_DAYS"			=> "Tage",
		"T_DAY"				=> "Tag",
		"T_HOURS"			=> "Stunden",
		"T_HOUR"			=> "Stunde",
		"T_MINUTES"		=> "Minuten",
		"T_MINUTE"		=> "Minute",
		"T_SECONDS"		=> "Sekunden",
		"T_SECOND"		=> "Sekunde",
		));


		//Passwords
	$lang = array_merge($lang,array(
		"PW_NEW"		=> "Neues Passwort",
		"PW_OLD"		=> "Altes Psswort",
		"PW_CONF"		=> "Passwort best&auml;tigen",
		"PW_RESET"	=> "Passwort zur&uuml;cksetzen",
		"PW_UPD"		=> "Passwort aktualisiert",
		"PW_SHOULD"	=> "Passw&ouml;rter sollen...",
		"PW_SHOW"		=> "Passwort anzeigen",
		"PW_SHOWS"	=> "Passw&ouml;rter anzeigen",
		));


		//Join
	$lang = array_merge($lang,array(
		"JOIN_SUC"		=> "Willkommen bei ",
		"JOIN_THANKS"	=> "Danke f&uumlr die Registrierung!",
		"JOIN_HAVE"		=> "Have at least ",
		"JOIN_CAP"		=> " Gro&szlig;buchstabe",
		"JOIN_TWICE"	=> "Zweimal richtig eingegeben",
		"JOIN_CLOSED"	=> "Registrierung is derzeit leider deaktiviert. Bei Fragen melden Sie sich bitte beim Administrator.",
		"JOIN_TC"			=> "Allgemeine Gesch&auml;hftsbedingungen (AGB)",
		"JOIN_ACCEPTTC" => "I Accept User Terms and Conditions",
		"JOIN_CHANGED"	=> "Our Terms Have Changed",
		"JOIN_ACCEPT" 	=> "Accept User Terms and Conditions and Continue",
		));


		//Sessions
	$lang = array_merge($lang,array(
		"SESS_SUC"	=> "Erfolgreich gschlossen ",
		));

		//Messages
	$lang = array_merge($lang,array(
		"MSG_SENT"			=> "Nachriht wurde gesendet!",
		"MSG_MASS"			=> "Massennachricht wurde gesendet!",
		"MSG_NEW"				=> "Neue Nachricht",
		"MSG_NEW_MASS"	=> "Neue Massennachricht",
		"MSG_CONV"			=> "Konversationen",
		"MSG_NO_CONV"		=> "Keine Konversationen",
		"MSG_NO_ARC"		=> "Keine Konversationen",
		"MSG_QUEST"			=> "Email senden, wenn aktiviert?",
		"MSG_ARC"				=> "Archivierte Threads",
		"MSG_VIEW_ARC"	=> "Archivierte Threads anzeigen",
		"MSG_SETTINGS"  => "Nachrichteinstellungen",
		"MSG_READ"			=> "gelesen",
		"MSG_BODY"			=> "Text",
		"MSG_SUB"				=> "Betreff",
		"MSG_DEL"				=> "Geliefert",
		"MSG_REPLY"			=> "Antworten",
		"MSG_QUICK"			=> "Schnelle Antwort",
		"MSG_SELECT"		=> "Benutzer ausw&auml;hlen",
		"MSG_UNKN"			=> "Unbekannter Empf&auml;nger",
		"MSG_NOTIF"			=> "Bmail-Benachrichtigungen",
		"MSG_BLANK"			=> "Nachright kann nicht leer sein",
		"MSG_MODAL"			=> "Hier klicken oder Alt + R drucken, um eine schnelle Atwort zu schriben, oder Umschalttaste + R um ein derweitertes Fenster zu &ouml;ffnen!",
		"MSG_ARCHIVE_SUCCESSFUL"        => "%m1% Threads wurden erfogreich archiviert",
		"MSG_UNARCHIVE_SUCCESSFUL"      => "%m1% Threads wurden erfogreich dearchiviert",
		"MSG_DELETE_SUCCESSFUL"         => "%m1% Threads wurden erfogreich gel&ouml;scht",
		"USER_MESSAGE_EXEMPT"         			=> "Benutzer %m1% ist von Nachrichten ausgenommen.",
		"MSG_MK_READ" 		=> "gelesen",
		"MSG_MK_UNREAD" 	=> "ungelesen",
		"MSG_ARC_THR" 		=> "Ausgew&auml;hlte threads archivieren",
		"MSG_UN_THR" 			=> "Ausgew&auml;hlte threads dearchivieren",
		"MSG_DEL_THR" 		=> "Ausgew&auml;hlte threads entfernen",
		"MSG_SEND" 				=> "Nachricht senden",

		));

	//2 Factor Authentication
	$lang = array_merge($lang,array(
		"2FA"				=> "2Faktor-Authentisierung",
		"2FA_CONF"	=> "Wollen Sie wirklich 2FA deaktivieren? Ihr Konto wird daduch nicht mehr gesch&uuml;tzt.",
		"2FA_SCAN"	=> "QR-Code bitte mit Ihrer Authentisierung-App scannen, oder Schl&uuml;ssel eingeben",
		"2FA_THEN"	=> "Dann geben Sie einen Ihrer einmaligen Passkeys hier ein",
		"2FA_FAIL"	=> "Problem bei Verifizierung von 2FA. Bitte Ihre Internetverbindung Pr&uuml;fen, oder Support kontaktieren .",
		"2FA_CODE"	=> "2FA-Code",
		"2FA_EXP"		=> "1 Fingerabruck wurde Erl&ouml;scht",
		"2FA_EXPD"	=> "Erl&ouml;scht",
		"2FA_FP"		=> "Fingerabruck",
		"2FA_NP"		=> "<strong>Anmeldung fehlgeschlagen</strong> 2Faktor-Authentisierungscode fehlt. Bitte erneut versuchen.",
		"2FA_INV"		=> "<strong>Anmeldung fehlgeschlagen</strong> 2Faktor-Authentisierungscode ist nicht g&uuml;ltig. Bitte erneut versuchen.",
		"2FA_FATAL"	=> "<strong>Unbehebbarer+Fehler</strong> Systemadministrator bitte kontaktieren.",
		"2FA_EXPS"	=> "L&auml;uft ab",
		"2FA_ACTIVE"=> "Aktive Sitzungen",
		"2FA_NOT_FN"=> "Keine Fingerabr&uuml;cke gefunden",
		));

	//Redirect Messages - These get a plus between each word
	$lang = array_merge($lang,array(
		"REDIR_2FA"						=> "Entschuldigung.2Faktor-Authentisierung+ist+Fuer+diesen+Benutzer+deaktiviert",
		"REDIR_2FA_EN"				=> "2Faktor-Authentisierung+wurde+aktiviert",
		"REDIR_2FA_DIS"				=> "2Faktor-Authentisierung+wurde+deaktiviert",
		"REDIR_2FA_VER"				=> "2Faktor-Authentisierung+wurde+verifiziert+und+aktiviert",
		"REDIR_SOM_TING_WONG" => "Something+went+wrong.+Please+try+again.",
		"REDIR_MSG_NOEX"			=> "Der+Thread+existiert+nicht+oder+Zugriff+verweigert.",
		"REDIR_UN_ONCE"				=> "Benutzername+kann+nur+einmal+aktualisiert+werden",
		"REDIR_EM_SUCC"				=> "Emailadresse+erfogreich+aktualisiert",
		));

	//Emails
	$lang = array_merge($lang,array(
		"EML_CONF"			=> "Emaladdresse best&auml;tigen",
		"EML_VER"				=> "Emailadresse best&auml;tigen",
		"EML_CHK"				=> "Ihre Anfrage wurde erhalten. Pr&uuml;fen Sie bitte Ihr Posteingang, um die Verifizierung auszuf&uml;hren. Pr&uuml;fen Sie Bitte Ihren Spam-Ordner, falls Sie die Email im Posteingang nicht finden k&ouml;nnen. G&uuml;ltigkeit des Verifizierungslinks: ",
		"EML_MAT"				=> "Emailadressen stimmen nicht &uuml;ber.",
		"EML_HELLO"			=> "Hallo von ",
		));

		//Verification
		$lang = array_merge($lang,array(
			"VER_SUC"			=> "Ihre Emailadresse wurde &uuml;berfr&uuml;ft!",
			"VER_FAIL"		=> "Ihr Konto konnte nich &uuml;berfr&uuml;ft werden. Bitte erneut versuchen.",
			"VER_RESEND"	=> "Verifizierungsemail neu senden",
			"VER_AGAIN"		=> "Emailadresse nochmal eingeben, und erneut versuchen.",
			"VER_PAGE"		=> "<li>Wir haben Ihnen einen Link per Email gesendet</li><li>Fertig</li>",
			"VER_RES_SUC" => "<p>Ihre Anfrage wurde erhalten. Pr&uuml;fen Sie bitte Ihr Posteingang, um die Verifizierung auszuf&uml;hren. Pr&uuml;fen Sie Bitte Ihren Spam-Ordner, falls Sie die Email im Posteingang nicht finden k&ouml;nnen.</p><p>G&uuml;ltigkeit des Verifizierungslinks: ",
			"VER_OOPS" 		=> "Oh je! Etwas ist schiefgegengen, Vielleicht wurde ein abgelaufener Reset-Link geklickt. Bitte unten klicken, um neu zu versuchen",
			"VER_RESET" 	=> "Ihr Passwort wurde Zur&uuml;ckgesetzt!",
			"VER_INS" 		=> "<li>Emailadresse eingeben und auf Zur&uuml;setzen klicken</li> <li>Posteingang pr&uuml;fen und auf den Reset-Link Klicken.</li> <li>Bildschirmanweisungen folgen</li>",
			"VER_SENT" 		=> "<p>Einen Link zur Passwortrücksetzung wurde Ihnen per Email gschickt.</p> <p>Bitte darauf klicken, um Ihr Passwort zur&uuml;ckzusetzen. Pr&uuml;fen Sie Bitte Ihren Spam-Ordner, falls Sie die Email im Posteingang nicht finden k&ouml;nnen.</p><p>G&uuml;ltigkeit des Verifizierungslinks: ",
			"VER_PLEASE" => "Bitte setzen Sie Ihr Passwort zur&uuml;ck",
			));

	//User Settings
	$lang = array_merge($lang,array(
		"SET_PIN"				=> "PIN Zur&uuml;setzen",
		"SET_WHY"				=> "Warum kann ich das nicht &auml;ndern?",
		"SET_PW_MATCH"	=> "Muss das neue Passwort übereinstimmen",

		"SET_PIN_NEXT"	=> "PIN kann bei n&auml;chstem Verifizierungsberarf erneut werden",
		"SET_UPDATE"		=> "Benutzereinstellungen aktualisieren",
		"SET_NOCHANGE"	=> "&Auml;nderung des Benutzername ist deaktiviert.",
		"SET_ONECHANGE"	=> "Benutzername kann nur einmal ge&auml;ndert werden. Ihr Benutzername wurden bereits einmal ge&auml;ndert.",

		"SET_GRAVITAR"	=> "<strong>Wollen Sie Ihr Profilbild &auml;ndern? </strong><br> Bitte ein Konto auf <a href='https://en.gravatar.com/'>https://en.gravatar.com/</a> mit der selben Emailadresse erstellen. Es funktioniert f&uuml; viele Websiten. Es geht schnell und einfach!",

		"SET_NOTE1"			=> "<p><strong>Hinweis</strong> Wir haben eine ausstehende Anfrage, Ihre Emailadresse nach",

		"SET_NOTE2"			=> ".</p><p> zu &auml;ndern. Bitte den Link in der Verifizierungsemail benutzen um Ihre Anfrage fort zu setzen.</p>
		<p>Um die Verifizierungsemail nochnal zu erhalten, Geben Sie bitte Ihre Emailadresse oben ein, und die Formular neu senden.</p>",

		"SET_PW_REQ" 		=> "Ben&ouml;tigt, um Ihr Passwort, PIN, oder Emailadresse zu &auml;ndern",
		"SET_PW_REQI" 	=> "Ben&ouml;tigt, um Ihr Passwort zu &auml;ndern",

		));

	//Errors
	$lang = array_merge($lang,array(
		"ERR_FAIL_ACT"		=> "Aktive Sitzung konnte nicht geschlossen werden, Fehler: ",
		"ERR_EMAIL"				=> "Email wurde nicht gesendet. Bitte Administrator kontaktieren.",
		"ERR_EM_DB"				=> "Diese Emailadresse existiert in unserer Datenbank nicht.",
		"ERR_TC"					=> "AGB bitte lesen und akzeptieren",
		"ERR_CAP"					=> "Captcha-Test nicht bestanden, Roboter!",
		"ERR_PW_SAME"			=> "Das neue Passwort muss anders als das alte Passwort sein.",
		"ERR_PW_FAIL"			=> "Alte Passwort stimmt nicht. Aktualisierung fehlgeschlagen. Bitte erneut versuchen.",
		"ERR_GOOG"				=> "<strong>Hinweis:</strong> Falls Sie sich mit Ihrem Google/Facebook Konto registriert haben, m&uuml;ssen Sich den - Passwort vergessen - Link benutzen, um Ihr Passwort zu &auml;ndern, es sei denn, dass Sie richttig gut raten k&ouml;nnen",
		"ERR_EM_VER"			=> "Email&uuml;berfr&uuml;fung ist nich aktiviert. Bitte Systemadministrator kontaktieren.",
		"ERR_EMAIL_STR"		=> "Etwas stimmt nicht. Emailadresse bitte neu &uuml;berfr&uuml;fen. Entschuldigung f&uuml; die Unannehmlichkeit.",
		));

	//Maintenance Page
	$lang = array_merge($lang,array(
		"MAINT_HEAD"		=> "Wir werden bald zur&uuml;ck sein!",
		"MAINT_MSG"			=> "Entschuldigung f&uuml;r die Unannehmlichkeiten, wir f&uuml;hren gerade enige Wartungsarbeiten aus.<br> Wir werden kurz wieder online!",
		"MAINT_BAN" 		=> "Es tut uns leid. Sue wurden Blockiert. Bitte den Systemadministrator kontaktieren, falls Sie glauben, das es ein Fehler gibt.",
		"MAINT_TOK" 		=> "Es gibt einen Fehler im Formular. Bitte erneut versuchen. Hinweis: Form If this continues to happen, please contact the administrator.",
		"MAINT_OPEN" 		=> "Ein quelloffenes PHP-Benutzerverwaltungssystem.",
		"MAINT_PLEASE" 	=> "Sie haben Userspice erfolgreich installiert!<br>Die Kurzanleitung befindet sich unter ",
		));

	//Database Menus
	$lang = array_merge($lang,array(
		"MENU_HOME"            => "Startseite",
		"MENU_HELP"            => "Hilfe",
		"MENU_ACCOUNT"    		 => "Konto",
		"MENU_DASH"            => "Adminbereich",
		"MENU_USER_MGR"	=> "User Management",
		"MENU_PAGE_MGR"   		 => "Seitenverwaltung",
		"MENU_PERM_MGR"    		 => "Zugriffsverwaltung",
		"MENU_MSGS_MGR"    		 => "Nachrichtenverwaltung",
		"MENU_LOGS_MGR"        => "Systembericht",
		"MENU_LOGOUT"          => "Abmelden",
		));

		//dataTables Added in 4.4.08
		//NOTE: do not change the words like _START_ between the two _ symbols!
		$lang = array_merge($lang,array(
		"DAT_SEARCH"    => "Search",
		"DAT_FIRST"     => "First",
		"DAT_LAST"      => "Last",
		"DAT_NEXT"      => "Next",
		"DAT_PREV"      => "Previous",
		"DAT_NODATA"        => "No data available in table",
		"DAT_INFO"          => "Showing _START_ to _END_ of _TOTAL_ entries",
		"DAT_ZERO"          => "Showing 0 to 0 of 0 entries",
		"DAT_FILTERED"      => "(filtered from _MAX_ total entries)",
		"DAT_MENU_LENG"     => "Show _MENU_ entries",
		"DAT_LOADING"       => "Loading...",
		"DAT_PROCESS"       => "Processing...",
		"DAT_NO_REC"        => "No matching records found",
		"DAT_ASC"           => "Activate to sort column ascending",
		"DAT_DESC"          => "Activate to sort column descending",
		));

		//LEAVE THIS LINE AT THE BOTTOM.  It allows users/lang to override these keys
		if(file_exists($abs_us_root.$us_url_root."usersc/lang/".$lang["THIS_CODE"].".php")){
			include($abs_us_root.$us_url_root."usersc/lang/".$lang["THIS_CODE"].".php");
		}
?>
