# estrcutura de carpeta por modulos dentro del ModuloDevolucion
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


# crud nota
ng g module pages/ModuloDevolucion/nota-devolucion --routing
ng g service pages/ModuloDevolucion/nota-devolucion/services/nota-devolucion
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-list
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-list-cancelada
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-form
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-detalle
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-grupo
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-add
ng g component pages/ModuloDevolucion/nota-devolucion/components/nota-devolucion-estado-cliente
ng g service pages/ModuloDevolucion/nota-devolucion/services/nota-devolucion
ng g service pages/ModuloDevolucion/nota-devolucion/services/detalle-devolucion
