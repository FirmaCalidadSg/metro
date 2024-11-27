# Casos de Uso - SICATEAM

## 1. Gestión de Usuarios y Accesos

### CU-01: Iniciar Sesión
- **Actor Principal:** Usuario del Sistema
- **Precondiciones:** Usuario registrado en el sistema
- **Flujo Principal:**
  1. Usuario accede a la página de inicio
  2. Sistema muestra formulario de login
  3. Usuario ingresa credenciales
  4. Sistema valida credenciales
  5. Sistema permite acceso y muestra menú principal
- **Flujos Alternativos:**
  - Credenciales inválidas: Sistema muestra mensaje de error
  - Cuenta bloqueada: Sistema notifica al usuario

### CU-02: Gestionar Perfiles
- **Actor Principal:** Administrador
- **Precondiciones:** Usuario autenticado con permisos de administrador
- **Flujo Principal:**
  1. Administrador accede a "Profile" en menú Administración
  2. Sistema muestra lista de perfiles
  3. Administrador puede crear/modificar/eliminar perfiles
  4. Sistema actualiza cambios en tiempo real
- **Flujos Alternativos:**
  - Perfil en uso: Sistema impide eliminación

## 2. Gestión de Plantas

### CU-03: Registrar Nueva Planta
- **Actor Principal:** Supervisor de Plantas
- **Precondiciones:** Usuario autenticado con permisos de supervisor
- **Flujo Principal:**
  1. Supervisor selecciona "Planta" en menú Administración
  2. Sistema muestra formulario de registro
  3. Supervisor ingresa datos de la planta:
     - Nombre y ubicación
     - Capacidad instalada
     - Equipos asociados
  4. Sistema valida y guarda información
- **Flujos Alternativos:**
  - Datos incompletos: Sistema solicita información faltante
  - Planta duplicada: Sistema notifica error

### CU-04: Monitorear Capacidad de Planta
- **Actor Principal:** Supervisor de Producción
- **Precondiciones:** Planta registrada en el sistema
- **Flujo Principal:**
  1. Supervisor accede a dashboard de capacidades
  2. Sistema muestra en tiempo real:
     - Capacidad utilizada vs instalada
     - Estado de equipos
     - Indicadores de eficiencia
  3. Sistema actualiza datos automáticamente
- **Flujos Alternativos:**
  - Falla de conexión: Sistema muestra última actualización disponible

## 3. Gestión de Equipos

### CU-05: Registrar Falla de Equipo
- **Actor Principal:** Operador de Equipo
- **Precondiciones:** Equipo registrado en sistema
- **Flujo Principal:**
  1. Operador selecciona "Daños de Equipos"
  2. Sistema muestra formulario de registro
  3. Operador ingresa:
     - Tipo de falla
     - Descripción
     - Tiempo de inicio
  4. Sistema registra falla y genera alerta
- **Flujos Alternativos:**
  - Falla crítica: Sistema notifica a supervisores inmediatamente

### CU-06: Monitorear Estado de Equipos
- **Actor Principal:** Supervisor de Mantenimiento
- **Precondiciones:** Equipos conectados al sistema
- **Flujo Principal:**
  1. Supervisor accede a monitor de equipos
  2. Sistema muestra:
     - Estado actual de cada equipo
     - Historial de fallas
     - Tiempo de operación
  3. Sistema actualiza información en tiempo real
- **Flujos Alternativos:**
  - Equipo desconectado: Sistema marca estado como "Sin conexión"

## 4. Gestión de Producción

### CU-07: Registrar Producción por Turno
- **Actor Principal:** Supervisor de Turno
- **Precondiciones:** Turno activo
- **Flujo Principal:**
  1. Supervisor accede a registro de producción
  2. Sistema muestra formulario de registro
  3. Supervisor ingresa:
     - Cantidad producida
     - Piezas conformes/no conformes
     - Tiempo efectivo de producción
  4. Sistema calcula indicadores automáticamente
- **Flujos Alternativos:**
  - Error en datos: Sistema solicita verificación

### CU-08: Gestionar Paros de Producción
- **Actor Principal:** Supervisor de Producción
- **Precondiciones:** Línea de producción activa
- **Flujo Principal:**
  1. Supervisor registra paro en sistema
  2. Sistema solicita:
     - Tipo de paro
     - Causa
     - Duración estimada
  3. Sistema actualiza estado de línea
  4. Sistema calcula impacto en producción
- **Flujos Alternativos:**
  - Paro no planificado: Sistema genera alerta de emergencia

## 5. Reportes y Análisis

### CU-09: Generar Reportes de Eficiencia
- **Actor Principal:** Gerente de Producción
- **Precondiciones:** Datos de producción disponibles
- **Flujo Principal:**
  1. Gerente accede a módulo de reportes
  2. Selecciona tipo de reporte:
     - Eficiencia por turno
     - TEEP
     - MTTR
  3. Sistema genera reporte con gráficos
  4. Sistema permite exportar datos
- **Flujos Alternativos:**
  - Sin datos: Sistema muestra mensaje informativo

### CU-10: Analizar Causas de Pérdidas
- **Actor Principal:** Analista de Producción
- **Precondiciones:** Registro de paros y fallas disponible
- **Flujo Principal:**
  1. Analista accede a análisis de pérdidas
  2. Sistema muestra:
     - Pareto de causas
     - Tendencias
     - Impacto en producción
  3. Sistema permite filtrar por período
- **Flujos Alternativos:**
  - Período sin datos: Sistema sugiere ajustar filtros

## 6. Configuración del Sistema

### CU-11: Gestionar Catálogos
- **Actor Principal:** Administrador del Sistema
- **Precondiciones:** Usuario con permisos administrativos
- **Flujo Principal:**
  1. Administrador accede a catálogos:
     - Países
     - Ciudades
     - Productos
     - Líneas
  2. Sistema permite CRUD de registros
  3. Sistema valida relaciones entre catálogos
- **Flujos Alternativos:**
  - Error de relación: Sistema muestra dependencias

### CU-12: Configurar Parámetros del Sistema
- **Actor Principal:** Administrador del Sistema
- **Precondiciones:** Acceso administrativo
- **Flujo Principal:**
  1. Administrador accede a configuraciones
  2. Sistema muestra parámetros:
     - Intervalos de backup
     - Umbrales de alertas
     - Configuración de correos
  3. Sistema aplica cambios en tiempo real
- **Flujos Alternativos:**
  - Error de configuración: Sistema mantiene valores anteriores