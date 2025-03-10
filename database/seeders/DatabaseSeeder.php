<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Cultivo;
use App\Models\Gestion;
use App\Models\Producto;
use App\Models\TipoProducto;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       //  \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            //'paterno' => 'sistema ',
            //'materno' => 'web',
            //'edad'=> 23,
            //'fechaNacimiento' => '1995/05/19',
            //'direccion' => 'montero - santa cruz de la sierra',
            //'ci' => 999999,
            'password' => Hash::make('123'),
            //'superAdmin'=> 1,
        ]);

        User::create([
            'name' => 'diego',
            'email' => 'diego@gmail.com',
            //'paterno' => 'barrios',
            //'materno' => 'zenteno',
            //'edad'=> 22,
            //'fechaNacimiento' => '2003/05/19',
            //'direccion' => 'montero - santa cruz de la sierra',
            //'ci' => 82922,
            'password' => Hash::make('123'),
            
        ]);

        User::create([
            'name' => 'fernando',
            'email' => 'fernando@gmail.com',
            //'paterno' => 'carvajal',
            //'materno' => 'barrioz',
            //'edad'=> 22,
            //'fechaNacimiento' => '2002/05/19',
            //'direccion' => 'santa cruz de la sierra',
            //'ci' => 99922,
            'password' => Hash::make('123'),
            
        ]);

        User::create([
            'name' => 'alfredo',
            'email' => 'alfredo@gmail.com',
            //'paterno' => 'barrios',
            //'materno' => 'veisaga',
            //'edad'=> 21,
            //'fechaNacimiento' => '2004/05/19',
            //'direccion' => 'santa cruz de la sierra',
            //'ci' => 77122,
            'password' => Hash::make('123'),
            
        ]);

        User::create([
            'name' => 'luis',
            'email' => 'luis@gmail.com',
           // 'paterno' => 'barrios',
           // 'materno' => 'merida',
           // 'edad'=> 25,
           // 'fechaNacimiento' => '1998/05/20',
           // 'direccion' => 'santa cruz de la sierra',
           // 'ci' => 70192,
            'password' => Hash::make('123'),
            
        ]);

        Categoria::create([
            'nombre' => 'FERTILIZANTE',
        ]);
        Categoria::create([
            'nombre' => 'HERBICIDA',
        ]);
        Categoria::create([
            'nombre' => 'FUNGICIDA',
        ]);
        Categoria::create([
            'nombre' => 'COYUANTE',
        ]);
        Categoria::create([
            'nombre' => 'ACEITE',
        ]);
        Categoria::create([
            'nombre' => 'INSECTICIDA',
        ]);
        Categoria::create([
            'nombre' => 'INNICULANTE',
        ]);

        TipoProducto::create([
            'nombre' => 'granulado',
        ]);
        TipoProducto::create([
            'nombre' => 'liquido',
        ]);
        TipoProducto::create([
            'nombre' => 'polvo',
        ]);
        TipoProducto::create([
            'nombre' => 'gel',
        ]);

        Producto::create([
            'nombre' => 'Amino-fol',
            'descripcion'=> 'aminoacido 80% foliar',
            'dosis'=> '0.1 kg',
            'precio_estimado'=> 20.0,
            'margen_minimo'=> 15.0,
            'margen_standar'=> 20.0,
            'margen_maximo'=> 25.0,
            'categoria_id'=> 1,
            'tipo_producto_id'=> 3
        ]);

        Producto::create([
            'nombre' => 'Serfol plus',
            'descripcion'=> 'llenado apk',
            'dosis'=> '0.2 lts',
            'precio_estimado'=> 5.5,
            'margen_minimo'=> 15.0,
            'margen_standar'=> 20.0,
            'margen_maximo'=> 25.0,
            'categoria_id'=> 1,
            'tipo_producto_id'=> 2
        ]);

        Unidad::create([
            'nombre' => 'litro',
            'nombre_corto' => 'LTS',            
        ]);
        Unidad::create([
            'nombre' => 'kilo',
            'nombre_corto' => 'kg',            
        ]);
        Unidad::create([
            'nombre' => 'gramo',
            'nombre_corto' => 'g',            
        ]);

        Gestion::create([
            'anio' => '2023',
            'nombre_campania' => 'verano',            
        ]);
        Gestion::create([
            'anio' => '2023',
            'nombre_campania' => 'invierno',            
        ]);
        Cultivo::create([
            'nombre' => 'soya',        
        ]);
        Cultivo::create([
            'nombre' => 'arroz',        
        ]);

        Cliente::create([
            'nombre'=> 'bernardo',
            'paterno'=> 'medrano',
            'materno'=> 'vargas',
           // 'telefono'=> '3422345',
           // 'direccion'=> 'montero',
            'ci'=> '11'       
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
