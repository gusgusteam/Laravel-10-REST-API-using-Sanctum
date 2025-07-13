<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Configuracion;
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
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'lucas',
            'email' => 'lucas@gmail.com',
            'password' => Hash::make('123'),
        ]);

        //User::create([
        //    'name' => 'diego',
        //    'email' => 'diego@gmail.com',
        //    //'paterno' => 'barrios',
        //    //'materno' => 'zenteno',
        //    //'edad'=> 22,
        //    //'fechaNacimiento' => '2003/05/19',
        //    //'direccion' => 'montero - santa cruz de la sierra',
        //    //'ci' => 82922,
        //    'password' => Hash::make('123'),
        //    
        //]);

        //User::create([
        //    'name' => 'fernando',
        //    'email' => 'fernando@gmail.com',
        //    //'paterno' => 'carvajal',
        //    //'materno' => 'barrioz',
        //    //'edad'=> 22,
        //    //'fechaNacimiento' => '2002/05/19',
        //    //'direccion' => 'santa cruz de la sierra',
        //    //'ci' => 99922,
        //    'password' => Hash::make('123'),
        //    
        //]);
//
        //User::create([
        //    'name' => 'alfredo',
        //    'email' => 'alfredo@gmail.com',
        //    //'paterno' => 'barrios',
        //    //'materno' => 'veisaga',
        //    //'edad'=> 21,
        //    //'fechaNacimiento' => '2004/05/19',
        //    //'direccion' => 'santa cruz de la sierra',
        //    //'ci' => 77122,
        //    'password' => Hash::make('123'),
        //    
        //]);
//
        //User::create([
        //    'name' => 'luis',
        //    'email' => 'luis@gmail.com',
        //   // 'paterno' => 'barrios',
        //   // 'materno' => 'merida',
        //   // 'edad'=> 25,
        //   // 'fechaNacimiento' => '1998/05/20',
        //   // 'direccion' => 'santa cruz de la sierra',
        //   // 'ci' => 70192,
        //    'password' => Hash::make('123'),
        //    
        //]);

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
            'nombre' => 'INNOCULANTE',
        ]);

        TipoProducto::create([
            'nombre' => 'LIQUIDO',
        ]);
        TipoProducto::create([
            'nombre' => 'GRANULADO',
        ]);
        TipoProducto::create([
            'nombre' => 'POLVO',
        ]);
        TipoProducto::create([
            'nombre' => 'GEL',
        ]);

        Producto::create([
            'nombre' => 'AMINO-FOL',
            'descripcion'=> 'aminoacido 80% foliar',
            'dosis'=> '0.1 kg',
            'categoria_id'=> 1,
            'tipo_producto_id'=> 3
        ]); 
        Producto::create([
            'nombre' => 'Serfol plus',
            'descripcion'=> 'llenado apk',
            'dosis'=> '0.2 lts',
            'categoria_id'=> 1,
            'tipo_producto_id'=> 1
        ]);

        Unidad::create([
            'nombre' => 'LITRO',
            'nombre_corto' => 'LTS',            
        ]);
        Unidad::create([
            'nombre' => 'KILO',
            'nombre_corto' => 'KG',            
        ]);
        Unidad::create([
            'nombre' => 'GRAMO',
            'nombre_corto' => 'G',            
        ]);

        Gestion::create([
            'anio' => '2025',
            'nombre_campania' => 'INVIERNO',
            'gestion_actual' => 1,         
        ]);
        Gestion::create([
            'anio' => '2025',
            'nombre_campania' => 'VERANO',            
        ]);
        Cultivo::create([
            'nombre' => 'SOYA',        
        ]);

        Cultivo::create([
            'nombre' => 'ARROZ',        
        ]);

        Cultivo::create([
            'nombre' => 'SORGO',        
        ]);

        Cliente::create([
            'nombre'=> 'MIRIAM',
            'paterno'=> 'BARRIOS',
            'materno'=> 'OLIVERA',
            'ci'=> '1'       
        ]);

        Cliente::create([
            'nombre'=> 'IVER',
            'paterno'=> 'CORONADO',
            'materno'=> '',
            'ci'=> '2'       
        ]);

        Cliente::create([
            'nombre'=> 'JHERY',
            'paterno'=> 'BARRIOS',
            'materno'=> 'MEDRANO',
            'ci'=> '3'       
        ]);

        Cliente::create([
            'nombre'=> 'ISAEL',
            'paterno'=> 'BARRIOS',
            'materno'=> '',
            'ci'=> '13'       
        ]);

        Cliente::create([
            'nombre'=> 'JUAN CARLOS',
            'paterno'=> 'BARRIOS',
            'materno'=> 'VEIZAGA',
            'ci'=> '4'       
        ]);

        Cliente::create([
            'nombre'=> 'JHONY',
            'paterno'=> 'BARRIOS',
            'materno'=> 'VEIZAGA',
            'ci'=> '5'       
        ]);

        Cliente::create([
            'nombre'=> 'ARIEL',
            'paterno'=> 'VASQUEZ',
            'materno'=> 'BARRIOS',
            'ci'=> '6'       
        ]);

        Cliente::create([
            'nombre'=> 'AGRIPINO',
            'paterno'=> 'VARGAS',
            'materno'=> '',
            'ci'=> '7'       
        ]);

        Cliente::create([
            'nombre'=> 'SIMON',
            'paterno'=> 'CHOQUE',
            'materno'=> '',
            'ci'=> '8'       
        ]);

        Cliente::create([
            'nombre'=> 'SENOVIO',
            'paterno'=> 'ROQUE',
            'materno'=> '',
            'ci'=> '9'       
        ]);

        Cliente::create([
            'nombre'=> 'BERNARDO',
            'paterno'=> 'MEDRANO',
            'materno'=> 'VARGAS',
            'ci'=> '10'       
        ]);

        Cliente::create([
            'nombre'=> 'NORBERTO',
            'paterno'=> 'PRADO',
            'materno'=> '',
            'ci'=> '11'       
        ]);

        Cliente::create([
            'nombre'=> 'SULMA',
            'paterno'=> 'MARTINEZ',
            'materno'=> '',
            'ci'=> '12'       
        ]);

        Cliente::create([
            'nombre'=> 'LUIS MIGUEL',
            'paterno'=> 'SANTOS',
            'materno'=> '',
            'ci'=> '14'       
        ]);

        Cliente::create([
            'nombre'=> 'ADOLFO',
            'paterno'=> 'CRUZ',
            'materno'=> '',
            'ci'=> '15'       
        ]);

        Cliente::create([
            'nombre'=> 'MICHAEL',
            'paterno'=> 'DIAZ',
            'materno'=> '',
            'ci'=> '16'       
        ]);

        Cliente::create([
            'nombre'=> 'ADOLFO',
            'paterno'=> 'CRUZ',
            'materno'=> '',
            'ci'=> '17'       
        ]);



        Configuracion::create([
            'nombre_empresa' => 'Agro Aisa',
            'telefono' => '71619345',
            'direccion' => 'zona norte - san jose del norte',
            'email' => 'empresa@gmail.com',
            'nit' => '0000',
            'razon_social' => 'Agro Aisa S.A.',
            'logo' => 'ConfiguracionLogo/logo.png',
            'frase' => 'gracias por preferirnos',
            'id_gestion' => 1,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
