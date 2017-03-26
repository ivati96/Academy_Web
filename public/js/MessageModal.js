(function($) {
    $.fn.MessageModal = function(options, callback) {
        /** 
            Options:
                - Type: Tipos de mensajes:
                    * Default: Valor por defecto. No muestra icono, color: gris y fondo blanco.
                    * Info: Muestra colores azules.
                    * Success: Muestra colores verdes.
                    * Warning: Muestra colores Amarillos.
                    * Danger: Muestra colores rojos.
                    * Question: Muestra colores Celestes.
                - Title: Muestra el título el mensaje.
                - Message: Muestra el mensaje.
                - ShowIcon: Mostrar icono el tipo del título (true, false).
                - Size: Mostrar el tamaño del modal (large = grande, small = pequeño).
                - Animation: Agregar animación del modal al mostrarlo (true, false).
                - Backdrop: Mostrar el fondo negro del modal.
                - Keyboard: Cerrar modal al presionar la tecla ESC.
                - Show: Mostrar modal.
                - Remote: Agregar texto de otra página.
                - ShowBtnClose: Opción para mostrar el icono de cerrar en el header (true, false).
                - IconClose: Clase que obtiene el icono del botón cerrar en el header.
                - TypeButton: Tipos de botones en el footer.
                    * Ok: Mostrar botón de Aceptar.
                    * Cancel: Mostrar botón Cancelar.
                    * Abort: Mostrar botón Abortar/Anular.
                    * Retry: Mostrar botón Reintentar.
                    * Ignore: Mostrar botón de Omitir.
                    * Yes: Mostrar botón de Sí.
                    * No: Mostrar botón de No.
                - Clases.
        **/

        var settings = {
            type: 'default', // default, info, success, warning, danger, question
            title: '',
            message: '',
            timeout: 0,
            showIcon: true,
            size: 'small', // large, small -- Muestra el tamaño del Modal.
            animation: true, //true, false -- Muestra animación del Modal.
            backdrop: true, //true, false -- Muestra el fondo del Modal.
            keyboard: true, //true, false -- Se sale al presionar ESC o false para que no lo haga.
            show: true,
            remote: true,
            showBtnClose: true,
            iconClose: 'fa fa-times',
            showFooter: true,
            typeButton: 'OkCancel', // OkCancel: Muestra botón de Aceptar y Cancelar
            colorDefault: 'text-muted', //Clase css
            colorInfo: 'text-primary', //Clase css
            colorSuccess: 'text-success', //Clase css
            colorWarning: 'text-warning', //Clase css
            colorDanger: 'text-danger', //Clase css
            colorQuestion: 'text-info', //Clase css
            backgroundDefault: '', //Clase css
            backgroundInfo: 'bg-primary', //Clase css
            backgroundSuccess: 'bg-success', //Clase css
            backgroundWarning: 'bg-warning', //Clase css
            backgroundDanger: 'bg-danger', //Clase css
            backgroundQuestion: 'bg-info', //Clase css
            iconDefault: '', //Clase css
            iconInfo: 'fa fa-info-circle',   //Clase css
            iconSuccess: 'fa fa-check-circle-o', //Clase css
            iconWarning: 'fa fa-exclamation-circle', //Clase css
            iconDanger: 'fa fa-exclamation-triangle', //Clase css
            iconQuestion: 'fa fa-question-circle', //Clase css
            classHeader: '',
            classTitle: '',
            classBody: '',
            classMessage: '',
            classFooter: '',
            ok: true, 
            okClass: 'btn btn-primary',
            okType: 'button',
            okValue: 'Aceptar',
            okText: 'Aceptar',
            okFunction: function () { _destroy(); },
            cancel: false, 
            cancelClass: 'btn btn-primary',
            cancelType: 'button',
            cancelValue: 'Cancel',
            cancelText: 'Cancel',
            cancelFunction: function () { },
            abort: false, 
            abortClass: 'btn btn-primary',
            abortType: 'button',
            abortValue: 'Abort',
            abortText: 'Abort',
            abortFunction: function () { },
            retry: false, 
            retryClass: 'btn btn-primary',
            retryType: 'button',
            retryValue: 'Retry',
            retryText: 'Retry',
            retryFunction: function () { },
            ignore: false, 
            ignoreClass: 'btn btn-primary',
            ignoreType: 'button',
            ignoreValue: 'Ignore',
            ignoreText: 'Ignore',
            ignoreFunction: function () { },
            yes: false, 
            yesClass: 'btn btn-primary',
            yesType: 'button',
            yesValue: 'Yes',
            yesText: 'Yes',
            yesFunction: function () { },
            no: false, 
            noClass: 'btn btn-primary',
            noType: 'button',
            noValue: 'No',
            noText: 'No',
            noFunction: function () { },
        };

        if(options) { $.extend(settings, options)}

        var id = 'MessageModal';
        
        function _contruct(){
            var modal = _content();
            
            $('body').prepend(modal);
            _buttons();
            $('#'+ id).modal({
                backdrop: settings.backdrop,
                keyboard: settings.keyboard,
                show: true,
            });
        }

        function _destroy(){
            $('#' + id).modal('hide');
            $('#'+id).remove();
            $('.modal-backdrop').remove();
            $('body').removeAttr('class');
            $('body').removeAttr('style');
        }

        function _buttons (){
            var buttons = '';
                    if(settings.ok){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.okClass).
                                attr("type", settings.okType).
                                attr("value", settings.okValue).
                                text(settings.okText).
                                click(settings.okFunction)
                            );
                    }

                    if(settings.cancel){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.cancelClass).
                                attr("type", settings.cancelType).
                                attr("value", settings.cancelValue).
                                text(settings.cancelText).
                                click(settings.cancelFunction)
                            );
                    }

                    if(settings.abort){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.abortClass).
                                attr("type", settings.abortType).
                                attr("value", settings.abortValue).
                                text(settings.abortText).
                                click(settings.abortFunction)
                            );
                    }

                    if(settings.retry){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.retryClass).
                                attr("type", settings.retryType).
                                attr("value", settings.retryValue).
                                text(settings.retryText).
                                click(settings.retryFunction)
                            );
                    }

                    if(settings.ignore){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.ignoreClass).
                                attr("type", settings.ignoreType).
                                attr("value", settings.ignoreValue).
                                text(settings.ignoreText).
                                click(settings.ignoreFunction)
                            );
                    }

                    if(settings.yes){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.yesClass).
                                attr("type", settings.yesType).
                                attr("value", settings.yesValue).
                                text(settings.yesText).
                                click(settings.yesFunction)
                            );
                    }

                    if(settings.no){
                        $('.modal-footer').append(
                            $('<button>').attr("class", settings.noClass).
                                attr("type", settings.noType).
                                attr("value", settings.noValue).
                                text(settings.noText).
                                click(settings.noFunction)
                            );
                    }
            }

            function iconType() {
            var icon = '';
            if(settings.showIcon) {
                switch (settings.type) {
                    default:
                        icon = '<span class="'+ settings.iconDefault +'"></span>';
                        break;
                    case 'info':
                        icon = '<span class="'+ settings.iconInfo +'"></span>';
                        break;
                    case 'success':
                        icon = '<span class="'+ settings.iconSuccess +'"></span>';
                        break;
                    case 'warning':
                        icon = '<span class="'+ settings.iconWarning +'"></span>';
                        break;
                    case 'danger':
                        icon = '<span class="'+ settings.iconDanger +'"></span>';
                        break;
                    case 'question':
                        icon = '<span class="'+ settings.iconQuestion +'"></span>';
                        break;
                } 
            }
            return icon;
        }

        function backgroundHeader() {
            var background = '';
            switch (settings.type) {
                default:
                    background = settings.backgroundDefault;
                    break;
                case 'info':
                    background = settings.backgroundInfo;
                    break;
                case 'success':
                    background = settings.backgroundSuccess;
                    break;
                case 'warning':
                    background = settings.backgroundWarning;
                    break;
                case 'danger':
                    background = settings.backgroundDanger;
                    break;
                case 'question':
                    background = settings.backgroundQuestion;
                    break;
            }
            return background;
        }

        function colorBody(){
            var color = '';
            switch (settings.type) {
                default:
                    color = settings.colorDefault;
                    break;
                case 'info':
                    color = settings.colorInfo;
                    break;
                case 'success':
                    color = settings.colorSuccess;
                    break;
                case 'warning':
                    color = settings.colorWarning;
                    break;
                case 'danger':
                    color = settings.colorDanger;
                    break;
                case 'question':
                    color = settings.colorQuestion;
                    break;
            }
            return color;
        }

        function _content(){
            var modal = '';
            var header = _header();
            var body = _body();
            var footer = _footer();

            modal = '<div class="modal fade" id="'+ id +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">'
                  + '<div class="modal-dialog" role="document">'
                  + '<div class="modal-content">'
                  + header + body + footer
                  + '</div></div></div>';

            return modal;
        }

        function _close(){
            var close = '';

            if(settings.showBtnClose){
                close = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="'+ settings.iconClose +'"></span></button>'
            }

            return close;
        }

        function _header(){
            var icon_message = iconType();
            var background = backgroundHeader();
            var button_close = _close();
            var header = '';

            
            header = '<div class="modal-header '+ background + settings.classHeader + '">'
                       + button_close
                       + '<h4 class="modal-title '+ settings.classTitle +'">'
                       + icon_message
                       + ' '
                       + '<span class="">'
                       + settings.title
                       + '</h4></div>';
            
            if(settings.title == ''){
                header = '';
            }

            return header;
        }

        function _body(){
            var body = '';
            var color = colorBody();
            var button_close = '';

            if(settings.title == ''){
                button_close = _close();
            }

            body = '<div class="modal-body '+ settings.classBody +'">'
                 + button_close
                 + '<label class="control-label '+ color + settings.classMessage +'">'+ settings.message +'</label>'
                 + '</div>';

            return body;
        }

        function _footer(){
            var footer = '';
            var buttons = '';

            if(settings.showFooter){
                footer = '<div class="modal-footer '+ settings.classFooter +'">'
                     + buttons
                     + '</div>';    
            }

            return footer;
        }
        
        if (settings.show){
            _contruct();    
        }else{
            _destroy();
        }

        if (settings.timeout != 0) {
            setInterval(function () {
                 _destroy();
            }, settings.timeout);
        }
    }
}) (jQuery);