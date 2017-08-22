var PMA_messages = new Array();
PMA_messages['strNoDropDatabases'] = "Las sentencias \"DROP DATABASE\" están desactivadas.";
PMA_messages['strConfirm'] = "Confirmar";
PMA_messages['strDoYouReally'] = "¿Realmente desea ejecutar \"%s\"?";
PMA_messages['strDropDatabaseStrongWarning'] = "¡Está a punto de DESTRUIR una base de datos completa!";
PMA_messages['strDropTableStrongWarning'] = "¡Está a punto de DESTRUIR una tabla completa!";
PMA_messages['strTruncateTableStrongWarning'] = "¡Está a punto de TRUNCAR una tabla completa!";
PMA_messages['strDeleteTrackingData'] = "Borrar los datos de seguimiento para esta tabla";
PMA_messages['strDeletingTrackingData'] = "Borrando los datos de seguimiento";
PMA_messages['strDroppingPrimaryKeyIndex'] = "Borrando Claves Primarias/Índice";
PMA_messages['strOperationTakesLongTime'] = "Esta operación podría llevar algún tiempo. ¿Proceder de todas formas?";
PMA_messages['strDropUserGroupWarning'] = "¿Realmente desea eliminar el grupo de usuarios \"%s\"?";
PMA_messages['strFormEmpty'] = "¡Falta un valor en el formulario!";
PMA_messages['strEnterValidNumber'] = "Introduzca un número válido";
PMA_messages['strEnterValidLength'] = "Introduzca una longitud válida";
PMA_messages['strAddIndex'] = "Agregar índice";
PMA_messages['strEditIndex'] = "Editar índice";
PMA_messages['strAddToIndex'] = "Agregar %s columna(s) al índice";
PMA_messages['strYValues'] = "Valores Y";
PMA_messages['strHostEmpty'] = "¡El nombre del servidor está vacío!";
PMA_messages['strUserEmpty'] = "¡El nombre de usuario está vacío!";
PMA_messages['strPasswordEmpty'] = "¡La contraseña está vacía!";
PMA_messages['strPasswordNotSame'] = "¡Las contraseñas no coinciden!";
PMA_messages['strAddUser'] = "Agregar usuario";
PMA_messages['strReloadingPrivileges'] = "Recargando Privilegios";
PMA_messages['strRemovingSelectedUsers'] = "Eliminando los usuarios seleccionados";
PMA_messages['strClose'] = "Cerrar";
PMA_messages['strOther'] = "Otro";
PMA_messages['strThousandsSeparator'] = ",";
PMA_messages['strDecimalSeparator'] = ".";
PMA_messages['strChartConnectionsTitle'] = "Conexiones / Procesos";
PMA_messages['strIncompatibleMonitorConfig'] = "Configuración local de monitorización incompatible";
PMA_messages['strIncompatibleMonitorConfigDescription'] = "La configuración de distribución de gráficos en el almacenamiento local del navegador no es compatible con la nueva versión del sistema de monitorización. Es probable que la configuración no funcione. Reinicie la configuración a la predeterminada en el menú <i>Configuración</i>.";
PMA_messages['strQueryCacheEfficiency'] = "Eficiencia del caché de consultas";
PMA_messages['strQueryCacheUsage'] = "Uso del caché de consultas";
PMA_messages['strQueryCacheUsed'] = "Caché de consultas utilizado";
PMA_messages['strSystemCPUUsage'] = "Uso de CPU del sistema";
PMA_messages['strSystemMemory'] = "Memoria de sistema";
PMA_messages['strSystemSwap'] = "Intercambio de sistema";
PMA_messages['strAverageLoad'] = "Carga promedio";
PMA_messages['strTotalMemory'] = "Memoria total";
PMA_messages['strCachedMemory'] = "Memoria caché";
PMA_messages['strBufferedMemory'] = "Memoria de búfers";
PMA_messages['strFreeMemory'] = "Memoria libre";
PMA_messages['strUsedMemory'] = "Memoria utilizada";
PMA_messages['strTotalSwap'] = "Intercambio total";
PMA_messages['strCachedSwap'] = "Intercambio en caché";
PMA_messages['strUsedSwap'] = "Intercambio utilizado";
PMA_messages['strFreeSwap'] = "Intercambio libre";
PMA_messages['strBytesSent'] = "Bytes enviados";
PMA_messages['strBytesReceived'] = "Bytes recibidos";
PMA_messages['strConnections'] = "Conexiones";
PMA_messages['strProcesses'] = "Procesos";
PMA_messages['strB'] = "B";
PMA_messages['strKiB'] = "KB";
PMA_messages['strMiB'] = "MB";
PMA_messages['strGiB'] = "GB";
PMA_messages['strTiB'] = "TB";
PMA_messages['strPiB'] = "PB";
PMA_messages['strEiB'] = "EB";
PMA_messages['strTables'] = "%d tabla(s)";
PMA_messages['strQuestions'] = "Preguntas";
PMA_messages['strTraffic'] = "Tráfico";
PMA_messages['strSettings'] = "Configuración";
PMA_messages['strRemoveChart'] = "Eliminar gráfico";
PMA_messages['strEditChart'] = "Editar título y etiquetas";
PMA_messages['strAddChart'] = "Agregar gráfico a la grilla";
PMA_messages['strAddOneSeriesWarning'] = "Agregue al menos una variable a la serie";
PMA_messages['strNone'] = "Ninguna";
PMA_messages['strResumeMonitor'] = "Reanudar monitorización";
PMA_messages['strPauseMonitor'] = "Pausar monitorización";
PMA_messages['strBothLogOn'] = "«general_log» y «slow_query_log» activos.";
PMA_messages['strGenLogOn'] = "«general_log» activo.";
PMA_messages['strSlowLogOn'] = "«slow_query_log» activo.";
PMA_messages['strBothLogOff'] = "«slow_query_log» y «general_log» desactivados.";
PMA_messages['strLogOutNotTable'] = "«log_output» no está definido como TABLE.";
PMA_messages['strLogOutIsTable'] = "«log_output» está definido como TABLE.";
PMA_messages['strSmallerLongQueryTimeAdvice'] = "«slow_query_log» activo, pero el servidor sólo registra consultas que tardan más de %d segundos. Es recomendable configurar «long_query_time» entre 0 y 2 segundos dependiendo del equipo.";
PMA_messages['strLongQueryTimeSet'] = "«long_query_time» está configurado a %d segundo(s).";
PMA_messages['strSettingsAppliedGlobal'] = "Las siguientes configuraciones serán aplicadas globalmente y volverán a sus valores predeterminados al reiniciar el servidor:";
PMA_messages['strSetLogOutput'] = "Configurar «log_output» a %s";
PMA_messages['strEnableVar'] = "Habilitar %s";
PMA_messages['strDisableVar'] = "Deshabilitar %s";
PMA_messages['setSetLongQueryTime'] = "Definir «long_query_time» a %ds";
PMA_messages['strNoSuperUser'] = "No posee permisos para cambiar estas variables. Inicie sesión con la cuenta root o contacte a su administrador de base de datos.";
PMA_messages['strChangeSettings'] = "Cambiar configuraciones";
PMA_messages['strCurrentSettings'] = "Configuraciones actuales";
PMA_messages['strChartTitle'] = "Título del gráfico";
PMA_messages['strDifferential'] = "Diferencial";
PMA_messages['strDividedBy'] = "Dividido por %s";
PMA_messages['strUnit'] = "Unidad";
PMA_messages['strFromSlowLog'] = "Del registro de consultas lentas";
PMA_messages['strFromGeneralLog'] = "Del registro general";
PMA_messages['strServerLogError'] = "Se desconoce el nombre de la base de datos para esta consulta en los registros del servidor.";
PMA_messages['strAnalysingLogsTitle'] = "Analizando registros";
PMA_messages['strAnalysingLogs'] = "Analizando y cargando registros. Esto puede demorar.";
PMA_messages['strCancelRequest'] = "Cancelar petición";
PMA_messages['strCountColumnExplanation'] = "Esta columna muestra la cantidad de consultas idénticas que fueron agrupadas. Sin embargo, sólo la consulta SQL en sí es es utilizada para agrupar, por lo que los demás atributos de las consultas como el tiempo de inicio podría diferir.";
PMA_messages['strMoreCountColumnExplanation'] = "Dado que se eligió agrupar consultas INSERT, las consultas INSERT a la misma tabla también fueron agrupadas sin importar los datos agregados.";
PMA_messages['strLogDataLoaded'] = "Los datos del registros fueron cargados. Consultas ejecutadas en este período de tiempo:";
PMA_messages['strJumpToTable'] = "Saltar a la tabla de registros";
PMA_messages['strNoDataFoundTitle'] = "No se encontraron datos";
PMA_messages['strNoDataFound'] = "Registros analizados, pero no se encontraron datos en este período de tiempo.";
PMA_messages['strAnalyzing'] = "Analizando…";
PMA_messages['strExplainOutput'] = "Explicar salida";
PMA_messages['strStatus'] = "Estado actual";
PMA_messages['strTime'] = "Tiempo";
PMA_messages['strTotalTime'] = "Tiempo total:";
PMA_messages['strProfilingResults'] = "Perfilando resultados";
PMA_messages['strTable'] = "Tabla";
PMA_messages['strChart'] = "Gráfico";
PMA_messages['strChartEdit'] = "Editar gráfico";
PMA_messages['strSeries'] = "Series";
PMA_messages['strFiltersForLogTable'] = "Opciones de filtros para tablas de registros";
PMA_messages['strFilter'] = "Filtrar";
PMA_messages['strFilterByWordRegexp'] = "Filtrar consultas por palabra/expresión regular:";
PMA_messages['strIgnoreWhereAndGroup'] = "Agrupar consultas ignorando datos variables en sentencias WHERE";
PMA_messages['strSumRows'] = "Suma de filas agrupadas:";
PMA_messages['strTotal'] = "Total:";
PMA_messages['strLoadingLogs'] = "Cargando registros";
PMA_messages['strRefreshFailed'] = "Falló la actualización del monitorizador";
PMA_messages['strInvalidResponseExplanation'] = "Al pedir un nuevo gráfico el servidor devolvió una respuesta inválida. Esto es probablemente porque expiró la sesión. Cargar la página nuevamente y volver a introducir sus credenciales debería ayudar.";
PMA_messages['strReloadPage'] = "Cargar página nuevamente";
PMA_messages['strAffectedRows'] = "Filas afectadas:";
PMA_messages['strFailedParsingConfig'] = "No se pudo analizar el archivo de configuración. No parece ser código JSON válido.";
PMA_messages['strFailedBuildingGrid'] = "No se pudo crear la grilla de gráficos con la configuración importada. Reiniciando a configuración predeterminada…";
PMA_messages['strImport'] = "Importar";
PMA_messages['strImportDialogTitle'] = "Importar configuración";
PMA_messages['strImportDialogMessage'] = "Seleccione el archivo que desea importar";
PMA_messages['strAnalyzeQuery'] = "Analizar consulta";
PMA_messages['strAdvisorSystem'] = "Sistema de consejos";
PMA_messages['strPerformanceIssues'] = "Posibles problemas de performance";
PMA_messages['strIssuse'] = "Problema";
PMA_messages['strRecommendation'] = "Recomendación";
PMA_messages['strRuleDetails'] = "Detalles de la regla";
PMA_messages['strJustification'] = "Justificación";
PMA_messages['strFormula'] = "Variable/fórmula utilizada";
PMA_messages['strTest'] = "Prueba";
PMA_messages['strGo'] = "Continuar";
PMA_messages['strCancel'] = "Cancelar";
PMA_messages['strLoading'] = "Cargando…";
PMA_messages['strAbortedRequest'] = "¡Pedido cancelado!";
PMA_messages['strProcessingRequest'] = "Procesando Petición";
PMA_messages['strErrorProcessingRequest'] = "Error al Procesar la Petición";
PMA_messages['strErrorCode'] = "Código de error: %s";
PMA_messages['strErrorText'] = "Texto de error: %s";
PMA_messages['strNoDatabasesSelected'] = "No se seleccionaron bases de datos.";
PMA_messages['strDroppingColumn'] = "Eliminando Columna";
PMA_messages['strAddingPrimaryKey'] = "Añadiendo Clave Primaria";
PMA_messages['strOK'] = "OK";
PMA_messages['strDismiss'] = "Pulse para descartar esta notificación";
PMA_messages['strRenamingDatabases'] = "Renombrando Bases de Datos";
PMA_messages['strReloadDatabase'] = "Recargar Base de Datos";
PMA_messages['strCopyingDatabase'] = "Copiando Base de Datos";
PMA_messages['strChangingCharset'] = "Cambiando el Juego de caracteres";
PMA_messages['strTableMustHaveAtleastOneColumn'] = "La tabla debe tener al menos una columna";
PMA_messages['strYes'] = "Sí";
PMA_messages['strNo'] = "No";
PMA_messages['strInsertTable'] = "Insertar tablas";
PMA_messages['strHideIndexes'] = "Esconder índices";
PMA_messages['strShowIndexes'] = "Mostrar índices";
PMA_messages['strForeignKeyCheck'] = "Revisión de claves foráneas:";
PMA_messages['strForeignKeyCheckEnabled'] = "(Habilitado)";
PMA_messages['strForeignKeyCheckDisabled'] = "(Deshabilitado)";
PMA_messages['strSearching'] = "Buscando";
PMA_messages['strHideSearchResults'] = "Ocultar resultados de búsqueda";
PMA_messages['strShowSearchResults'] = "Mostrar resultados de búsqueda";
PMA_messages['strBrowsing'] = "Examinando";
PMA_messages['strDeleting'] = "Borrando";
PMA_messages['MissingReturn'] = "¡La definición de una función almacenada debe contener una sentencia RETURN!";
PMA_messages['enum_editor'] = "Editor de ENUM/SET";
PMA_messages['enum_columnVals'] = "Valores para la columna %s";
PMA_messages['enum_newColumnVals'] = "Valores para una nueva columna";
PMA_messages['enum_hint'] = "Introduzca cada valor en un campo separado";
PMA_messages['enum_addValue'] = "Agregar %d valor(es)";
PMA_messages['strImportCSV'] = "Nota: si la fila contiene múltiples tablas, van a ser combinadas en una.";
PMA_messages['strHideQueryBox'] = "Ocultar ventana de consultas SQL";
PMA_messages['strShowQueryBox'] = "Mostrar ventana de consultas SQL";
PMA_messages['strEdit'] = "Editar";
PMA_messages['strNoRowSelected'] = "No se seleccionaron filas";
PMA_messages['strChangeTbl'] = "Cambiar";
PMA_messages['strQueryExecutionTime'] = "Tiempo de ejecución de la consulta";
PMA_messages['strNotValidRowNumber'] = "%d no es un número de fila válido.";
PMA_messages['strSave'] = "Guardar";
PMA_messages['strHideSearchCriteria'] = "Ocultar criterio de búsqueda";
PMA_messages['strShowSearchCriteria'] = "Mostrar criterio de búsqueda";
PMA_messages['strHideFindNReplaceCriteria'] = "Ocultar criterio de búsqueda y reemplazo";
PMA_messages['strShowFindNReplaceCriteria'] = "Mostrar criterio de búsqueda y reemplazo";
PMA_messages['strZoomSearch'] = "Búsqueda gráfica";
PMA_messages['strDisplayHelp'] = "<ul><li>Cada punto representa una fila de datos.</li><li>Ubicar el cursor sobre un punto mostrará su etiqueta.</li><li>Para ampliar, seleccione el gráfico.</li><li>Pulse el botón de restaurar ampliación para volver al estado original.</li><li>Pulse en un punto de datos para ver y posiblemente editar la fila de datos.</li><li>El gráfico puede redimensionarse arrastrando la esquina inferior derecha.</li></ul>";
PMA_messages['strInputNull'] = "<strong>Seleccionar dos columnas</strong>";
PMA_messages['strSameInputs'] = "<strong>Seleccionar dos columnas distintas</strong>";
PMA_messages['strQueryResults'] = "Resultados de la consulta";
PMA_messages['strDataPointContent'] = "Contenido del punto de datos";
PMA_messages['strIgnore'] = "Ignorar";
PMA_messages['strCopy'] = "Copiar";
PMA_messages['strX'] = "X";
PMA_messages['strY'] = "Y";
PMA_messages['strPoint'] = "Punto";
PMA_messages['strPointN'] = "Punto %d";
PMA_messages['strLineString'] = "Cadena de líneas";
PMA_messages['strPolygon'] = "Polígono";
PMA_messages['strGeometry'] = "Geometría";
PMA_messages['strInnerRing'] = "Círculo interior";
PMA_messages['strOuterRing'] = "Círculo exterior";
PMA_messages['strAddPoint'] = "Agregar un punto";
PMA_messages['strAddInnerRing'] = "Agregar un círculo interior";
PMA_messages['strAddPolygon'] = "Agregar un polígono";
PMA_messages['strAddColumns'] = "Agregar columnas";
PMA_messages['strSelectReferencedKey'] = "Seleccione la clave referenciada";
PMA_messages['strSelectForeignKey'] = "Seleccione la clave foránea";
PMA_messages['strPleaseSelectPrimaryOrUniqueKey'] = "Seleccione la clave primaria o una clave única";
PMA_messages['strChangeDisplay'] = "Elegir la columna a mostrar";
PMA_messages['strLeavingDesigner'] = "No se guardaron los cambios en la disposición. Serán perdidos si no los guardas. ¿Deseas continuar?";
PMA_messages['strAddOption'] = "Añadir una opción para la columna ";
PMA_messages['strObjectsCreated'] = "%d objeto(s) creado(s)";
PMA_messages['strCellEditHint'] = "Presion la tecla de escape para cancelar la edición";
PMA_messages['strSaveCellWarning'] = "Editó datos que no fueron guardados. ¿Está seguro que desea abandonar esta página sin guardar los datos?";
PMA_messages['strColOrderHint'] = "Arrastrar para reordenar";
PMA_messages['strSortHint'] = "Pulsar para ordenar";
PMA_messages['strColMarkHint'] = "Pulsar para marcar/desmarcar";
PMA_messages['strColNameCopyHint'] = "Haga doble click para copiar el nombre de la columna";
PMA_messages['strColVisibHint'] = "Pulsa la flecha de la lista desplegable <br />para conmutar la visibilidad de la columna";
PMA_messages['strShowAllCol'] = "Mostrar todo";
PMA_messages['strAlertNonUnique'] = "Esta tabla no contiene una columna única. Funcionalidades relacionadas con la edición de la grilla y los enlaces de copiado, eliminación y edición pueden no funcionar luego de guardar.";
PMA_messages['strGridEditFeatureHint'] = "También puede editar la mayoría de los valores<br />con un pulsado doble directamente en su contenido.";
PMA_messages['strGoToLink'] = "Ir al enlace";
PMA_messages['strColNameCopyTitle'] = "Copie el nombre de la columna";
PMA_messages['strColNameCopyText'] = "Haga click con el botón derecho sobre la columna para copiarla en el portapapeles.";
PMA_messages['strShowDataRowLink'] = "Mastrar fila(s) de datos";
PMA_messages['strGeneratePassword'] = "Generar contraseña";
PMA_messages['strGenerate'] = "Generar";
PMA_messages['strChangePassword'] = "Cambar contraseña";
PMA_messages['strMore'] = "Más";
PMA_messages['strShowPanel'] = "Mostrar panel";
PMA_messages['strHidePanel'] = "Esconder panel";
PMA_messages['strUnhideNavItem'] = "Mostrar los elementos escondidos del árbol de navegación";
PMA_messages['strInvalidPage'] = "La página solicitada no se encontró en el historial, puede haber expirado.";
PMA_messages['strNewerVersion'] = "Una versión más reciente de phpMyAdmin está disponible y le recomendamos que la obtenga. La versión más reciente es %s, y existe desde el %s.";
PMA_messages['strLatestAvailable'] = ", versión estable más reciente:";
PMA_messages['strUpToDate'] = "actualizada";
PMA_messages['strCreateView'] = "Crear vista";
PMA_messages['strSendErrorReport'] = "Enviar reporte de error";
PMA_messages['strSubmitErrorReport'] = "Enviar reporte de error";
PMA_messages['strErrorOccurred'] = "Ocurrió un error fatal en JavaScript. ¿Desearía enviar un reporte de error?";
PMA_messages['strChangeReportSettings'] = "Cambiar configuraciones del reporte";
PMA_messages['strShowReportDetails'] = "Mostrar detalles del reporte";
PMA_messages['strTimeOutError'] = "La exportación está incompleta debido a un límite en el tiempo de ejecución demasiado bajo a nivel de PHP";
var themeCalendarImage = './themes/pmahomme/img/b_calendar.png';
var pmaThemeImage = './themes/pmahomme/img/';
var pmaversion = '4.1.14';
var mysql_doc_template = './url.php?url=http%3A%2F%2Fdev.mysql.com%2Fdoc%2Frefman%2F5.5%2Fen%2F%25s.html&amp;server=0&amp;token=6315f81a5257459be48ee5a0a4c0006b';
if ($.datepicker) {
$.datepicker.regional['']['closeText'] = "Terminado";
$.datepicker.regional['']['prevText'] = "Anterior";
$.datepicker.regional['']['nextText'] = "Siguiente";
$.datepicker.regional['']['currentText'] = "Hoy";
$.datepicker.regional['']['monthNames'] = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre",];
$.datepicker.regional['']['monthNamesShort'] = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic",];
$.datepicker.regional['']['dayNames'] = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado",];
$.datepicker.regional['']['dayNamesShort'] = ["Dom","Lun","Mar","Mie","Jue","Vie","Sab",];
$.datepicker.regional['']['dayNamesMin'] = ["Do","Lu","Ma","Mi","Ju","Vi","Sa",];
$.datepicker.regional['']['weekHeader'] = "Sem";
$.datepicker.regional['']['showMonthAfterYear'] = true;
$.datepicker.regional['']['yearSuffix'] = "";
$.extend($.datepicker._defaults, $.datepicker.regional['']);
} /* if ($.datepicker) */

if ($.timepicker) {
$.timepicker.regional['']['timeText'] = "Tiempo";
$.timepicker.regional['']['hourText'] = "Hora";
$.timepicker.regional['']['minuteText'] = "Minuto";
$.timepicker.regional['']['secondText'] = "Segundo";
$.extend($.timepicker._defaults, $.timepicker.regional['']);
} /* if ($.timepicker) */
