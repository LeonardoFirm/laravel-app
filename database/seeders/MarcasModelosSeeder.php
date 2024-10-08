<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasModelosSeeder extends Seeder
{
    public function run()
    {
        // Adicionando marcas e seus respectivos modelos
        $marcasModelos = [
            'Toyota' => ['Corolla', 'Camry', 'Hilux', 'Yaris', 'Land Cruiser', 'RAV4', 'Prius', 'C-HR'],
            'Honda' => ['Civic', 'Accord', 'HR-V', 'Fit', 'CR-V', 'Pilot', 'Ridgeline', 'Element'],
            'Ford' => ['Fiesta', 'Focus', 'Ranger', 'EcoSport', 'Fusion', 'Mustang', 'Explorer', 'Escape'],
            'Chevrolet' => ['Onix', 'Tracker', 'S10', 'Cobalt', 'Malibu', 'Cruze', 'Camaro', 'Trailblazer'],
            'Volkswagen' => ['Gol', 'Polo', 'T-Cross', 'Virtus', 'Jetta', 'Passat', 'Touareg', 'Beetle'],
            'Nissan' => ['Versa', 'Sentra', 'Kicks', 'Rogue', 'Frontier', 'Altima', 'Pathfinder', 'Murano'],
            'Hyundai' => ['Hb20', 'Creta', 'Tucson', 'Elantra', 'Santa Fe', 'Kona', 'Veloster', 'i30'],
            'Kia' => ['Picanto', 'Seltos', 'Sportage', 'Cerato', 'Carnival', 'Stinger', 'Rio', 'Soul'],
            'Peugeot' => ['208', '3008', '5008', 'Partner', 'Expert', '3008 PHEV', '508', '2008'],
            'Fiat' => ['Palio', 'Argo', 'Toro', 'Doblò', 'Fiorino', 'Cronos', '500', 'Punto'],
            'Renault' => ['Kwid', 'Sandero', 'Duster', 'Captur', 'Logan', 'Zoe', 'Koleos', 'Trafic'],
            'Subaru' => ['Impreza', 'Outback', 'Forester', 'XV', 'BRZ', 'Crosstrek', 'Legacy', 'Ascent'],
            'Mazda' => ['Mazda3', 'CX-5', 'CX-30', 'MX-5', 'Mazda6', 'CX-50', 'CX-9', '2'],
            'Mitsubishi' => ['Lancer', 'Outlander', 'ASX', 'Pajero', 'Eclipse Cross', 'Mirage', 'Montero'],
            'Dodge' => ['Charger', 'Challenger', 'Durango', 'Journey', 'Viper', 'Ram 1500', 'Ram 2500'],
            'Chrysler' => ['300', 'Pacifica', 'Voyager'],
            'GMC' => ['Sierra', 'Canyon', 'Acadia', 'Yukon'],
            'Jeep' => ['Wrangler', 'Cherokee', 'Grand Cherokee', 'Renegade', 'Compass'],
            'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y'],
            'Land Rover' => ['Range Rover', 'Discovery', 'Defender'],
            'Volvo' => ['XC40', 'XC60', 'XC90', 'S60', 'S90'],
            'Audi' => ['A3', 'A4', 'A6', 'Q3', 'Q5', 'Q7', 'Q8'],
            'BMW' => ['1 Series', '3 Series', '5 Series', '7 Series', 'X1', 'X3', 'X5'],
            'Mercedes-Benz' => ['A-Class', 'C-Class', 'E-Class', 'S-Class', 'GLA', 'GLC', 'GLE'],
            'Porsche' => ['911', 'Cayenne', 'Macan', 'Taycan'],
            'Jaguar' => ['F-Pace', 'E-Pace', 'I-Pace', 'XF', 'XE'],
            'Infiniti' => ['Q50', 'Q60', 'QX50', 'QX80'],
            'Acura' => ['ILX', 'TLX', 'RDX', 'MDX'],
            'Lexus' => ['IS', 'ES', 'GS', 'RX', 'NX', 'LX'],
            'Alfa Romeo' => ['Giulia', 'Stelvio'],
        ];

        foreach ($marcasModelos as $marca => $modelos) {
            // Verifica se a marca já existe e obtém o ID ou a insere
            DB::table('marcas')->updateOrInsert(['nome' => $marca]);

            // Obtém o ID da marca após inserção
            $marcaId = DB::table('marcas')->where('nome', $marca)->first()->id;

            foreach ($modelos as $modelo) {
                // Verifica se o modelo já existe e o insere
                DB::table('modelos')->updateOrInsert(
                    ['nome' => $modelo, 'marca_id' => $marcaId],
                    ['marca_id' => $marcaId] // Preenche a coluna marca_id se necessário
                );
            }
        }
    }
}
