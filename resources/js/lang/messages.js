export default {
    'en': {
        message: {
            since_the_last: 'since the last',
            police_report: 'police report',
            domestic_violence_in_st_petersburg: 'of a possible domestic violence incident in ',
            prev: 'Prev',
            next: 'Next',
            about: 'About',
            connect: 'Connect',
            disconnect: 'Disconnect',
            email: 'Email',
            last_updated: 'Last updated',
            updating_next: 'Updating next',
            first_event: 'You\'ve reached the first event',
            last_event: 'You\'ve reached the last event',
            // Connect Dialog
            connect_dialog_title: 'Stay connected with Blink(1)',
            connect_dialog_subtitle: 'Illuminate with blink(1) for Enhanced Awareness',
            connect_dialog_text: 'Connect a blink(1) USB LED light to your laptop and it will automatically illuminate purple when a DV incident is reported, and stay lit for 1 hour.',
            connect_dialog_connect_button: 'Connect',
            connect_dialog_amazon_referral_button: 'Buy Blink(1) on Amazon',
            // Settings
            settings: 'Settings',
            // Settings - Cities
            cities: 'Cities',
            // Settings - Language
            language: 'Language',
            english: 'English',
            portuguese: 'Brazilian Portuguese',
            spanish: 'Spanish',
            // Settings - Notifications
            notifications: 'Notifications',
            subscribe_st_petersburg_pd: 'Subscribe to St. Petersburg PD',
            subscribe_orlando_pd: 'Subscribe to Orlando PD',
            receive_messages: 'Receive notifications in your browser'
        },
        // Error screen
        error: {
            '503_title': '503 Service Unavailable',
            '500_title': '500 Server Error',
            '404_title': '404 Page Not Found',
            '403_title': '403 Forbidden',
            '503_description': 'Sorry, we are doing some maintenance. Please check back soon.',
            '500_description': 'Whoops, something went wrong on our servers.',
            '404_description': 'Sorry, the page you are looking for could not be found.',
            '403_description': 'Sorry, you are forbidden from accessing this page.',
        },
        // Authenticated screens
        general: {
            navigation: {
                dashboard: 'Dashboard',
                profile: 'Your Profile',
                security: 'Security Options',
                log_out: 'Log out'
            }
        },
        // Dashboard screen
        dashboard: {
            page_title: 'Dashboard',
            first_section_title: 'Collect your access information',
            first_section_subtitle: 'Are you new here? We created this video to help you setup your account on Lifx.',
            second_section_title: 'Set your access key',
            second_section_subtitle: 'Are you ready to setup your access token? Just leave it here and we will save it securily.',
            form_access_key_label: 'Acess Token',
            third_section_title: 'Select your lamps',
            third_section_subtitle: 'Unleash the power of Blink-Safety! Connect all your Lifx lights for a truly immersive experience.',
            reset_my_token_button: 'Reset my token',
            light_id_th: 'Light Id',
            light_label_th: 'Label',
            light_power_th: 'Power',
            light_actions_th: 'Actions',
            light_power_on_td: 'On',
            light_power_off_td: 'Off',
            light_connect_td: 'Connect to Blink-safety',
            light_disconnect_td: 'Disconnect to Blink-safety',
            light_no_row_td: 'Sorry. We were not able to detect any new lights for now. Did you connect to Lifx lights?',
            previous_button: 'Previous',
            next_button: 'Next',
        },
        // Profile screen
        profile: {
            page_title: 'Profile',
            // Profile Section
            profile: {
                title: 'Personal Information',
                subtitle: 'Let\'s rewrite the narrative. Update your profile to showcase your commitment to building a world free from domestic violence. Share actions, resources and raise awareness with us.',
                form_name_label: 'Name',
                form_email_label: 'Email address',
                form_photo_label: 'Photo',
                form_required_label: 'required',
                cancel_button: 'Cancel',
                update_profile_button: 'Update Profile',
            },
            // Language Section
            language: {
                title: 'Languages',
                subtitle: 'To get the best experience, tell us your preferred language:',
                english: 'English',
                portuguese: 'Brazilian Portuguese',
                spanish: 'Spanish',
                cancel_button: 'Cancel',
                update_language_button: 'Update Language',
            },
            // Notifications Section
            notifications: {
                title: 'Notifications',
                subtitle: 'We\'ll always let you know about important changes, but you pick what else you want to hear about.',
                email_title: 'Email',
                email_subtitle: 'If you would like to receive our newsletter just check the box bellow.',
                form_email_label: 'Subscribe to our newsletter',
                push_title: 'Push Notifications',
                push_subtitle: 'We deliver the domestic violence notifications straight in your browser notification system, choose below which cities\' police departaments you would like to receive.',
                form_stpetersburg_label: 'Subscribe to St.Petersburg PD',
                form_orlando_label: 'Subscribe to Orlando PD',
                lifx_title: 'Lifx Notifications',
                lifx_subtitle: 'We deliver the domestic violence notifications straight to you as a lamp signal, choose below which cities\' police departaments you would liek to receive',
                cancel_button: 'Cancel',
                update_notification_button: 'Update Notifications',
            },
            // Danger Zone Section
            danger_zone: {
                title: 'Danger Zone',
                subtitle: 'This action will permanently close your account and erase all associated data.',
                remove_account_title: 'Remove account',
                remove_account_subtitle: 'To remove your account from blink-safety, click on remove my account button and click on the confirmation button.',
                remove_my_account_button: 'Remove my account',
                // Modal with confirmation
                modal: {
                    title: 'Remove my account',
                    first_paragraph: 'We value you as a user and want to make sure you have a positive experience with our platform. If you\'re having any issues or concerns, please let us know and we\'ll do our best to help resolve them.',
                    second_paragraph: 'Here are some things to consider before deleting your account:',
                    loss_access_title: 'Loss of access',
                    loss_access_description: 'Deleting your account will mean losing access to all of your data, including any content you\'ve created or saved.',
                    potential_inconvenience_title: 'Potential inconvenience',
                    potential_inconvenience_description: 'If you decide to come back in the future, you\'ll need to create a new account and start from scratch.',
                    alternatives_title: 'Alternatives',
                    alternatives_description: 'There may be other options available, such as taking a break from the platform or changing your settings to better suit your needs.',
                    last_paragraph: 'If you\'ve made up your mind to delete your account, we understand. However, we encourage you to reach out to us first to see if we can address any concerns you have.',
                    cancel_button: 'Cancel',
                    confirm_button: 'Confirm',
                }
            },
        },
        // Security
        security: {
            page_title: 'Security',
            // Change Password Section
            change_password: {
                password_title: 'Password',
                password_subtitle: 'Ready, set, secure! Accept the challenge and update your passwords to impenetrable fortresses. Remember, the more we learn and share, the safer we all become!',
                form_current_password_label: 'Current Password',
                form_new_password_label: 'New Password',
                form_new_password_confirmation_label: 'New Password Confirmation',
                form_required_label: 'required',
                cancel_button: 'Cancel',
                update_password_button: 'Update Password',
                modal_success_change_password_title: 'You are much safer now!',
                modal_success_change_password_subtitle: 'Congratulations on strengthening your password! Taking the step to create a more secure password helps protect your valuable information. You\'ve made a wise decision for your digital safety.',
                modal_error_change_password_title: 'Something went wrong',
                modal_error_change_password_subtitle: ' We\'re sorry, but we encountered an unexpected error while processing your request. Our team is working hard to fix the issue as soon as possible. Please try again later.',
            },
            // Forgot Password Section
            forgot_password: {
                forgot_password_title: 'Forgot your current password?',
                forgot_password_subtitle: 'Oops, password memory lapse? No worries! We\'ve all been there. Click "Send me a reset email" and we\'ll guide you through a quick reset process.',
                form_email_label: 'Email',
                form_required_label: 'required',
                cancel_button: 'Cancel',
                send_me_a_reset_email_button: 'Send me a reset email',
                modal_success_forgot_password_title: 'Reset your password email sent!',
                modal_success_forgot_password_subtitle: 'We received a request to reset your password. To continue, please check your email for a verification link. Click on the link to set a new password for your account.',
                modal_error_forgot_password_title: 'Something went wrong',
                modal_error_forgot_password_subtitle: ' We\'re sorry, but we encountered an unexpected error while processing your request. Our team is working hard to fix the issue as soon as possible. Please try again later.',
            },
        }
    },
    'es': {
        message: {
            since_the_last: 'desde el último',
            police_report: 'reporte policial',
            domestic_violence_in_st_petersburg: 'de un posible incidente de violencia doméstica en ',
            prev: 'Anterior',
            next: 'Próximo',
            about: 'Acerca',
            connect: 'Conectar',
            disconnect: 'Desconectar',
            email: 'Correo electrónico',
            last_updated: 'Última actualización',
            updating_next: 'Actualizando de nuevo',
            first_event: 'Este es el primer evento registrado',
            last_event: 'Este es el último evento registrado',
            // Connect Dialog
            connect_dialog_title: 'Mantente conectado con Blink(1)',
            connect_dialog_subtitle: 'Ilumina con blink(1) para una Conciencia Mejorada',
            connect_dialog_text: 'Conecta una luz LED USB blink(1) a tu laptop y se iluminará automáticamente de color morado cuando se informe de un incidente de violencia doméstica (DV), y permanecerá encendida durante 1 hora.',
            connect_dialog_connect_button: 'Conectar',
            connect_dialog_amazon_referral_button: 'Compra el Blink(1) en Amazon',
            // Settings
            settings: 'Ajustes',
            // Settings - Cities
            cities: 'Ciudades',
            // Settings - Language
            language: 'Idioma',
            english: 'Inglés',
            portuguese: 'Portugués',
            spanish: 'Español',
            // Settings - Notifications
            notifications: 'Notificaciones',
            subscribe_st_petersburg_pd: 'Suscríbete a la policía de St. Petersburgo',
            subscribe_orlando_pd: 'Suscríbete a la policía de Orlando',
            receive_messages: 'Recibe mensajes en tu navegador'
        },
        error: {
            '503_title': '503 Servicio No Disponible',
            '500_title': '500 Error del Servidor',
            '404_title': '404 Página no encontrada',
            '403_title': '403 Prohibido',
            '503_description': 'Lo sentimos, estamos haciendo algo de mantenimiento. Por favor, revise luego.',
            '500_description': 'Vaya, algo salió mal en nuestros servidores.',
            '404_description': 'Lo sentimos, no se pudo encontrar la página que estás buscando.',
            '403_description': 'Lo sentimos, tienes prohibido acceder a esta página.',
        },
        // Authenticated screens
        general: {
            navigation: {
                dashboard: 'Panel de control',
                profile: 'Tu perfil',
                security: 'Seguridad',
                log_out: 'Cerrar sesión',
            }
        },
        // Dashboard screen
        dashboard: {
            page_title: 'Panel de control',
            first_section_title: 'Recopila tu información de acceso',
            first_section_subtitle: '¿Eres nuevo aquí? Creamos este video para ayudarte a configurar tu cuenta en Lifx.',
            second_section_title: 'Configura tu clave de acceso',
            second_section_subtitle: '¿Estás listo para configurar tu token de acceso? Solo déjalo aquí y lo guardaremos de forma segura.',
            form_access_key_label: 'Token de acceso',
            third_section_title: 'Selecciona tus lámparas',
            third_section_subtitle: '¡Desata el poder de Blink-Safety! Conecta todas tus luces Lifx para una experiencia verdaderamente inmersiva.',
            reset_my_token_button: 'Restablecer mi token',
            light_id_th: 'ID de la lámpara',
            light_label_th: 'Etiqueta',
            light_power_th: 'Encendido',
            light_actions_th: 'Acciones',
            light_power_on_td: 'Encendido',
            light_power_off_td: 'Apagado',
            light_connect_td: 'Conectar a Blink-safety',
            light_disconnect_td: 'Desconectar de Blink-safety',
            light_no_row_td: 'Lo sentimos. No pudimos detectar ninguna lámpara nueva por ahora. ¿Te conectaste a luces Lifx?',
            previous_button: 'Anterior',
            next_button: 'Siguiente',
        },
        // Profile screen
        profile: {
            page_title: 'Perfil',
            // Profile section
            profile: {
                title: 'Información personal',
                subtitle: 'Reescribamos la narrativa. Actualiza tu perfil para mostrar tu compromiso con la construcción de un mundo libre de violencia doméstica. Comparte acciones, recursos y concientiza con nosotros.',
                form_name_label: 'Nombre',
                form_email_label: 'Correo electrónico',
                form_photo_label: 'Foto',
                form_required_label: 'obligatorio',
                cancel_button: 'Cancelar',
                update_profile_button: 'Actualizar Perfil',
            },
            // Language zone section
            language: {
                title: 'Idiomas',
                subtitle: 'Para obtener la mejor experiencia, dinos tu idioma preferido:',
                english: 'Inglés',
                spanish: 'Español',
                portuguese: 'Portugués brasileño',
                cancel_button: 'Cancelar',
                update_language_button: 'Actualizar Idioma',
            },
            // Notifications zone section
            notifications: {
                title: 'Notificaciones',
                subtitle: 'Siempre te informaremos sobre cambios importantes, pero tú eliges de qué más quieres escuchar.',
                email_title: 'Correo electrónico',
                email_subtitle: 'Si deseas recibir nuestro boletín de noticias, marca la casilla de abajo.',
                form_email_label: 'Suscríbete a nuestro boletín informativo',
                push_title: 'Notificaciones Push',
                push_subtitle: 'Te enviamos notificaciones sobre violencia doméstica directamente al sistema de notificaciones de tu navegador. Selecciona a continuación de qué departamentos de policía de las ciudades deseas recibirlas.',
                form_stpetersburg_label: 'Suscribirse a la policía de San Petersburgo',
                form_orlando_label: 'Suscribirse a la policía de Orlando',
                cancel_button: 'Cancelar',
                update_notification_button: 'Actualizar Notificaciones',
            },
            // Danger zone section
            danger_zone: {
                title: 'Eliminar cuenta',
                subtitle: 'Esta acción cerrará permanentemente tu cuenta y eliminará todos los datos asociados.',
                remove_account_title: 'Eliminar cuenta',  // Changed to match title
                remove_account_subtitle: 'Para eliminar tu cuenta de blink-safety, haz clic en el botón "Eliminar mi cuenta" y confirma en el botón de confirmación.',
                remove_my_account_button: 'Eliminar mi cuenta',
                // Modal with confirmation
                modal: {
                    title: 'Eliminar mi cuenta',
                    first_paragraph: 'Te valoramos como usuario y queremos asegurarnos de que tengas una experiencia positiva con nuestra plataforma. Si tienes algún problema o inquietud, por favor háznoslo saber y haremos todo lo posible para ayudarte a resolverlo.',
                    second_paragraph: 'Aquí hay algunas cosas a tener en cuenta antes de eliminar tu cuenta:',
                    loss_access_title: 'Pérdida de acceso',
                    loss_access_description: 'Eliminar tu cuenta significará perder el acceso a todos tus datos, incluido cualquier contenido que hayas creado o guardado.',
                    potential_inconvenience_title: 'Posibles inconvenientes',
                    potential_inconvenience_description: 'Si decides volver en el futuro, deberás crear una nueva cuenta y empezar desde cero.',
                    alternatives_title: 'Alternativas',
                    alternatives_description: 'Puede que haya otras opciones disponibles, como tomarte un descanso de la plataforma o cambiar tu configuración para que se adapte mejor a tus necesidades.',
                    last_paragraph: 'Entendemos que si ya tomaste la decisión de eliminar tu cuenta. Sin embargo, te animamos a que te pongas en contacto con nosotros primero para ver si podemos abordar cualquier inquietud que tengas.',
                    cancel_button: 'Cancelar',
                    confirm_button: 'Confirmar',
                }
            },
        },
        // Security
        security: {
            page_title: 'Seguridad',
            // Change Password Section
            change_password: {
                password_title: 'Contraseña',
                password_subtitle: '¡Preparados, listos, seguros! Acepta el desafío y actualiza tus contraseñas a fortalezas impenetrables. Recuerda, ¡cuanto más aprendemos y compartimos, más seguros estaremos todos!',
                form_current_password_label: 'Contraseña actual',
                form_new_password_label: 'Nueva contraseña',
                form_new_password_confirmation_label: 'Confirmar nueva contraseña',
                form_required_label: 'obligatorio',
                cancel_button: 'Cancelar',
                update_password_button: 'Actualizar contraseña',
                modal_success_change_password_title: '¡Ahora estás mucho más seguro!',
                modal_success_change_password_subtitle: '¡Felicitaciones por fortalecer tu contraseña! Tomar la decisión de crear una contraseña más segura ayuda a proteger tu información valiosa. Has tomado una decisión inteligente para tu seguridad digital.',
                modal_error_change_password_title: 'Algo salió mal',
                modal_error_change_password_subtitle: 'Lo sentimos, pero encontramos un error inesperado al procesar tu solicitud. Nuestro equipo está trabajando arduamente para solucionar el problema lo antes posible. Inténtalo de nuevo más tarde.',
            },
            // Forgot Password Section
            forgot_password: {
                forgot_password_title: '¿Olvidaste tu contraseña actual?',
                forgot_password_subtitle: '¿Ups, se te olvidó la contraseña? ¡No te preocupes! A todos nos ha pasado. Haz clic en "Envíame un correo electrónico de restablecimiento" y te guiaremos a través de un proceso de restablecimiento rápido.',
                form_email_label: 'Correo electrónico',
                form_required_label: 'obligatorio',
                cancel_button: 'Cancelar',
                send_me_a_reset_email_button: 'Envíame un correo electrónico de restablecimiento',
                modal_success_forgot_password_title: '¡Correo electrónico para restablecer tu contraseña enviado!',
                modal_success_forgot_password_subtitle: 'Recibimos una solicitud para restablecer tu contraseña. Para continuar, verifica tu correo electrónico para ver un enlace de verificación. Haz clic en el enlace para establecer una nueva contraseña para tu cuenta.',
                modal_error_forgot_password_title: 'Algo salió mal',
                modal_error_forgot_password_subtitle: 'Lo sentimos, pero encontramos un error inesperado al procesar tu solicitud. Nuestro equipo está trabajando arduamente para solucionar el problema lo antes posible. Inténtalo de nuevo más tarde.',
            }
        }
    },
    'pt-br': {
        message: {
            since_the_last: 'desde o último',
            police_report: 'relatório policial',
            domestic_violence_in_st_petersburg: 'de um possível incidente de violência doméstica em ',
            prev: 'Anterior',
            next: 'Próximo',
            about: 'Sobre',
            connect: 'Conectar',
            disconnect: 'Desconectar',
            email: 'E-mail',
            last_updated: 'Última atualização',
            updating_next: 'Atualizando novamente',
            first_event: 'Esse é o primeiro evento registrado',
            last_event: 'Esse é o último evento registrado',
            // Connect Dialog
            connect_dialog_title: 'Fique conectado com o Blink(1)',
            connect_dialog_subtitle: 'Ilumine com blink(1) para Consciência Aprimorada',
            connect_dialog_text: 'Conecte uma luz LED USB blink(1) ao seu laptop e ela se iluminará automaticamente em roxo quando um incidente de violência doméstica (DV) for relatado, permanecendo acesa por 1 hora.',
            connect_dialog_connect_button: 'Conectar',
            connect_dialog_amazon_referral_button: 'Comprar Blink(1) na Amazon',
            //Settings
            settings: 'Configurações',
            // Config - Cities
            cities: 'Cidades',
            // Config - Language
            language: 'Idioma',
            english: 'Inglês',
            portuguese: 'Português',
            spanish: 'Espanhol',
            // Config - Notifications
            notifications: 'Notificações',
            subscribe_st_petersburg_pd: 'Receba notificações da polícia de St. Petersburgo',
            subscribe_orlando_pd: 'Receba notificações da polícia de Orlando',
            receive_messages: 'Receba mensagens no seu navegador'
        },
        // Error screen
        error: {
            '503_title': '503 Serviço não disponível',
            '500_title': '500 Erro de servidor',
            '404_title': '404 Página não encontrada',
            '403_title': '403 Proibido',
            '503_description': 'Desculpe, nós estamos fazendo algumas manutenções. Por favor, retorne em breve.',
            '500_description': 'Oops, alguma coisa de errado ocorreu em nossos servidores.',
            '404_description': 'Desculpe, a página que está procurando não pode ser encontrada.',
            '403_description': 'Desculpe, você não pode acessar essa página.',
        },
        // Authenticated screens
        general: {
            navigation: {
                dashboard: 'Painel de Controle',
                profile: 'Perfil',
                security: 'Segurança',
                log_out: 'Sair'
            }
        },
        // Dashboard screen
        dashboard: {
            page_title: 'Painel de Controle',
            first_section_title: 'Colete suas informações de acesso',
            first_section_subtitle: 'É novo por aqui? Criamos este vídeo para ajudá-lo a configurar sua conta na Lifx.',
            second_section_title: 'Defina sua chave de acesso',
            second_section_subtitle: 'Pronto para configurar seu token de acesso? Basta deixá-lo aqui e nós o salvaremos com segurança.',
            form_access_key_label: 'Token de acesso',
            third_section_title: 'Selecione suas lâmpadas',
            third_section_subtitle: 'Libere o poder do Blink-Safety! Conecte todas as suas luzes Lifx para uma experiência imersiva.',
            reset_my_token_button: 'Redefinir meu token',
            light_id_th: 'ID da lâmpada',
            light_label_th: 'Nome',
            light_power_th: 'Energia',
            light_actions_th: 'Ações',
            light_power_on_td: 'Ligado',
            light_power_off_td: 'Desligado',
            light_connect_td: 'Conectar ao Blink-safety',
            light_disconnect_td: 'Desconectar do Blink-safety',
            light_no_row_td: 'Desculpe. Não conseguimos detectar nenhuma lâmpada nova no momento. Você se conectou às luzes Lifx?',
            previous_button: 'Anterior',
            next_button: 'Próximo',
        },
        // Profile screen
        profile: {
            page_title: 'Perfil',
            // Profile section
            profile: {
                title: 'Dados Pessoais',
                subtitle: 'Vamos reescrever a narrativa. Atualize seu perfil para mostrar seu compromisso com a construção de um mundo livre de violência doméstica. Compartilhe ações, recursos e aumente a conscientização conosco.',
                form_name_label: 'Nome',
                form_email_label: 'Endereço de e-mail',
                form_photo_label: 'Foto',
                form_required_label: 'obrigatório',
                cancel_button: 'Cancelar',
                update_profile_button: 'Atualizar Perfil',
            },
            // Language section
            language: {
                title: 'Idiomas',
                subtitle: 'Para ter a melhor experiência, informe seu idioma preferido:',
                english: 'Inglês',
                spanish: 'Espanhol',
                portuguese: 'Português brasileiro',
                cancel_button: 'Cancelar',
                update_language_button: 'Atualizar idioma',
            },
            // Notifications section
            notifications: {
                title: 'Notificações',
                subtitle: 'Sempre te informaremos sobre mudanças importantes, mas você escolhe o que mais quer receber.',
                email_title: 'E-mail',
                email_subtitle: 'Se você deseja receber nossa newsletter, marque a caixa abaixo.',
                form_email_label: 'Inscreva-se na nossa newsletter',
                push_title: 'Notificações Push',
                push_subtitle: 'Enviamos notificações sobre violência doméstica diretamente para o sistema de notificações do seu navegador. Selecione abaixo de quais departamentos de polícia das cidades você deseja recebê-las.',
                form_stpetersburg_label: 'Inscreva-se na polícia de São Petersburgo',
                form_orlando_label: 'Inscreva-se na polícia de Orlando',
                cancel_button: 'Cancelar',
                update_notification_button: 'Atualizar Notificações',
            },
            // Danger Zone section
            danger_zone: {
                title: 'Excluir conta',
                subtitle: 'Esta ação fechará permanentemente sua conta e excluirá todos os dados associados.',
                remove_account_title: 'Excluir conta', // Alterado para corresponder ao título principal
                remove_account_subtitle: 'Para excluir sua conta do blink-safety, clique no botão "Excluir minha conta" e confirme no botão de confirmação.',
                remove_my_account_button: 'Excluir minha conta',
                // Modal with confirmation
                modal: {
                    title: 'Excluir minha conta',
                    first_paragraph: 'Valorizamos você como usuário e queremos garantir que tenha uma experiência positiva com a nossa plataforma. Se você estiver enfrentando algum problema ou dúvida, entre em contato conosco e faremos o possível para ajudar.',
                    second_paragraph: 'Aqui estão alguns pontos para considerar antes de excluir sua conta:',
                    loss_access_title: 'Perda de acesso',
                    loss_access_description: 'Excluir sua conta significa perder acesso a todos os seus dados, incluindo qualquer conteúdo que você tenha criado ou salvo.',
                    potential_inconvenience_title: 'Possíveis inconvenientes',
                    potential_inconvenience_description: 'Se você decidir voltar no futuro, precisará criar uma nova conta e começar do zero.',
                    alternatives_title: 'Alternativas',
                    alternatives_description: 'Pode haver outras opções disponíveis, como dar um tempo da plataforma ou alterar suas configurações para melhor atender às suas necessidades.',
                    last_paragraph: 'Se você já decidiu excluir sua conta, entendemos. No entanto, recomendamos que entre em contato conosco primeiro para ver se podemos resolver qualquer dúvida que você tenha.',
                    cancel_button: 'Cancelar',
                    confirm_button: 'Confirmar',
                }
            },
        },
        // Security
        security: {
            page_title: 'Segurança',
            // Change Password section
            change_password: {
                password_title: 'Senha',
                password_subtitle: 'Pronto, firme e seguro! Aceite o desafio e atualize suas senhas para fortalezas impenetráveis. Lembre-se, quanto mais aprendemos e compartilhamos, mais seguros estaremos!',
                form_current_password_label: 'Senha atual',
                form_new_password_label: 'Nova senha',
                form_new_password_confirmation_label: 'Confirmar nova senha',
                cancel_button: 'Cancelar',
                form_required_label: 'obrigatório',
                update_password_button: 'Atualizar senha',
                modal_success_change_password_title: 'Você está muito mais seguro agora!',
                modal_success_change_password_subtitle: 'Parabéns por fortalecer sua senha! A decisão de criar uma senha mais segura ajuda a proteger suas informações valiosas. Você tomou uma decisão inteligente para sua segurança digital.',
                modal_error_change_password_title: 'Algo deu errado',
                modal_error_change_password_subtitle: 'Lamentamos, mas ocorreu um erro inesperado ao processar sua solicitação. Nossa equipe está trabalhando duro para corrigir o problema o mais rápido possível. Tente novamente mais tarde.',
            },
            // Forgot Password section
            forgot_password: {
                forgot_password_title: 'Esqueceu sua senha atual?',
                forgot_password_subtitle: 'Ops, esqueceu a senha? Não se preocupe! Acontece com todos nós. Clique em "Enviar e-mail de redefinição" e nós o guiaremos por um processo rápido de redefinição.',
                form_email_label: 'E-mail',
                form_required_label: 'obrigatório',
                cancel_button: 'Cancelar',
                send_me_a_reset_email_button: 'Enviar e-mail de redefinição',
                modal_success_forgot_password_title: 'E-mail para redefinir sua senha enviado!',
                modal_success_forgot_password_subtitle: 'Recebemos uma solicitação para redefinir sua senha. Para continuar, verifique seu e-mail para ver um link de verificação. Clique no link para definir uma nova senha para sua conta.',
                modal_error_forgot_password_title: 'Algo deu errado',
                modal_error_forgot_password_subtitle: 'Lamentamos, mas ocorreu um erro inesperado ao processar sua solicitação. Nossa equipe está trabalhando duro para corrigir o problema o mais rápido possível. Tente novamente mais tarde.',
            },
        }
    }
}
