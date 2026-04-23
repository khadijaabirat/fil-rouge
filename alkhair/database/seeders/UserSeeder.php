<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
class UserSeeder extends Seeder
{
    public function run(): void
    {

    $defaultPassword = Hash::make('password');
        // ============ ADMIN ============
      User::create([
            'name' => 'Admin AlKhair',
            'email' => 'admin@alkhair.ma',
            'password' => $defaultPassword,
            'phone' => '0600000000',
            'role' => 'admin',
            'ville' => 'Rabat',
            'email_verified_at' => now(),
            'status' => 'ACTIVE',
        ]);

        // ============ ASSOCIATIONS (IDs 2-13) ============
          $associationsData = [
            [
                'name' => 'Association Espoir et Avenir',
                'email' => 'espoir.avenir@alkhair.ma',
                'description' => 'Association dédiée au soutien éducatif et à l\'accompagnement des jeunes en difficulté scolaire dans les zones rurales du Maroc.',
                'ville' => 'Casablanca',
                'logo' => 'logos/creation-logo-icone-main-arbre_474888-3606.avif',
                'category' => 'Éducation'
            ],
            [
                'name' => 'Solidarité Sans Frontières',
                'email' => 'solidarite.sf@alkhair.ma',
                'description' => 'Organisation humanitaire spécialisée dans l\'aide d\'urgence et le soutien aux familles démunies à travers tout le royaume.',
                'ville' => 'Rabat',
                'logo' => 'logos/images (1).png',
                'category' => 'Santé'
            ],
            [
                'name' => 'Enfance Protégée Maroc',
                'email' => 'enfance.protegee@alkhair.ma',
                'description' => 'Association œuvrant pour la protection et l\'épanouissement des orphelins et enfants en situation difficile.',
                'ville' => 'Marrakech',
                'logo' => 'logos/images (10).jpg',
                'category' => 'Orphelins'
            ],
            [
                'name' => 'Terre Verte du Maroc',
                'email' => 'terre.verte@alkhair.ma',
                'description' => 'Association environnementale engagée dans la reforestation et la lutte contre la désertification au Maroc.',
                'ville' => 'Agadir',
                'logo' => 'logos/images (2).png',
                'category' => 'Environnement'
            ],
            [
                'name' => 'Santé Pour Tous',
                'email' => 'sante.pourtous@alkhair.ma',
                'description' => 'Organisation médicale offrant des soins gratuits et des caravanes médicales dans les régions isolées.',
                'ville' => 'Fès',
                'logo' => 'logos/images (3).png',
                'category' => 'Santé'
            ],
            [
                'name' => 'Avenir Éducatif',
                'email' => 'avenir.educatif@alkhair.ma',
                'description' => 'Association spécialisée dans la construction d\'écoles et la distribution de fournitures scolaires.',
                'ville' => 'Tanger',
                'logo' => 'logos/images (9).jpg',
                'category' => 'Éducation'
            ],
            [
                'name' => 'Bâtisseurs d\'Espoir',
                'email' => 'batisseurs.espoir@alkhair.ma',
                'description' => 'Association de développement des infrastructures rurales: routes, puits, électrification.',
                'ville' => 'Meknès',
                'logo' => 'logos/IMG-20210204-WA0022_logo_5ed3e26a-1404-49ab-8f21-abbdd61adbbc.jpg',
                'category' => 'Infrastructure'
            ],
            [
                'name' => 'Cœur Solidaire',
                'email' => 'coeur.solidaire@alkhair.ma',
                'description' => 'Organisation caritative distribuant des paniers alimentaires et vêtements aux nécessiteux.',
                'ville' => 'Oujda',
                'logo' => 'logos/téléchargement (1).jpg',
                'category' => 'Santé'
            ],
            [
                'name' => 'Lumière de l\'Atlas',
                'email' => 'lumiere.atlas@alkhair.ma',
                'description' => 'Association œuvrant pour l\'électrification et le développement des villages de montagne.',
                'ville' => 'Azilal',
                'logo' => 'logos/téléchargement (10).png',
                'category' => 'Infrastructure'
            ],
            [
                'name' => 'Sourire d\'Enfant',
                'email' => 'sourire.enfant@alkhair.ma',
                'description' => 'Association dédiée au parrainage et au soutien psychologique des orphelins.',
                'ville' => 'Tétouan',
                'logo' => 'logos/téléchargement (2).jpg',
                'category' => 'Orphelins'
            ],
            [
                'name' => 'Eau Vive Maroc',
                'email' => 'eau.vive@alkhair.ma',
                'description' => 'Spécialisée dans le forage de puits et l\'accès à l\'eau potable dans les zones arides.',
                'ville' => 'Taroudant',
                'logo' => 'logos/téléchargement (3).jpg',
                'category' => 'Infrastructure'
            ],
            [
                'name' => 'Éco-Maroc Durable',
                'email' => 'eco.maroc@alkhair.ma',
                'description' => 'Association environnementale axée sur le recyclage et la sensibilisation écologique.',
                'ville' => 'Essaouira',
                'logo' => 'logos/téléchargement (3).png',
                'category' => 'Environnement'
            ],
            [
                'name' => 'Santé Mobile',
                'email' => 'sante.mobile@alkhair.ma',
                'description' => 'Cliniques mobiles offrant des consultations gratuites dans les douars isolés.',
                'ville' => 'Ouarzazate',
                'logo' => 'logos/téléchargement (4).jpg',
                'category' => 'Santé'
            ],
            [
                'name' => 'Savoir et Culture',
                'email' => 'savoir.culture@alkhair.ma',
                'description' => 'Promotion de la lecture et création de bibliothèques communautaires.',
                'ville' => 'Kénitra',
                'logo' => 'logos/téléchargement (4).png',
                'category' => 'Éducation'
            ],
            [
                'name' => 'Main Tendue',
                'email' => 'main.tendue@alkhair.ma',
                'description' => 'Aide d\'urgence aux victimes de catastrophes naturelles et familles sinistrées.',
                'ville' => 'Safi',
                'logo' => 'logos/téléchargement (5).png',
                'category' => 'Santé'
            ],
            [
                'name' => 'Arganiers du Sud',
                'email' => 'arganiers.sud@alkhair.ma',
                'description' => 'Protection de la forêt d\'arganiers et soutien aux coopératives féminines.',
                'ville' => 'Tiznit',
                'logo' => 'logos/téléchargement (6).png',
                'category' => 'Environnement'
            ],
            [
                'name' => 'Toit et Chaleur',
                'email' => 'toit.chaleur@alkhair.ma',
                'description' => 'Rénovation de centres sociaux et distribution de couvertures en hiver.',
                'ville' => 'Ifrane',
                'logo' => 'logos/téléchargement (7).png',
                'category' => 'Infrastructure'
            ],
            [
                'name' => 'Vision Claire',
                'email' => 'vision.claire@alkhair.ma',
                'description' => 'Campagnes de dépistage visuel et distribution de lunettes aux élèves.',
                'ville' => 'Beni Mellal',
                'logo' => 'logos/téléchargement (8).png',
                'category' => 'Santé'
            ],
            [
                'name' => 'Routes du Progrès',
                'email' => 'routes.progres@alkhair.ma',
                'description' => 'Aménagement de routes rurales et désenclavement des douars isolés.',
                'ville' => 'Errachidia',
                'logo' => 'logos/téléchargement (9).png',
                'category' => 'Infrastructure'
            ],
            [
                'name' => 'Espoir Médical',
                'email' => 'espoir.medical@alkhair.ma',
                'description' => 'Équipement de dispensaires et acquisition d\'ambulances pour zones rurales.',
                'ville' => 'Nador',
                'logo' => 'logos/téléchargement.jpg',
                'category' => 'Santé'
            ],
        ];

       foreach ($associationsData as $data) {
             $category = Category::firstOrCreate(['name' => $data['category']]);
            
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $defaultPassword,
                'role' => 'association',
                'ville' => $data['ville'],
                'description' => $data['description'],
                'profilePhoto' => $data['logo'],
                'status' => 'ACTIVE',
                'category_id' => $category->id,
                'licenseNumber' => 'LIC-' . rand(10000, 99999),
                'documentKYC' => 'kyc_documents/verified_' . time() . '.pdf',
                'email_verified_at' => now(),  
            ]);
        }

        // ============ DONATEURS (IDs 14-28) ============
         $donators = [
            [
                'name' => 'Ahmed Benali',
                'email' => 'ahmed.benali@gmail.com',
                'ville' => 'Casablanca',
                'phone' => '+212 6 12 34 56 78',
                'photo' => 'https://randomuser.me/api/portraits/men/1.jpg'
            ],
            [
                'name' => 'Fatima Zahra El Amrani',
                'email' => 'fatima.elamrani@gmail.com',
                'ville' => 'Rabat',
                'phone' => '+212 6 23 45 67 89',
                'photo' => 'https://randomuser.me/api/portraits/women/1.jpg'
            ],
            [
                'name' => 'Youssef Alaoui',
                'email' => 'youssef.alaoui@gmail.com',
                'ville' => 'Marrakech',
                'phone' => '+212 6 34 56 78 90',
                'photo' => 'https://randomuser.me/api/portraits/men/2.jpg'
            ],
            [
                'name' => 'Khadija Mansouri',
                'email' => 'khadija.mansouri@gmail.com',
                'ville' => 'Fès',
                'phone' => '+212 6 45 67 89 01',
                'photo' => 'https://randomuser.me/api/portraits/women/2.jpg'
            ],
            [
                'name' => 'Omar Tazi',
                'email' => 'omar.tazi@gmail.com',
                'ville' => 'Tanger',
                'phone' => '+212 6 56 78 90 12',
                'photo' => 'https://randomuser.me/api/portraits/men/3.jpg'
            ],
            [
                'name' => 'Salma Idrissi',
                'email' => 'salma.idrissi@gmail.com',
                'ville' => 'Agadir',
                'phone' => '+212 6 67 89 01 23',
                'photo' => 'https://randomuser.me/api/portraits/women/3.jpg'
            ],
            [
                'name' => 'Mehdi Benjelloun',
                'email' => 'mehdi.benjelloun@gmail.com',
                'ville' => 'Meknès',
                'phone' => '+212 6 78 90 12 34',
                'photo' => 'https://randomuser.me/api/portraits/men/4.jpg'
            ],
            [
                'name' => 'Nadia Berrada',
                'email' => 'nadia.berrada@gmail.com',
                'ville' => 'Oujda',
                'phone' => '+212 6 89 01 23 45',
                'photo' => 'https://randomuser.me/api/portraits/women/4.jpg'
            ],
            [
                'name' => 'Karim Fassi',
                'email' => 'karim.fassi@gmail.com',
                'ville' => 'Tétouan',
                'phone' => '+212 6 90 12 34 56',
                'photo' => 'https://randomuser.me/api/portraits/men/5.jpg'
            ],
            [
                'name' => 'Amina Chaoui',
                'email' => 'amina.chaoui@gmail.com',
                'ville' => 'Kénitra',
                'phone' => '+212 6 01 23 45 67',
                'photo' => 'https://randomuser.me/api/portraits/women/5.jpg'
            ],
            [
                'name' => 'Rachid Lahlou',
                'email' => 'rachid.lahlou@gmail.com',
                'ville' => 'Safi',
                'phone' => '+212 6 12 34 56 79',
                'photo' => 'https://randomuser.me/api/portraits/men/6.jpg'
            ],
            [
                'name' => 'Zineb Kettani',
                'email' => 'zineb.kettani@gmail.com',
                'ville' => 'Essaouira',
                'phone' => '+212 6 23 45 67 80',
                'photo' => 'https://randomuser.me/api/portraits/women/6.jpg'
            ],
            [
                'name' => 'Hassan Chraibi',
                'email' => 'hassan.chraibi@gmail.com',
                'ville' => 'Beni Mellal',
                'phone' => '+212 6 34 56 78 91',
                'photo' => 'https://randomuser.me/api/portraits/men/7.jpg'
            ],
            [
                'name' => 'Leila Tounsi',
                'email' => 'leila.tounsi@gmail.com',
                'ville' => 'Nador',
                'phone' => '+212 6 45 67 89 02',
                'photo' => 'https://randomuser.me/api/portraits/women/7.jpg'
            ],
            [
                'name' => 'Samir Bennani',
                'email' => 'samir.bennani@gmail.com',
                'ville' => 'Ouarzazate',
                'phone' => '+212 6 56 78 90 13',
                'photo' => 'https://randomuser.me/api/portraits/men/8.jpg'
            ],
            [
                'name' => 'Houda Alami',
                'email' => 'houda.alami@gmail.com',
                'ville' => 'Taroudant',
                'phone' => '+212 6 67 89 01 24',
                'photo' => 'https://randomuser.me/api/portraits/women/8.jpg'
            ],
            [
                'name' => 'Amine Sefrioui',
                'email' => 'amine.sefrioui@gmail.com',
                'ville' => 'Ifrane',
                'phone' => '+212 6 78 90 12 35',
                'photo' => 'https://randomuser.me/api/portraits/men/9.jpg'
            ],
            [
                'name' => 'Samira Filali',
                'email' => 'samira.filali@gmail.com',
                'ville' => 'Azilal',
                'phone' => '+212 6 89 01 23 46',
                'photo' => 'https://randomuser.me/api/portraits/women/9.jpg'
            ],
            [
                'name' => 'Tarik Bensouda',
                'email' => 'tarik.bensouda@gmail.com',
                'ville' => 'Errachidia',
                'phone' => '+212 6 90 12 34 57',
                'photo' => 'https://randomuser.me/api/portraits/men/10.jpg'
            ],
            [
                'name' => 'Imane Zniber',
                'email' => 'imane.zniber@gmail.com',
                'ville' => 'Tiznit',
                'phone' => '+212 6 01 23 45 68',
                'photo' => 'https://randomuser.me/api/portraits/women/10.jpg'
            ],
            [
                'name' => 'Khalid Berrada',
                'email' => 'khalid.berrada@gmail.com',
                'ville' => 'Casablanca',
                'phone' => '+212 6 12 34 56 70',
                'photo' => 'https://randomuser.me/api/portraits/men/11.jpg'
            ],
            [
                'name' => 'Meriem Tazi',
                'email' => 'meriem.tazi@gmail.com',
                'ville' => 'Rabat',
                'phone' => '+212 6 23 45 67 81',
                'photo' => 'https://randomuser.me/api/portraits/women/11.jpg'
            ],
            [
                'name' => 'Adil Lahlou',
                'email' => 'adil.lahlou@gmail.com',
                'ville' => 'Marrakech',
                'phone' => '+212 6 34 56 78 92',
                'photo' => 'https://randomuser.me/api/portraits/men/12.jpg'
            ],
            [
                'name' => 'Siham Bennani',
                'email' => 'siham.bennani@gmail.com',
                'ville' => 'Fès',
                'phone' => '+212 6 45 67 89 03',
                'photo' => 'https://randomuser.me/api/portraits/women/12.jpg'
            ],
            [
                'name' => 'Hicham Alaoui',
                'email' => 'hicham.alaoui@gmail.com',
                'ville' => 'Tanger',
                'phone' => '+212 6 56 78 90 14',
                'photo' => 'https://randomuser.me/api/portraits/men/13.jpg'
            ],
            [
                'name' => 'Rajae Idrissi',
                'email' => 'rajae.idrissi@gmail.com',
                'ville' => 'Agadir',
                'phone' => '+212 6 67 89 01 25',
                'photo' => 'https://randomuser.me/api/portraits/women/13.jpg'
            ],
            [
                'name' => 'Mourad Fassi',
                'email' => 'mourad.fassi@gmail.com',
                'ville' => 'Meknès',
                'phone' => '+212 6 78 90 12 36',
                'photo' => 'https://randomuser.me/api/portraits/men/14.jpg'
            ],
            [
                'name' => 'Laila Mansouri',
                'email' => 'laila.mansouri@gmail.com',
                'ville' => 'Oujda',
                'phone' => '+212 6 89 01 23 47',
                'photo' => 'https://randomuser.me/api/portraits/women/14.jpg'
            ],
            [
                'name' => 'Nabil Chraibi',
                'email' => 'nabil.chraibi@gmail.com',
                'ville' => 'Tétouan',
                'phone' => '+212 6 90 12 34 58',
                'photo' => 'https://randomuser.me/api/portraits/men/15.jpg'
            ],
            [
                'name' => 'Hanane Kettani',
                'email' => 'hanane.kettani@gmail.com',
                'ville' => 'Kénitra',
                'phone' => '+212 6 01 23 45 69',
                'photo' => 'https://randomuser.me/api/portraits/women/15.jpg'
            ],
        ];

foreach ($donators as $donator) {
            User::create([
                'name' => $donator['name'],
                'email' => $donator['email'],
                'password' => $defaultPassword,
                'role' => 'donator',
                'ville' => $donator['ville'],
                'phone' => $donator['phone'],
                'profilePhoto' => $donator['photo'],
                'email_verified_at' => now(),
            ]);
        }
    }
}
