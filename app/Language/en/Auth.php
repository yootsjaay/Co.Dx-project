<?php

namespace Myth\Auth\Language\es; // Cambiado a español

return [
    // Excepciones
    'invalidModel'        => 'El modelo {0} debe ser cargado antes de su uso.',
    'userNotFound'        => 'No se puede encontrar un usuario con ID = {0, number}.',
    'noUserEntity'        => 'La Entidad de Usuario debe ser proporcionada para la validación de la contraseña.',
    'tooManyCredentials'  => 'Solo puedes validar 1 credencial además de la contraseña.',
    'invalidFields'       => 'El campo "{0}" no puede ser utilizado para validar credenciales.',
    'unsetPasswordLength' => 'Debes establecer la configuración `minimumPasswordLength` en el archivo de configuración de Auth.',
    'unknownError'        => 'Lo siento, encontramos un problema al enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.',
    'notLoggedIn'         => 'Debes iniciar sesión para acceder a esa página.',
    'notEnoughPrivilege'  => 'No tienes suficientes permisos para acceder a esa página.',

    // Registro
    'registerDisabled' => 'Lo siento, las nuevas cuentas de usuario no están permitidas en este momento.',
    'registerSuccess'  => '¡Bienvenido! Por favor, inicia sesión con tus nuevas credenciales.',
    'registerCLI'      => 'Nuevo usuario creado: {0}, #{1}',

    // Activación
    'activationNoUser'       => 'No se puede encontrar un usuario con ese código de activación.',
    'activationSubject'      => 'Activa tu cuenta',
    'activationSuccess'      => 'Por favor, confirma tu cuenta haciendo clic en el enlace de activación en el correo electrónico que te hemos enviado.',
    'activationResend'       => 'Reenviar mensaje de activación una vez más.',
    'notActivated'           => 'Esta cuenta de usuario aún no está activada.',
    'errorSendingActivation' => 'Error al enviar mensaje de activación a: {0}',

    // Inicio de sesión
    'badAttempt'      => 'No se puede iniciar sesión. Por favor, comprueba tus credenciales.',
    'loginSuccess'    => '¡Bienvenido de nuevo!',
    'invalidPassword' => 'No se puede iniciar sesión. Por favor, comprueba tu contraseña.',

    // Contraseñas olvidadas
    'forgotDisabled'  => 'La opción de restablecimiento de contraseña ha sido deshabilitada.',
    'forgotNoUser'    => 'No se puede encontrar un usuario con ese correo electrónico.',
    'forgotSubject'   => 'Instrucciones para restablecer la contraseña',
    'resetSuccess'    => 'Tu contraseña ha sido cambiada con éxito. Por favor, inicia sesión con la nueva contraseña.',
    'forgotEmailSent' => 'Se ha enviado un token de seguridad a tu correo electrónico. Introdúcelo en el siguiente cuadro para continuar.',
    'errorEmailSent'  => 'No se puede enviar el correo electrónico con las instrucciones para restablecer la contraseña a: {0}',
    'errorResetting'  => 'No se pueden enviar instrucciones de reinicio a {0}',

    // Contraseñas
    'errorPasswordLength'         => 'Las contraseñas deben tener al menos {0, number} caracteres de longitud.',
    'suggestPasswordLength'       => 'Las frases de contraseña - de hasta 255 caracteres de longitud - hacen que las contraseñas sean más seguras y fáciles de recordar.',
    'errorPasswordCommon'         => 'La contraseña no debe ser una contraseña común.',
    'suggestPasswordCommon'       => 'La contraseña se comprobó contra más de 65k contraseñas comúnmente utilizadas o contraseñas que se han filtrado a través de hackeos.',
    'errorPasswordPersonal'       => 'Las contraseñas no pueden contener información personal rehashed.',
    'suggestPasswordPersonal'     => 'Las variaciones de tu dirección de correo electrónico o nombre de usuario no deben ser utilizadas como contraseñas.',
    'errorPasswordTooSimilar'     => 'La contraseña es demasiado similar al nombre de usuario.',
    'suggestPasswordTooSimilar'   => 'No uses partes de tu nombre de usuario en tu contraseña.',
    'errorPasswordPwned'          => 'La contraseña {0} ha sido expuesta debido a una violación de datos y se ha visto {1, number} veces en {2} de las contraseñas comprometidas.',
    'suggestPasswordPwned'        => '{0} nunca debe ser utilizado como contraseña. Si lo estás utilizando en algún lugar, cámbialo inmediatamente.',
    'errorPasswordPwnedDatabase'  => 'una base de datos',
    'errorPasswordPwnedDatabases' => 'bases de datos',
    'errorPasswordEmpty'          => 'Se requiere una contraseña.',
    'passwordChangeSuccess'       => 'Contraseña cambiada con éxito',
    'userDoesNotExist'            => 'La contraseña no se cambió. El usuario no existe',
    'resetTokenExpired'           => 'Lo siento. Tu token de restablecimiento ha caducado.',

    // Grupos
    'groupNotFound' => 'No se puede encontrar el grupo: {0}.',

    // Permisos
    'permissionNotFound' => 'No se puede encontrar el permiso: {0}',

    // Prohibido
    'userIsBanned' => 'El usuario ha sido prohibido. Contacta al administrador',

    // Demasiadas solicitudes
    'tooManyRequests' => 'Demasiadas solicitudes. Por favor, espera {0, number} segundos.',

    // Vistas de inicio de sesión
    'home'                      => 'Inicio',
    'current'                   => 'Actual',
    'forgotPassword'            => '¿Olvidaste tu contraseña?',
    'enterEmailForInstructions' => '¡No hay problema! Ingresa tu correo electrónico a continuación y te enviaremos instrucciones para restablecer tu contraseña.',
    'email'                     => 'Correo electrónico',
    'emailAddress'              => 'Dirección de correo electrónico',
    'sendInstructions'          => 'Enviar Instrucciones',
    'loginTitle'                => 'Iniciar sesión',
    'loginAction'               => 'Iniciar sesión',
    'rememberMe'                => 'Recuérdame',
    'needAnAccount'             => '¿Necesitas una cuenta?',
    'forgotYourPassword'        => '¿Olvidaste tu contraseña?',
    'password'                  => 'Contraseña',
    'repeatPassword'            => 'Repetir Contraseña',
    'emailOrUsername'           => 'Correo electrónico o nombre de usuario',
    'username'                  => 'Nombre de usuario',
    'register'                  => 'Registrarse',
    'signIn'                    => 'Iniciar',
    'alreadyRegistered'         => '¿Ya registrado?',
    'weNeverShare'              => 'Nunca compartiremos tu correo electrónico con nadie más.',
    'resetYourPassword'         => 'Restablece tu contraseña',
    'enterCodeEmailPassword'    => 'Ingresa el código que recibiste por correo electrónico, tu dirección de correo electrónico y tu nueva contraseña.',
    'token'                     => 'Token',
    'newPassword'               => 'Nueva Contraseña',
    'newPasswordRepeat'         => 'Repetir Nueva Contraseña',
    'resetPassword'             => 'Restablecer Contraseña',
];
