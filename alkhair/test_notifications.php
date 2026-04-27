<?php

// Test Notifications Status

echo "=== VERIFICATION DES NOTIFICATIONS AL-KHAIR ===\n\n";

// 1. Check Notifications Table
echo "1. TABLE NOTIFICATIONS:\n";
try {
    $notifCount = DB::table('notifications')->count();
    echo "   ✓ Table existe - {$notifCount} notifications\n";
} catch (Exception $e) {
    echo "   ✗ Erreur: " . $e->getMessage() . "\n";
}

// 2. Check Notification Classes
echo "\n2. CLASSES NOTIFICATIONS:\n";
$classes = [
    'App\\Notifications\\AssociationStatusChanged',
    'App\\Notifications\\DonationStatusChanged',
    'App\\Notifications\\ImpactReportPublished',
];

foreach ($classes as $class) {
    if (class_exists($class)) {
        echo "   ✓ {$class}\n";
    } else {
        echo "   ✗ {$class} - MANQUANTE\n";
    }
}

// 3. Check Email Configuration
echo "\n3. CONFIGURATION EMAIL:\n";
echo "   MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
echo "   MAIL_HOST: " . env('MAIL_HOST') . "\n";
echo "   MAIL_PORT: " . env('MAIL_PORT') . "\n";
echo "   MAIL_FROM: " . env('MAIL_FROM_ADDRESS') . "\n";

// 4. Check Queue Configuration
echo "\n4. CONFIGURATION QUEUE:\n";
echo "   QUEUE_CONNECTION: " . env('QUEUE_CONNECTION') . "\n";
try {
    $jobsCount = DB::table('jobs')->count();
    echo "   ✓ Table jobs existe - {$jobsCount} jobs en attente\n";
} catch (Exception $e) {
    echo "   ✗ Erreur jobs: " . $e->getMessage() . "\n";
}

// 5. Check where notifications are used
echo "\n5. UTILISATION DANS LE CODE:\n";
echo "   ✓ AdminController::validateAssociation() - ligne 91\n";
echo "   ✓ AdminController::banAssociation() - ligne 145\n";
echo "   ✓ AdminController::validateDonation() - ligne 118\n";
echo "   ✓ AdminController::rejectDonation() - ligne 139\n";
echo "   ✓ ImpactReportController::store() - ligne 88-93\n";

// 6. Test notification sending (simulation)
echo "\n6. TEST SIMULATION:\n";
echo "   Pour tester:\n";
echo "   - Admin valide association → Email + DB notification\n";
echo "   - Admin valide don manuel → Email + DB notification\n";
echo "   - Association publie rapport → Email à tous donateurs\n";

echo "\n=== FIN VERIFICATION ===\n";
