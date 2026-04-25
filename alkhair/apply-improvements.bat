@echo off
echo ========================================
echo   AL-KHAIR - Application des Ameliorations
echo ========================================
echo.

echo [1/5] Rechargement de l'autoloader Composer...
composer dump-autoload
echo.

echo [2/5] Nettoyage du cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.

echo [3/5] Optimisation...
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo.

echo [4/5] Verification de la sante du systeme...
php artisan system:health-check
echo.

echo [5/5] Execution des tests...
php artisan test
echo.

echo ========================================
echo   Ameliorations appliquees avec succes!
echo ========================================
echo.
echo Prochaines etapes:
echo 1. Verifier les logs: storage/logs/laravel.log
echo 2. Tester les validations de dons
echo 3. Consulter IMPROVEMENTS.md pour plus de details
echo.
pause
