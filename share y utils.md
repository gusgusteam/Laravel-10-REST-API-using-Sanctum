# estrcutura de carpeta por modulos dentro del ModuloVenta
│── components/
│   │── gestion-list/
│   │   ├── gestion-list.component.ts
│   │   ├── gestion-list.component.html
│   │   ├── gestion-list.component.css
│   │
│   │── gestion-form/
│   │   ├── gestion-form.component.ts
│   │   ├── gestion-form.component.html
│   │   ├── gestion-form.component.css
│
│── services/
│   ├── gestion.service.ts
│
│── models/
│   ├── gestion.ts
│
│── gestion.module.ts
│── gestion-routing.module.ts
# estructura 


# crud Venta
ng g module pages/ModuloVenta/gestion --routing
ng g service pages/ModuloVenta/gestion/services/gestion
ng g component pages/ModuloVenta/gestion/components/gestion-list
ng g component pages/ModuloVenta/gestion/components/gestion-form
ng g service pages/ModuloVenta/gestion/services/gestion

ng g s shared/utils/cliente-utils