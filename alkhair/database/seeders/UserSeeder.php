<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);



        


       $donators = [
            ['name' => 'Ahmed Amine', 'email' => 'ahmed@gmail.com', 'phone' => '0611223344'],
            ['name' => 'Fatima Zahra', 'email' => 'fatima@gmail.com', 'phone' => '0622334455'],
            ['name' => 'Youssef El Fassi', 'email' => 'youssef@gmail.com', 'phone' => '0633445566'],
            ['name' => 'Khadija Mansour', 'email' => 'khadija@gmail.com', 'phone' => '0644556677'],
            ['name' => 'Omar Benjelloun', 'email' => 'omar@gmail.com', 'phone' => '0655667788'],
        ];

        foreach ($donators as $donator) {
            User::create([
                'name' => $donator['name'],
                'email' => $donator['email'],
                'phone' => $donator['phone'],
                'password' => Hash::make('donateur'),
                'role' => 'donator',
                'status' => 'ACTIVE',
            ]);
        }





        $associations = [
            [
                'name' => 'Association Sakia Al Khair',
                'email' => 'association1@gmail.com',
                'phone' => '0600112233',
                'ville' => 'Zagora',
                'address' => 'Quartier Administratif, Zagora',
                'description' => 'Œuvre pour le creusement de puits et l\'approvisionnement en eau potable dans les villages isolés du sud marocain.',
                'rib' => '011810000000000000000001',
                'category_id' => 1,
            ],
            [
                'name' => 'Fondation Atlas pour le Développement',
                'email' => 'association2@gmail.com',
                'phone' => '0600112244',
                'ville' => 'Azilal',
                'address' => 'Centre Ville, Azilal',
                'description' => 'Désenclavement des zones montagneuses et développement des infrastructures rurales.',
                'rib' => '011810000000000000000002',
                'category_id' => 1,
            ],

            [
                'name' => 'Association Iqraa pour l\'Éducation',
                'email' => 'association3@gmail.com',
                'phone' => '0600223344',
                'ville' => 'Errachidia',
                'address' => 'Avenue Mohammed V, Errachidia',
                'description' => 'Lutte contre l\'abandon scolaire et distribution de fournitures pour les enfants démunis.',
                'rib' => '011810000000000000000003',
                'category_id' => 2,
            ],
            [
                'name' => 'Fondation Sanad pour le Soutien',
                'email' => 'association4@gmail.com',
                'phone' => '0600223355',
                'ville' => 'Casablanca',
                'address' => 'Quartier Maarif, Casablanca',
                'description' => 'Soutien scolaire gratuit et aménagement de bibliothèques dans les écoles publiques.',
                'rib' => '011810000000000000000004',
                'category_id' => 2,
            ],

            [
                'name' => 'Association Chifaa Médicale',
                'email' => 'association5@gmail.com',
                'phone' => '0600334455',
                'ville' => 'Marrakech',
                'address' => 'Gueliz, Marrakech',
                'description' => 'Organisation de caravanes médicales multidisciplinaires dans les régions enclavées.',
                'rib' => '011810000000000000000005',
                'category_id' => 3,
            ],
            [
                'name' => 'Médecins de l\'Espoir Maroc',
                'email' => 'association6@gmail.com',
                'phone' => '0600334466',
                'ville' => 'Oujda',
                'address' => 'Boulevard Mohammed VI, Oujda',
                'description' => 'Prise en charge des opérations chirurgicales pour les familles sans couverture médicale.',
                'rib' => '011810000000000000000006',
                'category_id' => 3,
            ],

            [
                'name' => 'Association Amal pour les Orphelins',
                'email' => 'association7@gmail.com',
                'phone' => '0600445566',
                'ville' => 'Fès',
                'address' => 'Médina, Fès',
                'description' => 'Soutien financier et psychologique aux veuves et prise en charge des orphelins.',
                'rib' => '011810000000000000000007',
                'category_id' => 4,
            ],
            [
                'name' => 'Fondation Al Ikhlass',
                'email' => 'association8@gmail.com',
                'phone' => '0600445577',
                'ville' => 'Tanger',
                'address' => 'Place des Nations, Tanger',
                'description' => 'Distribution de couffins alimentaires et aide aux sans-abris.',
                'rib' => '011810000000000000000008',
                'category_id' => 4,
            ],

            [
                'name' => 'Secours Populaire Marocain',
                'email' => 'association9@gmail.com',
                'phone' => '0600556677',
                'ville' => 'Rabat',
                'address' => 'Agdal, Rabat',
                'description' => 'Intervention rapide lors des catastrophes naturelles et distribution de tentes et couvertures.',
                'rib' => '011810000000000000000009',
                'category_id' => 5,
            ],
            [
                'name' => 'Association Mounqid',
                'email' => 'association10@gmail.com',
                'phone' => '0600556688',
                'ville' => 'Agadir',
                'address' => 'Talborjt, Agadir',
                'description' => 'Aide d\'urgence et reconstruction des habitations détruites.',
                'rib' => '011810000000000000000010',
                'category_id' => 5,
            ],

            [
                'name' => 'Association Basma pour l\'Inclusion',
                'email' => 'association11@gmail.com',
                'phone' => '0600667788',
                'ville' => 'Tétouan',
                'address' => 'Avenue Hassan II, Tétouan',
                'description' => 'Achat de chaises roulantes et accompagnement professionnel des personnes à mobilité réduite.',
                'rib' => '011810000000000000000011',
                'category_id' => 6,
            ],
            [
                'name' => 'Fondation Nour pour les Non-Voyants',
                'email' => 'association12@gmail.com',
                'phone' => '0600667799',
                'ville' => 'Meknès',
                'address' => 'Ville Nouvelle, Meknès',
                'description' => 'Soutien à la scolarisation en braille et insertion sociale des non-voyants.',
                'rib' => '011810000000000000000012',
                'category_id' => 6,
            ],
        ];
       foreach ($associations as $assoc) {
            User::create(array_merge($assoc, [
                'password' =>Hash::make('association'),
                'role' => 'association',
                'status' => 'ACTIVE',
                'licenseNumber' => 'LIC-' . rand(1000, 9999),
            ]));
        }
    }
}
