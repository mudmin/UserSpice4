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
"THIS_LANGUAGE"	=>"Español",
"THIS_CODE"			=>"es-ES",
"MISSING_TEXT"	=>"Missing Text",
));
//Database Menus
$lang = array_merge($lang,array(
"MENU_HOME"			=> "Inicio",
"MENU_HELP"			=> "Ayuda",
"MENU_ACCOUNT"		=> "Mi Cuenta",
"MENU_DASH"			=> "Administraci&oacute;n",
"MENU_USER_MGR"	=> "User Management",
"MENU_PAGE_MGR"		=> "P&aacute;ginas",
"MENU_PERM_MGR"		=> "Permisos",
"MENU_MSGS_MGR"		=> "Mensajes",
"MENU_LOGS_MGR"		=> "Accesos al Sistema",
"MENU_LOGOUT"		=> "Salir",
));

// Signup
$lang = array_merge($lang,array(
	"SIGNUP_TEXT"			=> "Registrarse",
	"SIGNUP_BUTTONTEXT"		=> "Reg&iacute;strame",
	"SIGNUP_AUDITTEXT"		=> "Registrado",
	));

// Signin
$lang = array_merge($lang,array(
	"SIGNIN_FAIL"		=> "** ACCESO FDALLIDO **",
	"SIGNIN_PLEASE_CHK" => "Por favor comprueba tu usuario y contrase&ntilde;a e int&eacute;ntalo de nuevo",
	"SIGNIN_UORE"		=> "Usuario o Email",
	"SIGNIN_PASS"		=> "Contrase&ntilde;a",
	"SIGNIN_FORGOTPASS" => "Olvid&eacute; mi contrase&ntilde;a",
	"SIGNIN_TITLE"		=> "Acceso de Usuarios",
	"SIGNIN_TEXT"		=> "Acceder",
	"SIGNOUT_TEXT"		=> "Salir",
	"SIGNIN_BUTTONTEXT"	=> "Acceder",
	"SIGNIN_REMEMBER"	=> "Recu&eacute;rdame",
	"SIGNIN_AUDITTEXT"	=> "Conectado",
	"SIGNOUT_AUDITTEXT"	=> "Desconectado",
	));

// Account Page
$lang = array_merge($lang,array(
	"ACCT_EDIT"					=> "Editar Cuenta",
	"ACCT_2FA"					=> "Gestionar Doble Autenticaci&oacute;n",
	"ACCT_SESS"					=> "Gestionar Sesiones",
	"ACCT_HOME"					=> "Mi Cuenta",
	"ACCT_SINCE"				=> "Miembro Desde",
	"ACCT_LOGINS"				=> "Accesos",
	"ACCT_SESSIONS"				=> "Sesiones Activas",
	"ACCT_MNG_SES"				=> "Click the Manage Sessions button in the left sidebar for more information.",
	));

	//General Terms
	$lang = array_merge($lang,array(
		"GEN_ENABLED"			=> "Activado",
		"GEN_DISABLED"			=> "Desactivado",
		"GEN_ENABLE"			=> "Activar",
		"GEN_DISABLE"			=> "Desactivar",
		"GEN_NO"				=> "No",
		"GEN_YES"				=> "Si",
		"GEN_MIN"				=> "min",
		"GEN_MAX"				=> "max",
		"GEN_CHAR"				=> "caracteres", //as in characters
		"GEN_SUBMIT"			=> "Enviar",
		"GEN_MANAGE"			=> "Gestionar",
		"GEN_VERIFY"			=> "Verifica",
		"GEN_SESSION"			=> "Sesi&oacute;n",
		"GEN_SESSIONS"			=> "Sesiones",
		"GEN_EMAIL"				=> "Email",
		"GEN_FNAME"				=> "Nombre",
		"GEN_LNAME"				=> "Apellidos",
		"GEN_UNAME"				=> "Usuario",
		"GEN_PASS"				=> "Contrase&ntilde;a",
		"GEN_MSG"				=> "Mensaje",
		"GEN_TODAY"				=> "Hoy",
		"GEN_CLOSE"				=> "Cerrar",
		"GEN_CANCEL"			=> "Cancelar",
		"GEN_CHECK"				=> "[ selecciona/deselecciona todo ]",
		"GEN_WITH"				=> "con",
		"GEN_UPDATED"			=> "Actualizado",
		"GEN_UPDATE"			=> "Actualizar",
		"GEN_BY"				=> "por",
		"GEN_ENABLE"			=> "Habilitar",
		"GEN_DISABLE"			=> "Deshabilitar",
		"GEN_FUNCTIONS"			=> "Funciones",
		"GEN_NUMBER"			=> "n&uacute;mero",
		"GEN_NUMBERS"			=> "n&uacute;meros",
		"GEN_INFO" 				=> "Informaci&oacute;n",
		"GEN_REC" 				=> "Grabada",
		"GEN_DEL" 				=> "Eliminar",
		"GEN_NOT_AVAIL" 		=> "No Disponible",
		"GEN_AVAIL" 			=> "Disponible",
		"GEN_BACK" 				=> "Volver",
		"GEN_RESET" 			=> "Resetear",
		"GEN_REQ"					=> "required",
		"GEN_AND"					=> "y",
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
		"T_YEARS"		=> "A&ntilde;os",
		"T_YEAR"		=> "A&ntilde;o",
		"T_MONTHS"		=> "Meses",
		"T_MONTH"		=> "Mes",
		"T_WEEKS"		=> "Semanas",
		"T_WEEK"		=> "Semana",
		"T_DAYS"		=> "D&iacute;as",
		"T_DAY"			=> "D&iacute;a",
		"T_HOURS"		=> "Horas",
		"T_HOUR"		=> "Hora",
		"T_MINUTES"		=> "Minutos",
		"T_MINUTE"		=> "Minuto",
		"T_SECONDS"		=> "Segundos",
		"T_SECOND"		=> "Segundo",
		));


		//Passwords
	$lang = array_merge($lang,array(
		"PW_NEW"		=> "Nueva Contrase&ntilde;a",
		"PW_OLD"		=> "Contrase&ntilde;a Anterior",
		"PW_CONF"		=> "Confirmar Contrase&ntilde;a",
		"PW_RESET"		=> "Resetear Contrase&ntilde;a",
		"PW_UPD"		=> "Contrase&ntilde;a Actualizada",
		"PW_SHOULD"		=> "La Contrase&ntilde;a Deber&iacute;a...",
		"PW_SHOW"		=> "Mostrar Contrase&ntilde;a",
		"PW_SHOWS"		=> "Mostrar Contrase&ntilde;as",
		));


		//Join
	$lang = array_merge($lang,array(
		"JOIN_SUC"		=> "Bienvenido A ",
		"JOIN_THANKS"	=> "Gracias por registrarte",
		"JOIN_HAVE"		=> "Tener al menos ",
		"JOIN_CAP"		=> " letra may&uacute;scula",
		"JOIN_CAP"		=> " letra may&uacute;scula",
		"JOIN_TWICE"	=> "Ser esctrito correctamente dos veces",
		"JOIN_CLOSED"	=> "En estos momentos el registrarse est&aacute; deshabilitado. por favor, contacta con el Administrador del Sitio para cualquier duda.",
		"JOIN_TC"		=> "Condiciones y T&eacute;rminos de Usuario al Registrarse",
		"JOIN_ACCEPTTC" => "Acepto las Condiciones y T&eacute;rminos de Usuario",
		"JOIN_CHANGED"	=> "Our Terms Have Changed",
		"JOIN_ACCEPT" 	=> "Accept User Terms and Conditions and Continue",
		));


		//Sessions
	$lang = array_merge($lang,array(
		"SESS_SUC"	=> "Acabada Correctamente ",
		));

		//Messages
	$lang = array_merge($lang,array(
		"MSG_SENT"			=> "&iexcl;Tu mensaje ha sido enviado!",
		"MSG_MASS"			=> "&iexcl;Tu mensaje m&uacute;ltiple ha sido enviado!",
		"MSG_NEW"			=> "Nuevo Mensaje",
		"MSG_NEW_MASS"		=> "Nuevo Mensaje M&uacute;ltiple",
		"MSG_CONV"			=> "Conversaciones",
		"MSG_NO_CONV"		=> "Sin Conversaciones",
		"MSG_NO_ARC"		=> "Sin Conversaciones",
		"MSG_QUEST"			=> "&iquest;Enviar Email con Notificaciones si est&aacute; Activo?",
		"MSG_ARC"			=> "Hilo Archivado",
		"MSG_VIEW_ARC"		=> "Ver Hilos Archivados",
		"MSG_SETTINGS"  	=> "Configuraci&oacute;n de Mensajes",
		"MSG_READ"			=> "Leer",
		"MSG_BODY"			=> "Cuerpo",
		"MSG_SUB"			=> "Asunto",
		"MSG_DEL"			=> "Enviado",
		"MSG_REPLY"			=> "Responder",
		"MSG_QUICK"			=> "Respuesta R&aacute;pida",
		"MSG_SELECT"		=> "Seleccionar un usuario",
		"MSG_UNKN"			=> "Receptor Desconocido",
		"MSG_NOTIF"			=> "Mensaje de Notificaciones por Email",
		"MSG_BLANK"			=> "El mensaje no puede estar en blanco",
		"MSG_MODAL"			=> "&iexcl;Haz click aqu&iacute; o teclea Alt + R para activar este cuadro o teclea May&uacute;s + R para abrir la versi&oacute;n expandida del panel!",
		"MSG_ARCHIVE_SUCCESSFUL"        => "Se han archivado %m1% hilos correctamente",
		"MSG_UNARCHIVE_SUCCESSFUL"      => "Se han desarchivado %m1% hilos correctamente",
		"MSG_DELETE_SUCCESSFUL"         => "Se han eliminado %m1% hilos correctamente",
		"USER_MESSAGE_EXEMPT"         	=> "Usuario %m1% no recibe mensajes.",
		"MSG_MK_READ" 		=> "Le&iacute;do",
		"MSG_MK_UNREAD" 	=> "Sin Leer",
		"MSG_ARC_THR" 		=> "Archivar Hilos Seleccionados",
		"MSG_UN_THR" 		=> "Desarchivar Hilos Seleccionados",
		"MSG_DEL_THR" 		=> "Borrar Hilos Seleccionados",
		"MSG_SEND" 			=> "Enviar Mensaje",
		));

	//2 Factor Authentication
	$lang = array_merge($lang,array(
		"2FA"		=> "Doble Autenticaci&oacute;n (2FA)",
		"2FA_CONF"	=> "&iquest;Seguro que quieres deshabilitar 2FA? Tu cuenta estar&aacute; sin proteger.",
		"2FA_SCAN"	=> "Escanea este c&oacute;digo QR con tu app o introduce la clave",
		"2FA_THEN"	=> "Entonces teclea una de tus claves de un solo uso aqu&iacute;",
		"2FA_FAIL"	=> "Hubo un problema al verificar 2FA. Comprueba tu conexi&oacute;n o contacta con soporte.",
		"2FA_CODE"	=> "Clave 2FA",
		"2FA_EXP"	=> "1 huella digital caducada",
		"2FA_EXPD"	=> "Caducada",
		"2FA_FP"	=> "Huellas digitales",
		"2FA_NP"	=> "<strong>Fallo en Inicio de Sesi&oacute;n</strong> Two Factor Auth Code was not present. Please try again.",
		"2FA_INV"	=> "<strong>Fallo en Inicio de Sesi&oacute;n</strong> Two Factor Auth Code was invalid. Please try again.",
		"2FA_FATAL"	=> "<strong>Error fatal</strong> Por favor, contacta con el Administrador.",
		"2FA_EXPS" 	=> "Caduca",
		"2FA_ACTIVE" => "Sesiones Activas",
		"2FA_NOT_FN" => "No se encuentran huellas",
		));

	//Redirect Messages - These get a plus between each word
	$lang = array_merge($lang,array(
		"REDIR_2FA"					=> "Lo+sentimos.2FA+no+est&aacute;+disponible+en+este+momento",
		"REDIR_2FA_EN"				=> "Autentication+Enabled",
		"REDIR_2FA_DIS"				=> "Doble+Autenticaci&oacute;n+Desactivada",
		"REDIR_2FA_VER"				=> "Doble+Autenticaci&oacute;n+Verificada+y+Activa",
		"REDIR_SOM_TING_WONG" 		=> "Algo+ha+ido+mal.+Por+favor+intenta+de+nuevo.",
		"REDIR_MSG_NOEX"			=> "That+thread+does+not+belong+to+you+or+does+not+exist.",
		"REDIR_UN_ONCE"				=> "El+Nombre+de+Usuario+ya+ha+sido+modificado+una+vez.",
		"REDIR_EM_SUCC"				=> "Email+Actualizado+Correctamente",
		));

	//Emails
	$lang = array_merge($lang,array(
		"EML_CONF"				=> "Confirmar Email",
		"EML_VER"				=> "Verifica Tu Email",
		"EML_CHK"				=> "Solicitud Recibida. Por favor, comprueba tu correo para la verificaci&oacute;n. Aseg&uacute;rate de revisar tu carpeta de Spam y Junk, ya que el enlace de verificaci&oacute;n caduca en ",
		"EML_MAT"				=> "Tu email no coincide.",
		"EML_HELLO"				=> "Hola desde ",
		));

		//Verification
		$lang = array_merge($lang,array(
			"VER_SUC"		=> "&iexcl;Tu Email ha sido verificado!",
			"VER_FAIL"		=> "No hemos podido verificar tu cuenta. Por favor, intenta de nuevo.",
			"VER_RESEND"	=> "Email de Verificaci&oacute;n Reenviado",
			"VER_AGAIN"		=> "Escribe tu direcci&oacute;n email e intenta de nuevo",
			"VER_PAGE"		=> "<li>Comprueba tu correo y haz click en el enlace que se te ha enviado</li><li>Hecho</li>",
			"VER_RES_SUC" 	=> "<p>Se ha enviado tu enlace de verificaci&oacute;n a tu direcci&oacute;n email.</p><p>Haz click en el enlace enviado para completar la verificaci&oacute;n. Aseg&uacute;rate de revisar tu carpeta de Spam si el email no est&aacute; en tu bandeja de entrada.</p><p>Los enlaces de verificaci&oacute;n solo son v&aacute;lidos durante ",
			"VER_OOPS" 		=> "Oops...something went wrong, maybe an old reset link you clicked on. Click below to try again",
			"VER_RESET" 	=> "&iexcl;Tu contrase&ntilde;a ha sido reseteada!",
			"VER_INS" 		=> "<li>Teclea tu direcci&oacute;n email y haz click en Resetear</li> <li>Comprueba tu correo y haz click en el enlace que se te ha enviado.</li> <li>Sigue las instrucciones indicadas</li>",
			"VER_SENT" 		=> "<p>Se te ha enviado el enlace de reseteo de contrase&ntilde;a a tu correo.</p> <p>Haz click en el enlace del correo para Resetear la contrase&ntilde;a. Si no ves el correo, comprueba tu bandeja de Spam.</p><p>Enlace v&aacute;lido solo durante ",
			"VER_PLEASE" 	=> "Resetear tu contrase&ntilde",
			));

	//User Settings
	$lang = array_merge($lang,array(
		"SET_PIN"		=> "Resetear PIN",
		"SET_WHY"		=> "&iquest;Porqu&eacute; no puedo modificar esto?",
		"SET_PW_MATCH"	=> "Debe coincidir con la Nueva Contrase&ntilde;a",
		"SET_PIN_NEXT"	=> "Puedes establecer un PIN nuevo la pr&oacute;xima vez que se solicite verificaci&oacute;n",
		"SET_UPDATE"	=> "Actualiza tu configuraci&oacute;n de usuario",
		"SET_NOCHANGE"	=> "El Administrador ha desactivado el cambio de nombre de usuario.",
		"SET_ONECHANGE"	=> "El Administrador ha establecido que los cambios de nombre de usuario solo se pueden hacer una vez y tu ya lo has hecho.",
		"SET_GRAVITAR"	=> "<strong>&iquest;Quieres cambiar la foto de tu perfil? </strong><br> Visita <a href='https://en.gravatar.com/'>https://en.gravatar.com/</a> y crea una cuenta con el mismo email que has usado en este sitio. Est&aacute;n presentes en millones de sitios. &iexcl;Es r&aacute;pido y sencillo!",
		"SET_NOTE1"		=> "<p><strong>Atento por favor,</strong> hay pendiente una solicitud de actualizaci&oacute;n de tu email a",
		"SET_NOTE2"		=> ".</p><p>Por favor, usa el correo de verificaci&oacute;n para completar esta solicitud.</p>
		<p>Si necesitas un nuevo correo de verificaci&oacute;n, vuelve a escribir el email anterior y env&iacute;a la solicitud de nuevo.</p>",
		"SET_PW_REQ" 	=> "obligatorio para cambiar contrase&ntilde;a, email, o resetear el PIN",
		"SET_PW_REQI" 	=> "Obligatorio para cambiar tu contrase&ntilde;a",

		));

	//Errors
	$lang = array_merge($lang,array(
		"ERR_FAIL_ACT"		=> "Fallo al eliminar sesiones activas, Error: ",
		"ERR_EMAIL"			=> "El correo no se ha enviado debido a un error. Por favor, contacta con el Administrador del sitio.",
		"ERR_EM_DB"			=> "Ese email no existe en nuesta base de datos",
		"ERR_TC"			=> "Por favor, lee y acepta los t&eacute;rminos y condiciones",
		"ERR_CAP"			=> "&iexcl;No has pasado el Test de comprobaci&oacute;n humana, Robot!",
		"ERR_PW_SAME"		=> "Tu contrase&ntilde;a anterior no puede ser igual que la nueva",
		"ERR_PW_FAIL"		=> "Fallo en la verificaci&oacute;n de contrase&ntilde;a actual. No se ha actualizado. Por favor, intenta de nuevo.",
		"ERR_GOOG"			=> "<strong>ATENCI&oacute;N:</strong> Si desde el principio has entrado con tu cuenta de Google/Facebook, necesitar&aacute;s usar el enlace de olvido de contrase&ntilde;a para cambiar tu contrase&ntilde;a....a menos que seas realmente bueno adivinando.",
		"ERR_EM_VER"		=> "La verificaci&oacute;n de email no est&aacute; habilitada. Por favor, contacta con el Administrador del sitio.",
		"ERR_EMAIL_STR"		=> "Algo extra&ntilde;o ha ocurrido. Por favor, re-verifica tu email. Sentimos las molestias",
		));

	//Maintenance Page
	$lang = array_merge($lang,array(
		"MAINT_HEAD"		=> "&iexcl;Volveremos pronto!",
		"MAINT_MSG"			=> "&iexcl;Lo sentimos, estamos realizando tareas de mantenimiento ahora mismo.<br> Esteremos listos en breve!",
		"MAINT_BAN" 		=> "Sorry. You have been banned. If you feel this is an error, please contact the administrator.",
		"MAINT_TOK" 		=> "Ha habido un error con tu formulario. Vuelve atr&aacute;s e intenta de nuevo. Recuerda que enviar el formulario refrecando la p&aacute;gina, dar&aacute; error. Si vuelve a ocurrir, por favor contacta con el administrador.",
		"MAINT_OPEN" 		=> "Un Framework Open Source en PHP para la Gesti&oacute;n de Usuarios.",
		"MAINT_PLEASE" 		=> "&iexcl;UserSpice se ha instalado correctamente!<br>Para ver la documentaci&oacute;n inicial (en ingl&eacute;s), visita ",
		));

	//LEAVE THIS LINE AT THE BOTTOM.  It allows users/lang to override these keys
	if(file_exists($abs_us_root.$us_url_root."usersc/lang/".$lang["THIS_CODE"].".php")){
		include($abs_us_root.$us_url_root."usersc/lang/".$lang["THIS_CODE"].".php");
	}

?>
