# estrcutura de carpeta por modulos dentro del ModuloInventario
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


# crud Inventario
ng g module pages/ModuloInventario/inventario --routing
ng g service pages/ModuloInventario/inventario/services/inventario 
ng g component pages/ModuloInventario/inventario/components/inventario-list
ng g service pages/ModuloInventario/inventario/services/inventario 

