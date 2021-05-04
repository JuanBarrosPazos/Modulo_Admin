
# MÓDULO CRUD DE ADMINISTRADORES Y USUARIOS.
# Admin_Modulo_V08_Con_password_hash

## DESCRIPCION GENERAL:
- Creación de las tablas necesarias en la bbdd
- CRUD de usuarios y administradores
- Baja de usuarios activos y almacenamiento en Feedbak Admin.
- Recuperación de usuarios desde Feedback Admin
- Eliminación de usuarios y datos desde Feedback Admin
- Log de sistema y de actividad de los usuarios individuales.
---
---
## 2021/05/04

### Admin_Modulo_V07_Ok_Sin_password_hash.zip

### Admin_Modulo_V08_Con_password_hash.zip
- Se modifica la tabla de usuarios en relación la la version anterior Password varchar 100.
- Se aplica password_hash() al Password del usuario.
- Se modifica el sistema de validación de Password del usuario para adaptarlo a password_verify()

---

