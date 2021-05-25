
# MÓDULO CRUD DE ADMINISTRADORES Y USUARIOS.
# Admin_Modulo_V23

## DESCRIPCION GENERAL:
- Creación automática de las tablas necesarias en la bbdd
- CRUD de usuarios y administradores.
- Baja de usuarios activos y almacenamiento en Feedbak Admin.
- Recuperación de usuarios desde Feedback Admin a Admin.
- Eliminación de usuarios y datos desde Feedback Admin.
- Log de sistema y de actividad de los usuarios individuales.
- 
- Integro la función de copia de seguridad automática después de suma_visit(); en index_Play_System.php que pasa a ser index.php en el momento de la instalación. (dias 6, 12, 18, 24, 30. si se inicia sesión.)
- 
- Exportación de bbdd completa.
- Exportación y eliminación de log de usuarios.
- 
- Generador de qr code usuarios.
- Lector de qr code de usuarios.
- 
# IMPORTANTE:
- Las modificaciones en el archivo config/index_Play_System.php se han de reflejar en index.php.
- Borramos o renombramos index.php en el directorio raiz.
- Copiamos config/index_Play_System.php en el directorio raiz y le cambiamos el nombre por index.php
---
---
## 2021/05/25
### Admin_Modulo_V23.zip
- Ajustes generales de código.
---
---
## 2021/05/23
### Admin_Modulo_V21_Ok_Botones_Paginacion_&_Hash.zip
- Ajustes generales en qrgen, qrcam.
---
---
## 2021/05/22
### Admin_Modulo_V20_Ok_Botones_Paginacion_&_Hash.zip
- Nuevas integraciones bbdd & log, qrgen, qrcam.
- Ajustes generales de código.
---
---
## 2021/05/21
### Admin_Modulo_V19_Ok_Botones_Paginacion_&_Hash.zip
- Configuración del menu usuario.
- Ajustes generales de código.
---
---
## 2021/05/10
### Admin_Modulo_V12_Ok_Paginacion_&_Hash.zip
- Configuración de la paginacion en Admin y Feedback.
- Ajustes generales de código.
---
---
## 2021/05/09
### Admin_Modulo_V11_Paginacion_&_Hash.zip
- Configuración de la paginacion en Admin y Feedback.
- Ajustes generales de código.
---
---
## 2021/05/06
### Admin_Modulo_V10_Paginacion_&_Hash.zip
- Configuración inicial de l apaginación en consultas.
- Modificación del inicio al abrir sesión.
---
---
## 2021/05/05
### Admin_Modulo_V09_Con_password_hash.zip
- Ajustes generales de codigo para gestión de administradores y log de actividad.
---
---
## 2021/05/04
### Admin_Modulo_V07_Ok_Sin_password_hash.zip
### Admin_Modulo_V08_Con_password_hash.zip
- Se modifica la tabla de usuarios en relación la la version anterior Password varchar 100.
- Se aplica password_hash() al Password del usuario.
- Se modifica el sistema de validación de Password del usuario para adaptarlo a password_verify()
- Se modifican la variables superglobales.
---
---

