# estrcutura de carpeta por modulos dentro del ModuloProducto
│── components/
│   │── categoria-list/
│   │   ├── categoria-list.component.ts
│   │   ├── categoria-list.component.html
│   │   ├── categoria-list.component.css
│   │
│   │── categoria-form/
│   │   ├── categoria-form.component.ts
│   │   ├── categoria-form.component.html
│   │   ├── categoria-form.component.css
│
│── services/
│   ├── categoria.service.ts
│
│── models/
│   ├── categoria.ts
│
│── categoria.module.ts
│── categoria-routing.module.ts
# estructura 


# crud unidad
ng g module pages/ModuloProducto/unidad --routing
ng g service pages/ModuloProducto/unidad/services/unidad
ng g component pages/ModuloProducto/unidad/components/unidad-list
ng g component pages/ModuloProducto/unidad/components/unidad-form
ng g service pages/ModuloProducto/unidad/services/unidad

# crud categoria
ng g module pages/ModuloProducto/categoria --routing
ng g service pages/ModuloProducto/categoria/services/categoria
ng g component pages/ModuloProducto/categoria/components/categoria-list
ng g component pages/ModuloProducto/categoria/components/categoria-form
ng g service pages/ModuloProducto/categoria/services/categoria

# crud producto
ng g module pages/ModuloProducto/producto --routing
ng g service pages/ModuloProducto/producto/services/producto
ng g component pages/ModuloProducto/producto/components/producto-list
ng g component pages/ModuloProducto/producto/components/producto-form
ng g service pages/ModuloProducto/producto/services/producto

# crud tipo producto

ng g module pages/ModuloProducto/tipo-producto --routing
ng g service pages/ModuloProducto/tipo-producto/services/tipo-producto
ng g component pages/ModuloProducto/tipo-producto/components/tipo-producto-list
ng g component pages/ModuloProducto/tipo-producto/components/tipo-producto-form
ng g service pages/ModuloProducto/tipo-producto/services/tipo-producto

# crud productoEnvase
ng g module pages/ModuloProducto/producto-envase --routing
ng g service pages/ModuloProducto/producto-envase/services/producto-envase
ng g component pages/ModuloProducto/producto-envase/components/producto-envase-list
ng g component pages/ModuloProducto/producto-envase/components/producto-envase-form
ng g service pages/ModuloProducto/producto-envase/services/producto-envase