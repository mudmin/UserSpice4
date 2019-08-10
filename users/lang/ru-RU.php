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
//You defiitely want to customize these for your language
$lang = array_merge($lang,array(
"THIS_LANGUAGE"  =>"Русский",
"THIS_CODE"      =>"ru-RU",
"MISSING_TEXT"  =>"Отсутствующий текст",
));

//Database Menus
$lang = array_merge($lang,array(
  "MENU_HOME"     => "Главная",
  "MENU_HELP"     => "Помощь",
  "MENU_ACCOUNT"  => "Учетная запись",
  "MENU_DASH"     => "Панель администратора",
  "MENU_USER_MGR" => "Управление пользователями",
  "MENU_PAGE_MGR" => "Управление страницами",
  "MENU_PERM_MGR" => "Управление правами доступами",
  "MENU_MSGS_MGR" => "Менеджер сообщений",
  "MENU_LOGS_MGR" => "Журналы событий",
  "MENU_LOGOUT"   => "Выход",
));

// Signup
$lang = array_merge($lang,array(
  "SIGNUP_TEXT"       => "Зарегистрироваться",
  "SIGNUP_BUTTONTEXT" => "Зарегистрировать меня",
  "SIGNUP_AUDITTEXT"  => "Зарегистрировано",
  ));

// Signin
$lang = array_merge($lang,array(
  "SIGNIN_FAIL"       => "**НЕУДАЧНЫЙ ВХОД **",
  "SIGNIN_PLEASE_CHK" => "Пожалуйста, проверьте свое имя пользователя и пароль и повторите попытку",
  "SIGNIN_UORE"       => "Имя пользователя или адрес электронной почты",
  "SIGNIN_PASS"       => "Пароль",
  "SIGNIN_TITLE"      => "Пожалуйста, войдите в систему",
  "SIGNIN_TEXT"       => "Войти",
  "SIGNOUT_TEXT"      => "Выход",
  "SIGNIN_BUTTONTEXT" => "Логин",
  "SIGNIN_REMEMBER"   => "Запомнить меня",
  "SIGNIN_AUDITTEXT"  => "Вход",
  "SIGNIN_FORGOTPASS" => "Забыли пароль",
  "SIGNOUT_AUDITTEXT" => "Выход",
  ));

// Account Page
$lang = array_merge($lang,array(
  "ACCT_EDIT"         => "Редактировать информацию об учетной записи",
  "ACCT_2FA"          => "Управление 2-факторной аутентификацией",
  "ACCT_SESS"         => "Управление сеансами",
  "ACCT_HOME"         => "Главная учетная запись",
  "ACCT_SINCE"        => "Участник с",
  "ACCT_LOGINS"       => "Количество входов",
  "ACCT_SESSIONS"     => "Количество активных сеансов",
  "ACCT_MNG_SES"      => "Нажмите кнопку Управление сеансами на левой боковой панели для получения дополнительной информации",
  ));

  //General Terms
  $lang = array_merge($lang,array(
    "GEN_ENABLED"    => "Включено",
    "GEN_DISABLED"   => "Выключено",
    "GEN_ENABLE"     => "Включить",
    "GEN_DISABLE"    => "Выключить",
    "GEN_NO"         => "Нет",
    "GEN_YES"        => "Да",
    "GEN_MIN"        => "мин.",
    "GEN_MAX"        => "макс.",
    "GEN_CHAR"       => "символ", //as в символах.
    "GEN_SUBMIT"     => "Отправить",
    "GEN_MANAGE"     => "Управлять",
    "GEN_VERIFY"     => "Проверить",
    "GEN_SESSION"    => "Сеанс",
    "GEN_SESSIONS"   => "Сеансы",
    "GEN_EMAIL"      => "Электронная почта",
    "GEN_FNAME"      => "Имя",
    "GEN_LNAME"      => "Фамилия",
    "GEN_UNAME"      => "Имя пользователя",
    "GEN_PASS"       => "Пароль",
    "GEN_MSG"        => "Сообщение",
    "GEN_TODAY"      => "Сегодня",
    "GEN_CLOSE"      => "Закрыть",
    "GEN_CANCEL"     => "Отмена",
    "GEN_CHECK"      => "[ отметить/снять все ]",
    "GEN_WITH"       => "вместе с",
    "GEN_UPDATED"    => "Обновлено",
    "GEN_UPDATE"     => "Обновить",
    "GEN_BY"         => "к",
    "GEN_ENABLE"     => "Включить",
    "GEN_DISABLE"    => "Отключить",
    "GEN_FUNCTIONS"  => "Функции",
    "GEN_NUMBER"     => "номер",
    "GEN_NUMBERS"    => "цифры",
    "GEN_INFO"       => "Информация",
    "GEN_REC"        => "Записано",
    "GEN_DEL"        => "Удалить",
    "GEN_NOT_AVAIL"  => "Недоступно",
    "GEN_AVAIL"      => "Доступно",
    "GEN_BACK"       => "Назад",
    "GEN_RESET"      => "Сброс",
    "GEN_REQ"        => "требуется",
    "GEN_AND"        => "и",
    "GEN_SAME"       => "должно быть то же самое",
    ));

//validation class
  $lang = array_merge($lang,array(
    "VAL_SAME"       => "должно быть то же самое",
    "VAL_EXISTS"     => "уже существует. Пожалуйста, выберите другую",
    "VAL_DB"         => "Ошибка базы данных",
    "VAL_NUM"        => "должно быть число",
    "VAL_INT"        => "должно быть целое число",
    "VAL_EMAIL"      => "должен быть действительным адресом электронной почты",
    "VAL_NO_EMAIL"   => "не может быть адресом электронной почты",
    "VAL_MAILDOMAIN"		=> "must comply with the permitted maildomain list",
    "VAL_SERVER"     => "должен принадлежать действующему серверу",
    "VAL_LESS"       => "должно быть меньше, чем",
    "VAL_GREAT"      => "должен быть больше, чем",
    "VAL_LESS_EQ"    => "должно быть меньше или равно",
    "VAL_GREAT_EQ"   => "должно быть больше или равно",
    "VAL_NOT_EQ"     => "не должно быть равно",
    "VAL_EQ"         => "должен быть равен",
    "VAL_TZ"         => "должно быть правильным именем часового пояса",
    "VAL_MUST"       => "Должно быть",
    "VAL_MUST_LIST"  => "должен быть одним из следующих",
    "VAL_TIME"       => "должно быть действительным временем",
    "VAL_SEL"        => "неправильный выбор",
    "VAL_NA_PHONE"   => "должен быть действительным североамериканским номером телефона",
  ));

    //Time
  $lang = array_merge($lang,array(
    "T_YEARS"   => "Годы",
    "T_YEAR"    => "Год",
    "T_MONTHS"  => "Месяцы",
    "T_MONTH"   => "Месяц",
    "T_WEEKS"   => "Недели",
    "T_WEEK"    => "Неделя",
    "T_DAYS"    => "Дни",
    "T_DAY"     => "День",
    "T_HOURS"   => "Часы",
    "T_HOUR"    => "Час",
    "T_MINUTES" => "Минуты",
    "T_MINUTE"  => "Минута",
    "T_SECONDS" => "Секунды",
    "T_SECOND"  => "Секунд",
    ));


    //Passwords
  $lang = array_merge($lang,array(
    "PW_NEW"    => "Новый пароль",
    "PW_OLD"    => "Старый пароль",
    "PW_CONF"   => "Подтвердить пароль",
    "PW_RESET"  => "Сброс пароля",
    "PW_UPD"    => "Пароль обновлен",
    "PW_SHOULD" => "Пароли должны...",
    "PW_SHOW"   => "Показать пароль",
    "PW_SHOWS"  => "Показать пароли",
    ));


    //Join
  $lang = array_merge($lang,array(
    "JOIN_SUC"      => "Добро пожаловать",
    "JOIN_THANKS"   => "Спасибо за регистрацию!",
    "JOIN_HAVE"     => "Попробуй хотя бы",
    "JOIN_CAP"      => "заглавная буква",
    "JOIN_TWICE"    => "Должен быть корректно введен дважды",
    "JOIN_CLOSED"   => "К сожалению, в настоящее время регистрация отключена. Если у вас возникнут какие-либо вопросы или опасения, обращайтесь к администратору сайта",
    "JOIN_TC"       => "Правила и условия регистрации пользователя",
    "JOIN_ACCEPTTC" => "Я принимаю Правила и условия пользования",
    "JOIN_CHANGED"  => "Наши условия изменились",
    "JOIN_ACCEPT"   => "Принять условия пользования и продолжить",
    ));

    //Sessions
  $lang = array_merge($lang,array(
    "SESS_SUC" => "Успешно убит ",
    ));

    //Messages
  $lang = array_merge($lang,array(
    "MSG_SENT"                  => "Ваше сообщение отправлено!",
    "MSG_MASS"                  => "Ваше массовое сообщение отправлено!",
    "MSG_NEW"                   => "Новое сообщение",
    "MSG_NEW_MASS"              => "Новое массовое сообщение",
    "MSG_CONV"                  => "Разговоры",
    "MSG_NO_CONV"               => "Никаких разговоров",
    "MSG_NO_ARC"                => "Никаких разговоров",
    "MSG_QUEST"                 => "Отправить уведомление по электронной почте, если разрешено?",
    "MSG_ARC"                   => "Архивированные темы",
    "MSG_VIEW_ARC"              => "Просмотр архивированных тем",
    "MSG_SETTINGS"              => "Настройки сообщений",
    "MSG_READ"                  => "Читать",
    "MSG_BODY"                  => "Тело сообщения",
    "MSG_SUB"                   => "Тема",
    "MSG_DEL"                   => "Доставлено",
    "MSG_REPLY"                 => "Ответить",
    "MSG_QUICK"                 => "Быстрый ответ",
    "MSG_SELECT"                => "Выбрать пользователя",
    "MSG_UNKN"                  => "Неизвестный получатель",
    "MSG_NOTIF"                 => "Уведомления по электронной почте",
    "MSG_BLANK"                 => "Сообщение не может быть пустым",
    "MSG_MODAL"                 => "Нажмите здесь или нажмите Alt + R, чтобы сфокусироваться на этом поле, ИЛИ нажмите Shift + R, чтобы открыть расширенную панель ответа",
    "MSG_ARCHIVE_SUCCESSFUL"    => "Вы успешно архивировали темы %m1%",
    "MSG_UNARCHIVE_SUCCESSFUL"  => "Вы успешно выполнили разархивирование тем %m1%",
    "MSG_DELETE_SUCCESSFUL"     => "Вы успешно удалили темыи %m1%",
    "USER_MESSAGE_EXEMPT"       => "Пользователь на %m1% освобожден от сообщений.",
    "MSG_MK_READ"               => "Прочитанный",
    "MSG_MK_UNREAD"             => "Непрочитанный",
    "MSG_ARC_THR"               => "Архивация выбранных тем",
    "MSG_UN_THR"                => "Отмена архивации выбранных тем",
    "MSG_DEL_THR"               => "Удалить выбранные темы",
    "MSG_SEND"                  => "Отправить сообщение",
    ));

  //2 Factor Authentication
  $lang = array_merge($lang,array(
    "2FA"         => "2 Факторная аутентификация",
    "2FA_CONF"    => "Вы уверены, что хотите отключить двухфакторную аутентификацию? Ваш аккаунт больше не будет защищен.",
    "2FA_SCAN"    => "Отсканируйте этот QR-код с помощью приложения аутентификатора или введите ключ",
    "2FA_THEN"    => "Тогда введите здесь один из ваших одноразовых паролей",
    "2FA_FAIL"    => "Возникла проблема с двухфакторной аутентификацией. Пожалуйста, проверьте Интернет соединение или обратитесь в службу поддержки",
    "2FA_CODE"    => "Код двухфакторной аутентификации",
    "2FA_EXP"     => "Просрочен 1 отпечаток пальца",
    "2FA_EXPD"    => "Просрочен",
    "2FA_EXPS"    => "Истекает",
    "2FA_ACTIVE"  => "Активные сессии",
    "2FA_NOT_FN"  => "Отпечатков пальцев не найдено",
    "2FA_FP"      => "Отпечатки пальцев",
    "2FA_NP"      => "<strong>Сбой логина</strong> Отсутствует двухфакторный код автонастройки. Пожалуйста, попробуйте еще раз.",
    "2FA_INV"     => "<strong>Сбой логина</strong> Двухфакторный код был недействителен. Пожалуйста, попробуйте еще раз.",
    "2FA_FATAL"   => "<strong>Fatal Error</strong> Пожалуйста, свяжитесь с системным администратором",
    ));

  //Redirect Messages - These get a plus between each word
  $lang = array_merge($lang,array(
    "REDIR_2FA"           => "Извините.Двух+факторная+идентификация+в+настоящее+время+не+поддерживается",
    "REDIR_2FA_EN"        => "2х+Факторная+Аутентификация+Включена",
    "REDIR_2FA_DIS"       => "2х+Факторная+Аутентификация+Отключена",
    "REDIR_2FA_VER"       => "2х+Факторная+Аутентификация+Проверена+и+Включена",
    "REDIR_SOM_TING_WONG" => "Что-то+пошло+не+так.+Пожалуйста,+повторите+попытку.",
    "REDIR_MSG_NOEX"      => "Эта+тема+не+является+Вашей+или+не+существует",
    "REDIR_UN_ONCE"       => "Имя+пользователя+уже+было+изменено.",
    "REDIR_EM_SUCC"       => "Письмо+Обновлено+Успешно",
    ));

  //Emails
  $lang = array_merge($lang,array(
    "EML_CONF"    => "Подтвердить электронную почту",
    "EML_VER"     => "Проверить свою электронную почту",
    "EML_CHK"     => "Получен запрос по электронной почте. Пожалуйста, проверьте свою электронную почту для выполнения проверки. Обязательно проверьте папку `Спам и Корзину` до истечения срока действия верификационной ссылки в папке ",
    "EML_MAT"     => "Ваш адрес электронной почты не совпадает.",
    "EML_HELLO"   => "Привет от ",
    "EML_HI"      => "Привет",
    "EML_AD_HAS"  => "Администратор сбросил ваш пароль.",
    "EML_AC_HAS"  => "Администратор создал вашу учетную запись.",
    "EML_REQ"     => "Вам необходимо будет установить пароль, используя вышеуказанную ссылку.",
    "EML_EXP"     => "Обратите внимание, что срок действия ссылок на пароли истекает в ",
    "EML_VER_EXP" => "Обратите внимание, что срок действия верификационных ссылок истекает в ",
    "EML_CLICK"   => "Щелкните здесь, чтобы войти",
    "EML_REC"     => "Рекомендуется изменить пароль при входе в систему.",
    "EML_MSG"     => "У вас новое сообщение от",
    "EML_REPLY"   => "Нажмите здесь, чтобы ответить или просмотреть тему",
    "EML_WHY"     => "Вы получили это сообщение, потому что нами был получен запрос на сброс пароля. Если Вы его не отправляли, то можете проигнорировать это письмо",
    "EML_HOW"     => "Если это были Вы, нажмите на ссылку ниже, чтобы продолжить процесс сброса пароля",
    "EML_EML"     => "Запрос на изменение адреса электронной почты был сделан из вашей учетной записи пользователя",
    "EML_VER_EML" => "Спасибо, что зарегистрировались.  Как только Вы подтвердите свой адрес электронной почты, то сможете войти в систему! Пожалуйста, перейдите по ссылке, чтобы подтвердить свой адрес электронной почты",

    ));

    //Verification
    $lang = array_merge($lang,array(
      "VER_SUC"     => "Ваша электронная почта была подтверждена!",
      "VER_FAIL"    => "Мы не смогли проверить Вашу учетную запись. Пожалуйста, попробуйте еще раз.",
      "VER_RESEND"  => "Повторная отправка сообщения на электронную почту с подтверждением",
      "VER_AGAIN"   => "Введите адрес электронной почты и повторите попытку",
      "VER_PAGE"    => "<li>Проверьте адрес электронной почты и щелкните по ссылке, которая будет вам отправлена</li><li></li>Готово</li>",
      "VER_RES_SUC" => "<p>Нажмите на ссылку в электронном письме, чтобы завершить проверку. Обязательно проверьте папку 'Спам', если письмо не находится в папке 'Входящие'.</p><p>Ссылки для верификации действительны только для ",
      "VER_OOPS"    => "Что-то пошло не так, возможно вы нажали на старую ссылку сброса. Нажмите ниже, чтобы повторить попытку",
      "VER_RESET"   => "Ваш пароль сброшен!",
      "VER_INS"     => "<li>Введите свой адрес электронной почты и нажмите кнопку Сброс</li> <li>Проверьте свою электронную почту и пройдите по ссылке, которая вам отправлена.
                        <li> Следуйте инструкциям на экране</li>",
      "VER_SENT"    => "<p>Ссылка на сброс пароля отправлена на ваш электронный адрес.</p><p>Нажмите на ссылку в сообщении электронной почты для сброса пароля. Обязательно проверьте папку 'Спам', если письмо не находится в папке 'Входящие'.</p><p>Сброс ссылок действителен только для ",
      "VER_PLEASE"  => "Пожалуйста, сбросьте пароль",
      ));

  //User Settings
  $lang = array_merge($lang,array(
    "SET_PIN"       => "Сброс PIN-кода",
    "SET_WHY"       => "Почему я не могу изменить это?",
    "SET_PW_MATCH"  => "Должен соответствовать новому паролю",
    "SET_PIN_NEXT"  => "Вы можете установить новый PIN-код при следующей проверке",
    "SET_UPDATE"    => "Обновить пользовательские настройки",
    "SET_NOCHANGE"  => "Администратор отключил изменение имен пользователей.",
    "SET_ONECHANGE" => "Администратор установил, что изменение имени пользователя возможно только один раз, и вы это уже сделали",
    "SET_GRAVITAR"  => "<strong> Хотите изменить изображение своего профиля? </strong><br> Посетите <a href='https://en.gravatar.com/'>https://en.gravatar.com/</a> и создайте учетную запись с тем же адресом электронной почты, который вы использовали на этом сайте. Она работает на миллионах сайтов. Это быстро и просто!",
    "SET_NOTE1"     => "<p><strong>Примечание</strong> - запрос на обновление адреса электронной почты находится на рассмотрении",
    "SET_NOTE2"     => ".</p><p>Пожалуйста, используйте электронное письмо для проверки для завершения этого запроса.<p>Если вам нужен новый адрес электронной почты для проверки, пожалуйста, введите его повторно и отправьте запрос еще раз.</p>",
    "SET_PW_REQ"    => "Требуется для смены пароля, адреса электронной почты или сброса PIN-кода",
    "SET_PW_REQI"   => "Требуется для смены пароля",

    ));

  //Errors
  $lang = array_merge($lang,array(
    "ERR_FAIL_ACT"  => "Не удалось завершить активные сеансы, ошибка: ",
    "ERR_EMAIL"     => "Сообщение не отправлено из-за ошибки. Пожалуйста, свяжитесь с администратором сайта",
    "ERR_EM_DB"     => "Этого адреса электронной почты в нашей базе данных не существует",
    "ERR_TC"        => "Пожалуйста, прочитайте и примите условия",
    "ERR_CAP"       => "Ты провалил тест, Робот!",
    "ERR_PW_SAME"   => "Ваш старый пароль не может быть таким же, как и новый",
    "ERR_PW_FAIL"   => "Неудачная проверка текущего пароля. Обновление не завершено. Пожалуйста, попробуйте еще раз.",
    "ERR_GOOG"      => "<strong>NOTE:</strong> Если вы изначально зарегистрировались в своей учетной записи Google/Facebook, вам нужно будет использовать ссылку для смены пароля.",
    "ERR_EM_VER"    => "Проверка электронной почты не включена. Обратитесь к системному администратору",
    "ERR_EMAIL_STR" => "Что-то странное. Пожалуйста, проверьте свою электронную почту заново. Приносим извинения за причиненные неудобства",

    ));

  //Maintenance Page
  $lang = array_merge($lang,array(
    "MAINT_HEAD"    => "Мы скоро вернемся!",
    "MAINT_MSG"     => "Извините за неудобства, но в данный момент мы выполняем некоторые работы по обслуживанию",
    "MAINT_BAN"     => "Простите. Вас заблокировали. Если Вы считаете, что это ошибка, обратитесь к администратору",
    "MAINT_TOK"     => "С вашей формой произошла ошибка. Пожалуйста, вернитесь назад и попробуйте еще раз. Обратите внимание, что заполнение формы путем обновления страницы приведет к ошибке. Если это ровторится, обратитесь к администратору",
    "MAINT_OPEN"    => "Открытый исходный код PHP User Management Framework.",
    "MAINT_PLEASE"  => "Вы успешно установили UserSpice!<br>Для просмотра документации перед началом работы, пожалуйста, посетите наш сайт",
    ));

    //dataTables Added in 4.4.08
    //NOTE: do not change the words like _START_ between the two _ symbols!
    $lang = array_merge($lang,array(
      "DAT_SEARCH"    => "Поиск",
      "DAT_FIRST"     => "Первый",
      "DAT_LAST"      => "Последний",
      "DAT_NEXT"      => "Следующий",
      "DAT_PREV"      => "Предыдущий",
      "DAT_NODATA"    => "Нет данных в таблице",
      "DAT_INFO"      => "Отображение _START_ - _END_ записей из _TOTAL_",
      "DAT_ZERO"      => "Показывает от 0 до 0 из 0 записей",
      "DAT_FILTERED"  => "(отфильтрован из _MAX_ записей)",
      "DAT_MENU_LENG" => "Показать записи _MENU_",
      "DAT_LOADING"   => "Загрузка...",
      "DAT_PROCESS"   => "Обработка...",
      "DAT_NO_REC"    => "Соответствующие записи не найдены",
      "DAT_ASC"       => "Активировать для сортировки по возрастанию столбца",
      "DAT_DESC"      => "Активировать для сортировки нисходящего столбца",
    ));



//LEAVE THIS LINE AT THE BOTTOM.  It allows users/lang to override these keys
if(file_exists($abs_us_root.$us_url_root."usersc/lang/".$lang["THIS_CODE"].".php")){
  include($abs_us_root.$us_url_root."usersc/lang/".$lang["THIS_CODE"].".php");
}
?>
