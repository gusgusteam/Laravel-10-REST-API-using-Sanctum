# estrcutura de carpeta por modulos dentro del ModuloAdministracion
│── components/
│   │── users-list/
│   │   ├── users-list.component.ts
│   │   ├── users-list.component.html
│   │   ├── users-list.component.css
│   │
│   │── users-form/
│   │   ├── users-form.component.ts
│   │   ├── users-form.component.html
│   │   ├── users-form.component.css
│
│── services/
│   ├── users.service.ts
│
│── models/
│   ├── users.ts
│
│── users.module.ts
│── users-routing.module.ts
# estructura 


# crud user
ng g module pages/ModuloAdministracion/users --routing
ng g service pages/ModuloAdministracion/users/services/users
ng g component pages/ModuloAdministracion/users/components/users-list
ng g component pages/ModuloAdministracion/users/components/users-form
ng g service pages/ModuloAdministracion/users/services/users

# crud permiso
ng g module pages/ModuloAdministracion/permiso --routing
ng g service pages/ModuloAdministracion/permiso/services/permiso
ng g component pages/ModuloAdministracion/permiso/components/permiso-list
ng g component pages/ModuloAdministracion/permiso/components/permiso-form
ng g service pages/ModuloAdministracion/permiso/services/permiso

# crud rol
ng g module pages/ModuloAdministracion/rol --routing
ng g service pages/ModuloAdministracion/rol/services/rol
ng g component pages/ModuloAdministracion/rol/components/rol-list
ng g component pages/ModuloAdministracion/rol/components/rol-form
ng g service pages/ModuloAdministracion/rol/services/rol

# crud admin
ng g module pages/ModuloAdministracion/admin --routing
ng g service pages/ModuloAdministracion/admin/services/admin
ng g component pages/ModuloAdministracion/admin/components/admin-grupo
ng g component pages/ModuloAdministracion/admin/components/admin-form
ng g service pages/ModuloAdministracion/admin/services/admin

# crud configuracion
ng g module pages/ModuloAdministracion/configuracion --routing
ng g service pages/ModuloAdministracion/configuracion/services/configuracion
ng g component pages/ModuloAdministracion/configuracion/components/configuracion-form
ng g service pages/ModuloAdministracion/configuracion/services/configuracion

