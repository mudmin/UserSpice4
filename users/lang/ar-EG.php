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
"THIS_LANGUAGE"	=>"Arabic (Egyptian)",
"THIS_CODE"			=>"ar-EG",
"MISSING_TEXT"	=>"Missing Text",
));
//Database Menus
$lang = array_merge($lang,array(
"MENU_HOME"			=> "الرئيسية",
"MENU_HELP"			=> "مساعدة",
"MENU_ACCOUNT"	=> "الحساب",
"MENU_DASH"			=> "لوحة الادارة",
"MENU_USER_MGR"	=> "User Management",
"MENU_PAGE_MGR"	=> "ادارة الصفحات",
"MENU_PERM_MGR"	=> "ادارة الصلاحيات",
"MENU_MSGS_MGR"	=> "مدير الرسائل",
"MENU_LOGS_MGR"	=> "سجلات النظام",
"MENU_LOGOUT"		=> "خروج",
));

// Signup
$lang = array_merge($lang,array(
	"SIGNUP_TEXT"					=> "التسجيل",
	"SIGNUP_BUTTONTEXT"		=> "تسجيل",
	"SIGNUP_AUDITTEXT"		=> "تم التسجيل",
	));

// Signin
$lang = array_merge($lang,array(
	"SIGNIN_FAIL"				=> "** فشل تسجيل الدخول **",
	"SIGNIN_PLEASE_CHK" => "برجاء التحقق من اسم المستخدم وكلمة المرور",
	"SIGNIN_UORE"				=> "اسم المستخدم او الايميل",
	"SIGNIN_PASS"				=> "كلمة السر",
	"SIGNIN_TITLE"			=> "برجاء تسجيل الدخول",
	"SIGNIN_TEXT"				=> "تسجيل دخول",
	"SIGNOUT_TEXT"			=> "خروج",
	"SIGNIN_BUTTONTEXT"	=> "دخول",
	"SIGNIN_REMEMBER"		=> "تذكرني",
	"SIGNIN_AUDITTEXT"	=> "تم تسجيل الدخول",
	"SIGNIN_FORGOTPASS"	=>"نسيت كلمة السر",
	"SIGNOUT_AUDITTEXT"	=> "تم تسجيل الخروج",
	));

// Account Page
$lang = array_merge($lang,array(
	"ACCT_EDIT"					=> "تعديل بيانات الحساب",
	"ACCT_2FA"					=> "ادارة التحقق بخطوتين",
	"ACCT_SESS"					=> "ادارة الجلسات",
	"ACCT_HOME"					=> "رئيسية الحساب",
	"ACCT_SINCE"				=> "تاريخ الانضمام",
	"ACCT_LOGINS"				=> "مرات تسجيل الدخول",
	"ACCT_SESSIONS"			=> "الجلسات النشطة",
	"ACCT_MNG_SES"			=> "اضغط على ادارة الجلسات للمزيد من المعلومات",
	));

	//General Terms
	$lang = array_merge($lang,array(
		"GEN_ENABLED"			=> "مفعل",
		"GEN_DISABLED"		=> "معطل",
		"GEN_ENABLE"			=> "تفعيل",
		"GEN_DISABLE"			=> "تعطيل",
		"GEN_NO"					=> "لا",
		"GEN_YES"					=> "نعم",
		"GEN_MIN"					=> "اقل",
		"GEN_MAX"					=> "اكثر",
		"GEN_CHAR"				=> "حروف", //as in characters
		"GEN_SUBMIT"			=> "تأكيد",
		"GEN_MANAGE"			=> "ادارة",
		"GEN_VERIFY"			=> "تأكيد",
		"GEN_SESSION"			=> "جلسة",
		"GEN_SESSIONS"		=> "جلسات",
		"GEN_EMAIL"				=> "الايميل",
		"GEN_FNAME"				=> "الاسم الاول",
		"GEN_LNAME"				=> "الاسم الاخير",
		"GEN_UNAME"				=> "اسم المستخدم",
		"GEN_PASS"				=> "كلمة السر",
		"GEN_MSG"					=> "رسالة",
		"GEN_TODAY"				=> "اليوم",
		"GEN_CLOSE"				=> "اغلاق",
		"GEN_CANCEL"			=> "الغاء",
		"GEN_CHECK"				=> "[ تحديد/عدم تحديد الكل ]",
		"GEN_WITH"				=> "مع",
		"GEN_UPDATED"			=> "مُحدث",
		"GEN_UPDATE"			=> "تحديث",
		"GEN_BY"					=> "بواسطة",
		"GEN_ENABLE"			=> "تفعيل",
		"GEN_DISABLE"			=> "تعطيل",
		"GEN_FUNCTIONS"		=> "الدوال",
		"GEN_NUMBER"			=> "رقم",
		"GEN_NUMBERS"			=> "ارقام",
		"GEN_INFO"				=> "معلومات",
		"GEN_REC"					=> "سُجل",
		"GEN_DEL"					=> "حذف",
		"GEN_NOT_AVAIL"		=> "غير متاح",
		"GEN_AVAIL"				=> "متاح",
		"GEN_BACK"				=> "عودة",
		"GEN_RESET"				=> "اعادة ضبط",
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
		"T_YEARS"			=> "سنوات",
		"T_YEAR"			=> "سنة",
		"T_MONTHS"		=> "شهور",
		"T_MONTH"			=> "شهر",
		"T_WEEKS"			=> "اسابيع",
		"T_WEEK"			=> "اسبوع",
		"T_DAYS"			=> "ايام",
		"T_DAY"				=> "يوم",
		"T_HOURS"			=> "ساعات",
		"T_HOUR"			=> "ساعة",
		"T_MINUTES"		=> "دقائق",
		"T_MINUTE"		=> "دقيقة",
		"T_SECONDS"		=> "ثواني",
		"T_SECOND"		=> "ثانية",
		));


		//Passwords
	$lang = array_merge($lang,array(
		"PW_NEW"		=> "كلمة  السر جديدة",
		"PW_OLD"		=> "كلمة السر القديمة",
		"PW_CONF"		=> "تأكيد كلمة السر",
		"PW_RESET"	=> "اعدة ضبط كلمة السر",
		"PW_UPD"		=> "تم تحديث كلمة السر",
		"PW_SHOULD"	=> "...كلمة السر يجب انـ",
		"PW_SHOW"		=> "اظهار كلمة السر",
		"PW_SHOWS"	=> "اظهار كلمات السر",
		));


		//Join
	$lang = array_merge($lang,array(
		"JOIN_SUC"		=> " مرحبا في ",
		"JOIN_THANKS"	=> "شكراً لتسجيلك",
		"JOIN_HAVE"		=> " يحتوي على الاقل",
		"JOIN_CAP"		=> " حروف كبيرة",
		"JOIN_TWICE"	=> "متطابق",
		"JOIN_CLOSED"	=> "للأسف التسجيل مغلق الان برجاء التواصل مع ادارة الموقع اذا كان لديك اي استفسار",
		"JOIN_TC"			=> "شروط وقوانين التسجيل",
		"JOIN_ACCEPTTC" => "I Accept User Terms and Conditions",
		"JOIN_CHANGED"	=> "Our Terms Have Changed",
		"JOIN_ACCEPT" 	=> "Accept User Terms and Conditions and Continue",
		));

		//Sessions
	$lang = array_merge($lang,array(
		"SESS_SUC"	=> "تم الحذف بنجاح",
		));

		//Messages
	$lang = array_merge($lang,array(
		"MSG_SENT"			=> "تم ارسال رسالتك",
		"MSG_MASS"			=> "تم ارسال رسالتك الجماعية",
		"MSG_NEW"				=> "رسالة جديدة",
		"MSG_NEW_MASS"	=> "رسالة جماعية جديدة",
		"MSG_CONV"			=> "المحادثات",
		"MSG_NO_CONV"		=> "لا توجد محادثات",
		"MSG_NO_ARC"		=> "لا توجد محادثات",
		"MSG_QUEST"			=> "ارسال اشعارات عبر البريد اذا كانت مفعلة؟",
		"MSG_ARC"				=> "مواضيع مؤرشفة",
		"MSG_VIEW_ARC"	=> "عرض المواضيع المؤرشفة",
		"MSG_SETTINGS"  => "اعدادت الرسائل",
		"MSG_READ"			=> "قراءة",
		"MSG_BODY"			=> "نص الرسالة",
		"MSG_SUB"				=> "الموضوع",
		"MSG_DEL"				=> "تم التسليم",
		"MSG_REPLY"			=> "الرد",
		"MSG_QUICK"			=> "رد سريع",
		"MSG_SELECT"		=> "تحديد عضو",
		"MSG_UNKN"			=> "مستلم مجهول",
		"MSG_NOTIF"			=> "اشعارات البريد الالكتروني",
		"MSG_BLANK"			=> "الرسالة لا يمكن ان تكون فارغة",
		"MSG_MODAL"			=> "لفتح جزء الرد الموسع Shift + R للتركيز على هذا المربع أو اضغط على او اضغط على  Alt + R انقر هنا أو اضغط على",
		"MSG_ARCHIVE_SUCCESSFUL"        => "You have successfully archived %m1% threads",
		"MSG_UNARCHIVE_SUCCESSFUL"      => "You have successfully unarchived %m1% threads",
		"MSG_DELETE_SUCCESSFUL"         => "You have successfully deleted %m1% threads",
		"USER_MESSAGE_EXEMPT"         			=> "User is %m1% exempted from messages.",
		"MSG_MK_READ"		=> "قراءة.",
		"MSG_MK_UNREAD"	=> "غير مقروء",
		"MSG_ARC_THR"		=> "ارشفة المواضيع المحددة",
		"MSG_UN_THR"		=> "عدم ارشفة المواضيع المحددة",
		"MSG_DEL_THR"		=> "مسح المواضيع المحددة",
		"MSG_SEND"			=> "ارسال رسالة",
		));

	//2 Factor Authentication
	$lang = array_merge($lang,array(
		"2FA"				=> "التحقق بخطوتين",
		"2FA_CONF"	=> "هل انت متأكد من تعطيل خاصية التحقق بخطوتين؟ حسابك سيتعرض للخطر",
		"2FA_SCAN"	=> "التالي بواسطة تطبيقك الموثوق او استخدم المفتاح QR افحص كود الـ",
		"2FA_THEN"	=> "بعدها اكتب احد كلمات (لمرة واحدة) الرور هنا",
		"2FA_FAIL"	=> "حدث خطأ اثناء تفعيل خاصية التحقق بخطوتين برجاء التأكد من اتصال الانترنت او التواصل مع الدعم الفني",
		"2FA_CODE"	=> "2FA كود التحقق بخطوتين",
		"2FA_EXP"		=> "انتهت صلاحية بصمة واحدة",
		"2FA_EXPD"	=> "منتهي الصلاحية",
		"2FA_EXPS"	=> "تنتهي",
		"2FA_ACTIVE"=> "الجلسات المفعلة",
		"2FA_NOT_FN"=> "لم يتم العثور على البصمات",
		"2FA_FP"		=> "البصمات",
		"2FA_NP"		=> "<strong>فشل تسجيل الدخول</strong> لم يتم تقديم رمز المصادقة,برجاء المحاولة مرة اخرى",
		"2FA_INV"		=> "<strong>فشل تسجيل الدخول</strong> رمز المصادقة غير صحيح,برجاء المحاولة مرة اخرى",
		"2FA_FATAL"	=> "<strong>!خطأ فادح</strong> برجاء التواصل مع ادارة الموقع",
		));

	//Redirect Messages - These get a plus between each word
	$lang = array_merge($lang,array(
		"REDIR_2FA"						=> "Sorry.Two+factor+is+not+enabled+at+this+time",
		"REDIR_2FA_EN"				=> "2+Factor+Authentication+Enabled",
		"REDIR_2FA_DIS"				=> "2+Factor+Authentication+Disabled",
		"REDIR_2FA_VER"				=> "2+Factor+Authentication+Verified+and+Enabled",
		"REDIR_SOM_TING_WONG" => "Something+went+wrong.+Please+try+again.",
		"REDIR_MSG_NOEX"			=> "That+thread+does+not+belong+to+you+or+does+not+exist.",
		"REDIR_UN_ONCE"				=> "Username+has+already+been+changed+once.",
		"REDIR_EM_SUCC"				=> "Email+Updated+Successfully",
		));

	//Emails
	$lang = array_merge($lang,array(
		"EML_CONF"			=> "تأكيد الايميل",
		"EML_VER"				=> "التحقق من البريد الالكتروني",
		"EML_CHK"				=> "تم تلقي طلبك. يرجى التحقق من بريدك الالكتروني لتأكيده. تأكد من التحقق من مجلد الرسائل غير المرغوب فيها",
		"EML_MAT"				=> "عنوان البريد الالكتروني غير متطابق",
		"EML_HELLO"			=> " مرحباً من",
		"EML_HI"				=> "Hi ",
		"EML_AD_HAS"		=> "An Administrator has reset your password.",
		"EML_AC_HAS"		=> "An Administrator has created your account.",
		"EML_REQ"				=> "You will be required to set your password using the link above.",
		"EML_EXP"				=> "Please note, Password links expire in ",
		"EML_VER_EXP"		=> "Please note, Verification links expire in ",
		"EML_CLICK"			=> "Click here to login.",
		"EML_REC"				=> "It is recommended to change your password upon logging in.",
		"EML_MSG"				=> "You have a new message from",
		"EML_REPLY"			=> "Click here to reply or view the thread",
		"EML_WHY"				=> "You are receiving this email because a request was made to reset your password. If this was not you, you may disregard this email.",
		"EML_HOW"				=> "If this was you, click the link below to continue with the password reset process.",
		"EML_EML"				=> "A request to change your email was made from within your user account.",
		"EML_VER_EML"		=> "Thanks for signing up.  Once you verify your email address you will be ready to login! Please click the link below to verify your email address.",
		));

		//Verification
		$lang = array_merge($lang,array(
			"VER_SUC"			=> "تم التحقق من البريد الالكتروني",
			"VER_FAIL"		=> "لا يمكننا التحقق من حسابك برجاء المحاولة مرة اخرى",
			"VER_RESEND"	=> "اعادة ارسال التحقق من البريد الالكتروني",
			"VER_AGAIN"		=> "اعد كتابة البريد الالكتروني وحاول مجدداً",
			"VER_PAGE"		=> "<li>افحص بريدك الالكتروني واضغط على الرابط المرسل لك</li><li>انتهى</li>",
			"VER_RES_SUC" => "<p>تم ارسال رابط التحقق الى بريدك الالكتروني</p><p>اضغط على الرابط الذي تم ارساله لإكمال التحقق.في حالة لم تجد الرسالة تأكد من مراجعة الرسائل المهملة</p><p>الرابط صالح لمدة",
			"VER_OOPS"		=> "عفواً!... حدث خطأ ما ربما استخدمت رابط تحقق منتهي الصلاحية/قديم اضغط بالأسفل للمحاولة مجدداً",
			"VER_RESET"		=> "تم اعادة ضبط كلمة المرور",
			"VER_INS"			=> "<li>اكتب بريدك الالكتروني واضغط اعادة ضبط</li> <li>افحص بريدك الالكتروني واضغط على الرابط المرسل</li>
												<li>اتبع التعليمات على الشاشة</li>",
			"VER_SENT"		=> "<p>تم ارسال رابط اعادة ضبط كلمة المرور الى بريدك الالكتروني</p>
			    							<p>اضغط على الرابط في الرسالة لإعادة ضبط كلمة المرور. في حالة لم تجد الرسالة تأكد من مراجعة الرسائل المهملة</p><p>الرابط صالح لمدة",
			"VER_PLEASE"	=> "برجاء اعادة ضبط كلمة المرور",
			));

	//User Settings
	$lang = array_merge($lang,array(
		"SET_PIN"				=> "PINاعادة ضبط الـ",
		"SET_WHY"				=> "لماذا لا يمكنني تغيير ذلك؟",
		"SET_PW_MATCH"	=> "يجب أن تطابق كلمة المرور الجديدة",

		"SET_PIN_NEXT"	=> "المرة المقبلة التي تطلب فيها رابط تحقق PIN يمكنك اعادة ضبط الـ",
		"SET_UPDATE"		=> "تحديث اعدادات الحساب",
		"SET_NOCHANGE"	=> "تغيير اسم المستخدم معطل",
		"SET_ONECHANGE"	=> "عفواً!...لا يمكنك تغيير اسم المستخدم اكثر من مرة",

		"SET_GRAVITAR"	=> "<strong>هل تريد تغيير الصورة الرمزية؟</strong><br>توجه لـ <a href='https://en.gravatar.com/'>https://en.gravatar.com/</a>وقم بفتح حساب بنفس الايميل المستخدم هنا هذه الخدمة مدعومة من ملايين المواقع تتميز بالسهولة والسرعة",

		"SET_NOTE1"			=> "<p><strong>برجاء ملاحظة</strong> هناك طلب تحقق معلق لتحديث بريدك الالكتروني",

		"SET_NOTE2"			=> ".</p><p>يرجى استخدام رسالة التحقق لإكمال هذا الطلب</p>
		<p>إذا كنت بحاجة إلى رسالة تحقق جديدة ، يرجى إعادة إدخال البريد الإلكتروني وإرسال الطلب مرة أخرى</p>",

		"SET_PW_REQ" 		=> "[PIN]مطلوب لتغيير كلمة المرور أو البريد الإلكتروني أو إعادة تعيين رقم التعريف الشخصي",
		"SET_PW_REQI" 	=> "مطلوب لإعادة تعيين كلمة المرور",

		));

	//Errors
	$lang = array_merge($lang,array(
		"ERR_FAIL_ACT"		=> ":فشل انهاء الجلسات النشطة,خطأ",
		"ERR_EMAIL"				=> "خطأ في ارسال الايميل, برجاء التواصل مع الدعم الفني",
		"ERR_EM_DB"				=> "عنوان البريد الالكتروني الذي ادخله غير مسجل لدينا",
		"ERR_TC"					=> "برجاء قراءة البنود والشروط وقبولها",
		"ERR_CAP"					=> "خطأ,في كلمة التحقق",
		"ERR_PW_SAME"			=> "لا يمكنك استخدام كلمة المرور القديمة",
		"ERR_PW_FAIL"			=> "فشل التحقق من كلمة المرور الحالية. فشل التحديث. برجاء حاول مجدداً",
		"ERR_GOOG"				=> "<strong>:ملاحظة</strong>سيتعين عليك استخدام خاصية -نسيت كلمة المرور- لتعيين كلمة مرور خاصة بموقعنا Google/Facebook في حالة تسجيل الدخول بإستخدام حسابك في",
		"ERR_EM_VER"			=> "التحقق من البريد الالكتروني غير مفعلة",
		"ERR_EMAIL_STR"		=> "حدث خطأ ما, يرجى إعادة التحقق من بريدك الإلكتروني. نأسف على الازعاج",
		));

	//Maintenance Page
	$lang = array_merge($lang,array(
		"MAINT_HEAD"		=> "سوف نعود قريباً",
		"MAINT_MSG"			=> "نأسف على الازعاج, جاري عمل بعض الصيانة في الموقع<br>سيعود الموقع للعمل قريباً",
		"MAINT_BAN"			=> "عفواً,لقد تم حظر حسابك اذا كنت تشعر ان هذا خطأ برجاء التواصل مع الادارة",
		"MAINT_TOK"			=> "هناك خطأ في النموذج الخاص بك. الرجاء العودة والمحاولة مجددا. يرجى ملاحظة أن إرسال النموذج عن طريق تحديث الصفحة سوف يحدث خطأ. إذا استمر هذا في الحدوث ، يرجى التواصل مع الادارة",
		"MAINT_OPEN"		=> "لإدارة المستخدمين,مفتوح المصدر PHP اطار عمل",
		"MAINT_PLEASE"	=> "بنجاح UserSpice! تم تثبيت<br>لمشاهدة كيف يمكنك التعامل مع الخصائص المختلفة برجاء زيارة"
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
