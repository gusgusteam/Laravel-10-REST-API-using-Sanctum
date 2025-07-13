# estrcutura de carpeta por modulos dentro del ModuloCompra
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
ng g module pages/ModuloCompra/gestion --routing
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

# crud proveedor
ng g module pages/ModuloCompra/proveedor --routing
ng g service pages/ModuloCompra/proveedor/services/proveedor
ng g component pages/ModuloCompra/proveedor/components/proveedor-list
ng g component pages/ModuloCompra/proveedor/components/proveedor-form
ng g service pages/ModuloCompra/proveedor/services/proveedor

# crud nota
ng g module pages/ModuloCompra/nota-compra --routing
ng g service pages/ModuloCompra/nota-compra/services/nota-compra
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-list
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-list-cancelada
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-form
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-detalle
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-grupo
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-add
ng g component pages/ModuloCompra/nota-compra/components/nota-compra-estado-proveedor
ng g service pages/ModuloCompra/nota-compra/services/nota-compra
ng g service pages/ModuloCompra/nota-compra/services/detalle-compra
