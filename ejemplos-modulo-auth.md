# estrcutura de carpeta por modulos dentro del ModuloAuth
│── components/
│   │── auth-login/
│   │   ├── auth-login.component.ts
│   │   ├── auth-login.component.html
│   │   ├── auth-login.component.css
│
│── services/
│   ├── auth.service.ts
│
# │── models/
# │   ├── auth.ts
# │
│── auth.module.ts
│── auth-routing.module.ts
# estructura 


# crud auth
ng g module pages/ModuloAuth/auth --routing
ng g service pages/ModuloAuth/auth/services/auth
ng g component pages/ModuloAuth/auth/components/auth-login
ng g component pages/ModuloAuth/auth/components/auth-profile
ng g component pages/ModuloAuth/auth/components/auth-update-profile
ng g component pages/ModuloAuth/auth/components/auth-update-password
ng g service pages/ModuloAuth/auth/services/auth

