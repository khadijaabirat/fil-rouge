<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ============ ADMIN ============
        User::create([
            'name' => 'Admin AlKhair',
            'email' => 'admin@alkhair.ma',
            'password' => Hash::make('password'),
            'phone' => '0600000000',
            'role' => 'admin',
            'ville' => 'Rabat',
            'email_verified_at' => now(),
            'status' => 'ACTIVE',
        ]);

        // ============ ASSOCIATIONS (IDs 2-13) ============
        $associations = [
            ['name' => 'Association Al Nour pour l\'Éducation', 'email' => 'contact@alnour.ma', 'phone' => '0661111111', 'ville' => 'Casablanca', 'licenseNumber' => 'RC-2024-CS-001', 'address' => '12 Boulevard Hassan II, Casablanca', 'rib' => '011780000001234567890123', 'description' => 'Association pionnière dans le domaine de l\'éducation fondée en 2010, elle œuvre pour offrir des bourses scolaires et construire des écoles dans les zones rurales du Maroc.', 'status' => 'ACTIVE', 'category_id' => 1],
            ['name' => 'Fondation Achifaa pour la Santé', 'email' => 'info@achifaa.ma', 'phone' => '0662222222', 'ville' => 'Rabat', 'licenseNumber' => 'RC-2023-RB-045', 'address' => '45 Rue Prince Moulay Abdallah, Rabat', 'rib' => '022110000009876543210987', 'description' => 'Fondation caritative spécialisée dans les soins de santé gratuits pour les familles démunies et le financement d\'opérations chirurgicales.', 'status' => 'ACTIVE', 'category_id' => 2],
            ['name' => 'Association Kafil Al Yatim', 'email' => 'contact@kafilyatim.ma', 'phone' => '0663333333', 'ville' => 'Fès', 'licenseNumber' => 'RC-2022-FS-112', 'address' => '78 Derb Tawil, Fès El Bali', 'rib' => '033220000005678901234567', 'description' => 'Association spécialisée dans le parrainage d\'orphelins et la création d\'un environnement familial stable avec éducation et soins.', 'status' => 'ACTIVE', 'category_id' => 3],
            ['name' => 'Association Akhdar pour l\'Environnement', 'email' => 'green@akhdar.ma', 'phone' => '0664444444', 'ville' => 'Marrakech', 'licenseNumber' => 'RC-2024-MK-078', 'address' => '23 Avenue Mohammed V, Guéliz', 'rib' => '044330000001122334455667', 'description' => 'Association environnementale œuvrant pour la protection de l\'environnement, la plantation d\'arbres et la sensibilisation écologique.', 'status' => 'ACTIVE', 'category_id' => 4],
            ['name' => 'Comité de Secours Marocain', 'email' => 'urgence@ighatha.ma', 'phone' => '0665555555', 'ville' => 'Tanger', 'licenseNumber' => 'RC-2021-TG-033', 'address' => '56 Boulevard Mohammed VI, Tanger', 'rib' => '055440000007788990011223', 'description' => 'Organisme spécialisé dans les secours d\'urgence et l\'aide aux victimes de catastrophes naturelles.', 'status' => 'ACTIVE', 'category_id' => 5],
            ['name' => 'Association Al Bounyan pour le Développement', 'email' => 'info@bounyan.ma', 'phone' => '0666666666', 'ville' => 'Agadir', 'licenseNumber' => 'RC-2023-AG-091', 'address' => '34 Avenue des FAR, Agadir', 'rib' => '066550000003344556677889', 'description' => 'Association œuvrant pour la construction et la rénovation des infrastructures dans les zones rurales de Souss-Massa.', 'status' => 'ACTIVE', 'category_id' => 6],
            ['name' => 'Coopérative Nissa Al Khair', 'email' => 'contact@nissakkhair.ma', 'phone' => '0667777777', 'ville' => 'Meknès', 'licenseNumber' => 'RC-2023-MK-055', 'address' => '15 Rue Rouamzine, Meknès', 'rib' => '077660000009900112233445', 'description' => 'Coopérative féminine dédiée à l\'autonomisation des femmes à travers la formation professionnelle et les projets générateurs de revenus.', 'status' => 'ACTIVE', 'category_id' => 7],
            ['name' => 'Association Chabab Al Moustaqbal', 'email' => 'sport@chabab.ma', 'phone' => '0668888888', 'ville' => 'Kénitra', 'licenseNumber' => 'RC-2024-KN-029', 'address' => '90 Avenue Mohammed V, Kénitra', 'rib' => '088770000001122334455667', 'description' => 'Association sportive et culturelle pour les jeunes des quartiers défavorisés.', 'status' => 'ACTIVE', 'category_id' => 8],
            ['name' => 'Fondation Atlas pour l\'Éducation', 'email' => 'atlas@education.ma', 'phone' => '0669999999', 'ville' => 'Béni Mellal', 'licenseNumber' => 'RC-2022-BM-067', 'address' => '22 Rue Tarik Ibn Ziad, Béni Mellal', 'rib' => '099880000005566778899001', 'description' => 'Fondation spécialisée dans l\'éducation en milieu rural et la lutte contre l\'abandon scolaire dans la région Béni Mellal-Khénifra.', 'status' => 'ACTIVE', 'category_id' => 1],
            ['name' => 'Association Hayat pour la Santé', 'email' => 'hayat@sante.ma', 'phone' => '0661010101', 'ville' => 'Oujda', 'licenseNumber' => 'RC-2023-OJ-041', 'address' => '67 Boulevard Derfoufi, Oujda', 'rib' => '011990000007788990011223', 'description' => 'Association médicale proposant des consultations gratuites et des campagnes de sensibilisation sanitaire dans l\'Oriental.', 'status' => 'ACTIVE', 'category_id' => 2],
            ['name' => 'Association Amal Bladi', 'email' => 'contact@amalbladi.ma', 'phone' => '0662020202', 'ville' => 'Oujda', 'licenseNumber' => 'RC-2024-OJ-015', 'address' => '89 Rue Baraka, Oujda', 'rib' => '022110000003344556677889', 'description' => 'Association polyvalente s\'occupant de l\'éducation et de la santé dans la région de l\'Oriental.', 'status' => 'PENDING', 'category_id' => 1],
            ['name' => 'Fondation Rif Solidaire', 'email' => 'rif@solidaire.ma', 'phone' => '0663030303', 'ville' => 'Al Hoceïma', 'licenseNumber' => 'RC-2024-AH-008', 'address' => '12 Rue Calabonita, Al Hoceïma', 'rib' => '033220000009900112233445', 'description' => 'Fondation dédiée au développement de la région du Rif avec des projets d\'infrastructure et d\'aide sociale.', 'status' => 'PENDING', 'category_id' => 6],
        ];

        foreach ($associations as $assoc) {
            User::create(array_merge($assoc, [
                'password' => Hash::make('password'),
                'role' => 'association',
                'email_verified_at' => now(),
            ]));
        }

        // ============ DONATEURS (IDs 14-28) ============
        $donators = [
            ['name' => 'Ahmed Benali', 'email' => 'ahmed@gmail.com', 'phone' => '0670111111', 'ville' => 'Casablanca'],
            ['name' => 'Fatima Zahra Alaoui', 'email' => 'fatima@gmail.com', 'phone' => '0670222222', 'ville' => 'Rabat'],
            ['name' => 'Youssef Marrakchi', 'email' => 'youssef@gmail.com', 'phone' => '0670333333', 'ville' => 'Marrakech'],
            ['name' => 'Khadija Benmoussa', 'email' => 'khadija@gmail.com', 'phone' => '0670444444', 'ville' => 'Fès'],
            ['name' => 'Mohamed Tazi', 'email' => 'mohamed@gmail.com', 'phone' => '0670555555', 'ville' => 'Tanger'],
            ['name' => 'Sara Idrissi', 'email' => 'sara@gmail.com', 'phone' => '0670666666', 'ville' => 'Meknès'],
            ['name' => 'Omar Benchekroun', 'email' => 'omar@gmail.com', 'phone' => '0670777777', 'ville' => 'Agadir'],
            ['name' => 'Nadia Fassi', 'email' => 'nadia@gmail.com', 'phone' => '0670888888', 'ville' => 'Casablanca'],
            ['name' => 'Rachid El Mansouri', 'email' => 'rachid@gmail.com', 'phone' => '0670999999', 'ville' => 'Rabat'],
            ['name' => 'Laila Bouzidi', 'email' => 'laila@gmail.com', 'phone' => '0671111111', 'ville' => 'Fès'],
            ['name' => 'Hassan Ouazzani', 'email' => 'hassan@gmail.com', 'phone' => '0671222222', 'ville' => 'Tanger'],
            ['name' => 'Amina Chraibi', 'email' => 'amina@gmail.com', 'phone' => '0671333333', 'ville' => 'Marrakech'],
            ['name' => 'Karim Senhaji', 'email' => 'karim@gmail.com', 'phone' => '0671444444', 'ville' => 'Oujda'],
            ['name' => 'Zineb El Amrani', 'email' => 'zineb@gmail.com', 'phone' => '0671555555', 'ville' => 'Kénitra'],
            ['name' => 'Driss Belhaj', 'email' => 'driss@gmail.com', 'phone' => '0671666666', 'ville' => 'Béni Mellal'],
        ];

        foreach ($donators as $donator) {
            User::create(array_merge($donator, [
                'password' => Hash::make('password'),
                'role' => 'donator',
                'email_verified_at' => now(),
            ]));
        }
    }
}
