# estrcutura de carpeta por modulos dentro del SeccionDashboard
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
ng g module pages/SeccionDashboard/Dashboard --routing
ng g service pages/SeccionDashboard/Dashboard/services/dashboard

ng g component pages/SeccionDashboard/Dashboard/components/dashboard-principal
ng g component pages/SeccionDashboard/Dashboard/components/dashboard-stats-whidget

ng g component pages/SeccionDashboard/Dashboard/components/dashboard-stock-producto-whidget
ng g component pages/SeccionDashboard/Dashboard/components/dashboard-notificacion-notas-whidget


