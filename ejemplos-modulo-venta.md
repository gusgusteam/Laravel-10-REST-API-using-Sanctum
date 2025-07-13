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

# crud cultivo
ng g module pages/ModuloVenta/cultivo --routing
ng g service pages/ModuloVenta/cultivo/services/cultivo
ng g component pages/ModuloVenta/cultivo/components/cultivo-list
ng g component pages/ModuloVenta/cultivo/components/cultivo-form
ng g service pages/ModuloVenta/cultivo/services/cultivo

# crud cliente
ng g module pages/ModuloVenta/cliente --routing
ng g service pages/ModuloVenta/cliente/services/cliente
ng g component pages/ModuloVenta/cliente/components/cliente-list
ng g component pages/ModuloVenta/cliente/components/cliente-form
ng g service pages/ModuloVenta/cliente/services/cliente

# crud nota
ng g module pages/ModuloVenta/nota-venta --routing
ng g service pages/ModuloVenta/nota-venta/services/nota-venta
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-list
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-list-cancelada
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-form
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-detalle
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-grupo
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-add
ng g component pages/ModuloVenta/nota-venta/components/nota-venta-estado-cliente
ng g service pages/ModuloVenta/nota-venta/services/nota-venta
ng g service pages/ModuloVenta/nota-venta/services/detalle-venta
